<?php 

/* Mostra o nome do usu�rio logado. */

require 'verificar_login.php';

?>

<h1>Painel do Administrador</h1>
<h3><?php echo "Usu�rio: ".$_SESSION['nome_usuario']; ?></h3>
<a href="logout.php">Sair</a>