<?php
include "../config/config.php";

$idtb_aluno = $_GET['al'];

$data['token'] ='12AA740835D1436888BC817909998A86';
	//$data['token'] ='E2946BCBAE5B4FD1BE06EEB7652B4068';
$data['email'] = 'felipe.programer@gmail.com';
$data['currency'] = 'BRL';


$sql = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '".$_GET['id']."'") or die($mysqli->error);
if ($ln = $sql->fetch_assoc()) {
	$data['itemId1'] = $ln['idtb_curso'];
	$data['itemQuantity1'] = '1';
	$data['itemDescription1'] = $ln['curso'];
	$data['itemAmount1'] = str_replace(",", ".", str_replace(".", "", $ln['valor']));
	$data['reference'] = $idtb_aluno;
	

	//O valor do curso tem que passar com o ponto(.), Tenho que mudar lá na hora de cadastrar o curso;
}


$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);
echo $xml -> code;

$s = $mysqli->query("INSERT INTO tb_transacao(codigo, idtb_aluno) VALUES('".$_POST['']."')");


?>