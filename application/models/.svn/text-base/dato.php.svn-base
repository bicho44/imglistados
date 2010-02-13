<?php
/**
 * Dato_Model class.
 *
 * @extends ORM
 *
 id  	int(11)
 nombre 	varchar(255)
 calle 	varchar(255)
 nro 	int(11)
 piso 	int(11)
 depto 	int(11)
 localidad_id int(4)
 categoria_id int()
 *
 */

class Dato_Model extends ORM {
    protected $has_many = array('extras','rubros'=>'datos_rubro');
    protected $has_one = array('localidad');
    protected $belongs_to = array('categoria');

    // Relationships that should always be joined
    protected $load_with = array('datos_rubro', 'localidad');
    
    protected $sorting = array('nombre' => 'ASC');
    protected $primary_val = 'nombre';

    public $formo_ignores = array
    (
    'fechaModificado',
    );
    public $formo_defaults = array
    (
    'destacado' => array
    (
    'type'  => 'bool',
    'label' => 'Destacado'
    )
    );

    public function busqueda ($q=false, $limit=false, $limit2=false) {
       if ($q) {

        $sql = "SELECT `datos`.*, `localidad`.`id` AS `localidad:id`,".
               "`localidad`.`localidad_nombre` AS `localidad:localidad_nombre`,".
               "`localidad`.`abreviatura` AS `localidad:abreviatura`,".
               "`localidad`.`provincia_id` AS `localidad:provincia_id`,".
               "`localidad`.`cod_postal` AS `localidad:cod_postal`".
               "FROM (`datos`) LEFT JOIN `localidades` AS `localidad` ".
               "ON (`localidad`.`id` = `datos`.`localidad_id`) ".
               "WHERE lower(`nombre`) LIKE '%$q%' OR lower(`calle`) LIKE '%$q%' ".
               "ORDER BY `datos`.`nombre` ASC, `datos`.`fechamodificado` ASC ";
       if ($limit) $sql .="LIMIT $limit ";
       if ($limit2) $sql .=", $limit2";
       return $this->db->query($sql);
       } else {
           return false;
       }

    }

}