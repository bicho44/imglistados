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


class Rubros_Controller extends Website_Controller {


    public function __construct() {

        parent::__construct();

        if (Simple_Auth::instance()->logged_in(NULL))
            $this->user = Simple_Auth::instance()->get_user();
    }


    /**
     * index function.
     * redirecciona a /pages, para el paginado.
     * @access public
     * @return void
     */
    public function index() {
    // No page number supplied, so def
        url::redirect('rubros/page/1');
    }

    /**
     * index function.
     *
     * @access public
     * @return void
     */
    public function page($pagenum) {
        $this->template->title = 'Administración :: Rubros y subRubros';

        $this->template->data = new View('pages/rubros');
        $_SESSION['request'] = $this->uri->string();
        $this->template->data->menu = new View('rubros/menurubros');
        $this->template->data->title = 'Rubros';
        $rubros = ORM::factory('rubro')->where('parent_id', 0);

        //// Instantiate Pagination, passing it the total number of product rows.
        $paging = new Pagination(array
            (
            'total_items' => $rubros->count_all(),
            'auto_hide'=>true
        ));
        //// render the page links
        $this->template->data->pagination = $paging->render();
        // Display X items per page, from offset = page number
        $this->template->data->rubros = ORM::factory('rubro')
            ->where('parent_id', 0)
            ->find_all($paging->items_per_page, $paging->sql_offset);
    }

    public function view($id=0) {
        $this->template->title = 'Administracion :: Rubros y subRubros';
        $this->template->data = new View('pages/rubros');
        // ORM::factory("Category", 42)->children->as_array()
        // $rubros = ORM::factory('rubro',$id);
        $rubros = ORM::factory('rubro', $id);

        $this->template->data->title = $rubros->nombre;//$rubros->parent->nombre;
        $this->template->data->rubros = $rubros->children;//$rubros->children;
    }

    public function edit($id=0) {

        $this->template->title = 'Administracion :: Rubros y subRubros';
        $this->template->data = new View('rubros/edit');

        if (!$_POST) {

            $listRubros = ORM::factory('rubro')->select_list('id','nombre');

            $listRubros ['0'] = 'Rubro principal';

            if ($id!=0) {
                $rubro = ORM::factory('rubro')->find($id);

                $form = array
                    (
                    'id'    => $rubro->id,
                    'rubro_id'=> $listRubros,
                    'nombre'   => $rubro->nombre,
                    'seltipo'=>$rubro->parent_id,
                );
            } else {
                $form = array
                    (
                    'id'    => NULL,
                    'rubro_id'=> $listRubros,
                    'nombre'   => "",
                    'seltipo'=> 0,
                );
            }
            $this->template->data->form = $form;
        } else {

            $post = new Validation($_POST);
            $post->pre_filter('trim', TRUE);
            $post->add_rules('nombre', 'required', 'length[3,50]');

            //$post->post_filter('strtolower', 'nombre');

            $form = $post->as_array();

            if ( ! $post->validate()) {
                $this->template->errors = $post->errors('form_error');
            } else {
                $rubro = ORM::factory('rubro')->find($post->id);
                $rubro->nombre = $form['nombre'];
                $rubro->id = $form['id'];
                $rubro->parent_id = $form['rubro_id'];

                if ($rubro->save()) {
                    $this->template->messages =
                        array('Los datos fueron actualizados con éxito');
                    url::redirect($this->uri->string());
                }


            }

        }

    }

    public function principal() {
        $this->template->title = 'Administracion :: Rubros y subRubros';

        if ($_POST) {
            $datos ='<div class="yui-b data">';
            $datosRubros = ORM::factory('datos_rubro')
                ->where('dato_id',$_POST['dato_id'])->find_all();

            foreach ($datosRubros as $datoRubro) {

                if ($datoRubro->rubro_id ==$_POST['rubroPrincipal']) {
                    $datoRubro->position = 1;
                } else {
                    $datoRubro->position = 0;
                }
                $datoRubro->save();
            //$datos .= kohana::debug($datoRubro).'<br />';
            }
            $this->actualizarFecha($_POST['dato_id']);

            $datos .='</div>';

            //$this->template->data = $datos;

            if (isset($_SESSION['urledit'])) {
                url::redirect($_SESSION['urledit']);
            } else {
                url::redirect($_SESSION['request']);
            }

        } else {

        // Agregar paso intermedio
            $rubroPrincipal = $this->uri->segment(3);
            $dato_id = $this->uri->segment(4);

            $this->template->title = 'Administracion :: Cambiar Rubro Principal';
            $this->template->data = new View('datos/cambioppal');

            $this->dato = ORM::factory('dato',$dato_id );
            $question = '¿Esta seguro de Cambiar el Rubro Principal
                            del dato <span class="order0">'.$this->dato->nombre.'</span> ?';

            $this->template->data->mensaje = $question;
            $this->template->data->siquiero = 'rubros/ppalasignar/'.$rubroPrincipal.'/'.$dato_id ;
            $this->template->data->niahi = $_SESSION['request'];

        }

    }
    public function ppalasignar() {

        $rubroPrincipal = $this->uri->segment(3);
        $dato_id = $this->uri->segment(4);

        $datosRubros = ORM::factory('datos_rubro')
            ->where('dato_id',$dato_id)->find_all();

        //            $datos .= 'Dato: '.$dato_id;
        //            $datos .= kohana::debug($datosRubros).'<br />';

        foreach ($datosRubros as $datoRubro) {
            if ($datoRubro->rubro_id == $rubroPrincipal) {
                $datoRubro->position = 1;
            } else {
                $datoRubro->position = 0;
            }
            $datoRubro->save();
        }
        $this->actualizarFecha($dato_id);

        if (isset($_SESSION['urledit'])) {
            url::redirect($_SESSION['urledit']);
        } else {
            url::redirect($_SESSION['request']);
        }
    }

    public function actualizarFecha($dato) {
    // Salvo el mismo nro, para cambiar la última modificación
        $dato = ORM::factory('dato')->find($dato);
        $dato->fechaModificado = date('Y-m-d G:i:s');
        $dato->save();
    }

    public function delete($id) {
    // Falta la alerta
        ORM::factory('rubro')->where('id',$id)->delete_all();
        url::redirect($_SESSION['request']);
    }

}
