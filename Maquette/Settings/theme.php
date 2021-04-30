<?php
session_start();

if ($_SESSION["Connected"] = true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Theme</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
  <?php
      include '../../base.php';
    ?>

      <div>
        <form>
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color1.css')" value="Theme sombre">
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color2.css')" value="Theme clair">
        </form>
      </div>

      <?php
      include '../../base.php';
      ?>
      </div>
  </div>
</body>
</html>

<?php
}
?>