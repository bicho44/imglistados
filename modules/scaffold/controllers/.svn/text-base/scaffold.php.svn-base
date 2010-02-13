<?php

class Scaffold_Controller extends Template_Controller
{
	public $model_names = array();
	public $template = 'default';

	public function __construct()
	{
		parent::__construct();

		$this->scan_models();

		if(count($this->model_names) == 0)
			throw new Kohana_User_Exception('Scaffolding', 'You must have at least one model to use scaffolding.');

		if(Kohana::config('scaffold.enable_cache'))
			$this->cache = new Cache();
	}

	/**
	 * Outputs a media file, be it an image/javascript/css/etc
	 *
	 * @return void
	 */
	public function media()
	{
		$this->auto_render = FALSE;

		if(isset($_GET['path']))
		{
			// Remove harmful URLs
			$_GET['path'] = preg_replace('#\.[\s./]*/#', '', $_GET['path']);

			$path = MODPATH.'scaffold/media/'.$_GET['path'];
			if(is_file($path))
			{
				$last_modified = filemtime($path);

				if(@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified)
				{
					header("HTTP/1.1 304 Not Modified");
					return;
				}
				else
				{
					header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_modified).' GMT');
					header('Content-type:'); // Blank content-type lets the browser decide
					readfile($path);
				}
			}
		}
	}

	/**
	 * Home reroutes to displaying first model
	 *
	 * @return void
	 */
	public function index()
	{
		url::redirect('scaffold/show/'.$this->model_names[0]);
	}

	/**
	 * Binds relationship SQL loads to a single query
	 *
	 * @param ORM $model
	 * @param mixed $cols
	 */
	private function load_with($model, $cols)
	{
		foreach($cols as $col)
		{
			// If there is a belongs_to or has_one and it's not auto-loaded (load_with)
			if(isset($col['link']) && !in_array($col['link']['alias'], $model->load_with))
				$model->with($col['link']['alias']);
		}
	}

	/**
	 * Displays a model's data
	 *
	 * @param string $model_name
	 * @return void
	 */
	public function show($model_name)
	{
		// Setup the view/template
		$view = View::factory('scaffold/show');
		$this->template->content = $view;

		// Grab column data for this model
		$cols = $this->col_data($model_name);

		$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

		$limit = Kohana::config('scaffold.results_per_page');
		$offset = 0;

		$model = ORM::factory($model_name);
		$this->load_with($model, $cols);

		// Search being performed
		if(isset($_GET['search']) && trim($_GET['search']))
		{
			// Performed on a column that has_one or belongs_to
			if(isset($cols[$_GET['column']]['link']))
			{
				// This searches the primary value of the associated table
				// as well.  For instance, searching the 'city_id' column will
				// search the numeric city ID, as well as the associated 'city'
				// table's 'name' field - cool!
				$link = $cols[$_GET['column']]['link'];

				// Linked table's information
				$link_model = ORM::factory($link['model']);
				$link_tbl = $link_model->table_name;
				$link_pk = $link_model->primary_key;
				$link_pv = $link_model->primary_val;
				$alias = $link['alias'];

				// This model's table name
				$tbl = $model->table_name;

				// Perform the join on the linked table by its primary key
				$model->join($link_tbl, $link_tbl.'.'.$link_pk.' = '.$tbl.'.'.$alias.'_id');

				// Search both this model's column as well as the linked table's primary value
				$model->like($tbl.'.'.$_GET['column'], $_GET['search'], false);

				if(isset($link_model->$link_pv)) // Make sure primary_val column exists
					$model->orlike($link_tbl.'.'.$link_pv, $_GET['search'], false);
			}
			else
				// No relationship on this column, so just search it
				$model->like($model->table_name.'.'.$_GET['column'], $_GET['search'], false);
		}
		else
		{
			// Not performing a search
			$_GET['search'] = '';

			if(isset($cols[$model->primary_val]))
				$_GET['column'] = $model->primary_val;
			else
				$_GET['column'] = '';
		}

		if(!isset($_GET['dir']))
			$_GET['dir'] = 'asc';

		// Sort order and direction
		if(isset($_GET['sort']))
			$model->orderby($_GET['sort'], $_GET['dir']);

		// Grab the results and total returned
		$results = $model->find_all($limit, $limit * ($page - 1));
		$total = $model->count_last_query();

		$pages = new Pagination(array('query_string'=>'page', 'total_items'=>$total, 'items_per_page'=>$limit, 'style'=>'classic'));

		$pk = $model->primary_key;
		$pv = $model->primary_val;

		// Use primary key for value if not a column
		if(!isset($model->$pv))
			$pv = $pk;

		$view->pv = $pv;
		$view->pk = $pk;

		// Column information
		$view->cols = $cols;

		$view->results = $results;

		// Current model name and all model names
		$view->model_name = $model_name;
		$view->model_names = $this->model_names;

		$view->pages = $pages;
	}

	/**
	 * Edits a row (or rows) of data from a model
	 *
	 * @param string $model_name
	 * @param mixed $id
	 * @return void
	 */
	public function edit($model_name, $id = NULL)
	{
		if(is_file(APPPATH.'scaffold/'.$model_name.'/_actions'.EXT))
			include APPPATH.'scaffold/'.$model_name.'/_actions'.EXT;

		// Setup the view/templtae
		$view = View::factory('scaffold/edit');
		$this->template->content = $view;

		$cols = $this->col_data($model_name);

		// Editing a single row
		if(!is_null($id))
			$model = ORM::factory($model_name, $id);
		// Editing multiple rows
		else if(isset($_GET['ids']))
			$model = ORM::factory($model_name, $_GET['ids'][0]);
		// Creating a new row
		else
			$model = ORM::factory($model_name);

		if(function_exists('after_load'))
			after_load($view, $model);

		$post = Validation::factory($_POST);
		if($post->submitted())
		{
			// Multiple rows
			if(isset($_GET['ids']))
			{
				foreach($_GET['ids'] as $id)
				{
					if(!empty($id))
					{
						// Load existing row
						$model = ORM::factory($model_name, $id);

						if(function_exists('before_save'))
							before_save($post, $model);

						foreach($post as $key=>$val)
						{
							if(substr($key, 0, 2) != '__')
							{
								if(!empty($val) || ($cols[$key]['column']['type'] != 'password'))
								{
									// Only save fields that have their checkboxes enabled
									$enable = $key.'_enable';

									// Ignore primary key for multi-edit and unchecked fields
									if(($key != $model->primary_key) && isset($post->$enable))
										$model->$key = $val;
								}
							}
						}

						$model->save();

						if(function_exists('after_save'))
							after_save($post, $model);
					}
				}
			}
			// Single row or creating a new one
			else
			{
				if(function_exists('before_save'))
					before_save($post, $model);

				foreach($post as $key=>$val)
				{
					if(substr($key, 0, 2) != '__')
					{
						// Don't save blank password fields
						if(!empty($val) || ($cols[$key]['column']['type'] != 'password'))
							$model->$key = $val;
					}
				}

				$model->save();

				if(function_exists('after_save'))
					after_save($post, $model);
			}

			url::redirect($_GET['uri']);
		}

		// Load model and column information
		$view->id = $id;
		$view->model = $model;
		$view->model_name = $model_name;
		$view->model_names = $this->model_names;
		$view->cols = $this->col_data($model_name);
	}

	/**
	 * Removes a set of rows from model
	 *
	 * @param string $model_name
	 * @return void
	 */
	public function remove($model_name)
	{
		// Loop thru IDs and remove each
		$model = ORM::factory($model_name);
		foreach($_GET['ids'] as $id)
			$model->delete($id);

		url::redirect($_GET['uri']);
	}

	/**
	 * Loads column data for a model's table, including relationships
	 *
	 * @param string $model_name
	 * @return array Column data
	 */
	private function col_data($model_name)
	{
		$model = ORM::factory($model_name);

		$cols = $model->table_columns;

		// Load has_one and belongs_to relationships and treat them the same.  Store
		// associated info in the 'link' key of the array.
		foreach($model->belongs_to as $alias=>$target)
		{
			// Use target model name as alias if none is set
			if(!is_string($alias))
				$alias = $target;

			// Saves link information for later use
			$cols[$alias.'_id']['link'] = array('alias'=>$alias, 'model'=>$target);
		}

		// Load has_one relationships
		foreach($model->has_one as $alias=>$target)
		{
			if(!is_string($alias))
				$alias = $target;

			$cols[$alias.'_id']['link'] = array('alias'=>$alias, 'model'=>$target);
		}

		$column = array();
		foreach($cols as $name=>&$info)
		{
			// Load config information for this column
			$cnf = Kohana::config('scaffold.models.'.$model_name.'.'.$name);

			// Column names that are set to 'date' or end in '_date' should by
			// default be treated as UNIX timestamp dates
			if(($name == 'date') || (substr($name, -5) == '_date'))
			{
				if(!isset($cnf['type']))
					$cnf['type'] = 'date';
				if(!isset($cnf['display']))
					$cnf['display'] = 'date';
			}

			// Password column displayed as password by default
			if($name == 'password')
			{
				if(!isset($cnf['type']))
					$cnf['type'] = 'password';
				if(!isset($cnf['display']))
					$cnf['display'] = 'password|trim[5]';
			}

			// URL column displayed as url by default
			if(($name == 'url') || (substr($name, -4) == '_url'))
			{
				if(!isset($cnf['display']))
					$cnf['display'] = 'url';
			}

			// Set label, display, and style info
			$column['label'] = isset($cnf['label']) ? $cnf['label'] : $name;
			$column['display'] = isset($cnf['display']) ? $cnf['display'] : Kohana::config('scaffold.display');
			$column['style'] = isset($cnf['style']) ? $cnf['style'] : '';

			// This column links to another table (has_one or belongs_to)
			if(isset($info['link']))
			{
				$link = ORM::factory($info['link']['model']);

				// Load linked table's primary key and value
				$column['primary_key'] = $link->primary_key;
				$column['primary_val'] = $link->primary_val;
			}
			// Ordinary column
			else
			{
				// Type set by config
				if(isset($cnf['type']))
				{
					$column['type'] = $cnf['type'];

					// If it's a dropdown, we need the list data
					if($cnf['type'] == 'dropdown')
						$column['data'] = $cnf['data'];
				}
				// Determine type from column info
				else
				{
					switch($info['type'])
					{
						case 'string':
							$column['type'] = isset($info['length']) ? 'textbox' : 'textarea';
							break;
						default:
							$column['type'] = 'textbox';
							break;
					}
				}
			}

			// Set column info
			$info['column'] = $column;
		}

		return $cols;
	}

	/**
	 * Scan models from models folder
	 *
	 * @return void
	 */
	private function scan_models()
	{
		$files = Kohana::list_files('models');

		foreach($files as $file)
		{
			preg_match('/.*\/(.*)'.EXT.'/', $file, $match);
			$this->model_names[] = $match[1];
		}
	}
}