-- Changer la quantité d'item dans un panier
DELIMITER //

CREATE PROCEDURE changePanierQt(IN id_panier INT, IN qt INT)
BEGIN
    DECLARE id_item INT;
    DECLARE qt_stock INT;
    DECLARE qt_panier INT;

    SELECT idItem INTO id_item FROM paniers WHERE id = id_panier;
    SELECT quantiteStock INTO qt_stock FROM items WHERE id = id_item;
    SELECT quantite INTO qt_panier FROM paniers WHERE id = id_panier;

    SET qt_panier = qt_panier + qt;

    IF qt_panier > 0 AND qt_panier <= qt_stock THEN
        UPDATE paniers SET quantite = qt_panier WHERE id = id_panier;
    ELSEIF qt_panier <= 0 THEN
        DELETE FROM paniers WHERE id = id_panier;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Quantité invalide';
    END IF;
END//

DELIMITER ;


-- Ajouter un item au panier
DELIMITER //

CREATE PROCEDURE addPanier(IN id_joueur INT, IN id_item INT, IN qt INT)
BEGIN
    DECLARE qt_stock INT;
    DECLARE item_exists INT;
    
    SELECT quantiteStock INTO qt_stock FROM items WHERE id = id_item;
    SELECT COUNT(*) INTO item_exists FROM paniers WHERE idJoueur = id_joueur AND idItem = id_item;
    
    IF (((SELECT estAlchimiste FROM joueurs WHERE id = id_joueur) = 0) AND ((SELECT type FROM items WHERE id = id_item) = 'E')) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Seulement les alchimistes peuvent ajouter des éléments à leur panier';
    END IF;

    IF (qt_stock > 0) THEN
        IF (qt > 0) THEN
            IF (item_exists > 0) THEN
                IF (qt_stock >= (SELECT quantite FROM paniers WHERE idItem = id_item AND idJoueur = id_joueur) + qt) THEN
                    UPDATE paniers SET quantite = quantite + qt WHERE idJoueur = id_joueur AND idItem = id_item;
                END IF;
            ELSE
                INSERT INTO paniers (idJoueur, idItem, quantite) VALUES (id_joueur, id_item, qt);
            END IF;
        END IF;
    END IF;
END//

DELIMITER ;


-- Acheter le panier
DELIMITER //

CREATE PROCEDURE buyPanier(IN id_joueur INT)
BEGIN
    DECLARE total INT;
    DECLARE item_id_item INT;
    DECLARE item_quantite INT;
    DECLARE done INT;

    DECLARE cur CURSOR FOR SELECT idItem, quantite FROM paniers WHERE idJoueur = id_joueur;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    SELECT SUM(quantite * prix) INTO total FROM paniers INNER JOIN items ON paniers.idItem = items.id WHERE idJoueur = id_joueur;

    IF (total <= (SELECT solde FROM joueurs WHERE id = id_joueur)) THEN
        OPEN cur ;
            update_loop: LOOP
                FETCH cur INTO item_id_item, item_quantite;
                    IF (done = 1) THEN
                        LEAVE update_loop;
                    END IF;
                UPDATE items SET quantiteStock = quantiteStock - item_quantite WHERE id = item_id_item;
                IF ((SELECT COUNT(*) FROM inventaires WHERE idJoueur = id_joueur AND idItem = item_id_item) = 0) THEN
                    INSERT INTO inventaires (idJoueur, idItem, quantite) VALUES (id_joueur, item_id_item, item_quantite);
                ELSE
                    UPDATE inventaires SET quantite = quantite + item_quantite WHERE idJoueur = id_joueur AND idItem = item_id_item;
                END IF;
                DELETE FROM paniers WHERE idJoueur = id_joueur AND idItem = item_id_item;
            END LOOP update_loop ;
        CLOSE cur ;

        IF (total IS NOT NULL) THEN
            UPDATE joueurs SET solde = solde - total WHERE id = id_joueur;
        END IF;
    END IF ;
END//

DELIMITER ;

-- S'assurer du prix des potions et éléments
DELIMITER |;
CREATE TRIGGER checkPrixItem
before insert ON items
for each row
begin
declare minPrix int;
declare maxPrix int;
SELECT MAX(prix) INTO minPrix FROM items WHERE type = 'E';
SELECT MIN(prix) INTO maxPrix FROM items WHERE type = 'P';
-- on garantit le prix potion>=100
if(new.type='P') Then
    if(new.prix < minPrix) then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le prix est trop bas';
    end if; 
end if;
-- on garantit que le prix element <100
if(new.type='E') Then
    if(new.prix >= maxPrix) then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le prix est trop élevé';
    end if; 
