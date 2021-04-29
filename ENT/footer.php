<?php
session_start();

if ($_SESSION["Connected"] = "True") {
?>

<footer>
    <ul>
        <li><a href="/Projetwebl1/ENT/settings/contact/contact.php" class="link_footer"><i class="fas fa-bug icone"></i>Signaler un problème/Contact</a></li>
        <li><a href="/Projetwebl1/ENT/settings/credits.php" class="link_footer"><i class="fab fa-linux icone"></i>A propos</a></li>
    </ul>
</footer>

<?php
}
?>