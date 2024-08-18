<?php
include '../connection.php';

if(isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];
    
    $query = "SELECT * FROM appointment WHERE patient_id = $patient_id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $appointments = [];
        while($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        echo json_encode($appointments);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode(['error' => 'Missing patient_id parameter']);
}
?>
