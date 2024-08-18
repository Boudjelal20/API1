<?php
include('../connection.php');

if(isset($_POST['id_patient'], $_POST['id_doctor'], $_POST['description_acte'], $_POST['total'], $_POST['motive'], $_POST['date_acte'])) {
    $id_patient = $_POST['id_patient'];
    $id_doctor = $_POST['id_doctor'];
    $description_acte = $_POST['description_acte'];
    $total = $_POST['total'];
    $motive = $_POST['motive'];
    $date_acte = $_POST['date_acte'];

    $query = "INSERT INTO acte (id_patient, id_doctor, description_acte, total, motive, date_acte) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisdss", $id_patient, $id_doctor, $description_acte, $total, $motive, $date_acte);

    if ($stmt->execute()) {
        $id_acte = $stmt->insert_id;
        echo json_encode(['success' => true, 'id_acte' => $id_acte]); 
    } else {
        echo json_encode(['success' => false, 'message' => "Error inserting acte: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => "Missing POST data."]);
}

$conn->close();
?>
