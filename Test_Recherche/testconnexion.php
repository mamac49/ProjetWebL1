<?php
function dbConnect() {
        $link = new mysqli('localhost', 'ENT', 'uWBs4M9kIX4PVa2o', 'ENT');

        if (mysqli_connect_errno()) {
                echo 'Erreur d accès à la base' . mysqli_connect_error();
                exit;
        }
        echo 'accès réussi'."\n";
        return $link;
}

$link = dbConnect();

$sql = "SELECT * FROM users";

if ($result = mysqli_query($link, $sql)) {
        //echo mysqli_num_rows($result);
        while ( $row = mysqli_fetch_assoc($result)) {
                echo $row['prenom'] . "\n" . $row['nom'], '<br>';
        }

        mysqli_free_result($result);
}

mysqli_close($link);


?>