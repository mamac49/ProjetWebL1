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
        header('Location: /Projetwebl1/ENT/settings/admin/UserCreation.php');
    } else {
      echo mysqli_error($link);
    }
    mysqli_close($link);
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

if ($_SESSION["Connected"] == true and $_SESSION["Admin"] == True) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'administration</title>
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/styleLittle.css">
    <link rel="stylesheet" media="all and (min-width: 480px) and (max-width: 1023px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>

    <?php
      include ("../../base.php");
    ?>

        <div class="Center_adap has_cols">

            <form action="UserCreation.php" method="POST" class="Formulaire colonne" enctype="multipart/form-data">
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
                <input type="checkbox" value="1" name="admin" id="checkbox_admin" onclick="admin_checked()"></p>
                <div id="classe">
                  <p>
                    <label class="texte" for="GS">GS</label>
                    <input type="radio" name="classe" id="GS" value="GS">
                  <br>
                    <label class="texte" for="CP">CP</label>
                    <input type="radio" name="classe" id="CP" value="CP">
                  </p>
                </div>
                <button type="submit" name="valider" class="FormCrea bouton Centrer"><span>Créer</span></button>
            </form>
            <div class="colonne">
              <h2 class="texte">Suppression d'utilisateur</h2>
              <ul>
                <?php
                foreach (nombre() as $x) {
                  if ($x[0] != $_SESSION['ID']) { ?>
                  <li class="texte suppression"><?php echo info($x[0])["prenom"] . " " . info($x[0])["nom"]; ?><a href="SupUser.php?id=<?php print $x[0] ?>"><i class="fas fa-times fermer Fdroite"></i></a></li>
                <?php }} ?>
              </ul>
            </div>

        </div>


        </div>
    </div>
  </div>
  </div>
</html>

<?php
} elseif ($_SESSION['Connected'] == False) {
  header('Location: /Projetwebl1/ENT/auth/auth.php');
} else {
  header('Location: /Projetwebl1/ENT');
}
?>
