<?php
include_once '_debut.inc.php';

$dateMinimumDeReservation  = mktime(0, 0, 0, date("m"),   date("d")+7,   date("Y"));                                   
                                   
?>

<div class="row">
    <div class="col-3">
        <?php include_once '_menuReservation.inc.php'; ?>
    </div>
    <div class="col-1"></div>
    <div class="col-7 shadow mt-3">
        <form method="post" action="traitement.saisieDeUneReservationDeContainer.php">
            <div class="row mb-3 text-center">
                <div class="col ">
                    <h2 class="mb-3">
                        SAISIE D'UNE RESERVATION DE CONTAINER
                    </h2>
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                        </svg>
                        <span class="font-monospace"> INFORMATIONS SUR LA RESERVATION </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-europe-africa" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM3.668 2.501l-.288.646a.847.847 0 0 0 1.479.815l.245-.368a.809.809 0 0 1 1.034-.275.809.809 0 0 0 .724 0l.261-.13a1 1 0 0 1 .775-.05l.984.34c.078.028.16.044.243.054.784.093.855.377.694.801-.155.41-.616.617-1.035.487l-.01-.003C8.274 4.663 7.748 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 1.96.826 2.166 1.696 2.382.46.115.935.233 1.304.618.449.467.393 1.181.339 1.877C6.755 12.96 6.674 14 8.5 14c1.75 0 3-3.5 3-4.5 0-.262.208-.468.444-.7.396-.392.87-.86.556-1.8-.097-.291-.396-.568-.641-.756-.174-.133-.207-.396-.052-.551a.333.333 0 0 1 .42-.042l1.085.724c.11.072.255.058.348-.035.15-.15.415-.083.489.117.16.43.445 1.05.849 1.357L15 8A7 7 0 1 1 3.668 2.501Z"/>
                        </svg>
                    </div>
                    <div>
                        <a class="infobulle">
                            <img src="img/round-bouton-d-39-aide_318-77423-100x100.jpg" alt="" width="10%" />
                            <span>Ci-dessous, vous pouvez saisir une nouvelle réservation où il faut saisir la date de quand vous allez prendre le container puis la date retour ainsi que le port de la prise du container et le port que vous allez le rendre puis le volume que le container transportera</span>
                        </a>
                    </div>


                </div>
            </div>

            <div class="row ">
                <div class="col">
                    
 
                    <div class="row mb-3">
                        <div class=" form-group col-md-4">
                            <label class="mb-1 fst-italic" for="inputEmail4">
                                Date de d&eacute;but de la r&eacute;servation
                            </label>
                            <input type="date" class="form-control" id="dateDebut"  name="dateDebut" min="<?php echo date("Y-m-d");?>" 
                                   
                                   onchange="setDateDeFin()" required="required"
                                   
                                   placeholder="date de début de la réservation" >
                        </div>
                        <div class="form-group col-md-4 offset-1">
                            <label class="mb-1 fst-italic" for="inputPassword4">
                                date de fin de la r&eacute;servation
                            </label>
                            <input type="date" class="form-control" id="dateFin" name="dateFin"  required="required" 
                                   
                                   placeholder="date de fin de la réservation" >  
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-4">
                            <label class="mb-1 fst-italic" for="villeDepart">Lieu de mise &agrave; disposition</label>
                            <select class="form-control" id="villeDepart" name="villeDepart" placeholder="ville de départ" onchange="filterVilleArrivee()">
                                <option value="">Sélectionner une ville</option>
                                <?php
                                $listeVille = obtenirLaCollectionDesVilles();
                                foreach ($listeVille as $ville):
                                    ?>
                                    <option value="<?php echo $ville["codeVille"]; ?>"><?php echo $ville["nomVille"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4 offset-1">
                            <label class="mb-1 fst-italic" for="villeArrivee">Lieu de restitution</label>
                            <select class="form-control" id="villeArrivee" name="villeArrivee" placeholder="ville d'arrivée">
                                <option value="">Sélectionner une ville</option>
                                <?php foreach ($listeVille as $ville): ?>
                                    <option value="<?php echo $ville["codeVille"]; ?>"><?php echo $ville["nomVille"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 mt-4">
                        <label for="volumeEstime" class="col-sm-2 col-form-label col-form-label-sm mb-1 fst-italic">
                            Volume estim&eacute;
                        </label>
                        <div class="col-sm-2">
                            <input type="number" value="0" class="form-control" id="volumeEstime"  
                                   name="volumeEstime" placeholder="Volume éstimé">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-md-8">
                    <button type="submit" class="btn-sm btn btn-primary w-25 float-end">Valider</button>
                </div>
            </div>
        </form>
    </div>

</div>

<script>
    // Fonction permettant la surveillance de la valeur émis dans dateDebut au moment de faire la réservation
    function setDateDeFin() {
        var dateDebut = new Date(document.getElementById("dateDebut").value);
        var dateFin = document.getElementById("dateFin");
        
        dateDebut.setDate(dateDebut.getDate() + 7);
        var convertDate = dateDebut.toISOString().split('T')[0];
        dateFin.min = convertDate;
    }

    document.getElementById("dateDebut").addEventListener("input", setDateDeFin);
    // Fonction permettant de vérifier la valeur émis dans villeDepart et qu'il soit pas sélectionnable dans villeArrivee
    function filterVilleArrivee() {
        const villeDepart = document.getElementById("villeDepart").value;  
        const villeArrivee = document.getElementById("villeArrivee"); 
        const parametre = villeArrivee.options;

        for (let i = 0; i < parametre.length; i++) {
            parametre[i].disabled = parametre[i].value === villeDepart && villeDepart !== "";
        }
    }

</script>



<?php include_once '_fin.inc.php'; ?>