<?php
/**
 * Tipo_Model class.
 * 
 * @extends ORM
 *
 * Datos de tipo de extra
 * Tabla auxiliar para loslabels de los datos Extras
 * 
 */
class Tipo_Model extends ORM {
	//protected $belongs_to = array('extras');
	protected $sorting = array('orden' => 'ASC','label' => 'asc');

	// Table primary key and value
	protected $primary_val = 'label';

}