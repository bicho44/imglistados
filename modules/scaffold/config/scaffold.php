<?php

/**
 * @package Scaffold
 * @author John Heathco <jheathco@gmail.com>
 * @version 2.3
 *
 * The scaffold module reads models from the classes/model folder
 * and allows for manipulation of these models via ORM.  It supports
 * 'belongs_to', 'has_one', and 'has_many' relationships.  It also
 * supports many-to-many relationships through 'has_many' through
 * aliases.
 */

/**
 * Number of results per page for searches
 */
$config['results_per_page'] = 50;

/**
 * Default display for field output
 */
$config['display'] = 'trim[255]';

/**
 * Default datetime display format
 */
$config['date_format'] = '%m/%d/%Y %H:%M';

/**
 * Use caching (caches models and column information) - not yet used
 */
$config['enable_cache'] = TRUE;

/**
 * These are some example model configuration settings.
 * Format:
 *
 * $config['models'][model_name][column_name] = array(...)
 *
 *  Array values can be:
 * 		label - Field label name
 * 		type - Field input type (textbox, dropdown, textarea, date, password)
 * 		data - Data used if type is dropdown field (array of $keys=>$vals)
 * 		style - Style used for input field
 * 		display - Display format for field (use pipe | for multiple), can be:
 * 			trim[length] - Trims output to specific length
 * 			date[format] - Show as date (format optional)
 * 			password - Hide as *'s
 * 			url - Clickable link
 *
 * - Password fields left blank when editing a row will not save.
 * - Columns named 'date' or ending with '_date' will display as dates by default
 * - Columns named 'url' or ending with '_url' will display as URLs by default
 * - Columns named 'password' are displayed as passwords by default
 */

//$config['rubros']['student']['name'] = array('type'=>'textarea', 'label'=>'Student Name', 'style'=>'height: 400px');
//$config['models']['student']['city_id'] = array('label'=>'City', 'display'=>'trim[30]');
//$config['models']['student']['region'] = array('type'=>'dropdown', 'data'=>array(1=>'Southern', 2=>'Northern));
