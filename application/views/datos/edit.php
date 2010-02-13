<div class="yui-b data">
    <div class="yui-g">
        <div class="yui-u first">

            <div class="border">
                <h3>Datos Empresa</h3>
                <!-- Formulario de Carga de Datos -->
                <?=form::open(NULL, array("class"=>"cmxform"))?>
                <?=form::open_fieldset();?>
                <?=form::legend('Datos');?>
                <?=form::hidden("id",$form['id'])?>
                <?=form::label('categoria_id','Categoria')?>
                <?=form::dropdown('categoria_id',$form['categoria_id'],$form['selcat'])?><br />
                <?=form::label("nombre")?>
                <?=form::input(array("id"=>"nombre","name"=>"nombre", "title"=>"Nombre", "size"=>"24", "value"=>$form['nombre']))?><br/>
                <?=form::label("calle y nro")?>
                <?=form::input(array("id"=>"calle","name"=>"calle", "title"=>"Calle", "size"=>"20", "value"=>$form['calle']))?>
                <?=form::input(array("id"=>"nro","name"=>"nro", "title"=>"Nro","size"=>"4", "value"=>$form['nro']))?><br/>
                <?=form::label("piso y depto")?>
                <?=form::input(array("id"=>"piso","name"=>"piso", "title"=>"Piso","size"=>"4", "value"=>$form['piso']))?>
                <?=form::input(array("id"=>"depto","name"=>"depto","title"=>"Departamento", "size"=>"4", "value"=>$form['depto']))?><br/>
                <?=form::label('localidad_id','Localidad')?>
                <?=form::dropdown('localidad_id',$form['localidad_id'],$form['selloc'])?>
                <?=form::close_fieldset();?>


                <?=form::open_fieldset();?>
                <?=form::legend('Destacar');?>
                <?php
                echo form::label('destacado', '¿Destacado?');
                //                 if ($form['destacado']!=0) {
                //                     $checked = TRUE;
                //                    } else {
                //                     $checked = FALSE;
                //                    }
                echo  form::checkbox('destacado', 1, (bool) $form['destacado']);
                ?>
                <?=form::close_fieldset();?>
                <?=form::submit('submit',"Actualizar",'class="awesome big green"')?>
                <?=form::close()?>

            </div> <!-- Fin Border -->
        </div>
        <div class="yui-u">
            <div class="border">
                <h3>Extras</h3>
                    <ul class="menulist">
                        <li><a href="<?=url::site()?>datos/newextra/<?=$form['id']?>" class="awesome medium orange" >Agregue un Extra</a></li>
                    </ul>
                <?php if ($extras->count()>0) { ?>
                <table id="tablesorter" class="mensajes">
                    <thead><tr><th>Tipo</th><th>Dato</th><th colspan="2">Acciones</th></tr></thead>
                    <tbody>
                            <?php
                            foreach ($extras as $extra) {?>
                        <tr>
                            <td><strong><?=$extra->tipo->label?></strong>:</td>
                            <td><?=$extra->contenido?></td>
                            <td>
                                        <?php echo
                                        html::anchor('/datos/editextra/'.$extra->id,
                                        html::image(array('src'=>'media/images/application_edit.png','alt'=>'Editar','title'=>'Editar','width'=>'16','height'=>'16', 'align'=>'left'))
                                        );
                                        ?>
                            </td>
                            <td>
                                        <?php echo

                                        html::anchor('/datos/deleteextra/'.$extra->id,
                                        html::image(array('src'=>'media/images/cancel.png','alt'=>'Borrar', 'title'=>'Borrar','width'=>'16','height'=>'16', 'align'=>'left'))
                                        );

                                        ?>
                            </td>
                        </tr>

                            <?
                            } // end Foreach
                            ?>
                    </tbody>
                </table>
                <?php } else { // End if $extras ?>
                <div class="notice">Los datos de esta persona / empresa están incompletos, por favor cargue algunos</div>
                <?php } ?>

            </div> <!-- fin border -->
        </div>
    </div>
</div>

<div class="yui-b data"><div class="yui-g">
        <div class="yui-u first">
            <div class="border">
                <h3>Rubros</h3>
                    <ul class="menulist">
                        <li><a href="<?=url::site()."datos/addrubro/".$form['id'] ?>" class="awesome medium orange">Agregue un Rubro</a></li>
                    </ul>
                <?php if ($rubros->count()>0) {
                    echo form::open('rubros/principal');
                    echo form::hidden("dato_id",$form['id']);
                    ?>
                <ul>
                        <?php
                        foreach ($rubros as $rubro) {
                        //echo kohana::debug($rubro)
                            foreach ($rubro->where('dato_id',$form['id'])->datos_rubro as $datos_rubro) {
                                if ($datos_rubro->position == 1) {
                                    $ppal = true;
                                } else {
                                    $ppal = NULL;
                                }
                            }?>
                    <li><?php
                            
                            echo form::label('rubroPrincipal', $rubro->nombre);
                            echo form::radio('rubroPrincipal', $rubro->id, $ppal );
                                //echo $rubro->datos_rubro->id;
                                echo ' '.html::anchor('/datos/delrub/'.$rubro->id.'/'.$this->uri->segment(3),
                                html::image(array('src'=>'media/images/cancel.png','alt'=>'Borrar '.$rubro->nombre,
                                'title'=>'Borrar '.$rubro->nombre,
                                'width'=>'16','height'=>'16','valign'=>'center'))
                                );
                                ?>
                    </li>
                        <?
                        } // end Foreach
                        ?>
                </ul>
                    <?php
                    echo form::submit('submit', 'Actualizar Rubros','class="awesome small blue"');
                    echo form::close();
                } else { // End if $extras ?>
                <div class="notice">Los datos de esta persona / empresa están incompletos, por favor cargue algunos</div>
                <?php } ?>

            </div> <!-- fin border -->
        </div>
        <div class="yui-u">
            <div class="border">
                <h3>Datos administrativos</h3>
            </div>
            
                <ul class="menulist">
                    <li><?php echo html::anchor($volveratras, "&laquo; Volver al Listado", array('class'=>'awesome big blue'));?></li>
                </ul>


        </div>
    </div>
</div>