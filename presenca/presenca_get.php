<!DOCTYPE html>
<html>
	<body>
		<?php
			include "../config/config.php";
			
			$data = $_POST["data_get"];
			$turma = $_POST["turma_get"];
			
			$data = str_replace(",", "/", $data);
			
			$sql = "SELECT p.alunos_id, p.presencas FROM tb_presenca p
					JOIN tb_dia_letivo dia ON dia.id = p.id_data
					WHERE dia.data=STR_TO_DATE('$data', '%d/%m/%Y') AND p.id_turma=$turma";
			$query = mysqli_query($mysqli, $sql) or die("Erro1!");
			
			$res = mysqli_fetch_assoc($query);
			
			$alunos = $res["alunos_id"];
			$presencas = $res["presencas"];
		?>
		<script>
			var els = parent.document.getElementsByName("id_aluno"),
				alunos = "<?php echo $alunos ?>".split(","),
				presencas = "<?php echo $presencas ?>".split(",");
			
			if (presencas.length > 0 && presencas[0] != ""){
				for (var a=0, b=0; a<els.length && b<presencas.length; a+=1){
					if (els[a].value == alunos[b]){
						els[a].parentElement.getElementsByTagName("th")[2].firstElementChild.checked = (presencas[b] == 1) ? true : false;
						b+=1;
					}else{
						var el = els[a].parentElement;
						el.className = "disabled";
						el.getElementsByTagName("th")[2].firstElementChild.checked = false;
					}
				}
			}else {
				for (var a=0; a<els.length; a+=1){
					els[a].parentElement.getElementsByTagName("th")[2].firstElementChild.checked = false;
				}
			}
		</script>
	<body>
</html>