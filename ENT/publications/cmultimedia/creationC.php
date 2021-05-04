<?php
session_start();

if (empty($y)) {
  $y=1;
}

include ("../../fonc.php");

if (isset($_POST['Case'])) {
  $y += 1;
}

if (isset($_POST['Valider'])) {
  $texte = array();
  $len = count($_POST);
  for ($i = 1 ; $x < $len ; $i++) {
    $texte[$i] = $_POST[$i];
  }
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
    $x = 0;
    while ($x <= $y) {
    ?>
      <textarea name="<?php "text-".$n ?>" rows="8" cols="80" resize="none" required></textarea>
      <p class="texte"><?php echo $x . " " . $y; ?></p>
      <!--<input type="file" name="<?php "img-".$n ?>"> -->
    <?php
    $x += 1;
    }
    ?>
    <input type="submit" name="Valider" class="bouton" value="Valider de cahier multimédia">
  </form>
  <form action="CreationC.php" method="post">
    <input type="button" name="Case" class="bouton" value="Ajouter une case de texte">
  </form>

</div>


<?php
}
?>
