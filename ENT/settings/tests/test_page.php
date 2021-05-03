
<?php
function dbConnect() {
    // On se connecte à la BD ENT en utilisant le nom d'utilisateur et le mot de passe
    $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

    // Si il y a une erreur lors de la connexion
    if (mysqli_connect_errno()) {
            # Afficher l'erreur et stopper le programme
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    # Retourner la variable link
    return $link;
}
	function test() {
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
	}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TEST</title>
  </head>
    <body>
	
	<p>
		<?php echo "test";?>
	</p>
	</body>
</html>