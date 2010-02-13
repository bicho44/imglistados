<div class="yui-b data">
    <!-- Formulario de Carga de Datos -->
    <?=form::open(NULL, array("class"=>"cmxform"))?>

    <?=form::open_fieldset()?>

    <?=form::legend('Datos Empresa',array('id' => 'opciones'))?>
    <?=form::label('categoria_id','Categoria')?>
    <?=form::dropdown('categoria_id',$form['categoria_id'],$form['selcat'])?><br />
    <?=form::label("nombre")?>
    <?=form::input(array("id"=>"nombre","name"=>"nombre", "title"=>"Nombre", "size"=>"40", "value"=>$form['nombre']))?><br/>
    <?=form::label("calle y nro")?>
    <?=form::input(array("id"=>"calle","name"=>"calle", "title"=>"Calle", "size"=>"33", "value"=>$form['calle']))?>
    <?=form::input(array("id"=>"nro","name"=>"nro", "title"=>"Nro","size"=>"4", "value"=>$form['nro']))?><br/>
    <?=form::label("piso y depto")?>
    <?=form::input(array("id"=>"piso","name"=>"piso", "title"=>"Piso","size"=>"4", "value"=>$form['piso']))?>
    <?=form::input(array("id"=>"depto","name"=>"depto","title"=>"Departamento", "size"=>"4", "value"=>$form['depto']))?><br/>
    <?=form::label('localidad_id','Localidad')?>
    <?=form::dropdown('localidad_id',$form['localidad_id'],$form['selloc'])?>
    <?=form::close_fieldset()?>


    <?=form::open_fieldset()?>
    <?=form::legend('Opciones',array('id' => 'opciones'))?>
    <!--
    <?=form::label('negrita', '¿Negrita?')?>
    <?=form::checkbox('negrita', 'negrita')?>
    -->
    <?=form::label('destacado', '¿Destacado?')?>
    <?=form::checkbox('destacado', 'destacado')?>
    <?=form::close_fieldset()?>


    <?=form::submit(NULL,"Siguiente")?>
    <?=form::close()?>

</div>