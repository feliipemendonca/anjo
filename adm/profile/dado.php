<?php
include "../../config/seguranca.php";
include "checkSession.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Title</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="../../css/sb-admin.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script class="tempScript" src="../../js/valCampos.js"></script>
</head>

<body>
    <div id="wrapper">
        <?php $active=5; include "menu.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Meus Dados
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Início
                            </li>
                            <li class="">
                                <a href="nota.php"><i class="fa fa-fw fa-cogs"></i>Meus Dados</a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-12 col-md-12">

                        <?php 

                        if (isset($_POST['up'])) {

                            $cont = $mysqli->query("UPDATE tb_contato SET telefone1 = '".$_POST['tel1']."', telefone2 = '".$_POST['tel2']."' WHERE idtb_contato = '".$_POST['idtb_contato']."'") or die($mysqli->error) or die($mysqli->error);
                            if ($cont) {

                                $end = $mysqli->query("UPDATE tb_endereco SET cep = '".$_POST['cep']."', endereco = '".$_POST['endereco']."', numero = '".$_POST['numero']."', bairro = '".$_POST['bairro']."', cidade = '".$_POST['cidade']."', estado = '".$_POST['estado']."' WHERE tb_aluno_idtb_aluno = '".$_POST['idtb_aluno']."'") or die($mysqli->error);

                                if ($end) {

                                    $alu = $mysqli->query("UPDATE tb_aluno SET profissao = '".$_POST['profissao']."' WHERE idtb_aluno = '".$_POST['idtb_aluno']."'") or die($mysqli->error);

                                    if ($alu) {

                                        echo "<div class='alert alert-success alert-dismissible' role='alert'>
                                        <strong>Sucesso!</strong> Dados atualizados.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";

                                    }else{

                                        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                        <strong>Error!</strong> ao atualizar Profissão. Entre em contato com o <a href='msg.php' title='Informa erro ao
                                        administrador?'>Administrador</a>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }

                                }else{

                                    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                    <strong>Error!</strong> ao atualizar Endereço. Entre em contato com o <a href='msg.php' title='Informa erro ao administrador?'>Administrador</a>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }

                            }else{

                                echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                <strong>Error!</strong> ao atualizar contato. Entre em contato com o <a href='msg.php' title='Informa erro ao administrador?'>Administrador</a>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";

                            }

                        }
                        
                        $sql = "SELECT a.idtb_aluno, cont.idtb_contato, c.curso, t.nome as turma, p.nome as professor, a.nome as aluno, a.cpf, a.rg, a.orgao, a.tipo_sangue, a.data, a.profissao, cont.telefone1, cont.telefone2, login.email, end.cep, end.endereco, end.bairro, end.numero, end.cidade, end.estado
                        FROM tb_aluno a
                        JOIN tb_login login ON login.idtb_login = a.tb_login_idtb_login
                        JOIN tb_contato cont ON cont.idtb_contato = a.tb_contato_idtb_contato
                        JOIN tb_turma_aluno ta ON ta.tb_aluno_idtb_aluno = a.idtb_aluno
                        JOIN tb_curso c ON c.idtb_curso = ta.tb_curso_idtb_curso
                        JOIN tb_turma t ON t.idtb_turma = ta.tb_turma_idtb_turma
                        JOIN tb_professor p ON p.idtb_professor = t.tb_professor_idtb_professor
                        JOIN tb_endereco end ON end.tb_aluno_idtb_aluno = a.idtb_aluno
                        WHERE login.idtb_login = " . $_SESSION["idtb_login"];

                        $query = mysqli_query($mysqli, $sql);

                        if(!$query){ ?>
                            <script>
                                alert("Desculpe-nos, mas ocorreu um erro ao obter seus dados!\nTente novamente mais tarde, ou contate o administrador!");
                                location.href = "./";
                            </script>
                            <?php exit();
                        }

                        $ln = mysqli_fetch_assoc($query);

                        $idtb_aluno = $ln["idtb_aluno"];
                        $idtb_contato = $ln["idtb_contato"];

                        $nCurso = $ln["curso"];
                        $nTurma = $ln["turma"];
                        $nProf = $ln["professor"];
                        $nAluno = $ln["aluno"];

                        $cpf = $ln["cpf"];
                        $rg = $ln["rg"];
                        $orgao = $ln["orgao"];
                        $tipo_sangue = $ln["tipo_sangue"];
                        $dt_nascimento = $ln["data"];

                        $profissao = $ln["profissao"];
                        $celular = $ln["telefone1"];
                        $telefone = $ln["telefone2"];
                        $email = $ln["email"];

                        $end_cep = $ln["cep"];
                        $end_endereco = $ln["endereco"];
                        $end_bairro = $ln["bairro"];
                        $end_numero = $ln["numero"];
                        $end_cidade = $ln["cidade"];
                        $end_estado = $ln["estado"];

                        ?>

                    </div>
                    <div class="col-sm-12 col-md-12">
                        <h4><strong class="text-danger">Atenção!</strong> Cetifique-se que Seus dados estão corretos, e mantenha-os sempre atualizados.</h4>
                        <form action="" method="post" accept="utf-8">
                            <input type="hidden" name="idtb_aluno" value="<?php echo $idtb_aluno; ?>">
                            <input type="hidden" name="idtb_contato" value="<?php echo $idtb_contato; ?>">
                            <div class="col-sm-12 col-md-4">
                                <label>Curso</label>
                                <input type="text" class="form-control disabled" value="<?php echo $nCurso;?>" disabled>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Turma</label>
                                <input type="text" class="form-control" value="<?php echo $nTurma; ?>" disabled>						 	
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Professor</label>
                                <input type="text" class="form-control" value="<?php echo $nProf; ?>" disabled>						 	
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>Nome</label>
                                <input type="text" class="form-control" value="<?php echo $nAluno ?>" disabled>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label>CPF</label>
                                <input type="text" class="form-control" value="<?php echo $cpf; ?>" disabled>	
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label>RG</label>
                                <input type="text" class="form-control" value="<?php echo $rg; ?>" disabled>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label>Orgão Expeditor</label>
                                <input type="text" class="form-control" value="<?php echo $orgao; ?>" disabled>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label>Tipo Sanguíneo</label>
                                <input type="text" class="form-control" value="<?php echo $tipo_sangue; ?>" disabled>				
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label>Data de Nascimento</label>
                                <input type="text" class="form-control" value="<?php echo $dt_nascimento; ?>" disabled>			
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <label>Profissão</label>
                                <input type="text" class="form-control" value="<?php echo $profissao; ?>" name="profissao" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Celular</label>
                                <input type="text" class="form-control use-soNumeros use-addMask" value="<?php echo $celular; ?>" name="tel1" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Fixo</label>
                                <input type="text" class="form-control use-soNumeros use-addMask" value="<?php echo $telefone; ?>" name="tel2">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label> E-mail</label>
                                <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" required>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <br>
                                <p><strong>Informações de Endereço</strong></p>
                                <hr>							
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Cep</label>
                                <input type="text" class="form-control use-soNumeros cep" value="<?php echo $end_cep; ?>" name="cep" required>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <label>Endereço</label>
                                <input type="text" class="form-control use-soLetras" value="<?php echo $end_endereco; ?>" name="endereco" required>			
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label>Bairro</label>
                                <input type="text" class="form-control use-soLetras" value="<?php echo $end_bairro; ?>" name="bairro" required>			
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label>Número</label>
                                <input type="text" class="form-control use-soNumeros" value="<?php echo $end_numero; ?>" name="numero" required>			
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label>Cidade</label>
                                <input type="text" class="form-control use-soLetras" value="<?php echo $end_cidade; ?>" name="cidade" required>			
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label>Estado</label>
                                <input type="text" class="form-control use-soLetras" value="<?php echo $end_estado; ?>" name="estado" required>			
                            </div>
                            <div class="col-sm-12 col-sm-10"></div>
                            <div class="col-sm-12 col-md-2" style="padding-top: 2em; padding-bottom: 2em;">
                                <button type="submit" class="btn btn-primary form-control" name="up" value="up">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/popper.min.js"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script class="tempScript" src="../../js/valCampos_execute.js"></script>
    <script class="tempScript" src="../js/apagar_scripts.js"></script>
    <script>
        $('.cep').mask('00000-000');
    </script>
</body>
</html>