<?php
session_start();

include '../fonc.php';

if ($_SESSION["Connected"] == "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/styleLittle.css">
    <link rel="stylesheet" media="all and (min-width: 480px) and (max-width: 1023px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <title>Crédits</title>
  </head>
    <?php
      include '../base.php';
    ?>
    <div class="Center_adap texte">
      <h2>Mentions légales</h2>
        <ul class="texte">
          <li class="LiUser"><i class="fas fa-user-circle IconeProfil"></i>Antoine Beunas</li>
          <li class="LiUser"><i class="fab fa-discord IconeProfil"></i> Benjamin Humbert</li>
          <li class="LiUser"><i class="fas fa-cocktail IconeProfil"></i>Enzo Creuzet</li>
          <li class="LiUser"><i class="fab fa-steam IconeProfil"></i> Liam Kern</li>
          <li class="LiUser"><i class="fab fa-linux IconeProfil"></i> Mattéo Langlois</li>
        </ul>
      <h2>Sources</h2>
        <p>Icônes : <a href="https://fontawesome.com/icons?d=gallery&p=2&m=free">fontawesome</a></p>
        <p>Nous utilisons la license GNU General Public License v3.0 : <a href="https://choosealicense.com/license/gpl-3.0/">ChooseALicense</a></p>

      <h2>Code source</h2>
        <a href="https://github.com/matteolanglois/projetwebl1"><i class="fab fa-github code"></i></a>
    </div>

</body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
