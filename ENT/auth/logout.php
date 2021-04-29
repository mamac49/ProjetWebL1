<?php
session_start();

$_SESSION["Connected"] = false;

echo $_SESSION["Connected"];
echo "a";


//header('Location: auth.php');
//exit();

?>