<?php defined('SYSPATH') or die('No direct script access.');

/*
 * Disable auto render when IN_PRODUCTION is true
 */
if (!IN_PRODUCTION or 
	(Kohana::config('debug_toolbar.secret_key') !== FALSE and 
		isset($_GET[Kohana::config('debug_toolbar.secret_key')]))) 
{
	/*
	 * Allows the debug toolbar to inject itsself 
	 * into the html
	 */
	Event::add('system.display', array('DebugToolbar', 'render'));
}