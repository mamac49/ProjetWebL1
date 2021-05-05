<?php
session_start();

include '../../fonc.php';

function nbCm() {
  $link = dbConnect();
  $sql = "SELECT `idpublications` FROM `Publications` WHERE `nature`=2";
  if ($result = mysqli_query($link, $sql)) {
    return mysqli_num_rows($result);
  }
}

function titre($x) {
  $link = dbConnect();
  $sql = "SELECT `titre` FROM `Publications` WHERE `nature`=2 AND `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0];
  }
}

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cahier Multimédia</title>
    <link rel="stylesheet" href="styleC.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>

          <div class="Center">
            <h2 class="texte">Listes des cahiers</h2>
            <div class="leaf">
              <ul class="liste">
                <?php
                for ($x=1 ; $x<=nbCm() ; $x++) {
                ?>
                  <li class="texte"><a class="Copybook" href="media/Cahier1.html"><i class="fas fa-book IcoBook"></i><?php var_dump(titre($x)); ?></a></li>
                <?php
                }
                ?>
              </ul>
              <?php
                if ($_SESSION["Admin"] == true) {
              ?>
              <a href="creationC.php">Créer un cahier multimédia</a>
              <?php
                }
              ?>
            </div>
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
