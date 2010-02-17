 <?php //Menu Rubros
 if (isset($menu)) echo $menu; ?>

    <!-- YOUR DATA GOES HERE -->
     <?php $base = url::base(); ?>

     <?php if ($rubros->count()>0) { ?>
         <?php if(isset($pagination)) echo $pagination ?>

    <table id="tablesorter" class="mensajes">
        <thead><tr><th>Label</th></tr></thead>
        <tbody>
                 <?php
                 foreach ($rubros as $rubro) {?>
            <tr class="rubro">
                <td>
                             <?=html::anchor('/rubros/view/'.$rubro->id,$rubro->nombre )?>

                             <?php echo
                             html::anchor('/rubros/edit/'.$rubro->id,
                             html::image(array('src'=>'media/images/application_edit.png','alt'=>'Editar','title'=>'Editar','width'=>'16','height'=>'16'))
                             );

                             ?>

                             <?php echo

                             html::anchor('/rubros/delete/'.$rubro->id,
                             html::image(array('src'=>'media/images/cancel.png','alt'=>'Borrar', 'title'=>'Borrar','width'=>'16','height'=>'16'))
                             );

                             ?>
                </td>
            </tr>
                     <?php if ($rubro->datos->count()>0) { ?>
            <tr>
                <td>
                    <ul>
                                     <?php foreach($rubro->datos as $dato) { ?>
                        <li>
                                             <?php echo html::anchor('/datos/edit/'.$dato->id, $dato->nombre); ?>
                                             <?php echo html::anchor('/datos/edit/'.$dato->id,
                                             html::image(array('src'=>'media/images/application_edit.png','alt'=>'Editar','title'=>'Editar','width'=>'16','height'=>'16'))
                                             );?>
                                             <?php echo html::anchor('/datos/delete/'.$dato->id,
                                             html::image(array('src'=>'media/images/cancel.png','alt'=>'Borrar', 'title'=>'Borrar','width'=>'16','height'=>'16'))
                                             );
                                             ?>
                        </li>
                                     <?php } ?>
                    </ul>
                </td>
            </tr>
                     <?php } ?>
                 <?php } ?>
        </tbody>
    </table>
         <?php if(isset($pagination)) echo $pagination ?>
     <?php } else { // fin si hay rubros ?>
    <h3 class="notice">No hay datos por favor cargue alguno</h3>

     <?php } // fin si no hay datos?>

