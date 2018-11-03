<?php 
include "../config/seguranca.php";
include "../geral.php";

$idtb_prof = $_SESSION['idtb_login'];
$sql = "SELECT *FROM tb_professor WHERE tb_login_idtb_login = '$idtb_prof'";
$pro = $mysqli->query($sql) or die("Erro!<br>" . mysqli_error($mysqli));
while ($ln = $pro->fetch_assoc()) {
	$nome = $ln['nome'];
	$idtb_professor = $ln['idtb_professor'];
}
?>
<!DOCTYPE>
<html lang="pt-br">
<head>
	<title>ADM | PROFº | BIBLIOTECA</title>
	<meta charset="utf-8" /><!-- 
	<link media="screen" rel="stylesheet" href="/index.css" /> -->
	<!--<link media="screen" rel="stylesheet" href="css/index.css" />-->
	<link media="screen" rel="stylesheet" href="css/animations.css" />

	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<style>
	#div_iconsArquivo{
		width: 450px;
		position: relative;
		margin-bottom: 35px;

		-webkit-animation: anim_iconArquivo 0.8s ease-in;
		-moz-animation: anim_iconArquivo 0.8s ease-in;
		-o-animation: anim_iconArquivo 0.8s ease-in;
		animation: anim_iconArquivo 0.8s ease-in;
	}

	#div_iconsArquivo img {
		border: 3px solid black;
		margin: 5px;
		padding: 5px;
	}

	.hidde_animation{
		-webkit-animation: anim_iconArquivo 0.8s ease-in-out reverse !important;
		-moz-animation: anim_iconArquivo 0.8s ease-in-out reverse !important;
		-o-animation: anim_iconArquivo 0.8s ease-in-out reverse !important;
		animation: anim_iconArquivo 0.8s ease-in-out reverse !important;
	}

	.img_icon{
		width: auto !important;
		height: 150px !important;
		cursor: pointer;
	}

	#select_img_icon{
		-webkit-animation: anim_iconChange 1.5s ease-in-out;
		-moz-animation: anim_iconChange 1.5s ease-in-out;
		-o-animation: anim_iconChange 1.5s ease-in-out;
		animation: anim_iconChange 1.5s ease-in-out;
	}
</style>

<style id="animChangeIcon_style"></style>
</head>

