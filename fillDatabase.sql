-- le but est de remplir la base de donnée avec des données de test

-- réglage de l'encodage
SET CHARSET 'utf8';

-- Ajout des différentes formes
INSERT INTO bcp__forme VALUES
    ('Bacille'),
    ('Bacille fusiforme'),
    ('Borrelia'),
    ('Coccobacille'),
    ('Coque'),
    ('Coque en amas'),
    ('Diplobacille'),
    ('Diplocoque'),
    ('Leptospire'),
    ('Palissade'),
    ('Sarcina'),
    ('Spirille'),
    ('Staphylocoque'),
    ('Streptobacille'),
    ('Streptocoque'),
    ('Tétrade'),
    ('Treponeme'),
    ('Vibrions'),
    ('Helicoïdale');

-- Ajout des différents milieux
INSERT INTO bcp__milieu VALUES
    (NULL, 'BCP', 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 'Peptone, Extrait de viande, lactose, agar, pourpre de bromocrésol', 'Ce milieu est couramment utilisé au cours de l\'examen bactériologique des urines et des selles. Après ensemencement, le milieu est incubé à 37°C pendant 18 à 24 heures avant d\'être examiné. Ce délai ne doit pas être dépassé sous peine d\'entraîner des erreurs d\'interprétation.', 'La fermentation du lactose se manifeste par une production d\'acide qui entraîne le virage de l\'inducateur au jaune. Les colonies bleues proviennent de bactéries lactose -.', NULL, NULL, 'Solide', 'upload/photoMilieu/photoMilieu1.png'),
    (NULL, 'CASO', 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 'Tryptone, hydrolysat de caséine, peptone papaïnique de soja, chlorure de sodium, agar agar', NULL, NULL, NULL, 2, 'Solide', 'upload/photoMilieu/photoMilieu2.jpg'),
    (NULL, 'Chapman', 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 'Peptone, extrait de viande de bœuf, chlorure de sodium, manitol, rouge de phénol, agar agar', 'Le milieu de Chapman est utilisé pour l\'isolement des staphylocoques. Le pouvoir inhibiteur du chlorure de sodium permet d\'ensemencer abondamment les boites de Pétri. La lecture des résultats est effectuée après 24 à 48h d\'incubation à 37°C.', 'Les souche de S. aureus forment ', NULL, 13, 'Solide', 'upload/photoMilieu/photoMilieu3.png'),
    (NULL, 'PCA Standard', 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 'Tryptone, Extrait de levure, glucose, agar, pH, Eau', 'La gélose PCA Standart est un milieu utilisé pour le dénombrement des microorganismes aérobies. C\'ets un milieu nutritif sans inhibiteur qui a pour intérêt de favoriser le développement à 30°C de tous les microorganismes. ', 'Après une incubation on observe des colonies bactériennes et parfois des levures et des moisissures.', NULL, 4, 'Solide', 'upload/photoMilieu/photoMilieu4.jpg'),
    (NULL, 'COS', 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 'bio-Polyptone, Hydrolysat de protéines animales et végétales, bio-Myotone, amidon de maïs, chlorure de sodium, gélose', 'Milieu d\'isolement enrichi sur lequel les streptocoques se dévoloppent bien. Ce milieu permet également de déterminer le carctère hémolytique de la bactérie. Il est possible d\'ajouter des disque d\'antibiotiques pour identifier Streptococcus pneumoniae et Streptococcus pyogenes.', 'La dégradation des hématies crée ou non un halo autour des colonies ce qui permet de déterminer le caractère hémolytique.', NULL, 18, 'Solide', 'upload/photoMilieu/photoMilieu5.png'),
    (NULL, 'Chocolat non supplémenté', 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 'peptone trypsine de caséine, peptone pepsique de viande, amidon de maïs, hydrogénophosphate de postassium, dihydrogénophosphate de potassium, chlorure de sodium, agar', 'Milieu qui permet de déterminer la présence d\'un Haemophilus. ', NULL, NULL, 35, 'Solide ', 'upload/photoMilieu/photoMilieu6.jpg'),
    (NULL, 'Drigalski', 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 'Tryptone, Extrait de viande, Extrait autolytique de levure, Désoxycholate de sodium, Thiosulfate de sodium, Lactose, Cristal violet, bleu de bromothymol (BBT), Agar agar bactériologique', 'Cette gélose lactosé permet l\'isolement sélectif des bacilles à Gram négatif. Les bactéries sont différencier selon leur aptitude à fermenter le lactose. Cette gélose est souvent utilisée dans les secteurs alimentaire, pharmaceutique, médical, cosmétique et vétérinaire.', 'Les bacilles lactose-positif présentent des colonies de couleur jaune. Les bacilles lactose-négatif donnent des colonies de couleur bleue à bleu vert.', NULL, 32, 'solide', 'upload/photoMilieu/photoMilieu7.png'),
    (NULL, 'SS', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 'Peptone, extrait de viande, lactose, citrate de sodium, citrate de fer III, sels biliaires, vert brillant, rouge neutre, thiosulfate de sodium, agar', 'La gélose Salmonella-Shigella (SS) est sélective des Gram négatif par l\'ajout de sels biliaires. ', 'La coloration des colonies et la présence ou non d\'un centre noir permet de savoir si la bactérie est lactose négative ou positive et la production ou non de sulfure d\'hydrogène', NULL, 12, 'solide', 'upload/photoMilieu/photoMilieu8.jpg'),
    (NULL, 'BP', 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 'bio-Trypcase, extrait de viande de boeuf, extrait de levure, chlorure de lithium, gélose, glycocolle, pyruvate de sodium', 'Le milieu Baird Parker comporte une base nutritive riche qui permet d\'identifier les colonies de Staphylococcus aureus en leur donnant un aspect caratéristique après 24 heures de culture. La majorité des autre espèces du genre Staphylococcus sont inhibées ou ne produisent pas de colonies caractéristique en 24 heures. Ce milieu permet de également l\'étude de la réduction de la tellurite, de la protéolyse des protéines de jaune d\'oeuf et l\'hydrolyse des lécithines du jaune d\'oeuf. ', 'Après 24h l\'apparition de colonies noires avec un halo blanc opaque et une zone claire permet d\'affirmer la présence de Staphylococcus aureus.', NULL, 22, 'solide', 'upload/photoMilieu/photoMilieu9.png'),
    (NULL, 'EMB', 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 'peptone, lactose, éosine, bleu de méthylène, hydrogénophosphate de potassium, agar', 'Le milieu EMB (Eosine bleu de méthylène) est un milieu de culture qui permet d\'isoler les bacilles Gram-négatifs.', 'La forme, la couleur et l\'aspect de la colonie permet de déterminer le genre probable. ', NULL, 12, 'solide', 'upload/photoMilieu/photoMilieu10.jpg'),
    (NULL, 'XLD', 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 'extrait de levure, L-Lysine, Xylose, lactose, saccharose, désoxycholate de sodium, citrate de fer-amonium, thiosulfate de sodium, agar, rouge de phénol, eau distillée', 'Le milieu Xylose-Lysine-Désoxycholate est adapté à l\'isolement de Salmonella et Shigella à partir des aliments ou des selles.', 'Les colonies sont translucides sur fond rouge-orange. La présence ou non d\'un centre noir permet de déterminer le genre de la bactérie.', NULL, 21, 'solide', 'upload/photoMilieu/photoMilieu11.jpg'),
    (NULL, 'VF', 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 'Base viande foie, glucose, agar, pH', 'Le milieu viande foie coulé en longs tubes fins que l\'on régénère dans un bain marie à 100°C pendant 30 minutes afin d\'expulser les gaz dissous dans la gélose. Puis avant l\'encemensement se fait suite à au moins 10 minutes de surfusion à 50°C. Il sera ensuite solidifié à 37°C. Il permet de crée un gradient de pression partielle en oxygène afin de déterminer le type respiratoire de la bactérie.', 'La lecture des réultats se fait selon la localisation de la culture et la présence de bulles d\'air. ', NULL, 7, 'solide', 'upload/photoMilieu/photoMilieu12.jpg'),
    (NULL, 'Bouillon nitraté', 1, 0, 0, 1, 0, 1, 0, 0, 0, 0, 'Peptone trypsique de viande, Nitrate de potassium, H2O', 'Ce milieu permet l\'étude de la réduction des nitrates après une culture dans le milieu et l\'ajout de deux réactifs de mise en évidence de nitrites.', 'La lecture se fait grâce à l\'apparition d\'une coloration rouge suite à l\'ajout du réactif n°1 puis du réactif n°2.', NULL, 23, 'liquide', 'upload/photoMilieu/photoMilieu13.png');


