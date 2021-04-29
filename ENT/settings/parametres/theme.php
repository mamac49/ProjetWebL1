<?php
session_start();

if ($_SESSION["Connected"] = "True") {
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
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color1.css')" value="light mode">
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color2.css')" value="dark mode">
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