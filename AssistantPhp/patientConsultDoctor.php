<?php
include('../connection.php');

if(isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];

    $sql = "SELECT * FROM patient p 
            INNER JOIN appointment a ON p.id = a.patient_id 
            WHERE a.stat = 'C' AND a.doctor_id = $doctor_id AND a.date = CURDATE()";

    $result = mysqli_query($conn, $sql);

    $data = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
} else {
    echo "Error: doctor_id not provided";
}

mysqli_close($conn);
?>


