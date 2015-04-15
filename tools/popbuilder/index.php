<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));

class BuildTables{
    
    var $_sublevel      = null;
    var $_table         = null;
    var $_chunk         = null;
    var $_files         = null;
    var $_craft         = array();
    var $_td            = array();
    

    function __construct($files) {
        
          if(!empty($files)){
            $this->_files    = $files;
            if(is_array($this->_files)){
                $_dot = array_shift($this->_files);
                $__dot = array_shift($this->_files);

           }
        }
    }
    
    function bind($sublevel = ''){
        
        if(!empty($sublevel)){
           $this->_sublevel =  $sublevel;
        }
        
        $this->_chunk = array_chunk($this->_files, $this->_sublevel);
               
        $count = (is_array($this->_chunk)) ? count($this->_chunk) : $this->_chunk;
                
        for($x=0; $x < $count; $x++){
            for($y=0; $y < $this->_sublevel; $y++){
                $this->_td[$y] = '   <td></td>';
            }
            $this->_craft[$x] = $this->_td;
        }
        
        return $this->_craft;
        
    }
    
    function merge($table = '', $path_link = ''){
        
        if(!empty($table)){
            $this->_craft = $table;
        }
        if($path_link){
            if(substr($path_link, -1) != '/'){
                $path_link = str_replace("/var/www/html/intranet/", '', $path_link);
                $path_link = $path_link.'/';
            }
        }
        
        foreach($this->_chunk as $key => $val){
            $html = '';

            foreach ($val as $k => $v){
                
                $name = $this->_frename($v);

//                $html[] = '<td>';
//                $html[] = '<a href="'.$path_link.$v.'" onclick="window.open(this.href,\'\',\'scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0\');return false;">';
//                $html[] = '<span class="glyphicon glyphicon-save"></span> ';
//                $html[] = $name;
//                $html[] = '</a>';
//                $html[] = '</td>';

                $html = '   <td>'
                      . '<a '
                      . 'href="'.$path_link.$v.'" '
                      . 'onclick="window.open(this.href,\'\',\'scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0\');return false;">'
                      . '<span class="glyphicon glyphicon-save"></span> '
                      . $name
                      . '</a>'
                      . '</td>'
                    ;

                $this->_craft[$key][$k] = $html;
            }
        }
        
        return $this->_craft;
    }
    
    function _frename($value){
        
//        $name = str_replace("ISGH", "",$value);
        $name = str_replace("__", " ",trim($value));
        $name = str_replace("_", " ",trim($name));
        $name = explode('.', $name);
        
        return $name[0];
    }
}

class BuildList extends BuildTables{
    
    var $_list  = array();
    
    function __construct($files) {
        parent::__construct($files);
    }
    
    
    function merge($list = '', $path_link = ''){
        
        if(!empty($list)){
            $this->_list = $list;
        }
        if($path_link){
            if(substr($path_link, -1) != '/'){
                $path_link = str_replace("/var/www/html/intranet/", '', $path_link);
                $path_link = $path_link.'/';
            }
        }

        foreach($this->_files as $key => $val){
            $html = '';

            $name = $this->_frename($val);
            $html = '<li class="list-group-item">'
                  . '<a '
                  . 'href="'.$path_link.$val.'" '
                  . 'onclick="window.open(this.href,\'\',\'scrollbars=yes,resizable=yes,location=no,menubar=no,status=no,toolbar=no,left=0,top=0\');return false;">'
                  . '<span class="glyphicon glyphicon-save"></span> '
                  . $name
                  . '</a>'
                  . '</li>'
                ;


            $this->_list[$key] = $html;
        }
        
        return $this->_list;
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" dir="ltr" >
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="generator" content="Joomla! - Open Source Content Management" />
        <title>My Tools</title>
        
        <link rel="icon" type="image/x-icon" href="brazil.ico">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="css/newstuff-comp.css" type="text/css" />
        <link rel="stylesheet" href="css/prettify.css" type="text/css" />
        <link rel="stylesheet" href="css/glyphicons-halflings.css" type="text/css" />
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
            }
            html, body{
                font-family:'Roboto Condensed';
                font-size: 12px;
            }

            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                vertical-align: middle;
            }
            .table > tbody > tr > td > p + p {
                margin-bottom: 0;
            }
