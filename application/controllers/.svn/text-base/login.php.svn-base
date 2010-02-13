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


class Login_Controller extends Website_Controller {

	public function __construct() {

		parent::__construct();

		if (Simple_Auth::instance()->logged_in(NULL))
   			$this->user = Simple_Auth::instance()->get_user();
		else url::redirect('login');
	}

	/**
	 * index function.
	 *
	 * @access public
	 * @return void
	 */


	public function index() {
		if ( ! is_object($this->user))
			url::redirect('login');

		$this->template->title = 'Administracion :: Ingreso';

		$this->template->data = new View('login');
	}

}
