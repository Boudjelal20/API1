<?php
include "../connection.php";

$user = $_POST['user_id'];

$sqlQuery = "SELECT * FROM update_history WHERE NOT user_id = '$user'";

try {
    $result = $conn->query($sqlQuery);
    if ($result) {
      $result = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode(array("success" => true, "data" => $result));
    } else {
        throw new Exception("data not fetched", 1);
        
    }

} catch (Exception $e) {
    echo json_encode(array("success" => false, "error" => $e->getMessage()));
}

$conn->close();
