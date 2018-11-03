<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

$codigoNotificacao = $_POST["notificationCode"];
$tipo = $_POST["notificationType"];

// if($tipo != "transaction"){
// 	die("Não autorizado!");
// }

//$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/";
$url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/";

//$data['token'] ='12AA740835D1436888BC817909998A86';
$data['token'] ='E2946BCBAE5B4FD1BE06EEB7652B4068';
$data['email'] = 'felipe.programer@gmail.com';
$data = http_build_query($data);

$curl = curl_init($url . $codigoNotificacao . "?" . $data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$myxml = curl_exec($curl);

if($myxml == 'Unauthorized'){
	die("Não Autorizado!");
}

curl_close($curl);

$xml = simplexml_load_string($myxml);
if(count($xml ->error) > 0){
	die("Erro");
}

include "../config/config.php";

$codigoTransacao = str_ireplace("-", "", $xml -> code);
$ref = $xml -> reference;
$status = $xml -> status;
$item = $xml -> items -> item;
$data = $xml -> lastEventDate;
$produto = $item -> description;


echo "codigo=" . $codigoTransacao . "\nref=" . $ref . "\nstatus=" . $status . "\nid=" . $item->id . "\nproduto=" . $produto . "\n";


$sql = $mysqli->query("UPDATE tb_transacao SET codigo ='$codigoTransacao', status = '$status', data = '$data' WHERE idtb_aluno = '$ref'");
$sql = $mysqli->query("UPDATE tb_turma_aluno SET tb_pagamento_idtb_pagamento ='$status', WHERE tb_aluno_idtb_aluno = '$ref'");
$a = $mysqli_query("SELECT ")
// if(substr_count($ref, "facilite-cursos") > 0){
// 	$tmpStatus;
// 	$aluno = substr($ref, strpos($ref, "_")+1);
// 	$curso = $item -> id;

// 	switch($status){
// 		case 1:
// 		$tmpStatus = 1;
// 		break;
// 		case 2:
// 		$tmpStatus = 2;
// 		break;
// 		case 3:
// 		$tmpStatus = 3;
// 		break;
// 		default:
// 		$tmpStatus = 0;
// 		break;
// 	}

// 	$sql = "UPDATE tb_turma_aluno
// 	SET tb_pagamento_idtb_pagamento=$tmpStatus
// 	WHERE tb_curso_idtb_curso=$curso AND tb_aluno_idtb_aluno=$aluno";
// 	$query = mysqli_query($mysqli, $sql) or die("Erro!\n" . mysqli_error($mysqli));
// }


    /*
	$sql = "SELECT * FROM transacoes WHERE cod = '$codigoTransacao'";
	$query = mysqli_query($con, $sql) or die("Erro na procura " . mysqli_error($con));
	$res = mysqli_fetch_assoc($query);
	
	if(empty($res)){
		$sql = "INSERT INTO transacoes (cod, status, ref) VALUES('$codigoTransacao', $status, '$ref')";
		$query = mysqli_query($con, $sql) or die("Erro ao adicionar transação " . mysqli_error($con));
		enviar();
	}else{
		if($res["status"] != 3){
			$sql = "UPDATE transacoes SET status = $status WHERE cod = '$codigoTransacao'";
			$query = mysqli_query($con, $sql) or die("Erro ao atualizar transação " . mysqli_error($con));
			enviar();
		}
	}
    */
	echo "Transação retornada com sucesso";
	
	function enviar(){
		global $status;
		global $codigoTransacao;
		global $produto;
		
		if($status == 3){
			session_start();
			
			$data["status"] = (string) $status;
			$data["cod_transacao"] = $codigoTransacao;
			$data["produto"] = $produto;
			$data = http_build_query($data);
			
			$curl = curl_init("http://mkgcriacoes.com.br/Php/pagseguro_retornoChave.php");
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			$myxml = curl_exec($curl);
			
			echo $myxml;
		}
	}