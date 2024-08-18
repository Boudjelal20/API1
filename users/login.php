<?php
include "../connection.php";

$username = $_POST['user_name'];
$pass = $_POST['user_password'];

$sqlQuery = "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$pass' ";
$result = $conn->query($sqlQuery);
if ($result->num_rows > 0) {
  $result = $result->fetch_assoc();
  echo json_encode(array("success" => true, "data" => $result));
} else {
  echo json_encode(array("success" => false, "message" => "Invalid username or password"));
}

$conn->close();
