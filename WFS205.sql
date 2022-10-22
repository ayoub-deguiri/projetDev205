SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `absence` (
  `idAbsence` int(11) NOT NULL,
  `dateAbsence` date DEFAULT NULL,
  `heureAbsence` time DEFAULT NULL,
  `moduleAbsence` varchar(45) DEFAULT NULL,
  `formateurAbsence` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `annee_idAnnee` int(11) DEFAULT NULL,
  `filiere_idFiliere` int(11) DEFAULT NULL,
  `groupe_idGroupe` int(11) DEFAULT NULL,
  `anneeScolaire_idAnneeScolaire` int(11) DEFAULT NULL,
  `idStagiaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `annee` (
  `idAnnee` int(11) NOT NULL,
  `nomAnnee` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `anneescolaire` (
  `idAnneeScolaire` int(11) NOT NULL,
  `nomAnneeScolaire` varchar(45) DEFAULT NULL,
  `annee_idAnnee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `compte` (
  `user` int(11) NOT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `filiere` (
  `idFiliere` int(11) NOT NULL,
  `nomFiliere` varchar(45) DEFAULT NULL,
  `anneescolaire_idAnneeScolaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL,
  `nomGroupe` varchar(45) DEFAULT NULL,
  `filiere_idFiliere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `justifierabsence` (
  `idAbsence` int(11) NOT NULL,
  `Justifier` varchar(45) DEFAULT NULL,
  `motif` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `note` (
  `idStagiaire` int(11) NOT NULL,
  `Note` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `stagiaire` (
  `idStagiaire` int(11) NOT NULL,
  `nomStagiaire` varchar(45) DEFAULT NULL,
  `prenomStagiaire` varchar(45) DEFAULT NULL,
  `groupe_idGroupe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `absence`
  ADD PRIMARY KEY (`idAbsence`),
  ADD KEY `fk_absence_annee` (`annee_idAnnee`),
  ADD KEY `fk_absence_filiere` (`filiere_idFiliere`),
  ADD KEY `fk_absence_anneescolaire` (`anneeScolaire_idAnneeScolaire`),
  ADD KEY `fk_absence_groupe` (`groupe_idGroupe`),
  ADD KEY `fk_absence_stagiaire` (`idStagiaire`);

ALTER TABLE `annee`
  ADD PRIMARY KEY (`idAnnee`);

ALTER TABLE `anneescolaire`
  ADD PRIMARY KEY (`idAnneeScolaire`);

ALTER TABLE `compte`
  ADD PRIMARY KEY (`user`);

ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`),
  ADD KEY `fk_filiere_anneescolaire` (`anneescolaire_idAnneeScolaire`);

ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idGroupe`),
  ADD KEY `fk_groupe_filiere` (`filiere_idFiliere`);

ALTER TABLE `justifierabsence`
  ADD PRIMARY KEY (`idAbsence`);

ALTER TABLE `note`
  ADD PRIMARY KEY (`idStagiaire`);

ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`idStagiaire`),
  ADD KEY `fk_stagiaire_groupe` (`groupe_idGroupe`);


ALTER TABLE `absence`
  MODIFY `idAbsence` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `annee`
  MODIFY `idAnnee` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `anneescolaire`
  MODIFY `idAnneeScolaire` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `compte`
  MODIFY `user` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `filiere`
  MODIFY `idFiliere` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `groupe`
  MODIFY `idGroupe` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `justifierabsence`
  MODIFY `idAbsence` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `note`
  MODIFY `idStagiaire` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stagiaire`
  MODIFY `idStagiaire` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `absence`
  ADD CONSTRAINT `fk_absence_annee` FOREIGN KEY (`annee_idAnnee`) REFERENCES `annee` (`idAnnee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absence_anneescolaire` FOREIGN KEY (`anneeScolaire_idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absence_filiere` FOREIGN KEY (`filiere_idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absence_groupe` FOREIGN KEY (`groupe_idGroupe`) REFERENCES `groupe` (`idGroupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absence_stagiaire` FOREIGN KEY (`idStagiaire`) REFERENCES `stagiaire` (`idStagiaire`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `compte`
  ADD CONSTRAINT `fk_compte_stagiaire` FOREIGN KEY (`user`) REFERENCES `stagiaire` (`idStagiaire`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `filiere`
  ADD CONSTRAINT `fk_filiere_anneescolaire` FOREIGN KEY (`anneescolaire_idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `groupe`
  ADD CONSTRAINT `fk_groupe_filiere` FOREIGN KEY (`filiere_idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `justifierabsence`
  ADD CONSTRAINT `fk_JustifierAbsence_absence` FOREIGN KEY (`idAbsence`) REFERENCES `absence` (`idAbsence`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `note`
  ADD CONSTRAINT `fk_note_stagiaire` FOREIGN KEY (`idStagiaire`) REFERENCES `stagiaire` (`idStagiaire`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `stagiaire`
  ADD CONSTRAINT `fk_stagiaire_groupe` FOREIGN KEY (`groupe_idGroupe`) REFERENCES `groupe` (`idGroupe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
