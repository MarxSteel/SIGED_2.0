<div id="AddDiretor" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-primary">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h6 class="modal-title">Cadastrar novo Membro de Equipe</h6>
   </div>
   	<form name="CadDiretor" method="post" action="" enctype="multipart/form-data">
	<div class="modal-body">
	 <h6 class="text-semibold">Cadastro de Novo membro da comissão distrital</h6>
	 <p>Esta função permite o cadastro de associados do distrito como Diretores. Basta seleciona-lo e, em seguida, definir qual a comissão que o mesmo faz parte. Para cadastrar, é necessário:
	 <li>O Associado estar cadastrado, com e-mail cadastrado e com status "<b>A</b>" (Ativo).</li>
	 <li>O Associado não pode estar cadastrado em mais de uma diretoria, portanto, caso deseje, é necessário que o mesmo seja destituido da comissão anterior e inserido na comissão nova.</li>
	 <b>Fique atento!</b>
	 <li>Se o associado for desligado, automaticamente seu usuário é bloqueado e seu cargo de membro da comissão Distrital, revogado.</li>
	 <li>Se for cadastrar o associado e o mesmo não estar listado na lista de associados, verifique se o cadastro do mesmo, pois pode significar que A: O associado não está com e-mail cadastrado, B: O Associado já está vinculado em outra comissão
	  </li>
	 </p>
	 <hr>
	 <h6 class="text-semibold">Caso esteja ciente, selecione seu associado:</h6>
	  <div class="col-md-6">Selecione o Associado
	   <div class="form-group">										
	  	<select class="select" name="socio" required>											
	   	 <option value="">...Selecione...</option>
		  <?php
		   $ChClub = "SELECT * FROM ic_socio WHERE aDist='$Distrito' AND aStatus='A' AND aMail IS NOT NULL AND cd='0' ORDER BY id DESC";
	     		$cClu = $db->prepare($ChClub);
	     		$cClu->execute();
	     		while ($cl = $cClu->fetch(PDO::FETCH_ASSOC)){
	     		echo '<option value="' . $cl['id'] . '">' . $cl['nomeCom'] . '</option>';
	     	}
			?>
	  	  </select>
	 	 </div>
		</div>									
	  <div class="col-md-6">Selecione o Cargo
	   <div class="form-group">										
	  	<select class="select" name="cargo" required>											
	   	 <option value="">...Selecione...</option>
	   	 <option value="Secretário Adjunto">Secretário Adjunto</option>
	   	 <option value="Tesoureiro Adjunto">Tesoureiro Adjunto</option>
	   	 <option value="Dir. Projetos">Diretor de Projetos</option>
	   	 <option value="Dir. Imagem Pública">Diretor de Imagem Pública</option>
	   	 <option value="Dir. Internos">Diretor de Internos</option>
	   	 <option value="Cons. Distrital">Conselheiro Distrital</option>
	   	 <option value="Governador">Governador</option>
	   	 <option value="Dir. Eventos">Diretor de Eventos</option>
	  	</select>
	   </div>
	  </div>	
	</div>
	<div class="modal-footer">
     <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar	</button>
     <input name="CadDiretor" type="submit" class="btn btn-primary" value="Cadastrar Diretor"  />
    </form>
    <?php
    if(@$_POST["CadDiretor"])
    {     
     $codSocio = $_POST['socio'];		//AQUI PEGA CODIGO DO ASSOCIADO
     $codCargo = $_POST['cargo'];		//AQUI PEGA CODIGO DO ASSOCIADO
     $CadDiretor = $db->query("INSERT INTO equipe_distrital (distrito, socio, cargo) VALUES ('$Distrito', '$codSocio', '$codCargo')");
     if ($CadDiretor) {
      //AGORA, ALTERA O STATOS DO CADASTRO ASSOCIADO
      $Altera = $db->query("INSERT INTO ic_socio () VALUES ()");
       if ($Altera) {
	   	$DataLog = date('Y-m-d H:i:s');
	   	$M1 = "Cadastrado novo membro da equipe distrital";
	   	$InsereLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '500', '$M1', '$DataLog')");
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
       else{
       	echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%Diretor&mensagem=Não%20foi%20possível%20Cadastrar%20Diretor.%20Erro:%200x98'</script>";
       }
     }
     else{
	 echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%Diretor&mensagem=Não%20foi%20possível%20Cadastrar%20Diretor.%20Erro:%200x99'</script>";
     }
 	}
    ?>
   </div>
  </div>
 </div>
</div>