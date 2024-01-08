<?php

session_start();
include_once '_fonctions.inc.php';

/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_date = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
$regex_codeVille = "/^[0-9]{2}$/";
$regex_volumeEstime = "/^[0-9].*$/";

$filtreAppliqueAuFormulaire = array(
    'dateDebut' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_date)),
    'dateFin' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_date)
    ),
    'villeDepart' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_codeVille)
    ),
    'villeArrivee' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_codeVille)
    ),
    'volumeEstime' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_volumeEstime)
    ),
);

$donneesDuFormulaire = filter_input_array(INPUT_POST, $filtreAppliqueAuFormulaire);

if (!is_array($donneesDuFormulaire)) {
    throw new Exception("AUCUN FORMULAIRE VALIDE");
} else if (!in_array(false, $donneesDuFormulaire,true)) {
    $_SESSION["donneesDuFormulaire"] = $donneesDuFormulaire;
    header("location: saisieDesLignesDeReservation.php");
} else {
    throw new Exception("lES DONNES NE SONT PAS TRANSMIS VIA LE FORMULAIRE DE LA PAGE RESERVATION DE CONTAINERS");
}


