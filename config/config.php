<?php  

// $servidor = 'localhost';
// $usuario = 'root';
// $senha = '';
// $banco = 'facilite';

// $mysqli = new mysqli($servidor, $usuario, $senha, $banco);

// if ($mysqli->connect_errno) {
// 	printf("Error na conexão: ",$mysqli->connect_errno);
// 	exit();
// }

$servidor = 'mysql.hostinger.com.br';
$usuario = 'u305588326_facil';
$senha = 'Cl1l8jg9Ij29';
$banco = 'u305588326_facil';

$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

if ($mysqli->connect_errno) {
	printf("Error na conexão: ",$mysqli->connect_errno);
	exit();
}
?>