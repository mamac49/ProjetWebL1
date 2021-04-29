<?php
error_reporting(E_ALL);

function dbConnect() {
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

    if (mysqli_connect_errno()) {
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    echo 'accès réussi'."\n";
    return $link;
}

function Connexion($mail, $password) {
    $link = dbConnect();

    $sql = "SELECT 'mdp' FROM `users` WHERE 'mail'='$mail'";

    if ($result = mysqli_query($link, $sql)) {
        echo "succès";
        while ( $row = mysqli_fetch_assoc($result)) {
            $mdp = $row['mdp'];
        }
    } else {
        echo "erreur" . mysqli_error($link);
    }

    if ($password == $mdp) {
        echo "connexion réussi";
    } else {
        echo "erreur";
    }
}

if (isset($_POST['Valider'])) {
    $mail = $_POST['Id'];
    $password = $_POST['MotDePasse'];
}

Connexion($mail, password_hash($password, PASSWORD_DEFAULT));

?>