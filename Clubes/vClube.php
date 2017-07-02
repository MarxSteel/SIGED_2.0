<?php
include_once '../sess.php';
include_once '../dados.php';
include_once '../lib/qyuser.php';
include_once '../lib/compress.php';

$ClID = $_GET['ID'];
$db = DB();


$QtPro = $db->query("SELECT COUNT(*) FROM projetos where club='$ClID' AND status='3'")->fetchColumn();
$QtSocios = $db->query("SELECT COUNT(*) FROM ic_socio WHERE codClub='$ClID' AND aStatus='A'")->fetchColumn();


 $ChamaCl = $db->prepare("SELECT * FROM ic_clube WHERE id='$ClID'");
 $ChamaCl->execute();
  $Cl = $ChamaCl->fetch();
   $ClNome = $Cl['clubeNome'];				//NOME DO CLUBE
   $CapaClube = $Cl['cover'];				//NOME DO CLUBE
   $DataFundado = $Cl['dtFundacao'];		//DATA DE FUNDAÇÃO DO CLUB
   $MailClube = $Cl['mailContato'];			//DATA DE FUNDAÇÃO DO CLUB
   $Rotary = $Cl['rcPadrinho'];			//DATA DE FUNDAÇÃO DO CLUB
   	//CHAMANDO DADOS DE REUNIÃO
   $DiaSemana = $Cl['rSem'];			//DIA DA SEMANA
   $Periodo = $Cl['rPer'];				//PERIDIOCIDADE DE REUNIÃO
   $Horario = $Cl['rHora'];				//HORÁRIO DE REUNIÃO
   $LocalReuni = $Cl['rLocal'];			//LOCAL DE REUNIÃO
    //CHAMANDO ENDEREÇO
   $endRua = $Cl['eRua'];
   $endNum = $Cl['eNum'];
   $endBair = $Cl['eBair'];
   $endCEP = $Cl['eCEP'];
   $endUF = $Cl['eUF'];
   $endCidade = $Cl['eCid'];
   $endComp = $Cl['eCom'];
    //Diretoria
   $Pre = $Cl['pres'];					//PRESIDENTE
   $Sec = $Cl['sec'];					//SECRETÁRIO
   $Tes = $Cl['tes'];					//TESOUREIRO




   $LinkCapa = $server . '/assets/images/capas/' . $CapaClube;

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
 <div class="navbar navbar-inverse">
  <div class="navbar-collapse collapsed" id="navbar-mobile">
  <center>
    <img src="<?php echo $server; ?>assets/images/logos/ic_br_white.png" width="25%"></a>
