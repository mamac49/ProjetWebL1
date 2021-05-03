<?php
session_start();

if ($_SESSION["Connected"] == true) {

  include ("../../fonc.php");
  function nombreblog() {
    $link = dbConnect();
    $sql = "SELECT `idpublications` FROM `Publications`";
    if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      if gettype($row)==array{
        $nb = count($row);
      }
      else{
        $nb=0
      }
      mysqli_free_result($result);
      return $nb;
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
              <?php
              $serveur = dbConnect();
              $req=nombreblog();
              echo $req;
              for ($i=0;$i<$req;$i++){
                echo idpublications;
              ?>
              <li class="espaces"><hr></li>
              <li class="sujets"><a href="media/blog1.html"><i class="fas fa-robot icone"></i>
                <?php
                echo "bla";
                ?>
                </a> <span>Edité par
                  <?php
                  echo "blou";
                  ?>
                  le
                  <?php
                  echo "bli";
                  ?>
                  </span></li>
              <?php
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
