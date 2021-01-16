-- le but est de remplir la base de donnée avec des données de test

-- Ajout des différentes formes
INSERT INTO bcp__forme VALUES ('Coque'), ('Diplocoque'), ('Staphylocoque'), ('Streptocoque'), ('Sarcina'), ('Tétrade'), ('Coque en amas');
INSERT INTO bcp__forme VALUES ('Coccobacille'), ('Bacille'), ('Diplobacille'), ('Palissade'), ('Streptobacille'), ('Bacille fusiforme');
INSERT INTO bcp__forme VALUES ('Vibrions'), ('Spirille'), ('Borrelia'), ('Treponeme'), ('Leptospire');

-- Ajout des différents milieux (sans les photos)
INSERT INTO bcp__milieu VALUES
    (NULL, 'BCP', 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 'Peptone, Extrait de viande, lactose, agar, pourpre de bromocrésol', 'Ce milieu est couramment utilisé au cours de l\'examen bactériologique des urines et des selles. Après ensemencement, le milieu est incubé à 37°C pendant 18 à 24 heures avant d\'être examiné. Ce délai ne doit pas être dépassé sous peine d\'entraîner des erreurs d\'interprétation.', 'La fermentation du lactose se manifeste par une production d\'acide qui entraîne le virage de l\'inducateur au jaune. Les colonies bleues proviennent de bactéries lactose -.', NULL, NULL, 'Solide', NULL),
    (NULL, 'CASO', 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 'Tryptone, hydrolysat de caséine, peptone papaïnique de soja, chlorure de sodium, agar agar', NULL, NULL, NULL, 2, 'Solide', NULL),
    (NULL, 'Chapman', 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 'Peptone, extrait de viande de bœuf, chlorure de sodium, manitol, rouge de phénol, agar agar', 'Le milieu de Chapman est utilisé pour l\'isolement des staphylocoques. Le pouvoir inhibiteur du chlorure de sodium permet d\'ensemencer abondamment les boites de Pétri. La lecture des résultats est effectuée après 24 à 48h d\'incubation à 37°C.', 'Les souche de S. aureus forment', NULL, 13, 'Solide', NULL);

-- Ajout des différentes techniques d'ensemencement
INSERT INTO bcp__techniqueencemensement VALUES ('Ecouvillonnage'), ('Rateau'), ('Ance de platine');

-- Ajout des différents antibiotiques
INSERT INTO bcp__antibiotique VALUES ('Aminosides'), ('Carbapénèmes'), ('Céphalosporines'), ('Fluoroquinolones'), ('Glycopeptides'), ('Kétolides'), ('Macrolides'), ('Monobactames'), ('Oxazolidinones'), ('Pénicillines'), ('Polypeptides'), ('Rifamycines'), ('Sulfamides'), ('Streptogramines'), ('Tétracyclines'), ('Lipoglycopeptides');

-- Ajout des différents symptomes
INSERT INTO bcp__symptome VALUES ('Fièvre'), ('Toux sèche'), ('Fatigue'), ('Expectorations ou flegme épais des poumons'), ('Essoufflement'), ('Douleurs osseuses ou articulaires'), ('Maux de gorge'), ('Maux de tête'), ('Frissons'), ('Nausées ou vomissements'), ('Nez bouché'), ('Diarrhée'), ('Toux de sang'), ('Yeux gonflés');

-- Ajout des maladies
INSERT INTO bcp__maladie VALUES ('l’angine'), ('l’otite'), ('la sinusite'), ('la bronchite'), ('la pneumonie'), ('la tuberculose'), ('les ulcères'), ('la gastro-entérite'), ('la cholécystite'), ('la sigmoïdite'), ('l’angiocholite aiguë'), ('la pancréatite aiguë'), ('la syphilis'), ('les furoncles'), ('les abcès'), ('les panaris'), ('les impétigos'), ('les infections urinaires'), ('les infections génitales'), ('La maladie de Lyme'), ('La méningite'), ('Les abcès au cerveau'), ('la listériose'), ('la salmonellose'), ('la toxoplasmose'), ('la peste noire');

