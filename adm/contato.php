<?php

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "../config/tema-top.php"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>
	
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div id="wrapper">
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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i>  Solicitações de Serviços</a>
					</li>
					<li class="active">
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
					</li>
					<li>
						<a href="professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
					</li>

					<li>
						<a href="curso.php"><i class="fa fa-fw fa-graduation-cap"></i>Cursos</a>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#dem"><i class="fa fa-fw fa-check-square-o"></i>Turmas<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="dem" class="collapse">
							<li>
								<a href="turma.php">Ativas</a>
							</li>
							<li>
								<a href="turma_desativada.php">Desativadas</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Alunos<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="aluno.php">Matriculados</a>
							</li>
							<li>
								<a href="pre.php">Pré-Matriculados</a>
							</li>
							<li>
								<a href="cadastro.php">Todos os Cadastros</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="servico.php"><i class="fa fa-fw fa-briefcase"></i> Serviços</a>
					</li>
				</ul>
			</div>
		</nav>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
							<div class="row">
								<div class="col-sm-12 col-md-9">
									<h1>
										Contato
									</h1>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.php">Inicio</a>
							</li>
							<li class="active">
								<i class="fa fa-fw fa-briefcase"></i>Contato
							</li>
						</ol>
					</div>
					<div class="col-sm-12 col-md-12">
						<?php if (isset($_POST['delete'])) {
							$s = sha1(md5($_POST['senha']));
							$sql = $mysqli->query("SELECT *FROM tb_login WHERE senha = '$s' AND email = '".$_SESSION['email']."'");
							if ($s == $sql->fetch_assoc()['senha']) {

								$sql = $mysqli->query("DELETE FROM tb_msg WHERE idtb_msg = '".$_POST['id']."'") or die($mysqli->error);
								if ($sql) {
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Contato Excluido!
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}
							}else{
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
								<strong>Error!</strong> Senha Incorreta!
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}
						} ?>

					</div>

					<div class="col-sm-12 col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover ">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th>Contato</th>
										<th>Data</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
									$sql = $mysqli->query("SELECT *FROM tb_msg ORDER BY data desc") or die($mysqli->error);
									while ($ln = $sql->fetch_assoc()) {?>
										<tr>
											<td><?php echo $ln['idtb_msg']; ?></td>
											<td><?php echo $ln['nome']; ?></td>
											<td><?php echo $ln['contato']; ?></td>
											<td><?php echo $ln['data']; ?></td>
											<td>
												<a href='' data-toggle='modal' data-target="#mymodal_servico<?php echo $ln['idtb_msg'];?>"><i class="fa fa-fw fa-eye"></i></a>
												<a href='' data-toggle='modal' data-target="#delete<?php echo $ln['idtb_msg']; ?>"><i class="fa fa-fw fa-trash-o"></i></a>
											</td>
											<div class="modal fade " tabindex="-1" role="dialog" id="mymodal_servico<?php echo $ln['idtb_msg']; ?>" style="opacity: 1; padding-top: 11em;">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title pre"><strong>Visualizar Contato</strong></h5>
														</div>
														<div class="modal-body">
															<label for="Valor">Descrição<em>*</em></label>
															<textarea name="descricao" class="form-control" rows="10" required autofocus><?php echo $ln['msg']; ?></textarea>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
														</div>
													</div>
												</div>
											</div>
											<div class="modal fade " tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_msg']; ?>" style="opacity: 1; padding-top: 11em;">
												<div class="modal-dialog modal-sm">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title pre"><strong>Confirmar Senha</strong></h5>
														</div>
														<form action="" method="post" accept-charset="utf-8">
															<div class="modal-body">
																<label>Senha<em>*</em></label>
																<input type="password" class="form-control" name="senha" required>
																<input type="hidden" name="id" value="<?php echo $ln['idtb_msg']; ?>">

															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
																<button type="submit" class="btn btn-primary" name="delete" value="delete">Apagar</button>
															</div>
														</form>	
													</div>
												</div>
											</div>	
										</tr>				
									<?php } ?>									
								</tbody>
							</table>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>

	<script src="../js/popper.min.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>


</body>
</html