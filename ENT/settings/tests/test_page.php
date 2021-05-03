<?php
      include '../../fonc.php';
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TEST</title>
  </head>
    <body>
	
		<?php 
		$link = dbConnect();
		$sql = "SELECT * FROM `users` WHERE `iduser` = '$x';";
		if ($result = mysqli_query($link, $sql)) {
			$row = mysqli_fetch_array($result);
			$iduser = strval($row['iduser']);
			mysqli_free_result($result);
			return $iduser;
		?>
	</body>
</body>
</html>

