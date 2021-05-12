<?php
session_start();

error_reporting(E_ALL);

include ("../../fonc.php");
include ("../../base.php");

function Create($titre, $matiere, $contenu) {
  $link = dbConnect();

  $date = date("Y-m-d");
  $IDu = $_SESSION['ID'];

  $sql = "INSERT INTO `Publications` (`titre`, `date`, `nature`, `iduser`, `matiere`) VALUES ('$titre', '$date', '1', '$IDu', '$matiere')";
  if (mysqli_query($link, $sql)) {
    $sqlID = max(max(nbPub()));
    $pos = 0;

    foreach ($contenu as $element) {
      if (filter_var($element, FILTER_VALIDATE_URL)) {
        $nb = array_key_last(nombreTxt("liens"))+1;
        $sqlp = "INSERT INTO `liens` (`idliens`, `data`, `position`, `idpublications`) VALUES ('$nb', '$element', '$pos', '$sqlID')";
      } elseif (substr_count($element, "ImageContenu") == 1) {
        $nb = array_key_last(nombreTxt("image"))+1;
        $line = str_replace("ImageContenu", "", $element);
        $img = mysqli_real_escape_string($link, $line);
        $sqlp = "INSERT INTO `image` (`idimage`, `data`, `position`, `idpublications`) VALUES ('$nb', '$img', '$pos', '$sqlID')";
      } else {
        $nb = array_key_last(nombreTxt("texte"))+1;
        $sqlp = "INSERT INTO `texte` (`idtexte`, `data`, `position`, `idpublications`) VALUES ('$nb', '$element', '$pos', '$sqlID')";
      }
      $pos++;
      if (mysqli_query($link, $sqlp)) {
        echo "succès";
      } else { echo mysqli_error($link);}
    }
  } else {
    echo 'Erreur d accès à la base de données - FIN' . mysqli_error($link); }
}


if (isset($_POST['Valider'])) {
  $titre = securisation($_POST['titre']);
  $matiere = securisation($_POST['matiere']);
  $contenu = array();
  $nb = 1;
  while (isset($_POST['line_' . $nb]) or isset($_FILES['line_' . $nb]['tmp_name'])) {
    $temp = isset($_POST['line_' . $nb]) ? $_POST['line_' . $nb] : "ImageContenu" . file_get_contents($_FILES['line_' . $nb]['tmp_name']);
    $contenu[] = $temp;
    $nb++;
  }
  Create($titre, $matiere, $contenu);

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nouveau blog</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/styleLittle.css">
    <link rel="stylesheet" media="all and (max-width: 600px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/scroll.js"></script>
  </head>
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
      <select name="matiere">
        <option value="Francais">Français</option>
        <option value="Maths">Mathématiques</option>
        <option value="Sciences">Science</option>
        <option value="Espace">Espace</option>
        <option value="Temps">Temps</option>
        <option value="Musique">Musique</option>
        <option value="Arts">Arts</option>
        <option value="Anglais">Anglais</option>
        <option value="EPS">EPS</option>
        <option value="Contes">Contes</option>
        <option value="Rituels">Rituels</option>
        <option value="Education civique">Education civique</option>
      </select>
      <input type="submit" name="Valider" class="bouton Validerbouton" value="Valider">
    </div>
  </form>
</div>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
