<?php
include('../connection.php');

if(isset($_POST['id_acte'], $_POST['description'])) {
    $id_acte = $_POST['id_acte'];
    $description = $_POST['description'];

    $query = "INSERT INTO `session` (id_acte, date, description) VALUES (?, CURDATE(), ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $id_acte, $description);

    if ($stmt->execute()) {
        echo "Session inserted successfully.";
    } else {
        echo "Error inserting session: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing POST data.";
}

$conn->close();
?>
