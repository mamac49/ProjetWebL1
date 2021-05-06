<?php

/*if ($_SESSION['theme'] == 0) {
  echo "<script> LoadCSS('/Projetwebl1/ENT/css/color1.css'); </script>";
} else {
  echo "<script> LoadCSS('/Projetwebl1/ENT/css/color2.css'); </script>";
}*/

?>

<head>
  <script src="/Projetwebl1/ENT/js/scroll.js"></script>
</head>

<body onload="move_menu_burger(); close_menu_burger();">

<div class="site_container">
  <!--menu sandwich (burger) pour pouvoir navigueur entre les différentes pages-->
  <nav class="burger" id="menu_burger">
    <ul class="menuListe">
      <li><a class="menu_cross" id="burger_cross"><i class="fas fa-times icone"></i></a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/cmultimedia/cmedia.php"><div class="texteBurger"><i class="fas fa-book icone"></i>Cahiers multimédias</div></a></li>
      <li><hr class="hrBurger"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/blog/blog.php"><div class="texteBurger"><i class="fas fa-book-open icone"></i>Blog</div></a></li>
      <li><hr class="hrBurger"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/files/files.php"><div class="texteBurger"><i class="fas fa-file-archive icone"></i>Archivage de fichier</div></a></li>
      <li><hr class="hrBurger"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/settings/annuaire/annuaire.php"><div class="texteBurger"><i class="far fa-address-book icone"></i>Annuaire</div></a></li>
      <li><hr class="hrBurger"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/cahiertxt/cahier.php"><div class="texteBurger"><i class="fas fa-calendar-alt icone"></i>Cahier de texte</div></a></li>
      <li><hr class="hrBurger"></li>
    </ul>
    <ul class="menuAutre">
      <!--n'affiche le bouton vers le menu d'administration que si un admin est connecté-->
      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <li><a class="menu_link" href="/Projetwebl1/ENT/settings/admin/UserCreation.php"><div class="texteBurger"><i class="fas fa-user-cog icone"></i>Administration</div></a></li>
      <?php
      }
      ?>
      <li><a class="menu_link" onclick="LoadCSS('/Projetwebl1/ENT/css/color1.css')"><i class="fas fa-moon icone"></i>Theme Sombre</a></li>
      <li><a class="menu_link" onclick="LoadCSS('/Projetwebl1/ENT/css/color2.css')"><i class="fas fa-sun icone"></i>Theme Clair</a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/settings/parametres/parametres.php"><div class="texteBurger"><i class="fas fa-cogs icone"></i>Paramètres</div></a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/auth/logout.php"><div class="texteBurger"><i class="fas fa-sign-out-alt icone"></i>Se déconnecter</div></a></li>
    </ul>
  </nav>
  <div class="site_pusher">
    <header>
      <!--bouton cliquable pour le menu sandwich-->
      <span class="burger_icon" id="burger_button"><i class="fas fa-bars icone"></i></span>
      <!--bouton cliquable pour retourner à l'accueil de l'ENT-->
      <a href="/Projetwebl1/ENT/"><i class="fas fa-home icone retour"></i></a>
      <!--titre avec un style d'écriture à la craie-->
      <div class="Title">
        <h1 class="craie">Ecole Millocheau</h1>
        <h2>GS - CP</h2>
      </div>
      <img src="/Projetwebl1/ENT/data/logo_millocheau.png" alt="Logo de l'école millocheau" class="taoki">
    </header>
  <footer id="navbar">
      <!--liens en cas de problèmes, et à propos-->
      <a href="/Projetwebl1/ENT/settings/contact/contact.php" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a>
      <a href="/Projetwebl1/ENT/settings/credits.php" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a>
  </footer>
