<?php

// Récupère les requêtes boitiers
include('requetes.boitier.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/modele/connexion.php"); 


// Recherche un utilisateur en fonction de l'email passé en paramètre
function rechercheParEmail(PDO $conn, string $email): array {
    return search($conn, "Utilisateur", ['email' => $email]);
}

// Détermine si l'utilisateur existe en fonction du token passé en paramètre
function rechercheParToken(PDO $conn, string $token): bool {
    if (search($conn, "Utilisateur", ['token' => $token]) != []) {
        return true;
    }
    return false;
}

// Recherche un utilisateur en fonction de l'id passé en paramètre
function rechercheParId(PDO $conn, int $id): array {
    return search($conn, "Utilisateur", ['idUtilisateur' => $id]);
}

// Vérifie si l'email est déjà utilisé
function existEmail(PDO $conn, string $email): bool {
    if (search($conn, "Utilisateur", ['email' => $email]) != []) {
        return true;
    }
    return False;
}


// Détermine si l'utilisateur existe et est un admin
function isAdmin(PDO $conn, string $token): bool {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        if ($request[0]["role"] == "admin" || $request[0]["role"] == "superuser") {
            return true;
        }
    } 
    return false;
}

// Détermine si l'utilisateur est superuser
function isSuperUser(PDO $conn, string $token): bool {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request[0]["role"] == "superuser") {
        return true;
    }
    return false;
}

// Retourne l'id de l'utilisateur si le compte existe
function returnIdUser(PDO $conn, string $email) {
    $request = search($conn, "Utilisateur", ['email' => $email]);
    if ($request != []) {
        return $request[0]["idUtilisateur"];
    } else {
        return null;
    }
}

// Retourne l'id de l'utilisateur si le compte existe
function returnIdUserBytoken(PDO $conn, string $token) {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        return $request[0]["idUtilisateur"];
    } else {
        return null;
    }
}

// Retourne les donées de l'utilisateur à partir du token
function returnUserBytoken(PDO $conn, string $token) {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        return $request[0];
    } else {
        return null;
    }
}

// Retourne le prénom de l'utilisateur
function returnName(PDO $conn, string $token) {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        return $request[0]["prenom"];
    } else {
        return null;
    }
}

// Retourne le nom de l'utilisateur
function returnLastName(PDO $conn, string $token) {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        return $request[0]["nom"];
    } else {
        return null;
    }
}

// Retourne l'email de l'utilisateur
function returnEmail(PDO $conn, int $id) {
    $request = search($conn, "Utilisateur", ['idUtilisateur' => $id]);
    if ($request != []) {
        return $request[0]["email"];
    } else {
        return null;
    }
}

// Vérifie que l'identifiant est valide. Retourne le token de l'identifiant si valide.
function verifLogin(PDO $conn, string $email, string $password) {
    $request = search($conn, "Utilisateur", ['email' => $email]);
    if ($request != []) {
        if (password_verify($password, $request[0]["motDePasse"])) {
            return array($request[0]["token"], $request[0]["role"]);
        }   
    } 
    return null;
}

// Vérifie que l'identifiant est valide. 
function verifOldPwd(PDO $conn, string $token, string $password):bool {
    $request = search($conn, "Utilisateur", ['token' => $token]);
    if ($request != []) {
        if (password_verify($password, $request[0]["motDePasse"])) {
            return true;
        }   
    } 
    return false;
}

// Modification du mot de passe 
function updatePwd(PDO $conn, string $token, string $password) {
    return update(
        $conn, 
        [
            'table' => 'Utilisateur',
            'keyBis' => 'token',
            'valueBis' => $token
        ],
        [
            'motDePasse' => hashPassword($password)
        ]
    );
}

// Réinitialisation manuelle du mot de passe d'un utilisateur
function resetPwd(PDO $conn, int $id) {
    // Création d'un mot de passe sécurisé
    $pwd = generatePassword();
    // Mise à jour du mot de passe dans la base de données
    update(
        $conn, 
        [
            'table' => 'Utilisateur',
            'keyBis' => 'idUtilisateur',
            'valueBis' => $id
        ], 
        [
            'motDePasse' => hashPassword($pwd)
        ]
    );
    // Récupère l'email de l'utilisateur
    $request = rechercheParId($conn, $id);
    // Envoie du mot de passe sécurisé à l'utilisateur
    sendEmailUser($request[0]["prenom"], $request[0]["email"], $pwd);
}

// Suppression d'un utilisateur 
function deleteUser(PDO $conn, int $id) {
    delete($conn, [
        'table' => 'Utilisateur',
        'key' => 'idUtilisateur',
        'value' => $id]
    );
}

// Récupère tous les Utilisateur
function recupereUtilisateurs(PDO $conn): array {
    return selectAll($conn, "Utilisateur");
}


// Recherche un utilisateur à partir de mots clé
function searchUser(PDO $conn, string $research) {
    $request = ApproxSearch(
        $conn, 
        "Utilisateur",
        [
            'email' => $research,
            'idUtilisateur' => $research,
            'nom' => $research,
            'prenom' => $research,
            'cp' =>  $research,
            'role' => $research
        ]    
    );
    if ($request != []) {
        return $request;
    } else {
        return null;
    }
}

// Récupère tous les Utilisateur et ordre croissant
function recupereUtilisateursAsc(PDO $conn, string $column): array {
    return selectAllAsc($conn, "Utilisateur", $column);
}

// Récupère tous les Utilisateur et ordre décroissant
function recupereUtilisateursDesc(PDO $conn, string $column): array {
    return selectAllDesc($conn, "Utilisateur", $column);
}

// Ajoute un nouvel utilisateur dans la base de données
function ajouteUtilisateur(PDO $conn, array $utilisateur) {
    return insert($conn, $utilisateur, "Utilisateur");
}

// Modification d'un utilisateur
function modifierUtilisateur(PDO $conn, int $id, array $values) {
    return update(
        $conn, 
        [
            'table' => 'Utilisateur',
            'keyBis' => 'idUtilisateur',
            'valueBis' => $id
        ],
        $values
    );
}

// Nombre utilisateurs récents
function nbUtilisateursRécents(PDO $conn){
    $statement = $conn->prepare('SELECT idUtilisateur FROM Utilisateur WHERE creation >= (NOW() - INTERVAL 1 MONTH)');
    $statement->execute();
    return count($statement->fetchAll());    
}
?>

