
# Application THOLDI

## Application de gestion des réservations
v0.10.0

Authentification / Déconnection OK
Effectuer une reservation OK
Consulter ses réservations OK
Rechercher une réservation selon critères (3 seuls implémentés) OK
Consulter Container OK
Rechercher un container selon critère OK (4 implémenter) mid OK (doublure)
Mention légal ok
Création devis ok 
Consultation devis ok
Validation devis ok


## INSTALLATION DE L'APPLICATION SOUS LINUX 
### L'installation est réalisée depuis l'invite de commande (terminal)

>Téléchargement du code source 

    cd /var/www/html  
    git clone https://bitbucket.org/_SoDy/tholdi-appli-resa-web-labo-etudiant.git tholdi-appli-resa-web
    cd /tholdi-appli-resa-web

> Mise en place des fichiers de logs

	mkdir logs
	touch logs/exception.log  logs/error.log logs/current_log
	chown -R dev:www-data logs/
	chmod 755 logs/
	chmod 664 logs/*

## INSTALLATION DE LA BASE DE DONNÉES

Prérequis: Environnement web fonctionnel (et démarré le cas échéant)
Dans le fichier _config.inc.php, vérifiez les informations d'accès à MYSQL déclarées sous la forme de constantes
Depuis votre navigateur, accédez à l'adresse http://localhost/tholdi-appli-resa-web/script-bd/install.php

