<?php
include "../config/seguranca.php";
include "checkSession.php";

    // if(!($turma = $_SESSION["turma"])) header("location: ");

$idtb_prof = $_SESSION['idtb_login'];
include "consul_dados.php";
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
    

</head>

<body>

    <div id="wrapper">
        <?php /*Menu*/ $active=6; include "menu.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-9">
                                    <h1>
                                        Conta
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Início
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-gear"></i>Conta
                            </li>
                        </ol>
                    </div>
                    <div class="col-12 col-md-12">
                        <?php 
                        if (isset($_POST['save'])) {

                            $sql = $mysqli->query("UPDATE tb_professor SET formacao = '".$_POST['formacao']."', instituicao = '".$_POST['instituicao']."', ano = '".$_POST['ano']."', sobre = '".$_POST['sobre']."' WHERE idtb_professor = '".$ln['idtb_professor']."'") or die($mysqli->error);

                            if ($sql) {
                                $t = $_POST['tel1'];
                                $s = $mysqli->query("UPDATE tb_contato SET telefone1 = '".$_POST['tel1']."', telefone2 = '".$_POST['tel2']."' WHERE idtb_contato = '".$l['idtb_contato']."'") or die($mysqli->error); 
                                if ($s) {
                                    header("location: conta.php");
                                    echo "<div class='alert alert-success alert-dismissible' role='alert'>
                                    <strong>Sucesso!</strong> Dados atualizados.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                    ?>
                                    <form action="" method="post" accept-charset="utf-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8">
                                                <label>Nome</label>
                                                <input type="text" class="form-control disabled" value="<?php echo $ln['nome']; ?>" disabled>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>RG</label>
                                                <input type="tel" class="form-control disabled" value="<?php echo $ln['rg']; ?>" disabled>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>CPF</label>
                                                <input type="tel" class="form-control disabled" value="<?php echo $ln['cpf']; ?>" disabled>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Formação<em>*</em></label>
                                                <input type="text" class="form-control" name="formacao" value="<?php echo $ln['formacao']; ?>" required>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Instituição<em>*</em></label>
                                                <input type="text" class="form-control" name="instituicao" value="<?php echo $ln['instituicao']; ?>" required>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Ano<em>*</em></label>
                                                <input type="date" class="form-control" name="ano" value="<?php $ln['ano']; ?>" required>
                                            </div>

                                            <div class="col-sm-12 col-md-4">
                                                <label>Whatsapp<em>*</em></label>
                                                <input type="tel" class="form-control" name="tel1" value="<?php echo $l['telefone1']; ?>">
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Fixo</label>
                                                <input type="tel" class="form-control" name="tel2" value="<?php echo $l['telefone2']; ?>">
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <label>Biogafia<em>*</em></label>
                                                <textarea class="form-control" rows="5" name="sobre"><?php echo $ln['sobre']; ?></textarea>                  
                                            </div>
                                            <div class="col-sm-12 col-md-10"></div>
                                            <div class="col-sm-12 col-md-2">
                                                <br>
                                                <button class="btn btn-primary form-control" name="save" value="save" type="submit">Atualizar</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php  }else{
                                    echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                                    <strong>Error!</strong> Tente novamente.
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";

                                    ?>

                                    <form action="" method="post" accept-charset="utf-8">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-8">
                                                <label>Nome</label>
                                                <input type="text" class="form-control disabled" value="<?php echo $ln['nome']; ?>" disabled>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>RG</label>
                                                <input type="tel" class="form-control disabled" value="<?php echo $ln['rg']; ?>" disabled>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>CPF</label>
                                                <input type="tel" class="form-control disabled" value="<?php echo $ln['cpf']; ?>" disabled>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Formação<em>*</em></label>
                                                <input type="text" class="form-control" name="formacao" value="<?php echo $ln['formacao']; ?>" required>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Instituição<em>*</em></label>
                                                <input type="text" class="form-control" name="instituicao" value="<?php echo $ln['instituicao']; ?>" required>                                    
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Ano<em>*</em></label>
                                                <input type="date" class="form-control" name="ano" value="<?php $ln['ano']; ?>" required>
                                            </div>

                                            <div class="col-sm-12 col-md-4">
                                                <label>Whatsapp<em>*</em></label>
                                                <input type="tel" class="form-control" name="tel1" value="<?php echo $l['telefone1']; ?>">
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <label>Fixo</label>
                                                <input type="tel" class="form-control" name="tel2" value="<?php echo $l['telefone2']; ?>">
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <label>Biogafia<em>*</em></label>
                                                <textarea class="form-control" rows="5" name="sobre"><?php echo $ln['sobre']; ?></textarea>                  
                                            </div>
                                            <div class="col-sm-12 col-md-10"></div>
                                            <div class="col-sm-12 col-md-2">
                                                <br>
                                                <button class="btn btn-primary form-control" name="save" value="save" type="submit">Atualizar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                }
                            }
                        }else{ ?>
                         <form action="" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <label>Nome</label>
                                    <input type="text" class="form-control disabled" value="<?php echo $ln['nome']; ?>" disabled>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>RG</label>
                                    <input type="tel" class="form-control disabled" value="<?php echo $ln['rg']; ?>" disabled>                                    
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>CPF</label>
                                    <input type="tel" class="form-control disabled" value="<?php echo $ln['cpf']; ?>" disabled>                                    
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Formação<em>*</em></label>
                                    <input type="text" class="form-control" name="formacao" value="<?php echo $ln['formacao']; ?>" required>                                    
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Instituição<em>*</em></label>
                                    <input type="text" class="form-control" name="instituicao" value="<?php echo $ln['instituicao']; ?>" required>                                    
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Ano<em>*</em></label>
                                    <input type="date" class="form-control" name="ano" value="<?php $ln['ano']; ?>" required>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label>Whatsapp<em>*</em></label>
                                    <input type="tel" class="form-control" name="tel1" value="<?php echo $l['telefone1']; ?>">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label>Fixo</label>
                                    <input type="tel" class="form-control" name="tel2" value="<?php echo $l['telefone2']; ?>">
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label>Biogafia<em>*</em></label>
                                    <textarea class="form-control" rows="5" name="sobre"><?php echo $ln['sobre']; ?></textarea>                  
                                </div>
                                <div class="col-sm-12 col-md-10"></div>
                                <div class="col-sm-12 col-md-2">
                                    <br>
                                    <button class="btn btn-primary form-control" name="save" value="save" type="submit">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="../js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>


</body>
</html>