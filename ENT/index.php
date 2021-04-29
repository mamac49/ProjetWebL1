<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
  <body onload="move_menu_burger(); ">

  <div class="site_container">

    <?php
      include 'base.php'
    ?>

      <div class="contenu">
        <div class="site">
          <div class="Centre_main">
            <div class="Anniversaire">
              <h4><i class="fas fa-birthday-cake icone"></i>Anniversaires<i class="fas fa-birthday-cake icone"></i></h4>
              <ul>
                <li>Prénom, nom, Date</li>
                <li>Afficher tous ceux du mois actuel</li>
              </ul>
            </div>
            <div class="">

            </div>
          </div>

          <footer>
            <ul>
              <li><a href="/Projetwebl1/ENT/settings/contact/contact_bugreport.html" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a></li>
              <li><a href="/Projetwebl1/ENT/settings/credits.html" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a></li>
            </ul>
          </footer>
        </div>
    </div>
  </div>
  </div>
</body>
</html>
<?php
}

?>