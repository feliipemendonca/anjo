<?php
    include "checkSession.php";

    if (!isset($active)) $active = 1;
    
    if (!isset($linkRedirect)) $linkRedirect = "";

    $idtb_login = $_SESSION['idtb_login'];
    $query = $mysqli->query("SELECT nome FROM tb_aluno WHERE tb_login_idtb_login = '$idtb_login'");
    $nome_aluno;
    
    if ($query) $nome_aluno = $query->fetch_assoc()["nome"];
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
        <a class="navbar-brand" href="">SB Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nome_aluno; ?></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo $linkRedirect; ?>../../config/logout.php"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li <?php if($active == 1) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>./"><i class="fa fa-fw fa-dashboard"></i> Início</a>
            </li>
            <li <?php if($active == 2) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>nota.php"><i class="fa fa-fw fa-bar-chart-o"></i>Notas</a>
            </li>

            <li <?php if($active == 3) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>frequencia.php"><i class="fa fa-fw fa-graduation-cap"></i>Frequência</a>
            </li>
            <li <?php if($active == 4) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>biblioteca/virtual"><i class="fa fa-fw fa-cloud-download"></i>Material</a>
            </li>
            <li <?php if($active == 5) echo "class=\"active\""; ?> >
                <a href="<?php echo $linkRedirect; ?>dado.php"><i class="fa fa-fw fa-cogs"></i>Meus dados</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>