<?php

defined('SYSPATH') or die('No direct script access.');

/*
  Datos Controller
  ---------------------

  @file 		datos.php
  @version 	1.0.0b
  @date 		2009-02-24 00:07:56 -0300 (Tue, 24 Feb 2009)
  @author 	Federico Reinoso <admin@imgdigital.com.ar>

  Copyright (c) 2009 IMG Digital <http://imgdigital.com.ar>

  Controlador para mostrar crear y editar los datos


 */

class Datos_Controller extends Website_Controller {

    public $dato = ''; // Dato
    public $orden = array('fechamodificado' => 'DESC');
    public $ciudad= array(); //= array('localidad_id!=' => 0);

   public function __construct() {

        parent::__construct();
        
        if (Simple_Auth::instance()->logged_in(NULL)) {
            $this->user = Simple_Auth::instance()->get_user();
        } else {
            $this->user = "Por favor Logueese";
        }

        // if (!isset($_SESSION['cat'])) $_SESSION['cat'] = 0;
        if (isset($_GET['cat']))  $_SESSION['cat'] = $_GET['cat'];

        if (!isset($_SESSION['localidad'])) $_SESSION['localidad'] = 0;

        if (isset($_GET['localidad'])) $_SESSION['localidad'] = $_GET['localidad'];

        if ($_SESSION['localidad'] != 0)
            $this->ciudad = array('localidad_id' => $_SESSION['localidad']);

        if (!isset($_SESSION['orden']) OR $_SESSION['orden'] == '')
            $_SESSION['orden'] = 'fechamodificado';

        if (isset($_GET['orden']))
            $_SESSION['orden'] = $_GET['orden'];

        if ($_SESSION['orden'] == 'last') $_SESSION['orden'] = 'fechamodificado';

        switch ($_SESSION['orden']) {
            case 'calle':
                $this->orden = array($_SESSION['orden'] => 'ASC', 'nro' => 'ASC');
                break;
            case 'nombre':
                $this->orden = array($_SESSION['orden'] => 'ASC');
                break;
            default:
                $this->orden = array($_SESSION['orden'] => 'DESC');
                break;

               
        }

        /* if (isset($_SESSION['orden']) AND $_SESSION['orden']!='fechamodificado' ) {
          $this->orden = array($_SESSION['orden']=>'ASC');
          } else {
          $_SESSION['orden']  = 'fechamodificado';
          $this->orden = array($_SESSION['orden']=>'DESC');
          } */

        $this->localidad = ORM::factory('localidad', $_SESSION['localidad']);
        
        $this->categoria = ORM::factory('categoria', $_SESSION['cat']);

        $this->template->controller = 'datos';
    }

    /**
     * index function.
     * redirecciona a /pages, para el paginado.
     * @access public
     * @return void
     */
    public function index() {
        // No page number supplied, so def
        url::redirect('datos/page/1');
    }

