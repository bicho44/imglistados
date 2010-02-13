<?php
/**
 * Localidad_Model class.
 * 
 * @extends ORM
 */
class Localidad_Model extends ORM {
	protected $table_name = 'localidades';
	protected $table_names_plural = FALSE;
	protected $belongs_to = array('provincias');
	
	protected $primary_val = 'localidad_nombre';

}