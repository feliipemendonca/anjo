<?php
include "../geral.php";
include "../config/seguranca.php";
include "../professor/consul_dados.php";
include "notasTable.php";

if(!isset($_SESSION["tokenGenerated"])) $_SESSION["tokenGenerated"] = getToken();

$token = $_SESSION["tokenGenerated"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>ADM | PROFº | NOTAS</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="../../css/sb-admin.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery.js" type="text/javascript"></script>
    <script src="../js/valCampos.js" type="text/javascript"></script>
    <script>
        function somenteFloat(e, el){
            var tecla = (window.event)?event.keyCode:e.which;
            if((tecla > 47 && tecla < 58)){
                var a = parseFloat(el.value + String.fromCharCode(tecla));

                if (a > 10){
                    if (el.value.indexOf(".") == -1 && el.value.indexOf(",") == -1){
                        el.value += ".";
                        return true;
                    }

                    return false;
                }

                if(a == 10){
                    el.value = "10.0"
                    return false;
                }

                return true;
            }else if(tecla==46 && (el.value.indexOf(".") == -1 && el.value.indexOf(",") == -1)){
                return true;
            }else{
                return false;
            }
        }
    </script>
</head>

<body>

    <div id="wrapper">
        <?php /*Menu*/ $linkRedirect="../"; $active=4; include "../professor/menu.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <h1>
                                        Notas
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Início
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-briefcase"></i>Notas
                            </li>
                        </ol>
                        <?php   if (empty($pro->fetch_assoc()['formacao'])) { ?>
                            <h4><strong class="text-danger">Atenção!</strong> Matenha seu dados sempre atualizados. <a href="<?php echo $linkRedirect ?>conta.php" title="Atualiar dados">Clique aqui!</a></h4>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <?php

                        include "../professor/checkSession.php";
                        if(!($turma = $_SESSION["turma"])){ ?>
                            <!--<h3 style="padding: 20px; padding-bottom: 0px;">Por favor selecione a turma!</h3>
                            <h4 style="padding: 20px; padding-top: 0px;">Redirecionando em <span id="span_segs"></span></h4>-->
                        
                            <div class='alert alert-warning alert-dismissible' role='alert'>
                                <strong>Selecione uma turma na Pagina Turma / Aluno</strong> Redirecionando em <span id="span_segs"></span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            
                            <script>
                                var redSegundos = 5;
                                var span_segs = document.getElementById("span_segs");
                                
                                span_segs.innerHTML = redSegundos + ((redSegundos >= 1) ? " segundos" : " segundo");
                                setInterval(function(){
                                    if (redSegundos == 0) location.href = "/professor/aluno.php?redURL=" + location.href;
                                    
                                    var tmpStr = redSegundos--;
                                    tmpStr += ((redSegundos >= 1) ? " segundos" : " segundo");
                                    
                                    span_segs.innerHTML = tmpStr;
                                }, 1000);
                            </script>
                            
                            <?php
                            exit();
                        }

                        $sql = "SELECT a.idtb_aluno, a.nome,
                        n.nota1,n.envio_nota1,
                        n.nota2,n.envio_nota2,
                        n.nota3,n.envio_nota3,
                        n.nota4,n.envio_nota4 FROM tb_notas n
                        RIGHT JOIN tb_turma_aluno t ON t.idtb_turma_aluno = n.id_turma_aluno
                        JOIN tb_aluno a ON a.idtb_aluno = t.tb_aluno_idtb_aluno
                        WHERE t.tb_turma_idtb_turma=$turma";

                        $query = mysqli_query($mysqli, $sql);
                        ?>
                        <div style="padding: 20px; ">
                            <?php if (mysqli_num_rows($query) == 0){
                                $sql = "SELECT a.idtb_aluno, a.nome FROM tb_turma_aluno t
                                JOIN tb_aluno a ON a.idtb_aluno = t.tb_aluno_idtb_aluno
                                WHERE t.tb_turma_idtb_turma=$turma";

                                $query = mysqli_query($mysqli, $sql);

                                if(mysqli_num_rows($query) == 0) die("<h3>Erro!<br>Aluno e/ou turma não existe(m)</h3>");

                                ?>
                                <table id="tb_notas_aluno" class="table table-bordered table-hover" border="1px solid black">
                                    <?php echo getTableNotasHeader();
                                    while($res = mysqli_fetch_assoc($query)){
                                        echo getTableNotasBody($res["idtb_aluno"], $res["nome"]);
                                    } ?>
                                </table>
                                
                            <?php }else{ ?>
                                <table id="tb_notas_aluno" class="table table-bordered table-hover" border="1px solid black">
                                    <?php echo getTableNotasHeader();
                                    while($res = mysqli_fetch_assoc($query)){
                                        $id_aluno = $res["idtb_aluno"];
                                        $nome_aluno = $res["nome"];
                                        $nota1 = $res["nota1"];
                                        $nota2 = $res["nota2"];
                                        $nota3 = $res["nota3"];
                                        $nota4 = $res["nota4"];

                                        echo getTableNotasBody($id_aluno, $nome_aluno, [$nota1, $nota2, $nota3, $nota4]);
                                    } ?>
                                </table>
                            <?php } ?>
                            <form id="form_envio_notas" action="envioNotas.php" method="POST" target="frame_envioNotas">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" readonly />
                                <input type="hidden" name="aluno" value="" readonly />
                                <!--<input type="hidden" name="turma" value="<?php echo $turma; ?>" readonly />-->
                                <input type="hidden" name="nota" />
                                <input type="hidden" name="ref" />
                            </form>
                            <iframe name="frame_envioNotas" border="0" style="display:none;" ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var notaSalva;
        function salvarEnvioNotas(el){
            notaSalva = el.value;
        }

        function enviarNotas(el){
            if(notaSalva != null){
                if(el.value == ""){
                    notaSalva = null;
                    return;
                }

                if(notaSalva == el.value){
                    notaSalva = null;
                    return;
                }

                var form_envio = document.getElementById("form_envio_notas"),
                inpt_token = form_envio.ownerDocument.getElementsByName("token")[0],
                inpt_aluno = form_envio.ownerDocument.getElementsByName("aluno")[0],
                inpt_nota = form_envio.ownerDocument.getElementsByName("nota")[0],
                inpt_ref = form_envio.ownerDocument.getElementsByName("ref")[0];

                var ref = el.getAttribute("tag"),
                aluno = el.getAttribute("aluno"),
                nota = el.value;

                var nome_aluno = aluno.substring(0, aluno.indexOf("-"));

                if(confirm("Deseja enviar a nota: " + nota + "\nReferente a NOTA: " + ref + "\nPara o aluno: " + nome_aluno + "?")){
                    inpt_token.value = "<?php echo $token; ?>";
                    inpt_nota.value = nota;
                    inpt_ref.value = ref;
                    inpt_aluno.value = aluno.substring(aluno.indexOf("-")+1);

                    form_envio.submit();
                }else{
                    el.value = notaSalva;
                }
            }
        }
    </script>

    <script src="/js/popper.min.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
</body>
</html>