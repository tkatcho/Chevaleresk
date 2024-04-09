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
INSERT INTO `enigmes` (`id`, `enigme`, `difficulte`, `reponse`) VALUES ('1', 'Quelle est la couleur du cheval blanc de Napoléon?', 'Facile', 'Blanc');