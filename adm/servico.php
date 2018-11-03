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
					<li  class="active">
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
										Serviços<a href="" data-toggle="modal" data-target="#servico" title="Cadastrar Novo Serviço"><i class="fa fa-fw fa-plus-circle"></i></a>
									</h1>
								</div>
								<!-- <div class="col-sm-12 col-md-3">
									<form action="" method="post" class="form-inline my-2 my-lg-0" style="padding-top: 1.5em;">
										<input class="form-control mr-sm-2 form-control-lg" type="search" placeholder="Pesquisar Curso" aria-label="Search" name="nome">
										<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="pesquisa" value="pesquisa"><i class="fa fa-fw fa-search"></i></button>
									</form>
								</div> -->
							</div>
						</div>
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="index.php">Inicio</a>
							</li>
							<li class="active">
								<i class="fa fa-fw fa-briefcase"></i>Serviços
							</li>
						</ol>
					</div>
					<div class="col-lg-12">
						<?php

						if (isset($_POST['cadastro_servico'])) {

							$sql = $mysqli->query("SELECT *FROM tb_servico WHERE nome ='".$_POST['nome']."'");
							if ($sql->num_rows >0) {

							}else{

								$foto = $_FILES["image"];
								if (!empty($foto["name"])) {

									$dimensoes = getimagesize($foto["tmp_name"]);

									preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

									$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

									$caminho_imagem = "../upload/" . $nome_imagem;

									move_uploaded_file($foto["tmp_name"], $caminho_imagem);

									$sql = $mysqli->query("INSERT INTO tb_servico(nome, descricao, img) VALUES('".$_POST['nome']."','".$_POST['descricao']."','$nome_imagem')") or die($mysqli->error);

									if ($sql) {

										echo "<div class='alert alert-success alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Serviço Cadastrado!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";

									}else{

										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Erro!</strong> Tente Novamente!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}
								}
							}
						}

						if (isset($_POST['delete_servico'])) {
							if (isset($_POST['senha'])) {
								$q = $mysqli->query("SELECT senha FROM tb_login WHERE senha = '".sha1(md5($_POST['senha']))."' AND email = '".$_SESSION['email']."'") or die($mysqli->error);
								if ($q->num_rows) {
									$a = $mysqli->query("SELECT img FROM tb_servico WHERE idtb_servico = '".$_POST['id']."'");
									$b = $a->fetch_assoc()['img'];
									unlink("../upload/".$b."");
									$sql = $mysqli->query("DELETE FROM tb_servico WHERE idtb_servico = '".$_POST['id']."'");
									if ($sql) {

										echo "<div class='alert alert-success alert-dismissible' role='alert'>
										<strong>Sucesso!</strong> Serviço foi Excluido!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";

									}else{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'>
										<strong>Erro!</strong> Tente Novamente!
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}
								}else{
									echo "<div class='alert alert-warning alert-d' role='alert'>
									<strong>Erro!</strong> Senha do Administrador Incorreta!
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}
							}

						}

						if (isset($_POST['up_servico'])) {

							$foto = $_FILES["image"];

							if (!empty($foto["name"])) {

								$dimensoes = getimagesize($foto["tmp_name"]);

								preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

								$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

								$caminho_imagem = "../upload/" . $nome_imagem;

								move_uploaded_file($foto["tmp_name"], $caminho_imagem);

								$sql = $mysqli->query("UPDATE tb_servico SET nome = '".$_POST['nome']."', descricao = '".$_POST['descricao']."', img = '$nome_imagem' WHERE idtb_servico = '".$_POST['idtb_servico']."'") or die($mysqli->error);

								if ($sql) {
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Serviço Atualizado com Sucesso!
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}else{
									echo "<div class='alert alert-success alert-dismissible' role='alert'>
									<strong>Sucesso!</strong> Tente Novamente!
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}

							}else{
								$sql = $mysqli->query("UPDATE tb_servico SET nome = '".$_POST['nome']."', descricao = '".$_POST['descricao']."' WHERE idtb_servico = '".$_POST['idtb_servico']."'") or die($mysqli->error);
							}
							if ($sql) {
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<strong>Sucesso!</strong> Serviço Atualizado com Sucesso!
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}else{
								echo "<div class='alert alert-success alert-dismissible' role='alert'>
								<strong>Sucesso!</strong> Tente Novamente!
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}
						}

						?>

						<div class="col-sm-12 col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover ">
									<thead>
										<tr>
											<th>ID</th>
											<th>Serviço</th>
											<th>Ações</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php
											$sql = $mysqli->query("SELECT *FROM tb_servico ORDER BY idtb_servico ASC") or die($mysqli->error);
											while ($ln = $sql->fetch_assoc()) {?>

												<td><?php echo $ln['idtb_servico']; ?></td>
												<td><?php echo $ln['nome']; ?></td>
												<td>
													<a href='' data-toggle='modal' data-target="#mymodal_servico<?php echo $ln['idtb_servico'];?>"><i class="fa fa-fw fa-eye"></i></a>
													<a href='' data-toggle='modal' data-target="#delete<?php echo $ln['idtb_servico']; ?>"><i class="fa fa-fw fa-trash-o"></i></a>

												</td>
												<div class="modal fade " tabindex="-1" role="dialog" id="mymodal_servico<?php echo $ln['idtb_servico']; ?>" style="opacity: 1; padding-top: 11em;">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title pre"><strong>Visualizar Serviço</strong></h5>
															</div>
															<div class="modal-body">
																<form action="" method="post" enctype="multipart/form-data">   
																	<input type="hidden" name="idtb_servico" value="<?php echo $ln['idtb_servico']; ?>">                   
																	<div class="row">
																		<div class="col-sm-12 col-md-6">
																			<?php if (isset($ln['img'])) {?>													
																				<img src="../upload/<?php echo $ln['img']; ?>" class="img-responsive" width="100%" title="<?php echo $ln['nome']; ?>">														
																			<?php }else{ ?>
																				<label for="IMG">Imagem</label>
																				<input type="file" class="form-control" name="image">													
																			<?php } ?>
																		</div>
																		<div class="col-sm-12 col-md-6">
																			<div class="col-sm-12 col-md-12">
																				<label for="Curso">Serviço<em>*</em></label>
																				<input type="text" class="form-control" name="nome" required autofocus value="<?php echo $ln['nome']; ?>">
																			</div>													
																			<div class="col-sm-12 col-md-12">
																				<label for="Valor">Descrição<em>*</em></label>
																				<textarea name="descricao" class="form-control" rows="10" maxlength="250" required autofocus><?php echo $ln['descricao']; ?></textarea>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal">Fecha</button>						
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>


												<div class="modal fade" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_servico']; ?>"  style="opacity: 1; padding-top: 11em;">
													<div class="modal-dialog modal-sm">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title pre"><strong>Exluir serviço?</strong></h5>
															</div>
															<div class="modal-body">
																<form action="" method="post" enctype="multipart/form-data">   
																	<input type="hidden" name="idtb_servico" value="<?php echo $ln['idtb_servico']; ?>">                   
																	<div class="row">
																		<div class="col-sm-12 col-md-12">
																			<label for="Valor">Senha<em>*</em></label>
																			<input type="password" name="senha" class="form-control" required autofocus>
																			<input type="hidden" name="id" value="<?php echo $ln['idtb_servico']; ?>">
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
																		<button type="submit" class="btn btn-primary" name="delete_servico" value="delete_servico">EXcluir</button>		
																	</div>
																</form>
															</div>
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
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="servico" style="opacity: 1; padding-top: 11em;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><strong>Cadastrar Novo Serviço</strong></h5>
				</div>				
				<form action="" method="post" enctype="multipart/form-data"> 
					<div class="modal-body">                   
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<label for="Serviço">Serviço<em>*</em></label>
								<input type="text" class="form-control" name="nome" required autofocus>
							</div>
							<div class="col-sm-12 col-md-6">
								<label for="Image">Image<em>*</em></label>
								<input type="file" class="form-control" name="image" required autofocus>									
							</div>
							<div class="col-sm-12 col-md-12">
								<label for="Sobre">Descrição<em>*</em></label>
								<textarea name="descricao" class="form-control" rows="5" maxlength="250" required autofocus></textarea>											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary" name="cadastro_servico" value="cadastro_servico">Cadastrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script src="../js/popper.min.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>


</body>
</html