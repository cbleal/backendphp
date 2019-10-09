<?php 

require 'conexao.php';

?>

<!DOCTYPE html>
<html>

<head>
  <!-- Titulo -->
  <title>Consultar O.S.</title>
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
          <option value="Todas">Todas</option>
          <option value="Aberta">Aberta</option>
          <option value="Fechada">Fechada</option>          
          <option value="Cancelada">Cancelada</option>
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
                <h4 class="card-title"> Ordens de Serviços</h4>
              </div>
              <!-- Div Body -->
              <div class="card-body">
                <!-- Div Table Responsive -->
                <div class="table-responsive">
                  <!-- Table -->
                  <table class="table">
                    <thead class=" text-primary">                          
                      <th>
                        Cliente
                      </th>
                      <th>
                        Produto
                      </th>
                      <th>
                        Técnico
                      </th>
                      <th style="text-align: right">
                        Valor Total
                      </th>
                      <th>
                        Data Abertura
                      </th>
                      <th>
                        Data Fechamento
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

                        // pesquisa pela data informada e pelo status diferente de Todas
                        if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' && $_GET['status'] !='Todas' ) {
                          $data = $_GET['txtPesquisar'];
                          $status_orc = $_GET['status'];
                          $query = "SELECT ord.id, ord.cliente, ord.tecnico, ord.produto, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM os as ord INNER JOIN clientes as c ON c.cpf = ord.cliente INNER JOIN funcionarios f ON f.id = ord.tecnico WHERE ord.data_abertura = '{$data}' AND ord.status = '{$status_orc}' ORDER BY ord.id ASC";
                        
                        // pesquisa pela data atual e pelo status diferente de Todas 
                        } else if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] == '' && $_GET['status'] !='Todas' ) {                         
                          $status_orc = $_GET['status'];

                          $query = "SELECT ord.id, ord.cliente, ord.tecnico, ord.produto, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM os as ord INNER JOIN clientes as c ON c.cpf = ord.cliente INNER JOIN funcionarios f ON f.id = ord.tecnico WHERE ord.data_abertura = curDate() AND ord.status = '{$status_orc}' ORDER BY ord.id ASC";

                        // pesquisa pela data informada e pelo status igual a Todas
                        } else if ( isset($_GET['btPesquisar']) && $_GET['txtPesquisar'] != '' && $_GET['status'] == 'Todas' ) {          
                          $data = $_GET['txtPesquisar'];               
                          
                          $query = "SELECT ord.id, ord.cliente, ord.tecnico, ord.produto, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM os as ord INNER JOIN clientes as c ON c.cpf = ord.cliente INNER JOIN funcionarios f ON f.id = ord.tecnico WHERE ord.data_abertura = '{$data}' ORDER BY ord.id ASC";

                        // lista todos orçamentos da data atual
                        } else {
                           $query = "SELECT ord.id, ord.cliente, ord.tecnico, ord.produto, ord.valor_total, ord.data_abertura, ord.data_fechamento, ord.status, c.nome as nome_cli, c.email, f.nome as nome_tec FROM os as ord INNER JOIN clientes as c ON c.cpf = ord.cliente INNER JOIN funcionarios f ON f.id = ord.tecnico WHERE ord.data_abertura = curDate() ORDER BY ord.id ASC";
                        } 
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {

                          $data_abertura = implode('/', array_reverse(explode('-', $row['data_abertura'])));

                          $data_fechamento = implode('/', array_reverse(explode('-', $row['data_fechamento'])));
                          
                        ?>

                          <tr>
                            <td><?php echo $row['nome_cli']; ?></td>
                            <td><?php echo $row['produto']; ?></td>
                            <td><?php echo $row['nome_tec']; ?></td>
                            <td style="text-align: right"><?php echo number_format($row['valor_total'], 2, ',', '.'); ?></td>
                            <td style="text-align: center"><?php echo $data_abertura; ?></td>
                            <td style="text-align: center;"><?php echo $data_fechamento; ?></td>
                            <td><?php echo $row['status']; ?></td> 

                            <?php
                              if ($row['status'] == 'Fechada'):
                                ?>
                                <td>
                                  <a class="btn btn-info" href="rel/rel_os.php?id=<?php echo $row['id'] ?>&email=<?php echo $row['email'] ?>" data-toggle="tooltip" title="Imprimir">
                                    <i class="fas fa-print"></i>
                                  </a>
                           
                                  <a class="btn btn-danger" href="abrir_orcamentos.php?func=deleta&id=<?php echo $row['id'] ?>" data-toggle="tooltip" title="Excluir OS">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>
                                </td>

                            <?php 
                              else:
                            ?>
                                  
                            <td>
                              <a class="btn btn-secondary" href="#" data-toggle="tooltip" title="Imprimir">
                                <i class="fas fa-print"></i>
                              </a>
                           
                              <a class="btn btn-danger" href="abrir_orcamentos.php?func=deleta&id=<?php echo $row['id'] ?>" data-toggle="tooltip" title="Excluir OS">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr> 

                          <?php endif ?>                        

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
                <h4 class="modal-title">Novo Orçamento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="fornecedor">CPF</label>
                   <input type="text" class="form-control mr-2" name="txtcpf" id="txtcpf" placeholder="CPF" required>
                </div>

                <div class="form-group">
                  <label for="fornecedor">Técnico</label>
                  <select class="form-control mr-2" name="tecnico" id="cargo">
                    <?php
                    $query  = "SELECT * FROM funcionarios WHERE cargo = 'Tecnico'";
                    $result = mysqli_query($conexao, $query);
                    if ($result) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['id'] ?>">
                          <?php echo $row['nome'] ?>
                        </option>

                      <?php
                      }
                    }
                    ?>
                  </select>                  
                </div>

                <div class="form-group">
                  <label for="id_produto">Produto</label>
                  <input type="text" class="form-control mr-2" name="txtproduto" id="txtnumserie" placeholder="Produto" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Nº Série</label>
                  <input type="text" class="form-control mr-2" name="txtnumserie" id="txtnumserie" placeholder="Nº Série" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Defeito</label>
                  <input type="text" class="form-control mr-2" name="txtdefeito" id="txtdefeito" placeholder="Defeito" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Observações</label>
                  <input type="text" class="form-control mr-2" name="txtobs" id="txtobs" placeholder="Observações" required>
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
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script> 

  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>

