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

function AfficherDevoir($jour, $classe) {
  $link = dbConnect();

  $sql = "SELECT * FROM `cahiertxt` WHERE (`jour`='$jour' AND `classe`='$classe');";
  if ($resultat = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($resultat);
    mysqli_free_result($resultat);
    mysqli_close($link);
    return $row;
  }
}

function AjoutDevoir($classe, $matiere, $consigne, $jour) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `cahiertxt`");

  $sql = "INSERT INTO `cahiertxt`(`jour`, `matiere`, `consigne`, `classe`) VALUES ('$jour', '$matiere', '$consigne', '$classe')";
  if (mysqli_query($link, $sql)) {
    echo "<script> document.getElementById('AddHW').style.display='none' </script>";
    mysqli_close($link);
  } else {
    echo mysqli_error($link);
    mysqli_close($link);
  }
}

function SuppressionDevoir($jour, $classe, $matiere) {
  $link = dbConnect();

  $sql = "DELETE FROM `cahiertxt` WHERE (`jour`='$jour' AND `classe`='$classe' AND `matiere`='$matiere')";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `users`");
}

if (isset($_POST['Validejout'])) {
  $classe = $_POST['classe'];
  $matiere = $_POST['matiere'];
  $consigne = securisation($_POST['consigne']);
  $jour = $_POST['jour'];
  AjoutDevoir($classe, $matiere, $consigne, $jour);
}

if (isset($_POST['ValiderRemo'])) {
  $str = explode(" ", $_POST['devoirs']);
  SuppressionDevoir($str[0], $str[1], $str[2]);
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
$mmatiere["Anglais"] = "fas fa-cloud-rain";
$matiere["EPS"] = "fas fa-biking";
$matiere["Contes"] = "fas fa-dragon";
$matiere["Rituels"] = "fas fa-chalkboard-teacher";
$matiere["Education civique"] = "fas fa-school";

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
                <h3><?php echo $jour; ?></h3>
                <ul>
                  <?php for ($i=1 ; $i <= NbPubJour($jour, "GS") ; $i++) {
                        if ($_SESSION["Classe"] == "GS" OR $_SESSION["Admin"] == True) {
                            $info = AfficherDevoir($jour, "GS");
                            $matiereP = $info['matiere'];
                            $consigne = $info['consigne']; ?>
                            <li class="texte"><?php echo "<i class='$matiere[$matiereP] matiere'></i>" . $matiereP . " : " . $consigne; ?></li>
                    <?php }} ?>

                    <?php for ($i=1 ; $i <= NbPubJour($jour, "CP") ; $i++) {
                          if ($_SESSION["Classe"] == "CP" OR $_SESSION["Admin"] == True) {
                              $info = AfficherDevoir($jour, "CP");
                              $matiereP = $info['matiere'];
                              $consigne = $info['consigne']; ?>
                              <li class="texte"><?php echo "<i class='$matiere[$matiereP] matiere'></i>" . $matiereP . " : " . $consigne; ?></li>
                    <?php }} ?>
          </ul>
        </div>
      <?php } ?>



      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <button type="button" onclick="document.getElementById('AddHW').style.display='block'" name="button">Ajouter des devoirs</button>
        <button type="button" onclick="document.getElementById('RemoveHW').style.display='block'" name="button">Supprimer des devoirs</button>
      <?php } ?>

    </div>

    <div id="AddHW" class="modal">

        <form class="modal-content animate" method="POST">
        <span onclick="document.getElementById('AddHW').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <div class="container">
          <h3>Classe</h3>
          <select name="jour">
            <option value="lundi">Lundi</option>
            <option value="mardi">Mardi</option>
            <option value="jeudi">Jeudi</option>
            <option value="vendredi">Vendredi</option>
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

    <div id="RemoveHW" class="modal">

        <form class="modal-content animate" action="cahier.php" method="POST">
        <span onclick="document.getElementById('RemoveHW').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <div class="container">
          <h3>Devoirs</h3>
          <select name="devoirs">
            <?php foreach ($semaine as $jour) {
                      for ($i=1 ; $i <= NbPubJour($jour, "GS") ; $i++) {
                        if (null!==AfficherDevoir($jour, "GS")) { ?>
                          <option value="<?php print $jour . " GS " . AfficherDevoir($jour, 'GS')['matiere'] ?>"><?php echo AfficherDevoir($jour, "GS")['matiere'] . ":" . AfficherDevoir($jour, "GS")['consigne'] ?></option>
                      <?php }}
                      for ($i=1 ; $i <= NbPubJour($jour, "CP") ; $i++) {
                        if (null!==AfficherDevoir($jour, "CP")) { ?>
                          <option value="<?php print $jour . " CP " . AfficherDevoir($jour, 'CP')['matiere'] ?>"><?php echo AfficherDevoir($jour, "CP")['matiere'] . ":" . AfficherDevoir($jour, "CP")['consigne'] ?></option>
            <?php }}} ?>

          </select>

          <p><input type="submit" name="ValiderRemo" value="Supprimer"></p>
        </div>
      </form>
    </div>




<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
