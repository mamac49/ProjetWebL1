<?php
session_start();

include '../../fonc.php';

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="styleF.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/logo_millocheau.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>

          <div class="Center_adap">
            <h4 class="texte files-txt">Archivage des fichiers - Maquette</h4>
            <fieldset class="Dropzone">
              <legend>Dropzone</legend>
              <p class="texte files-txt">Listes de fichiers :</p>
              <ul>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-folder icone file"></i>Nom de dossier 1</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-folder icone file"></i>Nom de dossier 2</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-folder icone file"></i>Nom de dossier 3</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-file-pdf icone file"></i>Nom de fichier.pdf</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-file-code icone file"></i>Nom de fichier.py</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-file-archive icone file"></i>Nom de fichier.tar.gz</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
                <li class="texte fichier"><p style="margin 0px;"><i class="fas fa-file icone file"></i>Nom de fichier.txt</p><i class="fas fa-ellipsis-v icone Ificher"></i></li>
              </ul>
            </fieldset>
          </div>
  </div>
  </div>
</body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
