<?php if ($rubros->count()>0) { ?>
<div class="yui-b data">
    <!-- Muestra los rubros -->
    <ul>
            <?php foreach ($rubros as $rubro): ?>
        <li><?php echo $rubro->nombre ?>
            <a href="#"><?=html::image(array('src'=>'media/images/cancel.png',
                            'alt'=>'Borrar','title'=>'Borrar ',
                            'width'=>'16','height'=>'16'))?></a>
        </li>
            <?php endforeach ?>
    </ul>
</div>
<?php } ?>
<div class="yui-b data">
    <!-- Formulario de Carga de Datos -->
    <?=form::open(NULL, array("class"=>"cmxform"))?>
    <?=form::label('rubro','Rubro')?>
    <?=form::hidden('dato_id',$form['dato_id'])?>
    <?=form::dropdown('rubro_id',$form['rubros'], $form['seltipo'])?>
    <?=form::submit(NULL,"Agregar", 'class="awesome small green"')?>
    <?=form::close()?>
    <ul>
        <?php if (isset($_SESSION['urledit'])) {?>
        <li><?php echo html::anchor($_SESSION['urledit'], 'Finalizar carga',array('class'=>'awesome medium blue')) ?></li>
        <?} else { ?>
        <li><?php echo html::anchor('datos', 'Finalizar carga',array('class'=>'awesome medium blue')) ?></li>
        <? } ?>
    </ul>

</div>