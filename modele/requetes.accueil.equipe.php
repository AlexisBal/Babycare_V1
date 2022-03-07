<?php

// Récupère les requêtes génériques
include_once('./modele/requetes.generiques.php');

// Récupère tous les membre de l'équipe
function recupereEquipe(PDO $conn): array {
    return selectAll($conn, "Equipe");
}
// Modification d'un membre de l'équipe
function modifierEquipe(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Equipe',
            'keyBis' => 'idPersonne',
            'valueBis' => $id
        ],
        $values
    );
}

// Ajoute un nouveau membre à l'équipe
function ajouteMembreEquipe(PDO $conn, array $equipe) {
    return insert($conn, $equipe, "Equipe");
}

// Suppression d'un membre de l'équipe 
function deleteMembreEquipe(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Equipe',
        'key' => 'idPersonne',
        'value' => $id]
    );
}
?>