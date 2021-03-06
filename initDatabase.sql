-- Groupe N°032 -  Orlane GUILLET, Maxime ONILLON, Aline REBOUT, Achil MICHEL
-- bcp pour bactepedia

-- désactivation de la vérification des clées étrangères pour suppression des tables
SET foreign_key_checks = 0;

DROP TABLE IF EXISTS bcp__typeetude, bcp__user, bcp__article, bcp__favoris, bcp__asavoir, bcp__forme, bcp__bacterie, bcp__atteint, bcp__zonecorps, bcp__provoquemaladie, bcp__maladie, bcp__provoquesymptome, bcp__symptome, bcp__resistance, bcp__antibiotique, bcp__pousse, bcp__milieu, bcp__estmensione, bcp__fichetechnique, bcp__applique, bcp__techniqueencemensement;

SET foreign_key_checks = 1;

-- création des tables
CREATE TABLE bcp__typeetude(
    nom_typeEtude VARCHAR(255) PRIMARY KEY NOT NULL
);

CREATE TABLE bcp__user(
    id_user INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom_user VARCHAR(50) NOT NULL,
    prenom_user VARCHAR(50) NOT NULL,
    ddn_user DATE NOT NULL,
    email_user VARCHAR(255) NOT NULL,
    password_user TEXT NOT NULL,
    lienInternePhoto_user TEXT NULL,
    estProfessionnel_user BOOLEAN NOT NULL,
    nom_typeEtude VARCHAR(255) NULL,
    lienInterneJustificatif_user TEXT NULL,
    justificatifValide_user BOOLEAN NULL,
    emailValide_user BOOLEAN NOT NULL,
    NbModification_user INTEGER NULL,
    NbSuppression_user INTEGER NULL,
    NbAjout_user INTEGER NULL
);

CREATE TABLE bcp__article(
    id_article INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titre_article VARCHAR(255) NOT NULL,
    auteur_article TEXT NOT NULL,
    extrait_article LONGTEXT NULL,
    LienSource_article TEXT NOT NULL,
    datePublication_article DATE NOT NULL,
    id_bacterie INTEGER NOT NULL
);

CREATE TABLE bcp__favoris(
    id_bacterie INTEGER NOT NULL,
    id_user INTEGER NOT NULL
);

CREATE TABLE bcp__asavoir(
    id_bacterie INTEGER NOT NULL,
    id_user INTEGER NOT NULL,
    connu_aSavoir BOOLEAN NOT NULL -- True si bacterie connue, false si non
);

