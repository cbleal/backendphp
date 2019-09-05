<?php 

/* Fun��o: Mostra o nome do usu�rio logado. */

// inclui o arquivo
require 'verificar_login.php';

// verifica��o de cargo logado
if ( $_SESSION['cargo_usuario'] != 'Administrador' && 
		 $_SESSION['cargo_usuario'] != 'Gerente' ) {
		
		// redireciona para a p�gina
		header("Location: index.php");
		exit;		
}


?>

<h1>Painel do Administrador</h1>
<!-- recupera o par�metro nome_usuario da sess�o -->
<h3><?php echo "Usu�rio: ".$_SESSION['nome_usuario']; ?></h3>
<!-- recupera o par�metro cargo_usuario da sess�o -->
<h3><?php echo "Cargo: ".$_SESSION['cargo_usuario']; ?></h3>
<!-- link para p�gina logout -->
<a href="logout.php">Sair</a>