<?php
/*
** CHAMANDO INFORMAÇÕES DO CADASTRO DO CLUBE
*/
$db = DB();
 $ChamaCl = $db->prepare("SELECT * FROM ic_clube WHERE id='$ClID'");
 $ChamaCl->execute();
  $Cl = $ChamaCl->fetch();
   $ClNome = $Cl['clubeNome'];				//NOME DO CLUBE
   
?>