<?php 

require 'conexao.php';
require 'verificar_login.php';

$id_funcionario = $_SESSION['id_funcionario'];

// CONSULTA AO BANCO ORCAMENTOS (TOTAL REGISTROS STATUS = ABERTO)
$query = "SELECT COUNT(*) AS qtd 
          FROM orcamentos 
          WHERE status = 'Aberto'
          AND tecnico = '{$id_funcionario}' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_or = $row['qtd'];

// CONSULTA AO BANCO OS (TOTAL REGISTROS STATUS = ABERTA)
$query = "SELECT COUNT(*) AS qtd 
          FROM os 
          WHERE status = 'Aberta'
          AND tecnico = '{$id_funcionario}' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_os = $row['qtd'];

// CONSULTA AO BANCO ORCAMENTOS (TOTAL REGISTROS STATUS = AGUARDANDO)
$query = "SELECT COUNT(*) AS qtd 
          FROM orcamentos 
          WHERE status = 'Aguardando'
          AND tecnico = '{$id_funcionario}' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_ag = $row['qtd'];

// CONSULTA AO BANCO OS (TOTAL REGISTROS POR M�S E POR FUNCION�RIO)
$ano = date('Y');
$mes = date('m');
$dataIni = $ano.'-'.$mes.'-01';
$dataFim = $ano.'-'.$mes.'-31';
$query = "SELECT COUNT(*) AS qtd 
          FROM os 
          WHERE status = 'Fechada'
          AND data_fechamento
          BETWEEN '{$dataIni}'
          AND '{$dataFim}'
          AND tecnico = '{$id_funcionario}' ";
$result = mysqli_query($conexao, $query);
$row    = mysqli_fetch_assoc($result);
$qtd_me = $row['qtd'];

?>

<!DOCTYPE html>
<html lang="br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SysTec Freitas
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
          SysTec Freitas
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="clientes.php">
              <i class="nc-icon nc-circle-10"></i>
              <p>Clientes</p>
            </a>
          </li>
          <li>
            <a href="produtos.php">
              <i class="nc-icon nc-diamond"></i>
              <p>Produtos</p>
            </a>
          </li>
          <li>
            <a href="abrir_orcamentos.php">
              <i class="nc-icon nc-diamond"></i>
              <p>Abrir Or�amento</p>
            </a>
          </li>
          <li>
            <a href="fechar_orcamentos.php">
              <i class="nc-icon nc-pin-3"></i>
              <p>Fechar Or�amento</p>
            </a>
          </li>
          <li>
            <a href="rel_orcamentos.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Relat�rio Or�amento</p>
            </a>
          </li>
          <li>
            <a href="os_abertas.php">
              <i class="nc-icon nc-single-02"></i>
              <p>OS Abertas</p>
            </a>
          </li>
          <li>
            <a href="consultar_os.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Consultar OS</p>
            </a>
          </li>
          <!--<li>
            <a href="./typography.html">
              <i class="nc-icon nc-caps-small"></i>
              <p>Typography</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li>-->
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
                      <i class="nc-icon nc-check-2 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">OS Fechadas</p>
                      <p class="card-title">
                        <?php echo $qtd_me; ?>
                      <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Ordens Servico do Mes
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- LINHA -->
      <div class="row">
        <!-- COLUNA (col-md-6 = 50%) - dispositivos m�dios - largura da tela igual ou superior a 768 px -->
        <div class="col-md-6">
          <!-- MARGEM TOP = 5 -->
          <p class="mt-5">OR�AMENTOS ABERTOS</p>
        </div>
        <!-- COLUNA (col-md-6 = 50%) - dispositivos m�dios - largura da tela igual ou superior a 768 px -->
        <div class="col-md-6">
          <!-- MARGEM TOP = 5 -->
          <p class="mt-5">OS ABERTAS</p>
        </div>
      </div>

      <hr>

      <!-- Div Row Cards -->
      <div class="row">

      <!-- VERIFICAR OR�AMENTOS ABERTOS -->
      <?php 

        $query  = "SELECT o.id, o.problema, o.data_abertura, f.nome FROM orcamentos AS o INNER JOIN funcionarios AS f ON f.id = o.tecnico WHERE o.status = 'Aberto' AND tecnico = '{$id_funcionario}' ";
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

        $query  = "SELECT ord.id, ord.produto, ord.data_abertura, f.nome FROM os AS ord INNER JOIN funcionarios AS f ON f.id = ord.tecnico WHERE ord.status = 'Aberta' AND tecnico = '{$id_funcionario}'";
        $result = mysqli_query($conexao, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {

          ?>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
              <div class="card-header" style="font-size: 16px">
                <?php echo fmtData($row['data_abertura']); ?>                  
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
                  <a href="https://www.creative-tim.com" target="_blank">SYSTEC FREITAS</a>
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
                �
                <script>
                  document.write(new Date().getFullYear())
                </script>, Treinamento PHP <i class="fa fa-heart heart"></i> Hugo Vasconcelos
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
