<?php

// Création d'une liste permettant de définir une icone par matière
$matiere = array();
$matiere["Maths"] = "fas fa-square-root-alt";
$matiere["Francais"] = "fas fa-book";
$matiere["Sciences"] = "fas fa-flask";
$matiere["Espace"] = "fas fa-map";
$matiere["Temps"] = "fas fa-clock";
$matiere["Musique"] = "fas fa-music";
$matiere["Arts"] = "fas fa-palette";
$matiere["Anglais"] = "fas fa-cloud-rain";
$matiere["EPS"] = "fas fa-biking";
$matiere["Contes"] = "fas fa-dragon";
$matiere["Rituels"] = "fas fa-chalkboard-teacher";
$matiere["Education civique"] = "fas fa-school";

// Créatiion d'une liste contenant uniquement les matières
$ListMatiere = array("Maths", "Francais", "Sciences", "Espace", "Temps", "Musique", "Arts", "Anglais", "EPS", "Contes", "Rituels", "Education civique");

function dbConnect() {
    // On se connecte à la BD ENT en utilisant le nom d'utilisateur et le mot de passe
    $link = new mysqli('localhost', 'matteo', 'Jelly49400.', 'ENT');

    // Si il y a une erreur lors de la connexion
    if (mysqli_connect_errno()) {
            # Afficher l'erreur et stopper le programme
            echo 'Erreur d accès à la base' . mysqli_connect_error();
            exit;
    }
    # Retourner la variable link
    return $link;
}

// Cette fonction permet d'afficher l'image de profil en fonction du mail, elle est utilisée dans les paramètres et l'annuaire.
function Affichage($mail) {
  # On se connecte à la BD
  $link = dbConnect();

  # On définit la requète
  $sql = "SELECT * FROM `users` WHERE `mail`= (?)";
  # On la prépare
  $stmt = mysqli_prepare($link, $sql);
  # Si la requète ne s'est pas faite
  if ( !$stmt ){
      # On affiche l'erreur et on se déconnecte
      echo 'Erreur d accès à la base de données - FIN';
      mysqli_close($link);
  }
  # Sinon on définit le paramèetre le requète
  mysqli_stmt_bind_param($stmt, "s", $mail);
  # On exécute le requête
  if (mysqli_stmt_execute($stmt)) {
    # On récupère le résultat
    $result = mysqli_stmt_get_result($stmt);
    # On le met dans un array pour le réutiliser plus tard
    $row = mysqli_fetch_array($result);
    # Vider le cache du résultat de la requête
    mysqli_free_result($result);
  } else {
    echo mysqli_connect_error();
  }
  # Renvoyer l'image
  return $row['data'];
}

function nombre() {
  // Cette fonction renvoie une liste avec tous les ID des users
  $link = dbConnect();
  $sql = "SELECT `iduser` FROM `users`";
  $result = mysqli_query($link, $sql);
  $IDUser = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDUser[] = $row;
    }
  }
  return $IDUser;
}

function nombreTxt($table) {
  // Cette fonction renvoie une liste contenant les ID de tous les textes/images/liens en fonction du paramètres
  $link = dbConnect();
  $sql = "SELECT * FROM `$table`";
  $result = mysqli_query($link, $sql);
  $IDdata = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDdata[$row["0"]] = $row["1"];
    }
  } else {echo mysqli_error($link);}
  return $IDdata;
}

function info($x) {
  // Cette fonction permet de récupérer les données de l'utilisatuer d'ID $x.
  $link = dbConnect();
  $sql = "SELECT * FROM `users` WHERE `iduser` = '$x';";
  if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      mysqli_free_result($result);
      return $row;
  }
}

function securisation ($donnee){ // pour protéger les champs après un formulaire
  if (is_string($donnee)) {
    $donnee = str_replace('"', " ", $donnee);
    $donnee = str_replace("'", " ", $donnee);
    $donnee = str_replace("`", " ", $donnee);
     echo "<script>console.log('suppression des caractères spéciaux')</script>";
  }
  $donnee = htmlspecialchars($donnee);
  $donnee = trim($donnee);
  $donnee = stripslashes($donnee);
  $donnee = strip_tags($donnee);
  return $donnee;
}

function nbPub() {
  // Cette fonction renvoie la liste des ids de publications, elle est utilisée pour faire la liste des blogs et des cahiermultimédias
  $link = dbConnect();
  $sql = "SELECT `idpublications` FROM `Publications`";
  $result = mysqli_query($link, $sql);
  $IDpubli = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDpubli[] = $row;
    }
  }
  return $IDpubli;
}

function nbCom() {
  // Cette fonction renvoie la liste des ids de commentaires, elle est utilisée lors de l'affichage du blog
  $link = dbConnect();
  $sql = "SELECT `idcom` FROM `Commentaires`";
  $result = mysqli_query($link, $sql);
  $IDcommen = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDcommen[] = $row;
    }
  }
  return $IDcommen;
}

function nature($x) {
  // Cette fonction renvoie la nature d'une publication en fonction de son ID
  $link = dbConnect();
  $sql = "SELECT * FROM `Publications` WHERE `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row;
  }
}

?>
