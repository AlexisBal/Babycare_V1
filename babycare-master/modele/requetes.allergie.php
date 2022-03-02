<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');

// Nom de la table
$table = "allergie";

// Récupère toutes les allergies d'un enfant
function recupereAllergies(PDO $conn, int $id): array {
    return search($conn, "Allergie", ['idEnfant' => $id]);
}

// Ajoute une relation Enfant-Allergie 
function ajouteAllergie(PDO $conn, int $id, string $type) {
    return insert(
        $conn, 
        [
            "idEnfant" => $id, 
            "type" => $type
        ], 
        "Allergie"
    );
}

// Suppression d'une relation Enfant-Allergie 
function deleteAllergie(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Allergie',
        'key' => 'idAllergie',
        'value' => $id]
    );
}

?>