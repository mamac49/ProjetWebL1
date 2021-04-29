<?php
session_start();

$_SESSION["Connected"] = "False";

header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/auth/auth.php');
exit();

?>