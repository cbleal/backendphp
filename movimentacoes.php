<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Movimetações</title>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
 
  <!-- Your custom styles (optional) 
  <link href="css/style.css" rel="stylesheet"> -->

  <style type="text/css">
    .entrada {
      color: green;
      font-weight: bold;
    }
    .saida {
      color: red;
      font-weight: bold;
    }
  </style>

</head>

<body>

  <!-- Nav -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="painel_tesouraria.php">
      <big><big><i class="fa fa-arrow-left"></i></big></big>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
      
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <!-- CAIXA SELEÇÃO -->
        <select class="form-group mr-2" id="category" name="status">
          <option value="Todas">Todas</option>
          <option value="Entrada">Entradas</option>
          <option value="Saida">Saidas</option>  
        </select>
        <!-- INPUT TIPO DATE (DATA INICIAL) -->
        <input class="form-control mr-sm-2" type="date" name="txtDataInicial" placeholder="Pesquisar" aria-label="Pesquisar">
        <!-- INPUT TIPO DATE (DATA FINAL) -->
        <input class="form-control" type="date" name="txtDataFinal">
        <!-- BOTÃO -->
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btPesquisar">
          <i class="fa fa-search"></i>
        </button>

      </form>
    </div>

  </nav>
  <!-- Fim nav -->

  <!-- Div Container -->
  <div class="container">

      <br>

      <!-- Div Row -->
      <div class="row">
        <div class="col-sm-12">
          <!--<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalExemplo">
                Inserir Novo
          </button>-->
        </div>          
      </div>
      <!-- Fim Div Row -->

      <!-- Div Content -->
      <div class="content">

        <!-- Div Row -->
        <div class="row">
          <!-- Div Col -->
          <div class="col-md-12">
            <!-- Div Card -->
            <div class="card">              
              <div class="card-header">
                <h4 class="card-title"> Movimentações</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary">                          
                      <th>
                        Tipo
                      </th>
                      <th>
                        Movimento
                      </th>                     
                      <th>
                        Valor
                      </th>
                      <th>
                        Funcionário
                      </th>
                      <th>
                        Data
                      </th>                                           
                      <!--<th>
                        Ações
                      </th>-->

                    </thead>
                        
                    <tbody>

                      <?php
                        $valor_entrada = $valor_saida = $saldo = 0;
                        // SE FOR UTILIZADO A PESQUISA
                        if (isset($_GET['btPesquisar'])) {
                          // PEGA O VALOR DO SELECT
                          $status = $_GET['status'];
                          // PEGA OS VALORES DOS INPUTS DATE
                          $dataIni = $_GET['txtDataInicial'];
                          $dataFim = $_GET['txtDataFinal'];
                          // FAZ A VERIFICAÇÃO DO CONTEÚDO
                          // SE FOR VAZIO É ATRIBUÍDO A DATA CORRENTE
                          if ($dataIni == '') {
                            $dataIni = date('Y-m-d');
                          }
                          if ($dataFim == '') {
                            $dataFim = date('Y-m-d');
                          }
                          // FAZ A VERIFICAÇÃO DA CAIXA DE SELEÇÃO
                          if ($status != 'Todas') {
                            // FOI SELECIONADO UM STATUS
                            $query = "SELECT * FROM movimentacoes WHERE data BETWEEN '{$dataIni}' AND '{$dataFim}' AND tipo = '{$status}' ORDER BY data ASC ";
                          }
                          // NÃO FOI SELECIONADO UM STATUS
                          else {
                            $query = "SELECT * FROM movimentacoes WHERE data BETWEEN '{$dataIni}' AND '{$dataFim}' ORDER BY data ASC ";
                          }
                                              
                        }
                        // CARREGA OS DADOS SEM UTILIZAR PESQUISA
                        else {
                          $query = "SELECT * FROM movimentacoes WHERE data = curdate() ORDER BY data ASC ";
                        }
                        // RECEBE O RESULTADO DA CONSULTA                       
                        $result = mysqli_query($conexao, $query);
                        // PERCORRE ENQUANTO HOUVER DADOS NO RESULTADO
                        while ($row = mysqli_fetch_assoc($result)) {
                          
                          ?>

                          <tr>
                            <?php if ($row['tipo'] == 'Entrada'): ?>
                              <td class="entrada"><?php echo $row['tipo']; ?>                           
                              </td>
                              <?php $valor_entrada += $row['valor']; ?>
                            <?php elseif ($row['tipo'] == 'Saida'): ?>
                              <td class="saida"><?php echo $row['tipo']; ?>                           
                              </td>
                              <?php $valor_saida += $row['valor']; ?>
                            <?php endif; ?>
                            <?php if ($row['tipo'] == 'Entrada'): ?>
                              <td class="entrada"><?php echo $row['movimento']; ?>                         
                              </td>
                            <?php elseif ($row['tipo'] == 'Saida'): ?>
                              <td class="saida"><?php echo $row['movimento']; ?>                         
                              </td>
                            <?php endif; ?>
                            <td><?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['funcionario']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td>      

                          <?php } ?>

                    </tbody>
                  </table> 
                  <!-- Fim Table -->
                </div> 
                <!-- Fim Div Table Responsive -->              
              </div>
              <!-- Div Body -->             
            </div>
            <!-- Fim Div Card -->
          </div>
          <!-- Fim Div Col -->
        </div>
        <!-- Fim Div Row -->
      </div>
      <!-- Div Content -->

      <!-- TOTALIZADORES (ENTRADAS, SAIDAS, SALDO) -->
      <div class="row">
        <?php $saldo = $valor_entrada - $valor_saida; ?>
        <div class="col-md-3 mt-2">
          <p class="entrada">
            Total Entradas: R$ <?php echo number_format($valor_entrada, 2, ',', '.'); ?>              
          </p>
        </div>
        <div class="col-md-3 mt-2">
          <p class="saida">
            Total Saídas: R$ <?php echo number_format($valor_saida, 2, ',', '.'); ?>
              
          </p>
        </div>        
        <div class="col-md-6 mt-2">
          <?php if ($saldo >= 0): ?>             
            <p class="entrada">
              Saldo: R$ <?php echo number_format($saldo, 2, ',', '.'); ?>
            </p>
          <?php else: ?>            
            <p class="saida">
              Saldo: R$ <?php echo number_format($saldo, 2, ',', '.'); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
   
  </div>    
  <!-- Fim Div Container -->   

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script> 
  <!-- JQuery Mask -->
  <script type="text/javascript" src="js/jquery.mask.min.js"></script> 
  <!-- JavaScript JS -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 

</body>
</html>