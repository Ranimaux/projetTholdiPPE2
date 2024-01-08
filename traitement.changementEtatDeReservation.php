<?php

session_start();
include_once '_fonctions.inc.php';

/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_action = "/^(annulation|generationDevis)$/";
$regex_codeReservation = "/^[0-9]{1,2}$/";

$filtreAppliqueAuFormulaire = array(
    'codeReservation' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_codeReservation)),
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
        $codeReservation = $donneesDuFormulaire["codeReservation"];
        changementEtatDeUneReservationDeUnUtilisateur($codeUtilisateur, $codeReservation, "Annulé");
        header("location: consultationDesReservations.php");
        break;

    case "generationDevis":
        $_SESSION["codeReservation"] = $donneesDuFormulaire["codeReservation"];
        echo "<script>
            let a= document.createElement('a');
            a.target= '_blank';
            a.href= '/" . DIR_APP . "/devis.php';
            a.click();
            location.assign('/" . DIR_APP . "/consultationDesReservations.php'); 
          </script>";
        
        break;
    
    default:
        break;
}
 

