<?php
include "../config/config.php";
include "../config/fecha_turma.php";
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<?php include "../config/tema-top.php"; ?>
	<title>Anjos | Cursos</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
<body>
	<header>
		<div class="header">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="index.php"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="../">inicio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../sobre.php">sobre</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="index.php">cursos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../servico.php">serviços</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../galeria.php">galeria</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../contato.php">contato</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
							<form action="../login.php" method="post" class="dropdown-menu p-4">
								<div class="form-group">
									<label for="exampleDropdownFormEmail2">Email<em>*</em></label>
									<input type="email" class="form-control" name="email" id="exampleDropdownFormEmail2" placeholder="email@example.com" required>
								</div>
								<div class="form-group">
									<label for="exampleDropdownFormPassword2">Senha<em>*</em></label>
									<input type="password" class="form-control" name="senha" id="exampleDropdownFormPassword2" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-danger" name="login" value="login">Entrar</button>
							</form>
						</li>
					</ul>
				</div>
			</nav>
			<div class="counter-up">
				<h1 class="text-center">Cursos</h1>
				<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>
	</header>
	<img src="../img/logo.png" class="logo" alt="">
	<section class="curso-content-bottom">
		<div class="container">
			<div class="row">
				<?php
				$sql = $mysqli->query("SELECT *FROM tb_curso WHERE ativa = 1  ORDER BY curso ASC");
				while ($ln = $sql->fetch_assoc()) { 
					?>
					<div class="col-sm-12 col-md-6">
						<div class="card">
							<img class="card-img-top img-fluid" src="../upload/<?php echo $ln['img'] ?>" style=" height: 17em;" alt="curso anjos da noite: <?php echo $ln['curso']; ?>">
							<div class="card-body">
								<h4><strong><?php echo $ln['curso']; ?></strong></h4>
								<p class="card-text"><?php echo $ln['sobre'] ;?></p>
								<div class="top">
									<?php $t = $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."' AND ativa ='1'") or die($mysqli->error); if ($t->num_rows) { ?>
										<div class="row">
											<div class="col-sm-5 col-md-5">
												<a href="curso.php?id=<?php echo $ln['idtb_curso'];?>" class="btn btn-outline-secondary form-control" title='Mais!'>Detalhes do Curso</a>
											</div>
											<div class="col-sm-5 col-md-4">
												<a href="" class="btn btn-outline-info form-control" data-toggle="modal" data-target="#curso<?php echo $ln['idtb_curso']; ?>" title='Matricule-se já'>Turmas Abertas</a>
											</div>
											<div class="col-sm-2 col-md-3">
												<p class="btn btn-outline-primary form-control" style="height: 2.7em;"><?php echo "R$".$ln['valor']; ?></p>
											</div>
										</div>
									<?php }else{ ?>
										<div class="row">
											<div class="col-sm-5 col-md-5">
												<a href="curso.php?id=<?php echo $ln['idtb_curso'];?>" class="btn btn-outline-secondary form-control" title='Mais!'>Detalhes do Curso</a>
											</div>
											<div class="col-sm-5 col-md-4">
												<a href="" class="btn btn-outline-danger form-control" data-toggle="modal" data-target="#curso<?php echo $ln['idtb_curso']; ?>" title='Matricule-se já'>Turmas Fechadas</a>
											</div>
											<div class="col-sm-2 col-md-3">
												<p class="btn btn-outline-primary form-control" style="height: 2.7em;"><?php echo "R$".$ln['valor']; ?></p>
											</div>
										</div>
									<?php }	?>
								</div>
								<div class="modal" tabindex="-1" role="dialog" id="curso<?php echo $ln['idtb_curso']; ?>">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<p class="modal-title"><strong>Selecione uma turma mais próximo de você</strong></p>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="container">
													<div class="col-sm-12 col-md-12">
														<div class="list-group">
															<?php while($tu = $t->fetch_assoc()){ ?>
																<a href="cadastro.php?cur=<?php echo base64_encode($tu['tb_curso_idtb_curso']);?>&tur=<?php echo base64_encode($tu['idtb_turma']); ?>&pro=<?php echo base64_encode($tu['tb_professor_idtb_professor']); ?>" class="list-group-item list-group-item-action">
																	Dia / Horário : <?php echo $tu['dia']." /". $tu['hora']; ?> <br>Endereço: <?php echo $tu['endereco'].", ".$tu['bairro'].", ".$tu['cidade'].", ".$tu['numero'].".".$tu['complemento']; ?></a><br>
																	<?php 
																} ?>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
				</div>
			</div>
		</section>

		<footer>
			<div class="container">
				<p class="text-right">©2018 Anjos da Noite. Todos os Direitos Resevados | Designer Faciliit</p>
			</div>
		</footer>




		<script src="../js/popper.min.js"></script>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.js"></script>

	</body>
	</html>
