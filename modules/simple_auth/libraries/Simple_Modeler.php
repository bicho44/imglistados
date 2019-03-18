<?php
/**
* Simple_Modeler  
*
* @author           thejw23
* @copyright        (c) 2009 thejw23
* @license          http://www.opensource.org/licenses/isc-license.txt
* @version          1.4.3
* @last change      chainable methods: load(), select(), limit(), set_fields()
* 
* @NOTICE           table columns should be different from class varibales/methods names
* @NOTICE           ie. having table column 'timestamp' or 'skip' may (and probably will) lead to problems
*  
* modified version of Auto_Modeler by Jeremy Bush, 
* class name changed to prevent conflicts while using original Auto_Modeler 
*/
class Simple_Modeler_Core extends Model implements ArrayAccess {
	// The database table name
	protected $table_name = '';
	
	// if false, table fields are loaded from model
	// if true table fields are loaded from db
	// used only when creating table model without id
	protected $auto_fields = true;

	// The database fields
	protected $data = array();
	protected $original = array();
	
	// array, 'form field name' => 'database field name'
     public $aliases = array(); 
     
     // skip those fields from save to database
	public $skip = array ();
      
     //use cache?
     public $use_cache = TRUE; 
		              
     // timestamp fields, they will be auto updated on save()
     // update is only if table has a column with given name
	public $timestamp = array ('time_stamp');
	
	//timestamp updated only on create
	public $timestamp_created = array ('time_stamp_created');
     
     //fetch only those fields, if empty select all fields
     public $select;
     //array with offset and limit for limiting query result
     public $limit;
     public $offset = 0;  
	
	// constructor
	// $id - unique record to load
	public function __construct($id = NULL)
	{
		parent::__construct();

		if ($id != NULL)
          {   
               $this->load($id);
          }           
	}
	
	// Useful for one line method chaining
	// $model - The model name to make
	// $id - unique record to load
	public static function factory($model = FALSE, $id = FALSE)
	{
		$model = empty($model) ? __CLASS__ : ucfirst($model).'_Model';
		return new $model($id);
	}

	// Allows for setting data fields in bulk
	// $data - associative array to set $this->data to
	public function set_fields($data)
	{
          //make sure that table columns are loaded
          $this->load_columns();
          
          //assign new valuse to current data
		foreach ($data as $key => $value)
		{    
			if (array_key_exists($key, $this->aliases))
               {
                    //make use of aliasses 
				$key = $this->aliases[$key];
			}
          	
			if (array_key_exists($key,$this->data))
			{
			     //skip field not existing in current table  
                    $this->data[$key] = $value;
               }                       
		}
		
		return $this;
	}
     
	// Saves the current object 
	public function save()
	{	                    
          //make sure that table columns are loaded
          $this->load_columns();
          
          // $data_to_save=$this->data;
          $data_to_save = array_diff_assoc($this->data, $this->original);

          // if no changes, quit
          if (empty($data_to_save))
          {
               return null;
          }

          //update timestamp fields with current datetime
          foreach ($this->timestamp as $field)
               if (array_key_exists($field, $this->original))
               {
                    $data_to_save[$field] = date('Y-m-d H:i:s');
               }
          
          if ( ! $this->check_id())          
               foreach ($this->timestamp_created as $field)
                    if (array_key_exists($field, $this->original))
                    {
                         $data_to_save[$field] = date('Y-m-d H:i:s');
                    }  

          //remove skipped fields     
          if ( ! empty($this->skip))
               foreach ($this->skip as $skip)
                    if (array_key_exists($skip, $data_to_save))
                    { 
                         unset($data_to_save[$skip]);
                    }
                                                           
		// Do an update
		if ($this->check_id())
		{ 
               return count($this->db->update($this->table_name, $data_to_save, array('id' => $this->data['id'])));
		}
          else // Do an insert
		{
			$id = $this->db->insert($this->table_name, $data_to_save)->insert_id();
			return ($this->data['id'] = $id);
		}
		
		return null;
	}
	
