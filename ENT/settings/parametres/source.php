<?php
session_start();

echo "connexion réussi";

function dbConnect() {
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');
  
    if (mysqli_connect_errno()) {
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    return $link;
  }


$link = dbConnect();

$sql = "SELECT * FROM `PP` WHERE `idpic`= (?)";
$stmt = mysqli_prepare($link, $sql);
if ( !$stmt ){
    echo 'Erreur d accès à la base de données - FIN';    
    mysqli_close($link);    
}
mysqli_stmt_bind_param($stmt, 1, $_GET['id']);
if ($stmt = mysqli_stmt_execute()) {
  $row = mysqli_fetch_array($stmt);
} else {
  echo mysqli_connect_error();
}




header("Content-type: image/png");
print $row['data'];
exit;

?>