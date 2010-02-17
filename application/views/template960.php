<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!--<link rel="stylesheet" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css" />-->
        <title><?php echo " :: ".html::specialchars($title)." :: " ?></title>
        <?php echo html::stylesheet(array
        (
        'media/css/reset-fonts','media/css/estructura',
        ),
        array
        (
        'screen','screen',
        ));
        echo html::script('http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js');
        echo html::script('media/script/tablesorter/jquery.tablesorter.min.js');
        //echo html::script('media/script/tiny_mce/tiny_mce.js');
        //echo html::script('media/scripts/jtip2.js');
        ?>
    </head>
    <body>
        <script type="text/javascript">
            //<![CDATA[
            <!--
            $(document).ready(function()
            {
                $("#tablesorter").tablesorter( {
                    widgets: ['zebra']
                } );
                $('input[name=searchstring]').focus(function()
                {
                    $(this).val("");
                });
                $("#datos img[title]").tooltip({
                    
                // each trashcan image works as a trigger 
        tip: '#tooltip', 
 
        // custom positioning 
        position: 'center right', 
 
        // move tooltip a little bit to the right 
        offset: [0, 8],
 
        // do not initialize tooltips until they are used 
        lazy: true, 
 
        // there is no delay when the mouse is moved away from the trigger 
        delay: 0 
            });
            });
            -->
            //]]>
        </script>
        <div id="doc4" class="yui-t4">
            <div id="hd">
                <h1><?=html::image(array('src'=>'media/images/imglistados-blanco.png','alt'=>'IMGListados','width'=>'200','height'=>'85', 'align'=>'left'))?>
                <?=$title?></h1>
                <?php if (isset($user)) echo $user; ?>
            </div>
            <div id="bd">
                <div id="yui-main">
                    <!-- Si hay errores los muestra -->
                    <? if (isset($errors)) { ?>
                    <div class="yui-b data">
                        <div class="error">
                                <?=html::image(array('src'=>'media/images/cross.png','alt'=>'Error','align'=>'right','width'=>'16','height'=>'16'))?>
                            <ul>
                                    <?php foreach ($errors as $error): ?>
                                <li><?php echo $error ?></li>
                                    <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- Si hay errores los muestra -->
                    <? if (isset($messages)) { ?>
                    <div class="yui-b data">
                        <div class="success">
                            <ul>
                                    <?php foreach ($messages as $message): ?>
                                <li><?php echo $message ?></li>
                                    <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- $data recibe la grilla de yahoo o lo que sea -->
                    <div class="yui-b data">
                        <h2><?php echo $title;?></h2>
                    </div>
                    <?=$data?>

                </div>
                <div class="yui-b navigator">
                    <!-- YOUR NAVIGATION GOES HERE -->
                    <div id="navcontainer">
                        <h3>Menu</h3>
                        <ul>
                            <?php foreach ($links as $link => $url): ?>
                            <li><?php echo html::anchor($url, $link) ?></li>
                            <?php endforeach ?>
                        </ul>
                        <h3>Categorias</h3>
                        <ul>
                            <?php
                            foreach ($cats as $cat => $url): ?>
                                <?php if ($_SESSION['cat'] == $cat) {
                                    $class= array('class'=>'current') ;
                                } else {
                                    $class = array();
                                }
                                ?>
                            <li><?php echo html::anchor('datos/?cat='.$cat, $url, $class) ?></li>
                            <?php endforeach ?>
                        </ul>

                        <h3>Localidades</h3>
                        <ul>
                            <?php
                            foreach ($localidades as $loc => $url): ?>
                                <?php if ($_SESSION['localidad'] == $loc) {
                                    $class= array('class'=>'current') ;
                                } else {
                                    $class = array();
                                }
                                ?>
                            <li><?php echo html::anchor('datos/?localidad='.$loc, $url, $class) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php //echo $login; ?>
                </div>
            </div>
            <div id="ft">
                <?=$footer?>
            </div>
        </div>
    </body>
</html>