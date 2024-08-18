<?php
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $first_name = $_POST['first_name'];
  $family_name = $_POST['family_name'];
  $birth_date = $_POST['birth_date'];
  $phone_number = $_POST['phone_number'];
  $dental_incident = $_POST['dental_incident'];
  $medical_incident = $_POST['medical_incident'];
  $gender = $_POST['gender'];
  $doctor_id = $_POST['doctor_id'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $motive=$_POST['motive'];

  $sql = "INSERT INTO patient (first_name, family_name, birth_date, phone_number, dentalA, medicalA, gender)
          VALUES ('$first_name', '$family_name', '$birth_date', '$phone_number', '$dental_incident', '$medical_incident', '$gender')";

  $sql02 = "SELECT * FROM patient WHERE family_name = '$family_name' AND first_name = '$first_name' AND birth_date = '$birth_date'";

  if ($conn->query($sql) === TRUE) {
    $patient = $conn->query($sql02);
    $patient = $patient->fetch_assoc();
    $patient_id = $patient['id'];

    if (!empty($doctor_id) && !empty($date) && !empty($time)) {
      $appointment_sql = "INSERT INTO appointment (doctor_id, patient_id, motive, date, time)
                          VALUES ('$doctor_id', '$patient_id', '$motive', '$date', '$time')";

      if ($conn->query($appointment_sql) !== TRUE) {
        echo "Error adding appointment: " . $conn->error;
      } else {
        echo json_encode(array('msg' => "New patient and appointment added successfully", 'patient' => $patient));
      }
    } else {
      // Si les champs de rendez-vous sont vides, indiquez que seul le patient a été ajouté
      echo json_encode(array("msg" => "New patient added successfully", 'patient' => $patient));
    }
  } else {
    echo json_encode(array("msg" => "Error adding patient: " . $conn->error));
  }

  // Ferme la connexion à la base de données
  $conn->close();
}
