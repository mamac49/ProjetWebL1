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

function Connexion($mail, $password) {
    $link = dbConnect();

    $sql = "SELECT * FROM `users` WHERE `mail`= '$mail' ";
    if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $mdp = $row['mdp'];
    }

    if (password_verify($password, $mdp)) {
        $_SESSION["Connected"] = "True";
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
        exit();
    } else {
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/auth/');
        exit();
    }
}

if (isset($_POST['Valider'])) {
    $mail = $_POST['Id'];
    $password = $_POST['MotDePasse'];
}

Connexion($mail, $password);

if ($_SESSION["Connected"] = "True") {
    header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
} else {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="styleL.css">
    <link rel="stylesheet" href="../css/color1.css">
  </head>
  <body>

    <div class="Fond">
      <div class="Login">
        <h2>Se connecter</h2>
        <p>Identifiant/Mail</p>
        <form action="auth.php" method="POST">
        <input type="text" name="Id" placeholder="Identifiant/Mail">
        <p>Mot de passe</p>
        <input type="password" name="MotDePasse" placeholder="Mot de Passe">
        <input type="submit" name="Valider" value="Se connecter">
      </form>
      </div>
    </div>


  </body>
</html>
 <?php
}
?>