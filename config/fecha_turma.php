<?php 

$sql = $mysqli->query("SELECT *FROM tb_turma");

while ($ln = $sql->fetch_assoc()) {

	$t= $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma ='".$ln['idtb_turma']."'") or die($mysqli->error);

	if ($t->num_rows == $ln['vagas']) {
		$mysqli->query("UPDATE tb_turma SET ativa ='0' WHERE idtb_turma = '".$ln['idtb_turma']."'") or die($mysqli->error);	
	}

}

?>