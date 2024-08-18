<?php
include('../connection.php');

if(isset($_POST['payment_id'])) {
    $paymentId = $_POST['payment_id'];

    $paymentId = mysqli_real_escape_string($conn, $paymentId);

    $sql = "DELETE FROM payment WHERE id = $paymentId";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Échec de la suppression du paiement"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "ID du paiement non fourni"));
}
?>
