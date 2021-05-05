<?php
session_start();

include '../../fonc.php';

function titre($x) {
  $link = dbConnect();
  $sql = "SELECT * FROM `Publications` WHERE `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row['titre'];
  }
}

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `Publications` WHERE `idpublications`='$iduser'";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `Publications`");
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
                for ($x=1 ; $x<=nbPub() ; $x++) {
                  if (nature($x) == "2") {
                ?>
                  <li class="texte"><a class="Copybook" href="AffichageC.php"><i class="fas fa-book IcoBook"></i><br><?php echo titre($x); ?></a></li>
                <?php
                  }
                }
                ?>
              </ul>
              <?php
                if ($_SESSION["Admin"] == true) {
              ?>
              <form class="AdminMulti" action="cmedia.php" method="post">
                <a href="creationC.php">Créer un cahier multimédia</a>
                <select name="Cmulti">
                  <?php
                  for ($x=1 ; $x<=nbPub() ; $x++) {
                    if (nature($x) == "2") {
                  ?>
                    <option class="texte" value="<?php echo $x ?>"><?php echo titre($x); ?></option>
                  <?php }} ?>
                </select>
              </form>

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
