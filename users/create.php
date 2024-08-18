<?php

include '../connection.php';

if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$first_name = $_POST['first_name'];
$family_name = $_POST['family_name'];
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$phone_number = $_POST['phone_number'];
$job = $_POST['job'];

$query = "INSERT INTO user (first_name, family_name, user_name, user_password, phone_number, job) 
          VALUES ('$first_name', '$family_name', '$user_name', '$user_password', '$phone_number', '$job')";

$result = mysqli_query($conn, $query);


if ($result) {
    echo "insérées avec succès";
} else {
    echo "Erreur lors de l'insertion des données : " . mysqli_error($conn);
}


mysqli_close($conn);
