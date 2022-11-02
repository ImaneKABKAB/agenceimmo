--CREATION DE LA BASE DE DONNEES AGENCE IMMO 

DROP DATABASE IF EXISTS `agenceimmo`;
CREATE DATABASE `agenceimmo`;
USE `agenceimmo`;

--CREATION DE LA TABLE ADMIN
CREATE TABLE `admin`(
    `id` INT(10) AUTO_INCREMENT,
    `prenom` varchar(15) NOT NULL,
    `nom` varchar(15) NOT NULL,
    `login` varchar(30) NOT NULL,
    `pass` varchar(30) NOT NULL UNIQUE,
    `password` varchar(50) NOT NULL UNIQUE,
     PRIMARY KEY (`id`)
) ENGINE=MyISAM ;

--CHARGEMENT DE LA TABLE ADMIN
INSERT INTO admin (`prenom`,`nom`,`login`,`password`) VALUES
 ('imane','kabkab','admin','admin','d033e22ae348aeb5660fc2140aec35850c4da997');

--CREATION DE LA TABLE CLIENT
CREATE TABLE `clients` (
    `CNI` varchar(10) ,
    `nom`  varchar(30) NOT NULL ,
    `adresse` varchar(30)   NOT NULL ,
    `genre` varchar(9)   NOT NULL ,
    `mail`  varchar(30)   NOT NULL  ,
    `tel`   char(10)  NOT NULL  UNIQUE,
    PRIMARY KEY (`CNI`)
) ENGINE=MyISAM ;

--CHARGEMENT DE LA TABLE CLIENTS
INSERT INTO `clients` (`CNI`,`nom` ,`adresse`,`genre`,`mail`,`tel`) VALUES
 ('B123456','moussaoui','7,rue test','femme','aaaabbbb@gmail.com','0612345673'),
 ('F123456','kabkab','10,bd test','femme','ikabkab13@gmail.com','0622345967');

--CREATION DE LA TABLE BIENS
CREATE TABLE `biens`(
    `id_bien` INT(30) AUTO_INCREMENT,
    `type`  varchar(30) NOT NULL,
    `adresse` varchar(30)  NOT NULL UNIQUE,
    `ville` varchar(15)  NOT NULL,
    `superficie` INT(10) UNSIGNED NOT NULL,
    `nbr_chambre` INT(10) UNSIGNED NOT NULL,
    `prix_men` INT(10)  UNSIGNED NOT NULL,
    `path` varchar(30) NOT NULL,
    PRIMARY KEY (`id_bien`)
) ENGINE=MyISAM ;

--CHARGEMENT DE LA TABLE BIEN
INSERT INTO `biens` (`type`,`adresse`,`ville`,`superficie`,`nbr_chambre`,`prix_men`,`path`) VALUES
('appartement','bd tachefin','RABAT',75,4,4000,'image/appa-tachfin.jpg'),
('appartement','bd alqods','Oujda',75,4,4000,'image/home.jpg'),
('appartement','bd badr','Casablanca',70,4,4000,'image/app-badr.jpg'),
('studio','rue Ahmed','Fes',30,1,500,'image/studio.jpg');

--CREATION DE LA TABLE LOCATION
CREATE TABLE `locations` (
    `id` INT(30) AUTO_INCREMENT,
    `CNI` varchar(15) ,
    `adresse` varchar(30) ,
    `date` DATETIME  NOT NULL,
    `de` DATE  NOT NULL,
    `a` DATE  NOT NULL,
    `duree` FLOAT(6,4)  UNSIGNED NOT NULL ,
    `prix` FLOAT(10,4)  UNSIGNED NOT NULL,
    PRIMARY KEY (`id`) ,
    FOREIGN KEY (`CNI`) REFERENCES `clients`(`CNI`) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (`adresse` ) REFERENCES `biens`(`adresse` ) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=MyISAM ;

--CHARGEMENT DE LA TABLE LOCATIONS
INSERT INTO `locations`(`CNI`,`adresse`,`date`,`de`,`a`,`duree`,`prix`) VALUES
('H134567','rue Ahmed','2022-05-14 02:31','2022-05-14','2022-05-20',0.2,100),
('H134566','bd badr ','2022-05-14 02:31','2022-05-14','2022-05-20',0.2,800);

--CREATION DE LA TABLE DEMANDES
CREATE TABLE `demandes`(
    `id` INT(10) AUTO_INCREMENT,
    `nom_complet` varchar(30) NOT NULL,
    `mail` varchar(30) NOT NULL,
    `tel` char(10) NOT NULL,
    `text` varchar(70) NOT NULL,
    `statut` INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`) 
)ENGINE=MyISAM ;

--CREATION DE LA TABLE PROPOSITIONS
CREATE TABLE `propositions`(
    `id` INT(10) AUTO_INCREMENT,
    `nom_complet` varchar(30) NOT NULL,
    `mail` varchar(30) NOT NULL,
    `tel`  char(10)  NOT NULL  ,
    `type` varchar(15) NOT NULL,
    `addr_bien` varchar(30)  NOT NULL ,
    `statut` INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`) 
)ENGINE=MyISAM ;

