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



function Create($nom, $prenom, $mail, $password, $date)
{
    $link = dbConnect();
    if ($result = mysqli_query($link, "SELECT * FROM users")); {
        $nb = mysqli_num_rows($result);
    }
    mysqli_free_result($result);

    $iduser = $nb + 1;

    mysqli_query($link, "INSERT INTO `users` ($iduser, $prenom, $nom, $mail, $password, $date)");

}

if ( isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = $_POST['mdp'];
    $date = $_POST['datenaissance'];

    exit;
}

Create($nom, $prenom, $mail, $password, $date);

mysqli_close($link);

?>