<?php defined('SYSPATH') or die('No direct script access.');

/**
 *	Listado Controller
 *
 *	@file 		listados.php
 *	@version 	1.0.0b
 *	@date 		2009-10-25 00:07:56 -0300 (Tue, 24 Feb 2009)
 *	@author 	Federico Reinoso <admin@imgdigital.com.ar>
 *
 *	Copyright (c) 2009 IMG Digital <http://imgdigital.com.ar>
 *
 *	Controlador para crear y export de datos
 *
 **/
class Listados_Controller extends Website_Controller {
    /* Retorno de carro */
    var $CR = "\015\012";
    /* Tabulador */
    var $TAB = "\t";
    /* Break de Linea */
    var $BR = "";
    /* Estilo de Rubro para el export */
    var $RUB = 'pstyle:titulo';
    /* Estilo de Subrubro para el export */
    var $SUB = 'pstyle:subtitulo';

    /**
     * Listados
     * Genera los primeros paráetros oara la cración de los listados y luego exportarlos
     */
    public function __construct() {

        parent::__construct();

        if (Simple_Auth::instance()->logged_in(NULL)) {
            $this->user = Simple_Auth::instance()->get_user();
        }
        else {
            $this->user = "Por favor Logueese";
        }

        // if (!isset($_SESSION['cat'])) $_SESSION['cat'] = 0;
        if (isset($_GET['cat'])) $_SESSION['cat'] = $_GET['cat'];
        if (isset($_GET['localidad'])) $_SESSION['localidad'] = $_GET['localidad'];

        $this->localidad = ORM::factory('localidad',$_SESSION['localidad'])->select_list();
        $this->categoria = ORM::factory('categoria',$_SESSION['cat'])->select_list();

    }
    /**
     * Indice
     * Entrada default donde se abre el panel de export de datos
     * No tiene retornos
     */
    public function index() {
        if (isset($_SESSION['request'])) unset($_SESSION['request']);

        if (!$_POST) {

            $this->template->title = 'Administracion :: Exportar Datos';

            $this->template->data = new View('pages/export');
            $this->template->data->title = $this->template->title;
            $this->template->data->categoria = $this->categoria;
            $this->template->data->localidad = $this->localidad;

        }
        else {
            $this->auto_render=FALSE;

            $this->tipo = $_POST['tipo_listado'];
            $this->tagL = $_POST['marc_left'];
            $this->tagR = $_POST['marc_right'];

            $this->cat = ORM::factory('categoria', $_POST['categoria_id']);
            $this->loc = ORM::factory('localidad', $_POST['localidad_id']);

            switch ($this->tipo) {
                case 'alfabetico':
                    $this->tag = 'pstyle:alfa';
                    $this->listadoAlfabetico();
                    break;
                case 'rubros':
                    $this->tag = 'pstyle:rubro';
                    $this->listadoRubros();
                    break;
                case 'tematicos':
                    $this->tag = 'pstyle:rubro';
                    $this->listadoTematicos();
                    break;
                case 'mails':
                    $this->tag = 'pstyle:email';
                    $this->listadoExtras(4);
                    break;
                case 'webs':
                    $this->tag = 'pstyle:web';
                    $this->listadoExtras(5);
                    break;
                case 'mailwebs':
                    $this->tag = 'pstyle:web';
                    $this->listadoExtras(5);
                    break;
                default:
                    $this->listadoMamotreto();
                    break;
            }
        }

    }
    /**
     * Listado Mamotreto
     * Exporta un listado con TODA la data de la base de datos
     * @return <type>
     */
    public function listadoMamotreto() {
        return;
    }
    /**
     * Listado de Mail y Webs
     * Exporta el listado de Mails y Webs
     * No funciona correctamente
     *
     */
    public function listadoMailWebs() {
        $datos = ORM::factory('dato')
            ->where(array('categoria_id'=>$_POST['categoria_id'],'localidad_id'=>$_POST['localidad_id']))
            ->orderby('nombre','ASC')->find_all();
        //$export = "";

        if ($datos->count()>0) {

            //ini_set("memory_limit", "64M");

            //$dexport = $TAB.'NOMBRE'.$TAB.'DIRECCION'.$TAB.'TELEFONOS'.$TAB.'FAX'.$TAB.'RUBRO'.$CR;
            $dexport='<UNICODE-MAC>'.$this->CR;
            foreach ($datos as $dato) {
                $destacado = "";
                $extra = "";
                if ($dato->destacado!=0) $destacado = '-bold';

                $mail = $this->_extras($dato->extras, 4);
                $web = $this->_extras($dato->extras, 5);

                if ($extra!="" OR $extra!=0) {
                    $dexport .= $this->_tag($this->tag,$destacado)
                        .$dato->nombre
                        .$this->TAB.$this->_extras($dato->extras,4)
                        .$this->CR;
                    //echo $dexport.'<br />';
                }
            }

            //ini_set("memory_limit", "32M");
            $this->_export($dexport);
        }
        else {
            echo 'No hay Datos?';
        }
    }
    /**
     * Listado de Extras
     * Exporta el Listado de Extras
     *
     * @param int $i
     */
    public function listadoExtras($i=4) {

        $datos = ORM::factory('dato')
            ->where('categoria_id',$_POST['categoria_id'])
            ->where('localidad_id',$_POST['localidad_id'])
            ->orderby('nombre','ASC')->find_all();

        //$export = "";

        if ($datos->count()>0) {

            //ini_set("memory_limit", "64M");

            //$dexport = $TAB.'NOMBRE'.$TAB.'DIRECCION'.$TAB.'TELEFONOS'.$TAB.'FAX'.$TAB.'RUBRO'.$CR;
            $dexport='<UNICODE-MAC>'.$this->CR;
            foreach ($datos as $dato) {
                $destacado = "";
                $extra = "";
                if ($dato->destacado!=0) $destacado = '-bold';

                $extra = $this->_extras($dato->extras,$i);
                if ($extra!="" OR $extra!=0) {
                    $dexport .= $this->_tag($this->tag,$destacado)
                        .$dato->nombre
                        .$this->TAB.$this->_extras($dato->extras,$i)
                        .$this->CR;
                    //echo $dexport.'<br />';
                }
            }

            //ini_set("memory_limit", "32M");
            $this->_export($dexport);
        }
        else {
            echo 'No hay Datos?';
        }
    }
    /**
     * Listado de Rubros Temático
     *
     * Exporta un listado de los nombres de los rubros
     * de acuerdo a la ciudad
     * y si en cada rubro hay algún dato
     *
     *
     */
    public function listadoTematicos() {

        // Listado de Rubros ordenados por el rubro padre
        $rubros = ORM::factory('rubro')
            ->where('parent_id',0)
            ->orderby(array('parent_id'=>'ASC', 'nombre'=>'ASC'))
            ->find_all();

        $ex = "";

        foreach ($rubros as $rubro) {
            $ex .= $rubro->nombre;
            if ($rubro->children) {
                foreach($rubro->children as $child) {
                    $children = ORM::factory('dato')
                        ->where(array(
                        'categoria_id'=>$_POST['categoria_id'],
                        'localidad_id'=>$_POST['localidad_id']
                        ))
                        ->find_all();
                    if ($children->count()>0) {
                        $ex .= $child->nombre;
                    }
                }
            }
        }
        echo $ex;
    }
    /**
     * Listado de Rubros
     * Exporta listado de Rubros
     *
     */
    public function listadoRubros() {
        /*
         * Sacar listado de rubros dependientes del padre general
         * Hacer un bucle de los nombres de los hijos y ordenarlos alfabéticamente
         * Tomar ese array y hacer bucle de datos
         *
         *
         * @TODO Hacer una función de esto en el Model
         *
         */
        $rp = ORM::factory('rubro')
            ->where('parent_id',0)
            ->orderby(array('nombre'=>'ASC','parent_id'=>'ASC'))
            ->find_all();

        $par = array();

        foreach ($rp as $pariente) {
            $par[]= $pariente->id;
        }
        //echo kohana::debug($par);
        $rubros = ORM::factory('rubro')
            ->in('parent_id',$par)
            ->orderby(array('nombre'=>'ASC','parent_id'=>'ASC'))
            ->find_all();

        //            echo kohana::debug($par2);
        //          exit;
        /*$rubros = ORM::factory('rubro')
            ->where('parent_id!=',0)
            ->orderby(array('nombre'=>'ASC','parent_id'=>'ASC'))
            ->find_all();
*/
        //ini_set("memory_limit", "64M");

        if ($rubros->count()>0) {
            $r="<UNICODE-MAC>".$this->CR.$this->BR;
            foreach($rubros as $rubro) {
                //echo "<h3>".$rubro->nombre."</h3>";
                $r .= $this->_bucleDatos($rubro->datos, $rubro->nombre);
                //Si el Rubro tiene Hijos
                if ($rubro->children) {
                    foreach($rubro->children as $children) {
                        //echo "<h4>".$children->nombre."</h4>";

                        if ($children->datos->count()>0) {
                            //$r .= $this->_tag($this->SUB).$this->TAB.$children->nombre.$this->CR.$this->BR;
                            $r .= $this->_bucleDatos($children->datos, $children->nombre,$rubro->nombre);
                        }
                    }
                }
            }
            ///var_dump($r);
            //exit;
        }
        $this->_export($r);
        //ini_set("memory_limit", "32M");
    }

