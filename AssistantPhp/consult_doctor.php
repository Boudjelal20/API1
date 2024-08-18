<?php
include('../connection.php');

if(isset($_POST['patient_id'])) {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
   
    $query = "SELECT  s.id AS session_id,  ac.id AS acte_id, ac.total, 
    ac.motive, s.date , s.description,
     ac.date_acte, ac.description_acte, ac.id_doctor,
     u.first_name, u.family_name
              FROM acte ac
              LEFT JOIN session s ON s.id_acte = ac.id
              LEFT JOIN user u ON u.id = ac.id_doctor
              WHERE ac.id_patient = $patient_id";
   
   $result = mysqli_query($conn, $query);
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($sessions);
        } else {
            echo json_encode(array());
        }
    } else {
        echo json_encode(array('error' => 'Failed to execute query'));
    }
} else {
    echo json_encode(array('error' => 'No patient_id provided'));



    


// if(isset($_POST['patient_id'])) {
//     $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
   
//     $query = "SELECT s.id, ac.id, ac.total, 
//     ac.motive, s.date , s.description,
//      ac.date_acte, ac.description_acte, ac.id_doctor,
//      u.first_name, u.family_name, u.total_general, u.rest_general 
//               FROM acte ac
//               LEFT JOIN session s ON s.id_acte = ac.id
//               LEFT JOIN user u ON u.id = ac.id_doctor
//               WHERE ac.id_patient = $patient_id";

//     $result = mysqli_query($conn, $query);

//     if($result) {
//         if(mysqli_num_rows($result) > 0) {
//             $sessions = mysqli_fetch_all($result, MYSQLI_ASSOC);
//             echo json_encode($sessions);
//         } else {
//             echo json_encode(array());
//         }
//     } else {
//         echo json_encode(array('error' => 'Failed to execute query'));
//     }
// } else {
//     echo json_encode(array('error' => 'No patient_id provided'));
// }
}