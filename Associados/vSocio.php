<?php
include_once '../sess.php';
include_once '../dados.php';
include_once '../lib/qyuser.php';

$ClID = $_GET['ID'];
$db = DB();
$DadosSocio = $db->prepare("SELECT * FROM ic_socio WHERE id='$ClID'");
$DadosSocio->execute();
 $DS = $DadosSocio->fetch();
  $NomeSocio = $DS['nomeCom'];
  $DistSocio = $DS['aDist'];
  $NascSocio = $DS['dtNasc'];
  $PossSocio = $DS['dataPosse'];
  $FotoSocio = $DS['foto'];
  $idClube = $DS['codClub'];

$ChamaClube = $db->prepare("SELECT * FROM ic_clube WHERE id='$idClube'");
$ChamaClube->execute();
 $DC = $ChamaClube->fetch();
  $NomeClube = $DC['clubeNome'];







   $LinkCapa = $server . '/assets/images/backgrounds/user_bg4.png'

?>
<!DOCTYPE html>
<html lang="pt">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?php echo $Titulo; ?></title>
	<!-- Global stylesheets -->
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
 <!-- Core JS files -->
 <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
 <!-- /core JS files -->

 <!-- Theme JS files -->
 <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/core.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/wizards/form_wizard/form.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/styling/uniform.min.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jasny_bootstrap.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/validation/validate.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/notifications/sweet_alert.min.js"></script>

 <script type="text/javascript" src="../assets/js/core/app.js"></script>
 <script type="text/javascript" src="../assets/js/pages/wizard_form.js"></script>

 <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
 <!-- /theme JS files -->
 <script type="text/javascript" src="../assets/js/plugins/notifications/pnotify.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/components_notifications_pnotify.js"></script>
 <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
 <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/form_select2.js"></script>

<!-- Fab -->
 <script type="text/javascript" src="../assets/js/plugins/ui/fab.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/extra_fab.js"></script>
	<!-- /Fab -->


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
 <div class="navbar navbar-default" style="position: relative; z-index: 30">
  <div class="navbar-header">
   <a class="navbar-nav pull-right" >
    <img src="<?php echo $server; ?>assets/images/logos/icbr_logo.png" width=200 alt=""></a>
  </div>
 </div>
 <div class="page-container">
  <div class="page-content">
   <div class="content-wrapper">
	<div class="profile-cover">
	 <div class="profile-cover-img" style="background-image: url(<?php echo $LinkCapa; ?>)"></div>
	  <div class="media">
	   <div class="media-left">
		<a href="#" class="profile-thumb">
		 <img src="../assets/images/perfil/<?php echo $FotoSocio; ?>" class="img-circle" alt="">
		</a>
	   </div>
	   <div class="media-body">
		<h1><?php echo $NomeSocio; ?>
		 <small class="display-block">
		 Interact Club de <?php echo $NomeClube; ?><br />
		 Distrito <?php echo $DistSocio; ?>
		 </small>
		</h1>
	   </div>
	   <div class="col-xs-12">
	    <div class="media-right media-middle">
		 <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
 		  <li class="col-xs-6">
		   <a class="btn btn-default btn-block">Data de Posse: <?php echo dateConvert($PossSocio);?></a>
		  </li>
		  <li class="col-xs-6">
		   <a class="btn btn-default btn-block">Data de Nascimento: <?php echo dateConvert($NascSocio);?></a>
 		  </li>
	 	 </ul>
	    </div>
	   </div>
	  </div>
	 </div>






   </div>
  </div>
 </div>
</body>
</html>
