<?php
include '../connection.php';

$id = $_POST['id'];
$new_job = $_POST['new_job'];
$new_first_name = $_POST['new_first_name'];
$new_family_name = $_POST['new_family_name'];
$new_user_name = $_POST['new_user_name'];
$new_phone_number = $_POST['new_phone_number'];

$sql = "UPDATE user SET job = '$new_job', first_name = '$new_first_name', family_name = '$new_family_name', user_name = '$new_user_name', ";

if ($new_phone_number == "" || $new_phone_number == NULL) {
    $sql .= "phone_number=NULL ";
} else {
    $sql .= "phone_number='$new_phone_number' ";
}
$sql .= "WHERE id = '$id'";

try {
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Utilisateur mis a jour avec succes")); 
    } else {
        echo json_encode(array("message" => "Erreur lors de la mise a jour de l'utilisateur: " . $conn->error));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "Aucune nouvelle valeur à mettre à jour " . $e->getMessage()));
}

$conn->close();
