<?php 

require 'conexao.php';

session_start();
$tecnico = $_SESSION['nome_usuario'];

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Ordem de Serviços</title>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
 
  <!-- Your custom styles (optional) 
  <link href="css/style.css" rel="stylesheet"> -->

</head>

<body>

  <!-- Nav -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="painel_funcionario.php">
      <big><big><i class="fa fa-arrow-left"></i></big></big>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
      
      </ul>
      <form class="form-inline my-2 my-lg-0">    
        <input class="form-control mr-sm-2" type="date" name="txtPesquisar" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btPesquisar"><i class="fa fa-search"></i></button>
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
          <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalExemplo">
                <?php echo "$tecnico"; ?>
          </button>
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
                <h4 class="card-title"> Ordem de Serviços Abertas</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary"> 
                      <th>
                        Nº OS
                      </th>                         
                      <th>
                        Cliente
                      </th>
                      <th>
                        Produto
                      </th>                      
                      <th>
                        Valor Total
                      </th>
                      <th>
                        Data Abertura
                      </th>                      
                      <th>
                        Ações
                      </th>
                    </thead>
                        
                    <tbody>

                      <?php

                        // pesquisa pela data e pelo status
                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '') {
                          $data = $_GET['txtPesquisar'];
                         
                          $query = "SELECT ord.id, ord.cliente, ord.produto, ord.tecnico, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, f.nome AS fun_nome, c.nome AS cli_nome FROM os AS ord INNER JOIN funcionarios AS f ON f.id = ord.tecnico INNER JOIN clientes AS c ON c.cpf = ord.cliente WHERE data_abertura = '{$data}' AND status = 'Aberta' AND f.nome = '{$tecnico}' ORDER BY id ASC";
                        
                        // pesquisa pela data atual 
                        } else {
                           $query = "SELECT ord.id, ord.cliente, ord.produto, ord.tecnico, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, f.nome AS fun_nome, c.nome AS cli_nome FROM os AS ord INNER JOIN funcionarios AS f ON f.id = ord.tecnico INNER JOIN clientes AS c ON c.cpf = ord.cliente WHERE data_abertura = curDate() AND status = 'Aberta' AND f.nome = '{$tecnico}' ORDER BY id ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo '00'.$row['id']; ?></td>
                            <td><?php echo $row['cli_nome']; ?></td>
                            <td><?php echo $row['produto']; ?></td>
                            <td><?php echo number_format($row['valor_total'], 2, ',', '.'); ?></td>
                            <td><?php echo fmtData( $row['data_abertura'] ); ?></td>
                            <!--<td><?php echo date('d/m/Y', strtotime($row['data_abertura'])); ?></td>-->     
                            <td>
                              <a class="btn btn-info" href="os_abertas.php?func=edita&id=<?php echo $row['id'] ?>&valor=<?php echo $row['valor_total'] ?>" onclick="return confirm('Confirma o fechamento da O.S ?')">
                                <i class="fas fa-check-circle"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="os_abertas.php?func=deleta&id=<?php echo $row['id'] ?>" onclick="return confirm('Confirma o cancelamento da O.S ?')">
                                <i class="fas fa-minus-square"></i>
                              </a>
                            </td>
                          </tr>                         

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
      <!-- Fim Div Content -->   
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

<!-- CANCELAMENTO -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "UPDATE os SET status = 'Cancelada' WHERE id = '{$id}'";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='os_abertas.php'</script>";
  
}
?>

<!-- FECHAMENTO -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];
  $valor = $_GET['valor'];
  
  $query  = "UPDATE os SET data_fechamento = curDate(), status = 'Fechada' WHERE id = '{$id}' ";
  mysqli_query($conexao, $query);

  // Inserir no banco movimentacoes
   $query_mov = "INSERT INTO 
                movimentacoes (tipo, movimento, valor, funcionario, data, id_gasto) 
                VALUES (
                          'Entrada', 
                          'Servico', 
                          '{$valor}', 
                          '{$tecnico}', 
                          curdate(), 
                          '{$id}'
                        )";

    mysqli_query($conexao, $query_mov);

  echo "<script type='text/javascript'>window.location='os_abertas.php'</script>";

}

?>