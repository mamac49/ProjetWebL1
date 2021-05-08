<?php
session_start();

include '../../fonc.php';

function AfficherDevoir($jour, $classe) {
  $link = dbConnect();

  $sql = "SELECT * FROM `cahiertxt` WHERE (`jour`=='$jour' AND `classe`=$classe)";
  if ($resultat = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($resultat);
    mysqli_free_result($resultat);
    return $row;
}

function NbDevoir($jour, $classe) {
  $link = dbConnect();

  $sql = "SELECT `idtxt` FROM `cahiertxt` WHERE (`jour`=='$jour' AND `classe`=$classe)";
  if ($resultat = mysqli_query($link, $sql)) {
    $nb = mysqli_num_rows($resultat);
    mysqli_free_result($resultat);
    return $nb;
  }
}


function AjoutDevoir($classe, $matiere, $consigne, $jour) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `users`");

  $sql = "INSERT INTO `cahiertxt` (`jour`, `matiere`, `consigne`, `classe`)";
  if (mysqli_query($link, $sql)) {
    echo "succès";
    echo "<script> document.getElementById('AddHW').style.display='none' </script>";
  } else {
    echo mysqli_connect_error();
  }
}

if (isset($_POST['ValideAdd'])) {
  AjoutDevoir(securisation($_POST['classe']), securisation($_POST['matiere']), securisation($_POST['consigne']), securisation($_POST['jour']));
}

$semaine = array("Lundi", "Mardi", "Jeudi", "Vendredi");

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
    <script>
      // Get the modal
      var modal = document.getElementById('AddHW');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
       if (event.target == modal) {
         modal.style.display = "none";
       }
      }
      </script>
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

      <?php foreach ($semaine as $jour) {?>
        <div id="<?php echo $jour; ?>" class="tabcontent">
          <h3><?php echo $jour; ?></h3>
          <ul>
          <?php if ($_SESSION["Classe"] == "GS" or $_SESSION["Admin"] == True) {
            for ($i=0; $i < NbDevoir($jour, "GS"); $i++) {
              $matiere = AfficherDevoir($jour, "GS")['matiere'];
              $consigne = AfficherDevoir($jour, "GS")['consigne']; ?>
              <li><?php echo $matiere . ":" . $consigne ?></li>
            <?php }} ?>

          <?php if ($_SESSION["Classe"] == "CP" or $_SESSION["Admin"] == True) {
            for ($i=0; $i < NbDevoir($jour, "CP"); $i++) {
              $matiere = AfficherDevoir($jour, "CP")['matiere'];
              $consigne = AfficherDevoir($jour, "CP")['consigne']; ?>
              <li><?php echo $matiere . ":" . $consigne ?></li>
            <?php }} ?>
          </ul>
        </div>
      <?php } ?>



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

      <form class="modal-content animate" action="cahier.php" method="post">
        <span onclick="document.getElementById('AddHW').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <div class="container">
          <h3>Classe</h3>
          <select name="jour">
            <option value="lundi">Lundi</option>
            <option value="mardi">Mardi</option>
            <option value="jeudi">Jeudi</option>
            <option value="vendredi">Vendredi</option>
          </select>
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
          <p><input type="text" name="consigne"></p>
          <p><input type="submit" name="ValiderAdd" value="Ajouter"></p>
        </div>
      </form>
    </div>




<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
