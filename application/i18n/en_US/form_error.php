<?php defined('SYSPATH') or die('No direct script access.');
$lang = array
(
'nombre' => Array
(
'required' => 'Por favor debe haber un nombre.',
'length' => 'El nombre debe tener entre 3 y 50 caracteres.',
'default' => 'Nombre inválido.',
),
'calle' => Array
(
'required' => 'Por favor debe haber una calle.',
'length' => 'La calle debe tener entre 3 y 50 caracteres.',
'default' => 'Calle inválida.',
),
'nro' => Array
(
'required' => 'Por favor debe haber un nro.',
'default' => 'Nro Inválido',
),
'cod_postal' => Array
(
'required' => 'Por favor debe haber un codigo postal.',
'length' => 'El Código Postal debe tener entre 4 y 8 caracteres.',
'default' => 'Codigo Postal inválido.',
),
  'localidad_id'=>Array(
    'required'=>'Debe seleccionar una ciudad',
    'numeric'=>'No puede ser Todas las ciudades',
    'nogeneric'=>'El dato no puede estar en Todas las ciudades, ¿no?',
    'default' => 'Codigo de Ciudad inválido.',
),
    'categoria_id'=>Array(
    'required'=>'Debe seleccionar una Categoria',
    'numeric'=>'Seleccione una Categoria',
    'nogeneric'=>'El dato no puede estar en Todas las Categorias, ¿no?',
    'default' => 'Codigo de Categoria inválido.',
),
);
