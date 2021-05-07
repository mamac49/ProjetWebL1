<?php
session_start();

include '../../fonc.php';

$IDblog = $_GET['id'];

function textevide($x) {
  $link = dbConnect();
  $sql = "SELECT `texte` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
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
    <title><?php echo titre($IDblog); ?></title>
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

    <!--<p> <?php echo $_GET['id'] ?></p> -->
    <div class="Center">
      <h2 class="texte"><?php echo titre($IDblog); ?></h2>
      <br/>
      <div class="corpsB">
        <div class="Publication_texte">
          <p><?php echo textevide($IDblog); ?><p>
        </div>
        <?php

        ?>

      </div>

    </div>

</body>
</html>

<?php
} else {
header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
