<?php
ini_set("error_reporting", "E_ALL");
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        vertical-align: middle;
    }
    .table > tbody > tr > td > p + p {
        margin-bottom: 0;
    }
    code {
        background-color: rgba(217, 237, 247, 0.5);
        color: #31708f;
    }
    .panel-heading code {
        background-color: #fff;
        border: 1px solid #ccc;
        color: #333;
    }
    .panel-primary > .panel-heading code{
        color: #428bca;
    }
</style>

<div class="container bs-docs-container">
    <div role="main" class="col-md-9">
        <div class="page-header">
            <h1>Filerename <small>Renomeia arquivos dentro das pastas dos Processos Seletivos</small></h1>
        </div>
        <form class="form-horizontal" name="file-form" action="#" method="post" role="form"> 

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label" for="form_path">Diretorio:</label>
                <div class="row">
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="form_path" name="form_path" placeholder="Caminho do diretorio...">
                    </div>
                </div>
            </div>
            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label" for="form_path"></label>
                <div class="col-sm-10">
                    <input class="btn btn-primary" type="submit" value="Alterar" />
                </div>
            </div>
            <br />
        </form>
        <br/>

        <?php
        if (isset($_POST) && !empty($_POST)) {

            $path = $_POST['form_path'];
            if ($path == '') {
                echo '<div class="alert alert-danger" role="alert">Diretorio invalido</div>';
                exit;
            }
            if (!file_exists($path)) {
                echo '<div class="alert alert-danger" role="alert">Diretorio nao existe</div>';
                exit;
            }

            $files = scandir($path);
            $msg = array();
            ?>

            <table>
                <tr>

                    <?php
                    $count = 2;
                    foreach ($files as $file) {
                        if ($file != '.' && $file != "..") {
                            $clrName = '';
                            $parts = explode('.', $file);
                            $old_name = $path . DS . $file;
                            $new_name = 'images/Dctos/PDF/POPs/' . $parts[0] . '.' . $parts[1];
                            ?>
                            <?php
                            if ($count % 4 == 0) {
                                echo '</tr><tr>';
                            }
                            ?>
                            <td>
                                <a 
                                    href="<?php echo $new_name; ?>" 
                                    onclick="window.open(this.href, '', 'scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0');
                                                        return false;">
                                    <span class="glyphicon glyphicon-save"></span> <?php echo str_replace("_", " ", $parts[0]); ?>
                                </a>
                            </td>
                            <?php
                        }

                        $count++;
                    }
                }
                ?>
            </tr>
        </table>

    </div>
</div>