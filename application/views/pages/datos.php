<div class="clearfix">
    <ul id="categorias" class="grid_12 alpha">
            <?php
            foreach ($cats as $cat => $url): ?>
                <?php if ($_SESSION['cat'] == $cat) {
                    $class= array('class'=>'active') ;
                } else {
                    $class = array();
                }
                ?>
        <li><?php echo html::anchor('datos/?cat='.$cat, $url, $class) ?></li>
            <?php endforeach ?>
    </ul>

    <ul id="suckerfish" class="grid_4 omega">
        <li>Localidades:
            <ul>
                    <?php foreach ($localidades as $loc => $url): ?>
                        <?php if ($_SESSION['localidad'] == $loc) {
                            $class= array('class'=>'active') ;
                            $actual = $url;
                        } else {
                            $class = array();
                        }
                        ?>
                <li><?php echo html::anchor('datos/?localidad='.$loc, $url, $class) ?></li>
                    <?php endforeach ?>
            </ul>
            <?php echo $actual; ?>
        </li>
    </ul>
</div>

<?php
//Menu Datos
if (isset($menu)) echo $menu;
?>
<!-- YOUR DATA GOES HERE -->
<?php $base = url::base(); ?>
<?php
if (is_object($datos) && $datos->count()>0) {
    ?>

<table id="tablesorter" class="mensajes">
    <thead><tr><th>Nombre</th><th>Extras</th><th>Rubros</th><th colspan="2">Acciones</th></tr></thead>
    <tfoot>
        <tr>
            <td colspan="5">

                    <?php if(isset($pagination)) echo $pagination ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
            <?php foreach ($datos as $dato) { ?>
                <?php $class = ""; ?>
                <?php if ( $dato->destacado==1 ) $class = ' class="destacado"';?>
        <tr<?=$class?>>
            <td>
                <p class="nombre"><?=$dato->nombre;?></p>
                <p class="direccion"><?php
                            if ($dato->calle!='') echo $dato->calle;
                            if ($dato->nro!=0) echo ' '.$dato->nro;
                            if ($dato->piso!='') echo ' '.$dato->piso.'p.';
                            if ($dato->depto!='') echo ' '.$dato->depto;
                            if ($dato->localidad_id!=0) echo '. '.$dato->localidad->localidad_nombre.' ('.$dato->localidad->cod_postal.')';
                            ?>
                </p>
            </td>
            <td>
                        <?php if ($dato->extras->count()>0) { ?>
                <ul class="extras">
                                <?php foreach ($dato->extras as $extra) {?>
                    <li><strong><?=substr($extra->tipo->label,0,3)?></strong>: <?=$extra->contenido?></li>
                                    <?php } // end Foreach
                                ?>
                </ul>
                            <?php } else { // End if $dato->extras ?>
                <div class="notice">Faltan Datos</div>
                            <?php } ?>
            </td>
            <td>
                        <?php if ($dato->rubros->count()>0) { ?>
                <ul class="rubros">
                                <?php $class = ""; ?>
                                <?php foreach ($dato->rubros as $rubro) {

                                    // echo kohana::debug($rubro->where('dato_id',$dato->id)->datos_rubro);
                                    foreach ($rubro->where('dato_id',$dato->id)->datos_rubro as $datos_rubro) {
                                        if ($datos_rubro->position == 1) {
                                            $class = ' class="order4 spacer"';
                                        } else {
                                            $class = '';
                                        }

                                        //echo html::anchor('/rubros/principal/'.$rubro->id.'/'.$this->uri->segment(3),$rubro->nombre);?>

                    <li<?php echo $class; ?>><?=html::anchor('/rubros/principal/'.$rubro->id.'/'.$dato->id,
                                                    $rubro->nombre,
                                                    array('title'=>'Designar '.$rubro->nombre.' como rubro principal',
                                                    'alt'=>'Designar '.$rubro->nombre.' como rubro principal'));?></li>
                                        <?php //echo kohana::debug($datos_rubro);
                                    } // end Foreach
                                    ?>
                                    <?php   } // end Foreach $dato->rubros ?>
                </ul>
                            <?php } else { // End if $dato->extras ?>
                <div class="notice">No hay Rubros</div>
                            <?php } ?>
            </td>
            <td>
                        <?php echo html::anchor('/datos/edit/'.$dato->id,
                        html::image(array('src'=>'media/images/application_edit.png',
                        'title'=>'Editar '.$dato->nombre,
                        'width'=>'16','height'=>'16'))
                        , array('alt'=>'Editar '.$dato->nombre));?>
            </td>
            <td>
                        <?php echo html::anchor('/datos/delete/'.$dato->id,
                        html::image(array('src'=>'media/images/cancel.png',
                        'title'=>'Borrar '.$dato->nombre,
                        'width'=>'16','height'=>'16'))
                        , array('alt'=>'Borrar '.$dato->nombre));
                        ?>
            </td>
        </tr>

                <?php } ?>

    </tbody>
</table>


<div id="tooltip" class="tooltip">&nbsp;</div>

    <?php
} else {?>
<div class="error">No hay datos por favor cargue alguno</div>
    <?php }

?>
