<?php
/*
** CHAMANDO PRIVILÉGIOS DE LOGIN
*/
$db = DB();
$nickname = $user->username;
$Distrito = $user->dist;
$codAss = $user->codAss;
 $query = $db->prepare("SELECT * FROM priv WHERE user='$nickname'");
 $query->execute();
  $row = $query->fetch();
  $CorLayout = $row['color'];
  $PriA = $row['priA']; 		// Privilégio de Cadastro de Associados
  $PriC = $row['priC']; 		// Privilégio de Cadastro de Clubes
  $PriD = $row['priD']; 		// Privilégio de Gerenciar Distrito
  $PriP = $row['priP']; 		// Privilégio de Gerenciar ANP


/*
** CHAMANDO INFORMAÇÕES DO CADASTRO DO ASSOCIADO
*/
 $ChamaSocio = $db->prepare("SELECT * FROM ic_socio WHERE id='$codAss'");
 $ChamaSocio->execute();
  $Socio = $ChamaSocio->fetch();
   $nomSocio = $Socio['nomeCom'];		//NOME COMPLETO DO ASSOCIADO
   $phoSocio = $Socio['foto'];			//FOTO DO ASSOCIADO
   $CodClub = $Socio['codClub'];		//CODIGO DO CLUBE
   $DtNasc = $Socio['dtNasc'];      //DT. NASC CLUBE


/*
** CHAMANDO CLUBE DO ASSOCIADO
*/
 $ChamaClube = $db->prepare("SELECT * FROM ic_clube WHERE id='$CodClub'");
 $ChamaClube->execute();
  $Cl = $ChamaClube->fetch();
   $NomeClube = $Cl['clubeNome'];

/*
** CHAMANDO DADOS DO DISTRITO
*/
 $ChamaDistrito = $db->prepare("SELECT * FROM distrito WHERE id='$Distrito'");
  $ChamaDistrito->execute();
   $Di = $ChamaDistrito->fetch();
    $dRDI = $Di['RDI'];
    $dSDI = $Di['SDI'];
    $dTDI = $Di['TDI'];
    $dPDI = $Di['PDI'];
    $ViceRDI = $Di['RDIVice'];
    $RDIEleito = $Di['RDIEleito'];



/*
** CHAMANDO NOME DO ASSOCIADO
*/
function userNome($a){
  $db = DB();
   $ChamaNome = $db->prepare("SELECT nomeCom FROM ic_socio WHERE id='$a'");
    $ChamaNome->execute();
     $Nom = $ChamaNome->fetch();
     $ANome = $Nom['nomeCom'];
     return $ANome;
}

/*
** CHAMANDO EMAIL DO ASSOCIADO
*/
function userMail($a){
  $db = DB();
   $ChamaNome = $db->prepare("SELECT aMail FROM ic_socio WHERE id='$a'");
    $ChamaNome->execute();
     $Nom = $ChamaNome->fetch();
     $AMail = $Nom['aMail'];
     return $AMail;
}

/*
** CHAMANDO FOTO DO ASSOCIADO
*/
function userFoto($a){
  $db = DB();
   $ChamaNome = $db->prepare("SELECT * FROM ic_socio WHERE id='$a'");
    $ChamaNome->execute();
     $Nom = $ChamaNome->fetch();
     $AFoto = $Nom['foto'];
     return $AFoto;
}



?>