<?php

include "../config/config.php";

$id = base64_decode($_GET['url']);

$sql = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma = '$id' ") or die($mysqli->error);
while ($n = $sql->fetch_assoc()) {

	$idtb_curso = $n['tb_curso_idtb_curso'];
	
}

$a = $mysqli->query("SELECT *FROM tb_turma WHERE idtb_turma = '$id' ") or die($mysqli->error);
$idtb_professor = $a->fetch_assoc()['tb_professor_idtb_professor'];
$p = $mysqli->query("SELECT *FROM tb_professor WHERE idtb_professor = '$idtb_professor' ") or die($mysqli->error);
$c = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '$idtb_curso' ") or die($mysqli->error);




?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>ADM | PROFº | TURMA - ALUNO </title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<hr>
				<div class="row">
					<div class="col-md-10">
						<div class="justify-content-end">
							<h2>Anjos da Noite Resgate e Cursos Ltda - ME</h2>	
						</div>					
					</div>	
					<div class="col-md-2">
						<img src="../img/logo.png" width="100%">						
					</div>				
				</div>	
				<p><strong>Lista de Presença: <?php echo date("d/m/Y") ?></strong> | <strong>Professor: <?php echo $p->fetch_assoc()['nome']; ?></strong></p>
				<hr>			
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>P | F</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$z = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma = '$id' ") or die($mysqli->error);
							while($ln = $z->fetch_assoc()) {

								$idtb_aluno = $ln['tb_aluno_idtb_aluno'];


								$s = $mysqli->query("SELECT *FROM tb_aluno WHERE idtb_aluno = '$idtb_aluno' ") or die($mysqli->error);

								while ($l = $s->fetch_assoc()) {

									?>
									<tr>
										<td><?php echo $l['idtb_aluno']; ?></td>
										<td style="width: 91%;"><?php echo $l['nome']; ?></td>
										<td>
											<form class="form-inline">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1" style="margin-right: 7px; float: left;">
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
												</div>

											</form>
										</td>
									</tr>

									<?php
								}
							}
							?>						
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-10"></div>
					<div class="col-md-2">
						<a href="" class="btn btn-primary form-control" title="">Imprimir</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>