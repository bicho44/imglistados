<?php $base = url::base(); ?>
<?php
 //Menu Datos
// if (isset($menu)) echo $menu;
 ?>
<div class="yui-b data">
    <!-- YOUR DATA GOES HERE -->
    <h2><?=$title?></h2>
     <?php
     if (is_object($datos) && $datos->count()>0) {
         ?>
         <?php if(isset($pagination)) echo $pagination ?>
    <table id="tablesorter" class="mensajes">
        <thead><tr><th>Nombre</th><th>Extras</th><th>Rubros</th><th colspan="2">Acciones</th></tr></thead>
        <tbody>
                 <?php foreach ($datos as $dato) { ?>
            <?php $class = ""; ?>
            <?php if ( $dato->destacado==1 ) $class = ' class="destacado"';?>
            <tr<?=$class?>>
                <td>
                    <h4><?=$dato->nombre;?></h4>
                    <p class="direccion"><?php
                                 if ($dato->calle!='') echo $dato->calle;
                                 if ($dato->nro!=0) echo ' '.$dato->nro;
                                 if ($dato->piso!='') echo ' '.$dato->piso;
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
                                     <?php foreach ($dato->rubros as $rubro) {?>
                                        <li<?php echo $class; ?>><?=$rubro->nombre?></li>
                                     <?php   } // end Foreach ?>
                    </ul>
                             <?php } else { // End if $dato->extras ?>
                    <div class="notice">No hay Rubros</div>
                             <?php } ?>
                </td>
                <td>
                             <?php echo html::anchor('/datos/edit/'.$dato->id,
                             html::image(array('src'=>'media/images/application_edit.png','alt'=>'Editar','title'=>'Editar','width'=>'16','height'=>'16', 'align'=>'left'))
                             );?>
                </td>
                <td>
                             <?php echo html::anchor('/datos/delete/'.$dato->id,
                             html::image(array('src'=>'media/images/cancel.png','alt'=>'Borrar', 'title'=>'Borrar','width'=>'16','height'=>'16', 'align'=>'left'))
                             );
                             ?>
                </td>
            </tr>

                 <?php } ?>

        </tbody>
    </table>
         <?php if(isset($pagination)) echo $pagination ?>
     <?php
     } else {?>
    <div class="error">No hay datos por favor cargue alguno</div>
     <?php }

     ?>
</div>