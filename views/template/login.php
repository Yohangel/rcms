<?php
$user = new user(); 
if(!$user->status()){ 
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(18));
	?>
	<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#">Ingresar</a></li>
				<li><a href="#">Registrate grátis</a></li>
			</ul>
			<div id="cd-login"> <!-- log in form -->
				<form action="#login" method="post" class="cd-form">
					<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>
						<span class="cd-error-message"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></span>
						<?php } ?>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						<p class="fieldset">
							<input class="full-width has-padding has-border" type="text" placeholder="Usuario" name="username" required>
						</p>
						<p class="fieldset">
							<input class="full-width has-padding has-border" type="password"  placeholder="Contraseña" name="password" required>
						</p>
						<p class="fieldset">
							<input class="full-width" type="submit" value="Ingresar" name="login"
							>
						</p>
					</form>
					<p class="cd-form-bottom-message"><a href="#">¿Olvidaste tu contraseña?</a></p>
					<!-- <a href="#" class="cd-close-form">Close</a> -->
				</div> <!-- cd-login -->
				<div id="cd-signup"> <!-- sign up form -->
					<form action="#register" method="post" class="cd-form">
						<?php if(isset($_SESSION['errorReg']) && $_SESSION['errorReg'] != ""){ ?>
							<span class="cd-error-message"><?php echo $_SESSION['errorReg']; $_SESSION['errorReg']=""; ?></span>
							<?php } ?>
							<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="text" placeholder="Usuario" name="username" value="<?php if(isset($_POST['username'])){echo$_POST['username'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="text" placeholder="Nombre" name="name" value="<?php if(isset($_POST['name'])){echo$_POST['name'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="text" placeholder="Apellido" name="lastname" value="<?php if(isset($_POST['lastname'])){echo$_POST['lastname'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="password"  placeholder="Contraseña" name="password" alue="<?php if(isset($_POST['password'])){echo$_POST['password'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="password"  placeholder="Repetir contraseña" name="passwordConfirm" value="<?php if(isset($_POST['passwordConfirm'])){echo$_POST['passwordConfirm'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])){echo$_POST['email'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="email" placeholder="Repetir email" name="emailConfirm" value="<?php if(isset($_POST['email'])){echo$_POST['emailConfirm'];}?>" required>
							</p>
							<p class="fieldset">
								<input class="full-width" type="submit" value="Crear cuenta" name="register">
							</p>
						</form>
						<!-- <a href="#" class="cd-close-form">Close</a> -->
					</div> <!-- cd-signup -->
					<div id="cd-reset-password"> <!-- reset password form -->
						<p class="cd-form-message">¿Olvidaste tu contraseña?, ingresa tu email y recibiras un link para generar una nueva.</p>
						<form action="#" method="post" class="cd-form">
							<!-- <span class="cd-error-message">Error: contrasena invalida!</span> -->
							<p class="fieldset">
								<input class="full-width has-padding has-border" type="email" placeholder="Email" name="email" required>
							</p>
							<p class="fieldset">
								<input class="full-width has-padding" type="submit" value="Recuperar contraseña" name="resetPassword">
							</p>
						</form>
						<p class="cd-form-bottom-message"><a href="#">Volver a iniciar sesión</a></p>
					</div> <!-- cd-reset-password -->
					<a href="#" class="cd-close-form">Cerrar</a>
				</div> <!-- cd-user-modal-container -->
			</div> <!-- cd-user-modal -->
			<?php
		}
		?>