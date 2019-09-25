<?php 

session_start();
require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Gastos</title>
  <!-- Meta -->
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
        <input class="form-control mr-sm-2" type="date" name="txtPesquisar" placeholder="Pesquisar" aria-label="Pesquisar">
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
          <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalExemplo">
                Inserir Novo
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
                <h4 class="card-title"> Tabela de Gastos</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary">                          
                      <th>
                        Valor
                      </th>
                      <th>
                        Motivo
                      </th>
                      <th>
                        Funcionario
                      </th>                      
                      <th>
                        Data
                      </th>
                      <th>
                        Ações
                      </th>
                    </thead>
                        
                    <tbody>

                      <?php

                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' ) {
                          $data = $_GET['txtPesquisar'];
                          $query = "SELECT * FROM gastos WHERE data = '{$data}'ORDER BY id ASC";
                          
                        } else {
                           $query  = "SELECT * FROM gastos WHERE data = curdate() ORDER BY id ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['valor']; ?></td>
                            <td><?php echo $row['motivo']; ?></td>
                            <td><?php echo $row['funcionario']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td>  
                            <td>
                              <a class="btn btn-info" href="gastos.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="gastos.php?func=deleta&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-trash-alt"></i>
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

    <!-- Modal -->
      <div id="modalExemplo" class="modal fade" role="dialog">
        <!-- Form -->
        <form method="POST">
          <!-- Div Modal Dialog -->
          <div class="modal-dialog">
            <!-- Modal Content-->
            <div class="modal-content">

              <!-- Modal Header-->
              <div class="modal-header">              
                <h4 class="modal-title">Gastos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Valor</label>
                  <input type="text" class="form-control mr-2" name="txtvalor" id="txtvalor" placeholder="Valor" onkeypress="$(this).mask('#.##0,00', {reverse: true})" required>
                </div>
               
                <div class="form-group">
                  <label for="quantidade">Motivo</label>
                  <input type="text" class="form-control mr-2" name="txtmotivo" id="txtmotivo" placeholder="Motivo" required>
                </div>

              </div>
              <!-- Modal Body-->
                     
              <div class="modal-footer">
                 <button type="submit" class="btn btn-success mb-3" name="btSalvar">Salvar </button>

                  <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>

              </div>
            </div>
            <!-- Fim Modal Content-->
          </div>
          <!-- Fim Div Modal Dialog -->
        </form>
        <!-- Fim Form -->
    </div>
    <!-- Fim Modal -->
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

<!-- Cadastrar -->
<?php  

if (isset($_POST['btSalvar'])) {
  //$valor  = (float) number_format($_POST['txtvalor'], 2, '.', ',');
  $valor  = str_replace(',', '.', str_replace('.', '', $_POST['txtvalor']));
  $motivo = $_POST['txtmotivo'];
  $funcionario = $_SESSION['nome_usuario']; 	

	 // Inserir no banco gastos
   $query  = "INSERT INTO gastos (valor, motivo, funcionario, data) 
              VALUES (
                      '{$valor}', 
                      '{$motivo}', 
                      '{$funcionario}',                       
                      curdate() 
                    )";

	 $result = mysqli_query($conexao, $query);  

   if ($result) { 

   // Recuperar o último id inserido
   $query_id  = "SELECT * FROM gastos ORDER BY id DESC LIMIT 1";
   $result_id = mysqli_query($conexao, $query_id);
   $row       = mysqli_fetch_assoc($result_id);
   $id_gasto  = $row['id'];
   
   // Inserir no banco movimentacoes
   $query_mov = "INSERT INTO 
                movimentacoes (tipo, movimento, valor, funcionario, data, id_gasto) 
                VALUES (
                          'Saida', 
                          'Gasto', 
                          '{$valor}', 
                          '{$funcionario}', 
                          curdate(), 
                          '{$id_gasto}'
                        )";

    mysqli_query($conexao, $query_mov);
	
	 
	 	echo "<script type='text/javascript'>window.alert('Gasto cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='gastos.php'</script>";

	 } else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Gasto.')</script>";
    echo "<script type='text/javascript'>window.location='gastos.php'</script>";
	 }         
    
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  // TABELA GASTOS
  $query = "DELETE FROM gastos WHERE id = '{$id}' ";
  mysqli_query($conexao, $query);
  // TABELA MOVIMENTACOES
  $query = "DELETE FROM movimentacoes WHERE movimento = 'Gasto' AND id_gasto = '{$id}' ";  
  mysqli_query($conexao, $query);

  echo "<script type='text/javascript'>window.location='gastos.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM gastos WHERE id = '$id'";
  $result = mysqli_query($conexao, $query);


  while ($row = mysqli_fetch_array($result)) {

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
                <h4 class="modal-title">Gastos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Motivo</label>
                  <input type="text" class="form-control mr-2" name="txtmotivo" id="txtmotivo" value="<?php echo $row['motivo'] ?>" placeholder="Nome" required>
                </div>

              </div>
              <!-- Modal Body-->
                     
              <!-- Modal Footer -->
              <div class="modal-footer">
                 <button type="submit" class="btn btn-success mb-3" name="btEditar">Salvar </button>

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

if (isset($_POST['btEditar'])) {
  $motivo = $_POST['txtmotivo'];
  
  $query = "UPDATE gastos
            SET motivo     = '{$motivo}'  
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Gasto alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='gastos.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='gastos.php'</script>";
  }
  
}

?>

<?php } } ?> 