-- Check du prix des items
ALTER TABLE items ADD CONSTRAINT ck_prix CHECK (prix > 0 AND prix <= 200);

--Type dans Enigme
ALTER TABLE enigmes ADD 'Type' CHAR(1) NOT NULL AFTER difficulte;