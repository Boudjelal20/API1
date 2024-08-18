<?php
include '../connection.php';

// Vérifier si un identifiant de patient a été fourni
if(isset($_POST['patient_id'])) {
    // Récupérer l'identifiant du patient depuis la requête POST
    $patient_id = $_POST['patient_id'];
    
    // Préparer la requête SQL pour récupérer les données du patient
    $query = "SELECT * FROM patient WHERE id = $patient_id";
    
    // Exécuter la requête SQL
    $result = mysqli_query($conn, $query);

    // Vérifier s'il y a des résultats
    if(mysqli_num_rows($result) > 0) {
        // Récupérer les données du patient sous forme de tableau associatif
        $row = mysqli_fetch_assoc($result);
        
        // Encoder les données du patient en format JSON et les renvoyer
        echo json_encode($row);
    } else {
        // Si aucun patient n'est trouvé avec l'identifiant spécifié, renvoyer un tableau vide
        echo json_encode(array());
    }
} else {
    // Si aucun identifiant de patient n'a été fourni dans la requête, renvoyer une erreur
    echo json_encode(array('error' => 'No patient_id provided'));
}
?>
