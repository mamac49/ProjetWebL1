<?php

function dbConnect() {
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');
  
    if (mysqli_connect_errno()) {
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    return $link;
  }


$link = dbConnect();
    
$sql = "SELECT * FROM `users` WHERE `mail`= ?";
$stmt = mysqli_prepare($link, $sql);
$stmt = mysqli_stmt_bind_param($stmt, 1, $_GET["id"]);
$stmt = mysli_execute();

$row = mysqli_fetch_assoc($stmt);

$ext = $row['extPP'];

mysqli_close($link);

header("Content-type: image/". $ext);
print $row['PP'];
exit;

?>