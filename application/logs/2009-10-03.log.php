<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-10-03 02:01:34 -03:00 --- error: Uncaught PHP Error: Object of class ORM_Iterator could not be converted to string in file system/libraries/drivers/Database.php on line 324
2009-10-03 02:05:12 -03:00 --- error: Uncaught Kohana_Exception: The count property does not exist in the Dato_Model class. in file system/libraries/ORM.php on line 364
2009-10-03 02:05:38 -03:00 --- error: Uncaught Kohana_Exception: Invalid method count called in Dato_Model in file system/libraries/ORM.php on line 257
2009-10-03 02:06:15 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 1
AND `localidad_id` = 2
AND `rubro_id` = 124
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-03 02:14:26 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 1
AND `localidad_id` = 2
AND `rubro_id` = 124
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-03 02:17:43 -03:00 --- error: Uncaught PHP Error: Missing argument 2 for Database_Core::join(), called in /Users/bicho44/Sites/tdf/system/libraries/ORM.php on line 235 and defined in file system/libraries/Database.php on line 403
2009-10-03 02:21:44 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 1
AND `localidad_id` = 2
AND `rubro_id` = 124
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-03 02:37:32 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos_rubro:rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 1
AND `localidad_id` = 2
AND `datos_rubro:rubro_id` = 124
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-03 02:39:23 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `rubro_id` = 124
AND `categoria_id` = 1
AND `localidad_id` = 2
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-10-03 02:40:51 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'rubros:rubro_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `rubros:rubro_id` = 124
AND `categoria_id` = 1
AND `localidad_id` = 2
ORDER BY `nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
