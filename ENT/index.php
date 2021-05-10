<!--On vérifie si l'utilisateur est connecté, sinon on le redirige vers la page de connexion (voir à la fin)-->

<?php
session_start();

include 'fonc.php';

function Annivs() {
  $link = dbConnect();

  $moisactu = date("m");
  $anniv = "SELECT * FROM `users` WHERE `date_n` LIKE '%$moisactu%'";
  $IDUser = array();
  if ($result = mysqli_query($link, $sql);) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDUser[] = $row;
    }
  }
  return $IDUser;
}

if ($_SESSION["Connected"] == "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <!--on charge:
        * un fichier de style pour le syle principal de la page
        * un fichier de couleur pour le thème choisi par l'utilisateur (à modifier pour que ça se charge en fonction des paramètres de l'utilisateur)
        * le logo de l'école
        * des icones utilisées dans les différentes page de l'ENT
        * le fichier js-->
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <!--include car code récurrent dans toutes les pages-->
    <?php
      include 'base.php';
    ?>

    <div class="Centre_main">
      <div class="ligne">
        <!--affiche les anniversaires du mois actuel-->
        <div class="Anniversaire">
          <h4 class="texteB"><i class="fas fa-birthday-cake icone"></i>Anniversaires<i class="fas fa-birthday-cake icone"></i></h4>
          <ul>
            <?php foreach (Annivs() as $i) { ?>
              <li class="texteB"><?php echo Annivs()[$i]; ?></li>
            <?php } ?>
          </ul>
        </div>
        <!--permet d'avoir le moteur de recherche qwant junior sur la page-->
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
      <!--liens vers le cahier multimédia et le blog (à voir si l'on rajoute un aperçu sur la page d'accueil)-->
      <div class="ligne">
          <div class="raccourciM">
            <a href="/Projetwebl1/ENT/publications/cmultimedia/cmedia.php" class="shortcut"><i class="fas fa-book racicone"></i><br><p>Cahiers Multimédia</p></a>
          </div>
          <div class="raccourciB">
            <a href="/Projetwebl1/ENT/publications/blog/blog.php" class="shortcut"><i class="fas fa-book-open racicone"></i><br><p>Blogs</p></a>
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
