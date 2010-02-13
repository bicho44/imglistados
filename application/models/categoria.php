<?php
/**
 * Categoria_Model class.
 *
 * @extends ORM
 */
class Categoria_Model extends ORM {
    protected $has_many = array('dato');
    protected $primary_val = 'catname';

}
