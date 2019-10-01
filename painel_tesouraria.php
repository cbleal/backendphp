<?php 

require 'conexao.php';
require 'verificar_login.php';

// verificação de cargo logado
if ( $_SESSION['cargo_usuario'] != 'Administrador' && 
		 $_SESSION['cargo_usuario'] != 'Gerente' &&
		 $_SESSION['cargo_usuario'] != 'Tesoureiro' ) {
		
		// redireciona para a página
		header("Location: index.php");
		exit;		
}

// CONSULTA AO BANCO MOVIMENTACOES (TOTALIZA VALOR E QTDE REGISTROS)
$query  = "SELECT SUM(valor) AS total, COUNT(*) AS qtde FROM 
          movimentacoes WHERE data = curdate() 
          AND movimento = 'Servico' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$total_mov  = number_format($row['total'], 2, ',', '.');
$qtde_mov   = $row['qtde'];

// CONSULTA AO BANCO VENDAS (TOTALIZA VALOR E QTDE REGISTROS)
$query  = "SELECT SUM(valor) AS total, COUNT(*) AS qtde FROM 
          vendas WHERE data = curdate() 
          AND status = 'Efetuada' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$total_ven  = number_format($row['total'], 2, ',', '.');
$qtde_ven   = $row['qtde'];

// CONSULTA AO BANCO GASTOS (TOTALIZA VALOR E QTDE REGISTROS)
$query  = "SELECT SUM(valor) AS total, COUNT(*) AS qtde FROM 
          gastos WHERE data = curdate() ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$total_gas  = number_format($row['total'], 2, ',', '.');
$qtde_gas   = $row['qtde'];

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

$saldo  = number_format($row_ent['total_entradas'] - $row['total_saidas'], 2, ',', '.');

?>

<!DOCTYPE html>
<html lang="br">

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
            <a href="movimentacoes.php">
              <i class="nc-icon nc-circle-10"></i>
              <p>Movimentações</p>
            </a>
          </li>
          <li>
            <a href="gastos.php">
              <i class="nc-icon nc-diamond"></i>
              <p>Gastos</p>
            </a>
          </li>
          <li>
            <a href="vendas.php">
              <i class="nc-icon nc-pin-3"></i>
              <p>Vendas</p>
            </a>
          </li>
          <li>
            <a href="pagamentos.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Pagamentos</p>
            </a>
          </li>
          <li>
            <a href="compras.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Compras</p>
            </a>
          </li>         
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

                  <?php 

                    if($_SESSION['cargo_usuario'] == 'Administrador' || $_SESSION['cargo_usuario'] == 'Gerente'):

                  ?>
                        <a class="dropdown-item" href="painel_admin.php">Painel do Administrador</a>
                        <a class="dropdown-item" href="painel_tesouraria.php">Painel da Tesouraria</a>

                  <?php endif; ?>

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
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Serviços</p>
                      <p class="card-title">
                        <small><?php echo $total_mov; ?></small>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> 
                  Total Serviços: <?php echo $qtde_mov; ?>
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
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Vendas</p>
                      <p class="card-title">
                        <?php echo $total_ven; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> 
                  Total Vendas: <?php echo $qtde_ven; ?>
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
                      <i class="nc-icon nc-money-coins text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Gastos</p>
                      <p class="card-title">
                        <?php echo $total_gas; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> 
                  Total Gastos: <?php echo $qtde_gas; ?>
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
                      <i class="nc-icon nc-bank text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Saldo Diário:</p>

                      <p class="card-title">
                        <?php echo $saldo; ?>
                      <p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update now
                </div>
              </div>
            </div>
          </div>
        </div>
        


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
                </script>, Sistema PHP <i class="fa fa-heart heart"></i> Micropoint Informática
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
</body>

</html>