<?php
//Menu Datos
if (isset($menu)) echo $menu;
?>



<!-- Formulario de Carga de Datos -->
<?=form::open(NULL, array("class"=>"cmxform"))?>
<?=form::hidden("id",$form['id'])?>
<?=form::label('rubro_id','Rubro Padre')?>
<?=form::dropdown('rubro_id',$form['rubro_id'], $form['seltipo'])?><br />

<?=form::label('rubro','Rubro')?>
<?=form::input(array("id"=>"nombre","name"=>"nombre",
        "title"=>"Rubro", "size"=>"24", "value"=>$form['nombre']))?><br/>

<?=form::submit('submit',"Actualizar Rubro", 'class="awesome medium green"')?>
<?=form::close()?>


