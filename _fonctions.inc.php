<?php

include_once './config/_config.inc.php';

/**
 * retourne un objet PDO configuré
 * 
 * @return \PDO Une instance permettant l'accès à la base de données dont les paramètres d'accès ont été définis dans le fichier de fonfiguration de l'application
 * @throws PDOException Lève une exception si le gestionnaire n'a pu être initialisé (base de données inaccessible par exemple)
 *  
 */
function gestionnaireDeConnexion() {
    //LOCAL
    $pdo = new PDO(
            CONFIG["db"]["db_engine"] . ':host=' . CONFIG["db"]["db_host"] . ';dbname=' . CONFIG["db"]["db_name"],
            CONFIG["db"]["db_user"],
            CONFIG["db"]["db_password"],
            array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
    );
    //Production
//    $pdo = new PDO(
//            CONFIG["db_prod"]["db_engine"] . ':host=' . CONFIG["db_prod"]["db_host"] . ';dbname=' . CONFIG["db_prod"]["db_name"],
//            CONFIG["db_prod"]["db_user"],
//            CONFIG["db_prod"]["db_password"],
//            array(
//        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
//        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//            )
//    );
    return $pdo;
}

/**
 * retourne une collection contenant l'ensemble des containers proposés par l'entreprise
 *
 * @return Array la collection de containers proposés par l'entreprise
 */
function obtenirCollectionDeContainers() {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "select * from typeContainer";
    $pdoStatement = $pdo->query($requeteSql);
    $collectionDeContainers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $collectionDeContainers;
}

/**
 * retourne l'ensemble des containers qui contiennent le libelle saisi
 *
 * @param string $chaineRecherchee la chaine utilisée pour rechercher un ou plusieurs type de containers
 * @return Array collection de containers
 */
//function rechercherCollectionDeContainersParLibelle($chaineRecherchee) {
//    $pdo = gestionnaireDeConnexion();
//    $requeteSql = "select * from typeContainer where libelleTypeContainer like  :chaineRecherchee ";
//    $pdoStatement = $pdo->prepare($requeteSql);
//    $pdoStatement->bindValue(":chaineRecherchee", "%" . $chaineRecherchee . "%");
//    $pdoStatement->execute();
//    $collectionDeContainersParLibelle = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
//    return $collectionDeContainersParLibelle;
//}

/**
 * retourne une collection contenant l'ensemble des villes utilisées dans l'application
 * 
 * @return Array collection des villes de l'application
 */
function obtenirLaCollectionDesVilles() {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "select * from ville";
    $pdoStatement = $pdo->query($requeteSql);
    $collectionDesVilles = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    return $collectionDesVilles;
}


/**
 * Ajoute une réservation de container
 * 
 * @see les lignes de réservations sont ajoutées via la fonction insererUneLigneDeReservation
 * 
 * @param array $uneReservation les données relatives à une réservation
 * @return mixed le code de la réservation insérée
 */
function ajouterUneReservation(Array $uneReservation) {

    $pdo = gestionnaireDeConnexion();
    $requeteSql = "insert into reservation (codeUtilisateur,dateDebutReservation,dateFinReservation,"
            . " volumeEstime,codeVilleMiseDispo,codeVilleRendre,dateReservation) "
            . " values (:codeUtilisateur,:dateDebut,:dateFin,:volumeEstime,:villeDepart,:villeArrivee,:dateReservation)";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(":codeUtilisateur", $uneReservation["codeUtilisateur"]);
    $pdoStatement->bindValue(":dateDebut", $uneReservation["dateDebut"]);
    $pdoStatement->bindValue(":volumeEstime", $uneReservation["volumeEstime"]);
    $pdoStatement->bindValue(":villeDepart", $uneReservation["villeDepart"]);
    $pdoStatement->bindValue(":villeArrivee", $uneReservation["villeArrivee"]);
    $pdoStatement->bindValue(":dateReservation", $uneReservation["dateReservation"]);
    $pdoStatement->bindValue(":dateFin", $uneReservation["dateFin"]);
    $pdoStatement->execute();
    return $pdo->lastInsertId();
}

/**
 * Insère une ligne de réservation
 * 
 * @param string $codeReservation Le code de la réservation
 * @param string $typeContainer Le type de container réservé
 * @param string $quantite La quantité de container réservé
 */