</center>


  </div>
 </div>
 <div class="page-container">
  <div class="page-content">
   <div class="content-wrapper">
    <div class="row">
    <div class="col-xs-12">
    <div class="profile-cover">
	 <div class="profile-cover-img" style="background-image: url(<?php echo $LinkCapa; ?>)"></div>
	  <div class="media">						
	   <div class="media-body">
		<h1>Interact Club de <?php echo $ClNome; ?> 
		 <small class="display-block">
		 <b>Distrito <?php echo $Distrito; ?></b><br />
		 Patrocinado pelo <?php echo $Rotary; ?>
		 </small>
		</h1>
	   </div>
	   <!--
	   <div class="media-right media-middle">
		<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
		 <li><a href="#" class="btn bg-blue-400 btn-rounded">
		  <i class="icon-file-picture position-left"></i> Trocar Capa</a>
		 </li>
		 <li><a href="#" class="btn btn-default btn-rounded">
		  <b><i class="icon-mail-read position-left"></i></i> Enviar Mensagem</a>
		 </li>
		</ul>
	   </div>
	   -->
	  </div>
	 </div>
	 </div>
	 </div>
	 <div class="panel panel-body">
	  <div class="row text-center">
	   <div class="col-xs-6">
		<i class="icon-users2 icon-2x display-inline-block text-info"></i>
		 <h5 class="text-semibold no-margin">
		 <?php
		 if ($QtSocios == "1") {
		 	echo $QtSocios . " Associado";
		 }
		 else{
		 	echo $QtSocios . " Associados";
		 }
		 ?>
		</h5>
	   </div>
	   <div class="col-xs-6">
		<i class="icon-point-up icon-2x display-inline-block text-warning"></i>
		<h5 class="text-semibold no-margin">
		 <?php
		 if ($QtPro == "1") {
		 	echo $QtPro . " Projeto";
		 }
		 else{
		 	echo $QtPro . " Projetos";
		 }
		 ?>
		</h5>
	   </div>
	  </div>
	 </div>
	 <div class="col-xs-12 col-md-8">
	  <div class="panel border-left-lg border-left-success">
	   <div class="panel-footer panel-footer-condensed">
		<div class="heading-elements">
		 <span class="heading-text">Reuniões: 
		  <span class="text-semibold">
		  <?php
		   if ($DiaSemana == "SEG") {
		   	echo 'Segunda-Feira';
		   }
		   elseif ($DiaSemana == "TER") {
		   	echo 'Ter&ccedil;a-Feira';
		   }
		   elseif ($DiaSemana == "QUA") {
		   	echo 'Quarta-Feira';
		   }
		   elseif ($DiaSemana == "QUI") {
		   	echo 'Quinta-Feira';
		   }
		   elseif ($DiaSemana == "SEX") {
		   	echo 'Sexta-Feira';
		   }
		   elseif ($DiaSemana == "SAB") {
		   	echo 'S&aacute;bado';
		   }
		   elseif ($DiaSemana == "DOM") {
		   	echo 'Domingo';
		   }
		   else{
		   	echo 'N&atilde;o Cadastrado';
		   }
		   echo ', ' . $Horario . 'H</span> - ' . $Periodo;
		  ?>
		 </span>
		 <span class="list-inline list-inline-condensed heading-text pull-right">TESTE</span>
          <ul class="list-inline list-inline-condensed heading-text pull-right">
		   <li><b>Local de Reuniões:</b> <?php echo $LocalReuni; ?></li>
		  </ul>
		</div>
	   </div>
	   <div class="panel-body">
		<div class="row">
		 <div class="col-md-6">
		  <h5 class="no-margin-top">
		   <b>Endereço:</b> <?php echo $endRua; ?>, <b>Nº</b> <?php echo $endNum; ?>	<br />
		   <b>Complemento: </b><?php echo $endComp; ?><br />
		   <b>Bairro:</b> <?php echo $endBair; ?> <b>CEP.:</b> <?php echo $endCEP; ?> <br />
		   <b>Cidade: </b> <?php echo $endCidade; ?> <b>Estado: </b> <?php echo $endUF; ?>
		  </h5>
		  <h4><b>E-Mail para contato: </b>
		  <?php
		  if ($MailClube == "") {
		  	echo "N&atilde;o Cadastrado";
		  }
		  else{
		  	echo $MailClube;
		  }
		  ?>
		  </h4>
		 </div>
		 <div class="col-md-6">
		  <ul class="list task-details"><span>Data de Fundação: <?php echo dateConvert($DataFundado); ?></span></ul>
		 </div>
		</div>
	   </div>
	  </div>







	 </div>
	 <div class="col-xs-12 col-md-4">
	  <div class="panel panel-flat border-left-success">
		<ul class="media-list media-list-linked pb-5">
		  <li class="media">
		  <?php 
		   if ($Pre == "") {
		   	echo "<h2><b>Presidente Não Cadastrado</b></h2>";
		   } else{ 
		   	$ChamaPre = $db->prepare("SELECT * FROM ic_socio WHERE id='$Pre'");
 			$ChamaPre->execute();
  			$Pre = $ChamaPre->fetch();
		   	?>
		   <a href="#" class="media-link">
			<div class="media-left">
			 <img src="<?php echo $server;?>/assets/images/perfil/<?php echo $Pre['foto']; ?>" class="img-circle" alt=""></div>
			  <div class="media-body">
			   <span class="media-heading text-semibold"><?php echo $Pre['nomeCom']; ?></span>
			   <span class="media-annotation">Presidente</span>
			  </div>
		   </a>
		  <?php
		   }
		  ?>
		  </li>
		  <li class="media">
		  <?php 
		   if ($Sec == "") {
		   	echo "<h2><b>Secretário Não Cadastrado</b></h2>";
		   } else{ 
		   	$ChamaSec = $db->prepare("SELECT * FROM ic_socio WHERE id='$Sec'");
 			$ChamaSec->execute();
  			$Secc = $ChamaSec->fetch();
		   	?>
		   <a href="#" class="media-link">
			<div class="media-left">
			 <img src="<?php echo $server;?>/assets/images/perfil/<?php echo $Secc['foto']; ?>" class="img-circle" alt=""></div>
			  <div class="media-body">
			   <span class="media-heading text-semibold"><?php echo $Secc['nomeCom']; ?></span>
			   <span class="media-annotation">
			   <?php 
			   if ($Secc['Gen'] == "M") {
			   	echo 'Secret&aacute;rio';
			   }
			   else{
			   	echo 'Secret&aacute;ria';
			   }
			   	?>
			   </span>
			  </div>
		   </a>
		  <?php
		   }
		  ?>
		  </li>
		  <li class="media">
		  <?php 
		   if ($Tes == "") {
		   	echo "<h2><b>Tesoureiro Não Cadastrado</b></h2>";
		   } else{ 
		   	$ChamaTes = $db->prepare("SELECT * FROM ic_socio WHERE id='$Tes'");
 			$ChamaTes->execute();
  			$Tess = $ChamaTes->fetch();
		   	?>
		   <a href="#" class="media-link">
			<div class="media-left">
			 <img src="<?php echo $server;?>/assets/images/perfil/<?php echo $Tess['foto']; ?>" class="img-circle" alt=""></div>
			  <div class="media-body">
			   <span class="media-heading text-semibold"><?php echo $Tess['nomeCom']; ?></span>
			   <span class="media-annotation">
			   <?php 
			   if ($Tess['Gen'] == "M") {
			   	echo 'Tesoureiro';
			   }
			   else{
			   	echo 'Tesoureira';
			   }
			   	?>
			   </span>
			  </div>
		   </a>
		  <?php
		   }
		  ?>
		  </li>
		</ul>
	  </div>
	 </div>


	 <!-- FLOAT BUTTON -->
      <ul class="fab-menu fab-menu-fixed fab-menu-bottom-left" data-fab-toggle="click">
	   <li>
		<a class="fab-menu-btn btn bg-orange-400 btn-float btn-rounded btn-icon">
		 <i class="fab-icon-open icon-paragraph-justify3"></i>
		 <i class="fab-icon-close icon-cross2"></i>
		</a>
		<ul class="fab-menu-inner">
		 <li>
		  <button type="button" class="btn bg-danger-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#TrocaDataFundado"><b>
		   <i class="icon-calendar2"></i></b> Editar Data de Fundação
		  </button>				
		 </li>
		 <li>
		  <button type="button" class="btn bg-success-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#ConselhoDiretor"><b>
		   <i class="icon-users2"></i></b> Atualizar Conselho Diretor
		  </button>				
		 </li>
		 <li>
		  <button type="button" class="btn bg-teal-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#TrocaCapa"><b>
		   <i class="icon-camera"></i></b> Atualizar Foto de Capa
		  </button>				
		 </li>
		 <li>
		  <button type="button" class="btn bg-blue-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#Reuniao"><b>
		   <i class="icon-pin"></i></b> Atualizar Dados de Reunião e Endereço
		  </button>				
		 </li>
		 <li>
		  <button type="button" class="btn bg-orange-400 btn-labeled btn-rounded " data-toggle="modal" data-target="#RCPadrinho"><b>
		   <i class="icon-cog"></i></b> Atualizar Rotary Club Patrocinador e E-mail de contato
		  </button>				
		 </li>	 
		</ul>
	   </li>
	  </ul>
	<div class="content">








					<!-- Footer -->
					<?php 
					include_once 'modals.php';
					include_once '../footer.php';
					?>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
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


</html>
