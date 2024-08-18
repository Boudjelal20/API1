<?php
include ('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_acte = $_POST['id_acte'];
    $description = $_POST['description'];
    $medicines = json_decode($_POST['medicines'], true);

    $sql = "INSERT INTO session (id_acte, description) VALUES ('$id_acte', '$description')";
    if (mysqli_query($conn, $sql)) {
        $session_id = mysqli_insert_id($conn);

        if (!empty($medicines)) {
            $insert_prescription_query = "INSERT INTO prescription (id_session) VALUES ('$session_id')";
            if (mysqli_query($conn, $insert_prescription_query)) {
                $prescription_id = mysqli_insert_id($conn);

                foreach ($medicines as $medicine) {
                    $medicine_id = $medicine['id'];
                    $quantity = $medicine['quantity'];
                    $posology = $medicine['posology'];
                    $description = $medicine['description'];

                    $insert_medicinelist_query = "INSERT INTO medicinelist (id_prescription, id_medicine, quentity, posologie, description) VALUES ('$prescription_id', '$medicine_id', '$quantity', '$posology', '$description')";
                    mysqli_query($conn, $insert_medicinelist_query);
                }

                echo "Session and prescription inserted successfully.";
            } else {
                echo "Error inserting prescription: " . mysqli_error($conn);
            }
        } else {
            echo "Session inserted successfully without prescription.";
        }
    } else {
        echo "Error inserting session: " . mysqli_error($conn);
    }
}
