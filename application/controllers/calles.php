<?php defined('SYSPATH') or die('No direct script access.');

/*
	Rubros Controller
	---------------------

	@file 		rubros.php
	@version 	1.0.0b
	@date 		2009-01-26 13:21:16 -0300 (Mon, 26 Jan 2009)
	@author 	Federico Reinoso <admin@imgdigital.com.ar>

	Copyright (c) 2009 IMG Digital <http://imgdigital.com.ar>

	Controlador para mostrar las propiedades

*/


class Calles_Controller extends Website_Controller {

    public function __construct() {

	parent::__construct();

	if (Simple_Auth::instance()->logged_in(NULL))
	$this->user = Simple_Auth::instance()->get_user();
    }
/**
	 * index function.
	 *
	 * @access public
	 * @return void
	 */
    public function index() {
	// No page number supplied, so def
	url::redirect('calles/page/1');
    }


/**
	 * index function.
	 *
	 * @access public
	 * @return void
	 */
    public function page($pagenum) {

	$this->template->title = 'Administracion :: Calles';
	$this->template->data = new View('pages/calles');
	$this->template->data->title = 'Listado de Calles';

	$datos = ORM::factory('calle');
	//// Instantiate Pagination, passing it the total number of product rows.
	$paging = new Pagination(array
	    (
				'total_items' => $datos->count_all(),
	    ));
	//// render the page links
	$this->template->data->pagination = $paging->render();
	// Display X items per page, from offset = page number
	$this->template->data->rubros = $datos->find_all($paging->items_per_page, $paging->sql_offset);
    }


}
