-- Check du prix des items
ALTER TABLE items ADD CONSTRAINT ck_prix CHECK (prix > 0 AND prix <= 200);

--Type dans Enigme : savoir si le type de question est de potion (P), élément(E) ou autre(Z)
ALTER TABLE enigmes ADD 'Type' CHAR(1) NOT NULL AFTER difficulte;

--estPigee dans Enigme : savoir si la question a été pigée (o = oui | n = non)
ALTER TABLE enigmes ADD `estPigee` CHAR(1) NOT NULL AFTER Type;
