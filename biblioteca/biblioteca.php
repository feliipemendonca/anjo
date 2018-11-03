<?php
include "../config/seguranca.php";
include "../config/config.php";
include "../geral.php";

$erro = false;
$naoEncontrado = false;
$url = $_SERVER['REQUEST_URI'];

@$pasta = $_GET["pasta"];
    //$turma = 1;
if(isset($_SESSION["prof"])) include "../professor/checkSession.php";
else if(isset($_SESSION["admin"])) include "../adm/checkSession.php";
else if(isset($_SESSION["aluno"])) include "../adm/profile/checkSession.php";
else {
    ?>
    <script>
        alert("Faça o login para acessar essa pagina!")
        location.href = "../config/logout.php";
    </script>
    <?php
    exit();
}

if(!($turma = $_SESSION["turma"])) die("Acesso não autorizado!");

if(isset($turma) && isset($pasta)){
    if ($token = $_GET["token"]){
        $sql = "SELECT b.id_grupo, g.titulo, b.arquivo, b.dt_envio FROM tb_biblioteca b
        JOIN tb_gp_biblioteca g ON g.id = b.id_grupo
        WHERE g.id_turma=$turma AND b.token='$token' AND g.pasta='$pasta'";

        if ($pasta == ""){
            $sql = "SELECT b.id_grupo, g.titulo, b.arquivo, b.dt_envio FROM tb_biblioteca b
            JOIN tb_gp_biblioteca g ON g.id = b.id_grupo
            WHERE g.id_turma=$turma AND b.token='$token' AND g.pasta IS NULL";
        }

        $query = mysqli_query($mysqli, $sql);

        $erro = !$query;
        $naoEncontrado = mysqli_num_rows($query) == 0;

        $d_biblioteca = mysqli_fetch_assoc($query);
        $arquivo = $d_biblioteca["arquivo"];
        $fileName = ($pasta == "") ? $arquivo : $pasta . "/" . $arquivo;

        if(@$remover = $_GET["remover"]){
            $sql = "SELECT idtb_login FROM tb_login
                WHERE idtb_login=" . $_SESSION["idtb_login"] . " AND email='" . $_SESSION["email"] . "' AND senha='" . sha1(md5(base64_decode($remover . "="))) . "' AND ";
        
            if(isset($_SESSION["admin"])) $sql .= "tipo=1";
            else if(isset($_SESSION["prof"])) $sql .= "tipo=2";
            else{ ?>
                <script>
                    alert("Erro!\nVocê não tem permissões de exclusão!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }

            $q = mysqli_query($mysqli, $sql);

            if(!$q){ ?>
                <script>
                    alert("Erro!\nOcorreu um erro no acesso ao banco!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }

            if(mysqli_num_rows($q) > 0){
                if($erro){ ?>
                    <script>
                        alert("Erro!\nOcorreu um erro ao acessar o banco!");
                        location.href = "../voltar";
                    </script>
                    <?php exit();
                }
                
                if($naoEncontrado){ ?>
                    <script>
                        alert("Erro!\nArquivo não encontrado!");
                        location.href = "../voltar";
                    </script>
                    <?php exit();
                }
                
                $nomeArquivo = $d_biblioteca["arquivo"];
                
                $sql = "DELETE FROM tb_biblioteca
                        WHERE token='$token' AND arquivo='$nomeArquivo'";
                
                $q = mysqli_query($mysqli, $sql);
                
                if(!$q){ ?>
                    <script>
                        alert("Erro!\nOcorreu um erro ao excluir do banco!");
                        location.href = "../voltar";
                    </script>
                    <?php exit();
                }
                
                unlink("lib_aluno/" . $nomeArquivo); ?>
                <script>
                    alert("Arquivo \"<?php echo $nomeArquivo ?>\" excluido com sucesso!");
                    location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length) + "grupo/<?php echo $d_biblioteca["titulo"] . "/" . $d_biblioteca["id_grupo"]?>";
                </script>
                <?php exit();
                
            }else{ ?>
                <script>
                    alert("Erro!\nLogin e/ou senha invalidos!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }
        }
        else if(isset($_GET["download"])) downloadFile("lib_aluno/" . $arquivo);
        else if(isset($_GET["voltar"])){
            //header("location: " . substr($url, 0, strpos($url, "biblioteca/virtual") + 18) . "/grupo/" . $d_biblioteca["titulo"] . "/" . $d_biblioteca["id_grupo"]);
            ?>
            <script>
                location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length) + "grupo/<?php echo $d_biblioteca["titulo"] . "/" . $d_biblioteca["id_grupo"]?>";
            </script>
            <?php exit();
        }
    }
}else if((@$grupo = $_GET["grupo"]) && (@$grupoId = $_GET["grupo_id"])){
    $sql = "SELECT g.titulo, g.descricao, g.pasta, b.arquivo, b.dt_envio, b.token FROM tb_biblioteca b
    JOIN tb_gp_biblioteca g ON g.id = b.id_grupo
    WHERE g.id='$grupoId' AND g.titulo='$grupo'";

    $query_gpBiblioteca = mysqli_query($mysqli, $sql);
    $erro = !$query_gpBiblioteca;

    if(@$remover = $_GET["remover"]){
        $sql = "SELECT idtb_login FROM tb_login
                WHERE idtb_login=" . $_SESSION["idtb_login"] . " AND email='" . $_SESSION["email"] . "' AND senha='" . sha1(md5(base64_decode($remover . "="))) . "' AND ";
        
            if(isset($_SESSION["admin"])) $sql .= "tipo=1";
            else if(isset($_SESSION["prof"])) $sql .= "tipo=2";
            else{ ?>
                <script>
                    alert("Erro!\nVocê não tem permissões de exclusão!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }

            $q = mysqli_query($mysqli, $sql);

            if(!$q){ ?>
                <script>
                    alert("Erro!\nOcorreu um erro no acesso ao banco!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }

            if(mysqli_num_rows($q) > 0){
                if($erro){ ?>
                    <script>
                        alert("Erro!\nOcorreu um erro ao acessar o banco!");
                        location.href = "../voltar";
                    </script>
                    <?php exit();
                }
                
                $quantArquivos = mysqli_num_rows($query_gpBiblioteca);
                
                if($quantArquivos < 1){
                    $sql = "SELECT id FROM tb_gp_biblioteca
                            WHERE id='$grupoId' AND titulo='$grupo'";
                    $q = mysqli_query($mysqli, $sql);
                    
                    if(!$q){ ?>
                        <script>
                            alert("Erro!\nOcorreu um erro ao acessar o banco!");
                            location.href = "../voltar";
                        </script>
                        <?php exit();
                    }
                    
                    if(mysqli_num_rows($q) < 1){ ?>
                        <script>
                            alert("Erro!\nGrupo não encontrado!");
                            location.href = "../voltar";
                        </script>
                        <?php exit();
                    }
                }else{
                    while($res = mysqli_fetch_assoc($query_gpBiblioteca)){
                        $sql = "DELETE FROM tb_biblioteca
                                WHERE id_grupo=$grupoId AND arquivo='" . $res["arquivo"] . "' AND token='" . $res["token"] . "'";
                        $q = mysqli_query($mysqli, $sql);

                        if(!$q){ ?>
                            <script>
                                alert("Erro!\nOcorreu um erro ao excluir do banco o arquivo <?php echo $res["arquivo"]; ?>!\nContate o administrador!");
                                location.href = "../voltar";
                            </script>
                            <?php exit();
                        }
                        
                        unlink("lib_aluno/" . $res["arquivo"]);
                    }
                }
                
                $sql = "DELETE FROM tb_gp_biblioteca
                        WHERE titulo='$grupo' AND id='$grupoId'";
                
                $q = mysqli_query($mysqli, $sql);
                
                if(!$q){ ?>
                    <script>
                        alert("Erro!\nOcorreu um erro ao excluir do banco!");
                        location.href = "../voltar";
                    </script>
                    <?php exit();
                } ?>

                <script>
                    alert("Grupo \"<?php echo $grupo ?>\" excluido com sucesso!");
                    if (parent != null) parent.location.href = parent.location.href;
                    location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length);
                </script>
                <?php exit();
                
            }else{ ?>
                <script>
                    alert("Erro!\nLogin e/ou senha invalidos!");
                    location.href = "../voltar";
                </script>
                <?php exit();
            }
    }
    else if(isset($_GET["voltar"])){
        //header("location: " . substr($url, 0, strpos($url, "biblioteca/virtual") + 18));
        ?>
        <script>
            location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length -1);
        </script>
        <?php exit();
    }
    
    if(mysqli_num_rows($query_gpBiblioteca) < 1) echo "<h2 style=\"padding: 20px; padding-left: 50px; margin-top:150px;\">Nenhum material postado ainda!</h2>";
}

$linkRedirect = "";
function getMenu($a=0){
    global $mysqli;
    global $linkRedirect;
    
    if(isset($_SESSION["aluno"])) {
        $active = 4;
        $linkRedirect = "../";
        
        for($b=0; $b<$a; $b+=1){
            $linkRedirect .= "../";
        }
        ?>

        <div id="wrapper">
            <?php include "../adm/profile/menu.php"; ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Materia de Estudo</h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-dashboard"></i> Início
                                </li>
                                <li class="">
                                    <a href="<?php echo $linkRedirect ?>biblioteca/virtual"><i class="fa fa-fw fa-cloud-download"></i>Materia de Estudo</a>
                                </li>
                            </ol>
                        </div>					
                    </div>

                    <div class="row" style="padding-left: 50px;">
    <?php }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
        <link media="screen" rel="stylesheet" href="/biblioteca/css/biblioteca.css" />
        <link media="screen" rel="stylesheet" href="/biblioteca/css/animations.css" />
        <script type="text/javascript" src="/biblioteca/js/urlManager.js"></script>
        <script type="text/javascript" src="/biblioteca/js/checkBrowser.js"></script>
        
        <script type="text/javascript">
            getBrowser();
        </script>
        <?php
        if($erro){
            ?>
            <title>Erro - Biblioteca</title>
            <script>
                alert("Ocorreu um erro ao acessar o banco!");
            </script></head></html>
            <?php
            exit();
        }

        if($naoEncontrado){
            ?>
            <title>Não encontrado - Biblioteca</title>
            <script>
                alert("Erro!\nArquivo não encontrado!");
                location.href = "../voltar";
            </script></head></html>
            <?php
            exit();
        }

        if(isset($fileName)){ ?>
            <title><?php echo $fileName ?> - Biblioteca</title>
        <?php }else { ?>
            <title>Biblioteca</title>
        <?php } ?>

        <?php if(isset($_SESSION["aluno"])){ ?>
            <?php include "../config/tema-top.php"; ?>

            <link rel="stylesheet" href="/css/bootstrap.min.css">
            <link href="/css/sb-admin.css" rel="stylesheet">
            <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <style type="text/css" media="screen">
                .form-control{
                    border-radius: 0px;
                }
                
                #bt_voltar{
                    top: 240px !important;
                    left: 320px !important;
                }
                
                #div_infoCenter{
                    left: 35% !important;
                }
            </style>
        <?php } ?>
    </head>
    <body>
        <?php if(!empty($d_biblioteca)){ getMenu(3); ?>
            <?php if(isset($_SESSION["aluno"])){ ?>
                <style>
                    #div_bibliotecaArquivo_info{
                        width: 78.35% !important;
                    }
                </style>
            <?php } ?>
            <button id="bt_voltar">
                <font style="top: 12px; font-size: 50pt; margin-right: 22px; position: relative;">&lt;</font>Voltar
            </button>
            <?php
            $tipos_icones = getTipoIcones();
            $tipoEncontrado = getTipoEncontrado($arquivo, $tipos_icones);

            if(!$tipoEncontrado) $tipoEncontrado = "noneType";
            ?>

            <div id="div_bibliotecaArquivo_info">
                <div id="div_infoCenter">
                    <img id="img_iconType" src="<?php echo substr($url, 0, strpos($url, "biblioteca") + 10) ?>/icones/<?php echo $tipoEncontrado ?>_icon.png" />
                    <div id="div_info">
                        <h2><?php echo $arquivo; ?></h2>
                        <h5><?php echo date("d/m/Y", strtotime($d_biblioteca["dt_envio"])); ?></h5>
                    </div>
                    <img id="bt_download" src="<?php echo substr($url, 0, strpos($url, "biblioteca") + 10) ?>/img/download_icon.png" />
                </div>
            </div>
            <div id="div_previewArquivo">
                <?php switch($tipoEncontrado){
                    case "code":
                    $code = true;
                    case "txt":
                    $f = fopen("lib_aluno/" . $arquivo, "r");
                    if(!$f) arquivoNaoLido();
                    else{
                        $read = fread($f, filesize("lib_aluno/" . $arquivo));
                        $read = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $read);
                        fclose($f);

                        if(isset($code) && $code){
                            switch(substr($arquivo, strrpos($arquivo, ".")+1)){
                                case "js":
                                $read = str_replace("\"", "<font color=\"#FFAA00\" >\"</font>", $read);
                                                //$read = str_replace("\'", "<font color=\"#FFAA00\" >\'</font>", $read);

                                $read = str_replace("var ", "<font color=\"#0000FF\" >var </font>", $read);

                                $read = str_replace("if(", "<font color=\"#FF00FF\" >if</font>(", $read);
                                $read = str_replace("if (", "<font color=\"#FF00FF\" >if</font> (", $read);
                                $read = str_replace("else ", "<font color=\"#FF00FF\" >else</font> ", $read);
                                $read = str_replace("{", "<font color=\"#FF00FF\" >{</font>", $read);
                                $read = str_replace("}", "<font color=\"#FF00FF\" >}</font>", $read);

                                $read = str_replace("for(", "<font color=\"#FF00FF\" >for</font>(", $read);
                                $read = str_replace("for (", "<font color=\"#FF00FF\" >for</font> (", $read);
                                $read = str_replace("while(", "<font color=\"#FF00FF\" >while</font>(", $read);
                                $read = str_replace("while (", "<font color=\"#FF00FF\" >while</font> (", $read);

                                $read = str_replace("+", "<font color=\"#0000FF\" >+</font>", $read);
                                                //$read = str_replace("!=", "<font color=\"#FF00FF\" >!=</font>", $read);
                                                //$read = str_replace("==", "<font color=\"#FF00FF\" >==</font>", $read);
                                                //$read = str_replace(">=", "<font color=\"#FF00FF\" >&gt;=</font>", $read);
                                                //$read = str_replace(">", "<font color=\"#FF00FF\" >&gt;</font>", $read);
                                                //$read = str_replace("<=", "<font color=\"#FF00FF\" >&lt;=</font>", $read);
                                                //$read = str_replace("<", "<font color=\"#FF00FF\" >&lt;</font>", $read);

                                $read = str_replace("true", "<font color=\"#CC7A00\" >true</font>", $read);
                                $read = str_replace("false", "<font color=\"#CC7A00\" >false</font>", $read);
                                $read = str_replace("null", "<font color=\"#777777\" >null</font>", $read);

                                $read = str_replace("break;", "<font color=\"#0000FF\" >break;</font>", $read);
                                $read = str_replace("return", "<font color=\"#0000FF\" >return</font>", $read);
                                $read = str_replace("function", "<font color=\"#0000FF\" >function</font>", $read);
                                break;
                                case "css":
                                break;
                                case "html":
                                case "htm":
                                break;
                                case "php":
                                break;
                                case "c":
                                break;
                                case "h":
                                break;
                                case "cs":
                                break;
                                case "cpp":
                                break;
                                case "java":
                                break;
                                case "py":
                                break;
                            }
                        } ?>
                        <p><?php echo str_replace("\n", "<br>", $read); ?></p>
                    <?php }
                    break;
                    case "img":
                    break;
                    case "pdf":
                    $f = fopen("lib_aluno/$arquivo", "rb");
                    $read = fread($f, filesize("lib_aluno/$arquivo"));
                    fclose($f);
                    ?>
                    <iframe id="iframe_previewPDF" type="application/pdf" height="100%" width="100%" frameborder="0" ></iframe>
                    <script class="tempScript">
                        var div_preview = document.getElementById("div_previewArquivo"),
                        iframe_preview = document.getElementById("iframe_previewPDF");

                        iframe_preview.src = getTmpUrl("<?php echo base64_encode($read); ?>", "application/pdf");
                        iframe_preview.contentDocument.body.innerHTML = "<?php arquivoNaoLido() ?>";
                        div_preview.style.overflow = "hidden";

                        iframe_preview.addEventListener("load", function(){
                            switch(UANAV){
                                case "Mozilla Firefox":
                                    div_preview.style.backgroundColor = "#3E3E3E";
                                    break;
                                case "Chrome":
                                    div_preview.style.backgroundColor = "#525659";
                                    break;
                                case "Edge":
                                default:
                                    if (this.contentDocument != null) div_preview.style.backgroundColor = this.contentDocument.getElementsByTagName("html")[0].style.backgroundColor || this.contentDocument.getElementsByTagName("body")[0].style.backgroundColor;
                                    else div_preview.style.backgroundColor = "#3E3E3E";
                                    break;
                            }
                        });
                    </script>
                    <?php
                    break;
                    case "ppt":
                    case "xls":
                    case "doc":
                    case "noneType":
                    default:
                    arquivoNaoLido();
                    break;
                } ?>
            </div>
            <?php if(isset($_SESSION["aluno"])) echo "</div></div></div></div>"; ?>
            <script class="tempScript">
                var bt_download = document.getElementById("bt_download");

                bt_download.addEventListener("click", function(){
                    //location.href += "/download";
                    open(location.href + "/download", "_blank");
                });
            </script>
            <script class="tempScript">
                function tmpResizeF(e){
                    var div_info = document.getElementById("div_previewArquivo");
                    var a = Math.abs(window.innerHeight - 420);
                    
                    div_info.style.height = (parseInt(a) + 20) + "px";
                }
                
                addEventListener("resize", function(e){
                    tmpResizeF(e);
                });
                
                tmpResizeF();
            </script>
            <?php
        }else if(!empty($query_gpBiblioteca)){ getMenu(3); ?>
            <style>
                .div_grupoBiblioteca{
                    margin-left: 80px !important;
                }
            </style>
            <div style="margin-bottom: 150px;">
                <button id="bt_voltar" style="background-color: #FFF;">
                    <font style="top: 12px; font-size: 50pt; margin-right: 22px; position: relative;">&lt;</font>Voltar
                </button>
            </div>
            <?php
            $tipos_icones = getTipoIcones();

            $pasta = "";
            while($res = mysqli_fetch_assoc($query_gpBiblioteca)){
                $pasta = $res["pasta"];
                $tipoEncontrado = getTipoEncontrado($res["arquivo"], $tipos_icones); ?>

                <div id="div_file_<?php echo $res["token"] ?>" class="div_grupoBiblioteca" onclick="getFile(this);" >
                    <img src="<?php echo substr($url, 0, strpos($url, "biblioteca") + 10) ?>/icones/<?php echo $tipoEncontrado; ?>_icon.png" />
                    <div class="div_grupoBiblioteca_info">
                        <h3><?php echo $res["arquivo"] ?></h3>
                        <p><?php echo date("d/m/Y", strtotime($res["dt_envio"])); ?></p>
                    </div>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION["aluno"])) echo "</div></div></div></div>"; ?>
            <script>
                function getFile(el){
                    var token = el.id.replace("div_file_", ""),
                    pasta = "<?php echo $pasta; ?>";

                    
                    location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length) + "arquivo/" + pasta + "/" + token;
                    //location.href = "<?php //echo substr($url, 0, strpos($url, "biblioteca/virtual") + 18) ?>/arquivo/" + pasta + "/" + token;
                }
            </script>
        <?php }else{ getMenu(0);
            $sql = "SELECT g.id, g.titulo, g.descricao, g.icone, (
            SELECT COUNT(b.id) FROM tb_biblioteca b
            WHERE g.id=b.id_grupo) AS quant
            FROM tb_gp_biblioteca g
            WHERE id_turma=$turma";
            $query = mysqli_query($mysqli, $sql);

            if(!$query){
                ?>
                <script>
                    alert("Ocorreu um erro ao acessar o banco!");
                </script></body></html>
                <?php exit();
            }
            
            $res = mysqli_fetch_assoc($query);
            ?>
                    
            <div id="div_gruposBiblioteca">
                <?php if (mysqli_num_rows($query) < 1 || (isset($_SESSION["aluno"]) && (mysqli_num_rows($query) == 1 && $res["quant"] < 1))) echo "<h2 style=\"padding: 20px; padding-left: 50px;\">Nenhum material postado ainda!</h2>"; else do{
                    //if($res["quant"] > 0){ ?>
                        <div id="div_grupo_<?php echo $res["id"]; ?>" class="div_grupoBiblioteca" onclick="joinInGroup(this);" >
                            <img src="<?php echo substr($url, 0, strpos($url, "biblioteca") + 10) ?>/icones/<?php echo $res["icone"]; ?>_icon.png" />
                            <div class="div_grupoBiblioteca_info">
                                <h3><?php echo $res["titulo"] ?></h3>
                                <p><?php echo $res["descricao"] ?></p>
                            </div>
                            <div id="div_quantFiles"><?php echo $res["quant"]; ?></div>
                        </div>
                    <?php //}
                }while($res = mysqli_fetch_assoc($query)); ?>
            </div>
            <?php if(isset($_SESSION["aluno"])) echo "</div></div></div></div>"; ?>
            <script>
                function joinInGroup(el){
                    var id = el.id.replace("div_grupo_", ""),
                    grupo = el.getElementsByTagName("h3")[0].innerHTML;

                    location.href =  "virtual/grupo/" + grupo + "/" + id;
                }
            </script>
        <?php } ?>
        <script class="tempScript">
            var bt_voltar = document.getElementById("bt_voltar");

            if(bt_voltar != null) bt_voltar.addEventListener("click", function(){
                location.href += "/voltar";
            });
        </script>
        
        <?php if(isset($_SESSION["admin"]) || isset($_SESSION["prof"])){ ?>
            <div id="div_ctxMenu" style="display: none;">
                <ul>
                    <li id="bt_ctxAbrir" style="display:none;"><b>Abrir</b></li>
                    <!--<li id="bt_ctxEditar" style="display:none;">Editar</li>-->
                    <li id="bt_ctxRemover" style="display:none;">Remover</li>
                </ul>
            </div>
            <script>
                function removeGroup(el, s){
                    var id = el.id.replace("div_grupo_", ""),
                    grupo = el.getElementsByTagName("h3")[0].innerHTML;

                    location.href =  "virtual/grupo/" + grupo + "/" + id + "/remover/" + s;
                }
                
                function removeFile(el, s){
                    var token = el.id.replace("div_file_", ""),
                    pasta = "<?php echo @$pasta; ?>";

                    location.href = location.href.substring(0, location.href.indexOf("biblioteca/virtual/") + "biblioteca/virtual/".length) + "arquivo/" + pasta + "/" + token + "/remover/" + s;
                    //location.href = "<?php //echo substr($url, 0, strpos($url, "biblioteca/virtual") + 18) ?>/arquivo/" + pasta + "/" + token + "/remover/" + s;
                }
            </script>
            <script src="/biblioteca/js/animationManager.js" ></script>
            <script class="tempScript">
                //Controle do menu
                var div_biblioteca = document.getElementsByClassName("div_grupoBiblioteca");
                var div_ctxMenu = document.getElementById("div_ctxMenu");

                for(var a=0; a<div_biblioteca.length; a+=1){
                    if (div_biblioteca[a] != null){
                        div_biblioteca[a].addEventListener("contextmenu", function(e){
                            e.preventDefault();
                            
                            div_ctxMenu.style.left = (e.pageX) + "px";
                            div_ctxMenu.style.top = (parseInt(e.pageY)) + "px";
                            
                            div_ctxMenu.style.display = "none";
                            bt_ctxAbrir.style.display = "none";
                            //bt_ctxEditar.style.display = "none";
                            bt_ctxRemover.style.display = "none";
                            
                            setTimeout(function(){
                                div_ctxMenu.style.display = "block";
                            }, 50);
                            
                            var target = this;
                            
                            var id, tipo;
                            
                            if (target.id.indexOf("div_grupo_") > -1){
                                id = target.id.replace("div_grupo_", "");
                                tipo = "grupo";
                            }else{
                                id = target.id.replace("div_file_", "");
                                tipo = "arquivo";
                            }
                            
                            var grupo = target.getElementsByTagName("h3")[0].innerHTML;
                            
                            div_ctxMenu.setAttribute("targetId", id);
                            div_ctxMenu.setAttribute("targetName", grupo);
                            div_ctxMenu.setAttribute("targetType", tipo);
                        }, false);
                    }
                }
                
                //Esconder menu quando clicar com o mouse
                document.addEventListener("click", function(){
                    div_ctxMenu.style.display = "none";
                    bt_ctxAbrir.style.display = "none";
                    //bt_ctxEditar.style.display = "none";
                    bt_ctxRemover.style.display = "none";
                }, false);
                
                if(parent != null) parent.document.addEventListener("click", function(){
                    div_ctxMenu.style.display = "none";
                    bt_ctxAbrir.style.display = "none";
                    //bt_ctxEditar.style.display = "none";
                    bt_ctxRemover.style.display = "none";
                }, false);
                
                //Eventos de clique do menu
                var bt_ctxAbrir = document.getElementById("bt_ctxAbrir"),
                    //bt_ctxEditar = document.getElementById("bt_ctxEditar"),
                    bt_ctxRemover = document.getElementById("bt_ctxRemover");
                
                bt_ctxAbrir.addEventListener("click", function(e){
                    div_ctxMenu.style.display = "none";
                    bt_ctxAbrir.style.display = "none";
                    //bt_ctxEditar.style.display = "none";
                    bt_ctxRemover.style.display = "none";
                    
                    var id = div_ctxMenu.getAttribute("targetId"),
                        grupo = div_ctxMenu.getAttribute("targetName"),
                        tipo = div_ctxMenu.getAttribute("targetType");
                    
                    if(tipo == "grupo") joinInGroup(document.getElementById("div_grupo_" + id));
                    else getFile(document.getElementById("div_file_" + id));
                }, false);
                
                /*
                bt_ctxEditar.addEventListener("click", function(e){
                    div_ctxMenu.style.display = "none";
                    //bt_ctxEditar.style.display = "none";
                    bt_ctxRemover.style.display = "none";
                    
                    var id = div_ctxMenu.getAttribute("targetId"),
                        grupo = div_ctxMenu.getAttribute("targetName"),
                        tipo = div_ctxMenu.getAttribute("targetType");
                    
                }, false);
                */
                
                bt_ctxRemover.addEventListener("click", function(e){
                    div_ctxMenu.style.display = "none";
                    bt_ctxAbrir.style.display = "none";
                    //bt_ctxEditar.style.display = "none";
                    this.style.display = "none";
                    
                    var id = div_ctxMenu.getAttribute("targetId"),
                        grupo = div_ctxMenu.getAttribute("targetName"),
                        tipo = div_ctxMenu.getAttribute("targetType");
                    
                    var senha = prompt("Tem certeza que quer remover esse " + tipo + "?\n"
                                +      "Essa alteração não pode ser desfeita!\n"
                                +      "Insira sua senha se tiver certeza:");
                    
                    if (senha != null){
                        if(senha.trim() == ""){
                            alert("Senha invalida!");
                            return;
                        }
                        
                        if(tipo == "grupo") removeGroup(document.getElementById("div_grupo_" + id), btoa(senha));
                        else removeFile(document.getElementById("div_file_" + id), btoa(senha));
                    }
                }, false);
                
                //Eventos para transições
                createEventListener(div_ctxMenu, "animationend", function(e){
                    bt_ctxAbrir.style.display = "block";
                }, false);
                
                createEventListener(bt_ctxAbrir, "animationend", function(e){
                    //bt_ctxEditar.style.display = "block";
                    bt_ctxRemover.style.display = "block";
                }, false);
                
                /*
                createEventListener(bt_ctxEditar, "animationend", function(e){
                    bt_ctxRemover.style.display = "block";
                }, false);
                */
            </script>
        <?php } ?>
        <script class="tempScript">
            //Prevenir padrão do clique direito do mouse
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        </script>
        <?php if(isset($_SESSION["aluno"])) { ?>
            <script src="<?php echo @$linkRedirect ?>../../js/popper.min.js"></script>
            <script src="<?php echo @$linkRedirect ?>../../js/jquery.min.js"></script>
            <script src="<?php echo @$linkRedirect ?>../../js/bootstrap.js"></script>
        <?php } ?>
        <script src="/biblioteca/js/apagar_scripts.js" class="tempScript" ></script>
        <script>
            if(typeof(String.prototype.trim) === "undefined") {
                String.prototype.trim = function() {
                    return String(this).replace(/^\s+|\s+$/g, '');
                };
            }
        </script>
    </body>
</html>