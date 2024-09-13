<?php

session_start();
include_once '_fonctions.inc.php';

/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_action = "/^(annulation|generationDevis|validation)$/";
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

    case "validation":
        $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
        $codeReservation = $donneesDuFormulaire["codeReservation"];
        changementEtatDeUneReservationDeUnUtilisateur($codeUtilisateur, $codeReservation, "Demande de réservation validée");
        header("location: consultationDesReservations.php");
        break;

    case "generationDevis":
        $_SESSION["codeReservation"] = $donneesDuFormulaire["codeReservation"];
        $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
        $codeReservation = $_SESSION["codeReservation"];

        if (devisExistePourUneReservationPourUnClient($codeUtilisateur, $codeReservation) != true) {
            creationDevisPourUneReservation($codeReservation);
        }
        $collectionDeUneReservations = obtenirDetailDeUneReservationPourUnClient($codeUtilisateur, $codeReservation);
        $detailDevis = obtenirDetailDeUnDevisPourUnClient($codeUtilisateur, $codeReservation);

//        var_dump($collectionDeUneReservations);
        $codeDevis = $detailDevis['codeDevis'];
        $montantDevis = $detailDevis['montantDevis'];
        require('fpdf184/fpdf.php');
        $pdf = new FPDF();
        $pdf->SetTitle("Votre devis numéro " . $codeDevis . " du " . date('d-m-Y'), true);
        $pdf->AddPage();
        $pdf->Image(PATH_APP . "/img/logo-tholdi.png", null, null, 30, 30);

        //Information Tholdi
        $pdf->SetXY(50, 10);
        $pdf->SetFont('Times', 'B', 24);
        $pdf->SetXY(50, 20);
        $pdf->Cell(0, 0, 'THOLDI', 0, 0, "R");
        $pdf->SetXY(50, 30);
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(0, 0, '24 RUE DU PORT', 0, 0, "R");
        $pdf->SetXY(50, 40);
        $pdf->Cell(0, 0, 'ANVERS', 0, 0, "R");
        $pdf->SetY(60);
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 200, $pdf->GetY());

        //Information client

        $pdf->SetXY(10, 65);
        $pdf->Cell(0, 0, "Raison sociale :" . $_SESSION["utilisateur"]["raisonSociale"], 0, 0, "L");
        $pdf->SetXY(10, 70);
        $pdf->Cell(0, 0, "Votre Contact :" . $_SESSION["utilisateur"]["contact"], 0, 0, "L");

        //Lieu et date
        $pdf->SetY(65);
        $pdf->Cell(0, 0, "Anvers,", 0, 0, "R"); //A REMPLACER PAR LE PORT CONCERNE
        $pdf->SetY(70);
        $pdf->Cell(0, 0, "Le " . date('d-m-Y'), 0, 0, "R");
        $pdf->SetY(90);
        $pdf->SetFillColor(200, 220, 255);

        //Information Devis
        $pdf->Cell(0, 10, "Num Devis : " . $codeDevis, 1, 0, "L", 1);

        //Lignes de réservations

        $pdf->SetXY(10, 120);
        $header = array("Type container", "Quantite reservee", "Tarif Jour", "Nb jour", "Montant");

        $pdf->SetFillColor(255, 0, 0);

        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Times', 'B');

        // En-tête
        $w = array(37, 37, 37, 37, 37);

        $pdf->SetFont('Arial', 'B', 12);
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 20, $header[$i], 1, 0, 'C', true);
        }
        $pdf->Ln();

        //tableau de lignes de réservation
        $total_ht = 0;
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        foreach ($collectionDeUneReservations as $uneCollection) {

            $pdf->Cell($w[0], 10, $uneCollection["libelleTypeContainer"], 1, 0, 'C');
            $pdf->Cell($w[1], 10, $uneCollection["qteReserver"], 1, 0, 'C');
            $pdf->Cell($w[2], 10, $uneCollection["tarifJour"], 1, 0, 'C');
            $pdf->Cell($w[3], 10, $uneCollection["nombreDeJourDeLocation"], 1, 0, 'C');
            $pdf->Cell($w[4], 10, $uneCollection["montantLigneDeReservation"], 1, 1, 'C');

            $total_ht += $uneCollection["montantLigneDeReservation"];
        } 
        $pdf->Ln();
        $tva = $total_ht * 0.20;
        $prix_final = $total_ht + $tva;

        $pdf->Ln(5);

        $pdf->SetXY(10, 170);
        $headerPrice = array("Montant Hors Taxe", "Montant TVA", "Montant Final");
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->SetFillColor(255, 0, 0);

        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.10);
        $pdf->SetFont('Times', 'B');

        $z = array(50, 50, 50);

        for ($i = 0; $i < count($headerPrice); $i++) {
            $pdf->Cell($z[$i], 20, $headerPrice[$i], 1, 0, 'C', true);
        }
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->ln();
        //Montant HT
        $pdf->Cell($z[0], 20, 'Total hors taxe: ' . $total_ht, 1, 0);
        //Montant TVA
        $pdf->Cell($z[1], 20, 'TVA (20%): ' . $tva, 1, 0);
        //Montant Final
        $pdf->Cell($z[2], 20, 'Prix final du devis: ' . $prix_final, 1, 0, 'C');

        $pdf->Output();

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
 

