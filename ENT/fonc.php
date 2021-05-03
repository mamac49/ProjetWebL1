<?php
session_start();

function dbConnect() {
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

    if (mysqli_connect_errno()) {
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    return $link;
}

function Affichage() {
  $link = dbConnect();

  $sql = "SELECT * FROM `users` WHERE `mail`= (?)";
  $stmt = mysqli_prepare($link, $sql);
  if ( !$stmt ){
      echo 'Erreur d accès à la base de données - FIN';
      mysqli_close($link);
  }
  mysqli_stmt_bind_param($stmt, "s", $_SESSION['Mail']);
  if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
  } else {
    echo mysqli_connect_error();
  }
  return $row['data'];
}

?>
