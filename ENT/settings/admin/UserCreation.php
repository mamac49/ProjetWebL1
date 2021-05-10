<?php
session_start();

error_reporting(E_ALL);

include '../../fonc.php';

function Create($nom, $prenom, $mail, $password, $date, $admin, $classe) {
    $link = dbConnect();
    mysqli_query($link, "FLUSH `users`");

    $pp = file_get_contents("../../data/PP.png", True);
    $pp = mysqli_real_escape_string($link, $pp);
    $iduser = max(max(nombre())) + 1;

    $sql = "INSERT INTO `users` (`iduser`, `prenom`, `nom`, `mail`, `mdp`, `date_n`, `admin`, `Classe`, `data`)
    VALUES ('$iduser', '$prenom', '$nom', '$mail', '$password', '$date', '$admin', '$classe', '$pp');";
    if (mysqli_query($link, $sql)) {
        reset($_POST);
        mysqli_close($link);
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/settings/admin/UserCreation.php');
    } else {
      echo mysqli_error($link);
    }
    mysqli_close($link);
}

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `users` WHERE `iduser`='$Contact'";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `users`");
}


if ( isset($_POST['valider'])) {
    if ($_POST['mdp'] == $_POST['mdp2']) {
      $password = securisation(password_hash($_POST['mdp'], PASSWORD_DEFAULT));
      $nom = securisation($_POST['nom']);
      $prenom = securisation($_POST['prenom']);
      $mail = securisation($_POST['mail']);
      $classe = securisation($_POST['classe']);
      $date = securisation($_POST['datenaissance']);
      if (isset($_POST['admin'])) {
        $admin = securisation($_POST['admin']);
      } else {
        $admin = 0;
      }
      Create($nom, $prenom, $mail, $password, $date, $admin, $classe);
  } else {
    echo "<script> alert('les deux mots de passe ne correspondent pas'); </script>";
    header("refresh: 0");
  }
}

if ( isset($_POST['ValiderSupp'])) {
  $user = $_POST['user'];
  Delete($user);
}

if ($_SESSION["Connected"] == true and $_SESSION["Admin"] == True) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleAd.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/Admin.js"></script>
    <link rel="stylesheet" href="styleAd.css">
  </head>

    <?php
      include ("../../base.php");
    ?>

        <div class="Center">

            <form action="UserCreation.php" method="POST" class="Formulaire" enctype="multipart/form-data">
                <h2 class="texte">Création d'utilisateur</h2>
                <div class="input-container">
                  <i class="fas fa-user iconCrea"></i>
                  <input type="text" name="nom" placeholder="Nom" class="input-field" required>
                </div>
                <div class="input-container">
                  <i class="far fa-user iconCrea"></i>
                  <input type="text" name="prenom" placeholder="Prénom" class="input-field" required>
                </div>
                <div class="input-container">
                  <i class="fas fa-envelope iconCrea"></i>
                  <input type="email" name="mail" placeholder="E-mail" class="input-field" required>
                </div>
                <div class="input-container">
                  <i class="fas fa-key iconCrea"></i>
                  <input type="password" name="mdp" placeholder="Mot de passe" class="input-field" required>
                </div>
                <div class="input-container">
                  <i class="fas fa-key iconCrea"></i>
                  <input type="password" name="mdp2" placeholder="Vérification du mot de passe" class="input-field" required>
                </div>
                <div class="input-container">
                <i class="fas fa-calendar-day iconCrea"></i>
                  <input type="date" name="datenaissance" placeholder="DD/MM/AAAA" class="input-field" required>
                </div>
                <p class="texteF">Administrateur ?
                <input type="checkbox" value="1" name="admin"></p>
                <p>
                  <label class="texte" for="GS">GS</label>
                  <input type="radio" name="classe" id="GS" value="GS">
                <br>
                  <label class="texte" for="CP">CP</label>
                  <input type="radio" name="classe" id="CP" value="CP">
                </p>
                <input type="submit" name="valider" value="Creer" class="FormCrea bouton Centrer">
            </form>
            <form action="UserCreation.php" method="post" class="Formulaire">
              <h2 class="texte">Suppression d'utilisateur</h2>
              <select class="custom-select" name="user">
                <?php
                foreach (nombre() as $x) { ?>
                  <option class="texte" value="<?php echo $x[0] ?>"><?php echo info($x[0])["prenom"] . " " . info($x[0])["nom"]; ?></option>
                <?php } ?>
              </select>

              <input type="submit" name="ValiderSupp" value="Supprimer l'utilisateur" class="bouton Séparer">

            </form>

        </div>


        </div>
    </div>
  </div>
  </div>
</html>

<?php
} elseif ($_SESSION['Connected'] == False) {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT');
}
?>
