<?php 

/* Mostra o nome do usuário logado. */

require 'verificar_login.php';

?>

<h1>Painel do Funcionario</h1>
<!-- recupera o parâmetro nome_usuario da sessão -->
<h3><?php echo "Usuário: ".$_SESSION['nome_usuario']; ?></h3>
<!-- recupera o parâmetro cargo_usuario da sessão -->
<h3><?php echo "Cargo: ".$_SESSION['cargo_usuario']; ?></h3>
<!-- link para página logout -->
<a href="logout.php">Sair</a>