</body>
</html>

<!-- Cadastrar -->
<?php  

if (isset($_POST['btSalvar'])) {
  $dados = $_POST;	

  // VERIFICAR SE O CPF ESTÁ CADASTRADO
  $query  = "SELECT * FROM clientes WHERE cpf = '{$dados['txtcpf']}'";
  $result = mysqli_query($conexao, $query);
  $row    = mysqli_num_rows($result);
  if ($row <= 0) {
     echo "<script type='text/javascript'>window.alert('Cliente não cadastrado.')</script>";
     exit();
   } 

	 // Inserir no banco	
   $query  = "INSERT INTO orcamentos (cliente, tecnico, produto, serie, problema, observacoes, valor_total, data_abertura, status) 
              VALUES (
                      '{$dados['txtcpf']}', 
                      '{$dados['tecnico']}', 
                      '{$dados['txtproduto']}',
                      '{$dados['txtnumserie']}', 
                      '{$dados['txtdefeito']}', 
                      '{$dados['txtobs']}',
                      '0',                      
                      now(),
                      'Aberto' 
                    )";

	 $result = mysqli_query($conexao, $query);
	
	 if ($result) {
	 	echo "<script type='text/javascript'>window.alert('Orçamento cadastrado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='abrir_orcamentos.php'</script>";

	 } else {
	 	echo "<script type='text/javascript'>window.alert('Erro ao cadastrar o Funcionario.')</script>";
    echo "<script type='text/javascript'>window.location='abrir_orcamentos.php'</script>";
	 }
}

?>

<!-- Exclusao -->
<?php 
if (@$_GET['func'] == 'deleta') {
  $id = $_GET['id'];
  $query = "DELETE FROM orcamentos WHERE id = '{$id}'";
  mysqli_query($conexao, $query);  
  echo "<script type='text/javascript'>window.location='abrir_orcamentos.php'</script>";
  
}
?>

<!-- Alteração -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];

  $query  = "SELECT * FROM orcamentos WHERE id = '$id' ";
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
                <h4 class="modal-title">Orçamentos</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">

                <div class="form-group">
                  <label for="fornecedor">Técnico</label>
                  <select class="form-control mr-2" name="tecnico" id="cargo">
                    <?php
                    $query  = "SELECT * FROM funcionarios WHERE cargo = 'Tecnico'";
                    $result = mysqli_query($conexao, $query);
                    if ($result) {
                      while ($rowt = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $rowt['id'] ?>">
                          <?php echo $rowt['nome'] ?>
                        </option>

                      <?php
                      }
                    }
                    ?>
                  </select>                  
                </div>

                <div class="form-group">
                  <label for="id_produto">Produto</label>
                  <input type="text" class="form-control mr-2" name="txtproduto" id="txtnumserie" value="<?php echo $row['produto'] ?>" placeholder="Produto" required>
                </div>

                <div class="form-group">
                  <label for="id_produto">Nº Série</label>
                  <input type="text" class="form-control mr-2" name="txtnumserie" id="txtnumserie" value="<?php echo $row['serie'] ?>" placeholder="Nº Série" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Defeito</label>
                  <input type="text" class="form-control mr-2" name="txtdefeito" id="txtdefeito" value="<?php echo $row['problema'] ?>" placeholder="Defeito" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Observações</label>
                  <input type="text" class="form-control mr-2" name="txtobs" id="txtobs" value="<?php echo $row['observacoes'] ?>" placeholder="Observações" required>
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
  
  $query = "UPDATE orcamentos
            SET tecnico     = '{$dados['tecnico']}',
                produto     = '{$dados['txtproduto']}',
                serie       = '{$dados['txtnumserie']}',
                problema    = '{$dados['txtdefeito']}',
                observacoes = '{$dados['txtobs']}'
                
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Orçamento alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='abrir_orcamentos.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='abrir_orcamentos.php'</script>";
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