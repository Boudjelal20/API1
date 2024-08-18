<?php
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['id'];
    $new_state = $_POST['newstat'];

    $sql = "UPDATE user SET stat = '$new_state' WHERE id = $user_id  ";

    if ($conn->query($sql) === TRUE) {
        echo "User state has been updated successfully";
    } else {
        echo "Error updating user state: " . $conn->error;
    }
} else {
    echo "No parameters provided";
}

$conn->close();