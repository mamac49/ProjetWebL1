<?php
session_start();

include '../../fonc.php';

function Save($type, $message) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `avis`");

  $date = date("Y-m-d H:i:s");
  $id = $_SESSION["ID"];

  $nb = array_key_last(nombreAvis())+1;

  $sql = "INSERT INTO `avis` (`IDavis`, `type`, `message`, `date`, `iduser`) VALUES ('$nb', '$type', '$message', '$date', '$id')";
  if (mysqli_query($link, $sql)) {
    echo  "<script>console.log('succès')</script>";
  } else {
      echo mysqli_error($link);
  }
}

function nombreAvis() {
  $link = dbConnect();
  $sql = "SELECT * FROM `avis`";
  $result = mysqli_query($link, $sql);
  $IDavis = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDavis[$row[0]] = $row[0];
    }
  }
  return $IDavis;
}

function nombreAvisUser() {
  $link = dbConnect();
  $id = $_SESSION['ID'];
  $sql = "SELECT `IDavis` FROM `avis` WHERE `iduser`=$id";
  $result = mysqli_query($link, $sql);
  $IDavis = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDavis[] = $row[0];
    }
  }
  return $IDavis;
}

function AfficheAvis($id) {
  $link = dbConnect();

  $icone = array();
  $icone["Bug"] = "<i class='fas fa-bug icone icone'></i>";
  $icone["Avis"] = "<i class='fas fa-comment-dots icone icone'></i>";

  $sql = "SELECT * FROM `avis` WHERE `IDavis`='$id'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    $sqlUser = "SELECT * FROM `users` INNER JOIN `avis` ON `users`.`iduser` = `avis`.`iduser` WHERE `avis`.`idavis`='$id'";
    if ($resultat = mysqli_query($link, $sqlUser)) {
      $rowUser = mysqli_fetch_array($resultat);
      return array($icone[$row['type']] . $row['type'] . " - " . "(" . $row['date'] . ") " . $rowUser['mail'] . "<br>", $row['message']);
    } else {
      return mysqli_error($link);;
    }
  }
}


if (isset($_POST['ValiderEnvoi'])) {
  $type = $_POST['Type'];
  $message = $_POST['Rapport'];
  Save($type, $message);
}

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (max-width: 1024px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/scroll.js"></script>
    <title>Contact</title>
  </head>
  <?php
      include '../../base.php';
  ?>
  <div class="Center_adap texte has_cols">
    <div class="colonne">
      <form method="POST">
        <label><input type="radio" name="Type" value="Avis"><i class="fas fa-comment-dots icone"></i> Donner un avis?</label>
        <label><input type="radio" name="Type" value="Bug"><i class="fas fa-bug icone icone"></i> Signaler un bug</label>
        <p><textarea name="Rapport" placeholder="Donnez votre avis/Signaler votre problème(400 caractères maximum)" class="avis-area" max-length=400 rows="5" cols="70" required></textarea></p>
        <button type="submit" class="bouton" name="ValiderEnvoi"><span>Valider</span></button>
      </form>
      <?php
        if ($_SESSION["Admin"] == True) {
      ?>
        <button type="button" onclick="document.getElementById('ShowRate').style.display='block'" name="button" class="bouton"><span>Afficher les avis</span></button>
      <?php } ?>
    </div>
    <div class="colonne">
      <h3>Mes avis</h3>
      <ul>
        <?php $x=0;
          foreach (nombreAvisUser() as $id) { ?>
            <li class="texte suppression"><div class="avis"><p><?php echo AfficheAvis($id[0])[0];?></p><span style="display: none" id=<?php print "more-". $x ?>><?php echo AfficheAvis($id[0])[1];?></span></div>
              <a href="<?php print "SupAvis.php?id=" . $id[0];?>"><i class="fas fa-times fermer"></i></a></li>
            <button onclick="ReadMore(<?php print $x ?>)" id="<?php print "Mybtn-". $x ?>" class="bouton"><span>Lire Plus</span></button>
        <?php $x+=1; }  ?>
      </ul>
    </div>


      <div class="modal" id="ShowRate">
        <div class="modal-content animate">
          <span onclick="document.getElementById('ShowRate').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
          <h3 class="texte">Avis et bugs</h3>
          <ul>
            <?php $x=-1;
              foreach (nombreAvis() as $id) { ?>
                <li class="texte suppression"><div class="avis"><p><?php echo AfficheAvis($id[0])[0];?></p><span style="display: none" id=<?php print "more-" . $x ?>><?php echo AfficheAvis($id[0])[1];?></span></div>
                  <a href="<?php print "SupAvis.php?id=" . $id[0];?>"><i class="fas fa-times fermer"></i></a></li>
                <button onclick="ReadMore(<?php print $x ?>)" id="<?php print "Mybtn-" . $x ?>" class="bouton"><span>Lire Plus</span></button>
            <?php $x-=1; }  ?>
          </ul>
        </div>
      </div>
    </div>


    </body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
