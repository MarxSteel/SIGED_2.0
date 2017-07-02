<?php
/*
 * Tutorial: PHP Login Registration system
 *
 * Page index.php
 * */

// Start Session
session_start();

// Database connection
require __DIR__ . '/database.php';
$db = DB();

// Application library ( with DemoLib class )
require __DIR__ . '/lib/library.php';
$app = new DemoLib();

$login_error_message = '';
$register_error_message = '';

// check Login request
if (!empty($_POST['btnLogin'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $login_error_message = 'Usuário Obrigatório!';
    } else if ($password == "") {
        $login_error_message = 'Obrigatório digitar senha!';
    } else {
        $user_id = $app->Login($username, $password); // check user login
        if($user_id > 0)
        {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: dashboard.php"); // Redirect user to the profile.php
        }
        else
        {
            $login_error_message = 'Login ou senha inválidos!';
        }
    }
}


?>


<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Sistema de Gestão Distrital - SIGED</title>
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"> 
 <link href="assets/css/core.css" rel="stylesheet" type="text/css">
 <link href="assets/css/components.css" rel="stylesheet" type="text/css">
 <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
 <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
 <script type="text/javascript" src="assets/js/core/app.js"></script>
 <script type="text/javascript" src="assets/js/pages/login.js"></script>
 <script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
</head>
<body class="login-container">
 <div class="page-container">
  <div class="page-content">
   <div class="content-wrapper">
    <div class="content pb-20">
     <form action="index.php" method="post">
      <div class="panel panel-body login-form">
       <div class="text-center">
        <img src="assets/images/logos/ICBrasil_Direita.png" width="115%">         
         <?php
         if ($login_error_message != "") 
         {
          echo '
          <div class="alert alert-danger alert-styled-left alert-bordered">
          <span class="text-semibold">Erro!</span>   
          N&atilde;o foi possível acessar o sistema. <br />Erro: ' . $login_error_message . '</div>';
         }
         ?>
       </div>
       <div class="form-group has-feedback has-feedback-left">
         <input type="text" class="form-control" name="username" placeholder="Digite seu Usu&aacute;rio" required autofocus>
         <div class="form-control-feedback"><i class="icon-user text-muted"></i></div>
       </div>
       <div class="form-group has-feedback has-feedback-left">
        <input type="password" class="form-control" name="password" placeholder="Digite sua Senha" required>
        <div class="form-control-feedback"><i class="icon-lock2 text-muted"></i></div>
       </div>
       <div class="form-group">
        <input type="submit" name="btnLogin" class="btn bg-pink-400 btn-block" value="Entrar no Sistema">
       </div>
        <span class="help-block text-center no-margin">&copy; 2017 <a href="#">MDIO Interact Brasil</a>. Todos os Direitos Reservados<br />Desenvolvido por <b>Marquistei Medeiros</b></span>
      </div>
     </form>
    </div>
   </div>
  </div>
 </div>
</body>
</html>
