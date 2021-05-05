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
    <link rel="stylesheet" href="styleC.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
<?php
include ("../../base.php");
?>

<div class="Center">
  <form class="" action="creationC.php" method="post" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre du cahier">
    <ul class="publicationsCahierMultimedia" id="publications_cahier_multimedia">

    </ul>
  <!--<textarea class="textareaCahierMultimedia" id="textarea_cahier_multimedia" name="" rows="8" cols="80" resize="none" value=1 required></textarea>-->
      <button onclick="textarea()" class="bouton">Ajouter une case</button>
    <input type="submit" name="Valider" class="bouton" value="Valider de cahier multimédia">
  </form>
</div>
<!--publication liée à la bdd-->
<textarea class="textareaId" id="textareaCahierMultimedia" name="texte_0" rows="8" cols="80" resize="none" create=false required></textarea>

<!--zone de texte éditable
<textarea class="textareaId" id="textareaCahierMultimedia" name="" rows="8" cols="80" resize="none" nb=0 nb_max=1 required></textarea>
-->

<?php
}
?>
