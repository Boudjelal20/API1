<?php
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID and new state from POST parameters
    $id = $_POST['id'];
    $new_state = $_POST['newstat'];

    // Update user state in the database
    $sql = "UPDATE appointment SET stat = '$new_state' WHERE id = $id  ";

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        // If update successful, return success message
        echo "appointment state has been updated successfully";
    } else {
        // If update failed, return error message
        echo "Error updating appointment state: " . $conn->error;
    }
} else {
    // If request method is not POST, return error message
    echo "No parameters provided";
}

// Close the database connection
$conn->close();
?>
