<?php
if(!isset($_SESSION['aluno']) || !isset($_SESSION["token"])){ ?>
    <script>
        alert("Erro 01!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if (strpos($_SESSION["token"], "alunoY30") != 0){ ?>
    <script>
        alert("Erro 02!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if(strlen(str_replace("alunoY30", "", $_SESSION["token"])) != 21 ){ ?>
    <script>
        alert("Erro 03!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if($_SESSION['aluno'] != md5($_SESSION["token"])){ ?>
    <script>
        alert("Erro 04!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }

if(!isset($mysqli)) include "config.php";

if(!isset($_SESSION["turma"])){
    $sql = "SELECT t.tb_turma_idtb_turma FROM tb_aluno a
            JOIN tb_turma_aluno t ON a.idtb_aluno = t.tb_aluno_idtb_aluno
            WHERE tb_login_idtb_login = '" . $_SESSION['idtb_login'] . "'";
    $query = $mysqli->query($sql);
    $res = mysqli_fetch_assoc($query);

    $_SESSION["turma"] = $res["tb_turma_idtb_turma"];
}

$turma = $_SESSION["turma"];