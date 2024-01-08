<?php

session_start();
include "_fonctions.inc.php";

/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_codeTypeContainer = "/^[a-zA-Z0-9\s]{0,20}$/";
$regex_quantite = "/^[0-9]{1,2}$/";

$filtreAppliqueAuFormulaire = array(
    'codeTypeContainer' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_codeTypeContainer)),
    'quantite' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_quantite)
    ),
);

$donneesDuFormulaire = filter_input_array(INPUT_POST, $filtreAppliqueAuFormulaire);


if (!is_array($donneesDuFormulaire)) {
    throw new Exception("AUCUN FORMULAIRE VALIDE");
} else if (!in_array(false, $donneesDuFormulaire, true)) {
    $codeTypeContainer = $donneesDuFormulaire["codeTypeContainer"];
    $quantite = $donneesDuFormulaire["quantite"];
    $_SESSION["ligneDeReservation"][$codeTypeContainer] = $quantite;
    header("location: saisieDesLignesDeReservation.php");
} else {
    throw new Exception("lES DONNES NE SONT PAS TRANSMIS VIA LE FORMULAIRE DE LA PAGE RESERVATION DE CONTAINERS");
}



