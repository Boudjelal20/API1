<?php
include('../connection.php');

if (isset($_POST['doctor_id']) && isset($_POST['date'])) {
    $doctorId = $_POST['doctor_id'];
    $date = $_POST['date'];

  
    $sql = "SELECT a.id, a.time, p.first_name, p.family_name, p.phone_number ,a.stat , a.motive
            FROM appointment a
            JOIN patient p ON a.patient_id = p.id
            WHERE a.doctor_id = '$doctorId' AND a.date = '$date' AND a.stat!='' AND a.stat !='P'
            ORDER BY a.time ASC";  // Tri par heure croissante

    $result = mysqli_query($conn, $sql);

    if ($result) { 
        $appointments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        echo json_encode($appointments);
    } else {
        http_response_code(500);
        echo json_encode(array('message' => 'Failed to fetch appointments'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Missing doctor_id or date parameter'));
}
?>
