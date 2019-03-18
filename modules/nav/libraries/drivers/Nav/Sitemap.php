<?php

/**
 * The Site Item Driver class demonstrates rendering a basic sitemap
 *
 * @author			Dave Stewart
 * @date			18th October 2009
 * @version			1.0
 * @kohana-version	2.x
 */

require_once (dirname(__FILE__) . '/' . 'Core.php');

class Nav_Sitemap_Item_Driver extends Nav_Core_Item_Driver 
{
	
	// ------------------------------------------------------------------------------------------------
	// VARIABLES
	// ------------------------------------------------------------------------------------------------

		protected $tag = '';
	
	// ------------------------------------------------------------------------------------------------
	// INITIALIZATION
	// ------------------------------------------------------------------------------------------------

		/**
		 * Creates all the properties for the class to create flexible elements
		 */
		public function __construct($uri, $text, $children, $properties)
		{
			parent::__construct($uri, $text, $children, $properties);
			$this->tag = $children != NULL ? 'h' . ($this->depth + 1) : 'p';
		}
		
	// ------------------------------------------------------------------------------------------------
	// CORE METHODS
	// ------------------------------------------------------------------------------------------------

		/**
		 * Opens an individual item and returns a <li>
		 */
		public function open()
		{
			return '';
		}
		
		/**
		 * Processes the content of an item and returns a <a>
		 */
		public function process()
		{
			return '<' . $this->tag . '><a href="' .$this->uri. '">' .$this->text. '</a></' . $this->tag . '>';
		}
		
		/**
		 * Closes an individual item and returns a </li>
		 */
		public function close()
		{
			return '';
		}
		
		/**
		 * Opens a group of child items and returns a <ul>
		 */
		public function open_children($attributes = NULL)
		{
			return $attributes != NULL ? '<blockquote ' .$attributes. '>' : '<blockquote>';
		}
		
		/**
		 * Closes a group of child items and returns a </ul>
		 */
		public function close_children()
		{
			return '</blockquote>';
		}
		
}

?>
