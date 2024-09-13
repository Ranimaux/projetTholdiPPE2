<?php

session_start();
include "_fonctions.inc.php";

$regex_formulaire = "/^(?=.*[a-zA-Z_]).*$/";
$regex_identifiant = "/^(?=\\S+$)(?=.{4,})(?=.*[a-zA-Z]).*$/";
$regex_password = "/^(?=\\S+$)(?=.*[0-9])(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/";

$donneesFormulaire = array(
    'formulaire' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_formulaire)),
    'identifiant' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_identifiant)
    ),
    'password' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_password)
    ),
);

$donneesDuFormulaire = filter_input_array(INPUT_POST, $donneesFormulaire);
if (!in_array(false, $donneesDuFormulaire)) {
    $compteUtilisateur = obtenirCompteUtilisateur($donneesDuFormulaire["identifiant"], $donneesDuFormulaire["password"]);
    $compteEstDesactive = compteUtilisateurEstTemporairementDesactive($compteUtilisateur);
    if ($compteUtilisateur != false) {
        $resultat = password_verify($donneesDuFormulaire["password"], $compteUtilisateur["password"]);
        if ($compteEstDesactive != true) {
            if ($resultat != false) {
                $_SESSION["utilisateur"] = $compteUtilisateur;
                $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
                reinitialisationLeNombreDeTentativesDeConnexion($codeUtilisateur, $compteUtilisateur);
            } else {
                $compteUtilisateur = echecDeTentativeDeConnexion($compteUtilisateur);
            }
        }
    }
}

header("Location: index.php");

/*
 * https://www.php.net/manual/fr/reference.pcre.pattern.syntax.php
 * https://regexr.com/
 * https://www.regextester.com
 * 
    Il contient au moins 8 caractères et au plus 20 caractères.
    Il contient au moins un chiffre.
    Il contient au moins un alphabet majuscule.
    Il contient au moins un alphabet minuscule.
    Il contient au moins un caractère spécial qui inclut !@#$%&*()-+=^ .
    Il ne contient aucun espace blanc.

 * 
    ^ représente le caractère de départ de la string.
    (?=.*[0-9]) représente un chiffre qui doit apparaître au moins une fois.
    (?=.*[az]) représente un alphabet minuscule qui doit apparaître au moins une fois.
    (?=.*[AZ]) représente un alphabet majuscule qui doit apparaître au moins une fois.
    (?=.*[@#$%^&-+=()] représente un caractère spécial qui doit apparaître au moins une fois.
    (?=\\S+$) les espaces blancs ne sont pas autorisés dans toute la string.
    (?=.{10,20}) représente au moins 10 caractères et 20 au plus
    .* représente n'importe quel caractère qui apparait n fois.
    $ représente la fin de la string.

 * 
 * 
 */