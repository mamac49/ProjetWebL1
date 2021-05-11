<?php
session_start();

include '../../fonc.php';

$IDcahier = $_GET['id'];

function AffichageCahier($ID) {
  $link = dbConnect();

  $sqlLiens = "SELECT *  FROM `liens` WHERE `idpublications`='$ID' ORDER BY `position`";
  $sqlTxt = "SELECT *  FROM `texte` WHERE `idpublications`='$ID' ORDER BY `position`";

  $result = mysqli_query($link, $sqlTxt);
  $Txt = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      $Txt[$row["position"]] = $row["data"];
    }
  }

  $result = mysqli_query($link, $sqlLiens);
  $Liens = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      $Txt[$row["position"]] = $row["data"];
    }
  }
  $liste = array();

  for ($i=0; $i <= count($Txt) + count($Liens) ; $i++) {
    if (array_key_exists($i, $Txt)) {
      $liste[$i] = $Txt;
    } elseif (array_key_exists($i, $Liens)) {
      $liste[$i] = $Liens;
    }
  }

  return array($Txt, $Liens, $liste);

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
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>

    <!--<p> <?php echo $_GET['id'] ?></p> -->
    <div class="Center_adap">
      <h2 class="texte"><?php echo titre($IDcahier); ?></h2>
      <div class="corps">
        <?php
          var_dump(AffichageCahier($IDcahier));
        ?>

      </div>

    </div>

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
