<?php
session_start();

if ($_SESSION["Connected"] == true) {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="styleA.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/color1.css">
    <link rel="stylesheet" href="/Projetwebl1/ENT/css/style.css">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/Projetwebl1/ENT/js/main.js"></script>
    <script src="menu_clic.js"></script>
  </head>
    <?php
      include ("../../base.php");
    ?>
  <body onload="move_menu_burger(); detect_click();">

    <div class="site_container">
      
      <script src="menu_clic.js"></script>
        <div class="contenu">
          <div class="site">
            <div class="Center">
              <!-- les contacts seront listé avec en premier le professeur
                et ensuite les élèves de la classe dans l'ordre alphabétique des noms/-->
              <h2 class="texte">Listes des contacts</h2>
              <ul class="contact_list">
                <li class="contact">
                  <a class="contact_link" id="contact0"><i class="fas fa-user-tie icone"></i>M. Langlois</a>
                </li>
                <li>
                  <hr class="hrcontact">
                </li>
                <li class="contact">
                  <a class="contact_link" id="contact1"><i class="fas fa-laugh-beam icone"></i>Romain</a>
                </li>
                <li>
                  <hr class="hrcontact">
                </li>
                <li class="contact">
                  <a class="contact_link" id="contact2"><i class="fas fa-laugh-beam icone"></i>Marie</a>
                </li>
                <li>
                  <hr class="hrcontact">
                </li>
              </ul>
            </div>
          </div>
      </div>

      <!-- menu clic droit/-->

      <div id="context_menu" class="context_menu" >
      <ul class="context_menu_list">
        <li class="context_menu_element" id="show_profile">
          <p class="context_menu_button"><i class="fa fa-address-card" id="context_menu_icons"></i>Profil</p>
        </li>
        <li>
          <hr class="context_menu_hr">
        </li>
        <li class="context_menu_element" id="copy_phone">
          <p class="context_menu_button"><i class="fa fa-copy" id="context_menu_icons"></i>Copier le numéro de téléphone</p>
        </li>
        <li>
          <hr class="context_menu_hr">
        </li>
        <li class="context_menu_element" id="copy_mail">
          <p class="context_menu_button"><i class="fa fa-envelope-open" id="context_menu_icons"></i>Copier le mail</p>
        </li>
      </ul>
      </div>
    </div>
    
    


  </div>
</body>
</html>

<?php
} else {
  header('Location: https://mlanglois.freeboxos.fr//Projetwebl1/ENT/auth/auth.php');
}
?>
