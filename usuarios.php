<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Usuarios</title>
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
                <h4 class="card-title"> Tabela de Usuarios</h4>
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
                        Usuario
                      </th> 
                      <!-- 
                      <th>
                        Senha
                      </th> -->                      
                      <th>
                        Cargo
                      </th>
                      <th>
                        Telefone
                      </th>
                      <th>                  
                        Ações
                      </th>
                    </thead>
                        
                    <tbody>

                      <?php

                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' ) {
                          $nome = $_GET['txtPesquisar'].'%';

                          $query = "SELECT u.id, f.nome, u.usuario, u.senha, u.cargo, u.id_funcionario, f.telefone from usuarios as u INNER JOIN funcionarios as f ON u.id_funcionario = f.id where f.nome LIKE '$nome'  order by f.nome asc"; 
                          
                        } else {
                           $query = "SELECT u.id, f.nome, u.usuario, u.senha, u.cargo, u.id_funcionario, f.telefone from usuarios as u INNER JOIN funcionarios as f ON u.id_funcionario = f.id order by f.nome asc"; 
                           
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['usuario']; ?></td>
                            <!--<td><?php echo $row['senha']; ?></td>-->
                            <td><?php echo $row['cargo']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td>
                              <a class="btn btn-info" href="usuarios.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="usuarios.php?func=deleta&id=<?php echo $row['id'] ?>">
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
                <h4 class="modal-title">Usuarios</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Usuario</label>
                  <input type="text" class="form-control mr-2" name="txtusuario" id="txtusuario" placeholder="Usuario" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Senha</label>
                   <input type="password" class="form-control mr-2" name="txtsenha" id="txtsenha" placeholder="Senha" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Funcionario</label>
                  <select class="form-control mr-2" name="id_funcionario" id="id_funcionario">
                    <?php
                    $query  = "SELECT * FROM funcionarios";
                    $result = mysqli_query($conexao, $query);
                    if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['id']; ?>">
                          <?php echo $row['nome']; ?>
                        </option>

                      <?php
                      }
                    }
                    ?>
                  </select>
                  
                </div>

              </div>
              <!-- Fim Modal Body-->
                     
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
  //$dados = $_POST;
  $usuario = $_POST['txtusuario'];
  $senha   = $_POST['txtsenha'];
  $id_funcionario = $_POST['id_funcionario'];
  
  $query  = "SELECT * FROM funcionarios WHERE id = '{$id_funcionario}' ";
  $result = mysqli_query($conexao, $query);
  $dados  = mysqli_fetch_assoc($result);
  $row    = mysqli_num_rows($result);
  if ($row > 0) {
     $nome  = $dados['nome'];
     $cargo = $dados['cargo']; 
   } 

	// Verificar se o Usuario já é cadastrado
	$query  = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' ";
	$result = mysqli_query($conexao, $query);
	$row    = mysqli_num_rows($result);

	if ($row > 0) { // se encontrar, a operação é cancelada
	 	echo "<script type='text/javascript'>window.alert('Usuario já cadastrado')</script>";
	 	exit;
	 }

	 // Inserir no banco	
   $query  = "INSERT INTO usuarios (nome, usuario, senha, cargo, id_funcionario) 
              VALUES ('$nome', '$usuario', '$senha', '$cargo', '$id_funcionario')";
                      
	 $result = mysqli_query($conexao, $query);
	
	 if ($result) {
	 	echo "<script type='text/javascript'>window.alert('Usuario cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='usuarios.php'</script>";

	 } else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Usuario.')</script>";
    echo "<script type='text/javascript'>window.location='usuarios.php'</script>";
	 }
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "DELETE FROM usuarios WHERE id = $id";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='usuarios.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  // pega o id passado pelo link
  $id = $_GET['id'];

  // consulta ao banco usuarios
  $query  = "SELECT * FROM usuarios WHERE id = '{$id}'";
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
                <h4 class="modal-title">Usuarios</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="id_produto">Usuario</label>
                  <input type="text" class="form-control mr-2" name="txtusuario" id="txtusuario" value="<?php echo $row['usuario'] ?>" placeholder="Usuario" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Senha</label>
                   <input type="text" class="form-control mr-2" name="txtsenha" id="txtsenha" value="<?php echo $row['senha'] ?>" placeholder="Senha" required>
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
  //$dados = $_POST;
  $usuario = $_POST['txtusuario'];
  $senha   = $_POST['txtsenha'];

  if ($row['usuario'] != $usuario) {       

    $query  = "SELECT * FROM usuarios WHERE usuario = '{$usuario}' ";
    $result = mysqli_query($conexao, $query);
    $row    = mysqli_num_rows($result);

    if($row > 0){
      echo "<script language='javascript'> window.alert('Usuário já Cadastrado!'); </script>";
      exit();
    }
  }

  // atualizar os dados no banco
  $query = "UPDATE usuarios
            SET    usuario  = '{$usuario}',
                   senha    = '{$senha}'  
            WHERE  id       = '{$id}' ";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Usuario alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='usuarios.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='usuarios.php'</script>";
  }
  
}

?>

<?php } } ?> 