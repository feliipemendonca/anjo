<?php
include "../config/config.php";
include "../config/seguranca.php";
include "../geral.php"; 
include "../professor/consul_dados.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ADM | PROFº</title>

	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- <style>
	input[type=checkbox] {
		/* Double-sized Checkboxes */
		-ms-transform: scale(2); /* IE */
		-moz-transform: scale(2);  FF 
		-webkit-transform: scale(2); /* Safari and Chrome */
		-o-transform: scale(2); /* Opera */
		transform: scale(2);
	}
	
	/*#tb_presencas_aluno{
		font-size: 14pt;
		font-family: 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, 'sans-serif';
		}*/
	</style> -->
</head>

<body onload="now();">

	<div id="wrapper">
		<?php /*Menu*/ $linkRedirect="../"; $active=3; include "../professor/menu.php"; ?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Presença
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Início
							</li>
							<li class="active">
								<i class="fa fa-bolt"></i> Presença
							</li>
						</ol>
						<?php   if (empty($pro->fetch_assoc()['formacao'])) { ?>
							<h4><strong class="text-danger">Atenção!</strong> Matenha seu dados sempre atualizados. <a href="<?php echo $linkRedirect ?>conta.php" title="Atualiar dados">Clique aqui!</a></h4>
						<?php } ?>
					</div>
					<div class="col-sm-12 col-md-12">

						<?php


            // $linkRedirect = "../";
            // $active = 4;


						include "../professor/checkSession.php";
						if(!($turma = $_SESSION["turma"])){ ?>
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
                            <!--<script>
                                location.href = "/professor/aluno.php?redURL=" + location.href;
                            </script>-->
                            <?php
                            exit();
                        }

                        mysqli_query($mysqli, "SET NAMES 'utf-8'");
                        mysqli_query($mysqli, "SET character_set_connection=utf8");
                        mysqli_query($mysqli, "SET character_set_client=utf8");
                        mysqli_query($mysqli, "SET character_set_results=utf8");

			//$turma = 5;
			/*
			$sql = "SELECT a.idtb_aluno, a.nome, c.curso FROM tb_aluno a
					JOIN tb_curso c ON c.idtb_curso = a.tb_curso_idtb_curso
					WHERE a.tb_curso_idtb_curso = 1";
			*/

					$sql = "SELECT  a.idtb_aluno, a.nome, c.curso, t.nome as turma, p.nome as professor FROM tb_turma t
					JOIN tb_turma_aluno ta ON t.idtb_turma=ta.tb_turma_idtb_turma
					JOIN tb_aluno a ON a.idtb_aluno=ta.tb_aluno_idtb_aluno
					JOIN tb_curso c ON c.idtb_curso=t.tb_curso_idtb_curso
					JOIN tb_professor p ON p.idtb_professor=t.tb_professor_idtb_professor
					WHERE t.idtb_turma=$turma";

					$query = mysqli_query($mysqli, $sql) or die("Erro!");

					$quantAlunos = mysqli_num_rows($query);
					?>
					<div style="padding: 20px;">
						<p>
							<strong>Curso: </strong>
							<?php
							$res = mysqli_fetch_assoc($query);
							echo $res["curso"];
							?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>Turma:</strong> <?php echo $res["turma"]; ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>Alunos:</strong> <?php echo $quantAlunos; ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<strong>Prof.:</strong> <?php echo $res["professor"]; ?>
						</p>
						<div class="col-sm-6 col-md-3">
							<select id="select_datas" class="form-control" onchange="getPresencas();">
								<?php
								$sql2 = "SELECT DATE_FORMAT(data, '%d/%m/%Y') as data FROM tb_dia_letivo";
								$query2 = mysqli_query($mysqli, $sql2) or die("Erro ao obter as datas!");

								while($res2 = mysqli_fetch_assoc($query2)){
									?>
									<option><?php echo $res2["data"] ?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="table-responsive">								
								<table id="tb_presencas_aluno" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nome</th>
											<th>Presente?</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while($res){
											?>
											<tr>
												<input type="hidden" name="id_aluno" value="<?php echo $res["idtb_aluno"]; ?>" />
												<th> <?php echo $res["idtb_aluno"]; ?> </th>
												<th> <?php echo $res["nome"]; ?> </th>
												<th style="text-align: center;"> <input type="checkbox" name="presente" /> </th>
											</tr>
											<?php $res = mysqli_fetch_assoc($query);
										} 
										?>
									</tbody>
								</table>
							</div>
							<div id="div_btsSalvarPresenca">
								<button id="bt_cancelar" onclick="bt_clickPresenca(this)"> Cancelar </button>
								<button id="bt_salvar" onclick="bt_clickPresenca(this)"> Salvar </button>
							</div>
							<iframe style="display:none;" name="presenca_get" ></iframe>
							<form id="form_get_presenca" action="presenca_get.php" method="POST" target="presenca_get">
								<input type="hidden" name="data_get" value="" required />
								<input type="hidden" name="turma_get" value="" required />
							</form>

							<iframe style="display:none;" name="presenca_post" ></iframe>
							<form id="form_presenca" action="presenca_post.php" method="POST" target="presenca_post" >
								<input type="hidden" name="ids_post" value="" required />
								<input type="hidden" name="presentes_post" value="" required />
								<input type="hidden" name="data_post" value="" required />
								<input type="hidden" name="turma_post" value="" required />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var select_datas = document.getElementById("select_datas");

		function bt_clickPresenca(el){
			if (el == null) return;

			var ids = document.getElementsByName("id_aluno"),
			presentes = document.getElementsByName("presente"),
			data_selecionada = document.getElementById("select_datas");

			if(el.id == "bt_cancelar"){
				for(var a=0; a < presentes.length; a+=1){
					presentes[a].checked = false;
				}

				alert("Cancelado!");
			}else if(el.id == "bt_salvar"){
				if(ids.length != presentes.length){
					alert("Desculpe, mas ocorreu um erro!");
					return;
				}

				var ids_post = "";
				var presentes_post = "";
				for(var a=0; a < ids.length && a < presentes.length; a+=1){
					ids_post += ids[a].value;
					presentes_post += presentes[a].checked ? "1" : "0";

					if (a != ids.length - 1){
						ids_post += ",";
						presentes_post += ",";
					}
				}

				document.getElementsByName("ids_post")[0].value = ids_post;
				document.getElementsByName("presentes_post")[0].value = presentes_post;
				document.getElementsByName("data_post")[0].value = select_datas.options[select_datas.selectedIndex].innerHTML.replace("/", ",").replace("/", ",");
				document.getElementsByName("turma_post")[0].value = "<?php echo $turma ?>";
				document.getElementById("form_presenca").submit();
			}else{
				alert("Desculpe, mas ocorreu um erro!");
				return;
			}
		}
	</script>
	<script>
		function getPresencas(){
			document.getElementsByName("data_get")[0].value = select_datas.options[select_datas.selectedIndex].innerHTML.replace("/", ",").replace("/", ",");
			document.getElementsByName("turma_get")[0].value = "<?php echo $turma ?>";
			document.getElementById("form_get_presenca").submit();
		}

		function now(){
			var data_agora = document.createElement("option"),
			d = new Date(),
			dd = d.getDate().toString();
			mm = (parseInt(d.getMonth())+1).toString();

			d = ((dd.length==1) ? "0" + dd : dd) + "/" + ((mm.length==1) ? "0" + mm : mm) + "/" + d.getFullYear();

			if (select_datas.options.length == 0 || select_datas.options[select_datas.length-1].innerHTML != d){
				data_agora.innerHTML = d;
				select_datas.appendChild(data_agora);
				data_agora.selected = true;
			}else{
				select_datas.options[select_datas.length-1].selected = true;
			}

			getPresencas();
		}
	</script>

	<script src="/js/popper.min.js"></script>
	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.js"></script>
</body>
</html>