<article>
    <!-- Formulario de Carga de Datos -->
    <?=form::open(NULL, array("class"=>"cmxform"))?>

    <?=form::open_fieldset()?>

    <?=form::legend('Datos Empresa',array('id' => 'opciones'))?>
    <label for="categoria_id">Categoría:</label><br /> 
        <?=form::dropdown('categoria_id',$form['categoria_id'],$form['selcat'])?><br />
    <label for="nombre">Nombre: </label><br />
 <?=form::input(array("id"=>"nombre","name"=>"nombre", "title"=>"Nombre", "size"=>"40", "value"=>$form['nombre']))?><br/>
   
    <label for="calle">
        Calle: </label><br />
        <?=form::input(array("id"=>"calle","name"=>"calle", "title"=>"Calle", "size"=>"33", "value"=>$form['calle']))?><br />

    <label for="nro">Nro:</label><br />
        <?= form::input(array("id" => "nro", "name" => "nro", "title" => "Nro", "size" => "4", "value" => $form['nro'], "type"=>"number")) ?><br />
    
    <label for="piso">
        Piso:</label> <br />
        <?= form::input(array("id" => "piso", "name" => "piso", "title" => "Piso", "size" => "4", "value" => $form['piso'], "type"=>"number")) ?><br />
    
    <label for="depto">Depto:</label><br />
        <?= form::input(array("id" => "depto", "name" => "depto", "title" => "Departamento", "size" => "4", "value" => $form['depto'])); ?><br />
    
    <label for="localidad">Localidad:</label> <br />
<?=form::dropdown('localidad_id',$form['localidad_id'],$form['selloc'])?>
    
   
    <?=form::close_fieldset()?>


    <?=form::open_fieldset()?>
    <?=form::legend('Opciones',array('id' => 'opciones'))?>
    <!--
    <?=form::label('negrita', '¿Negrita?')?>
    <?=form::checkbox('negrita', 'negrita')?>
    -->
    <label for="destacado">¿Dato Destacado? <?=form::checkbox('destacado', 'destacado')?></label>
    
    <?=form::close_fieldset()?>


    <?=form::submit(array('type'=>'submit','value'=>'Siguiente', 'class'=>'awesome green medium'));?>
    <?=form::close()?>

</article>