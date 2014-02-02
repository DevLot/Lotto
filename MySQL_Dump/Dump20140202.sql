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
  `cardnr` int(11) DEFAULT NULL COMMENT 'Karten Nummer',
  `line1` varchar(45) DEFAULT NULL COMMENT 'Zahlen 1. Reihe',
  `line2` varchar(45) DEFAULT NULL COMMENT 'Zahlen 2. Reihe',
  `line3` varchar(45) DEFAULT NULL COMMENT 'Zahlen 3. Reihe',
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Player',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`),
  KEY `player_idx` (`player`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Enthält alle Spielkarten';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,1234,'2,5,11,24,36','6,13,33,45,67','9,18,20,53,84',32,'2013-12-14 17:24:22','2013-12-14 17:24:22'),(6,9999,'12,15,2,48,1','45,66,23,21,7','35,19,58,39,8',33,'2013-12-14 19:04:10','2013-12-14 19:04:10'),(8,1,'1,2,3,4,5','6,15,39,55,65','11,12,13,14,15',33,'2013-12-14 21:09:58','2013-12-14 21:09:58'),(11,2014,'11,22,33,44,55','9,8,7,6,5','55,66,77,88,99',32,'2014-01-18 17:39:44','2014-01-18 17:39:44');
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
  `name` varchar(45) DEFAULT NULL COMMENT 'Event Name',
  `date` date DEFAULT NULL COMMENT 'Event Datum',
  `location` varchar(45) DEFAULT NULL COMMENT 'Event Ort',
  `organizer` varchar(45) DEFAULT NULL COMMENT 'Event Veranstallter',
  `duration` time DEFAULT NULL COMMENT 'Event Dauer',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Enthält die einzelnen Events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (2,'Test2','1212-12-12','Test2','Test2',NULL,'2014-01-15 20:13:49','2014-01-15 20:13:49'),(3,'Test3','1212-12-12','Test4','Test4',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(4,'Test4','1212-12-12','Test4','Test4',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(5,'Test5','1212-12-12','Test5','Test5',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(6,'Test6','1212-12-12','Test6','Test6',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(7,'Test7','1212-12-12','Test7','Test7',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(8,'Test8','1212-12-12','Test8','Test8',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(9,'Test9','1212-12-12','Test9','Test9',NULL,'2014-01-15 20:18:38','2014-01-15 20:18:38'),(10,'asdf','1234-12-12','asdf','asdf',NULL,'2014-01-15 20:27:25','2014-01-15 20:27:25');
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
  `round` int(11) DEFAULT NULL COMMENT 'Serie:',
  `numbers` varchar(45) DEFAULT NULL COMMENT 'Gezogene Nummern',
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='History der Events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (9,1,1,'26,01,14','2014-01-25 23:59:08','2014-01-25 23:59:08'),(30,3,1,'1,2,3,4,5,1,2,3,4,5,1,2,3,4,5,1,2,3,4,5','2014-01-28 16:44:43','2014-01-28 16:44:43'),(31,3,2,'6,7,8,9,10,6,7,8,9,10,6,7,8,9,10,6,7,8,9,10','2014-01-28 16:44:43','2014-01-28 16:44:43'),(32,3,3,'','2014-01-26 19:38:34','2014-01-26 19:38:34'),(33,3,1,'','2014-01-28 16:21:15','2014-01-28 16:21:15'),(34,3,2,'','2014-01-28 16:21:15','2014-01-28 16:21:15'),(35,3,3,'','2014-01-28 16:21:15','2014-01-28 16:21:15'),(36,3,1,'','2014-01-28 16:21:39','2014-01-28 16:21:39'),(37,3,2,'','2014-01-28 16:21:39','2014-01-28 16:21:39'),(38,3,3,'','2014-01-28 16:21:39','2014-01-28 16:21:39'),(39,3,1,'','2014-01-28 16:44:42','2014-01-28 16:44:42'),(40,3,2,'','2014-01-28 16:44:42','2014-01-28 16:44:42'),(41,3,3,'','2014-01-28 16:44:42','2014-01-28 16:44:42');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Spieler ID',
  `firstname` varchar(45) DEFAULT NULL COMMENT 'Vornamen',
  `surname` varchar(45) DEFAULT NULL COMMENT 'Nachnamen',
  `birthdate` date DEFAULT NULL COMMENT 'Geburtsdatum',
  `address` varchar(45) DEFAULT NULL COMMENT 'Adresse',
  `zipcode` int(11) DEFAULT NULL COMMENT 'PLZ',
  `city` varchar(45) DEFAULT NULL COMMENT 'Ort',
  `phone` int(11) DEFAULT NULL COMMENT 'Telefon',
  `mobile` int(11) DEFAULT NULL COMMENT 'Mobile',
  `mail` varchar(45) DEFAULT NULL COMMENT 'E-Mail',
  `status` int(1) DEFAULT '1',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='Enthält Informationen über Spieler	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (32,'Hans','Muster','2013-12-14','Musterweg 1',5400,'Baden',49,79,'hans@muster.ch',1,'2013-12-14 23:01:46','2013-12-14 23:01:46'),(33,'Peter','Müller','2014-01-18','Wolfbergstrasse1',5400,'Baden',49,79,NULL,1,'2014-01-18 21:18:23','2014-01-18 21:18:23');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
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
  `player` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Player',
  `event` int(11) DEFAULT NULL COMMENT 'Foreigen Key: Event',
  `set` int(11) NOT NULL COMMENT 'Serie:',
  `create_on` timestamp NULL DEFAULT NULL COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT NULL COMMENT 'Aktualisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id_UNIQUE` (`id`)
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
  `player` int(11) NOT NULL COMMENT 'Foreigen Key: Spieler',
  `event` int(11) NOT NULL COMMENT 'Foreigen Key: Event',
  `create_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Erstellt am:',
  `update_on` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Aktuallisiert am:',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Anmeldungen für Events		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
INSERT INTO `registration` VALUES (1,32,2,'2014-01-18 15:58:14','2014-01-18 15:58:14'),(2,32,3,'2014-01-18 16:42:48','2014-01-18 16:42:48'),(3,32,4,'2014-01-18 16:42:56','2014-01-18 16:42:56'),(4,32,5,'2014-01-18 16:43:00','2014-01-18 16:43:00'),(5,33,2,'2014-01-18 21:13:19','2014-01-18 21:13:19'),(6,33,3,'2014-01-18 21:13:24','2014-01-18 21:13:24'),(7,33,4,'2014-01-18 21:13:27','2014-01-18 21:13:27'),(8,33,5,'2014-01-18 21:13:31','2014-01-18 21:13:31'),(9,34,4,'2014-01-22 20:43:58','2014-01-22 20:43:58');
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

-- Dump completed on 2014-02-02 17:49:58
