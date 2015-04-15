<?php
$nome_arquivo = "Cadastro";
    header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/force-download");
    header("Content-Disposition: attachment; filename=$nome_arquivo.xls");
    header("Pragma: no-cache");

 
$html = '';
  $html .= "<body>";
  $html .=  "<table>";
  $html .=    "<tbody>";
  $html .=    "<tr>";
  $html .=      "<td><strong>Data</strong></td>";
  $html .=      "<td><strong>Nome</strong></td>";
  $html .=      "<td><strong>Telefone</strong></td>";
  $html .=      "<td><strong>E-mail</strong></td>";
  $html .=      "<td><strong>Mensagem</strong></td>";
  $html .=      "<td><strong>Destinat&aacute;rio</strong></td>";
  $html .=      "<td><strong>Utm_campaign</strong></td>";
  $html .=      "<td><strong>Utm_medium</strong></td>";
  $html .=      "<td><strong>Utm_source</strong></td>";
  $html .=    "</tr>";
  $html .=    "<tr>";
  $html .=      "<td>aaaaaaaaaaaaaa</td>";
  $html .=      "<td>bbbbbbbbbbbbbb</td>";
  $html .=      "<td>cccccccccccccc</td>";
  $html .=      "<td>dddddddddddddd</td>";
  $html .=      "<td>eeeeeeeeeeeeee</td>";
  $html .=      "<td>ffffffffffffff</td>";
  $html .=      "<td>gggggggggggggg</td>";
  $html .=      "<td>hhhhhhhhhhhhhh</td>";
  $html .=      "<td>iiiiiiiiiiiiii</td>";
  $html .=    "</tr>";
  $html .=    "</tbody>";
  $html .=  "</table>";
  $html .= "</body>";
 
echo $html;