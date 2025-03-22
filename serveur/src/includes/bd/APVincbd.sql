CREATE IF NOT EXISTS DATABASE APVincdb;
USE APVincdb;

CREATE IF NOT EXISTS TABLE membres(
	idm int PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(30) NOT NULL,
	prenom VARCHAR(30) NOT NULL,
	sexe VARCHAR(2),
	daten DATE,
	photo VARCHAR(127)
);

CREATE TABLE connexion(
	idm int,
	courriel VARCHAR(256) NOT NULL,
	pass VARCHAR(20) NOT NULL,
	role CHAR(1) NOT NULL, 
	statut CHAR(1) NOT NULL,
	CONSTRAINT connexion_idm_FK FOREIGN KEY (idm) REFERENCES membres(idm)
);

INSERT INTO membres VALUES(1,"admin","admin","F", "1985-03-18","admin.png");
INSERT INTO connexion VALUES(1, "admin@boutique.com","12345",'A','A');