<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <?php
      include 'base.php'
    ?>

      <div>
        <form>
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color1.css')" value="light mode">
          <input type="button" onclick="LoadCSS('/Projetwebl1/ENT/css/color2.css')" value="dark mode">
        </form>
      </div>

      <footer>
        <ul>
          <li><a href="/Projetwebl1/ENT/settings/contact/contact_bugreport.html" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a></li>
          <li><a href="/Projetwebl1/ENT/settings/credits.html" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a></li>
        </ul>
      </footer>
      </div>
  </div>
</body>
</html>

<?php
}
?>