<?php 

define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', 'wsbcbl');
define('BD', 'systec');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, BD) 
			or die('Não conectou!');

?>