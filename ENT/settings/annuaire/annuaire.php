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
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/style.css">
    <link rel="stylesheet" media="all and (min-width: 1024px)" href="/Projetwebl1/ENT/css/styleLittle.css">
    <link rel="stylesheet" media="all and (min-width: 480px) and (max-width: 1023px)" href="/Projetwebl1/ENT/css/stylePhone.css">
    <link rel="stylesheet" href="annuaire.css">
    <link rel="icon" type="image/png" href="/Projetwebl1/ENT/data/Taoki.png">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="/Projetwebl1/ENT/js/annuaire.js"></script>
    <script src="/Projetwebl1/ENT/js/scroll.js"></script>
  </head>

    <?php
      include ("../../base.php");
    ?>


  <body onload="move_menu_sandwich(); detect_click();">

    <div class="site_container">
      <div class="Center_adap center_rem">
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
            <div class="infos_basiques">
              <div class="debut line_block_annuaire">
                <a class="<?php echo $contact_id;?> texte" id="contact">
                  <span>
                    <img src="<?php echo ' data:image/png;base64,' . base64_encode(Affichage($mail)) . ' '?>" alt="Photo de profil" class="PPannuaire">
                  </span>
                </a>
              </div>
              <div class="milieu line_block_annuaire">
                <p class="user_name">
                  <?php echo $contact_name;?>
                </p>
              </div>
              <!--<div class="fin">-->
              <div class="line_block_annuaire">
                <button onclick="down(<?php print $x[0];?>)" class="infos_button">Informations</button>
              </div>
            </div>
            <div class="infos_detaillee">
              <div id="infos_block" class="modal">
                <div class="modal-content animate" method="POST">
                  <span onclick="document.getElementById('infos_block').style.display='none'" class="close" title="Close Modal"><i class="fas fa-times"></i></span>
                    <div class="container">
                      <div id="myInfos-<?php echo $x[0];?>" class="contenu_infos_detaillee">
                        <button class="bouton" onclick="copy('<?php print 'Mail-' . $x[0];?>')"><i class="fas fa-envelope"></i><p id="ToCopyMail-<?php echo $x[0];?>"><?php echo $mail; ?></p></button>
                        <button class="bouton" onclick="copy('<?php print 'Contact-' . $x[0];?>')"><i class="fas fa-user-tag"></i><p id="ToCopyContact-<?php echo $x[0];?>"><?php echo $contact_name; ?></p></button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </li>
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