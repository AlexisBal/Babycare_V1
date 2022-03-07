<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');

// Recherche les Capteurs en fonction du type passé en paramètre
function rechercheParType(PDO $conn, string $type): array {
    return search($conn, "Capteur", ['type' => $type]);
}

// Recherche les Capteurs en fonction de l'id d'un boitier 
function rechercheParBoitier(PDO $conn, int $id): array {
    return search($conn, "Capteur", ['idBoitier' => $id]);
}

// Récupère tous les Capteurs
function recupereCapteurs(PDO $conn): array {
    return selectAll($conn, "Capteur");
}

// Ajoute un nouveau capteur dans la base de données
function ajouteCapteur(PDO $conn, array $capteur) {
    return insert($conn, $capteur, "Capteur");
}

// Suppression d'un capteur dans la base de données
function deleteCapteur(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Capteur',
        'key' => 'idCapteur',
        'value' => $id]
    );
}

// Modification d'un capteur dans la base de données
function modifierCapteur(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Capteur',
            'keyBis' => 'idCapteur',
            'valueBis' => $id
        ],
        $values
    );
}

?>