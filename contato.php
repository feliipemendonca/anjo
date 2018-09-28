<?php
include "config/config.php";

?>


<!DOCTYPE html>
<html lang="pt">
<head>
	<?php include "config/tema-top.php"; ?>
	<title>Anjos da Noite Cursos e Resgates</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<style type="text/css">
	@media(min-width: 1024px){
		.content-top .container .row{
			padding: 3em;
			padding-top: 0;
			
		}
	}
</style>

</head>
<body>
	<main class="container">
		<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-sm-12 col-md-4 pt-1"></div>
				<div class="col-sm-12 col-md-4 text-center">
					<a class="blog-header-logo text-dark" href="#"><img src="img/logo.png" width="215px" alt=""></a>
				</div>
				<div class="col-sm-12 col-md-4 d-flex justify-content-end align-items-center">
				</div>
			</div>
		</header>
		<hr>
		<div class="nav-scroller py-1 mb-2">
			<ul class="nav d-flex justify-content-between">
				<a class="p-2 text-muted" href="../">inicio</a>
				<a class="p-2 text-muted" href="sobre.php">sobre</a>
				<a class="p-2 text-muted" href="curso/">cursos</a>
				<a class="p-2 text-muted" href="servico.php">serviços</a>
				<a class="p-2 text-muted" href="galeria.php">galeria</a>
				<a class="p-2 text-muted active" href="contato.php">contato</a>
				<a class="p-2 text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
				<form action="login.php" method="post" class="dropdown-menu p-4">
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
					<p class="jumbotron-heading text-left">Contato</p>
				</div>
			</div>
		</div>
	</section> -->
	<section class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h2 class="text-center">Vamos bater um papo!</h2>
					<p class="text-center"><small>Escreva qual a sua nessecidade e responderemos o mais rápido possível. :)</small></p>
				</div>
				<div class="col-sm-12 col-md-12">
					<?php if (isset($_POST['contato_msg'])) {
						$d = date("d-m-y");
						$sql = $mysqli->query("INSERT INTO tb_msg(msg, nome, contato, data) VALUES('".$_POST['msg']."','".$_POST['nome']."','".$_POST['contato']."','$d')") or die($mysqli->error);

						if ($sql) {
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
							<strong>Sucesso!</strong> Em breve entraremos em Contato.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}
					} ?>
					<form action="" method="post">
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<label>Nome<em>*</em></label>
								<input type="text" class="form-control use-soLetras" name="nome">
							</div>
							<div class="col-sm-12 col-md-6">
								<label>Contato<em>*</em></label>
								<input type="text" class="form-control use-soNumeros celular" placeholder="Preferência Whatsapp" name="contato">
							</div>
							<div class="col-sm-12 col-md-12">
								<label>Mensagem<em>*</em></label>
								<textarea class="form-control use-soLetras" name="msg" rows="5"></textarea>
								<br>
							</div>
							<div class="col-sm-12 col-md-10"></div>
							<div class="col-sm-12 col-md-2">
								<button type="submit" class="btn btn-secondary form-control" name="contato_msg" value="contato_msg">Enviar</button>
							</div>
						</div>
					</form>
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
	<script type="text/javascript" src="../js/valCampos.js" ></script>
	<script class="tmpScript" type="text/javascript" src="../js/valCampos_execute.js" ></script>
	<script src="../js/jquery.mask.js"></script>
	<script>

		$('.rg').mask('000.000.000', {reverse: true});
		$('.cpf').mask('000.000.000-00', {reverse: true});
		$('.celular').mask('(00) 0 0000-0000');
		$('.fixo').mask('(00) 0000-0000');
		$('.cep').mask('00000-0000');

	</script>

</body>
</html>