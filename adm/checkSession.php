<?php
if(!isset($_SESSION['admin']) || !isset($_SESSION["token"])){ ?>
    <script>
        alert("Erro 01!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if (strpos($_SESSION["token"], "adminT01") != 0){ ?>
    <script>
        alert("Erro 02!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if(strlen(str_replace("adminT01", "", $_SESSION["token"])) != 21 ){ ?>
    <script>
        alert("Erro 03!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }else if($_SESSION['admin'] != md5($_SESSION["token"])){ ?>
    <script>
        alert("Erro 04!\nSeu login não tem permissões para acessar essa pagina!")
        location.href = "/config/logout.php";
    </script>
<?php }