<?php
//Menu Rubros
//if (isset($menu))
//    echo $menu;
?>

<!-- YOUR DATA GOES HERE -->
<?php $base = url::base(); ?>

<?php if ($rubros->count() > 0) {
?>
<?php if (isset($pagination))
        echo $pagination; ?>

    <table id="tablesorter" class="nice">
        <thead><tr><th>Label</th><th>Categorias del Rubro</th> <th colspan="2">Acciones</th> </tr></thead>
        <tbody>
        <?php foreach ($rubros as $rubro) {
        ?>
            <tr class="rubro">
                <td>
            <?php
            echo html::anchor('/rubros/view/' . $rubro->id, $rubro->nombre);

            /* @var cant_children Cantidad de subrubros */
            $cant_children = $rubro->children->count();

            /* @var cant_datos Cantidad de Datos */
            $cant_datos = $rubro->datos->count();

            if ($cant_children > 0) {
                echo '<span class="color1">';
                echo " <strong>SubRubros:</strong> " . $cant_children;
                echo '</span>';
            }

            if ($cant_datos > 0) {
                echo '<span class="color2">';
                echo " <strong>Datos:</strong> " . $cant_datos;
                echo '</span>';
            }
        ?>
                <!-- Datos  del Rubro -->
                <?php if ($rubro->datos->count() > 0) { ?>
                    <dl class="datosrubros">
                        <?php foreach ($rubro->datos as $dato) { ?>
                        <dt>
                        <?php echo $dato->nombre; ?>
                        <?php
                        echo html::anchor('/datos/edit/' . $dato->id,
                                html::image(array('src' => 'media/images/application_edit.png',
                                    'alt' => 'Editar', 'title' => 'Editar',
                                    'width' => '16', 'height' => '16')), array( 'class'=>'editar'));
                        ?>
                        <?php
                        echo html::anchor('/datos/delete/' . $dato->id,
                                html::image(array('src' => 'media/images/cancel.png',
                                    'alt' => 'Borrar', 'title' => 'Borrar',
                                    'width' => '16', 'height' => '16')), array( 'class'=>'borrar'));
                        ?>
                    </dt>
                    <dd>
                        <?php
                        if ($dato->calle != '')  echo $dato->calle;
                        if ($dato->nro != 0) echo ' ' . $dato->nro;
                        if ($dato->piso != '')  echo ' ' . $dato->piso . 'p.';
                        if ($dato->depto != '') echo ' ' . $dato->depto;
                        if ($dato->localidad_id != 0)  echo '. ' . $dato->localidad->localidad_nombre . ' (' . $dato->localidad->cod_postal . ')';
                        ?>
                    </dd>
<?php } ?>
                </dl>
<?php } ?>
                <!-- Fin datos del Rubro -->


            </td>
            <td><?php
                if ($rubro->categorias) {
                    $cat_display = "";
                    foreach ($rubro->categorias as $categoria) {
                        $cat_display.= $categoria->catname . ",";
                    }

                    echo substr($cat_display, 0, -1);
                }
?></td>
            <td>
                <?php
                echo html::anchor('/rubros/edit/' . $rubro->id,
                        html::image(array('src' => 'media/images/application_edit.png',
                            'alt' => 'Editar', 'title' => 'Editar',
                            'width' => '16', 'height' => '16')));
                ?>
            </td>
            <td>
                <?php
                echo html::anchor('/rubros/delete/' . $rubro->id,
                        html::image(array('src' => 'media/images/cancel.png',
                            'alt' => 'Borrar', 'title' => 'Borrar',
                            'width' => '16', 'height' => '16')));
                ?>
            </td>
        </tr>
<?php } ?>
        </tbody>
    </table>
<?php if (isset($pagination))
                echo $pagination ?>
<?php } else { // fin si hay rubros ?>
                <h3 class="notice">No hay datos por favor cargue alguno</h3>

<?php } // fin si no hay datos    ?>

