-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : dim. 01 jan. 2023 à 13:31
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tholdi_reservation_appli_resa_web`
--
CREATE DATABASE IF NOT EXISTS `tholdi_reservation_appli_resa_web` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `tholdi_reservation_appli_resa_web`;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `codeDevis` int NOT NULL,
  `dateDevis` date NOT NULL,
  `montantDevis` decimal(10,2) NOT NULL,
  `volume` smallint DEFAULT NULL,
  `nbContainers` smallint DEFAULT NULL,
  `valider` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;



-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `codePays` char(4) NOT NULL DEFAULT '',
  `nomPays` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`codePays`, `nomPays`) VALUES
('AD', 'AND'),
('AE', 'EMI'),
('AF', 'AFG'),
('AG', 'ANT'),
('AL', 'ALB'),
('AM', 'ARM'),
('AN', 'ANT'),
('AO', 'ANG'),
('AR', 'ARG'),
('AT', 'AUT'),
('AU', 'AUS'),
('AZ', 'AZE'),
('BA', 'BOS'),
('BB', 'BAR'),
('BD', 'BAN'),
('BE', 'BEL'),
('BF', 'BUR'),
('BG', 'BUL'),
('BH', 'BAH'),
('BI', 'BUR'),
('BJ', 'BEN'),
('BM', 'BER'),
('BN', 'BRU'),
('BO', 'BOL'),
('BR', 'BRE'),
('BS', 'BAH'),
('BT', 'BHO'),
('BW', 'BOT'),
('BY', 'BEL'),
('BZ', 'BEL'),
('CA', 'CAN'),
('CD', 'CON'),
('CF', 'CEN'),
('CG', 'CON'),
('CH', 'SUI'),
('CI', 'COT'),
('CK', 'COO'),
('CL', 'CHI'),
('CM', 'CAM'),
('CN', 'CHI'),
('CO', 'COL'),
('CR', 'COS'),
('CS', 'SER'),
('CU', 'CUB'),
('CV', 'CAP'),
('CY', 'CHY'),
('CZ', 'TCH'),
('DE', 'ALL'),
('DJ', 'DJI'),
('DK', 'DAN'),
('DM', 'DOM'),
('DO', 'DOM'),
('DZ', 'ALG'),
('EC', 'EQU'),
('EE', 'EST'),
('EG', 'EGY'),
('ER', 'ERY'),
('ES', 'ESP'),
('ET', 'ETH'),
('FI', 'FIN'),
('FJ', 'FID'),
('FM', 'MIC'),
('FR', 'FRA'),
('GA', 'GAB'),
('GB', 'GRA'),
('GD', 'GRE'),
('GE', 'GEO'),
('GH', 'GHA'),
('GI', 'GIB'),
('GM', 'GAM'),
('GN', 'GUI'),
('GQ', 'GUI'),
('GR', 'GRE'),
('GT', 'GUA'),
('GU', 'GUA'),
('GW', 'GUI'),
('GY', 'GUY'),
('HK', 'HON'),
('HN', 'HON'),
('HR', 'CRO'),
('HT', 'HAI'),
('HU', 'HON'),
('ID', 'IND'),
('IE', 'IRL'),
('IL', 'ISR'),
('IN', 'IND'),
('IQ', 'IRA'),
('IR', 'IRA'),
('IS', 'ISL'),
('IT', 'ITA'),
('JM', 'JAM'),
('JO', 'JOR'),
('JP', 'JAP'),
('KE', 'KEN'),
('KG', 'KIR'),
('KH', 'CAM'),
('KI', 'KIR'),
('KM', 'COM'),
('KN', 'SAI'),
('KP', 'COR'),
('KR', 'COR'),
('KW', 'KOW'),
('KZ', 'KAZ'),
('LA', 'LAO'),
('LB', 'LIB'),
('LC', 'SAI'),
('LI', 'LIE'),
('LK', 'SRI'),
('LR', 'LIB'),
('LS', 'LES'),
('LT', 'LIT'),
('LU', 'LUX'),
('LV', 'LET'),
('LY', 'LIB'),
('MA', 'MAR'),
('MC', 'MON'),
('MD', 'MOL'),
('MG', 'MAD'),
('MH', 'MAR'),
('MK', 'MAC'),
('ML', 'MAL'),
('MM', 'MYA'),
('MN', 'MON'),
('MO', 'MAC'),
('MR', 'MAU'),
('MT', 'MAL'),
('MU', 'MAU'),
('MV', 'MAL'),
('MW', 'MAL'),
('MX', 'MEX'),
('MY', 'MAL'),
('MZ', 'MOZ'),
('NA', 'NAM'),
('NE', 'NIG'),
('NG', 'NIG'),
('NI', 'NIC'),
('NL', 'PAY'),
('NO', 'NOR'),
('NP', 'NEP'),
('NR', 'NAU'),
('NU', 'NIU'),
('NZ', 'NOU'),
('OM', 'OMA'),
('PA', 'PAN'),
('PE', 'PER'),
('PG', 'PAP'),
('PH', 'PHI'),
('PK', 'PAK'),
('PL', 'POL'),
('PR', 'POR'),
('PT', 'POR'),
('PW', 'PAL'),
('PY', 'PAR'),
('QA', 'QAT'),
('RO', 'ROU'),
('RU', 'RUS'),
('RW', 'RWA'),
('SA', 'ARA'),
('SB', 'SAL'),
('SC', 'SEY'),
('SD', 'SOU'),
('SE', 'SUE'),
('SG', 'SIN'),
('SI', 'SLO'),
('SK', 'SLO'),
('SL', 'SIE'),
('SM', 'SAI'),
('SN', 'SEN'),
('SO', 'SOM'),
('SR', 'SUR'),
('ST', 'SAO'),
('SV', 'EL '),
('SY', 'SYR'),
('SZ', 'SWA'),
('TD', 'TCH'),
('TG', 'TOG'),
('TH', 'THA'),
('TJ', 'TAD'),
('TL', 'TIM'),
('TM', 'TUR'),
('TN', 'TUN'),
('TO', 'TON'),
('TR', 'TUR'),
('TT', 'TRI'),
('TV', 'TUV'),
('TW', 'TAI'),
('TZ', 'TAN'),
('UA', 'UKR'),
('UG', 'OUG'),
('US', 'ETA'),
('UY', 'URU'),
('UZ', 'OUZ'),
('VA', 'VAT'),
('VC', 'SAI'),
('VE', 'VEN'),
('VN', 'VIE'),
('VU', 'VAN'),
('WS', 'SAM'),
('YE', 'YEM'),
('ZA', 'AFR'),
('ZM', 'ZAM'),
('ZW', 'ZIM');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `codeReservation` int NOT NULL,
  `dateDebutReservation` date NOT NULL,
  `dateFinReservation` date NOT NULL,
  `dateReservation` date NOT NULL,
  `volumeEstime` smallint DEFAULT NULL,
  `codeDevis` int DEFAULT NULL,
  `codeVilleMiseDispo` char(3) NOT NULL,
  `codeVilleRendre` char(3) NOT NULL,
  `codeUtilisateur` int NOT NULL,
  `etat` enum('Demande de réservation','Demande de réservation validée','Réservation en cours','Réservation terminée','Archivé','Annulé') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'Demande de réservation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `codeReservation` int NOT NULL DEFAULT '0',
  `codeTypeContainer` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `qteReserver` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `typeContainer`
--

CREATE TABLE `typeContainer` (
  `codeTypeContainer` char(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `libelleTypeContainer` varchar(30) NOT NULL,
  `longueurEnMillimetre` decimal(5,0) NOT NULL,
  `largeurEnMillimetre` decimal(5,0) NOT NULL,
  `hauteurEnMillimetre` decimal(5,0) NOT NULL,
  `masseEnTonne` decimal(5,3) DEFAULT NULL,
  `volumeEnMetreCube` decimal(4,2) DEFAULT NULL,
  `capaciteDeChargeEnTonne` decimal(5,3) DEFAULT NULL,
  `tarifJour` decimal(5,2) DEFAULT NULL,
  `photo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `typeContainer`
