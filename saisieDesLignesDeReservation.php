<?php
include_once '_debut.inc.php';
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
                    SELECTIONNEZ VOS CONTAINERS
                </h2>
            </div>

        </div>



        <form action="traitement.saisieDesLignesDeReservation.php" method="post">
            <div class="row ">
                <div class="col offset-1">
                    <label for="typeContainer" class="form-label">Type de container</label>
                    <select name="codeTypeContainer" id="typeContainer" class="me-3" required>
                        <?php
                        $collectionContainers = obtenirCollectionDeContainers();
                        foreach ($collectionContainers as $unContainer):
                            ?>
                            <option value="<?php echo $unContainer["codeTypeContainer"] ?>"> 
                                <?php echo $unContainer["libelleTypeContainer"] ?>
                            </option>

                        <?php endforeach; ?>
                    </select>   


                </div>
                <div class="col">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" id="quantite" min="0" required/>
                </div>
            </div> 
            <div class="row mt-5 mb-5">
                <div class="col-4 offset-4">
                    <button type="submit"  class="bg-opacity-50 bg-success rounded text-uppercase" >
                        Ajoutez un container
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mt-5 mb-5">
    <div class="col-7 offset-4 shadow">
        <div class="row mb-3 text-center">
            <div class="col ">
                <h2 class="mb-3">
                    CONTAINERS SELECTIONNES
                </h2>
                
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-8 offset-2">
                <table class="table table-sm table-striped">
                    <?php
                    if (isset($_SESSION["ligneDeReservation"])):
                        foreach ($_SESSION["ligneDeReservation"] as $key => $value):
                            ?>
                            <tr>
                                <td>
                                    <?php echo $key; ?>
                                </td>
                                <td>
                                    <?php echo $value; ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </table>
            </div>
        </div>

        <div class="row mt-5 mb-5">
            <div class="col-4 offset-4">
                <form action="traitement.validationReservationContainer.php" method="post">
                    <button type="submit" class="bg-opacity-50 bg-success rounded text-uppercase">
                        Validez la r&eacute;servation
                    </button>
                </form>   
            </div>
        </div>

    </div>
</div>


<?php include_once '_fin.inc.php'; ?>