CREATE DATABASE  IF NOT EXISTS `fabingo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fabingo`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: fabingo
-- ------------------------------------------------------
-- Server version	5.5.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Karten ID',
  `cardnr` int(11) NOT NULL COMMENT 'Karten Nummer',
  `line1` varchar(45) NOT NULL COMMENT 'Zahlen 1. Reihe',
  `line2` varchar(45) NOT NULL COMMENT 'Zahlen 2. Reihe',
  `line3` varchar(45) NOT NULL COMMENT 'Zahlen 3. Reihe',
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Player',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Enthält alle Spielkarten';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,1234,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',3,'2013-12-14 17:24:22','2013-12-14 17:24:22'),(2,1235,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',3,'2013-12-14 17:24:47','2013-12-14 17:24:47'),(3,1236,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',3,'2013-12-14 17:24:51','2013-12-14 17:24:51'),(4,1237,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',3,'2013-12-14 17:24:55','2013-12-14 17:24:55'),(5,1238,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',3,'2013-12-14 17:24:59','2013-12-14 17:24:59');
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Event ID',
  `name` varchar(45) NOT NULL COMMENT 'Event Name',
  `date` date NOT NULL COMMENT 'Event Datum',
  `location` varchar(45) NOT NULL COMMENT 'Event Ort',
  `host` varchar(45) DEFAULT NULL COMMENT 'Event Veranstallter',
  `duration` time DEFAULT NULL COMMENT 'Event Dauer',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Enthält die einzelnen Events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'History ID',
  `event` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Event',
  `set` int(11) NOT NULL COMMENT 'Serie:',
  `numbers` int(11) NOT NULL COMMENT 'Gezogene Nummern',
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `fk_ev_UNIQUE` (`event`),
  CONSTRAINT `fk_ev` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='History der Events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Spieler ID',
  `firstname` varchar(45) NOT NULL COMMENT 'Vornamen',
  `surname` varchar(45) NOT NULL COMMENT 'Nachnamen',
  `birthdate` date NOT NULL COMMENT 'Geburtsdatum',
  `address` varchar(45) NOT NULL COMMENT 'Adresse',
  `zipcode` int(11) NOT NULL COMMENT 'PLZ',
  `city` varchar(45) NOT NULL COMMENT 'Ort',
  `phone` int(11) DEFAULT NULL COMMENT 'Telefon',
  `mobile` int(11) DEFAULT NULL COMMENT 'Mobile',
  `mail` varchar(45) NOT NULL COMMENT 'E-Mail',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Enthält Informationen über Spieler	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (3,'Philippe','Rüdele','1989-02-21','Zürcherstrasse 20',5400,'Baden',0,111,'f@r.ch','2013-12-14 11:57:09','2013-12-14 11:57:09');
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Preis ID',
  `name` varchar(45) NOT NULL COMMENT 'Preis Name',
  `player` int(11) NOT NULL COMMENT 'Foreigen Key: Player',
  `event` int(11) NOT NULL COMMENT 'Foreigen Key: Event',
  `set` int(11) NOT NULL COMMENT 'Serie:',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`),
  KEY `fk_pl_idx` (`player`),
  KEY `fk_ev_idx` (`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Enthält alle Preise';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Anmeldungs ID',
  `player` varchar(45) NOT NULL COMMENT 'Foreigen Key: Spieler',
  `event` varchar(45) NOT NULL COMMENT 'Foreigen Key: Event',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktuallisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Anmeldungen für Events		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-14 19:18:34
