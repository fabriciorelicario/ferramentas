<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

for($i=78; $i<=234; $i++){
    if(mkdir('C:/Users/fabricio.fs/Fabricio/Processos Seletivos/Externos/HRC/2010_01_CONVOCACOES/2010_01_GRUPO_'.$i, 0777)){
        echo 'Pasta: 2010_01_GRUPO_'.$i.' Criada com sucesso<br />';
    }else{
        echo 'Falha ao criar a Pasta: 2010_01_GRUPO_'.$i.'<br />';
    }
}
?>
