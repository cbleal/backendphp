<?php 

// recupera a configuração de acesso ao banco de dados
require '../conexao.php';

// pegar o parâmetro id passado por GET
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$query = "SELECT o.id, o.produto, o.serie, o.problema, o.laudo, o.valor_servico, o.pecas, o.valor_pecas, o.desconto, o.valor_total, ord.id, ord.id_orc, ord.data_abertura, ord.data_fechamento, c.nome as cli_nome, c.telefone, c.endereco, c.email, c.cpf, f.nome as func_nome FROM orcamentos o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios as f ON f.id = o.tecnico INNER JOIN os AS ord ON ord.id_orc = o.id WHERE ord.id = '{$id}'";

$result = mysqli_query($conexao, $query);
if ($result) {
	$row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Relatório de Ordem de Serviço</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<style>

	 @page {
	            margin: 0px;

	        }

	.footer {
	    position:absolute;
	    bottom:0;
	    width:100%;
	    background-color: #ebebeb;
	    padding:10px;
	}

	.cabecalho {    
	    background-color: #ebebeb;
	    padding-top:15px;
	    margin-bottom:15px;
	}

	.titulo{
		margin:0;
	}

	.areaTotais{
		border : 0.5px solid #bcbcbc;
		padding: 15px;
		border-radius: 5px;
		margin-right:25px;
	}

	.areaTotal{
		border : 0.5px solid #bcbcbc;
		padding: 15px;
		border-radius: 5px;
		margin-right:25px;
		background-color: #f9f9f9;
		margin-top:2px;
	}

	.pgto{
		margin:1px;
	}

	.figura {
		
	}

	</style>

</head>

<body>

	<!-- Div cabecalho  -->
	<div class="cabecalho">
		
		<div class="row">
			<div class="col-sm-5 figura">	
			  <img src="../img/amarVotebd.png" width="250px">
			</div>
			<div class="col-sm-7">	
				<h3 class="titulo">
			 		<b>Micropoint - Assistência Técnica</b>
			 	</h3>
			 	<h6 class="titulo">
			 		www.micropointinformatica.com.br
			 	</h6>
			</div>
		</div>

	</div>
	<!-- Fim Div cabecalho  -->

	<!-- Div Container  -->
	<div class="container">
		
		<div class="row">
			<div class="col-sm-8">	
				<big> Orçamento Nº <?php echo $id ?>  </big>
			</div>
			<div class="col-sm-4">	
				<big> Data: <?php echo date('d/m/Y', strtotime($row['data_fechamento'])); ?> </big>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-sm-12">
				<p style="font-size:16px"><b>Dados do Cliente:</b></p>
			</div>			
		</div>

		<div class="row">
			<div class="col-sm-3">	
				<p style="font-size:16px">
					Nome: <?php echo $row['cli_nome']; ?>	
				</p>
			</div>
			<div class="col-sm-3">	
				<p style="font-size:16px">
				 	Email: <?php echo $row['email']; ?>
				 </p>
			</div>
			<div class="col-sm-3">	
				<p style="font-size:16px">
					Endereço: <?php echo $row['endereco']; ?>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">	
				<p style="font-size:16px">
					Telefone: <?php echo $row['telefone']; ?> 
				</p>
			</div>
			<div class="col-sm-3">	
				<p style="font-size:16px">  
					CPF: <?php echo $row['cpf']; ?> 
				</p>
			</div>	
		</div>

		<hr>

		<div class="row">
			<div class="col-sm-12">
				<p style="font-size:16px"> 
					<b> Dados do Aparelho </b> 
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">	
				<p style="font-size:16px">  
					Produto: <?php echo $row['produto']; ?> 
				</p>
			</div>
			<div class="col-sm-3">	
				<p style="font-size:16px">  
					Nº Série: <?php echo $row['serie']; ?> 
				</p>
			</div>
			<div class="col-sm-3">	
				<p style="font-size:16px">  
					Modelo: XHPER 
				</p>
			</div>				
		</div>

		<div class="row">
			<div class="col-sm-12">	
				<p style="font-size:16px">  
					Defeito: <?php echo $row['problema']; ?> 
				</p>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-sm-12">
				<p style="font-size:16px"> 
					<b> Laudo Técnico </b> 
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">	
				<p style="font-size:16px"> 
					<?php echo $row['laudo']; ?>  
				</p>
			</div>
		</div>

		<br>

		<table class="table">
			<tr bgcolor="#f9f9f9">
				<td> <b>Peça</b> </td>
				<td> <b>Valor da Peça</b> </td>
				<td> <b> Quantidade</b> </td>
				
			</tr>
			<tr>
				<td> <?php echo $row['pecas']; ?> </td>
				<td> <?php echo number_format($row['valor_pecas'], 2, ',', '.'); ?> </td>
				<td> 1 </td>
				
			</tr>
		</table>

		<hr><br><br>

		<div class="row">
			<div class="col-sm-6">

			</div>
			<div class="col-sm-4 areaTotais">
				<p class="pgto" style="font-size:16px">  
					<b>Total de Peças: </b> R$ 
					<?php echo number_format($row['valor_pecas'], 2, ',', '.'); ?> 
				</p>
				<p class="pgto" style="font-size:16px">  
					<b>Total Mão de Obra: </b> R$ 
					<?php echo number_format($row['valor_servico'], 2, ',', '.'); ?> 
				</p>
				<p class="pgto" style="font-size:16px">  
					<b>Desconto: </b> R$ 
					<?php echo number_format($row['desconto'], 2, ',', '.'); ?> 
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">	
				<p style="font-size:16px">  
					<b>Técnico: </b> 
					<?php echo $row['func_nome']; ?> 
				</p>				
			</div>
			<div class="col-sm-4 areaTotal">				
				 <p class="pgto" style="font-size:16px">  
				 	<b>Total a Pagar: </b> R$ 
				 	<?php echo number_format($row['valor_total'], 2, ',', '.'); ?> 
				 </p>				
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">	
				
			</div>
			<div class="col-sm-3">	
				<p style="font-size:12px">  
					Garantia válida até: 
					<?php echo date('d/m/Y', strtotime("+30 days",strtotime($row['data_fechamento']))); ?>						
				</p>
			</div>
		</div>

	</div>
	<!-- Fim Div Container  -->

	<!-- Div Footer 
	<div class="footer">
 		<p style="font-size:14px" align="center">
 			Desenvolvido por CBL_Inf - Micropoint
 		</p> 
	</div>
	Fim Div Footer  -->
	
</body>
</html>