<?php
session_start();

include ("../../fonc.php");


if (isset($_POST['Valider'])) {
  $texte = array();
  $len = count($n);
  for ($i = 1 ; $x < $len ; $i++) {
    $texte[$i] = $_POST[$i];
  }
}


if ($_SESSION["Connected"] == true) {
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cahier multimédia</title>
    <link rel="stylesheet" href="styleB.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
<?php
include ("../../base.php");
?>

<div class="Center">
  <form class="" action="creationC.php" method="post" enctype="multipart/form-data">

      <!--<input type="file" name="<?php "img-".$n ?>"> -->
      <button onclick="document.write('<textarea name="" rows="8" cols="80" resize="none" required></textarea>')" class="bouton">Ajouter une case</button>
    <input type="submit" name="Valider" class="bouton" value="Valider de cahier multimédia">
  </form>

</div>


<?php
}
?>
