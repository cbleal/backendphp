<?php 

require 'conexao.php';
require 'verificar_login.php';

// verificação de cargo logado
if ( $_SESSION['cargo_usuario'] != 'Administrador' && 
		 $_SESSION['cargo_usuario'] != 'Gerente' ) {
		
		// redireciona para a página
		header("Location: index.php");
		exit;		
}

// CONSULTA AO BANCO ORCAMENTOS (TOTAL REGISTROS STATUS = ABERTO)
$query = "SELECT COUNT(*) AS qtd 
          FROM orcamentos 
          WHERE status = 'Aberto' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_or = $row['qtd'];

// CONSULTA AO BANCO OS (TOTAL REGISTROS STATUS = ABERTA)
$query = "SELECT COUNT(*) AS qtd 
          FROM os 
          WHERE status = 'Aberta' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_os = $row['qtd'];

// CONSULTA AO BANCO ORCAMENTOS (TOTAL REGISTROS STATUS = AGUARDANDO)
$query = "SELECT COUNT(*) AS qtd 
          FROM orcamentos 
          WHERE status = 'Aguardando' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_ag = $row['qtd'];

// CONSULTA AO BANCO MOVIMENTACOES (TOTALIZA VALOR POR ENTRADA E SAIDA)
$query_ent = "SELECT SUM(valor) AS total_entradas 
              FROM movimentacoes WHERE data = curdate()
              AND tipo = 'Entrada' ";
$result_ent = mysqli_query($conexao, $query_ent);
$row_ent    = mysqli_fetch_assoc($result_ent);

$query_sai = "SELECT SUM(valor) AS total_saidas 
              FROM movimentacoes WHERE data = curdate()
              AND tipo = 'Saida' ";
$result_sai = mysqli_query($conexao, $query_sai);
$row_sai    = mysqli_fetch_assoc($result_sai);

