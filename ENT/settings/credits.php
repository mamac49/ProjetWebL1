<?php
session_start();

if ($_SESSION["Connected"] == "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <title>Crédits</title>
  </head>
    <?php
      include '../base.php';
    ?>
    <div class="Center texte">
      <h2>Mentions légales</h2>
      <ul>
        <li>Antoine Beunas</li>
        <li>Benjamin Humbert</li>
        <li>Enzo Creuzet</li>
        <li>Liam Kern</li>
        <li>Mattéo Langlois</li>
      </ul>
      <h2>Sources</h2>
      <p>Icônes : <a href="https://fontawesome.com/icons?d=gallery&p=2&m=free">fontawesome</a></p>
      <p>Nous utilisons la license GNU General Public License v3.0 : <a href="https://choosealicense.com/license/gpl-3.0/">ChooseALicense</a></p>
    </div>

</body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
