<div class="yui-b data"><div class="yui-g">
        <div class="yui-u first">
            <ul id="menulist">
                <!-- <li><a href="#">Listar por Dato</a></li>
		<li><a href="#">Listar por Rubro</a></li>-->
                <li><a href="<?=url::site();?>datos/add" class="awesome medium yellow">Agregar un Dato</a></li>
            </ul>
        </div>
        <div class="yui-u right">
            <form action="" method="GET" class="cmxform">
                <input type="text" size="30" name="searchstring" value="<?php if(isset($searchstring)) echo $searchstring; else echo "Buscar por nombre, calle o ciudad" ;?>" />
                <input type="submit" value="Buscar" name="submit" />
            </form>
        </div>
    </div>
</div>
<div id="orden" class="yui-b data">
    <ul>

        <li<?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] =='fechamodificado') echo ' class="active"'; ?> ><a href="<?=url::base();?><?=url::current();?>?orden=fechamodificado">Ultima modificación</a></li>
        <li<?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] =='nombre') echo ' class="active"'; ?>><a href="<?=url::base();?><?=url::current();?>?orden=nombre">Alfabético</a></li>
        <li<?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] =='calle') echo ' class="active"'; ?>><a href="<?=url::base();?><?=url::current();?>?orden=calle">Dirección</a></li>

    </ul>
</div>