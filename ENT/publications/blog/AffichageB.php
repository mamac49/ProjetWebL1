<?php
session_start();

include '../../fonc.php';

$IDblog = $_GET['id'];

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


function textevide($x) { //renvoie le texte d'une publication, aussi utilisé pour savoir si il n'y a pas encore de texte (variable NULL)
  $link = dbConnect();
  $sql = "SELECT `data` FROM `texte` WHERE `idpublications`=$x";
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
  $sql = "SELECT `date_ecriture`,`heure_ecriture` FROM `Commentaires` WHERE `idcom`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." à ".$row[1];
  }
}

function auteurC($x) { //renvoie le prénom et le nom de la personne qui a écrit ou édité le commentaire
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Commentaires` WHERE `idcom`='$x')";
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

function idCom($x) { //renvoie l'id de la publication à laquelle appartient le commentaire
  $link = dbConnect();
  $sql = "SELECT `idpublications` FROM `Publications` WHERE `idpublications`=(SELECT `idpublications` FROM `Commentaires` WHERE `idcom`=$x)";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0];
  }
}

function message($x) { //renvoie le texte de chaque commentaire relié à leur publication
  $link = dbConnect();
  $sql = "SELECT * FROM `Commentaires` WHERE `idcom`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row;
  }
}

if (isset($_POST['ValiderEnvoi'])) {
  $_SESSION['commentaires'] = array(securisation($_POST['commentaire']), $IDblog);
  header("Location: AjoutComm.php");
}


if ($_SESSION["Connected"] == true) { // vérifie si on est bien connecté via l'authentification (auth.php)
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo nature($IDblog)["titre"]; ?></title> <!--renvoie le titre du blog via l'id de ce dernier-->
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/styleLittle.css">
    <link rel="stylesheet" media="all and (min-width: 480px) and (max-width: 1023px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/scroll.js"></script>
  </head>

  <?php
  include ("../../base.php");
  ?>

  <!--<p> <?php echo $_GET['id'] ?></p> -->

  <body>
    <div class="Center_adap">
      <h2 class="texte"><?php echo nature($IDblog)["titre"]; ?></h2>
      <br/>
      <div class="corpsB">
        <div>
          <?php if (textevide($IDblog)==""){ ?>
            <span>Il n'y a pas encore de publication!</span>
            <br/>
            <br/>
            <input type="button" value="Ajouter une publication">
          <?php } else {
            $auteur=auteurP($IDblog);
            $temps=temps_ecriture_P($IDblog); ?>
            <span class="texte"> Edité par <?php echo $auteur; ?> le <?php echo $temps; ?></span>

            <div class="corps Publication_texte">
              <?php
                $res = auteurB($IDblog);
                foreach (AffichageCahier($IDblog) as $line) {
                  if (substr_count($line, "http") == 1) {
                    if (substr_count($line, "https://www.deezer.com/") == 1) {
                      $track = str_replace("https://www.deezer.com/us/track/", "", $line); ?>
                      <iframe title='deezer-widget' src=<?php print 'https://widget.deezer.com/widget/dark/track/'. $track .'?tracklist=false' ?> width='400' height='300' frameborder='0' allowtransparency='true' allow='encrypted-media; clipboard-write'></iframe>
                    <?php
                  } elseif (substr_count($line, "https://youtu.be/") == 1) {
                      $video = str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $line); ?>
                      <iframe width="450" height="330" src="<?php echo $video ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                  <?php
                } else {
                      echo "<a href=". $line .">". $line ."</a><br>";
                      }
                  } elseif (substr_count($line, "ImageContenu") == 1) {
                    $line = str_replace("ImageContenu", "", $line); ?>
                      <img src="<?php echo ' data:image/png;base64,' . base64_encode(AffichageCM($line)) . ' '?>" alt="Image" class="ImgCM">
                  <?php
                  } else {
                    echo "<pre width='950px' class='textePre'>". $line ."</pre>";
                  }} ?>

            </div>

            <?php if ($_SESSION["ID"]==$res){ ?>
              <input type="button" class="bouton" value="Editer la publication">
            <?php } ?>
            <div class="Comm">
              <?php
              foreach (nbCom() as $x){
                if (idCom($x[0]) == $IDblog){
                  $auteurC=auteurC($x[0]);
                  $tempsC=temps_ecriture_C($x[0]);
                  $message=message($x[0])["message"];
                ?>
                  <div class="ComDiv">
                    <div class="commentairefield">
                      <fieldset>
                        <legend>
                          <span class="texte"> Edité par <?php echo $auteurC; ?> le <?php echo $tempsC; ?></span>
                        </legend>
                        <?php echo $message; ?>
                      </fieldset>
                    </div>
                  <div class="Bouton-com">
                    <?php $res=message($x[0])["iduser"];
                    if ($_SESSION["ID"]==$res OR $_SESSION["Admin"] == true){ ?>
                      <a href="SupComm.php?id=<?php print $x[0] ?>" class="bouton"><span>Supprimer</span></a>
                      <?php if ($_SESSION["ID"]==$res){?>
                        <button type="submit" class="bouton" name="EditCom"><span>Editer</span></button>
                      <?php } ?>
                      <br/>
                      <br/>
                      <br/>
                    <?php } ?>
                  </div>
                </div>
              <?php }} ?>
            <br/>
            <div class="ajoutcommentaire">
              <button type="button" id="add_com" onclick="document.getElementById('AddComm').style.display='block'" class="bouton"><span>Ajouter un commentaire</span></button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <div id="AddComm" class="modal">
        <form class="modal-content animate" method="POST">
        <span onclick="document.getElementById('AddComm').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
        <div class="container">
          <h3 class="titre">Commentaire</h3>
          <p><textarea name="commentaire" rows="6" cols="40"></textarea></p>
          <p><button type="submit" class="bouton" name="ValiderEnvoi">Envoyer</button></p>
        </div>
      </form>
    </div>

  </body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
