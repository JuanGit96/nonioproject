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
-- Table structure for table `simulations`
--

DROP TABLE IF EXISTS `simulations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simulations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sector_id` int(10) unsigned NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `income` decimal(22,2) NOT NULL,
  `sale_value` decimal(22,2) NOT NULL,
  `operating_costs` decimal(22,2) NOT NULL,
  `depreciation_costs` decimal(22,2) NOT NULL,
  `amortization_costs` decimal(22,2) NOT NULL,
  `financial_obligations` decimal(22,2) NOT NULL,
  `heritage_value` decimal(22,2) NOT NULL,
  `ebitda` decimal(22,2) NOT NULL,
  `email_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `simulations_email_contact_unique` (`email_contact`),
  KEY `simulations_sector_id_foreign` (`sector_id`),
  CONSTRAINT `simulations_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simulations`
--

LOCK TABLES `simulations` WRITE;
/*!40000 ALTER TABLE `simulations` DISABLE KEYS */;
INSERT INTO `simulations` VALUES (1,12,'2017',55000000.00,38000000.00,70000000.00,10000000.00,6000000.00,20000000.00,85000000.00,-37000000.00,'urbinafoto@gmail.com',NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(2,1,'2017',500000000.00,60000000.00,50000000.00,20000000.00,30000000.00,10000000.00,600000000.00,440000000.00,'geral201014@hotmail.com',NULL,'2019-01-14 05:56:32','2019-01-14 05:56:32'),(3,15,'2017',70000000.00,40000000.00,45000000.00,35000000.00,8000000.00,26000000.00,90000000.00,28000000.00,'juansebastianur@hotmail.com',NULL,'2019-01-14 06:32:23','2019-01-14 06:32:23'),(4,1,'2018',10000000.00,10000.00,10000.00,10000.00,10000.00,10000.00,1000000.00,10000000.00,'contacto@contacto.com',NULL,'2019-02-28 00:08:44','2019-02-28 00:08:44'),(5,12,'2018',5000000000.00,2000000000.00,500000000.00,13000000.00,20000000.00,45000000.00,2000000000.00,2533000000.00,'danielareyna@latinvestco.com',NULL,'2019-03-28 01:07:22','2019-03-28 01:07:22'),(6,18,'2018',2000000000.00,500000000.00,500000000.00,50000000.00,10000000.00,40000000.00,400000000.00,1060000000.00,'danielitar18@hotmail.com',NULL,'2019-03-28 21:54:56','2019-03-28 21:54:56'),(7,2,'2017',200000000.00,50000000.00,30000000.00,2000000.00,2000000.00,12000000.00,50000000.00,124000000.00,'info@latinvestco.com',NULL,'2019-03-28 22:11:59','2019-03-28 22:11:59');
/*!40000 ALTER TABLE `simulations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-31 16:35:55