end if;
END |;

DELIMITER //
CREATE PROCEDURE GetRecord(IN recordID INT)
BEGIN
    IF recordID IS NOT NULL THEN
        SELECT * FROM items WHERE Id = recordID;
    ELSE
        SELECT * FROM items;
    END IF;
END //
DELIMITER ;


-- Changer le solde du joueur lorsqu'il résout une énigme dépendamment de la difficulté de l'énigme
DELIMITER //

CREATE PROCEDURE repondreEnigme(IN id_enigme INT, IN id_joueur INT, IN id_reponse INT)
BEGIN
    DECLARE difficulte_enigme VARCHAR(12);
    DECLARE est_bonne BIT;
  
    SELECT difficulte INTO difficulte_enigme FROM enigmes WHERE id = id_enigme;
    SELECT estBonne INTO est_bonne FROM reponses WHERE id = id_reponse;
   
    IF est_bonne = 1 THEN
        IF difficulte_enigme = 'Facile' THEN
            UPDATE joueurs SET solde = solde + 50 WHERE id = id_joueur;
        END IF;
        IF difficulte_enigme = 'Moyen' THEN
            UPDATE joueurs SET solde = solde + 100 WHERE id = id_joueur;
        END IF;
        IF difficulte_enigme = 'Difficile' THEN
            UPDATE joueurs SET solde = solde + 200 WHERE id = id_joueur;
        END IF;
        
        INSERT INTO quetes (idJoueur, idEnigme, reussi) VALUES (id_joueur, id_enigme, 1);
    ELSE 
        INSERT INTO quetes (idJoueur, idEnigme, reussi) VALUES (id_joueur, id_enigme, 0);
    END IF;

END//

DELIMITER ;

-- Le joueur devient alchimiste s'il résout 3 énigmes de potions ou éléments
DELIMITER //
CREATE PROCEDURE checkEnigmesRésoluEnigmaAlchimiste(IN id_joueur INT)
begin
declare nb_quetes_reussi_joueur_potions_elements int;

SELECT count(*) INTO  nb_quetes_reussi_joueur_potions_elements FROM quetes INNER JOIN enigmes ON quetes.idEnigme = enigmes.id WHERE (enigmes.type = 'E' OR enigmes.type='P') AND quetes.reussi=1 AND idJoueur =id_joueur;

if( nb_quetes_reussi_joueur_potions_elements >=3) Then
    UPDATE joueurs SET estAlchimiste = 1 WHERE id = id_joueur;
    UPDATE joueurs SET niveau = 'débutant' WHERE id = id_joueur;
end if;

END// 
DELIMITER ;

-- Augmente le niveau d'un joueur lorsqu'il concocte des potions
DELIMITER //

CREATE TRIGGER augmenteNiveau
AFTER INSERT ON potionsConcoctes
FOR EACH ROW
BEGIN

	DECLARE nb_potions INT;
    SELECT COUNT(*) INTO nb_potions FROM potionsConcoctes WHERE idJoueur = new.idJoueur;
    
    IF (nb_potions >= 3 AND nb_potions < 6) THEN
    	UPDATE joueurs SET niveau = 'débutant' WHERE id = new.idJoueur;
    ELSEIF (nb_potions >= 6 AND nb_potions < 9) THEN
    	UPDATE joueurs SET niveau = 'intermédiaire' WHERE id = new.idJoueur;
    ELSEIF (nb_potions >= 9) THEN
    	UPDATE joueurs SET niveau = 'expert' WHERE id = new.idJoueur;
    END IF;

END //

DELIMITER ;

-- Ajouter une demande pour de l'argent (A: accepté, R: rejeté, W: attente)
DELIMITER //

CREATE PROCEDURE nouvelleDemande(IN id_joueur INT)
BEGIN

    DECLARE nb_demandes INT;
    SELECT COUNT(*) INTO nb_demandes FROM demandes WHERE idJoueur = id_joueur;

    IF (nb_demandes < 3) THEN
        INSERT INTO demandes (idJoueur, statue) VALUES (id_joueur, 'W');
    END IF;

END//

DELIMITER ;

-- Accepter une demande
DELIMITER //

CREATE PROCEDURE accepterDemande(IN id_demande INT)
BEGIN

    DECLARE id_joueur INT;
    SELECT idJoueur INTO id_joueur FROM demandes WHERE id = id_demande;

    IF ((SELECT statue FROM demandes WHERE id = id_demande) = 'W') THEN
        UPDATE demandes SET statue = 'A' WHERE id = id_demande;
        UPDATE joueurs SET solde = (solde + 200) WHERE id = id_joueur;
    END IF;

END//

DELIMITER ;

