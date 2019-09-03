<?php 

require 'conexao.php';

if ( empty($_POST['email']) || empty($_POST['password']) ) {
	header("Location: index.php");
	exit;
}

?>

<h1>Logado com sucesso !!!</h1>