<!-- MODAL DE ALTERAR DATA DE FUNDAÇÃO -->
<div id="TrocaDataFundado" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-danger">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	 <h6 class="modal-title">Atualizar Data de Fundação</h6>
   </div>
   <div class="modal-body">
	<h3>Atualizar Data de Fundação</h3>
	<form name="TrocaDataFundado" id="name" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
	 <div class="col-md-12">Digite a Nova Data de Fundação
	  <input class="form-control" type="date" name="date" required>
	 </div>
	</div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="TrocaDataFundado" type="submit" class="btn btn-danger" value="Atualizar Cadastro"  />
    </form>
    <?php 
    if(@$_POST["TrocaDataFundado"])
    {
     $DataCadastro = $_POST['date'];
      $AtualizaDataHora = $db->query("UPDATE ic_clube SET dtFundacao='$DataCadastro' WHERE id='$ClID'");
       if ($AtualizaDataHora) {
       	$DataLog = date('Y-m-d H:i:s');
       	$DataCadastro = dateConvert($DataCadastro);
       	$DataFundado = dateConvert($DataFundado);
       	$Descricao = "Atualizada Data de Fundação.<br />Clube: " . $ClNome . "<br />Data de Fundação Anterior: " . $DataFundado . "<br />Nova Data: " . $DataCadastro;
       	$InsereLog = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '205', '$Descricao', '$DataLog')");
       	 if ($InsereLog) {
		  echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-success&evento=Data%20de%20Fundacao&mensagem=Data%20de%20Fundação%20Atualizada%20com%20Sucesso!'</script>";
       	 }
       	 else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Data%20de%20Fundação&mensagem=Não%20Foi%20possível%20Atualizar%20a%20Data%20de%20Fundação.%20Erro:%200x26'</script>";
       	 }
       	}
       else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Data%20de%20Fundação&mensagem=Não%20Foi%20possível%20Atualizar%20a%20Data%20de%20Fundação.%20Erro:%200x25'</script>";
       }
    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR DATA DE FUNDAÇÃO -->
<!-- MODAL DE ALTERAR CAPA -->
<div id="TrocaCapa" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-teal-400">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	 <h3 class="modal-title">Atualizar Capa</h3>
   </div>
   <div class="modal-body">
	<form name="Trocafoto" id="Trocafoto" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
	 <div class="col-md-12">Inserir Imagem
    <input name="arquivo" type="file" required />
	 </div>
	</div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="Trocafoto" type="submit" class="btn bg-teal-400" value="Atualizar Cadastro"  />
    </form>
    <?php 
    if(@$_POST["Trocafoto"])
    {
    // verifica se foi enviado um arquivo 
    if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
    {
     $arquivo_tmp = $_FILES['arquivo']['tmp_name']; //NOME ORIGINAL DO ARQUIVO
     $nome = $_FILES['arquivo']['name'];
     $extensao = strrchr($nome, '.'); // Pega a extensao
     $extensao = strtolower($extensao); // Converte a extensao para mimusculo
      // Somente imagens, .jpg;.jpeg;.gif;.png
      // Aqui eu enfilero as extesões permitidas e separo por ';'
      // Isso server apenas para eu poder pesquisar dentro desta String
      if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
      {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        $novoNome = md5(microtime()) . $extensao;
    
    // Concatena a pasta com o nome
    $desIMG = '../assets/images/capas/' . $novoNome; 

    // tenta mover o arquivo para o destino
    if( @move_uploaded_file( $arquivo_tmp, $desIMG  ))
    {
     $AtualizaIMG = $db->query("UPDATE ic_clube SET cover= '$novoNome' WHERE id='$ClID'");
      if ($AtualizaIMG) {
       $DataLog = date('Y-m-d H:i:s');
       $Descricao = "Capa Atuaizada";
        $InsereLog2 = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '206', '$Descricao', '$DataLog')");
        if ($InsereLog2) {
        echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-success&evento=Atualizar%20Foto de Capa&mensagem=E-mail%20Atualizado%20com%20Sucesso!'</script>";
        }
        else
        {
         echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Capa&mensagem=Não%20Foi%20possível%20Atualizar%20o%20Capa.%20Erro:%200x80'</script>";
        }
      }
      else{
      echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Capa&mensagem=Não%20Foi%20possível%20Atualizar%20o%20Capa.%20Erro:%200x79'</script>";
      }
    }
    else
      echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Capa&mensagem=Não%20Foi%20possível%20Atualizar%20o%20Capa.%20Erro:%200x78'</script>";
  }
  else
   echo '<script type="text/javascript">alert("ocê poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"");</script>';
  }
    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR CAPA -->
