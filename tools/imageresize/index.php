<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$sizesArr = array(
    '426x300' => 'Slideshow Intranet',
    '625x384' => 'Slideshow Site',
    '280x150' => 'Destaques Intranet',
    '199x115' => 'Newsletter normal',
    '299x115' => 'Newsletter larga'
);

if(isset($_GET) && $_GET['size'] != ""){
    $sizeGet = $_GET['size'];
}else{
    $sizeGet = "426x300";
}

list($w, $h) = explode("x",$sizeGet);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" >
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
        <meta name="robots" content="noindex" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="generator" content="myTools! - Image Resize" />
        <title>Imageresize</title>

        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/glyphicons.css" rel="stylesheet" />

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.cropit.js" type="text/javascript"></script>
        <script src="js/bootstrap-filestyle.min.js" type="text/javascript"></script>

        
        <style>
            .cropit-image-preview {
                background-color: #f8f8f8;
                background-size: cover;
                border: 5px solid #ccc;
                border-radius: 3px;
                margin-top: 7px;
                width: <?php echo $w+10; ?>px;
                height: <?php echo $h+10; ?>px;
                cursor: move;
              }

              .cropit-image-background {
                opacity: .2;
                cursor: auto;
              }

              .image-size-label {
                margin-top: 10px;
              }

              input {
                /* Use relative position to prevent from being covered by image background */
                position: relative;
                z-index: 10;
                display: block;
              }

              .export {
                margin-top: 10px;
              }
        </style>

    </head>
    <body>
        <nav class="navbar navbar-inverse" style="margin: 0; border-radius: 0;">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                  <a class="navbar-brand" href="../../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Ferramentas para edição e ajuste de conteúdo para o site e intranet ISGH</a>
              </div>
              <!--/.nav-collapse -->
            </div>
          </nav>
        <div class="panel panel-inverse" style="border-radius: 0px;border: none;">
            <div class="panel-heading" style="border-radius: 0px;background-color: #A42258;border-color: #A42258;color: #ffffff">
                <h3 class="panel-title"><div class="container">Image Resize</div></h3>
            </div>
            <div class="panel-body">
                <div id="system-messages"></div>
                <div class="col-xs-3 col-sm-2">
                    <div class="well-clean sidebar-nav">
                        <ul class="nav">
                            <li id="tools">
                                <div>
                                    <div class="page-header">
                                        <h3>Dimensões</h3>
                                    </div>
                                    <?php include 'sizes.php'; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-xs-9 col-sm-10">
                    <div class="page-header">
                        <h3><?php echo $sizesArr[$sizeGet]; ?> <small>(<?php echo $sizeGet; ?>)</small></h3> 
                    </div>
                    <div class="image-editor" style="text-align: center;">
                        <input type="file" class="cropit-image-input filestyle" data-buttonText="Escolha a Imagem" data-buttonBefore="true" data-iconName="glyphicon-inbox">

                        <!-- .cropit-image-preview-container is needed for background image to work -->
                        
                        <div style="width: <?php echo $w; ?>px; margin-left: auto; margin-right: auto;margin-top: 25px;">
                            <div class="cropit-image-preview-container">
                              <div class="cropit-image-preview"></div>
                            </div>
                            <div class="image-size-label">
                                <span class="glyphicon glyphicon-resize-full"></span>  Redimensionar a imagem
                            </div>
                            <input type="range" class="cropit-image-zoom-input" style="width: <?php echo $w; ?>px;">
                            <div style="position: relative; padding: 25px 0px;">
                                <button class="export btn btn-inverse" style="position: absolute;margin-left: -49px;top: 0"><span class="glyphicon glyphicon-new-window"></span> Exportar</button>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </body>
</html>

<script>
      $(function() {
        $('.image-editor').cropit({
            imageBackground: true
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          window.open(imageData);
        });
      });
    </script>