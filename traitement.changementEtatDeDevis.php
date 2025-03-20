<?php

session_start();
include_once '_fonctions.inc.php';
/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_action = "/^(annulation|validation)$/";
$regex_codeDevis = "/^[0-9]{1,2}$/";

$filtreAppliqueAuFormulaire = array(
    'codeDevis' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_codeDevis)),
    'action' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_action)
    ),
);

$donneesDuFormulaire = filter_input_array(INPUT_POST, $filtreAppliqueAuFormulaire);

if (!is_array($donneesDuFormulaire)) {
    throw new Exception("FORMULAIRE INVALIDE");
} else if (!in_array(false, $donneesDuFormulaire)) {
    $action = $donneesDuFormulaire["action"];
}

switch ($action) {
    case "annulation":
        $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
        $codeDevis = $donneesDuFormulaire["codeDevis"];
        changementEtatDeUnDevisDeUnUtilisateur($codeDevis, "N");
        header("location: consultationDesDevis.php");
        break;

    case "validation":
        $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
        $codeDevis = $donneesDuFormulaire["codeDevis"];
        changementEtatDeUnDevisDeUnUtilisateur($codeDevis, "O");
        header("location: consultationDesDevis.php");
        break;

    default:
        break;
}
 

