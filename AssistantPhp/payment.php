<?php
include('../connection.php');

// Récupérer les données POST envoyées depuis Flutter
$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

// Requête SQL pour récupérer les informations sur les patients avec stat = 'N'
$sql = "SELECT a.id AS appointment_id, p.first_name, p.family_name, p.birth_date, p.phone_number,p.id,a.date
        FROM appointment AS a
        INNER JOIN patient AS p ON a.patient_id = p.id
        WHERE a.doctor_id = '$doctorId' AND a.date = '$date' AND a.stat = 'P'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Erreur dans la requête SQL : ' . mysqli_error($conn));
}

// Tableau pour stocker les résultats à renvoyer à Flutter
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    // Ajouter chaque patient au tableau de réponse
    $response[] = $row;
}

// Retourner les résultats au format JSON à Flutter
echo json_encode($response);

mysqli_close($conn);
?>
