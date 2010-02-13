<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-05-19 03:05:14 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'guia.rubro' doesn't exist - SELECT * FROM datos_rubro as d, rubro as r WHERE d.rubro_id = r.rubro.id AND datos_rubro.dato_id = 24 in file system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 03:05:41 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'r.rubro.id' in 'where clause' - SELECT * FROM datos_rubro as d, rubros as r WHERE d.rubro_id = r.rubro.id AND datos_rubro.dato_id = 24 in file system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 03:05:57 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'datos_rubro.dato_id' in 'where clause' - SELECT * FROM datos_rubro as d, rubros as r WHERE d.rubro_id = r.id AND datos_rubro.dato_id = 24 in file system/libraries/drivers/Database/Mysql.php on line 392
