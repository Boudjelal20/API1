<?php
include ('../connection.php');

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$family_name = $_POST['family_name'];
$birth_date = $_POST['birth_date'];
$phone_number = $_POST['phone_number'];
$dentalA = $_POST['dentalA'];
$medicalA = $_POST['medicalA'];
$gender = $_POST["gender"];

$sql = "UPDATE patient SET 
            first_name = '$first_name', 
            family_name = '$family_name', 
            birth_date = '$birth_date', 
            phone_number = '$phone_number', 
            dentalA = '$dentalA', 
            medicalA = '$medicalA', 
            gender =  '$gender'
            WHERE id = '$id'";

try {
    $result = $conn->query($sql);
    if ($result) {
        echo json_encode(array("message" => "Patient updated successfully"));
    } else {
        echo json_encode(array("error" => "Error updating patient"));
    }
} catch (Exception $e) {
    echo json_encode(array('error'=>$e->getMessage()));
}


$conn->close();