    /**
     * Page function.
     *
     * @TODO Verificar que no es muy DRY que digamos
     *
     * @access public
     * @return void
     */
    public function page($pagenum) {

        //if (!isset($_SESSION['request'])) unset($_SESSION['request']);
        $_SESSION['request'] = $this->uri->string();

        if (isset($_SESSION['urledit'])) {
            unset($_SESSION['urledit']);
        }
        //if (isset($_GET['order'])) $this->order = $_GET['order'];

        $this->template->title = 'Administracion :: Datos';

        $this->template->data = new View('pages/datos');

        $this->template->data->menu = new View('datos/menudatos');
        $this->template->data->cats = $this->categorias;
        $this->template->data->localidades = $this->localidades;
        //$this->template->data->gets =
        if (!empty($this->messages))
            $this->template->messages = $this->messages;

        if (isset($_GET['searchstring'])) {

            $searchstring = strtolower($_GET['searchstring']);
            $this->template->data->menu->searchstring = $searchstring;

            if ($_SESSION['cat'] != 0) {

                // NO estoy seguro de esto, pero me permite buscar por ciudad
                $datos = ORM::factory('dato')
                                ->where('categoria_id', $_SESSION['cat'])
                                ->where($this->ciudad)
                                ->open_paren()
                                ->like('nombre', $searchstring)
                                ->orlike('calle', $searchstring)
                                ->orlike('localidad_nombre', $searchstring)
                                ->close_paren()
                                ->find_all();



                $this->template->data->title = $datos->count() . ' Resultados por "' . ucwords($searchstring) . '" en ' . ucwords($this->categoria->catname);
                //// Instantiate Pagination, passing it the total number of product rows.
                $paging = new Pagination(array
                            (
                            'total_items' => $datos->count(),
                            'auto_hide' => true
                        ));


                $this->template->data->datos = ORM::factory('dato')
                                ->where('categoria_id', $_SESSION['cat'])
                                ->where($this->ciudad)
                                ->open_paren()
                                ->like('nombre', $searchstring)
                                ->orlike('calle', $searchstring)
                                ->orlike('localidad_nombre', $searchstring)
                                ->close_paren()
                                ->orderby($this->orden)
                                ->find_all($paging->items_per_page, $paging->sql_offset);
            } else {
                // NO estoy seguro de esto, pero me permite buscar por ciudad
                $datos = ORM::factory('dato')
                                ->where($this->ciudad)
                                ->open_paren()
                                ->like('nombre', $searchstring)
                                ->orlike('calle', $searchstring)
                                ->orlike('localidad_nombre', $searchstring)
                                ->close_paren()
                                ->orderby($this->orden)
                                ->find_all();

                $this->template->data->title = $datos->count() . ' Resultados por "' . ucwords($searchstring) . '" en ' . ucwords($this->categoria->catname);
                //// Instantiate Pagination, passing it the total number of product rows.
                $paging = new Pagination(array
                            (
                            'total_items' => $datos->count(),
                            'auto_hide' => true
                        ));


                $this->template->data->datos = ORM::factory('dato')
                                ->where($this->ciudad)
                                ->open_paren()
                                ->like('nombre', $searchstring)
                                ->orlike('calle', $searchstring)
                                ->orlike('localidad_nombre', $searchstring)
                                ->close_paren()
                                ->orderby($this->orden)
                                ->find_all($paging->items_per_page, $paging->sql_offset);
            }
        } else {

            if ($_SESSION['cat'] > 0) {

                $datos = ORM::factory('dato')
                                ->where('categoria_id', (int) $_SESSION['cat'])
                                ->where($this->ciudad)
                                ->find_all();

                $this->template->data->title = 'Listado ' . ucwords($this->categoria->catname);


                //// Instantiate Pagination, passing it the total number of product rows.
                $paging = new Pagination(array
                            (
                            'total_items' => $datos->count(),
                            'auto_hide' => true
                        ));

                $this->template->data->datos = ORM::factory('dato')
                                ->where('categoria_id', (int) $_SESSION['cat'])
                                ->where($this->ciudad)
                                ->orderby($this->orden)
                                ->find_all($paging->items_per_page, $paging->sql_offset);
            } else {

                $datos = ORM::factory('dato')
                                ->where($this->ciudad)
                                ->find_all();

                $this->template->data->title = 'Listado ' . ucwords($this->categoria->catname);


                //// Instantiate Pagination, passing it the total number of product rows.
                $paging = new Pagination(array
                            (
                            'total_items' => $datos->count(),
                            'auto_hide' => true
                        ));

                $this->template->data->datos = ORM::factory('dato')
                                ->where($this->ciudad)
                                ->orderby($this->orden)
                                ->find_all($paging->items_per_page, $paging->sql_offset);
            }
        }
        //// render the page links
//        echo "<pre>";
//        var_dump($datos);
//        echo "</pre>";
        $this->template->data->pagination = $paging->render();
    }

