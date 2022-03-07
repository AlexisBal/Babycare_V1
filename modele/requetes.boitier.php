<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/modele/connexion.php"); 

// Vérifie si un Id d'activation est valide
function ExistIdActivation(PDO $conn, string $idActivation) {
    $request = search($conn, "Boitier", ['idActivation' => $idActivation]);
    if ($request) {
        if ($request[0]['isActive'] == 1) {
            return false;
        }
        return $request[0]['idBoitier'];
    }
    return false;
}

// Récupère toutes les relation Boitier-Utilisateur
function recupereUtilisateursBoitiers(PDO $conn): array {
    return selectAll($conn, "Enfant");
}

// Récupère tous les boitiers de l'utilisateur
function recupereBoitiers(PDO $conn, int $id): array {
    return search($conn, "Enfant", ['idUtilisateur' => $id]);
}

// Retourne l'id de l'utilisateur
function returnIdUserByIdBoitier(PDO $conn, int $idBoitier) {
    $request = search($conn, "Enfant", ['idBoitier' => $idBoitier]);
    if ($request != []) {
        return $request[0]["idUtilisateur"];
    } else {
        return null;
    }
}

// Retourne les informations du boitier
function recupereBoitier(PDO $conn, int $id): array {
    return search($conn, "Enfant", ['idBoitier' => $id])[0];
}

// Recherche dans une jointure entre Boitier et Boitier-Utilisateur 
function joinLeftBoitiersUtilisateursSearch(PDO $conn, string $research) {
    return leftJoinTablesSearch(
        $conn,
        ["table1" => "Boitier",
        "table2" => "Enfant", 
        "columns" => ["Boitier.idBoitier", "Boitier.idActivation", "Enfant.prenom", "Enfant.idUtilisateur"], 
        "column1" => "Boitier.idBoitier",
        "column2" => "Enfant.idBoitier"],
        [
            'Boitier.idBoitier' => $research,
            'Enfant.idUtilisateur' => $research,
            'Boitier.idActivation' => $research,
            'Enfant.prenom' => $research
        ]   
    );
}

// jointure entre Boitier et Boitier-Utilisateur
function joinLeftBoitiersUtilisateurs(PDO $conn) {
    return leftJoinTables(
        $conn,
        ["table1" => "Boitier",
        "table2" => "Enfant", 
        "columns" => ["Boitier.idBoitier", "Boitier.idActivation", "Enfant.prenom", "Enfant.idUtilisateur"], 
        "column1" => "Boitier.idBoitier",
        "column2" => "Enfant.idBoitier"]
    );
}

// jointure entre Boitier et Boitier-Utilisateur par ordre croissant
function joinLeftBoitiersUtilisateursAsc(PDO $conn, string $column) {
    return leftJoinTablesAsc(
        $conn,
        ["table1" => "Boitier",
        "table2" => "Enfant", 
        "columns" => ["Boitier.idBoitier", "Boitier.idActivation", "Enfant.prenom", "Enfant.idUtilisateur"], 
        "column1" => "Boitier.idBoitier",
        "column2" => "Enfant.idBoitier"],
        $column
    );
}

// Modification d'un boitier
function modifierBoitier(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Boitier',
            'keyBis' => 'idBoitier',
            'valueBis' => $id
        ],
        $values
    );
}

// Modification d'une relation Enfant
function modifierUtilisateurBoitier(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Enfant',
            'keyBis' => 'idBoitier',
            'valueBis' => $id
        ],
        $values
    );
}

// Création d'une relation Enfant
function ajouteUtilisateurBoitier(PDO $conn, array $values) {
    return insert($conn, $values, "Enfant");
}

// Ajoute un nouveau boitier dans la base de données
function ajouteBoitier(PDO $conn) {
    $id = generateId();
    return insert($conn, ["idActivation" => $id], "Boitier");
}

// Suppression d'un boitier
function deleteBoitier(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Boitier',
        'key' => 'idBoitier',
        'value' => $id]
    );
}

// Nombre de boitiers actifs
function nbBoitiersActifs(PDO $conn) {
    return count(search(
        $conn,
        'Boitier',
        array('isActive' => '1')
    ));
}

?>