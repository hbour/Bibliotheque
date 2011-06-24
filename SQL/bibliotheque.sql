-- MySQL
-- Base de donnée Bibliotheque

-- Création de la base

CREATE DATABASE Bibliotheque;


-- Dans Bibliotheque
-- Si la table existait avant (réinstallation)

DROP TABLE IF EXISTS TJ_Emprunter;
DROP TABLE IF EXISTS T_Relances;
DROP TABLE IF EXISTS TJ_Reserver;
DROP TABLE IF EXISTS T_Usagers;
DROP TABLE IF EXISTS T_Exemplaires;
DROP TABLE IF EXISTS T_Ouvrages;
DROP TABLE IF EXISTS T_Disponibilites;
DROP TABLE IF EXISTS TJ_Limiter_emprunts;
DROP TABLE IF EXISTS T_Categories_usagers;
DROP TABLE IF EXISTS T_Type_ouvrage;


-- Création des tables
-- Table : TJ_Emprunter

CREATE TABLE TJ_Emprunter
(
	USA_ID					INT(8) NOT NULL,
	EXE_Code_exemplaire		INT(4) NOT NULL,
	EMP_Date				DATE NOT NULL,
	EMP_En_cours			BOOL NOT NULL DEFAULT TRUE,
	PRIMARY KEY (USA_ID, EXE_Code_exemplaire, EMP_Date)
) TYPE = InnoDB;


-- Table : T_Categories_usagers

CREATE TABLE T_Categories_usagers
(
	CAT_Categorie			VARCHAR(50) NOT NULL,
	PRIMARY KEY (CAT_Categorie)
) TYPE = InnoDB;


-- Table : T_Disponibilites

CREATE TABLE T_Disponibilites
(
	DIS_Disponibilite		VARCHAR(50) NOT NULL,
	PRIMARY KEY (DIS_Disponibilite)
) TYPE = InnoDB;


-- Table : T_Exemplaires

CREATE TABLE T_Exemplaires
(
	EXE_Code_exemplaire		INT(4) NOT NULL AUTO_INCREMENT,
	OUV_ID					VARCHAR(25) NOT NULL,
	DIS_Disponibilite		VARCHAR(50) NOT NULL,
	PRIMARY KEY (EXE_Code_exemplaire)
) TYPE = InnoDB;


-- Table : T_Ouvrages

CREATE TABLE T_Ouvrages
(
	OUV_ID					VARCHAR(25) NOT NULL,
	TYP_Support				VARCHAR(16) NOT NULL,
	OUV_Auteur				VARCHAR(50) NOT NULL,
	OUV_Titre				VARCHAR(100) NOT NULL,
	OUV_Editeur				VARCHAR(50) NOT NULL,
	OUV_Collection			VARCHAR(50) NULL,
	OUV_Date_parution		DATE NOT NULL,
	OUV_Theme				VARCHAR(50) NOT NULL,
	PRIMARY KEY (OUV_ID)
) TYPE = InnoDB;


-- Table : T_Relances

CREATE TABLE T_Relances
(
	REL_Numero_ID			INT(8) NOT NULL AUTO_INCREMENT,
	USA_ID					INT(8) NOT NULL,
	EXE_Code_exemplaire		INT(4) NOT NULL,
	REL_Date_envoi_email	DATE NOT NULL,
	PRIMARY KEY (REL_Numero_ID)
) TYPE = InnoDB;


-- Table : TJ_Reserver

CREATE TABLE TJ_Reserver
(
	USA_ID					INT(8) NOT NULL,
	EXE_Code_exemplaire		INT(4) NOT NULL,
	RES_Date				DATE NOT NULL,
	RES_EN_COURS			BOOL NOT NULL DEFAULT TRUE,
	PRIMARY KEY (USA_ID, EXE_Code_exemplaire, RES_DATE)
) TYPE = InnoDB;


-- Table : T_Type_ouvrage

CREATE TABLE T_Type_ouvrage
(
	TYP_Support				VARCHAR(16) NOT NULL,
	PRIMARY KEY (TYP_Support)
) TYPE = InnoDB;


-- Table : T_Usagers

CREATE TABLE T_Usagers
(
	USA_ID					INT(8) NOT NULL AUTO_INCREMENT,
	CAT_Categorie			VARCHAR(50) NOT NULL,
	USA_Motdepasse			VARCHAR(50) NOT NULL,
	USA_Date_fin_validite	DATE NOT NULL,
	USA_Nom					VARCHAR(50) NOT NULL,
	USA_Prenom				VARCHAR(50) NOT NULL,
	USA_Adresse				VARCHAR(200) NOT NULL,
	USA_Tel					VARCHAR(25) NOT NULL,
	USA_Email				VARCHAR(50) NOT NULL,
	USA_Retard				BOOL NOT NULL DEFAULT FALSE,
	PRIMARY KEY (USA_ID)
) TYPE = InnoDB;


-- Table : TJ_Limiter_emprunts

CREATE TABLE TJ_Limiter_emprunts
(
   CAT_Categorie        VARCHAR(50) NOT NULL,
   TYP_Support             VARCHAR(16) NOT NULL,
   LIM_Quantite         INT NOT NULL,
   LIM_Duree            INT NOT NULL,
   PRIMARY KEY (TYP_Support, CAT_Categorie)
) TYPE = InnoDB;


-- Déclaration des clés étrangères

