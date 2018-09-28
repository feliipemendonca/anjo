<?php
$idtb_prof = $_SESSION['idtb_login'];
$sql = "SELECT *FROM tb_professor WHERE tb_login_idtb_login = '$idtb_prof'";
$pro = $mysqli->query($sql) or die("Erro!<br>" . mysqli_error($mysqli));

$ln = $pro->fetch_assoc();
$nome = $ln['nome'];
$idtb_professor = $ln['idtb_professor'];$ln['tb_contato_idtb_contato'];

$c = $mysqli->query("SELECT *FROM tb_contato WHERE idtb_contato = '".$ln['tb_contato_idtb_contato']."'");
$l = $c->fetch_assoc();

/* UM WHILE IRÁ PUXAR MAIS DE UM PROFESSOR, MAS SÓ QUEREMOS UM
    NA ID QUE APONTA PARA O LOGIN
while ($ln = $pro->fetch_assoc()) {
	$nome = $ln['nome'];
	$idtb_professor = $ln['idtb_professor'];
}
*/
?>