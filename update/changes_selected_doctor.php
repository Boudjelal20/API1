<?php
include "../connection.php";

$user = $_POST['user_id'];
$doctor = $_POST['doctor'];

$sqlQuery = "UPDATE update_history SET selected_doctor = '$doctor' WHERE user_id = '$user'";

try {
    $result = $conn->query($sqlQuery);
    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        throw new Exception("Error editing update", 1);
    }

} catch (Exception $e) {
    echo json_encode(array("success" => false, "error" => $e->getMessage()));
}

$conn->close();
