<!-- MODAL PARA CADASTRAR ASSOCIADO -->
<div id="cadSocio" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-orange-400">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h5 class="modal-title">Cadastrar novo Associado</h5>
   </div>
	<form name="CadSocio" method="post" action="" enctype="multipart/form-data">
	 <div class="modal-body">
	  <div class="form-group">
	   <div class="row">
		<div class="col-sm-6">Nome Completo<b>*</b>
		 <input type="text" name="nomeComp" class="form-control" required>
		</div>
		<div class="col-sm-3">Data de Nascimento<b>*</b>
	     <input class="form-control" type="date" name="DtNasc" required>
		</div>
		<div class="col-md-3">G&ecirc;nero
		 <select class="form-control" name="genero" required>
	      <option value="">...Selecione...</option>
	      <option value="M">Masculino</option>
		  <option value="F">Feminino</option>
		 </select>
		</div>		
		<div class="col-sm-6">E-mail
		 <input type="text" placeholder="seu@email.com" class="form-control" name="mail" required="">
		 <span class="help-block">O endereço de e-mail deve ser único</span>
		</div>
		<div class="col-sm-6">Telefone 1
		 <input type="text" placeholder="(41) 999-999-999" name="fone1" data-mask="(99) 999-999-999" class="form-control">
		 <span class="help-block">Digitar telefone completo com DDD e nono dígito (se tiver)</span>
		</div>
		<div class="col-sm-6">Telefone 2
		 <input type="text" placeholder="(41) 999-999-999" name="fone2" data-mask="(99) 999-999-999" class="form-control">
		 <span class="help-block">Digitar telefone completo com DDD e nono dígito (se tiver)</span>
		</div>
		<div class="col-md-6">Selecione o Clube
	 	 <div class="form-group">										
	  	  <select class="select" name="clube" required>											
	   	   <option value="">...Selecione...</option>
		   	<?php
		 	$ChClub = "SELECT * FROM ic_clube WHERE clubeDistrito='$Distrito' AND status='A' ORDER BY id DESC";
	     		$cClu = $db->prepare($ChClub);
	     		$cClu->execute();
	     		while ($cl = $cClu->fetch(PDO::FETCH_ASSOC)){
	     		echo '<option value="' . $cl['id'] . '">' . $cl['clubeNome'] . '</option>';
	     	}
			?>
	  	  </select>
	 	 </div>
		</div>
	   </div>
	  </div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="CadSocio" type="submit" class="btn btn-primary" value="Cadastrar Associado"  />
    </form>
    <?php 
    if(@$_POST["CadSocio"])
    {     
     $sNome = $_POST['nomeComp'];			//NOME COMPLETO DO ASSOCIADO
     $sDataNasc = $_POST['DtNasc'];			//DATA DE NASCIMENTO DO ASSOCIADO YYYY-MM-DD
     $sGen = $_POST['genero'];					//GENERO (M) MASCULINO OU (F) FEMININO
     $sMail = $_POST['mail'];				//E-MAIL DO ASSOCIADO (OBRIGATÓRIO)
     $sfone1 = $_POST['fone1'];				//TELEFONE 1 - (XX) XXX-XXX-XXX
     $sfone2 = $_POST['fone2'];				//TELEFONE 1 - (XX) XXX-XXX-XXX
     $cClube = $_POST['clube'];				//CODIGO DO CLUB DO ASSOCIADO
      $ChamaMail = $db->query("SELECT COUNT(*) FROM ic_socio WHERE aMail='$sMail'")->fetchColumn();
      if ($ChamaMail >= "1") {
		  echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%20Associado&mensagem=Não%20foi%20possível%20Cadastrar%20Associado.%20O%20E-mail%20cadastrado%20já%20está%20em%20uso%20no%20sistema.%20Erro:%200x25'</script>";
      }
      else
      {
	   $CadastraSocio = $db->query("INSERT INTO ic_socio (nomeCom, dtNasc, aDist, codClub, aMail, aStatus, Gen, Fone1, Fone2) VALUES ('$sNome', '$sDataNasc', '$Distrito', '$cClube', '$sMail', 'A', '$sGen', '$sfone1', '$sfone2')");	
	   if ($CadastraSocio) {
	   	//SE CADASTRO SOCIO FOR OK
	   	$DataLog = date('Y-m-d H:i:s');
	   	$M1 = "Associado Cadastrado<br/>";
	   	$M2 = "Associado: " . $sNome;
	   	$M3 = "<br />Data de Nascimento: " . dateConvert($sDataNasc);	
	   	$Descricao = $M1 .  $M2 . $M3;
	   	$InsereLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '107', '$Descricao', '$DataLog')");
	   	 if ($InsereLog) {
	   	 	//SE INSERÇÃO DE LOG DE CADASTRO FOR OK
	   	 	echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Cadastrar%20Associado&mensagem=Associado%20Cadastrado%20com%20sucesso!'</script>";
	   	 }
	   	 else
	   	 {
	   	 	//SE INSERÇÃO DE LOG DE CADASTRO FOR NOK
		  echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%20Associado&mensagem=Não%20foi%20possível%20Cadastrar%20Associado.%20O%20E-mail%20cadastrado%20já%20está%20em%20uso%20no%20sistema.%20Erro:%200x25'</script>";
	   	 }
	   }
	   else
	   {
		  echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%20Associado&mensagem=Não%20foi%20possível%20Cadastrar%20Associado.%20O%20E-mail%20cadastrado%20já%20está%20em%20uso%20no%20sistema.%20Erro:%200x14'</script>";
	   	//SE CADASTRO SOCIO FOR NOk
	   }
	   //SE E-MAIL JÁ TIVER CADASTRADO
      }
    }
    ?>
   </div>
  </div>
 </div>
<!-- //MODAL PARA CADASTRAR ASSOCIADO -->