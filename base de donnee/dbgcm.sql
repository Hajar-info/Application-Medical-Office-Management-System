-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 19 oct. 2024 à 05:36
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbgcm`
--

-- --------------------------------------------------------

--
-- Structure de la table `analysemedicale`
--

CREATE TABLE `analysemedicale` (
  `CodeAnalyseMed` int(11) NOT NULL,
  `DateAnalyseMed` date NOT NULL,
  `DescriptionAnalyse` varchar(250) NOT NULL,
  `NumDossierPat` int(11) NOT NULL,
  `NumIdMedecin` int(11) NOT NULL,
  `MatricTechnicien` int(11) NOT NULL,
  `IdTypeAnalyse` int(11) NOT NULL,
  `EtatAnalyse` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `NumConsultation` int(11) NOT NULL,
  `Date_Consultation` date NOT NULL,
  `Date_Rendez_Vous` date NOT NULL,
  `DescriptConsultation` varchar(50) NOT NULL,
  `NumDossierPat` int(11) NOT NULL,
  `NumIdMedecin` int(11) NOT NULL,
  `EtatConsultation` varchar(255) NOT NULL,
  `IdTypeConsultation` int(11) NOT NULL,
  `NumSalle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `NumIdMedecin` int(11) NOT NULL,
  `NomMedecin` varchar(50) NOT NULL,
  `PrenomMedecin` varchar(50) NOT NULL,
  `date_naiss_medecin` date NOT NULL,
  `SpecialiteMedecin` varchar(255) NOT NULL,
  `email_medecin` varchar(50) NOT NULL,
  `telephoneMedecin` varchar(250) NOT NULL,
  `adresseMedecin` varchar(60) NOT NULL,
  `IdSpecialite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`NumIdMedecin`, `NomMedecin`, `PrenomMedecin`, `date_naiss_medecin`, `SpecialiteMedecin`, `email_medecin`, `telephoneMedecin`, `adresseMedecin`, `IdSpecialite`) VALUES
(12, 'AOUNI', 'LEILA', '1988-05-31', '', 'aouni@gmail.com', '09875422', 'Rabat', 15),
(13, 'Hakimi', 'Majid', '1975-05-31', '', 'majid@gmail.com', '09875427890', 'Rabat', 18);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `IdMedicament` int(11) NOT NULL,
  `NomMedicament` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`IdMedicament`, `NomMedicament`) VALUES
(1, ' KARDEGIC'),
(2, ' DAFALGAN'),
(3, 'IMODIUM'),
(4, 'LEVOTHYROX'),
(6, 'SPASFON'),
(7, 'IMODIUM'),
(8, 'DOLIPRANE'),
(9, 'SPEDIFEN '),
(10, 'FORLAX'),
(11, 'DAFLON'),
(12, 'PLAVIX'),
(13, 'VENTOLINE '),
(14, 'ASPEGIC'),
(15, 'ATARAX'),
(16, 'DIAMICRON '),
(17, 'AMLOR '),
(18, 'BETADINE');

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

CREATE TABLE `ordonnance` (
  `CodeOrdonnance` int(11) NOT NULL,
  `DateOrdonnance` date NOT NULL,
  `DetailOrdonnance` varchar(255) NOT NULL,
  `NumDossierPat` int(11) NOT NULL,
  `NumIdMedecin` int(11) NOT NULL,
  `NumConsultation` int(11) NOT NULL,
  `medicaments` varchar(255) NOT NULL,
  `posologie` varchar(255) NOT NULL,
  `nbrUnite` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ordonnance`
--

INSERT INTO `ordonnance` (`CodeOrdonnance`, `DateOrdonnance`, `DetailOrdonnance`, `NumDossierPat`, `NumIdMedecin`, `NumConsultation`, `medicaments`, `posologie`, `nbrUnite`) VALUES
(22, '2024-10-17', '____', 20, 12, 17, 'SPASFON', '____', 2);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `NumDossierPat` int(16) NOT NULL,
  `NomPatient` varchar(15) NOT NULL,
  `PrenomPatient` varchar(15) NOT NULL,
  `DateNaissPat` date NOT NULL,
  `SexePatient` varchar(15) NOT NULL,
  `StatutMatriPat` varchar(50) NOT NULL,
  `ProfessPatient` varchar(50) NOT NULL,
  `PoidsPatient` varchar(40) NOT NULL,
  `TensionPatient` varchar(50) NOT NULL,
  `TemperPatient` varchar(50) NOT NULL,
  `Teleph1Patient` varchar(250) NOT NULL,
  `Teleph2Patient` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`NumDossierPat`, `NomPatient`, `PrenomPatient`, `DateNaissPat`, `SexePatient`, `StatutMatriPat`, `ProfessPatient`, `PoidsPatient`, `TensionPatient`, `TemperPatient`, `Teleph1Patient`, `Teleph2Patient`) VALUES
