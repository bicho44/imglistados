<?php defined('SYSPATH') or die('No direct script access.');

/*

	Website_Controller
	-------------------

	@file 		website.php
	@version 	1.0.0b
	@date 		2009-01-26 16:50:14 -0300 (Mon, 26 Jan 2009)
	@author 	Federico Reinoso <admin@imgdigital.com.ar>

	Copyright (c) 2009 IMG Digital <http://imgdigital.com.ar>

	Controlador Base para todo el sitio

*/

class Website_Controller extends Template_Controller {
        public $user;
        
        public $messages = array();
        public $errors = array();

	private $y = 2009;

	public function __construct() {

		parent::__construct();
                
                // Inicio de Session
		$this->session = Session::instance();
                // Si la variable cat no está definida, definirla
                if (!isset($_SESSION['cat'])) $_SESSION['cat'] = 0;
                if (!isset($_SESSION['localidad'])) $_SESSION['localidad'] = 0;

		$this->template->links = array (
			'Acerca de IMGListados'=>'about',
			'Datos'=>'datos',
			'Rubros'=>'rubros',
			
                        'Exportar Listados'=>'listados'
		 );

		$this->template->footer = 'Copyright '.$this->thiYear ($this->y).' - '.html::anchor('http://www.imgdigital.com.ar','IMG Digital',array('target'=>'_blank')) .'- '.html::anchor('http://www.imgdigital.com.ar/imglistados','IMGListados', array('target'=>'_blank'));

		$this->template->login = new View('login');

                // Da acceso a todos los controladores la base de datos
		$this->db = Database::instance();

                //Listado de Categorías
                $this->categorias = ORM::factory('categoria')->select_list();
		$this->template->cats =  $this->categorias;

                //Listado de Localidades
                $this->localidades = ORM::factory('localidad')->select_list();
                $this->template->localidades = $this->localidades;
                
		//$this->profiler = new Profiler;

	}

	public function index(){
		if ( ! is_object($this->user))
   			url::redirect('login');
	}

	private function thiYear ($y){
		$yy = date('Y');
		if (($yy-$y)>0) return $this->y.' - '.$yy;
	}

}

?>
