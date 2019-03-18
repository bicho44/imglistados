<?php

class Nav_Controller extends Controller
{

	const ALLOW_PRODUCTION = FALSE;
		
	// -------------------------------------------------------------------------------------
	// variables
	// -------------------------------------------------------------------------------------
	
		protected $config		= '';
		protected $indent		= '';
		protected $folder		= '';
		
	// -------------------------------------------------------------------------------------
	// initialize
	// -------------------------------------------------------------------------------------
	
		public function setup($save = FALSE)
		{
			// setup
				$this->indent = $save == TRUE ? "	" : '';
				$this->initialize();
				
			// save
				if($save == TRUE)
				{
					// get the default config
						$config = file_get_contents(MODPATH . 'nav/config/nav.php');
						
					// replace the existing site config
						$config = preg_replace('%\t\$config\[\'site\'\].+%si', $this->config . '?>', $config);
					
					//download
						download::force('nav.php', $config);
				}
				
			// echo
				else
				{
					$view = new View('nav-setup',array('config' => $this->config));
					$view->render(TRUE);
				}
		}
		
	// -------------------------------------------------------------------------------------
	// get properties
	// -------------------------------------------------------------------------------------
	
		protected function initialize()
		{
			$this->add('$config[\'site\'] = array');
			$this->add('(');
			$this->indent(1);
			$this->process(APPPATH. 'controllers');
			$this->indent(-1);
			$this->add(");\n\n");
		}
	
		protected function process($path)
		{
			// get objects
				$objects = $this->get_folder($path);
			
			// loop through controllers
				foreach($objects->files as $file)
				{
					$controller = $this->get_controller($file);
					
					if($controller->content != NULL)
					{
						$methods = $this->get_methods($controller);
						if($methods != NULL)
						{
							$this->open_group($controller->name, $controller->comment);
							foreach($methods as $method)
							{
								$this->process_item($method->name, $method->comment);
							}
							$this->close_group();
						}
					}
					
				}
				
			// loop through folders
				foreach($objects->folders as $folder)
				{
					$name	= basename($folder);
					$text	= $this->humanize($name);
					$this->open_group($name, $text);
					$this->process($folder);
					$this->close_group();
				}
		}
	
	
		protected function get_folder($path)
		{
			// variables
				$path			= rtrim($path, '/') . '/';
				$pointers		= array_diff(scandir($path), array('.', '..') );
				$obj->files		= array();
				$obj->folders	= array();
				
			// get contents
				foreach($pointers as $pointer)
				{
					$pointer = $path . $pointer;
					if(is_dir($pointer))
					{
						array_push($obj->folders, $pointer . '/');
					}
					else
					{
						if(substr($pointer, -3) == 'php')
						{
							array_push($obj->files, $pointer);
						}
					}
				}
			
			// return
				return $obj;
		}
		
		protected function get_controller($file)
		{
			// variables
				$obj->content	= NULL;
				$contents		= file_get_contents($file);
				
			// matches
				if (preg_match('%(/\*\*.*?\*/)?\s+class (\w+)_Controller extends Controller(.+)%s', $contents, $matches))
				{
					// grab controller
						array_shift($matches);
						$obj->file		= $file;
						$obj->name		= strtolower($matches[1]);
						$obj->content	= $matches[2];
						$obj->comment	= $this->parse_doc_comment($matches[0]);
						if($obj->comment == NULL)
						{
							$obj->comment = $this->humanize($obj->name);
						}
				}
			
			// return
				return $obj;
		}
		
		protected function get_methods($controller)
		{
			// variables
				$methods		= array();

			// grab methods
				if (preg_match_all('%(/\*\*.*?\*/)?\s+(\w+)?\s?function\s+(\w+)\s*\(.*?\)%s', $controller->content, $matches))
				{
					array_shift($matches);
					for($i = 0; $i < count($matches[0]); $i++)
					{
						// grab method
							$obj			= NULL;
							$obj->type		= $matches[1][$i];
							$obj->name		= strtolower($matches[2][$i]);
							$obj->comment	= $this->parse_doc_comment($matches[0][$i]);
							if($obj->comment == NULL)
							{
								$obj->comment = $this->humanize($obj->name);
							}
							
						// add valid methods to array
							if(($obj->type == NULL || $obj->type == 'public') && $obj->name != '_default')
							{
								array_push($methods, $obj);
							}
					}

				}
				
			// return
				return $methods;
		}
				
	// -------------------------------------------------------------------------------------
	// write config
	// -------------------------------------------------------------------------------------
	
		protected function process_item($segment, $text)
		{
			$this->add("array('$segment', '$text'),");
		}
		
		protected function open_group($segment, $text)
		{
			$this->add("array");
			$this->add("(");
			$this->add("	'$segment', '$text', array");
			$this->add("	(");
			$this->indent(2);
		}
		
		protected function close_group()
		{
			$this->indent(-2);
			$this->add("	),");
			$this->add("),\n");
		}
		
	// -------------------------------------------------------------------------------------
	// utilities
	// -------------------------------------------------------------------------------------
	
		protected function add($str)
		{
			$this->config .= $this->indent . $str . "\n";
		}
		
		protected function indent($indent_level)
		{
			if($indent_level > 0)
			{
				$this->indent .= str_repeat("\t", $indent_level);
			}
			else if($indent_level < 0)
			{
				$this->indent = substr($this->indent, - $indent_level);
			}
		}
	
		protected function humanize($str)
		{
			$str = strtolower(str_replace('_', ' ', preg_replace('%([a-z])([A-Z])%', '$1 $2', $str)));
			$str = ucfirst(trim(str_replace('controller', '', $str)));
			return addslashes(htmlentities($str));
		}
		
		public static function parse_doc_comment($comment)
		{
			// grab the entire comment, trimming any faff
				$comment		= trim(preg_replace('%^[\t ]*(/\*\*|\*/|\*[\t ]*)%m', "", $comment));
				
			// strip windows line ends
				$comment		= str_replace("\r\n", "\n", $comment);
				
			// split text into "paragraphs" at double-returns 
				$paragraphs		= preg_split('%(\n){2}%', $comment);
				
			// grab the first line
				$first_line		= preg_replace('%[\r\n]+%', ' ', $paragraphs[0]);
				
			// grab up until first full stop
				$str			= substr($first_line, 0, strpos($first_line, '.'));
				
			// return
				return addslashes(htmlentities(htmlentities($str)));
		}
		

	
}


?>