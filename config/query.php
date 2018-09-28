<?php
//cadastro aluno

if (isset($_POST['cadastra_aluno'])){

	$date = date("d-m-Y");

	if ($_POST['senha_aluno'] == $_POST['csenha_aluno']) {

		$cry = sha1(md5($_POST['senha_aluno']));

		if ($_POST['email_aluno'] == $_POST['cemail_aluno']) {

			$a = $mysqli->query("INSERT INTO tb_contato(telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')") or die($mysqli->error);
			$b = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['tel1']."'") or die($mysqli->error);
			$c = $b->fetch_assoc()['idtb_contato'];

			$d = $mysqli->query("INSERT INTO tb_aluno(nome, email, senha, cpf, rg, orgao, profissao, tipo_sangue, data, data_cadastro, tb_curso_idtb_curso, tb_sexo_idtb_sexo, tb_escolaridade_idtb_escolaridade, tb_contato_idtb_contato, tb_pagamento_idtb_pagamento) VALUES(
				'".$_POST['nome']."',
				'".$_POST['email_aluno']."',
				'$cry',
				'".$_POST['cpf']."',
				'".$_POST['rg']."',
				'".$_POST['orgao']."',
				'".$_POST['profissao']."',
				'".$_POST['tipo_sangue']."',
				'".$_POST['data']."',
				'$date',
				'".$_POST['idtb_curso']."',
				'".$_POST['sexo']."',
				'".$_POST['escolaridade']."',
				'$c','1')") or die($mysqli->error);

			$e = $mysqli->query("SELECT *FROM tb_aluno WHERE cpf = '".$_POST['cpf']."'") or die($mysqi->error);
			$idtb_aluno = $e->fetch_assoc()['idtb_aluno'];
			$_POST['idprofessor']."<br>";
			$_POST['turma']."<br>";

			$f = $mysqli->query("INSERT INTO tb_turma_aluno(tb_aluno_idtb_aluno, tb_turma_idtb_turma, tb_professor_idtb_professor) VALUES('$idtb_aluno'
				,'".$_POST['turma']."',
				'".$_POST['idprofessor']."')") or die($mysqli->error);

			$g = $mysqli->query("INSERT INTO tb_endereco(cep, endereco, numero, bairro, cidade, estado, tb_aluno_idtb_aluno) VALUES('".$_POST['cep']."','".$_POST['endereco']."','".$_POST['numero']."','".$_POST['bairro']."','".$_POST['cidade']."','".$_POST['estado']."','$idtb_aluno')") or die($mysqli->error);

			if ($f) {
				header("Location: sucesso.php?url_user=".base64_encode($idtb_aluno)."");
			}
		}else{
			echo "<div class='alert alert-warning' role='alert'>
			E-mails diferentes. Por favor, redefinir senha! :)
			</div>";
		}
	}

		// $sql = $mysqli->query("INSERT INTO tb_aluno (nome, email, senha cpf, rg, orgao, profissao, tipo_sangue, data, tb_sexo_idtb_sexo, tb_escolaridade_idtb_escolaridade) VALUES('".$_POST['nome']."','$email','$cry','".$_POST['cpf']."','".$_POST['rg']."','".$_POST['orgao']."','".$_POST['pro']."','".$_POST['tipo']."','".$_POST['date']."','".$_POST['sexo']."','".$_POST['escolaridade']."','$date')") or die($mysqli->error);

		// if ($sql == true) {
		// 	$a = $mysqli->query("SELECT idtb_aluno FROM tb_aluno WHERE cpf = '$cpf'") or die($mysqli->error);
		// 	$idtb_aluno = $a->fetch_assoc()['idtb_aluno'];							

		// 	$b = $mysqli->query("INSERT INTO tb_endereco(cep, endereco, cidade, estado, tb_aluno_idtb_aluno) VALUES('".$_POST['cep']."','".$_POST['endereco']."','".$_POST['cidade']."','$idtb_aluno')") or die($mysqli->error);

		// 	$c = $mysqli->query("INSERT INTO tb_user(email, senha, tb_aluno_idtb_aluno) VALUES('$email','$cry','$idtb_aluno')") or die($mysqli->error);
		// 	$con = $mysqli->query("SELECT *FROM tb_user WHERE email = '$email' LIMIT 1");
		// 	$idtb_user = $con->fetch_assoc()['idtb_user'];



		// 	$e = $mysqli->query("INSERT INTO tb_conf_cadastro(confirmacao, tb_aluno_idtb_aluno) VALUES ('N','$idtb_user')");

		// 	header("location: ../login.php?url_user=".base64_decode($email)."");
		// }
	else{ 
		echo "<div class='alert alert-warning' role='alert'>
		Senhas não são iguais. Por favor, redefinir senha! :)
		</div>";
	}
}
//Cadastro de Curso
if (isset($_POST['cadastra_curso'])) {
	$foto = $_FILES["image"];

	if (!empty($foto["name"])) {

		$dimensoes = getimagesize($foto["tmp_name"]);

		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

		$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

		$caminho_imagem = "../upload/" . $nome_imagem;

		move_uploaded_file($foto["tmp_name"], $caminho_imagem);

		$s = $mysqli->query("INSERT INTO tb_curso(curso, sobre, alvo, carga, mercado, valor, img) VALUES('".$_POST['curso']."','".$_POST['sobre']."','".$_POST['alvo']."','".$_POST['carga']."','".$_POST['mercado']."','".$_POST['valor']."','$nome_imagem')") or die($mysqli->error);

		if ($s) {
			echo "<div class='alert alert-primary' role='alert'>Cadastro realizado com sucesso!</div>";
		}else{
			echo "<div class='alert alert-warning' role='alert'>Error tente Novamente!</div>";
		}
	}
}
//Cadastro de MOdulo
if (isset($_POST['modulo'])) {
	$b = $mysqli->query("INSERT INTO tb_modulo(nome, descricao, tb_curso_idtb_curso) VALUES('".$_POST['nome']."','".$_POST['descricao']."','".$_POST['id']."')") or die($mysqli->error);

	if ($b) {
		echo "<div class='alert alert-primary'> Módulo Cadastrado com Sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
	}
}
//Excluir Curso
if (isset($_POST['delete_curso'])) {
	if (isset($_POST['senha'])) {
		$q = $mysqli->query("SELECT senha FROM tb_adm WHERE senha = '".sha1(md5($_POST['senha']))."'") or die($mysqli->error);
		if ($q->num_rows == 1) {

			$sql = $mysqli->query("DELETE FROM tb_modulo WHERE tb_curso_idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
			$sql = $mysqli->query("DELETE FROM tb_regiao_curso WHERE tb_curso_idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
			$sql = $mysqli->query("DELETE FROM tb_curso WHERE idtb_curso = '".$_POST['idtb_curso']."'") or die($mysqli->error);
			if ($sql) {
				echo "<div class='alert alert-primary'>Serviço excluido com sucesso!</div>";
			}else{
				echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
			}
		}else{
			echo "<div class='alert alert-warning'>Senha do administrador incorreta!</div>";
		}
	}
}
//Atualizar Curso

if (isset($_POST['up'])) {
	$sql = $mysqli->query("UPDATE tb_curso SET curso = '".$_POST['curso']."', carga = '".$_POST['carga']."', valor = '".$_POST['valor']."', alvo = '".$_POST['alvo']."', mercado = '".$_POST['mercado']."' WHERE idtb_curso = '".$_POST['id']."'") or die($mysqli->error);

	if ($sql) {
		echo "<div class='alert alert-primary' role='alert'>Curso Atualizado com Sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning' role='alert'>Error tente Novamente!</div>";
	}
}


//cadastro Novo Adm


if (isset($_POST['cadastrar'])) {

	$a = $mysqli->query("INSERT INTO tb_adm(email, senha) VALUES('".$_POST['email']."','".sha1(md5($_POST['senha']))."')")or die($mysqli->error);

	if ($a) {

		$post = $_POST['email'];
		$senh = sha1(md5($_POST['senha']));

		$b = $mysqli->query("SELECT * FROM tb_adm WHERE email = '$post' AND senha ='$senh'") or die($mysqli->error);
		$c = $b->num_rows;

		if ($c == 1) {

			session_start();

			$a = $b->fetch_assoc();
			$_SESSION['idtb_adm'] = $a['idtb_adm'];
			$_SESSION['email'] = $a['email'];
			$_SESSION['senha'] = $a['senha'];

			header("Location: /adm/");
		}else{
			echo "error";
		}
	}
	else{
		echo "Error, Tente Novamente mais tarde";
	}
} 


//LOGIN


if (isset($_POST['adm'])) {


	$post = $_POST['login'];
	$senh = sha1(md5($_POST['senha']));

	$sql = $mysqli->query("SELECT *FROM tb_adm WHERE email = '$post' AND senha ='$senh'") or die($mysqli->error);
	$s = $sql->num_rows;

	if ($s >= 1) {

		session_start();

		$a = $sql->fetch_assoc();
		$_SESSION['idtb_adm'] = $a['idtb_adm'];
		$_SESSION['email'] = $a['email'];
		$_SESSION['senha'] = $a['senha'];

		$sq = $mysqli->query("SELECT *FROM tb_dado_adm WHERE tb_adm_idtb_adm = '".$_SESSION['idtb_adm']."'");

		$b = $sq->fetch_assoc();
		$_SESSION['nome'] = $b['nome'];
		

		header("Location: adm/");

	}
	else{
		echo "Erro, Tente Novamente";
	}
}


if (isset($_POST['professor'])) {


	$post = $_POST['login'];
	$senh = sha1(md5($_POST['senha']));

	$sql = $mysqli->query("SELECT *FROM tb_professor WHERE email = '$post' AND senha ='$senh'") or die($mysqli->error);
	$s = $sql->num_rows;

	if ($s >= 1) {

		session_start();

		$a = $sql->fetch_assoc();
		$_SESSION['idtb_professor'] = $a['idtb_professor'];
		$_SESSION['nome'] = $a['nome'];
		$_SESSION['rg'] = $a['rg'];
		$_SESSION['cpf'] = $a['cpf'];
		$_SESSION['email'] = $a['email'];                                                                                                                                                                             

		header("Location: adm/prof/");

	}
	else{
		echo "Erro, Tente Novamente";
	}
}


if (isset($_POST['aluno'])) {


	$post = $_POST['login'];
	$senh = sha1(md5($_POST['senha']));

	$sql = $mysqli->query("SELECT *FROM tb_aluno WHERE email = '$post' AND senha ='$senh'") or die($mysqli->error);
	$s = $sql->num_rows;

	if ($s >= 1) {

		session_start();

		$a = $sql->fetch_assoc();
		$_SESSION['idtb_aluno'] = $a['idtb_aluno'];
		$_SESSION['nome'] = $a['nome'];
		$_SESSION['cpf'] = $a['cpf'];
		$_SESSION['rg'] = $a['rg'];
		$_SESSION['orgao'] = $a['orgao'];
		$_SESSION['profissao'] = $a['profissao'];
		$_SESSION['tipo'] = $a['tipo_sangue'];
		$_SESSION['data'] = $a['data'];
		$_SESSION['email'] = $a['email'];
		$_SESSION['senha'] = $a['senha'];

		header("Location: adm/profile/");

	}
	else{
		echo "Erro, Tente Novamente";
	}
}

//cadastro de Professor
if (isset($_POST['cadastra_prof'])) {
	if ($_POST['senha_prof'] == $_POST['csenha_prof']) {

		$cry = sha1(md5($_POST['senha_prof']));

		$sql = $mysqli->query("INSERT INTO tb_professor(nome, rg, cpf, email, senha) VALUES('".$_POST['nome']."','".$_POST['rg']."','".$_POST['cpf']."','".$_POST['email']."','$cry')") or die($mysqli->error);
		if ($sql) {
			echo "<div class='alert alert-primary'> Professor Cadastrado com Sucesso! Por favor peça para o Sr.(a)".$_POST['nome'].",Acessar seu para continuar o cadastro.</div>";
		}else{
			echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
		}
	}
	
}
//Up Professor
if (isset($_POST['upProf'])) {
	$s = $mysqli->query("INSERT INTO tb_contato (telefone1, telefone2) VALUES('".$_POST['te1']."','".$_POST['te2']."')") or die($mysqli->error);
	$l = $mysqli->query("SELECT idtb_contato FROM tb_contato WHERE telefone1 ='".$_POST['te1']."'") or die($mysqli->error);
	$q = $l->fetch_assoc()['idtb_contato'];


	$sql = $mysqli->query("INSERT INTO tb_dado_prof(formacao, instituicao, ano, sobre, tb_professor_idtb_professor, tb_contato_idtb_contato) VALUES('".$_POST['formacao']."','".$_POST['instituicao']."','".$_POST['ano']."','".$_POST['sobre']."','".$_POST['id']."','$q')")or die($mysqli->error);

	if ($sql) {
		echo "<div class='alert alert-primary'> Atualizado com sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
	}
}
//Delete Professor
if (isset($_POST['delete_prof'])) {
	if (isset($_POST['senha'])) {
		$q = $mysqli->query("SELECT senha FROM tb_adm WHERE senha = '".sha1(md5($_POST['senha']))."'") or die($mysqli->error);
		if ($q->num_rows == 1) {

			$sql = $mysqli->query("DELETE FROM tb_professor WHERE idtb_professor = '".$_POST['idtb_prof']."'");
			if ($sql) {
				echo "<div class='alert alert-primary'>Serviço excluido com sucesso!</div>";
			}else{
				echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
			}
		}else{
			echo "<div class='alert alert-warning'>Senha do administrador incorreta!</div>";
		}
	}
}
//Turma
if (isset($_POST['cadastra_turma'])) {
	$date = date("d-m-Y");
	$sql = $mysqli->query("INSERT INTO tb_turma(nome, cep, endereco, bairro, numero, cidade, complemento, data, vagas, tb_curso_idtb_curso, tb_professor_idtb_professor) VALUES (
		'".$_POST['nome']."',
		'".$_POST['cep']."',
		'".$_POST['endereco']."',
		'".$_POST['bairro']."',
		'".$_POST['numero']."',
		'".$_POST['cidade']."',
		'".$_POST['complemento']."',
		'$date',
		'".$_POST['vagas']."',
		'".$_POST['curso']."',
		'".$_POST['idprofessor']."'
	)") or die($mysqli->error);	

	if ($sql) {
		echo "<div class='alert alert-primary'>Cadastrao realizado com sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
	}
}

//Relatorios de Turma




//Solicitação de Curso
if (isset($_POST['solicitacao_profissional'])) {
	$c = $mysqli->query("INSERT INTO tb_contato(telefone1) VALUES('".$_POST['telefone']."')") or die($mysqli->error);
	$q = $mysqli->query("SELECT *FROM tb_contato WHERE telefone1 = '".$_POST['telefone']."'") or die($mysqli->error);
	echo $id = $q->fetch_array()['idtb_contato']."<br>";

	$sql = $mysqli->query("INSERT INTO tb_contato_empresa(nome, responsavel, cnpj, vaga, mensagem, tb_contato_idtb_contato, tb_curso_idtb_curso) VALUES ('".$_POST['empresa']."','".$_POST['responsavel']."','".$_POST['cnpj']."','".$_POST['vaga']."','".$_POST['mensagem']."','$id','".$_POST['idtb_curso']."')")  or die($mysqli->error);

	if ($sql) {
		echo "<div class='alert alert-primary'>Cadastrao realizado com sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
	}
}

//Cadatro de Serviço
if (isset($_POST['cadastro_servico'])) {
	$foto = $_FILES["image"];
	if (!empty($foto["name"])) {

		$dimensoes = getimagesize($foto["tmp_name"]);

		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

		$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

		$caminho_imagem = "../upload/" . $nome_imagem;

		move_uploaded_file($foto["tmp_name"], $caminho_imagem);

		$sql = $mysqli->query("INSERT INTO tb_servico(nome, descricao, img) VALUES('".$_POST['nome']."','".$_POST['descricao']."','$nome_imagem')") or die($mysqli->error);

		if ($sql) {

			echo "<div class='alert alert-primary'>Serviço cadastrado realizado com sucesso!</div>";
		}else{
			echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
		}
	}
}
//Delete Servico
if (isset($_POST['delete_servico'])) {
	if (isset($_POST['senha'])) {
		$q = $mysqli->query("SELECT senha FROM tb_adm WHERE senha = '".sha1(md5($_POST['senha']))."'") or die($mysqli->error);
		if ($q->num_rows == 1) {
			$a = $mysqli->query("SELECT img FROM tb_servico WHERE idtb_servico = '".$_POST['id']."'");
			$b = $a->fetch_assoc()['img'];
			unlink("../upload/".$b."");
			$sql = $mysqli->query("DELETE FROM tb_servico WHERE idtb_servico = '".$_POST['id']."'");
			if ($sql) {
				echo "<div class='alert alert-primary'>Serviço excluido com sucesso!</div>";
			}else{
				echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
			}
		}else{
			echo "<div class='alert alert-warning'>Senha do administrador incorreta!</div>";
		}
	}

}

//Update Serciço
if (isset($_POST['up_servico'])) {

	$foto = $_FILES["image"];

	if (!empty($foto["name"])) {

		$dimensoes = getimagesize($foto["tmp_name"]);

		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

		$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

		$caminho_imagem = "../upload/" . $nome_imagem;

		move_uploaded_file($foto["tmp_name"], $caminho_imagem);

		$sql = $mysqli->query("UPDATE tb_servico SET nome = '".$_POST['nome']."', descricao = '".$_POST['descricao']."', img = '$nome_imagem' WHERE idtb_servico = '".$_POST['idtb_servico']."'") or die($mysqli->error);

		if ($sql) {
			echo "<div class='alert alert-primary'>Serviço atulizado com sucesso!</div>";
		}else{
			echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
		}

	}else{
		$sql = $mysqli->query("UPDATE tb_servico SET nome = '".$_POST['nome']."', descricao = '".$_POST['descricao']."' WHERE idtb_servico = '".$_POST['idtb_servico']."'") or die($mysqli->error);
	}
	if ($sql) {
		echo "<div class='alert alert-primary'>Serviço atualizado com sucesso!</div>";
	}else{
		echo "<div class='alert alert-warning'>Error tente Novamente!</div>";
	}
}