$saldo  = number_format($row_ent['total_entradas'] - $row_sai['total_saidas'], 2, ',', '.');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SysTec Micropoint
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          SysTec Micropoint
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="funcionarios.php">
              <i class="nc-icon nc-circle-10"></i>
              <p>Funcionarios</p>
            </a>
          </li>
          <li>
            <a href="usuarios.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li>
            <a href="cargos.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Cargos</p>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="modal" data-target=#modalOrc>
              <i class="nc-icon nc-diamond"></i>
              <p>Rel. Orçamentos</p>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="modal" data-target="#modalOS">
              <i class="nc-icon nc-pin-3"></i>
              <p>Rel. O.S.</p>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="modal" data-target="#modalMov">
              <i class="nc-icon nc-bell-55"></i>
              <p>Rel. Movimentações</p>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="modal" data-target="#modalGastos">
              <i class="nc-icon nc-caps-small"></i>
              <p>Rel. Gastos</p>
            </a>
          </li>

          <!--<?php if ($_SESSION['cargo_usuario'] == 'Administrador'):?>
            
                <li class="active-pro">
                  <a href="#" data-toggle='modal' data-target='#modalDados'>
                  <i class="nc-icon nc-spaceship"></i>
                  <p>Excluir Dados</p>
                  </a>
                </li>

          <?php endif; ?>-->

          <?php 
            if ($_SESSION['cargo_usuario'] == 'Administrador') {

              ?>
            
              <?php 
                $query = "SELECT * FROM backup WHERE data = curdate()";
                $result = mysqli_query($conexao, $query);
                $row = mysqli_num_rows($result);
                if ($row > 0) {
                  ?>
                  <li class="active-pro">
                    <a href="#" data-toggle='modal' data-target='#modalDados'>
                    <i class="nc-icon nc-spaceship"></i>
                    <p>Excluir Dados</p>
                    </a>
                  </li>
                  <?php 
                } else {
                  ?>
                    <li class="active-pro">
                      <a href="#" data-toggle='modal' data-target='#modalMensagem'>
                      <i class="nc-icon nc-spaceship"></i>
                      <p>Excluir Dados</p>
                      </a>
                    </li>
                   
                <?php } } ?>
       
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"></a>
          </div>
         
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
             
              <li class="nav-item btn-rotate dropdown">

                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                	<?php echo $_SESSION['nome_usuario']; ?>
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Sair</a>
                  <a class="dropdown-item" href="painel_funcionario.php">Painel do Funcionario</a>
                  <a class="dropdown-item" href="painel_tesouraria.php">Painel da Tesouraria</a>
                  <a class="dropdown-item" href="backup.php">Backup</a>
                </div>

              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-copy-04 text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Orcamentos</p>
                      <p class="card-title">
                        <?php echo $qtd_or; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> 
                  Orcamentos Abertos 
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">OS</p>
                      <p class="card-title">
                        <?php echo $qtd_os; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> OS Abertas
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-email-85 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Aprovacao</p>
                      <p class="card-title">
                        <?php echo $qtd_ag; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> 
                  Orcam. Aguardando
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Saldo Diario</p>
                      <p class="card-title">
                        <?php 
                          if ( $saldo >= 0 ) { 
                            echo '<font color="green">'.$saldo.' </font>';
                          } else {
                            echo '<font color="red">'.$saldo.' </font>';
                          }

                        ?>   
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Valor Arrecadado Hoje
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- LINHA -->
      <div class="row">
        <!-- COLUNA (col-md-6 = 50%) - dispositivos médios - largura da tela igual ou superior a 768 px -->
        <div class="col-md-6">
          <!-- MARGEM TOP = 5 -->
          <p class="mt-5">ORÇAMENTOS ABERTOS</p>
        </div>
        <!-- COLUNA (col-md-6 = 50%) - dispositivos médios - largura da tela igual ou superior a 768 px -->
        <div class="col-md-6">
          <!-- MARGEM TOP = 5 -->
          <p class="mt-5">OS ABERTAS</p>
        </div>
      </div>

      <hr>

      <!-- Div Row Cards -->
      <div class="row">

      <!-- VERIFICAR ORÇAMENTOS ABERTOS -->
      <?php 

        $query  = "SELECT o.id, o.problema, o.data_abertura, f.nome FROM orcamentos AS o INNER JOIN funcionarios AS f ON f.id = o.tecnico WHERE o.status = 'Aberto'";
        $result = mysqli_query($conexao, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {

          ?>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header" style="font-size: 16px">
                <?php echo date('d/m/Y', strtotime($row['data_abertura'])); ?>                  
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nome']; ?></h5>
                <p class="card-text"><?php echo $row['problema']; ?></p>
              </div>
            </div>
          </div>

        <?php 
          }
        ?>
      
      <!-- VERIFICAR OS ABERTAS -->
      <?php 

        $query  = "SELECT ord.id, ord.produto, ord.data_abertura, f.nome FROM os AS ord INNER JOIN funcionarios AS f ON f.id = ord.tecnico WHERE ord.status = 'Aberta'";
        $result = mysqli_query($conexao, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {

          ?>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
              <div class="card-header" style="font-size: 16px">
                <?php echo date('d/m/Y', strtotime($row['data_abertura'])); ?>                  
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nome']; ?></h5>
                <p class="card-text"><?php echo $row['produto']; ?></p>
              </div>
            </div>
          </div>

        <?php 
          }
        ?>

      </div>
      <!-- Fim Div Row Cards -->

      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">SYSTEC MICROPOINT</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, Treinamento PHP <i class="fa fa-heart heart"></i> Micropint Informática
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>

  <!-- Modal Orçamento -->
  <div class="modal fade" id="modalOrc" role="dialog">
     <!-- Form -->
    <form method="POST" action="rel/rel_orcamentos_data_class.php">
    <!-- Modal Dialog -->
      <div class="modal-dialog modal-lg">
        <!-- Modal Content -->
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Relatório de Orçamento</h4>
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
              <!-- Row 1 -->
              <div class="row">
                <!-- Col Status -->
                <div class="col-md-4">
                  <label>Status</label>
                </div>
                <!-- Fim Col Status -->
                <!-- Col Data Inicial -->
                <div class="col-md-4">
                  <label>Data Inicial</label>
                </div>
                <!-- Fim Col Data Inicial -->
                <!-- Col Data Final -->
                <div class="col-md-4">
                  <label>Data Final</label>
                </div>
                <!-- Fim Col Data Inicial -->
              </div>
              <!-- Fim Row 1 -->

              <!-- Row 2 -->
              <div class="row">
                <!-- Col Status -->
                <div class="col-md-4 mt-2">
                  <select class="form-control" id="category" name="status">
                    <option value="Todos">Todos</option>
                    <option value="Aberto">Aberto</option>
                    <option value="Aguardando">Aguardando</option>
                    <option value="Aprovado">Aprovado</option>
                    <option value="Cancelado">Cancelado</option>
                  </select>
                </div>
                <!-- Fim Col Status -->
                <!-- Col Data Inicial -->
                <div class="col-md-4 mt-2">
                  <input class="form-control" type="date" name="txtDataInicial">
                </div>
                <!-- Fim Col Data Inicial -->
                <!-- Col Data Final -->
                <div class="col-md-4 mt-2">
                  <input class="form-control" type="date" name="txtDataFinal">
                </div>
                <!-- Fim Col Data Inicial -->
              </div>
              <!-- Fim Row 2 -->
          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" type="submit" name="btnOK">
              OK
            </button>
            <button class="btn btn-danger mb-3" type="button" data-dismiss="modal">
              Cancelar
            </button>
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal Orçamento -->

  <!-- Modal OS -->
  <div class="modal fade" id="modalOS" role="dialog">
    <!-- Form -->
    <form method="POST" action="rel/rel_os_data_class.php">
      <!-- Modal Dialog -->
      <div class="modal-dialog modal-lg">
        <!-- Modal Content -->
        <div class="modal-content">
          
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Relatório de Ordens de Serviço</h4>
            <button class="close" type="button" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
            <!-- Row 1 -->
            <div class="row">
              <!-- Col Status -->
              <div class="col-md-4">
                 <label>Status</label>
              </div>
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-md-4">
                <label>Data Inicial</label>
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
                <div class="col-md-4">
                  <label>Data Final</label>
                </div>
                <!-- Fim Col Data Inicial -->
              </div>
              <!-- Fim Row 1 -->

            <!-- Row 2 -->
            <div class="row">
              <!-- Col Status -->
              <div class="col-md-4 mt-2">
                <select class="form-control" id="category" name="status">
                  <option value="Todas">Todas</option>
                  <option value="Aberta">Abertas</option>
                  <option value="Fechada">Fechadas</option>
                  <option value="Cancelada">Canceladas</option>
                </select>
              </div>
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-md-4 mt-2">
                <input class="form-control" type="date" name="txtDataInicial">
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
              <div class="col-md-4 mt-2">
                <input class="form-control" type="date" name="txtDataFinal">
              </div>
              <!-- Fim Col Data Inicial -->
            </div>
            <!-- Fim Row 2 -->
          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" type="submit" name="btnOK">
              OK
            </button>
            <button class="btn btn-danger mb-3" type="button" data-dismiss="modal">
              Cancelar
            </button>
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal OS -->

  <!-- Modal Movimentações -->
  <div class="modal fade" id="modalMov" role="dialog">
    <!-- Form -->
    <form method="POST" action="rel/rel_mov_data_class.php">
      <!-- Modal Dialog -->
      <div class="modal-dialog modal-lg">
        <!-- Modal Content -->
        <div class="modal-content">
          
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Relatório de Movimentações</h4>
            <button class="close" type="button" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
            <!-- Row 1 -->
            <div class="row">
              <!-- Col Status -->
              <div class="col-md-4">
                 <label>Status</label>
              </div>
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-md-4">
                <label>Data Inicial</label>
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
                <div class="col-md-4">
                  <label>Data Final</label>
                </div>
                <!-- Fim Col Data Inicial -->
              </div>
              <!-- Fim Row 1 -->

            <!-- Row 2 -->
            <div class="row">
              <!-- Col Status -->
              <div class="col-md-4 mt-2">
                <select class="form-control" id="category" name="tipo">
                  <option value="Todas">Todas</option>
                  <option value="Entrada">Entradas</option>
                  <option value="Saida">Saidas</option>                
                </select>
              </div>
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-md-4 mt-2">
                <input class="form-control" type="date" name="txtDataInicial">
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
              <div class="col-md-4 mt-2">
                <input class="form-control" type="date" name="txtDataFinal">
              </div>
              <!-- Fim Col Data Inicial -->
            </div>
            <!-- Fim Row 2 -->
          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" type="submit" name="btnOK">
              OK
            </button>
            <button class="btn btn-danger mb-3" type="button" data-dismiss="modal">
              Cancelar
            </button>
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal Movimentações -->

  <!-- Modal Gastos -->
  <div class="modal fade" id="modalGastos" role="dialog">
    <!-- Form -->
    <form method="POST" action="rel/rel_gastos_data_class.php">
      <!-- Modal Dialog -->
      <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
          
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Relatório de Gastos</h4>
            <button class="close" type="button" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
            <!-- Row 1 -->
            <div class="row">
              <!-- Col Status -->
              <!--<div class="col-md-4">
                 <label>Status</label>
              </div>-->
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-6">
                <label>Data Inicial</label>
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
                <div class="col-6">
                  <label>Data Final</label>
                </div>
                <!-- Fim Col Data Inicial -->
              </div>
              <!-- Fim Row 1 -->

            <!-- Row 2 -->
            <div class="row">
              <!-- Col Status -->
              <!--<div class="col-md-4 mt-2">
                <select class="form-control" id="category" name="tipo">
                  <option value="Todas">Todas</option>
                  <option value="Entrada">Entradas</option>
                  <option value="Saida">Saidas</option>                
                </select>
              </div>-->
              <!-- Fim Col Status -->
              <!-- Col Data Inicial -->
              <div class="col-6 mt-2">
                <input class="form-control" type="date" name="txtDataInicial">
              </div>
              <!-- Fim Col Data Inicial -->
              <!-- Col Data Final -->
              <div class="col-6 mt-2">
                <input class="form-control" type="date" name="txtDataFinal">
              </div>
              <!-- Fim Col Data Inicial -->
            </div>
            <!-- Fim Row 2 -->
          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" type="submit" name="btnOK">
              OK
            </button>
            <button class="btn btn-danger mb-3" type="button" data-dismiss="modal">
              Cancelar
            </button>
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal Gastos -->

  <!-- Modal Dados -->
  <div class="modal fade" id="modalDados" role="dialog">
    <!-- Form -->
    <form method="POST" action="">
      <!-- Modal Dialog -->
      <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
          
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Excluir Dados do Banco</h4>
            <button class="close" type="button" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
            <!-- Row 1 -->
            <div class="row">              
              <!-- Col Ano -->
              <div class="col-12 ml-2">
                <label>Ano</label>
              </div>
              <!-- Fim Col Ano -->              
            </div>
            <!-- Fim Row 1 -->

            <!-- Row 2 -->
            <div class="row">
              <!-- Col Ano -->
              <div class="col-md-6 mt-2">
                <!-- PEGA O ANO ATUAL -->
                <?php $ano = date('Y') ?>
                <select class="form-control" id="category" name="ano">
                  <?php 
                    for ( $i = 1; $i <= 4; $i++) {
                      ?>
                      <option value=<?php echo $ano - $i ?> >
                        <?php echo $ano - $i ?>                         
                      </option>
                      <?php
                    }
                  ?>                          
                </select>
              </div>
              <!-- Fim Col Ano -->              
            </div>
            <!-- Fim Row 2 -->

          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" type="submit" name="btnOK">
              OK
            </button>
            <button class="btn btn-danger mb-3" type="button" data-dismiss="modal">
              Cancelar
            </button>
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal Dados -->

<!-- EXCLUSÃO DADOS DO BANCO -->
<?php 

if (isset($_POST['btnOK'])) {

  $ano = $_POST['ano'];
  $data_ini = $ano.'-01-01';
  $data_fim = $ano.'-12-31';

  //EXCLUIR DADOS DAS VENDAS DO ANO ANTERIOR
  $query = "DELETE FROM vendas 
            WHERE data 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";
  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DAS COMPRAS DO ANO ANTERIOR
  $query = "DELETE FROM compras 
            WHERE data 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";

  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DAS MOVIMENTACOES DO ANO ANTERIOR
  $query = "DELETE FROM movimentacoes 
            WHERE data 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";

  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DOS GASTOS DO ANO ANTERIOR
  $query = "DELETE FROM gastos 
            WHERE data 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";

  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DOS PAGAMENTOS DO ANO ANTERIOR
  $query = "DELETE FROM pagamentos 
            WHERE data 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";

  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DOS ORCAMENTOS DO ANO ANTERIOR
  $query = "DELETE FROM orcamentos 
            WHERE data_abertura 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";

  mysqli_query($conexao, $query);

  //EXCLUIR DADOS DAS OS DO ANO ANTERIOR
  $query = "DELETE FROM os 
            WHERE data_abertura 
            BETWEEN '{$data_ini}' 
            AND '{$data_fim}'
            ";
 
  mysqli_query($conexao, $query);

  echo "<script type='text/javascript'>window.location='painel_admin.php'</script>";
  
}

?>  

  <!-- Modal Mensagem -->
  <div class="modal fade" id="modalMensagem" role="dialog">
    <!-- Form -->
    <form method="POST" action="">
      <!-- Modal Dialog -->
      <div class="modal-dialog">
        <!-- Modal Content -->
        <div class="modal-content">
          
          <!-- Modal Header -->
          <div class="modal-header">
            <!-- Modal Title -->
            <h4 class="modal-title">Excluir Dados do Banco</h4>
            <button class="close" type="button" data-dismiss="modal">
              &times;
            </button>
            <!-- Fim Modal Title -->
          </div>
          <!-- Fim Modal Header -->

          <!-- Modal Body -->
          <div class="modal-body">
            
            <div class="row">
              <div class="col-md-12">
                <p>Faça antes o Backup dos Dados.</p>
              </div>              
            </div>

          </div>
          <!-- Fim Modal Body -->

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button class="btn btn-success mb-3" name="buttonOK">
              OK
            </button>           
          </div>
          <!-- Fim Modal Footer -->

        </div>
        <!-- Fim Modal Content -->
      </div>
      <!-- Fim Modal Dialog -->
    </form>
    <!-- Fim Form -->
  </div>
  <!-- Fim Modal Mensagem -->

</body>
</html>