ALTER TABLE TJ_Emprunter ADD CONSTRAINT FK_TJ_Emprunter FOREIGN KEY (USA_ID)
REFERENCES T_Usagers (USA_ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE TJ_Emprunter ADD CONSTRAINT FK_TJ_Emprunter2 FOREIGN KEY (EXE_Code_exemplaire)
REFERENCES T_Exemplaires (EXE_Code_exemplaire) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Exemplaires ADD CONSTRAINT FK_TJ_Caracteriser FOREIGN KEY (DIS_Disponibilite)
REFERENCES T_Disponibilites (DIS_Disponibilite) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Exemplaires ADD CONSTRAINT FK_TJ_Correspondre FOREIGN KEY (OUV_ID)
REFERENCES T_Ouvrages (OUV_ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Ouvrages ADD CONSTRAINT FK_Typer FOREIGN KEY (TYP_Support)
REFERENCES T_Type_ouvrage (TYP_Support) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Relances ADD CONSTRAINT FK_TJ_Avertir FOREIGN KEY (USA_ID)
REFERENCES T_Usagers (USA_ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Relances ADD CONSTRAINT FK_TJ_Manquer FOREIGN KEY (EXE_Code_exemplaire)
REFERENCES T_Exemplaires (EXE_Code_exemplaire) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE TJ_Reserver ADD CONSTRAINT FK_TJ_Reserver FOREIGN KEY (USA_ID)
REFERENCES T_Usagers (USA_ID) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE TJ_Reserver ADD CONSTRAINT FK_TJ_Reserver2 FOREIGN KEY (EXE_Code_exemplaire)
REFERENCES T_Exemplaires (EXE_Code_exemplaire) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE T_Usagers ADD CONSTRAINT FK_Grouper FOREIGN KEY (CAT_Categorie)
REFERENCES T_Categories_usagers (CAT_Categorie) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE TJ_Limiter_emprunts ADD CONSTRAINT FK_TJ_Limiter_emprunts FOREIGN KEY (TYP_Support)
REFERENCES T_Type_ouvrage (TYP_Support) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE TJ_Limiter_emprunts ADD CONSTRAINT FK_TJ_Limiter_emprunts2 FOREIGN KEY (CAT_Categorie)
REFERENCES T_Categories_usagers (CAT_Categorie) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- Triggers

DELIMITER //

CREATE TRIGGER ValideEmprunter
BEFORE INSERT ON TJ_Emprunter
FOR EACH ROW
BEGIN

	SELECT COUNT(e.USA_ID)
	FROM TJ_Emprunter e
	WHERE e.USA_ID = NEW.USA_ID
	AND EMP_En_cours = TRUE
	INTO @nbEmprunts;
		
	SELECT DISTINCT LIM_Quantite
	FROM TJ_Limiter_emprunts
	WHERE CAT_Categorie = (
		SELECT DISTINCT CAT_Categorie
		FROM T_Usagers u
		JOIN TJ_Emprunter e
		ON e.USA_ID = u.USA_ID
		WHERE u.USA_ID = NEW.USA_ID
		)
	AND TYP_Support = (
		SELECT DISTINCT TYP_Support
		FROM T_Ouvrages o
		JOIN T_Exemplaires x
		ON x.OUV_ID = o.OUV_ID
		WHERE x.EXE_Code_exemplaire = NEW.EXE_Code_exemplaire
		)
	INTO @limQuantite;
	
	IF (
		SELECT DISTINCT USA_Retard
		FROM T_Usagers u
		JOIN TJ_Emprunter e
		ON e.USA_ID = u.USA_ID
		WHERE u.USA_ID = NEW.USA_ID
		) 
	= TRUE THEN
		SELECT 0 FROM `Emprunt interdit par USA_Retard (trigger ValidEmprunter).` 
		INTO @error;
	END IF;
		
	IF @nbEmprunts > @limQuantite THEN
		SELECT 0 FROM `Emprunt interdit par LIM_Quantite (trigger ValidEmprunter).`
		INTO @error;
	END IF;
	
	UPDATE T_Exemplaires
	SET DIS_Disponibilite = 'Emprunté'
	WHERE EXE_Code_exemplaire = (
		SELECT EXE_Code_exemplaire
		FROM TJ_Emprunter
		WHERE EXE_Code_exemplaire = NEW.EXE_Code_exemplaire
		);
		
END //

DELIMITER ;


/* tests du trigger

select * from TJ_Emprunter where usa_id = 2 and emp_en_cours = true;

INSERT INTO TJ_Emprunter VALUES (2, 1, '2011-03-01', TRUE);
INSERT INTO TJ_Emprunter VALUES (2, 2, '2011-03-01', TRUE);
INSERT INTO TJ_Emprunter VALUES (2, 3, '2011-03-01', TRUE);

DELETE FROM `bibliotheque`.`tj_emprunter` 
WHERE `tj_emprunter`.`USA_ID` = 2 AND `tj_emprunter`.`EXE_Code_exemplaire` = 1 
AND `tj_emprunter`.`EMP_Date` = '2011-03-01' LIMIT 1;
DELETE FROM `bibliotheque`.`tj_emprunter` 
WHERE `tj_emprunter`.`USA_ID` = 2 AND `tj_emprunter`.`EXE_Code_exemplaire` = 2 
AND `tj_emprunter`.`EMP_Date` = '2011-03-01' LIMIT 1;
DELETE FROM `bibliotheque`.`tj_emprunter` 
WHERE `tj_emprunter`.`USA_ID` = 2 AND `tj_emprunter`.`EXE_Code_exemplaire` = 3 
AND `tj_emprunter`.`EMP_Date` = '2011-03-01' LIMIT 1;

drop trigger valideemprunter;

*/