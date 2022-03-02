<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');

// Retournes toutes notifications
function recupereNotif(PDO $conn): array {
    return selectAllAsc($conn, "Notification", "idBoitier");
}

// Modification d'une notification
function modifierNotif(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Notification',
            'keyBis' => 'idNotif',
            'valueBis' => $id
        ],
        $values
    );
}

// Suppression d'une notification
function deleteNotif(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Notification',
        'key' => 'idNotif',
        'value' => $id]
    );
}
?>
