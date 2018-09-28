<?php

include "../config/seguranca.php";
include "../config/modal.php";

$idtb_adm = $_SESSION['idtb_adm'];

$sql = $mysqli->query("SELECT *FROM tb_contato_empresa ORDER BY idtb_contato_empresa ASC");
$s = $sql->num_rows;


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

	
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/dashboard.css">


</head>

<body>
	<div class="container">

		<main role="main" class="col-sm-12 ml-sm-auto col-md-12 pt-3">
			<h1 class="text-center">Dashboard</h1>
			<section class="row placeholders">
				<div class="col-6 col-sm-4 col-md-3 placeholder text-center">
					<img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
					<h4>Solicitações</h4>
					<span class="text-muted"><a href="message.php" title="Atualizar Pagina">Clique aqui para Atualizar a página</a></span><br>
					<span class="text-muted"><a href="index.php" title="Cadastrar novo curso">Voltar</a></span><br>
				</div>
				<div class="col-sm-8 col-md-9 row">
					<!-- <div class="col-6">
						<form action="" method="post" accept-charset="utf-8">
							<label for="Dia">Dia</label>
							<select name="dia" class="form-control">
								<option>Dia</option>
								<?php $a = $mysqli->query("SELECT *FROM tb_dia ORDER BY dia ASC");
								while ($b = $a->fetch_assoc()) { ?>
								<option value="<?php echo $b['idtb_dia']; ?>"><?php echo $b['dia']; ?></option>
								<?php } ?>
							</select>
							<label for="Hora">Horário</label>
							<input type="text" class="form-control" placeholder="EX: 09:00 - 11:00" name="hora">
							<button type="submit" class="btn btn-primary">Cadastrar</button>
						</form>

					</div> -->
					<div class="col-12">
						<table class="table-responsive">
							<thead>
								<tr>
									<th>Dia | Hora | Empresa</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								if ($sql->num_rows > 1) {

									while ($ln = $sql->fetch_assoc()) {

										$a = $mysqli->query("SELECT *FROM tb_dia WHERE idtb_dia = '".$ln['tb_dia_idtb_dia']."'");
										$b = $mysqli->query("SELECT *FROM tb_hora WHERE idtb_hora = '".$ln['tb_hora_idtb_hora']."'"); ?>
										<tr>
											<td><?php echo $a->fetch_assoc()['data']." | ".$b->fetch_assoc()['hora']." | ".$ln['nome']; ?></td>
											
										</tr>
										<?php
									}
								} else{
									echo "<th>Ainda não há solicitação cadastrada!</th>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>

			</section>
		</main>
	</div>

	<footer>
		<hr>
		<p class="text-center text-muted">Desenvolvido Faciliit. Todos os diretos resevados Anjos da Noite</p>
	</footer>


	<script src="../js/popper.min.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>


</body>
</html>