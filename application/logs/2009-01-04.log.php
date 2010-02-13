<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-01-04 00:04:07 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'db_cart_shipment_order_id' in 'where clause' - SELECT `respuestas`.*
FROM `respuestas`
WHERE `db_cart_shipment_order_id` = 0
ORDER BY `respuestas`.`order_id` ASC in file system/libraries/drivers/Database/Mysql.php on line 367
