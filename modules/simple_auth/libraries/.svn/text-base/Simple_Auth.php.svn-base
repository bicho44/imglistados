<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
* Simple_Auth - user authorization library for KohanaPHP framework
*
* @author           thejw23
* @copyright        (c) 2009 thejw23
* @license          http://www.opensource.org/licenses/isc-license.txt
* @version          1.3
* @last change      set_role(), active_to      
* based on KohanaPHP Auth and Auto_Modeler
*/
class Simple_Auth_Core  {

	// Session instance
	protected $session;

	// Configuration
	protected $config;
	
	/**
	 * Creates a new class instance, loading the session and storing config.
	 *
	 * @param   array  configuration
	 * @return  void
	 */
	public function __construct($config = array())
	{
	     // Append default auth configuration
		$config += Kohana::config('simple_auth');
	    
		// Load Session
		$this->session = Session::instance();

		// Save the config in the object
		$this->config = $config;

          //set debug message
		Kohana::log('debug', 'SimpleAuth Library loaded');
	}
	
	
	/**
	 * Create an instance of Simple_Auth.
	 *
	 * @param   array  configuration	 
	 * @return  object
	 */
	public static function factory($config = array())
	{
		return new Simple_Auth($config);
	}

	/**
	 * Return a static instance of Simple_Auth.
	 *
	 * @param   array  configuration	 
	 * @return  object
	 */
	public static function instance($config = array())
	{
		static $instance;

		// Load the Auth instance
		empty($instance) and $instance = new Simple_Auth($config);

		return $instance;
	}
	
	/**
	 * Perform a hash, using the configured method.
	 *
	 * @param   string  password to hash
	 * @return  string
	 */
	public function hash($str)
	{
		return hash($this->config['hash_method'], $this->config['salt_prefix'].$str.$this->config['salt_suffix']); 
	} 
	
	
	/**
	 * Complete the login for a user by incrementing the logins and setting
	 * session data
	 *
	 * @param   object   user model object
	 * @return  void
	 */
	protected function complete_login(Auth_Users_Model $user)
	{	
     
          //update time_stamp to login datetime
          $user->timestamp = array ('time_stamp');
                  
		// Update the number of logins
		$user->logins += 1;
		
          // Set the last login time
		$user->last_time_stamp = $user->time_stamp;
		
		//set user ip
		$user->last_ip_address = $user->ip_address;
		$user->ip_address = $_SERVER['REMOTE_ADDR'];
		
		// Save the user
		$user->save();
 
		// Regenerate session_id
		$this->session->regenerate();         
		// Store username in session
		$this->session->set($this->config['session_key'],$user);
		
		return TRUE;
	}

	/**
	 * Reload user properties from db 	 
	 *      	 
	 */
     public function reload_user() 
     {
          //only for logged in users
          if ($this->logged_in()) 
          {
               //get user id from session
               $user_data = $this->get_user();
               $user_model = new Auth_Users_Model($user_data->id);
               if (!$user_model->check_id())
               {
                 //if there is no such user in database - quit
			  return FALSE;
			} 
               if (intval($user_model->active) === 1)
               {
                    //if user is active, assign new data from database
                    $this->session->set($this->config['session_key'],$user_model);
               }
               else
                    //if user is inactive, log him out
                    $this->logout();                
          }              
     }
     
	/**
	 * assign role to user, by default to current user
	 * 
	 * @param   array   role=>status, where role is admin/active/moderator
	 *                  and status is integer 0/1 or bool	 
	 * @param   object/integer   user model object or user ID            	 
	 */
     public function set_role($role=array(), $user = 0) {

          //role must be an array
          if (!is_array($role)) 
          {
               return FALSE;
          } 

          //role must be an array with only valid roles (by default: admin, active, moderator)
          $role = array_intersect_key($role, $this->config['roles']);
          //if no valid key, quit 
          if (empty($role)) 
          {
               return FALSE;
          } 
          
          //if no user passed, get current user from session
          if ((!is_object($user)) AND (intval($user) === 0))
          {
               $user = $this->get_user();
          }
                         
	    //if user is an object
	    if (is_object($user) AND $user instanceof Auth_Users_Model) 
         {
	         //load user from database
              $user_model = new Auth_Users_Model($user->id);
              //for each $role assign new value 
	         foreach ($role as $key => $value)
	              $user_model->$key = intval($value);
	         //and save     
	         return ($user_model->save()) ? TRUE : FALSE;
         }  
                       
         //if user ID was passed, try to load user from database	    
         $user_model = new Auth_Users_Model($user);                         
	    if (!$user_model->check_id())
         { 
               //if no such user, quit
               return FALSE;
         }
         //for each $role assign new value 
         foreach ($role as $key => $value)
              $user_model->$key = intval($value);
         //and save      
	    return ($user_model->save()) ? TRUE : FALSE;
     }

