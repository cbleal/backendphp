<?php 

/*
* Faz a verificação do login do usuário, caso ele não esteja, o programa
* redireciona para a página inicial index e aborta o fluxo.
*/

session_start();

if (!isset($_SESSION['usuario'])) {
	header("Location: index.php");
	exit;
}

?>