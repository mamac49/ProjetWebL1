<?php
session_start();

if ($_SESSION["Connected"] = true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cahier Multimédia</title>
    <link rel="stylesheet" href="styleC.css">
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
            <h2 class="texte">Listes des cahiers</h2>
            <div class="leaf">
              <ul class="liste">
                <li class="texte"><a class="Copybook" href="media/Cahier1.html"><i class="fas fa-book IcoBook"></i> Cahier n°1</a></li>
                <li class="texte"><a class="Copybook" href="media/Cahier2.html"><i class="fas fa-book Icobook"></i> Cahier n°2</a></li>
                <li class="texte"><a class="Copybook" href="media/Cahier3.html"><i class="fas fa-book Icobook"></i> Cahier n°3</a></li>
                <li class="texte"><a class="Copybook" href="media/Cahier4.html"><i class="fas fa-book Icobook"></i> Cahier n°4</a></li>
              </ul>
              <?php
                if ($_SESSION["Admin"] == true) {
              ?>
              <input type="button" class="Creation" name="CreationC" value="Créer un Cahier Multimédia">
              <?php
                }
              ?>
            </div>
    </div>
  </div>
  </div>
</body>
</html>

<?php
}
?>