<div class="grid_8 alpha">
    <h3>Datos Empresa</h3>
    <!-- Formulario de Carga de Datos -->
    <?= form::open(NULL, array("class" => "cmxform")) ?>
    <?= form::open_fieldset(); ?>
    <?= form::legend('Datos Empresa'); ?>
    <?= form::hidden("id", $form['id']) ?>
    <?php
    /** Muestra el ID para saberque nombre le ponemos al logo */
    if ( $form['id']!==0) { ?>
        <h5>Codigo:<?php echo $form['id'];?></h5>
    <?php } ?>

    <label for="categoria_id"> Categoria:</label><br />
    <?= form::dropdown('categoria_id', $form['categoria_id'], $form['selcat']); ?><br />
    <label for="nombre"> Nombre: </label><br />
    <?= form::input(array("id" => "nombre", "name" => "nombre", "title" => "Nombre", "class" => "input_full", "value" => $form['nombre'])) ?><br/>
    <label for="calle"> Calle:</label><br />
    <?= form::input(array("id" => "calle", "name" => "calle", "title" => "Calle", "class" => "input_full", "value" => $form['calle'])) ?><br />
    <label for="nro">Nro:  </label><br />
    <?= form::input(array("id" => "nro", "name" => "nro", "title" => "Nro", "class" => "input_small", "value" => $form['nro'], "type" => "number")) ?><br />
    <label for="piso"> Piso: </label><br />
    <?= form::input(array("id" => "piso", "name" => "piso", "title" => "Piso", "class" => "input_tiny", "value" => $form['piso'], "type" => "number")) ?><br />
    <label for="depto">Depto:</label><br />
    <?= form::input(array("id" => "depto", "name" => "depto", "title" => "Departamento", "class" => "input_tiny", "value" => $form['depto'])); ?><br />
    <label for="localidad_id"> Localidad:</label><br />
    <?= form::dropdown('localidad_id', $form['localidad_id'], $form['selloc']) ?>
    <?= form::close_fieldset(); ?>

    <?= form::open_fieldset(); ?>
    <?= form::legend('Opciones'); ?>
    <?php
    // echo form::label('destacado', '¿Destacado?');
    //                 if ($form['destacado']!=0) {
    //                     $checked = TRUE;
    //                    } else {
    //                     $checked = FALSE;
    //                    }
    ?>
    <ul>
        <li><label for="destacado"> <?php echo form::checkbox('destacado', 1, (bool) $form['destacado']); ?>¿Destacado?</label></li>
        <li> <label for="destaweb"> <?php echo form::checkbox('destaweb', 1, (bool) $form['destaweb']); ?>¿Logo Web?</label></li>
    </ul>



    <?= form::close_fieldset(); ?>
    <?= form::submit('submit', "Actualizar", 'class="awesome big green"') ?>
    <?= form::close() ?>

</div> <!-- Fin Border -->

<div class="grid_8 omega">
    <h3>Extras</h3>
    <a href="<?= url::site() ?>datos/newextra/<?= $form['id'] ?>" class="awesome medium orange" >Agregue un Extra</a>
    <?php if ($extras->count() > 0) {
    ?>
        <table id="tablesorter" class="nice">
            <thead><tr><th>Tipo</th><th>Dato</th><th colspan="2">Acciones</th></tr></thead>
            <tbody>
            <?php foreach ($extras as $extra) {
            ?>
                <tr>
                    <td><strong><?= $extra->tipo->label ?></strong>:</td>
                    <td><?= $extra->contenido ?></td>
                    <td>
                    <?php
                    echo
                    html::anchor('/datos/editextra/' . $extra->id,
                            html::image(array('src' => 'media/images/application_edit.png', 'alt' => 'Editar', 'title' => 'Editar', 'width' => '16', 'height' => '16', 'align' => 'left'))
                    );
                    ?>
                </td>
                <td>
                    <?php
                    echo

                    html::anchor('/datos/deleteextra/' . $extra->id,
                            html::image(array('src' => 'media/images/cancel.png', 'alt' => 'Borrar', 'title' => 'Borrar', 'width' => '16', 'height' => '16', 'align' => 'left'))
                    );
                    ?>
                </td>
            </tr>

            <?
                } // end Foreach
            ?>
            </tbody>
        </table>
    <?php } else { // End if $extras
    ?>
                <div class="notice">Los datos de esta persona / empresa están incompletos, por favor cargue algunos</div>
    <?php } ?>

        </div> <!-- fin border -->

        <div class="clearfix"></div>

        <div class="grid_8 alpha">
            <h3>Rubros <a href="<?= url::site() . "datos/addrubro/" . $form['id'] ?>" class="awesome medium orange">Agregue un Rubro</a>
 </h3>
         <?php
            if ($rubros->count() > 0) {
                echo form::open('rubros/principal');
                echo form::hidden("dato_id", $form['id']);
    ?>
                <ul class="listadeitems">
        <?php
                foreach ($rubros as $rubro) {
                    //echo kohana::debug($rubro)
                    foreach ($rubro->where('dato_id', $form['id'])->datos_rubro as $datos_rubro) {
                        if ($datos_rubro->position == 1) {
                            $ppal = true;
                        } else {
                            $ppal = NULL;
                        }
                    } ?>
                    <li>
                        <label for="<?php echo $rubro->nombre; ?>"><?php echo $rubro->nombre; ?></label>
                             <?php echo form::radio(array('name'=>'rubroPrincipal', 'id'=>$rubro->nombre), $rubro->id, $ppal); ?>
                <?php
                    echo ' ' . html::anchor('/datos/delrub/' . $rubro->id . '/' . $this->uri->segment(3),
                            html::image(array('src' => 'media/images/cancel.png', 'alt' => 'Borrar ' . $rubro->nombre,
                                'title' => 'Borrar ' . $rubro->nombre,
                                'width' => '16', 'height' => '16', 'class' => 'delrubro'))
                    );
                ?>
            <?php
                    //echo form::radio('rubroPrincipal', $rubro->id, $ppal );
                    //echo $rubro->datos_rubro->id;
            ?>

                </li>
        <?
                } // end Foreach
        ?>
            </ul>
    <?php
                echo form::submit('submit', 'Actualizar Rubros', 'class="awesome small blue"');
                echo form::close();
            } else { // End if $extras
    ?>
                <div class="notice">Los datos de esta persona / empresa están incompletos, por favor cargue algunos</div>
    <?php } ?>

        </div> <!-- fin border -->

        <div class="grid_8 omega">
            <h3>Datos administrativos</h3>
        </div>
        <div class="clearfix"></div>
<?php echo html::anchor($volveratras, "&laquo; Volver al Listado", array('class' => 'awesome big blue')); ?>
