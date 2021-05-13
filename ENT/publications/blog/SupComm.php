<?php
session_start();

include '../../fonc.php';

$id = $_GET['id'];

function SuppressionCom($id) {
  $link = dbConnect();
  $sql2 = "SELECT `idpublications` FROM `Publications` WHERE `idpublications`=(SELECT `idpublications` FROM `Commentaires` WHERE `idcom`=$id)";
  if ($result = mysqli_query($link, $sql2)) {
    $row = mysqli_fetch_array($result);
    $IDPubli = $row[0];
  }

  $sql = "DELETE FROM `Commentaires` WHERE `idcom`='$id' ";
  if (mysqli_query($link, $sql)) {
    echo "<script>console.log('succes')</script>";
    mysqli_query($link, "FLUSH `users`");
    header("Location: AffichageB.php?id=". $IDPubli);
  } else {
    echo mysqli_error($link);
    header("Location: AffichageB.php?id=". $IDPubli);
  }
}

SuppressionCom($id);

?>