	/**
	 * Log a user out.
	 *
	 * @param   boolean  completely destroy the session
	 * @return  boolean
	 */
	
	public function logout($destroy = FALSE)
	{
	     //get user ID
	     $user = $this->get_user();
	     if (intval($user['id']) !== 0) 
          {
               //delete user tokens
	          Simple_Modeler::factory('auth_user_tokens')->delete_user_tokens($user['id']);
	     }
	     
		if ($destroy === TRUE)
		{
			// Destroy the session completely
			Session::instance()->destroy();
		}
		else
		{
			// Remove the user from the session
			$this->session->delete($this->config['session_key']);

			// Regenerate session_id
			$this->session->regenerate();
		}
		
          //delete cookie. tokens from db will be deleted on next login.
          cookie::delete($this->config['cookie_key']);
          
		// Double check
		return ! $this->logged_in();
	}
	
	/**
	 * Checks if a session is active.
	 *
	 * @return  boolean
	 */
	public function logged_in()
	{
		$status = FALSE;

		// Get the user from session
		$user =  $this->session->get($this->config['session_key']);
          
          //if user is an object
		if (is_object($user) AND $user instanceof Auth_Users_Model)
		{
			// Everything is okay so far
			$status = TRUE;
		}
          
          //if no user in session check cookies/tokens for autologin
          if (!$status) $status = $this->auto_login();
           
		return $status;	
	}
	
	
	/**
	 * Gets the currently logged in user from the session.
	 * Returns FALSE if no user is currently logged in.
	 *
	 * @return  mixed
	 */
	public function get_user($user = 0)
	{
	    /*if (is_object($user) AND $user instanceof Auth_Users_Model)*/
	    //if no user passed, get current user from session
	    if ((!is_object($user)) AND (intval($user) === 0) AND ($this->logged_in())) 
         {  
			return  $this->session->get($this->config['session_key']);
         } 

	    //if user object given 
	    if (is_object($user) AND $user instanceof Auth_Users_Model) 
         {
               //try to get user data from database
	          $user_model = new Auth_Users_Model(intval($user->id)); 
               if ($user_model->check_id()) 
               {
			     return $user_model->as_array();
               } 
         }  
                       
         //if user ID was passed, try to load user from database	 
         if ((!is_object($user)) AND (intval($user) !== 0)) 
         {	    
               $user_model = new Auth_Users_Model(intval($user));                         
               if ($user_model->check_id()) 
               {
			       return $user_model->as_array();
		     }
         }
          
         return FALSE; 
	}
	
	/**
	 * Logs a user in, based on unique token stored in cookie.
	 *
	 * @return  boolean
	 */
	public function auto_login()  
	{
	     //if token is stored in cookie
		if ($token = cookie::get($this->config['cookie_key']))
		{
			     // Load the token and user
				$token_model = new Auth_User_Tokens_Model($token);
				
				//if token is not in the db
				if (!$token_model->check_id())
				{
				      return FALSE;
                    }

                    //is token from the same browser?
				if ($token_model->user_agent === sha1(Kohana::$user_agent))
				{
					 //load user assigned to token
					 $user = new Auth_Users_Model($token_model->user_id);
                          
                          //if no user or inactive user, quit  
				      if (!$user->check_id() OR (intval($user->active) === 0)) 
                          {    
                              //token is not needed any more
                              $token_model->delete_user_tokens($token_model->user_id, TRUE);
                              return FALSE;
                          }
                         
                         //check if user has not expired 
          			if (valid::date($user->active_to)) 
                         {
                              $now = date('Y-m-d H:i:s');
                              if ($user->active_to < $now) 
                              {
                              	return FALSE;
                              }     
                         }
     				                          
                          // Save the token to create a new unique token
				      $token_model->expires =  date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s')+$this->config['lifetime'], date('m'), date('d'), date('Y'))); 
				      
                          $token_model->save();
                          // Set the new cookie timers
					 cookie::set($this->config['cookie_key'], $token_model->token, strtotime($token_model->expires) - time());
				      
                          //complete login
                          $this->complete_login($user);

					 // Automatic login was successful
					 return TRUE;
				}

				// Token is invalid
				$token_model->delete();
		}

		return FALSE;
	}
	
