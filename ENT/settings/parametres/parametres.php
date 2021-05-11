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

function chgtThemeDef($theme) {
  $link = dbConnect();
  $sql = "UPDATE `users` SET `theme` = '$theme' WHERE `mail`= '$_SESSION[Mail]'";
  if (mysqli_query($link, $sql)) {
    reset($_POST);
    mysqli_close($link);
    header("refresh: 0");
    $_SESSION['theme'] = $theme;
  }
}

if (isset($_POST['Valider'])) {
  if (securisation($_POST['passwordN']) == securisation($_POST['passwordNN'])) {
    $mdpN = securisation(password_hash($_POST['passwordN'], PASSWORD_DEFAULT));
    $mdpA = securisation($_POST['passwordA']);
    ChgtMdp($mdpA, $mdpN);
  } else {
    echo "<script> alert('les deux mots de passe ne correspondent pas'); </script>";
    header("refresh: 0");
  }
}


if (isset($_POST['ChgtIMG'])) {
  chgtPP(file_get_contents($_FILES['PP']['tmp_name']));
}

if (isset($_POST['ValiderTheme'])) {
  chgtThemeDef($_POST['theme']);
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
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>

  <?php
      include ("../../base.php");
  ?>
      <div class="Center">
        <h1 class="texte titre_p">Paramètres</h1>
        <div class="page">
          <div class="colonnes">
            <form method="POST" name="password">
              <p>
              <h2 class="texte">Réinitialisation du mot de passe</h2>
                <div class="input-container">
                  <i class="fas fa-key iconCrea"></i>
                  <input type="password" class="texte" name="passwordA" placeholder="Ancien mot de passe" class="input-field" minlengh="8" maxlength="16" required>
                </div>
              </p>
              <p>
                <div class="input-container">
                  <i class="fas fa-lock iconCrea"></i>
                  <input class="texte" type="password" name="passwordN" placeholder="Nouveau mot de passe" class="input-field" minlengh="8" maxlength="16" required>
                </div>
              </p>
              <p>
                <div class="input-container">
                  <i class="fas fa-unlock iconCrea"></i>
                  <input class="texte" type="password" name="passwordNN" placeholder="Valider le nouveau mot de passe" class="input-field" minlengh="8" maxlength="16" required>
                </div>
              </p>
              <button type="submit" class="bouton" name="Valider"><span>Valider</span></button>
            </form>
            <form action="parametres.php" method="POST" enctype="multipart/form-data">
              <h2 class="texte">Changement de l'image de profil</h2>
              <img src="<?php echo ' data:image/png;base64,' . base64_encode(Affichage($_SESSION['Mail'])) . ' '?>" alt="Photo de profil" class="PP">
              <p class="texte"><i class='fas fa-folder-open'></i> Charger une image à partir de mon ordinateur (maximum 64ko)</p>
              <input type="file" id="file" name="PP" accept="image/*" required>
              <button type="submit" class="bouton" name="ChgtIMG"><span>Valider</span></button>
            </form>
          </div>
          <div class="colonnes">
            <form action="parametres.php" method="post">
              <h2 class="texte">Thème par défault</h2>
              <p>
                <label class="texte" for="clair">Thème clair</label>
                <input type="radio" checked name="theme" id="clair" value="0">
              </p>
              <p>
                <label class="texte" for="sombre">Thème sombre</label>
                <input type="radio" name="theme" id="sombre" value="1">
              </p>
              <button type="submit" class="bouton" name="ValiderTheme"><span>Valider le thème</span></button>
            </form>
          </div>
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
