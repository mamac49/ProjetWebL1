<?php

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

Delete($_GET['id']);

?>
