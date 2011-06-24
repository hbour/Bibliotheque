-- MySQL
-- Base de données Bibliotheque
-- Insertions de données


-- Table : T_Type_ouvrage

INSERT INTO T_Type_ouvrage VALUES ('Livre');
INSERT INTO T_Type_ouvrage VALUES ('CD');
INSERT INTO T_Type_ouvrage VALUES ('DVD');


-- Table : T_Ouvrages
-- Livres (code ouvrage : numéro ISBN)
INSERT INTO T_Ouvrages VALUES ('978-2070360536', 'Livre', 'Isaac Asimov', 'Fondation',
'Editions Gallimard', 'Folio SF', '2009-03-26', 'Science-fiction');
INSERT INTO T_Ouvrages VALUES ('978-2070360550', 'Livre', 'Isaac Asimov', 'Fondation et Empire',
'Editions Gallimard', 'Folio SF', '2009-03-26', 'Science-fiction');
INSERT INTO T_Ouvrages VALUES ('978-2070360529', 'Livre', 'Isaac Asimov', 'Seconde Fondation',
'Editions Gallimard', 'Folio SF', '2009-03-26', 'Science-fiction');
INSERT INTO T_Ouvrages VALUES ('978-2246269328', 'Livre', 'Joseph Heller', 'Catch 22',
'Grasset & Fasquelle', 'Les cahiers rouges', '2004-06-02', 'Comédie');
INSERT INTO T_Ouvrages VALUES ('978-2070328291', 'Livre', 'Baruch de Spinoza', 'L\'Ethique',
'Gallimard', 'Folio', '1994-01-13', 'Philosophie');
-- CD (code ouvrage : numéro ASIN)
INSERT INTO T_Ouvrages VALUES ('B004IXJEWK', 'CD', 'PJ Harvey', 'Let England Shake',
'Az', NULL, '2011-02-14', 'Pop-rock');
INSERT INTO T_Ouvrages VALUES ('B004H1Z65M', 'CD', 'Lykke Li', 'Wounded Rhymes',
'Wea', NULL, '2011-02-28', 'Pop-rock');
INSERT INTO T_Ouvrages VALUES ('B004K46Q64', 'CD', 'The Do', 'Both Ways Open Jaws',
'Cinq 7', NULL, '2011-03-07', 'Pop-rock');
INSERT INTO T_Ouvrages VALUES ('B000001GOZ', 'CD', 'Gustav Mahler', 'Symphonie n°6',
'Deutsche Grammophon', NULL, '2000-03-06', 'Classique');
-- DVD (code ouvrage : numéro ASIN)
INSERT INTO T_Ouvrages VALUES ('B004OHEU10 ', 'DVD', 'Carl Theodor Dreyer', 'La Passion de Jeanne d\'Arc',
'Criterion', NULL, '1999-10-19', 'Historique');
INSERT INTO T_Ouvrages VALUES ('B000H6SYBY', 'DVD', 'Terrence Malick', 'Le Nouveau Monde',
'Metropolitan Vidéo', NULL, '2006-10-05', 'Aventure');
INSERT INTO T_Ouvrages VALUES ('B0008GRSWY', 'DVD', 'Wong Kar-Wai', 'Chungking Express',
'ARP Sélection', NULL, '2005-05-26', 'Romantique');


-- Table : T_Disponibilites
INSERT INTO T_Disponibilites VALUES ('Présent');
INSERT INTO T_Disponibilites VALUES ('Emprunté');
INSERT INTO T_Disponibilites VALUES ('Réservé');
INSERT INTO T_Disponibilites VALUES ('Supprimé');


-- Table : T_Exemplaires
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('978-2070360536', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('978-2070360550', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('978-2070360529', 'Emprunté');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('978-2246269328', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('978-2070328291', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B004IXJEWK', 'Réservé');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B004H1Z65M', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B004K46Q64', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B000001GOZ', 'Supprimé');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B004OHEU10', 'Présent');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B000H6SYBY', 'Emprunté');
INSERT INTO T_Exemplaires (OUV_ID, DIS_Disponibilite) VALUES ('B0008GRSWY', 'Présent');


-- Table : T_CATEGORIES_USAGERS
INSERT INTO T_CATEGORIES_USAGERS VALUES ('Etudiant');
INSERT INTO T_CATEGORIES_USAGERS VALUES ('Professeur');
INSERT INTO T_CATEGORIES_USAGERS VALUES ('Bibliothecaire');
INSERT INTO T_CATEGORIES_USAGERS VALUES ('Administrateur');


-- Table : TJ_Limiter_emprunts
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Etudiant', 'Livre', 3, 2);
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Etudiant', 'CD', 2, 2);
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Etudiant', 'DVD', 1, 2);
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Professeur', 'Livre', 8, 4);
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Professeur', 'CD', 4, 4);
INSERT INTO TJ_Limiter_emprunts (CAT_Categorie, TYP_Support, LIM_Quantite, LIM_Duree)
VALUES ('Professeur', 'DVD', 2, 4);


-- Table : T_Usagers
INSERT INTO T_Usagers (CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite, 
USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email)
VALUES ('Bibliothecaire', 'Hdo9;?VG51', '2012-01-10', 'Giles', 'Rupert',
'123 Sunset blvd 91456 Sunnydale, CA', '555-1234', 'r.giles@sdhigh.com');
INSERT INTO T_Usagers (CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite, 
USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email)
VALUES ('Etudiant', 'Y,8hP:91', '2012-09-04', 'Rosenberg', 'Willow',
'13 River street 91456 Sunnydale, CA', '555-1234', 'wilrose@gmail.com');
INSERT INTO T_Usagers (CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite, 
USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email)
VALUES ('Etudiant', 'h0m3R', '2012-09-05', 'Harris', 'Xander',
'58 Sunset blvd 91456 Sunnydale, CA', '555-1234', 'xander91@hotmail.com');
INSERT INTO T_Usagers (CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite, 
USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email)
VALUES ('Professeur', 'mth4vr', '2012-09-05', 'Maggie', 'Walsh',
'940 Elders road 91456 Sunnydale, CA', '555-1234', 'm.walsh@sdhigh.com');
INSERT INTO T_Usagers (CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite, 
USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email)
VALUES ('Administrateur', 'r00t', '2012-08-20', 'Richard', 'Wilkins',
'1 City Hotel place 91456 Sunnydale, CA', '555-1234', 'major@sunnydale.com');


-- Table : TJ_Emprunter
INSERT INTO TJ_Emprunter VALUES (2, 3, '2011-02-24', FALSE);
INSERT INTO TJ_Emprunter VALUES (4, 6, '2011-03-01', TRUE);
INSERT INTO TJ_Emprunter VALUES (2, 11, '2011-02-24', FALSE);


-- Table : TJ_Reserver
INSERT INTO TJ_Reserver VALUES (3, 6, '2011-03-12', TRUE);


-- Table : T_Relances
INSERT INTO T_Relances (USA_ID, EXE_Code_exemplaire, REL_Date_envoi_email) 
VALUES (3, 1, '2011-10-22');
INSERT INTO T_Relances (USA_ID, EXE_Code_exemplaire, REL_Date_envoi_email) 
VALUES (3, 1, '2011-10-29');

