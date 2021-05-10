<?php
session_start();

include ("../../fonc.php");

if ($_SESSION["Admin"] == True) {

function AjoutDevoir($classe, $matiere, $consigne, $jour) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `cahiertxt`");

  $sql = "INSERT INTO `cahiertxt`(`jour`, `matiere`, `consigne`, `classe`) VALUES ('$jour', '$matiere', '$consigne', '$classe')";
  if (mysqli_query($link, $sql)) {
    header("Location : cahier.php");
    mysqli_close($link);
  } else {
    echo mysqli_error($link);
    mysqli_close($link);
  }
}

$str = explode(".", $_GET['id']);

AjoutDevoir($str[0], $str[1], $str[2], $str[3]);

}
?>
