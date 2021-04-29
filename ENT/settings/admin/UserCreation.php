<?php

session_start();

error_reporting(E_ALL);

function dbConnect() {
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

    if (mysqli_connect_errno()) {
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    return $link;
}



function Create($nom, $prenom, $mail, $password, $date, $pp, $admin)
{
    $link = dbConnect();
    if ($result = mysqli_query($link, "SELECT * FROM users")) {
        $nb = mysqli_num_rows($result);
    }
    mysqli_free_result($result);

    $iduser = $nb + 1;

    $sql = "INSERT INTO `users` (`iduser`, `prenom`, `nom`, `mail`, `mdp`, `date_n` ,`pp`, `admin`) VALUES ('$iduser', '$prenom', '$nom', '$mail', '$password', '$date', '$pp', '$admin');";

    if (mysqli_query($link, $sql)) {
        echo "succès";
        reset($_POST);
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/settings/admin');
        exit();
    } else {
        echo "erreur" . mysqli_error($link);
    }

}

if ( isset($_POST['valider'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $date = $_POST['datenaissance'];
    $pp = $_POST['pp'];
    if (isset($_POST['admin'])) {
      $admin = $_POST['admin'];
    } else {
      $admin = 0;
    }
    
}

Create($nom, $prenom, $mail, $password, $date, $pp, $admin);

mysqli_close($link);

if ($_SESSION["Connected"] = true and $_SESSION["Admin"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="styleAd.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <link rel="stylesheet" href="styleAd.css">
  </head>

    <?php
      include ("../../base.php");
    ?>

        <div class="Centre">
            <form action="UserCreation.php" method="POST" class="Formulaire">
                <input type="text" name="nom" placeholder="Nom" class="FormCrea" required>
                <input type="text" name="prenom" placeholder="Prénom" class="FormCrea" required>
                <input type="email" name="mail" placeholder="E-mail" class="FormCrea" required>
                <input type="password" name="mdp" placeholder="Premier mot de passe" class="FormCrea" required>
                <input type="date" name="datenaissance" placeholder="DD/MM/AAAA" class="FormCrea" required>
                <label for="file">Sélectionner la PP</label>
                <input type="file" id="file" name="pp" accept="image/*" required>
                <label for="admin">Admin ?</label>
                <input type="checkbox" value="1" name="admin">
                <input type="submit" name="valider" value="Creer" class="FormCrea Bouton">
            </form>

        </div>


        <?php
          include ("../../footer.php");
        ?>
        </div>
    </div>
  </div>
  </div>
</html>

<?php
}
?>