<?php

$arquivo = "
<style type='text/css' media='screen'>
body{
	background: #d4d4d4;
}
.content{
	background: #fff;
	border-radius: 10px;
	padding:  190px;
	padding-bottom: 2em;
	padding-top: 2em;
	width: 16%;
	margin-left: 18em;
	text-align: center;
}
.jumbotron{
	padding: 1em;
	background: #d3d3d3;
}
span{
	color: red;
}
</style>
<html>
<body>
<div class='content'>
<header>
<a><img src='http://www.publyc.esy.es/img/logo.png' width='215px'></a>
</header>
<section>
<strong>Recuperação de senha</strong>
<div class='jumbotron'>
Codigo de Recuperação: <span><?php echo  date("isG"); ?></span>
</div>
<a href='http://www.publyc.esy.es' >Clique continuar</a>
</section>
</div>
</body>
</html>";

$emailenviar = "felipe.programer@gmail.com";
$destino = $emailenviar;
$assunto = "Contato pelo Site";

  // É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: $nome <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";

$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if($enviaremail){
	$mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
	echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
} else {
	$mgm = "ERRO AO ENVIAR E-MAIL!";
	echo "";
}