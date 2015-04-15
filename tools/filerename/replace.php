<?php

ini_set("error_reporting","E_ALL");
define('DS', DIRECTORY_SEPARATOR);
define('BP', dirname(__FILE__));
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$substituir = array(
//    '/á/' => "a",
//    '/Á/' => "A",
//    '/à/' => "a",
//    '/À/' => "A",
//    '/ã/' => "a",
//    '/Ã/' => "A",
//    '/â/' => "a",
//    '/Â/' => "A",
//    '/ä/' => "a",
//    '/Ä/' => "A",
//    '/é/' => "e",
//    '/É/' => "E",
//    '/è/' => "e",
//    '/È/' => "E",
//    '/ê/' => "e",
//    '/Ê/' => "E",
//    '/ë/' => "e",
//    '/Ë/' => "E",
//    '/í/' => "i",
//    '/Í/' => "I",
//    '/ì/' => "i",
//    '/Ì/' => "I",
//    '/î/' => "i",
//    '/Î/' => "I",
//    '/ï/' => "i",
//    '/Ï/' => "I",
//    '/ó/' => "o",
//    '/Ó/' => "O",
//    '/ò/' => "o",
//    '/Ò/' => "O",
//    '/õ/' => "o",
//    '/Õ/' => "O",
//    '/ô/' => "o",
//    '/Ô/' => "O",
//    '/ö/' => "o",
//    '/Ö/' => "O",
//    '/ú/' => "u",
//    '/Ú/' => "U",
//    '/ù/' => "u",
//    '/Ù/' => "U",
//    '/û/' => "u",
//    '/Û/' => "U",
//    '/ü/' => "u",
//    '/Ü/' => "U",
//    '/,/' => "",
//    '/!/' => "",
//    '/#/' => "",
//    '/%/' => "",
//    '/¬/' => "",
//    '/{/' => "",
//    '/}/' => "",
//    '/^/' => "",
//    '/&/' => "",
//    '/`/' => "",
//    '/;/' => "",
//    '/:/' => "",
//    '/?/' => "",
//    '/¹/' => "1",
//    '/²/' => "2",
//    '/³/' => "3",
//    '/ª/' => "a",
//    '/º/' => "o",
//    '/ç/' => "c",
//    '/ü/' => "u",
//    '/$/' => "s",
//    '/ÿ/' => "y",
//    '/w/' => "w",
//    '/</' => "",
//    '/>/' => "",
//    '/[/' => "",
//    '/]/' => "",
//    '/&/' => "e",
//    '/ /' => "_",
//    '/ç/' => "c",
//    '/Ç/' => "C"
//);




function strtolower_utf8($string){
    
    $string    = utf8_decode($string);
    $string    = strtolower($string);
    $string    = utf8_encode($string);  
    
    
  $convert_to = array(
    "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
    "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
    "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
    "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
    "ь", "э", "ю", "я"
  );
  $convert_from = array(
    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
    "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
    "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
    "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
    "Ь", "Э", "Ю", "Я"
  );

  return str_replace($convert_from, $convert_to, $string);
} 






function clearNameFile ($file){
    
    $file = strtolower($file);
    $arrayChar = array(
        "/á/" => 'a',
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
        '/ /' => '_',
        '/-/' => '_',
        '/,/' => ''
    );
    $teste = strtolower(utf8_encode($file));
    $teste2 = utf8_decode($teste);
    $teste3 = mb_strtolower($file, mb_detect_encoding($file));

    $newFile = preg_replace(array_keys($arrayChar), array_values($arrayChar),$file);
    $newFile = strtoupper($newFile);

    return $newFile;
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

            foreach ($files as $file) {
                if ($file != '.' && $file != "..") {
                    $clrName = '';
                    $parts = explode('.', $file);
                    $old_name = $path . DS . $file;
                    $clrName = clearNameFile($parts[0]);
//                    $clrName = strtolower_utf8($parts[0]);
                    $new_name = $path.DS.$clrName.'.'.$parts[1];

                    rename($old_name, $new_name);
                    
//                    echo '<lable><p>'.$parts[0].'</p><p>'.$clrName.'</p></lable><br />';
                    
                }
            }
        }
        ?>
        
        
        </div>
    <div class="col-md-3">
        
    </div>
</div>