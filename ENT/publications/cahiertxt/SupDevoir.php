<?php
session_start();

include '../../fonc.php';

if ($_SESSION["Admin"] == True) {

$id = $_GET['id'];

function SuppressionDevoir($id) {
  $link = dbConnect();

  $sql = "DELETE FROM `cahiertxt` WHERE `idtxt`='$id' ";
  if (mysqli_query($link, $sql)) {
    echo "<script>console.log('succes')</script>";
    mysqli_query($link, "FLUSH `users`");
    header("Location: cahier.php");
  } else {
    echo mysqli_error($link);
    header("Location: cahier.php");
  }
}

SuppressionDevoir($id);

}
?>
