<header>
    <ul class="icons">
        <li><a href="" title=""><i class="fab fa-facebook"></i></a></li>
        <li><a href="" title=""><i class="fab fa-instagram"></i></a></li>
        <li><a><i class="fas fa-envelope"></i> anjosdanoite@anjosdanoite.com </a></li>
    </ul>           
    <!--<p class="text-right"><a href="login.php" title=""><i class="fas fa-user-lock"></i>Login</a></p>-->
</header>
<nav class="navbar-expand-lg">
    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">sobre</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="curso/">curso</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">serviços</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">galeria</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">contato</a>
            </li>
            <li class="nav-item">
                <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-lock"></i>login
                    </button>
                    <form action="login.php" method="post" class="dropdown-menu p-4">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail2">Email<em>*</em></label>
                            <input type="email" class="form-control" name="email" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword2">Senha<em>*</em></label>
                            <input type="password" class="form-control" name="senha" id="exampleDropdownFormPassword2" placeholder="Password">
                        </div>
                        <button type="submit" name="login" value="login" class="btn btn-danger">Entrar</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>