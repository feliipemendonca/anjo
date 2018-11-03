<?php

include "config.php";

session_start();

if (!isset($_SESSION['email']) and !isset($_SESSION['senha'])) {
	
	session_destroy();

	unset($_SESSION['email']);
	unset($_SESSION['senha']);

	echo "<script type='text/javascript'>alert('Por favor, faça o login.');location.href='/login.php';</script>";


}?>