CREATE TABLE bcp__forme(
    nom_forme VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__bacterie(
    id_bacterie INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    genre_bacterie VARCHAR(255) NOT NULL,
    espece_bacterie VARCHAR(255) NOT NULL,
    serovar_bacterie VARCHAR(255) NULL,
    gram_bacterie VARCHAR(255) NOT NULL,
    LienInterneImage_bacterie TEXT NULL,
    visible_bacterie BOOLEAN NOT NULL,
    nbConsultation_bacterie INTEGER NOT NULL DEFAULT 0,
    nbModification_bacterie INTEGER NOT NULL DEFAULT 0,
    nbRecherche_bacterie INTEGER NOT NULL DEFAULT 0,
    dateModif_bacterie DATETIME NOT NULL,
    temperatureOptimale_bacterie INTEGER NULL,
    prophylaxie_bacterie LONGTEXT NULL,
    nom_forme VARCHAR(255) NOT NULL
);

CREATE TABLE bcp__atteint(
    id_bacterie INTEGER NOT NULL,
    nom_zoneCorps VARCHAR(255) NOT NULL
);

CREATE TABLE bcp__zonecorps(
    nom_zoneCorps VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__provoquemaladie(
	id_bacterie INTEGER NOT NULL,
	nom_maladie VARCHAR(255) NOT NULL
);

CREATE TABLE bcp__maladie(
	nom_maladie VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__provoquesymptome(
	id_bacterie INTEGER NOT NULL,
	nom_symptome VARCHAR(255) NOT NULL
);

CREATE TABLE bcp__symptome(
	nom_symptome VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__resistance(
	id_bacterie INTEGER NOT NULL,
	nom_antibiotique VARCHAR(255) NOT NULL	
);

CREATE TABLE bcp__antibiotique(
	nom_antibiotique VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__pousse(
	id_bacterie INTEGER NOT NULL,
	id_milieu INTEGER NOT NULL
);

CREATE TABLE bcp__milieu(
	id_milieu INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nature_milieu VARCHAR(255) NOT NULL,
	empirique_milieu BOOLEAN NULL,
	synthetique_milieu BOOLEAN NULL,
	semiSynthetique_milieu BOOLEAN NULL,
	ordinaire_milieu BOOLEAN NULL,
	enrichi_milieu BOOLEAN NULL,
	oriantation_milieu BOOLEAN NULL,
	isolement_milieu BOOLEAN NULL,
	identification_milieu BOOLEAN NULL,
	enrichissement_milieu BOOLEAN NULL,
	conservation_milieu BOOLEAN NULL,
	composition_milieu TEXT NULL,
	utilisation_milieu TEXT NULL,
	lecture_milieu TEXT NULL,
	lectureResultat_milieu LONGTEXT NULL,
	cout_milieu INTEGER NULL,
	etat_milieu VARCHAR(255) NULL,
	LienInterneImage_milieu TEXT NULL
);

CREATE TABLE bcp__applique(
	id_milieu INTEGER NOT NULL,
	nom_techniqueEncemensement VARCHAR(255) NOT NULL
);

CREATE TABLE bcp__techniqueencemensement(
	nom_techniqueEncemensement VARCHAR(255) NOT NULL PRIMARY KEY
);

CREATE TABLE bcp__estmensione (
	id_milieu INTEGER NOT NULL,
	id_ficheTechnique INTEGER NOT NULL
);

CREATE TABLE bcp__fichetechnique(
	id_ficheTechnique INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	titre_ficheTechnique TEXT NOT NULL,
	LienInterneFichier_ficheTechnique TEXT NOT NULL
);


-- création des clées étrangères
ALTER TABLE bcp__user ADD FOREIGN KEY (nom_typeEtude) REFERENCES bcp__typeetude(nom_typeEtude);

ALTER TABLE bcp__favoris ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__favoris ADD FOREIGN KEY (id_user) REFERENCES bcp__user(id_user);

ALTER TABLE bcp__asavoir ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__asavoir ADD FOREIGN KEY (id_user) REFERENCES bcp__user(id_user);

ALTER TABLE bcp__article ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);

ALTER TABLE bcp__bacterie ADD FOREIGN KEY (nom_forme) REFERENCES bcp__forme(nom_forme);

ALTER TABLE bcp__atteint ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__atteint ADD FOREIGN KEY (nom_zoneCorps) REFERENCES bcp__zonecorps(nom_zoneCorps);

ALTER TABLE bcp__provoquemaladie ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__provoquemaladie ADD FOREIGN KEY (nom_maladie) REFERENCES bcp__maladie(nom_maladie);

ALTER TABLE bcp__provoquesymptome ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__provoquesymptome ADD FOREIGN KEY (nom_symptome) REFERENCES bcp__symptome(nom_symptome);

ALTER TABLE bcp__resistance ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__resistance ADD FOREIGN KEY (nom_antibiotique) REFERENCES bcp__antibiotique(nom_antibiotique);

ALTER TABLE bcp__pousse ADD FOREIGN KEY (id_bacterie) REFERENCES bcp__bacterie(id_bacterie);
ALTER TABLE bcp__pousse ADD FOREIGN KEY (id_milieu) REFERENCES bcp__milieu(id_milieu);

ALTER TABLE bcp__applique ADD FOREIGN KEY (id_milieu) REFERENCES bcp__milieu(id_milieu);
ALTER TABLE bcp__applique ADD FOREIGN KEY (nom_techniqueEncemensement) REFERENCES bcp__techniqueencemensement(nom_techniqueEncemensement);

ALTER TABLE bcp__estmensione ADD FOREIGN KEY (id_milieu) REFERENCES bcp__milieu(id_milieu);
ALTER TABLE bcp__estmensione ADD FOREIGN KEY (id_ficheTechnique) REFERENCES bcp__fichetechnique(id_ficheTechnique);



