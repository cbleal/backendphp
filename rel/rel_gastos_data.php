<?php 

// recupera a configuração de acesso ao banco de dados
require '../conexao.php';

// pegar os parâmetros passados por GET (rel_mov_data_class.php)

$dataInicial = $_GET['dataInicial'];
$dataFinal 	 = $_GET['dataFinal'];	

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
			<div class="col-sm-6">
				<big><big> RELATÓRIO DE GASTOS  </big> </big>
			</div>
			<!--<div class="col-sm-6">
				<small>
					<?php 
						if ($tipo == 'Todas'){
							echo 'Todas as Movimentações';
						} else {
							echo 'Movimentações de '.$tipo;
						}
				 	?>				 	
				 </small>
			</div>-->
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

			$total = 0;

			$query = "SELECT * FROM gastos WHERE data BETWEEN '{$dataInicial}' AND '{$dataFinal}' ORDER BY data";

			$result = mysqli_query($conexao, $query);

			?>

			<table class="table">
				<tr bgcolor="#f9f9f9">
					<td style="font-size:12px"> <b>Motivo</b> </td>
					<td style="font-size:12px"> <b>Valor R$</b> </td>
					<td style="font-size:12px"> <b>Funcionário</b> </td>
					<td style="font-size:12px"> <b>Data</b> </td>	
				</tr>

				<?php
				while ($row = mysqli_fetch_assoc($result)) {
					
					$total += $row['valor'];	
	                
				?>

				<tr>					
					<td style="font-size:12px"> <?php echo $row['motivo']; ?> </td>
					<td style="font-size:12px"> <?php echo number_format($row['valor'], 2, ',', '.'); ?> </td>
					<td style="font-size:12px"> <?php echo $row['funcionario']; ?> </td>	
					<td style="font-size:12px"> <?php echo date('d/m/Y', strtotime($row['data'])); ?> </td>	
				</tr>

				<?php } ?>
			</table>

			<hr><br><br>
			
			<div class="row">

				<div class="col-sm-8">	
									
				</div>

				<div class="col-sm-4 areaTotais">				
					<p class="pgto" style="font-size:16px">  
						<b>Valor Total: </b> R$ 
						<?php echo number_format($total, 2, ',', '.'); ?> 
					</p>				
				</div>

			</div>

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



