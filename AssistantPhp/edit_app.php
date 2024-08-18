<?php
include '../connection.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    $doctorId = $data['doctor_id'];
    $date = $data['date'];
    $time = $data['time'];
    $appointmentId = $data['id'];
    $motive = $data['motive']; 

    $query = "UPDATE appointment SET doctor_id = ?, motive = ?, date = ?, time = ?, stat='W' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isssi', $doctorId, $motive, $date, $time, $appointmentId); // Liaison des valeurs aux paramètres de la requête

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Appointment updated successfully']);
    } else {
        echo json_encode(['message' => 'Failed to update appointment']);
    }

    $stmt->close();
} else {
    echo json_encode(['message' => 'No data received']);
}

$conn->close();
