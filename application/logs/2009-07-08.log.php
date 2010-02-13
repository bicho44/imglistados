<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-07-08 02:42:13 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'localidad_nombre' in 'where clause' - SELECT COUNT(*) AS `records_found`
FROM (`datos`)
WHERE  `nombre` LIKE '%trevelin%'
OR  `calle` LIKE '%trevelin%'
OR  `localidad_nombre` LIKE '%trevelin%' in file system/libraries/drivers/Database/Mysql.php on line 371
2009-07-08 02:44:01 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'localidad:localidad_nombre' in 'where clause' - SELECT COUNT(*) AS `records_found`
FROM (`datos`)
WHERE  `nombre` LIKE '%trevelin%'
OR  `calle` LIKE '%trevelin%'
OR  `localidad:localidad_nombre` LIKE '%trevelin%' in file system/libraries/drivers/Database/Mysql.php on line 371
2009-07-08 02:44:26 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'localidad_nombre' in 'where clause' - SELECT COUNT(*) AS `records_found`
FROM (`datos`)
WHERE  `nombre` LIKE '%trevelin%'
OR  `calle` LIKE '%trevelin%'
OR  `localidad_nombre` LIKE '%trevelin%' in file system/libraries/drivers/Database/Mysql.php on line 371
