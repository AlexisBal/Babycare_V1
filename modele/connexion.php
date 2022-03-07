<?php

$servername = "herogu.garageisep.com";
$dbname = "3hNsp2D9cG_babycare";
$username = "AFl43e0HgX_babycare";
$password = "VQ1TSchk0JjmAbg1";

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$servername;dbname=" . $dbname, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(Exception $e){
      die('Erreur : '.$e->getMessage());
  }

?>



