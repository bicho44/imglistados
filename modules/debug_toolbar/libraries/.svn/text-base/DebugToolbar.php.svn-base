<?php defined('SYSPATH') or die('No direct script access.');

class DebugToolbar_Core {

	// system.log events
	public static $logs = array();
	
	public static $benchmark_name = 'debug_toolbar';
	
	// show the toolbar
	public static function render($print = false) 
	{
		Benchmark::start(self::$benchmark_name);
		
		$template = new View('toolbar');
		
		if (Kohana::config('debug_toolbar.panels.database'))
			$template->set('queries', self::queries());
			
		if (Kohana::config('debug_toolbar.panels.logs'))
			$template->set('logs', self::logs());
			
		if (Kohana::config('debug_toolbar.panels.vars_and_config'))
			$template->set('configs', self::configs());
		
		if (Kohana::config('debug_toolbar.panels.files'))
			$template->set('files', self::files());
		
		if (Kohana::config('debug_toolbar.firephp_enabled'))
			self::firephp();
		
		switch (Kohana::config('debug_toolbar.align'))
		{
			case 'right':
			case 'center':
			case 'left':
				$template->set('align', Kohana::config('debug_toolbar.align'));
				break;
			default:
				$template->set('align', 'left');				
		}
		
		$template->set('scripts', file_get_contents(Kohana::find_file('views', 'toolbar', true, 'js')));
		
		Benchmark::stop(self::$benchmark_name);
		
		if (Kohana::config('debug_toolbar.panels.benchmarks'))
			$template->set('benchmarks', self::benchmarks());
		
		if (Event::$data)
		{
			if (Kohana::config('debug_toolbar.auto_render') or
					(Kohana::config('debug_toolbar.secret_key') !== FALSE and 
						isset($_GET[Kohana::config('debug_toolbar.secret_key')])))
			{
				// try to add css to <head>, otherwise, send to template
				$styles = file_get_contents(Kohana::find_file('views', 'toolbar', false, 'css'));
				if (stripos(Event::$data, '</head>') !== FALSE)
					Event::$data = str_ireplace('</head>', $styles.'</head>', Event::$data);
				else
					$template->set('styles', $styles);
				
				// try to add js and HTML just before the </body> tag,
				// otherwise just append it to the output
				if (stripos(Event::$data, '</body>') !== FALSE)
					Event::$data = str_ireplace('</body>', $template->render().'</body>', Event::$data);
				else
					Event::$data .= $template->render();
			}
		}
		else
		{
			if ($print)
				$template->render(TRUE);
			else
				return $template->render();
		}
	}
	
	/*
	 * Hooks the system.log event to catch 
	 * all log messages and save to 
	 * self::$logs;
	 */
	public static function log() 
	{
		self::$logs[] = Event::$data;
	}
	
	public static function logs()
	{
		return self::$logs;
	}
	
	public static function queries()
	{
		return Database::$benchmarks;
	}
	
	public static function benchmarks()
	{
		$benchmarks = array();
		foreach (Benchmark::get(true) as $name => $benchmark)
		{
			$benchmarks[$name] = array(
				'name'   => ucwords(str_replace(array('_', '-'), ' ', str_replace(SYSTEM_BENCHMARK.'_', '', $name))),
				'time'   => $benchmark['time'],
				'memory' => $benchmark['memory']
			);
		}
		$benchmarks = array_slice($benchmarks, 1) + array_slice($benchmarks, 0, 1);
		return $benchmarks;
	}
	
	/*
	 * Add toolbar data to FirePHP console
	 */
	private static function firephp()
	{
		$firephp = FirePHP::getInstance(true);
		
		$firephp->fb('KOHANA DEBUG TOOLBAR:');
		
		// globals
		
		$globals = array(
			'Post'    => empty($_POST)    ? array() : $_POST,
			'Get'     => empty($_GET)     ? array() : $_GET,
			'Cookie'  => empty($_COOKIE)  ? array() : $_COOKIE,
			'Session' => empty($_SESSION) ? array() : $_SESSION
		);
		
		foreach ($globals as $name => $global)
		{
			$table = array();
			$table[] = array($name,'Value');
			
			foreach($global as $key => $value)
			{
				if (is_object($value))
					$value = get_class($value).' [object]';
					
				$table[] = array($key, $value);
			}
			
			$firephp->fb(
				array(
					"$name: ".count($global).' variables',
					$table
				),
				FirePHP::TABLE
			);
		}
		
		// database
		
		$queries = self::queries();
		
		$total_time = $total_rows = 0;
		$table = array();
		$table[] = array('SQL Statement','Time','Rows');
		
		foreach ($queries as $query)
		{
			$table[] = array(
				str_replace("\n",' ',$query['query']), 
				number_format($query['time'], 3), 
				$query['rows']
			);
			
			$total_time += $query['time'];
			$total_rows += $query['rows'];
		}
		
		$firephp->fb(
			array(
				'Queries: ' . count($queries).' SQL queries took '.number_format($total_time,3).' seconds and returned '.$total_rows.' rows',
				$table
			),
			FirePHP::TABLE
		);
		
		// benchmarks
		
		$benchmarks = self::benchmarks();
		
		$table = array();
		$table[] = array('Benchmark','Time','Memory');
		
		foreach ($benchmarks as $name => $benchmark)
		{
			// Clean unique id from system benchmark names
			$name = ucwords(str_replace(array('_', '-'), ' ', str_replace(SYSTEM_BENCHMARK.'_', '', $name)));
			
			$table[] = array(
				$name, 
				number_format($benchmark['time'], 3), 
				number_format($benchmark['memory'] / 1024 / 1024, 2).'MB'
			);
		}
		
		$firephp->fb(
			array(
				'Benchmarks: ' . count($benchmarks).' benchmarks took '.number_format($benchmark['time'], 3).' seconds and used up '. number_format($benchmark['memory'] / 1024 / 1024, 2).'MB'.' memory',
				$table
			),
			FirePHP::TABLE
		); 
	}
	
	/*
	 * Get config data
	 */
	private static function configs() 
	{	
		if (Kohana::config('debug_toolbar.skip_configs') === TRUE)
			return array();
		
		$inc_paths = Kohana::include_paths();
		$configs = array();
		foreach ($inc_paths as $inc_path)
		{
			foreach (glob($inc_path.'/config/*.php') as $filename) 
			{
				$filename = pathinfo($filename, PATHINFO_FILENAME);
				if (in_array($filename, (array)Kohana::config('debug_toolbar.skip_configs')))
					continue;
				
				if (!isset($configs[$filename]))
					$configs[$filename] = Kohana::Config($filename);
			}
		}
		return $configs;
	}
	
	/*
	 * Get list of included files
	 */
	public static function files()
	{
		return get_included_files();
	}

	
	// return a filename without extension
	private static function _strip_ext($filename)
	{
		if (($pos = strrpos($filename, '.')) !== false)
		{
			return substr($filename, 0, $pos);
		}
		else
		{
			return $filename;
		}
	}

}