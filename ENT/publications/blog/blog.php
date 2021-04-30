<?php
session_start();

if ($_SESSION["Connected"] = true) {
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


        <div class="contenu">
          <div class="Centre">
            <h2 class="texte">Listes des sujets</h2>
            <ul class="liste_sujets">
              <li class="sujets"><a href="media/blog1.html"><i class="fas fa-robot icone"></i> Sujet n°1</a> <span>Edité par M. Langlois le 07/03/2021</span></li>
              <li class="espaces"><hr></li>
              <li class="sujets"><a href="media/blog2.html"><i class="fas fa-paint-brush icone"></i> Sujet n°2</a> <span>Edité par M. Langlois le 08/03/2021</span></li>
              <li class="espaces"><hr></li>
              <li class="sujets"><a href="media/blog3.html"><i class="fas fa-chess icone"></i> Sujet n°3</a> <span>Edité par M. Langlois le 09/03/2021</span></li>
            </ul>
            <br/>
            <?php
              if ($_SESSION["Admin"] == true) {
            ?>
              <input type="button" name="CreationBlog" value="Créer Un Blog">
              <br/>
            <?php
            }
            ?>
          </div>

        </div>


        <script src="../../burger.js"></script>
        <div class="site-cache" id="site-cache"></div>
        <footer>
          <ul>
            <li><a href="/Projetwebl1/ENT/settings/contact/contact_bugreport.html" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a></li>
            <li><a href="/Projetwebl1/ENT/settings/credits.html" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a></li>
          </ul>
        </footer>
        </div>
      </div>
  </body>
</html>

<?php
}
?>
