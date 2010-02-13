<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-09-05 02:18:16 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dato:fechamodificado' in 'order clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 2
ORDER BY `dato:fechamodificado` DESC, `dato:nombre` ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-05 02:18:38 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos:fechamodificado' in 'order clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 2
ORDER BY `datos:fechamodificado` DESC, `datos:nombre` ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-05 02:19:46 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos:fechaModificado' in 'order clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `categoria_id` = 2
ORDER BY `datos:fechaModificado` DESC, `datos:nombre` ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
