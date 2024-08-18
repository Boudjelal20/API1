<?php
include('../connection.php');

// Récupérer les données envoyées depuis l'application
$id_patient = $_POST['id_patient']; // Correction ici
$total = $_POST['total'];

// Insérer les données dans la table `payment`
$query = "INSERT INTO payment (id_patient, total, rest) VALUES ('$id_patient', '$total', '$total')";
$result = mysqli_query($conn, $query);

// Vérifier si l'insertion a réussi
if ($result) {
  // Succès
  echo "Paiement effectué avec succès";
} else {
  // Échec
  echo "Échec du paiement";
}

// Fermer la connexion
mysqli_close($conn);
?>
