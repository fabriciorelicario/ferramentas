<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'configuration.php';

function clearTitle($str) {
    $str = utf8_encode($str);

    $arrayChar = array(
        '/á/' => 'a',
        '/é/' => 'e',
        '/í/' => 'i',
        '/ó/' => 'o',
        '/ú/' => 'u',
        '/ã/' => 'a',
        '/õ/' => 'o',
        '/â/' => 'a',
        '/ê/' => 'e',
        '/î/' => 'i',
        '/ô/' => 'o',
        '/û/' => 'u',
        '/ç/' => 'c',
        '/Á/' => 'A',
        '/É/' => 'E',
        '/Í/' => 'I',
        '/Ó/' => 'O',
        '/Ú/' => 'U',
        '/Ã/' => 'A',
        '/Õ/' => 'O',
        '/Â/' => 'A',
        '/Ê/' => 'E',
        '/Î/' => 'I',
        '/Ô/' => 'O',
        '/Û/' => 'U',
        '/Ç/' => 'C',
        '/à/' => 'a',
        '/À/' => 'A',
        '/-/' => '_',
        '/ /' => '_',
    );

    $str = preg_replace(array_keys($arrayChar), array_values($arrayChar), $str);
    return nl2br($str);
}
?>
<link rel="icon" type="image/x-icon" href="brazil.ico">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<style>
    @import 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300';
    @font-face {
        font-family: 'Roboto Condensed';
        src: url('fonts/RobotoCondensed-Regular.ttf') format('truetype');
    }
    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-family:'Roboto Condensed';
    }
    html{
        font-family:'Roboto Condensed';
    }
    .highlight {
        background-color: rgba(86, 61, 124, 0.15);
        border: 1px solid rgba(86, 61, 124, 0.2);
        border-radius: 4px;
        margin-bottom: 14px;
        padding: 9px 14px;
        color: #563d7c;
        font-size: 18px;
    }
    .panel-purple {
        border-color: rgba(86, 61, 124, 0.2);
    }
    .panel-purple > .panel-heading {
        background-color: rgba(86, 61, 124, 0.15);
        border-color: rgba(86, 61, 124, 0.2);
        color: #563d7c;
    }
    
    .btn-purple {
        background-color: #765d9c;
        border-color: #563d7c;
        color: #fff;
    }
    .btn-purple:hover, .btn-purple:focus, .btn-purple:active{
        background-color: #654c8b;
        color: #fff;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        vertical-align: middle;
    }
    
    .panel-heading code {
        background-color: #fff;
        border: 1px solid #ccc;
        color: #333;
    }
    .panel-purple > .panel-heading code{
        color: #563d7c;
    }
</style>
<div class="container bs-docs-container">

    <div role="main" class="col-md-9">
        <div class="page-header">
            <h1>Filerename <small>Pesquisa os arquivos do Processo Seletivo pelo ID</small></h1>
        </div>
        <form class="form-horizontal" name="file-form" action="#" method="post" role="form"> 

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label" for="form_id">N&ordm;:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="form_id" name="form_id" placeholder="ID do processo...">
                </div>
            </div>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <input class="btn btn-purple" type="submit" value="Pesquisar" />
                    <?php if (isset($_POST) && !empty($_POST)) { ?>
                        <a href="javascript:;">ID: 
                            <span class="badge"><?php echo $_POST['form_id'] ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <br />
        </form>

        <br/>

        <?php if (isset($_POST) && !empty($_POST)) { ?>

            <?php $list = getList($_POST['form_id']); ?>
            <?php $title = getTitle($_POST['form_id']); ?>

            <?php $x = 1; ?>
            <?php if ($list) { ?>

                <nav role="navigation" class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="javascript:;" class="navbar-brand">Total de resultados:</a>
                        </div>
                        <div id="bs-example-navbar-collapse-3" class="collapse navbar-collapse">
                            <button class="btn btn-default navbar-btn" type="button"><?php echo count($list); ?></button>
                        </div>
                    </div>
                </nav>

                <div class="panel panel-purple">
                    <div class="panel-heading">Processo: <h6 style="margin: 0px; display: inline;"><code><?php echo clearTitle($title->title); ?></code></h6></div>
                    <table class="table table-striped">
                        <?php foreach ($list as $l) { ?>
                            <tr>
                                <td valign="middle"><h1 style="margin: 0;"><?php echo $x; ?></h1></td>
                                <td valign="middle"><a class="btn btn-default" href="<?php echo $l->path; ?>">Download</a></td>
                                <td valign="middle">
                                    <p><small>Titulo: <kbd style="margin-left: 15px;"><?php echo $l->title; ?></kbd></small></p>
                                    <p><small>Arquivo: <code style="margin-left: 5px;"><?php echo basename($l->filename); ?></code></small></p>
                                    <small style="color: #888;"><?php echo $l->path; ?></small>
                                </td>
                            </tr>
                            <?php $x++; ?>
                        <?php } ?>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert">N&atilde;o h&aacute; arquivos para exibir</div>
            <?php } ?>
        <?php } ?>
    </div>
</div>