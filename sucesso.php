<?php  echo base64_decode($_GET['url_user']); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Parabéns</title>
	<link rel="stylesheet" href="css/bootstrap.css">


	<script>

		function enviaPagseguro(){
			$.post('config/pagseguro.php','',function(data){
				// $('#code').val(data);
				// $('#comprar').submit();
				alert($data);
			})
		}

	</script>

</head>
<body>
	<main role="main" class="col-sm-12 ml-sm-auto col-md-12 pt-3">
		<h4 class="text-center">Sucesso, seja bem Vindo</h4>
		<p class="text-center">Efetue Pagamento clicando em continuar</p>

		<button onclick="enviaPagseguro()">Continuar</p></a>

		</main>

		<script type="text/javascript"
		src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
	</script>

	<script src="js/popper.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>


</body>
</html>
