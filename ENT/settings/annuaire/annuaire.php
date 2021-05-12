<?php
session_start();

include '../../fonc.php';

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="annuaire.js"></script>
    <script src="/Projetwebl1/ENT/js/scroll.js"></script>
  </head>

    <?php
      include ("../../base.php");
      echo '<link rel="stylesheet" href="styleA.css">';
    ?>


  <body onload="move_menu_sandwich(); detect_click();">

    <div class="site_container">
      <script src="annuaire.js"></script>
          <div class="Center_adap">
            <!-- les contacts seront listé avec en premier le professeur
              et ensuite les élèves de la classe dans l'ordre alphabétique des noms/-->
            <h2 class="titre_liste texte">Liste des contacts</h2>
            <ul class="contact_list">
            <?php
              foreach (nombre() as $x) {
                $contact_name = info($x[0])['prenom'] . " " . info($x[0])['nom'];
                $contact_id = "contact_" . $x[0];
                $mail = info($x[0])["mail"];
            ?>
              <li class="contact">
                <div class="debut"><a class="<?php echo $contact_id;?> texte" id="contact"><span><img src="<?php echo ' data:image/png;base64,' . base64_encode(Affichage($mail)) . ' '?>" alt="Photo de profil" class="PPannuaire"><?php echo $contact_name;?></span></a></div>
                <div class="fin">
                  <div class="dropdown"><button onclick="down(<?php print $x[0];?>)" class="dropbtn">Information</button></div>
                  <div id="myDropdown-<?php echo $x[0];?>" class="dropdown-content">
                    <button class="btn-info" onclick="copy(<?php print 'Mail-' . $x[0];?>)"><i class="fa fa-home"></i><p id="ToCopyMail-<?php echo $x[0];?>"><?php echo $mail; ?></p></button>
                    <button class="btn-info" onclick="copy(<?php print 'Contact-' . $x[0];?>)"><i class="fa fa-home"></i><p id="ToCopyContact-<?php echo $x[0];?>"><?php echo $contact_name; ?></p></button>
                  </div>

                </div>
              </li>
              <li><hr class="hrcontact"></li>
            <?php
                }
            ?>
            </ul>
      </div>
    </div>
  </body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
