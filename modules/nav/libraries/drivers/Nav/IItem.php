<?php

interface INav_Item_Driver
{
	public function __construct($uri, $text, $children, $properties);
	public function open();
	public function process();
	public function close();
	public function open_children($attributes = NULL);
	public function close_children();
}

?>