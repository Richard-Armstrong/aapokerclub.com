-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: 127.0.0.1    Database: aapokerclub
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'administration','Administrators'),(2,'unassigned','Unassigned');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nvp_codes`
--

DROP TABLE IF EXISTS `nvp_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nvp_codes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `context` varchar(45) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `display` varchar(45) DEFAULT NULL,
  `theValue` varchar(45) DEFAULT NULL,
  `altValue` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nvp_codes`
--

LOCK TABLES `nvp_codes` WRITE;
/*!40000 ALTER TABLE `nvp_codes` DISABLE KEYS */;
INSERT INTO `nvp_codes` VALUES (1,'Yes_No',1,'Yes','1',''),(2,'Yes_No',2,'No','0','');
/*!40000 ALTER TABLE `nvp_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poker_players`
--

DROP TABLE IF EXISTS `poker_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poker_players` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poker_players`
--

LOCK TABLES `poker_players` WRITE;
/*!40000 ALTER TABLE `poker_players` DISABLE KEYS */;
INSERT INTO `poker_players` VALUES (1,'Richard','Armstrong','','richard.armstrong@gmail.com'),(2,'Adam','','',''),(3,'Alan','','',''),(4,'Brett','','',''),(5,'Brian','','',''),(6,'Chris','','',''),(7,'Dan','Britton','',''),(8,'Derrek','','',''),(9,'Gareth','','',''),(10,'Glenn','','',''),(11,'Hope','','',''),(12,'Jamie','Harrell','',''),(13,'Jay','Davis','',''),(14,'Jesse','','',''),(15,'Keith','','',''),(16,'Lowell','','',''),(17,'Paul','','',''),(18,'Ridge','','',''),(19,'Robby','','',''),(20,'Roman','','',''),(21,'Smitty','','',''),(22,'Xavier','','',''),(23,'Gomez','','','');
/*!40000 ALTER TABLE `poker_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_results`
--

DROP TABLE IF EXISTS `tournament_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tournament_results` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `tourney_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `prize` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_results`
--

LOCK TABLES `tournament_results` WRITE;
/*!40000 ALTER TABLE `tournament_results` DISABLE KEYS */;
INSERT INTO `tournament_results` VALUES (1,2,1,3,NULL,5),(2,13,1,1,NULL,7),(3,4,1,2,NULL,6),(4,18,1,4,NULL,4),(5,5,1,5,NULL,3),(6,8,1,6,NULL,2),(7,6,1,7,NULL,1),(8,6,2,1,NULL,10),(9,10,2,2,NULL,9),(10,3,2,3,NULL,8),(11,14,2,4,NULL,7),(12,4,2,5,NULL,6),(13,19,2,6,NULL,5),(14,5,2,7,NULL,4),(15,15,2,8,NULL,3),(16,16,2,9,NULL,2),(17,18,2,10,NULL,1),(18,4,3,1,NULL,8),(19,5,3,2,NULL,7),(20,13,3,3,NULL,6),(21,15,3,4,NULL,5),(22,6,3,5,NULL,4),(23,16,3,6,NULL,3),(24,14,3,7,NULL,2),(25,1,3,8,NULL,1),(26,2,4,9,NULL,2),(27,16,4,10,NULL,1),(28,4,4,8,NULL,3),(29,15,4,7,NULL,4),(30,1,4,6,NULL,5),(31,6,4,5,NULL,6),(32,11,4,4,NULL,7),(33,18,4,3,NULL,8),(34,8,4,2,NULL,9),(35,13,4,1,NULL,10),(36,4,5,1,NULL,12),(37,14,5,2,NULL,11),(38,16,5,3,NULL,10),(39,2,5,4,NULL,9),(40,13,5,5,NULL,8),(41,6,5,6,NULL,7),(42,5,5,7,NULL,6),(43,11,5,8,NULL,5),(44,8,5,9,NULL,4),(45,15,5,10,NULL,3),(46,18,5,11,NULL,2),(47,1,5,12,NULL,1),(48,3,7,1,NULL,8),(49,2,7,2,NULL,7),(50,4,7,3,NULL,6),(51,6,7,4,NULL,5),(52,16,7,5,NULL,4),(53,5,7,6,NULL,3),(54,11,7,7,NULL,2),(55,18,7,8,NULL,1),(56,17,6,1,NULL,9),(57,10,6,2,NULL,8),(58,21,6,3,NULL,7),(59,6,6,4,NULL,6),(60,16,6,5,NULL,5),(61,18,6,6,NULL,4),(62,22,6,7,NULL,3),(63,5,6,8,NULL,2),(64,2,6,9,NULL,1),(65,8,8,1,NULL,10),(66,16,8,2,NULL,9),(67,2,8,3,NULL,8),(68,6,8,4,NULL,7),(69,18,8,5,NULL,6),(70,17,8,6,NULL,5),(71,13,8,7,NULL,4),(72,5,8,8,NULL,3),(73,15,8,9,NULL,2),(74,1,8,10,NULL,1),(75,7,9,1,NULL,7),(76,5,9,2,NULL,6),(77,20,9,3,NULL,5),(78,6,9,4,NULL,4),(79,1,9,5,NULL,3),(80,12,9,6,NULL,2),(81,16,9,7,NULL,1),(82,2,10,1,NULL,7),(83,20,10,2,NULL,6),(84,18,10,3,NULL,5),(85,6,10,4,NULL,4),(86,16,10,5,NULL,3),(87,11,10,6,NULL,2),(88,1,10,7,NULL,1),(89,6,11,1,NULL,13),(90,9,11,2,NULL,12),(91,1,11,3,NULL,11),(92,13,11,4,NULL,10),(93,2,11,5,NULL,9),(94,5,11,6,NULL,8),(95,4,11,7,NULL,7),(96,16,11,8,NULL,6),(97,15,11,9,NULL,5),(98,14,11,10,NULL,4),(99,18,11,11,NULL,3),(100,12,11,12,NULL,2),(101,11,11,13,NULL,1),(102,1,12,1,NULL,9),(103,16,12,2,NULL,8),(104,8,12,3,NULL,7),(105,9,12,4,NULL,6),(106,18,12,5,NULL,5),(107,11,12,6,NULL,4),(108,5,12,7,NULL,3),(109,6,12,8,NULL,2),(110,2,12,9,NULL,1),(111,13,13,1,NULL,11),(112,11,13,2,NULL,10),(113,15,13,3,NULL,9),(114,2,13,4,NULL,8),(115,18,13,5,NULL,7),(116,16,13,6,NULL,6),(117,14,13,7,NULL,5),(118,1,13,8,NULL,4),(119,6,13,9,NULL,3),(120,19,13,10,NULL,2),(121,5,13,11,NULL,1),(122,17,14,9,NULL,1),(123,18,14,8,NULL,2),(124,23,14,7,NULL,3),(125,15,14,6,NULL,4),(126,5,14,5,NULL,5),(127,6,14,4,NULL,6),(128,16,14,3,NULL,7),(129,2,14,2,NULL,8),(130,4,14,1,NULL,9),(131,6,15,1,NULL,9),(132,3,15,2,NULL,8),(133,11,15,3,NULL,7),(134,18,15,4,NULL,6),(135,1,15,5,NULL,5),(136,17,15,6,NULL,4),(137,9,15,7,NULL,3),(138,5,15,8,NULL,2),(139,19,15,9,NULL,1);
/*!40000 ALTER TABLE `tournament_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tournaments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tourney_date` datetime DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `prize_pool` int(11) DEFAULT NULL,
  `entrants` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (1,'2021-08-04 00:00:00','Ridges',200,7),(2,'2021-08-06 00:00:00','Ridges',350,10),(3,'2021-08-13 00:00:00','Ridges',360,8),(4,'2021-08-24 00:00:00','Chris',260,10),(5,'2021-08-26 00:00:00','Ridges',410,12),(6,'2021-09-05 00:00:00','Ridges',340,9),(7,'2021-09-02 00:00:00','Ridges',220,8),(8,'2021-09-09 00:00:00','Ridges',420,10),(9,'2021-09-16 00:00:00','Ridges',210,7),(10,'2021-09-18 00:00:00','Ridges',240,7),(11,'2021-09-23 00:00:00','Ridges',420,13),(12,'2021-09-25 00:00:00','Ridges',290,9),(13,'2021-09-30 00:00:00','Ridges',370,11),(14,'2021-10-02 00:00:00','Ridges',370,9),(15,'2021-10-05 00:00:00','Ridges',220,9);
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,1,1);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `notify_sms` tinyint(1) NOT NULL DEFAULT '0',
  `notify_email` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'::1','$2y$08$Epkbj.pe3Xl9lxKwT1YvWOW.ev3bHPNo3R91QMbUkrltq5XYUrU2i',NULL,'richard.armstrong@gmail.com',NULL,NULL,NULL,NULL,1464459128,1633527531,1,'Richard','Armstrong','0',0,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-06 15:03:43
