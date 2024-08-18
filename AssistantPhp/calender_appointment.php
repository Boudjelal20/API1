<?php
include('../connection.php');

if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$doctor_id = $_POST['doctor_id'];

$sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') AS formatted_date, COUNT(*) AS appointment_count FROM appointment WHERE doctor_id = $doctor_id GROUP BY formatted_date";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $appointments_by_date = array();
    while ($row = $result->fetch_assoc()) {
        $appointments_by_date[$row['formatted_date']] = $row['appointment_count'];
    }
    echo json_encode($appointments_by_date);
} else {
    echo json_encode(array()); // Return an empty array if no appointments found
}

$conn->close();
?>