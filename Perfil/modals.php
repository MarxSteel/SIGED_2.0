<!-- MODAL DE ALTERAR DATA DE FUNDAÇÃO -->
<div id="TrocaSenha" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header bg-danger">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	 <h6 class="modal-title">Atualizar Senha</h6>
   </div>
   <div class="modal-body">
	<h3>Atualizar Senha</h3>
	<form name="attSenha" id="name" method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
	 <div class="col-md-6">Digite a senha atual
	  <input class="form-control" type="password" name="atual" required>
	 </div>
   <div class="col-md-6">Digite a nova senha
    <input class="form-control" type="password" name="nova" required>
   </div>
	</div>
   </div>
   <div class="modal-footer"><br /><br /><br />
    <button type="button" class="btn btn-link" data-dismiss="modal">Fechar	</button>
    <input name="attSenha" type="submit" class="btn btn-danger" value="Trocar Senha"  />
    </form>
    <?php 
    if(@$_POST["attSenha"])
    {
     $SenhaAtual = $_POST['atual'];
     $CrySenha = hash('sha256', $SenhaAtual);
     $SenhaNova = $_POST['nova'];
     $CrySenhaN = hash('sha256', $SenhaNova);
     $PassUser = $user->password;
     $UserCods = $user->username;
     if ($CrySenha == $PassUser) {
      $TrocaSenha = $db->query("UPDATE users SET password='$CrySenhaN' WHERE username='$UserCods'");
      if ($TrocaSenha) {      
      echo "<script>location.href='perfil.php?sucesso=bg-success&evento=Atualizar%20Senha&mensagem=Senha%20Atualizada%20com%20sucesso'</script>";
      }
      else{
      echo "<script>location.href='perfil.php?sucesso=bg-danger&evento=Atualizar%20Senha&mensagem=Não%20Foi%20possível%20Atualizar%20a%20Senha.%20Erro:%200x81'</script>";
      }
     }
     else{
    echo "<script>location.href='perfil.php?sucesso=bg-danger&evento=Atualizar%20Senha&mensagem=Não%20Foi%20possível%20Atualizar%20a%20senha.%20Senha%20Invalida'</script>";      
     }

    }
    ?>
   </div>
  </div>
 </div>
</div>
<!-- /MODAL DE ALTERAR DATA DE FUNDAÇÃO -->