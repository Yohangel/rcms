<header role="banner">
  <nav class="main-nav">
    <ul>
      <?php 
      $user = new user(); 
      if(!$user->status()){ ?>
        <!-- inser more links here -->
        <li><a class="cd-signin" href="#">Ingresar</a></li>
        <li><a class="cd-signup" href="#">Registrate grátis</a></li>
        <?php } else { ?>
          <nav class="main-nav">
            <li>
              <form method="post" action="#">
                <input type="submit" name="logout" value="Salir" class="menu-logged-options">
              </form>
            </li>
            <?php } ?>
          </ul>
        </nav>
      </header>