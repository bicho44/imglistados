<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-06-29 13:42:11 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'lower(nombre)' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE  `lower(nombre)` LIKE '%aidar%'
OR  `lower(calle)` LIKE '%aidar%'
ORDER BY `datos`.`nombre` ASC, `datos`.`fechamodificado` ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