--

INSERT INTO `typeContainer` (`codeTypeContainer`, `libelleTypeContainer`, `longueurEnMillimetre`, `largeurEnMillimetre`, `hauteurEnMillimetre`, `masseEnTonne`, `volumeEnMetreCube`, `capaciteDeChargeEnTonne`, `tarifJour`, `photo`) VALUES
('FLAT', 'Flatracks 40', '12190', '2440', '2590', '4.500', '70.00', '28.000', '74.00', '40-flatrack-high-cube.png'),
('OTOP', 'Open Top 20', '6060', '2440', '2590', '2.250', '33.00', '28.000', '65.00', '20-open-top.jpg'),
('RE20', 'Reefer 20', '6060', '2440', '2590', '3.150', '27.00', '23.000', '48.00', 'reefer_20.png'),
('REEF', 'Reefer 40', '12190', '2440', '2900', '5.650', '54.00', '26.000', '70.00', 'reefer_40.webp');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `codeUtilisateur` int NOT NULL,
  `raisonSociale` varchar(50) NOT NULL,
  `adresse` varchar(80) NOT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` varchar(40) DEFAULT NULL,
  `adrMel` varchar(100) DEFAULT NULL,
  `telephone` char(10) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `codePays` char(4) NOT NULL,
  `identifiant` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `profil` enum('client','gestionnaire') NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`codeUtilisateur`, `raisonSociale`, `adresse`, `cp`, `ville`, `adrMel`, `telephone`, `contact`, `codePays`, `identifiant`, `password`, `profil`) VALUES
(1, 'Entreprise Bernard', '23 allée des accacias', '78600', 'Conflans sainte honorine', 'Ent.Bernard@orange.fr', '0134504215', 'Bernard Jean', 'FR', 'jber', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(2, 'Bouchat et Fils', '12 avenue Foch', '75003', 'Paris', 'Bouchat@gmail.com', '0156854575', 'Martin Philippe', 'FR', 'pmar', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'gestionnaire'),
(3, 'Gondrand', 'route d\'alicante', '23154', 'Valence', 'contact@gondrandValence.com', '0971354499', 'Granjean Maria', 'ES', 'mgra', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(4, 'Agrolait', '69 rue de Chimay', '5478', 'Wavre', 's.l@agrolait.be', '3281588558', 'Sylvie Lelitre', 'BE', 'agrolait', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(5, 'ASUStek', '31 Hong Kong street', '23410', 'Taiwan', 'info@asustek.com', '+ 1 64 61', 'Tang', 'TW', 'asustek', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(6, 'Axelor', '12 rue Albert Einstein', '77420', 'Champs sur Marne', 'info@axelor.com', '+33 1 64 6', 'Laith Jubair', 'FR', 'axelor', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(7, 'BalmerInc S.A.', 'Rue des Palais 51, bte 33', '1000', 'Bruxelles', 'info@balmerinc.be', '(+32)2 211', 'Michel Schumacher', 'BE', 'balmerincs', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(8, 'Bank Wealthy and sons', '1 rue Rockfeller', '75016', 'Paris', 'a.g@wealthyandsons.com', '3368978776', 'Arthur Grosbonnet', 'FR', 'bankwealth', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(9, 'Camptocamp', 'PSE-A, EPFL', '1015', 'Lausanne', '', '+41 21 619', 'Luc Maurer', 'CH', 'camptocamp', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(10, 'Centrale d\'achats BML', '89 Chaussée de Liège', '1000', 'Bruxelles', 'carl.françois@bml.be', '32-258-256', 'Carl François', 'BE', 'centraleac', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(11, 'China Export', '52 Chop Suey street', '47855', 'Shanghai', 'zen@chinaexport.com', '86-751-648', 'Zen', 'CN', 'chinaexpor', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(12, 'Distrib PC', '42 rue de la Lesse', '2541', 'Namur', 'info@distribpc.com', '3208125698', 'Jean Guy Lavente', 'BE', 'distribpc', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(13, 'Dubois sprl', 'Avenue de la Liberté 56', '1000', 'Brussels', 'm.dubois@dubois.be', '', '', 'BE', 'duboissprl', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(14, 'Ecole de Commerce de Liege', '2 Impasse de la Soif', '5478', 'Liege', 'k.lesbrouffe@eci-liege.info', '3242152571', 'Karine Lesbrouffe', 'BE', 'ecoledecom', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(15, 'Elec Import', '23 rue du Vieux Bruges', '2365', 'Brussels', 'info@elecimport.com', '3202589745', 'Etienne Lacarte', 'BE', 'elecimport', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(16, 'Eric Dubois', 'Chaussée de Binche, 27', '7000', 'Mons', 'e.dubois@gmail.com', '(+32).758', 'Eric Dubois', 'BE', 'ericdubois', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(17, 'Fabien Dupont', 'Blvd Kennedy, 13', '5000', 'Namur', '', '', 'Fabien Dupont', 'BE', 'fabiendupo', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(18, 'Leclerc', 'rue Grande', '29200', 'Brest', 'marine@leclerc.fr', '+33-298.33', 'Marine Leclerc', 'FR', 'leclerc', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(19, 'Lucie Vonck', 'Chaussée de Namur', '1367', 'Grand-Rosière', '', '', 'Lucie Vonck', 'BE', 'lucievonck', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(20, 'Magazin BML 1', '89 Chaussée de Liège', '5000', 'Namur', 'lucien.ferguson@bml.be', '-569567', 'Lucien Ferguson', 'BE', 'magazinbml', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(21, 'Maxtor', '56 Beijing street', '23540', 'Hong Kong', 'info@maxtor.com', '1185284567', 'Wong', 'CN', 'maxtor', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(22, 'Mediapole SPRL', 'Rue de l\'Angelique, 1', '1348', 'Louvain-la-Neuve', '', '(+32).10.4', 'Thomas Passot', 'BE', 'mediapoles', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(23, 'NotSoTiny SARL', 'Antwerpsesteenweg 254', '2000', 'Antwerpen', '', '(+32).81.8', 'NotSoTiny SARL', 'BE', 'notsotinys', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(24, 'Seagate', '10200 S. De Anza Blvd', '95014', 'Cupertino', 'info@seagate.com', '1408256987', 'Seagate Technology', 'US', 'seagate', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(25, 'SmartBusiness', 'Palermo, Capital Federal', '1659', 'Buenos Aires', 'contact@smartbusiness.ar', '(5411) 477', 'Jack Daniels', 'AR', 'smartbusin', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(26, 'Syleam', '1 place de l\'Église', '61000', 'Alencon', 'contact@syleam.fr', '+33 (0) 2', 'Sebastien LANGE', 'FR', 'syleam', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(27, 'Tecsas', '85 rue du traite de Rome', '84911', 'Avignon CEDEX 09', 'contact@tecsas.fr', '(+33)4.32.', 'Laurent Jacot', 'FR', 'tecsas', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(28, 'The Shelve House', '25 av des Champs Elysées', '75000', 'Paris', '', '', 'Henry Chard', 'FR', 'theshelveh', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(29, 'Tiny AT Work', 'One Lincoln Street', '5501', 'Boston', 'info@tinyatwork.com', '+33 (0) 2', 'Tiny Work', 'US', 'tinyatwork', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(30, 'Université de Liège', 'Place du 20Août', '4000', 'Liège', 'martine.ohio@ulg.ac.be', '32-4589524', 'Martine Ohio', 'BE', 'université', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(31, 'Vicking Direct', 'Schoonmansveld 28', '2870', 'Puurs', '', '(+32).70.1', 'Leen Vandenloep', 'BE', 'vickingdir', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(32, 'Wood y Wood Pecker', '', '', 'Kainuu', '', '(+358).9.5', 'Roger Pecker', 'FI', 'woodywoodp', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(33, 'ZeroOne Inc', '', '', 'Brussels', '', '', 'Geoff', 'BE', '', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client'),
(40, 'test2', 'test', '75005', 'Paris', 'qsdf@qsdf.fr', '0102030405', 'bob', 'FR', 'test', '$2y$07$ChUcamnbInJfx163fTwfnu4TX8nmyPtmZBVvkCVx2BEuGZIrERofq', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `codeVille` char(3) NOT NULL DEFAULT '',
  `nomVille` varchar(30) NOT NULL,
  `codePays` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`codeVille`, `nomVille`, `codePays`) VALUES
('01', 'Le Havre', 'FR'),
('02', 'Marseille', 'FR'),
('03', 'Gennevilliers', 'FR'),
('04', 'Anvers', 'BE'),
('05', 'Barcelone', 'ES'),
('06', 'Hambourg', 'DE'),
('07', 'Rotterdam', 'NL');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`codeDevis`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`codePays`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`codeReservation`),
  ADD KEY `fk_devis` (`codeDevis`),
  ADD KEY `fk_villeD` (`codeVilleMiseDispo`),
  ADD KEY `fk_villeR` (`codeVilleRendre`),
  ADD KEY `fk_pers` (`codeUtilisateur`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`codeReservation`,`codeTypeContainer`),
  ADD KEY `fk_codtyp` (`codeTypeContainer`);

--
-- Index pour la table `typeContainer`
--
ALTER TABLE `typeContainer`
  ADD PRIMARY KEY (`codeTypeContainer`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`codeUtilisateur`),
  ADD UNIQUE KEY `login` (`identifiant`),
  ADD KEY `fk_perspays` (`codePays`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`codeVille`),
  ADD KEY `fk_pays` (`codePays`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `codeDevis` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `codeReservation` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `codeUtilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_pers` FOREIGN KEY (`codeUtilisateur`) REFERENCES `utilisateur` (`codeUtilisateur`),
  ADD CONSTRAINT `fk_villeD` FOREIGN KEY (`codeVilleMiseDispo`) REFERENCES `ville` (`codeVille`),
  ADD CONSTRAINT `fk_villeR` FOREIGN KEY (`codeVilleRendre`) REFERENCES `ville` (`codeVille`),
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`codeDevis`) REFERENCES `devis` (`codeDevis`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `fk_codres` FOREIGN KEY (`codeReservation`) REFERENCES `reservation` (`codeReservation`),
  ADD CONSTRAINT `fk_codtyp` FOREIGN KEY (`codeTypeContainer`) REFERENCES `typeContainer` (`codeTypeContainer`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_perspays` FOREIGN KEY (`codePays`) REFERENCES `pays` (`codePays`);

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `fk_pays` FOREIGN KEY (`codePays`) REFERENCES `pays` (`codePays`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;