function insererUneLigneDeReservation($codeReservation, $codeTypeContainer, $quantite) {

    $pdo = gestionnaireDeConnexion();
    $requeteSql = "insert into reserver (codeReservation,codeTypeContainer,qteReserver) "
            . "values (:codeReservation,:codeTypeContainer,:quantite)";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindParam(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->bindParam(':codeTypeContainer', $codeTypeContainer, PDO::PARAM_STR);
    $pdoStatement->bindParam(':quantite', $quantite, PDO::PARAM_STR);
    $pdoStatement->execute();
    $pdoStatement->closeCursor();
}

/**
 * retourne les informations d'un compte utilisateur
 * 
 * @param string $identifiant l'identifiant utilisateur
 * @return Array|false retourne les informations d'un utilisateur en cas de succès false dans le cas contraire
 */
function obtenirCompteUtilisateur($identifiant) {
    $compteExistant = false;
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "SELECT * FROM utilisateur "
            . " WHERE identifiant=:identifiant ";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $pdoStatement->execute();
    $resultat = $pdoStatement->fetch();
    if (is_array($resultat) && count($resultat) > 0) {
        $compteExistant = $resultat;
    }
    $pdoStatement->closeCursor();

    return $compteExistant;
}

/**
 * Retourne les réservations de containers d'un client donné
 * 
 * @param string $codeUtilisateur Le code utilisateur du client concerné
 * @return array une collection de réservation de containers 
 */
function obtenirCollectionDeReservationsPourUnClient($codeUtilisateur) {

    $pdo = gestionnaireDeConnexion();
    $requeteSql = "SELECT reservation.*, v1.nomVille as nomVilleMiseDispo, v2.nomVille as nomVilleRendre 
        FROM reservation, ville v1, ville v2  
        WHERE reservation.codeUtilisateur=:codeUtilisateur 
        and reservation.codeVilleMiseDispo = v1.codeVille 
        and reservation.codeVilleRendre = v2.codeVille
        order by  reservation.dateReservation desc
        ";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->execute();
    $collectionDeReservationsPourUnClient = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $pdoStatement->closeCursor();
    return $collectionDeReservationsPourUnClient;
}



/**
 * Retourne les données d'une réservation client
 * 
 * @param string $codeUtilisateur un code client
 * @param string $codeReservation le code d'une réservation
 * @return Array le détail d'une réservation client
 */
function obtenirDetailDeUneReservationPourUnClient($codeUtilisateur, $codeReservation) {

    $pdo = gestionnaireDeConnexion();
    $requeteSql = "select reservation.*, typeContainer.*, reserver.*, 
        v1.nomVille as nomVilleMiseDispo, v2.nomVille as nomVilleRendre,
        qteReserver * tarifJour as montantLigneDeReservation,
        datediff(reservation.dateFinReservation,reservation.dateDebutReservation) nombreDeJourDeLocation
        FROM reservation,  ville v1, ville v2, typeContainer, reserver  
        WHERE reservation.codeReservation = :codeReservation
        and reservation.codeUtilisateur = :codeUtilisateur
        and reservation.codeVilleMiseDispo = v1.codeVille 
        and reservation.codeVilleRendre = v2.codeVille
        and reservation.codeReservation = reserver.codeReservation
        and reserver.codeTypeContainer = typeContainer.codeTypeContainer";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->bindParam(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->execute();
    $detailDeUneReservationPourUnClient = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    $pdoStatement->closeCursor();
    return $detailDeUneReservationPourUnClient;
}

/**
 * Retourne un devis client
 * 
 * @param string $codeUtilisateur un code client
 * @param string $codeReservation le code d'une réservation
 * @return Array le détail d'un devis client
 */
function obtenirDetailDeUnDevisPourUnClient($codeUtilisateur, $codeReservation) {

    $pdo = gestionnaireDeConnexion();
    $requeteSql = "select * from devis d
                    join reservation r on r.codeDevis = d.codeDevis
                    where codeUtilisateur=:codeUtilisateur 
                    and codeReservation=:codeReservation
        ";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->execute();
    $detailDeUnDevisPourUnClient = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    $pdoStatement->closeCursor();
    return $detailDeUnDevisPourUnClient;
}


/**
 * Vérifie l'existence d'un devis associé à une réservation client
 * @param type $codeUtilisateur un code client
 * @param type $codeReservation le code d'une réservation
 * @return boolean vrai si le devis existe pour une réservation client donnée, faux dans le cas contraire
 */
function devisExistePourUneReservationPourUnClient($codeUtilisateur, $codeReservation) {
    $devisExiste = false;
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "select * from devis d
                    join reservation r on r.codeDevis = d.codeDevis
                    where codeUtilisateur=:codeUtilisateur 
                    and codeReservation=:codeReservation
        ";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->execute();
    $detailDeUnDevisPourUnClient = $pdoStatement->fetch(PDO::FETCH_ASSOC);

    if ($detailDeUnDevisPourUnClient !== false) {
        $devisExiste = true;
    }
    $pdoStatement->closeCursor();
    return $devisExiste;
}

/**
 * Change l'état d'une réservation 
 * 
 * @param type $codeUtilisateur un code client
 * @param type $codeReservation le code d'une réservation
 * @param type $etat l'état à venir pour la réservation client donnée
 */
function changementEtatDeUneReservationDeUnUtilisateur($codeUtilisateur, $codeReservation, $etat) {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "update reservation set etat = :etat where reservation.codeUtilisateur=:codeUtilisateur"
            . " and reservation.codeReservation = :codeReservation ";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->bindParam(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->bindParam(':etat', $etat, PDO::PARAM_STR);
    $pdoStatement->execute();
    $pdoStatement->closeCursor();
}

function changementEtatDeUnDevisDeUnUtilisateur($codeDevis, $valider) {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "UPDATE devis SET valider = :valider WHERE codeDevis = :codeDevis";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':codeDevis', $codeDevis, PDO::PARAM_INT);
    $pdoStatement->bindValue(':valider', $valider, PDO::PARAM_STR);
    $pdoStatement->execute();
    $pdoStatement->closeCursor();
}

/**
 * Crée le devis d'une réservation
 * 
 * @param type $codeReservation le code de la réservation pour laquelle un devis est créé
 */
function creationDevisPourUneReservation($codeReservation) {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "insert into devis (dateDevis,montantDevis,volume,nbContainers) "
            . " values ("
            . " CURRENT_DATE(),"
            . "     (SELECT sum(r.qteReserver * t.tarifJour * DATEDIFF(rs.dateFinReservation , rs.dateDebutReservation))
                    FROM reservation rs
                    JOIN reserver r on r.codeReservation = rs.codeReservation
                    JOIN typeContainer t on t.codeTypeContainer = r.codeTypeContainer
                    WHERE rs.codeReservation=:codeReservation
                    ),
                    (SELECT reservation.volumeEstime from reservation where codeReservation=:codeReservation),
                    (SELECT sum(r.qteReserver)
                     FROM reservation rs
                     JOIN reserver r on r.codeReservation = rs.codeReservation
                     WHERE rs.codeReservation=:codeReservation
                    )
              )";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->execute();
    $codeDevis = $pdo->lastInsertId();
    $requeteSql = "update reservation set codeDevis=:codeDevis "
            . " where codeReservation=:codeReservation";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':codeDevis', $codeDevis, PDO::PARAM_STR);
    $pdoStatement->bindValue(':codeReservation', $codeReservation, PDO::PARAM_STR);
    $pdoStatement->execute();
}

