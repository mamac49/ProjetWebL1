<?php
session_start();

$filename="logs.txt";
chmod($filename, 0444);

include '../../fonc.php';

function Save($type, $message) {
  $link = dbConnect();
}


if (isset($_POST['Valider'])) {
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
        <input type="submit" name="Valider" value="Valider le formulaire">
      </form>
    </div>

    </body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
