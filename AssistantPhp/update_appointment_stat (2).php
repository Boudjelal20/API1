<?php
include('../connection.php');

// Récupérer les données envoyées depuis Flutter
$doctorId = mysqli_real_escape_string($conn, $_POST['doctor_id']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$v = false;

// Requête SQL pour vérifier si un rendez-vous avec statut 'C' existe
$sql = "SELECT COUNT(*) AS count FROM appointment WHERE doctor_id = ? AND date = ? AND stat = 'C'";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Binder les valeurs aux paramètres de la requête
    mysqli_stmt_bind_param($stmt, "ss", $doctorId, $date);
    
    // Exécuter la requête préparée
    mysqli_stmt_execute($stmt);
    
    // Lire le résultat
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);

    // Mettre à jour la valeur de v en fonction du résultat COUNT(*)
    if ($count > 0) {
        $v = true;
    }

    // Fermer le statement
    mysqli_stmt_close($stmt);

    // Retourner la valeur de v
    echo json_encode(array('hasConsultation' => $v));
} else {
    // Erreur de préparation de la requête
    echo json_encode(array('hasConsultation' => false, 'message' => 'Error preparing SQL statement'));
}

// Fermer la connexion
mysqli_close($conn);
?>
