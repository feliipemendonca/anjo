<?php

include "../config/config.php";

?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<?php include "../config/tema-top.php"; ?>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<style>
	.form-control{
		text-transform: uppercase;
	}		
</style>
<script type="text/javascript">
	history.go(1);
</script>
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
				<a class="p-2 text-muted active" href="curso/">cursos</a>
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
	<section class="container curso-content-top">
		<div class=" text-center box-shadow">
			<div class="jumbotron">
				<div class="container">
					<p class="jumbotron-heading text-left">Matrícula</p>
					<p class="text-left"> Preencha seus dados conrretamente, todos o campos com <em>*</em>, são obrigatórios</p>
				</div>
			</div>
		</div>
	</section>

	<section class="ca-content">
		<div class="container">
			<div class="col-sm-12 col-md-12">
				<?php
				if (isset($_POST['cadastra_aluno'])) {
					$date = date("d-m-y");
					$n = date("d-m-y", strtotime($_POST['data']));

					if ($_POST['senha_aluno'] == $_POST['csenha_aluno']) {

						if ($_POST['email_aluno'] == $_POST['cemail_aluno']) {

							$cry = sha1(md5($_POST['senha_aluno']));

							$c = $mysqli->query("SELECT cpf FROM tb_aluno WHERE cpf = '".$_POST['cpf']."'") or die($mysqli->error);

							if ($_POST['cpf'] == $c->fetch_assoc()['cpf']) {
								echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
								<strong>Error!</strong> Já existe <strong>CPF</strong> Cadastrado.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}else{
								$r = $mysqli->query("SELECT rg FROM tb_aluno WHERE rg ='".$_POST['rg']."'");
								if ($_POST['rg'] == $r->fetch_assoc()['rg']) {
									echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
									<strong>Error!</strong> Já existe <strong>RG</strong> Cadastrado.
									<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
									</button>
									</div>";
								}else{
									$t = $mysqli->query("SELECT telefone1 FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'");
									if ($t->num_rows > 1) {
										echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
										<strong>Error!</strong> Já existe <strong>Telefone</strong> Cadastrado.
										<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
										<span aria-hidden='true'>&times;</span>
										</button>
										</div>";
									}else{
										$e = $mysqli->query("SELECT email FROM tb_login WHERE email = '".$_POST['email_aluno']."'");
										if ($_POST['email_aluno'] == $e->fetch_assoc()['email']) {
											echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
											<strong>Error!</strong> Já existe E-mail Cadastrado.
											<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
											<span aria-hidden='true'>&times;</span>
											</button>
											</div>";
										}else{
											
											$f = $mysqli->query("SELECT *FROM tb_contato WHERE telefone2 = '".$_POST['tel2']."'") or die($mysqli->error);
											if ($f->num_rows > 1) {
												echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
												<strong>Error!</strong> Número de Telefone já estar em uso.
												<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
												<span aria-hidden='true'>&times;</span>
												</button>
												</div>";
											}else{


												$a = $mysqli->query("INSERT INTO tb_contato(telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')") or die($mysqli->error);
												$b = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'") or die($mysqli->error);
												$c = $b->fetch_assoc()['idtb_contato'];
												$s = $mysqli->query("INSERT INTO tb_login(email, senha, tipo) VALUES('".$_POST['email_aluno']."','$cry','3')") or die($mysqli->error);
												$q = $mysqli->query("SELECT *FROM tb_login WHERE email ='".$_POST['email_aluno']."'") or die($mysqli->error);
												$id = $q->fetch_assoc()['idtb_login'];
												$sql = $mysqli->query("INSERT INTO tb_aluno(nome, cpf, rg, orgao, profissao, tipo_sangue, data, data_cadastro, tb_curso_idtb_curso, tb_sexo_idtb_sexo, tb_escolaridade_idtb_escolaridade, tb_contato_idtb_contato, tb_login_idtb_login) VALUES('".$_POST['nome']."','".$_POST['cpf']."','".$_POST['rg']."','".$_POST['orgao']."','".$_POST['profissao']."','".$_POST['tipo_sangue']."','$n','$date','".$_POST['curso']."','".$_POST['sexo']."','".$_POST['escolaridade']."','$c','$id')") or die($mysqli->error);

												$x = $mysqli->query("SELECT *FROM tb_aluno WHERE cpf ='".$_POST['cpf']."'") or die($mysqli->error);
												$idAluno = $x->fetch_assoc()['idtb_aluno'];
												
												$tur = $mysqli->query("INSERT INTO tb_turma_aluno (tb_aluno_idtb_aluno, tb_turma_idtb_turma, tb_curso_idtb_curso, tb_pagamento_idtb_pagamento) VALUES('$idAluno','".$_POST['turma']."','".$_POST['curso']."','1')") or die($mysqli->error);


												$en = $mysqli->query("INSERT INTo tb_endereco(cep, endereco, numero, bairro, cidade, estado, tb_aluno_idtb_aluno) VALUES(
													'".$_POST['cep']."',
													'".$_POST['endereco']."',
													'".$_POST['numero']."',
													'".$_POST['bairro']."',
													'".$_POST['cidade']."',
													'".$_POST['estado']."',
													'$idAluno')") or die($mysqli->error);






												$hora = date("YYYY-MM-DDThh:mm:ss.sTZD");
												$t = $mysqli->query("INSERT INTO tb_transacao(status, idtb_aluno, data) VALUES('1','$idAluno','$hora')") or die($mysqli->error);
												if ($en) {

													$cu1 = ($_POST['curso']);
													$tumar=($_POST['turma']);
													$professor = ($_POST['professor']);
													$alunoId = ($idAluno);

													echo "<script> document.location.href='sucesso.php?code=".$cu1."&tur=".$turma."&pro=".$professor."&id=".$alunoId."&cur=".$cu1."';</script>";
												}
											}
										}
									}
								}
							}
						} else{
							echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
							<strong>Error!</strong> E-mail Diferentes
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}
					}else{
						echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Senhas Diferentes
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
						</button>
						</div>";
					}
				}
				?>
				<form style="padding-bottom: 9em;" action="" method="post" accept-charset="utf-8" style="text-transform: uppercase;"> 
					<input type="hidden" name="curso" value="<?php echo base64_decode($_GET['cur']); ?>">                                          
					<input type="hidden" name="turma" value="<?php echo base64_decode($_GET['tur']); ?>">                                        
					<input type="hidden" name="professor" value="<?php echo base64_decode($_GET['pro']); ?>">                                        
					<div class="row">
						<input type="hidden" name="idprofessor" value="<?php $h = $mysqli->query("SELECT *FROM tb_turma WHERE idtb_turma = '".$_POST['turma']."'"); echo $h->fetch_assoc()['tb_professor_idtb_professor']; ?>">
						<div class="col-sm-12 col-md-12">
							<br>
							<p><strong>Dados Pessoais</strong></p>
							<hr>							
						</div>
						<div class="col-sm-12 col-md-8">
							<label for="Curso">Nome Completo<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="nome" value="<?php echo @$_POST['nome']; ?>">
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Sexo" required autofocus>Sexo<em>*</em></label>
							<select name="sexo" class="form-control" required>
								<option>Selecione</option>
								<?php $a = $mysqli->query("SELECT *FROM tb_sexo"); while ($b = $a->fetch_assoc()) {
									echo "<option value=".$b['idtb_sexo'].">".$b['sexo']."</option>";
								} ?>
							</select>							
						</div>

						<div class="col-sm-12 col-md-4">
							<label for="CPF">CPF<em>*</em></label>
							<input type="tel" class="form-control use-soNumeros use-addMask cpf" name="cpf" title="CPF" placeholder="000.000.000.00" maxlength="14" value="<?php echo @$_POST['cpf']; ?>" required>
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="RG">RG<em>*</em></label>
							<input type="tel" class="form-control use-soNumeros rg" name="rg" title="RG" placeholder="000.000.000" maxlength="11" value="<?php echo @$_POST['rg']; ?>" required>
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Orgão">Órgão Expeditor<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="orgao" value="<?php echo @$_POST['orgao']; ?>" required>

						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Escolaridade">Escolaridade<em>*</em></label>
							<select name="escolaridade" class="form-control" required>
								<option>Selecione</option>
								<?php $c = $mysqli->query("SELECT *FROM tb_escolaridade"); while ($d = $c->fetch_assoc()) {
									echo "<option value=".$d['idtb_escolaridade'].">".$d['nivel']."</option>";
								} ?>
							</select>						
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Profissão">Profissão<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="profissao" value="<?php echo @$_POST['profissao']; ?>" required> 											
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="data">Data de Nascimento<em>*</em></label>
							<input type="date" class="form-control use-soNumeros" name="data" maxlength="10" required> 											
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Tipo Sanguineo">Tipo Sanguineo</label>
							<input type="text" class="form-control use-soLetras" name="tipo_sangue" value="<?php echo @$_POST['tipo_sangue']; ?>" >
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Celular">Celular<em>*</em></label>
							<input type="tel" class="form-control use-soNumeros use-addMask celular" placeholder="Preferencia Whatsapp" name="tel1" value="<?php echo @$_POST['tel1']; ?>" required>
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Fixo">Fixo</label>
							<input type="tel" class="form-control use-soNumeros use-addMask fixo" name="tel2" placeholder="(00) 0000-0000" maxlength="14" value="<?php echo @$_POST['tel2']; ?>">
						</div>
						<div class="col-sm-12 col-md-12">
							<br>
							<p><strong>Endereço</strong></p>
							<hr>							
						</div>
						<div class="col-sm-12 col-md-5">
							<label for="CEP">CEP<em>*</em></label>
							<input type="tel" class="form-control cep use-soNumeros" name="cep" placeholder="00000-000" maxlength="9" value="<?php echo @$_POST['cep']; ?>" required>
						</div>
						<div class="col-sm-12 col-md-5">
							<label for="Endereço">Endereço<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="endereco" value="<?php echo @$_POST['endereco']; ?>" required>
						</div>	
						<div class="col-sm-12 col-md-2">
							<label for="Número">Número</label>
							<input type="tel" class="form-control use-soNumeros" name="numero" value="<?php echo @$_POST['numero']; ?>" maxlength="4" required>

						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Bairro">Bairro<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="bairro" value="<?php echo @$_POST['bairro']; ?>" required>
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Cidade">Cidade<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="cidade" value="<?php echo @$_POST['cidade']; ?>" required>								
						</div>
						<div class="col-sm-12 col-md-4">
							<label for="Estado">Estado<em>*</em></label>
							<input type="text" class="form-control use-soLetras" name="estado" value="<?php echo @$_POST['estado']; ?>" required>								
						</div>
						<div class="col-sm-12 col-md-12">
							<br>
							<p><strong>Informações de Login</strong></p>	
							<small>Seu e-mail e senha seram usadas para logar no sistema</small>							
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label for="">E-mail<em>*</em></label>
							<input type="email" class="form-control" placeholder="example@example.com" name="email_aluno"  value="<?php echo @$_POST['email_aluno']; ?>"  style="text-transform: unset;" required>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="">Confirme E-mail<em>*</em></label>
							<input type="email" class="form-control" name="cemail_aluno"  style="text-transform: unset;" required>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="">Senha<em>*</em></label>
							<input type="password" class="form-control" name="senha_aluno" style="text-transform: unset;" required>
						</div>
						<div class="col-sm-12 col-md-6">
							<label for="">Confirme Senha<em>*</em></label>
							<input type="password" class="form-control" name="csenha_aluno" style="text-transform: unset;" required>
							<br>
						</div>
					</div>
					<div class="col-sm-12 col-md-2 ">
						<button type="button" class="btn btn-outline-warning form-control"  data-toggle="modal" data-target="#modal">Continuar</button>
						<br>
					</div>
				</div>
				<div class="modal fade" tabindex="-1" role="dialog" id="modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-center">
						<div class="modal-content">
							<div class="modal-header">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<h5 class="modal-title">Atenção</h5>
									</div>
									<div class="col-sm-12 col-md-12">
										<p><em>Aviso: </em>Leia atentamente as Infomações contidades neste contrato. Pois ao clicar em concordo, você estará automáticamente aceitando todas as normas de adesão de serviços prestado de acordo com as Leis virgêntes no País. </small></p>
									</div>							
								</div>
							</div>
							<div class="modal-body">
								<div class="termo">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Não Concordo</button>
								<button type="submit" class="btn btn-warning" value="cadastra_aluno" name="cadastra_aluno">Concordo</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<footer>
	<div class="container">
		<p class="text-right">©2018 Anjos da Noite. Todos os Direitos Resevados | Designer Faciliit</p>
	</div>
</footer>


<script src="../js/popper.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
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