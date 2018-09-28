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
	<main class="container">
		<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-sm-12 col-md-4 pt-1"></div>
				<div class="col-sm-12 col-md-4 text-center">
					<a class="blog-header-logo text-dark" href="index.php"><img src="img/logo.png" width="215px" alt=""></a>
				</div>
				<div class="col-sm-12 col-md-4 d-flex justify-content-end align-items-center">
				</div>
			</div>
		</header>
		<hr>
		<div class="nav-scroller py-1 mb-2">
			<ul class="nav d-flex justify-content-between">
				<a class="p-2 text-muted active" href="../">inicio</a>
				<a class="p-2 text-muted" href="sobre.php">sobre</a>
				<a class="p-2 text-muted" href="curso/">cursos</a>
				<a class="p-2 text-muted" href="servico.php">serviços</a>
				<a class="p-2 text-muted" href="galeria.php">galeria</a>
				<a class="p-2 text-muted" href="contato.php">contato</a>
				<a class="p-2 text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
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
			</ul>
		</div>
		<hr>
	</main>
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
	<section class="content-top">
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