<?php 

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];
$pro = $mysqli->query("SELECT *FROM tb_dado_adm WHERE tb_login_idtb_login = '$idtb_adm'");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<?php include "../config/tema-top.php"; ?>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADM | Professor</title>

	
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/offcanvas.min.css">
	<link href="../css/sb-admin.css" rel="stylesheet">
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/valCampos.js" ></script>
</head>

<body>
	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">SB Admin</a>
			</div>
			<!-- Top Menu Items -->
			<ul class="nav navbar-right top-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $pro->fetch_assoc()['nome']; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Solicitações de Serviços</a>
					</li>
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
					</li>
					<li class="active">
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
					<li
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
			<!-- /.navbar-collapse -->
		</nav>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-header">
							<div class="row">
								<div class="col-sm-12 col-md-9">
									<h1 class="">
										Professores<a href="" data-toggle="modal" data-target="#mymodalProf"><i class="fa fa-fw fa-plus-circle"></i></a>
									</h1>
								</div>
								<div class="col-sm-12 col-md-3">
									<form action="" method="post" class="form-inline my-2 my-lg-0" style="padding-top: 1.5em;">
										<input class="form-control mr-sm-2 form-control-lg" type="search" placeholder="Pesquisar Professor" aria-label="Search" name="nome">
										<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="pesquisa" value="pesquisa"><i class="fa fa-fw fa-search"></i></button>
									</form>
								</div>
							</div>
						</div>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.php">Inicio</a>
							</li>
							<li class="active">
								<i class="fa fa-fw fa-bar-chart-o"></i> Professores
							</li>
						</ol>
					</div>
					<div class="col-lg-12">
						<?php 
						if (isset($_POST['cadastra_prof'])) {
							if ($_POST['senha_prof'] == $_POST['csenha_prof']) {
								$sql = $mysqli->query("SELECT *FROM tb_professor WHERE cpf = '".$_POST['cpf']."'");
								if ($sql->num_rows>0) {
									echo "<div class='alert alert-danger alert-dismissible' role='alert'>
									<strong>Error!</strong> Já existe esse CPF cadastrado!
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}else{

									$cry = sha1(md5($_POST['senha_prof']));
									$r = $mysqli->query("SELECT *FROM tb_professor WHERE rg = '".$_POST['rg']."'");
									if ($r->num_rows>0) {
										echo "<div class='alert alert-danger alert-dismissible' role='alert'>
										<strong>Error!</strong> Já existe esse RG cadastrado!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}else{

										$c = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'");
										if ($c->num_rows>0) {
											echo "<div class='alert alert-danger alert-dismissible' role='alert'>
											<strong>Error!</strong> Já existe número de telefone cadastrado!
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";
										}else{
											$l = $mysqli->query("SELECT *FROM tb_login WHERE email = '".$_POST['email']."'");
											if ($l->num_rows>0) {
												echo "<div class='alert alert-danger alert-dismissible' role='alert'>
												<strong>Error!</strong> Já existe esse e-mail cadastrado!
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
												</button>
												</div>";
											}else{
												$sql_contato = $mysqli->query("INSERT INTO tb_contato(telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')") or die($mysqli->error);
												$c = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'");

												$login = $mysqli->query("INSERT INTO tb_login(email, senha, tipo) VALUES('".$_POST['email']."','$cry','2')") or die($mysqli->error);
												$sl = $mysqli->query("SELECT *FROM tb_login WHERE email = '".$_POST['email']."' AND senha = '$cry'")->fetch_assoc()['idtb_login'];

												$sql = $mysqli->query("INSERT INTO tb_professor(nome, rg, cpf, tb_contato_idtb_contato, tb_login_idtb_login) VALUES('".$_POST['nome']."','".$_POST['rg']."','".$_POST['cpf']."','".$c->fetch_assoc()['idtb_contato']."','$sl')") or die($mysqli->error);


												if ($sql) {

													echo "<div class='alert alert-success alert-dismissible' role='alert'>
													<strong>Sucesso!</strong> Professor Cadastrado!
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
										}
									}
								}
							}else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<strong>Error!</strong> Senhas Diferentes.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}

						}

						if (isset($_POST['delete_prof'])) {

							$q = $mysqli->query("SELECT senha FROM tb_login WHERE senha = '".sha1(md5($_POST['senha']))."' AND email = '".$_SESSION['email']."'") or die($mysqli->error);
							if ($q->fetch_assoc()['senha'] == sha1(md5($_POST['senha']))) {

								$tur = $mysqli->query("SELECT *FROM tb_turma WHERE tb_professor_idtb_professor = '".$_POST['idtb_prof']."'") or die($mysqli->error);
								$id = $tur->fetch_assoc()['idtb_turma'];

								$s  = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma = '$id'") or die($mysqli->error);

								if ($s->num_rows) {
									echo "<div class='alert alert-warning alert-dismissible' role='alert'><strong>Error!</strong> Existem Cursos e Turmas abertas com esse Professor<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
								}else{

									$i = $mysqli->query("SELECT *FROM tb_professor WHERE idtb_professor = '".$_POST['idtb_prof']."'");

									if (!empty($i->fetch_assoc()['img'])) {

										unlink("../upload/".$i->fetch_assoc()['img']."");

									}

									$idtb_contato = $i->fetch_assoc()['tb_contato_idtb_contato'];

									$con = $mysqli->query("DELETE FROM tb_contato WHERE idtb_contato = '$idtb_contato'") or die($mysqli->error);
									$u  = $mysqli->query("UPDATE tb_turma SET ativa = '0' WHERE tb_professor_idtb_professor = '".$_POST['idtb_prof']."'");
									$sql = $mysqli->query("DELETE FROM tb_professor WHERE idtb_professor = '".$_POST['idtb_prof']."'");


									if ($sql) {
										echo "<div class='alert alert-success alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Professor Excluido!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
								// header("Location: professor.php");
									}else{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Error!</strong> tente Novamente.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}
								}
							}else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<strong>Error!</strong> Senha incorreta.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}
						}
						if (isset($_POST['update_prof'])) {
							if ($_POST['senha'] == $_POST['csenha']) {
								if ($_POST['email'] == $_POST['cemail']) {

									$i = $mysqli->query("SELECT *FROM tb_professor WHERE idtb_professor = '".$_POST['id']."'");
									while ($ln = $i->fetch_assoc()) {
										$idCon = $ln['tb_contato_idtb_contato'];
										$idLog = $ln['tb_login_idtb_login'];
									}
									

									$cry = sha1(md5($_POST['senha']));

									$sql = $mysqli->query("UPDATE tb_contato SET telefone1 = '".$_POST['tel1']."' WHERE idtb_contato = '$idCon'") or die($mysqli->error);
									$s = $mysqli->query("UPDATE tb_contato SET telefone2 = '".$_POST['tel2']."' WHERE idtb_contato = '$idCon'") or die($mysqli->error);

									$login = $mysqli->query("UPDATE tb_login SET email = '".$_POST['email']."' WHERE idtb_login = '$idLog'") or die($mysqli->error);
									$l = $mysqli->query("UPDATE tb_login SET senha ='$cry' WHERE idtb_login = '$idLog'") or die($mysqli->error);

									$n = $mysqli->query("UPDATE tb_professor SET nome ='".$_POST['nome']."' WHERE idtb_professor ='".$_POST['id']."'") or die($mysqli->error);
									$r = $mysqli->query("UPDATE tb_professor SET rg = '".$_POST['rg']."' WHERE idtb_professor ='".$_POST['id']."'") or die($mysqli->error);
									$c = $mysqli->query("UPDATE tb_professor SET cpf = '".$_POST['cpf']."' WHERE idtb_professor ='".$_POST['id']."'") or die($mysqli->error);

									if ($c) {
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Atualizado com sucesso.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}else{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Error!</strong> Tente novamente.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}

								}else{
									echo "<div class='alert alert-warning alert-dismissible' role='alert'>
									<strong>Error!</strong> E-mails Diferentes.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}
							}else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'>
								<strong>Error!</strong> Senhas Diferentes.
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
										<th>Nome</th>
										<th>RG</th>
										<th>CPF</th>
										<th>E-mail</th>
										<th>Telefone</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php 

									if (isset($_POST['pesquisa'])) {
										$n = $_POST['nome'];

										$sql = $mysqli->query("SELECT *FROM tb_professor WHERE nome LIKE '%".$n."%'") or die($mysqli->error);

										if ($sql->num_rows) {
											while ($ln = $sql->fetch_assoc()) { 
												$idtb_contato = $ln['tb_contato_idtb_contato'];
												$idtb_login = $ln['tb_login_idtb_login'];
												$c = $mysqli->query("SELECT *FROM tb_contato WHERE idtb_contato = '$idtb_contato'");
												$l = $mysqli->query("SELECT *FROM tb_login WHERE idtb_login = '".$ln['tb_login_idtb_login']."'");

												?>
												<tr>
													<td><?php echo $ln['idtb_professor']; ?></td>
													<td><?php echo $ln['nome']; ?></td>
													<td><?php echo $ln['rg']; ?></td>
													<td><?php echo $ln['cpf']; ?></td>
													<td><?php echo $l->fetch_assoc()['email']; ?></td>
													<td><?php echo $c->fetch_assoc()['telefone1'] ?></td>
													<td>
														<a href="" data-toggle="modal" data-target="#mymodalProf<?php echo $ln['idtb_professor'];?>"><i class="fa fa-fw fa-eye"></i></a>
														<a href="" data-toggle="modal" data-target="#delete<?php echo $ln['idtb_professor']; ?>"><i class="fa fa-fw fa-trash-o"></i></a>
													</td>
												</tr>
												<div class="modal fade delete esse_modal" tabindex="-1" role="dialog" id="mymodalProf<?php echo $ln['idtb_professor'];?>"  style="opacity: 1; padding-top: 11em;">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">Currículo</h5>
															</div>
															<div class="modal-body contanto-form">
																<form action="" method="post">
																	Está Incompleto
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																		<button type="submit" class="btn btn-primary" name="delete_prof" value="delete_prof">Continuar</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
												<div class="modal fade delete" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_professor'];?>"  style="opacity: 1; padding-top: 11em;">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">Excluir Professor</h5>
															</div>
															<form action="" method="post">
																<div class="modal-body contanto-form">														
																	<div class="col-sm-12 col-md-12">
																		<label for="Curso">Confirme Senha<em>*</em></label>
																		<input type="password" class="form-control" name="senha" required autofocus>
																		<input type="hidden" name="idtb_prof" value="<?php echo $ln['idtb_professor']; ?>">
																	</div>
																</div>
																<div class="modal-footer" style="margin-top: 5em!important;">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																	<button type="submit" class="btn btn-primary" name="delete_prof" value="delete_prof">Continuar</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<?php
											}
										}else{
											echo "<div class='alert alert-warning alert-dismissible' role='alert'>
											<strong>Nenhum Professor Encontrado.
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<a href='professor.php'><span aria-hidden='true'>&times;</span></a>
											</button>
											</div>";
										}
									}else{

										$professor = $mysqli->query("SELECT *FROM tb_professor ORDER BY idtb_professor ASC");
										$s = $professor->num_rows;
										while ($ln = $professor->fetch_assoc()) { 
											$idtb_contato = $ln['tb_contato_idtb_contato'];
											$idtb_login = $ln['tb_login_idtb_login'];
											$c = $mysqli->query("SELECT *FROM tb_contato WHERE idtb_contato = '$idtb_contato'");
											$tel1 = $c->fetch_assoc()['telefone1'];
											$tel2 = $c->fetch_assoc()['telefone2'];

											$l = $mysqli->query("SELECT *FROM tb_login WHERE idtb_login = '".$ln['tb_login_idtb_login']."'") or die($mysqli->error);
											$email = $l->fetch_assoc()['email'];
											?>

											<tr>
												<td><?php echo $ln['idtb_professor']; ?></td>
												<td><?php echo $ln['nome']; ?></td>
												<td><?php echo $ln['rg']; ?></td>
												<td><?php echo $ln['cpf']; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $tel1; ?></td>
												<td>
													<a href="" data-toggle="modal" data-target="#delete<?php echo $ln['idtb_professor']; ?>" title="Excluir?"><i class="fa fa-fw fa-trash-o"></i></a>
													<a href="" data-toggle="modal" data-target="#atualizar<?php echo $ln['idtb_professor']; ?>" title="Atualizar"><i class="fa fa-fw fa-edit""></i></a>
												</td>
											</tr>
											<div class="modal fade" tabindex="-1" role="dialog" id="atualizar<?php echo $ln['idtb_professor'];?>"  style="opacity: 1; padding-top: 11em;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Currículo</h5>
														</div>
														<form action="" method="post">
															<div class="modal-body contanto-form">
																<div class="row">																
																	<input type="hidden" name="id" value="<?php echo $ln['idtb_professor']; ?>">
																	<div class="col-sm-12 col-md-12">
																		<label for="Curso">Nome Completo<em>*</em></label>
																		<input type="text" class="form-control use-soLetras" name="nome" id="nome" value="<?php echo $ln['nome']; ?>" required autofocus>
																		<span class='msg-erro msg-nome'></span>
																	</div>
																	<div class="col-sm-4 col-md-6">
																		<label for="Carga Horária">CPF<em>*</em></label>
																		<input type="tel" class="form-control cpf use-soNumeros use-addMask" name="cpf" id="cpf" title="CPF" value="<?php echo $ln['cpf']; ?>" required  autofocus>
																	</div>
																	<div class="col-sm-4 col-md-6">
																		<label for="Valor">RG<em>*</em></label>
																		<input type="tel" class="form-control rg use-soNumeros use-addMask" name="rg" id="rg" title="RG" value="<?php echo $ln['rg']; ?>" maxlength="9" required autofocus>
																		<span class='msg-erro msg-rg'></span>
																	</div>
																	<div class="col-sm-4 col-md-6">
																		<label for="Valor">Celular<em>*</em></label>
																		<input type="tel" class="form-control celular use-soNumeros use-addMask" name="tel1" id="tel1" title="Preferência ao Whatsapp" value="<?php echo $tel1; ?>" autofocus required>
																		<span class='msg-erro msg-rg'></span>
																	</div>
																	<div class="col-sm-4 col-md-6">
																		<label for="Valor">Fixo</label>
																		<input type="tel" class="form-control fixo use-soNumeros use-addMask" name="tel2" id="tel2" value="<?php echo $tel2; ?>" autofocus>
																		<span class='msg-erro msg-rg'></span>
																	</div>
																	<div class="col-sm-12 col-md-6">
																		<label for="">E-mail<em>*</em></label>
																		<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" value="<?php echo $email; ?>" required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-6">
																		<label for="">Confirme E-mail<em>*</em></label>
																		<input type="email" class="form-control" placeholder="example@example.com" name="cemail" id="c_email" required autofocus>
																		<span class='msg-erro msg-c_email'></span>
																	</div>
																	<div class="col-sm-12 col-md-6">
																		<label for="">Senha<em>*</em></label>
																		<input type="password" class="form-control senha_prof" name="senha" id="senha"  required autofocus>
																	</div>
																	<div class="col-sm-12 col-md-6">
																		<label for="">Confirmer Senha<em>*</em></label>
																		<input type="password" class="form-control csenha_prof" name="csenha" id="c_senha" required autofocus>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																<button type="submit" class="btn btn-primary" name="update_prof" value="update_prof">Continuar</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="modal fade delete" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_professor'];?>"  style="opacity: 1; padding-top: 11em;">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Excluir Professor</h5>
														</div>
														<form action="" method="post">
															<div class="modal-body contanto-form">														
																<div class="col-sm-12 col-md-12">
																	<label for="Curso">Confirme Senha<em>*</em></label>
																	<input type="password" class="form-control" name="senha" required autofocus>
																	<input type="hidden" name="idtb_prof" value="<?php echo $ln['idtb_professor']; ?>">
																</div>
															</div>
															<div class="modal-footer" style="margin-top: 5em!important;">
																<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																<button type="submit" class="btn btn-primary" name="delete_prof" value="delete_prof">Continuar</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<?php
										}
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="mymodalProf" style="opacity: 1; padding-top: 11em;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><strong>Cadastrar Professor</strong></h5>
				</div>
				<form action="" method="post"> 
					<div class="modal-body contato-form">					                     
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<label for="Curso">Nome Completo<em>*</em></label>
								<input type="text" class="form-control use-soLetras" name="nome" id="nome" required autofocus>
								<span class='msg-erro msg-nome'></span>
							</div>
							<div class="col-sm-4 col-md-6">
								<label for="Carga Horária">CPF<em>*</em></label>
								<input type="tel" class="form-control cpf use-soNumeros use-addMask" name="cpf" id="cpf" title="CPF" required  autofocus>
							</div>
							<div class="col-sm-4 col-md-6">
								<label for="Valor">RG<em>*</em></label>
								<input type="tel" class="form-control rg use-soNumeros use-addMask" name="rg" title="RG" maxlength="9" required autofocus>
								<span class='msg-erro msg-rg'></span>
							</div>
							<div class="col-sm-4 col-md-6">
								<label for="Valor">Celular<em>*</em></label>
								<input type="tel" class="form-control celular use-soNumeros" name="tel1" id="tel1" title="Preferência ao Whatsapp" autofocus required>
								<span class='msg-erro msg-rg'></span>
							</div>
							<div class="col-sm-4 col-md-6">
								<label for="Valor">Fixo</label>
								<input type="tel" class="form-control fixo use-soNumeros" name="tel2" id="tel2" autofocus>
								<span class='msg-erro msg-rg'></span>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="">E-mail<em>*</em></label>
								<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" required autofocus>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="">Confirme E-mail<em>*</em></label>
								<input type="email" class="form-control" placeholder="example@example.com" name="c_email" id="c_email" required autofocus>
								<span class='msg-erro msg-c_email'></span>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="">Senha<em>*</em></label>
								<input type="password" class="form-control senha_prof" name="senha_prof" id="senha"  required autofocus>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="">Confirmer Senha<em>*</em></label>
								<input type="password" class="form-control csenha_prof" name="csenha_prof" id="c_senha" required autofocus>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary" name="cadastra_prof" value="cadastra_prof" id="botao">Cadastrar</button>						
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="../js/popper.min.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script class="tmpScript" type="text/javascript" src="../js/valCampos_execute.js" ></script>
	<script src="../js/jquery.mask.js"></script>
	<script>

		$('.rg').mask('000.000.000', {reverse: true});
		$('.cpf').mask('000.000.000-00', {reverse: true});
		$('.celular').mask('(00) 0 0000-0000');
		$('.fixo').mask('(00) 0000-0000');

	</script>
</body>
</html>