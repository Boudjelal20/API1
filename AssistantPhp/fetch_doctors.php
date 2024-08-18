<?php
include "../connection.php";
$sqlQuery = "SELECT * FROM user WHERE job ='Doctor'";
$result = $conn->query($sqlQuery);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userData[] = $row;
    }
    echo json_encode($userData);
} else {
    echo json_encode('0 result');
}
$conn->close();
