<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");
include ("../../base.php");

function Create($titre) {
  $link = dbConnect();

  $date = date("Y-m-d");
  $IDu = $_SESSION['ID'];

  $sql = "INSERT INTO `Publications` (`titre`, `date`, `nature`, `iduser`) VALUES ('$titre', '$date', '1', '$IDu')";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  } else {
    echo 'Erreur d accès à la base de données - FIN' . mysqli_error($link);
  }
}


if (isset($_POST['Valider'])) {
  $titre = securisation($_POST['titre']);
  Create($titre);
}

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

  <div class="Center_adap">
    <form class="" action="creationB.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="titre" placeholder="Titre du blog" >
      <ul class="publicationsBlog" id="publications_blog">

      </ul>
      <button name="create" class="bouton" method="PUT"><span>Ajouter une case </span></button>
      <input type="submit" name="Valider" class="bouton Validerbouton" value="Valider">
    </form>
  </div>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
