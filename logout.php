<?php 

// inicia a sess�o
session_start(); 
// fecha a sess�o
session_destroy();

// redireciona para p�gina index
header("Location: index.php");
// encerra a opera��o
exit;

?>