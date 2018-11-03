<?php
	include "../config/config.php";
	
	$ids = $_POST["ids_post"];
	$presentes = $_POST["presentes_post"];
	$data = $_POST["data_post"];
	$turma = $_POST["turma_post"];
	
	$data = str_replace(",", "/", $data);
	
	$sql = "SELECT p.id FROM tb_presenca p
			JOIN tb_dia_letivo dia ON dia.id = p.id_data
			WHERE dia.data=STR_TO_DATE('$data', '%d/%m/%Y') AND p.id_turma=$turma";
	$query = mysqli_query($mysqli, $sql) or die("Erro1!");
	
	if(mysqli_num_rows($query) > 0){
		$id = mysqli_fetch_assoc($query)["id"] or die("Erro2!");
		$sql = "UPDATE tb_presenca
				SET alunos_id='$ids', presencas='$presentes'
				WHERE id='$id'";
		mysqli_query($mysqli, $sql) or die("Erro ao atualizar!");
	}else{
		$sql = "SELECT id FROM tb_dia_letivo
				WHERE data=STR_TO_DATE('$data', '%d/%m/%Y')";
		$query = mysqli_query($mysqli, $sql) or die("Erro3!");
		
		$id;
		if (mysqli_num_rows($query) > 0) $id = mysqli_fetch_assoc($query)["id"] or die("Erro4!");
		else{
			$sql = "INSERT INTO tb_dia_letivo (data)
					VALUES (STR_TO_DATE('$data', '%d/%m/%Y'))";
			$query = mysqli_query($mysqli, $sql) or die("Erro5!");
			$id = mysqli_insert_id($mysqli);
		}
		
		$sql = "INSERT INTO tb_presenca(id_data, id_turma, alunos_id, presencas)
				VALUES($id, $turma, '$ids', '$presentes')";		
		mysqli_query($mysqli, $sql) or die("Erro ao inserir!");
	}
?>
<script>
	alert("Presença de alunos atualizada com sucesso!");
</script>