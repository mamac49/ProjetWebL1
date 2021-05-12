<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");
include ("../../base.php");



/*if (isset($_POST['Valider'])) {
  $texte = array();
  $len = count($n);
  for ($i = 1 ; $x < $len ; $i++) {
    $texte[$i] = $_POST[$i];
  }
}*/

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nouveau blog</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleB.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
<!--ajout de la méthode PUT-->
  <input type="hidden" name="_METHOD" value="PUT"/>

  <div class="Center">
    <form class="" action="creationB.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="titre" placeholder="Titre du blog" >
      <ul class="publicationsBlog" id="publications_blog">

      </ul>
      <button name="create" class="bouton" method="PUT"><span>Ajouter une case </span></button>
    <input type="submit" name="Valider" class="bouton" value="Valider le blog">
  </form>
</div>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
