<?php 
require 'conexao.php';

//session_start();
require 'verificar_login.php';

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
      <!--<form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="date" name="txtPesquisar" placeholder="Pesquisar" aria-label="Pesquisar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btPesquisar"><i class="fa fa-search"></i></button>
      </form>-->
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
                <!-- Inserir Novo -->
                <?php echo $_SESSION['nome_usuario']; ?>
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
                <h4 class="card-title"> Orçamentos Abertos</h4>
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
                      <!--<th>
                        Técnico
                      </th>-->
                      <th>
                        Produto
                      </th>
                      <th>
                        Defeito
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

                        $usuario = $_SESSION['nome_usuario'];

                        $query = "SELECT o.id, o.cliente, o.tecnico, o.produto, o.problema, o.data_abertura, c.nome as nome_cli FROM orcamentos as o INNER JOIN clientes as c ON c.cpf = o.cliente WHERE o.status = 'Aberto' ORDER BY o.id ASC";
                        
                       
                        $result = mysqli_query($conexao, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                          
                        ?>

                          <tr>
                            <td><?php echo $row['nome_cli']; ?></td>
                            <td><?php echo $row['produto']; ?></td>
                            <td><?php echo $row['problema']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['data_abertura'])); ?></td>         
                            <td>
                              <a class="btn btn-info" href="fechar_orcamentos.php?func=edita&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-pen-square"></i>
                              </a>
                           
                              <!--<a class="btn btn-danger" href="abrir_orcamentos.php?func=deleta&id=<?php echo $row['id'] ?>">
                                <i class="fas fa-trash-alt"></i>
                              </a>-->
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

<!-- Gravação -->
<?php 
if (@$_GET['func'] == 'edita') {
  $id = $_GET['id'];
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
                <h4 class="modal-title">Fechar Orçamento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Fim Modal Header -->

              <!-- Modal Body -->
              <div class="modal-body">     

                <div class="form-group">
                  <label for="id_produto">Valor Serviço</label>
                  <input type="text" class="form-control mr-2" name="txtvalor_servico" id="txtvalor_servico" placeholder="Valor Serviço" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Peças</label>
                  <input type="text" class="form-control mr-2" name="txtpecas" id="txtpecas" placeholder="Peças" required>
                </div>

                <div class="form-group">
                  <label for="quantidade">Valor Peças</label>
                  <input type="text" class="form-control mr-2" name="txtvalor_pecas" id="txtvalor_pecas" placeholder="Valor Peças" required>
                </div>

                 <div class="form-group">
                  <label for="id_produto">Laudo</label>
                  <textarea class="form-control mr-2" name="txtlaudo" id="txtlaudo" placeholder="Laudo" required></textarea>
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

<!-- Salvar os dados -->
<?php 

if (isset($_POST['btSalvar'])) {
  $dados = $_POST;
  $valor_servico = $_POST['txtvalor_servico'];
  $valor_pecas   = $_POST['txtvalor_pecas'];
  $valor_total   = $valor_servico + $valor_pecas;
  
  $query = "UPDATE orcamentos
            SET laudo             = '{$dados['txtlaudo']}',
                valor_servico     = '{$dados['txtvalor_servico']}',
                pecas             = '{$dados['txtpecas']}',
                valor_pecas       = '{$dados['txtvalor_pecas']}',
                sub_total         = '{$valor_total}',
                valor_total       = '{$valor_total}',
                data_geracao      = now(),
                status            = 'Aguardando'
                
            WHERE id = '{$id}'";

  $result = mysqli_query($conexao, $query);

  if ($result) {
    echo "<script type='text/javascript'>window.alert('Orçamento alterado com sucesso.')</script>";
    echo "<script type='text/javascript'>window.location='fechar_orcamentos.php'</script>";
  } else {
    echo "<script type='text/javascript'>window.alert('Erro ao alterar registro.')</script>";
    echo "<script type='text/javascript'>window.location='fechar_orcamentos.php'</script>";
  }
  
}

?>

<?php } ?> 


<!-- Máscaras -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#txttelefone').mask('(00) 00000-0000');
		$('#txtcpf').mask('000.000.000-00');
	});
</script>