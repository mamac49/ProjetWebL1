<?php
session_start();

include '../../fonc.php';

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `Publications` WHERE `idpublications`='$Contact'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }
  $sql = "DELETE FROM `texte` WHERE `idpublications`='$Contact'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }
  $sql = "DELETE FROM `image` WHERE `idpublications`='$Contact'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }
  $sql = "DELETE FROM `liens` WHERE `idpublications`='$Contact'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }

  mysqli_query($link, "FLUSH `Publications`");
  mysqli_query($link, "FLUSH `texte`");
  mysqli_query($link, "FLUSH `image`");
  mysqli_query($link, "FLUSH `liens`");
}


if ( isset($_POST['ValiderSupp'])) {
  $Cmulti = $_POST['Cmulti'];
  Delete($Cmulti);
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

          <div class="Center_adap">
            <h2 class="texte">Liste des cahiers</h2>
            <div class="leaf">
              <ul class="liste">
                <?php
                foreach (nbPub() as $x) {
                  if (nature($x[0])["nature"] == "2") {
                ?>
                  <li class="texte"><div class="chip"><a class="Copybook" href="AffichageC.php?id=<?php print $x[0] ?>"><?php echo "<i class='". $matiere[nature($x[0])["matiere"]] ."'></i>"?></i><?php echo titre($x[0]); ?></a></div></li>
                <?php
                  }
                }
                ?>
              </ul>
              <?php
                if ($_SESSION["Admin"] == true) {
              ?>
              <form class="AdminMulti" action="cmedia.php" method="post">
                <button type="button" class="bouton" name="CreationCmedia" onclick="window.location.href = 'creationC.php';"><span>Créer un cahier</span></button>
                <select name="Cmulti">
                  <?php
                  foreach (nbPub() as $x) {
                    if (nature($x[0])["nature"] == "2") {
                  ?>
                    <option class="texte" value="<?php echo $x[0] ?>"><?php echo titre($x[0]); ?></option>
                  <?php }} ?>
                </select>
                <button type="submit" class="bouton" name="ValiderSupp"><span>Supprimer</span> </button>
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
