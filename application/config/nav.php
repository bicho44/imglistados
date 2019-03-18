<?php

// --------------------------------------------------------------------------------------------
// class configuration
// --------------------------------------------------------------------------------------------

$config['settings'] = array
    (
    // defaults
    'default_config_key' => 'site_domain', // default menu config to load if one is not specified in each method's argument
    'item_driver_name' => 'Menu', // the current driver for item class
    'uri_prefix' => '/imglistados/', // uri prefix for all links, such as '/' or your site domain
    // defaults
    'default_id' => 'menu', // default id to apply to the Nav instance upon instantiation
    'default_class' => 'nav', // default class to apply to the Nav instance upon instantiation
    'default_attributes' => '', // default attributes to apply to the Nav instance upon instantiation
    // html
    'default_indent' => "\t", // default initial indent for all markup
    'html_prefix' => '', // any html to add before the menu renders
    'html_suffix' => '', // append a clearing div
);


$config['sitemap-settings'] = array
    (
    'default_config_key' => 'site_domain', // default menu config to load if one is not specified in each method's argument
    'item_driver_name' => 'Sitemap', // the current driver for item class
    'default_id' => 'sitemap', // default id to apply to the Nav instance upon instantiation
    'default_class' => '', // default class to apply to the Nav instance upon instantiation
);


// --------------------------------------------------------------------------------------------
// menu configuration
// --------------------------------------------------------------------------------------------

/*

  Items are defined with 2 or optionally 3 elements:

  1. <string> the segment (controller/method/argument name)
  2. <string> The item text
  3. <array>  Any child items

  array( segment, title, [ children ] )

  Children are simply arrays of more Items.

  Note how Items are ALWAYS nested in the order of children > item, children > item.
  Bear this in mind when adding new levels manually!

  Follow the arrows below using your eye to see how arrays always line up with other arrays
  and how segment names always line up with other segment names, for example, red, blue, red, blue

  root (no properties)
  |	children
  |	.
  |	.	item / properties
  |	.	|	children
  |	.	|	.
  |	.	|	.	item / properties
  |	.	|	.	|	children
  |	.	|	.	|	.
  V	V	V	V	V	V

 */


$config['site_domain'] = array
    (
    array("about", "Inicio"),
    array
        (
        "datos", "Datos", array
            (
            array("add", "Agregar dato"),
            array
                (
                "", "Ordenar", array
                    (
                    array(url::base().url::current()."?orden=fechamodificado", "Fecha Modificado"),
                    array(url::base().url::current()."?orden=nombre", "Nombre"),
                    array(url::base().url::current()."?orden=calle", "Dirección"),
                )
            )
        )
    ),
    array(
        "rubros", "Rubros", array(
            array("edit", "Agregar Rubro")
        )
    ),
    array(
        "listados", "Exportar Listados"
    )
);
?>