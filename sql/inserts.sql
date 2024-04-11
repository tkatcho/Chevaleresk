-- Inserts for the Items table
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

-- Corresponding inserts for the Armes (Weapons) table, assuming Items.id = 1 for the first weapon, and so on
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Sword of Might'), 'High', 'Sword', 'A mighty sword that can split mountains.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Axe of Fury'), 'Medium', 'Axe', 'An axe that enrages its wielder to fight fiercely.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Dagger'), 'High', 'Sword', 'A dagger can kill.');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Bow'), 'Medium', 'Bow', 'A pretty bow');
INSERT INTO armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM items WHERE nom = 'Axe'), 'High', 'Axe', 'This axe is cool');

-- Corresponding inserts for the Armures (Armor) table, assuming Items.id = 3 for the first armor, and so on
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Plate Armor'), 'Steel', 'L');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Chainmail'), 'Iron', 'M');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Helmet'), 'Steel', 'S');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Fancy helmet'), 'Steel', 'S');
INSERT INTO armures (idItem, matiere, taille) VALUES ((SELECT id FROM items WHERE nom = 'Big armor'), 'Iron', 'L');


-- Corresponding inserts for the Potions table, assuming Items.id = 5 for the first potion, and so on
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Healing'), 'Restore Health', '00:00:30', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Strength'), 'Increase Strength', '00:00:20', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Poison'), 'Hurt Ennemies', '00:00:10', 1);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of High vision'), 'Increase Vision', '00:00:60', 0);
INSERT INTO potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM items WHERE nom = 'Potion of Gold'), 'Increase Strength', '00:00:20', 0);

-- Corresponding inserts for the Elements table, assuming Items.id = 7 for the first element, and so on
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Fire Essence'), 'Fire', 'Common', 'Low');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Ice Shard'), 'Ice', 'Uncommon', 'Medium');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Leaf'), 'Earth', 'Common', 'Low');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Fangs'), 'Earth', 'Uncommon', 'Medium');
INSERT INTO elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM items WHERE nom = 'Leaf'), 'Earth', 'Common', 'Low');


--Enigmes
INSERT INTO enigmes (id, enigme, difficulte, type) VALUES ('1', 'Quel matériau est traditionnellement utilisé pour fabriquer des armures ?', 'Facile', 'Z');
INSERT INTO enigmes (id, enigme, difficulte, type) VALUES ('2', 'Quel type d armure était porté par les chevaliers médiévaux pour protéger leur corps ?', 'Moyen', 'Z');
INSERT INTO enigmes (id, enigme, difficulte, type) VALUES ('3', 'Quel ingrédient est souvent utilisé dans les potions de guérison magique ?', 'Difficile', 'E');
INSERT INTO enigmes (id, enigme, difficulte, type) VALUES ('4', 'Quel effet a la potion Amortentia dans l univers de Harry Potter ?', 'Moyen', 'P');
INSERT INTO enigmes (id, enigme, difficulte, type) VALUES ('5', 'Quelle est l utilité principale de la potion d Invisibilité ?', 'Facile', 'P');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('1', '1', 'Acier', b'1');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('2', '1', 'Cuir', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('3', '1', 'Argent', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('4', '1', 'Plastique', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('5', '2', 'Armure en plaques', b'1');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('6', '2', 'Armure en mailles', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('7', '2', 'Gambison', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('8', '2', 'Cotte de mailles', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('9', '3', 'Plume', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('10', '3', 'Fleur', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('11', '3', 'Mandragore', b'1');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('12', '3', 'Eau', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('13', '4', 'Elle rend invisible', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('14', '4', 'Elle rend amoureux', b'1');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('15', '4', 'Elle rend immortel', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('16', '4', 'Elle rend invincible', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('17', '5', 'Se téléporter', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('18', '5', 'Guérir les blessures', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('19', '5', 'Voler', b'0');
INSERT INTO reponses (id, idEnigme, reponse, estBonne) VALUES ('20', '5', 'Devenir invisible', b'1');