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
	<!-- <header>
		<ul class="icons">
			<li><a href="" title=""><i class="fab fa-facebook"></i></a></li>
			<li><a href="" title=""><i class="fab fa-instagram"></i></a></li>
			<li><a><i class="fas fa-envelope"></i> anjosdanoite@anjosdanoite.com </a></li>
		</ul>
	</header>
	<nav class="navbar-expand-lg">
		<a class="navbar-brand" href="../index.php"><img src="../img/logo.png" alt=""></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span><i class="fas fa-bars"></i></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="../sobre.php">sobre</span></a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="index.php">curso</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../servico.php">serviços</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="../galeria.php">galeria</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../contato.php">contato</a>
				</li>
				<li class="nav-item">
					<div class="btn-group">
						<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-lock"></i>login
						</button>
						<form action="../login.php" method="post" class="dropdown-menu p-4">
							<div class="form-group">
								<label for="exampleDropdownFormEmail2">Email<em>*</em></label>
								<input type="email" class="form-control" name="email" id="exampleDropdownFormEmail2" placeholder="email@example.com">
							</div>
							<div class="form-group">
								<label for="exampleDropdownFormPassword2">Senha<em>*</em></label>
								<input type="password" class="form-control" name="senha" id="exampleDropdownFormPassword2" placeholder="Password">
							</div>
							<button type="submit" name="login" value="login" class="btn btn-danger">Entrar</button>
						</form>
					</div>
				</li>
			</ul>
		</div>
	</nav> -->
	<main class="container">
		<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-sm-12 col-md-4 pt-1"></div>
				<div class="col-sm-12 col-md-4 text-center">
					<a class="blog-header-logo text-dark" href="#"><img src="../img/logo.png" width="215px" alt=""></a>
				</div>
				<div class="col-sm-12 col-md-4 d-flex justify-content-end align-items-center">
				</div>
			</div>
		</header>
		<hr>
		<div class="nav-scroller py-1 mb-2">
			<ul class="nav d-flex justify-content-between">
				<a class="p-2 text-muted" href="../">inicio</a>
				<a class="p-2 text-muted" href="../sobre.php">sobre</a>
				<a class="p-2 text-muted active" href="index.php">cursos</a>
				<a class="p-2 text-muted" href="../servico.php">serviços</a>
				<a class="p-2 text-muted" href="../galeria.php">galeria</a>
				<a class="p-2 text-muted" href="../contato.php">contato</a>
				<a class="p-2 text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
				<form action="../login.php" method="post" class="dropdown-menu p-4">
					<div class="form-group">
						<label for="exampleDropdownFormEmail2">Email<em>*</em></label>
						<input type="email" class="form-control" name="email" id="exampleDropdownFormEmail2" placeholder="email@example.com">
					</div>
					<div class="form-group">
						<label for="exampleDropdownFormPassword2">Senha<em>*</em></label>
						<input type="password" class="form-control" name="senha" id="exampleDropdownFormPassword2" placeholder="Password">
					</div>
					<button type="submit" name="login" value="login" class="btn btn-danger">Entrar</button>
				</form>
			</ul>
		</div>
		<hr>
	</main>
<!-- 	<section class="curso-content-top">
		<div class=" text-center box-shadow">
			<div class="jumbotron">
				<div class="container">
					<p class="jumbotron-heading text-left">Nossos Cursos</p>
				</div>
			</div>
		</div>
	</section> -->
	<section class="curso-content-bottom">
		<div class="container">
			<div class="row">
				<?php

				$sql = $mysqli->query("SELECT *FROM tb_curso WHERE ativa = 1  ORDER BY curso ASC");
				while ($ln = $sql->fetch_assoc()) { 

					?>
					<div class="col-sm-12 col-md-6">
						<div class="card">
							<div class="carousel-item">
								<img class="card-img-top img-fluid" src="../upload/<?php echo $ln['img'] ?>" style=" height: 17em;" alt="curso anjos da noite: <?php echo $ln['curso']; ?>">
							</div>

							<div class="card-body">
								<h4><strong><?php echo $ln['curso']; ?></strong></h4>
								<p class="card-text"><?php echo $ln['sobre'] ;?></p>
								<br>
								<div class="top">
									<?php $t = $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '".$ln['idtb_curso']."' AND ativa ='1'") or die($mysqli->error);

									if ($t->num_rows) {	?>
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
																	<?php
																	while($tu = $t->fetch_assoc()){ ?>
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
											<?php 
										}else{
											?>

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

											<?php
										}
										?>										
										<br>
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
