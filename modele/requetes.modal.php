<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');

function recupereModal(PDO $conn): array {
    return selectAllAsc($conn, "Modal", "titre");
}

// Modification d'un modal
function modifierModal(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Modal',
            'keyBis' => 'idModal',
            'valueBis' => $id
        ],
        $values
    );
}

// Suppression d'un modal
function deleteModal(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Modal',
        'key' => 'idModal',
        'value' => $id]
    );
}

// Recherche un utilisateur en fonction de l'email passé en paramètre
function rechercheParCategorie(PDO $conn, string $categorie): array {
    return search($conn, "Modal", ['categorie' => $categorie]);
}
?>
