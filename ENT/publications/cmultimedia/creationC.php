<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");

function Create($titre, $contenu) {
  var_dump($contenu);
}


if (isset($_POST['Valider'])) {
  $titre = securisation($_POST['titre']);
  $contenu = array();
  $nb = 0;
  while (isset($_POST['line_'+$nb])) {
    $contenu[] = securisation($_POST['line_'+$nb]);
  }
  Create($titre, $contenu);
}

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
      <input name="line_0" type="url" class="videoCahierMulimedia videoArea" id="video_cahier_multimedia" title="video" rows="8" cols="80" resize="none" create="false" required=""></input>
    </ul>
    <div class="boutonsCahierMultimedia">
      <button class="boutonAjouterTexte bouton" id="add_text" onclick="addText()"><span>Ajouter un texte</span></button>
      <button class="boutonAjouterImage bouton" id="add_image" onclick="addImage()"><span>Ajouter une image</span></button>
      <button class="boutonAjouterVideo bouton" id="add_video" onclick="addVideo()"><span>Ajouter une vidéo</span></button>
      <!--<button name="create" class="bouton" onclick="addVideo()">Ajouter une case</button>-->
      <input type="submit" name="Valider" class="bouton Validerbouton" value="Valider">
    </div>
  </form>
</div>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
