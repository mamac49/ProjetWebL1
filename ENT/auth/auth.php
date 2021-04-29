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

    if (password_verify($password, $mdp)) {
        echo "connexion réussi";
        header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT');
        exit();
    } else {
        echo "erreur connexion";
    }
}

if (isset($_POST['Valider'])) {
    $mail = $_POST['Id'];
    $password = $_POST['MotDePasse'];
}

Connexion($mail, $password);
?>