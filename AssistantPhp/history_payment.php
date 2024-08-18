<?php
include('../connection.php');

$patientId = $_POST['patient_id']; 
$query = "SELECT * FROM payment WHERE id_patient = $patientId";
$result = mysqli_query($conn, $query);

$payments = array();
while ($row = mysqli_fetch_assoc($result)) {
    $payments[] = $row;
}

echo json_encode($payments);
?>