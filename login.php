<?php 

// inicia uma sess�o
session_start();

// inclui o arquivo conexao.php
require 'conexao.php';

// cancelar or�amentos ap�s 5 dias de gerados
$data_cancelamento = date('Y/m/d', strtotime("-7 days", strtotime(date("Y/m/d")))); // data atual - 7 dias
$query  = "SELECT * FROM orcamentos WHERE status = 'Aguardando'";
$result = mysqli_query($conexao, $query);
while ($row = mysqli_fetch_assoc($result)) {
 	$query = "UPDATE orcamentos SET status = 'Cancelado' WHERE data_geracao = '{$data_cancelamento}' ";
 	$result = mysqli_query($conexao, $query);
} 

// se os campos do formulario login estiverem vazios:
if ( empty($_POST['usuario']) || empty($_POST['senha']) ) {
	// redireciona para a p�gina inicial index
	header("Location: index.php");
	// aborta a opera��o
	exit;
}

// cria vari�veis e associa aos valores capturados do formul�rio
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha   = mysqli_real_escape_string($conexao, $_POST['senha']);

// sql que verifica se existe um usuario no banco com esses dados:
$query = "SELECT * FROM usuarios 
		  WHERE usuario = '{$usuario}'
		  AND senha = '{$senha}'";

// resultado da consulta:
$result = mysqli_query($conexao, $query);

// popula a vari�vel $row com as informa?es
$row = mysqli_num_rows($result);

// se tiver dados
if ($row > 0) {
	// adiciona os dados ?vari?el
	$dados = mysqli_fetch_assoc($result);
	// adiciona na sess�o
	$_SESSION['usuario'] = $usuario;
	$_SESSION['id_funcionario'] = $dados['id_funcionario'];
	$_SESSION['nome_usuario'] = $dados['nome'];
	$_SESSION['cargo_usuario'] = $dados['cargo'];

	//verificacao do tipo de cargo para redirecionamento de p�gina
	if ( $_SESSION['cargo_usuario'] == 'Administrador' || 
		 $_SESSION['cargo_usuario'] == 'Gerente' ) {
		
		// redireciona para a p�gina
		header("Location: painel_admin.php");
		exit;		
	}
	if ( $_SESSION['cargo_usuario'] == 'Tesoureiro' ) {
		
		// redireciona para a p�gina
		header("Location: painel_tesouraria.php");
		exit;		
	}
	if ( $_SESSION['cargo_usuario'] == 'Funcionario' ) {
		
		// redireciona para a p�gina
		header("Location: painel_funcionario.php");
		exit;		
	}

	
} else { // do contr�rio...
	$_SESSION['nao_autenticado'] = true;
	header("Location: index.php");
	exit;
}

?>

