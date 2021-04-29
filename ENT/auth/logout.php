<?php
session_start();

$_SESSION["Connected"] = false;

header('Location: auth.php');
exit();

?>