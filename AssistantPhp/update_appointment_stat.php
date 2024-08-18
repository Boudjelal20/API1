<?php
include('../connection.php');

$appointmentId = $_POST['appointment_id'];
$newStat = $_POST['new_stat'];
$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

mysqli_begin_transaction($conn);

try {
    if ($newStat == 'S') {
        $sql = "UPDATE appointment SET stat = 
                CASE 
                    WHEN stat = 'S' THEN 'C'
                    WHEN stat = 'C' THEN 'P'
                    WHEN stat = 'P' THEN ''
                    ELSE stat
                END
                WHERE doctor_id = '$doctorId' AND date = '$date'";
    } 
    if ($newStat == 'C') {
        $sql = "UPDATE appointment SET stat = 
                CASE 
                    WHEN stat = 'S' THEN 'C'
                    WHEN stat = 'C' THEN 'P'
                    WHEN stat = 'P' THEN ''
                    ELSE stat
                END
                WHERE doctor_id = '$doctorId' AND date = '$date'";
    }
   

    mysqli_query($conn, $sql);

   
 $sqlUpdateById = "UPDATE appointment SET stat = '$newStat' WHERE id = '$appointmentId' AND doctor_id ='$doctorId' AND date ='$date' ";

 // Exécuter la deuxième requête SQL
 mysqli_query($conn, $sqlUpdateById);

    // Vérifier si les requêtes ont réussi
    if (mysqli_affected_rows($conn) > 0) {
        // Commit la transaction si tout s'est bien passé
        mysqli_commit($conn);
        echo json_encode(array('success' => true));
    } else {
        // Rollback la transaction si aucune ligne n'a été modifiée
        mysqli_rollback($conn);
        echo json_encode(array('success' => false, 'message' => 'Aucune ligne modifiée.'));
    }
} catch (Exception $e) {
    // En cas d'erreur, rollback la transaction
    mysqli_rollback($conn);
    echo json_encode(array('success' => false, 'message' => $e->getMessage()));
}

// Fermer la connexion
mysqli_close($conn);
?>

