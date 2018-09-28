<?php
	function sendErro($msg, $ref){
		?>
		<script>
			try{
				var tb_notas = parent.document.getElementById("tb_notas_aluno"),
					notas = tb_notas.getElementsByClassName("tb_td_nota");
				
				var el;
				console.log(notas);
				for(var a=4; a<notas.length; a+=1){
					var nota = notas[a].firstChild;
					if("<?php echo $ref; ?>" == nota.getAttribute("tag")){
						el = nota;
						break;
					}
				}
				
				el.value = parent.notaSalva;
			}catch (except){}
			
			alert("<?php echo $msg; ?>".replace("<br>", "\n"));
		</script>
		<?php
		exit();
	}
?>

<?php
	include "../config/seguranca.php";
    include "../professor/checkSession.php";
	
	if(!isset($_SESSION["tokenGenerated"])) sendErro("Não autorizado!", "");
	
    var_dump($_POST);
	if(!($token = $_POST["token"]) || !($aluno = $_POST["aluno"]) || !($turma = $_SESSION["turma"]) || !($nota = $_POST["nota"]) || !($ref = (int) $_POST["ref"])){
        var_dump($token);
        var_dump($aluno);
        var_dump($turma);
        var_dump($nota);
        var_dump($ref);
		sendErro("Não autorizado!", "");
	}
	
	if($token != $_SESSION["tokenGenerated"] || strlen($token) != 16) sendErro("Não autorizado!", $ref);
	if($nota=="") sendErro("Nota invalida!", $ref);
	$nota = (float) $nota;
	if($nota < 0 || $nota > 10) sendErro("Nota invalida!", $ref);
	if($ref < 0 || $ref > 4) sendErro("Referência da nota invalida!", $ref);
	
	include "../config/config.php";
	
	$sql = "SELECT n.id,n.nota1,n.nota2,n.nota3,n.nota4 FROM tb_notas n
			JOIN tb_turma_aluno t ON t.idtb_turma_aluno = n.id_turma_aluno
			JOIN tb_aluno a ON a.idtb_aluno = t.tb_aluno_idtb_aluno
			WHERE t.tb_aluno_idtb_aluno=$aluno AND t.tb_turma_idtb_turma=$turma";
	$query = mysqli_query($mysqli, $sql);
	
	if(!$query) sendErro("Ocorreu um erro ao buscar as notas do aluno!", $ref);
	if(mysqli_num_rows($query) > 0){
		$res = mysqli_fetch_assoc($query);
		if($res["nota" . $ref]){}
		
		$sql = "UPDATE tb_notas
				SET nota" . $ref . "=$nota, envio_nota" . $ref . "=NOW()
				WHERE id=" . $res["id"];
		$query = mysqli_query($mysqli, $sql);
		
		if(!$query) sendErro("Ocorreu um erro ao atualizar as notas do aluno!", $ref);
	}else{
		$sql = "INSERT INTO tb_notas(id_turma_aluno, nota" . $ref . ", envio_nota" . $ref . ")
				VALUES (
						(SELECT idtb_turma_aluno FROM tb_turma_aluno
						WHERE tb_aluno_idtb_aluno=$aluno AND tb_turma_idtb_turma=$turma),
					$nota, NOW()
				)";
		$query = mysqli_query($mysqli, $sql);
		
		if(!$query){
			if (mysqli_error($mysqli) == "Column 'id_turma_aluno' cannot be null") sendErro("Ocorreu um erro ao inserir a nota do aluno!<br>Aluno não existe ou não é da turma informada!", $ref);
			else sendErro("Ocorreu um erro ao inserir a nota do aluno!", $ref);
		}
	}
?>
<script>
	alert("Nota enviada com sucesso!");
	parent.location.reload();
</script>