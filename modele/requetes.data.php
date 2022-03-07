<?php

// Récupère les requêtes génériques
include_once('requetes.generiques.php');


// Recherche les Capteur en fonction du type passé en paramètre
function obtenirValeurCapteur(PDO $conn, int $idCapteur, string $nom): array {
    return search(
        $conn, 
        "Data", 
        [
            'idCapteur' => $idCapteur, 
            'nom' => $nom
        ]
    );
}

function obtenirCapteurInfos(PDO $conn, int $idCapteur): array {
    return search(
        $conn, 
        "Capteur", 
        [
            'idCapteur' => $idCapteur
        ]
    );
}

// Jointure entre 2 tables et recherche d'éléments
function leftJoinTablesSearchLast(PDO $conn, array $selects, array $research) {
    $select = "";
    $table1 = $selects["table1"];
    $table2 = $selects["table2"];
    $columns = $selects["columns"];
    $column1 = $selects["column1"];
    $column2 = $selects["column2"];
    foreach ($columns as $column) {
        $select .= $column . ", ";
    }
    $where = "";
    foreach($research as $key => $value) {
        $where .= "$key LIKE '$value%'" . " OR ";
    }
    $where = substr_replace($where, '', -3, 3);
    $select = substr_replace($select, '', -2, 2);
    $query = 'SELECT DISTINCT ' . $select . ' FROM ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2. ' WHERE ' . $where;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function obtenirTouteLaData(PDO $conn, int $idBoitier): array {
    return leftJoinTablesSearchLast(
        $conn,
        array(
            'table1' => 'Capteur',
            'table2' => 'Data',
            'columns' => ['Data.nom', 'Data.idCapteur', 'Capteur.type'],
            'column1' => 'Capteur.idCapteur',
            'column2' => 'Data.idCapteur',
        ),
        array(
            'Capteur.idBoitier' => $idBoitier
        )
    );
}



?>