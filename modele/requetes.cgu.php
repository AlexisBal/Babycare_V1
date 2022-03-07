<?php

// Récupère les requêtes génériques
require_once('requetes.generiques.php');

// Ajoute un nouvel article aux cgu
function ajouteArticle(PDO $conn, String $categorie, String $titre, String $texte) {
    return insert(
        $conn, 
        [
            "categorie" => $categorie, 
            "titre" => $titre, 
            "texte" => $texte
        ], 
        "CGU"
    );
}

// Modification du contenu d'un article
function modifierArticle(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'CGU',
            'keyBis' => 'idArticle',
            'valueBis' => $id
        ],
        $values
    );
}

// Suppression d'un article
function deleteArticle(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'CGU',
        'key' => 'idArticle',
        'value' => $id]
    );
}

// Récupère tous les articles des CGU
function recupereArticles(PDO $conn): array {
    return selectAllAsc($conn, "CGU", "titre");
}
