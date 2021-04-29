<?php
session_start();

$_SESSION['Connected'] = false;

var_dump($_SESSION['Connected']);


header('Location: auth.php');
exit();

?>