    /**
     * Listado Alfabetico
     * Genera un archivo con el listado Alfabético
     */
    public function listadoAlfabetico() {
        $datos = ORM::factory('dato')->where(array('categoria_id'=>$_POST['categoria_id'],'localidad_id'=>$_POST['localidad_id']))->orderby('nombre','ASC')->find_all();
        //$export = "";

        if ($datos->count()>0) {

            ini_set("memory_limit", "64M");

            //$dexport = $TAB.'NOMBRE'.$TAB.'DIRECCION'.$TAB.'TELEFONOS'.$TAB.'FAX'.$TAB.'RUBRO'.$CR;
            $dexport='<UNICODE-MAC>'.$this->CR;
            foreach ($datos as $dato) {

                $destacado = "";
                if ($dato->destacado!=0) $destacado = '-bold';

                $dexport .= $this->_tag($this->tag,$destacado)
                    .$dato->nombre
                    .$this->TAB.$this->_direccion($dato)
                    .$this->TAB.$this->_extras($dato->extras,1)
                    .$this->_extras($dato->extras,3)
                    .$this->TAB.$this->_extras($dato->extras,2,1)
                    .$this->TAB.$this->_rubroPpal($dato->rubros,$dato->id,$_POST['cut_rubro'])
                    .$this->CR;
                //echo $dexport.'<br />';
            }

            ini_set("memory_limit", "32M");
            $this->_export($dexport);
        }
        else {
            echo 'No hay Datos?';
        }
    }

