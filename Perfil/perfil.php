<?php
include_once '../sess.php';
include_once '../dados.php';
include_once '../lib/qyuser.php';
$db = DB();
?>
<!DOCTYPE html>
<html lang="pt">
<head> 
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?php echo $Titulo; ?></title>
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="../assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">

	<link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
</head>
<?php
if (isset($_GET["sucesso"])) {

$CodSucesso = $_GET["sucesso"];
$CodEvento = $_GET["evento"];
$CodMSG = $_GET["mensagem"];

echo "<script>
function myFunction() {
 new PNotify({
 title: '" . $CodEvento . "',
 text: '" . $CodMSG . "',
 addclass: '" . $CodSucesso . "'
 });
}
</script>";

} ?>
<body onload="myFunction()">
 <div class="navbar navbar-default " style="position: relative; z-index: 30">
  <div class="navbar-header">
   <a class="navbar-nav pull-right" >
    <img src="<?php echo $server; ?>assets/images/logos/icbr_logo.png" width=200 alt=""></a>
   <ul class="nav navbar-nav pull-left visible-xs-block">
    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
   </ul>	
  </div>
  <div class="navbar-collapse collapse" id="navbar-mobile">
   <div class="navbar-right">
    <p class="navbar-text">Ol&aacute;, <?php echo $nomSocio; ?>!</p>				
    <?php include_once '../notifications.php' ?>
   </div>
  </div>
 </div>
 <div class="page-container">
 <div class="page-content">
  <?php 
   include_once '../sidebar.php'; 
   ?>
  <div class="content-wrapper">
   <div class="page-header">
	  <div class="page-header-content">
	   <div class="page-title">
	    <h4><i class="icon-arrow-left52 position-left"></i> 
	     <span class="text-semibold">Meu Perfil</span></h4>
	   </div>
	  </div>
   </div>
   <div class="content">


     <ul class="fab-menu fab-menu-fixed fab-menu-top-left" data-fab-toggle="click">
     <li>
    <a class="fab-menu-btn btn bg-orange-400 btn-float btn-rounded btn-icon">
     <i class="fab-icon-open icon-paragraph-justify3"></i>
     <i class="fab-icon-close icon-cross2"></i>
    </a>
    <ul class="fab-menu-inner">
     <li>
      <button type="button" class="btn bg-danger-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#TrocaSenha"><b>
       <i class="icon-key"></i></b> Atualizar Senha
      </button>       
     </li>
     <li>
      <button type="button" class="btn bg-success-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#ConselhoDiretor"><b>
       <i class="icon-users2"></i></b> Atualizar Apelido
      </button>       
     </li>
     <li>
      <button type="button" class="btn bg-purple-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#Email"><b>
       <i class="icon-calendar2"></i></b> Atualizar Data de Nascimento
      </button>       
     </li>
     <li>
      <button type="button" class="btn bg-blue-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#Reuniao"><b>
       <i class="icon-pin"></i></b> Atualizar Endereço
      </button>       
     </li>

    </ul>
     </li>
    </ul>




    <div class="col-md-4 col-xs-12">
     <div class="thumbnail">
      <div class="thumb thumb-rounded thumb-slide">
       <img src="<?php echo $server; ?>assets/images/perfil/<?php echo $phoSocio; ?>" alt="">
      </div>        
      <div class="caption text-center">
       <h6 class="text-semibold no-margin"><?php echo $nomSocio; ?></h6>
      </div>
      <div class="list-group no-border">
       <a class="list-group-item">Interact Club de 
        <div class="text-muted text-size-small"><?php echo $NomeClube; ?></div>
       </a>
       <a class="list-group-item">Distrito <?php echo $Distrito; ?></a>
       <a class="list-group-item">Data de Nascimento: <?php echo dateConvert($DtNasc); ?></a>
      </div>
     </div>
    </div>
    <div class="col-md-8 col-xs-12">
     <div class="panel panel-flat">
      <div class="panel-body">
       <div class="tabbable">
        <ul class="nav nav-pills">
         <li class="active">
          <a href="#perfil" data-toggle="tab">Dados do Perfil</a>
         </li>
         <li><a href="#associado" data-toggle="tab">Dados de Associado</a></li>
        </ul>
        <div class="tab-content">
         <div class="tab-pane fade in active" id="perfil">
          <div class="sidebar-category">
           <div class="category-content">
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Apelido:</label>
             <div class="pull-right"><?php echo $user->name; ?></div>
            </div>
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Usu&aacute;rio:</label>
             <div class="pull-right"><?php echo $user->username; ?></div>
            </div>
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Senha:</label>
             <div class="pull-right"><?php echo $user->password; ?></div>
            </div>
           </div>
          </div>
         </div>
         <div class="tab-pane fade" id="associado">
          <div class="sidebar-category">
           <div class="category-content">
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Apelido:</label>
             <div class="pull-right"><?php echo $user->name; ?></div>
            </div>
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Usu&aacute;rio:</label>
             <div class="pull-right"><?php echo $user->username; ?></div>
            </div>
            <div class="form-group">
             <label class="control-label no-margin text-semibold">Senha:</label>
             <div class="pull-right"><?php echo $user->password; ?></div>
            </div>
           </div>
          </div>          
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   <?php 
   include_once 'modals.php';
   include_once '../footer.php'; ?>
   </div><!-- /content area -->
  </div><!-- /main content -->
 </div><!-- /page content -->
</div><!-- /page container -->
</body>
<!-- Core JS files -->
 <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/core.min.js"></script>	
 <script type="text/javascript" src="../assets/js/core/libraries/jasny_bootstrap.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/app.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
 <!-- /core JS files -->
 <!-- DATATABLES -->
 <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
 <!-- //DATATABLES --> 
 <!-- NOTIFICAÇÕES -->
 <script type="text/javascript" src="../assets/js/plugins/notifications/pnotify.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/components_notifications_pnotify.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
 <!-- //NOTIFICAÇÕES -->
 <!-- FORMS -->
 <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/styling/uniform.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/validation/validate.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/wizard_form.js"></script>
 <!-- //FORMS -->		

<!-- FAB -->
 <script type="text/javascript" src="../assets/js/plugins/ui/fab.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/extra_fab.js"></script>
<!-- /FAB -->

</html>