    /**
     * Busqueda
     *
     * Función de Ayuda para la búsqueda de datos
     *
     * @param <type> $cat
     * @param <type> $localidad
     */
    public function busqueda($cat=0, $localidad=0) {
        
    }

    /**
     * Agrega un dato nuevo
     *
     */
    public function add() {
        $this->template->title = 'Administracion :: Agregar Dato';
        $this->template->data = new View('datos/datosform');

        if (isset($_SESSION['urledit']))
            unset($_SESSION['urledit']);

        if (!$_POST) {
            //Variables en Cero del Formulario
            $localidades = ORM::factory('localidad')->select_list('id', 'localidad_nombre');
            $categorias = ORM::factory('categoria')->select_list();
            $form = array
                (
                'nombre' => '',
                'calle' => '',
                'nro' => '',
                'piso' => '',
                'depto' => '',
                'localidad_id' => $localidades,
                'categoria_id' => $categorias,
                'selloc' => $_SESSION['localidad'],
                'selcat' => $_SESSION['cat'],
                'destaweb'=>0,
                'destacado'=>0
            );

            $this->template->data->form = $form;
        } else {

            $post = new Validation($_POST);
            $post->pre_filter('trim', TRUE);
            $post->add_rules('nombre', 'required', 'length[3,80]');
            //$post->add_rules('calle', 'required');
            //$post->add_rules('nro', 'required');
                    
            $post->add_rules('localidad_id', 'numeric', 'required');
            $post->add_callbacks('localidad_id', array($this, '_nozero'));
            $post->add_callbacks('categoria_id', array($this, '_nozero'));
            
            //$post->post_filter('ucwords', 'nombre');

            $form = $post->as_array();


            if (!$post->validate()) {

                // repopulate form fields and show errors
                $form['localidad_id'] = ORM::factory('localidad')->select_list('id', 'localidad_nombre');
                $form['categoria_id'] = ORM::factory('categoria')->select_list();
                // Localidad Seleccionada
                $form['selloc'] = $post->localidad_id;
                $form['selcat'] = $post->categoria_id;

                $this->template->errors = $post->errors('form_error');
                $this->template->data->form = $form;

            } else {

                if (!$this->duplicateNombre($post->nombre)) {

                    $dato = ORM::factory('dato');
                    $dato->nombre = $post->nombre;
                    $dato->calle = $post->calle;
                    $dato->nro = $post->nro;
                    $dato->depto = $post->depto;
                    $dato->localidad_id = $post->localidad_id;
                    $dato->categoria_id = $post->categoria_id;

                    $dato->save();
                    //$this->session->set('datos',$post->as_array());

                    $this->session->set('dato_id', $dato->id);

                    url::redirect(url::site() . "datos/newextra/" . $dato->id);
                } else {

                    $error = array("Dato duplicado");
                    $form['localidad_id'] = ORM::factory('localidad')->select_list('id', 'localidad_nombre');
                    $form['categoria_id'] = ORM::factory('categoria')->select_list();
                    // Localidad Seleccionada
                    $form['selloc'] = $post->localidad_id;
                    $form['selcat'] = $post->categoria_id;

                    $this->template->data->form = $form;
                    $this->template->data->errors = $error;
                }
            }
        }


        $this->template->data->menu = new View('datos/menudatos');
        $this->template->data->title = 'Agregar Dato';
    }

/**
 * Callback method that checks for uniqueness of email
 *
 * @param  Validation  $array   Validation object
 * @param  string      $field   name of field being validated
 */
public function _nozero(Validation $array, $field)
{
   // check the database for existing records
 
   if ($array[$field]<=0)
   {
       // add error to validation object
       $array->add_error($field, 'nogeneric');
   }
}
    
    
    /**
     * New extra
     *
     * Agrega un dato extra al dato recien creado
     *
     * @param integer $id id del dato
     */
    public function newextra($id, $nuevo=NULL) {
        $dato_id = $id;

        //if (isset($_SESSION['urledit']))  unset($_SESSION['urledit']);

        $this->template->title = 'Administracion :: Data Extra';
        $this->template->data = new View('datos/dataextra');
        $this->template->data->title = $this->template->title;

        $this->template->data->extras = ORM::factory('extra')->where('dato_id', $dato_id)->find_all();

        if (!$_POST) {
            $this->template->data->errors = NULL;
            $tipos = ORM::factory('tipo')->select_list('id', 'label');
            $contenido = array();
            foreach ($tipos as $id => $name) {
                $contenido[$name] = "";
            }

            $form = array
                (
                'dato_id' => $dato_id,
                'tipo' => $tipos,
                'contenido' => $contenido,
                'seltipo' => '',
            );

            $this->template->data->form = $form;
        } else {

            $post = new Validation($_POST);
            $post->pre_filter('trim', TRUE);

            if (!$post->validate()) {
                // repopulate form fields and show errors
                $form['tipo'] = ORM::factory('tipo')->select_list('id', 'label');

                $form = $post->as_array();
                //echo '<h1>No valida</h1>';
                $this->template->data->form = $form;
                $this->template->data->errors = $post->errors('form_error');
            } else {
                //echo '<h1>valida</h1>';
                $this->template->data->errors = NULL;
                //$this->session->set('extras',$post->as_array());
                $data = $post->as_array();

                foreach ($data['contenido'] as $key => $value) {

                    if (!empty($value)) {
                        $extra = ORM::factory('extra');

                        $extra->tipo_id = $key;
                        $extra->contenido = $value;
                        $extra->dato_id = $post->dato_id;
                        $extra->save();
                    }
                }

                $this->actualizarFecha($post->dato_id);

                if (!isset($_SESSION['urledit'])) {
                    url::redirect(url::site() . "datos/newextra/" . $post->dato_id);
                } else {
                    url::redirect($_SESSION['urledit']);
                }
            }
        }
    }

