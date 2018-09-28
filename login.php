<?php 
include "config/config.php";
include "geral.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "config/tema-top.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=1">
    <title>Anjos da Noite</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body>
    <main class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-sm-12 col-md-4 pt-1"></div>
                <div class="col-sm-12 col-md-4 text-center">
                    <a class="blog-header-logo text-dark" href="index.php"><img src="img/logo.png" width="215px" alt=""></a>
                </div>
                <div class="col-sm-12 col-md-4 d-flex justify-content-end align-items-center">
                </div>
            </div>
        </header>
        <hr>
        <div class="nav-scroller py-1 mb-2">
            <ul class="nav d-flex justify-content-between">
                <a class="p-2 text-muted active" href="../">inicio</a>
                <a class="p-2 text-muted" href="sobre.php">sobre</a>
                <a class="p-2 text-muted" href="curso/">cursos</a>
                <a class="p-2 text-muted" href="servico.php">serviços</a>
                <a class="p-2 text-muted" href="galeria.php">galeria</a>
                <a class="p-2 text-muted" href="contato.php">contato</a>
                <a class="p-2 text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"" href="contato.php"><i class="fas fa-lock"></i>Login</a>
                <form action="login.php" method="post" class="dropdown-menu p-4">
                    <div class="form-group">
                        <label for="exampleDropdownFormEmail2">Email<em>*</em></label>
                        <input type="email" class="form-control" name="email" id="exampleDropdownFormEmail2" placeholder="email@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleDropdownFormPassword2">Senha<em>*</em></label>
                        <input type="password" class="form-control" name="senha" id="exampleDropdownFormPassword2" placeholder="Password">
                    </div>
                    <button type="submit" name="login" value="login" class="btn btn-danger">Entrar</button>
                </form>
            </ul>
        </div>
        <hr>
    </main>
    <section class="contato-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3"></div>
                <div class="col-sm-12 col-md-6">
                    <?php 

                    if (isset($_POST['login'])) {

                        $senha = sha1(md5($_POST['senha']));


                        $email = $mysqli->query("SELECT idtb_login FROM tb_login WHERE email ='".$_POST['email']."'") or die($mysqli->error);
                            //$e = $email->fetch_assoc()['email'];

                            if ($email->num_rows > 0){ //if ($e == $_POST['email']) {

                                $sql = $mysqli->query("SELECT idtb_login, email, tipo FROM tb_login WHERE email ='".$_POST['email']."' AND senha ='$senha'") or die($mysqli->error);
                                $s = $sql->num_rows;


                                if ($s >= 1) {

                                    session_start();

                                    $a = $sql->fetch_assoc();
                                    
                                    switch($a['tipo']){
                                        case 1:
                                        $_SESSION['idtb_login'] = $a['idtb_login'];
                                        $_SESSION['email'] = $a['email'];
                                        $_SESSION["token"] = "adminT01" . getToken(20);
                                        $_SESSION['admin'] = md5($_SESSION["token"]);
                                                //$_SESSION['senha'] = $a['senha'];

                                        header("Location: adm/");
                                        break;
                                        case 2:
                                        $_SESSION['idtb_login'] = $a['idtb_login'];
                                        $_SESSION['email'] = $a['email'];
                                        $_SESSION["token"] = "professorX2" . getToken(20);
                                        $_SESSION['prof'] = md5($_SESSION["token"]);

                                        header("Location: professor/");
                                        break;
                                        case 3:
                                            //aluno
                                        $_SESSION['idtb_login'] = $a['idtb_login'];
                                        $_SESSION['email'] = $a['email'];
                                        $_SESSION["token"] = "alunoY30" . getToken(20);
                                        $_SESSION['aluno'] = md5($_SESSION["token"]);
                                        header("Location: adm/profile/");

                                        break;
                                        default:
                                        break;
                                    }
                                }
                                else{
                                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Error!</strong> Senha incorreta!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }
                            }else{
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error!</strong> Não Existe usuário com esse E-mail cadastrado!
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                        }
                        ?>
                        <h3 class="text-center">Login</h3>
                        <form action="" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label for="Nome">Login<em>*</em></label>
                                    <input type="email" class="form-control" name="email" placeholder="Entre com seu e-mail" value="<?php echo @$_POST['email']; ?>" required>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label for="E-mail">Senha<em>*</em></label>
                                    <input type="password" class="form-control" name="senha" placeholder="senha" required>
                                </div>
                                <div class="col-sm-12 col-md-8"><p><a href="" title="">Esqueci minha Senha!?</a></p></div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="submit" class="btn btn-outline-secondary form-control" name="login" value="login">Entrar</button>
                                </div>
                            </div>
                        </form>					
                    </div>	
                    <div class="col-sm-12 col-md-3"></div>	
                </div>
            </div>
        </section>

        <script src="js/popper.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script class="tempScript" src="../js/apagar_scripts.js"></script>
    </body>
    </html>