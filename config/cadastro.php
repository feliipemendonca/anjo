<?php include "config.php";

// if (isset($_POST['curso'])) {









else{
	echo "Erro! Tente Novamente";
}
}
else{
	echo "Senha não Batem, Redefina Sua Senha";

	header("location: ../cadastro.php?reboot=yes".."nome=".base64_encode($nome)."tipo=".base64_encode($tipo)."cpf=".base64_encode($cpf)."rg=".base64_encode($rg)."orgao=".base64_encode($orgao)."pro=".base64_encode($pro)."tel1=".base64_encode($tel1)."tel2=".base64_encode($tel2)."cep=".base64_encode($cep)."endereco=".base64_encode($endereco)."numero=".base64_encode($numero)."bairro=".base64_encode($bairro)."cidade=".base64_encode($cidade)."estado=".base64_encode($estado)."email=".base64_encode($email)."");
}


?>