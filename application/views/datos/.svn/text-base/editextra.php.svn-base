<?php
/* 
 * editextra.php
 *
 * formulario para la edición de un extra del dato
 */
?>
<div class="yui-b data">

    <?=form::open(NULL, array("class"=>"cmxform"))?>
    <?=form::hidden("id",$form['id'])?>
    <?=form::hidden("dato_id",$form['dato_id'])?>

    <?=form::label('tipo','Tipo');?>
    <?=form::dropdown('tipo',$form['tipo'], $form['seltipo']);?>
    <?=form::input(array("id"=>'contenido',"name"=>'contenido',
        "title"=>'contenido', "size"=>"30", "value"=>$form['contenido']));?>
    <?=form::submit(NULL,"Actualizar")?>
    <?=form::close()?>
</div>