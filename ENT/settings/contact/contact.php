<?php
session_start();

include '../../fonc.php';

function Save($type, $message) {
  $link = dbConnect();

  $date = date("Y-m-d H:i:s");
  $id = $_SESSION["ID"];

  $sql = "INSERT INTO `avis` (`type`, `message`, `date`, `iduser`) VALUES ('$type', '$message', '$date', '$id')";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  }
}


if (isset($_POST['ValiderEnvoi'])) {
  $type = $_POST['Type'];
  $message = $_POST['Rapport'];
  Save($type, $message);
}

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <title>Contact</title>
  </head>
  <?php
      include '../../base.php';
  ?>
  <div class="Center texte">
      <form method="POST">
        <label><input type="radio" name="Type" value="Avis"><i class="fas fa-comment-dots icone"></i> Donner un avis?</label>
        <label><input type="radio" name="Type" value="Bug"><i class="fas fa-bug icone icone"></i> Signaler un bug</label>
        <p><textarea name="Rapport" placeholder="Donnez votre avis/Signaler votre problème(400 caractères maximum)" max-length=400 rows="5" cols="70" required></textarea></p>
        <input type="submit" name="ValiderEnvoi" class="bouton" value="Valider le formulaire">
      </form>
      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <button type="button" onclick="document.getElementById('ShowRate').style.display='block'" name="button" class="bouton">Afficher les avis</button>
      <?php } ?>

      <div class="modal" id="ShowRate">
        <span onclick="document.getElementById('AddHW').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <h3 class="texte">Avis et bugs</h3>

      </div>
    </div>


    </body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
