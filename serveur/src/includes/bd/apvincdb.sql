

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `photo` varchar(127) NOT NULL,
  `featured` char(1) NOT NULL DEFAULT 'N',
  `rating` int(11) NOT NULL DEFAULT 0,
  `categorie` varchar(50) NOT NULL DEFAULT 'Autres'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `articles` (`id`, `name`, `description`, `price`, `photo`, `featured`, `rating`, `categorie`) VALUES
(31, 'iPhone 16', 'Smartphone Apple avec IA intégrée pour la recherche photo, création d\'émojis et reformulation de messages. Accent sur la protection des données personnelles.', 1399, 'iPhone16.png', 'Y', 5, 'Smartphone'),
(32, 'Galaxy Z Flip4', 'Smartphone pliable de Samsung avec écran AMOLED 6,7 pouces, taux de rafraîchissement 120 Hz, et deux caméras arrière de 12 MP.', 1259.99, 'Galaxyflip4.png', 'Y', 4, 'Smartphone'),
(33, 'DJI Flip', 'Drone pliable de moins de 250 g avec caméra 48 MP, enregistrement 4K/60fps, stabilisation à 3 axes et modes de vol intelligents.', 899, 'DJIflip.png', 'N', 4, 'Autres'),
(34, 'HP Omen Transcend 32', 'Moniteur QD-OLED de 32 pouces avec haute luminosité, performances de jeu exceptionnelles et alimentation USB-C de 140 W.', 1299, 'HPomen32.png', 'N', 2, 'Moniteur'),
(35, 'Samsung Music Frame', 'Enceinte dissimulée dans un cadre photo personnalisable, offrant une qualité audio sans compromis.', 399, 'Samsungmusicframe.png', 'N', 3, 'Autres'),
(36, '70mai Omni Dash Cam', 'Caméra embarquée pivotante avec design compact, enregistrement automatique et surveillance à distance.', 149, 'Omnidash.png', 'N', 4, 'Autres'),
(37, 'HP Spectre Fold', 'Ordinateur portable pliable avec écran tactile, combinant portabilité et performance pour les professionnels en déplacement.', 1999, 'HPSpectrefold.png', 'Y', 4, 'Autres'),
(38, 'Oura Ring 4', 'Anneau intelligent en titane offrant un suivi précis de la santé, du sommeil et de l\'activité quotidienne.', 399, 'OuraRing4.png', 'N', 4, 'Autres'),
(39, 'Garmin fēnix 8', 'Montre GPS robuste avec suivi de l\'endurance, cartes TopoActive intégrées et fonctionnalités multisports.', 899, 'Garminfenix8.png', 'N', 4, 'Autres'),
(40, 'Galaxy Ring', 'Anneau connecté de Samsung pour le suivi du sommeil et du rythme cardiaque, intégrant des fonctionnalités d\'IA.', 349, 'Galaxyring.png', 'N', 4, 'Autres');



CREATE TABLE `connexion` (
  `idm` int(11) DEFAULT NULL,
  `courriel` varchar(256) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` char(1) NOT NULL,
  `statut` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `connexion` (`idm`, `courriel`, `pass`, `role`, `statut`) VALUES
(2, 'alastor@gmail.com', '$2y$10$b2oBN8L3o2qsuzZFRxavAep/6fJ.K0MvoLsjfG88leatlcqo1.Tl.', 'A', 'A'),
(3, 'alastormembre@gmail.com', '$2y$10$KPl0dvOQB7LNHujYxocVHOpEcQCuO9sLFFntsFQp/YkPTN2LytO4q', 'M', 'A');



CREATE TABLE `membres` (
  `idm` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `sexe` varchar(2) DEFAULT NULL,
  `daten` date DEFAULT NULL,
  `photo` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




INSERT INTO `membres` (`idm`, `nom`, `prenom`, `sexe`, `daten`, `photo`) VALUES
(2, 'Espinoza', 'Kevin', 'M', '2000-03-29', NULL),
(3, 'espinoza', 'kevin', 'M', '2000-03-29', NULL);


ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `connexion`
  ADD KEY `connexion_idm_FK` (`idm`);


ALTER TABLE `membres`
  ADD PRIMARY KEY (`idm`);




ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;


ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);
COMMIT;

