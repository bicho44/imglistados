<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-10-14 02:06:02 -03:00 --- error: Uncaught PHP Error: Undefined property:  ORM_Iterator::$dato in file application/controllers/listados.php on line 197
2009-10-14 02:06:52 -03:00 --- error: Uncaught PHP Error: Undefined property:  ORM_Iterator::$datos in file application/controllers/listados.php on line 197
2009-10-14 02:07:58 -03:00 --- error: Uncaught Kohana_Exception: Query methods cannot be used through ORM in file system/libraries/ORM.php on line 200
2009-10-14 02:08:21 -03:00 --- error: Uncaught PHP Error: Undefined property:  ORM_Iterator::$nombre in file application/controllers/listados.php on line 201
2009-10-14 02:13:08 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '0'
AND `rubro_id` = 24
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:14:12 -03:00 --- error: Uncaught Kohana_Exception: Invalid method width called in Dato_Model in file system/libraries/ORM.php on line 257
2009-10-14 02:16:25 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '0'
AND `rubro_id` = 24
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:17:02 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '2'
AND `rubro_id` = 24
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:18:31 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '2'
AND `rubro_id` = 24
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:25:38 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `rubro_id` = 24
AND `categoria_id` = '1'
AND `localidad_id` = '2'
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:27:55 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos_rubro:rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `datos_rubro:rubro_id` = 24
AND `categoria_id` = '1'
AND `localidad_id` = '2'
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:28:51 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos_rubro:rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `datos_rubro:rubro_id` = 24
AND `categoria_id` = '1'
AND `localidad_id` = '2'
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:34:09 -03:00 --- error: Uncaught Kohana_Exception: Invalid method count called in Dato_Model in file system/libraries/ORM.php on line 257
2009-10-14 02:35:33 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos_rubro.rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '2'
AND `datos_rubro`.`rubro_id` = 24
ORDER BY `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:36:40 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'categoria_id' in 'where clause' - SELECT `rubros`.*
FROM (`rubros`)
JOIN `datos_rubro` ON (`datos_rubro`.`rubro_id` = `rubros`.`id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '2'
AND `datos_rubro`.`dato_id` = 0
ORDER BY `rubros`.`nombre` ASC, `rubros`.`parent_id` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:37:48 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'categoria_id' in 'where clause' - SELECT `rubros`.*
FROM (`rubros`)
JOIN `datos_rubro` ON (`datos_rubro`.`rubro_id` = `rubros`.`id`)
WHERE `categoria_id` = '1'
AND `localidad_id` = '2'
AND `datos_rubro`.`dato_id` = 0
ORDER BY `rubros`.`nombre` ASC, `rubros`.`parent_id` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-14 02:38:03 -03:00 --- error: Uncaught Kohana_Exception: The rubro property does not exist in the Dato_Model class. in file system/libraries/ORM.php on line 364
