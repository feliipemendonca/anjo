<?php
	$curso = 1;

	$sql = "SELECT curso FROM tb_curso
			WHERE idtb_curso=$curso";
	$query = mysqli_query($mysqli, $sql) or die("Erro ao obter os cursos!");

	if(!($res = mysqli_fetch_assoc($query))) die("Curso não existe!");

	$pasta = "img_cursos/" . $res["curso"];
	$album = $pasta . "/.album";
	
	function genFileName($pasta){
		$newNome = "";
		$letters_numbers = array_merge(range("A", "Z"), range(0, 9));
		
		while(strlen($newNome) < 20){
			$newNome .= $letters_numbers[rand(0, count($letters_numbers)-1)];
		}
		
		if(getFilesNames($pasta, $newNome)) return genFileName($pasta);
		return $newNome;
	}
	
	function getFilesNames($pasta, $arquivo){
		$arqs = scandir($pasta);
		
		for($a=0; $a<count($arqs); $a+=1){
			if($arqs[$a] == $arquivo) return true;
		}
		
		return false;
	}