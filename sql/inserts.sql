-- ITEMS
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Sword of Might', 'W', 5, 150, 'images/items/épée.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Axe of Fury', 'W', 7, 120, 'images/items/épée.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Dagger', 'W', 5, 150, 'images/items/dagger.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Bow', 'W', 9, 120, 'images/items/bow.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Axe', 'W', 7, 130, 'images/items/axe.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Plate Armor', 'A', 3, 200, 'images/items/armure.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Chainmail', 'A', 4, 100, 'images/items/armure.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Helmet', 'A', 3, 180, 'images/items/helmet.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Fancy helmet', 'A', 5, 110, 'images/items/fancy_helmet.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Big armor', 'A', 4, 90, 'images/items/big_armor.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Healing', 'P', 20, 120, 'images/items/potion.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Strength', 'P', 15, 100, 'images/items/potion2.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Poison', 'P', 20, 70, 'images/items/poison_potion.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of High vision', 'P', 15, 70, 'images/items/vision_potion.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Gold', 'P', 15, 80, 'images/items/gold_potion.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Fire Essence', 'E', 10, 40, 'images/items/élément.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Ice Shard', 'E', 10, 50, 'images/items/élément.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Leaf', 'E', 10, 40, 'images/items/leaf.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Fangs', 'E', 10, 60, 'images/items/fangs.png');
INSERT INTO items (nom, type, quantiteStock, prix, photo) VALUES ('Flower', 'E', 10, 30, 'images/items/flower.png');

-- Corresponding inserts for the ARMES (Weapons) table, assuming Items.id = 1 for the first weapon, and so on
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Sword of Might'), 'High', 'Sword', 'A mighty sword that can split mountains.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Axe of Fury'), 'Medium', 'Axe', 'An axe that enrages its wielder to fight fiercely.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Dagger'), 'High', 'Sword', 'A dagger can kill.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Bow'), 'Medium', 'Bow', 'A pretty bow');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Axe'), 'High', 'Axe', 'This axe is cool');

-- Corresponding inserts for the ARMURES (Armor) table, assuming Items.id = 3 for the first armor, and so on
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Plate Armor'), 'Steel', 'L');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Chainmail'), 'Iron', 'M');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Helmet'), 'Steel', 'S');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Fancy helmet'), 'Steel', 'S');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Big armor'), 'Iron', 'L');


-- Corresponding inserts for the POTIONS table, assuming Items.id = 5 for the first potion, and so on
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Healing'), 'Restore Health', '30', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Strength'), 'Increase Strength', '20', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Poison'), 'Hurt Ennemies', '10', 1);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of High vision'), 'Increase Vision', '60', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Gold'), 'Increase Strength', '20', 0);

-- Corresponding inserts for the ÉLÉMENTS table, assuming Items.id = 7 for the first element, and so on
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Fire Essence'), 'Fire', 'Common', 'Low');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Ice Shard'), 'Ice', 'Uncommon', 'Medium');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Leaf'), 'Earth', 'Common', 'Low');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Fangs'), 'Earth', 'Uncommon', 'Medium');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Flower'), 'Earth', 'Common', 'Low');


-- ÉNIGMES
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel matériau est traditionnellement utilisé pour fabriquer des armures ?', 'Facile', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel type d armure était porté par les chevaliers médiévaux pour protéger leur corps ?', 'Moyen', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel ingrédient est souvent utilisé dans les potions de guérison magique ?', 'Difficile', 'E');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel effet a la potion Amortentia dans l univers de Harry Potter ?', 'Moyen', 'P');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quelle est l utilité principale de la potion d Invisibilité ?', 'Facile', 'P');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quelle est cette arme portée par les chevaliers, utilisée pour transpercer leurs ennemis ?', 'Facile', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Qui est le souverain régnant sur un royaume médiéval ?', 'Facile', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quelle couleur est associée à une potion qui confère de la force et de la vigueur ?', 'Moyen', 'P');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel est cet ingrédient communément utilisé pour rendre une potion invisible à l oeil nu ?', 'Moyen', 'E');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel est l effet d une potion concoctée à base de plumes de phénix ?', 'Difficile', 'P');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel ingrédient magique est souvent utilisé pour donner des pouvoirs de guérison aux potions ?', 'Difficile', 'E');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel est cet édifice imposant, construit pour protéger la ville et sa population des attaques ennemies ?', 'Moyen', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quelle est l arme traditionnelle utilisée par les chevaliers en combat rapproché ?', 'Facile', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quel est l animal noble utilisé comme symbole par de nombreux chevaliers ?', 'Moyen', 'Z');
INSERT INTO enigmes (enigme, difficulte, type) VALUES ('Quelle est la résidence fortifiée du seigneur du domaine ?', 'Moyen', 'Z');


