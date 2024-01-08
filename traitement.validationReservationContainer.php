<?php

session_start();
include "_fonctions.inc.php";


$reservation = $_SESSION["donneesDuFormulaire"];
$reservation["dateReservation"] = date("Y-n-d");
$reservation["codeUtilisateur"] = $_SESSION["utilisateur"]["codeUtilisateur"];
$codeReservation = ajouterUneReservation($reservation);

foreach($_SESSION["ligneDeReservation"] as $key=>$value)
{
    insererUneLigneDeReservation($codeReservation, $key, $value) ;
}

unset($_SESSION["donneesDuFormulaire"]);
unset($_SESSION["ligneDeReservation"]);


header("location: consultationDesReservations.php");

