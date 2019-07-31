-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: latinvestco
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indebtedness_capacities_id` int(10) unsigned NOT NULL,
  `value` decimal(22,2) NOT NULL,
  `interest_rate` decimal(22,2) NOT NULL,
  `terms` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` enum('Iniciado','En estudio','Aceptada','Rechazada','Vencida','Finalizado','Contactado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_indebtedness_capacities_id_foreign` (`indebtedness_capacities_id`),
  CONSTRAINT `applications_indebtedness_capacities_id_foreign` FOREIGN KEY (`indebtedness_capacities_id`) REFERENCES `indebtedness_capacities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,9,40000000.00,16.30,'90','Vencida','2019-02-23 05:13:29','2019-03-28 01:11:17'),(2,18,1515500000.00,14.00,'180','Vencida','2019-03-28 01:18:24','2019-05-22 17:04:45'),(4,19,1500000000.00,13.70,'90','Rechazada','2019-03-28 01:46:31','2019-03-28 01:50:03'),(6,18,541000000.00,16.30,'90','Vencida','2019-03-28 01:53:35','2019-05-22 17:04:45'),(7,18,4621500000.00,16.30,'90','Vencida','2019-03-28 01:57:49','2019-05-22 17:04:45'),(8,20,2163500000.00,14.50,'90','Vencida','2019-03-28 02:01:56','2019-05-22 17:04:45'),(9,20,1500000000.00,14.50,'90','Vencida','2019-03-28 21:15:57','2019-05-22 17:04:45');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-31 16:35:50
