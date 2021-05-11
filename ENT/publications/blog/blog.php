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

function Delete($x) {
  $link = dbConnect();
  $sql = "DELETE FROM `Publications` WHERE `idpublications`='$x'";
  if (mysqli_query($link, $sql)) {
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `Publications`");
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
    <link rel="stylesheet" href="styleB.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>

          <div class="Center">
            <h2 class="texte">Liste des sujets</h2>
            <ul class="liste_sujets">
              <li class="espaces"><hr></li>
              <?php
              foreach (nbPub() as $i){
                if (nature($i[0]) == "1"){
                  if (textevide($i[0])!=="" OR $_SESSION["Admin"] == true){
                  $titre=titre($i[0]);
                  $auteur=auteur($i[0]);
                  $date=jour($i[0]);
              ?>
              <li class="sujets"><a href="AffichageB.php?id=<?php print $i[0]?>"><i class="fas fa-robot icone"></i> <?php echo $titre; ?>
              </a> <span class="texte">Créé par <?php echo $auteur; ?> le <?php echo $date; ?></span></li>
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
            <form>
              <button type="button" class="bouton" onclick="window.location.href = 'creationB.php';" name="CreationBlog"><span>Créer un blog</span></button>
              <select name="BlogD">
                <?php
              foreach (nbPub() as $x){
                  if (nature($x[0]) == "1") {
                ?>
                  <option class="texte" value="<?php echo $x[0] ?>"><?php echo titre($x[0]); ?></option>
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
