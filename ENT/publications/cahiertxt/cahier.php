<?php
session_start();

include '../../fonc.php';

function DevoirID() {
  $link = dbConnect();

  $sql = "SELECT `idtxt` FROM `cahiertxt`";
  $result = mysqli_query($link, $sql);
  $cahiersIds = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $cahiersIds[] = $row;
    }
  }
  return $cahiersIds;
}

function NbPubJour($jour, $classe) {
  $link = dbConnect();

  $sql = "SELECT `idtxt` FROM `cahiertxt` WHERE (`jour`='$jour' AND `classe`='$classe')";
  $result = mysqli_query($link, $sql);
  $nb = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $nb[] = $row;
    }
  }
  return count($nb);
}

function AfficherDevoir($jour, $classe, $matiere) {
  $link = dbConnect();

  $sql = "SELECT * FROM `cahiertxt` WHERE (`jour`='$jour' AND `classe`='$classe' AND `matiere`='$matiere');";
  if ($resultat = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($resultat);
    mysqli_free_result($resultat);
    mysqli_close($link);
    return $row;
  }
}

if (isset($_POST['ValiderAjout'])) {
  $_SESSION['devoirs'] = array($_POST['classe'], $_POST['matiere'], securisation($_POST['consigne']), $_POST['jour']);
  header("Location: AjoutDevoir.php");
}


$semaine = array("Lundi", "Mardi", "Jeudi", "Vendredi");

$matiere = array();
$matiere["Maths"] = "fas fa-square-root-alt";
$matiere["Francais"] = "fas fa-book";
$matiere["Sciences"] = "fas fa-flask";
$matiere["Espace"] = "fas fa-map";
$matiere["Temps"] = "fas fa-clock";
$matiere["Musique"] = "fas fa-music";
$matiere["Arts"] = "fas fa-palette";
$matiere["Anglais"] = "fas fa-cloud-rain";
$matiere["EPS"] = "fas fa-biking";
$matiere["Contes"] = "fas fa-dragon";
$matiere["Rituels"] = "fas fa-chalkboard-teacher";
$matiere["Education civique"] = "fas fa-school";

$ListMatiere = array("Maths", "Francais", "Sciences", "Espace", "Temps", "Musique", "Arts", "Anglais", "EPS", "Contes", "Rituels", "Education civique");

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

      <?php foreach ($semaine as $jour) {?>
        <div id="<?php echo $jour; ?>" class="tabcontent">
          <h3 class=texte><?php echo $jour; ?></h3>
            <ul>
              <?php
                  foreach ($ListMatiere as $x) {
                    if (gettype(AfficherDevoir($jour, "GS", $x)) != "NULL") {
                       $info = AfficherDevoir($jour, "GS", $x);
                       $consigne = $info['consigne']; ?>
                      <li class="texte suppression"><div class="DevoirC"> <?php echo "<i class='$matiere[$x] matiere'></i>" . "<span class='MG'>" . $x .  " : " . "</span>" . $consigne; ?></div>
                        <?php if ($_SESSION["Admin"] == True) { ?> <a href="SupDevoir.php?id=<?php print $info['idtxt'] ?>"><i class="fas fa-times fermer"></i></a> <?php } ?></li>
              <?php }} ?>

              <?php
                  foreach ($ListMatiere as $x) {
                    if (gettype(AfficherDevoir($jour, "CP", $x)) != "NULL") {
                       $info = AfficherDevoir($jour, "CP", $x);
                       $matiereP = $info['matiere'];
                       $consigne = $info['consigne']; ?>
                       <li class="texte suppression"><div class="DevoirC"> <?php echo "<i class='$matiere[$x] matiere'></i>" . "<span class='MG'>" . $x .  " : " . "</span>" . $consigne; ?></div>
                         <?php if ($_SESSION["Admin"] == True) { ?> <a href="SupDevoir.php?id=<?php print $info['idtxt'] ?>"><i class="fas fa-times fermer"></i></a> <?php } ?></li>
              <?php }} ?>
            </ul>
        </div>
      <?php } ?>



      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <button type="button" onclick="document.getElementById('AddHW').style.display='block'" name="button" class="bouton"><span>Ajouter des devoirs </span></button>
      <?php } ?>

    </div>

    <div id="AddHW" class="modal">

        <form class="modal-content animate" method="POST">
        <span onclick="document.getElementById('AddHW').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <div class="container">
          <h3>Classe</h3>
          <select name="jour">
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
          </select>
          <div>
            <input type="radio" name="classe" id="GS" value="GS" checked>
            <label class="texte" for="GS">GS</label>
          <br>
            <input type="radio" name="classe" id="CP" value="CP">
            <label class="texte" for="CP">CP</label>
          </div>
          <h3>Matière</h3>
          <select name="matiere">
            <option value="Francais">Français</option>
            <option value="Maths">Mathématiques</option>
            <option value="Sciences">Science</option>
            <option value="Espace">Espace</option>
            <option value="Temps">Temps</option>
            <option value="Musique">Musique</option>
            <option value="Arts">Arts</option>
            <option value="Anglais">Anglais</option>
            <option value="EPS">EPS</option>
            <option value="Contes">Contes</option>
            <option value="Rituels">Rituels</option>
            <option value="Education civique">Education civique</option>
          </select>
          <h3>Consigne</h3>
          <p><textarea name="consigne" rows="6" cols="40"></textarea></p>
          <p><input type="submit" name="ValiderAjout" value="Ajouter"></p>
        </div>
      </form>
    </div>




<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
