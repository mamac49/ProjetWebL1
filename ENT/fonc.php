<?php

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

$ListMatiere = array("Maths", "Francais", "Sciences", "Espace", "Temps", "Musique", "Arts", "Anglais", "EPS", "Contes", "Rituels", "Education civique");

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
  $link = dbConnect();
  $sql = "SELECT * FROM `$table`";
  $result = mysqli_query($link, $sql);
  $IDdata = array();
  if ($result) {
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $IDdata[$row["id".$table]] = $row[`data`];
    }
  } else {echo mysqli_error($link);}
  return $IDdata;
}

function info($x) {
  $link = dbConnect();
  $sql = "SELECT * FROM `users` WHERE `iduser` = '$x';";
  if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      mysqli_free_result($result);
      return $row;
  }
}

function securisation ($donnee){ // pour protéger les champs
  $donnee = htmlspecialchars($donnee);
  $donnee = trim($donnee);
  $donnee = stripslashes($donnee);
  $donnee = strip_tags($donnee);
  return $donnee;
}

function nbPub() {
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
  $link = dbConnect();
  $sql = "SELECT * FROM `Publications` WHERE `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row;
  }
}

function titre($x) {
  $link = dbConnect();
  $sql = "SELECT * FROM `Publications` WHERE `idpublications`='$x'";
  if ($result = mysqli_query($link, $sql)) {
    $row = mysqli_fetch_array($result);
    return $row["titre"];
  }
}


function adPublication($idpublication, $titre, $texte, $image, $date, $nature, $iduser) {
  $link = dbConnect();
  mysqli_query($link, "FLUSH `Publications`");

  /*désactivé car auto increment
  $Publications = nombre() + 1;*/

  $sql = "INSERT INTO `Publications` (`idpublication`, `titre`, `texte`, `image`, `date`, `nature`, `iduser`) VALUES ($idpublication, '$titre', '$texte', $image, '$date', $nature, $iduser);";
  /*Peut être utilisable pour image (voir avec mattéo ^^)*/
  if (mysqli_query($link, $sql)) {
    $pp = mysqli_real_escape_string($link, $pp);
    $sql2 = "INSERT INTO `users` (`data`) VALUE ('$pp');";
    if (mysqli_query($link, $sql2)) {
      reset($_POST);
      mysqli_close($link);
      header('Location: https://mlanglois.freeboxos.fr/Projetwebl1/ENT/settings/admin/UserCreation.php');
      exit();
    } else {
      echo mysqli_error($link);
    }
  } else {
    echo mysqli_error($link);
  }
  mysqli_close($link);
}

?>