/**
 * Retourne une date au format jj-mm-aaaa
 * 
 * @param string $date une date dans un format date supportés
 * @link https://www.php.net/manual/fr/datetime.formats.date.php formats dates supportés
 * @return string une date au format jj-mm-aaaa
 */
function dateAuFormatJourMoisAnnee($date) {
    $dateAuFormatJourMoisAnnee = new DateTime($date);
    return $dateAuFormatJourMoisAnnee->format("d-m-Y");
}

/**
 * Recherche de réservation à partir de criteres
 * 
 * @param int|string $codeUtilisateur le code de l'utilisateur
 * @param Array $criteres les critères de recherche sous la forme de clé et de valeur associée
 * @return Array Une collection de réservations répondant aux critères fournis
 */
function rechercheReservationSelonCritere($codeUtilisateur, Array $criteres) {

    $pdo = gestionnaireDeConnexion();
    $criteresMisEnForme = miseEnFormeCriterePourSQL($criteres);
    if (strlen($criteresMisEnForme) > 0) {
        $requeteSql = "SELECT reservation.*, v1.nomVille as nomVilleMiseDispo, v2.nomVille as nomVilleRendre 
        FROM reservation, ville v1, ville v2  
        WHERE reservation.codeUtilisateur=:codeUtilisateur 
        and reservation.codeVilleMiseDispo = v1.codeVille 
        and reservation.codeVilleRendre = v2.codeVille
         " . $criteresMisEnForme;
        $pdoStatement = $pdo->prepare($requeteSql);
        $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
        $pdoStatement->execute();
        $reservationSelonCriteres = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        $pdoStatement->closeCursor();
    } else {
        $reservationSelonCriteres = [];
    }
    return $reservationSelonCriteres;
}

