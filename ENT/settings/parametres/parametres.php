<?php
session_start();

$ID = $_SESSION['Id'];
include '../../fonc.php';

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

function chgtPP($pp) {
  $link = dbConnect();

  $pp = mysqli_real_escape_string($link, $pp);
  $request = "UPDATE `users` SET `data` = '$pp' WHERE `mail`= '$_SESSION[Mail]'";
  if (mysqli_query($link, $request)) {
    reset($_POST);
    mysqli_close($link);
    header("refresh: 0");
    exit();
  }
}

if (isset($_POST['Valider'])) {
  $mdpA = securisation($_POST['passwordA']);
  $mdpN = securisation(password_hash($_POST['passwordN'], PASSWORD_DEFAULT));
  ChgtMdp($mdpA, $mdpN);
}


if (isset($_POST['ChgtIMG'])) {
  chgtPP(file_get_contents($_FILES['PP']['tmp_name']));
}


if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleP.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>

  <?php
      include ("../../base.php");
  ?>
      <div class="Center">
        <h1 class="texte">Paramètres</h1>
        <div class="colonnes">
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
          <form action="parametres.php" method="POST" enctype="multipart/form-data">
            <h2 class="texte">Changement de l'image de profil</h2>
            <img src="<?php echo ' data:image/png;base64,' . base64_encode(Affichage()) . ' '?>" alt="Photo de profil" class="PP">
            <p class="texte"><i class='fas fa-folder-open'></i> Charger une image à partir de mon ordinateur (maximum 64ko)</p>
            <input type="file" id="file" name="PP" accept="image/*">
            <input type="submit" name="ChgtIMG" value="Valider" class="Bouton">
          </form>
        </div>
        <div class="colonnes">
          <form action="parametres.php" method="post">
            <h2 class="texte">Thème prédéfini</h2>
            <label for="clair">Thème clair</label>
            <input type="radio" checked name="theme" id="clair" value="clair">
            <label for="sombre">Thème sombre</label>
            <input type="radio" name="theme" id="sombre" value="sombre">

          </form>
        </div>

      </div>
  </div>
</div>
</body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
