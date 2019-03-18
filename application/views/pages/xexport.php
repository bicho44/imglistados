
    <!-- YOUR DATA GOES HERE -->
    <?=form::open(NULL, array("class"=>"cmxform"))?>
    <div class="yui-g">
        <div class="yui-u first">
            <div class="border">
                <?=form::open_fieldset();?>
                <?=form::legend('Listados');?>
                <?=form::label('tipo_listado', 'Alfabético: '.form::radio('tipo_listado', 'alfabetico', TRUE))?>
                <?=form::label('tipo_listado', 'Rubros: '.form::radio('tipo_listado', 'rubros'))?>
                <?=form::label('tipo_listado', 'E-Mails y Web: '.form::radio('tipo_listado', 'mailwebs'))?>
                <?=form::label('tipo_listado', 'Emails: '.form::radio('tipo_listado', 'mails'))?>
                <?=form::label('tipo_listado', 'Webs: '.form::radio('tipo_listado', 'webs'))?>
                <?=form::label('tipo_listado', 'Indice Temático de Rubros: '.form::radio('tipo_listado', 'tematicos'))?>
                <?=form::close_fieldset();?>
                
                <?=form::open_fieldset();?>
                <?=form::legend('Tipo de Listados');?>
                <?=form::label('categoria_id', 'Categoria '.form::dropdown('categoria_id',$categoria,$_SESSION['cat']))?>
                <?=form::label('localidad_id','Ciudad: '.form::dropdown('localidad_id',$localidad,$_SESSION['localidad']))?>
                <?=form::close_fieldset();?>
            </div>
        </div>
        <div class="yui-u">
            <div class="border">
                <?=form::open_fieldset();?>
                <?=form::legend('Opciones');?>
                <?=form::label('marc_left', 'Separadores')?>
                <?=form::input('marc_left', '<', ' size="3"');?>
                <?=form::input('marc_right', '>', ' size="3"');?><br />
                <?=form::label('cut_rubro', 'Rubro Max: '.form::input('cut_rubro', 30, ' size="3"'))?>
                <?=form::label('archivo', 'Archivo '.form::input('archivo', NULL, ' size="20"'))?>
                <?=form::close_fieldset();?>
            </div>
        </div>


    </div>
    <?=form::submit('submit',"Exportar",'class="awesome big green"')?>
    <?=form::close()?>

