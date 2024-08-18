<?php
include('../connection.php');

if (isset($_POST['id'])) {
    $appointmentId = $_POST['id'];

    $sql = "SELECT p.id, p.first_name, p.family_name, p.birth_date, p.phone_number, p.dentalA, p.medicalA, p.gender
            FROM appointment AS a
            INNER JOIN patient AS p ON a.patient_id = p.id
            WHERE a.id = '$appointmentId'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $patientDetails = array(
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'family_name' => $row['family_name'],
                'birth_date' => $row['birth_date'],
                'phone_number' => $row['phone_number'],
                'dentalA' => $row['dentalA'],
                'medicalA' => $row['medicalA'],
                'gender' => $row['gender'],
            );
            echo json_encode($patientDetails);
        } else {
            echo json_encode(array('error' => 'Aucun patient trouvé pour cet ID de rendez-vous'));
        }
    } else {
        echo json_encode(array('error' => 'Erreur SQL lors de la récupération des details du patient'));
    }

    mysqli_close($conn);
} else {
    echo json_encode(array('error' => 'ID de rendez-vous non spécifié'));
}
?>
