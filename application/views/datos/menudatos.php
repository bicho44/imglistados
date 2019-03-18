<div class="grid_16 clearfix">
    <ul id="menulist">
        <li><a href="<?= url::site(); ?>datos/add" class="awesome medium yellow">Agregar un Dato</a></li>
    </ul>
</div>

<div id="orden" class="grid_16 clearfix">
    <div class="grid_8 alpha">
         <ul>
         <li <?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] == 'fechamodificado')
    echo ' class="active"'; ?> ><a href="<?= url::base(); ?><?= url::current(); ?>?orden=fechamodificado">Ultima modificación</a></li>
        <li<?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] == 'nombre')
    echo ' class="active"'; ?>><a href="<?= url::base(); ?><?= url::current(); ?>?orden=nombre">Alfabético</a></li>
        <li<?php if (isset($_SESSION['orden']) AND $_SESSION['orden'] == 'calle')
    echo ' class="active"'; ?>><a href="<?= url::base(); ?><?= url::current(); ?>?orden=calle">Dirección</a></li>
        </ul>
    </div>

    <div class="grid_8 omega">
        <form id="search" action="" method="GET">
            <input type="text" size="50" name="searchstring"
                   value="<?php if (isset($searchstring))
    echo $searchstring; else
    echo "Buscar por nombre, calle o ciudad"; ?>" />
            <input type="submit" value="Buscar" class="awesome small green" name="submit" />
        </form>
    </div>
</div>