<!-- MODAL DE ALTERAR RC PATROCINADOR -->
<div id="RCPadrinho" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-orange-400">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	 <h6 class="modal-title">Atualizar Rotary Club e E-Mail</h6>
   </div>
   <div class="modal-body">
	<h3>Atualizar Rotary Club(s) Patrocinador(es)</h3>
	<form name="TrocaRC" id="TrocaRC" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
	 <div class="col-md-12">Digite o nome do(s) Rotary Club(s) Patrocinador(es)
	  <input class="form-control" type="text" name="rcp" required>
	 </div>
   <div class="col-md-12">Digite o Novo E-Mail
    <input class="form-control" type="text" name="mail" required>
   </div>   
	</div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="TrocaRC" type="submit" class="btn bg-orange-400" value="Atualizar Cadastro"  />
    </form>
    <?php 
    if(@$_POST["TrocaRC"])
    {
     $NovoRotary = $_POST['rcp'];
     $NovoEmail = $_POST['mail'];

      $AtualizaRC = $db->query("UPDATE ic_clube SET rcPadrinho='$NovoRotary', mailContato='$NovoEmail' WHERE id='$ClID'");
       if ($AtualizaRC) {
       	$DataLog = date('Y-m-d H:i:s');
       	$Descricao = "Atualizado Rotary Club Patrocinador<br />Clube: " . $ClNome . "<br />Rotary Club antigo: " . $Rotary . "<br />Novo Club Patrocinador: " . $NovoRotary . '<br/> E-Mail Atualizado. <br />E-Mail Antigo:' . $MailClube . '. E-mail Novo: ' . $NovoEmail;
       	$InsereLog3 = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '207', '$Descricao', '$DataLog')");
       	 if ($InsereLog3) {
		  echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-success&evento=Atualizar%20Rotary%20Club%20Patrocinador&mensagem=E-mail%20Atualizado%20com%20Sucesso!'</script>";

       	 }
       	 else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Rotary%20Club%20Patrocinador&mensagem=Não%20Foi%20Possível%20Atualizar%20RC%20Patrocinador.%20Erro:%200x29'</script>";
		
       	 }
       	}
       else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Rotary%20Club%20Patrocinador&mensagem=Não%20Foi%20Possível%20Atualizar%20RC%20Patrocinador.%20Erro:%200x30'</script>";
       }
    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR RC PATROCINADOR -->
