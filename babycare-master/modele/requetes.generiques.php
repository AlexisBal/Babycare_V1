<?php

// Connexion à la base de données
include_once($_SERVER['DOCUMENT_ROOT'] . "/modele/connexion.php"); 

// Récupère tous les éléments d'une table
function selectAll(PDO $conn, string $table): array {
    $query = 'SELECT * FROM ' . $table;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Récupère tous les éléments d'une table et tri croissant
function selectAllAsc(PDO $conn, string $table, string $column): array {
    $query = 'SELECT * FROM ' . $table . ' ORDER BY  ' . $column . " ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Récupère tous les éléments d'une table et tri décroissant
function selectAllDesc(PDO $conn, string $table, string $column): array {
    $query = 'SELECT * FROM ' . $table . ' ORDER BY  ' . $column . " DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Jointure entre 2 tables 
function leftJoinTables(PDO $conn, array $selects) {
    $select = "";
    $table1 = $selects["table1"];
    $table2 = $selects["table2"];
    $columns = $selects["columns"];
    $column1 = $selects["column1"];
    $column2 = $selects["column2"];
    foreach ($columns as $column) {
        $select .= $column . ", ";
    }
    $select = substr_replace($select, '', -2, 2);
    $query = 'SELECT ' . $select . ' FROM ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Jointure entre 2 tables et tri croissant
function leftJoinTablesAsc(PDO $conn, array $selects, string $name) {
    $select = "";
    $table1 = $selects["table1"];
    $table2 = $selects["table2"];
    $columns = $selects["columns"];
    $column1 = $selects["column1"];
    $column2 = $selects["column2"];
    foreach ($columns as $column) {
        $select .= $column . ", ";
    }
    $select = substr_replace($select, '', -2, 2);
    $query = 'SELECT ' . $select . ' FROM ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2. ' ORDER BY  ' . $name . " ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Jointure entre 2 tables et recherche d'éléments
function leftJoinTablesSearch(PDO $conn, array $selects, array $research) {
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
    $query = 'SELECT ' . $select . ' FROM ' . $table1 . ' LEFT JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2. ' WHERE ' . $where;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Jointure entre 2 tables 
function innerJoinTables(PDO $conn, array $selects) {
    $select = "";
    $table1 = $selects["table1"];
    $table2 = $selects["table2"];
    $columns = $selects["columns"];
    $column1 = $selects["column1"];
    $column2 = $selects["column2"];
    foreach ($columns as $column) {
        $select .= $column . ", ";
    }
    $select = substr_replace($select, '', -2, 2);
    $query = 'SELECT ' . $select . ' FROM ' . $table1 . ' INNER JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Jointure entre 2 tables 
function rightTables(PDO $conn, array $selects) {
    $select = "";
    $table1 = $selects["table1"];
    $table2 = $selects["table2"];
    $columns = $selects["columns"];
    $column1 = $selects["column1"];
    $column2 = $selects["column2"];
    foreach ($columns as $column) {
        $select .= $column . ", ";
    }
    $select = substr_replace($select, '', -2, 2);
    $query = 'SELECT ' . $select . ' FROM ' . $table1 . ' RIGHT JOIN ' . $table2 . ' ON ' . $column1 . "=" . $column2;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Supprimer un élément d'une table
function delete(PDO $conn, array $attributs) {
    $table = $attributs['table'];
    $key = $attributs['key'];
    $value = $attributs['value'];
    $query = "DELETE FROM ".$table." WHERE ".$key."='".$value."'";
    $stmt = $conn->prepare($query);
    return $stmt->execute();
}

// Recherche des éléments en fonction des attributs passés en paramètre
function search(PDO $conn, string $table, array $attributs): array {
    $where = "";
    foreach($attributs as $key => $value) {
        $where .= "$key='".$value."' AND ";
    }
    $where = substr_replace($where, '', -4, 4);
    // Prepare statement
    $statement = $conn->prepare('SELECT * FROM ' . $table . ' WHERE ' . $where);
    $statement->execute();
    return $statement->fetchAll();    
}

// Recherche des éléments en fonction des attributs passés en paramètre
function approxSearch(PDO $conn, string $table, array $attributs): array {
    $where = "";
    foreach($attributs as $key => $value) {
        $where .= "$key LIKE '$value%'" . " OR ";
    }
    $where = substr_replace($where, '', -3, 3);
    // Prepare statement
    $statement = $conn->prepare('SELECT * FROM ' . $table . ' WHERE ' . $where);
    $statement->execute();
    return $statement->fetchAll();    
}

// Insère un nouvel élément dans une table
function insert(PDO $conn, array $values, string $table): bool {
    $attributs = '';
    $valeurs = '';
    foreach ($values as $key => $value) {
        $attributs .= $key . ', ';
        $valeurs .= "'".$value . "', ";
    }
    $attributs = substr_replace($attributs, '', -2, 2);
    $valeurs = substr_replace($valeurs, '', -2, 2);
    $query = ' INSERT INTO ' . $table . ' (' . $attributs . ') VALUES (' . $valeurs . ')';
    // Prepare statement
    $donnees = $conn->prepare($query);
    return $donnees->execute();
}

// Modifier l'élément d'une table
function update(PDO $conn, array $element, array $values) {
    $table = $element['table'];
    $keyBis = $element['keyBis'];
    $valueBis = $element['valueBis'];
    $valeurs = '';
    foreach ($values as $key => $value) {
        $valeurs .= $key . "='" . $value . "', ";
    }
    $valeurs = substr_replace($valeurs, '', -2, 2);
    $query = "UPDATE ".$table." SET ".$valeurs." WHERE ".$keyBis."='".$valueBis."'";
    // Prepare statement
    $stmt = $conn->prepare($query);
    return $stmt->execute();
}

?>