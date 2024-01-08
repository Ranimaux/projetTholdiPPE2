<?php

include_once '../config/_config.inc.php';

$pdo = new PDO(
            CONFIG["db"]["db_engine"] . ':host=' . CONFIG["db"]["db_host"] . ';dbname=' . CONFIG["db"]["db_name"],
            CONFIG["db"]["db_user"],
            CONFIG["db"]["db_password"],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );

$password = password_hash("@Xazerty1",PASSWORD_DEFAULT);
$codeUtilisateur = 1;

$requeteSql = "update utilisateur set password=:password where codeUtilisateur=:codeUtilisateur";
$pdoStatement = $pdo->prepare($requeteSql);
$pdoStatement->bindValue(':password', $password, PDO::PARAM_STR);
$pdoStatement->bindValue(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_INT);
$pdoStatement->execute();

//var_dump($pdoStatement->errorInfo());

