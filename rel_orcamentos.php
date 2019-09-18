<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Relatório Orçamentos</title>
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
        <select class="form-group mr-2" id="category" name="status">
          <option value="Aguardando">Aguardando</option>
          <option value="Aprovado">Aprovado</option>          
        </select>
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
      <!--<div class="row">
        <div class="col-sm-12">
          <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalExemplo">
                Inserir Novo
          </button>
        </div>          
      </div>-->
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
                <h4 class="card-title"> Orçamentos Fechados</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary">                          
                      <th>
                        Nome
                      </th>
                      <th>
                        Técnico
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
                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' && $_GET['status'] != '' ) {
                          $data = $_GET['txtPesquisar'];
                          $status_orc = $_GET['status'];
                          $query = "SELECT o.id, o.cliente, o.tecnico, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM orcamentos as o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios f ON f.id = o.tecnico  WHERE o.data_geracao = '{$data}' AND o.status = '{$status_orc}' ORDER BY o.id ASC";
                        
                        // pesquisa pela data atual e pelo status Aguardando  
                        } else if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] == '' && $_GET['status'] != 'Aprovado' ) {                         
                          $status_orc = $_GET['status'];
                          $query = "SELECT o.id, o.cliente, o.tecnico, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM orcamentos as o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios f ON f.id = o.tecnico  WHERE o.data_geracao = curDate() AND o.status = '{$status_orc}' ORDER BY o.id ASC";
                        
                        // pesquisa pela data atual e pelo status Aprovado  
                        } else if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] == '' && $_GET['status'] == 'Aprovado' ) {                         
                          $status_orc = $_GET['status'];
                          $query = "SELECT o.id, o.cliente, o.tecnico, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM orcamentos as o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios f ON f.id = o.tecnico  WHERE o.data_geracao = curDate() AND o.status = '{$status_orc}' ORDER BY o.id ASC";

                        // lista os orçamentos da data atual
                        } else {
                           $query = "SELECT o.id, o.cliente, o.tecnico, o.produto, o.valor_total, o.data_abertura, o.data_geracao, o.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM orcamentos as o INNER JOIN clientes as c ON c.cpf = o.cliente INNER JOIN funcionarios f ON f.id = o.tecnico WHERE o.data_geracao = curDate() ORDER BY o.id ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['nome_cli']; ?></td>
                            <td><?php echo $row['nome_tec']; ?></td>
                            <td><?php echo $row['produto']; ?></td>
                            <td><?php echo $row['valor_total']; ?></td>
                            <td><?php echo date( 'd/m/Y', strtotime($row['data_abertura']) ); ?></td>         
                            <td>
                              <a class="btn btn-info" href="rel/rel_orcamentos.php?id=<?php echo $row['id'] ?>&email=<?php echo $row['email'] ?>">
                                <i class="fas fa-print"></i>
                              </a>
                           
                              <a class="btn btn-success" href="rel_orcamentos.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-check-circle"></i>
                              </a>
                            </td>
                          </tr>                         

                          <?php } 

                      ?>

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

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM orcamentos WHERE id = '{$id}' ";
  $result = mysqli_query($conexao, $query);

  //while ($row = mysqli_fetch_assoc($result)) {
  $row = mysqli_fetch_assoc($result); 
  $cliente = $row['cliente'];
  $tecnico = $row['tecnico'];
  $produto = $row['produto']; 
  $sub_total = $row['sub_total'];

  ?>

    <!-- Modal -->
      <div id="modalEditar" class="modal fade" role="dialog">
        <!-- Form -->
        <form method="POST">
          <!-- Div Modal Dialog -->
          <div class="modal-dialog">
            <!-- Modal Content-->
            <div class="modal-content">

              <!-- Modal Header-->
              <div class="modal-header">              
                <h4 class="modal-title">Aprovar Orçamento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="fornecedor">Forma Pagto</label>
                  <select class="form-control mr-2" name="pgto" id="pgto">
                        <option value="Dinheiro"> Dinheiro</option>
                        <option value="Cartão"> Cartão</option>
                  </select>                  
                </div>

                <div class="form-group">
                  <label for="id_produto">Desconto</label>
                  <input type="text" class="form-control mr-2" name="txtdesconto" id="txtdesconto" placeholder="Desconto" required>
                </div>

              </div>
              <!-- Modal Body-->
                     
              <!-- Modal Footer -->
              <div class="modal-footer">
                 <button type="submit" class="btn btn-success mb-3" name="btSalvar">Salvar </button>

                  <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>

              </div>
              <!-- Fim Modal Footer -->

            </div>
            <!-- Fim Modal Content-->
          </div>
          <!-- Fim Div Modal Dialog -->
        </form>
        <!-- Fim Form -->
    </div>
    <!-- Fim Modal -->

<!-- Abre Janela Modal -->
<script type="text/javascript">
$(document).ready(function(){
  // Show the Modal on load
  $("#modalEditar").modal("show");    
 
});
</script>

<!-- Salvar os dados UPDATE -->
<?php 

if (isset($_POST['btSalvar'])) {
  $pgto        = $_POST['pgto'];
  $desconto    = $_POST['txtdesconto'];
  $valor_total = $sub_total - $desconto;
  
  $query = "UPDATE orcamentos
            SET desconto       = '{$desconto}',
                valor_total    = '{$valor_total}',
                pgto_tipo      = '{$pgto}',                
                data_aprovacao = curDate(),
                status         = 'Aprovado'
                
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Orçamento aprovado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='rel_orcamentos.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao atualizar registro.')</script>";
    echo "<script type='text/javascript'>window.location='rel_orcamentos.php'</script>";
  }

  $query = "INSERT INTO os (id_orc, cliente, produto, tecnico,  valor_total, data_abertura, status) 
    VALUES ('{$id}', '{$cliente}', '{$produto}', '{$tecnico}', '{$valor_total}', curDate(), 'Aberta')";
  
  $result = mysqli_query($conexao, $query);
}

?>

<?php } ?> 