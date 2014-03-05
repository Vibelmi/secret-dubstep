<!DOCTYPE html>
<!-- Camera is a Pixedelic free jQuery slideshow | Manuel Masia (designer and developer) --> 
<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--///////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //		Styles
        //
        ///////////////////////////////////////////////////////////////////////////////////////////////////--> 
        <link rel='stylesheet' id='camera-css'  href='modules/slider/css/camera.css' type='text/css' media='all'> 
        <style>


            #back_to_camera {
                clear: both;
                display: block;
                height: 80px;
                line-height: 40px;
                padding: 20px;
            }
            .fluid_container {
                margin: 0 auto;
                max-width: 1000px;
                width: 90%;
            }
        </style>

        <!--///////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //		Scripts
        //
        ///////////////////////////////////////////////////////////////////////////////////////////////////--> 

        <script type='text/javascript' src='modules/slider/scripts/jquery.min.js'></script>
        <script type='text/javascript' src='modules/slider/scripts/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='modules/slider/scripts/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='modules/slider/scripts/camera.min.js'></script>  
        <script>
            jQuery(function() {
                jQuery('#camera_wrap_2').camera({
                    height: '400px',
                    loader: 'pie',
                    pagination: false,
                    thumbnails: true,
                    portrait: true
                });
            });
        </script>
    </head>
    <body>  
        <div class="camera_wrap camera_turquoise_skin" id="camera_wrap_2">

            <?php
            //With this code i get all the jpg from the dir selected.
            //In the future opendir should get the url from database.
            $dir = opendir('modules/slider/images/slides');
            while ($archivo = readdir($dir)) {
                if (strstr($archivo, ".jpg")) {
                    ?>
                    <div data-thumb="<?php echo ('modules/slider/images/slides/thumbs/' . $archivo) ?>" data-src="<?php echo ('modules/slider/images/slides/' . $archivo) ?>">
                        <div class="camera_caption fadeFromBottom">
                            <!--Edit for get messages from DB or XML-->
                            This is a description of the image, <em>this is optional</em>
                        </div>
                    </div>   

                    <?php
                }
            }
            closedir($dir);
            ?>
        </div><!-- #camera_wrap_2 -->
        <div style="clear:both; display:block; height:0px"></div>
    </body> 
</html>