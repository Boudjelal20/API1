<?php
include('../connection.php');

if(isset($_POST['patient_id'])) {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
   
    $query = "SELECT s.id, s.date, s.paid, ac.id, ac.total, ac.rest,ac.motive
              FROM acte ac
              LEFT JOIN session s ON s.id_acte = ac.id
              WHERE ac.id_patient = $patient_id";

    $result = mysqli_query($conn, $query);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($sessions);
        } else {
            echo json_encode(array());
        }
    } else {
        echo json_encode(array('error' => 'Failed to execute query'));
    }
} else {
    echo json_encode(array('error' => 'No patient_id provided'));
}
