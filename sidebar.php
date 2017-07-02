   <div class="sidebar sidebar-main">
	<div class="sidebar-content">
	 <div class="sidebar-user-material">
	  <div class="category-content">
	   <div class="sidebar-user-material-content">
		<a href="#"><img src="<?php echo $server; ?>assets/images/perfil/<?php echo $phoSocio; ?>" class="img-circle img-responsive" alt=""></a>
		<h6><?php echo $nomSocio; ?></h6>
		<span class="text-size-small"><?php echo $NomeClube; ?><br />Distrito <?php echo $Distrito; ?></span>
	   </div>														
	   <div class="sidebar-user-material-menu">
		<a href="#user-nav" data-toggle="collapse"><span>Minha Conta</span> <i class="caret"></i></a>
	   </div>
	  </div>
      <div class="navigation-wrapper collapse" id="user-nav">
	   <ul class="navigation">
	    <li><a href="Perfil/Perfil.php" target="_blank">
	     <i class="icon-user-plus"></i> <span>Meu Perfil</span></a>
	    </li>
	    <li><a href="#"><i class="icon-coins"></i> <span>Relatório de Uso</span></a></li>
	    <li class="divider"></li>
	    <li><a href="#"><i class="icon-cog5"></i> <span>Configura&ccedil;&atilde;o de Perfil</span></a></li>
	    <li><a href="<?php echo $server; ?>logout.php"><i class="icon-switch2"></i> <span>Sair do Sistema</span></a></li>
	   </ul>
	  </div>
	 </div>
	 <div class="sidebar-category sidebar-category-visible">
	  <div class="category-content no-padding">
	   <ul class="navigation navigation-main navigation-accordion">
		<li <?php echo $aHome; ?>>
		 <a href="<?php echo $server; ?>dashboard.php">
		 <i class="icon-home4"></i> <span>In&iacute;cio</span></a>
		</li>
		<li <?php echo $aDist; ?>>
		 <a href="#"><i class="icon-cog"></i> <span>Distrito <?php echo $Distrito; ?></span></a>
	      <ul>
	      <?php if ($PriD == "1") { ?>
		   <li <?php echo $aDDistrito; ?>><a href="<?php echo $server; ?>Distrito/dashboard.php">
		    <i class="icon-cog"></i>Distrito</a></li>
	      <?php } else { } if ($PriC == "1") { ?>
		   <li <?php echo $aDClube; ?>><a href="<?php echo $server; ?>Clubes/dashboard.php">
		    <i class="icon-flag3"></i>Clubes</a></li>
	      <?php } else { } if ($PriA == "1") { ?>
		   <li <?php echo $aDSocio; ?>><a href="<?php echo $server; ?>Associados/dashboard.php">
		    <i class="icon-users2"></i>Associados</a></li>
	      <?php } else { } if ($PriP == "1") { ?>		    
		   <!--<li <?php echo $aDProjeto; ?>><a href="<?php echo $server; ?>Projetos/dashboard.php">
		    <i class="icon-users2"></i>Projetos</a></li>-->
	      <?php } else { } ?>

		  </ul>
		</li>
	   </ul>
	  </div>
	 </div>
	</div>
   </div>