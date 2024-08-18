<?php
include "../connection.php";

$user = $_POST['user_id'];
$doctor = $_POST['doctor'];

$sqlQuery = "INSERT INTO update_history(selected_doctor, user_id) VALUES('$doctor', '$user')";

try {
    $result = $conn->query($sqlQuery);
    if ($result) {
      echo json_encode(array("success" => true));
    } else {
        throw new Exception("Error inserting update", 1);
        
    }

} catch (Exception $e) {
    echo json_encode(array("success" => false, "error" => $e->getMessage()));
}

$conn->close();