    /**
     * 	Genera un formulario
     *  de acuerdo al dato cargado
     *
     * @param integer $id
     */
    public function addrubro($id=0, $edit=false) {

        $this->template->title = 'Administracion :: Agregar Rubros';

        /**
         * Sino NO Hay ID
         * Genera el Error
         */
        if ($id == 0) {
            $this->template->data = new View('datos/error');
            $this->template->title = 'Error de datos';
            $this->template->errors = array('No puede crear un rubro para un dato sin id');
        } else {

            $this->template->data = new View('datos/datorubros');

            if (!$_POST) {
                $this->template->data->rubros = $this->db->query('SELECT r.nombre as nombre, d.id as id FROM datos_rubro as d, rubros as r WHERE d.rubro_id = r.id AND d.dato_id = ' . $id);

                $listRubros = ORM::factory('rubro')->select_list('id', 'nombre');

                $form = array
                    (
                    'dato_id' => $id,
                    'rubros' => $listRubros,
                    'seltipo' => '',
                );

                $this->template->data->form = $form;
            } else {

                //Nueva Validación
                $post = new Validation($_POST);

                if (!$post->validate() || $this->duplicateRubro($post->rubro_id, $post->dato_id)) { // datos no validos
                    // repopulate form fields and show errors
                    $form['rubros'] = ORM::factory('rubro')->select_list('id', 'nombre');

                    $form = $post->as_array();

                    $this->template->data->form = $form;
                    $this->template->errors = $post->errors('form_error');
                } else { // Datos válidos
                    //$this->session->set('extras',$post->as_array());
                    //$data = $post->as_array();
                    $extra = ORM::factory('datos_rubro');

                    $extra->rubro_id = $post->rubro_id;
                    $extra->dato_id = $post->dato_id;
                    $extra->save();

                    $this->actualizarFecha($post->dato_id);

                    if (!isset($_SESSION['urledit'])) {
                        url::redirect(url::site() . "datos/addrubro/" . $post->dato_id);
                    } else {
                        url::redirect($_SESSION['urledit']);
                    }
                } //end Validate
            } // end !POST
        } // end id vacío
    }

// end addrubro

