<?php

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];
$pro = $mysqli->query("SELECT *FROM tb_dado_adm WHERE tb_login_idtb_login = '$idtb_adm'");

if (isset($_POST['save'])) {
    $senha = sha1(md5($_POST['senha']));
    $con = $mysqli->query("INSERT INTO tb_contato (telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')") or die($mysqli->error);
    $c = $mysqli->query("SELECT *FROm tb_contato WHERE telefone1 = '".$_POST['tel1']."'") or die($mysqli->error);
    $id = $c->fetch_assoc()['idtb_contato'];
    $l = $mysqli->query("INSERT INTO tb_login(email, senha) VALUES('".$_POST['email']."','".$senha."')");

    $sql = $mysqli->query("INSERT INTO tb_dado_adm(nome, cpf, rg, tb_login_idtb_login, tb_contato_idtb_contato)
      VALUES('".$_POST['nome']."','".$_POST['cpf']."','".$_POST['rg']."','$idtb_adm','$id')") or die($mysqli->error);

    if ($sql) {
        echo "<script>alert('Novo Administador Cadastrado');location.href=''</script>";
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> Verefique seus dados e tente novamente.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "../config/tema-top.php"; ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="screen">
    .form-control{
        border-radius: 0px;
    }
</style>


</head>

<body>



 <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">SB Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Solicitações de Serviços</a>
                </li>
                <li>
                    <a href="contato.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
                </li>
                <li>
                    <a href="professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
                </li>

                <li>
                    <a href="curso.php"><i class="fa fa-fw fa-edit"></i>Cursos</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#dem"><i class="fa fa-fw fa-check-square-o"></i>Turmas<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="dem" class="collapse">
                        <li>
                            <a href="turma.php">Ativas</a>
                        </li>
                        <li>
                            <a href="turma_desativada.php">Desativadas</a>
                        </li>
                    </ul>
                </li>
                <li
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Alunos<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="aluno.php">Matriculados</a>
                        </li>
                        <li>
                            <a href="pre.php">Pré-Matriculados</a>
                        </li>
                        <li>
                            <a href="cadastro.php">Todos os Cadastros</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="servico.php"><i class="fa fa-fw fa-briefcase"></i> Serviços</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Inicio<a href="" data-toggle="modal" data-target="#mymodal" title="Adcionar Noo Administador?"><i class="fa fa-fw fa-plus-circle"></i></a>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Início
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <h4>Solicitações de Serviço</h4>
                <?php if (isset($_POST['del'])) {
                    $senha = sha1(md5($_POST['senha']));
                    $sql = $mysqli->query("SELECT senha FROM tb_login WHERE senha = '$senha' ");
                    if ($sql->num_rows) {
                        $sql = $mysqli->query("UPDATE tb_solicitacao SET arquivo = '1' WHERE idtb_solicitacao ='".$_POST['id']."'");
                        if ($sql) {
                            echo "<div class='alert alert-success alert-dismissible' role='alert'>
                            <strong>Sucesso</strong> Solicitação Arquivada.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                            </div>";
                        }
                    }else{
                        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                        <strong>Error!</strong> Senha Incorreta.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>";
                    }
                } ?>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>CNPJ</th>
                                <th>Empresa</th>
                                <th>Responsável</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $s = $mysqli->query("SELECT *FROM tb_solicitacao ORDER BY idtb_solicitacao DESC");
                            while ($a = $s->fetch_assoc()) {?>
                                <tr>
                                    <td><?php echo $a['cnpj']; ?></td>
                                    <td><?php echo $a['empresa']; ?></td>
                                    <td><?php echo $a['nome']; ?></td>
                                    <td><?php echo $a['email']; ?></td>
                                    <td><?php echo $a['contato']; ?></td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="<?php echo "#ver".$a['idtb_solicitacao']; ?>" title="Ver Serviço solicitado?"><i class="fa fa-fw fa-eye"></i></a>
                                        <a href="" data-toggle="modal" data-target="<?php echo "#del".$a['idtb_solicitacao']; ?>" title="Excluir"><i class="fa fa-fw fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" tabindex="-1" role="dialog" id="ver<?php echo $a['idtb_solicitacao']; ?>"  style="opacity: 1; padding-top: 11em;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?php echo $a['empresa']." | Serviço/curso Solicitado: ".$a['servico']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12">
                                                        <label>Mensagem do solicitante</label>
                                                        <textarea class="form-control" rows="5" placeholder="Não existe mensagem"><?php echo $a['mensagem']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="modal fade" tabindex="-1" role="dialog" id="del<?php echo $a['idtb_solicitacao']; ?>"  style="opacity: 1; padding-top: 11em;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Arquivar Solicitação?</strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12">
                                                            <label>Senha<em>*</em></label>
                                                            <input type="hidden" name="id" value="<?php echo $a['idtb_solicitacao']; ?>">
                                                            <input type="password" class="form-control" name="senha" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                    <button type="submit" class="btn btn-warning" name="del" value="del">Arquivar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 


                                <?php

                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal mymodal fade register" tabindex="-1" role="dialog" id="mymodal" style="opacity: 1; padding-top: 11em;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar Dado de Administrador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>       
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body content-form">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <label>Nome<em>*</em></label>
                                <input type="text" name="nome" class="form-control use-soLetras"  required>             
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>CPF<em>*</em></label>
                                <input type="tel" name="cpf" class="form-control use-soNumeros cpf"  required>             
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>RG<em>*</em></label>
                                <input type="text" name="rg" class="form-control use-soNumeros rg"  required>             
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>Contato<em>*</em></label>
                                <input type="tel" name="tel1" class="form-control use-soNumeros contato"  required>             
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>Fixo<em>*</em></label>
                                <input type="tel" name="tel2" class="form-control use-soNumeros fixo"  required>             
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="E-mail">E-mail<em>*</em></label>
                                <input type="email" class="form-control" name="email" required autofocus>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="Curso">Senha<em>*</em></label>
                                <input type="password" class="form-control" name="senha" required autofocus>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="save" value="save">Cadastrar</button>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script class="tmpScript" type="text/javascript" src="../js/valCampos_execute.js" ></script>
    <script src="../js/jquery.mask.js"></script>
    <script>
        $('.contato').mask('(00) 90000-0000');
        $('.fixo').mask('(00) 0000-0000');
        $('.rg').mask('000.000.000', {reverse: true});
        $('.cpf').mask('000.000.000-00', {reverse: true});

    </script>

</body>
</html>