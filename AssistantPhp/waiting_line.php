<?php
include('../connection.php');

// Vérifier si les paramètres 'doctor_id' et 'date' ont été envoyés en POST
if (isset($_POST['doctor_id']) && isset($_POST['date'])) {
    $doctorId = $_POST['doctor_id'];
    $date = $_POST['date'];

    // Requête SQL pour récupérer les rendez-vous pour le médecin et la date spécifiés
    $sql = "SELECT a.id, a.time, p.first_name, p.family_name, p.phone_number
            FROM appointment a
            JOIN patient p ON a.patient_id = p.id
            WHERE a.doctor_id = '$doctorId' AND a.date = '$date'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $booked_appointments = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $booked_appointments[$row['time']] = $row;
        }
    } else {
        $booked_appointments = array();
    }

    // Création des créneaux horaires disponibles dans la journée
    $start_time = strtotime('09:00');
    $end_time = strtotime('23:00');
    $interval = 30 * 60; // Intervalle de 30 minutes en secondes

    $available_slots = array();

    while ($start_time < $end_time) {
        $time_slot = date('H:i', $start_time);

        if (array_key_exists($time_slot, $booked_appointments)) {
            // Créneau réservé : Ajouter les détails du rendez-vous existant
            $available_slots[$time_slot] = $booked_appointments[$time_slot];
        } else {
            // Créneau disponible : Indiquer qu'il est libre
            $available_slots[$time_slot] = null;
        }

        $start_time += $interval;
    }

    // Retourner les créneaux horaires disponibles avec leurs statuts
    echo json_encode($available_slots);
} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Missing doctor_id or date parameter'));
}
?>