<!-- MODAL DE ALTERAR DIRETORIA -->
<div id="ConselhoDiretor" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-green-400">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	 <h6 class="modal-title">Atualizar Conselho Diretor</h6>
   </div>
   <div class="modal-body">
	<h3>Atualizar Rotary Club(s) Patrocinador(es)</h3>
	<form name="TrocaDiretoria" id="TrocaDiretoria" method="post" action="" enctype="multipart/form-data">
	<div class="col-xs-12">Selecionar Presidente
	 <div class="form-group">										
	  <select class="select-search" name="pres">											
	   <option value="">...Nenhum...</option>
		<?php
		 $ChamaPresida = "SELECT * FROM ic_socio WHERE codClub='$ClID' AND aStatus='A' ORDER BY id DESC";
	     $ChPres = $db->prepare($ChamaPresida);
	     $ChPres->execute();
	     while ($pr = $ChPres->fetch(PDO::FETCH_ASSOC)){
	     echo '<option value="' . $pr['id'] . '">' . $pr['nomeCom'] . '</option>';
	     }
		?>
	  </select>
	 </div>
	</div>
	<div class="col-xs-12">Selecionar Secret&aacute;rio(a)
	 <div class="form-group">										
	  <select class="select-search" name="sec">											
	   <option value="">...Nenhum...</option>
		<?php
		 $ChamaSecreta = "SELECT * FROM ic_socio WHERE codClub='$ClID' AND aStatus='A' ORDER BY id DESC";
	     $ChSec = $db->prepare($ChamaSecreta);
	     $ChSec->execute();
	     while ($sc = $ChSec->fetch(PDO::FETCH_ASSOC)){
	     echo '<option value="' . $sc['id'] . '">' . $sc['nomeCom'] . '</option>';
	     }
		?>
	  </select>
	 </div>
	</div>
	<div class="col-xs-12">Selecionar Tesoureiro(a)
	 <div class="form-group">										
	  <select class="select-search" name="tes">											
	   <option value="">...Nenhum...</option>
		<?php
		 $ChamaTesou = "SELECT * FROM ic_socio WHERE codClub='$ClID' AND aStatus='A' ORDER BY id DESC";
	     $ChTes = $db->prepare($ChamaTesou);
	     $ChTes->execute();
	     while ($ts = $ChTes->fetch(PDO::FETCH_ASSOC)){
	     echo '<option value="' . $ts['id'] . '">' . $ts['nomeCom'] . '</option>';
	     }
		?>
	  </select>
	 </div>
	</div>	
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="TrocaDiretoria" type="submit" class="btn bg-green-400" value="Atualizar Cadastro"  />
    </form>
    <?php 
    if(@$_POST["TrocaDiretoria"])
    {
     $NovoPre = $_POST['pres'];
     $NovoSec = $_POST['sec'];
     $NovoTes = $_POST['tes'];
      $AtDir = $db->query("UPDATE ic_clube SET pres='$NovoPre', sec='$NovoSec', tes='$NovoTes' WHERE id='$ClID'");
       if ($AtDir) {
       	$DataLog = date('Y-m-d H:i:s');
       	$Descricao = "Atualizado Diretoria<br />";
       	$InsereLog4 = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '208', '$Descricao', '$DataLog')");
       	 if ($InsereLog4) {
		  echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-success&evento=Atualizar%20Diretoria&mensagem=Diretoria%20Atualizada%20com%20Sucesso!'</script>";
       	 }
       	 else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Diretoria&mensagem=Não%20Foi%20Possível%20Atualizar%20Atualizar%20Diretoria.%20Erro:%200x31'</script>";
		
       	 }
       	}
       else{
		echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Diretoriar&mensagem=Não%20Foi%20Possível%20Atualizar%20Atualizar%20Diretoria.%20Erro:%200x32'</script>";
       }
    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR DIRETORIA -->