    /**
     * Rubros
     *
     * Listado de Rubros
     * Busca todos los rubros
     *
     * @param integer $id
     */
    public function rubros($id) {
        $this->template->title = 'Administracion :: Agregar Rubros';
        $this->template->data = new View('datos/datorubros');
        $this->template->data->rubros = ORM::factory('rubros')->find_all();
    }

    /**
     * 	Editar Dato
     *
     * Edita los datos de un item
     *
     * @param integer $id numero del dato
     */
    public function edit($id) {

        $this->template->title = 'Administracion :: Editar dato';
        $this->template->data = new View('datos/edit');
        $this->template->data->title = $this->template->title;
        $this->template->data->volveratras = $_SESSION['request'];

        $_SESSION['urledit'] = $this->uri->string();

        if (!$_POST) {

            $dato = ORM::factory('dato', $id);
            $form = $dato->as_array();

            $form['localidad_id'] = ORM::factory('localidad')->select_list('id', 'localidad_nombre');
            $form['categoria_id'] = ORM::factory('categoria')->select_list();

            // Localidad Seleccionada
            $form['selloc'] = $dato->localidad_id;
            $form['selcat'] = $dato->categoria_id;
            // Destacado
            $form['destacado'] = $dato->destacado;
            $form['destaweb'] = $dato->destaweb;

            $this->template->data->form = $form;
            $this->template->data->extras = $dato->extras;
            $this->template->data->rubros = $dato->rubros; //$form->rubros;
        } else {

            $post = new Validation($_POST);
            $post->pre_filter('trim', TRUE);
            $post->add_rules('nombre', 'required', 'length[3,80]');
            $post->add_rules('calle', 'required');
            //$post->add_rules('nro', 'required');
            //$post->post_filter('ucwords', 'nombre');

            $form = $post->as_array();

            $form['localidad_id'] = ORM::factory('localidad')->select_list('id', 'localidad_nombre');
            $form['categoria_id'] = ORM::factory('categoria')->select_list();
            // Localidad Seleccionada
            $form['selloc'] = $post->localidad_id;
            // Categoria Seleccionada
            $form['selcat'] = $post->categoria_id;

            /** Está destacado */
            if (isset($post->destacado)) {
                $form['destacado'] = $post->destacado;
            } else {
                $form['destacado'] = 0;
            }

            /** Logo para web */
            if (isset($post->destaweb)) {
                $form['destaweb'] = $post->destaweb;
            } else {
                $form['destaweb'] = 0;
            }

            $dato = ORM::factory('dato', $post->id);

            if (!$post->validate()) {

                $this->template->errors = $post->errors('form_error');
            } else {
                //$dato = ORM::factory('dato')->with('dato_rubros')->find($post->id);
                $dato->nombre = ucwords($post->nombre);
                $dato->calle = ucfirst($post->calle);
                $dato->nro = $post->nro;
                $dato->depto = $post->depto;
                $dato->piso = $post->piso;
                $dato->localidad_id = $post->localidad_id;
                $dato->categoria_id = $post->categoria_id;


                //echo kohana::debug($post->destacado);
                if (isset($post->destacado)) {
                    $dato->destacado = $post->destacado;
                } else {
                    $dato->destacado = 0;
                    $form['destacado'] = 0;
                }

                //echo kohana::debug($post->destacado);
                if (isset($post->destaweb)) {
                    $dato->destaweb = $post->destaweb;
                } else {
                    $dato->destaweb = 0;
                    $form['destaweb'] = 0;
                }

                if ($dato->save()) {
                    $this->template->messages = array('Los datos fueron actualizados con éxito');
                } else {
                    $this->template->errors = $post->errors('form_error');
                }
                //echo kohana::debug($dato->as_array(), $form);
                //$this->template->data->form = $dato->as_array();
            }
            $this->template->data->form = $form;
            $this->template->data->extras = $dato->extras;

            $this->template->data->rubros = $dato->rubros; //$form->rubros;
        }
    }

