<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");

/*if (isset($_POST['Valider'])) {
  $texte = array();
  $len = count($n);
  for ($i = 1 ; $x < $len ; $i++) {
    $texte[$i] = $_POST[$i];
  }
}
if (isset($_POST['Valider'])) {
  $idpublication = "NONE";
  $titre = "NONE" ;
  $texte = "NONE" ;
  $image = "NONE" ;
  $date = "NONE" ;
  $nature = "NONE" ;
  $iduser = "NONE" ;
  //echo "<script>createLine();</script>";
}*/

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cahier multimédia</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleC.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
  <?php
      include ("../../base.php");
  ?>
<!--ajout de la méthode PUT-->
<div class="Center_adap">
  <form class="" action="creationC.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre du cahier" >
    <ul class="publicationsCahierMultimedia" id="publications_cahier_multimedia">
      <!--
        <textarea class="templateCahierMulimedia" id="text_template_cahier_multimedia" title="template" name="texte_0" rows="8" cols="80" resize="none" create=false required></textarea>
        <input class="templateCahierMulimedia" type="image_template_cahier_multimedia" id="template_cahier_multimedia" name="templateImage" accept="image/*" required>
      -->
    </ul>
    <button class="bouton" onclick="addText()">Ajouter une case</button>
    <button class="bouton" onclick="addImage()">Ajouter une image</button>
    <!--<button name="create" class="bouton" onclick="addVideo()">Ajouter une case</button>-->
    <input type="submit" name="Valider" class="bouton" value="Valider de cahier multimédia">
  </form>
</div>

<!--publication liée à la bdd-->
<textTemplate id="textTemplate">
  <textarea class="templateCahierMulimedia" id="text_template_cahier_multimedia" title="template" name="texte_0" rows="8" cols="80" resize="none" create=false required></textarea>
</textTemplate>

<imageTemplate id="imageTemplate">
  <input class="templateCahierMulimedia" type="image_template_cahier_multimedia" id="template_cahier_multimedia" name="templateImage" accept="image/*" required>
</imageTemplate>

<!--zone de texte éditable
<textarea class="textareaId" id="textareaCahierMultimedia" name="" rows="8" cols="80" resize="none" nb=0 nb_max=1 required></textarea>
-->

<?php
}
?>
