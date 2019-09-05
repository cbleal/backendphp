<?php 

// inicia a sessуo
session_start(); 
// fecha a sessуo
session_destroy();

// redireciona para pсgina index
header("Location: index.php");
// encerra a operaчуo
exit;

?>