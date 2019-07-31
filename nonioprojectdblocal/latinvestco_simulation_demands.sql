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
-- Table structure for table `simulation_demands`
--

DROP TABLE IF EXISTS `simulation_demands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simulation_demands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `simulation_id` int(10) unsigned NOT NULL,
  `demand_id` int(10) unsigned NOT NULL,
  `value` decimal(22,2) NOT NULL,
  `rodi` decimal(22,2) NOT NULL,
  `dinversion` decimal(22,2) NOT NULL,
  `roic` decimal(22,2) NOT NULL,
  `eadicional` decimal(22,2) NOT NULL,
  `costopatrimonio` decimal(22,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `simulation_demands_simulation_id_foreign` (`simulation_id`),
  KEY `simulation_demands_demand_id_foreign` (`demand_id`),
  CONSTRAINT `simulation_demands_demand_id_foreign` FOREIGN KEY (`demand_id`) REFERENCES `demands` (`id`),
  CONSTRAINT `simulation_demands_simulation_id_foreign` FOREIGN KEY (`simulation_id`) REFERENCES `simulations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simulation_demands`
--

LOCK TABLES `simulation_demands` WRITE;
/*!40000 ALTER TABLE `simulation_demands` DISABLE KEYS */;
INSERT INTO `simulation_demands` VALUES (1,2,1,60000000.00,272000000.00,1.64,44.59,1104285714.29,15.79,'2019-01-14 05:57:04','2019-01-14 05:57:04'),(2,3,2,40000000.00,30800000.00,22.41,26.55,80400000.00,12.95,'2019-01-14 06:33:10','2019-01-14 06:33:10'),(3,5,3,1500000000.00,1525000000.00,2.20,74.57,4621666666.67,12.87,'2019-03-28 01:08:33','2019-03-28 01:08:33'),(4,6,4,250000000.00,959000000.00,9.09,217.95,702857142.86,41.64,'2019-03-28 21:57:42','2019-03-28 21:57:42'),(5,8,5,10000000.00,9100000.00,4.55,41.36,30500000.00,72.05,'2019-05-21 20:59:21','2019-05-21 20:59:21');
/*!40000 ALTER TABLE `simulation_demands` ENABLE KEYS */;
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
