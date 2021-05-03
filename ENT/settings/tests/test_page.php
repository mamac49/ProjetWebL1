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
	<ul class="contact_list">
		<?php
		$nb = nombre();
		//for ($x=0; $x<=$nb; $x++) {
			$x = 1;
			$contact_name = nom($x);
			$contact_id = "contact" + iduser($x);
		?>
		<li class="contact">
			<a class=<?php $contact_id;?> id="contact"><i class="fas fa-user-tie icone"></i><?php $contact_name;?></a>
		</li>
		<li>
			<hr class="hrcontact">
		</li>
		<?php
			//}
		?>
	</body>
</body>
</html>

