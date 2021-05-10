<?php

$id = $_GET['id'];

function SuppressionDevoir($id) {
  $link = dbConnect();

  $sql = "DELETE FROM `cahiertxt` WHERE `idtxt`='$id' ";
  if (mysqli_query($link, $sql)) {
    echo "succès";
    mysqli_query($link, "FLUSH `users`");
    header("Location: cahier.php");
  } else {
    echo mysqli_error($link);
    header("Location: cahier.php");
  }
}
?>
