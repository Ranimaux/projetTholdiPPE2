<?php

session_start();
include_once '_debut.inc.php';

/**
 * VERIFICATION DES DONNES DU FORMULAIRE
 */
$regex_date = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";

$regex_ville ="/^[0-9]{1,3}$/";

$filtreAppliqueAuFormulaire = array(
    'dateDebutReservation' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_date)),
    'dateFinReservation' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_date)),
    'dateReservation' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_date)),
    'codeVilleMiseDispo' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_ville)),
    'codeVilleRendre' => array('filter' => FILTER_VALIDATE_REGEXP,
        'options' => array("regexp" => $regex_ville)),
);

$donneesDuFormulaire = filter_input_array(INPUT_POST, $filtreAppliqueAuFormulaire);

if ($donneesDuFormulaire != null) {
    $donneesDuFormulaire = array_filter($donneesDuFormulaire, function ($value) {
        return ($value != null);
    });
    if (!in_array(false, $donneesDuFormulaire, true)) {
        $codeUtilisateur = $_SESSION["utilisateur"]["codeUtilisateur"];
        $collectionDeReservations = rechercheReservationSelonCritere($codeUtilisateur,$donneesDuFormulaire);
    }
}

?>
<div class="row">
    <div class="col-3">
        <?php include_once '_menuReservation.inc.php'; ?>
    </div>
    <div class="col-1"></div>
    <div class="col-7 shadow mt-3">
        <div class="row mb-3 text-center">
            <div class="col ">
                <h2 class="mb-3">
                    CONSULTATION
                </h2>
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                    </svg>
                    <span class="font-monospace"> RESULTAT DE VOTRE RECHERCHE </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-europe-africa" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM3.668 2.501l-.288.646a.847.847 0 0 0 1.479.815l.245-.368a.809.809 0 0 1 1.034-.275.809.809 0 0 0 .724 0l.261-.13a1 1 0 0 1 .775-.05l.984.34c.078.028.16.044.243.054.784.093.855.377.694.801-.155.41-.616.617-1.035.487l-.01-.003C8.274 4.663 7.748 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 1.96.826 2.166 1.696 2.382.46.115.935.233 1.304.618.449.467.393 1.181.339 1.877C6.755 12.96 6.674 14 8.5 14c1.75 0 3-3.5 3-4.5 0-.262.208-.468.444-.7.396-.392.87-.86.556-1.8-.097-.291-.396-.568-.641-.756-.174-.133-.207-.396-.052-.551a.333.333 0 0 1 .42-.042l1.085.724c.11.072.255.058.348-.035.15-.15.415-.083.489.117.16.43.445 1.05.849 1.357L15 8A7 7 0 1 1 3.668 2.501Z"/>
                    </svg>
                </div>


            </div>
        </div>
    </div>
    <?php
    if (isset($collectionDeReservations) && count($collectionDeReservations) > 0):
        ?>

        <?php
        foreach ($collectionDeReservations as $uneReservation) :
            ?>
            <div class="col-7 offset-4 shadow mt-3">
                <div class="card m-4">
                    <div class="card-header text-center alert-success " >
                        Reservation du <?php echo verificationSaisie(dateAuFormatJourMoisAnnee($uneReservation["dateReservation"])); ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Mise &agrave; disposition le :
                                <span class="fw-bold ">
                                    <?php echo verificationSaisie(dateAuFormatJourMoisAnnee($uneReservation["dateDebutReservation"])); ?> 
                                </span>
                                &agrave;
                                <span class="fw-bold text-uppercase ">
                                    <?php echo $uneReservation["nomVilleMiseDispo"]; ?> 
                                </span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                Restitution le :
                                <span class="fw-bold ">
                                    <?php echo verificationSaisie(dateAuFormatJourMoisAnnee($uneReservation["dateFinReservation"])); ?> 
                                </span>
                                &agrave;
                                <span class="fw-bold text-uppercase ">
                                    <?php echo verificationSaisie($uneReservation["nomVilleRendre"]); ?>
                                </span>
                            </div>
                        </div>

                        <div class="row mt-3 mb-2">
                            <div class="col">
                                Volume estim&eacute; :
                                <span class="fw-bold ">
                                    <?php
                                    echo verificationSaisie(($uneReservation["volumeEstime"] === 0) ? $uneReservation["volumeEstime"] : "<i>Non renseigné</i>");
                                    ?>
                            </div>
                        </div>

                        <div class="row mt-4 ">
                            <div class="btn-group text-center" role="group">
                                <div class="col m-2 ">
                                    <a  href="detailDeUneReservation.php?codeReservation=<?php echo verificationSaisie($uneReservation["codeReservation"]) ?>" 
                                        class="btn btn-primary  w-75 me-2">
                                        détails
                                    </a>
                                </div>
                                <div class="col m-2 ">
                                    <form action="traitement.changementEtatDeReservation.php" method="post">
                                        <input type="hidden" name="codeReservation" 
                                               value="<?php echo verificationSaisie($uneReservation["codeReservation"]) ?>">
                                                   <?php
                                                   switch ($uneReservation["etat"]) :

                                                       case "Demande de réservation":
                                                           ?>
                                                    <input type="hidden" name="action" value="annulation" />
                                                    <button type="submit" class="btn btn-danger w-75" >Annuler votre réservation</button>
                                                    <?php
                                                    break;

                                                case "Demande de réservation validée":
                                                    ?>
                                                    <input type="hidden" name="action" value="generationDevis" />
                                                    <button type="submit" class="btn btn-primary w-75" >Générer votre devis</button>

                                                    <?php
                                                    break;

                                                case "Annulé":
                                                    ?>
                                                     <button type="button" class="btn btn-secondary w-75" >Réservation annulée</button>                                                     
                                                    
                                                    <?php
                                                    break;

                                                default:
                                                    break;
                                            endswitch;
                                            ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted alert-success text-center" >

                        <?php
                        $dateDebut = new DateTime($uneReservation["dateDebutReservation"]);
                        $dateFin = new DateTime($uneReservation["dateFinReservation"]);
                        $interval = $dateDebut->diff($dateFin);
                        ?>Durée de la réservation <?php echo $interval->days; ?> jour(s)
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>





<?php include_once '_fin.inc.php'; ?>