<body>

	<div id="wrapper">
		<?php /*Menu*/ $linkRedirect="../"; $active=5; include "../professor/menu.php"; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Material
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Início
							</li>
							<li class="active">
								<i class="fa fa-download"></i> Material
							</li>
						</ol>
						<?php   if (empty($pro->fetch_assoc()['formacao'])) { ?>
							<h4><strong class="text-danger">Atenção!</strong> Matenha seu dados sempre atualizados. <a href="<?php echo $linkRedirect ?>conta.php" title="Atualiar dados">Clique aqui!</a></h4>
						<?php } ?>
					</div>
					<div class="col-sm-12 col-md-12">
						<?php			

						include "../professor/checkSession.php";
						if(!(@$turma = $_SESSION["turma"])){ ?>
						<!--<h3 style="padding: 20px; padding-bottom: 0px;">Por favor selecione a turma!</h3>
							<h4 style="padding: 20px; padding-top: 0px;">Redirecionando em <span id="span_segs"></span></h4>-->

							<div class='alert alert-warning alert-dismissible' role='alert'>
								<strong>Selecione uma turma na Pagina Turma / Aluno</strong> Redirecionando em <span id="span_segs"></span>
								<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>
							</div>

							<script>
								var redSegundos = 5;
								var span_segs = document.getElementById("span_segs");

								span_segs.innerHTML = redSegundos + ((redSegundos >= 1) ? " segundos" : " segundo");
								setInterval(function(){
									if (redSegundos == 0) location.href = "/professor/aluno.php?redURL=" + location.href;

									var tmpStr = redSegundos--;
									tmpStr += ((redSegundos >= 1) ? " segundos" : " segundo");

									span_segs.innerHTML = tmpStr;
								}, 1000);
							</script>
							<?php
							exit();
						}

						function getTokenDiferente($mysqli){
							$tempToken = getToken(30);

							$sql = "SELECT id FROM tb_biblioteca WHERE token='$tempToken'";
							$query = mysqli_query($mysqli, $sql) or die("Erro!<br>" . mysqli_error($mysqli));

							if(mysqli_num_rows($query) > 0) return getTokenDiferente();
							return $tempToken;
						}

						if($_POST){
							$grupo = $_POST["grupo"];
							$titulo = $_POST["titulo"];
							$descricao = $_POST["descricao"];
							$icone = $_POST["icone"];
							$arquivo = $_FILES["arquivos"];
							$pasta = $_POST["pasta"];

							if((!isset($grupo) || $grupo == "") || (!isset($titulo) || $titulo == "") || !isset($descricao) || (!isset($icone) || $icone == "") || !isset($arquivo) || (count($arquivo["name"]) == 1 && $arquivo["name"][0] == "") || !isset($pasta)){
								?>
								<script>
									alert("Erro!\nNão foi possivel enviar o arquivo!");
                                    location.href = ".";
								</script>
								<?php
								exit();
							}

							if($grupo == -1){
                                $sql = "SELECT id FROM tb_gp_biblioteca
                                        WHERE titulo='$titulo'";
                                $query = mysqli_query($mysqli, $sql);
                                if(!$query){ ?>
                                    <script>
                                        alert("Erro!\nOcorreu um erro ao obter informações de grupos no banco!");
                                        location.href = ".";
                                    </script>
                                    <?php exit();
                                }
                                
                                if(mysqli_num_rows($query) > 0 ){ ?>
                                    <script>
                                        alert("Erro!\nJá existe um grupo com esse nome!\nTente outro nome!");
                                        location.href = ".";
                                    </script>
                                    <?php exit();
                                }
                                
								$sql = "INSERT INTO tb_gp_biblioteca (id_turma, titulo, descricao, icone)
								VALUES ('$turma', '$titulo', '$descricao', '$icone')";
								$query = mysqli_query($mysqli, $sql) or die("Erro!<br>" . mysqli_error($mysqli));
								$grupo = mysqli_insert_id($mysqli);
							}else{
								$sql = "SELECT id FROM tb_gp_biblioteca
								WHERE id=$grupo";
								$query = mysqli_query($mysqli, $sql) or die("Erro!<br>" . mysqli_error($mysqli));

								if(mysqli_num_rows($query) == 0){
									?>
									<script>
										alert("Erro!\nEsse grupo de biblioteca já não existe mais!");
									</script>
									<?php
									header("Refresh: 10");
									exit();
								}
							}

							for($a=0; $a<count($arquivo["name"]); $a+=1){
								$nomeArquivo = $arquivo["name"][$a];
                                
                                if(strlen($nomeArquivo) > 250){
                                    $i = strrpos($nomeArquivo, ".");

                                    $extensao = "";
                                    if($i > 1){
                                        $extensao = substr($nomeArquivo, $i);
                                        $nomeArquivo = substr($nomeArquivo, 0, strrpos($nomeArquivo, $extensao));
                                    }

                                     $nomeArquivo =  substr($nomeArquivo, 0, 250 - strlen($extensao) -1) . "_" . $extensao;
                                }
                                
								$arquivoFinal = "lib_aluno/" . $nomeArquivo;

								if(move_uploaded_file($arquivo["tmp_name"][$a], $arquivoFinal)){
									$token = getTokenDiferente($mysqli);

									$sql = "INSERT INTO tb_biblioteca (id_grupo, arquivo, dt_envio, token)
									VALUES (" . $grupo . ", '$nomeArquivo', now(), '$token')";
									$query = mysqli_query($mysqli, $sql);

									if(!$query){
										//unlink($arquivoFinal);
                                        if ($grupo == -1) mysqli_query("DELETE FROM tb_gp_biblioteca WHERE id=" . mysqli_insert_id($mysqli));
										?>
										<--<script>
											alert("Erro!\nEsse material já foi postado!");location.href=".";
										</script>-->
										<script>
											alert("Erro!\nNão foi possivel sincronizar com o banco de dados!");
										</script>
										<?php
										exit();
									}
								}else{
									?>
									<script>
										alert("Erro!\nNão foi possivel enviar o arquivo!");location.href=".";
									</script>
									<?php
									exit();
								}
							}

							?>
							<script>
								alert("Material enviado com sucesso!");
							</script>
							<?php
						}

						$sql = "SELECT id, titulo, descricao, pasta, icone FROM tb_gp_biblioteca WHERE id_turma=$turma";

						$query = mysqli_query($mysqli, $sql) or die("Erro!<br>" . mysqli_error($mysqli));

						$gp_ids = array();
						$gp_titulos = array();
						$gp_descricoes = array();
						$gp_pastas = array();
						$gp_icones = array();
						while($res = mysqli_fetch_assoc($query)){
							$gp_ids[] = $res["id"];
							$gp_titulos[] = $res["titulo"];
							$gp_descricoes[] = $res["descricao"];
							$gp_pastas[] = $res["pasta"];
							$gp_icones[] = $res["icone"];
						}			
						$tipos_icones = getTipoIcones(); ?>


						<div class="col-sm-12 col-md-4">
							<form action="" method="POST" enctype="multipart/form-data" >
								<input type="hidden" name="turma" />
								<div class="form-group">
									<select id="sel_grupos" name="grupo" class="form-control" onchange="selecionarGrupo();" >
										<?php
										for($a=0; $a<count($gp_ids); $a+=1){
											?>
											<option value="<?php echo $gp_ids[$a]; ?>" >
												<?php echo $gp_titulos[$a]; ?>
											</option>
											<?php
										}
										?>
										<option value="-1">Criar um novo grupo</option>
									</select>
								</div>							
								<div class="form-group">
									<input type="file" class="form-control" name="arquivos[]" onchange="checkFiles(this);" multiple style="display: inline;" />
									<div id="div_iconsArquivo" style="display:none;" >
										<?php
										for($a=0; $a<count($tipos_icones); $a+=1){ ?>
											<img class="img_icon" src="icones/<?php echo $tipos_icones[$a]; ?>_icon.png" onclick="selecionarIcone(<?php echo $a ?>)" />
										<?php } ?>
									</div>
								</div>
								<div class="form-group" id="div_gp_inpt">
									<input type="text" class="form-control" name="titulo" placeholder="Título" readonly />
									<textarea name="descricao" class="form-control" placeholder="Descrição" readonly ></textarea>
									<input type="text" class="form-control" name="pasta" placeholder="Nome da pasta" readonly />
									<img class="img_icon" id="select_img_icon" style="margin-top: 20px;" src="icones/<?php echo $tipos_icones[0]?>_icon.png" onclick="show_hiddenSelectIcone();" />
								</div>
								<input type="hidden" name="icone" value="<?php echo $tipos_icones[0]; ?>" />
								<div class="form-group">
									<input type="submit" class="btn btn-primary" name="enviarArquivo" value="Enviar" />
								</div>
							</form>
						</div>
						<div class="col-sm-12 col-md-8">
							<iframe src="/biblioteca/virtual/" frameborder="1" width="100%" style="transform: scale(0.9); border: 1px solid #e6e6e6; height: 38em; padding: 0;"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/animationManager.js" type="text/javascript"></script>
	<script>
		var icones = [<?php echo "\"" . implode("\",\"", $tipos_icones) . "\"" ?>];

		var gp_titulos = [<?php echo "\"" . implode("\",\"", $gp_titulos) . "\"" ?>],
		gp_descricoes = [<?php echo "\"" . implode("\",\"", $gp_descricoes) . "\"" ?>],
		gp_pastas = [<?php echo "\"" . implode("\",\"", $gp_pastas) . "\"" ?>],
		gp_icones = [<?php echo "\"" . implode("\",\"", $gp_icones) . "\"" ?>];
	</script>
	<script type="text/javascript" src="js/fileSend.js"></script>
	<script class="tempScript">
		function ajustDivIcons(){
			var el1 = document.getElementById("div_iconsArquivo"),
			el2 = document.getElementsByName("arquivos[]")[0];

			el1.style.left = (el2.offsetLeft + 10) + "px";
			el1.style.top = (parseFloat(el2.offsetTop) + parseFloat(el2.height) - parseInt(31)) + "px";


			createEventListener(el1, "animationend", function(){
				if(el1.className == "hidde_animation"){
					el1.style.display = "none";
					el1.className = "";
				}
			});
		}

		document.body.onload = function(){
			ajustDivIcons();
			selecionarGrupo();
		};
	</script>

	<script src="/js/popper.min.js"></script>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
</body>
</html>