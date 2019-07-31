-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: latinvestco
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.16.04.1

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
-- Table structure for table `average_interests`
--

DROP TABLE IF EXISTS `average_interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `average_interests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` int(10) unsigned NOT NULL,
  `agricultura` decimal(22,2) NOT NULL,
  `explotacion` decimal(22,2) NOT NULL,
  `industria` decimal(22,2) NOT NULL,
  `electricidad` decimal(22,2) NOT NULL,
  `agua` decimal(22,2) NOT NULL,
  `construccion` decimal(22,2) NOT NULL,
  `comercio` decimal(22,2) NOT NULL,
  `transporte` decimal(22,2) NOT NULL,
  `alojamiento` decimal(22,2) NOT NULL,
  `comunicaciones` decimal(22,2) NOT NULL,
  `financieras` decimal(22,2) NOT NULL,
  `inmobiliarias` decimal(22,2) NOT NULL,
  `cientificas` decimal(22,2) NOT NULL,
  `administrativos` decimal(22,2) NOT NULL,
  `publica` decimal(22,2) NOT NULL,
  `educacion` decimal(22,2) NOT NULL,
  `salud` decimal(22,2) NOT NULL,
  `arte` decimal(22,2) NOT NULL,
  `otras` decimal(22,2) NOT NULL,
  `hogares` decimal(22,2) NOT NULL,
  `organizaciones` decimal(22,2) NOT NULL,
  `noincluidas` decimal(22,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `average_interests_offer_id_foreign` (`offer_id`),
  CONSTRAINT `average_interests_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `average_interests`
--

LOCK TABLES `average_interests` WRITE;
/*!40000 ALTER TABLE `average_interests` DISABLE KEYS */;
INSERT INTO `average_interests` VALUES (1,1,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,2,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,3,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,4,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(7,7,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2019-05-21 22:27:32','2019-05-21 22:27:32');
/*!40000 ALTER TABLE `average_interests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-31 16:34:06
