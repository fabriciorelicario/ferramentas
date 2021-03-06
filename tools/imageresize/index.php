<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//'625x384' => '<font color="#3276B1">SITE</font> - Slideshow',

$sizesArr = array(
    '426x300' => '<font color="#0D4772">INTRANET</font> - Slideshow',
    '280x150' => '<font color="#0D4772">INTRANET</font> - Destaques',
	'960x595' => '<font color="#0D4772">INTRANET</font> - Banner',
	'786x418' => '<font color="#3276B1">SITE</font> - Slideshow',
	'1180x632' => '<font color="#3276B1">SITE</font> - Banner',
    '435x260' => '<font color="#3276B1">SITE</font> - Cursos Capa',
    '190x230' => '<font color="#3276B1">SITE</font> - Cursos Min',
    '199x115' => 'Newsletter normal',
    '299x115' => 'Newsletter larga',
    '48x48' => 'Toolbar Icon',
    '16x16' => 'Menu Icon',
	'297x200' => 'Vacinação H1N1',
	'600x800' => '600x800 pixels',
	'600x598' => '600 pixels',
	'500x500' => '500 pixels',
	'350x350' => '350 pixels',
	'256x256' => '256 pixels',
	'128x128' => '128 pixels',
	'64x64' => '64 pixels',
	'64x64' => '64 pixels',
	'48x48' => '48 pixels',
	'32x32' => '32 pixels',
	'24x24' => '24 pixels',
	'16x16' => '16 pixels'
);

if(isset($_GET) && $_GET['size'] != ""){
    $sizeGet = $_GET['size'];
}else{
    $sizeGet = "800x600";
}

list($w, $h) = explode("x",$sizeGet);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
        <meta name="robots" content="noindex" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="generator" content="myTools! - Image Resize" />
        <title>Imageresize</title>

        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/glyphicons.css" rel="stylesheet" />

		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/jquery.cropit.js" type="text/javascript"></script>
        <script src="./js/bootstrap-filestyle.min.js" type="text/javascript"></script>
		

        
        <style>
            .list-group-item.active *, .list-group-item.active:hover *, .list-group-item.active:focus *{
                color: #FFFFFF!important;
            }
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

              .cropited-image{
                  margin-left: auto; 
                  margin-right: auto; 
                  margin-top:70px;
                  border: 5px dashed #ccc;
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

                    <hr />
                    <div class="cropited-image" style="width: <?php echo ($w+11)."px"; ?>; height: <?php echo ($h+11)."px"; ?>;">
                        <iframe id="manualFrame"
                            frameborder="0"
                            style="border:0"
                            allowfullscreen sandbox>
                        </iframe> 
                    <div>
                        
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
      $(function() {
	  //$(document).ready(function() {
        $('.image-editor').cropit({
            imageBackground: true,
			allowDragNDrop: false
        });

        $('.export').click(function() {
            var imageData = $('.image-editor').cropit('export');
            var frame = $("#manualFrame");
            frame.attr("height", '<?php echo $h?>');
            frame.attr("width", '<?php echo $w?>');
            frame.attr("src", imageData);
            //window.open(imageData);
        });
      });
</script>