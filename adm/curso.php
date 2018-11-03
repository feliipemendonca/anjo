<?php 

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];
$pro = $mysqli->query("SELECT *FROM tb_dado_adm WHERE tb_login_idtb_login = '$idtb_adm'") or die($mysqli->error);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "../config/tema-top.php"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADM | Cursos</title>

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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $pro->fetch_assoc()['nome']; ?> <b class="caret"></b></a>
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
					<li>
						<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
					</li>
					<li>
						<a href="professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
					</li>

					<li class="active">
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
										Cursos<a href="" data-toggle="modal" data-target="#mymodal"><i class="fa fa-fw fa-plus-circle"></i></a>
									</h1>
								</div>
								<div class="col-sm-12 col-md-3">
									<form action="" method="post" class="form-inline my-2 my-lg-0" style="padding-top: 1.5em;">
										<input class="form-control mr-sm-2 form-control-lg" type="search" placeholder="Pesquisar Curso" aria-label="Search" name="nome">
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
								<i class="fa fa-fw fa-graduation-cap"></i>Cursos
							</li>
						</ol>
					</div>
					<div class="col-lg-12">
						<?php
						if (isset($_POST['cadastra_curso'])) {
							$sql = $mysqli->query("SELECT *FROM tb_curso WHERE curso = '".$_POST['curso']."'");
							if ($sql->num_rows) {

							}else{
								$foto = $_FILES["image"];

								if (!empty($foto["name"])) {

									$dimensoes = getimagesize($foto["tmp_name"]);

									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

									$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

									$caminho_imagem = "../upload/" . $nome_imagem;

									move_uploaded_file($foto["tmp_name"], $caminho_imagem);

									$s = $mysqli->query("INSERT INTO tb_curso(curso, sobre, alvo, carga, mercado, valor, img, ativa) VALUES('".$_POST['curso']."','".$_POST['sobre']."','".$_POST['alvo']."','".$_POST['carga']."','".$_POST['mercado']."','".$_POST['valor']."','$nome_imagem', '1')") or die($mysqli->error);

									if ($s) {
										echo "<div class='alert alert-success alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Curso cadastrado com Sucesso.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}else{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Error!</strong> Verefique os dados e tente Novamente.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}
								}
							}

						}

						if (isset($_POST['cadastra_requito'])) {
							$sql = $mysqli->query("INSERT INTO tb_requisito(requisito, tb_curso_idtb_curso) VALUES('".$_POST['requisito']."', '".$_POST['id']."')");

							if ($sql) {
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<strong>Sucesso!</strong> Requisito cadastrado.
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

						if (isset($_POST['update_curso'])) {

							$foto = $_FILES["image"];

							if (!empty($foto["name"])) {

								$dimensoes = getimagesize($foto["tmp_name"]);

								preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

								$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

								$caminho_imagem = "../upload/" . $nome_imagem;

								move_uploaded_file($foto["tmp_name"], $caminho_imagem);

								$s = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '".$_POST['id']."'");

								unlink("../upload/".$s->fetch_assoc()['img']."");

								$sql = $mysqli->query("UPDATE tb_curso SET curso = '".$_POST['curso']."', carga = '".$_POST['carga']."', valor = '".$_POST['valor']."', alvo = '".$_POST['alvo']."', mercado = '".$_POST['mercado']."', img = '$nome_imagem' WHERE idtb_curso = '".$_POST['id']."'") or die($mysqli->error);

								if ($sql) {
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Curso atualizado com Sucesso.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
						// header("Location: curso.php");
								}else{
									echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
									<strong>Error!</strong> tente Novamente.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";


								}
							}else{

								$sql = $mysqli->query("UPDATE tb_curso SET curso = '".$_POST['curso']."', sobre = '".$_POST['sobre']."', carga = '".$_POST['carga']."', valor = '".$_POST['valor']."', alvo = '".$_POST['alvo']."', mercado = '".$_POST['mercado']."' WHERE idtb_curso = '".$_POST['id']."'") or die($mysqli->error);


								if ($sql) {
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Curso atualizado com Sucesso.
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


						if (isset($_POST['delete_curso'])) {

							$cry = sha1(md5($_POST['senha']));

							$q = $mysqli->query("SELECT *FROM tb_login WHERE senha = '$cry' AND email = '".$_SESSION['email']."'") or die($mysqli->error);
							$senha = $q->fetch_assoc()['senha'];
							if ($senha == $cry) {				

								$tur  = $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
								$at = $tur->fetch_assoc()['ativa'];
								if ($at != 0) {
									echo "<div class='alert alert-warning alert-dismissible' role='alert'><strong>Error!</strong> Existem turma ativa para esse  curso<strong> Desative a turma e tente novamente!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
								}else{
									
									$sql = $mysqli->query("UPDATE tb_curso SET ativa = 0 WHERE idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
									if ($sql) {
										$cur = $mysqli->query("UPDATE tb_turma_aluno SET tb_curso_idtb_curso = 0 WHERE tb_curso_idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
										if ($cur) {

											echo "<div class='alert alert-success alert-d' role='alert'>
											<strong>Sucesso!</strong> Curso curso excluido com Sucesso.
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";

										}else{
											echo "<div class='alert alert-warning alert-d' role='alert'>
											<strong>Error!</strong> Tente Novamente.
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";
										}
									}
								}
							}else{
								echo "<div class='alert alert-warning alert-d' role='alert'>
								<strong>Error!</strong> Senha Incorretas.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
								
							}
						}

						if (isset($_POST['cadastra_modulo'])) {
							$sql = $mysqli->query("SELECT *FROM tb_modulo WHERE nome = '".$_POST['nome']."'");
							$nome = $sql->fetch_assoc()['nome'];
							if (empty($nome)) {
								$sql = $mysqli->query("INSERT INTO tb_modulo(nome, descricao, tb_curso_idtb_curso) VALUES('".$_POST['nome']."','".$_POST['descricao']."','".$_POST['id']."')") or die($mysqli->error);

								if ($sql) {

									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Módulo Cadastrado com Sucesso.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";

								}else{

									echo "<div class='alert alert-danger alert-dismissible' role='alert'>
									<strong>Error!</strong> não foi possivel cadastrar o módulo.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";

								}
							}else{
								echo "<div class='alert alert-danger alert-dismissible' role='alert'>
								<strong>Error!</strong> já existe modulo cadastrado com esse nome.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}
						}

						if (isset($_POST['delete_modulo'])) {

							$sql = $mysqli->query("DELETE FROM tb_modulo WHERE idtb_modulo = '".$_POST['idtb_modulo']."'") or die($mysqli->error);

							if ($sql) {

								echo "<div class='alert alert-success' role='alert'>
								<strong>Sucesso!</strong> Módulo excluido com Sucesso.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}else{

								echo "<div class='alert alert-danger' role='alert'>
								<strong>Error!</strong> não foi possivel excluir o módulo.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}


						}

						if (isset($_POST['delete_requisito'])) {

							$sql = $mysqli->query("DELETE FROM tb_requisito WHERE idtb_requisito = '".$_POST['idtb_requisito']."'") or die($mysqli->error);

							if ($sql) {

								echo "<div class='alert alert-success' role='alert'>
								<strong>Sucesso!</strong> Requisito excluido com Sucesso.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}else{

								echo "<div class='alert alert-danger' role='alert'>
								<strong>Error!</strong> não foi possivel excluir o Requisito.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}


						}

						if (isset($_POST['img_curso'])) {

							$foto = $_FILES["image"];

							if (!empty($foto["name"])) {

								$dimensoes = getimagesize($foto["tmp_name"]);

								preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

								$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

								$caminho_imagem = "../upload/" . $nome_imagem;

								move_uploaded_file($foto["tmp_name"], $caminho_imagem);

								$s = $mysqli->query("INSERT INTO tb_galeria(img, tb_curso_idtb_curso) VALUES('$nome_imagem', '".$_POST['idtb_curso']."')") or die($mysqli->error);

								if ($s) {
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Imagem cadastrada com Sucesso.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}else{
									echo "<div class='alert alert-warning alert-dismissible' role='alert'>
									<strong>Error!</strong> Verefique os dados e tente Novamente.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}

							}
						}

						if (isset($_POST['delete_img'])) {

							$cry = sha1(md5($_POST['senha']));

							$q = $mysqli->query("SELECT *FROM tb_login WHERE senha = '$cry' AND email = '".$_SESSION['email']."'") or die($mysqli->error);
							$senha = $q->fetch_assoc()['senha'];
							if ($senha == $cry) {
								$sql = $mysqli->query("SELECT img FROM tb_galeria WHERE idtb_galeria = '".$_POST['idtb_galeria']."'");
								$img = $sql->fetch_assoc()['img'];

								if (!empty($img)) {

									unlink("../upload/".$img."");

									$sql = $mysqli->query("DELETE FROM tb_galeria WHERE idtb_galeria = '".$_POST['idtb_galeria']."'");

									if ($sql) {
										echo "<div class='alert alert-success alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Imagem excluida com Sucesso.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}else{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Error!</strong> Verefique os dados e tente Novamente.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}
								}
							}
						}




						?>
					</div>


					<div class="col-sm-12 col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover ">
								<thead>
									<tr>
										<th>ID</th>
										<th>Curso</th>
										<th>Carga horária</th>
										<th>Valor</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>

									<?php


									if (isset($_POST['pesquisa'])) {
										$n = $_POST['nome'];

										$sql = $mysqli->query("SELECT *FROM tb_curso WHERE curso LIKE '%".$n."%' AND ativa ='1'") or die($mysqli->error);

										if ($sql->num_rows) {
											while ($ln = $sql->fetch_assoc()) {?>
												<tr>
													<td><?php echo $ln['idtb_curso']; ?></td>
													<td><?php echo $ln['curso']; ?></td>
													<td><?php echo $ln['carga']; ?></td>
													<td><?php echo $ln['valor']; ?></td>
													<td>
														<a href="" data-toggle="modal" data-target="<?php echo "#modulo_curso".$ln['idtb_curso']; ?>" title="Cadastrar Módulo de Curso"><i class="fa fa-fw fa-pencil"></i></a>
														<a href="" data-toggle="modal" data-target="<?php echo "#modulo_ver".$ln['idtb_curso']; ?>" title="Ver Módulo de Curso"><i class="fa fa-fw fa-eye"></i></a>
														<a href="" data-toggle="modal" data-target="<?php echo "#update".$ln['idtb_curso']; ?>" title="Atualizar Curso"><i class="fa fa-fw fa-edit"></i></a>
														<a href="" data-toggle="modal" data-target="#delete<?php echo $ln['idtb_curso']; ?>" title="Excluir"><i class="fa fa-fw fa-trash-o"></i></a>
														<a href="" data-toggle="modal" data-target="#requisito<?php echo $ln['idtb_curso']; ?>" title="Requisitos"><i class="fas fa-chevron-down"></i></a>
														<a href="" data-toggle="modal" data-target="<?php echo "#requisito_ver".$ln['idtb_curso']; ?>" title="Ver Requisitos do Curso"><i class="fa fa-fw fa-eye"></i></a>
														<a href="" data-toggle="modal" data-target="<?php echo "#img".$ln['idtb_curso']; ?>" title="Ver Requisitos do Curso"><i class="fa fa-file"></i></a>
													</td>
												</tr>
												<?php

												include "../config/modal_adm_curso.php";

											}
										}
									}else{

										$sql = $mysqli->query("SELECT *FROM tb_curso WHERE ativa = '1'");
										while ($ln = $sql->fetch_assoc()) {?>
											<tr>
												<td><?php echo $ln['idtb_curso']; ?></td>
												<td><?php echo $ln['curso']; ?></td>
												<td><?php echo $ln['carga']; ?></td>
												<td><?php echo $ln['valor']; ?></td>
												<td>
													<a href="" data-toggle="modal" data-target="<?php echo "#modulo_curso".$ln['idtb_curso']; ?>" title="Cadastrar Módulo de Curso"><i class="fa fa-fw fa-pencil"></i></a>
													<a href="" data-toggle="modal" data-target="<?php echo "#modulo_ver".$ln['idtb_curso']; ?>" title="Ver Módulo de Curso"><i class="fa fa-fw fa-eye"></i></a>
													<a href="" data-toggle="modal" data-target="<?php echo "#update".$ln['idtb_curso']; ?>" title="Atualizar Curso"><i class="fa fa-fw fa-edit"></i></a>
													<a href="" data-toggle="modal" data-target="#delete<?php echo $ln['idtb_curso']; ?>" title="Excluir"><i class="fa fa-fw fa-trash-o"></i></a>
													<a href="" data-toggle="modal" data-target="#requisito<?php echo $ln['idtb_curso']; ?>" title="Requisitos"><i class="fa fa-chevron-down"></i></a>
													<a href="" data-toggle="modal" data-target="<?php echo "#requisito_ver".$ln['idtb_curso']; ?>" title="Ver Requisitos do Curso"><i class="fa fa-fw fa-eye"></i></a>
													<a href="" data-toggle="modal" data-target="<?php echo "#img".$ln['idtb_curso']; ?>" title="Adcionar foto do Curso"><i class="fa fa-file"></i></a>
													<a href="" data-toggle="modal" data-target="<?php echo "#img_ver".$ln['idtb_curso']; ?>" title="Ver img do Curso"><i class="fa fa-fw fa-eye"></i></a>
												</td>
											</tr>
											<?php include "../config/modal_adm_curso.php"; ?>
										</div>
										<?php
									}
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="modal mymodal fade register" tabindex="-1" role="dialog" id="mymodal" style="opacity: 1; padding-top: 11em;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Cadastrar Curso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>		
					</div>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-body content-form">
							<p style="font-size: 13px;">Necessário de sejam respetadas a padronisação dos Exemplos. Todos os campos com <em>*</em>, são obrigatórios.</p>
							<div class="row">
								<div class="col-sm-12 col-md-8">
									<label for="Curso">Curso<em>*</em></label>
									<input type="text" class="form-control" name="curso">
								</div>
								<div class="col-sm-12 col-md-4">
									<label for="Curso">Imagem<em>*</em></label>
									<input type="file" class="form-control" name="image" required autofocus>
								</div>								
								<div class="col-sm-4 col-md-6">
									<label for="Carga Horária">Carga Horária<em>*</em></label>
									<input type="tel" class="form-control" name="carga" title="Carga Horária do Curso">
								</div>
								<div class="col-sm-4 col-md-6">
									<label for="Valor">Valor<em>*</em></label>
									<input type="tel" class="form-control valor" name="valor" maxlength="6" title="Valor do Curso">
								</div>
								<div class="col-sm-12 col-md-12">
									<label for="">Publico Alvo</label>
									<input type="text" class="form-control" placeholder="Enfermeras.." name="alvo">
								</div>
								<div class="col-sm-12 col-md-12">
									<label for="Sobre">Sobre o Curso<em>*</em><em><small class="caracteres"></small></em></label>
									<textarea name="sobre" id="sobre" class="form-control" rows="10"></textarea>											
								</div>
								<div class="col-sm-12 col-md-12">
									<label for="Sobre">Mercado de Trabalho<em>*</em><em><small class="caracteres"></small></em></label>
									<textarea name="mercado" class="form-control" rows="4" id="mercado" maxlength="250" required autofocus></textarea>											
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary" name="cadastra_curso" value="cadastra_curso">Cadastrar</button>
							</div>	
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.mask.js"></script>
<script>

	$('.valor').mask('000.000.000.000.000,00', {reverse: true});

</script>

</body>
</html>