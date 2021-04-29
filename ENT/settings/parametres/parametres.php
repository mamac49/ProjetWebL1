<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
<body onload="move_menu_burger(); ">

  <div class="site_container">
  <?php
      include 'base.php'
    ?>
    <a href="../index.html"><i class="fas fa-undo icone retour"></i></a>

    <fieldset class="legal">
      <legend class=legend>Réinitialisation des paramètres</legend>
      <form method="get" name=password>
        <p>
        <h2>Réinitialisation du mot de passe</h2>
        <label>Ancien mot de passe</label>
        <input type="text" name="password" minlengh="8" maxlength="16" required>
        </p>
        <p>
        <label>Nouveau mot de passe</label>
        <input type="text" name="password" minlengh="8" maxlength="16" required>
        </p>
      </form>
        <h2>Changement de l'image de profil</h2>
        <img src="../data/PP.png" alt="Photo de profil" class="PP"><span><p class="pp"></p><i class="fas fa-folder-open"></i> Charger une image à partir de mon ordinateur</span>
    </fieldset>

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