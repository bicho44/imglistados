 <?php
 //Menu Calles
 if (isset($menu)) echo $menu;
 ?>

<div class="yui-b data">
    <!-- YOUR DATA GOES HERE -->
     <?php $base = url::base(); ?>
     <?php if ($rubros->count()>0) {?>
     
         <?php echo $pagination ?>
    <table id="tablesorter" class="mensajes">
        <thead><tr><th>Nombre</th><th colspan="2">Acciones</th></tr></thead>
        <tbody>
                 <?php
                 foreach ($rubros as $rubro) {?>
            <tr>
                <td>
                             <?=$rubro->nombre?>
                </td>
                <td>
			[edit]
                </td>
                <td>
			[del]
                </td>
            </tr>
                 <?php } ?>
        </tbody>
    </table>
         <?php echo $pagination ?>
     <?php } else { // fin si hay rubros ?>
    <h3 class="notice">No hay datos por favor cargue alguno</h3>
     <?php } // fin si no hay datos?>
</div>
