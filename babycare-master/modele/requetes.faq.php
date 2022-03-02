<?php

// Récupère les requêtes génériques
require_once('requetes.generiques.php');

// Ajoute une nouvelle question à la FAQ
function ajouteQuestion(PDO $conn, String $categorie, String $question, String $reponse) {
    return insert(
        $conn, 
        [
            "categorie" => $categorie, 
            "question" => $question, 
            "reponse" => $reponse
        ], 
        "FAQ"
    );
}

// Modification d'une question
function modifierQuestion(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'FAQ',
            'keyBis' => 'idQuestion',
            'valueBis' => $id
        ],
        $values
    );
}

// Suppression d'une question
function deleteQuestion(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'FAQ',
        'key' => 'idQuestion',
        'value' => $id]
    );
}

// Récupère toutes les questions de la FAQ
function recupereQuestions(PDO $conn): array {
    return selectAllAsc($conn, "FAQ", "categorie");
}

// Nombre de questions
function nbQuestionsFAQ(PDO $conn) {
    return count(selectAll(
        $conn,
        'FAQ'
    ));
}



?>