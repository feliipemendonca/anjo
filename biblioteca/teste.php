<?php
$nomeArquivo = "abcdefghijklmnopqtuvxz.pptx";
    //if(strlen($nomeArquivo) > 250){
$i = strrpos($nomeArquivo, ".");

$extensao = "";
if($i > 1){
    $extensao = substr($nomeArquivo, $i);
    $nomeArquivo = substr($nomeArquivo, 0, strrpos($nomeArquivo, $extensao));
}

$nomeArquivo =  substr($nomeArquivo, 0, 250 - strlen($extensao) -1) . "_" . $extensao;
echo $nomeArquivo;
    //}