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
    </head>
  <?php
      include ("../../base.php");
  ?>
<!--ajout de la méthode PUT-->
<div class="Center_adap Saisie">
  <form class="" action="creationC.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre du cahier" >
    <ul class="publicationsCahierMultimedia" id="publications_cahier_multimedia">
    </ul>
    <div class="boutonsCahierMultimedia">
      <button class="boutonAjouterTexte bouton" id="add_text" onclick="addText()">Ajouter un texte</button>
      <button class="boutonAjouterImage bouton" id="add_image" onclick="addImage()">Ajouter une image</button>
      <!--<button name="create" class="bouton" onclick="addVideo()">Ajouter une case</button>-->
      <input type="submit" name="Valider" class="boutonValider bouton" value="Valider de cahier multimédia">
    </div>
  </form>
</div>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
