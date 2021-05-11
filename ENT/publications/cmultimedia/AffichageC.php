<?php
session_start();

include '../../fonc.php';

$IDcahier = $_GET['id'];

function AffichageCahier($ID) {
  $link = dbConnect();

  $sqlLiens = "SELECT *  FROM `liens` WHERE `idpublications`='$ID' ORDER BY `position`";
  $sqlTxt = "SELECT *  FROM `texte` WHERE `idpublications`='$ID' ORDER BY `position`";
  $sqlImg = "SELECT *  FROM `image` WHERE `idpublications`='$ID' ORDER BY `position`";

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

  $result = mysqli_query($link, $sqlImg);
  $images = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_BOTH)) {
      $images[$row["position"]] = "ImageContenu" . $row["idimage"];
    }
  }
  $liste = array();

  for ($i=0; $i <= count($Txt) + count($Liens) + count($images) ; $i++) {
    if (array_key_exists($i, $Txt)) {
      $liste[$i] = $Txt[$i];
    } elseif (array_key_exists($i, $Liens)) {
      $liste[$i] = $Liens[$i];
    } elseif (array_key_exists($i, $images)) {
      $liste[$i] = $images[$i];
    }
  }
  var_dump($liste);
  return $liste;
}

function AffichageCM($element) {
  # On se connecte à la BD
  $link = dbConnect();

  # On définit la requète
  $sql = "SELECT * FROM `image` WHERE `idimage`= (?)";
  # On la prépare
  $stmt = mysqli_prepare($link, $sql);
  # Si la requète ne s'est pas faite
  if ( !$stmt ){
      # On affiche l'erreur et on se déconnecte
      echo 'Erreur d accès à la base de données - FIN';
      mysqli_close($link);
  }
  # Sinon on définit le paramètre le requète
  mysqli_stmt_bind_param($stmt, 'i', $element);
  # On exécute le requête
  if (mysqli_stmt_execute($stmt)) {
    # On récupère le résultat
    $result = mysqli_stmt_get_result($stmt);
    # On le met dans un array pour le réutiliser plus tard
    $row = mysqli_fetch_array($result);
    # Vider le cache du résultat de la requête
    mysqli_free_result($result);
  } else {
    echo mysqli_connect_error();
  }
  # Renvoyer l'image
  return $row['data'];
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
            } elseif (substr_count($line, "ImageContenu") == 1) {
              $line = str_replace("ImageContenu", "", $line); ?>
                <img src="<?php echo ' data:image/png;base64,' . base64_encode(AffichageCM($line)) . ' '?>" alt="Image" class="ImgCM">
            <?php
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
