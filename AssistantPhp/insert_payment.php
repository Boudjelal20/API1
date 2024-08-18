<?php
include('../connection.php');

$patientId = $_POST['patient_id'];
$paid = $_POST['paid'];

$datePayment = date("Y-m-d");

$query = "INSERT INTO payment (id_patient, paid, date_payment) VALUES ('$patientId', '$paid', '$datePayment')";

if (mysqli_query($conn, $query)) {
    echo "Nouveau paiement ajouté avec succès";
} else {
    echo "Erreur lors de l'ajout du paiement: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
