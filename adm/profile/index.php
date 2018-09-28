<?php
include "../../config/seguranca.php";
include "checkSession.php";
$aa = $mysqli->query("SELECT *FROM tb_aluno WHERE tb_login_idtb_login = '".$_SESSION['idtb_login']."'");
while ($s = $aa->fetch_assoc()) {
	$idtb_aluno = $s['idtb_aluno'];
	$nome = $s['nome'];
	$idtb_curso = $s['tb_curso_idtb_curso'];
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "../../config/tema-top.php"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<style type="text/css" media="screen">
	.form-control{
		border-radius: 0px;
	}
</style>


</head>

<body>

	<?php
	$sql = $mysqli->query("SELECT tb_pagamento_idtb_pagamento FROM tb_turma_aluno WHERE tb_aluno_idtb_aluno = '$idtb_aluno' LIMIT 1 ");
	if ($sql->fetch_assoc()['tb_pagamento_idtb_pagamento'] == 1) {?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">SB Admin</a>
			</div>
			<ul class="nav navbar-right top-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $nome; ?></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="#"><i class="fa fa-fw fa-dashboard"></i> Início</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-bar-chart-o"></i>Notas</a>
					</li>

					<li>
						<a href="#""><i class="fa fa-fw fa-graduation-cap"></i>Frequência</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-cloud-download"></i>Material</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-cogs"></i>Meus dados</a>
					</li>
				</ul>
			</div>
		</nav>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
								Início
							</h1>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-dashboard"></i> Início
								</li>
							</ol>
							<div class="col-sm-12 col-md-12">
								<p><strong>Assim que o pagamento for confirmado, seu acesso a área do aluno será liberado automáticamente</strong> 
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else{?>



		<div id="wrapper">
			<?php $active=1; include "menu.php"; ?>

			<div id="page-wrapper">

				<div class="container-fluid">

					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
								Início
							</h1>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-dashboard"></i> Início
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/bootstrap.js"></script>

</body>
</html>