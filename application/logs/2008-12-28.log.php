<?php defined('SYSPATH') or die('No direct script access.'); ?>

2008-12-28 00:05:14 -03:00 --- debug: Disable magic_quotes_gpc! It is evil and deprecated: http://php.net/magic_quotes
2008-12-28 00:05:14 -03:00 --- debug: Global GET, POST and COOKIE data sanitized
2008-12-28 00:05:14 -03:00 --- debug: MySQL Database Driver Initialized
2008-12-28 00:05:14 -03:00 --- debug: Database Library initialized
2008-12-28 00:26:54 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'tratodirecto.20' doesn't exist - SELECT `u`.`order_id`, `u`.`name`, `u`.`name2`, `u`.`start_date`, `u`.`end_date`, `u`.`adultos`, `u`.`menores`, `u`.`estado`
FROM `db_cart_shipment` AS `u`, `20`
WHERE u.email!=""
ORDER BY `u`.`estado` ASC, `u`.`order_id` DESC in file system/libraries/drivers/Database/Mysql.php on line 367
2008-12-28 01:00:01 -03:00 --- error: Uncaught PHP Error: Attempt to assign property of non-object in file application/controllers/consultas.php on line 5
2008-12-28 01:01:04 -03:00 --- error: Uncaught PHP Error: Missing argument 1 for Consultas_Controller::view() in file application/controllers/consultas.php on line 14
2008-12-28 16:46:39 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, modules/auth/views/auth/install.php, could not be found. in file system/core/Kohana.php on line 787
2008-12-28 16:47:53 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, auth/install.php, could not be found. in file system/core/Kohana.php on line 787
