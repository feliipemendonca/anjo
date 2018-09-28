<?php $y = $mysqli->query("SELECT *FROM tb_modulo WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."'");
if ($y->num_rows >= 1){ 
	while ($a = $y->fetch_assoc()) {
		echo $a['nome']."   ";
	} 
} ?>