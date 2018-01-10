<?php
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));

require_once ('./lib/ReadFileXLS.php');
?>


<!DOCTYPE>
<html lang="pt-br" dir="ltr" >
    <head>
		<!--<meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />-->
        <meta charset="utf-8" />
		<!--<meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
  		<meta name="author" content="Fabricio Farias" />

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
                  <a class="navbar-brand" href="../../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Ferramentas para ediedi&ccedil;&atilde;o e ajuste de conte&ugrave;do para o site e intranet ISGH</a>
              </div>
              <!--/.nav-collapse -->
            </div>
          </nav>
        <div class="panel panel-inverse" style="border-radius: 0px;border: none;">
            <div class="panel-heading" style="border-radius: 0px;background-color: #27965C;border-color: #27965C;color: #ffffff">
                <h3 class="panel-title"><div class="container" style="text-align: left;">Excel Reader</div></h3>
            </div>
            <div class="panel-body">
                
            
        
        <div class="container bs-docs-container" style="text-align: left;">
            <div role="main" class="col-md-9">
                <div class="page-header">
                    <h1>Excel Reader <small>Ler planilhas do excel e monta objeto para Tabela HTML5</small></h1>
                    <span class="label label-danger" style="font-weight: 500;">OBS: </span>&nbsp;<code style="color: #C7254E; background-color: #F9F2F4;">A planilha deve ser da extens&atilde;o '*.xlt', ou seja, Modelo Excel 97-2003</code>
                </div>
                <?php if(isset($_POST) && !empty($_POST)){?>
                    <?php
                        $path = $_POST['form_path'];
                        if($path == ''){
                            echo '<div class="alert alert-danger" role="alert">Diretorio inválido: '.$path.'</div><a class="btn btn-danger" href="index.php">Nova Planilha</a>';
                            exit;
                        }
                        if (!file_exists($path)) {
                            echo '<div class="alert alert-danger" role="alert">Diretorio não existe: '.$path.'</div><a class="btn btn-danger" href="index.php">Nova Planilha</a>';
                            exit;
                        }
                        
                        $extensao = pathinfo($path, PATHINFO_EXTENSION);
                        if ($extensao != 'xlt') {
                            echo '<div class="alert alert-danger" role="alert">Extensão inválida: '.$extensao.'</div><a class="btn btn-danger" href="index.php">Nova Planilha</a>';
                            exit;
                        }
                        
                        
                        $rows = new ReadFileXLS(trim($path));
                        $rows = $rows->getDadosExcel();
                        
                        
                        // foreach($rows as $k => $v){
                                
                        //         var_dump($v['funcao']);exit;
                        //     }
                        //     exit;
						// echo '<pre>';
                        // var_dump($rows);exit;
                        
						function utf8_converter($array)
{
							array_walk_recursive($array, function(&$item, $key){
								if(!mb_detect_encoding($item, 'utf-8', true)){
										$item = utf8_encode($item);
								}
							});
						 
							return $array;
						}
						
						$json  = json_encode(utf8_converter($rows),JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
						$error = json_last_error();
						switch (json_last_error()) {
							case JSON_ERROR_NONE:
								echo ' - No errors';
							break;
							case JSON_ERROR_DEPTH:
								echo ' - Maximum stack depth exceeded';
							break;
							case JSON_ERROR_STATE_MISMATCH:
								echo ' - Underflow or the modes mismatch';
							break;
							case JSON_ERROR_CTRL_CHAR:
								echo ' - Unexpected control character found';
							break;
							case JSON_ERROR_SYNTAX:
								echo ' - Syntax error, malformed JSON';
							break;
							case JSON_ERROR_UTF8:
								echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
							break;
							default:
								echo ' - Unknown error';
							break;
						}
						echo $json;
						
						
						
						$thead = array();
						$thead[] = '<thead>';
						$thead[] = '<tr>';
						foreach(array_keys($rows[0]) as $col){
							$thead[] = '<th>'.strtoupper($col).'</th>';
						}
						$thead[] = '</tr>';
						$thead[] = '</thead>';

                    ?>
<p>&nbsp;</p>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="form_path">Diretorio:</label>
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $path; ?>
                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-primary" href="index.php">Nova Planilha</a>
                                </div>
                            </div>
                        </div>
                        
                
                
                        <?php
							
							$html  = array();
                            $html[] = '<table class="adminlist adminlist-info">';
							foreach($thead as $head){
								$html[] = $head;
							}
							$html[] = '<tbody>';
							
							foreach($rows as $row){
								$html[] = '<tr>';
								foreach($row as $k => $v){
									$html[] = '<td><span>'.$v.'</span></td>';
								}
								$html[] = '</tr>';
							}
							
							$html[] = ' </tbody>';
                            $html[] = '</table>';
                            ?>
                <div>
                    <?php echo (implode("\n", $html));?>
                </div>
                <!--<div style="padding: 25px;border-width: 1px 1px 2px; border-color: #FBE7A8; border-style: solid;margin: 20px 0; line-height: 18px;background-color: #FFFFF3;">-->
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
					
					<?php
//                        foreach ($html as $k => $v){
//                            echo '<p>';
//                            highlight_string($k).'. '.highlight_string($v);
//                            echo '</p>';
//                        }
//                          highlight_string($html);
//                          highlight_string(implode("\n", $html));
//                        $source = highlight_string(implode("\n", $html), TRUE);
//                        $source = str_replace(array('<code>', '/ code>', '','</ are >','< font color ="'),array('<pre style="padding:1em;border:2px solid black;overflow:scroll">', '/ pre>', '','</ span >','< span style = "color:' ), $source);
//                        echo $source;
                        ?>
                </div>
                
                <?php }else{?>
                    <form class="form-horizontal" name="file-form" action="#" method="post" role="form"> 
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="form_path">Diretorio:</label>
                            <div class="row">
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="form_path" name="form_path" placeholder="Caminho do arquivo excel...">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label" for="form_path"></label>
                            <div class="col-sm-10">
                                <input class="btn btn-primary" type="submit" value="Submit" />
                            </div>
                        </div>
                    </form>
                <?php }?>
            </div>
        </div>
                </div>
        </div>
    </body>
</html>