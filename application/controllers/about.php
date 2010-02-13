<?php defined('SYSPATH') or die('No direct script access.');

/*
	Consultas Controller
	---------------------

	@file 		consultas.php
	@version 	1.0.0b
	@date 		2009-01-26 13:21:16 -0300 (Mon, 26 Jan 2009)
	@author 	Federico Reinoso <admin@imgdigital.com.ar>

	Copyright (c) 2009 IMG Digital <http://imgdigital.com.ar>

	Controlador para mostrar las propiedades

*/


class About_Controller extends Website_Controller {

	/**
	 * index function.
	 *
	 * @access public
	 * @return void
	 */


	public function index() {
		$this->template->title = 'Administracion :: Acerca de IMGListados';
		$this->template->data = new View('pages/about');
	}

}

