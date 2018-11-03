<!DOCTYPE html>
<html lang="pt">
<head>
	<?php include "config/tema-top.php"; ?>
	<meta charset="utf-8">
	<title>Sobre</title>
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
				<li class="nav-item">
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
	<img src="img/logo.png" class="logo" alt="">
	<section class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h4>Somos um empresa com 15 anos de experiência</h4>
					<p class="text-left">Ser referência no mercado de trabalho e de excelência do país, através da educação de qualidade, metodologias inovadoras e com a prática do ensino, de pesquisa aplicada e da extensão, transformando a sociedade moderna.</p>
					<p class="text-left">Nossa Visão é desenvolver um padrão de ensino renovado e flexível, a partir da construção coletiva da proposta pedagógica da empresa, considerando, particularmente, as necessidades, expectativas e condições de vida e trabalho da clientela ou empresas à qual prestará os serviços profissionalizantes.</p>
				</div>
				<div class="col-sm-12 col-md-6">
					<img src="img/1856.jpg" class="img-fluid" alt="">
				</div>
			</div>
		</div>
	</section>
	<section class="curso-content-top">
		<div class=" text-center box-shadow">
			<div class="jumbotron">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<p class="jumbotron-heading text-left"><strong>Missão</strong></p>
							<p class="text-left">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.
								</small>
							</p>
						</div>
						<div class="col-sm-12 col-md-4">
							<p class="jumbotron-heading text-left"><strong>Visão</strong></p>
							<p class="text-left">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.
								</small>
							</p>
						</div>
						<div class="col-sm-12 col-md-4">
							<p class="jumbotron-heading text-left"><strong>Valores</strong></p>
							<p class="text-left">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat.
								</small>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="content-bottom">
		<div class="container">			
			<h1 class="mt-5 text-center">Equipe</h1><br>
			<div class="content-header">
				<div class="row">
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<img class="card-img-top" src="img/4770.jpg" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">nome do nome</h5>
								<p class="card-text">Função </p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<img class="card-img-top" src="img/4770.jpg" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">nome do nome</h5>
								<p class="card-text">Função </p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<img class="card-img-top" src="img/4770.jpg" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">nome do nome</h5>
								<p class="card-text">Função </p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<img class="card-img-top" src="img/4770.jpg" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title">nome do nome</h5>
								<p class="card-text">Função </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--
	<div class="col-12">
		<div class="content-cont row">
			<div class="col-md-3 col-sm-12 text-center">
				<div class="content-about">
					<img src="img/1.png">
					<hr>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</span>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 text-center">
				<div class="content-about">
					<img src="img/1.png">
					<hr>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</span>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 text-center">
				<div class="content-about">
					<img src="img/1.png">
					<hr>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</span>
				</div>
			</div>
			<div class="col-md-3 col-sm-12 text-center">
				<div class="content-about">
					<img src="img/1.png">
					<hr>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.</span>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
-->


<section class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d3969.284425498702!2d-35.241036185745585!3d-5.815447958968642!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x7b25538c4b05da1%3A0x2c3442a5f8b8a09c!2sR.+Bianor+Medeiros%2C+226+-+Bom+Pastor%2C+Natal+-+RN%2C+59060-230!3m2!1d-5.8154533!2d-35.2388475!4m5!1s0x7b25538c4b05da1%3A0x2c3442a5f8b8a09c!2sRua+Bianor+Medeiros%2C+226+-+Bom+Pastor!3m2!1d-5.8154533!2d-35.2388475!5e0!3m2!1spt-BR!2sbr!4v1523542864228" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

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