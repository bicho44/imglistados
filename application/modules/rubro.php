<?php
/**
 * Rubro_Model class.
 *
 * @extends ORM
 *
 * id  	int(4)
 * parent_id 	int(4)
 * nombre 	varchar(255)
 */
class Rubro_Model extends ORM_Tree {
// Name of the child
    protected $ORM_Tree_children = "rubros";
    // Parent keyword name
    protected $ORM_Tree_parent_key = 'parent_id';

    protected $primary_val = 'nombre';

    protected $sorting = array('nombre'=>'ASC','parent_id' => 'ASC', );

    protected $has_many = array('datos'=>'datos_rubro');

    // Relationships that should always be joined
    protected $load_with = array('datos','rubros'=>'datos_rubro');

}