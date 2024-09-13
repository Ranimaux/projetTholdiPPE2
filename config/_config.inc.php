<?php

/* * *****************************************************************************
 * Définition de constantes
 * *******************************************************************************
 */

//PATH_APP contient le chemin du répertoire racine de l'application
define('PATH_APP', getcwd());

//DIR_APP contient le nom du répertoire de l'application
define('DIR_APP', basename(getcwd()));

//CONFIG contient les données de configuration de l'application
define('CONFIG', [
    "db" => [
        "db_engine" => "mysql",
        "db_host" => "service_mysql",
        "db_name" => "tholdi_reservation_appli_resa_web",
        "db_user" => "root",
        "db_password" => "Azerty1"
    ],
//    "db" => [
//        "db_engine" => "mysql",
//        "db_host" => "172.26.0.100",
//        "db_name" => "db_anvers",
//        "db_user" => "slam",
//        "db_password" => "@Xazerty1"
//    ],
    "log" => [
        "exception_file_log" => PATH_APP . '/logs/exception.log',
        "error_file_log" => PATH_APP . '/logs/error.log',
        "current_file_log" => PATH_APP . '/logs/current.log',
    ]
]);

/* * *****************************************************************************
 * Définition d'un gestionnaire d'exceptions
 * *******************************************************************************

 * Cela constiste à définir une méthode en charge de gérer les exceptions non traitées dans
 * l'application
 */
set_exception_handler('exception_handler');

/* Gestionnaire d'exceptions */

function exception_handler($exception) {
    $error = "\nLe :" . date('d-m-y h:i:s') . "\n";
    $error = "\n" . print_r($exception, true);
    $exception_file = CONFIG["log"]["exception_file_log"];
    $current_file = CONFIG["log"]["current_file_log"];
    error_log($error, 3, $exception_file);
    file_put_contents($current_file, $error);
    header('Location: /' . DIR_APP . '/logs/current.log');
    exit();
}

/* * *****************************************************************************
 * Définition d'un gestionnaire d'erreurs
 * *******************************************************************************

 * Cela consiste à définir une méthode en charge de gérer les erreurs qui surviennent dans l'application
 */
set_error_handler('error_handler');

/* Gestionnaire d'erreurs */

function error_handler($errno, $errstr, $errfile, $errline) {
    $error = "\nniveau erreur: " . $errno .
            "\n description: " . $errstr .
            " \n fichier: " . $errfile .
            "\n n°ligne: " . $errline;
    $error_file = CONFIG["log"]["error_file_log"];
    $current_file = CONFIG["log"]["current_file_log"];
    error_log($error, 3, $error_file);
    file_put_contents($current_file, $error);
    header('Location: /' . DIR_APP . '/logs/current.log');
    exit();
}
