<?php
    include "../../config/seguranca.php";
    include "checkSession.php";
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

</head>

<body>

	<div id="wrapper">
        <?php $active=3; include "menu.php"; ?>

		<div id="page-wrapper">

			<div class="container-fluid">

				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							Frequência
						</h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-dashboard"></i> Início
							</li>
							<li class="">
								<a href="frequencia.php"><i class="fa fa-fw fa-graduation-cap"></i>Frequência</a>
							</li>
						</ol>
					</div>
				</div>
                
                <div class="row">
                    <?php
                        include "../../presenca/porcentagemPresenca.php";
                    
                        $query = $mysqli->query("SELECT idtb_aluno FROM tb_aluno WHERE tb_login_idtb_login = '$idtb_login'");
                        $res = mysqli_fetch_assoc($query);
                        
                        $pres = new presencas($res['idtb_aluno'], $turma);
                    ?>
                    <table class="table table-bordered table-hover" style="text-align: center; font-size: 10pt">
                        <tr>
                            <td>Total de Faltas</td>
                            <td>Total de Presenças</td>
                            <td>Faltas (%)</td>
                            <td>Presenças (%)</td>
                        </tr>
                        <tr>
                            <td><?php echo $pres->total_faltas; ?></td>
                            <td><?php echo $pres->total_presencas; ?></td>
                            <td><?php echo $pres->porFaltas; ?></td>
                            <td><?php echo $pres->porPresencas; ?></td>
                        </tr>
                    </table>
                </div>
			</div>
		</div>
	</div>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/bootstrap.js"></script>

</body>
</html>