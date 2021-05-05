<?php
session_start();

if ($_SESSION["Connected"] == true) {

  include ("../../fonc.php");
  function nombrepubli() {
    $link = dbConnect();
    $sql = "SELECT COUNT(*) FROM `Publications`";
    if ($result = mysqli_query($link, $sql)) {
      $nb= mysqli_num_rows($result);
      return $nb;
    }
  }

  function titre($x) {
    $link = dbConnect();
    $sql = "SELECT `titre` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
    if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      return $row[0];
    }
  }

  function auteur($x) {
    $link = dbConnect();
    $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM Publications WHERE `nature`=1 AND `idpublications`='$x')";
    if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      return $row[0];
    }
  }

  function jour($x) {
    $link = dbConnect();
    $sql = "SELECT `date` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
    if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      return $row[0];
    }
  }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blogs</title>
    <link rel="stylesheet" href="styleB.css">
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
            <h2 class="texte">Listes des sujets</h2>
            <ul class="liste_sujets">
              <li class="espaces"><hr></li>
              <?php
              $link = dbConnect();
              $req=nbPub();
              for ($i=0;$i<$req;$i++){
                if (nature($i) == "1"){
                  $titre=titre($i);
                  $auteur=auteur($i);
                  $date=jour($i);
              ?>
              <li class="sujets"><a href="media/blog1.html"><i class="fas fa-robot icone"></i>
              <li class="espaces"><hr></li>
                <?php
                echo $titre;
                ?>
                </a> <span>Edité par
                  <?php
                  echo $auteur;
                  ?>
                  le
                  <?php
                  echo $date;
                  ?>
                  </span></li>
              <?php
                }
              }
              ?>

              <li class="sujets"><a href="media/blog2.html"><i class="fas fa-paint-brush icone"></i> Sujet n°2</a> <span>Edité par M. Langlois le 08/03/2021</span></li>
              <li class="espaces"><hr></li>
              <li class="sujets"><a href="media/blog3.html"><i class="fas fa-chess icone"></i> Sujet n°3</a> <span>Edité par M. Langlois le 09/03/2021</span></li>
            </ul>
            <br/>
            <?php
              if ($_SESSION["Admin"] == true) {
            ?>
            <form>
              <input type="button" name="CreationBlog" value="Créer Un Blog" onclick="creerpage();">
              <br/>
            </form>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
  </body>
</html>

<?php
}
?>
