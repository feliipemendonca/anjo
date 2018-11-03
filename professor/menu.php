<?php
if (!isset($active)) $active = 1;

if (!isset($linkRedirect)) $linkRedirect = "";

$idtb_prof = $_SESSION['idtb_login'];
$query = $mysqli->query("SELECT nome FROM tb_professor WHERE tb_login_idtb_login = '$idtb_prof'");
$nome_prof;

if ($query) $nome_prof = $query->fetch_assoc()["nome"];
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">       
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">SB Admin</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nome_prof; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo $linkRedirect; ?>../../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if($active == 1) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>./"><i class="fa fa-fw fa-dashboard"></i> Início</a>
            </li>
            <li <?php if($active == 2) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>aluno.php"><i class="fa fa-fw fa-graduation-cap"></i>Turma | Alunos</a>
            </li>

            <li <?php if($active == 3) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>presenca/"><i class="fa fa-fw fa-bolt"></i>Presença</a>
            </li>
            <li <?php if($active == 4) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>notas/"><i class="fa fa-fw fa-briefcase"></i> Notas</a>
            </li>
            <li <?php if($active == 5) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>biblioteca/"><i class="fa fa-fw fa-download"></i> Material</a>
            </li>
            <li <?php if($active == 6) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>conta.php"><i class="fa fa-fw fa-gear"></i> Conta</a>
            </li>
        </ul>
    </div>
</nav>