function rechercheContainerSelonCritere($codeUtilisateur, Array $criteres) {

    $pdo = gestionnaireDeConnexion();
    $criteresMisEnForme = miseEnFormeCriterePourSQL($criteres);
    if (strlen($criteresMisEnForme) > 0) {
        $requeteSql = "SELECT DISTINCT typeContainer.*
            FROM typeContainer, reservation
            WHERE reservation.codeUtilisateur=:codeUtilisateur
             " . $criteresMisEnForme;
        $pdoStatement = $pdo->prepare($requeteSql);
        $pdoStatement->bindParam(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
        $pdoStatement->execute();
        $containerSelonCriteres = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        $pdoStatement->closeCursor();
    } else {
        $containerSelonCriteres = [];
    }
    return $containerSelonCriteres;
}

/**
 * formate une chaine de caractères représentant les critères SQL à intégrer à une requête
 * 
 * @param Array $criteres Un tableau contenant les clés et les valeurs à utiliser pour former un critère SQL
 * @return string une chaine de caractères représentant des critères SQL à intégrer à une requête
 */
function miseEnFormeCriterePourSQL(Array $criteres) {
    $criteresSql = "and";
    foreach ($criteres as $key => $value) {
        $criteresSql .= " " . $key . " = '" . $value . "' and";
    }
    return substr($criteresSql, 0, strlen($criteresSql) - 3);
}

function verificationSaisie(string $checkFinal) {
    echo suppressionBaliseJavascript($checkFinal);
    echo strip_tags($checkFinal);
}

function suppressionBaliseJavascript(string $chaine) {
    $cleanString = $chaine;

    while (strpos($cleanString, "<script>") != false) {
        $deb = strpos($cleanString, "<script>");
        $fin = strpos($cleanString, "</script>");

        $cleanString = substr_replace($cleanString, "", $deb, $fin - $deb + 9);
    }

    return $cleanString;
}

function compteUtilisateurEstTemporairementDesactive(array $utilisateur) {
    $compteEstDesactive = false;
    $nbTentativeConnexion = $utilisateur["nbTentativeConnexion"];
    $now = date_create();
    $dateHeure = date_create($utilisateur["dateHeure"]);
    if (date_diff($now, $dateHeure)->i < 10 && $nbTentativeConnexion >= 5) {
        $compteEstDesactive = true;
    }


    return $compteEstDesactive;
}

function echecDeTentativeDeConnexion(array $utilisateur) {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "update utilisateur"
            . " set nbTentativeConnexion = nbTentativeConnexion+1, dateHeure=:dateHeure"
            . " where identifiant=:identifiant";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':identifiant', $utilisateur['identifiant'], PDO::PARAM_STR);
    $pdoStatement->bindValue(':dateHeure', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $pdoStatement->execute();
}

function reinitialisationLeNombreDeTentativesDeConnexion($codeUtilisateur, array $utilisateur) {
    $pdo = gestionnaireDeConnexion();
    $requeteSql = "update utilisateur set nbTentativeConnexion = 0 , dateHeure = NULL"
            . " where identifiant=:identifiant  and codeUtilisateur=:codeUtilisateur";
    $pdoStatement = $pdo->prepare($requeteSql);
    $pdoStatement->bindValue(':identifiant', $utilisateur['identifiant'], PDO::PARAM_STR);
    $pdoStatement->bindValue(':codeUtilisateur', $codeUtilisateur, PDO::PARAM_STR);
    $pdoStatement->execute();
}
