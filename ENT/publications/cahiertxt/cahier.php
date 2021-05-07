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
        <button class="tablinks" onmouseover="openDay(event, 'Lundi')" autofocus>Lundi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Mardi')">Mardi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Jeudi')">Jeudi</button>
        <button class="tablinks" onmouseover="openDay(event, 'Vendredi')">Vendredi</button>
      </div>

      <div id="Lundi" class="tabcontent">
        <h3>Lundi</h3>
        <ul>
        <?php if ($_SESSION["Classe"] == "GS" OR $_SESSION['Admin'] == True) { ?>
          <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
          <li><i class="fas fa-flask matiere"></i> Science : </li>
          <li><i class="fas fa-landmark matiere"></i> Histoire : </li>
        <?php } else if ($_SESSION["Classe"] == "CP" OR $_SESSION['Admin'] == True) {  ?>
          <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
        <?php } ?>
        </ul>
      </div>

      <div id="Mardi" class="tabcontent">
        <h3>Mardi</h3>
        <ul>
          <?php if ($_SESSION["Classe"] == "GS" OR $_SESSION['Admin'] == True) { ?>
            <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
            <li><i class="fas fa-book matiere"></i> Français : </li>
            <li><i class="fas fa-globe-americas matiere"></i> Géographie : </li>
          <?php } else if ($_SESSION["Classe"] == "CP" OR $_SESSION['Admin'] == True) {  ?>
            <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
          <?php } ?>
        </ul>
      </div>

      <div id="Jeudi" class="tabcontent">
        <h3>Jeudi</h3>
        <ul>
        <?php if ($_SESSION["Classe"] == "GS" OR $_SESSION['Admin'] == True) { ?>
          <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
        <?php } else if ($_SESSION["Classe"] == "CP" OR $_SESSION['Admin'] == True) {  ?>
          <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
          <li><i class="fas fa-bicycle matiere"></i> Sport : </li>
          <li><i class="fas fa-landmark matiere"></i> Histoire : </li>
        <?php } ?>
        </ul>
      </div>

      <div id="Vendredi" class="tabcontent">
        <h3>Vendredi</h3>
        <ul>
        <?php if ($_SESSION["Classe"] == "GS" OR $_SESSION['Admin'] == True) { ?>
          <li><i class="fas fa-square-root-alt matiere"></i> Mathématiques : </li>
        <?php } else if ($_SESSION["Classe"] == "CP" OR $_SESSION['Admin'] == True) {  ?>
          <li><i class="fas fa-book matiere"></i> Français : </li>
        <?php } ?>
        </ul>
      </div>

      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <button type="button" onclick="document.getElementById('AddHW').style.display='block'" name="button">Ajouter des devoirs</button>
        <button type="button" onclick="DeleteWork" name="button">Supprimer des devoirs</button>
      <?php
      }
      ?>

    </div>

    <div id="AddHW" class="modal">
      <span onclick="document.getElementById('AddHW').style.display='none'"
class="close" title="Close Modal">x</span>

      <form class="modal-content animate" action="cahier.php" method="post">
        <div class="container">
          <h3>Classe</h3>
          <p>
            <label class="texte" for="GS">GS</label>
            <input type="radio" name="classe" id="GS" value="GS">
          <br>
            <label class="texte" for="CP">CP</label>
            <input type="radio" name="classe" id="CP" value="CP">
          </p>
          <h3>Matière</h3>
          <select name="matiere">
            <option value="francais">Français</option>
            <option value="maths">Mathématiques</option>
            <option value="science">Science</option>
            <option value="histoire">Histoire</option>
            <option value="geo">Géographie</option>
            <option value="autre">Autre</option>
          </select>
          <h3>Intitulé</h3>
          <input type="text" name="consigne">
          <input type="sumbit" name="ValiderAdd" value="Ajouter">
        </div>
      </form>
    </div>




<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
