<?php 
include "config/config.php";
include "config/query.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<?php include "config/tema-top.php"; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Anjos | Serviços</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<style type="text/css">
	.card-body .btn-warning{
		width: 60% !important;
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
				<a class="p-2 text-muted active" href="servico.php">serviços</a>
				<a class="p-2 text-muted" href="galeria.php">galeria</a>
				<a class="p-2 text-muted" href="contato.php">contato</a>
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

	<section class="curso-content-bottom">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<?php 
					if (isset($_POST['solicitacao'])) {

						$sql = $mysqli->query("INSERT INTO tb_solicitacao(contato, servico, empresa, cnpj, nome, email, mensagem, cargo) VALUES ('".$_POST['telefone']."','".$_POST['id']."','".$_POST['empresa']."','".$_POST['cnpj']."','".$_POST['nome']."','".$_POST['email']."','".$_POST['mensagem']."','".$_POST['cargo']."')")  or die($mysqli->error);

						if ($sql) {
							echo "<div class='alert alert-primary alert-dismissible' role='alert'>
							<strong>Sucesso!</strong> Em breve entraremos em Contato.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}else{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'>
							<strong>Error!</strong> tente Novamente.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}
					}
					?>
				</div>
				<?php


				$sql = $mysqli->query("SELECT *FROM tb_servico ORDER BY nome ASC");
				while ($ln = $sql->fetch_assoc()) { 

					?>
					<div class="col-sm-12 col-md-6">
						<div class="card mb-4 box-shadow">
							<div class="carousel-item">
								<img class="card-img-top img-fluid" src="../upload/<?php echo $ln['img'] ?>" style=" height: 17em;" alt="cuso anjos da noite: <?php echo $ln['nome']; ?>">
							</div>
							<div class="card-body">
								<p><strong><?php echo $ln['nome']; ?></strong></p>
								<p class="card-text"><?php echo $ln['descricao'] ;?></p>
								<br>
								<button class="btn btn-outline-secondary" data-toggle="modal" data-target="#<?php echo $ln['idtb_servico']; ?>" title="<?php echo $ln['nome']; ?>" style="margin-bottom: 2em;">Entre em contato</button>
							</div>
						</div>
					</div>
					<div class="modal" tabindex="-1" role="dialog" id="<?php echo $ln['idtb_servico']; ?>">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><strong>Contato</strong></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="" method="post" accept-charset="utf-8">
									<div class="modal-body">
										<div class="row">
											<input type="hidden" name="id" value="<?php echo $ln['nome']; ?>"> 
											
											<div class="col-sm-12 col-md-12">
												<label>Empresa<em>*</em></label>
												<input type="text" class="form-control use-soLetras" name="empresa">
											</div>
											<div class="col-sm-12 col-md-6">
												<label>CNPJ<em>*</em></label>
												<input type="tel" class="form-control use-soNumeros cnpj" name="cnpj">
											</div>
											<div class="col-sm-12 col-md-6">
												<label>Responsável<em>*</em></label>
												<input type="text" class="form-control use-soLetras" name="nome" placeholder="">
											</div>
											<div class="col-sm-12 col-md-6">
												<label>Cargo<em>*</em></label>
												<input type="text" class="form-control use-soLetras" name="cargo" placeholder="EX: Gerente, Supervisor...">
											</div>
											<div class="col-sm-12 col-md-6">
												<label>Telefone<em>*</em></label>
												<input type="tel" class="form-control use-soNumeros tel" name="telefone" placeholder="Preferência Whatsapp">
											</div>
											<div class="col-sm-12 col-md-12">
												<label>E-mail<em>*</em></label>
												<input type="email" class="form-control use-soLetras" name="email">
											</div>
											<div class="col-sm-12 col-md-12">
												<label>Mensagem<em>*</em></label>
												<textarea class="form-control" name="mensagem" rows="5" placeholder="Descreva aqui a quaid" required></textarea>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
										<button type="submit" class="btn btn-warning" name="solicitacao" value="servico">Enviar</button>
									</div>
								</form>
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


	<script src="js/popper.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/valCampos.js"></script>
	<script src="js/valCampos_execute.js"></script>
	<script src="js/jquery.mask.js"></script>
	<script>
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
		$('.tel').mask('(00) 0 0000-0000');
	</script>


</body>
</html>