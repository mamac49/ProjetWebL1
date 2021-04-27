<?php
error_reporting(E_ALL);
require ('demo.inc.php');
debutHtml('Connexion à la base');
echo '<p> démonstration à venir de connexion à une base </p>' ;
finHtml();

$link = mysqli_connect('localhost', 'phpmyadmin', 'Jelly49400', 'ENT');

?>