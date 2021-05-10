<?php
session_start();

include '../../fonc.php';


function AjoutDevoir($classe, $matiere, $consigne, $jour) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `cahiertxt`");

  $sql = "INSERT INTO `cahiertxt`(`jour`, `matiere`, `consigne`, `classe`) VALUES ('$jour', '$matiere', '$consigne', '$classe')";
  if (mysqli_query($link, $sql)) {
    unset($_SESSION['devoirs']);
    header("Location: cahier.php");
    mysqli_close($link);
  } else {
    echo mysqli_error($link);
    mysqli_close($link);
  }
}

$classe = $_SESSION['devoirs'][0]
$matiereA = $_SESSION['devoirs'][1]
$consigne = $_SESSION['devoirs'][2]
$jour = $_SESSION['devoirs'][3]

AjoutDevoir($classe, $matiereA, $consigne, $jour);

?>
