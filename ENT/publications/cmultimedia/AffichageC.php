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
      $liste[$i] = $Txt[$i];
    } elseif (array_key_exists($i, $Liens)) {
      $liste[$i] = $Liens[$i];
    }
  }

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
          foreach (AffichageCahier($IDcahier) as $line) {
            if (substr_count($line, "http") == 1) {
              if (substr_count($line, "https://www.deezer.com/") == 1) {
                $track = str_replace("https://www.deezer.com/us/track/", "", $line); ?>
                <iframe title='deezer-widget' src=<?php print 'https://widget.deezer.com/widget/dark/track/'. $track .'?tracklist=false' ?> width='400' height='300' frameborder='0' allowtransparency='true' allow='encrypted-media; clipboard-write'></iframe>
              <?php
              } else {
                echo "<a href=". $line .">". $line ."</a><br>";
              }
            } else {
              echo "<pre>". $line ."</pre>";
            }} ?>

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
