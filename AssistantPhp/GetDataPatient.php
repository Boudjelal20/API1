<?php

include '../connection.php';

$sql = "SELECT * FROM patient";

$result = $conn->query($sql); 

$data = array(); 
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>