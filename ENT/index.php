<?php
session_start();

if ($_SESSION["Connected"] == "True") {
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

    <?php
      include 'base.php';
    ?>
        
        <div class="Centre_main">
          <div class="ligne">
            <div class="Anniversaire">
              <h4><i class="fas fa-birthday-cake icone"></i>Anniversaires<i class="fas fa-birthday-cake icone"></i></h4>
              <ul>
                <li>Prénom, nom, Date</li>
                <li>Afficher tous ceux du mois actuel</li>
              </ul>
            </div>

            <div class="qwant">
              <form action="https://www.qwantjunior.com/" method="GET" target="_blank">
                <a href="https://www.qwantjunior.com/" target="_blank">
                  <img src="https://ent.e-primo.fr/assets/widgets/qwant-junior/logo.svg" alt="Qwant Junior">
                </a>
                <input type="texte" name="q" size="31" maxlength="255" placeholder="Rechercher">
                <button><i class="fas fa-search"></i></button>
              </form>
            </div>
          </div>
          <div class="ligne">
              <div class="raccourciM">
                <a href="/Projetwebl1/ENT/publications/cmultimedia/cmedia.php" class="shortcut"><i class="fas fa-book racicone"></i><br><p>Cahiers Multimédia</p></a>
              </div>
              <div class="raccourciB">
                <a href="/Projetwebl1/ENT/publications/blog/blog.php" class="shortcut"><i class="fas fa-book-open racicone"></i><br><p>Blogs</p></a>
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
