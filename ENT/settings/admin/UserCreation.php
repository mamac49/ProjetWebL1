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
    $admin = $_POST['admin'];
}

Create($nom, $prenom, $mail, $password, $date, $pp, $admin);

mysqli_close($link);

?>