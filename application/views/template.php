<!DOCTYPE HTML>
<html lang="es-AR">
    <head>
        <title><?php echo " :: ".html::specialchars($title)." :: " ?></title>
        <meta charset="UTF-8">
        <?php echo html::stylesheet(
        array('media/css/960-reset','media/css/text','media/css/estructura2' ),
        array ( 'screen','screen','screen'));

        echo html::script('http://cdn.jquerytools.org/1.1.2/jquery.tools.min.js');
        echo html::script('media/script/tablesorter/jquery.tablesorter.min.js');
        ?>
    </head>
    <body>

        <div id="container" class="container_16 data">
            <div id="hd" class="grid_16">
                <h1><?php echo html::image(array('src'=>'media/images/imglistados-blanco.png',
                    'alt'=>'IMGListados','width'=>'200','height'=>'85', 'align'=>'left')); ?>
                    <?php echo $title; ?></h1>

                <?php if (isset($user)) echo $user; ?>
            </div>
            <div  class="grid_16">
                <ul id="menu">
                    <?php foreach ($links as $link => $url): ?>

                    <?php
                    $class = '';
                    if (isset($controller)) {
                        
                        if (strtolower($url)==strtolower($controller)){
                            $class = array('class'=>'active');
                        } else {
                            $class = '';
                        }
                    }
                    ?>
                    <li><?php echo html::anchor($url, $link, $class);  ?></li>
                    <?php endforeach ?>
                </ul>
            </div>



            
            <? if (isset($errors)) { ?><!-- Si hay errores los muestra -->

            <div class="error">
                    <?=html::image(array('src'=>'media/images/cross.png','alt'=>'Error','align'=>'right','width'=>'16','height'=>'16'))?>
                <ul>
                        <?php foreach ($errors as $error): ?>
                    <li><?php echo $error ?></li>
                        <?php endforeach ?>
                </ul>
            </div>

                <?php } ?>
            
            <? if (isset($messages)) { ?><!-- Si hay Mensajes los muestra -->

            <div class="success">
                <ul>
                        <?php foreach ($messages as $message): ?>
                    <li><?php echo $message ?></li>
                        <?php endforeach ?>
                </ul>
            </div>

                <?php } ?>


            <div class="grid_16">
                <!-- Data -->
                <?php echo $data;?>
                <!-- End Data -->
            </div>

            <div class="clearfix"></div>

            <div id="ft">
                <?php echo $footer; ?>
            </div>
        </div>


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
                $("table img[title]").tooltip({

                    // each trashcan image works as a trigger
                    tip: '#tooltip',

                    // custom positioning
                    position: 'center left',

                    // move tooltip a little bit to the right
                    offset: [0, 0],

                    // do not initialize tooltips until they are used
                    lazy: true,

                    // there is no delay when the mouse is moved away from the trigger
                    delay: 0
                });
            });
            -->
            //]]>
        </script>
        <script type="text/javascript"><!--//--><![CDATA[//><!--
            startList = function() {
                if (document.all&&document.getElementById) {
                    navRoot = document.getElementById("nav");
                    for (i=0; i<navRoot.childNodes.length; i++) {
                        node = navRoot.childNodes[i];
                        if (node.nodeName=="LI") {
                            node.onmouseover=function() {
                                this.className+=" over";
                            }
                            node.onmouseout=function() {
                                this.className=this.className.replace(" over", "");
                            }
                        }
                    }
                }
            }
            window.onload=startList;

            //--><!]]></script>
    </body>
</html>