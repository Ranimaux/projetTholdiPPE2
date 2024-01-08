<?php

include_once '../config/_config.inc.php';

$pdo = new PDO('mysql:host='. CONFIG["db"]["db_host"] , 
        CONFIG["db"]["db_user"], 
        CONFIG["db"]["db_password"]);

$pdoStatement = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbName');
$dbName = CONFIG["db"]["db_name"];
$pdoStatement->bindParam(':dbName', $dbName, PDO::PARAM_STR);
$pdoStatement->execute();

if ($pdoStatement->fetchColumn() == 0) {
    $query = file_get_contents("../script-bd/tholdi.sql");
    $pdoStatement = $pdo->prepare($query);
    $pdoStatement->execute();
}

header("Location: ../index.php");