-- Ajout des zones du corps
INSERT INTO bcp__zonecorps VALUES ('Abdominale: régions de la paroi antérieure de l\'abdomen'), ('Antérieur du carpe: poignet'),('Antérieur du cou: face avant du cou'),('Antérieur du genou: face avant du genou'),('Axillaire: aisselle'),('Brachiale antérieure: face avant du bras'),('Buccale: joue'),('Coxale: hanche'),('Crurale antérieure: face avant de la jambe'),('Cubitale antérieure: face avant du coude'),('Deltoïdienne: saillie de l\'épaule'),('Digitale: doigts de la main'),('Fémorale antérieure: face avant de la cuisse'),('Fibulaire: côté extérieur de la jambe'),('Inguinale: région où la cuisse rejoint le tronc; aine'),('Nasale: nez'),('Ombilicale: ombilic'),('Orale: bouche'),('Orbitaire: œil'),('Pectorale: régions de la poitrine'),('Pelvienne: bassin'),('Présternale: région du sternum'),('Pubienne: région située au-dessus du pubis'),('Talocrurale antérieure: cheville'),('Crâne'),('Face'),('Orbite'),('Œil'),('Bouche'),('Langue'),('Dents'),('Glande salivaire'),('Nez'),('Oreilles'),('Cuir chevelu'),('Pharynx'),('Méninges'),('Cerveau'),('Glande thyroïde'),('Glande parathyroïde'),('Parois du corps'),('Péritoine'),('Mésentère'),('Estomac'),('Rate'),('Pancréas'),('Foie'),('Vésicule biliaire'),('Intestin grêle'),('Duodénum'),('Jéjunum'),('Iléon'),('Gros intestin'),('Cæcum'),('Appendice iléo-cæcal'),('Côlon'),('Reins'),('Glandes surrénales'),('Bassin osseux'),('Sacrum'),('Coccyx'),('Pubis'),('Vessie'),('Ovaire'),('Trompe de Fallope'),('Utérus'),('Vagin'),('Vulve'),('Clitoris'),('Périnée'),('Testicules'),('Pénis humain'),('Rectum');

-- Ajout des type d'étude
INSERT INTO bcp__typeetude VALUES ('DUT'), ('Fac'), ('BTS'), ('Master'), ('Doctorat'), ('Ingénieur');

-- Ajout des utilisateurs
INSERT INTO bcp__user VALUES
    (NULL, 'ONILLON', 'Maxime', '2000-11-08', 'monillon@outlook.fr', 'TRUC', 'upload/photoUser/photoUser1.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'GUILLET', 'Orlane', '1999-12-06', 'guilletorlane@gmail.com', 'MACHIN', 'upload/photoUser/photoUser2.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'MICHEL', 'Achil', '2000-03-13', 'michel.achil@orange.fr', 'BIDULE', 'upload/photoUser/photoUser3.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'REBOUT', 'Aline', '2000-05-16', 'aline.rebout@outlook.fr', 'CHOSE', 'upload/photoUser/photoUser4.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'MABILEAU', 'Fabienne', '1980-07-17', 'fabienne.mabileau@domaine.Fr', 'JadoreLesBacteries', 'upload/photoUser/photoUser5.jpg', 1, 'Master', 'upload/justificatif/justificatif1.pdf', 1, 1),
    (NULL, 'FAGOT', 'Sophie', '1970-10-20', 'sophie.fagot@domaine.fr', 'ANGERS', 'upload/photoUser/photoUser6.jpg', 1, 'Master', 'upload/justificatif/justificatif2.pdf', 0, 0);


-- Ajout des bactéries
INSERT INTO bcp__bacterie VALUES
    (NULL, 'Escherichia', 'coli', NULL, 'Positif', 'upload/photoBacterie/escherichia_coli.jpg', 1, 0, 0, 0, '2021-01-14 20:25:00', 37, NULL, 'Bacille'),
    (NULL, 'Yersinia', 'pestis', NULL, 'Negatif', 'upload/photoBacterie/yersinia_pestis.png', 1, 0, 0, 0, '2021-01-14 20:25:00', NULL, NULL, 'Bacille'),
    (NULL, 'Lactobacillus', 'rhamnosus', NULL, 'Positif', 'upload/photoBacterie/Lactobacillus_rhamnosus.png', 1, 0, 0, 0, '2021-01-14 20:25:00',37, NULL, 'Bacille');






