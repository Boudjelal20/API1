<?php
include('../connection.php');

$sql = "SELECT FamilyNameP, FirstNameP, BirthDateP FROM patient";

$result = $conn->query($sql); 

while($row = $result->fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data);
?>
