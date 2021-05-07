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

function temps_ecriture($x) {
  $link = dbConnect();
  $sql = "SELECT `date_ecriture`,`heure_ecriture` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." à ".row[1];
  }
}

function auteur($x) {
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM Publications WHERE `nature`=1 AND `idpublications`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." ".$row[1];
  }
}

function auteur2($x) {
  $link = dbConnect();
  $sql = "SELECT `iduser` FROM `users` WHERE iduser=(SELECT `iduser` FROM Publications WHERE `nature`=1 AND `idpublications`='$x')";
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
  <body>
    <div class="Center">
      <h2 class="texte"><?php echo titre($IDblog); ?></h2>
      <br/>
      <div class="corpsB">
        <div class="Publication_texte">
          <?php if (textevide($IDblog)==""){ ?>
            <p>Il n'y a pas encore de publication!</p>
            <input type="button" value="Ajouter une publication">
          <?php } else {
            $auteur=auteur($IDblog);
            $temps=temps_ecriture($IDblog);?>
            <span class="texte"> Edité par <?php echo $auteur; ?> le <?php echo $temps; ?></span>
            <p><?php echo textevide($IDblog);
            $res=auteur2($IDblog);?></p>
            <?php if ($_SESSION["ID"]==$res){ ?>
            <input type="button" value="Editer la publication">
          <?php }}?>


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
