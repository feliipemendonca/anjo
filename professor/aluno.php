<!DOCTYPE html>
<?php
include "../config/seguranca.php";
include "checkSession.php";

    // if(!($turma = $_SESSION["turma"])) header("location: ");

$idtb_prof = $_SESSION['idtb_login'];
$sql = "SELECT *FROM tb_professor WHERE tb_login_idtb_login = '$idtb_prof'";
$pro = $mysqli->query($sql) or die("Erro!<br>" . mysqli_error($mysqli));
while ($ln = $pro->fetch_assoc()) {
    $nome = $ln['nome'];
    $idtb_professor = $ln['idtb_professor'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADM | PROFº</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <?php if((@$redURL = $_GET["redURL"]) && !isset($_SESSION["turma"])) { ?>
        <script>
            alert("Desculpe!\nErro ao acessar a página: <?php echo $redURL ?>\nSelecione uma turma primeiro!");
        </script>
    <?php } ?>
</head>

<body>

    <div id="wrapper">

        <?php /*Menu*/ $active=2; include "menu.php"; ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-9">
                                    <h1>
                                        Turma | Alunos
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Início
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-graduation-cap"></i>Turma | Alunos
                            </li>
                        </ol>
                        <?php   if (empty($pro->fetch_assoc()['formacao'])) { ?>
                            <h4><strong class="text-danger">Atenção!</strong> Matenha seu dados sempre atualizados. <a href="<?php echo $linkRedirect ?>conta.php" title="Atualiar dados">Clique aqui!</a></h4>
                        <?php } ?>
                        <div class='alert alert-warning alert-dismissible' role='alert'>
                            Clique em turma para adcionar Presença, Notas e Material
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="table-responsive">
                            <?php if(!isset($_SESSION["turma"])){ ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Turma</th>
                                            <th>Horário</th>
                                            <th>Dias</th>
                                            <th>Matrículados</th>
                                            <th>Vagas</th>
                                            <th>Vagas Restantes</th>
                                            <th>Abertura</th>                                        
                                            <!-- <th>Ações</th>
                                            -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = "SELECT t.idtb_turma, t.nome, t.hora, t.dia, t.vagas, t.data, c.curso, (
                                        SELECT count(idtb_turma_aluno) FROM tb_turma_aluno WHERE tb_turma_idtb_turma=t.idtb_turma) AS quantAlunos FROM tb_turma t JOIN tb_curso c ON c.idtb_curso=t.tb_curso_idtb_curso WHERE tb_professor_idtb_professor='$idtb_professor'";
                                        $query = $mysqli->query($sql);

                                        while($res = mysqli_fetch_assoc($query)){ 
                                            $t = $mysqli->query("SELECT *FROM tb_turma_aluno WHERE tb_turma_idtb_turma ='".$res['idtb_turma']."'");
                                            $id = $t->num_rows;
                                            ?>
                                            <tr>
                                                <?php
                                                $d= array();
                                                $d["turma"] = $res["idtb_turma"];
                                                if(isset($redURL)) $d["redURL"] = $redURL;

                                                @$d = http_build_query($d); ?>

                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['idtb_turma']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['nome']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['hora']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['dia']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['quantAlunos']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['vagas']; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['vagas'] - $id; ?>
                                                </td>
                                                <td class="use-linkButton" link-button="?<?php echo $d; ?>">
                                                    <?php echo $res['data']; ?>
                                                </td>
                                               <!--  <td>
                                                    <a href="ver_alunos.php?url=<?php echo base64_encode($res['idtb_turma']); ?>" title="Imprimir" target="_blank"><i class="fa fa-fw fa-print"></i></a>
                                                </td> -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php }else{ ?>
                                <button class="use-linkButton btn btn-primary" link-button="?turma=-1" >Voltar</button>
                                <?php
                                $sql = "SELECT a.idtb_aluno as id, a.cpf, a.nome, c.curso, t.nome AS turma, t.hora FROM tb_turma t
                                JOIN tb_curso c ON c.idtb_curso=t.tb_curso_idtb_curso
                                JOIN tb_turma_aluno ta ON ta.tb_turma_idtb_turma=t.idtb_turma
                                JOIN tb_aluno a ON a.idtb_aluno=ta.tb_aluno_idtb_aluno
                                WHERE t.idtb_turma=$turma";
                                $query = $mysqli->query($sql);

                                if(!$query){ ?>
                                    <h3>Desculpe, mas ocorreu um erro ao listar os alunos!</h3>
                                <?php }

                                if(mysqli_num_rows($query) > 0){
                                    $res = $query->fetch_assoc();
                                    ?>
                                    <h4>Alunos da turma de: <b><?php echo $res["turma"]; ?></b></h4>
                                    <?php include "../presenca/porcentagemPresenca.php"; ?>
                                    <?php include "../notas/notasTable.php"; ?>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Matricula</th>
                                                <th>Nome</th>
                                                <th>Faltas</th>
                                                <th>Média atual</th>
                                                <th>Curso</th>
                                                <th>Turno</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do {
                                                $pres = new presencas($res['id'], $turma);
                                                $n = new notas($res['id'], $turma);

                                                $res["cpf"] = str_replace(".", "", $res["cpf"]);
                                                $res["cpf"] = str_replace("-", "", $res["cpf"]);
                                                ?>
                                                <tr>
                                                    <td><?php echo $res["cpf"]; ?></td>
                                                    <td><?php echo $res['nome'] ?></td>
                                                    <td style="text-align: center;"><?php echo $pres->porFaltas; ?></td>
                                                    <td style="text-align: center;"><?php echo $n->mediaAtual; ?></td>
                                                    <td><?php echo $res['curso'] ?></td>
                                                    <td><?php
                                                    $h = $res['hora'];
                                                    $h = substr($h, 0, strpos($h, " "));
                                                    $h = str_replace("h", "", $h);

                                                    if((int) $h < 12) echo "MATUTINO";
                                                    else if((int) $h > 18) echo "VESPERTINO";
                                                    else echo "NOTURNO";
                                                    ?></td>
                                                </tr>
                                            <?php } while ($res = $query->fetch_assoc()); ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <h3> Nenhum aluno encontrado na turma: <?php echo mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT nome FROM tb_turma WHERE idtb_turma=$turma"))["nome"]; ?></h3>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/valCampos_execute.js" ></script>
</body>
</html>