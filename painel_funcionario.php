<?php 

/* Mostra o nome do usu�rio logado. */

require 'verificar_login.php';

?>

<h1>Painel do Funcionario</h1>
<!-- recupera o par�metro nome_usuario da sess�o -->
<h3><?php echo "Usu�rio: ".$_SESSION['nome_usuario']; ?></h3>
<!-- recupera o par�metro cargo_usuario da sess�o -->
<h3><?php echo "Cargo: ".$_SESSION['cargo_usuario']; ?></h3>
<!-- link para p�gina logout -->
<a href="logout.php">Sair</a>