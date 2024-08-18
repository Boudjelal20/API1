<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medicine_name = $_POST['medicine_name'];

    $query = "INSERT INTO medicine (medicine_name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $medicine_name);

    if ($stmt->execute()) {
        $inserted_id = $stmt->insert_id;
        echo json_encode(array('status' => 'success', 'id' => $inserted_id, 'message' => 'Medicine added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to add medicine'));
    }

    $stmt->close();
    $conn->close();
}

