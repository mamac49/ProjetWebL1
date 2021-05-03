<?php
      include '../../fonc.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo "test";?></title>
  </head>
    <body>
	<?php
		$x = 1;
		$link = dbConnect();
		$sql = "SELECT * FROM `users` WHERE `iduser` = '$x';";
		$iduser = 0;
		if ($result = mysqli_query($link, $sql)) {
			$row = mysqli_fetch_array($result);
			$iduser = strval($row['iduser']);
			mysqli_free_result($result);
			return $iduser;
		}
	?>
	<h1>
		<?php echo "test";?>
	</h1>
	</body>
</body>
</html>