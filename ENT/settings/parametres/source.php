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


$link = dbConnect();

$sql = "SELECT * FROM `PP` WHERE `idpic`= ?";
$stmt = mysqli_prepare($sql);
mysqli_stmt_bind_param($stmt, 1, $_GET['id']);
$stmt = mysli_stmt_execute();

$row = mysqli_fetch_array($stmt);

header("Content-type: image/png");
print $row['data'];
exit;

?>