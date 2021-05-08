


<?php
echo "<script src='\Projetwebl1\ENT\js\main.js'></script>";
if ($_SESSION['theme'] == 1) {
  echo "<script>LoadCSS('/Projetwebl1/ENT/css/color1.css'); </script>";
} else {
  echo "<script>LoadCSS('/Projetwebl1/ENT/css/color2.css'); </script>";
}
?>

<body onload="move_menu_sandwich(); close_menu_sandwich();">

<div class="site_container">
  <!--menu sandwich (sandwich) pour pouvoir navigueur entre les différentes pages-->
  <nav class="sandwich" id="menu_sandwich">
    <ul class="menuListe">
      <li><a class="menu_cross" id="sandwich_cross" onclick="close_menu_sandwich()"><i class="fas fa-times icone"></i></a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/cmultimedia/cmedia.php"><div class="textesandwich"><i class="fas fa-book icone"></i>Cahiers multimédias</div></a></li>
      <li><hr class="hrsandwich"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/blog/blog.php"><div class="textesandwich"><i class="fas fa-book-open icone"></i>Blog</div></a></li>
      <li><hr class="hrsandwich"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/files/files.php"><div class="textesandwich"><i class="fas fa-file-archive icone"></i>Archivage de fichier</div></a></li>
      <li><hr class="hrsandwich"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/settings/annuaire/annuaire.php"><div class="textesandwich"><i class="far fa-address-book icone"></i>Annuaire</div></a></li>
      <li><hr class="hrsandwich"></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/publications/cahiertxt/cahier.php"><div class="textesandwich"><i class="fas fa-calendar-alt icone"></i>Cahier de texte</div></a></li>
      <li><hr class="hrsandwich"></li>
    </ul>
    <ul class="menuAutre">
      <!--n'affiche le bouton vers le menu d'administration que si un admin est connecté-->
      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <li><a class="menu_link" href="/Projetwebl1/ENT/settings/admin/UserCreation.php"><div class="textesandwich"><i class="fas fa-user-cog icone"></i>Administration</div></a></li>
      <?php
      }
      ?>
      <li><a class="menu_link" onclick="LoadCSS('/Projetwebl1/ENT/css/color1.css')"><div class="pointer"><i class="fas fa-moon icone"></i>Theme Sombre</div></a></li>
      <li><a class="menu_link" onclick="LoadCSS('/Projetwebl1/ENT/css/color2.css')"><div class="pointer"><i class="fas fa-sun icone"></i>Theme Clair</div></a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/settings/parametres/parametres.php"><div class="textesandwich"><i class="fas fa-cogs icone"></i>Paramètres</div></a></li>
      <li><a class="menu_link" href="/Projetwebl1/ENT/auth/logout.php"><div class="textesandwich"><i class="fas fa-sign-out-alt icone"></i>Se déconnecter</div></a></li>
    </ul>
  </nav>
  <div class="site_pusher">
    <header>
      <!--bouton cliquable pour le menu sandwich-->
      <span class="sandwich_icon" id="sandwich_button" onclick="move_menu_sandwich()"><i class="fas fa-bars icone"></i></span>
      <!--titre avec un style d'écriture à la craie-->
      <div class="Title">
        <h1 class="craie">Ecole Millocheau</h1>
        <h2>GS - CP</h2>
      </div>
      <img src="/Projetwebl1/ENT/data/logo_millocheau.png" alt="Logo de l'école millocheau" class="logo_millocheau">
    </header>
  <footer id="navbar">
      <!--bouton cliquable pour retourner à l'accueil de l'ENT-->
      <a href="/Projetwebl1/ENT/" class="link_footer return"><i class="fas fa-home icone retour"></i>Retour à l'accueil</a>
      <!--liens en cas de problèmes, et à propos-->
      <a href="/Projetwebl1/ENT/settings/contact/contact.php" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a>
      <a href="/Projetwebl1/ENT/settings/credits.php" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a>
  </footer>
