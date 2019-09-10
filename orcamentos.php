<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Orçamentos</title>
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
                <h4 class="card-title"> Tabela de Orçamentos</h4>
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
                        Status
                      </th>                      
                      <th>
                        Ações
                      </th>
                    </thead>
                        
                    <tbody>

                      <?php

                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' ) {
                          $data = $_GET['txtPesquisar'].'%';
                          $query = "SELECT * FROM orcamentos WHERE data_abertura = $data ORDER BY id ASC";
                          
                        } else {
                           $query  = "SELECT * FROM orcamentos WHERE  data_abertura = now() ORDER BY id ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['cliente']; ?></td>
                            <td><?php echo $row['tecnico']; ?></td>
                            <td><?php echo $row['produto']; ?></td>
                            <td><?php echo $row['valor_total']; ?></td>
                            <td><?php echo $row['status']; ?></td>         
                            <td>
                              <a class="btn btn-info" href="funcionarios.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="funcionarios.php?func=deleta&id=<?php echo $row['id'] ?>">
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
                <h4 class="modal-title">Funcionarios</h4>
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
                  <label for="fornecedor">CPF</label>
                   <input type="text" class="form-control mr-2" name="txtcpf" id="txtcpf" placeholder="CPF" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Telefone</label>
                  <input type="text" class="form-control mr-2" name="txttelefone" id="txttelefone" placeholder="Telefone" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Endereco</label>
                  <input type="text" class="form-control mr-2" name="txtendereco" id="txtendereco" placeholder="Endereço" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Cargo</label>
                  <select class="form-control mr-2" name="cargo" id="cargo">
                    <?php
                    $query  = "SELECT * FROM cargos";
                    $result = mysqli_query($conexao, $query);
                    if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['cargo'] ?>">
                          <?php echo $row['cargo'] ?>
                        </option>

                      <?php
                      }
                    }
                    ?>
                  </select>
                  
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
  $dados = $_POST;	

	// Verificar se o CPF já é cadastrado
	$query  = "SELECT * FROM funcionarios WHERE cpf = '{$dados['txtcpf']}' ";
	$result = mysqli_query($conexao, $query);
	$row    = mysqli_num_rows($result);

	if ($row > 0) { // se encontrar, a operação é cancelada
	 	echo "<script type='text/javascript'>window.alert('CPF já cadastrado')</script>";
	 	exit;
	 }

	 // Inserir no banco	
   $query  = "INSERT INTO funcionarios (nome, cpf, telefone, endereco, cargo, data) 
              VALUES (
                      '{$dados['txtnome']}', 
                      '{$dados['txtcpf']}', 
                      '{$dados['txttelefone']}', 
                      '{$dados['txtendereco']}', 
                      '{$dados['cargo']}', 
                      now() 
                    )";

	 $result = mysqli_query($conexao, $query);
	
	 if ($result) {
	 	echo "<script type='text/javascript'>window.alert('Funcionario cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='funcionarios.php'</script>";

	 } else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Funcionario.')</script>";
    echo "<script type='text/javascript'>window.location='funcionarios.php'</script>";
	 }
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "DELETE FROM funcionarios WHERE id = $id";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='funcionarios.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM funcionarios WHERE id = '$id'";
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
                <h4 class="modal-title">Funcionarios</h4>
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
                  <label for="fornecedor">CPF</label>
                   <input type="text" class="form-control mr-2" name="txtcpf" id="txtcpf" value="<?php echo $row['cpf'] ?>" placeholder="CPF" required>
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
                  <label for="fornecedor">Cargo</label>
                  <select class="form-control mr-2" name="cargo" id="cargo">
                    <?php
                    $query  = "SELECT * FROM cargos";
                    $result = mysqli_query($conexao, $query);
                    if ($result) {
                      while ($row_cargo = mysqli_fetch_assoc($result)) {
                        // selecionar o cargo respectivo para deixar ativo
                        $check = ($row['cargo'] == $row_cargo['cargo']) ? 'selected=1' : '';
                        // lista no combobox
                        echo "<option $check value='{$row_cargo['cargo']}'>{$row_cargo['cargo']}</option>";

                      }
                    }
                    ?>
                  </select>
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
  $dados = $_POST;

  // se o cpf recuperado do banco for diferente do cpf digitado no campo:
  if ($row['cpf'] != $dados['txtcpf']) {
    // VERIFICACAO CPF CADASTRADO
    $query  = "SELECT * FROM funcionarios WHERE cpf = '{$dados['txtcpf']}'";
    $result = mysqli_query($conexao, $query);
    $row    = mysqli_num_rows($result);
    if ($row > 0) {
       echo "<script type='text/javascript'>window.alert('CPF já cadastrado.')</script>";
       exit;
     }
  }
  
  $query = "UPDATE funcionarios
            SET nome     = '{$dados['txtnome']}',
                cpf      = '{$dados['txtcpf']}',
                telefone = '{$dados['txttelefone']}',
                endereco = '{$dados['txtendereco']}',
                cargo    = '{$dados['cargo']}'
                
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Cliente alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='funcionarios.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='funcionarios.php'</script>";
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