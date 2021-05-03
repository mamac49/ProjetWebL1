<?php
session_start();

error_reporting(E_ALL);

include '../../fonc.php';



function Create($nom, $prenom, $mail, $password, $date, $pp, $admin) {
    $link = dbConnect();
    if ($result = mysqli_query($link, "SELECT * FROM `users`")) {
        $nb = mysqli_num_rows($result);
    }
    mysqli_free_result($result);

    $iduser = $nb + 1;

    $sql = "INSERT INTO `users` (`iduser`, `prenom`, `nom`, `mail`, `mdp`, `date_n`, `admin`) VALUES ('$iduser', '$prenom', '$nom', '$mail', '$password', '$date', '$admin');";
    if (mysqli_query($link, $sql)) {
      $pp = mysqli_real_escape_string($link, $pp);
      $sql2 = "INSERT INTO `users` (`data`) VALUE ('$pp');";
      if (mysqli_query($link, $sql2)) {
        reset($_POST);
        mysqli_close($link);
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/settings/admin/UserCreation.php');
        exit();
      } else {
        echo mysqli_error($link);
      }
    } else {
      echo mysqli_error($link);
    }
    mysqli_close($link);
}

if ( isset($_POST['valider'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $date = $_POST['datenaissance'];
    $pp = file_get_contents($_FILES['pp']['tmp_name']);
    if (isset($_POST['admin'])) {
      $admin = $_POST['admin'];
    } else {
      $admin = 0;
    }
    Create($nom, $prenom, $mail, $password, $date, $pp, $admin);
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
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <link rel="stylesheet" href="styleAd.css">
  </head>

    <?php
      include ("../../base.php");
    ?>

        <div class="Center">

            <form action="UserCreation.php" method="POST" class="Formulaire" enctype="multipart/form-data">
                <h2>Création d'utilisateur</h2>
                <p class="texteF">Nom</p>
                  <input type="text" name="nom" placeholder="Nom" class="FormCrea Centrer" required>
                <p class="texteF">Prenom</p>
                  <input type="text" name="prenom" placeholder="Prénom" class="FormCrea Centrer" required>
                <p class="texteF">Email</p>
                  <input type="email" name="mail" placeholder="E-mail" class="FormCrea Centrer" required>
                <p class="texteF">Mot de passe</p>
                  <input type="password" name="mdp" placeholder="Mot de passe" class="FormCrea Centrer" required>
                <p class="texteF">Date de naissance</p>
                  <input type="date" name="datenaissance" placeholder="DD/MM/AAAA" class="FormCrea Centrer" required>
                <p class="texteF">Sélectionner l'image de profil (64ko maximum)</p>
                  <input type="file" id="file" name="pp" accept="image/*" required>
                <p class="texteF">Administrateur ?</p>
                <input type="checkbox" value="1" name="admin">
                <input type="submit" name="valider" value="Creer" class="FormCrea Bouton Centrer">
            </form>
            <form action="UserCreation.html" method="post" class="Formulaire">
              <h2>Suppression d'utilisateur</h2>
              <select name="user">
                <?php
                $nb = nombre();
                for ($x=1; $x<=$nb+2; $x++) {
                ?>
                  <option value="<?php $x ?>"><?php echo nom($x); ?></option>
                <?php } ?>

              </select>



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
