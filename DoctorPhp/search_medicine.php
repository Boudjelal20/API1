<?php
include('../connection.php');

$query = "SELECT * FROM medicine";
$stmt = $conn->prepare($query);

$stmt->execute();
$result = $stmt->get_result();

$medicines = [];
while ($row = $result->fetch_assoc()) {
    $medicines[] = $row;
}

echo json_encode($medicines);

$stmt->close();
$conn->close();

