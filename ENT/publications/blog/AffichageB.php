<?php
session_start();

include '../../fonc.php';

$IDblog = $_GET['id'];

function textevide($x) { //renvoie le texte d'une publication, aussi utilisé pour savoir si il n'y a pas encore de texte (variable NULL)
  $link = dbConnect();
  $sql = "SELECT `texte` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0];
  }
}

function temps_ecriture_P($x) { //renvoie l'heure et la date à laquelle est écrit ou édité la publication
  $link = dbConnect();
  $sql = "SELECT `date_ecriture`,`heure_ecriture` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." à ".$row[1];
  }
}

function auteurP($x) { //renvoie le prénom et le nom de la personne qui a écrit ou édité la publication
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." ".$row[1];
  }
}

function temps_ecriture_C($x) { //renvoie l'heure et la date à laquelle est écrit ou édité le commentaire
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Commentaires WHERE` `nature`=1 AND `idcom`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." ".$row[1];
  }
}

function auteurC($x) { //renvoie le prénom et le nom de la personne qui a écrit ou édité le commentaire
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Commentaires` WHERE `nature`=1 AND `idcom`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." ".$row[1];
  }
}

function auteurB($x) { //renvoie l'id de la personne ayant créé le cette page du blog
  $link = dbConnect();
  $sql = "SELECT `iduser` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0];
  }
}

function idCom($x) { //renvoie le texte de chaque commentaire relié à leur publication
  $link = dbConnect();
  $sql = "SELECT `idcom` FROM `Commentaires` WHERE `idpublications`=(SELECT `idpublications` FROM `Publications` WHERE `idcom`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    return mysqli_num_rows($result);
  }
}

function message($x) { //renvoie le texte de chaque commentaire relié à leur publication
  $link = dbConnect();
  $sql = "SELECT `message` FROM `Commentaires` WHERE `idcom`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
    return $row;
  }
}

if ($_SESSION["Connected"] == true) { // vérifie si on est bien connecté via l'authentification (auth.php)
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo titre($IDblog); ?></title> <!--renvoie le titre du blog via l'id de ce dernier-->
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

  <body>
    <div class="Center">
      <h2 class="texte"><?php echo titre($IDblog); ?></h2>
      <br/>
      <div class="corpsB">
        <div class="Publication_texte">
          <?php if (textevide($IDblog)==""){ ?>
            <span>Il n'y a pas encore de publication!</span>
            <br/>
            <br/>
            <input type="button" value="Ajouter une publication">
          <?php } else {
            $auteur=auteurP($IDblog);
            $temps=temps_ecriture_P($IDblog); ?>
            <span class="texte"> Edité par <?php echo $auteur; ?> le <?php echo $temps; ?></span>
            <p><?php echo textevide($IDblog);
            $res=auteurB($IDblog); ?></p>
            <?php if ($_SESSION["ID"]==$res){ ?>
              <input type="button" value="Editer la publication">
            <?php }
            foreach (nbCom() as $x){
              echo $x[0];
              if (idCom($x[0]) == $IDblog){
                $auteurC=auteurC($x[0]);
                $tempsC=temps_ecriture_C($x[0]);
                $message=message($x[0]);
              ?>
                <span class="texte"> Edité par <?php echo $auteurC; ?> le <?php echo $tempsC; ?></span>
                <p><?php echo $message; ?></p>
                <?php
              }
            }
          }
          ?>
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
