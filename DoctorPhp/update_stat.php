<?php
include '../connection.php';


$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

$sql = "UPDATE appointment SET stat ='P' WHERE  stat='C'  AND doctor_id = ? AND date = ?  ";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $doctorId, $date);

    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        mysqli_commit($conn); 
        echo json_encode(array('success' => true));
    } else {
        mysqli_rollback($conn); 
        echo json_encode(array('success' => false, 'message' => 'Aucun rendez-vous mis à jour'));
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array('success' => false, 'message' => 'Erreur de préparation de la requête'));
}

mysqli_close($conn);