/*            code {
                background-color: #FBE7A8;
                color: #31708f;
            }*/
            .panel-heading code {
                background-color: #fff;
                border: 1px solid #ccc;
                color: #333;
            }
            .panel-primary > .panel-heading code{
                color: #428bca;
            }
            code, kbd, pre, samp{
                font-family: monospace,monospace!important;
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
                <div class="panel-heading" style="border-radius: 0px;background-color: #D99330;border-color: #D99330;color: #ffffff">
                    <h3 class="panel-title"><div class="container" style="text-align: left;">POP Construtor</div></h3>
                </div>
                <div class="panel-body">
                    <div class="container bs-docs-container" style="text-align: left;">
            
                    
                
            
            
            
            <div role="main" class="col-md-9">
                <div class="page-header">
                    <h1>POP Contrutor <small>Monta a estrutura de tabelas para listagem de POP</small></h1>
                </div>
                <form class="form-horizontal" name="file-form" action="#" method="post" role="form"> 

                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="form_path_local">Diretorio Local:</label>
                        <div class="row">
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="form_path_local" name="form_path_local" placeholder="Caminho do diretorio dos PDFs...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="form_path_remote">Diretorio Remoto:</label>
                        <div class="row">
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="form_path_remote" name="form_path_remote" placeholder="Caminho do diretorio remoto dos PDFs...">
                            </div>
                        </div>
                    </div>
                    
                    <div id="form_type" class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="form_path_remote">Tipo:</label>
                        <div class="row">
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="form_type" id="inlineRadio1" value="t" onclick="document.getElementById('form_colums').style.display = 'block'"> Tabela
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="form_type" id="inlineRadio2" value="l" onclick="document.getElementById('form_colums').style.display = 'none'"> Lista
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div id="form_colums" class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="form_path_local">QTD Colunas:</label>
                        <div class="row">
                            <div class="col-sm-2">
                                <select name="form_colums" class="form-control">
                                    <option value="">-Colunas-</option>
                                    <?php for($o=1; $o<20; $o++){ ?>
                                    <option value="<?php echo $o ?>"><?php echo $o ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="form_path_local"></label>
                        <div class="col-sm-10">
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                    <br />
                </form>
                <br/>


                <?php
                if (isset($_POST) && !empty($_POST)) {

                    $path = $_POST['form_path_local'];
                    $path_r = $_POST['form_path_remote'];
                    $colums = $_POST['form_colums'];
                    $type = $_POST['form_type'];
                    $num_proc = $_POST['form_proc_1'].'_'.$_POST['form_proc_2'];

                    if ($colums == '' and $type != 'l') {
                        echo '<div class="alert alert-danger" role="alert">Informe Quantidade de colunas</div>';
                        exit;
                    }
                    if ($path == '') {
                        echo '<div class="alert alert-danger" role="alert">Diretorio invalido</div>';
                        exit;
                    }
                    if ($path_r == '') {
                        echo '<div class="alert alert-danger" role="alert">Diretorio remoto invalido</div>';
                        exit;
                    }
                    if (!file_exists($path)) {
                        echo '<div class="alert alert-danger" role="alert">Diretorio nao existe</div>';
                        exit;
                    }

                    $files = scandir($path);
                    $msg = array();
                    
                    $path_r = str_replace("\\", "/", $path_r);
                    
                    /*********************************************/
                    /*
                     * CLASSE QUE GERA  TABELA
                     */
                    if($type == 't'){
                        $bt = new BuildTables($files);
                        $bind = $bt->bind($colums);
                        $table = $bt->merge($bind, $path_r);
                        
                        $html = array();

                        $html[] = '<table class="table table-bordered table-striped table-hover">';
                        foreach ($table as $tr){
                            $html[] = ' <tr>';
                            foreach ($tr as $td){
                                $html[] = $td;
                            }
                            $html[] = ' </tr>';
                        }
                        $html[] = '</table>';
                    }else{
                        $lt = new BuildList($files);
                        $list = $lt->merge('',$path_r);
                        
                        $html = array();

                        $html[] = '<ul class="list-group">';
                        foreach ($list as $li){
                            $html[] = $li;
                        }
                        $html[] = '</ul>';
                    }

                    /*********************************************/
                    
                    
                    ?>
                    <div>
                        <?php echo (implode("\n", $html));?>
                    </div>
                
                    <div style="margin: 25px 0;">
                        <pre class="prettyprint linenums">
                            <ol class="linenums">
                                <?php foreach ($html as $k => $v){?>
                                <?php
                                      $source = highlight_string($v, TRUE);
                                      $source = str_replace(array('<code>', '</code>','<span style="color: #000000">','</span>'),array('','','',''), $source);
                                      $source = str_replace(array('      ', '       ','                             ','       ',"\n"),array('','','','',''), $source);
                                    ?>
                                <li><?php echo trim($source); ?></li>
                                <?php } ?>
                            </ol>
                        </pre>
                    </div>
                
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
    </body>
</html>