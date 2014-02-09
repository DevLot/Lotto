-- Create Database Schema 'fabingo'
CREATE DATABASE IF NOT EXISTS `fabingo` DEFAULT CHARACTER SET utf8 ;
USE `fabingo`;


-- Table structure for table `cards`

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Karten ID',
  `cardnr` int(11) DEFAULT NULL COMMENT 'Karten Nummer',
  `line1` varchar(45) DEFAULT NULL COMMENT 'Zahlen 1. Reihe',
  `line2` varchar(45) DEFAULT NULL COMMENT 'Zahlen 2. Reihe',
  `line3` varchar(45) DEFAULT NULL COMMENT 'Zahlen 3. Reihe',
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Spieler ID',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`),
  KEY `player_idx` (`player`)
) ENGINE=InnoDB AUTO_INCREMENT=726 DEFAULT CHARSET=utf8 COMMENT='Enthält alle Spielkarten';


-- Table structure for table `events`

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Event ID',
  `name` varchar(45) DEFAULT NULL COMMENT 'Event Name',
  `date` date DEFAULT NULL COMMENT 'Event Datum',
  `location` varchar(45) DEFAULT NULL COMMENT 'Event Ort',
  `organizer` varchar(45) DEFAULT NULL COMMENT 'Event Veranstalter',
  `duration` time DEFAULT NULL COMMENT 'Event Dauer',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktualisiert am: ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Enthält die einzelnen Events';


-- Table structure for table `history`

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'History ID',
  `event` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Event ID',
  `round` int(11) DEFAULT NULL COMMENT 'Serie',
  `numbers` varchar(255) DEFAULT NULL COMMENT 'Gezogene Nummern',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktualisiert am: ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='History der Events';


-- Table structure for table `players`

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Spieler ID',
  `firstname` varchar(45) DEFAULT NULL COMMENT 'Vornamen',
  `surname` varchar(45) DEFAULT NULL COMMENT 'Nachnamen',
  `birthdate` date DEFAULT NULL COMMENT 'Geburtsdatum',
  `address` varchar(45) DEFAULT NULL COMMENT 'Adresse',
  `zipcode` int(11) DEFAULT NULL COMMENT 'PLZ',
  `city` varchar(45) DEFAULT NULL COMMENT 'Ort',
  `phone` int(14) DEFAULT NULL COMMENT 'Telefon',
  `mobile` int(14) DEFAULT NULL COMMENT 'Mobil Telefon',
  `mail` varchar(255) DEFAULT NULL COMMENT 'E-Mail',
  `status` int(1) DEFAULT '1' COMMENT 'Status: 1=Aktiviert; 0=Deaktiviert',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Enthält Informationen über Spieler	';


-- Table structure for table `prices`

DROP TABLE IF EXISTS `prices`;

CREATE TABLE `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Preis ID',
  `name` varchar(45) DEFAULT NULL COMMENT 'Preis Name',
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Spieler ID des Gewinners',
  `event` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Event ID',
  `round` int(11) DEFAULT NULL COMMENT 'Serie',
  `line` int(1) DEFAULT NULL COMMENT 'Linien Nr. der Gewinnkarte',
  `card` int(11) DEFAULT NULL COMMENT 'Karten ID',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Enthält alle Preise';


-- Table structure for table `registration`

DROP TABLE IF EXISTS `registration`;

CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registrations ID',
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Spieler ID',
  `event` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Event ID',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktuallisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Anmeldungen für Events		';