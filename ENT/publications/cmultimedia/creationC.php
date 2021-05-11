<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");

function Create($titre, $contenu) {
  var_dump($contenu);
  $link = dbConnect();

  $date = date("m");
  $IDu = $_SESSION['ID'];

  $sql = "INSERT INTO `Publications` (`titre`, `date`, `nature`, `iduser`) VALUES ('$titre', '$date', '2', 'IDu')";
  if (mysqli_query($link, $sql)) {

    $sqlID = max(max(nbPub()));

    $sqlp = "INSERT INTO `(?)` (`data`, `position`, `idpublications`) VALUES ('(?)', '(?)', '(?)')";
    $stmt = mysqli_prepare($link, $sqlp);
    if ( !$stmt ){
        echo 'Erreur d accès à la base de données - FIN';
        mysqli_close($link);
    }

    $pos = 0;

    var_dump($contenu);
    foreach ($contenu as $element) {
      if (filter_var($element, FILTER_VALIDATE_URL)) {
        $table = "liens";
        mysqli_stmt_bind_param($stmt, 'ssii', $table, $element, $pos, $sqlID);
      }
      $pos++;
    }
  }
}


if (isset($_POST['Valider'])) {
  var_dump($_POST);
  $titre = securisation($_POST['titre']);
  $contenu = array();
  $nb = 0;
  while (isset($_POST['line_' . $nb])) {
    $temp = mysqli_real_escape_string(dbConnect(), $_POST['line_' . $nb]);
    $contenu[] = $temp;
    $nb++;
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
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    </head>
  <?php
      include ("../../base.php");
  ?>
<!--ajout de la méthode PUT-->
<div class="Center_adap Saisie">
  <form action="creationC.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre du cahier" >
    <ul class="publicationsCahierMultimedia" id="publications_cahier_multimedia">
    </ul>
    <div class="boutonsCahierMultimedia">
      <button class="boutonAjouterTexte bouton" id="add_text" onclick="addText()"><span>Ajouter un texte</span></button>
      <button class="boutonAjouterImage bouton" id="add_image" onclick="addImage()"><span>Ajouter une image</span></button>
      <button class="boutonAjouterVideo bouton" id="add_video" onclick="addVideo()"><span>Ajouter une vidéo</span></button>
      <input type="submit" name="Valider" class="bouton Validerbouton" value="Valider">
    </div>
  </form>
</div>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
