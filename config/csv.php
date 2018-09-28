<?php

include "config.php";  

header("Content-type: application/csv");   
header("Content-Disposition: attachment; filename=file.csv");   
header("Pragma: no-cache");   

$sql = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma = '".$_GET['id']."'");  
$a = $mysqli->query("SELECT *FROM tb_aluno WHERE idtb_aluno = '".$sql->fetch_assoc()['tb_aluno_idtb_aluno']."'");  
while ($ln = $a->fetch_assoc())  
{ 


	echo $ln['nome']."\n";
	echo $ln['idtb_aluno']."\n";
	echo $ln['cpf']."\n";
	echo $ln['rg']."\n";
} 



?>