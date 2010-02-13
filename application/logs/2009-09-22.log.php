<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-09-22 00:38:15 -03:00 --- error: Uncaught PHP Error: Undefined index:  orden in file application/controllers/datos.php on line 46
2009-09-22 01:00:49 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC' at line 8 - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `localidad_id` != 0
AND ( `nombre` LIKE '%gui%'
OR  `calle` LIKE '%gui%'
OR  `localidad_nombre` LIKE '%gui%')
ORDER BY  ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-22 01:01:43 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC' at line 8 - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `localidad_id` != 0
AND ( `nombre` LIKE '%gui%'
OR  `calle` LIKE '%gui%'
OR  `localidad_nombre` LIKE '%gui%')
ORDER BY  ASC in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-22 01:04:16 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC
LIMIT 0, 25' at line 5 - SELECT `datos`.*, `localidad`.`id` AS `localidad:id`, `localidad`.`localidad_nombre` AS `localidad:localidad_nombre`, `localidad`.`abreviatura` AS `localidad:abreviatura`, `localidad`.`provincia_id` AS `localidad:provincia_id`, `localidad`.`cod_postal` AS `localidad:cod_postal`
FROM (`datos`)
LEFT JOIN `localidades` AS `localidad` ON (`localidad`.`id` = `datos`.`localidad_id`)
WHERE `localidad_id` != 0
ORDER BY  ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-22 10:27:37 -03:00 --- error: Uncaught PHP Error: Undefined index:  request in file application/controllers/datos.php on line 518
2009-09-22 17:48:11 -03:00 --- error: Uncaught PHP Error: Undefined index:  request in file application/controllers/datos.php on line 518
2009-09-22 20:11:21 -03:00 --- error: Uncaught PHP Error: date() expects at least 1 parameter, 0 given in file application/controllers/datos.php on line 661
2009-09-22 20:16:55 -03:00 --- error: Uncaught Kohana_Exception: The fechamodificado property does not exist in the Dato_Model class. in file system/libraries/ORM.php on line 416
2009-09-22 20:18:39 -03:00 --- error: Uncaught Kohana_Exception: The fechamodificado property does not exist in the Dato_Model class. in file system/libraries/ORM.php on line 416
2009-09-22 20:20:59 -03:00 --- error: Uncaught Kohana_Exception: The fechamodificado property does not exist in the Dato_Model class. in file system/libraries/ORM.php on line 416
2009-09-22 21:32:07 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC
LIMIT 0, 25' at line 4 - SELECT `rubros`.*
FROM (`rubros`)
WHERE `parent_id` = 0
ORDER BY  ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
2009-09-22 21:33:30 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ASC
LIMIT 0, 25' at line 4 - SELECT `rubros`.*
FROM (`rubros`)
WHERE `parent_id` = 0
ORDER BY  ASC
LIMIT 0, 25 in file system/libraries/drivers/Database/Mysql.php on line 371
