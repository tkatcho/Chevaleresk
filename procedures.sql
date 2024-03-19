-- Entrez vos procédures ici

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
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid quantity';
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