-- Ajout des différentes techniques d'ensemencement
INSERT INTO bcp__techniqueencemensement VALUES
    ('Ecouvillonnage'),
    ('Rateau'),
    ('Ance de platine'),
    ('En quadrant'),
    ('Piqure centrale'),
    ('Ajout de colonie dans milieu');

-- Ajout des différents antibiotiques
INSERT INTO bcp__antibiotique VALUES
    ('Acide fusidique'),
    ('Acide oxolinique'),
    ('Amikacine'),
    ('Amoxicilline'),
    ('Azithomycine'),
    ('Aztréonam'),
    ('Carbapénèmes'),
    ('Céfadroxil'),
    ('Céfalotine'),
    ('Céfapirine'),
    ('Céfazoline'),
    ('Céfixime'),
    ('Céfotaxime'),
    ('Céfotiam - héxétil'),
    ('Céfoxitine'),
    ('Cefpodoxime-proxétil'),
    ('Ceftazidime'),
    ('Ceftriaxone'),
    ('Cefuroxime-axétil'),
    ('Chloramphénicol'),
    ('Clindamycine'),
    ('Colistine'),
    ('Doxycycline'),
    ('Erythromycine'),
    ('Fluoroquinolones'),
    ('Gentamicine'),
    ('Glycopeptides'),
    ('Isepamicine'),
    ('Kanamycine'),
    ('Latamoxef'),
    ('Lipoglycopeptides'),
    ('Loracarbef'),
    ('Mécillinam'),
    ('Métronidazole'),
    ('Midécamycine'),
    ('Monobactames'),
    ('Netilmicine'),
    ('Nitroxoline'),
    ('Ofloxacine'),
    ('Oxacilline'),
    ('Péfloxacine'),
    ('Pipéracilline'),
    ('Polypeptides'),
    ('Rifampicine'),
    ('Sparfloxacine'),
    ('Spiramycine'),
    ('Streptomycine'),
    ('Sulfamides'),
    ('Tétracyclines'),
    ('Tinidazole'),
    ('Triméthoprime'),
    ('Vancomycine');