	/**
     * create new user 
     *
     * @param   array   user data to add
     * @param   string  name of second unique field to verify          
     * @return  bool
     */
	public function create_user($user_data=array(), $second = FALSE) 
     {
          //get password field name from config
          $password_field = $this->config['password'];
          
          //user_data must be an array
          if (empty($user_data) OR !is_array($user_data)) 
          {
                //if not, quit
                return FALSE;
          }
          
          //create empty user object to save      
          $user = new Auth_Users_Model();
          
          if ($second) 
          {
               //if second login field passed to verify with unique user login name 
               $user_exist = $user->user_exists($user_data[$this->config['unique']],$user_data[$this->config['unique_second']]);
          }
          else 
          {
               //verify unique user login name 
               $user_exist = $user->user_exists($user_data[$this->config['unique']]);
          }
               
          //check if username is unique
	     if (!$user_exist)
          {
               //check if user account is time limited, if no valid time, remove from data to save
               if (isset($user_data['active_to']) AND !valid::date($user_data['active_to']))
               {
                    unset($user_data['active_to']);
               }
               
               //to make sure that $user_data['admin']=true works the same as $user_data['admin']=1 
               $roles = $this->config['roles'];
               foreach ($roles as $key=>$value) 
               {
                    if (array_key_exists($key, $user_data))
                    {
                         $user_data[$key] = intval($user_data[$key]);     
                    }     
               }
                
               //assign user fields
               $user->set_fields($user_data);
               //hash the password
               $user->$password_field = $this->hash($user->$password_field);

               //add the user to db
               return ($result = $user->save()) ? $result : FALSE;
          } 
          
          return FALSE; 
     }
     
     
     /**
      * delete user from db 
      *
      * @param   int   user id to delete          
      * @return  bool
      */
     public function delete_user($user) 
     {
	    //if user is an object 
	    if (is_object($user) AND $user instanceof Auth_Users_Model) 
         {
               //delete user from database
	          return ($user->delete()) ? TRUE : FALSE;
         }     
         
         //check if proper number given
	    if (intval($user) === 0) 
         {
               return FALSE;
         } 

         //if user ID was passed, try to load user from database		    
         $user_model = new Auth_Users_Model(intval($user));                          
	    if (!$user_model->check_id()) 
         { 
               //no user in database, quit
               return FALSE;
         }
	    //delete the user
         return ($user_model->delete()) ? TRUE : FALSE;  
     }
     
	/**
	 * Attempt to log in a user by using an ORM object and plain-text password.
	 *
	 * @param   string   username to log in
	 * @param   string   password to check against
	 * @param   boolean  enable auto-login
	 * @return  boolean
	 */
	public function login($user, $password, $remember = FALSE)
	{
	     //get password field name from config
	     $password_field = $this->config['password'];
	     
		//$user and $password must set, ane they must be string type 
          if (empty($password) OR !is_string($password) OR !is_string($user)) 
          {
			return FALSE;
          } 

		$user = new Auth_Users_Model(array('username' => $user,'password' => $password));
		
          //if there is no such user in database, quit
		if (!$user->check_id()) 
          {
			return FALSE;
		}
               
		if (is_string($password))
		{
			// Create a hashed password using the secrets from config
			$password = $this->hash($password);
		}

          // If user is active and the passwords match, perform a login
		if ((intval($user->active) === 1) AND ($user->$password_field == $password))
		{      	    
			//check if user has not expired
               if (valid::date($user->active_to)) 
               {
                    $now = date('Y-m-d H:i:s');
                    if ($user->active_to<$now) 
                    {
                    	return FALSE;
                    }     
               }
			
               if ($remember === TRUE)
			{
				// Create a new autologin token
				$token_model = new Auth_User_Tokens_Model();

				// delete old user tokens
				$token_model->delete_user_tokens($user->id);
				
                    // Set token data
				$token_model->user_id = $user->id;
				$token_model->expires =  date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s')+$this->config['lifetime'], date('m'), date('d'), date('Y')));
				
                    //save token
                    $token_model->save();

				// Set the autologin cookie                    
				cookie::set($this->config['cookie_key'], $token_model->token, $this->config['lifetime']);
			}

			// Finish the login
			$this->complete_login($user);

			return TRUE;
		}

		// Login failed
		return FALSE;
	} 	

}
?>