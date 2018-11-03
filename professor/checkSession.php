<?php
if(!isset($_SESSION['prof']) || !isset($_SESSION["token"])){ ?>
    <script>
        alert("Erro 01!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if (strpos($_SESSION["token"], "professorX2") != 0){ ?>
    <script>
        alert("Erro 02!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if(strlen(str_replace("professorX2", "", $_SESSION["token"])) != 21 ){ ?>
    <script>
        alert("Erro 03!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if($_SESSION['prof'] != md5($_SESSION["token"])){ ?>
    <script>
        alert("Erro 04!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }

if(@$turma = $_GET["turma"]){
   if ($turma > 0){
       $_SESSION["turma"] = $turma;
       if(@$redURL = $_GET["redURL"]) header("location: $redURL");
       else header("location: ?");
   }else {
       $_SESSION["turma"] = null;
       header("location: ?");
   }
}

@$turma = $_SESSION["turma"];