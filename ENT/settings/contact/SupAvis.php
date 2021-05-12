<?php
session_start();

include '../../fonc.php';

if ($_SESSION["Admin"] == True) {



function SuppressionDevoir($id) {
  $link = dbConnect();

  $sql = "DELETE FROM `avis` WHERE `IDavis`='$id' ";
  if (mysqli_query($link, $sql)) {
    echo "<script>console.log('succes')</script>";
    mysqli_query($link, "FLUSH `avis`");
    header("Location: contact.php");
  } else {
    echo mysqli_error($link);
    header("Location: contact.php");
  }
}

SuppressionDevoir($_GET['id']);

}
?>
