<div class="yui-b data">
    <h3>Extras</h3>
</div>
<?php if (is_object($extras)) { ?>
<div class="yui-b data">
    <!-- Muestra las extras -->
    <ul>
            <?php foreach ($extras as $extra): ?>
        <li><?php echo '<strong>'.$extra->tipo->label.'</strong>: '.$extra->contenido ?>
            <!-- <a href="/datos/deleteextra/<?=$extra->id?>">
                    <?=html::image(array('src'=>'media/images/cancel.png',
                        'alt'=>'Borrar '.$extra->tipo,
                        'title'=>'Borrar '.$extra->tipo,
                        'width'=>'16','height'=>'16'))?></a> -->
        </li>
            <?php endforeach ?>
    </ul>
</div>
<?php } ?>
<div class="yui-b data">

    <!-- Formulario de Carga de Datos -->
    <?=form::open(NULL, array("class"=>"cmxform"))?>

    <?php
    //var_dump($form['tipo']);
    foreach ($form['tipo'] as $id=>$name) {
        echo form::label('contenido['.$name.']',ucfirst($name))."<br />";
        echo form::input(array("id"=>$name,"name"=>'contenido['.$id.']',
        "title"=>$name, "size"=>"30", "value"=>$form['contenido'][$name]));
        //echo html::image(array('src'=>'media/images/cancel.png','alt'=>'borrar','title'=>'Borrar','width'=>'16','height'=>'16'));
        echo "<br/>";
    }
    //	 echo form::label('otro','Otro');
    //	 echo form::dropdown('tipo',$form['tipo']);
    //	 echo form::input(array("id"=>$name,"name"=>$name, "title"=>$name, "size"=>"30", "value"=>''));
    //	echo "<br/>";
    ?>
    <?php echo form::hidden("dato_id", $form['dato_id']);?>
    <?php if (!isset($_SESSION['urledit'])) {?>
        <?php echo form::submit('submit',"Continuar", 'class="awesome medium green"');?>
        <?php echo html::anchor( url::site()."datos/addrubro/".$form['dato_id'],
            "Agregue Rubro", array('class'=>'awesome medium orange'));?>
    <?php } else { ?>
        <?php echo form::submit('submit',"Aceptar", 'class="awesome medium green"')?>
    <?php }?>
    <?php echo form::close()?>
</div>
