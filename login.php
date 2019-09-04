<?php 

session_start();

require 'conexao.php';

// se os campos do formulario login estiverem vazios:
if ( empty($_POST['usuario']) || empty($_POST['senha']) ) {
	// � redirecionado para a p�gina inicial index
	header("Location: index.php");
	exit;
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha   = mysqli_real_escape_string($conexao, $_POST['senha']);

// sql que verifica se existe um usuario no banco com esses dados:
$query = "SELECT * FROM usuarios 
			WHERE usuario = '{$usuario}'
			AND senha = '{$senha}'";
// resultado da consulta:
$result = mysqli_query($conexao, $query);
// popula a vari�vel row com as informa��es
$row = mysqli_num_rows($result);
// se tiver dados
if ($row > 0) {
	// adiciona os dados � vari�vel
	$dados = mysqli_fetch_array($result);
	// adiciona na sess�o
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome_usuario'] = $dados['nome'];
	$_SESSION['cargo_usuario'] = $dados['cargo'];
	header("Location: painel_admin.php");
	exit;
} else { // do contr�rio...
	$_SESSION['nao_autenticado'] = true;
	header("Location: index.php");
	exit;
}

?>

