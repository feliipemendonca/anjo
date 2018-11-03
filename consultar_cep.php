<?php
	
	$cep = $_POST['cep'];
	
    //O CEP TÁ BUSCANDO NO SITE DOS CORREIOS
	$xml = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?cep=" . $cep . "&formato=xml");
	
	$d['resultado'] = (string) $xml -> resultado;
	$d['tipo_logradouro'] = (string) $xml -> tipo_logradouro;
	$d['logradouro'] = (string) $xml -> logradouro;
	$d['bairro'] = (string) $xml -> bairro;
	$d['cidade'] = (string) $xml -> cidade;
	$d['estado'] = (string) $xml -> estado;
	
	echo json_encode($d);