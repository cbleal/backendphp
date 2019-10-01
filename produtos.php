<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Produtos</title>
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
      <!-- Form Pesquisar Nome -->
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="txtPesquisar" placeholder="Buscar pelo nome" aria-label="Pesquisar">
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
                <h4 class="card-title"> Tabela de Produtos</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary">                          
                      <th>
                        ID
                      </th>
                      <th>
                        Produto
                      </th>
                      <th>
                        Unid.
                      </th>
                      <th>
                        Valor
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
                          $nome = $_GET['txtPesquisar'].'%';
                          $query = "SELECT * FROM produtos WHERE nome LIKE '{$nome}' ORDER BY nome ASC";
                        } else {
                           $query  = "SELECT * FROM produtos ORDER BY nome ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>

                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['unidade']; ?></td>
                            <td><?php echo $row['valor_venda']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td> 
                            <td>
                              <a class="btn btn-info" href="produtos.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="produtos.php?func=deleta&id=<?php echo $row['id'] ?>">
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
                <h4 class="modal-title">Produtos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Nome</label>
                  <input type="text" class="form-control mr-2" name="txtnome" id="txtnome" placeholder="Nome do Produto" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Unidade</label>
                  <input type="text" class="form-control mr-2" name="txtunidade" id="txtunidade" placeholder="Unidade" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Valor</label>
                  <input type="text" class="form-control mr-2" name="txtvalor" id="txtvalor" placeholder="Valor" onkeypress="$(this).mask('#.##0,00', {reverse: true})" required>
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
	$nome    = $_POST['txtnome'];
	$unidade = $_POST['txtunidade'];
  $valor   = str_replace(',', '.', str_replace('.', '', $_POST['txtvalor']));

	// Verificar se o Produto já é cadastrado
	$query  = "SELECT * FROM produtos WHERE nome = '{$nome}' ";
	$result = mysqli_query($conexao, $query);
	$row    = mysqli_num_rows($result);

	if ($row > 0) { // se encontrar, a operação é cancelada
	 	echo "<script type='text/javascript'>window.alert('CPF já cadastrado')</script>";
	 	exit;
	}

	 // Inserir no banco
	$query  = "INSERT INTO produtos (nome, unidade, valor_compra, data) VALUES ('{$nome}', '{$unidade}', '{$valor}', curdate() )";

	$result = mysqli_query($conexao, $query);
	
	if ($result) {
	 	echo "<script type='text/javascript'>window.alert('Produto cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='produtos.php'</script>";

	} else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Produto.')</script>";
    echo "<script type='text/javascript'>window.location='produtos.php'</script>";
	}
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "DELETE FROM produtos WHERE id = $id";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='clientes.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM produtos WHERE id = '$id'";
  $result = mysqli_query($conexao, $query);


  while ($row = mysqli_fetch_assoc($result)) {

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
                <h4 class="modal-title">Produtos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Nome</label>
                  <input type="text" class="form-control mr-2" name="txtnome" id="txtnome" value="<?php echo $row['nome'] ?>" placeholder="Nome do Produto" required>
                </div>               

                <div class="form-group">
                  <label for="quantidade">Unidade</label>
                  <input type="text" class="form-control mr-2" name="txtunidade" id="txtunidade" value="<?php echo $row['unidade'] ?>" placeholder="Unidade" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Valor</label>
                  <input type="text" class="form-control mr-2" name="txtvalor" id="txtvalor" value="<?php echo $row['valor_venda'] ?>" placeholder="Valor" onkeypress="$(this).mask('#.##0,00', {reverse: true})" required>
                </div>

              </div>
              <!-- Modal Body-->
                     
              <div class="modal-footer">
                 <button type="submit" class="btn btn-success mb-3" name="btEditar">Salvar </button>

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
  $nome    = $_POST['txtnome'];
  $unidade = $_POST['txtunidade'];
  $valor   = str_replace(',', '.', str_replace('.', '', $_POST['txtvalor']));
  
  $query = "UPDATE produtos 
            SET nome     = '{$nome}',
                unidade  = '{$unidade}',
                valor_venda = '{$valor}'          
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Produto alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='produtos.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='produtos.php'</script>";
  }
  
}

?>

<?php } } ?> 