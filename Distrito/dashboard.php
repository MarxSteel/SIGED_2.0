<?php
include_once '../sess.php';
include_once '../dados.php';
$hosts = $server;
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
  $NomeDiretor = $Ch['nomeCom'];
  $CodSocio = $Ch['id'];
 
 $ChamaPriv = $db->prepare("SELECT * FROM priv WHERE codAss='$CodSocio'");
  $ChamaPriv->execute();
  $Pr = $ChamaPriv->fetch();
  $PCl = $Pr['priC'];
  $PAs = $Pr['priA'];
  echo '
  <div class="col-md-4 col-xs-12">
   <div class="thumbnail border-slate border-lg">
    <div class="thumb thumb-rounded border-slate">
     <img src="../assets/images/perfil/' . $Ch['foto'] . '" alt="">
    </div>
      <div class="caption text-center">
     <h6 class="text-semibold no-margin">' . substr($Ch['nomeCom'], 0, 15) . ' 
      <small class="display-block">' . $cargo . '</small></h6><br />
      <!-- BOTÃO DE PRIVLÉGIOS -->
       <div class="btn-group btn-group-animated">
        <button type="button" class="btn bg-teal-400 btn-rounded btn-xs btn-block dropdown-toggle" data-toggle="dropdown">Permissões 
        <span class="caret"></span></button>
         <ul class="dropdown-menu">';
         echo '<li>';
          if ($PCl === "1") {
          echo '
           <button type="button" class="btn bg-success-400 btn-labeled btn-xs btn-block" data-toggle="modal" data-target="#InativaClubes" data-idvalue="' . $diretor . '"  data-whatever="' . $NomeDiretor . '"><b><i class="icon-flag3"></i></b> Clubes</button>';
          }
           else
          {
        //BOTAO MODAL DE CONCEDER PRIVILÉGIOS
           echo '
            <button type="button" class="btn bg-danger-400 btn-labeled btn-xs btn-block" data-toggle="modal" data-target="#AtivaClubes" data-idvalue="' . $diretor . '"  data-whatever="' . $NomeDiretor . '"><b><i class="icon-flag3"></i></b> Clubes</button>';
          }
          echo '</li>';
          echo '<li>';
           if ($PAs === "1") {
            echo '
             <button type="button" class="btn bg-success-400 btn-labeled btn-xs btn-block" data-toggle="modal" data-target="#InativaSocios" data-idvalue="' . $diretor . '"  data-whatever="' . $NomeDiretor . '"><b><i class="icon-users2"></i></b> Associados</button>';
           }
           else 
           {
            //BOTAO MODAL DE CONCEDER PRIVILÉGIOS
           echo '
            <button type="button" class="btn bg-danger-400 btn-labeled btn-xs btn-block" data-toggle="modal" data-target="#AtivaSocios" data-idvalue="' . $diretor . '"  data-whatever="' . $NomeDiretor . '"><b><i class="icon-users2"></i></b> Associados</button>';
           }
            echo '</li>
         <!-- BOTÃO DE PRIVLÉGIOS -->
         </ul>
        </div>
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
 <link href="../assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
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
        $Diretores = "SELECT * FROM equipe_distrital WHERE distrito='$Distrito'";
         $ListaDiretor = $db->prepare($Diretores);
         $ListaDiretor->execute();
          while ($Dir = $ListaDiretor->fetch(PDO::FETCH_ASSOC)){
          $CDir = $Dir['cargo'];
          $CSocio = $Dir['socio'];
         echo diretor($CSocio, $CDir); 
          }
       ?>




