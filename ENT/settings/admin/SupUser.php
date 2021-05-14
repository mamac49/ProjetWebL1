<?php
session_start();

include '../../fonc.php';

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `users` WHERE `iduser`='$Contact'";
  if (mysqli_query($link, $sql)) {
    echo "<script>console.log('succes')</script>";
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `users`");
}

if ($_SESSION["Admin"] == True) {

Delete($_GET['id']);
}
?>
