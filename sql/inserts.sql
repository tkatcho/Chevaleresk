-- Inserts for the Items table
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Sword of Might', 'W', 5, 150, 'images/items/épée.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Axe of Fury', 'W', 7, 120, 'images/items/épée.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Plate Armor', 'A', 3, 200, 'images/items/armure.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Chainmail', 'A', 4, 100, 'images/items/armure.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Healing', 'P', 20, 120, 'images/items/potion.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Potion of Strength', 'P', 15, 100, 'images/items/potion2.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Fire Essence', 'E', 10, 80, 'images/items/élément.png');
INSERT INTO Items (nom, type, quantiteStock, prix, photo) VALUES ('Ice Shard', 'E', 10, 90, 'images/items/élément.png');

-- Corresponding inserts for the Armes (Weapons) table, assuming Items.id = 1 for the first weapon, and so on
INSERT INTO Armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM Items WHERE nom = 'Sword of Might'), 'High', 'Sword', 'A mighty sword that can split mountains.');
INSERT INTO Armes (idItem, efficacite, genre, description) VALUES ((SELECT id FROM Items WHERE nom = 'Axe of Fury'), 'Medium', 'Axe', 'An axe that enrages its wielder to fight fiercely.');

-- Corresponding inserts for the Armures (Armor) table, assuming Items.id = 3 for the first armor, and so on
INSERT INTO Armures (idItem, matiere, taille) VALUES ((SELECT id FROM Items WHERE nom = 'Plate Armor'), 'Steel', 'L');
INSERT INTO Armures (idItem, matiere, taille) VALUES ((SELECT id FROM Items WHERE nom = 'Chainmail'), 'Iron', 'M');

-- Corresponding inserts for the Potions table, assuming Items.id = 5 for the first potion, and so on
INSERT INTO Potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM Items WHERE nom = 'Potion of Healing'), 'Restore Health', '00:00:30', 0);
INSERT INTO Potions (idItem, effet, duree, estAttaque) VALUES ((SELECT id FROM Items WHERE nom = 'Potion of Strength'), 'Increase Strength', '00:00:20', 0);

-- Corresponding inserts for the Elements table, assuming Items.id = 7 for the first element, and so on
INSERT INTO Elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM Items WHERE nom = 'Fire Essence'), 'Fire', 'Common', 'Low');
INSERT INTO Elements (idItem, type, rarete, dangerosite) VALUES ((SELECT id FROM Items WHERE nom = 'Ice Shard'), 'Ice', 'Uncommon', 'Medium');

--Corresponding inserts for the Recettes table, for the potion with id of 1 and element with id of 1;
INSERT INTO Recettes (idPotion,idElement) VALUES (1,1);
