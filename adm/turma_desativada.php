<?php

include "../config/seguranca.php";
include "../config/fecha_turma.php";

$idtb_adm = $_SESSION['idtb_login'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "../config/tema-top.php"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADM | Turmas</title>

	
	
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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
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
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Solicitações de Serviços</a>
					</li>
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
					</li>
					<li>
						<a href="professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
					</li>

					<li>
						<a href="curso.php"><i class="fa fa-fw fa-graduation-cap"></i>Cursos</a>
					</li>
					<li class="active">
						<a href="javascript:;" data-toggle="collapse" data-target="#dem"><i class="fa fa-fw fa-check-square-o"></i>Turmas<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="dem" class="collapse">
							<li class="active">
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
						<h1 class="page-header">
							Turmas Desativadas
						</h1>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.php">Inicio</a>
							</li>
							<li class="active">
								<i class="fa fa-fw fa-check-square-o"></i>Turma Desativada
							</li>
						</ol>
					</div>
					<div class="col-lg-12">
						<?php 

						if (isset($_POST['update_turma'])) {


							$sql = $mysqli->query("UPDATE tb_turma SET cep = '".$_POST['cep']."',  endereco = '".$_POST['endereco']."', bairro = '".$_POST['bairro']."', numero = '".$_POST['numero']."', cidade = '".$_POST['cidade']."', complemento = '".$_POST['complemento']."', vagas = '".$_POST['vagas']."',ativa ='1', dia = '".$_POST['dia']."', hora = '".$_POST['hora']."' WHERE idtb_turma = '".$_POST['idtb_turma']."'") or die($mysqli->error);
							if ($sql) {
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<strong>Sucesso!</strong> Turma ativada com Sucesso!
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}else{
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
								<strong>Error!</strong> tente Novamente.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}

						}

						if (isset($_POST['delete_turma'])) {
							$date = date("d-m-Y");
							$cry = sha1(md5($_POST['senha']));
							$sql = $mysqli->query("SELECT *FROM tb_login WHERE senha = '".sha1(md5($_POST['senha']))."' AND email ='".$_SESSION['email']."'");
							$senha = $sql->fetch_assoc()['senha'];
							if ($senha == $cry) {

								$tur = $mysqli->query("SELECT *FROM tb_turma WHERE idtb_turma = '".$_POST['idtb_turma']."'");
								$a = $tur->fetch_assoc()['ativa'];
								if ($a == 1) {
									"<div class='alert alert-danger alert-dismissible' role='alert'>
									<strong>Atenção!</strong> Desative a Turma para poder eXcluir.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}else{
									$g = $mysqli->query("SELECT *FROm tb_gp_biblioteca WHERE id_turma = '".$_POST['idtb_turma']."' ") or die($mysqli->error);
									$idg = $g->fetch_assoc()['id'];
									$s = $mysqli->query("DELETE FROM tb_biblioteca WHERE id_grupo = '$idg' ") or die($mysqli->error);
									if ($s) {
										$gr = $mysqli->query("DELETE FROM tb_gp_biblioteca WHERE id_turma = '".$_POST['idtb_turma']."'") or die($mysqli->error);
										$pre = $mysqli->query("DELETE FROM tb_presenca WHERE id_turma = '".$_POST['idtb_turma']."'") or die($mysqli->error);
										$t = $mysqli->query("DELETE FROM tb_turma WHERE idtb_turma = '".$_POST['idtb_turma']."'") or die($mysqli->error);


										if ($t) {
											echo "<div class='alert alert-success alert-dismissible' role='alert'>
											<strong>Sucesso!</strong> Turma Excluida com Sucesso!
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";
										}else{
											echo "<div class='alert alert-danger alert-dismissible' role='alert'>
											<strong>Error!</strong> tente Novamente.
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";
										}
									}
								}
							}else{
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
								<strong>Error!</strong> Senha Incorreta.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}
						}
						?>

					</div>
					<div class="col-sm-12 col-md-12">						
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Vagas</th>
										<th>Curso</th>
										<th>Cidade</th>
										<th>bairro</th>
										<th>Abertura</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>

									<?php 

									$sql = $mysqli->query("SELECT *FROM tb_turma WHERE ativa  = '0' ");
									while ($ln = $sql->fetch_assoc()) {
										$c = $mysqli->query("SELECT curso FROM tb_curso WHERE idtb_curso = '".$ln['tb_curso_idtb_curso']."'");
										$curso = $c->fetch_assoc()['curso'];
										?>
										<tr>
											<td><?php echo $ln['idtb_turma']; ?></td>
											<td><?php echo $ln['vagas']; ?></td>
											<td><?php echo $curso; ?></td>
											<td><?php echo $ln['cidade']; ?></td>
											<td><?php echo $ln['cidade']; ?></td>
											<td><?php echo $ln['data']; ?></td>											
											<td>
												<a href='' data-toggle='modal' data-target="#update<?php echo $ln['idtb_turma'];?>" title="Atualizar Turma?"><i class="fa fa-fw fa-edit"></i></a>
												<a href='' data-toggle='modal' data-target="#delete<?php echo $ln['idtb_turma']; ?>" title="Excluir Turma"><i class="fa fa-fw fa-trash-o"></i></a>
											</td>
										</tr>

										<div class="modal fade delete" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_turma'];?>" style="opacity: 1; padding-top: 11em;">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Excluir Turma?</h5>
													</div>
													<form action="" method="post">
														<div class="modal-body contanto-form">														
															<div class="col-sm-12 col-md-12">
																<label for="Curso">Confirme Senha<em>*</em></label>
																<input type="password" class="form-control" name="senha" required autofocus>
																<input type="hidden" name="idtb_turma" value="<?php echo $ln['idtb_turma']; ?>">
															</div>
														</div>
														<div class="modal-footer" style="margin-top: 5em!important;">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
															<button type="submit" class="btn btn-primary" name="delete_turma" value="delete_turma">Continuar</button>
														</div>
													</form>
												</div>
											</div>
										</div>

										
										<div class="modal fade" tabindex="-1" role="dialog" id="update<?php echo $ln['idtb_turma']; ?>" style="opacity: 1; padding-top: 11em;">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Atualizar Turma?</h5>
													</div>
													<form action="" method="post">
														<input type="hidden" value="<?php echo $ln['idtb_turma']; ?>" name="idtb_turma">	
														<div class="modal-body">
															<div class="container-fluid">								                     
																<div class="row">
																	<div class="col-sm-6 col-md-6">
																		<label for="Nome">Turma<em>*</em></label>
																		<input type="text" class="form-control" value="<?php echo $ln['nome']; ?>" disabled>
																	</div>
																	<div class="col-sm-12 col-md-2">
																		<label for="Vagas">Vagas<em>*</em></label>
																		<input type="tel" class="form-control" name="vagas" value="<?php echo $ln['vagas']; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-4">
																		<label for="Vagas">Dias de aula<em>*</em></label>
																		<input type="text" class="form-control" name="dia" placeholder="EX: Seg a Sex" value="<?php echo $ln['dia']; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-4">
																		<label for="Vagas">Horário<em>*</em></label>
																		<input type="text" class="form-control" name="hora" placeholder="Ex: 19h as 22h" value="<?php echo $ln['hora']; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<label for="CEP">CEP<em>*</em></label>
																		<input type="tel" class="form-control" placeholder="Cep da Cidade" name="cep" value="<?php echo $ln['cep']; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-5">
																		<label for="Cidade">Cidade<em>*</em></label>
																		<input type="text" class="form-control" name="cidade" value="<?php echo $ln['cidade']; ?>" required autofocus>										
																	</div>
																	<div class="col-sm-12 col-md-5">
																		<label for="Endereço">Endereço<em>*</em></label>
																		<input type="text" class="form-control" placeholder="Cidade" name="endereco" value="<?php echo $ln['endereco']; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-4">
																		<label for="Bairro">Bairro<em>*</em></label>
																		<input type="text" class="form-control" placeholder="Cep da Cidade" name="bairro" value="<?php echo $ln['bairro']; ?>" required autofocus>
																	</div>	
																	<div class="col-sm-12 col-md-3">
																		<label for="Número">Número<em>*</em></label>
																		<input type="tel" class="form-control" placeholder="Número" name="numero" value="<?php echo $ln['numero']; ?>" required autofocus>	
																	</div>
																	<div class="col-sm-12 col-md-12">
																		<label for="Complemento">Complemento</label>
																		<input type="text" class="form-control" placeholder="Próximo a casa de Chico"  value="<?php echo $ln['complemento']; ?>" name="complemento">
																	</div>	
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
															<button type="submit" class="btn btn-primary" name="update_turma" value="update_turma">Ativar</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<?php 
								}	?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../js/popper.min.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/valCampos.js" ></script>
	<script class="tmpScript" type="text/javascript" src="../js/valCampos_execute.js" ></script>
	<script src="../js/jquery.mask.js"></script>
	<script>

		$('.cep').mask('00000-000');

	</script>


</body>
</html>