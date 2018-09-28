<?php

include "../../config/seguranca.php"; 

include "../../config/modal.php";

$sql = $mysqli->query("SELECT *FROM tb_dado_prof WHERE tb_professor_idtb_professor = '".$_SESSION['idtb_professor']."'");

$a = $mysqli->query("SELECT *FROM tb_turma WHERE tb_professor_idtb_professor = '".$_SESSION['idtb_professor']."'");
$b = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '".$a->fetch_assoc()['tb_curso_idtb_curso']."'");


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

	
	<link rel="stylesheet" href="../../css/bootstrap.css">
	<link rel="stylesheet" href="../../css/dashboard.css">


</head>
<body>
	<div class="container">
		<main role="main" class="col-sm-12 ml-sm-auto col-md-12 pt-3">
			<a href="index.php" title="Voltar?"><</a>
			<h1 class="text-center">Dashboard</h1>

			<section class="row placeholders">
				<div class="col-6 col-sm-4 col-md-3 placeholder text-center">
					<a href="turma.php" title="">
						<img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
						<h4>Turma</h4>
						<div class="text-muted">Something else</div>
					</a>
				</div>
				<div class="col-sm-8 col-md-9">
					<p>Pesquisa de Aluno</p>
					<form action="" method="post">
						<div class="row">						
							<div class="col">
								<input type="tel" class="form-control" placeholder="CPF do Aluno" name="cpf" required autofocus>
							</div>
							<div class="col">
								<select name="curso" class="form-control" title="Selecione Curso" required autofocus>
									<option value="">Selecione Curso</option>
									<?php while ($l = $b->fetch_assoc()) {?>
									<option value="<?php echo $l['idtb_curso']; ?>"><?php echo $l['curso']; ?></option>
									<?php } ?>									
								</select>								
							</div>
							<div class="col">
								<button type="submit" class="btn btn-danger">Pesquisar</button>
								
							</div>
						</div>
					</form>
					<div class="col-sm-12 col-md-12">
						<?php $sql = $mysqli->query("SELECT *FROM tb_turma WHERE tb_professor_idtb_professor = '".$_SESSION['idtb_professor']."'");
						if ($sql->num_rows > 1) { ?>

						<p class="text-center">Não sei O que colocar aqui. :D</p>

						<?php } else{?>
						<br><br>
						<p class="text-center">Ainda não há Turma Cadastrada.</p>
						<br><br>

						<?php } ?>
					</div>
				</div>
				
			</section>
			
			<footer>
				<hr>
				<p class="text-center text-muted">Desenvolvido Faciliit. Todos os diretos resevados Anjos da Noite</p>
			</footer>




			<script src="../../js/popper.min.js"></script>
			<script src="../../js/jquery.min.js"></script>
			<script src="../../js/bootstrap.js"></script>



		</body>
		</html>