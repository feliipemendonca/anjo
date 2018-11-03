<?php include "config/config.php";


if (isset($_POST['contato_msg'])) {
	$d = date("d-m-y");
	$sql = $mysqli->query("INSERT INTO tb_msg(msg, nome, contato, data) VALUES('".$_POST['mensagem']."','".$_POST['nome']."','".$_POST['email']."','$d')") or die($mysqli->error);

	if ($sql) {
		echo "<script>alert('Obrigado! Em breve entraremos em Contato');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php include "config/tema-top.php"; ?>
	<title>Anjos da Noite Cursos e Resgates</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="index.php"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="../">inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="sobre.php">sobre</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="curso/">cursos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="servico.php">serviços</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="galeria.php">galeria</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contato.php">contato</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
					<form action="login.php" method="post" class="dropdown-menu p-4">
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

	<article id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="img/abd.png" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="img/abd.png" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="img/abd.png" alt="Third slide">
			</div>
		</div>
	</article>
	<img src="img/logo.png" class="logo" alt="">
	<section class="curso-content-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h1 class="text-center">Cursos</h1>
					<p class="text-center">Conheça nossos cursos. Com nossa metódologia garantimos aprendizado pra você ser, o profissional que o mercado espera! </p>
				</div>
				<?php $sql = $mysqli->query("SELECT *FROM tb_curso WHERE ativa = 1  ORDER BY curso ASC LIMIT 4"); while ($ln = $sql->fetch_assoc()) { ?>
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<div class="">
								<img class="card-img-top img-fluid" style="height: 11em;" src="upload/<?php echo $ln['img'];?>" alt="curso anjos da noite: <?php echo $ln['curso']; ?>">
							</div>
							<div class="card-body">
								<h4><strong><?php echo $ln['curso']; ?></strong></h4>
								<br>
								<div class="top">
									<?php $t = $mysqli->query("SELECT *FROM tb_turma WHERE ativa = 1 AND tb_curso_idtb_curso = '".$ln['idtb_curso']."'") or die($mysqli->error);?>
									<p><a href="" data-toggle="modal" data-target="#curso<?php echo $ln['idtb_curso']; ?>" title="ver Curso"><i class="fas fa-caret-right"></i>Ver Turma</a><span><?php echo "R$".$ln['valor'];?></span></p>
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
															if ($t->num_rows >= 1) { 
																while($tu = $t->fetch_assoc()){
																	?>
																	<a href="cadastro.php?cur=<?php echo base64_encode($tu['tb_curso_idtb_curso']);?>&tur=<?php echo base64_encode($tu['idtb_turma']); ?>&pro=<?php echo base64_encode($tu['tb_professor_idtb_professor']); ?>" class="list-group-item list-group-item-action">
																		Dia / Horário : <?php echo $tu['dia']." /". $tu['hora']; ?> <br>Endereço: <?php echo $tu['endereco'].", ".$tu['bairro'].", ".$tu['cidade'].", ".$tu['numero'].".".$tu['complemento']; ?></a><br>
																		<?php
																	} 
																}else{ ?>

																	<a href="" class="list-group-item list-group-item-action text-center">Turmas Fechadas</a>
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
									<br>
								</div>
							</div>
						</div>				
					<?php } ?>
				</div>		
			</div>
		</section>

		<section class="paralax">
			<div class="top">
				<div class="container">
					<div class="counter-up">
						<h1 class="text-center">Conheça nosso Serviços</h1>
						<p class="text-center">	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercita</p>
						<p class="text-center link"><a href="servico.php">Ver mais</a></p>
					</div>
				</div>
			</div>
		</section>
		<section class="depoimento">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="depoimento-top">
							<h1 class="text-center">Depoimentos</h1>
							<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et d</p>
						</div>
					</div>
					<div class="col-sm-12 col-md-3"></div>
					<div class="col-sm-12 col-md-6">
						<article id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<div class="card">
										<img src="img/1.jpg" class="card-img-top">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<h5>Aluno de Teste</h5><span>Curso de teste</span>
										</div>
									</div>
								</div>	
								<div class="carousel-item">
									<div class="card">
										<img src="img/1.jpg" class="card-img-top">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<h5>Aluno de Teste</h5><span>Curso de teste</span>
										</div>
									</div>
								</div>
								<div class="carousel-item">
									<div class="card">
										<img src="img/1.jpg" class="card-img-top">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											<h5>Aluno de Teste</h5><span>Curso de teste</span>
										</div>
									</div>
								</div>							
							</div>
						</article>						
					</div>
					<div class="col-sm-12 col-md-3"></div>
				</div>
			</div>
		</section>

	<!-- <section class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="media">
						<img src="img/1.png" alt="">
						<div class="media-body">
							<h5 class="mt-0" style="font-size: 17px;">Experiência</h5>
							<p>Mais de 15 anos de experiência no mercado oferecendo os melhores cursos e serviços.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="media">
						<img src="img/3.png" alt="">
						<div class="media-body">
							<h5 class="mt-0" style="font-size: 17px;">Segurança</h5>
							<p>Trabalhamos com o mais alto padrão de segurança.</p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="media">
						<img src="img/2.png" alt="">
						<div class="media-body">
							<h5 class="mt-0" style="font-size: 17px;">Profissionais Capacidados</h5>
							<p>Contamos com um time de profissionais altamente capacitados para oferecer as cursos e serviços de qualidade.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="paralax">
		<div class="paralax-main">
			<div class="container">
				<div class="col-sm-12 col-md-12">
					<p class="text-center">Visite as nossas redes sociais!</p>
					<div class="nav-scroller py-1 mb-2">
						<ul class="nav d-flex justify-content-between">
							<a class="p-2 text-muted" href="../"><i class="fab fa-facebook-square"></i></a>
							<a class="p-2 text-muted" href="sobre.php"><i class="fab fa-instagram"></i></a>
							<a class="p-2 text-muted" href="curso/"><i class="fab fa-youtube"></i></a>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="content-new">
		<div class="container">
			<h1 class="text-center"></h1>
			<form action="confir.php" method="post" class="form-inline text-center">
				<div class="form-group">
					<label><i class="fas fa-envelope fa-2x"></i>Assine a nossa newsletters</label>
					<input type="email" class="form-control" name="email" placeholder="Digite seu E-mail" required>
					<button type="submit" class="btn-warning"><i class="fas fa-paper-plane"></i></button>
				</div>

			</form>
		</div>
	</section> -->

	<section class="contact">
		<div class="top">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<h1 class="text-center">Contato</h1>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="contact-left">
							<h3>Anjos da Noite Resgate Cursos</h3>
							<p>Rua Natal, Parnamirim, 123, (Rio Grande do Norte)</p>
							<hr>
							<p><span>"</span>Ser referência no mercado de trabalho e de excelência do país, através da educação de qualidade, metodologias inovadoras e com a prática do ensino, de pesquisa aplicada e da extensão, transformando a sociedade moderna.<span>"</span></p>
							<div class="contact-bottom">
								<ul>
									<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
									<li><a href=""><i class="fab fa-instagram"></i></a></li>
									<li><a href=""><i class="fab fa-youtube"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="contact-rigth">
							<form action="" method="post">
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<label for="exampleInputEmail1">Nome<em>*</em></label>
										<span>
											<i class="fas fa-user"></i>
											<input type="text" class="form-control" name="nome" required>
										</span>
									</div>
									<div class="col-sm-12 col-md-6">
										<label for="exampleInputEmail1">E-mail<em>*</em></label>
										<span>
											<i class="fas fa-at"></i>
											<input type="email" class="form-control" name="email" placeholder="Ex: exemplo@exemplo.com">
										</span>
									</div>
									<div class="col-sm-12 col-md-12">
										<label for="exampleInputPassword1">Mensagem<em>*</em></label>
										<span>
											<i class="fas fa-comment-alt"></i>
											<textarea class="form-control" rows="5" name="mensagem" required></textarea>
										</span>
									</div>
								</div>
								<button type="submit" class="btn btn-primary" name="contato_msg" value="contato_msg">Enviar</button>
							</form>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<p class="text-right">©2018 Anjos da Noite. Todos os Direitos Resevados | Designer Faciliit</p>
		</div>
	</footer>

	<script src="js/popper.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	
</body>
</html>