<?php
// Récupère les requêtes génériques
include_once('requetes.generiques.php');


// Vérifie si l'email est bannie
function isBan(PDO $conn, string $email): bool {
    if (search($conn, "UtilisateurBanni", ['email' => $email]) != []) {
        return true;
    }
    return False;
}

// Bannir un email
function banUser(PDO $conn, array $utilisateur) {
    return insert($conn, $utilisateur, "UtilisateurBanni");
}

// Ne plus bannir un utilisateur
function debanUser(PDO $conn, string $email) {
    delete($conn, [
        'table' => 'UtilisateurBanni',
        'key' => 'email',
        'value' => $email]
    );
}

?>