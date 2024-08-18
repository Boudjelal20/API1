<?php
include('../connection.php');

$sql = "SELECT a.*, p.first_name, p.family_name, p.birth_date, p.phone_number, p.dentalA, p.medicalA, p.gender
        FROM appointment a
        INNER JOIN patient p ON a.patient_id = p.id
        WHERE a.stat = 'C'
        ORDER BY a.date, a.time
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(null);
}

mysqli_close($conn);
?>