-- Ajout des différents symptomes
INSERT INTO bcp__symptome VALUES
    ('Fièvre'),
    ('Toux sèche'),
    ('Fatigue'),
    ('Expectorations ou flegme épais des poumons'),
    ('Essoufflement'),
    ('Douleurs osseuses ou articulaires'),
    ('Maux de gorge'),
    ('Maux de tête'),
    ('Frissons'),
    ('Nausées ou vomissements'),
    ('Nez bouché'),
    ('Diarrhée'),
    ('Toux de sang'),
    ('Yeux gonflés'),
    ('Anosmie'),
    ('Ageusie'),
    ('Brûlure en urinant'),
    ('Urine trouble'),
    ('Crampes'),
    ('Hématurie'),
    ('Courbature'),
    ('Douleurs abdominales'),
    ('Douleurs génitales'),
    ('Ecoulement génitale'),
    ('Photophobie'),
    ('Angine'),
    ('Toux grasse'),
    ('Trouble dermatologique'),
    ('Sueurs nocturnes'),
    ('Perte de poids');

-- Ajout des maladies
INSERT INTO bcp__maladie VALUES
    ('la peste'),
    ('la gastro-entérite'),
    ('Salmonellose'),
    ('Staphylococcose'),
    ('Gonorrhée'),
    ('Angine'),
    ('Impétigo'),
    ('Pneumococcose'),
    ('Streptococcose B'),
    ('La mucoviscidose'),
    ('La bronchopneumopathie chronique obstructive'),
    ('La méningite'),
    ('inflammation de l\'épiglotte'),
    ('La tuberculose'),
    ('Le choléra'),
    ('le paludisme');


-- Ajout des zones du corps
INSERT INTO bcp__zonecorps VALUES
    ('Région abdominale'),
    ('Joue'),
    ('Nez'),
    ('Bouche'),
    ('Poitrine'),
    ('Encéphale'),
    ('Cheville'),
    ('Face'),
    ('Œil'),
    ('Langue'),
    ('Glande salivaire'),
    ('Oreilles'),
    ('Pharynx'),
    ('Cerveau'),
    ('Glande parathyroïde'),
    ('Péritoine'),
    ('Estomac'),
    ('Pancréas'),
    ('Vésicule biliaire'),
    ('Duodénum'),
    ('Iléon'),
    ('Cæcum'),
    ('Côlon'),
    ('Glandes surrénales'),
    ('Sacrum'),
    ('Vessie'),
    ('Trompe de Fallope'),
    ('Utérus'),
    ('Partie génitale'),
    ('Rectum'),
    ('Peau'),
    ('Intestin'),
    ('Poumon'),
    ('Gorge');

-- Ajout des type d'étude
INSERT INTO bcp__typeetude VALUES
    ('DUT'),
    ('BTS'),
    ('Licence'),
    ('Master'),
    ('Doctorat'),
    ('Ingénieur'),
    ('CPGE');