    private function _bucleDatos2($rubro_id,$Rnombre="") {
        $r = "";
        $j = TRUE;

        $datos = ORM::factory('dato')
            ->where(array('rubros:rubro_id'=>$rubro_id,
            'categoria_id'=>$this->cat->id,
            'localidad_id'=>$this->loc->id,
            ))
            ->orderby('nombre', 'ASC')
            ->find_all();

        if ($datos->count()>0) {

            foreach($datos as $dato) {

                $destacado = "";
                if ($dato->destacado!=0) $destacado = '-bold';

                $r .= $this->_tag($this->tag,$destacado)
                    .$dato->nombre
                    .$this->TAB.$this->_direccion($dato)
                    .$this->TAB.$this->_extras($dato->extras,1)
                    .$this->_extras($dato->extras,3)
                    .$this->TAB.$this->_extras($dato->extras,2,1).$this->CR.$this->BR;
            }

        }
        return $r;
    }
    /**
     * Bucle de Datos
     * Recorre toda la lista de datos para generar los listados y exportarlos
     *
     * @param obj $datos
     * @param string $Rnombre
     * @param string $parent
     * @return string
     */
    private function _bucleDatos(&$datos,$Rnombre="",$parent="") {
        $r = "";
        $j = TRUE;
        if (!isset($_SESSION['parent'])) $_SESSION['parent'] = "";

        //if ($datos->count>0) {

        foreach($datos as $dato) {

            if ($dato->categoria_id == $this->cat->id AND $dato->localidad_id == $this->loc->id) {
                if ($Rnombre!="" && $j==TRUE) {
                    if ($parent!="") {
                        if (isset($_SESSION['parent'])!=$parent) {
                            $_SESSION['parent'] = $parent;
                            $r .= $this->_tag($this->RUB).$parent.$this->CR.$this->BR;
                        }
                    }
                    $r .= $this->_tag($this->RUB).$Rnombre.$this->CR.$this->BR;
                    $j = FALSE;
                }
                $destacado = "";
                if ($dato->destacado!=0) $destacado = '-bold';

                $r .= $this->_tag($this->tag,$destacado)
                    .$dato->nombre
                    .$this->TAB.$this->_direccion($dato)
                    .$this->TAB.$this->_extras($dato->extras,1)
                    .$this->_extras($dato->extras,3)
                    .$this->TAB.$this->_extras($dato->extras,2,1).$this->CR.$this->BR;
            }
        }

        //} else {
        //            if ($Rnombre!="") {
        //                $r .= $this->_tag($this->RUB).$Rnombre.$this->CR.$this->BR;
        //            } else {
        //                $r .= "No hay nombre de Rubro".$this->CR.$this->BR;
        //            }
        //        }
        return $r;
    }
    /**
     * Export
     * Exporta el Archivo Final
     *
     * @param string $dexport
     */
    private function _export($dexport) {
        $filename = str_replace(' ','_', $this->loc->localidad_nombre);
        header("Content-type: text/plain; charset=UTF-8");
        header("Content-Length: ".strlen($dexport));
        header("Content-Disposition: attachment; filename=".$filename.'_'.$this->cat->catname.'_'.$this->tipo.'_'. date("Ymd") .".txt");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $dexport;
        exit;
    }
    /**
     * Rubro Principal
     * Extrae el Rubro principal de la lista de datos
     *
     * @param obj $rubros
     * @param int $dato_id
     * @param int $cut
     * @return string
     */
    private function _rubroPpal($rubros,$dato_id, $cut=30) {
        foreach($rubros as $rubro) {
            //$dato_rubro = $rubro->getwhere(array('dato_id'=>$dato_id))->datos_rubro->find('position',1);
            //$dato_rubro = $datos_rubro->where(array('position'=>1));
            foreach ($rubro->where('dato_id',$dato_id)->datos_rubro as $datos_rubro) {
                if ($datos_rubro->position == 1) {
                    return substr($datos_rubro->nombre,0,$cut);
                }
            }
            
           // return substr($dato_rubro->nombre,0,$cut);
        }
    }
    /**
     * Extras
     *
     * Obtiene las extras por tipo
     * @todo cambiarla por una más generica que devuelva un array o algo así
     * porque consume mucha memoria.
     *
     * @param obj $dato
     * @param int $tipo
     * @param int $cant
     * @return string
     */
    private function _extras($dato,$tipo=1,$cant=NULL) {
        //$label = false;
        $datoextra = "";

        if ($cant !== NULL) {
            $i = 1;
            foreach ($dato as $extra) {
                if ($extra->tipo_id===$tipo) {
                    if ($i<=$cant+1) {
                        $datoextra .= $extra->contenido.' ' ;
                    }
                }
                $i++;
            }
        }
        else {
            foreach ($dato as $extra) {
                if ($extra->tipo_id===$tipo) {
                    $datoextra .= $extra->contenido.' ' ;
                }
            }
        }
        return $datoextra;
    }
    /**
     * Dirección
     * Obtiene la direccion del dato y le da un formato oara el export
     *
     * @param obj $dato
     * @return string
     */
    private function _direccion($dato) {
        $nro = "";
        $piso = "";
        $dpto = "";
        $calle = "";

        if ($dato->nro!="" OR $dato->nro!=0) $nro = ' '.$dato->nro.' ';
        if ($dato->piso!="" OR $dato->piso!=0) $piso = $dato->piso.'p ';
        if ($dato->depto!="" OR $dato->depto!=0 ) $dpto = $dato->depto.' ';
        if ($dato->calle!="" OR $dato->calle!=0) $calle = $dato->calle;
        $dir = $calle.$nro.$piso.$dpto;

        return $dir;
    }
    /**
     * Tag
     * Genera el Tag para el export y que este sea compatible con e l Indesing
     *
     * @param <type> $tag
     * @param <type> $destacado
     * @return <type>
     */
    private function _tag( $tag = "", $destacado="") {
        if ($tag=="") $tag = $this->tag;
        return $this->tagL.$tag.$destacado.$this->tagR;
    }
}