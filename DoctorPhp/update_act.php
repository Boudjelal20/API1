<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $total = isset($_POST['total']) ? $_POST['total'] : null;
    $motive = isset($_POST['motive']) ? $_POST['motive'] : null;
    $description_acte = isset($_POST['description_acte']) ? $_POST['description_acte'] : null;

    $fields = [];
    $params = [];
    $types = '';

    if ($total !== null) {
        $fields[] = 'total=?';
        $params[] = $total;
        $types .= 'd';
    }

    if ($motive !== null) {
        $fields[] = 'motive=?';
        $params[] = $motive;
        $types .= 's';
    }

    if ($description_acte !== null) {
        $fields[] = 'description_acte=?';
        $params[] = $description_acte;
        $types .= 's';
    }

    $params[] = $id;
    $types .= 'i';

    if (!empty($fields)) {
        $query = "UPDATE acte SET " . implode(', ', $fields) . " WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo "Acte mis à jour avec succès";
        } else {
            echo "Erreur lors de la mise à jour de l'acte: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Aucun champ à mettre à jour";
    }

    $conn->close();
}
?>
