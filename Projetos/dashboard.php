<?php
include_once '../sess.php';
include_once '../dados.php';
include_once '../lib/qyuser.php';
$aDist = 'class="active"';
$aDClube = $aDist;
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
   <?php 
   include_once '../sidebar.php'; 
   ?>
   <div class="content-wrapper">
	<div class="page-header">
	 <div class="page-header-content">
	  <div class="page-title">
	   <h4>
		 <span class="text-semibold">Distrito <?php echo $Distrito; ?></span> - Cadastro de Projetos
	   </h4>
	  </div>
	 </div>
	</div>

<?php if ($PriP == "1") { ?>
	<div class="content">
    <!-- FLOAT -->
  <ul class="fab-menu fab-menu-fixed fab-menu-top-right" data-fab-toggle="click">
   <li>
    <button type="button" class="btn btn-danger btn-float btn-float-lg btn-rounded" data-toggle="modal" data-target="#modal_h1"><b><i class="icon-file-plus2"></i></b></button>
   </li>
  </ul><!-- FLOAT -->
  <div class="row">
   <div class="content">
	<div class="panel panel-flat">
 	<div class="panel-heading"><h5 class="panel-title">Lista de Projetos</h5>
	 <table class="table datatable-basic">
	  <thead>
	   <tr>
	    <th>#</th>
	    <th>Projeto</th>
		<th>Clube</th>
		<th>Data de Cadastro</th>
		<th>Avenidas</th>
		<th></th>
	   </tr>
			 </thead>
			 <tbody>
         	 <?php
         	  $ClAtivo = "SELECT * FROM ic_clube WHERE clubeDistrito='$Distrito' AND status='A' ORDER BY id DESC";
         	  $CAtivo = $db->prepare($ClAtivo);
         	  $CAtivo->execute();
         	  while ($ca = $CAtivo->fetch(PDO::FETCH_ASSOC)){
			  echo '<tr>';
			  $idCl = $ca["id"];
			  $claNome = $ca["clubeNome"];
			  echo '<td>' . $idCl . '</td>';
			  echo '<td>' . $claNome . '</td>';
			  $QtSocio = $db->query("SELECT COUNT(*) FROM ic_socio WHERE aStatus='A' AND codClub='$idCl'")->fetchColumn();
			  echo '<td>' . $QtSocio . '</td>';
			  echo '<td>' . $ca["rSem"] . ', ' . $ca["rHora"] .  '</td>';
			  echo '<td>
	<button type="button" class="btn bg-danger-400 btn-labeled btn-rounded btn-xs" data-toggle="modal" data-target="#modalInativa" data-idvalue="' . $idCl . '"  data-whatever="' . $claNome . '"><b><i class="icon-x"></i></b> Inativar</button>
			        </td>';
			 echo '<td>';
             echo '<a class="btn bg-blue-400 btn-labeled btn-rounded btn-xs" href="javascript:abrir(';
             echo "'vClube.php?ID=" . $idCl . "');";
             echo '"><b><i class="icon-search4"></i></b> Visualizar</a>';
             echo '</td>';
			 echo '</tr>';
         	  }
            ?>
			 </tbody>
			</table>





					</div>
					<!-- /basic responsive configuration -->


					<!-- Column controlled child rows -->
		
					<!-- /column controlled child rows -->


	

				</div>











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
	<h2 align="justify"><b>Aten&ccedil;&atilde;o!</b> Ao desativar o Clube, os associados pertencentes a este club serão automaticamente desativados, tem certeza disto?</h2>
    <form name="inativaCL" id="inativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Interact Club de
        <input class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="inativaCL" type="submit" class="btn bg-danger-400 btn-block btn-lg" value="Tenho certeza, inativar clube"  />
    </form>
    <?php 
    if(@$_POST["inativaCL"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
  	$Inativar = $db->query("UPDATE ic_clube SET status='I' WHERE id='$idClube'");
    if ($Inativar) {
     $InSocio = $db->query("UPDATE ic_socio SET aStatus='I' WHERE codClub='$idClube'");
      if ($InSocio) {
    	$DataCad = date('Y-m-d H:i:s');
    	$Descrito = "Clube Desativado. <br />Interact Club de: " . $clubeNome;
     	$InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '105', '$Descrito', '$DataCad')");
     	if ($InLog) {
         echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Desativar%20Clube&mensagem=Clube%20Desativado%20com%20Sucesso!'</script>";
     	}	
     	else
     	{
         echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Clube&mensagem=Não%20foi%20possível%20desativar%20clube.%20Erro:%200x05'</script>";  
      	 //ELSE CADASTRAR LOG
     	}
      }
      else
      {
       echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Clube&mensagem=Não%20foi%20possível%20desativar%20clube.%20Erro:%200x04'</script>"; 
      //ELSE INATIVAR SOCIO
      }
     }
     else
     {
     echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Desativar%20Clube&mensagem=Não%20foi%20possível%20desativar%20clube.%20Erro:%200x03'</script>";     	
  	 //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL DE INATIVAR CLUB -->
<!-- MODAL DE REATIVAR CLUB -->	 
<div class="modal fade" id="modalAtiva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-success">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
   </div>
   <div class="modal-body">
	<h2 align="justify"><b>Aten&ccedil;&atilde;o!</b> Você está prestes a reativar o clube, vale lembrar que os associados não são reativados automativamente, é necessário reativar um por um.
    Deseja realmente reativar o clube?</h2>
    <form name="ReativaClube" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Interact Club de
        <input type="text" class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="ReativaClube" type="submit" class="btn bg-success-400 btn-block btn-lg" value="Tenho certeza, reativar clube"  />
    </form>
    <?php 
    if(@$_POST["ReativaClube"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
  	 $reativarCl = $db->query("UPDATE ic_clube SET status='A' WHERE id='$idClube'");
  	 if ($reativarCl) {
  	 $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Clube Desativado. <br />Interact Club de: " . $clubeNome;
   	 $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '106', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Reativar%20Clube&mensagem=Clube%20reativado%20com%20Sucesso!'</script>";
      }
      else
      {
        echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20reativar%20clube.%20Erro:%200x05'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
      echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20reativar%20clube.%20Erro:%200x04'</script>"; 
  	  //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL DE REATIVAR CLUB -->
<!-- MODAL DE CADASTRAR -->
<div id="modal_h1" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-primary-200">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h1 class="modal-title">Cadastrar novo Club</h1>
   </div>
   <div class="modal-body">
	<form name="cadClub" id="cadClub" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
	 <div class="col-md-12">Interact Club de (Não digitar "Interact Club de ")
	  <input class="form-control" type="text" name="clube" placeholder="São Paulo Norte" required>
	 </div>
	 <div class="col-md-12">Rotary Club Patrocinador (Digitar "Rotary Club de")
	  <input class="form-control" type="text" name="rc" placeholder="Rotary Club de São Paulo Norte" required>
	 </div>
	</div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="cadClub" type="submit" class="btn btn-primary" value="Cadastrar Clube">
    </form>
    <?php 
    if(@$_POST["cadClub"])
    {
     $novoClubNome = $_POST['clube'];
     $novoRCNome = $_POST['rc'];
     $CadClube = $db->query("INSERT INTO ic_clube (clubeNome, rcPadrinho, clubeDistrito, status) VALUES ('$novoClubNome', '$novoRCNome', '$Distrito', 'A')");
     if ($CadClube) {
      $DataLog = date('Y-m-d H:i:s');
      $Descricao = "Novo Club Cadastrado.<br />Clube: " . $novoClubNome . "<br />Rotary Club Patrocinador: " . $novoRCNome;
      $InsereLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '100', '$Descricao', '$DataLog')");
      if ($InsereLog) {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Cadastrar%20Clube&mensagem=Clube%20cadastrado%20com%20Sucesso!'</script>";  		
      }
      else
      {
        echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Cadastrar%20Clube&mensagem=Não%20foi%20possível%20cadastrar%20clube.%20Erro:%200x02'</script>"; 
      }
     }
     else{
        echo "<script>location.href='vClube.php?sucesso=bg-danger&evento=Cadastrar%20Clube&mensagem=Não%20foi%20possível%20reativar%20clube.%20Erro:%200x01'</script>"; 
     	//ELSE CAD CLUB
     }
	}
	?>

  </div>
 </div>
</div>

<!-- //MODAL DE CADASTRAR -->

	
	 </div>
	</div>
<?php include_once '../footer.php'; ?>	
   </div><!-- /main content -->
   <?php } else{
    echo '
     <div class="alert alert-danger alert-styled-left alert-bordered">
      <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Fechar</span></button>
      <h3><span class="text-semibold">Opa!</span> Não foi possível acessar a página! Você não possui privilégios para isso.</h3>.
     </div>';
  }
    ?>
   
  </div><!-- /page content -->
 </div><!-- /page container -->

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





<script language="JavaScript">
function abrir(URL) {
 
  var width = 1200;
  var height = 650;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
<script type="text/javascript">
	$('#modalInativa').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Desativar o Interact  Club de ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<script type="text/javascript">
	$('#modalAtiva').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Desativar o Interact  Club de ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
</body>
</html>
