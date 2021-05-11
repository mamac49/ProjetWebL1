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
    while($row = mysqli_fetch_array($result)) {
      if (isset($row[`data`])) {
      $Txt[$row[`position`]] = $row[`data`];
    }}
  }

  $result = mysqli_query($link, $sqlLiens);
  $Liens = array();
  if ($result) {
    while($row = mysqli_fetch_array($result)) {
      if (isset($row[`data`])) {
      $Liens[$row[`position`]] = $row[`data`];
    }}
  }

  $liste = array_merge($Txt, $Liens);
  ksort($liste);

  return $liste;

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
