<?php
session_start();

$n = 1;
$y = 1;

include ("../../fonc.php");

if (isset($_POST['Case'])) {
  $y++;
}

if ($_SESSION["Connected"] == true) {
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cahier multimédia</title>
    <link rel="stylesheet" href="styleB.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
  </head>
<?php
include ("../../base.php");
?>

<div class="Center">
  <form class="" action="creationC.php" method="post" enctype="multipart/form-data">
    <?php
    for ($x=1 ; $x<=$n ; $x = $x + $y) {
    ?>
      <textarea name="<?php "text-".$n ?>" rows="8" cols="80" resize="none" required></textarea>
      <input type="file" name="<?php "img-".$n ?>">
    <?php
    }
    ?>
    <input type="submit" name="Valider" value="Valider de cahier multimédia">
  </form>
  <form action="CreationC.php" method="post">
    <input type="button" name="Case" value="Ajouter une case de texte">
  </form>

</div>


<?php
}
?>
