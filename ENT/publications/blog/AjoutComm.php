<?php
session_start();

include '../../fonc.php';


function AjoutComm($message, $IDPubli) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `Commentaires`");
  $date = date("Y-m-d");
  $heure= date("H:i");
  $ID = $_SESSION['ID']

  $sql = "INSERT INTO `Commentaires`(`message`, `date_ecriture`, `heure_ecriture`, `iduser`, `idpublications`) VALUES ('$message', '$date', '$heure', '$ID', '$IDPubli')";
  if (mysqli_query($link, $sql)) {
    unset($_SESSION['commentaires']);
    header("Location: AffichageB.php");
    mysqli_close($link);
  } else {
    echo mysqli_error($link);
    mysqli_close($link);
  }
}

$message = $_SESSION['commentaires'][0];
$IDpubli = $_SESSION['commentaires'][1];

AjoutComm($message, $IDpubli);

?>