-- RÉPONSES
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('1', 'Acier', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('1', 'Cuir', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('1', 'Argent', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('1', 'Plastique', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('2', 'Armure en plaques', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('2', 'Armure en mailles', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('2', 'Gambison', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('2', 'Cotte de mailles', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('3', 'Plume', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('3', 'Fleur', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('3', 'Mandragore', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('3', 'Eau', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('4', 'Elle rend invisible', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('4', 'Elle rend amoureux', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('4', 'Elle rend immortel', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('4', 'Elle rend invincible', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('5', 'Se téléporter', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('5', 'Guérir les blessures', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('5', 'Voler', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('5', 'Devenir invisible', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('6', 'Arc', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('6', 'Épée', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('6', 'Hache', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('6', 'Lance', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('7', 'Roi', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('7', 'Duc', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('7', 'Seigneur', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('7', 'Chevalier', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('8', 'Rouge', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('8', 'Vert', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('8', 'Bleu', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('8', 'Jaune', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('9', 'Feuille de menthe', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('9', 'Écaille de serpent', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('9', 'Poudre de licorne', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('9', 'Pétales de rose', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('10', 'Rajeunissement', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('10', 'Vol', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('10', 'Invisibilité', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('10', 'Force surhumaine', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('11', 'Ailes de chauve-souris', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('11', 'Yeux de dragon', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('11', 'Baies de sorbier', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('11', 'Racine de mandragore', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('12', 'Château', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('12', 'Cathédrale', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('12', 'Muraille', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('12', 'Tour de guet', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('13', 'Arc', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('13', 'Épée', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('13', 'Lance', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('13', 'Marteau de guerre', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('14', 'Lion', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('14', 'Loup', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('14', 'Cerf', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('14', 'Dragon', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('15', 'Manoir', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('15', 'Auberge', 0);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('15', 'Château', 1);
INSERT INTO reponses (idEnigme, reponse, estBonne) VALUES ('15', 'Moulin', 0);

-- RECETTES
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('1', '1', '3');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('1', '2', '2');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('2', '3', '2');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('2', '2', '4');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('3', '5', '1');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('3', '1', '2');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('4', '4', '3');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('4', '5', '1');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('5', '1', '1');
INSERT INTO recettes (idPotion, idElement, qtElement) VALUES ('5', '3', '2');

------------------------------------------------------------------------------------------------
--JOUEURS (tous les mots de passe sont : 1234)
--joueurs normaux
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerOne','PlayerOne','PlayerOne','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'aucun',0,0);
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerTwo','PlayerTwo','PlayerTwo','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'aucun',0,0);
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerThree','PlayerThree','PlayerThree','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'aucun',0,0);
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerFour','PlayerFour','PlayerFour','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'aucun',0,0);
--joueurs alichimstes
--idJoueur: 5
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerOneAlchimiste','PlayerOneAlchimiste','PlayerOneAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'débutant',1,0);
--idJoueur: 6
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerTwoAlchimiste','PlayerTwoAlchimiste','PlayerTwoAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'débutant',1,0);
--idJoueur: 7
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerThreeAlchimiste','PlayerThreeAlchimiste','PlayerThreeAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'intermédiaire',1,0);
--idJoueur: 8
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerFourAlchimiste','PlayerFourAlchimiste','PlayerFourAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'intermédiaire',1,0);
--idJoueur: 9
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerFiveAlchimiste','PlayerFiveAlchimiste','PlayerFiveAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'expert',1,0);
--idJoueur: 10
INSERT INTO joueurs( alias, nom, prenom, motDePasse, solde, niveau, estAlchimiste, estAdmin) VALUES ('PlayerSixAlchimiste','PlayerSixAlchimiste','PlayerSixAlchimiste','$2y$10$4u8e9bYoQV4A8U0FptzbVOO6bZBnf8f5EzMITRChYurmdvR8ftJ3i',1000,'expert',1,0);

--Changer les id des joueurs alchimiste (PlayerOne =5 , etc)
--inventaire des joueurs (mettre des éléments dans l'inventaire des alchimistes)
--idJoueur 5
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('5','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('5','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('5','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('5','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('5','20','2');
--idJoueur 6
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('6','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('6','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('6','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('6','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('6','20','2');
--idJoueur 7
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('7','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('7','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('7','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('7','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('7','20','2');
--idJoueur 8
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('8','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('8','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('8','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('8','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('8','20','2');
--idJoueur 9
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('9','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('9','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('9','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('9','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('9','20','2');
--idJoueur 10
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('10','16','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('10','17','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('10','18','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('10','19','8');
INSERT INTO inventaires( idJoueur, idItem, quantite) VALUES ('10','20','2');


--Évaluations
INSERT INTO evaluations(idItem, idJoueur, etoile, commentaire) VALUES ( '5', '1', '3', 'Wow trop cool');
INSERT INTO evaluations(idItem, idJoueur, etoile, commentaire) VALUES ( '5', '3', '2', 'Oh lala. Trop wow');
INSERT INTO evaluations(idItem, idJoueur, etoile, commentaire) VALUES ( '5', '8', '5', 'Damnnnnnnnnnnnnnnnnnn');
INSERT INTO `evaluations` (`id`, `idItem`, `idJoueur`, `etoile`, `commentaire`) VALUES (NULL, '2', '1', '3', 'wow');
INSERT INTO `evaluations` (`id`, `idItem`, `idJoueur`, `etoile`, `commentaire`) VALUES (NULL, '10', '1', '4', 'ouuuuuuhhhhhhh');