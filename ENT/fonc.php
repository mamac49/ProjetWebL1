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

function Affichage() {
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
  mysqli_stmt_bind_param($stmt, "s", $_SESSION['Mail']);
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
  $sql = "SELECT COUNT(*) FROM `users`";
  if ($result = mysqli_query($link, $sql)) {
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $data['total'];
  }
}

function nom($x) {
  $link = dbConnect();
  $sql = "SELECT * FROM `users` WHERE `iduser` = '$x';";
  if ($result = mysqli_query($link, $sql)) {
      $row = mysqli_fetch_array($result);
      $contact = $row['prenom'] . " " . $row['nom'];
      mysqli_free_result($result);
      return $contact;
  }
}

function idusers($x) {
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
