<?php
include('../connection.php');
$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];

$available_hours = array();
$start_time = strtotime('09:00');
$end_time = strtotime('23:00');
$current_time = strtotime(date('H:i'));
$current_day = date('Y-m-d');
while ($start_time < $end_time) {
  if ($date == $current_day && $start_time >= $current_time) { // Compare with current time
    $available_hours[] = date('H:i', $start_time);
  } else if ($date != $current_day) {
    $available_hours[] = date('H:i', $start_time);
  }
  $start_time += 30 * 60; // Add 30 minutes * 60 seconds
}

// Check already reserved hours for this date and doctor
$sql = "SELECT time FROM appointment WHERE doctor_id = $doctor_id AND date = '$date'";
$result = $conn->query($sql);

$reserved_hours = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $reserved_hours[] = $row["time"];
  }
}

// Remove reserved hours from available hours
$available_hours = array_diff($available_hours, $reserved_hours);

echo json_encode(array_values($available_hours));

$conn->close();