(18, 'Alami', 'Jasmine', '1999-05-01', '', 'Qartaj Str 39', 'professor', '67KG', '6', '37C', '0987764322', '0982273838'),
(20, 'Han', 'Emiley', '2000-05-24', '', 'Flower str 34', 'Professor', '90KG', '6', '37°C', '0987764322', '0982273838');

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `RefRecu` int(11) NOT NULL,
  `TypeRecu` varchar(255) NOT NULL,
  `MontantRecu` varchar(255) NOT NULL,
  `DateRecu` date NOT NULL,
  `NumDossierPat` int(11) NOT NULL,
  `NumIdSecretaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `resultatanalyse`
--

CREATE TABLE `resultatanalyse` (
  `RefResultatAnalyse` int(11) NOT NULL,
  `DescriptionResultat` varchar(250) NOT NULL,
  `CodeAnalyseMed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `NumSalle` int(11) NOT NULL,
  `NomSalle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`NumSalle`, `NomSalle`) VALUES
(1, 'salle de  radiologie.'),
(2, 'salle d ophtalmologie'),
(3, 'salle d urgence'),
(4, 'salle de chirurgie'),
(5, 'salle de réveil'),
(6, 'salle de radiothérapie');

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

CREATE TABLE `secretaire` (
  `NumIdSecretaire` int(11) NOT NULL,
  `NomSecretaire` varchar(255) NOT NULL,
  `PrenomSecretaire` varchar(255) NOT NULL,
  `TelephoneSecretaire` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`NumIdSecretaire`, `NomSecretaire`, `PrenomSecretaire`, `TelephoneSecretaire`) VALUES
(1, 'Maliki', 'Nabila', '659741'),
(3, 'ALAMI', 'SARA', '3232255'),
(5, 'ALAOUI', 'AICHA', '0987654');

-- --------------------------------------------------------

--
-- Structure de la table `specialite`
--

CREATE TABLE `specialite` (
  `IdSpecialite` int(11) NOT NULL,
  `NomSpecialite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`IdSpecialite`, `NomSpecialite`) VALUES
(1, 'La cardiologie'),
(2, 'L’allergologie ou l’immunologie'),
(3, 'L’anesthésiologie'),
(4, 'La chirurgie'),
(5, 'La dermatologie'),
(6, 'La gastro-entérologie'),
(7, 'La gériatrie'),
(8, 'La gynécologie'),
(9, 'La médecine générale'),
(10, 'La néonatologie'),
(11, 'La neurologie'),
(12, 'L’odontologie'),
(13, 'L’ophtalmologie'),
(14, 'La psychiatrie'),
(15, 'La radiologie'),
(16, 'La radiothérapie'),
(18, 'La rhumatologie');

-- --------------------------------------------------------

--
-- Structure de la table `technicien`
--

