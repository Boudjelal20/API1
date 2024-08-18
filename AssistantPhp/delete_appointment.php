<?php
include '../connection.php';

if (isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    $query = "DELETE FROM appointment WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Appointment deleted successfully";
    } else {
        echo "Failed to delete appointment";
    }
} else {
    echo "Appointment ID not provided";
}

$stmt->close();
$conn->close();
?>
