<?php
include('../connection.php');

$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

$sql = "SELECT a.id AS appointment_id, p.first_name, p.family_name, p.birth_date, p.phone_number,p.id
        FROM appointment AS a
        INNER JOIN patient AS p ON a.patient_id = p.id
        WHERE a.doctor_id = '$doctorId' AND a.date = '$date' AND a.stat = 'C'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Erreur dans la requête SQL: ' . mysqli_error($conn));
}

$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    $response[] = $row;
}

echo json_encode($response);

mysqli_close($conn);