CREATE TABLE `technicien` (
  `MatricTechnicien` int(11) NOT NULL,
  `NomTechnicien` varchar(50) NOT NULL,
  `PrenomTechnicien` varchar(50) NOT NULL,
  `TelephoneTechnicien` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `technicien`
--

INSERT INTO `technicien` (`MatricTechnicien`, `NomTechnicien`, `PrenomTechnicien`, `TelephoneTechnicien`) VALUES
(2, 'aaouni', 'hamid', '09875433');

-- --------------------------------------------------------

--
-- Structure de la table `typeanalyse`
--

CREATE TABLE `typeanalyse` (
  `IdTypeAnalyse` int(11) NOT NULL,
  `LibelleAnalyse` varchar(255) NOT NULL,
  `PrixAnalyse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typeanalyse`
--

INSERT INTO `typeanalyse` (`IdTypeAnalyse`, `LibelleAnalyse`, `PrixAnalyse`) VALUES
(3, 'L’hématologie', '200'),
(4, 'La biochimie', '100'),
(5, 'dosimétrie', '400'),
(6, 'L’allergologie', '600');

-- --------------------------------------------------------

--
-- Structure de la table `typeconsultation`
--

CREATE TABLE `typeconsultation` (
  `IdTypeConsultation` int(11) NOT NULL,
  `LibelleConsultation` varchar(255) NOT NULL,
  `PrixConsultation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typeconsultation`
--

INSERT INTO `typeconsultation` (`IdTypeConsultation`, `LibelleConsultation`, `PrixConsultation`) VALUES
(4, 'PERIODIQUE', '400'),
(5, 'GENERALE', '200');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Iduser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','medecin','secretaire') NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Iduser`, `username`, `email`, `password`, `role`, `message`) VALUES
(5, 'Secretaire ', 'secretaire@gmail.com', '2405d33c5a2347a96b79cab84742425372eb93fc8fd65b59c82d903575d46d8c', 'secretaire', ''),
(17, 'medecin', 'medecin@gmail.com', '65ddffa46968972563cd09aecd8473dd5cd5290eca9f5041bd5a35a711b0631e', 'medecin', ''),
(20, 'admin', 'admin@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', '');

-- --------------------------------------------------------

--
-- Structure de la table `usersm`
--

CREATE TABLE `usersm` (
  `IduserM` int(11) NOT NULL,
  `usernameM` varchar(255) NOT NULL,
  `emailM` varchar(255) NOT NULL,
  `passwordM` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `userss`
--

CREATE TABLE `userss` (
  `IduserS` int(11) NOT NULL,
  `usernameS` varchar(255) NOT NULL,
  `emailS` varchar(255) NOT NULL,
  `passwordS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `analysemedicale`
--
ALTER TABLE `analysemedicale`
  ADD PRIMARY KEY (`CodeAnalyseMed`),
  ADD KEY `NumDossierPat` (`NumDossierPat`,`NumIdMedecin`,`MatricTechnicien`),
  ADD KEY `IdTypeAnalyse` (`IdTypeAnalyse`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`NumConsultation`),
  ADD KEY `NumDossierPat` (`NumDossierPat`),
  ADD KEY `NumIdMedecin` (`NumIdMedecin`),
  ADD KEY `IdTypeConsultation` (`IdTypeConsultation`),
  ADD KEY `NumSalle` (`NumSalle`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`NumIdMedecin`),
  ADD KEY `IdSpecialite` (`IdSpecialite`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`IdMedicament`);

--
-- Index pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD PRIMARY KEY (`CodeOrdonnance`),
  ADD KEY `NumDossierPat` (`NumDossierPat`,`NumIdMedecin`,`NumConsultation`),
  ADD KEY `NumConsultation` (`NumConsultation`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`NumDossierPat`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`RefRecu`),
  ADD KEY `NumDossierPat` (`NumDossierPat`,`NumIdSecretaire`);

--
-- Index pour la table `resultatanalyse`
--
ALTER TABLE `resultatanalyse`
  ADD PRIMARY KEY (`RefResultatAnalyse`),
  ADD KEY `CodeAnalyseMed` (`CodeAnalyseMed`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`NumSalle`);

--
-- Index pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`NumIdSecretaire`);

--
-- Index pour la table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`IdSpecialite`);

--
-- Index pour la table `technicien`
--
ALTER TABLE `technicien`
  ADD PRIMARY KEY (`MatricTechnicien`);

--
-- Index pour la table `typeanalyse`
--
ALTER TABLE `typeanalyse`
  ADD PRIMARY KEY (`IdTypeAnalyse`);

--
-- Index pour la table `typeconsultation`
--
ALTER TABLE `typeconsultation`
  ADD PRIMARY KEY (`IdTypeConsultation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Iduser`);

--
-- Index pour la table `usersm`
--
ALTER TABLE `usersm`
  ADD PRIMARY KEY (`IduserM`);

--
-- Index pour la table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`IduserS`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `analysemedicale`
--
ALTER TABLE `analysemedicale`
  MODIFY `CodeAnalyseMed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `NumConsultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `NumIdMedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `IdMedicament` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  MODIFY `CodeOrdonnance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `NumDossierPat` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `RefRecu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `resultatanalyse`
--
ALTER TABLE `resultatanalyse`
  MODIFY `RefResultatAnalyse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `NumSalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `secretaire`
--
ALTER TABLE `secretaire`
  MODIFY `NumIdSecretaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `IdSpecialite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `technicien`
--
ALTER TABLE `technicien`
  MODIFY `MatricTechnicien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typeanalyse`
--
ALTER TABLE `typeanalyse`
  MODIFY `IdTypeAnalyse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `typeconsultation`
--
ALTER TABLE `typeconsultation`
  MODIFY `IdTypeConsultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `usersm`
--
ALTER TABLE `usersm`
  MODIFY `IduserM` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `userss`
--
ALTER TABLE `userss`
  MODIFY `IduserS` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