<!-- INICIO DOS MODALS DE PRIVILEGIOS -->
<!-- MODAL DE ATIVAR PRIVILEGIO DE CLUBE -->   
<div class="modal fade" id="AtivaClubes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-success">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
  <h6 class="modal-title">Cadastrar novo Membro de Equipe</h6>         
   </div>
   <div class="modal-body">
  Você está concedendo acesso à página dos clubes a este diretor. Tens certeza?
    <form name="AtivaClubes" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Diretor: 
        <input type="text" class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="AtivaClubes" type="submit" class="btn bg-success-400 btn-block btn-lg" value="Tenho certeza, Conceder Acesso"  />
    </form>
    <?php 
    if(@$_POST["AtivaClubes"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
     $reativarCl = $db->query("UPDATE priv SET priC='1' WHERE codAss='$idClube'");
     if ($reativarCl) {
     $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Privilegio de acessar página de clubs concedido. <br />Associado: " . $clubeNome;
     $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '501', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Conceder%20Acesso&mensagem=Acesso%20Atualizado'</script>";
      }
      else
      {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.901'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.900'</script>";      

      //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL DE ATIVAR PRIVILEGIO DE CLUBE -->   
<!-- MODAL DE INATIVAR PRIVILEGIO DE CLUBE -->   
<div class="modal fade" id="InativaClubes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-danger">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>

    </button>
  <h6 class="modal-title">Cadastrar novo Membro de Equipe</h6>

   </div>
   <div class="modal-body">
  Você está revogando acesso à página dos clubes a este diretor. Tens certeza?
    <form name="InativaClubes" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Diretor:
        <input type="text" class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="InativaClubes" type="submit" class="btn bg-danger-400 btn-block btn-lg" value="Tenho certeza, revogar Acesso"  />
    </form>
    <?php 
    if(@$_POST["InativaClubes"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
     $reativarCl = $db->query("UPDATE priv SET priC='0' WHERE codAss='$idClube'");
     if ($reativarCl) {
     $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Privilegio de acessar página de clubs retirado. <br />Associado: " . $clubeNome;
     $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '502', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Conceder%20Acesso&mensagem=Acesso%20Atualizado'</script>";
      }
      else
      {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.903'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.902'</script>";      

      //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL INATIVAR PRIVILEGIO DE CLUBE -->
<!-- MODAL DE ATIVAR PRIVILEGIO DE CLUBE -->   
<div class="modal fade" id="AtivaSocios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-success">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
  <h6 class="modal-title">Cadastrar novo Membro de Equipe</h6>         
   </div>
   <div class="modal-body">
  Você está concedendo acesso à página dos clubes a este diretor. Tens certeza?
    <form name="AtivaSocios" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Diretor: 
        <input type="text" class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="AtivaSocios" type="submit" class="btn bg-success-400 btn-block btn-lg" value="Tenho certeza, Conceder Acesso"  />
    </form>
    <?php 
    if(@$_POST["AtivaSocios"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
     $reativarCl = $db->query("UPDATE priv SET priA='1' WHERE codAss='$idClube'");
     if ($reativarCl) {
     $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Privilegio de acessar página de associados concedido. <br />Associado: " . $clubeNome;
     $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '503', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Conceder%20Acesso&mensagem=Acesso%20Atualizado'</script>";
      }
      else
      {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.905'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.904'</script>";      

      //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL DE ATIVAR PRIVILEGIO DE CLUBE -->   
<!-- MODAL DE INATIVAR PRIVILEGIO DE CLUBE -->   
<div class="modal fade" id="InativaSocios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header bg-danger">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>

    </button>
  <h6 class="modal-title">Cadastrar novo Membro de Equipe</h6>

   </div>
   <div class="modal-body">
  Você está revogando acesso à página dos clubes a este diretor. Tens certeza?
    <form name="InativaSocios" id="reaativaCL" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <div class="col-md-8">Diretor:
        <input type="text" class="form-control" name="nomeClubeIn" id="modal-titulo">
      </div>
      <div class="col-md-4">ID:
       <div class="modal-valor">
        <input type="text" class="form-control" name="idClubeIn" id="modal-valor">
       </div>
      </div>
     </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <input name="InativaSocios" type="submit" class="btn bg-danger-400 btn-block btn-lg" value="Tenho certeza, revogar Acesso"  />
    </form>
    <?php 
    if(@$_POST["InativaSocios"])
    {
    $clubeNome = $_POST['nomeClubeIn']; //ID DO PRODUTO
    $idClube = $_POST['idClubeIn']; //ID DO PRODUTO
     $reativarCl = $db->query("UPDATE priv SET priA='0' WHERE codAss='$idClube'");
     if ($reativarCl) {
     $DataCad = date('Y-m-d H:i:s');
     $Descrito = "Privilegio de acessar página de associados retirado. <br />Associado: " . $clubeNome;
     $InLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '504', '$Descrito', '$DataCad')");
      if ($InLog) 
      {
       echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Conceder%20Acesso&mensagem=Acesso%20Atualizado'</script>";
      }
      else
      {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.907'</script>";      
       //ELSE CADASTRAR LOG
      }
     }
     else
     {
        echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Reativar%20Clube&mensagem=Não%20foi%20possível%20Atualizar.%20Erro:%200.906'</script>";      

      //ELSE INATIVAR CLUB
     }
    }
    ?>
        </div>
      </div>
    </div>
  </div>
<!-- //MODAL INATIVAR PRIVILEGIO DE CLUBE -->
<!-- FIM DOS MODALS DE PRIVILEGIOS -->





      </div>
     </div>
    </div>
     </div>
    </div>
   </div>



 



  <?php 
  include_once 'modals.php';
  include_once 'mailLogin.php';
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

  <script type="text/javascript" src="../assets/js/pages/components_buttons.js"></script>

  <script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>

  <script type="text/javascript" src="../assets/js/core/app.js"></script>
  <script type="text/javascript" src="../assets/js/pages/datatables_responsive.js"></script>

<!-- FAB -->
 <script type="text/javascript" src="../assets/js/plugins/ui/fab.min.js"></script>
 <script type="text/javascript" src="../assets/js/pages/extra_fab.js"></script>
 <script type="text/javascript" src="../assets/js/pages/user_pages_team.js"></script>
 <script type="text/javascript" src="../assets/js/pages/colors_slate.js"></script>

  <!-- Theme JS files -->
  <script type="text/javascript" src="../assets/js/plugins/velocity/velocity.min.js"></script>
  <script type="text/javascript" src="../assets/js/plugins/velocity/velocity.ui.min.js"></script>
  <script type="text/javascript" src="../assets/js/plugins/buttons/spin.min.js"></script>
  <script type="text/javascript" src="../assets/js/plugins/buttons/ladda.min.js"></script>
  <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
  <!-- /theme JS files -->
<script type="text/javascript">
  $('#AtivaClubes').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Permitir Acesso à página Clubes a:  ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<script type="text/javascript">
  $('#InativaClubes').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('remover Acesso à página Clubes a:  ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<!-- MODAL DE ATIVAR SOCIOS -->
<script type="text/javascript">
  $('#AtivaSocios').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('Permitir acesso à página associados a:  ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<!-- MODAL DE ATIVAR SOCIOS -->
<!-- MODAL DE INATIVAR SOCIOS -->
<script type="text/javascript">
  $('#InativaSocios').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idvalor = button.data('idvalue') 
  var recipient = button.data('whatever')
  var nomeClubeInativar = button.data('whatever')
  var modal = $(this)
  modal.find('.modal-title').text('remover acesso à página associados a:  ' + nomeClubeInativar)
  modal.find('.modal-body input').val(nomeClubeInativar)
  modal.find('.modal-valor input').val(idvalor)
})
</script>
<!-- MODAL DE INATIVAR SOCIOS -->

</html>