	// load single record based on unique field value
	// $where - where conditions
	// $type - type of clause: where,orwhere, like...
	public function load($value, $key = 'id', $type = 'where')
	{
          //make sure that table columns are loaded
          $this->load_columns();
                       
          // get data , inflector::singular(ucwords($this->table_name)).'_Model'
          //if value is an array, make where statement and load data
          if (is_array($value))
          {
              $data = $this->db->$type($value)->get($this->table_name)->result(TRUE);
          }
          else //else load by default ID key
          {
		    $data = $this->db->$type(array($key => $value))->get($this->table_name)->result(TRUE);
		}
		
		// try and assign the data
		if (count($data) === 1 AND $data = $data->current())
		{
               // set original data
               $this->original = (array) $data;
               // set current data
			$this->data = $this->original; 
		}
		
		return $this;
	}
	
	//insert data into database
	public function insert($data_to_save = array()) 
     {   
	    if ( ! empty($data_to_save) AND is_array($data_to_save))
         {
               //insert data and get inserted id
               $id = $this->db->insert($this->table_name, $data_to_save)->insert_id();
               return $id;
         }
     }
     
	//update table
	public function update($data_to_update = array(), $where = array()) 
     {   
	    if ( ! empty($data_to_update) AND is_array($data_to_update) AND  ! empty($where) AND is_array($where))
         {
               //update table and get number of changed records
               $changed = $this->db->update($this->table_name, $data_to_update, $where);
               return $changed;
         }
     }

	// Deletes the current record and destroys the object
	// or deletes by given conditions 
	public function delete($what = array())
	{
		if (( ! empty($what)) AND (is_array($what)))
		{
		     //delete  based on passed conditions
		     return $this->db->delete($this->table_name, $what);
		}
		elseif (intval($this->data['id']) !== 0) 
		{
			//if no conditions and data is loaded -  delete current loaded data by ID
               return $this->db->delete($this->table_name, array('id' => $this->data['id']));
		}
	}

	// Fetches all rows in the table
	// $order_by - the ORDER BY value to sort by
	// $direction - the direction to sort
	public function fetch_all($order_by = 'id', $direction = 'ASC')
	{
		if ( ! empty($this->limit)) 
          {
             return $this->db->select($this->select)->limit($this->limit,$this->offset)->orderby($order_by, $direction)->get($this->table_name)->result(TRUE);
		}
		else
		{
             //no limits, get all records from table
             return $this->db->select($this->select)->orderby($order_by, $direction)->get($this->table_name)->result(TRUE);
          }
	} 
     
     //set fields for select
     public function select($what=array())
     {
          if (( ! empty($what)) AND (is_array($what)))
          {
               $this->select =  $what;
          }
          
          return $this;
     }
         
     //set limits for select
     public function limit($limit,$offset = 0)
     {
          if (intval($limit) !== 0)
          {
               $this->limit = intval($limit);
               $this->offset = intval($offset);
          }
          return $this;
     }

	// Does a basic search on the table.
	// $where - the where clause to search on
	// $order_by - the ORDER BY value to sort by
	// $direction - the direction to sort
	// $type - where,orwhere...
	public function fetch_where($where = array(), $order_by = 'id', $direction = 'ASC', $type = 'where')
	{		
		if ( ! empty($this->limit)) 
          {
		   return $this->db->select($this->select)->$type($where)->limit($this->limit,$this->offset)->orderby($order_by, $direction)->get($this->table_name)->result(TRUE);
		}
          else
          { 
		   //no limits, get all records from table based on passed conditions
             return $this->db->select($this->select)->$type($where)->orderby($order_by, $direction)->get($this->table_name)->result(TRUE);
		}
	}

     // shortcut for easier count all records
     public function count_all() {
          return $this->db->count_records($this->table_name);
     }
     
     // shortcut for easier count limited records
	// $where - where conditions
	// $type - type of clause: where,orwhere, like...
     public function count_where($where = array(),$type = 'where') {
          return $this->db->$type($where)->count_records($this->table_name);
     }

