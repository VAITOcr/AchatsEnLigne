CREATE IF NOT EXISTS DATABASE APVincdb;
USE APVincdb;

CREATE  TABLE membres(
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
	pass VARCHAR(255) NOT NULL,
	role CHAR(1) NOT NULL, 
	statut CHAR(1) NOT NULL,
	CONSTRAINT connexion_idm_FK FOREIGN KEY (idm) REFERENCES membres(idm)
);

CREATE TABLE articles(
	id int PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	description TEXT NOT NULL,
	price FLOAT NOT NULL,
	photo VARCHAR(127) NOT NULL,
	featured CHAR(1) DEFAULT 'N',
	rating INT MAX(5) DEFAULT 0
);


INSERT INTO membres VALUES(1,"admin","admin","F", "1985-03-18","admin.png");
INSERT INTO connexion VALUES(1, "admin@boutique.com","12345",'A','A');


INSERT INTO articles (name, description, price, photo) VALUES
("iPhone 16", "Smartphone Apple avec IA intégrée pour la recherche photo, création d'émojis et reformulation de messages. Accent sur la protection des données personnelles.", 1399.00, "https://www.apple.com/iphone-16/images/overview/hero.jpg"),
("Galaxy Z Flip4", "Smartphone pliable de Samsung avec écran AMOLED 6,7 pouces, taux de rafraîchissement 120 Hz, et deux caméras arrière de 12 MP.", 1259.99, "https://images.samsung.com/galaxy-z-flip4/overview/hero.jpg"),
("DJI Flip", "Drone pliable de moins de 250 g avec caméra 48 MP, enregistrement 4K/60fps, stabilisation à 3 axes et modes de vol intelligents.", 899.00, "https://www.dji.com/dji-flip/images/overview/hero.jpg"),
("HP Omen Transcend 32", "Moniteur QD-OLED de 32 pouces avec haute luminosité, performances de jeu exceptionnelles et alimentation USB-C de 140 W.", 1299.00, "https://www.hp.com/omen-transcend-32/images/overview/hero.jpg"),
("Samsung Music Frame", "Enceinte dissimulée dans un cadre photo personnalisable, offrant une qualité audio sans compromis.", 399.00, "https://images.samsung.com/music-frame/overview/hero.jpg"),
("70mai Omni Dash Cam", "Caméra embarquée pivotante avec design compact, enregistrement automatique et surveillance à distance.", 149.00, "https://www.70mai.com/omni-dash-cam/images/overview/hero.jpg"),
("HP Spectre Fold", "Ordinateur portable pliable avec écran tactile, combinant portabilité et performance pour les professionnels en déplacement.", 1999.00, "https://www.hp.com/spectre-fold/images/overview/hero.jpg"),
("Oura Ring 4", "Anneau intelligent en titane offrant un suivi précis de la santé, du sommeil et de l'activité quotidienne.", 399.00, "https://ouraring.com/ring-4/images/overview/hero.jpg"),
("Garmin fēnix 8", "Montre GPS robuste avec suivi de l'endurance, cartes TopoActive intégrées et fonctionnalités multisports.", 899.00, "https://www.garmin.com/fenix-8/images/overview/hero.jpg"),
("Galaxy Ring", "Anneau connecté de Samsung pour le suivi du sommeil et du rythme cardiaque, intégrant des fonctionnalités d'IA.", 349.00, "https://images.samsung.com/galaxy-ring/overview/hero.jpg");
