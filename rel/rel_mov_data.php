<?php 

// recupera a configuração de acesso ao banco de dados
require '../conexao.php';

// pegar os parâmetros passados por GET (rel_mov_data_class.php)

$dataInicial = $_GET['dataInicial'];
$dataFinal 	 = $_GET['dataFinal'];
$tipo	 	 = $_GET['tipo'];	

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Relatório de Movimentações</title>
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
			<div class="col-sm-12">
				<big><big> RELATÓRIO DE MOVIMENTAÇÕES  </big> </big>
			</div>			
		</div>
		<div class="row">			
			<div class="col-sm-3">
				<small>
					<?php 
						if ($tipo == 'Todas'){
							echo 'Todas as Movimentações';
						} else {
							echo 'Movimentações de '.$tipo;
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

			$total_mov 		= 0;
			$quant 			= 0;			
			$quant_entradas = 0;
			$quant_saidas 	= 0;
			$total_entradas = 0;
			$total_saidas 	= 0;
			
			if ( $tipo != 'Todas' ) {   // SE ESCOLHER O STATUS

				$query = "SELECT * FROM movimentacoes WHERE data BETWEEN '{$dataInicial}' AND '{$dataFinal}' AND tipo = '{$tipo}' ORDER BY data";

			} else { // SENÃO

				$query = "SELECT * FROM movimentacoes WHERE data BETWEEN '{$dataInicial}' AND '{$dataFinal}' ORDER BY data";
			}

			$result = mysqli_query($conexao, $query);

			?>

			<table class="table">
				<tr bgcolor="#f9f9f9">
					<td style="font-size:12px"> <b>Tipo</b> </td>
					<td style="font-size:12px"> <b>Movimento</b> </td>
					<td style="font-size:12px"> <b>Valor R$</b> </td>
					<td style="font-size:12px"> <b>Funcionário</b> </td>
					<td style="font-size:12px"> <b>Data</b> </td>	
				</tr>

				<?php
				while ($row = mysqli_fetch_assoc($result)) {	
					
					$total_mov += $row['valor'];				
	                $quant += 1;

	                if($row['tipo'] == 'Entrada'){
	                    $quant_entradas += 1;
	                    $total_entradas += $row['valor'];
	                }

	                if($row['tipo'] == 'Saida'){
	                    $quant_saidas += 1;
	                    $total_saidas += $row['valor'];
	                }               
	                
					?>

				<tr>
					<td style="font-size:12px"> <?php echo $row['tipo']; ?> </td>
					<td style="font-size:12px"> <?php echo $row['movimento']; ?> </td>
					<td style="font-size:12px"> <?php echo number_format($row['valor'], 2, ',', '.'); ?> </td>
					<td style="font-size:12px"> <?php echo $row['funcionario']; ?> </td>	
					<td style="font-size:12px"> <?php echo date('d/m/Y', strtotime($row['data'])); ?> </td>	
				</tr>

				<?php } ?>
			</table>

			<hr><br><br>

		<?php 

			if ($tipo == 'Todas'):
				?>

				<!-- Div Row 1 -->
				<div class="row">
					
					<div class="col-sm-4 areaTotais">					
						<p class="pgto" style="font-size:12px">  
							<b>Qtde Entradas: </b> 
							<?php echo $quant_entradas; ?>
							<b> - Total : R$ </b> 
							<?php echo number_format($total_entradas, 2, ',', '.'); ?> 
						</p>
					
						<p class="pgto" style="font-size:12px">  
							<b>Qtde Saídas: </b> 
							<?php echo $quant_saidas; ?> 
							<b> - Total : R$ </b> 
							<?php echo number_format($total_saidas, 2, ',', '.'); ?> 
						</p>

						<p class="pgto" style="font-size:12px">  	
							<b>Saldo: R$ </b> 
							<?php echo number_format(($total_entradas - $total_saidas), 2, ',', '.'); ?> 
						</p>								
					</div>

				</div>
				<!-- Fim Div Row 1 -->

			<?php else:
			?>
				<!-- Div Row 1 -->
				<div class="row">
					<!--<div class="col-sm-8">	
									
					</div>-->
					<div class="col-sm-4 areaTotais">				
						 <p class="pgto" style="font-size:12px">  
						 	<b>Valor Total: </b> R$ 
						 	<?php echo number_format($total_mov, 2, ',', '.'); ?> 
						 </p>	
						 <p style="font-size:12px">  
							<b>Qtde de Movimentos: </b> 
							<?php echo $quant; ?> 
						</p>					
					</div>
				</div>
				<!-- Fim Div Row 1 -->

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