	// Returns an associative array to use in dropdowns and other widgets
	// $key - the key column of the array
	// $display - the value column of the array
	// $order_by - the direction to sort
	// $where - an optional where array to be passed if you don't want every record
	// $direction - the direction to sort
	public function select_list($key, $display, $order_by = 'id', $where = array(), $direction = 'ASC')
	{
		$rows = array();

          if (empty($where))
          {
               //if no where statements, get all records 
               $query = $this->db->select($key,$display)->orderby($order_by,$direction)->get($this->table_name)->result(TRUE);
          }
          else
          {
               //get using where statement
               $query = $this->db->select($key,$display)->where($where)->orderby($order_by,$direction)->get($this->table_name)->result(TRUE);
          }

		foreach ($query as $row)
		{
		     //assign key - value for select
			$rows[$row->$key] = $row->$display;
		}

		return $rows;
	}
	
     // check if data has been retrived from db and has a value other than 0
     // $field - field to be checked	
	public function check_id($field = 'id') 
     {
          return (intval($this->data[$field]) !== 0) ? TRUE : FALSE;
     }
     
     // auto load table fields
     public function load_columns() 
     {    
          //only if table_name is set and there are no columns set
          if ( ! empty($this->table_name) AND (empty($this->original)) )
          {    
               //only if auto_fields are enabled          
               if ($this->auto_fields) 
               {
                    if ( ! $this->use_cache) 
                    {
                         //if cache is disabled, load from DB
                         $columns = $this->explain();
                    } 
                    else 
                    { 
                         $cache = Cache::instance();
                         if ( ! $columns = $cache->get($this->table_name))
               		{
               		     //delete old cached data
               			$cache->delete($this->table_name);
               			//and set new data
               			$columns = $this->explain();
               			$cache->set($this->table_name, $columns);
               		}
                    }

                    $this->data = $columns;
                    $this->original = $this->data;          
               }               
          }
          
          if ( ! empty($this->data) AND (empty($this->original)) )
               foreach ($this->data as $key => $value) 
               {
                    $this->original[$key] = '';
               }          
     }
	
	// get table columns from db 
	public function explain()
	{
	     //get columns from database
		$columns = array_keys($this->db->list_fields($this->table_name, TRUE));
	     $data = array();
	     //assign default empty values
	     foreach ($columns as $column) 
          { 
		   $data[$column] = '';
		}
          return $data;
	}
	
     // return current data 
	public function as_array()
	{
		return $this->data;
	}
        
        
	// Magic __get() method
	public function __get($key)
	{    
		if (array_key_exists($key, $this->aliases))
		{
			$key = $this->aliases[$key];
		}

     	if (array_key_exists($key, $this->data))
     	{
	    		return $this->data[$key];
	    	}
          return NULL;
	}

	// Magic __set() method
	public function __set($key, $value)
	{
		if (array_key_exists($key, $this->aliases))
          { 
			$key = $this->aliases[$key];
		}
          
		if (array_key_exists($key, $this->data) AND (empty($this->data[$key]) OR $this->data[$key] !== $value))
		{
    		    return $this->data[$key] = $value;
    		}
          return NULL;	
	}
        
	// Array Access Interface
	public function offsetExists($key)
	{
		if (array_key_exists($key, $this->aliases))
		{
			$key = $this->aliases[$key];
		}

		return array_key_exists($key, $this->data);
	}

     // Array Access Interface
	public function offsetSet($key, $value)
	{
		//$this->__set($key, $value);
		if (array_key_exists($key, $this->aliases))
		{
			$key = $this->aliases[$key];
          } 

		if (array_key_exists($key, $this->data) AND (empty($this->data[$key]) OR $this->data[$key] !== $value))
		{
			$this->data[$key] = $value;
		}
		else
		{
		   return NULL;
		}
	}

     // Array Access Interface
	public function offsetGet($key)
	{
		if (array_key_exists($key, $this->data))
		{
			return $this->data[$key];
		}
		return NULL;
	}

     // Array Access Interface
	public function offsetUnset($key)
	{
		if (array_key_exists($key, $this->aliases))
		{
			$key = $this->aliases[$key];
		}
          
		$this->data[$key] = NULL;
	}
	
     // store in session only needed values	  
	public function __sleep()
	{
		// Store only information about the object
		return array('skip','aliases','auto_fields','timestamp','timestamp_created','table_name','original','data');
	}

	// restore db connection
	public function __wakeup()
	{
		// Initialize database
          parent::__construct();
	}

}