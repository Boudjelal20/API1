<?php
include('../connection.php');

// Récupération des données POST envoyées par l'application Flutter.
$appointmentId = $_POST['appointmentId'];
$paymentId = $_POST['paymentId'];
$paidAmount = $_POST['paidAmount'];
$currentDate = date("Y-m-d");


// Préparation de la requête SQL pour insérer les données.
$stmt = $conn->prepare("INSERT INTO session (id_acte, paid , date ) VALUES (?, ?, ?)");
$stmt->bind_param("iid", $paymentId, $paidAmount, $currentDate); 

// Exécution de la requête.
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Fermeture de la connexion.
$stmt->close();
$conn->close();
?>
