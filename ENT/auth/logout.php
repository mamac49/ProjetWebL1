<?php
session_start();

$_SESSION["Connected"] = "False";

header('Location: auth.php');
exit();

?>