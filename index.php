<!DOCTYPE html> <!-- Template baixado no site: www.bootsnipp.com -->

<!-- inicia sess�o PHP -->
<?php session_start() ?>

<html>
<head>

    <!-- Bootstrap CSS -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- Fontawesome (�cones) -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- Arquivo CSS na pasta local css -->
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- T�tulo da p�gina -->
	<title>Login Sys Tec</title>
    
</head>

<body>

<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> 
                <img src="https://amar.vote/assets/img/amarVotebd.png" class="w-75" alt="Logo"> 
            </span>
            <br/>
            <span class="logo_title mt-5"> Login Dashboard </span>
            <!-- Mensagem -->
            <?php 
                // se o usu�rio n�o for localizado no banco
                if (isset($_SESSION['nao_autenticado'])): ?>
                    <p><small><small>
                        Usu�io ou Senha Inv�idos
                    </small></small></p>
            <?php endif;
                // encerra a sess�o
                unset($_SESSION['nao_autenticado']);
            ?>

        </div>
        <div class="card-body">
            <form action="login.php" method="POST">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" name="usuario" class="form-control" placeholder="Usu?io">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JQuery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</body>
</html>