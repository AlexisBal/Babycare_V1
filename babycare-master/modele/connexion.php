<?php

$servername = "sql712.main-hosting.eu";
$dbname = "u538522988_babycare";
$username = "u538522988_babycare";
$password = "Nr@Y7XT:6P7";

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbname, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(Exception $e){
      die('Erreur : '.$e->getMessage());
  }

?>



