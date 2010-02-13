<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-02-27 19:46:49 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, rubros, could not be found. in file system/core/Kohana.php on line 787
2009-02-27 22:02:02 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, admin/login, could not be found. in file system/core/Kohana.php on line 787
2009-02-27 23:58:22 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Cannot add or update a child row: a foreign key constraint fails (`guia/extras`, CONSTRAINT `extras_ibfk_2` FOREIGN KEY (`dato_id`) REFERENCES `datos` (`id`) ON DELETE CASCADE) - INSERT INTO `extras` (`tipo`, `contenido`, `dato_id`) VALUES (6, 'Director', 0) in file system/libraries/drivers/Database/Mysql.php on line 367
