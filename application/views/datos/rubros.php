<div class="yui-u">
    <!-- Rubros -->
    <?php
    if (is_object($rubros)) {
        if ($rubros->count()>0) {
            foreach ($rubros as $rubro) {

            }
        }
    } else {
        ?>
    <h4 class="notice"> No hay Rubros Asignados </h4>
    <?php }	?>
    <ul><li>[Asignar Rubro]</li></ul>

</div>