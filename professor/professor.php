<?php 

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<?php include "../config/tema-top.php"; ?>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADM | Professor</title>

	
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/dashboard.css">
	<link rel="stylesheet" href="../css/offcanvas.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="../js/valCampos.js" ></script>
</head>

<body>
	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow  bg-white box-shadow">
		<nav class="my-2 my-md-0 mr-md-3 nav nav-underline">
			<a class="nav-link active" href="index.php"><strong>Dashboard</strong></a>
			<!-- <a class="nav-link" href="#">
				Friends
				<span class="badge badge-pill bg-light align-text-bottom">27</span>
			</a> -->
			<a class="nav-link p-2 text-dark" href="curso.php">Curso</a>
			<a class="active nav-link p-2 text-dark" href="professor.php">Professor</a>
			<a class="nav-link p-2 text-dark" href="turma.php">Turma</a>
			<a class="nav-link p-2 text-dark" href="aluno.php">Alunos</a>
			<a class="nav-link p-2 text-dark" href="pre.php">Matriculados</a>
			<a class="nav-link p-2 text-dark" href="servico.php">Servicos</a>
			<a class="nav-link p-2 text-dark btn-outline-danger" href="../config/logout.php">Sair</a>
		</nav>
	</div>

	<div class="container">
		<div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
			<a href="index.php" title="Inicio do dashboard"><img class="mr-3" src="../img/home.png" alt="" width="48" height="48"></a>
			<div class="lh-100">
				<h6 class="mb-0 text-white lh-100">Professor</h6><a style="margin-left: 69px!important;" class="add" href="" data-toggle="modal" data-target="#mymodalProf" title="Cadastrar Professor"><i class="material-icons">&#xE146;</i></a>
			</div>
		</div>
		<div class="my-3 p-3 bg-white rounded box-shadow">
			<?php

			if (isset($_POST['cadastra_prof'])) {
				if ($_POST['senha_prof'] == $_POST['csenha_prof']) {
					$sql = $mysqli->query("SELECT *FROM tb_professor WHERE cpf = '".$_POST['cpf']."'");
					if ($sql->num_rows > 0) {
						
					}else{

						$cry = sha1(md5($_POST['senha_prof']));

						$sql_contato = $mysqli->query("INSERT INTO tb_contato(telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')");
						//$c = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'");

						if ($sql_contato) {
							$c = mysqli_insert_id($mysqli);

							$login = $mysqli->query("INSERT INTO tb_login(email, senha, tipo) VALUES('".$_POST['email']."','$cry','2')");
							//$sl = $mysqli->query("SELECT *FROM tb_login WHERE senha = '$cry'")->fetch_assoc()['idtb_login'];
							$sl = mysqli_insert_id($mysqli);

							$sql = $mysqli->query("INSERT INTO tb_professor(nome, rg, cpf, tb_contato_idtb_contato, tb_login_idtb_login) VALUES('".$_POST['nome']."','".$_POST['rg']."','".$_POST['cpf']."','".$c."','$sl')") or die($mysqli->error);


							if ($sql) {
								
								echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
								<strong>Sucesso!</strong> Professor Cadastrado!
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";

							}else{

								echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
								<strong>Error!</strong> tente Novamente.
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
								</button>
								</div>";
							}

						}else{
							echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
							<strong>Error!</strong> ao cadastrar o Contato. Verefique o número e tente Novamente.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}
					}
				}else{
					echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
					<strong>Error!</strong> Senhas Diferentes.
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					</div>";
				}

			}

			if (isset($_POST['delete_prof'])) {

				$q = $mysqli->query("SELECT idtb_login FROM tb_login WHERE senha = '".sha1(md5($_POST['senha']))."'") or die($mysqli->error);
				if ($q->num_rows == 1) {

					$tur = $mysqli->query("SELECT *FROM tb_turma WHERE tb_professor_idtb_professor = '".$_POST['idtb_prof']."'");

					if ($tur->num_rows) {
						echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Error!</strong> Existem Cursos e Turmas abertas com esse Professor<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
					}else{

						$i = $mysqli->query("SELECT *FROM tb_professor WHERE idtb_professor = '".$_POST['idtb_prof']."'");

						if (!empty($i->fetch_assoc()['img'])) {

							unlink("../upload/".$i->fetch_assoc()['img']."");

						}
                        
                        $sqlStr = "DELETE FROM tb_login
                                    WHERE idtb_login = (
                                        SELECT tb_login_idtb_login FROM tb_professor
                                        WHERE idtb_professor = '".$_POST['idtb_prof']."'
                                    )";
                        $sql = $mysqli->query($sqlStr) or die("Erro ao deletar o login do professor!<br>'$sqlStr'<br>" . mysqli_error($mysqli));
                        
                        $sqlStr = "DELETE FROM tb_contato
                                    WHERE idtb_contato = (
                                        SELECT tb_contato_idtb_contato FROM tb_professor
                                        WHERE idtb_professor = '".$_POST['idtb_prof']."'
                                    )";
                        $sql = $mysqli->query($sqlStr) or die("Erro ao deletar o contato do professor!<br>'$sqlStr'<br>" . mysqli_error($mysqli));
                        
						$sql = $mysqli->query("DELETE FROM tb_professor WHERE idtb_professor = '".$_POST['idtb_prof']."'");


						if ($sql) {
							echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
							<strong>Sucesso!</strong> Professor Excluido!
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
								// header("Location: professor.php");
						}else{
							echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
							<strong>Error!</strong> tente Novamente.
							<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
							</button>
							</div>";
						}
					}
				}else{
					echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
					<strong>Error!</strong> Senha incorreta.
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span>
					</button>
					</div>";
				}
			}


			echo"<h6 class='border-bottom border-gray pb-2 mb-0'><strong>Professores Cadastrados</strong></h6>";

			$professor = $mysqli->query("SELECT *FROM tb_professor ORDER BY idtb_professor ASC");
			$s = $professor->num_rows;
			while ($ln = $professor->fetch_assoc()) {  ?>

				<div class="media text-muted pt-3">
					<p class="media-body pb-3 mb-0 small lh-125">
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-10">
										<strong class="d-block text-gray-dark"><?php echo $ln['nome']; ?></strong>										
									</div>
									<div class="col-2">
										<ul class="justify-content-end">
											<li><a href='' data-toggle='modal' data-target="#mymodalProf<?php echo $ln['idtb_professor'];?>"><i class="material-icons">&#xE417;</i></a></li>
											<li><a href='' data-toggle='modal' data-target="#delete<?php echo $ln['idtb_professor']; ?>"><i class="material-icons">&#xE872;</i></a></li>											
										</ul>
									</div>										
								</div>
							</div>
						</div>
					</p>
				</div>
				<hr>
				<div class="modal fade delete" tabindex="-1" role="dialog" id="mymodalProf<?php echo $ln['idtb_professor'];?>">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Currículo</h5>
							</div>
							<div class="modal-body contanto-form">
								<form action="" method="post">
									Está Incompleto
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-outline-warning" name="delete_prof" value="delete_prof">Continuar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade delete" tabindex="-1" role="dialog" id="delete<?php echo $ln['idtb_professor'];?>">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Excluir Professor</h5>
							</div>
							<div class="modal-body contanto-form">
								<form action="" method="post">
									<div class="col-sm-12 col-md-12">
										<label for="Curso">Confirme Senha<em>*</em></label>
										<input type="password" class="form-control" name="senha" required autofocus>
										<input type="hidden" name="idtb_prof" value="<?php echo $ln['idtb_professor']; ?>">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-outline-warning" name="delete_prof" value="delete_prof">Continuar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>


		<div class="modal fade" tabindex="-1" role="dialog" id="mymodalProf">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Cadastrar Professor</h5>
					</div>
					<form action="" method="post" onsubmit="return validarCampos(this);"> 
						<div class="modal-body contato-form">					                     
							<div class="row">
								<div class="col-sm-12 col-md-12">
									<label for="Curso">Nome Completo<em>*</em></label>
									<input type="text" class="form-control use-soLetras" name="nome" id="nome" value="<?php echo @$_POST['nome']; ?>" required autofocus>
									<span class='msg-erro msg-nome'></span>
								</div>
								<div class="col-sm-4 col-md-6">
									<label for="Carga Horária">CPF<em>*</em></label>
									<input type="tel" class="form-control cpf use-soNumeros use-addMask" name="cpf" id="cpf" title="CPF" value="<?php echo @$_POST['cpf']; ?>" maxlength="14" autocomplete="off" required autofocus>
								</div>
								<div class="col-sm-4 col-md-6">
									<label for="Valor">RG<em>*</em></label>
									<input type="tel" class="form-control rg use-soNumeros" name="rg" id="rg" title="RG" value="<?php echo @$_POST['rg']; ?>" maxlength="20" autocomplete="off" required autofocus>
									<span class='msg-erro msg-rg'></span>
								</div>
								<div class="col-sm-4 col-md-6">
									<label for="Valor">Celular<em>*</em></label>
									<input type="tel" class="form-control celular use-soNumeros use-addMask" name="tel1" id="tel1" title="Preferência ao Whatsapp" value="<?php echo @$_POST['tel1']; ?>" maxlength="16" autofocus required>
									<span class='msg-erro msg-rg'></span>
								</div>
								<div class="col-sm-4 col-md-6">
									<label for="Valor">Fixo</label>
									<input type="tel" class="form-control fixo use-soNumeros use-addMask" name="tel2" id="tel2" value="<?php echo @$_POST['tel2']; ?>" maxlength="14" autofocus>
									<span class='msg-erro msg-rg'></span>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="">E-mail<em>*</em></label>
									<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" value="<?php echo @$_POST['email']; ?>" required autofocus>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="">Confirme E-mail<em>*</em></label>
									<input type="email" class="form-control" placeholder="example@example.com" name="c_email" id="c_email" required autofocus>
									<span class='msg-erro msg-c_email'></span>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="">Senha<em>*</em></label>
									<input type="password" class="form-control senha_prof" name="senha_prof" id="senha" maxlength="15"  required autofocus>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="">Confirmer Senha<em>*</em></label>
									<input type="password" class="form-control csenha_prof" name="csenha_prof" id="c_senha" maxlength="15" required autofocus>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-outline-warning" name="cadastra_prof" value="cadastra_prof" id="botao">Cadastrar</button>						
						</div>
					</form>
				</div>
			</div>
		</div>


		<footer>
			<p class="text-center text-muted">Desenvolvido Faciliit. Todos os diretos resevados Anjos da Noite</p>
		</footer>

		<script src="../js/popper.min.js"></script>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.js"></script>
		<script src="../js/jquery.mask.min.js"></script>
		<script src="../js/app.js"></script>
        <script class="tmpScript" >
            var elOnlyLetters = document.getElementsByClassName("use-soLetras"),
                elOnlyNumbers = document.getElementsByClassName("use-soNumeros"),
                elMasc = document.getElementsByClassName("use-addMask");
            
            for(var a=0; a<elOnlyLetters.length; a+=1){
                if (elOnlyLetters[a] != null) elOnlyLetters[a].addEventListener("keypress", function(e){
                    return somenteLetras(e);
                }, false);
            }
            
            for(var a=0; a<elOnlyNumbers.length; a+=1){
                if (elOnlyNumbers[a] != null) elOnlyNumbers[a].addEventListener("keypress", function(e){
                    return somenteNumeros(e);
                }, false);
            }
            
            for(var a=0; a<elMasc.length; a+=1){
                if (elMasc[a] != null){
                    elMasc[a].addEventListener("focus", function(){
                        moveCursorToEnd(this);
                    }, false);
                    
                    elMasc[a].addEventListener("click", function(){
                        moveCursorToEnd(this);
                    }, false);
                    
                    elMasc[a].addEventListener("keypress", function(e){
                        inserirMascara(this);
                    }, false);
                    
                    elMasc[a].addEventListener("keydown", function(e){
                        removerMascara(this, e);
                    }, false);
                }
            }
        </script>
	</body>
	</html>