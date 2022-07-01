<?php

$servername = "herogu.garageisep.com";
$dbname = "2YasfoxhZv_babycare";
$username = "g4g7LrsR1F_babycare";
$password = "5e66RNAWKUwRfGFT";

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbname, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(Exception $e){
      die('Erreur : '.$e->getMessage());
  }

?>



