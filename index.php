<?php
// Activation des erreurs. A DESACTIVER LORS DE LA MISE EN PRODUCTION
ini_set('display_errors', 1);

// Rapporte toutes les erreurs PHP
ini_set('error_reporting', E_ALL);

// Désactivation des variables globales
ini_set('register_globals', 0);

// Sécurité anti-injection SQL
ini_set('magic_quotes_gpc', 1);

// Activer session.use_only_cookies
ini_set("session.use_only_cookies", 1);

// Appel des fonctions du contrôleur
include("controleurs/fonctions.php");

// On identifie le contrôleur à appeler dont le nom est contenu dans cible passé en GET
if(isset($_GET['cible']) && !empty($_GET['cible'])) {
    // Si la variable cible est passé en GET
    $url = $_GET['cible']; //user, sensor, etc.
    
} else {
    // Si aucun contrôleur défini en GET, on bascule sur utilisateur
    $url = 'utilisateur';
}

// On appelle le contrôleur
include('controleurs/' . $url . '.php');
?>