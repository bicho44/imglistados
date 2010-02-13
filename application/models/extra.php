<?php
/**
 * Extra_Model class.
 * 
 * @extends ORM
 */
class Extra_Model extends ORM {

	protected $belongs_to = array('dato'=>'dato_id');
	protected $has_one = array('tipo');

	// Array of foreign key name overloads
	protected $foreign_key = array('tipo_id'=>'id');

	// Relationships that should always be joined
	protected $load_with = array('tipo');
        protected $sorting = array('tipo_id' => 'ASC');
}