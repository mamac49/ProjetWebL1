<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="styleF.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>
      <div class="contenu">
        <div class="site">
          <div class="Centre">
            <h4 class="texte">Archivage des fichiers</h4>
            <fieldset class="Dropzone">
              <legend>Dropzone</legend>
              <p class="texte">Listes de fichiers :</p>
              <ul>
                <li class="texte"><p><i class="fas fa-folder icone file"></i>Nom de dossier 1</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-folder icone file"></i>Nom de dossier 2</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-folder icone file"></i>Nom de dossier 3</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-file-pdf icone file"></i>Nom de fichier.pdf</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-file-code icone file"></i>Nom de fichier.py</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-file-archive icone file"></i>Nom de fichier.tar.gz</p><i class="fas fa-ellipsis-v icone"></i></li>
                <li class="texte"><p><i class="fas fa-file icone file"></i>Nom de fichier.txt</p><i class="fas fa-ellipsis-v icone"></i></li>
              </ul>
            </fieldset>
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
</body>
</html>

<?php
}
?>