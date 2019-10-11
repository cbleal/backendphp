<?php 

//definição de variáveis globais com informações para conexão com o banco
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BD', 'systec');

//variável de conexão MySQL
$conexao = mysqli_connect(HOST, USUARIO, SENHA, BD) 
			or die('Não conectou!');	

// função para formatar data
function fmtData( $data ) 
{
	return date( 'd/m/Y', strtotime( $data ) );
}		

?>