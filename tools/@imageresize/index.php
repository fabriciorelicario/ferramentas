<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" >
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
        <meta name="robots" content="noindex" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="generator" content="myTools! - Image Resize" />
        <title>Imageresize</title>
        <link href="css/system.css" rel="stylesheet" />
        <!--<link href="css/system-joomla.css" rel="stylesheet" />-->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/jquery.crop.css" rel="stylesheet" />
        <link href="css/bootstrap-fileupload.css" rel="stylesheet" />

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.form.js" type="text/javascript"></script>
        <script src="js/jquery.crop.js" type="text/javascript"></script>
        <script src="js/jquery.color.js" type="text/javascript"></script>
        <script src="js/core.js" type="text/javascript"></script>
        <script src="js/form.js" type="text/javascript"></script>
        
        <style>
            #hero-unit {margin-bottom: 30px;}
                #output {position: relative;background-color: #00FF01;}
                #output:before {content:attr(dataw);position: absolute;bottom: -20px;left: 50%;color: #00FF01}
                #output:after {content:attr(datah);position: absolute;right: -30px;transform: rotate(90deg);top: 50%;color: #00FF01;}
        </style>

    </head>
    <body>
        
        <div class="panel panel-inverse" style="border-radius: 0px;border-color: transparent;">
            <div class="panel-heading" style="border-radius: 0px;background-color: #A42258;border-color: #A42258;color: #ffffff">
                <h3 class="panel-title">Image Resize</h3>
            </div>
            <div class="panel-body">
                <div id="system-messages"></div>
                <div class="col-xs-3 col-sm-2">
                    <div class="well-clean sidebar-nav">
                        <ul class="nav">
                            <li id="tools">
                                <div>
                                    <h3 class="page-header">Dimensões</h3>
                                    <ul class="nav">
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="size-options" id="size-options1" value="426X300">
                                                    Slideshow Intranet
                                                    <p>(426x300)</p>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="size-options" id="size-options2" value="625X384">
                                                    Slideshow Site
                                                    <p>(625x384)</p>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="size-options" id="size-options3" value="280X150">
                                                    Destaques Intranet
                                                    <p>(280x150)</p>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="size-options" id="size-options3" value="199X115">
                                                    Newsletter normal
                                                    <p>(199x115)</p>
                                                </label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="size-options" id="size-options3" value="299X115">
                                                    Newsletter larga
                                                    <p>(299x115)</p>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-xs-9 col-sm-10">
                    <div class="bs-example bs-example-type bs-example-clean" title="Fazer upload de fotos">
                        <form id="photoForm" name="photoForm" method="post" action="progress.php" enctype="multipart/form-data">

                            <div class="hero-unit" id="hero-unit"> 
                                <div id="input">
                                    <h1><span class="glyphicon glyphicon-picture"></span></h1>
                                    <p>Selecione uma  foto para redimensionar.</p>
                                </div>
                                
                                <div id="output"></div>

                                <div id="progress">
                                    <div class="progress progress-striped active">
                                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="" role="progressbar" class="progress-bar"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="hero-unit">
                                <span class="btn btn-file btn-inverse">
                                    <span class="fileupload-new">Selecionar uma foto do computador</span>
                                    <span class="fileupload-exists">Escolher outra</span>
                                    <input type="file" name="image" id="image" />
                                </span>
                                <!--<a id="dimension" href="javascript:;" class="btn fileupload-exists btn-info"><span class="glyphicon glyphicon-compressed"></span>Redimensionar</a>-->
                                <a id="remove" href="javascript:;" class="btn fileupload-exists btn-danger">Cancelar</a>
                            </div>
                        </div>

                        <div class="highlight highlight-clean">

                            <div class="bs-callout bs-callout-warning">
                                <blockquote style="border-left: none; padding: 0;">
                                    <p class=""><span class="glyphicon glyphicon-picture"></span> Observação:</p>
                                    <small>Os tipos de imagens permitidos são: "gif", "jpeg", "jpg", "png".</small>
                                    <small>A imagem deve ter ser de no máximo 10MB.</small>
                                    <small><span style="background-color: #00FF01;padding: 0px 5px;">&nbsp;</span> Indica altura e largura da imagem.</small>
                                </blockquote>
                            </div>
                        </div>
                    </form>

<!--                    <form id="adminForm" name="adminForm" method="post" action="controller.php" enctype="multipart/form-data">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />

                        <input type="hidden" name="width" id="width" value="" />
                        <input type="hidden" name="height" id="height" value="" />
                        <input type="hidden" name="tmp_image" id="tmp_image" value="" />
                        <input type="hidden" name="usu_id" id="usu_id" value="1" />
                        <input type="hidden" name="hot_id" id="hot_id" value="2" />
                        <input type="hidden" name="task" id="task" value="" />
                    </form>-->

                </div>
            </div>
        </div>
    </body>
</html>