-- Refuser une demande
DELIMITER //

CREATE PROCEDURE refuserDemande(IN id_demande INT)
BEGIN

    IF ((SELECT statue FROM demandes WHERE id = id_demande) = 'W') THEN
        UPDATE demandes SET statue = 'R' WHERE id = id_demande;
    END IF;

END//

DELIMITER ;


-- Ajouter une potion
DELIMITER //
CREATE PROCEDURE ajouterPotion(IN potion_id INT,IN id_joueur int,IN elem1_id int,IN elem2_id int)
BEGIN
    DECLARE idItem_potion INT;
    DECLARE qt_elem1 INT;
    DECLARE qt_elem2 INT;
    DECLARE id_item1 INT;
    DECLARE id_item2 INT;
    DECLARE qt_inventaire1 INT;
    DECLARE qt_inventaire2 INT;

    SELECT idItem INTO idItem_potion FROM potions WHERE id = potion_id;
    
    SELECT qtElement INTO qt_elem1 FROM recettes WHERE idPotion = potion_id AND idElement = elem1_id;
    
    SELECT qtElement INTO qt_elem2 FROM recettes WHERE idPotion = potion_id AND idElement = elem2_id;
    
    SELECT idItem INTO id_item1 FROM elements WHERE id = elem1_id;
    
    SELECT idItem INTO id_item2 FROM elements WHERE id = elem2_id;

    
    IF(SELECT quantite from inventaires WHERE idJoueur = id_joueur AND idItem = idItem_potion) >= 1 THEN
        UPDATE inventaires SET quantite = quantite + 1 WHERE idJoueur = id_joueur and idItem = idItem_potion;
        
        INSERT INTO potionsConcoctes (idJoueur, idPotion) VALUES (id_joueur, potion_id);
        
        UPDATE inventaires SET quantite = (quantite - qt_elem1) WHERE idJoueur = id_joueur AND idItem = id_item1;
        
        UPDATE inventaires SET quantite = (quantite - qt_elem2) WHERE idJoueur = id_joueur AND idItem = id_item2;
        IF (SELECT quantite FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item1) <= 0 THEN
            DELETE FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item1;
        END IF;
        
        IF (SELECT quantite FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item2) <= 0 THEN
            DELETE FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item2;
        END IF;
    ELSE
        INSERT INTO inventaires (idJoueur, idItem, quantite) VALUES (id_joueur, idItem_potion, 1);
        
        INSERT INTO potionsConcoctes (idJoueur, idPotion) VALUES (id_joueur, potion_id);

        UPDATE inventaires SET quantite = (quantite - qt_elem1) WHERE idJoueur = id_joueur AND idItem = id_item1;
        
        UPDATE inventaires SET quantite = (quantite - qt_elem2) WHERE idJoueur = id_joueur AND idItem = id_item2;
        
        IF (SELECT quantite FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item1) <= 0 THEN
            DELETE FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item1;
        END IF;
        
        IF (SELECT quantite FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item2) <= 0 THEN
            DELETE FROM inventaires WHERE idJoueur = id_joueur AND idItem = id_item2;
        END IF;
    END IF;
END  //

DELIMITER ;

--moyenne des évaluations
DELIMITER |
CREATE FUNCTION moyenneEvaluation(id INT) returns integer
BEGIN
    DECLARE moyenne integer;
    SELECT AVG(etoile) INTO moyenne FROM evaluations WHERE idItem= id;
    RETURN moyenne;
END|


-- Modifier alias
DELIMITER //

CREATE PROCEDURE modifierAlias(IN id_joueur INT, IN nouv_alias VARCHAR(32))
BEGIN
    UPDATE joueurs SET alias = nouv_alias WHERE id = id_joueur;
END  //

DELIMITER ;


-- Modifier Prénom
DELIMITER //

CREATE PROCEDURE modifierPrenom(IN id_joueur INT, IN nouv_prenom VARCHAR(32))
BEGIN
    UPDATE joueurs SET prenom = nouv_prenom WHERE id = id_joueur;
END //

DELIMITER ;


-- Modifier Nom
DELIMITER //

CREATE PROCEDURE modifierNom(IN id_joueur INT, IN nouv_nom VARCHAR(32))
BEGIN
    UPDATE joueurs SET nom = nouv_nom WHERE id = id_joueur;
END //

DELIMITER ;


-- Modifier Mot de passe
DELIMITER //

CREATE PROCEDURE modifierPassword(IN id_joueur INT, IN nouv_mdp VARCHAR(256))
BEGIN
    UPDATE joueurs SET motDePasse = nouv_mdp WHERE id = id_joueur;
END //

DELIMITER ;