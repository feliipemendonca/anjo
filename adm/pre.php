<?php

include "../config/seguranca.php";

$idtb_adm = $_SESSION['idtb_login'];
$pro = $mysqli->query("SELECT *FROM tb_dado_adm WHERE tb_login_idtb_login = '$idtb_adm'");

$v = 1;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADM | Pré-Matrículados</title>


    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">SB Admin</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $pro->fetch_assoc()['nome']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Solicitações de Serviços</a>
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Contato</a>
                    </li>
                    <li>
                        <a href="professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
                    </li>

                    <li>
                        <a href="curso.php"><i class="fa fa-fw fa-graduation-cap"></i>Cursos</a>
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
                    <li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Alunos<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="aluno.php">Matriculados</a>
                            </li>
                            <li>
                                <a href="pre.php">Pré-Matriculados</a>
                            </li>
                            <li class="active">
                                <a href="cadastro.php">Todos os Cadastros</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="servico.php"><i class="fa fa-fw fa-briefcase"></i> Serviços</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-9">
                                    <h1>
                                        Alunos Pré-matrículados
                                    </h1>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <form action="" method="post" class="form-inline my-2 my-lg-0" style="padding-top: 1.5em;">
                                        <input class="form-control mr-sm-2 form-control-lg cpf use-soNumeros " type="tel" placeholder="Digite CPF" aria-label="Search" name="nome" value="<?php echo @$_POST['nome']; ?>">
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="pesquisa" value="pesquisa"><i class="fa fa-fw fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Inicio</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-check-square-o"></i>Alunos Matrículados
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-12 col-md-12">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Data Nacimento</th>
                                        <th>Contato</th>
                                        <th>Data Cadastro</th>      
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['pesquisa'])) { 

                                        $as = $mysqli->query("SELECT *FROM tb_aluno WHERE cpf LIKE '%".$_POST['nome']."%'");
                                        $id = $as->fetch_assoc()['idtb_aluno'];

                                        $lk = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_pagamento_idtb_pagamento = '$v' AND tb_aluno_idtb_aluno = '$id'");
                                        while ($ln = $lk->fetch_assoc()) {;
                                            $sql = $mysqli->query("SELECT *FROm tb_aluno WHERE idtb_aluno = '".$ln['tb_aluno_idtb_aluno']."'");
                                            while ($a = $sql->fetch_assoc()) {
                                                $con = $mysqli->query("SELECT *FROM tb_contato WHERE idtb_contato = '".$a['tb_contato_idtb_contato']."'") or die($mysqli->error);
                                                while ($b = $con->fetch_assoc()) {

                                                    $p = $mysqli->query("SELECT *FROM tb_pagamento WHERE idtb_pagamento = '".$ln['tb_pagamento_idtb_pagamento']."'");
                                                    while ($c = $p->fetch_assoc()) {
                                                        $log = $mysqli->query("SELECT *FROM tb_login WHERE idtb_login = '".$a['tb_login_idtb_login']."'") or die($mysqli->error);
                                                        while ($d = $log->fetch_assoc()) {
                                                            $for = $mysqli->query("SELECT *FROM tb_escolaridade WHERE idtb_escolaridade = '".$a['tb_escolaridade_idtb_escolaridade']."'");
                                                            while ($e = $for->fetch_assoc()) {
                                                                $cur = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '".$a['tb_curso_idtb_curso']."'");
                                                                while ($f = $cur->fetch_assoc()) {
                                                                    $tur = $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '".$f['idtb_curso']."'") or die($mysqli->error);
                                                                    while ($g = $tur->fetch_assoc()) {
                                                                        $ender = $mysqli->query("SELECT *FROM tb_endereco WHERE tb_aluno_idtb_aluno = '".$a['idtb_aluno']."'");
                                                                        while($h = $ender->fetch_assoc()){
                                                                            ?>

                                                                            <tr>
                                                                                <td><?php echo $a['idtb_aluno']; ?></td>
                                                                                <td><?php echo $a['nome']; ?></td>
                                                                                <td><?php echo $a['cpf'] ?></td>                                          
                                                                                <td><?php echo $a['data']; ?></td>
                                                                                <td><?php echo $b['telefone1']; ?></td>
                                                                                <td><?php echo $a['data_cadastro'] ?></td>
                                                                                <td><?php echo $c['status']; ?></td>
                                                                                <td>
                                                                                    <a href='' data-toggle='modal' data-target="#ver<?php echo $a['idtb_aluno'];?>" title="Ver aluno?"><i class="fa fa-fw fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>

                                                                            <div class="modal fade" tabindex="-1" role="dialog" id="ver<?php echo $a['idtb_aluno'];?>"  style="opacity: 1; padding-top: 11em;">
                                                                                <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4>Fixa de Pré-matrícula</h4>

                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-8 col-md-12">
                                                                                                    <label>Nome:</label>
                                                                                                    <input class="form-control" value="<?php echo $a['nome']; ?>">
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>CPF:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['cpf']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>RG:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['rg']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Expeditor:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['orgao']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>E-mail:</label>
                                                                                                        <input class="form-control" value="<?php echo $d['email']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Contato:</label>
                                                                                                        <input class="form-control" value="<?php echo $b['telefone1']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Fixo:</label>
                                                                                                        <input class="form-control" value="<?php echo $b['telefone2']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Tipo Sanguíneo:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['tipo_sangue']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Formação:</label>
                                                                                                        <input class="form-control" value="<?php echo $e['nivel']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Profissão:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['profissao']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-12">
                                                                                                        <label>Curso:</label>
                                                                                                        <input class="form-control" value="<?php echo $f['curso']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-12">
                                                                                                        <label>Turma</label>
                                                                                                        <textarea class="form-control" ><?php echo $g['endereco'].", ".$g['bairro'].", ".$g['cidade'].", ".$g['numero'].", ".$g['complemento'].". / Horário: ".$g['dia']."/".$g['hora']; ?></textarea>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div class="col-sm-12 col-md-12">
                                                                                                    <h3>Endereço</h3>
                                                                                                    <hr>
                                                                                                    <div class="row">
                                                                                                        <div class='col-sm-12 col-md-8'>
                                                                                                            <label>Endereço:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['endereco'];?>">
                                                                                                        </div> 
                                                                                                        <div class='col-sm-12 col-md-4'>
                                                                                                            <label>Bairro:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['bairro'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-3'>
                                                                                                            <label>Número:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['numero'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-5'>
                                                                                                            <label>Cidade:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['cidade'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-4'>
                                                                                                            <label>Estado</label>
                                                                                                            <input class='form-control' value="<?php echo $h['estado'];?>">
                                                                                                        </div>";
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }else{

                                        $lk = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_pagamento_idtb_pagamento = '$v'");
                                        while ($ln = $lk->fetch_assoc()) {;
                                            $sql = $mysqli->query("SELECT *FROm tb_aluno WHERE idtb_aluno = '".$ln['tb_aluno_idtb_aluno']."'");
                                            while ($a = $sql->fetch_assoc()) {
                                                $con = $mysqli->query("SELECT *FROM tb_contato WHERE idtb_contato = '".$a['tb_contato_idtb_contato']."'") or die($mysqli->error);
                                                while ($b = $con->fetch_assoc()) {
                                                    $p = $mysqli->query("SELECT *FROM tb_pagamento WHERE idtb_pagamento = '".$ln['tb_pagamento_idtb_pagamento']."'");
                                                    while ($c = $p->fetch_assoc()) {
                                                        $log = $mysqli->query("SELECT *FROM tb_login WHERE idtb_login = '".$a['tb_login_idtb_login']."'") or die($mysqli->error);
                                                        while ($d = $log->fetch_assoc()) {
                                                            $for = $mysqli->query("SELECT *FROM tb_escolaridade WHERE idtb_escolaridade = '".$a['tb_escolaridade_idtb_escolaridade']."'");
                                                            while ($e = $for->fetch_assoc()) {
                                                                $cur = $mysqli->query("SELECT *FROM tb_curso WHERE idtb_curso = '".$a['tb_curso_idtb_curso']."'");
                                                                while ($f = $cur->fetch_assoc()) {
                                                                    $tur = $mysqli->query("SELECT *FROM tb_turma WHERE tb_curso_idtb_curso = '".$f['idtb_curso']."'") or die($mysqli->error);
                                                                    while ($g = $tur->fetch_assoc()) {
                                                                        $ender = $mysqli->query("SELECT *FROM tb_endereco WHERE tb_aluno_idtb_aluno = '".$a['idtb_aluno']."'");
                                                                        while($h = $ender->fetch_assoc()){
                                                                            ?>

                                                                            <tr>
                                                                                <td><?php echo $a['idtb_aluno']; ?></td>
                                                                                <td><?php echo $a['nome']; ?></td>
                                                                                <td><?php echo $a['cpf'] ?></td>                                          
                                                                                <td><?php echo $a['data']; ?></td>
                                                                                <td><?php echo $b['telefone1']; ?></td>
                                                                                <td><?php echo $a['data_cadastro'] ?></td>
                                                                                <td><?php echo $c['status']; ?></td>
                                                                                <td>
                                                                                    <a href='' data-toggle='modal' data-target="#ver<?php echo $a['idtb_aluno'];?>" title="Ver aluno?"><i class="fa fa-fw fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>

                                                                            <div class="modal fade" tabindex="-1" role="dialog" id="ver<?php echo $a['idtb_aluno'];?>"  style="opacity: 1; padding-top: 11em;">
                                                                                <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4>Fixa de Pré-matrícula</h4>

                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-8 col-md-12">
                                                                                                    <label>Nome:</label>
                                                                                                    <input class="form-control" value="<?php echo $a['nome']; ?>">
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>CPF:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['cpf']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>RG:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['rg']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Expeditor:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['orgao']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>E-mail:</label>
                                                                                                        <input class="form-control" value="<?php echo $d['email']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Contato:</label>
                                                                                                        <input class="form-control" value="<?php echo $b['telefone1']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Fixo:</label>
                                                                                                        <input class="form-control" value="<?php echo $b['telefone2']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Tipo Sanguíneo:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['tipo_sangue']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Formação:</label>
                                                                                                        <input class="form-control" value="<?php echo $e['nivel']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-4">
                                                                                                        <label>Profissão:</label>
                                                                                                        <input class="form-control" value="<?php echo $a['profissao']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-12">
                                                                                                        <label>Curso:</label>
                                                                                                        <input class="form-control" value="<?php echo $f['curso']; ?>">
                                                                                                    </div>
                                                                                                    <div class="col-sm-12 col-md-12">
                                                                                                        <label>Turma</label>
                                                                                                        <textarea class="form-control" ><?php echo $g['endereco'].", ".$g['bairro'].", ".$g['cidade'].", ".$g['numero'].", ".$g['complemento'].". / Horário: ".$g['dia']."/".$g['hora']; ?></textarea>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div class="col-sm-12 col-md-12">
                                                                                                    <h3>Endereço</h3>
                                                                                                    <hr>
                                                                                                    <div class="row">
                                                                                                        <div class='col-sm-12 col-md-8'>
                                                                                                            <label>Endereço:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['endereco'];?>">
                                                                                                        </div> 
                                                                                                        <div class='col-sm-12 col-md-4'>
                                                                                                            <label>Bairro:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['bairro'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-3'>
                                                                                                            <label>Número:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['numero'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-5'>
                                                                                                            <label>Cidade:</label>
                                                                                                            <input class='form-control' value="<?php echo $h['cidade'];?>">
                                                                                                        </div>
                                                                                                        <div class='col-sm-12 col-md-4'>
                                                                                                            <label>Estado</label>
                                                                                                            <input class='form-control' value="<?php echo $h['estado'];?>">
                                                                                                        </div>";
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script class="tmpScript" type="text/javascript" src="../js/valCampos_execute.js" ></script>
    <script src="../js/jquery.mask.js"></script>
    <script>
        $('.cpf').mask('000.000.000-00', {reverse: true});


    </script>


</body>
</html>