<?php
include_once '../sess.php';
include_once '../dados.php';
$hosts = 'http://localhost:8888/interact/Interact/';
include_once '../lib/qyuser.php';
$aDist = 'class="active"';
  $db = DB();
   $ChamaNome = $db->prepare("SELECT nomeCom FROM ic_socio WHERE id='$a'");
    $ChamaNome->execute();
     $Nom = $ChamaNome->fetch();
     $ANome = $Nom['nomeCom'];



function chamaAssociado($cd, $cargo){
$db = DB();
 $ChamaDiretor = $db->prepare("SELECT * FROM ic_socio where id='$cd'");
  $ChamaDiretor->execute();
   $Ch = $ChamaDiretor->fetch();
   $Genero = $Ch['Gen'];
   if ($cargo == 'pre') {
   	$ccargo = 'Presidente';
   }
   elseif ($cargo == 'sec') {
   	if ($Genero == 'M') {
   		$ccargo = 'Secret&aacute;rio';
   	}
   	else{
   		$ccargo = 'Secret&aacute;ria';
   	}
   }
   elseif ($cargo == 'tes') {
   	if ($Genero == 'M') {
   		$ccargo = 'Tesoureiro';
   	}
   	else{
   		$ccargo = 'Tesoureira';
   	}
   }
   
    echo '<div class="panel panel-body">';
    echo '<div class="media no-margin">';
    echo '<div class="media-body">';
	echo '<h6 class="media-heading text-semibold">' . $Ch['nomeCom'] . '</h6>';
	echo '<span class="text-muted"><b>' . $ccargo . '</b></span>';
	echo '</div>';
	echo '<div class="media media-left">';
	echo '<a href="../assets/images/perfil/' . $Ch['foto'] . '" data-popup="lightbox">
		  <img src="../assets/images/perfil/' . $Ch['foto'] . '" class="img-circle img-lg" alt="">
	 </a>';
	echo '</div></div></div>';

}

function diretor($diretor, $cargo){
$db = DB();
 $ChamaDiretor = $db->prepare("SELECT * FROM ic_socio where id='$diretor'");
  $ChamaDiretor->execute();
   $Ch = $ChamaDiretor->fetch();
	echo '
	<div class="col-md-4 col-xs-12">
	 <div class="thumbnail border-slate border-lg">
	  <div class="thumb thumb-rounded border-slate">
	   <img src="../assets/images/perfil/' . $Ch['foto'] . '" alt="">
	  </div>
      <div class="caption text-center">
	   <h6 class="text-semibold no-margin">' . substr($Ch['nomeCom'], 0, 15) . ' 
	    <small class="display-block">' . $cargo . '</small></h6>
	    <!-- botão de privilégio de clubes -->
	    <button type="button" class="btn bg-danger-400 btn-labeled btn-rounded btn-xs" data-toggle="modal" //data-target="#modalInativa" data-idvalue="' . $idCl . '"  data-whatever="' . $claNome . '"><b><i class="icon-x"></i></b> Inativar</button> 	  
		   <a href="#" data-popup="tooltip" class="btn btn-default btn-block" title="Atualizar" data-container="body" align="center"><i class="icon-google-drive"></i></a>
		  

	  </div>
	 </div>
	</div>';

		

}

 /*
 ** CHAMANDO QUANTIDADES DE ASSOCIADOS, PROJETOS E CLUBES
 */
// QUANT CLUBES ATIVOS
 $QuantClube = $db->query("SELECT COUNT(*) FROM ic_clube WHERE status='A' AND clubeDistrito='$Distrito'")->fetchColumn();

// QUANT ASSOCIADOS ATIVOS
 $QuantSocio = $db->query("SELECT COUNT(*) FROM ic_socio WHERE aStatus='A' AND aDist='$Distrito'")->fetchColumn();

// QUANT PROJETOS
 $QuantProjetos = $db->query("SELECT COUNT(*) FROM projetos WHERE dist='$Distrito'")->fetchColumn(); 

?>
<!DOCTYPE html>
<html lang="pt">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?php echo $Titulo; ?></title>
 <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
 <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
 <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
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

