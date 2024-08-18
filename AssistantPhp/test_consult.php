<?php
include('../connection.php');

$doctorId = $_POST['doctor_id'];
$date = $_POST['date'];

$sql = "SELECT a.id, p.first_name, p.family_name, p.birth_date
        FROM appointment AS a
        INNER JOIN patient AS p ON a.patient_id = p.id
        WHERE a.doctor_id = '$doctorId' 
        AND a.date = '$date' 
        AND a.stat = 'N'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $appointmentData = array(
        'id' => $row['id'],
        'first_name' => $row['first_name'],
        'family_name' => $row['family_name'],
        'birth_date' => $row['birth_date'],
    );
    // Retourner les détails du patient au format JSON avec un code de succès
    echo json_encode($appointmentData);
} else {
    // Aucun rendez-vous avec statut 'C' pour ce médecin et cette date, retourner un message d'erreur JSON
    echo json_encode(array('error' => 'Aucun rendez-vous trouvé'));
}

mysqli_close($conn);
?>