    /**
     * edit extra
     *
     * Edita el contenido de un dato extra.
     *
     * @param integer $id  identificador del dato extra
     */
    public function editextra($id) {
        $this->template->title = 'Administracion :: Editar Extra';
        $this->template->data = new View('datos/editextra');
        $this->template->data->title = $this->template->title;

        if (!$_POST) {
            $extras = ORM::factory('extra')->find($id);

            $form['id'] = $extras->id;
            $form['dato_id'] = $extras->dato_id;

            $form['tipo'] = ORM::factory('tipo')->select_list('id', 'label');
            $form['seltipo'] = $extras->tipo_id;
            $form['contenido'] = $extras->contenido;

            $this->template->data->form = $form;
        } else {

            $post = new Validation($_POST);
            $post->pre_filter('trim', TRUE);


            if (!$post->validate()) {
                // repopulate form fields and show errors
                $form['tipo'] = ORM::factory('tipo')->select_list('id', 'label');

                $form = $post->as_array();
                //echo '<h1>No valida</h1>';
                $this->template->data->form = $form;
                $this->template->data->errors = $post->errors('form_error');
            } else {
                //echo '<h1>valida</h1>';
                $this->template->data->errors = NULL;
                //$this->session->set('extras',$post->as_array());
                $data = $post->as_array();

                $extra = ORM::factory('extra')->find($data['id']);

                $extra->tipo_id = $data['tipo'];
                $extra->contenido = $data['contenido'];
                $extra->dato_id = $data['dato_id'];
                $extra->save();

                $this->actualizarFecha($data['dato_id']);

                url::redirect($_SESSION['urledit']);
                // url::redirect(url::site()."datos/edit/".$post->dato_id);
            }
        }
    }

    public function actualizarFecha($dato) {
        // Salvo el mismo nro, para cambiar la última modificación
        $dato = ORM::factory('dato')->find($dato);
        $dato->fechaModificado = date('Y-m-d G:i:s');
        $dato->save();
    }

    /**
     * Delete
     * Prepara el dato para ser borrado
     *
     * @param <type> $id
     */
    public function delete($id) {

        $this->template->title = 'Administracion :: Borrar dato';
        $this->template->data = new View('datos/delete');
        $this->template->data->title = $this->template->title;
//        $this->template->data->errors = '';
//        $this->template->data->messages = '';
        //$this->template->data->volveratras = $_SESSION['request'];

        $this->dato = ORM::factory('dato')->with('dato_rubros')->find($id);
        $question = '¿Esta seguro de borrar el dato <span class="order0">' . $this->dato->nombre . '</span> ?';

        $question.='<br />' . $this->getDatoInfo();
        $this->template->data->data = $this->dato->as_array();
        $this->template->data->borrar = $question;
        $this->template->data->siquiero = 'datos/deleteIt/' . $id;
        $this->template->data->niahi = $_SESSION['request'];
    }

    /**
     * DeleteIt
     * Realmente hace el borrado del dato
     *
     * @param integer $id
     */
    public function deleteIt($id) {
        $dato = ORM::factory('dato', $id)->with('datos_rubro')->delete();
        ORM::factory('datos_rubro')->where('dato_id', $id)->delete_all();
        ORM::factory('extra')->where('dato_id', $id)->delete_all();
        $this->messages = array("El dato fue borrado con éxito");
        $this->index();
    }