</style>
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
    <?php include_once '../notifications.php' ?>
   </div>
  </div>
 </div>
 <div class="page-container">
  <div class="page-content">
   <?php include_once '../sidebar.php'; ?>
   <div class="content-wrapper">
    <div class="page-header">
	 <div class="page-header-content">
	  <div class="page-title">
	   <h4><i class="icon-arrow-left52 position-left"></i> 
	    <span class="text-semibold">Distrito <?php echo $Distrito; ?></span> - Informações do Distrito</h4>
	  </div>
	 </div>
    </div>
    <div class="content">
     <ul class="fab-menu fab-menu-fixed fab-menu-top-right" data-fab-toggle="click">
      <li>
       <button type="button" class="btn btn-default btn-labeled btn-rounded btn-block" data-toggle="modal" data-target="#AddDiretor"><b>
        <i class="icon-plus-circle2"></i></b>Cadastrar novo membro da equipe
        </button>
      </li>
     </ul><!-- FLOAT -->
     <div class="col-md-4 col-xs-12">
      <div class="panel panel-body">
       <div class="row text-center">
	    <div class="col-xs-4" align="center">
		 <p><i class="icon-flag3 icon-2x display-inline-block text-primary"></i></p>
		 <h5 class="text-semibold no-margin"><?php echo $QuantClube; ?></h5>
		 <span class="text-muted text-size-small">Clubes</span>
		</div>
	    <div class="col-xs-4" align="center">
		 <p><i class="icon-users2 icon-2x display-inline-block text-info"></i></p>
		 <h5 class="text-semibold no-margin"><?php echo $QuantSocio; ?></h5>
	     <span class="text-muted text-size-small">Associados</span>
		</div>
	    <div class="col-xs-4" align="center">
		 <p><i class="icon-magazine icon-2x display-inline-block text-success"></i></p>
		 <h5 class="text-semibold no-margin"><?php echo $QuantProjetos; ?></h5>
		 <span class="text-muted text-size-small">Projetos</span>
		</div>
	   </div>
	  </div>
	  <div class="panel panel-body bg-indigo-400" style="background-image: url(../assets/images/backgrounds/bg.png);">
	   <div class="media">
	    <div class="media-left">
		 <a href="assets/images/placeholder.jpg">
		  <img src="../assets/images/perfil/<?php echo userFoto($dRDI); ?>" style="width: 70px; height: 70px;" class="img-circle" alt="">
		 </a>
		</div>
		<div class="media-body">
		 <h6 class="media-heading"><?php echo substr(userNome($dRDI), 0, 20); ?></h6>
		 <span class="text-muted">Representante Distrital</span>
		</div>
	   </div>
	  </div>
     </div>
	 <div class="col-md-8 col-xs-12">
	  <div class="panel panel-flat">
	   <div class="panel-body">
	    <div class="tabbable">
		 <ul class="nav nav-pills">
		  <li class="active"><a href="#ClAt" data-toggle="tab">Clubes Ativos</a></li>
		  <li><a href="#eqp" data-toggle="tab">Equipe Distrital</a></li>
		 </ul>
		 <div class="tab-content">
		  <div class="tab-pane fade in active" id="ClAt">
 		   <?php
 		   $LC = "SELECT * FROM ic_clube WHERE clubeDistrito='$Distrito' AND status='A' ORDER BY id DESC";
 		   $ClubesLista = $db->prepare($LC);
 		   $ClubesLista->execute();
 		    while ($Cl = $ClubesLista->fetch(PDO::FETCH_ASSOC)){ ?>
		   <ul class="media-list media-list-linked">
			<li class="media">
			 <div class="media-link cursor-pointer" data-toggle="collapse" data-target="#<?php echo $Cl['id']; ?>">
			  <div class="media-body">
			   <div class="media-heading text-semibold">Interact Club de <?php echo $Cl['clubeNome']; ?></div>
				<span class="text-muted">Data de Fundação: <?php echo dateConvert($Cl['dtFundacao']); ?></span>
			  </div>
			  <div class="media-right media-middle text-nowrap">
			   <i class="icon-menu7 display-block"></i>
			  </div>
			 </div>
			 <div class="collapse" id="<?php echo $Cl['id']; ?>">
		      <div class="contact-details">
			   <ul class="list-extended list-unstyled list-icons">
				<li><i class="icon-pin position-left"></i> <?php echo $Cl['eRua'] . ', ' . $Cl['eNum'] . ' (' . $Cl['eCom'] . ') ' . $Cl['eBair'] . ' - ' . $Cl['eCid'] . ' - ' . $Cl['eUF'] . ' (' . $Cl['eCEP'] . ')'; ?></li>
				<li><i class="icon-calendar2 position-left"></i><?php echo $Cl['rSem'] . ',' . $Cl['rHora'] . ' - ' . $Cl['Per']; ?></li>
				<li><i class="icon-mail5 position-left"></i> 
				 <a href="#"><?php echo $Cl['mailContato']; ?></a>
				</li>
				<li>
				 <?php echo chamaAssociado($Cl['pres'], 'pre'); ?>
				</li>
				<li>
				 <?php echo chamaAssociado($Cl['sec'], 'sec'); ?>
				</li>
				<li>
				 <?php echo chamaAssociado($Cl['tes'], 'tes'); ?>
				</li>
			   </ul>
			  </div>
			 </div>
			</li>
		   </ul>
		   <?php } ?>
	      </div>
		  <div class="tab-pane fade" id="eqp">
		   <?php 
		    echo diretor($dSDI, 'Secretario(a) Distrital'); 
		    echo diretor($dTDI, 'Tesoureiro(a) Distrital'); 
		    echo diretor($dPDI, 'Protocolo Distrital');
		    $Diretores = "SELECT * FROM equipe_distrital WHERE distrito='$Distrito'";
		     $ListaDiretor = $db->prepare($Diretores);
		     $ListaDiretor->execute();
		      while ($Dir = $ListaDiretor->fetch(PDO::FETCH_ASSOC)){
		      $CDir = $Dir['cargo'];
		      $CSocio = $Dir['socio'];
		     echo diretor($CSocio, $CDir); 
		      }
 		   ?>




		  </div>
		 </div>
		</div>
	   </div>
	  </div>
	 </div>



 



	<?php 
	include_once 'modals.php';
	include_once '../footer.php'; 

	?>
	</div>
   </div>
  </div>
 </div>
</body>
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


	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>

	<script type="text/javascript" src="../assets/js/core/app.js"></script>
	<script type="text/javascript" src="../assets/js/pages/datatables_responsive.js"></script>

<!-- FAB -->
 <script type="text/javascript" src="../assets/js/plugins/ui/fab.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/extra_fab.js"></script>
 <script type="text/javascript" src="../assets/js/pages/user_pages_team.js"></script>
 <script type="text/javascript" src="../assets/js/pages/colors_slate.js"></script>

</html>
