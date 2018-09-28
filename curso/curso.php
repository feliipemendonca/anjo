<?php 
include "../config/config.php";
@$id = $_GET['id'];
$sql = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '$id' LIMIT  1") or die($mysqli->error);
while($ln = $sql->fetch_assoc()) {
	$idtb_curso = $ln['idtb_curso'];
	$curso = $ln['curso'];
	$sobre = $ln['sobre'];
	$img = $ln['img'];
	$valor = $ln['valor'];
	$mercado = $ln['mercado'];
	$publico = $ln['alvo'];
	$ativa = $ln['ativa'];
}


if (isset($_POST['solicitacao'])) {

	$d = $_POST['id'];
	$msg = $_POST['mensagem'];

	$s = $msg.": ".$d;



	$sql = $mysqli->query("INSERT INTO tb_solicitacao(contato, servico, empresa, cnpj, nome, email, mensagem) VALUES ('".$_POST['telefone']."','".$_POST['id']."','".$_POST['empresa']."','".$_POST['cnpj']."','".$_POST['nome']."','".$_POST['email']."','$s')")  or die($mysqli->error);

	if ($sql) {
		echo "	<script>
		alert('Sucesso! Em breve entraremos em contato');location.href='curso.php?id=".$_POST['curso']."';
		</script>";
	}else{
		echo "	<script>
		alert('Erro! Tente novamente);
		</script>";
	}
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php 
	include "../config/tema-top.php";
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php echo $curso;?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

	<script src="../js/jquery.min.js"></script>


	<style type="text/css" media="screen">
	body{
		font-family: 'Roboto',"Helvetica Neue",Helvetica,Arial,sans-serif;
	}
	.content{
		padding-top: 3em;
	}
	.btn-outline-dark{
		color: #fff;
		border: 1px solid #fff;
		width: 50%;
		cursor: pointer;
	}
	.btn-outline-dark:hover{
		background: transparent;
	}
	.panel{
		background-image: url("../upload/<?php echo $img; ?>");
		background-size: cover;
		margin-top: 1em;
	}
	.jumbotron{
		background: #000000c2 !important;
		color: #fff;
		padding: 2em;
	}
	.jumbotron .jumbotron-heading{
		font-weight: bolder;
	}
	.jumbotron .lead{
		font-size: 1em;
		font-family: inherit;
	}
	.jumbotron hr{
		border: 1px solid;
	}
	.jumbotron .navbar-nav{
		display: -webkit-box;
		display: -moz-box;
		display: -o-box;
		display: -ms-box;
	}
	.jumbotron .navbar-nav .nav-item{
		padding-top: 0;
		padding: 0.8em;
	}
	.jumbotron .navbar-nav .nav-item i{
		padding-right: 0.3em;
	}
	.jumbotron .card{
		background: transparent;
		border-color: #fff;
		font-size: 1.6em;
		border-radius: 0;
	}
	.jumbotron .card .top{
		padding-top: 2em;
		margin-bottom: 0;
	}
	.content .btn-warning, .content .btn-danger{
		width: 30%; margin-left: 8em; margin-bottom: 2em; cursor: pointer;
	}
	@media(min-width: 320px){
		.content .btn-warning, .content .btn-danger{
			width: 40%;
			margin-left: 5.1em;
		}
	}
	@media(min-width: 376px){
		.content .btn-warning, .content .btn-danger{
			margin-left: 6.1em;
		}
	}
	@media(min-width: 568px){
		.content .btn-warning{
			width: 21%;
			margin-left: 12.4em;
		}
	}
	@media(min-width: 900px){
		.panel .navbar-nav{
			display: -webkit-box !important;
			display: -moz-box !important;
			display: -o-box !important;
			display: -ms-box !important;
		}
		.content .btn-warning{
			width: 55%;
			margin-left: 3em;
		}
	}
	@media(min-width: 1024px){
		.content .btn-warning, .content .btn-danger{
			width: 39%;
			margin-left: 5.5em;
		}
		.panel .navbar-nav{
			display: -webkit-box !important;
			display: -moz-box !important;
			display: -o-box !important;
			display: -ms-box !important;
		}

	}
	@media(min-width: 1280px){
		.content .btn-warning{
			margin-left: 6.7em;
		}
	}
	@media(min-width: 1300px){
		.content .btn-warning, .content .btn-danger{
			width: 49%;
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
	<section class="container text-center">
		<div class="panel">
			<div class="jumbotron">
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="content">
							<h1 class="jumbotron-heading text-left"><?php echo $curso; ?></h1>
							<p class="lead text-left"><?php echo $sobre; ?></p>
							<hr>
							<p class="lead text-left">Material Digital Incluso.</p>
						</div>
					</div>
					<div class="col-sm-12 col-md-4">
						<div class="card">
							<p class="top">Investimento*</p>
							<p>R$ <?php echo $valor; ?></p>
							<p class="bottom" style="background: #ffffff57; margin: 0; padding-top: 0.4em; padding-bottom: 0.6em; font-size: 0.6em; margin-top: 1em;">Aceitamos todos os cartões e boleto</p>
						</div>
						<br>
						<?php if ($ativa == 1) {
							echo "<button type='button' class='btn btn-outline-dark form-control'  data-toggle='modal' data-target='#turma' title='Matricule-se já'>Matrícule-se</button";
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<h4>Mercado de Trabalho</h4>
					<hr>			
					<p><?php echo $mercado; ?></p>
					<br>
					<br>
					<h4>Público Alvo</h4>
					<hr>
					<p><?php echo $publico; ?></p>
					<br>
					<br>
					<h4>Módulos do Curso</h4>
					<hr>
					<?php 
					$m = $mysqli->query("SELECT *FROM tb_modulo WHERE tb_curso_idtb_curso = '$idtb_curso'") or die($mysqli->error);
					while ($o = $m->fetch_assoc()) {
						$m_nome = $o['nome'];
						$desc = $o['descricao'];
						?>
						<p><strong><?php echo $m_nome; ?></strong></p>
						<h6><?php echo $desc; ?></h6>
						
					<?php } ?>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="card" style="background: #0000000a; border: none; font-weight: bolder;">
						<h4 class="text-center" style="padding-top: 3em; font-weight: bold;">Invista em sua Empresa</h4>
						<p class="text-center">Capacite seus funcionarios</p>
						<div class="btn-card" style="padding: 8em; padding-top: 0; padding-bottom: 3em; font-weight: bold;">
							<button class="btn btn-outline-primary form-control" data-toggle="modal" data-target="#<?php echo $id; ?>">Invista</button>
						</div>
					</div>
				</div>
			</div>						
		</div>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="turma">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title"><small>Selecione uma turma mais próximo de você</small></p>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="col-sm-12 col-md-12">
							<div class="list-group">
								<?php 

								$tm =  $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '$idtb_curso' AND ativa = 1") or die($mysqli->error);
								while ($l = $tm->fetch_assoc()) {

									$idtb_turma  = $l['idtb_turma'];
									$idtb_prof = $l['tb_professor_idtb_professor'];
									$endereco = $l['endereco'];
									$bairro = $l['bairro'];
									$numero = $l['numero'];
									$cidade = $l['cidade'];
									$ativa = $l['ativa'];
									$dia = $l['dia'];
									$hora = $l['hora'];
									$complemento = $l['complemento'];
									?>
									<a href="cadastro.php?cur=<?php echo base64_encode($id);?>&tur=<?php echo base64_encode($idtb_turma); ?>&pro=<?php echo base64_encode($idtb_prof); ?>"  class="list-group-item list-group-item-action">
										<em><i class="fas fa-map-marker-alt"></i></em>Horário: <?php echo $dia." / ".$hora; ?><br>Endereço: <?php echo $endereco.", ".$bairro.", ".$cidade.", ".$numero.". ".$complemento; ?>
									</a>
									<br>
								<?php } ?>
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
	<div class="modal" tabindex="-1" role="dialog" id="<?php echo $id; ?>">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><strong>Contato</strong></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="curso.php" method="post" accept-charset="utf-8">
					<div class="modal-body">
						<div class="row">
							<input type="hidden" name="id" value="<?php echo $curso; ?>"> 
							<input type="hidden" name="curso" value="<?php echo $id; ?>"> 
							<div class="col-sm-12 col-md-6">
								<label>CNPJ<em>*</em></label>
								<input type="tel" class="form-control use-soNumeros cnpj" name="cnpj" placeholder="00.000.000/0000-00">
							</div>
							<div class="col-sm-12 col-md-6">
								<label>Empresa<em>*</em></label>
								<input type="text" class="form-control use-soLetras" name="empresa">
							</div>
							<div class="col-sm-12 col-md-6">
								<label>Responsável<em>*</em></label>
								<input type="text" class="form-control use-soLetras" name="nome" placeholder="">
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
								<textarea class="form-control" name="mensagem" rows="5">Olá, desejo investir em minha empresa com o curso: <?php echo $curso; ?></textarea>
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
	<footer>
		<div class="container">
			<p class="text-right">©2018 Anjos da Noite. Todos os Direitos Resevados | Designer Faciliit</p>
		</div>
	</footer>



	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/valCampos.js"></script>
	<script src="../js/valCampos_execute.js"></script>
	<script src="../js/jquery.mask.js"></script>
	<script>
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
		$('.tel').mask('(00) 0 0000-0000');
	</script>

</body>
</html>