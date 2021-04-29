<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ENT Millocheau</title>
    <link rel="stylesheet" href="/ENT/css/styleA.css">
    <link rel="stylesheet" href="/ENT/css/style.css">
    <script src="https://kit.fontawesome.com/f0c5800638.js" crossorigin="anonymous"></script>
    <script src="/ENT/js/main.js"></script>
  </head>
    <?php
      include 'base.php'
    ?>

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

      <footer>
        <ul>
          <li><a href=" ../Contact/contact_bugreport.html"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a></li>
          <li><a href="../credits.html"><i class="fab fa-linux icone"></i>A propos</a></li>
        </ul>
      </footer>
    </div>
    
    


  </div>
</body>
</html>

<?php
}
?>