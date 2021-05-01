<?php
session_start();

function dbConnect() {
  $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

  if (mysqli_connect_errno()) {
          echo 'Erreur d accès à la base' . mysqli_connect_error();
          exit;
  }
  return $link;
}

function ChgtMdp($mdpA, $mdpN) {
   $link = dbConnect();

   $sql = "SELECT * FROM `users` WHERE `mail`= '$_SESSION[Mail]'";
   if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_assoc($result);
    $mdp = $row['mdp'];
  }
  mysqli_free_result($result);

  $sql = "UPDATE `users` SET `mdp` = '$mdpN' WHERE `mail`= '$_SESSION[Mail]'";
  if (password_verify($mdpA, $mdp)) {
    if (mysqli_query($link, $sql)) {
        echo "succès";
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/');
    } else {
      echo "erreur" . mysqli_error($link);
    }
  }
}

function AffichageImg () {
  $link = dbConnect();
  
  $sql = "SELECT * FROM `users` WHERE `mail`= '$_SESSION[Mail]'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_assoc($result);

    $img = $row['PP'];
    $ext = $row['extPP'];

    header("Content-type: image/PNG");
    return $img;
  }
}

if (isset($_POST['Valider'])) {
  $mdpA = $_POST['passwordA'];
  $mdpN = password_hash($_POST['passwordN'], PASSWORD_DEFAULT);
}

ChgtMdp($mdpA, $mdpN);

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleP.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>

  <?php
      include ("../../base.php");
  ?>
      <div class="Center">
        <h1 class="texte">Paramètres</h1>
          <form method="POST" name="password">
            <p>
            <h2 class="texte">Réinitialisation du mot de passe</h2>
            <label class="texte">Ancien mot de passe</label>
            <input type="password" class="texte" name="passwordA" minlengh="8" maxlength="16" required>
            </p>
            <p>
            <label class="texte">Nouveau mot de passe</label>
            <input class="texte" type="password" name="passwordN" minlengh="8" maxlength="16" required>
            </p>
            <input class="texte" type="submit" name="Valider" value="Valider">
          </form>
            <h2 class="texte">Changement de l'image de profil</h2>
            <img src="<?php AffichageImg(); ?>" alt="Photo de profil" class="PP">;
            <span class="texte"><p class="pp"></p><i class="fas fa-folder-open"></i> Charger une image à partir de mon ordinateur</span>
      </div>
  </div>
</div>
</body>
</html>

<?php
}
?>
