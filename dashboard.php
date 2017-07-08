<?php
include_once 'sess.php';
include_once 'dados.php';
include_once 'lib/qyuser.php';
$cHome = 'class="active"';
$QuantClube = $db->query("SELECT COUNT(*) FROM ic_clube WHERE status='A' AND clubeDistrito='$Distrito'")->fetchColumn();

$QuantSocio = $db->query("SELECT COUNT(*) FROM ic_socio WHERE aStatus='A' AND aDist='$Distrito'")->fetchColumn();

?>
<!DOCTYPE html>
<html lang="pt">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?php echo $Titulo; ?></title>
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
 <link href="assets/css/core.css" rel="stylesheet" type="text/css">
 <link href="assets/css/components.css" rel="stylesheet" type="text/css">
 <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
 <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
 <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
 <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
 <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
 <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
 <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
 <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>

 <script type="text/javascript" src="assets/js/core/app.js"></script>
 <script type="text/javascript" src="assets/js/pages/dashboard.js"></script>

 <script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->


<style type="text/css">


a:visited{
text-decoration:none;
color:white;
}

a:visited{
text-decoration:none;
color:white;
}

a:hover{
text-decoration:none;
color:white;
}

a:active{
text-decoration:none;
color:white;
}

.icon-2x:before {
  color: white 
}



</style>
</head>

<body>

<!-- Main navbar -->
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
    <?php include_once 'notifications.php' ?>
   </div>
  </div>
 </div>
 <div class="page-container">
  <div class="page-content">
   <?php include_once 'sidebar.php'; ?>
   <div class="content-wrapper">
    <div class="content">
    <?php if ($PriC == "1") { ?>
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body bg-blue-400" style="background-image: url(assets/images/backgrounds/bg.png);">
	   <div class="media no-margin">
	   <a href="Clubes/dashboard.php" target="_blank" class="media-left media-middle" color="#ffffff">
	   <i class="icon-flag3 icon-2x"></i></a>
		 <div class="media-body text-right">
		  <h5 class="media-heading text-semibold">Cadastro de Clubes</h5>
		   <span class="text-muted">Ativos no momento: <?php echo $QuantClube; ?> </span>
		 </div>
	   </div>
	  </div>
     </div>
	<?php } else { } if ($PriA == "1") { ?>
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body bg-green-400" style="background-image: url(assets/images/backgrounds/bg.png);">
	   <div class="media no-margin">
	   <a href="Associados/dashboard.php" target="_blank" class="media-left media-middle" color="#ffffff">
	   <i class="icon-users2 icon-2x"></i></a>
		 <div class="media-body text-right">
		  <h5 class="media-heading text-semibold">Cadastro de Associados</h5>
		   <span class="text-muted">Ativos no momento: <?php echo $QuantSocio; ?> </span>
		 </div>
	   </div>
	  </div>
     </div>
	<?php } else { } if ($PriD == "1") { ?>     
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body bg-orange-400" style="background-image: url(assets/images/backgrounds/bg.png);">
	   <div class="media no-margin">
	   <a href="Distrito/dashboard.php" target="_blank" class="media-left media-middle" color="#ffffff">
	   <i class="icon-cog icon-2x"></i></a>
		 <div class="media-body text-right">
		  <h5 class="media-heading text-semibold">Distrito <?php echo $Distrito; ?></h5>
		   <span class="text-muted">Gerenciar  Distrito</span>
		 </div>
	   </div>
	  </div>
     </div>
	<?php } else { } if ($PriD == "1") { ?>     
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body bg-purple-400" style="background-image: url(assets/images/backgrounds/bg.png);">
	   <div class="media no-margin">
	   <a href="Projetos/dashboard.php" target="_blank" class="media-left media-middle" color="#ffffff">
	    <i class="icon-files-empty icon-2x white"></i></a>
		 <div class="media-body text-right">
		  <h5 class="media-heading text-semibold">Cadastro de Projetos</h5>
		 </div>
	   </div>
	  </div>
     </div>
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body bg-teal-400" style="background-image: url(assets/images/backgrounds/bg.png);">
	   <div class="media no-margin">
	   <a href="" class="media-left media-middle" color="#ffffff"><i class="icon-media icon-2x"></i></a>
		 <div class="media-body text-right">
		  <h5 class="media-heading text-semibold">Imagem Pública</h5>
		 </div>
	   </div>
	  </div>
     </div>
	<?php } else { } ?>


 



	<?php include_once 'footer.php'; ?>
	</div>
   </div>
  </div>
 </div>
</body>
</html>
