<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Funcionarios</title>
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

    <a class="navbar-brand" href="painel_admin.php">
      <big><big><i class="fa fa-arrow-left"></i></big></big>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
      
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="txtPesquisar" placeholder="Pesquisar" aria-label="Pesquisar">
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
                <h4 class="card-title"> Tabela de Clientes</h4>
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
                        Telefone
                      </th>
                      <th>
                        Endereço
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        CPF
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
                          $query = "SELECT * FROM clientes WHERE nome LIKE '{$nome}' ORDER BY nome ASC";
                          
                        } else {
                           $query  = "SELECT * FROM clientes ORDER BY nome ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td><?php echo $row['endereco']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td> 
                            <td>
                              <a class="btn btn-info" href="clientes.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="clientes.php?func=deleta&id=<?php echo $row['id'] ?>">
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
                <h4 class="modal-title">Clientes</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Nome</label>
                  <input type="text" class="form-control mr-2" name="txtnome" id="txtnome" placeholder="Nome" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Telefone</label>
                  <input type="text" class="form-control mr-2" name="txttelefone" id="txttelefone" placeholder="Telefone" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Endereço</label>
                  <input type="text" class="form-control mr-2" name="txtendereco" id="txtendereco" placeholder="Endereço" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Email</label>
                  <input type="email" class="form-control mr-2" name="txtemail" id="txtemail" placeholder="Email" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">CPF</label>
                   <input type="text" class="form-control mr-2" name="txtcpf" id="txtcpf" placeholder="CPF" required>
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
	$nome     = $_POST['txtnome'];
	$telefone = $_POST['txttelefone'];
	$endereco = $_POST['txtendereco'];
	$email    = $_POST['txtemail'];
	$cpf      = $_POST['txtcpf'];

	// Verificar se o CPF já é cadastrado
	$query  = "SELECT * FROM clientes WHERE cpf = '$cpf' ";
	$result = mysqli_query($conexao, $query);
	$row    = mysqli_num_rows($result);

	if ($row > 0) { // se encontrar, a operação é cancelada
	 	echo "<script type='text/javascript'>window.alert('CPF já cadastrado')</script>";
	 	exit;
	 }

	 // Inserir no banco
	 $query  = "INSERT INTO clientes (nome, telefone, endereco, email, cpf, data) VALUES ('$nome', '$telefone', '$endereco', '$email', '$cpf', now() )";

	 $result = mysqli_query($conexao, $query);
	
	 if ($result) {
	 	echo "<script type='text/javascript'>window.alert('Cliente cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='clientes.php'</script>";

	 } else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Cliente.')</script>";
    echo "<script type='text/javascript'>window.location='clientes.php'</script>";
	 }
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "DELETE FROM clientes WHERE id = $id";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='clientes.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM clientes WHERE id = '$id'";
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
                <h4 class="modal-title">Clientes</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Nome</label>
                  <input type="text" class="form-control mr-2" name="txtnome" id="txtnome" value="<?php echo $row['nome'] ?>" placeholder="Nome" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Telefone</label>
                  <input type="text" class="form-control mr-2" name="txttelefone" id="txttelefone" value="<?php echo $row['telefone'] ?>" placeholder="Telefone" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Endereço</label>
                  <input type="text" class="form-control mr-2" name="txtendereco" id="txtendereco" value="<?php echo $row['endereco'] ?>" placeholder="Endereço" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Email</label>
                  <input type="email" class="form-control mr-2" name="txtemail" id="txtemail" value="<?php echo $row['email'] ?>" placeholder="Email" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">CPF</label>
                   <input type="text" class="form-control mr-2" name="txtcpf" id="txtcpf" value="<?php echo $row['cpf'] ?>" placeholder="CPF" required>
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
  $dados = $_POST;

  // se o cpf recuperado do banco for diferente do cpf digitado no campo:
  if ($row['cpf'] != $dados['txtcpf']) {
    // VERIFICACAO CPF CADASTRADO
    $query  = "SELECT * FROM clientes WHERE cpf = '{$dados['txtcpf']}'";
    $result = mysqli_query($conexao, $query);
    $row    = mysqli_num_rows($result);
    if ($row > 0) {
       echo "<script type='text/javascript'>window.alert('CPF já cadastrado.')</script>";
       exit;
     }
  }
  
  $query = "UPDATE clientes 
            SET nome     = '{$dados['txtnome']}',
                telefone = '{$dados['txttelefone']}',
                endereco = '{$dados['txtendereco']}',
                email    = '{$dados['txtemail']}',
                cpf      = '{$dados['txtcpf']}'
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Cliente alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='clientes.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='clientes.php'</script>";
  }
  
}

?>

<?php } } ?> 


<!-- Máscaras -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#txttelefone').mask('(00) 00000-0000');
		$('#txtcpf').mask('000.000.000-00');
	});
</script>