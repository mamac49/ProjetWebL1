<?php
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
    } else {
        echo "erreur récupération" . mysqli_error($link);
    }
    echo "a" . $mdp . "<br>" . "b" . $password;

    if ($password == $mdp) {
        echo "connexion réussi";
    } else {
        echo "erreur connexion";
    }
}

if (isset($_POST['Valider'])) {
    $mail = $_POST['Id'];
    $password = password_hash($_POST['MotDePasse'], PASSWORD_DEFAULT);
}

Connexion($mail, $password);

?>