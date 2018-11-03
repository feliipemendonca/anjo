<?php

$emailenviar = "felipe.programer@gmail.com";
$destino = "feliipemendonca@outlook.com";
$assunto = "Contato pelo Site";
$arquivo = "Teste de Envio de E-mail"


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Anjos da Noite <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";


$enviaremail = mail($destino, $assunto, $arquivo, $headers);
if($enviaremail){
	$mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
	echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
} else {
	$mgm = "ERRO AO ENVIAR E-MAIL!";
	echo "";
}

?>