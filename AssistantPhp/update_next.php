<!-- <?php
include('../connection.php');

 if (isset($_POST['patient_id_P']) && !empty($_POST['patient_id_P']) &&
    isset($_POST['patient_id_N']) && !empty($_POST['patient_id_N'])) {

    $appointment_id_P = $_POST['appointment_id_P'];
    $appointment_id_N = $_POST['appointment_id_N'];


    // Vérifier si des enregistrements existent avec les patient_ids spécifiés et un statut 'P'
    $query = "SELECT * FROM appointment WHERE id = $appointment_id_P AND stat = 'P'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Mettre à jour le statut à 'N' pour ces enregistrements
        $update_query = "UPDATE appointment SET stat = 'N' WHERE id = $appointment_id_N  ";
        mysqli_query($conn, $update_query);

        // Vérifier si la mise à jour a été effectuée avec succès
        if (mysqli_affected_rows($conn) > 0) {
            echo "Statut mis à jour avec succès pour les patients ID $patient_id_P et $patient_id_N de 'P' à 'N'<br>";
        } else {
            echo "Aucun enregistrement mis à jour pour les patients ID $patient_id_P et $patient_id_N<br>";
        }
    } else {
        echo "Aucun enregistrement avec les patients ID $patient_id_P et $patient_id_N et un statut 'P' trouvé dans la table appointment<br>";
    }
} else {
    echo "Veuillez fournir les IDs de patients (patient_id_P et patient_id_N) via la méthode POST<br>";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?> -->