-- Ajout des utilisateurs
INSERT INTO bcp__user VALUES
    (NULL, 'ONILLON', 'Maxime', '2000-11-08', 'monillon@outlook.fr', '$2y$12$Bc/Gxp2SPoFrhPzVVe1ZE.Eaek/jPnWZ5smv7Itu4hIxeKtihrjRO', 'upload/photoUser/photoUser1.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'GUILLET', 'Orlane', '1999-12-06', 'guilletorlane@gmail.com ', '$2y$12$VUeyfUc0EwPNb0YN.BUrZ.id8FdWkD7ZyBZCZjuvULdc4oQ9lsqqW', 'upload/photoUser/photoUser2.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'MICHEL', 'Achil', '2000-03-13', 'michel.achil@orange.fr', '$2y$12$6O3Ix9sdCmJdIrSRm3E3wuQE300t3ii1DrwYxK3/oy8Vrg.Z.5bgS', 'upload/photoUser/photoUser3.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'REBOUT', 'Aline', '2000-05-16', 'aline.rebout@outlook.fr ', '$2y$12$McSgP3RObeV2LXYNQVpykem8ANVUFmqAixpy66x1HLekKNjhDHGBi', 'upload/photoUser/photoUser4.jpg', 0, 'DUT', NULL, NULL, 1),
    (NULL, 'MABILEAU', 'Fabienne', '1980-07-17', 'fabienne.mabileau@domaine.Fr', '$2y$12$tlrklEQBi9zYP97USnwfK.Bbw8zh.tvk4CqzgP2w6NcRNj/VWIit.', 'upload/photoUser/photoUser5.jpg', 1, 'Master', 'upload/justificatif/justificatif5.pdf', 1, 1),
    (NULL, 'FAGOT', 'Sophie', '1970-10-20', 'sophie.fagot@domaine.fr', '$2y$12$i4dMGOY1RrEqzUwj6dFx9.MZme4EK2sxYuflCDBIS9NtBSnbsrWlC', 'upload/photoUser/photoUser6.jpg', 1, 'Master', 'upload/justificatif/justificatif6.pdf', 0, 0);


-- Ajout des bactéries
INSERT INTO bcp__bacterie VALUES
    (NULL, 'Escherichia', 'coli', NULL, 'Positif', 'upload/photoBacterie/photoBacterie1.jpg', 1, 0, 0, 0, '2021-01-14 20:25:00', 37, NULL, 'Bacille'),
    (NULL, 'Yersinia', 'pestis', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie2.png', 1, 0, 0, 0, '2021-01-14 20:25:00', 30, NULL, 'Bacille'),
    (NULL, 'Lactobacillus', 'rhamnosus', NULL, 'Positif', 'upload/photoBacterie/photoBacterie3.png', 1, 0, 0, 0, '2021-01-14 20:25:00', 37, NULL, 'Bacille'),
    (NULL, 'Salmonella', 'spp', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie4.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Salmonella', 'enterica', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie5.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Staphylococcus', 'aureus', NULL, 'Positif', 'upload/photoBacterie/photoBacterie6.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Neisseria', 'gonorrhoeae', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie7.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Neisseria', 'meningitidis', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie8.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Streptococcus', 'pyogenes', NULL, 'Positif', 'upload/photoBacterie/photoBacterie9.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Streptococcus', 'pneumoniae', NULL, 'Positif', 'upload/photoBacterie/photoBacterie10.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'diplocoque'),
    (NULL, 'Streptococcus', 'agalactiae', NULL, 'Positif', 'upload/photoBacterie/photoBacterie11.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Staphylococcus', 'epidermidis', NULL, 'Positif', 'upload/photoBacterie/photoBacterie12.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Staphylococcus', 'auricularis', NULL, 'Positif', 'upload/photoBacterie/photoBacterie13.jpg', 0, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coque'),
    (NULL, 'Pseudomonas', 'aeruginosa', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie14.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Haemophilus', 'influenzae', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie15.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Coccobacille'),
    (NULL, 'Mycobacterium', 'tuberculosis', NULL, 'NA', 'upload/photoBacterie/photoBacterie16.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Klebsiella', 'pneumoniae', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie17.jpg', 0, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Treponema', 'pallidum', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie18.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Helicoïdale'),
    (NULL, 'Leptospira', 'interrogans', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie19.png', 1, 0, 0, 0, '2021-02-06 07:09:28', 30, NULL, 'Leptospire'),
    (NULL, 'Escherichia', 'coli', 'O157:H7', 'Positif', 'upload/photoBacterie/photoBacterie20.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 40, NULL, 'Bacille'),
    (NULL, 'Vibrio', 'cholerae', NULL, 'Negatif', 'upload/photoBacterie/photoBacterie21.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille'),
    (NULL, 'Vibrio', 'cholerae', 'O139', 'Negatif', 'upload/photoBacterie/photoBacterie22.jpg', 1, 0, 0, 0, '2021-02-06 07:09:28', 37, NULL, 'Bacille');


-- ajout des articles
INSERT INTO bcp__article VALUES
    (NULL, 'PROBIOTIQUES : QU\'EST-CE QUE LE LACTOBACILLUS RHAMNOSUS ?', 'Apyforme', 'Lactobacillus rhamnosus est une souche microbiotique qui concourt à l\'efficacité de la flore intestinale, participant ainsi au confort digestif et au renforcement du système immunitaire. Étudié depuis plusieurs décennies, il procure des effets bénéfiques prouvés scientifiquement. C\'est pourquoi il fait partie de la formule de nombreux compléments alimentaires. Retrouvez dans cet article tout ce qu\'il faut savoir à propos de Lactobacillus rhamnosus.', 'https://www.apyforme.com/blog/les-probiotiques/probiotiques-qu-est-ce-que-le-lactobacillus-rhamnosus-', '2020-07-01', 3),
    (NULL, 'Staphylococcus aureus : place et impact dans la prise en charge des pneumopathies nosocomiales', 'D. Benhamou, A. S. Carrié, F. Lecomte', 'Staphylococcus aureus (SA) a acquis une place primordiale dans les pneumopathies nosocomiales en termes de fréquence et de gravité et pose des problèmes thérapeutiques du fait essentiellement de ses résistances aux antibiotiques et des difficultés de gérer les antistaphylococciques majeurs.', 'https://www.em-consulte.com/article/157140/staphylococcus-aureus-%C2%A0-place-et-impact-dans-la-pr', '2008-04-30', 6),
    (NULL, 'Infections à « Haemophilus influenzae »', 'A.-E. Deghmane, M.-K. Taha', 'Haemophilus influenzae est une bactérie sous forme de coccobacille à Gram négatif dont l\'homme est le seul hôte naturel connu. Cette bactérie colonise fréquemment les voies respiratoires chez l\'être humain comme constituant de la flore normale des humains. La transmission est aérogène et le portage rhinopharyngé est généralement asymptomatique. Les infections invasives à H. influenzae se produisent lorsque la bactérie traverse le rhinopharynx, envahit la circulation sanguine et se propage pour atteindre des sites normalement stériles. Les infections invasives à H. influenzae peuvent se manifester comme une septicémie, une pneumonie invasive, une épiglottite et une méningite bactérienne aiguë. H. influenzae est divisé en deux grandes catégories : souches capsulées et non capsulées. La capsule détermine le sérotype et c\'est le sérotype b (H. influenzae b) qui est le plus pathogène chez l\'homme, affectant principalement les nourrissons et les jeunes enfants. Au début des années 1990, le vaccin conjugué contre le sérotype b a été introduit dans la plupart des pays européens, et l\'incidence des infections invasives à H. influenzae b a considérablement baissé. Les autres sérotypes (a, c, d, e et f) restent rarement associées aux infections invasives et peuvent révéler des comorbidités subjacentes. Les souches non capsulées sont également appelées « non typables » (H. influenzae NT). Elles causent habituellement des infections non invasives des voies respiratoires supérieures, telles que l\'otite moyenne et la sinusite. Cependant, les souches H. influenzae NT peuvent être responsables d\'infections invasives.', 'https://www.em-consulte.com/article/1275523/infections-a-haemophilus-influenzae', '2019-02-11', 15),
    (NULL, 'LE CHOLÉRA', 'Institut Pasteur', 'Le choléra est une maladie diarrhéique épidémique, strictement humaine, due à des bactéries appartenant aux sérogroupes O1 et O139 de l’espèce Vibrio cholerae. Ce bacille fût initialement observé par Pacini en 1854 puis isolé en 1883 par Robert Koch en Inde. La bactérie V. cholerae sérogroupe O1, biotype El Tor, est répandue sur toute la planète, qui subit actuellement la septième pandémie de choléra. L’Organisation mondiale de la santé estime à près de 3 millions le nombre de cas et à plus de 95 000 le nombre de décès dus à cette maladie chaque année dans le monde. Toutes les régions du monde déclarent des cas de choléra, l’Afrique est le continent le plus touché et concentre plus de 50% des cas. Le taux global de létalité a été de 1,8%, en 2016, mais a dépassé les 6% parmi les groupes vulnérables résidant dans des zones à haut risque.', 'https://www.pasteur.fr/fr/centre-medical/fiches-maladies/cholera', '2019-09-16', 21);

-- ajout fiche technique
INSERT INTO bcp__fichetechnique VALUES
    (NULL, 'Réaliser une coloration de GRAM', 'upload/ficheTechnique/ficheTechnique1.pdf'),
    (NULL, 'Réaliser un antibiogramme', 'upload/ficheTechnique/ficheTechnique2.pdf'),
    (NULL, 'Ensemencer une galerie API', 'upload/ficheTechnique/ficheTechnique3.pdf'),
    (NULL, 'Réaliser une coloration de Ziehl-Neelsen', 'upload/ficheTechnique/ficheTechnique4.pdf'),
    (NULL, 'Réaliser le test de l\'ONPG', 'upload/ficheTechnique/ficheTechnique5.pdf'),
    (NULL, 'Réaliser le test VP', 'upload/ficheTechnique/ficheTechnique6.pdf'),
    (NULL, 'Coulage des boîtes de Pétri', 'upload/ficheTechnique/ficheTechnique7.pdf'),
    (NULL, 'Description macroscopique ', 'upload/ficheTechnique/ficheTechnique8.pdf'),
    (NULL, 'Ensemencement d\'un milieu liquide', 'upload/ficheTechnique/ficheTechnique9.pdf'),
    (NULL, 'Ensemencement en quadrants', 'upload/ficheTechnique/ficheTechnique10.pdf'),
    (NULL, 'Ensemencement par écouvillonnage', 'upload/ficheTechnique/ficheTechnique11.pdf'),
    (NULL, 'Etat frais', 'upload/ficheTechnique/ficheTechnique12.pdf'),
    (NULL, 'Indicateur coloré de pH', 'upload/ficheTechnique/ficheTechnique13.pdf'),
    (NULL, 'Test groupage des Streptocoques', 'upload/ficheTechnique/ficheTechnique14.pdf'),
    (NULL, 'Recherche de la staphyylocoagulase', 'upload/ficheTechnique/ficheTechnique15.pdf'),
    (NULL, 'Test d\'agglutination rapide', 'upload/ficheTechnique/ficheTechnique16.pdf');


-- remplissage de la table applique
INSERT INTO bcp__applique VALUES
    (1, 'Ecouvillonnage'),
    (1, 'Rateau'),
    (1, 'Ance de platine'),
    (1, 'En quadrant'),
    (2, 'Ecouvillonnage'),
    (2, 'Rateau'),
    (2, 'Ance de platine'),
    (2, 'En quadrant'),
    (3, 'Ecouvillonnage'),
    (3, 'Rateau'),
    (3, 'Ance de platine'),
    (3, 'En quadrant'),
    (4, 'Ecouvillonnage'),
    (4, 'Rateau'),
    (4, 'Ance de platine'),
    (4, 'En quadrant'),
    (5, 'Ecouvillonnage'),
    (5, 'Rateau'),
    (5, 'Ance de platine'),
    (5, 'En quadrant'),
    (6, 'Ecouvillonnage'),
    (6, 'Rateau'),
    (6, 'Ance de platine'),
    (6, 'En quadrant'),
    (7, 'Ecouvillonnage'),
    (7, 'Rateau'),
    (7, 'Ance de platine'),
    (7, 'En quadrant'),
    (8, 'Ecouvillonnage'),
    (8, 'Rateau'),
    (8, 'Ance de platine'),
    (8, 'En quadrant'),
    (9, 'Ecouvillonnage'),
    (9, 'Rateau'),
    (9, 'Ance de platine'),
    (9, 'En quadrant'),
    (9, 'Ajout de colonie dans milieu'),
    (10, 'Ecouvillonnage'),
    (10, 'Rateau'),
    (10, 'Ance de platine'),
    (10, 'En quadrant'),
    (11, 'Ecouvillonnage'),
    (11, 'Rateau'),
    (11, 'Ance de platine'),
    (11, 'En quadrant'),
    (12, 'Piqure centrale'),
    (13, 'Ajout de colonie dans milieu');


-- remplissage de la table estMentionné
INSERT INTO bcp__estmensione VALUES
    (1, 7),
    (2, 7),
    (3, 7),
    (4, 7),
    (5, 7),
    (6, 7),
    (7, 7),
    (8, 7),
    (9, 7),
    (10, 7),
    (11, 7),
    (13, 9),
    (1, 11),
    (2, 11),
    (3, 11),
    (4, 11),
    (5, 11),
    (6, 11),
    (7, 11),
    (8, 11),
    (9, 11),
    (10, 11),
    (11, 11),
    (1, 10),
    (2, 10),
    (3, 10),
    (4, 10),
    (5, 10),
    (6, 10),
    (7, 10),
    (8, 10),
    (9, 10),
    (10, 10),
    (11, 10);


-- remplissage de la table a savoir
INSERT INTO bcp__asavoir VALUES
    (1, 3, 1),
    (2, 3, 1),
    (3, 3, 1),
    (4, 3, 1),
    (5, 3, 1),
    (6, 3, 1),
    (7, 3, 1),
    (8, 3, 1),
    (9, 3, 1),
    (10, 3, 1),
    (11, 3, 1),
    (12, 3, 1),
    (13, 3, 1),
    (14, 3, 1),
    (15, 3, 1),
    (16, 3, 1),
    (17, 3, 1),
    (18, 3, 1),
    (19, 3, 1),
    (20, 3, 1),
    (21, 3, 1),
    (22, 3, 1),
    (2, 4, 1),
    (5, 4, 0),
    (6, 4, 0),
    (8, 4, 0),
    (4, 1, 1),
    (5, 1, 1),
    (9, 1, 0),
    (10, 1, 0),
    (11, 1, 0),
    (12, 1, 0),
    (13, 1, 0),
    (16, 1, 0),
    (1, 2, 0),
    (20, 2, 0),
    (21, 2, 0),
    (22, 2, 0);

-- remplissage de la table atteint
INSERT INTO bcp__atteint VALUES
    (1, 'Intestin'),
    (2, 'Peau'),
    (4, 'Estomac'),
    (4, 'Intestin'),
    (5, 'Estomac'),
    (5, 'Intestin'),
    (7, 'Partie génitale'),
    (8, 'Encéphale'),
    (9, 'Peau'),
    (10, 'Poumon'),
    (11, 'Gorge'),
    (14, 'Poumon'),
    (15, 'Encéphale'),
    (15, 'Gorge'),
    (16, 'Peau'),
    (21, 'Intestin'),
    (22, 'Intestin'),
    (18, 'Encéphale');

-- remplissage de la table favoris
INSERT INTO bcp__favoris VALUES
    (1, 1),
    (3, 1),
    (4, 1),
    (5, 1),
    (6, 1),
    (9, 1),
    (10, 1),
    (11, 1),
    (12, 1),
    (13, 1),
    (20, 1),
    (21, 1),
    (22, 1),
    (2, 2),
    (3, 2),
    (6, 2),
    (7, 2),
    (8, 2),
    (14, 2),
    (15, 2),
    (16, 2),
    (17, 2),
    (18, 2),
    (19, 2),
    (1, 3),
    (2, 3),
    (3, 3),
    (4, 3),
    (5, 3),
    (6, 3),
    (7, 3),
    (8, 3),
    (9, 3),
    (10, 3),
    (11, 3),
    (12, 3),
    (13, 3),
    (14, 3),
    (15, 3),
    (16, 3),
    (17, 3),
    (18, 3),
    (19, 3),
    (20, 3),
    (21, 3),
    (22, 3),
    (2, 4);

-- remplissage de la table pousse
INSERT INTO bcp__pousse VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 9),
    (1, 12),
    (1, 13),
    (2, 1),
    (2, 2),
    (2, 4),
    (2, 7),
    (2, 9),
    (2, 10),
    (2, 12),
    (2, 13),
    (3, 1),
    (3, 2),
    (3, 3),
    (3, 4),
    (3, 9),
    (3, 12),
    (3, 13),
    (4, 1),
    (4, 2),
    (4, 4),
    (4, 5),
    (4, 6),
    (4, 7),
    (4, 8),
    (4, 9),
    (4, 10),
    (4, 11),
    (4, 12),
    (4, 13),
    (5, 1),
    (5, 2),
    (5, 4),
    (5, 5),
    (5, 6),
    (5, 7),
    (5, 8),
    (5, 9),
    (5, 10),
    (5, 11),
    (5, 12),
    (5, 13),
    (6, 1),
    (6, 2),
    (6, 3),
    (6, 4),
    (6, 9),
    (6, 12),
    (6, 13),
    (7, 1),
    (7, 2),
    (7, 4),
    (7, 5),
    (7, 6),
    (7, 7),
    (7, 9),
    (7, 10),
    (7, 12),
    (7, 13),
    (8, 1),
    (8, 2),
    (8, 4),
    (8, 5),
    (8, 6),
    (8, 7),
    (8, 9),
    (8, 10),
    (8, 12),
    (8, 13),
    (9, 1),
    (9, 2),
    (9, 3),
    (9, 4),
    (9, 9),
    (9, 12),
    (9, 13),
    (10, 1),
    (10, 2),
    (10, 3),
    (10, 4),
    (10, 9),
    (10, 12),
    (10, 13),
    (11, 1),
    (11, 2),
    (11, 3),
    (11, 4),
    (11, 9),
    (11, 12),
    (11, 13),
    (12, 1),
    (12, 2),
    (12, 3),
    (12, 4),
    (12, 9),
    (12, 12),
    (12, 13),
    (13, 1),
    (13, 2),
    (13, 3),
    (13, 4),
    (13, 9),
    (13, 12),
    (13, 13),
    (14, 1),
    (14, 2),
    (14, 4),
    (14, 5),
    (14, 6),
    (14, 7),
    (14, 9),
    (14, 10),
    (14, 12),
    (14, 13),
    (15, 1),
    (15, 2),
    (15, 4),
    (15, 5),
    (15, 6),
    (15, 7),
    (15, 9),
    (15, 10),
    (15, 12),
    (15, 13),
    (17, 1),
    (17, 2),
    (17, 4),
    (17, 7),
    (17, 9),
    (17, 10),
    (17, 12),
    (17, 13),
    (18, 1),
    (18, 2),
    (18, 4),
    (18, 7),
    (18, 9),
    (18, 10),
    (18, 12),
    (18, 13),
    (19, 1),
    (19, 2),
    (19, 4),
    (19, 7),
    (19, 9),
    (19, 10),
    (19, 12),
    (19, 13),
    (20, 1),
    (20, 2),
    (20, 3),
    (20, 4),
    (20, 9),
    (20, 12),
    (20, 13),
    (21, 1),
    (21, 2),
    (21, 4),
    (21, 7),
    (21, 9),
    (21, 10),
    (21, 12),
    (21, 13),
    (22, 1),
    (22, 2),
    (22, 4),
    (22, 7),
    (22, 9),
    (22, 10),
    (22, 12),
    (22, 13);

-- remplissage de la table provoque maladie
INSERT INTO bcp__provoquemaladie VALUES
    (1, 'la gastro-entérite'),
    (2, 'la peste'),
    (4, 'Salmonellose'),
    (5, 'Salmonellose'),
    (6, 'Staphylococcose'),
    (7, 'Gonorrhée'),
    (8, 'La méningite'),
    (9, 'Angine'),
    (9, 'Impétigo'),
    (10, 'Pneumococcose'),
    (11, 'Streptococcose B'),
    (14, 'La mucoviscidose'),
    (14, 'La bronchopneumopathie chronique obstructive'),
    (15, 'La méningite'),
    (15, 'inflammation de l\'épiglotte'),
    (16, 'La tuberculose'),
    (21, 'Le choléra'),
    (22, 'Le choléra'),
    (18, 'le paludisme');

-- remplissage de la table provoque symptome
INSERT INTO bcp__provoquesymptome VALUES
    (1, 'Fatigue'),
    (1, 'Nausées ou vomissements'),
    (1, 'Diarrhée'),
    (2, 'Fièvre'),
    (2, 'Fatigue'),
    (2, 'Maux de tête'),
    (2, 'Frissons'),
    (2, 'Courbature'),
    (4, 'Fièvre'),
    (4, 'Nausées ou vomissements'),
    (4, 'Diarrhée'),
    (4, 'Douleurs abdominales'),
    (5, 'Fièvre'),
    (5, 'Nausées ou vomissements'),
    (5, 'Diarrhée'),
    (5, 'Douleurs abdominales'),
    (6, 'Fièvre'),
    (6, 'Fatigue'),
    (7, 'Brûlure en urinant'),
    (7, 'Douleurs génitales'),
    (7, 'Ecoulement génitale'),
    (8, 'Maux de tête'),
    (8, 'Nausées ou vomissements'),
    (8, 'Courbature'),
    (8, 'Photophobie'),
    (9, 'Toux sèche'),
    (9, 'Angine'),
    (9, 'Toux grasse'),
    (9, 'Trouble dermatologique'),
    (10, 'Fièvre'),
    (10, 'Toux sèche'),
    (10, 'Frissons'),
    (10, 'Toux grasse'),
    (11, 'Fièvre'),
    (11, 'Toux sèche'),
    (11, 'Diarrhée'),
    (11, 'Crampes'),
    (14, 'Fièvre'),
    (14, 'Toux sèche'),
    (14, 'Fatigue'),
    (14, 'Expectorations ou flegme épais des poumons'),
    (14, 'Maux de gorge'),
    (14, 'Toux de sang'),
    (14, 'Toux grasse'),
    (15, 'Fièvre'),
    (15, 'Fatigue'),
    (15, 'Frissons'),
    (16, 'Fièvre'),
    (16, 'Toux sèche'),
    (16, 'Sueurs nocturnes'),
    (16, 'Perte de poids'),
    (21, 'Fatigue'),
    (21, 'Nausées ou vomissements'),
    (21, 'Diarrhée'),
    (21, 'Douleurs abdominales'),
    (22, 'Fatigue'),
    (22, 'Nausées ou vomissements'),
    (22, 'Diarrhée'),
    (22, 'Douleurs abdominales'),
    (18, 'Fièvre');

-- remplissage de la table résistance
INSERT INTO bcp__resistance VALUES
    (1, 'Azithomycine'),
    (1, 'Chloramphénicol'),
    (1, 'Glycopeptides'),
    (20, 'Azithomycine'),
    (20, 'Chloramphénicol'),
    (20, 'Glycopeptides'),
    (4, 'Spiramycine'),
    (5, 'Spiramycine'),
    (7, 'Clindamycine'),
    (7, 'Colistine'),
    (7, 'Doxycycline'),
    (7, 'Erythromycine'),
    (7, 'Fluoroquinolones'),
    (7, 'Gentamicine'),
    (7, 'Glycopeptides'),
    (7, 'Isepamicine'),
    (7, 'Kanamycine'),
    (7, 'Latamoxef'),
    (7, 'Lipoglycopeptides'),
    (7, 'Loracarbef'),
    (7, 'Mécillinam'),
    (8, 'Ceftazidime'),
    (14, 'Acide oxolinique'),
    (20, 'Lipoglycopeptides'),
    (21, 'Acide fusidique'),
    (22, 'Sulfamides');

