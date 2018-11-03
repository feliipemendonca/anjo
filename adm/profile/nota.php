<?php
    include "../../config/seguranca.php";
    include "checkSession.php";
    include "../../notas/notasTable.php";
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
	<style type="text/css" media="screen">
	.form-control{
		border-radius: 0px;
	}
</style>


</head>

<body>

	<div id="wrapper">
		<?php $active=2; include "menu.php" ?>

		<div id="page-wrapper">

			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Notas 
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Início
							</li>
							<li class="">
								<a href="nota.php"><i class="fa fa-fw fa-bar-chart-o"></i>Notas</a>
							</li>
						</ol>
					</div>					
				</div>

				<div class="col-sm-12 col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
                                    <?php for($a=0; $a < quantMaxNotas; $a+=1){ ?>
                                        <th>Nota <?php echo $a+1 ?></th>
                                        <th>Data</th>
                                    <?php } ?>
                                    
									<th>Média</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								$s = $mysqli->query("SELECT idtb_aluno FROM tb_aluno WHERE tb_login_idtb_login = '$idtb_login'") or die($mysqli->error);
								$res = $s->fetch_assoc();
								
								$notas = new notas($res["idtb_aluno"], $turma);
                                /*
                                    $q = $mysqli->query("SELECT *FROM tb_notas WHERE id_turma_aluno = '$id'") or die($mysqli->error);
                                    while ($l = $q->fetch_assoc()) {

                                        ?>
                                        <tr>
                                            <td><?php echo $l['nota1']; ?></td>
                                            <td><?php echo $l['envio_nota1']; ?></td>
                                            <td><?php echo $l['nota2']; ?></td>
                                            <td><?php echo $l['envio_nota2']; ?></td>
                                            <td><?php echo $l['nota3']; ?></td>
                                            <td><?php echo $l['envio_nota3']; ?></td>
                                        </tr>

                                        <?php
                                    }
                                */
                                    ?>
                                    <tr
                                    <?php if($notas->mediaAtual != "-"){
                                    	if($notas->mediaAtual < 4) echo "style=\"background-color:#FF7878\";";
                                    	else if($notas->mediaAtual < 7) echo "style=\"background-color:#FFFFC9\";";
                                    	else echo "style=\"background-color:#A7FFBD\";";
                                    } ?>
                                    >
                                        <?php for($a=0; $a < quantMaxNotas; $a+=1){ ?>
                                            <td><?php echo @$notas->notas[$a]; ?></td>
                                            <td><?php echo @$notas->dts_envio[$a]; ?></td>
                                        <?php } ?>
                                        
                                        <td><?php echo @$notas->mediaAtual; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>					
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>

</body>
</html>