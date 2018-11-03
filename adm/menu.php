<?php
include "checkSession.php";

if (!isset($active)) $active = 1;

if (!isset($linkRedirect)) $linkRedirect = "";

$idtb_prof = $_SESSION['idtb_login'];
$query = $mysqli->query("SELECT nome FROM tb_dado_adm WHERE tb_login_idtb_login = '$idtb_prof'");
$nome_adm;

if ($query) $nome_adm = $query->fetch_assoc()["nome"];
?>

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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nome_adm ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Conta</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if($active == 1) echo "class=\"active\"" ?> >
                <a href="<?php echo $linkRedirect ?>index.php"><i class="fa fa-fw fa-dashboard"></i> Solicitações de Serviços</a>
            </li>
            <li <?php if($active == 2) echo "class=\"active\"" ?> >
                <a href="<?php echo $linkRedirect ?>professor.php"><i class="fa fa-fw fa-bar-chart-o"></i>Professores</a>
            </li>

            <li <?php if($active == 3) echo "class=\"active\"" ?> >
                <a href="<?php echo $linkRedirect ?>curso.php"><i class="fa fa-fw fa-graduation-cap"></i>Cursos</a>
            </li>
            <li <?php if($active == 4) echo "class=\"active\"" ?> >
                <a href="javascript:;" data-toggle="collapse" data-target="#dem"><i class="fa fa-fw fa-check-square-o"></i>Turmas<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="dem" class="collapse">
                    <li>
                        <a href="<?php echo $linkRedirect ?>turma.php">Ativas</a>
                    </li>
                    <li>
                        <a href="<?php echo $linkRedirect ?>turma_desativada.php">Desativadas</a>
                    </li>
                </ul>
            </li>
            <li <?php if($active == 5) echo "class=\"active\"" ?> >
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Alunos<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="<?php echo $linkRedirect ?>aluno.php">Matriculados</a>
                    </li>
                    <li>
                        <a href="<?php echo $linkRedirect ?>pre.php">Pré-Matriculados</a>
                    </li>
                </ul>
            </li>
            <li <?php if($active == 6) echo "class=\"active\"" ?> >
                <a href="<?php echo $linkRedirect ?>servico.php"><i class="fa fa-fw fa-briefcase"></i> Serviços</a>
            </li>
            <li <?php if($active == 7) echo "class=\"active\"" ?> >
                <a href="<?php echo $linkRedirect ?>contato.php"><i class="fa fa-fw fa-briefcase"></i> Contato</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>