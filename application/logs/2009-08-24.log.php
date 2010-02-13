<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-08-24 15:35:38 -03:00 --- error: Uncaught ReflectionException: Method 1 does not exist in file system/core/Kohana.php on line 257
2009-08-24 15:35:59 -03:00 --- error: Uncaught ReflectionException: Method 1 does not exist in file system/core/Kohana.php on line 257
2009-08-24 15:36:46 -03:00 --- error: Uncaught ReflectionException: Method categoria does not exist in file system/core/Kohana.php on line 257
2009-08-24 16:23:30 -03:00 --- error: Uncaught PHP Error: Undefined property:  Datos_Controller::$categorias in file application/controllers/datos.php on line 118
2009-08-24 16:23:57 -03:00 --- error: Uncaught PHP Error: Undefined property:  Datos_Controller::$categorias in file application/controllers/datos.php on line 118
2009-08-24 16:32:48 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'AND categoria_id' in 'where clause' - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `AND categoria_id` = 1
OR  `nombre` LIKE '%puelo%'
OR  `calle` LIKE '%puelo%'
OR  `localidad_nombre` LIKE '%puelo%'
ORDER BY `datos`.`fechamodificado` ASC, `datos`.`nombre` ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-08-24 17:36:53 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:37:17 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:37:20 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:37:28 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:39:59 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:40:18 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
2009-08-24 17:40:20 -03:00 --- error: Uncaught PHP Error: Illegal offset type in isset or empty in file system/libraries/ORM.php on line 479
