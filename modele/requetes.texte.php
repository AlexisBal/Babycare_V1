<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');

// Récupère le texte avec un nom en paramètre
function recupereTexte(PDO $conn, string $nom): array {
    return search($conn, "Texte", ['nom' => $nom]);
}

// Modification d'un texte
function modifierTexte(PDO $conn, string $nom, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Texte',
            'keyBis' => 'nom',
            'valueBis' => $nom
        ],
        $values
    );
}
?>
