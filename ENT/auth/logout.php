<?php
session_start();

$_SESSION['Connected'] = false;

echo $_SESSION['Connected'];


//header('Location: auth.php');
//exit();

?>