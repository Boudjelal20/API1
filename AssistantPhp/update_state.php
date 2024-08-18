<?php
// Inclure le fichier de connexion à la base de données
include '../connection.php';

// Récupérer les valeurs des paramètres POST
$appointmentId = $_POST['appointment_id'];
$newStat = $_POST['new_stat'];
$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

// Préparer la requête SQL avec une requête préparée
$sqlUpdateById = "UPDATE appointment SET stat = ? WHERE id = ? AND doctor_id = ? AND date = ?";
$stmt = mysqli_prepare($conn, $sqlUpdateById);

if ($stmt) {
    // Lier les paramètres aux marqueurs de position dans la requête préparée
    mysqli_stmt_bind_param($stmt, 'ssss', $newStat, $appointmentId, $doctorId, $date);

    // Exécuter la requête préparée
    mysqli_stmt_execute($stmt);

    // Vérifier le nombre de lignes affectées par la mise à jour
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Succès de la mise à jour
        mysqli_commit($conn); // Valider la transaction
        echo json_encode(array('success' => true));
    } else {
        // Aucune ligne mise à jour
        mysqli_rollback($conn); // Annuler la transaction
        echo json_encode(array('success' => false, 'message' => 'Aucun rendez-vous mis à jour'));
    }

    // Fermer le statement
    mysqli_stmt_close($stmt);
} else {
    // Erreur de préparation de la requête
    echo json_encode(array('success' => false, 'message' => 'Erreur de préparation de la requête'));
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
