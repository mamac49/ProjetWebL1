<?php
session_start();

include '../fonc.php';

function Connexion($mail, $password) {
    $link = dbConnect();

    $sql = "SELECT * FROM `users` WHERE `mail`= (?) ";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $mail);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        $mdp = $row['mdp'];
        $id = $row['iduser'];
        $theme = $row['theme'];
        if ($row['admin'] == 1) {
          $admin = True;
        } else {
          $admin = False;
        }
        $id = $row['iduser'];
    }
    mysqli_free_result($result);

    if (password_verify($password, $mdp)) {
        $_SESSION["Connected"] = True;
        $_SESSION["Mail"] = $mail;
        $_SESSION["ID"] = $id;
        $_SESSION["Admin"] = $admin;
        $_SESSION["theme"] = $theme;
        $_SESSION["Id"] = $id;
        $_SESSION["Pic"] = $pic;

        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
    } else {
      echo "<script> alert('Identifiant ou mot de passe faux'); </script>";
      header("refresh: 0");
    }
}

if (isset($_POST['Valider'])) {
    $mail = securisation($_POST['Id']);
    $password = securisation($_POST['MotDePasse']);

    Connexion($mail, $password);
}



if ( $_SESSION["Connected"] == true) {
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
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
  </head>
  <body>

    <div class="Fond">
      <div class="Login">
        <form action="auth.php" method="POST">
        <h2>Se connecter</h2>
        <p>E-Mail</p>
        <div class="input-container">
          <i class="fa fa-envelope icon"></i>
          <input type="mail" class="input-field" name="Id" placeholder="EMail">
        </div>
        <p>Mot de passe</p>
        <div class="input-container">
          <i class="fa fa-key icon"></i>
          <input type="password" class="input-field" name="MotDePasse" placeholder="Mot de Passe">
        </div>

        <p></p>
        <input type="submit" class="btn" name="Valider" value="Se connecter">
      </form>
      </div>
    </div>


  </body>
</html>
 <?php
}
?>
