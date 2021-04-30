<?php
session_start();

if (isset(($_POST['themeS']))) {
    $_SESSION["theme"] = "Sombre";
}

if (isset(($_POST['themeC']))) {
  $_SESSION["theme"] = "Clair";
}


if ($_SESSION["Connected"] = true) {
?>

<body onload="move_menu_burger(); ">

  <div class="site_container">  
    
    
    <nav class="burger" id="menu_burger">
      <ul class="menuListe">
        <li><a class="menu_cross" id="burger_cross" href="index.html"><i class="fas fa-times icone"></i></a></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/publications/cmultimedia/cmedia.php"><div class="texteBurger"><i class="fas fa-book icone"></i>Cahiers multimédias</div></a></li>
        <li><hr class="hrBurger"></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/publications/blog/blog.php"><div class="texteBurger"><i class="fas fa-book-open icone"></i>Blog</div></a></li>
        <li><hr class="hrBurger"></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/publications/files/files.php"><div class="texteBurger"><i class="fas fa-file-archive icone"></i>Archivage de fichier</div></a></li>
        <li><hr class="hrBurger"></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/settings/annuaire/annuaire.php"><div class="texteBurger"><i class="far fa-address-book icone"></i>Annuaire</div></a></li>
        <li><hr class="hrBurger"></li>
      </ul>
      <ul class="menuAutre">
        <?php
          if ($_SESSION["Admin"] == True) {
        ?>
        <li><a class="menu_link" href="/Projetwebl1/ENT/settings/admin/UserCreation.php"><div class="texteBurger"><i class="fas fa-user-cog icone"></i>Administration</div></a></li>
        <?php
        }
        ?>
        <li><form action="base.php" method="POST"><input type="button" value="theme clair" name="themeC"><input type="button" value="theme sombre" name="themeS"></form></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/settings/parametres/parametres.php"><div class="texteBurger"><i class="fas fa-cogs icone"></i>Paramètres</div></a></li>
        <li><a class="menu_link" href="/Projetwebl1/ENT/auth/logout.php"><div class="texteBurger"><i class="fas fa-sign-out-alt icone"></i>Se déconnecter</div></a></li>
      </ul>
    </nav>
    <div class="site_pusher">
      <header>
        <span class="burger_icon" id="burger_button"><i class="fas fa-bars icone"></i></span>
        <a href="index.html"><i class="fas fa-undo icone retour"></i></a>
        <div class="Title">
          <h1>Ecole Millocheau</h1>
          <h2>GS - CP</h2>
        </div>
        <img src="/Projetwebl1/ENT/data/logo_millocheau.png" alt="Logo de l'école millocheau" class="taoki">
      </header>

<?php
}
?>