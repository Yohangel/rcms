<?php if(isAdmin()){ 
	$_SESSION['adminToken'] = bin2hex(openssl_random_pseudo_bytes(18));
	?>
	<h1 style="text-align:center;">Panel de administración</h1>
	<form method="post" action="#" class="cd-form" style="width:90%; margin: 0 auto;">
		<h2>Configuración del sitio web</h2>
		<input type="hidden" name="token" value="<?= $_SESSION['adminToken']; ?>">
		<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>
			<span class="cd-error-message"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></span>
			<?php } ?>
			<p class="fieldset">
				<input type="text" value="<?= $site->siteConfig()->sitename; ?>" name="sitename" class="full-width has-padding has-border" required>
			</p>
			<p class="fieldset">
				<input type="text" value="<?= $site->siteConfig()->url; ?>" name="url" class="full-width has-padding has-border" required>
			</p>
			<p class="fieldset">
				<input class="full-width" type="submit" value="Modificar" name="modify"
				>
			</p>
		</form>
		<form method="post" action="#" class="cd-form" style="width:90%; margin: 0 auto;">
			<h2>Agregar página</h2>
			<input type="hidden" name="token" value="<?= $_SESSION['adminToken']; ?>">
			<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>
				<span class="cd-error-message"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></span>
				<?php } ?>
				<p class="fieldset">
					<input type="text" placeholder="Nombre de la página" name="pagename" class="full-width has-padding has-border" required>
				</p>
				<p class="fieldset">
					<textarea name="pagecontent" style="width:100%; min-height:100px;">Contenido de la página</textarea>
				</p>
				<p class="fieldset">
					<input class="full-width" type="submit" value="Modificar" name="addPage"
					>
				</p>
			</form>
			<form method="post" action="#" class="cd-form" style="width:90%; margin: 0 auto;">
				<h2>Modificar contenido de las páginas</h2>
				<input type="hidden" name="token" value="<?= $_SESSION['adminToken']; ?>">
				<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>
					<span class="cd-error-message"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></span>
					<?php } ?>
					<?php foreach ($pages as $page) { ?>
						<h3><?= $page->pagename ?></h3>
						<p class="fieldset">
							<textarea name="page<?= $page->id ?>" style="width:100%; min-height:100px;"><?= $page->pagecontent ?></textarea>
						</p>
						<?php } ?>
						<p class="fieldset">
							<input class="full-width" type="submit" value="Modificar" name="modifyPages"
							>
						</p>
					</form>
					<?php } else { ?>
						<h1 style="text-align:center; margin: 10px auto; font-size: 24px; font-weight:bold;">Acceso no autorizado</h1>
						<?php } ?>