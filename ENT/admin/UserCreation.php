<?php
error_reporting(E_ALL);

function Create($nom, $prenom, $mail, $password, $date)
{
    //* Ajouter tout ça dans la BD
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


?>