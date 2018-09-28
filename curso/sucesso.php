<?php include "../config/config.php"; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<?php include "../config/tema-top.php"; ?>
	<title>Compra</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<script type="text/javascript" src="../js/jquery.js"></script>
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
				<a class="p-2 text-muted active" href="index.php">cursos</a>
				<a class="p-2 text-muted" href="../servico.php">serviços</a>
				<a class="p-2 text-muted" href="../galeria.php">galeria</a>
				<a class="p-2 text-muted" href="../contato.php">contato</a>
				<a class="p-2 text-muted" href="../login.php"><i class="fas fa-lock"></i>Login</a>

			</ul>
		</div>
		<hr>
	</main>
	<section class="curso-content-top">
		<div class=" text-center">
			<div class="jumbotron" style="padding: 5em;">
				<div class="container">
					<h1 class="jumbotron-heading text-center">Infomações da Compra</h1>
					<?php
					$sql = "SELECT curso, valor FROM tb_curso
					WHERE idtb_curso='".$_GET["cur"]."'";
					$query = mysqli_query($mysqli, $sql);

					if(!$query){ ?>
						<small class="text-center">Nenhum curso encontrado!<small class="text-center">
						</div></body></html>
						<?php
						exit();
					}
					$res = mysqli_fetch_assoc($query);
					?>
					<h1>Curso: <?php echo $res["curso"]; ?></h1>
					<p>Valor: R$ <?php echo $res["valor"];?></p>
					<button class="btn btn-warning" onclick="enviaPagseguro();">Clique aqui para continuar</button>
				</div>
			</div>
		</div>
	</section>


	<form id="comprar" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" method="post" onsubmit="PagSeguroLightbox(this); return false;">
		<input type="hidden" name="code" id="code" value="" />
	</form>

	<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

	<script>
		function enviaPagseguro(codigo){

			$.post('pagseguro.php?id=<?php echo $_GET["cur"] . "&al=" . $_GET["id"]; ?>','',function(data){

				$('#code').val(data);
				$('#comprar').submit();

			})
		}
	</script>


	<footer style="margin-top: -32px;">
		<div class="container">
			<p class="text-right">©2018 Anjos da Noite. Todos os Direitos Resevados | Designer Faciliit</p>
		</div>
	</footer>




</body>
</html>