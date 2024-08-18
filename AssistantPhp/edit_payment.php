<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentId = $_POST['payment_id'];
    $newPaid = $_POST['new_paid'];
    $newDatePayment = $_POST['new_date_payment'];

    $paymentId = mysqli_real_escape_string($conn, $paymentId);
    $newPaid = mysqli_real_escape_string($conn, $newPaid);
    $newDatePayment = mysqli_real_escape_string($conn, $newDatePayment);

    $sql = "UPDATE payment SET paid = '$newPaid', date_payment = '$newDatePayment' WHERE id = $paymentId";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Échec de la mise à jour du paiement"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Méthode de requête invalide"));
}

