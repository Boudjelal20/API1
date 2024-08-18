<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorId = $_POST['doctor_id'];
    $patientId = $_POST['patient_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $motive = $_POST['motive'];

    // Requête d'insertion
    $sql = "INSERT INTO appointment (doctor_id, patient_id, date, time ,motive) VALUES ('$doctorId', '$patientId', '$date', '$time','$motive')";
 
    if ($conn->query($sql) !== TRUE) {
        echo "Error adding appointment: " . $conn->error;
    } else {
        $response = array(
          'message' => "appointment added successfully",
        );
        echo json_encode($response);
    }
    $conn->close();
}
?>
