<?php
include '../connection.php';

$query = "SELECT * FROM infoadmin LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No data found']);
}

mysqli_close($conn);
