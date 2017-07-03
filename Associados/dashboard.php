<?php
include_once '../sess.php';
include_once '../dados.php';
include_once '../lib/qyuser.php';
$db = DB();
$aDist = 'class="active"';
$aDSocio = $aDist;
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
 <?php if ($PriC == "1") { ?>
 <div class="page-content">
  <?php 
   include_once '../sidebar.php'; 
   ?>
  <div class="content-wrapper">
   <div class="page-header">
	<div class="page-header-content">
	 <div class="page-title">
	  <h4><i class="icon-arrow-left52 position-left"></i> 
	   <span class="text-semibold">Distrito <?php echo $Distrito; ?></span> - Cadastro de Associados</h4>
	 </div>
	</div>
   </div>
   <div class="content">
    <?php if ($PriA =="1") { ?>
<!-- MODAL DE INATIVAR CLUB -->	 
<div class="modal fade" id="modalInativa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-danger">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
   </div>
   <div class="modal-body">
	<h2 align="justify"><b>Aten&ccedil;&atilde;o!</b> Ao desativar associado, irá remover o cadastro dela como presidente, secretário e/ou tesoureiro do clube que ele pertence. tem certeza?</h2>
    <form name="inativaCL" id="inativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Associado:
        <input class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="inativaCL" type="submit" class="btn bg-danger-400 btn-block btn-lg" value="Tenho certeza, desativar associado"  />
    </form>
    <?php 
    if(@$_POST["inativaCL"])
    {
    $socioNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idSocio = $_POST['idClubeIn']; //ID DO PRODUTO
  	$Inativar = $db->query("UPDATE ic_socio SET aStatus='I' WHERE id='$idSocio'");
    if ($Inativar) {
     // Se associado foi desligado
     $DesP = $db->query("UPDATE ic_clube SET pres='' WHERE pres='$idSocio'");
      if ($DesP) {
       //Se Remover Presidente deu certo
       $DesS = $db->query("UPDATE ic_clube SET sec='' WHERE sec='$idSocio'");
       if ($DesS) {
       	//Se Remover Secretário deu Certo
       	$DesT = $db->query("UPDATE ic_clube SET tes='' WHERE tes='$idSocio'");
       	if ($DesT) {
       	 //Se Remover Tesoureiro deu Certo
    	$DataCad = date('Y-m-d H:i:s');
    	$Descrito = "Associado desligado <br />" . $socioNome;
     	$InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '105', '$Descrito', '$DataCad')");
     	 if ($InLog) {
         echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Desativar%20Associado&mensagem=Associado%20Desativado%20com%20Sucesso!'</script>";
     	 }	
     	 else
     	 {
         echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Associado&mensagem=Não%20foi%20possível%20desativar%20associado.%20Erro:%200x16'</script>";  
      	 //ELSE CADASTRAR LOG
     	 }
         echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Associado&mensagem=Não%20foi%20possível%20desativar%20associado.%20Erro:%200x17'</script>";         	
       	}
       	echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Associado&mensagem=Não%20foi%20possível%20desativar%20associado.%20Erro:%200x18'</script>";         	
       }
	   echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Associado&mensagem=Não%20foi%20possível%20desativar%20associado.%20Erro:%200x19'</script>";         	       
      }
  	 }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL DE INATIVAR CLUB -->
<!-- MODAL DE REATIVAR CLUB -->	 
<div class="modal fade" id="modalReativa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-success">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
   </div>
   <div class="modal-body">
	<h2 align="justify"><b>Aten&ccedil;&atilde;o!</b> Deseja realmente reativar associado?</h2>
    <form name="ReativaClube" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Associado:
        <input class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-idsocio">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="ReativaClube" type="submit" class="btn bg-success-400 btn-block btn-lg" value="Tenho certeza, reativar associado"  />
    </form>
    <?php 
    if(@$_POST["ReativaClube"])
    {
    $nomeSocio = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idSocio = $_POST['idClubeIn']; //ID DO PRODUTO
  	 $reativarCl = $db->query("UPDATE ic_socio SET aStatus='A' WHERE id='$idSocio'");
  	 if ($reativarCl) {
  	 $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Associado Reativado. <br />" . $nomeSocio;
   	 $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '108', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Reativar%20Associado&mensagem=20Associado%20reativado%20com%20Sucesso!'</script>";
      }
      else
      {
        echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Reativar%20Associado&mensagem=Não%20foi%20possível%20reativar%20Associado.%20Erro:%200x11'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
      echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Reativar%20Associado&mensagem=Não%20foi%20possível%20reativar%20Associado.%20Erro:%200x12'</script>"; 
  	  //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL DE REATIVAR CLUB -->








<!-- FLOAT -->

	<ul class="fab-menu fab-menu-fixed fab-menu-top-left" data-fab-toggle="click">
	 <li>
	  <a class="fab-menu-btn btn bg-danger-400 btn-float btn-rounded btn-icon">
	   <i class="fab-icon-open icon-cog52"></i><i class="fab-icon-close icon-cross2"></i>
	  </a>
	  <ul class="fab-menu-inner">
	   <li>
		<button type="button" class="btn bg-orange-400 btn-rounded btn-labeled btn-xs" data-toggle="modal" data-target="#cadSocio"><b><i class="icon-user-plus"></i></b> Cadastrar Novo Associado</button>
	   </li>
	  </ul>
	 </li>
	</ul><!-- FLOAT -->
	<div class="row">
	 <div class="col-md-12">
	  <div class="panel panel-flat">
	   <div class="panel-body">
		<div class="tabbable">
		 <ul class="nav nav-pills">
		  <li class="active"> 
		   <a href="../#ativos" data-toggle="tab">
		   <i class="icon-user-check position-left"></i> Associados Ativos </a>
		   </li>
		   <li>
			<a href="../#inativos" data-toggle="tab">
			<i class="icon-user-block position-left"></i> Associados Inativos</a>
		   </li>
		  </ul>
		  <div class="tab-content">
		   <div class="tab-pane active" id="ativos">
			<table class="table datatable-basic">
			 <thead>
			  <tr>
			   <th>Nome</th>
			   <th>Data de Nascimento</th>
			   <th>Clube</th>
			   <th>Gênero</th>
			   <th></th>
			   <th></th>
			  </tr>
			 </thead>
			 <tbody>
         	 <?php
         	  $ClAtivo = "SELECT * FROM ic_socio WHERE aDist='$Distrito' AND aStatus='A' ORDER BY id DESC";
         	  $CAtivo = $db->prepare($ClAtivo);
         	  $CAtivo->execute();
         	  while ($ca = $CAtivo->fetch(PDO::FETCH_ASSOC)){
			  echo '<tr>';
			  $idCl = $ca["id"];
			  $claNome = $ca["nomeCom"];
			  $aaClube= $ca["codClub"];
			  $GeneroA= $ca["Gen"];
			  echo '<td>' . $claNome . '</td>';
			  echo '<td>' . dateConvert($ca["dtNasc"]) . ' - <b>' . calcIdade($ca["dtNasc"]) . ' Anos</b></td>';
			  echo '<td>';
			   $chamaClube = $db->prepare("SELECT * FROM ic_clube WHERE id='$aaClube'");
 				$chamaClube->execute();
  				$nncl = $chamaClube->fetch();
  				echo $nncl['clubeNome'];
			  echo '</td>';  			   
			  echo '<td>';
			  if ($GeneroA == "M") {
			  	echo '<button type="button" class="btn btn-primary btn-rounded btn-xs disabled"><i class="fa fa-male position-left"></i> MAS</button></td>';
			  }
			  elseif ($GeneroA == "F") {
			  	echo '<button type="button" class="btn bg-pink btn-rounded btn-xs disabled"><i class="fa fa-female position-left"></i> FEM</button></td>';
			  }
			  else{
			  }
			  echo '</td>';
			  echo '<td>
	<button type="button" class="btn bg-danger-400 btn-labeled btn-rounded btn-xs" data-toggle="modal" data-target="#modalInativa" data-idvalue="' . $idCl . '"  data-whatever="' . $claNome . '"><b><i class="icon-x"></i></b>Inativar</button>
			        </td>';
			 echo '<td>';
             echo '<a class="btn bg-teal-400 btn-labeled btn-rounded btn-xs" href="javascript:abrir(';
             echo "'vSocio.php?ID=" . $claNome . "');";
             echo '"><b><i class="icon-search4"></i></b> Visualizar</a>';
             echo '</td>';
			 echo '</tr>';
         	  }
            ?>
			 </tbody>
			</table>
		   </div>
		   <div class="tab-pane" id="inativos">
			<table class="table datatable-basic">
			 <thead>
			  <tr>
			   <th>Nome</th>
			   <th>Data de Nascimento</th>
			   <th>Clube</th>
			   <th>Gênero</th>
			   <th></th>
			   <th></th>
			  </tr>
			 </thead>
			 <tbody>
         	 <?php
         	  $ClInAtivo = "SELECT * FROM ic_socio WHERE aDist='$Distrito' AND aStatus='I' ORDER BY id DESC";
         	  $CInAtivo = $db->prepare($ClInAtivo);
         	  $CInAtivo->execute();
         	  while ($ci = $CInAtivo->fetch(PDO::FETCH_ASSOC)){
			  echo '<tr>';
			  $idClci = $ci["id"];
			  $claNomeci = $ci["nomeCom"];
			  $aaClubeci= $ci["codClub"];
			  $GeneroAci= $ci["Gen"];
			  echo '<td>' . $claNomeci . '</td>';
			  echo '<td>' . dateConvert($ci["dtNasc"]) . ' - <b>' . calcIdade($ci["dtNasc"]) . ' Anos</b></td>';
			  echo '<td>';
			   $chamaClubeci = $db->prepare("SELECT * FROM ic_clube WHERE id='$aaClubeci'");
 				$chamaClubeci->execute();
  				$nnclci = $chamaClubeci->fetch();
  				echo $nnclci['clubeNome'];
			  echo '</td>';  			   
			  echo '<td>';
			  if ($GeneroAci == "M") {
			  	echo '<button type="button" class="btn btn-primary btn-rounded btn-xs disabled"><i class="fa fa-male position-left"></i> MAS</button></td>';
			  }
			  elseif ($GeneroAci == "F") {
			  	echo '<button type="button" class="btn bg-pink btn-rounded btn-xs disabled"><i class="fa fa-female position-left"></i> FEM</button></td>';
			  }
			  else{
			  }
			  echo '</td>';
			  echo '<td>
			  
	<button type="button" class="btn bg-green-400 btn-labeled btn-rounded btn-xs" data-toggle="modal" data-target="#modalReativa" data-idvalue="' . $idClci . '"  data-whatever="' . $claNomeci . '"><b><i class="icon-check"></i></b>Inativar</button>
			        </td>';
			 echo '<td>';
             echo '<a class="btn bg-teal-400 btn-labeled btn-rounded btn-xs" href="javascript:abrir(';
             echo "'vSocio.php?ID=" . $claNomeci . "');";
             echo '"><b><i class="icon-search4"></i></b> Visualizar</a>';
             echo '</td>';
			 echo '</tr>';
         	  }
            ?>
			 </tbody>
			</table>
		   </div>
		  </div>
		 </div>
		</div>
	   </div>
	  </div>



	</div>









   	<?php 
   	include_once 'modals.php';
   	} else { ?>
	<div class="alert bg-pink alert-styled-left">
	 <button type="button" class="close" data-dismiss="alert"><span>&times;</span>
	 <span class="sr-only">Fechar</span></button>
	 <h5>Erro! voc&ecirc; n&atilde;o possui privil&eacute;gios para acessar esta p&aacute;gina. Entre em contato com seu RDI ou com a <b>MDIO Interact Brasil</b></h5>
    </div>
   <?php } include_once '../footer.php'; ?>
   </div><!-- /content area -->
   <?php } else{
    echo '
     <div class="alert alert-danger alert-styled-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Fechar</span></button>
      <h3><span class="text-semibold">Opa!</span> Não foi possível acessar a página! Você não possui privilégios para isso.</h3>.
     </div>';
    }
    ?>

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
<script type="text/javascript">
	$('#modalInativa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Desligar associado: ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<script type="text/javascript">
	$('#modalReativa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Reativar Associado: ' + recipient)
  modal.find('.modal-body input').val(recipient)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<script language="JavaScript">
function abrir(URL) {
 
  var width = 700;
  var height = 650;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
</html>
