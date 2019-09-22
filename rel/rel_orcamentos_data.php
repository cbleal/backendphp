<?php 

// recupera a configuração de acesso ao banco de dados
require '../conexao.php';

// pegar os parâmetros passados por GET (rel_orcamentos_data_class.php)

$dataInicial = $_GET['dataInicial'];
$dataFinal 	 = $_GET['dataFinal'];
$status 	 = $_GET['status'];	

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Relatório de Orçamento</title>
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
			<!--<div class="col-sm-5 figura">	
			  <img src="../img/amarVotebd.png" width="250px">
			</div>-->
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
			<!--<div class="col-sm-6">
				<big><big> RELATÓRIO DE ORÇAMENTOS  </big> </big>
			</div>-->
			<div class="col-sm-6">
				<small>
					<?php 
						if ($status == 'Todos'){
							echo 'Todos os Orçamentos';
						} else {
							echo 'Orçamentos com Status de: '.$status;
						}
				 	?>				 	
				 </small>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">	
				
			</div>
			<div class="col-sm-6">	
				<small>
					<b>Data Inicial:</b> <?php echo date('d/m/Y', strtotime($dataInicial)); ?> 
					<b>Data Final:</b> <?php echo date('d/m/Y', strtotime($dataFinal)); ?>
				</small>
			</div>
		</div>

		<hr>
		<br>

		<?php 

			$total_orc = 0;
			$quant = 0;
			$quant_aguardando = 0;
			$quant_abertos = 0;
			$quant_cancelados = 0;
			$quant_aprovados = 0;

			if ( $status != 'Todos' ) {   // SE ESCOLHER O STATUS

				$query = "SELECT o.id, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.data_aprovacao, o.status, c.nome as cli_nome, f.nome as func_nome FROM orcamentos o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios as f ON f.id = o.tecnico WHERE o.data_abertura BETWEEN '{$dataInicial}' AND '{$dataFinal}' AND o.status = '{$status}' ORDER BY o.data_abertura";

			} else { // SENÃO

				$query = "SELECT o.id, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.data_aprovacao, o.status, c.nome as cli_nome, f.nome as func_nome FROM orcamentos o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios as f ON f.id = o.tecnico WHERE o.data_abertura BETWEEN '$dataInicial' AND '$dataFinal' ORDER BY o.data_abertura";
			}

			$result = mysqli_query($conexao, $query);

			?>

			<table class="table">
				<tr bgcolor="#f9f9f9">
					<td style="font-size:12px"> <b>Cliente</b> </td>
					<td style="font-size:12px"> <b>Data Abertura</b> </td>
					<td style="font-size:12px"> <b>Data Geração</b> </td>
					<td style="font-size:12px"> <b>Data Aprovação</b> </td>
					<td style="font-size:12px"> <b>Status</b> </td>
					<td style="font-size:12px"> <b>Valor R$</b> </td>
				</tr>

			<?php
			while ($row = mysqli_fetch_assoc($result)) {

				$data_abertura = implode('/', array_reverse(explode('-', $row['data_abertura'])));
				$data_geracao = implode('/', array_reverse(explode('-', $row['data_geracao'])));
				$data_aprovacao = implode('/', array_reverse(explode('-', $row['data_aprovacao'])));

				$total_orc += $row['valor_total'];				
                $quant += 1;

                if($row['status'] == 'Aberto'){
                    $quant_abertos += 1;
                }

                if($row['status'] == 'Aguardando'){
                    $quant_aguardando += 1;
                }
                         
                if($row['status'] == 'Cancelado'){
                    $quant_cancelados += 1;
                }
                         
                if($row['status'] == 'Aprovado'){
                    $quant_aprovados += 1;
                }                         

				?>

			<tr>
				<td style="font-size:12px"> <?php echo $row['cli_nome']; ?> </td>
				<td style="font-size:12px"> <?php echo $data_abertura; ?> </td>
				<td style="font-size:12px"> <?php echo $data_geracao; ?> </td>
				<td style="font-size:12px"> <?php echo $data_aprovacao; ?> </td>
				<td style="font-size:12px"> <?php echo $row['status']; ?> </td>
				<td style="font-size:12px"> <?php echo number_format($row['valor_total'], 2, ',', '.'); ?> </td>	
			</tr>

			<?php } ?>
		</table>

	

		<hr><br><br>

		<?php 

			if ($status == 'Todos'):
				?>

				<div class="row">
					<div class="col-sm-6">

					</div>
					<div class="col-sm-4 areaTotais">
						<p class="pgto" style="font-size:12px">  
							<b>Orçamentos Aguardando: </b> 
							<?php echo $quant_aguardando; ?> 
						</p>
						<p class="pgto" style="font-size:12px">  
							<b>Orçamentos Abertos: </b> 
							<?php echo $quant_abertos; ?> 
						</p>
						<p class="pgto" style="font-size:12px">  
							<b>Orçamentos Aprovados: </b> 
							<?php echo $quant_aprovados; ?> 
						</p>
						<p class="pgto" style="font-size:12px">  
							<b>Orçamentos Cancelados: </b> 
							<?php echo $quant_cancelados; ?> 
						</p>			
					</div>

				</div>

		<?php else:
			?>
			<div class="row">
				<div class="col-sm-8">	
								
				</div>
				<div class="col-sm-4 areaTotais">				
					 <p class="pgto" style="font-size:16px">  
					 	<b>Valor Total: </b> R$ 
					 	<?php echo number_format($total_orc, 2, ',', '.'); ?> 
					 </p>
					 <p style="font-size:16px">  
						<b>Qtde de Orçamentos: </b> 
						<?php echo $quant; ?> 
					</p>					
				</div>
			</div>

		<?php endif ?>		

	</div>
	<!-- Fim Div Container  -->

	

	<div class="footer">
 		<p style="font-size:12px" align="center">Desenvolvido por Claudinei B Leal - CBLInf</p> 
	</div>

	<!-- Div Footer 
	<div class="footer">
 		<p style="font-size:14px" align="center">
 			Desenvolvido por CBL_Inf - Micropoint
 		</p> 
	</div>
	Fim Div Footer  -->
	
</body>
</html>