<!-- MODAL DE ALTERAR ENDEREÇO -->
<div id="Reuniao" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header bg-blue-400">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h6 class="modal-title">Atualizar Endereço</h6>
   </div>
   <div class="modal-body">
  <form name="Mudareuni" id="Mudareuni" method="post" action="" enctype="multipart/form-data">
  <div class="row">
   <div class="col-md-8">
    <div class="form-group">Local de Reuni&atilde;o:
      <input type="text" name="local" placeholder="Ex.: Casa da Amizade" class="form-control" required>
    </div>
   </div>
   <div class="col-md-4">
   <div class="form-group">Hor&aacute;rio:
   <input type="text" name="horario" placeholder="22:00" minlength="5" maxlength="5" class="form-control" required>
   </div>
   </div>
   <div class="col-md-6">
  <div class="form-group">Per&iacute;odo:
   <select name="periodo" data-placeholder="Selecione um Estado..." class="select" required>
    <option></option> 
    <option value="Semanal"> Semanal</option>
    <option value="Quinzenal"> Quinzenal</option>
    <option value="Mensal"> Mensal</option>
   </select>
  </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">Dia da Semana:
    <select name="semana" data-placeholder="Selecione um Estado..." class="select-search" required>
     <option></option> 
     <option value="SEG"> Segunda-Feira</option>
     <option value="TER"> Terça-Feira</option>
     <option value="Qua"> Quarta-Feira</option>
     <option value="Qui"> Quinta Feira</option>
     <option value="SEX"> Sexta-Feira</option>
     <option value="SAB"> S&aacute;bado</option>
     <option value="DOM"> Domingo</option>
    </select>
   </div>
  </div>
  <div class="col-md-8">
   <div class="form-group">Rua:
    <input type="text" name="rua" placeholder="Ex.: Avenida 7 de Setembro" class="form-control" required>
   </div>
  </div>
  <div class="col-md-4">
   <div class="form-group">Num.:
    <input type="text" name="num" placeholder="1234" class="form-control" required>
   </div>
  </div>
  <div class="col-md-4">
   <div class="form-group">Complemento
    <input type="text" name="comp" class="form-control" placeholder="Ex.: Ao lado da padaria" required>
   </div>
  </div>
  <div class="col-md-3">
   <div class="form-group">CEP (C&oacute;digo Postal):
    <input type="text" name="cep" class="form-control" required>
   </div>
  </div>
  <div class="col-md-5">
   <div class="form-group">Bairro/Setor:
    <input type="text" name="bairro" class="form-control" required>
   </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">Cidade:
    <input type="text" name="cidade" class="form-control" required>
   </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">UF
    <select name="UF" data-placeholder="Selecione um Estado..." class="select-search" required>
     <option></option> 
     <option value="AC"> Acre</option>
     <option value="AL"> Alagoas</option>
     <option value="AM"> Amap&aacute;</option>
     <option value="BA"> Bahia</option>
     <option value="CE"> Cear&aacute;</option>
     <option value="DF"> Distrito Federal</option>
     <option value="ES"> Esp&iacute;rito Santo</option>
     <option value="GO"> Goi&aacute;</option>
     <option value="MA"> Maranh&atilde;o</option>
     <option value="MT"> Mato Grosso</option>
     <option value="MS"> Mato Grosso do Sul</option>
     <option value="MG"> Minas Gerais</option>
     <option value="PA"> Par&aacute;</option>
     <option value="PB"> Para&iacute;ba</option>
     <option value="PR"> Paran&aacute;</option>
     <option value="PE"> Pernambuco</option>
     <option value="PI"> Piau&iacute;</option>
     <option value="RJ"> Rio de Janeiro</option>
     <option value="RN"> Rio Grande do Norte</option>
     <option value="RS"> Rio Grande do Sul</option>
     <option value="RO"> Rond&ocirc;nia</option>
     <option value="RR"> Roraima</option>
     <option value="SC"> Santa Catarina</option>
     <option value="SP"> S&atilde;o Paulo</option>
     <option value="SE"> Sergipe</option>
     <option value="TO"> Tocantins</option>
    </select>
   </div>
  </div>
 </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar  </button>
    <input name="Mudareuni" type="submit" class="btn bg-blue-400" value="Atualizar Cadastro"  />
    </form>
    <?php 
    if(@$_POST["Mudareuni"])
    {
     $nLocal = $_POST['local'];
     $nhorario = $_POST['horario'];
     $nperiodo = $_POST['periodo'];
     $nsemana = $_POST['semana'];
     $nrua = $_POST['rua'];
     $nnum = $_POST['num'];
     $ncomp = $_POST['comp'];
     $ncep = $_POST['cep'];
     $nbairro = $_POST['bairro'];
     $ncidade = $_POST['cidade'];
     $nUF = $_POST['UF'];
     $AtEnd = $db->query("UPDATE ic_clube SET eRua='$nrua', eNum='$nnum', eBair='$nbairro', eCid='$ncidade', eCEP='$ncep', eUF='$nUF', eCom='$ncomp', rLocal='$nLocal', rPer='$nperiodo', rSem='$nsemana', rHora='$nhorario'");
      if ($AtEnd) {
        $DataLog = date('Y-m-d H:i:s');
        $Descricao = "Atualizado Endereços<br />";
        $InsereLog4 = $db->query("INSERT INTO logs (user, logCod, descreve, dtCadastro) VALUES ('$nickname', '209', '$Descricao', '$DataLog')");
         if ($InsereLog4) {
      echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-success&evento=Atualizar%20Endereço&mensagem=Endereço%20Atualizado%20com%20Sucesso!'</script>";
         }
         else{
    echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Endereço&mensagem=Não%20Foi%20Possível%20Atualizar%20Atualizar%20Endereço.%20Erro:%200x33'</script>";
    
         }
        }
       else{
    echo "<script>location.href='vClube.php?ID=" . $ClID . "&sucesso=bg-danger&evento=Atualizar%20Endereço&mensagem=Não%20Foi%20Possível%20Atualizar%20Atualizar%20Endereço.%20Erro:%200x33'</script>";
       }
    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR ENDEREÇO -->
