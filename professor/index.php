<?php
include "../config/seguranca.php";
include "checkSession.php";
include "consul_dados.php";

$t = $mysqli->query("SELECT *FROm tb_turma WHERE tb_professor_idtb_professor = '$idtb_professor'");
$idtb_turma = $t->fetch_assoc()['idtb_turma'];


// if (isset($_POST['save'])) {

//     $con = $mysqli->query("INSERT INTO tb_contato (telefone1, telefone2) VALUES('".$_POST['tel1']."','".$_POST['tel2']."')") or die($mysqli->error);
//     $id = mysqli_insert_id($mysqli);

//     $sql = $mysqli->query("INSERT INTO tb_professor(nome, cpf, rg, tb_login_idtb_login, tb_contato_idtb_contato)
//       VALUES('".$_POST['nome']."','".$_POST['cpf']."','".$_POST['rg']."','$idtb_prof','$id')") or die($mysqli->error);

//     if ($sql) {
//         header("Location: index.php");
//     }else{
//         echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
//         <strong>Error!</strong> Verefique seus dados e tente novamente.
//         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
//         <span aria-hidden='true'>&times;</span>
//         </button>
//         </div>";
//     }
// }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <?php include "../config/tema-top.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADM | PROFº</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    

</head>

<body>

    <div id="wrapper">
        <?php /*Menu*/ $active=1; include "menu.php"; ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Inicio
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Início
                            </li>
                        </ol>
                        <?php   if (empty($pro->fetch_assoc()['formacao'])) { ?>
                            <h4><strong class="text-danger">Atenção!</strong> Matenha seu dados sempre atualizados. <a href="<?php echo $linkRedirect ?>conta.php" title="Atualiar dados">Clique aqui!</a></h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $sql = $mysqli->query("SELECT *FROM tb_msg WHERE idtb_professor = '$idtb_professor'")->num_rows; ?></div>
                                        <div>Mesagens de de Alunos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="message.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Mensagens</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                            $sqlStr = "SELECT count(b.id) as quant FROM tb_biblioteca b
                                            JOIN tb_gp_biblioteca gp ON gp.id = b.id_grupo
                                            JOIN tb_turma t ON t.idtb_turma=gp.id_turma
                                            WHERE t.tb_professor_idtb_professor=$idtb_professor";
                                            echo $b = $mysqli->query($sqlStr)->fetch_assoc()["quant"];
                                            ?>
                                        </div>
                                        <div>Materiais Postados!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="biblioteca/">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Material</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php $sql = $mysqli->query("SELECT *FROm tb_aluno"); ?>
                                        <div class="huge"><?php echo $sql->fetch_assoc()['idtb_aluno']; ?></div>
                                        <div>Alunos Matrículados</div>
                                    </div>
                                </div>
                            </div>
                            <a href="aluno.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalhes</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php $s = $mysqli->query("SELECT *FROM tb_msg WHERE tb_professor_idtb_professor = '$idtb_professor'"); ?>
                                        <div class="huge"></div>
                                        <div>Support Tickets!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/valCampos.js"></script>
    <script type="text/javascript" src="../js/valCampos_execute.js"></script>
    <script type="text/javascript" class="tmpScript">
        var linkButtons = document.getElementsByClassName("use-linkButton");

        for(var a=0; a<linkButtons.length; a+=1){
            if (linkButtons[a] != null) linkButtons[a].addEventListener("click", function(e){
                var tmpLink = this.getAttribute("link-button");
                if (tmpLink == null) return;

                location.href = tmpLink;
            }, false);
        }
    </script>
</body>
</html>