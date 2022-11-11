-- phpMyAdmin SQL Dump

-- version 5.2.0

-- https://www.phpmyadmin.net/

--

-- Host: 127.0.0.1

-- Generation Time: Nov 11, 2022 at 06:15 PM

-- Server version: 10.4.25-MariaDB

-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Database: `wfs205`

--

DELIMITER $$

--

-- Functions

--

CREATE DEFINER =`ROOT`@`LOCALHOST` FUNCTION `CHECK_FORMATUER`
(`DATAIN` VARCHAR(50)) RETURNS INT(11) DETERMINISTIC 
BEGIN 
	DECLARE state int ;
	if exists (
	    select formateur.Matricule
	    from formateur
	    where
	        formateur.Matricule = datain
	) then
	set state = 1;
	else set state = -1;
	end if ;
	RETURN state;
END$ 

$ 

DELIMITER ;

-- --------------------------------------------------------

--

-- Table structure for table `absence`

--

CREATE TABLE
    `absence` (
        `idAbsence` int(11) NOT NULL,
        `dateAbsence` date DEFAULT NULL,
        `heureDebutAbsence` time DEFAULT NULL,
        `heureFinAbsence` time DEFAULT NULL,
        `moduleAbsence` varchar(45) DEFAULT NULL,
        `matricule` varchar(45) DEFAULT NULL,
        `type` varchar(45) DEFAULT NULL,
        `idAnnee` int(11) DEFAULT NULL,
        `idFiliere` int(11) DEFAULT NULL,
        `idGroupe` int(11) DEFAULT NULL,
        `idAnneeScolaire` int(11) DEFAULT NULL,
        `CEF` varchar(50) DEFAULT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--

-- Table structure for table `annee`

--

CREATE TABLE
    `annee` (
        `idAnnee` int(11) NOT NULL,
        `nomAnnee` varchar(40) NOT NULL,
        `idAnneeScolaire` int(11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `annee`

--

INSERT INTO
    `annee` (
        `idAnnee`,
        `nomAnnee`,
        `idAnneeScolaire`
    )
VALUES (1, '1ere Annee', 1), (2, '2eme Annee', 1), (3, '3eme  Annee', 1);

-- --------------------------------------------------------

--

-- Table structure for table `anneescolaire`

--

CREATE TABLE
    `anneescolaire` (
        `idAnneeScolaire` int(11) NOT NULL,
        `nomAnneeScolaire` varchar(40) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `anneescolaire`

--

INSERT INTO
    `anneescolaire` (
        `idAnneeScolaire`,
        `nomAnneeScolaire`
    )
VALUES (1, '2021-2023');

-- --------------------------------------------------------

--

-- Table structure for table `compte`

--

CREATE TABLE
    `compte` (
        `user` varchar(50) NOT NULL,
        `password` varchar(50) NOT NULL,
        `compteType` varchar(50) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `compte`

--

INSERT INTO
    `compte` (
        `user`,
        `password`,
        `compteType`
    )
VALUES (
        '199211260144',
        '123',
        'stagiaire'
    ), (
        '2000121600314',
        '123',
        'stagiaire'
    ), (
        'admin',
        'admin',
        'serveillant'
    ), (
        'directrice',
        'directrice',
        'directrice'
    );

-- --------------------------------------------------------

--

-- Table structure for table `filiere`

--

CREATE TABLE
    `filiere` (
        `idFiliere` int(11) NOT NULL,
        `nomFiliere` varchar(150) NOT NULL,
        `idAnnee` int(11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `filiere`

--

INSERT INTO
    `filiere` (
        `idFiliere`,
        `nomFiliere`,
        `idAnnee`
    )
VALUES (
        11,
        "developpeur d'applications python",
        1
    ), (12, 'Developpement digital', 1), (
        13,
        'Infrastructure digitale',
        1
    ), (
        14,
        'Developpement des applications web et mobiles',
        1
    ), (
        15,
        'Developpement digital option Web full stack',
        2
    ), (
        16,
        'Infrastructure Digitale option Systemes et Re',
        2
    ), (
        17,
        'Infrastructure Digitale option Cyber securite',
        2
    ), (
        18,
        'Infrastructure Digitale option Cloud Computin',
        2
    ), (
        19,
        'Developpement Digital option Applications Mob',
        2
    ), (
        20,
        'Maintenance Informatique et Reseaux',
        3
    );

-- --------------------------------------------------------

--

-- Table structure for table `formateur`

--

CREATE TABLE
    `formateur` (
        `Matricule` varchar(50) NOT NULL,
        `nomFormateur` varchar(50) NOT NULL,
        `prenomFormateur` varchar(50) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `formateur`

--

INSERT INTO
    `formateur` (
        `Matricule`,
        `nomFormateur`,
        `prenomFormateur`
    )
VALUES ('1', 'Ouatoch', 'Abd Jalil'), ('2', 'Holako', 'Noob');

-- --------------------------------------------------------

--

-- Table structure for table `groupe`

--

CREATE TABLE
    `groupe` (
        `idGroupe` int(11) NOT NULL,
        `nomGroupe` varchar(40) NOT NULL,
        `idFiliere` int(11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `groupe`

--

INSERT INTO
    `groupe` (
        `idGroupe`,
        `nomGroupe`,
        `idFiliere`
    )
VALUES (22, 'DAP101', 11), (23, 'DAP102', 11), (24, 'DEV101', 12), (25, 'DEV102', 12), (26, 'DEV103', 12), (27, 'DEV104', 12), (28, 'DEV105', 12), (29, 'DEV106', 12), (30, 'DEV107', 12), (31, 'DEV108', 12), (32, 'DEV109', 12), (34, 'DEV110', 12), (35, 'ID101', 13), (36, 'ID102', 13), (37, 'ID103', 13), (38, 'ID104', 13), (39, 'ID105', 13), (40, 'ID106', 13), (41, 'ID107', 13), (42, 'DAWM101', 14), (43, 'DEVOWFS201', 15), (44, 'DEVOWFS202', 15), (45, 'DEVOWFS203', 15), (46, 'DEVOWFS204', 15), (47, 'DEVOWFS205', 15), (48, 'DEVOWFS206', 15), (49, 'DEVOWFS207', 15), (50, 'DEVOWFS208', 15), (51, 'DEVOWFS209', 15), (52, 'IDOSR201', 16), (53, 'IDOSR202', 16), (54, 'IDOSR203', 16), (55, 'IDOSR204', 16), (56, 'IDOSR205', 16), (57, 'IDOSR206', 16), (58, 'IDOCS201', 17), (59, 'IDOCC201', 18), (60, 'IDOCC202', 18), (61, 'DEVOAM201', 19), (62, 'MIR301', 20);

-- --------------------------------------------------------

--

-- Table structure for table `justifierabsence`

--

CREATE TABLE
    `justifierabsence` (
        `idAbsence` int(11) NOT NULL,
        `Justifie_motif` varchar(250) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--

-- Table structure for table `note`

--

CREATE TABLE
    `note` (
        `CEF` varchar(50) NOT NULL,
        `note` int(11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--

-- Table structure for table `stagiaire`

--

CREATE TABLE
    `stagiaire` (
        `CEF` varchar(50) NOT NULL,
        `nomStagiaire` varchar(60) NOT NULL,
        `prenomStagiaire` varchar(60) NOT NULL,
        `idGroupe` int(11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--

-- Dumping data for table `stagiaire`

--

INSERT INTO
    `stagiaire` (
        `CEF`,
        `nomStagiaire`,
        `prenomStagiaire`,
        `idGroupe`
    )
VALUES (
        '199211260144',
        'EL HANINE',
        'KHAIR ALLAH',
        41
    ), (
        '1993030100110',
        'ACHEIKH',
        'ALI LOOL',
        22
    ), (
        '199402200533',
        'ELHADDAD',
        'ABDELMOUNAIM',
        43
    ), (
        '1994030600023',
        'CHOUIRGUI',
        'ABDELKADER',
        54
    ), (
        '199403070517',
        'BADDOU',
        'ABDELLAH',
        60
    ), (
        '1994032900063',
        'TAJI',
        'IMRANE',
        49
    ), (
        '1994053100060',
        'IBNOUZAHER',
        'RAJA',
        32
    ), (
        '1994100200080',
        'EL AANG',
        'ABDESSADEK',
        52
    ), (
        '199501180430',
        'AIT FNINE',
        'SAMIRA',
        46
    ), (
        '1995080600107',
        'ENNAHI',
        'KHALID',
        56
    ), (
        '199508100382',
        'MEGLAOUI',
        'SAMIR',
        43
    ), (
        '1996012500241',
        'DAMHARI',
        'ABDELKARIM',
        38
    ), (
        '1996052500266',
        'FAOUZI',
        'NOURDDINE',
        26
    ), (
        '1996061800188',
        'AMSAAFI',
        'IMANE',
        23
    ), (
        '1996081000313',
        'SABOUI',
        'MOHAMED HASSAN',
        38
    ), (
        '1996100700208',
        'EDDIRAA',
        'ABDELHADI',
        44
    ), (
        '1996102100146',
        'LARGOU',
        'KHALIL',
        55
    ), (
        '199612160080',
        'BOUIKRAITE',
        'FATIM EZZAHRA',
        44
    ), (
        '1997012700327',
        'LAKHLILI',
        'SALAH EDDINE',
        30
    ), (
        '1997020000000',
        'EL BAKAL',
        'AYOUB',
        48
    ), (
        '1997022000466',
        'MARKABI',
        'GHIZLANE',
        23
    ), (
        '1997030200283',
        'LAGHMIR',
        'MOHAMED',
        60
    ), (
        '1997030900003',
        'EL MOUDEN',
        'HAMZA',
        22
    ), (
        '1997032000289',
        'BENOUAZIZ',
        'KHADIJA',
        22
    ), (
        '1997040400290',
        'MARZAQ',
        'AYOUB',
        26
    ), (
        '1997050100485',
        'AIT ELHAJ',
        'ABDELAZIZ',
        57
    ), (
        '1997060100464',
        'KAOUCH',
        'OUSSAMA',
        40
    ), (
        '1997062600264',
        'ZEROUAL',
        'WIAM',
        43
    ), (
        '1997071300186',
        'EL GHOJDAMI',
        'MOHAMED AMINE',
        22
    ), (
        '1997082500343',
        'OUAISSA',
        'MERIEM',
        26
    ), (
        '1997091500218',
        'BAYAD',
        'ABDELHAKIM',
        59
    ), (
        '1997112000448',
        'EL IDRISSI',
        'ISSAM',
        30
    ), (
        '1997112100346',
        'ABDOUH',
        'SOUKAINA',
        32
    ), (
        '1998010000000',
        'TAILBA',
        'OUSSAMA',
        48
    ), (
        '1998010103661',
        'EZ-ZAIDANI',
        'SANA',
        52
    ), (
        '1998010103819',
        'AIT EL HAJ',
        'ELHASSAN',
        45
    ), (
        '1998010103825',
        'ETTITAOU',
        'SALOUA',
        57
    ), (
        '1998010200145',
        'BEN AMMI',
        'HAMZA',
        54
    ), (
        '1998011800311',
        'JEMAANE',
        'AYOUB',
        52
    ), (
        '1998021200230',
        'RIHI',
        'MOHAMED',
        22
    ), (
        '1998022500231',
        'MAKRAZ',
        'MOUAD',
        50
    ), (
        '1998030000000',
        'KOUDOUA',
        'ZOUHAIR',
        48
    ), (
        '1998030600400',
        'DAKIR',
        'ISMAIL',
        60
    ), (
        '1998030700344',
        'WASSOU',
        'LAHOUCINE',
        45
    ), (
        '1998043000357',
        'BENNAQTE',
        'ZAHIRA',
        32
    ), (
        '1998051600257',
        'EL AZIZ',
        'AYOUB',
        56
    ), (
        '1998051700216',
        'ELAKKAL',
        'AYOUB',
        42
    ), (
        '1998053100215',
        'KHARRAZ',
        'ZOUHAIR',
        46
    ), (
        '1998060700420',
        'CHAFIK',
        'NAOUFEL',
        60
    ), (
        '1998061000553',
        'EL MATTAT',
        'MEHDI',
        56
    ), (
        '1998061700385',
        'RBIB',
        'HAMZA',
        25
    ), (
        '1998062500223',
        'SEMLALI',
        'ISMAIL',
        32
    ), (
        '1998070100660',
        'AIT BOUAZZA',
        'ABDERRAHIM',
        38
    ), (
        '1998070200474',
        'HROUCHAN',
        'ABDECHAKOUR',
        60
    ), (
        '1998071200387',
        'TACHRIMANTE',
        'HAMZA',
        40
    ), (
        '1998072800461',
        'MIGHRANI',
        'MOHAMED',
        31
    ), (
        '1998082400431',
        'DAMOUCH',
        'MONA',
        55
    ), (
        '1998082700388',
        'KHARBOUCH',
        'ZIAD',
        58
    ), (
        '1998083100357',
        'DOUBABI',
        'MARIAM',
        60
    ), (
        '1998090300052',
        'LAGHIRI',
        'HAMZA',
        55
    ), (
        '1998091100393',
        'OUALI',
        'HAMID',
        40
    ), (
        '1998091600404',
        'SIDI BBA',
        'YOUSSEF',
        44
    ), (
        '1998091800386',
        'RHALMI',
        'ZAKARIA',
        24
    ), (
        '1998092000527',
        'BOUDAR',
        'ABDELLAH',
        49
    ), (
        '1998101000405',
        'LAMHAKKEM',
        'HAITAM',
        38
    ), (
        '1998101900328',
        'ELMOQDADI',
        'ABDELJALIL',
        55
    ), (
        '1998102700194',
        'ELKHALIFA',
        'MOHAMED NOUREDDINE',
        32
    ), (
        '1998102800431',
        'LAMSAOUI',
        'MOHAMED',
        27
    ), (
        '1998110400386',
        'TOLMAN',
        'MOHAMED',
        43
    ), (
        '1998110900393',
        'ELHARCHI',
        'AHMED',
        27
    ), (
        '1998112100004',
        'IDRISSI AIT ELOUALI',
        'YAZID',
        22
    ), (
        '1998121300329',
        'EL MOUSAOUI',
        'AYOUB',
        61
    ), (
        '1998121500435',
        'BENSALAH',
        'DOUNIA',
        59
    ), (
        '1998121700398',
        'ASEMLAL',
        'HANANE',
        47
    ), (
        '1999010103464',
        'AIT-LAHCEN',
        'ZAHRA',
        49
    ), (
        '1999010103989',
        'DOUAMNA',
        'HAMZA',
        37
    ), (
        '1999010200483',
        'ITOUNI',
        'YASSINE',
        22
    ), (
        '1999010700398',
        'DASSAA',
        'SADIK',
        39
    ), (
        '1999011000323',
        'YASSIR',
        'LAHJILA',
        56
    ), (
        '1999011300546',
        'MOUHADDAB',
        'ISSAM',
        36
    ), (
        '1999012000323',
        'BELATTAR',
        'JAMAL',
        61
    ), (
        '1999012100466',
        'IDA BBOU',
        'NOHAYLA',
        58
    ), (
        '1999020900293',
        'BELGHOUL',
        'MEHDI',
        60
    ), (
        '1999021700041',
        'ABBAD',
        'AYOUB',
        22
    ), (
        '1999022300367',
        'MOUSSAOUI',
        'ABDELKARIM',
        47
    ), (
        '1999030200262',
        'RAISI',
        'HAMZA',
        42
    ), (
        '1999030200448',
        'AITIDAR',
        'NIAMA',
        47
    ), (
        '1999030200460',
        'TELMOUDI',
        'NOUAMANE',
        31
    ), (
        '1999030400265',
        'NABOULSI',
        'ILIAS',
        22
    ), (
        '1999030600371',
        'ELDDOUAB',
        'ABDELLAH',
        59
    ), (
        '1999030900352',
        'HAFED',
        'ELHOUSSAINE',
        46
    ), (
        '1999032000551',
        'TOUFNOUTI',
        'YOUSSEF',
        52
    ), (
        '1999032400454',
        'AMALOU',
        'YOUSSEF',
        52
    ), (
        '1999033000316',
        'IBNOUMAJAH',
        'ILIASS',
        52
    ), (
        '1999033000391',
        'IOUI',
        'ABDERRAHMANE',
        54
    ), (
        '1999033100327',
        'AQIL',
        'AMINE',
        55
    ), (
        '1999040200383',
        'NANI',
        'FATIMA',
        50
    ), (
        '1999040200402',
        'EL MANSSOURI',
        'ABDELKARIM',
        44
    ), (
        '1999041900386',
        'OULOUARK',
        'OUSSAMA',
        61
    ), (
        '1999042300229',
        'BENLARBI',
        'YOUSSEF',
        47
    ), (
        '1999042900328',
        'ELAABID',
        'HICHAM',
        36
    ), (
        '1999050600386',
        'BELKABOUS',
        'ANIR',
        27
    ), (
        '1999050800357',
        'AIT HQI',
        'ABDELKARIM',
        46
    ), (
        '1999052100351',
        'MANSOUR',
        'IMAD',
        29
    ), (
        '1999052900346',
        'DRAOUI',
        'HAMZA',
        26
    ), (
        '1999060200447',
        'ELKHALFAOUI',
        'ZAKARIA',
        27
    ), (
        '1999062000563',
        'MEZOUARI',
        'NABIL',
        46
    ), (
        '1999070400387',
        'HBACHOU',
        'SOUAAD',
        56
    ), (
        '1999070400397',
        'GHALLABI',
        'HIBA',
        47
    ), (
        '1999070800482',
        'AIT IHYA',
        'ABDELMAJID',
        52
    ), (
        '1999071600335',
        'LAAYDI',
        'TARIK',
        38
    ), (
        '1999071600373',
        'ELMAHRAOUI',
        'OUIJDANE',
        42
    ), (
        '1999071900408',
        'MAHOUAT',
        'FATIMA EZZAHRA',
        59
    ), (
        '1999072000613',
        'BOUABRIK',
        'HICHAM',
        28
    ), (
        '1999072200421',
        'BOUSSOU',
        'JAWAD',
        54
    ), (
        '1999073000462',
        'MENTAGUI',
        'ACHRAF',
        39
    ), (
        '1999080300370',
        'EL HAILA',
        'HAMZA',
        42
    ), (
        '1999080500434',
        'MAGHLAL',
        'MEHDI',
        51
    ), (
        '1999081500514',
        'AFKHKHAR',
        'ABDELHADI',
        41
    ), (
        '1999082000513',
        'AGNOUCH',
        'MOHAMED',
        46
    ), (
        '1999082300405',
        'AIT SIDI ALI',
        'SALAH EDDINE',
        58
    ), (
        '1999090000000',
        'AL RADWANE',
        'MEHDI',
        48
    ), (
        '1999091300250',
        'FAJRI',
        'YOUSSEF',
        58
    ), (
        '1999091300330',
        'ELBARGUI',
        'HAMZA',
        52
    ), (
        '1999091600492',
        'AIT ECHCHIKH',
        'FATIMA',
        31
    ), (
        '1999092100395',
        'JAAOUANI',
        'ZINEB',
        55
    ), (
        '1999092400372',
        'GADIRI',
        'TARIK',
        60
    ), (
        '1999092500412',
        'MACHKOUR',
        'YASSINE',
        52
    ), (
        '1999093000368',
        'MOUNJID',
        'AHMED',
        39
    ), (
        '1999100100505',
        'LOUACHE',
        'MOUAD',
        43
    ), (
        '1999100300359',
        'MOUSTAKIM',
        'AYOUB',
        51
    ), (
        '1999100400260',
        'EL ASLANI',
        'MOHAMED TAHA',
        22
    ), (
        '1999100600347',
        'ELALLAOUI',
        'ABDELFATTAH',
        42
    ), (
        '1999101400484',
        'ABDESSADEK',
        'EL MOUTASSIM',
        34
    ), (
        '1999101500093',
        'SAHIL',
        'AICHA',
        43
    ), (
        '1999101900243',
        'EL AAGAIBA',
        'ABDELAADIM',
        61
    ), (
        '1999102100057',
        'TIJANI',
        'AYMANE',
        56
    ), (
        '1999102400184',
        'BOUNNITE',
        'SALIM',
        39
    ), (
        '1999102900400',
        'IMZILEN',
        'MEHDI',
        50
    ), (
        '1999110500428',
        'LAMDIRA',
        'ELMEHDI',
        44
    ), (
        '1999111000519',
        'TOURABI',
        'YASSINE',
        54
    ), (
        '1999111300421',
        'KABIBI',
        'SOHAYB',
        59
    ), (
        '1999111400326',
        'ENNAJMI',
        'MOUAD',
        30
    ), (
        '1999112200454',
        'BOUGANE',
        'MEHDI',
        37
    ), (
        '1999112300252',
        'ESSANI',
        'ABDERRAZAQ',
        23
    ), (
        '1999120300178',
        'HMIMID',
        'MOHAMED',
        58
    ), (
        '1999121100467',
        'IHDIDI',
        'NOUR EDDINE',
        38
    ), (
        '1999121700282',
        'EL MOUDNI',
        'FOUAD',
        46
    ), (
        '1999121800437',
        'GOURTI',
        'YOUNESS',
        44
    ), (
        '1999122300430',
        'BERRIOUA',
        'AYMANE',
        37
    ), (
        '1999122600436',
        'GUYAR',
        'YOUSSEF',
        52
    ), (
        '1999122600505',
        'AIT DAOUD',
        'LAMIA',
        26
    ), (
        '1999123000197',
        'LBIDA',
        'MAHDI',
        34
    ), (
        '2000010103101',
        'LAKSIOUER',
        'MEHDI',
        45
    ), (
        '2000010500353',
        'BOUTERHAQ',
        'ABDERRAHIM',
        55
    ), (
        '2000011200545',
        'IBNOUBAR',
        'AMINE',
        52
    ), (
        '2000012100275',
        'ELFARKH',
        'MUSTAPHA',
        22
    ), (
        '2000012600433',
        'DHIH',
        'ACHRAF',
        30
    ), (
        '2000012700415',
        'GUERFOUSS',
        'ANAS',
        44
    ), (
        '2000012800434',
        'FAQIR',
        'SAADIA',
        40
    ), (
        '2000012900382',
        'LAAMRI',
        'ABDELHAKIM',
        36
    ), (
        '2000020700464',
        'AIT ZIDAN',
        'MAROUANE',
        26
    ), (
        '2000021200458',
        'GOURIZMI',
        'OUMNIA',
        54
    ), (
        '2000021200495',
        'ELMOUTRIS',
        'CHAIMA',
        37
    ), (
        '2000021500296',
        'GHAOUCH',
        'OUSSAMA',
        35
    ), (
        '2000022100408',
        'AHBALY',
        'MOHAMED',
        61
    ), (
        '2000030500359',
        'ABDELGHANI',
        'MOUJOUD',
        54
    ), (
        '2000030800472',
        'ABOUZAHID',
        'ABDELFETTAH',
        61
    ), (
        '2000031000612',
        'BOUSSOUAB',
        'YOUSSEF',
        40
    ), (
        '2000031100324',
        'OUAHIDI',
        'ABDELGHAFOUR',
        54
    ), (
        '2000031500556',
        'BOUMRIS',
        'RACHID',
        26
    ), (
        '2000032600419',
        'EL AAOUAM',
        'MOHAMED',
        32
    ), (
        '2000033000419',
        'CHABILI',
        'MAROUANE',
        27
    ), (
        '2000040100079',
        'BENKHABBA',
        'ISMAIL',
        35
    ), (
        '2000040100586',
        'LAMZOUKI',
        'JAMAL',
        37
    ), (
        '2000040200400',
        'TENNOUKHI',
        'FATIMA',
        40
    ), (
        '2000041300452',
        'BOUYESK',
        'MOHAMED',
        49
    ), (
        '2000042000496',
        'AIT ALI',
        'OUASSILA',
        59
    ), (
        '2000042000571',
        'AOUFOUSSI',
        'HACHIM',
        24
    ), (
        '2000042000572',
        'NISSOUKIN',
        'OTHMANE',
        31
    ), (
        '2000042800413',
        'LAMRABET',
        'HANANE',
        51
    ), (
        '2000050000000',
        'ABOUKHOURA',
        'IBTISSAM',
        48
    ), (
        '2000050300280',
        'AIT NASSIR',
        'MERYEM',
        59
    ), (
        '2000050600361',
        'BOUSSAKKINE',
        'RACHID',
        38
    ), (
        '2000050900375',
        'FATH-ALLAH',
        'HICHAM',
        52
    ), (
        '2000050900404',
        'FOUAD',
        'LAKHAL',
        52
    ), (
        '2000051000561',
        'OUATTOU',
        'OTMAN',
        60
    ), (
        '2000051100416',
        'BEN DABIA',
        'ABDELOUFI',
        36
    ), (
        '2000051300301',
        'BENLAMLIH',
        'MOHAMMED',
        59
    ), (
        '2000051300352',
        'EZ-ZYGHAM',
        'SOUKAINA',
        32
    ), (
        '2000051800386',
        'MOUMTAZ',
        'HAMZA',
        44
    ), (
        '2000051900199',
        'LANIBI',
        'LAMYA',
        34
    ), (
        '2000051900205',
        'BERBOUCHI',
        'MOHAMED',
        51
    ), (
        '2000060100639',
        'BNOUSSAAD',
        'MOATAZE',
        57
    ), (
        '2000061200431',
        'AIT MOHAMED',
        'ACHRAF',
        45
    ), (
        '2000061600186',
        'MOUSSADDAQ',
        'IKRAM',
        47
    ), (
        '2000062500308',
        'AITCHAIB',
        'MOHAMAD ELMEHDI',
        52
    ), (
        '2000062700269',
        'RHOUMIZA',
        'HAJAR',
        22
    ), (
        '2000063000387',
        'ESSEBAIY',
        'MOHAMED',
        61
    ), (
        '2000070200494',
        'ARSAOUI',
        'ABDELFATTAH',
        51
    ), (
        '2000070400358',
        'AIT EL MADANI',
        'ABDELKRIM',
        59
    ), (
        '2000070500470',
        'BAKANDAR',
        'ACHRAF',
        52
    ), (
        '2000070900294',
        'ET-TONIA',
        'HAMZA',
        55
    ), (
        '2000071200332',
        'BAKANY',
        'HOUDA',
        47
    ), (
        '2000071200443',
        'ARROUSS',
        'HAMZA',
        56
    ), (
        '2000071300382',
        'ISGUAR',
        'MERIEM',
        34
    ), (
        '2000072000463',
        'BOUMOULA',
        'SAFOUANE',
        46
    ), (
        '2000072200468',
        'ANASSER',
        'OSSAMA',
        34
    ), (
        '2000072600372',
        'EL BOUCHANI',
        'HAMZA',
        25
    ), (
        '2000073000368',
        'BOUCHAIRA',
        'FARID',
        39
    ), (
        '2000073100016',
        'AIT TADDART',
        'JAWAD',
        58
    ), (
        '2000080000000',
        'ENNAJI',
        'ABDESSAMIA',
        48
    ), (
        '2000080800403',
        'ELMAJDOULI',
        'ZAKARIAE',
        35
    ), (
        '2000082300373',
        'BADAOUI',
        'ZAKARIA',
        46
    ), (
        '2000082300450',
        'ELHOUARI',
        'ABDELATI',
        49
    ), (
        '2000083000396',
        'ELMANSOURI',
        'TAHA',
        22
    ), (
        '2000090100691',
        'LAMRISS',
        'ABDELHAKIM',
        24
    ), (
        '2000090300366',
        'MAKFOUNI',
        'YOUSSEF',
        40
    ), (
        '2000090300392',
        'ETTAKADDOUMI',
        'HAMZA',
        45
    ), (
        '2000091000472',
        'EL BOUAZAOUI',
        'MAROUANE',
        40
    ), (
        '2000091100361',
        'GHAZI',
        'ICHRAK',
        22
    ), (
        '2000091100405',
        'LAMSAAF',
        'EL MAHDI',
        32
    ), (
        '2000091400329',
        'KORAIBAN',
        'KARAM',
        22
    ), (
        '2000091400420',
        'GADDAH',
        'MOHAMMAD',
        26
    ), (
        '2000091600396',
        'ELGHACHI',
        'HAMZA',
        55
    ), (
        '2000092000442',
        'MOUNIR',
        'KARIM',
        58
    ), (
        '2000100300516',
        'BOUZERB',
        'HANANE',
        26
    ), (
        '2000101100420',
        'BANI',
        'RIDA',
        38
    ), (
        '2000102000548',
        'GHOUNDOULI',
        'OUALID',
        54
    ), (
        '2000102100162',
        'HAIKAL',
        'OMAR',
        22
    ), (
        '2000102100427',
        'BENSIDI',
        'ABDERRAZZAK',
        56
    ), (
        '2000102200329',
        'BARCHA',
        'SALAH EDDINE',
        54
    ), (
        '2000102900407',
        'AZDYOU',
        'AYOUB',
        47
    ), (
        '2000110100663',
        'FALLAH',
        'ADNANE',
        24
    ), (
        '2000110900290',
        'EL BAKHRI',
        'AISSAM',
        58
    ), (
        '2000112200421',
        'ZARHOUN',
        'ZIAD',
        47
    ), (
        '2000112300353',
        'HIDAR',
        'MOHAMED',
        47
    ), (
        '2000112400407',
        'EL MAHZOULI',
        'NOUR EDDINE',
        37
    ), (
        '2000112400471',
        'MOUSTAOUI',
        'YOUSSEF',
        39
    ), (
        '2000112800383',
        'MEKOUAR',
        'ABDELAZIZ',
        56
    ), (
        '2000120100602',
        'ELHAJI',
        'ZAKARIA',
        52
    ), (
        '2000120500295',
        'LAHMYED',
        'OUSSAMA',
        61
    ), (
        '2000120500312',
        'ELBOUHAOUI',
        'SALIMA',
        22
    ), (
        '2000120700446',
        'ELMOUADANE',
        'AYOUB',
        38
    ), (
        '2000121500432',
        'LAKHDAR',
        'MOURAD',
        42
    ), (
        '2000121500536',
        'CHERQUAOUI',
        'OUSSAMA',
        51
    ), (
        '2000121600314',
        "R'GUIBI",
        'MAROUANE',
        47
    ), (
        '2000121900398',
        'DRAI',
        'BADR',
        45
    ), (
        '2000121900411',
        'AJZAGH',
        'KHAOULA',
        51
    ), (
        '2000122100442',
        'TIRAR',
        'SAFIA',
        32
    ), (
        '2000122300242',
        'EL MEDDAI',
        'REDA',
        54
    ), (
        '2000122300385',
        'EL MAHLALI',
        'EL MEHDI',
        58
    ), (
        '2000123000366',
        'ELHADDAJI',
        'OTMANE',
        50
    ), (
        '2001010101260',
        'MRABTI FASSI',
        'YAHYA',
        46
    ), (
        '2001010103395',
        'KALIL',
        'YOUSSEF',
        25
    ), (
        '2001010103663',
        'EL OUARDY',
        'ANASS',
        37
    ), (
        '2001010200345',
        'AKBOUR',
        'AHLAM',
        51
    ), (
        '2001010200723',
        'BOUYOUB',
        'FATIMA ZAHRA',
        31
    ), (
        '2001010800497',
        'NASRI',
        'ABDELADIM',
        49
    ), (
        '2001010800538',
        'BOUKHRIS',
        'OTHMANE',
        27
    ), (
        '2001011000473',
        'ALOUAH',
        'ABDELMAJID',
        61
    ), (
        '2001011100431',
        'BENHAMOU',
        'ABDESSAMAD',
        57
    ), (
        '2001011200424',
        'MHIDRA',
        'MOHAMED',
        50
    ), (
        '2001011200459',
        'ZARGANI',
        'MAHMOUD',
        36
    ), (
        '2001011800286',
        'BARKHOUSS',
        'SAAD EDDINE',
        22
    ), (
        '2001012000611',
        'KZAIBER',
        'ATIKA',
        26
    ), (
        '2001012800425',
        'OUBOUALI',
        'YOUSSEF',
        59
    ), (
        '2001012900437',
        'AZAGZA',
        'AYOUB',
        29
    ), (
        '2001020200508',
        'MOHAMED',
        'BENBELKHIR',
        26
    ), (
        '2001020300366',
        'KARKACHI',
        'MOHAMED',
        59
    ), (
        '2001020800304',
        'BOULLOUZ',
        'YASSINE',
        46
    ), (
        '2001020900335',
        'HAMOUCHI',
        'AKRAM',
        47
    ), (
        '2001021000317',
        'LABRASSI',
        'MOHAMED',
        22
    ), (
        '2001021100293',
        'BAZZI',
        'AYOUB',
        22
    ), (
        '2001021200361',
        'LYAKROUMI',
        'YOUNESS',
        59
    ), (
        '2001021600369',
        'DRISSI',
        'OMAR',
        56
    ), (
        '2001021700183',
        'HAMMAMA',
        'ELMEHDI',
        22
    ), (
        '2001022000453',
        'DAHOU',
        'ABDELILAH',
        58
    ), (
        '2001022100303',
        'MOUZDAHIR',
        'SALMA',
        52
    ), (
        '2001022700397',
        'TAHIRI',
        'ABD ELKRIM',
        28
    ), (
        '2001030000000',
        'CHERKAOUI AZZAB',
        'YASSINE',
        48
    ), (
        '2001030100612',
        'ZIRRI',
        'BOUHCINE',
        45
    ), (
        '2001030100731',
        'DAGHASTANI',
        'KAMAL',
        40
    ), (
        '2001030300503',
        'ELBARJI',
        'ABDERRAHMAN',
        27
    ), (
        '2001030500041',
        'OUAINAHOU',
        'SALAH EDDINE',
        52
    ), (
        '2001030600506',
        'AHRISS',
        'HASSAN',
        36
    ), (
        '2001030800452',
        'AIT-ELCADI',
        'MAROUANE',
        32
    ), (
        '2001031500454',
        'KHAIRI',
        'CHAIMAA',
        35
    ), (
        '2001032200408',
        'ELMOUJAHED',
        'MOHAMED',
        36
    ), (
        '2001040000000',
        'EL HOUARY',
        'FATIMA',
        48
    ), (
        '2001040500271',
        'ESSALAM',
        'ZAKARIA',
        36
    ), (
        '2001041600352',
        'IZERG',
        'MOUNIR',
        57
    ), (
        '2001042900241',
        'ELOUDAA',
        'ISMAIL',
        52
    ), (
        '2001042900306',
        'HAMAME',
        'SALAHEDDINE',
        57
    ), (
        '2001050000000',
        'BANACER',
        'SOUFIANE',
        48
    ), (
        '2001050300296',
        'FAKIHI',
        'YASIN',
        42
    ), (
        '2001050400275',
        'EL FAKHR',
        'MOHAMED',
        52
    ), (
        '2001051000416',
        'EL MARBOUH',
        'KHALID',
        61
    ), (
        '2001051500348',
        'NAIT EL HAJ',
        'MOHAMED',
        52
    ), (
        '2001051500374',
        'EL FETOUAKI',
        'OMAR',
        50
    ), (
        '2001051600282',
        'HILALI',
        'CHAIMAE',
        58
    ), (
        '2001051700404',
        'JAOUJAOUI',
        'ABDELHAKIM',
        34
    ), (
        '2001052500504',
        'EL KABLAOUI',
        'MOURAD',
        43
    ), (
        '2001052900327',
        'KAICH',
        'ZAKARIA',
        45
    ), (
        '2001053000385',
        'LAKHNIKH',
        'KHALIL',
        51
    ), (
        '2001060000000',
        'AIT TATA',
        'MOHAMED',
        48
    ), (
        '2001060200432',
        'BOUSSALEM',
        'ANAS',
        24
    ), (
        '2001060300438',
        'LAHNIDA',
        'KHAOULA',
        37
    ), (
        '2001060800350',
        'KHARBOUCH',
        'SOUMIA',
        52
    ), (
        '2001060900375',
        'LAHLANE',
        'OTHMANE',
        31
    ), (
        '2001061200419',
        'ESSADOQ',
        'MOHAMED',
        31
    ), (
        '2001061300099',
        'AMMIMNI',
        'MOUHCINE',
        42
    ), (
        '2001061700182',
        'ELAABID',
        'ELMOKHTAR',
        22
    ), (
        '2001061800252',
        'NIBARKIOUN',
        'ALI',
        35
    ), (
        '2001061900335',
        'CHAAOULA',
        'NIZAR',
        44
    ), (
        '2001062300281',
        'BOUTANNOURA',
        'ABDESSADEK',
        34
    ), (
        '2001062400303',
        'KARCHAOUI',
        'OTHMANE',
        55
    ), (
        '2001062400414',
        'OUTMASSINT',
        'HAMZA',
        43
    ), (
        '2001070200215',
        'ELGAZZOULI',
        'HAJIBA',
        43
    ), (
        '2001070200411',
        'GHALLABI',
        'NOUSSAIBA',
        45
    ), (
        '2001070600414',
        'LAHNIDA',
        'ABDELGHAFOUR',
        47
    ), (
        '2001070700367',
        'HAOUA',
        'KHALID',
        50
    ), (
        '2001071400231',
        'IBEN ELAMID',
        'REDA',
        30
    ), (
        '2001071700333',
        'BABRAIM',
        'ABDELAZIZ',
        40
    ), (
        '2001071700395',
        'BENALI',
        'YOUNES',
        45
    ), (
        '2001071800345',
        'EL HAIBOUBI',
        'ZAHRA',
        50
    ), (
        '2001071800425',
        'EL HAKIMY',
        'YOUNESE',
        61
    ), (
        '2001072400298',
        'HALMAOUI',
        'ABDELLAH',
        57
    ), (
        '2001072900262',
        'BOUSSAFANE',
        'YOUNES',
        41
    ), (
        '2001072900343',
        'CHAWKI',
        'MAROUANE',
        52
    ), (
        '2001073100360',
        'EL MAMOUN',
        'MOHAMED ELHABIB',
        39
    ), (
        '2001080200451',
        'OUADEH',
        'IMAD',
        31
    ), (
        '2001080500307',
        'ID-BRAHIM',
        'MUSTAFA',
        50
    ), (
        '2001080900239',
        'MAGHMOURI',
        'SALMA',
        52
    ), (
        '2001081100263',
        'TRIAY',
        'FATIMA-EZZAHRA',
        45
    ), (
        '2001081100405',
        'ELMIFDALI',
        'MUSTAPHA',
        28
    ), (
        '2001081300411',
        'BELAKHAL',
        'OUSSAMA',
        45
    ), (
        '2001081500447',
        'BIZI',
        'SALAHEDDINE',
        40
    ), (
        '2001081900378',
        'ELMOULKIA',
        'MAROINE',
        36
    ), (
        '2001082200298',
        'BOUSTAHE',
        'FATIMA EZZAHRA',
        60
    ), (
        '2001082700290',
        'NOUIDRAT',
        'JAMALEDDINE',
        42
    ), (
        '2001090000000',
        'BAROUD',
        'ABDELKARIM',
        48
    ), (
        '2001090100504',
        'BOULAGHZALATE',
        'OMAR',
        52
    ), (
        '2001090300397',
        'HISSOU',
        'ILHAM',
        45
    ), (
        '2001090500399',
        'ALLAOUI',
        'YAHYA',
        28
    ), (
        '2001090600276',
        'SEKKOUMI',
        'HOUSSAM',
        61
    ), (
        '2001090800164',
        'AIT BOUDOUAR',
        'ILYASSE',
        51
    ), (
        '2001091200274',
        'LAMLIOUI',
        'OUSSAMA',
        52
    ), (
        '2001091700308',
        'ZOUINE',
        'ADAM',
        38
    ), (
        '2001091800333',
        'KHAZNAOUI',
        'SOUFIANE',
        30
    ), (
        '2001091800380',
        'FARHAT',
        'AYOUB',
        52
    ), (
        '2001091900179',
        'ILAHIANE',
        'YOUSSEF',
        25
    ), (
        '2001092100255',
        'AHMANE',
        'NOUHAILA',
        42
    ), (
        '2001092100344',
        'ILYAS',
        'LAMSALEK',
        46
    ), (
        '2001092300080',
        'EL MAHFOUDY',
        'ANAS',
        57
    ), (
        '2001092700184',
        'AAMIRICHE',
        'WISSAL',
        60
    ), (
        '2001092700286',
        'NOURTI',
        'OUSSAMA',
        54
    ), (
        '2001092700395',
        'ITOU',
        'OUSSAMA',
        44
    ), (
        '2001092800428',
        'BINIKE',
        'OUSSAMA',
        58
    ), (
        '2001093000302',
        'NAAIM',
        'OTHMANE',
        27
    ), (
        '2001093000424',
        'IDABBOU',
        'OUSSAMA',
        38
    ), (
        '2001100300391',
        'OUKTIT',
        'HAMZA',
        29
    ), (
        '2001100600349',
        'BAHLAOUI',
        'OUSSAMA',
        60
    ), (
        '2001100600386',
        'ABDELLAOUI',
        'MEHDI',
        26
    ), (
        '2001100700325',
        'ACHBANI',
        'HOUSSAME',
        50
    ), (
        '2001100900257',
        'BOUDOUNIT',
        'OUSSAMA',
        58
    ), (
        '2001101000250',
        'ANAS',
        'MAHMOUDI',
        54
    ), (
        '2001101300232',
        'BOUALLI',
        'ABDELLAH',
        22
    ), (
        '2001101300316',
        'EZZALZOULI',
        'REDA',
        40
    ), (
        '2001101400239',
        'ESSIFAR',
        'MOHAMED',
        42
    ), (
        '2001101900384',
        'HIDAOUI',
        'YOUNES',
        45
    ), (
        '2001102200194',
        'ZANNOURE',
        'AYMANE',
        59
    ), (
        '2001102500394',
        'KALLOUCH',
        'TAOUFIQ',
        37
    ), (
        '2001102800197',
        'ISOUKTAN',
        'RADOUANE',
        42
    ), (
        '2001110300258',
        'BENYASSINE',
        'ANOUAR',
        56
    ), (
        '2001110300439',
        'HAZMIRI',
        'KHAOULA',
        25
    ), (
        '2001110400238',
        'KIRBA',
        'ABDELGHANI',
        50
    ), (
        '2001110500352',
        'SIMAMRI',
        'OUSSAMA',
        52
    ), (
        '2001110600307',
        'ZAIDY',
        'ICHRAQ',
        57
    ), (
        '2001110800296',
        'QUARRO',
        'SAMI',
        47
    ), (
        '2001111000172',
        'ZAHOUAN',
        'ABDELMOUHCINE',
        49
    ), (
        '2001111200221',
        'REGRAGUI-DOUNIA',
        'ADAM',
        52
    ), (
        '2001111200311',
        'HAIDOURI',
        'AHMED',
        54
    ), (
        '2001111200346',
        'IDRISSI',
        'MOHAMED',
        47
    ), (
        '2001111200379',
        'ELFATIMI',
        'SALAHEDDINE',
        43
    ), (
        '2001111900057',
        'HALLAL',
        'SIHAM',
        42
    ), (
        '2001112200186',
        'LAGHLIMI',
        'AYOUB',
        32
    ), (
        '2001112300349',
        'MIQASSE',
        'ABDESSAMAD',
        44
    ), (
        '2001112500341',
        'MAJID',
        'NACER EDDINE',
        49
    ), (
        '2001112600219',
        'KANSSOUR',
        'MOHAMED',
        52
    ), (
        '2001112700262',
        'ET-TALEBY',
        'HAJAR',
        57
    ), (
        '2001112700269',
        'ALOUAH',
        'EL MASTAPHA',
        22
    ), (
        '2001112800290',
        'SARAMOU',
        'MOHAMED REDA',
        60
    ), (
        '2001112900150',
        'ECH-CHOURFI',
        'OUSSAMA',
        22
    ), (
        '2001112900309',
        'ROSSAYSSI',
        'FATIMA-EZZAHRA',
        52
    ), (
        '2001120100464',
        'ED-DAHBY',
        'YOUNES',
        60
    ), (
        '2001120200197',
        'LAAZIZE',
        'ZAKARIA',
        35
    ), (
        '2001120600426',
        'AZAIRIT',
        'ADNANE',
        46
    ), (
        '2001120900042',
        'QARIOUH',
        'NIZAR',
        55
    ), (
        '2001121200410',
        'MOUMAN',
        'TAOUFIK',
        57
    ), (
        '2001121600206',
        'LAHIAOUNI',
        'HICHAM',
        22
    ), (
        '2001121700366',
        'ESSEBAA',
        'ABDERRAZZAK',
        45
    ), (
        '2001122200340',
        'TAOUFIQ',
        'YOUNESS',
        32
    ), (
        '2001122300225',
        'LAHLALI',
        'ZINEB',
        42
    ), (
        '2001122600390',
        'BOUTRIG',
        'ZAKARIA',
        43
    ), (
        '2002010300348',
        'HATTA',
        'NOAMANE',
        56
    ), (
        '2002010300430',
        'MACHOUAR',
        'SAID',
        41
    ), (
        '2002010700312',
        'TAHI',
        'NAJOUA',
        55
    ), (
        '2002010800290',
        'BENHIDA',
        'OUSSAMA',
        44
    ), (
        '2002010800344',
        'LAANANI',
        'HAMZA',
        44
    ), (
        '2002011100207',
        'BENKHAZRA',
        'OUSSAMA',
        42
    ), (
        '2002011100335',
        'EL HOUNI',
        'NOUAMANE',
        31
    ), (
        '2002011300289',
        'LAADIMI',
        'YOUSSEF',
        52
    ), (
        '2002011400265',
        'MOUAKITI',
        'JAOUAD',
        49
    ), (
        '2002011400271',
        'OUHADDOUCH',
        'MANAL',
        57
    ), (
        '2002011400343',
        'BENAMIR',
        'YAHYA',
        49
    ), (
        '2002011400402',
        'LABIB',
        'ABDELKARIM',
        28
    ), (
        '2002011700361',
        'CHAKRAOUI',
        'ANAS',
        28
    ), (
        '2002011900302',
        'GUERGUER',
        'YASSER',
        54
    ), (
        '2002011900323',
        'AIT MANSOUR',
        'SLIMANE',
        38
    ), (
        '2002012200321',
        'AIT LAOUNI',
        'DOUNIA',
        59
    ), (
        '2002012300096',
        'LAKRITI',
        'ANAS',
        22
    ), (
        '2002012300210',
        'BENCHOUK',
        'AMAL',
        44
    ), (
        '2002012300296',
        'TAGHOUNI',
        'HALIMA',
        51
    ), (
        '2002012500232',
        'EL HAMIDI',
        'HAMZA',
        55
    ), (
        '2002012500352',
        'OUAKRIM',
        'MOHAMED',
        57
    ), (
        '2002012600297',
        'TARIKI',
        'MOHAMED ANAS',
        31
    ), (
        '2002012800209',
        'EL OUARRARI',
        'ILYAS',
        41
    ), (
        '2002012800232',
        'AKABLI',
        'MARYAME',
        42
    ), (
        '2002012800406',
        'CHOKHMANE',
        'AYA',
        26
    ), (
        '2002013100367',
        'AITBENTALEB',
        'HABIBA',
        31
    ), (
        '2002020000000',
        'AZMOUR',
        'HOUSSAM',
        48
    ), (
        '2002020100507',
        'OUDRA',
        'SALAH',
        35
    ), (
        '2002020300099',
        'EL ATTAR',
        'FATIMA EZZAHRA',
        55
    ), (
        '2002020400409',
        'WIJDANE',
        'BELATTAR',
        35
    ), (
        '2002020600263',
        'ELMEZDI',
        'ABDELHAMID',
        50
    ), (
        '2002020900201',
        'EL QOURI',
        'HAMZA',
        36
    ), (
        '2002021100350',
        'GOUIDA',
        'KARIM',
        32
    ), (
        '2002021300248',
        'KAMRONE',
        'WIAM',
        52
    ), (
        '2002022000291',
        'AMJAHDI',
        'LOBNA',
        57
    ), (
        '2002022000365',
        'CHAKIR',
        'EL ARABI',
        50
    ), (
        '2002022000419',
        'AFROUSS',
        'HAMZA',
        46
    ), (
        '2002022200334',
        'BENKARROUME',
        'BADR',
        46
    ), (
        '2002022200350',
        'ELHACHIMI',
        'DOHA',
        51
    ), (
        '2002022200351',
        'DEGUIRI',
        'AYOUB',
        47
    ), (
        '2002022400305',
        'ELHASNAOUI',
        'MEHDI',
        44
    ), (
        '2002022500434',
        'OUCHERAA',
        'LAMYA',
        27
    ), (
        '2002022600278',
        'LAMSSELEK',
        'WISSAL',
        26
    ), (
        '2002022600327',
        'EL KOSTASSI',
        'KAOUTAR',
        56
    ), (
        '2002022800379',
        'MECHHAB',
        'YASSER',
        61
    ), (
        '2002030100469',
        'AMER',
        'HAJAR',
        50
    ), (
        '2002030700172',
        'AASRI',
        'OUSSAMA',
        22
    ), (
        '2002030900269',
        'AGOURRAM',
        'IKRAM',
        50
    ), (
        '2002031000309',
        'MOUFAKKIR',
        'CHARIFA',
        46
    ), (
        '2002031100305',
        'BAHID',
        'ZAKARIA',
        51
    ), (
        '2002031200281',
        'SIKOUK',
        'AYOUB',
        50
    ), (
        '2002031300292',
        'AIT AABOU',
        'YOUSSEF',
        58
    ), (
        '2002031400034',
        'ELGAROUNI',
        'ZOUHAIR',
        35
    ), (
        '2002031500243',
        'ROUHI',
        'HAJAR',
        43
    ), (
        '2002031700242',
        'ENOUITI',
        'AYOUB',
        60
    ), (
        '2002032000229',
        'GHIRMOUKA',
        'YOUSEF',
        56
    ), (
        '2002032000324',
        'OUTKATERT',
        'FATIMA',
        50
    ), (
        '2002032100196',
        'LAYADI',
        'OLIA',
        49
    ), (
        '2002032800355',
        'MARNI',
        'HAFSSA',
        25
    ), (
        '2002032900203',
        'AIT EL BAZE',
        'OUSSAMA',
        49
    ), (
        '2002040200274',
        'TOUFFELLA',
        'OUSSAMA',
        57
    ), (
        '2002040400080',
        'KRIOUITA',
        'ABDESSAMAD',
        51
    ), (
        '2002040400225',
        'LAHSINI',
        'MOHAMED',
        54
    ), (
        '2002040500216',
        'IOUIRY',
        'OUSSAMA',
        61
    ), (
        '2002040800323',
        'ELAMINE',
        'NADIA',
        30
    ), (
        '2002041200006',
        'AKHFAMANI',
        'AMINE',
        31
    ), (
        '2002041400348',
        'ELOUADI',
        'ABDELLAH',
        35
    ), (
        '2002041500170',
        'MOUNSI',
        'AMAL',
        59
    ), (
        '2002041600337',
        'EL FANKARI',
        'MOHAMED',
        25
    ), (
        '2002041700313',
        'TAOUIL',
        'ABDELLAH',
        25
    ), (
        '2002041900151',
        'OUACHOUCH',
        'ABDELLAH',
        51
    ), (
        '2002041900206',
        'AGRAB',
        'HAMZA',
        51
    ), (
        '2002042300251',
        'EL FASSIHI',
        'OUSSAMA',
        54
    ), (
        '2002042500246',
        'MOBTAHIJ',
        'ACHRAF',
        57
    ), (
        '2002042600245',
        'BAANNI',
        'ZAINEB',
        47
    ), (
        '2002042600339',
        'KHALIL',
        'OMAR',
        29
    ), (
        '2002042900143',
        'ADGHAR',
        'SAAD',
        52
    ), (
        '2002043000173',
        'EBN ERRADIY',
        'ANASS',
        49
    ), (
        '2002050000000',
        'BENSIDI',
        'YASSINE',
        48
    ), (
        '2002050100324',
        'BERROUCH',
        'KAWTAR',
        47
    ), (
        '2002050100407',
        'KEMMOUCH',
        'ZINEB',
        56
    ), (
        '2002050700266',
        'AIT BELHAJ',
        'YOUSSEF',
        61
    ), (
        '2002050900267',
        'NASSER',
        'IKRAM',
        26
    ), (
        '2002051100138',
        'BARIAN',
        'SOULAIMANE',
        49
    ), (
        '2002051200019',
        'BENDRAAOU',
        'RIDA',
        40
    ), (
        '2002051300385',
        'BADRY',
        'OUSSAMA',
        40
    ), (
        '2002051700274',
        'BELFHAILI',
        'FADI',
        37
    ), (
        '2002051700289',
        'MENEBHI',
        'OMAR',
        52
    ), (
        '2002052000392',
        'LAKHDAR',
        'ABDERAFIA',
        32
    ), (
        '2002052300105',
        'TAZRI',
        'HAMZA',
        50
    ), (
        '2002052500230',
        'BENHRA',
        'MOAD',
        55
    ), (
        '2002052700148',
        'BOUDCHICH',
        'OUIJDANE',
        39
    ), (
        '2002052900188',
        'AIT FTIM',
        'YAHYA',
        59
    ), (
        '2002052900297',
        'AIT BELKACEM',
        'ISSAM',
        36
    ), (
        '2002060000000',
        'AIT BENZEKRI',
        'HAMZA',
        48
    ), (
        '2002060100358',
        'GHALBANE',
        'ZIAD',
        41
    ), (
        '2002060200291',
        'HAJJAJ',
        'ILYAS',
        55
    ), (
        '2002060500266',
        'KAATICH',
        'ABDESSAMAD',
        30
    ), (
        '2002060700392',
        'EL KHADYM',
        'MOHAMED',
        39
    ), (
        '2002060800347',
        'BAKHACH',
        'OUALID',
        37
    ), (
        '2002061100341',
        'DRAOU',
        'AIMRANE',
        29
    ), (
        '2002061300210',
        'DOUMNAJI',
        'BTISSAM',
        57
    ), (
        '2002061600190',
        'AIT EDERY',
        'ABDERRAHMAN',
        58
    ), (
        '2002061600270',
        'FALIH',
        'ABDELILAH',
        61
    ), (
        '2002061700260',
        'BOUKHAIMA',
        'CHAIMAE',
        50
    ), (
        '2002061700304',
        'TAALITE',
        'ANAS',
        25
    ), (
        '2002061700312',
        'BOUKHAIMA',
        'KAWTAR',
        50
    ), (
        '2002061800342',
        'EL ANNAOUI',
        'ZAKARIA',
        39
    ), (
        '2002062000469',
        'AIT OUAKKA',
        'ADNANE',
        39
    ), (
        '2002062700164',
        'OUAISSA',
        'OUSSAMA',
        44
    ), (
        '2002062800164',
        'BRAOU',
        'AYOUB',
        58
    ), (
        '2002063000192',
        'BOUSMAIL',
        'ABD ELFATTAH',
        62
    ), (
        '2002063000270',
        'BOULBAROUD',
        'MOHAMED',
        50
    ), (
        '2002070000000',
        'CHOUAFNI',
        'RIDA',
        48
    ), (
        '2002070300297',
        'BAGHAZ',
        'MAHMOUD',
        38
    ), (
        '2002070600349',
        'BEN FAIDA',
        'MOHAMED HAYTAM',
        35
    ), (
        '2002070800128',
        'ABDELLAOUI',
        'ADNANE',
        51
    ), (
        '2002071000298',
        'EL KARNI',
        'HASSAN',
        60
    ), (
        '2002071100139',
        'EL BIDAKI',
        'WISSAL',
        55
    ), (
        '2002071100345',
        'EL HASSIA',
        'KHADIJA',
        34
    ), (
        '2002071200251',
        'SAS',
        'RAYANE',
        46
    ), (
        '2002071300264',
        'MIRICH',
        'ABDELHALIM',
        46
    ), (
        '2002071400179',
        'LAHGAZ',
        'ZAKARIA',
        51
    ), (
        '2002071600419',
        'DAJI',
        'KHALID',
        31
    ), (
        '2002071700255',
        'ZAKINE',
        'SALMA',
        28
    ), (
        '2002071700385',
        'BIDI',
        'HASSAN',
        25
    ), (
        '2002071900348',
        'TAINIT',
        'ABDELILAH',
        28
    ), (
        '2002072600232',
        'ABLAD',
        'ILYAS',
        47
    ), (
        '2002073000148',
        'ZAAZAA',
        'AYA',
        26
    ), (
        '2002080000000',
        'MSITTA',
        'YAZID',
        48
    ), (
        '2002080100036',
        'MECHOUAT',
        'OTHMANE',
        35
    ), (
        '2002080100332',
        'GOUNANE',
        'CHARAF',
        56
    ), (
        '2002080200282',
        'KNANBI',
        'KHALID',
        41
    ), (
        '2002080300333',
        'ICHAHANE',
        'OUSSAMA',
        29
    ), (
        '2002080400254',
        'BENBAKKA',
        'YOUNESS',
        44
    ), (
        '2002080500337',
        'BEN HNINOU',
        'TAIB',
        35
    ), (
        '2002080700147',
        'BABIGHEF',
        'ZAKIA',
        46
    ), (
        '2002080800351',
        'ANOUAR',
        'HAMZA',
        51
    ), (
        '2002081000153',
        'BOURAS',
        'IMANE',
        43
    ), (
        '2002081400228',
        'FARAHAT',
        'HAMZA',
        61
    ), (
        '2002081500252',
        'FLOULOU',
        'AMINE',
        28
    ), (
        '2002081800207',
        'LAGRIOUI',
        'HOUSSAM',
        41
    ), (
        '2002081800345',
        'OUAMI',
        'AYOUB',
        28
    ), (
        '2002081900297',
        'BEN ABBOU',
        'MOHAMED ELAMINE',
        31
    ), (
        '2002082000395',
        'AMESKALI',
        'HAMZA',
        41
    ), (
        '2002082100301',
        'GHARAD',
        'MOHAMED AMINE',
        38
    ), (
        '2002082200345',
        'SAHDANE',
        'OUSSAMA',
        41
    ), (
        '2002082700328',
        'RAGI',
        'NAJWA',
        22
    ), (
        '2002083100221',
        'ELBANOUJI',
        'OMAR',
        49
    ), (
        '2002090000000',
        'EL KHALIL',
        'AYOUB',
        48
    ), (
        '2002090100203',
        'AIT ELHAJ',
        'SOUKAINA',
        50
    ), (
        '2002090100317',
        'ALOUAH',
        'ADNANE',
        36
    ), (
        '2002090500152',
        'AHKIMOU',
        'SALMA',
        59
    ), (
        '2002090500315',
        'MOUSTAJIL',
        'ISMAIL',
        37
    ), (
        '2002090700309',
        'LAFHALE',
        'HOMAM',
        36
    ), (
        '2002090900265',
        'FAIDA',
        'ABDEL HAKIM',
        59
    ), (
        '2002091100226',
        'FAKHRI',
        'NOUHAILA',
        36
    ), (
        '2002091200256',
        'JIAA',
        'LOUBNA',
        51
    ), (
        '2002091300244',
        'ABOU-NAAMANE',
        'BOCHRA',
        47
    ), (
        '2002091500401',
        'EL OUARRAQI',
        'ABDELFATTAH',
        37
    ), (
        '2002091500409',
        'ABERJI',
        'GHIZLANE',
        26
    ), (
        '2002091600185',
        'BOUAALI',
        'SOUAD',
        46
    ), (
        '2002091600220',
        'MOHAMED',
        'QZADRI',
        58
    ), (
        '2002091600304',
        'KORKECH',
        'OUSSAMA',
        25
    ), (
        '2002092200131',
        'EL HAMDAOUI',
        'AYMAN',
        22
    ), (
        '2002092500391',
        'BENLHOUSSAINE',
        'ZAKARIA',
        36
    ), (
        '2002092600211',
        'AIT ZOUINET',
        'ANAS',
        29
    ), (
        '2002092600241',
        'AIT LMADANI',
        'AZZEDDINE',
        41
    ), (
        '2002092600267',
        'OUAGAG',
        'MOHAMED ACHRAF',
        47
    ), (
        '2002092700192',
        'SEBTI',
        'MOHAMED KHALIL',
        51
    ), (
        '2002092800147',
        'ABBOU',
        'RIDA',
        37
    ), (
        '2002092800229',
        'AZAGROUZE',
        'MOHAMED',
        43
    ), (
        '2002100200264',
        'EL AAROUMI',
        'YASSIR',
        29
    ), (
        '2002100300376',
        'CHATTER',
        'ASMAA',
        36
    ), (
        '2002100500259',
        'TITIF',
        'GHITA',
        57
    ), (
        '2002100500357',
        'MAKKA',
        'HAJAR',
        35
    ), (
        '2002100800238',
        'TALEB',
        'FATIMA EZZAHRA',
        57
    ), (
        '2002100800327',
        'EL MANDILI',
        'SALMA',
        39
    ), (
        '2002100800333',
        'MAJID',
        'ABDELLATIF',
        24
    ), (
        '2002101100255',
        'OULAMINE',
        'HICHAM',
        29
    ), (
        '2002101400298',
        'BOUGADER',
        'MOHAMED',
        27
    ), (
        '2002101700291',
        'EL OUAJJANI',
        'YOUSSEF',
        52
    ), (
        '2002101900203',
        'CHAKHAIS',
        'FATIM-EZZAHRA',
        49
    ), (
        '2002102100300',
        'CHAOUAY',
        'SAID',
        40
    ), (
        '2002102700046',
        'HALAS',
        'ZAKARIA',
        44
    ), (
        '2002103000260',
        'OULED CHATER',
        'MERIEM',
        52
    ), (
        '2002103100285',
        'MOUSTAID',
        'ASSMA',
        31
    ), (
        '2002110000000',
        'NAJI',
        'OSSAMA',
        48
    ), (
        '2002110100190',
        'BELGADI',
        'SALMA',
        43
    ), (
        '2002110100194',
        'HARAKAT',
        'YAHYA',
        46
    ), (
        '2002110300014',
        'AMSAAFI',
        'SALAH-EDDINE',
        42
    ), (
        '2002110300046',
        'NAJAHI',
        'OUSSAMA',
        54
    ), (
        '2002110400200',
        'LAFKIRI',
        'ACHRAF',
        50
    ), (
        '2002110700328',
        'EL GHAZOUANI',
        'OUALID',
        38
    ), (
        '2002110700330',
        'IBNOUZAHIR',
        'NABIL',
        26
    ), (
        '2002110800248',
        'ALOUANE',
        'HATIM',
        60
    ), (
        '2002110900199',
        'GHARRAB',
        'AHMED',
        44
    ), (
        '2002111100271',
        'ENNAKIMI',
        'ZINEB',
        56
    ), (
        '2002111300123',
        'BEN DEMRANE',
        'GHADA',
        44
    ), (
        '2002111400198',
        'KAMINE',
        'BADR EDDINE',
        60
    ), (
        '2002111400297',
        'BENNAJMA',
        'RABIA',
        29
    ), (
        '2002111500114',
        'IBN AHMED',
        'KAMAL',
        62
    ), (
        '2002111700132',
        'IRIK',
        'SARA',
        55
    ), (
        '2002112000434',
        'ABOULOUAFA',
        'KHADIJA',
        26
    ), (
        '2002112300145',
        'BERJILA',
        'ZAKARIA',
        41
    ), (
        '2002112400228',
        'NOUINI',
        'OUMAIMA',
        61
    ), (
        '2002112400238',
        'LAMNADI',
        'IMANE',
        39
    ), (
        '2002112500263',
        'OUCHN',
        'YAHYA',
        47
    ), (
        '2002112500296',
        'AIT TAMALDOU',
        'ANASS',
        51
    ), (
        '2002112500377',
        'WAHMANE',
        'HAMZA',
        34
    ), (
        '2002112600160',
        'EL KHANTOURI',
        'BILAL',
        59
    ), (
        '2002112700095',
        'AIT SAID',
        'AYOUB',
        62
    ), (
        '2002112700262',
        'AL KHASSASSY',
        'EL MOUATAZ BILLAH',
        49
    ), (
        '2002112900291',
        'AIT BEN AMEUR',
        'AYOUB',
        37
    ), (
        '2002120000000',
        'DABOUSSI',
        'SANAE',
        48
    ), (
        '2002120100247',
        'AIT AHMAD',
        'HAMZA',
        37
    ), (
        '2002120300252',
        'MOUNNAN',
        'SANA',
        56
    ), (
        '2002120600133',
        'OUNASSER',
        'SAAD-EDDINE',
        49
    ), (
        '2002120900167',
        'TAGHOUNI',
        'ABDELLA',
        28
    ), (
        '2002121300138',
        'TIKANAB',
        'M\'HAMED',
        56
    ), (
        '2002121500330',
        'TIKO',
        'HAFÇA',
        32
    ), (
        '2002122200122',
        'EL MOURABIT',
        'MOHAMED',
        60
    ), (
        '2002122300155',
        'TALEB',
        'ILYASS',
        52
    ), (
        '2002122500196',
        'BENNIS',
        'YOUSSEF',
        38
    ), (
        '2002122800115',
        'ANAMIR',
        'NOUHAILA',
        42
    ), (
        '2002122900180',
        'AIT OULHINE',
        'IKRAM',
        45
    ), (
        '2002123000177',
        'HADDANE',
        'FATIMA-EZZAHRA',
        36
    ), (
        '2002123000195',
        'BOULAKTAF',
        'FATIMA EZZAHRAE',
        49
    ), (
        '2003010000000',
        'ELLATIFI',
        'HOUSSAM',
        48
    ), (
        '2003010101161',
        'BAHMANE',
        'YASSINE',
        49
    ), (
        '2003010101167',
        'AIT LAHCEN',
        'HALIMA',
        56
    ), (
        '2003010101243',
        'CHEGDALI',
        'ABDELLAH',
        60
    ), (
        '2003010101595',
        'EZZAOUINI',
        'ABDERRAHMANE',
        30
    ), (
        '2003010200258',
        'CHEKROUN',
        'ADNAN',
        58
    ), (
        '2003010200264',
        'CHATIR',
        'OUMNIA',
        54
    ), (
        '2003010200342',
        'ERRADI',
        'HIBA',
        35
    ), (
        '2003011700095',
        'NABIR',
        'YAHYA',
        54
    ), (
        '2003012000242',
        'TOUGARI',
        'HAMZA',
        40
    ), (
        '2003012000248',
        'KOUNANE',
        'HAMZA',
        56
    ), (
        '2003012000271',
        'BOUTOUBA',
        'ZOUBAIR',
        55
    ), (
        '2003012100196',
        'FATHALLAH',
        'YOUSSRA',
        55
    ), (
        '2003012200010',
        'SAQOUANE',
        'RACHID',
        52
    ), (
        '2003012500239',
        'LOHMAM',
        'ABDERRAHMAN',
        44
    ), (
        '2003012600257',
        'ABOUHASSI',
        'ASMAA',
        38
    ), (
        '2003013100203',
        'EDDAIDI',
        'IMAD',
        43
    ), (
        '2003020100279',
        'HIFOU',
        'RAOUIA',
        41
    ), (
        '2003020200353',
        'MADADI',
        'ABDELILAH',
        28
    ), (
        '2003020400136',
        'ILYASSE',
        'AITTOUFAKI',
        25
    ), (
        '2003020800237',
        'ELBAL',
        'TAHA',
        43
    ), (
        '2003021100285',
        'CHAAOULA',
        'IMAN',
        28
    ), (
        '2003021100326',
        'KOUTAMI',
        'OUSSAMA',
        37
    ), (
        '2003021500108',
        'LAMHIZAM',
        'SALMA',
        62
    ), (
        '2003021600324',
        'TALAGHTE',
        'EL MAHDI',
        40
    ), (
        '2003022000135',
        'TRICHA',
        'ABDELMOUGHIT',
        61
    ), (
        '2003030000000',
        'BOUGAJDI',
        'NOUR EDDINE',
        48
    ), (
        '2003030200201',
        'AZGUITI',
        'MERIEM',
        49
    ), (
        '2003030500109',
        'BENJIMA',
        'YASSIR',
        44
    ), (
        '2003030500316',
        'BOULKERCH',
        'OUSSAMA',
        32
    ), (
        '2003031100146',
        'MACH',
        'YASSMINE',
        51
    ), (
        '2003031500189',
        'DIRZAD',
        'OUALID',
        45
    ), (
        '2003031700212',
        'JAKANI',
        'FATIMA ZAHRA',
        49
    ), (
        '2003032000275',
        'LAICHI',
        'YASSINE',
        58
    ), (
        '2003032200277',
        'BELKADI',
        'ELMAHDI',
        32
    ), (
        '2003032400200',
        'AKHCHCHAN',
        'MARIAM',
        25
    ), (
        '2003032600307',
        'MOUKHTARI',
        'MOHAMED',
        24
    ), (
        '2003033100070',
        'ZAOUICH',
        'BADER',
        50
    ), (
        '2003033100129',
        'HARDA',
        'TARIK',
        61
    ), (
        '2003033100209',
        'MARDAT',
        'MOUAD',
        39
    ), (
        '2003040000000',
        'TAOUBI',
        'WISSAL',
        48
    ), (
        '2003040100217',
        'ECHIGUER',
        'ABDERRAHMANE',
        52
    ), (
        '2003040200159',
        'SALGANE',
        'TAHA',
        49
    ), (
        '2003040200199',
        'EL FAIZANI',
        'AYA',
        43
    ), (
        '2003040200322',
        'EL MANYANI',
        'ASMA',
        35
    ), (
        '2003041300241',
        'ABOUHAFID',
        'OUAFA',
        30
    ), (
        '2003041300276',
        'BATTAH',
        'KAOUTAR',
        34
    ), (
        '2003041600128',
        'ELBAHI',
        'FATIMA',
        59
    ), (
        '2003041600256',
        'AKCHACH',
        'ZAHRA',
        27
    ), (
        '2003041900056',
        'BENMINA',
        'CHAIMA',
        62
    ), (
        '2003041900121',
        'JABRI',
        'ANAS',
        47
    ), (
        '2003042000147',
        'CHADLI',
        'ASMAA',
        37
    ), (
        '2003042200266',
        'MANOULI',
        'IMAD',
        24
    ), (
        '2003042200267',
        'MANOULI',
        'MOUAD',
        24
    ), (
        '2003042400320',
        'KEMMISSA',
        'MUSTAPHA',
        27
    ), (
        '2003042500259',
        'LAATRI',
        'KHAOULA',
        25
    ), (
        '2003042900148',
        'BAHLAOUI',
        'MAROUA',
        60
    ), (
        '2003050200267',
        'NIF',
        'ABDELFETTAH',
        37
    ), (
        '2003050600132',
        'OUTIZI',
        'NADIA',
        46
    ), (
        '2003050800361',
        'LAHBARI',
        'YOUSSEF',
        24
    ), (
        '2003050900138',
        'IDOUAHMANE',
        'KHALID',
        61
    ), (
        '2003051300155',
        'BENMALEK',
        'WALID',
        45
    ), (
        '2003051500033',
        'MAHRACH',
        'AYOUB',
        38
    ), (
        '2003051600225',
        'FALAH',
        'ANAS',
        28
    ), (
        '2003051600242',
        'AMAKDOUF',
        'ALI',
        27
    ), (
        '2003051600281',
        'KHIBI',
        'IMANE',
        32
    ), (
        '2003051700147',
        'KAHL LAAYOUN',
        'ABDERRAHMAN',
        41
    ), (
        '2003051800182',
        'HARACH',
        'HIBA',
        59
    ), (
        '2003052100200',
        'BENLARBI',
        'ABDERRAHMAN',
        24
    ), (
        '2003052100264',
        'ISSKOURN',
        'ABDERAHMAN',
        24
    ), (
        '2003052400166',
        'BOUDRARI',
        'MOHAMED',
        41
    ), (
        '2003052400258',
        'EZ-ZYZY',
        'MOHAMED',
        38
    ), (
        '2003052500251',
        'BOUJTITA',
        'AIMANE',
        41
    ), (
        '2003052800132',
        'SEGGARI',
        'OTHMANE',
        59
    ), (
        '2003052900148',
        'AIT BELHADDAD',
        'SALMA',
        46
    ), (
        '2003053100193',
        'EL MOFID',
        'YOUSSEF',
        30
    ), (
        '2003060100079',
        'SEMMAA',
        'KHALIL',
        62
    ), (
        '2003060700171',
        'JANATE',
        'ANAS',
        54
    ), (
        '2003061300152',
        'ELJOUNI',
        'HAITAM',
        60
    ), (
        '2003061300210',
        'ELOUARDI',
        'AYOUB',
        29
    ), (
        '2003061500230',
        'DAKIR',
        'ISMAIL',
        30
    ), (
        '2003061700075',
        'SAJIM',
        'MOUAD',
        62
    ), (
        '2003062000191',
        'LHAROUFIA',
        'FATIM-EZZAHRA',
        45
    ), (
        '2003062200131',
        'BEN MBAREK',
        'SIHAM',
        57
    ), (
        '2003062500096',
        'BADJI',
        'ADNANE',
        62
    ), (
        '2003062700184',
        'FASSEH',
        'ANAS',
        24
    ), (
        '2003070000000',
        'LOUAAGUID',
        'HAITAM',
        48
    ), (
        '2003070200257',
        'RHARIBI',
        'ABDERRAHMANE',
        29
    ), (
        '2003070300256',
        'BENADDI',
        'SARA',
        31
    ), (
        '2003070400162',
        'HASNAOUI',
        'ELMEHDI',
        59
    ), (
        '2003070500127',
        'MANOUR',
        'MOHAMMED',
        61
    ), (
        '2003070600147',
        'HACHIMI',
        'IBTISSAM',
        38
    ), (
        '2003070800189',
        'MAKNAOUI',
        'SOUFIANE',
        52
    ), (
        '2003070800262',
        'DAKIR',
        'ABDELLAH',
        24
    ), (
        '2003070900124',
        'FERNANE',
        'MOAD',
        52
    ), (
        '2003071200219',
        'TBER',
        'ILYASS',
        32
    ), (
        '2003071300183',
        'BOUSSENNA',
        'HAJAR',
        29
    ), (
        '2003071300228',
        'AARIBIA',
        'ABIDARAHMAN',
        30
    ), (
        '2003071500327',
        'ABDELMOUMEN',
        'ABDELLAH',
        40
    ), (
        '2003071600066',
        'JAHA',
        'HASSAN',
        25
    ), (
        '2003071600159',
        'GHOUTANI',
        'HICHAM',
        61
    ), (
        '2003071900202',
        'YAFIK',
        'SAMIRA',
        31
    ), (
        '2003072100164',
        'MITAK',
        'YASSINE',
        56
    ), (
        '2003072900218',
        'AMENZOU',
        'IBTISSAM',
        27
    ), (
        '2003073000149',
        'JAMIM',
        'NADA',
        45
    ), (
        '2003080000000',
        'TAKI',
        'KAOUTAR',
        48
    ), (
        '2003080200151',
        'KHALLOUF',
        'SOULAIMANE',
        35
    ), (
        '2003080400127',
        'GABSI',
        'OUMAIMA',
        55
    ), (
        '2003080500243',
        'AIT BRIK',
        'ASMAE',
        35
    ), (
        '2003080700282',
        'KARKOHI',
        'NADIR',
        38
    ), (
        '2003081100236',
        'ELKADI',
        'ANAS',
        34
    ), (
        '2003081900254',
        'ELAATAOUI',
        'ABDELLATIF',
        29
    ), (
        '2003082500118',
        'KORAIT',
        'MOHAMED TAHA',
        37
    ), (
        '2003082500260',
        'NAJDAOUI',
        'ZOBAIR',
        34
    ), (
        '2003082700224',
        'EL HOUBRI',
        'ZAKARYA',
        29
    ), (
        '2003083000187',
        'LAMRIBAH',
        'SALMA',
        32
    ), (
        '2003090400147',
        'EL HATAF',
        'GHIZLANE',
        43
    ), (
        '2003090400269',
        'HOUMAME',
        'NOUR EDDINE',
        30
    ), (
        '2003090500108',
        'HABOU',
        'ILYAS',
        58
    ), (
        '2003090600253',
        'ABIDI',
        'ZAINAB',
        32
    ), (
        '2003090800145',
        'EDDAHIOUI',
        'KHAWLA',
        54
    ), (
        '2003091200245',
        'RABIAI',
        'ANAS',
        38
    ), (
        '2003091300234',
        'EL-HOUIJ',
        'ABDERRAHMANE',
        27
    ), (
        '2003091500272',
        'AIT HDA',
        'ABDE SSAMAD',
        27
    ), (
        '2003091700102',
        'LAHLANE',
        'HANAE',
        31
    ), (
        '2003091700146',
        'THIMI',
        'FATIMEZZAHRA',
        60
    ), (
        '2003091800152',
        'EL HANDAOUI',
        'HICHAM',
        50
    ), (
        '2003091900010',
        'BIGANI',
        'BADER',
        62
    ), (
        '2003091900125',
        'HARAKATIA',
        'KAOUTAR',
        58
    ), (
        '2003091900127',
        'OUHADDA',
        'FATIM-EZZAHRA',
        43
    ), (
        '2003091900249',
        'LAGHOUASLI',
        'TAREK',
        41
    ), (
        '2003092100102',
        'AIT NACEUR',
        'RAHHAL',
        45
    ), (
        '2003092200093',
        'BASSLI',
        'MARIEM',
        39
    ), (
        '2003092400134',
        'DERDARI',
        'ZINEB',
        58
    ), (
        '2003092800117',
        'ABAACH',
        'ILHAM',
        43
    ), (
        '2003092800133',
        'OUARDINI',
        'CHOUAIB',
        35
    ), (
        '2003092900276',
        'HANALI',
        'SOUFIANE',
        35
    ), (
        '2003093000142',
        'AGOURAM',
        'YASSMINA',
        49
    ), (
        '2003100000000',
        'TEHOUKI',
        'ASSIA',
        48
    ), (
        '2003100100301',
        'BOUBLIGHA',
        'ABDERRAHMAN',
        28
    ), (
        '2003100400202',
        'BOULOUAYA',
        'NISSRINE',
        40
    ), (
        '2003100600194',
        'AIMRANE',
        'ZAROUAL',
        24
    ), (
        '2003100700128',
        'RHAZLANI',
        'HIBA',
        44
    ), (
        '2003100700236',
        'ADIBI',
        'ZAKARIAE',
        39
    ), (
        '2003100900102',
        'KATIR',
        'OUALID',
        43
    ), (
        '2003100900149',
        'ERROUISSI',
        'HASSAN',
        37
    ), (
        '2003101100012',
        'MOSAID',
        'AYOUB',
        41
    ), (
        '2003101300153',
        'JAATIT',
        'FATIMA-EZZAHRA',
        57
    ), (
        '2003101500180',
        'ERRAISS',
        'AYOUB',
        60
    ), (
        '2003101600218',
        'ELMAZROUA',
        'HAMZA',
        25
    ), (
        '2003101600248',
        'EZZAARAOUI',
        'AYOUB',
        32
    ), (
        '2003102000101',
        'BLANI',
        'HOUSSAM',
        62
    ), (
        '2003102000149',
        'BENHAJJAJ',
        'HIBA',
        46
    ), (
        '2003102200125',
        'ERROUMANI',
        'GHIZLANE',
        45
    ), (
        '2003102400116',
        'BEN HAMZA',
        'OUALID',
        52
    ), (
        '2003102900227',
        'SBITI',
        'KHALID',
        29
    ), (
        '2003103000210',
        'SABROUKI',
        'SAHAR',
        26
    ), (
        '2003103100235',
        'SANDID',
        'HAJAR',
        25
    ), (
        '2003110300162',
        'ISSIS',
        'SALMA',
        43
    ), (
        '2003110500256',
        'BOUABOUT',
        'OUSSAMA',
        39
    ), (
        '2003111100173',
        'KABAB',
        'ABDELKARYM',
        55
    ), (
        '2003111200138',
        'MGHIRITE',
        'HAYTHAM',
        39
    ), (
        '2003111400120',
        'TARFI',
        'IMANE',
        45
    ), (
        '2003111400229',
        'SBIHI',
        'YASSIR',
        34
    ), (
        '2003112400277',
        'CHOUHAD',
        'HALIMA',
        26
    ), (
        '2003112400294',
        'CHNAH',
        'ABDELMOUGHIT',
        25
    ), (
        '2003112500311',
        'AHKIM',
        'YOUSSEF',
        29
    ), (
        '2003112600181',
        'BENCHAHYD',
        'ILYASS',
        47
    ), (
        '2003112600222',
        'MOUZGHI',
        'FATIMA EZZAHRA',
        26
    ), (
        '2003112600238',
        'AZAMMAR',
        'SALMA',
        34
    ), (
        '2003112600251',
        'AIT OUCHLIH',
        'MOHAMED',
        34
    ), (
        '2003113000120',
        'ATMANI',
        'HAMZA',
        26
    ), (
        '2003120800281',
        'LAMZAOUAK',
        'OTHMANE',
        34
    ), (
        '2003120900127',
        'MORAD',
        'MAROUANE',
        51
    ), (
        '2003121100059',
        'LAHJOUJI',
        'ACHRAF',
        62
    ), (
        '2003121600158',
        'EDDOHA',
        'AYA',
        41
    ), (
        '2003121700052',
        'ALHILALI',
        'AYEMANE',
        62
    ), (
        '2003121900104',
        'BOUBA',
        'YASSINE',
        43
    ), (
        '2003122400084',
        'OUBOUH',
        'WALID',
        51
    ), (
        '2003122900125',
        'EL HASNAOUI',
        'ZAINEB',
        45
    ), (
        '2004010100985',
        'ELKARIMY',
        'ASMAE',
        29
    ), (
        '2004010800084',
        'EL KADDAOUI',
        'ALI',
        38
    ), (
        '2004011000094',
        'NAYSSA',
        'NOUHA',
        32
    ), (
        '2004011200129',
        'MOURABIT',
        'FATIMA EZZAHRA',
        41
    ), (
        '2004011400129',
        'MOUTTAKHID',
        'CHAIMAA',
        31
    ), (
        '2004011500198',
        'KESTRAOUI',
        'ANAS',
        29
    ), (
        '2004011600096',
        'SAADEN',
        'YASSIN',
        61
    ), (
        '2004011600167',
        'HILALI NAZIH',
        'REDA',
        38
    ), (
        '2004011600188',
        'TOUHIRI',
        'MAROUANE',
        39
    ), (
        '2004011600201',
        'SAIDAT',
        'YOUSSEF',
        35
    ), (
        '2004011800200',
        'BENBAKH',
        'ABDELLAH',
        40
    ), (
        '2004011800202',
        'ZAKRANE',
        'HAFSA',
        35
    ), (
        '2004012000108',
        'MOUDALI',
        'NASSIMA',
        47
    ), (
        '2004012000162',
        'EL KAOUAY',
        'MOHAMED',
        60
    ), (
        '2004012500110',
        'AKHATTAT',
        'YASSER',
        36
    ), (
        '2004012600271',
        'RIGALE',
        'NORDINE',
        24
    ), (
        '2004013000105',
        'EL OUTMANI',
        'OUMAIMA',
        52
    ), (
        '2004013100087',
        'IOUT',
        'HIND',
        41
    ), (
        '2004020200234',
        'ESSOUAIDI',
        'ADEL',
        37
    ), (
        '2004020300174',
        'TAJINE',
        'IKRAM',
        30
    ), (
        '2004020300208',
        'TOUSSI',
        'ZAKARIA',
        40
    ), (
        '2004020400179',
        'DAROUICH',
        'ABDELLAH',
        30
    ), (
        '2004020500111',
        'MAGHACHE',
        'IBTISSAM',
        58
    ), (
        '2004020900094',
        'ES-SARRAR',
        'SMAIL',
        61
    ), (
        '2004021600217',
        'KHALLOUK',
        'HASSAN',
        40
    ), (
        '2004021800020',
        'EZOUINI',
        'AYOUB',
        39
    ), (
        '2004022600191',
        'SABRI',
        'HAFSA',
        28
    ), (
        '2004022800122',
        'EL FARAZI',
        'SAAD',
        58
    ), (
        '2004022900160',
        'ZARRIA',
        'ABDERRAHMANE',
        24
    ), (
        '2004030200077',
        'JIAA',
        'CHAIMAA',
        45
    ), (
        '2004031000199',
        'LAQSSIR',
        'AMINA',
        24
    ), (
        '2004031400156',
        'BOUNNIT',
        'KARIMA',
        24
    ), (
        '2004031500100',
        'AIT OUFLIH',
        'RANYA',
        36
    ), (
        '2004032000106',
        'AMDJAR',
        'ABDELWAHID',
        44
    ), (
        '2004032200107',
        'EL MEJDOUB',
        'MOHAMED',
        39
    ), (
        '2004032300172',
        'EL ADRAOUI',
        'AMINA',
        36
    ), (
        '2004032300185',
        'CHOUINI',
        'ISMAIL',
        36
    ), (
        '2004032500195',
        'ZOUHAYR',
        'LAYLA',
        38
    ), (
        '2004032900087',
        'LAGDIM SOUSSI',
        'RYAD',
        49
    ), (
        '2004040200143',
        'IDDI',
        'SALMA',
        31
    ), (
        '2004040300055',
        'EL FARISSI',
        'HIBA',
        44
    ), (
        '2004040300111',
        'LAAJOULI',
        'AHMED',
        29
    ), (
        '2004040400166',
        'ELGOUENNOUNI',
        'TOUHFA',
        28
    ), (
        '2004040600131',
        'MOULAY BENAISSA',
        'JOUMANA',
        29
    ), (
        '2004040700136',
        'CHAMSI',
        'MUSTAPHA',
        28
    ), (
        '2004041700137',
        'BELLA',
        'AMINE',
        24
    ), (
        '2004041900112',
        'BELMOUDDINE',
        'NACIRA',
        34
    ), (
        '2004042100168',
        'BATILI',
        'NOUHAILA',
        30
    ), (
        '2004042200064',
        'BAQASSE',
        'YAHYA',
        39
    ), (
        '2004042800181',
        'GHEBBARI',
        'MOHAMED ELAMINE',
        34
    ), (
        '2004043000131',
        'BOUKERCH',
        'ANASS',
        41
    ), (
        '2004050800127',
        'KABBAJ',
        'YASSINE',
        35
    ), (
        '2004050900110',
        'MOUZARIA',
        'IMRANE',
        24
    ), (
        '2004051200124',
        'ERRAQUI',
        'TAHAR',
        25
    ), (
        '2004051200147',
        'DRIRIJ',
        'ALI',
        36
    ), (
        '2004051900151',
        'ELALAOUI BANOUZI',
        'SALMA',
        28
    ), (
        '2004052900124',
        'RHIRHA',
        'IBTISSAM',
        29
    ), (
        '2004053000124',
        'NSILA',
        'ABDELLAH',
        34
    ), (
        '2004060100045',
        'BELLAMANE',
        'ANOUAR',
        25
    ), (
        '2004060300162',
        'BAROUSSI',
        'ABDERRAZAK',
        29
    ), (
        '2004062000140',
        'ECH-CHALH',
        'HOUDA',
        37
    ), (
        '2004062400146',
        'EL FADLI',
        'HOUDA',
        27
    ), (
        '2004070300128',
        'AOURIN-MOUCHE',
        'ILIAS',
        24
    ), (
        '2004070400075',
        'EL ALLAOUIA',
        'AMAL',
        56
    ), (
        '2004070800153',
        'KHARSOS',
        'KHALIL',
        25
    ), (
        '2004071400134',
        'AKHCHCHAN',
        'LATIFA',
        25
    ), (
        '2004071500178',
        'EL MALKI',
        'FATIMA',
        30
    ), (
        '2004071600156',
        'BOURADOUAN',
        'RADOUANE',
        29
    ), (
        '2004071800143',
        'MOUATAMIDE',
        'ADAM',
        35
    ), (
        '2004072600140',
        'ETTAYEF',
        'ASMAA',
        32
    ), (
        '2004072800167',
        'KORNIFA',
        'YOUNES',
        31
    ), (
        '2004080600110',
        'LOTFI',
        'ZAKARIA',
        24
    ), (
        '2004080700128',
        'ELGHABRA',
        'YASSINE',
        27
    ), (
        '2004080900108',
        'MCHICHI',
        'MOHAMED',
        30
    ), (
        '2004081600124',
        'OURIK',
        'AMINA',
        30
    ), (
        '2004081600137',
        'BOUZIANE',
        'ABDELFATTAH',
        27
    ), (
        '2004082000146',
        'BOUHOU',
        'MAJDOULINE',
        25
    ), (
        '2004082000187',
        'MAATOUQUI',
        'MERIEM',
        34
    ), (
        '2004082500177',
        'MOUSTAJIL',
        'AIMAD',
        31
    ), (
        '2004082500184',
        'BOUZIT',
        'ANIR',
        28
    ), (
        '2004082800141',
        'ELMANNI',
        'MOHAMED AMINE',
        35
    ), (
        '2004082900114',
        'BOURKHISS',
        'HOUSSAM',
        40
    ), (
        '2004082900117',
        'NAJA',
        'YASSINE',
        41
    ), (
        '2004090700019',
        'EL METKOUL',
        'ABDELMOULA',
        34
    ), (
        '2004091600101',
        'SOUIFI',
        'ISMAIL',
        30
    ), (
        '2004091700102',
        'BOUJOU',
        'AMINA',
        40
    ), (
        '2004092200117',
        'AIT HADDOU',
        'SARA',
        28
    ), (
        '2004092300165',
        'LAFROUH',
        'MOHAMED',
        30
    ), (
        '2004092400143',
        'KHEDID',
        'ABDELLAH',
        30
    ), (
        '2004092900134',
        'ZOUITINI',
        'RABAB',
        28
    ), (
        '2004100500044',
        'NIZARI',
        'MOHAMED',
        62
    ), (
        '2004100500152',
        'CHNITEF',
        'JIHANE',
        40
    ), (
        '2004101100117',
        'HNIKER',
        'ISMAIL',
        41
    ), (
        '2004101700137',
        'CHAHID',
        'ABDELILAH',
        25
    ), (
        '2004101800108',
        'MOTAHHIR',
        'MOUATAZ',
        31
    ), (
        '2004102600115',
        'ELFELLAH',
        'ADIL',
        34
    ), (
        '2004110500125',
        'LACHKAR',
        'MERIEM',
        27
    ), (
        '2004110500148',
        'MOUSDIK',
        'ISMAIL',
        28
    ), (
        '2004110600162',
        'KADDOURI',
        'ASMA',
        28
    ), (
        '2004111000126',
        'CHERKAOUI GHATTATI',
        'AYMANE',
        31
    ), (
        '2004112000206',
        'LAQRIBSSI',
        'SALMA',
        36
    ), (
        '2004112700102',
        'NADIRI',
        'MAJIDA',
        39
    ), (
        '2004112900106',
        'RKINI',
        'OTHMAN',
        32
    ), (
        '2004120200017',
        'MECHOUAT',
        'HIBA',
        28
    ), (
        '2004120400097',
        'CHAOUFI',
        'HIBA',
        24
    ), (
        '2004120500086',
        'BIZERGANE',
        'HASNA',
        36
    ), (
        '2004121900072',
        'BOUNNOU',
        'MOHAMED REDA',
        30
    ), (
        '2004122000150',
        'EZZAIM',
        'HOUSSAM',
        34
    ), (
        '2004122900102',
        'SNIBA',
        'AYA',
        26
    ), (
        '2005010100440',
        'BOUALLAGA',
        'MANAR',
        29
    ), (
        '2005010100471',
        'SASSAOUI',
        'YASSER',
        31
    ), (
        '2005010700042',
        'KHARBOUCHI',
        'MOHAMED',
        62
    ), (
        '2005011800036',
        'AMDICH',
        'MOHAMED',
        62
    ), (
        '2005012400120',
        'BAAYA',
        'SALMA',
        30
    ), (
        '2005020300084',
        'BELFAKIR',
        'OUSSAMA',
        24
    ), (
        '2005021000117',
        'BAHI',
        'HAJAR',
        34
    ), (
        '2005021100021',
        'LAGRAM',
        'MOHAMED',
        62
    ), (
        '2005021100085',
        'KAHIME',
        'BASMA',
        37
    ), (
        '2005021400094',
        'EL MAKKOUI',
        'MOHAMED',
        39
    ), (
        '2005021500103',
        'EL KAMRI',
        'MARYEM',
        27
    ), (
        '2005021900058',
        'ELHIRAJANE',
        'YASSINE',
        41
    ), (
        '2005022200083',
        'ELMELIANI',
        'YOUSSEF',
        34
    ), (
        '2005022400100',
        'KHALLOUKI',
        'AMINE',
        27
    ), (
        '2005022500046',
        'TROMBATI',
        'MONCEF',
        62
    ), (
        '2005030100174',
        'MOHAMED',
        'ABOU-LJAD',
        27
    ), (
        '2005031900073',
        'MAHROUZ',
        'DOHA',
        39
    ), (
        '2005033000085',
        'EL BERKHAMI',
        'MOHAMED RIDA',
        36
    ), (
        '2005041500047',
        'EL HAFIANI',
        'ISMAIL',
        26
    ), (
        '2005042000071',
        'JNIOUI',
        'ZAKARIA',
        37
    ), (
        '2005042800074',
        'LOKRITI',
        'ZINEB',
        27
    ), (
        '2005050100086',
        'CHRIOUITI',
        'SOUFIA',
        25
    ), (
        '2005050400062',
        'AICHI',
        'MOHAMED',
        27
    ), (
        '2005060900027',
        'EL HAMMOURI',
        'AHMED AYMANE',
        62
    ), (
        '2006012300022',
        'SEMMAÂ',
        'WALID',
        62
    ), (
        '2006020300015',
        'FARCHIOUI',
        'AMINA',
        62
    ), (
        '2006021100020',
        'BOUKDIR',
        'AYOUB',
        62
    ), (
        '2006040800006',
        'KALSADI',
        'AIMRANE',
        62
    );

--

-- Indexes for dumped tables

--

--

-- Indexes for table `absence`

--

ALTER TABLE `absence`
ADD
    PRIMARY KEY (`idAbsence`),
ADD
    KEY `absence_annee` (`idAnnee`),
ADD
    KEY `absence_anneescolaire` (`idAnneeScolaire`),
ADD
    KEY `absence_filiere` (`idFiliere`),
ADD
    KEY `absence_groupe` (`idGroupe`),
ADD
    KEY `absence_stagiaire` (`CEF`),
ADD
    KEY `absence_formatuer` (`matricule`);

--

-- Indexes for table `annee`

--

ALTER TABLE `annee`
ADD PRIMARY KEY (`idAnnee`),
ADD
    KEY `annee_anneescolaire` (`idAnneeScolaire`);

--

-- Indexes for table `anneescolaire`

--

ALTER TABLE `anneescolaire` ADD PRIMARY KEY (`idAnneeScolaire`);

--

-- Indexes for table `compte`

--

ALTER TABLE `compte` ADD PRIMARY KEY (`user`);

--

-- Indexes for table `filiere`

--

ALTER TABLE `filiere`
ADD
    PRIMARY KEY (`idFiliere`),
ADD
    KEY `filiere_annee` (`idAnnee`);

--

-- Indexes for table `formateur`

--

ALTER TABLE `formateur` ADD PRIMARY KEY (`Matricule`);

--

-- Indexes for table `groupe`

--

ALTER TABLE `groupe`
ADD
    PRIMARY KEY (`idGroupe`),
ADD
    KEY `group_filiere` (`idFiliere`);

--

-- Indexes for table `justifierabsence`

--

ALTER TABLE `justifierabsence`
ADD
    KEY `justifierabsence_absence` (`idAbsence`);

--

-- Indexes for table `note`

--

ALTER TABLE `note` ADD KEY `note_stagiaire` (`CEF`);

--

-- Indexes for table `stagiaire`

--

ALTER TABLE `stagiaire`
ADD PRIMARY KEY (`CEF`),
ADD
    KEY `satagiaire_groupe` (`idGroupe`);

--

-- AUTO_INCREMENT for dumped tables

--

--

-- AUTO_INCREMENT for table `absence`

--

ALTER TABLE
    `absence` MODIFY `idAbsence` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 19;

--

-- AUTO_INCREMENT for table `annee`

--

ALTER TABLE
    `annee` MODIFY `idAnnee` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--

-- AUTO_INCREMENT for table `anneescolaire`

--

ALTER TABLE
    `anneescolaire` MODIFY `idAnneeScolaire` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 2;

--

-- AUTO_INCREMENT for table `filiere`

--

ALTER TABLE
    `filiere` MODIFY `idFiliere` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 21;

--

-- AUTO_INCREMENT for table `groupe`

--

ALTER TABLE
    `groupe` MODIFY `idGroupe` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 63;

--

-- Constraints for dumped tables

--

--

-- Constraints for table `absence`

--

ALTER TABLE `absence`
ADD
    CONSTRAINT `absence_annee` FOREIGN KEY (`idAnnee`) REFERENCES `annee` (`idAnnee`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
    CONSTRAINT `absence_anneescolaire` FOREIGN KEY (`idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE
SET NULL ON UPDATE CASCADE,
ADD
    CONSTRAINT `absence_filiere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
    CONSTRAINT `absence_formatuer` FOREIGN KEY (`matricule`) REFERENCES `formateur` (`Matricule`) ON DELETE
SET NULL ON UPDATE
SET NULL,
ADD
    CONSTRAINT `absence_groupe` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
    CONSTRAINT `absence_stagiaire` FOREIGN KEY (`CEF`) REFERENCES `stagiaire` (`CEF`) ON DELETE CASCADE ON UPDATE CASCADE;

--

-- Constraints for table `annee`

--

ALTER TABLE `annee`
ADD
    CONSTRAINT `annee_anneescolaire` FOREIGN KEY (`idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE;

--

-- Constraints for table `filiere`

--

ALTER TABLE `filiere`
ADD
    CONSTRAINT `filiere_annee` FOREIGN KEY (`idAnnee`) REFERENCES `annee` (`idAnnee`) ON DELETE CASCADE ON UPDATE CASCADE;

--

-- Constraints for table `groupe`

--

ALTER TABLE `groupe`
ADD
    CONSTRAINT `group_filiere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`) ON DELETE CASCADE ON UPDATE CASCADE;

--

-- Constraints for table `justifierabsence`

--

ALTER TABLE `justifierabsence`
ADD
    CONSTRAINT `justifierabsence_absence` FOREIGN KEY (`idAbsence`) REFERENCES `absence` (`idAbsence`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--

-- Constraints for table `note`

--

ALTER TABLE `note`
ADD
    CONSTRAINT `note_stagiaire` FOREIGN KEY (`CEF`) REFERENCES `stagiaire` (`CEF`) ON DELETE CASCADE ON UPDATE CASCADE;

--

-- Constraints for table `stagiaire`

--

ALTER TABLE `stagiaire`
ADD
    CONSTRAINT `satagiaire_groupe` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;