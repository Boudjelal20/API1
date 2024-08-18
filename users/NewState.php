<?php
error_reporting(0);
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $stat = $_POST['stat'];
    
    $sql = "UPDATE user SET stat='$stat' WHERE id=$id ";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Statut mis à jour avec succès"));
    } else {
        echo json_encode(array("message" => "Erreur lors de la mise à jour du statut: " . $conn->error));
    }
} else {
    echo json_encode(array("message" => "Méthode non autorisée"));
}

$conn->close();
