<?php
include '../connection.php';

$firstName = $_POST['first_name'];
$lastName  = $_POST['last_name'];
$des1      = $_POST['des1'];
$des2      = $_POST['des2'];
$des3      = $_POST['des3'];
$tel1      = $_POST['tel1'];
$tel2      = $_POST['tel2'];
$tel3      = $_POST['tel3'];
$mail      = $_POST['mail'];
$loc1      = $_POST['loc1'];
$loc2      = $_POST['loc2'];
$loc3      = $_POST['loc3'];

$query = "UPDATE infoadmin SET 
            first_name='$firstName',
            last_name='$lastName',
            des1='$des1',
            des2='$des2',
            des3='$des3',
            tel1='$tel1',
            tel2='$tel2',
            tel3='$tel3',
            mail='$mail',
            loc1='$loc1',
            loc2='$loc2',
            loc3='$loc3'
          WHERE id=1";

if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

