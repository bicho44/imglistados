<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-01-15 02:30:17 -03:00 --- error: Uncaught ReflectionException: Method view does not exist in file system/core/Kohana.php on line 243
2009-01-15 02:30:23 -03:00 --- error: Uncaught Kohana_404_Exception: The page you requested, propieades/view/853, could not be found. in file system/core/Kohana.php on line 787
2009-01-15 17:36:32 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`, `propiedades`.*
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 18:00:43 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`, `propiedades`.*
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 18:34:25 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `propiedades`.*, `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 18:36:43 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `propiedades`.*, `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 19:29:01 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `propiedades`.*, `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 19:30:38 -03:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'dueno.propiedades_propiedad_id' in 'on clause' - SELECT `propiedades`.*, `dueno`.`propietario_id` AS `dueno:propietario_id`, `dueno`.`nombre` AS `dueno:nombre`, `dueno`.`nombre_completo` AS `dueno:nombre_completo`, `dueno`.`telefono` AS `dueno:telefono`, `dueno`.`dirDue` AS `dueno:dirDue`, `dueno`.`email` AS `dueno:email`, `dueno`.`comDue` AS `dueno:comDue`, `dueno`.`dueno_acta` AS `dueno:dueno_acta`
FROM `propiedades`
LEFT JOIN `duenos` AS `dueno` ON (`dueno`.`propiedades_propiedad_id` = `propiedades`.`propiedad_id`)
WHERE `activa` = 's'
ORDER BY `propiedades`.`propiedad_id` ASC
LIMIT 0, 50 in file system/libraries/drivers/Database/Mysql.php on line 367
2009-01-15 21:49:18 -03:00 --- error: Uncaught ReflectionException: Method view does not exist in file system/core/Kohana.php on line 243
