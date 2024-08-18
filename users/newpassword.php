<?php
error_reporting(0);
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $new_values = array();

    if(isset($_POST['id'])) {
        $new_password = $_POST['new_password'];
        $new_values[] = "user_password='$new_password'";
    }

    if (!empty($new_values)) {
        $update_query = "UPDATE user SET " . implode(", ", $new_values) . " WHERE id = $id";

        if (mysqli_query($conn, $update_query)) {
            echo "Mot de passe mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe : " . mysqli_error($conn);
        }
    } else {
        echo "Aucun nouveau mot de passe fourni.";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
