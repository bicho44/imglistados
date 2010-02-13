<?php defined('SYSPATH') or die('No direct script access.'); ?>

2008-12-27 15:53:09 -03:00 --- error: Uncaught PHP Error: mysql_connect() [<a href='function.mysql-connect'>function.mysql-connect</a>]: Access denied for user 'tratodirecto'@'localhost' (using password: YES) in file system/libraries/drivers/Database/Mysql.php on line 61
2008-12-27 15:58:01 -03:00 --- error: Uncaught PHP Error: mysql_connect() [<a href='function.mysql-connect'>function.mysql-connect</a>]: Access denied for user 'tratodirecto'@'localhost' (using password: YES) in file system/libraries/drivers/Database/Mysql.php on line 61
2008-12-27 16:03:53 -03:00 --- error: Uncaught PHP Error: mysql_connect() [<a href='function.mysql-connect'>function.mysql-connect</a>]: Access denied for user 'root'@'localhost' (using password: NO) in file system/libraries/drivers/Database/Mysql.php on line 61
2008-12-27 16:04:12 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'tratodirecto.reservas' doesn't exist - SELECT `r`.`reserva_id`, `r`.`propiedad_id`, `r`.`confirmada`, `r`.`apellido`, `r`.`nombre`, `r`.`email`, `r`.`fecha_entrada`, `r`.`fecha_salida`, `r`.`importe_total`, `r`.`transfer`
FROM `reservas` AS `r`
WHERE 0 = 'r.fecha_entrada==\"$entrada\"'
AND `1` = 'r.fecha_entrada==\"$salida\"'
ORDER BY `r`.`reserva_id` DESC, `r`.`apellido` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-27 16:06:35 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'tratodirecto.reservas' doesn't exist - SELECT `r`.`reserva_id`, `r`.`propiedad_id`, `r`.`confirmada`, `r`.`apellido`, `r`.`nombre`, `r`.`email`, `r`.`fecha_entrada`, `r`.`fecha_salida`, `r`.`importe_total`, `r`.`transfer`
FROM `reservas` AS `r`
WHERE 0 = 'r.fecha_entrada==\"$entrada\"'
AND `1` = 'r.fecha_entrada==\"$salida\"'
ORDER BY `r`.`reserva_id` DESC, `r`.`apellido` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-27 16:54:30 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column '1' in 'where clause' - SELECT `r`.`reserva_id`, `r`.`propiedad_id`, `r`.`confirmada`, `r`.`apellido`, `r`.`nombre`, `r`.`email`, `r`.`fecha_entrada`, `r`.`fecha_salida`, `r`.`importe_total`, `r`.`transfer`
FROM `reservas` AS `r`
WHERE 0 = 'r.fecha_entrada==\"$entrada\"'
AND `1` = 'r.fecha_entrada==\"$salida\"'
ORDER BY `r`.`reserva_id` DESC, `r`.`apellido` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-27 16:56:31 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column '1' in 'where clause' - SELECT `r`.`reserva_id`, `r`.`propiedad_id`, `r`.`confirmada`, `r`.`apellido`, `r`.`nombre`, `r`.`email`, `r`.`fecha_entrada`, `r`.`fecha_salida`, `r`.`importe_total`, `r`.`transfer`
FROM `reservas` AS `r`
WHERE 0 = 'r.fecha_entrada==\"$entrada\"'
AND `1` = 'r.fecha_entrada==\"$salida\"'
ORDER BY `r`.`reserva_id` DESC, `r`.`apellido` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-27 16:58:00 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column '1' in 'where clause' - SELECT `r`.`reserva_id`, `r`.`propiedad_id`, `r`.`confirmada`, `r`.`apellido`, `r`.`nombre`, `r`.`email`, `r`.`fecha_entrada`, `r`.`fecha_salida`, `r`.`importe_total`, `r`.`transfer`
FROM `reservas` AS `r`
WHERE 0 = 'r.fecha_entrada==\"$entrada\"'
AND `1` = 'r.fecha_entrada==\"$salida\"'
ORDER BY `r`.`reserva_id` DESC, `r`.`apellido` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-27 16:59:18 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, consultar, could not be found. in file system/core/Kohana.php on line 787
2008-12-27 17:54:32 -03:00 --- error: Uncaught Kohana_Exception: Invalid method findall called in Consulta_Model in file system/libraries/ORM.php on line 246