    /**
     * Get DatoInfo
     *
     * @return <type> Datos dirección y otros
     */
    public function getDatoInfo() {
        if ($this->dato != "") {
            $datoInfo = $this->dato->calle;
            if ($this->dato->nro != 0)
                $datoInfo.= ' ' . $this->dato->nro;
            if ($this->dato->piso != 0)
                $datoInfo.= ' ' . $this->dato->piso;
            if ($this->dato->depto != "")
                $datoInfo.= ' ' . $this->dato->depto;

            $localidad = ORM::factory('localidad', $this->dato->localidad_id);
            $datoInfo.= ' ' . $localidad->localidad_nombre;

            return $datoInfo;
        } else {
            return '';
        }
    }

    /**
     * delRub
     * Borra Rubro
     *
     * Elimina un rubro determinado por la URL
     *
     * @param integer $id
     * @param integer $rub
     *
     * redirecciona al URL que lo llama
     *
     * TODO: Hay que hacer un paso intermedio con javascript y HTML
     * para evitar borradas accidentales
     */
    public function delrub() {

        $id = $this->uri->segment(4); // Dato
        $rub = $this->uri->segment(3); // Rubro


        if ($id != 0) {

            // Poner alerta

            $rubro = ORM::factory('datos_rubro')
                            ->where(array('dato_id' => $id, 'rubro_id' => $rub))
                            ->find();

            //echo kohana::debug($rubro);

            if ($rubro) {
                $rubro->delete();
            }
            if (isset($_SESSION['urledit'])) {
                url::redirect($_SESSION['urledit']);
            } else {
                url::redirect($_SESSION['request']);
            }
        }
    }

    /**
     * deleteextra
     *
     * Borra un extra del dato por el ID del mismo
     *
     * @param integer $id ID del extra
     * @param bool $all Borrar todos?
     *
     * vuelve al la URL que lo llamó.
     *
     * TODO: Hay que hacer un paso intermedio con javascript y HTML
     * para evitar borradas accidentales
     */
    public function deleteextra($id=0, $all=false) {

        //@TODO revisar la redirección porque cambia de acuerdo al sector desde donde se la llama
        $redirect = $_SESSION['request'];

        if ($id != 0) {
            // Poner alerta
            if ($all == false) {
                $extra = ORM::factory('extra', $id);
                //echo kohana::debug($extra);
                if ($extra) {
                    $extra->delete();
                }
                url::redirect($_SESSION['urledit']);
                //url::redirect(url::site().$redirect);
            } else {
                if (is_object($this->dato)) {
                    
                } else {
                    // Error
                }
                // goto rubros
            }
        }
    }

    /**
     * 	Nombre duplicado
     *
     * Verifica la existencia del nombre en la base de datos
     * Es una función de ayuda, que se usa generamente en la carga inicial
     * de un dato
     *
     * @param string $nombre
     * @return boolean
     */
    public function duplicateNombre($nombre) {
        $dato = ORM::factory('dato')->where('nombre', $nombre)->find_all();
        if ($dato->count() > 0)
            return TRUE;
    }

    /**
     * 	rubro duplicado
     *
     * Verifica la existencia del id del rubro en la base de datos
     * Es una función de ayuda, que se usa generamente en la carga inicial
     * de un dato
     *
     * @param integer $rubro ID del rubro
     * @param integer $dato_id ID del dato
     * @return boolean
     */
    public function duplicateRubro($rubro, $dato_id) {
        $dato = ORM::factory('datos_rubro')->where(array('rubro_id' => $rubro, 'dato_id' => $dato_id))->find_all();
        if ($dato->count() > 0)
            return TRUE;
    }

    /**
     * Check Bool
     *
     * Chequea los datos Booleanos tipo para los checkboxes
     *
     * @TODO Incompleta Favor de Completar
     *
     * @param <type> $selection
     * @param <type> $estado
     * @return <type>
     */
    public function checkbool($selection='', $estado=FALSE) {
        if ($selection != '') {

            //$value =
        }
        return $value;
    }

}