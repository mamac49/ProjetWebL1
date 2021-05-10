<?php
session_start();

function Delete($Contact) {
  $link = dbConnect();
  $sql = "DELETE FROM `users` WHERE `iduser`='$Contact'";
  if (mysqli_query($link, $sql)) {
    echo "succès";
  } else {
    echo mysqli_error($link);
  }
  mysqli_query($link, "FLUSH `users`");
}

if ($_SESSION["Admin"] == True) {

Delete($_GET['id']);
}
?>
