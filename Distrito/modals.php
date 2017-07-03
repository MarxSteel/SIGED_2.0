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
		   $ChClub = "SELECT * FROM ic_socio WHERE aDist='$Distrito' AND aStatus='A' AND aMail IS NOT NULL ORDER BY id DESC";
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
       <option value="Secretário(a) Distrital">Secretário(a) Distrital</option>
       <option value="Tesoureiro(a) Distrital">Tesoureiro(a) Distrital</option>
       <option value="Vice RDI">Vice-RDI</option>
       <option value="RDI Eleito">RDI Eleito</option>


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
	   	  //Chamando Dados do Associado
	   	 	$ChamaSocio = $db->prepare("SELECT * FROM ic_socio WHERE id='$codSocio'");
	   	 	$ChamaSocio->execute();
	   	 	 $DadoSocio = $ChamaSocio->fetch();
  			  $mSocio = $DadoSocio['aMail'];
  			   $ChecaUser = $db->query("SELECT COUNT(username) FROM users WHERE username='$mSocio' ")->fetchColumn();
  			    if ($ChecaUser >= "1") {
				 echo "<script>location.href='dashboard.php?sucesso=bg-warning&evento=Cadastrar%20Associado&mensagem=Diretor%20cadastrado%20com%20sucesso.%20Entretanto,%20não%20foi%20criado%20login%20pois%20ele%20já%20possui.'</script>";
  			    }
  			    else{
  			     //CRIANDO LOGIN DO ASSOCIADO
  			    	$name = $DadoSocio['nomeCom'];
  			    	$SenhaDiretor = $Distrito . $codSocio;
  			    	$CrySenha = hash('sha256', $SenhaDiretor);
  			     $CadastraLogin = $db->query("INSERT INTO users (name, email, username, password, dist, codAss) VALUES('$name', '$mSocio', '$mSocio', '$CrySenha', '$Distrito', '$codSocio')");
  			     if ($CadastraLogin) {
  			      //SE O LOGIN FOI CRIADO, AGORA DEVEMOS COLOCAR PARA ELE OS PRIVILEGIOS
  			      $InserePriv = $db->query("INSERT INTO priv (user, priA, priC, priD, PriP, codAss) VALUES ('$mSocio', '0', '0', '0', '0', '$codSocio') ");
  			       if ($InserePriv) {
          include "../assets/email/PHPMailerAutoload.php";           //chamando a lib
           $mail = new PHPMailer();// Inicia a classe PHPMailer
            $mail->IsSMTP(); // Enviar por SMTP 
            $mail->Host = "mx1.hostinger.com.br"; // Você pode alterar este parametro para o endereço de SMTP do seu provedor
            $mail->Port = 587; 
            $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório)
            $mail->Username = 'sistema@interactbrasil.org'; // Usuário do servidor SMTP
            $mail->Password = 'rv1FkdpqcUsM'; // Mesma senha da sua conta de email
            // Configurações de compatibilidade para autenticação em TLS
            $mail->SMTPOptions = array(
             'ssl' => array(
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
             )
            );
            // $mail->SMTPDebug = 2; // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro.

            $mail->From = "sistema@interactbrasil.org"; // Seu e-mail
            $mail->FromName = "MDIO Interact Brasil"; // Seu nome
              // Define o(s) destinatário(s)
              $mail->AddAddress($mSocio,$name);
              // BCC - Cópia oculta

              $mail->AddCC($MailRDI, $nomSocio);
              $mail->AddBCC('sistema@interactbrasil.org', 'Administrador do Sistema'); 
              

              //$mail->AddBCC($MailRDI, 'Login de Diretor'); 
              $mail->IsHTML(true); // Formato HTML . Use "false" para enviar em formato texto simples.
 
              $mail->CharSet = 'UTF-8'; // Charset (opcional)
              $mail->Subject = "Cadastro de Login no SIGED"; 
 
$mail->Body = '
<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0; 
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }
      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
      .body {
        background-color: #f6f6f6;
        width: 100%; }
      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }
      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }
      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%; }
      .wrapper {
        box-sizing: border-box;
        padding: 20px; }
      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }
      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }
      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }
      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }
      a {
        color: #3498db;
        text-decoration: underline; }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }
      .btn-primary table td {
        background-color: #3498db; }
      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }
      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }
      .first {
        margin-top: 0; }
      .align-center {
        text-align: center; }
      .align-right {
        text-align: right; }
      .align-left {
        text-align: left; }
      .clear {
        clear: both; }
      .mt0 {
        margin-top: 0; }
      .mb0 {
        margin-bottom: 0; }
      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }
      .powered-by a {
        text-decoration: none; }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }
      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}
      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; } 
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }


        .azul{
          color: rgb(0,165,208);
        }
        .rosa{
          color: rgb(251,73,89);
        }
        .email-automatico{
          word-wrap: break-word;
          font-size: 16px;

        }

    </style>
  </head>
  <body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                 <img src="http://interactbrasil.org/layoutemail/capa.png" width="500">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center">
                       <h2 class="azul">
                        Olá ' . $name . '! Tá na hora de usar o SIGED!
                       </h2>
                       <h3 align="justify" class="rosa">O seu Representante Distrital realizou seu cadastro e lhe concedeu alguns privilégios, seu distrito precisa de você, acesse agora mesmo!
                        </h3>
                        <h2 align="left">
                        <span class="azul"> Login:</span><span class="rosa"> ' . $mSocio . '</span><br />
                        <span class="azul"> Senha:</span><span class="rosa"> ' . $SenhaDiretor . '</span><br />
                        </h2>
                        <h2>
                        </h2>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary btn-block">
                          <tbody>
                            <tr>
                             <td> <a href="http://interactbrasil.org/sistema" target="_blank" class="btn btn-block" align="center">Acessar o Sistema</a> </td>
                            </tr>
                          </tbody>
                        </table>
                        <span>
                         <img class="partial-image" src="http://interactbrasil.org/layoutemail/logoICBRasil.png" width="250">
                        </span><br/>
                        <small>Este e-mail foi enviado automaticamente, favor não responder</small>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
              </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block powered-by">
                  &copy; 2017 - <a href="http://interactbrasil.org">MDIO Interact Brasil</a>.<br />
                    Desenvolvido por <a href="#">Marquistei Medeiros</a>.
                  </td>
                </tr>
              </table>
            </div>

            <!-- END FOOTER -->
            
<!-- END CENTERED WHITE CONTAINER --></div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>


';

$enviado = $mail->Send();
if ($enviado) {
echo '<script type="text/javascript">alert("LOGIN ENVIADO COM SUCESSO!");</script>';
echo "<script>location.href='dashboard.php?sucesso=bg-success&evento=Cadastrar%20Diretor&mensagem=Cadastrado!'</script>";
} else {
     echo "Houve um erro enviando o email: ".$mail->ErrorInfo;
echo "<script>location.href='dashboard.php?sucesso=bg-danger&evento=Cadastrar%20Diretor&mensagem=Erro%20ao%20Enviar%20Login!'</script>";
}

  			       }

  			       else{
                	echo '<script type="text/javascript">alert("ERRO NO PRIVILEGIO");</script>';
  			       }
  			     }
  			     else{
                echo '<script type="text/javascript">alert("ERRO NO LOGIN");</script>';
  			     }

  			    }




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