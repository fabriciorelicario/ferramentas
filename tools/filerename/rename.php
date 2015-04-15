<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));

function getNumber($str, $replace) {

    $rep_array = explode("_", $replace);
    $str = str_replace($rep_array[0] . '-' . $rep_array[1], "", $str);
    $str = str_replace($rep_array[0] . '_' . $rep_array[1], "", $str);
    $str = str_replace($rep_array[0] . '__' . $rep_array[1], "", $str);
    $str = str_replace($rep_array[0] . ' ' . $rep_array[1], "", $str);
    $str = str_replace($rep_array[0] . $rep_array[1], "", $str);

//    $str = str_replace($replace, "", $str);
    $num = preg_replace("/[^0-9]/", "", $str);

    if ($num != '') {
        if (strlen($n) < 2) {
            $n = str_pad($num, 2, "0", STR_PAD_LEFT);
        }
    } else {
        $n = '';
    }

    return $n;
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

<nav class="navbar navbar-inverse" style="margin: 0; border-radius: 0;">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                  <a class="navbar-brand" href="../../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Ferramentas para edi&ccedil;&atilde;o e ajuste de conte&ugrave;do para o site e intranet ISGH</a>
              </div>
              <!--/.nav-collapse -->
            </div>
          </nav>
<div class="panel panel-inverse" style="border-radius: 0px;border: none;">
    <div class="panel-heading" style="border-radius: 0px;background-color: #3E5FA3;border-color: #3E5FA3;color: #ffffff">
        <h3 class="panel-title"><div class="container">Filerename</div></h3>
    </div>
    <div class="panel-body">
        
    


<div class="container bs-docs-container">
    <div role="main" class="col-md-9">
        <div class="page-header">
            <h1>Filerename <small>Renomeia arquivos dentro das pastas dos Processos Seletivos</small></h1>
        </div>
        <form class="form-horizontal" name="file-form" action="#" method="post" role="form"> 

            <div class="form-group form-group-lg">
                <label class="col-sm-2 control-label" for="form_proc">N&ordm; Processo:</label>
                <div class="row">
                    <div class="col-sm-2">
                        <select name="form_proc_1" class="form-control">
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014" selected>2014</option>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <input class="form-control" type="text" id="form_proc" name="form_proc_2" placeholder="Numero do processo...">
                    </div>
                </div>
                
            </div>
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
            $num_proc = $_POST['form_proc_1'].'_'.$_POST['form_proc_2'];
            
            if ($_POST['form_proc_2'] == '') {
                echo '<div class="alert alert-danger" role="alert">Numero do processo invalido</div>';
                exit;
            }
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
            $old_name = '';
            $new_name = '';

            foreach ($files as $file) {
                if ($file != '.' && $file != "..") {

                    $parts = explode('.', $file);
                    $n = getNumber($parts[0], $num_proc);
                    $old_name = $path . DS . $file;
                    
                    if (strpos($parts[0], 'prova') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_PROVA_OFICIAL.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name).'</code></small></p>';
                        }
                    
                    }else if ((strpos($parts[0], 'diviso') > -1 && strpos($parts[0], 'sala') > -1) or (strpos($parts[0], 'divisao') > -1 && strpos($parts[0], 'sala') > -1)) {
                        
                        $new_name = $path . DS . $num_proc . '_DIVISAO_POR_SALA.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name).'</code></small></p>';
                        }
                    
                    }else if (strpos($parts[0], 'errata') > -1 or strpos($parts[0], 'ERRATA') > -1) {
                        
                        $n = ($n == '')?'01':$n;
                        $new_name = $path . DS . $num_proc . '_ERRATA_' . $n . '.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name).'</code></small></p>';
                        }
                    
                    } else if (strpos($parts[0], 'gabarito') > -1 && strpos($parts[0], 'retificado') > -1 && strpos($parts[0], 'recurso') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_GABARITO_OFICIAL_RETIFICADO_POS_RECURSO.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'gabarito') > -1 && strpos($parts[0], 'retificado') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_GABARITO_OFICIAL_RETIFICADO.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if ((strpos($parts[0], 'gabarito') > -1 && strpos($parts[0], 'pos') > -1) or (strpos($parts[0], 'gabarito') > -1 && strpos($parts[0], 'recurso') > -1)) {
                        
                        $new_name = $path . DS . $num_proc . '_GABARITO_OFICIAL_POS_RECURSO.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'gabarito') > -1 or strpos($parts[0], 'GABARITO') > -1) {

                        $new_name = $path . DS . $num_proc . '_GABARITO_OFICIAL.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                    
                        
                    } else if ((strpos($parts[0], 'especifica') > -1 && strpos($parts[0], 'retificado') > -1) or (strpos($parts[0], 'especfica') > -1 && strpos($parts[0], 'retificado') > -1) or (strpos($parts[0], 'espe') > -1 && strpos($parts[0], 'retificado') > -1)) {
                        
                        $new_name = $path . DS . $num_proc . '_CONVOCACAO_AVALIACAO_ESPECIFICA_RETIFICADO.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'especifica') > -1 or strpos($parts[0], 'especfica') > -1 or strpos($parts[0], 'espe') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_CONVOCACAO_AVALIACAO_ESPECIFICA.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'entrevista') > -1 && strpos($parts[0], 'recurso') > -1) {

                        $new_name = $path . DS . $num_proc . '_CONVOCACAO_ENTREVISTA_POS_RECURSO.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'entrevista') > -1 or strpos($parts[0], 'entrev') > -1) {

                        $new_name = $path . DS . $num_proc . '_CONVOCACAO_ENTREVISTA.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'aditivo') > -1 or strpos($parts[0], 'ADITIVO') > -1) {
                        
                        $n = ($n == '')?'01':$n;
                        $new_name = $path . DS . $num_proc . '_ADITIVO_' . $n . '.' . $parts[1];

                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'edital') > -1 or strpos($parts[0], 'EDITAL') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_EDITAL.' . $parts[1];

                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'final') > -1 or strpos($parts[0], 'FINAL') > -1) {
                        
                        $new_name = $path . DS . $num_proc . '_RESULTADO_FINAL.' . $parts[1];

                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'classificatorio') > -1 or strpos($parts[0], 'classificatrio') > -1 or strpos($parts[0], 'classificatrio') or strpos($parts[0], 'class')) {
                        
                        $new_name = $path . DS . $num_proc . '_RESULTADO_CLASSIFICATORIO.' . $parts[1];

                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'prorrogao') > -1 or strpos($parts[0], 'prorrogacao') > -1) {
                        
                        $n = ($n == '')?'01':$n;
                        $new_name = $path . DS . $num_proc . '_PRORROGACAO_' . $n . '.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'reconvocacao') > -1 or strpos($parts[0], 'RECONVOCACAO') > -1 or strpos($parts[0], 'reconvocao') > -1 or strpos($parts[0], 'RECONVOCAO') > -1) {
                        
                        $n = ($n == '')?'01':$n;
                        $new_name = $path . DS . $num_proc . '_RECONVOCACAO_' . $n . '.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                        
                    } else if (strpos($parts[0], 'convocacao') > -1 or strpos($parts[0], 'conv') > -1 or strpos($parts[0], 'convoc') > -1 or strpos($parts[0], 'convocao') > -1 or strpos($parts[0], 'convocaao') > -1 or strpos($parts[0], 'convocaco') > -1) {
                        
                        $n = ($n == '')?'01':$n;
                        $new_name = $path . DS . $num_proc . '_CONVOCACAO_' . $n . '.' . $parts[1];
                        
                        if(file_exists($new_name)){
                            $new_name = $new_name.'_(2)';
                        }
                        
                        if (!rename($old_name, $new_name)) {
                            $msg[] = 'Falha ao renomear arquivo!: ' . $parts[0];
                        } else {
                            $msg[] = '<p><small>Antes : <kbd>' . $file . '</kbd></small></p><p><small> Depois :<code>' . basename($new_name) .'</code></small></p>';
                        }
                    }
                }
            }
            ?>

            <?php if ($msg) { ?>

                <nav role="navigation" class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="javascript:;" class="navbar-brand">Total de resultados:</a>
                        </div>
                        <div id="bs-example-navbar-collapse-3" class="collapse navbar-collapse">
                            <button class="btn btn-default navbar-btn" type="button"><?php echo count($msg); ?></button>
                        </div>
                    </div>
                </nav>

                <div class="panel panel-primary">
                    <div class="panel-heading">Diretorio: <h6 style="margin: 0px; display: inline;"><code><?php echo $path; ?></code></h6></div>
                    <table class="table table-striped">
                        <tbody>
                            <?php $y = 1; ?>
                            <?php foreach ($msg as $m) { ?>
                                <tr>
                                    <td valign="middle">
                                        <h1 style="margin: 0;"><?php echo $y; ?></h1>
                                    </td>
                                    <td valign="middle">
                                        <?php echo $m; ?>
                                    </td>
                                </tr>
                                <?php $y++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="col-md-3">
        
    </div>
</div>
    </div>
</div>