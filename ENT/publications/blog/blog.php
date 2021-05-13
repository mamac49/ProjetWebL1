<?php
session_start();

include ("../../fonc.php");

function auteur($x) {
  $link = dbConnect();
  $sql = "SELECT `prenom`, `nom` FROM `users` WHERE iduser=(SELECT `iduser` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x')";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0]." ".$row[1];
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

function textevide($x) {
  $link = dbConnect();
  $sql = "SELECT `texte` FROM `Publications` WHERE `nature`=1 AND `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row[0];
  }
}

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `Commentaires` WHERE `idpublications`='$Contact'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }
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
  $BlogD = $_POST['BlogD'];
  Delete($BlogD);
}

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blogs</title>
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
          <div class="Center_adap">
            <h2 class="texte">Liste des sujets</h2>
            <ul class="liste_sujets">
              <?php
              foreach (nbPub() as $i){
                if (nature($i[0])["nature"] == "1"){
                  if (textevide($i[0])!=="" OR $_SESSION["Admin"] == true){
                  $titre=nature($i[0])["titre"];
                  $auteur=auteur($i[0]);
                  $date=jour($i[0]);
              ?>
              <br/>
              <li class="sujets"><span class="texte"><a href="AffichageB.php?id=<?php print $i[0]?>"><?php echo "<i class='". $matiere[nature($i[0])["matiere"]] ."'></i>"?> <?php echo $titre; ?></span>
              </a> <span class="texte">Créé par <?php echo $auteur; ?> le <?php echo $date; ?></span></li>
              <br/>
              <li class="espaces"><hr></li>
              <?php
                  }
                }
              }
              ?>
            </ul>
            <br/>
            <?php
              if ($_SESSION["Admin"] == true) {
            ?>
            <form class="noclass" action="blog.php" method="post">
              <button type="button" class="bouton" onclick="window.location.href = 'creationB.php';" name="CreationBlog"><span>Créer un blog</span></button>
              <select name="BlogD">
                <?php
              foreach (nbPub() as $x){
                  if (nature($x[0])["nature"] == "1") {
                ?>
                  <option class="texte" value="<?php echo $x[0] ?>"><?php echo nature($x[0])["titre"]; ?></option>
                <?php }} ?>
              </select>
              <button type="submit" class="bouton" name="ValiderSupp"><span>Supprimer</span></button>
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
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
