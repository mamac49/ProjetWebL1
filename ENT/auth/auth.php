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

function Connexion($mail, $password) {
    $link = dbConnect();
    session_unset();

    $sql = "SELECT * FROM `users` WHERE `mail`= '$mail' ";
    if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);
        $mdp = $row['mdp'];
        if (isset ($row['admin'])) {
          $admin = True;
          echo "a";
        }
        $id = $row['iduser'];
    }
    mysqli_free_result($result);

    if (password_verify($password, $mdp)) {
        $_SESSION["Connected"] = True;
        $_SESSION["Mail"] = $mail;
        $_SESSION["ID"] = $id;
        if ($admin == True) {
          $_SESSION["Admin"] = True;
        }
        echo "b";
        //header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
    }
}

if (isset($_POST['Valider'])) {
    $mail = $_POST['Id'];
    $password = $_POST['MotDePasse'];
}

Connexion($mail, $password);

if ( $_SESSION["Connected"] == true) {
    header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
    echo "a";
    var_dump($_SESSION["Connected"]);
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