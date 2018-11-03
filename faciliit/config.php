<?php
$servidor = 'mysql.hostinger.com.br';
$usuario = 'u305588326_felip';
$senha = '31Bmj3FhoCBMEk2Hof';
$banco = 'u305588326_felip';

$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

if ($mysqli->connect_errno) {
	printf("Error na conexão: ",$mysqli->connect_errno);
}

$sql = $mysqli->query("INSERT INTO tb_contato (nome, tel, email, msg) VALUES('".$_POST['nome']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['msg']."')") or die($mysqli->error);

if ($sql) {
	echo "<script>alert('Mensagem Enviada com Sucesso. Em breve entraremos em contato!');href.location='index.php';</script";
}
?>