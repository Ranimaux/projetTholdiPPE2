<?php
include_once '_debut.inc.php';
?>

<div class="row">
    <div class="col-3">
        <?php include_once '_menuContainer.inc.php'; ?>
    </div>
    <div class="col-1"></div>
    <div class="col-7 shadow mt-3">
        <form method="post" action="consultationContainerViaModuleDeRecherche.php">
            <div class="row mb-3 text-center">
                <div class="col ">
                    <h2 class="mb-3">
                        MODULE DE RECHERCHE
                    </h2>
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
                        </svg>
                        <span class="font-monospace"> VOS RESERVATIONS </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-europe-africa" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM3.668 2.501l-.288.646a.847.847 0 0 0 1.479.815l.245-.368a.809.809 0 0 1 1.034-.275.809.809 0 0 0 .724 0l.261-.13a1 1 0 0 1 .775-.05l.984.34c.078.028.16.044.243.054.784.093.855.377.694.801-.155.41-.616.617-1.035.487l-.01-.003C8.274 4.663 7.748 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 1.96.826 2.166 1.696 2.382.46.115.935.233 1.304.618.449.467.393 1.181.339 1.877C6.755 12.96 6.674 14 8.5 14c1.75 0 3-3.5 3-4.5 0-.262.208-.468.444-.7.396-.392.87-.86.556-1.8-.097-.291-.396-.568-.641-.756-.174-.133-.207-.396-.052-.551a.333.333 0 0 1 .42-.042l1.085.724c.11.072.255.058.348-.035.15-.15.415-.083.489.117.16.43.445 1.05.849 1.357L15 8A7 7 0 1 1 3.668 2.501Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <input type="checkbox" name="_libelleTypeContenair" id="_libelleTypeContenair" data-cible="libelleTypeContainer" >
                        <label for="libelleTypeContenair">inclure le nom du container</label>
                </div>
                <div class="col-3"> 

                    <select class="form-control" disabled id="libelleTypeContainer" name="libelleTypeContainer" placeholder="libelleTypeContainer">
                        <?php
                            $listeContainer = obtenirCollectionDeContainers(); //fonction pour obtenir la liste des containers
                            foreach ($listeContainer as $typeDeContainer):
                        ?>
                        <option value="<?php echo $typeDeContainer["libelleTypeContainer"]; ?>"><?php echo $typeDeContainer["libelleTypeContainer"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="col-5">
                    <input type="checkbox" name="_masseEnTonne" id="_masseEnTonne" data-cible="masseEnTonne"  >
                        <label for="masseEnTonne">inclure une masse en tonne</label>
                </div>
                <div class="col-3"> 
                    <input type="text" class="w-100"  disabled  id="masseEnTonne" name="masseEnTonne"
                           name="masseEnTonne" pattern="/^[0-9\.]{0,10}$/" title="Veilliez saisir correctement une masse, par exemple : 1.402">
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="col-5">
                    <input type="checkbox" name="_volumeEnMetreCube" id="_volumeEnMetreCube" data-cible="volumeEnMetreCube"  >
                        <label for="volumeEnMetreCube">inclure un volume en mettre cube</label>
                </div>
                <div class="col-3"> 
                    <input type="text" class="w-100"  disabled  id="volumeEnMetreCube"  name="volumeEnMetreCube"
                           name="volumeEnMetreCube" pattern="^[0-9\.]{0,7}$" title="Veilliez saisir correctement le volume, par exemple : 14.00">
                </div>
            </div>
            
            <div class="row mt-2">
                <div class="col-5">
                    <input type="checkbox" name="_tarifJour" id="_tarifJour" data-cible="tarifJour"  >
                        <label for="tarifJour">inclure un tarif du jour</label>
                </div>
                <div class="col-3"> 
                    <input type="text" class="w-100"  disabled  id="tarifJour" name="tarifJour" 
                           pattern="^[0-9\.]{0,8}$" title="Veilliez saisir correctement, par exemple : 10.45">
                </div>
            </div>
            
            <div class="row m-5">
                <div class="col text-center">
                    <button class="btn btn-outline-secondary" type="submit"   id="button-addon 2 "> Rechercher</button>
                </div>
            </div>
            
        </form>
    </div>
</div>

<script>
    //L'ensemble des objets html "input" de type checkbox sont sélectionnés
    var checkboxes = document.querySelectorAll('input[type=checkbox]'),
            //et placer dans une variable de type tableau
            checkboxArray = Array.from(checkboxes);

    function checkboxChangeEvent() {
        //le mot clé this fait référence à une case à cocher dont l'état à changer
        //L'attribut "data-cible" retourne la valeur associée à l'attribut "data" défini dans l'objet html checkbox
        var cible = this.getAttribute("data-cible");
        //la case à cocher active ou désactive le champ de saisi associé
        if (!this.checked) {
            document.getElementById(cible).setAttribute('disabled', '');
        } else {
            document.getElementById(cible).removeAttribute('disabled');
        }
    }
    /* Le tableau des objets contenant les objets html "input" de type checkbox est parcouru
     * A chaque itération, une fonction anonyme est appelée
     * Celle-ci ajoute un traitement (une fonction nommée "checkboxChangeEvent") associée à l'événement "change"
     * Cet événement correspond à un changement d'état d'une checkbox (cocher ou non).
     */
    checkboxArray.forEach(function (checkbox) {
        checkbox.addEventListener('change', checkboxChangeEvent);
    });
</script>



<?php include_once '_fin.inc.php'; ?>