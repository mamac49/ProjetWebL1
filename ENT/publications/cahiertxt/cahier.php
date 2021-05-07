<?php
session_start();

include '../../fonc.php';

if ($_SESSION["Connected"] == "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <link rel="stylesheet" href="styletxt.css">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/cahiertxt.js"></script>
  </head>

  <?php
      include '../../base.php';
    ?>

    <div class="Center">
      <div class="semaine">
        <button class="tablinks" onmouseover="openDay(event, 'Lundi')">Lundi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Mardi')">Mardi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Jeudi')">Jeudi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Vendredi')">Vendredi</button>
      </div>

      <div id="Lundi" class="tabcontent">
        <h3>Lundi</h3>
        <ul>
          <li><i class="fas fa-square-root-alt icone"></i> Mathématiques : </li>
          <li><i class="fas fa-flask icone"></i> Science : </li>
          <li><i class="fas fa-landmark icone"></i> Histoire : </li>
        </ul>
      </div>

      <div id="Mardi" class="tabcontent">
        <h3>Mardi</h3>
        <ul>
          <li><i class="fas fa-square-root-alt icone"></i> Mathématiques : </li>
          <li><i class="fas fa-book icone"></i> Français : </li>
          <li><i class="fas fa-globe-americas icone"></i> Géographie : </li>
        </ul>
      </div>

      <div id="Jeudi" class="tabcontent">
        <h3>Jeudi</h3>
        <ul>
          <li><i class="fas fa-square-root-alt icone"></i> Mathématiques : </li>
          <li><i class="fas fa-bicycle"></i> Sport : </li>
          <li><i class="fas fa-landmark icone"></i> Histoire : </li>
        </ul>
      </div>

      <div id="Vendredi" class="tabcontent">
        <h3>Vendredi</h3>
        <ul>
          <li><i class="fas fa-square-root-alt icone"></i> Mathématiques : </li>
          <li><i class="fas fa-book icone"></i> Français : </li>
        </ul>
      </div>

      <form action="cahier.php" method="post" class="devoirs">
      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <input type="button" class="bouton" name="ajout" value="ajouter des devoirs">
        <input type="button" class="bouton" name="suppresion" value="enlever des devoirs">
      <?php
      }
      ?>
      </form>
    </div>



<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
