-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `average_interests`
--

LOCK TABLES `average_interests` WRITE;
/*!40000 ALTER TABLE `average_interests` DISABLE KEYS */;
INSERT INTO `average_interests` VALUES (1,1,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,14.60,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,2,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,17.70,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,3,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,18.80,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,4,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,16.30,'2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `average_interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `income` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_costs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depreciation_costs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amortization_costs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_obligations` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heritage_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demands`
--

DROP TABLE IF EXISTS `demands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `demands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `nit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubication` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demands_nit_unique` (`nit`),
  KEY `demands_user_id_foreign` (`user_id`),
  CONSTRAINT `demands_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demands`
--

LOCK TABLES `demands` WRITE;
/*!40000 ALTER TABLE `demands` DISABLE KEYS */;
INSERT INTO `demands` VALUES (1,6,'2699','lop','lop','233','ghjk','2019-01-14 05:57:04','2019-01-14 05:57:04'),(2,7,'31345800001','Empresa prueba hotmail','Jorge Garzon','3127854546','Bogota D.C','2019-01-14 06:33:10','2019-01-21 20:40:37');
/*!40000 ALTER TABLE `demands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `heritage_costs`
--

DROP TABLE IF EXISTS `heritage_costs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `heritage_costs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tlr_usa` decimal(22,2) NOT NULL,
  `embi` decimal(22,2) NOT NULL,
  `tasa_impuestos` decimal(22,2) NOT NULL,
  `prima_mercado` decimal(22,2) NOT NULL,
  `inflacion_colombia` decimal(22,2) NOT NULL,
  `inflacion_usa` decimal(22,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `heritage_costs`
--

LOCK TABLES `heritage_costs` WRITE;
/*!40000 ALTER TABLE `heritage_costs` DISABLE KEYS */;
INSERT INTO `heritage_costs` VALUES (1,6.06,2.39,40.00,5.91,4.09,2.11,'2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `heritage_costs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indebtedness_capacities`
--

DROP TABLE IF EXISTS `indebtedness_capacities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `indebtedness_capacities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `simulation_id` int(10) unsigned NOT NULL,
  `offers_id` int(10) unsigned NOT NULL,
  `cec` decimal(22,2) NOT NULL,
  `cecc` decimal(22,2) NOT NULL,
  `ces` decimal(22,2) NOT NULL,
  `cea` decimal(22,2) NOT NULL,
  `after_taxes` decimal(22,2) NOT NULL,
  `wacc` decimal(22,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indebtedness_capacities_simulation_id_foreign` (`simulation_id`),
  KEY `indebtedness_capacities_offers_id_foreign` (`offers_id`),
  CONSTRAINT `indebtedness_capacities_offers_id_foreign` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `indebtedness_capacities_simulation_id_foreign` FOREIGN KEY (`simulation_id`) REFERENCES `simulations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indebtedness_capacities`
--

LOCK TABLES `indebtedness_capacities` WRITE;
/*!40000 ALTER TABLE `indebtedness_capacities` DISABLE KEYS */;
INSERT INTO `indebtedness_capacities` VALUES (1,1,1,-144814090.02,-140600000.00,127500000.00,-164814090.02,8.76,NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(2,1,2,-92906465.79,-111000000.00,198333333.33,-131000000.00,10.62,NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(3,1,3,-196808510.64,-99900000.00,157857142.86,-216808510.64,11.28,NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(4,1,4,-90797546.01,-151700000.00,103888888.89,-171700000.00,9.78,NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(5,2,1,1722113502.94,1672000000.00,900000000.00,890000000.00,8.76,15.67,'2019-01-14 05:56:32','2019-01-14 05:57:04'),(6,2,2,1104833647.21,1320000000.00,1400000000.00,1094833647.21,10.62,15.70,'2019-01-14 05:56:32','2019-01-14 05:57:04'),(7,2,3,2340425531.91,1188000000.00,1114285714.29,1104285714.29,11.28,15.71,'2019-01-14 05:56:32','2019-01-14 05:57:04'),(8,2,4,1079754601.23,1804000000.00,733333333.33,723333333.33,9.78,15.69,'2019-01-14 05:56:32','2019-01-14 05:57:04'),(9,3,1,109589041.10,106400000.00,135000000.00,80400000.00,8.76,12.01,'2019-01-14 06:32:23','2019-01-14 06:33:10'),(10,3,2,70307595.73,84000000.00,210000000.00,44307595.73,10.62,12.42,'2019-01-14 06:32:23','2019-01-14 06:33:10'),(11,3,3,148936170.21,75600000.00,167142857.14,49600000.00,11.28,12.57,'2019-01-14 06:32:23','2019-01-14 06:33:10'),(12,3,4,68711656.44,114800000.00,110000000.00,42711656.44,9.78,12.24,'2019-01-14 06:32:23','2019-01-14 06:33:10');
/*!40000 ALTER TABLE `indebtedness_capacities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `offer_id` int(10) unsigned NOT NULL,
  `sector_id` int(10) unsigned NOT NULL,
  `noventa` decimal(22,2) NOT NULL,
  `ciento_ochenta` decimal(22,2) NOT NULL,
  `un_ano` decimal(22,2) NOT NULL,
  `dos_anos` decimal(22,2) NOT NULL,
  `mas_dos_anos` decimal(22,2) NOT NULL,
  `average` decimal(22,2) NOT NULL,
  `state` enum('Si','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interests_sector_id_foreign` (`sector_id`),
  KEY `interests_offer_id_foreign` (`offer_id`),
  CONSTRAINT `interests_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `interests_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interests`
--

LOCK TABLES `interests` WRITE;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
INSERT INTO `interests` VALUES (1,1,1,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,1,2,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,1,3,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,1,4,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,1,5,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,1,6,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(7,1,7,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(8,1,8,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(9,1,9,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(10,1,10,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(11,1,11,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(12,1,12,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(13,1,13,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(14,1,14,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(15,1,15,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(16,1,16,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(17,1,17,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(18,1,18,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(19,1,19,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(20,1,20,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(21,1,21,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(22,1,22,16.30,15.60,13.00,13.20,13.60,14.60,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(23,2,1,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(24,2,2,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(25,2,3,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(26,2,4,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(27,2,5,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(28,2,6,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(29,2,7,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(30,2,8,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(31,2,9,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(32,2,10,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(33,2,11,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(34,2,12,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(35,2,13,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(36,2,14,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(37,2,15,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(38,2,16,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(39,2,17,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(40,2,18,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(41,2,19,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(42,2,20,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(43,2,21,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(44,2,22,14.00,14.30,13.10,15.70,15.80,17.70,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(45,3,1,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(46,3,2,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(47,3,3,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(48,3,4,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(49,3,5,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(50,3,6,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(51,3,7,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(52,3,8,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(53,3,9,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(54,3,10,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(55,3,11,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(56,3,12,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(57,3,13,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(58,3,14,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(59,3,15,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(60,3,16,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(61,3,17,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(62,3,18,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(63,3,19,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(64,3,20,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(65,3,21,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(66,3,22,13.70,14.50,13.70,15.30,15.80,18.80,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(67,4,1,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(68,4,2,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(69,4,3,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(70,4,4,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(71,4,5,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(72,4,6,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(73,4,7,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(74,4,8,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(75,4,9,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(76,4,10,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(77,4,11,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(78,4,12,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(79,4,13,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(80,4,14,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(81,4,15,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(82,4,16,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(83,4,17,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(84,4,18,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(85,4,19,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(86,4,20,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(87,4,21,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37'),(88,4,22,14.50,13.60,15.70,14.30,15.80,16.30,'No','2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=339 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (223,'2018_03_21_170403_create_clients_table',1),(324,'2014_10_12_000000_create_users_table',2),(325,'2014_10_12_100000_create_password_resets_table',2),(326,'2018_03_20_230229_create_sectors_table',2),(327,'2018_03_21_170403_create_simulations_table',2),(328,'2018_04_03_172236_create_offers_table',2),(329,'2018_05_02_164420_create_indebtedness_capacities_table',2),(330,'2018_05_03_200057_create_demands_table',2),(331,'2018_05_08_194855_create_simulation_demands_table',2),(332,'2018_05_15_160527_create_applications_table',2),(333,'2018_06_25_150002_create_roles_table',2),(334,'2018_06_25_150121_create_role_users_table',2),(335,'2018_07_03_185548_create_interests_table',2),(336,'2018_07_04_153015_create_heritage_costs_table',2),(337,'2018_07_05_161952_create_average_interests_table',2),(338,'2018_09_21_161639_create_offers_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `nit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_functionary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ebitda_interes` double(22,2) NOT NULL,
  `of_ebitda` double(22,2) NOT NULL,
  `of_financiacion` double(22,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offers_user_id_foreign` (`user_id`),
  CONSTRAINT `offers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES (1,1,'1111','Bancolombia',NULL,1.75,3.80,60.00,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,2,'2222','Davivienda',NULL,2.25,3.00,70.00,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,3,'3333','BBVA',NULL,1.00,2.70,65.00,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,4,'4444','Banco de Bogotá',NULL,2.50,4.10,55.00,'2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers_users`
--

DROP TABLE IF EXISTS `offers_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offers_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offers_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `offers_users_user_id_unique` (`user_id`),
  KEY `offers_users_offers_id_foreign` (`offers_id`),
  CONSTRAINT `offers_users_offers_id_foreign` FOREIGN KEY (`offers_id`) REFERENCES `offers` (`id`),
  CONSTRAINT `offers_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers_users`
--

LOCK TABLES `offers_users` WRITE;
/*!40000 ALTER TABLE `offers_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `offers_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_users_user_id_unique` (`user_id`),
  KEY `role_users_role_id_foreign` (`role_id`),
  CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` VALUES (1,2,1,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,2,2,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,2,3,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,2,4,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,1,5,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,3,6,'2019-01-14 05:56:37','2019-01-14 05:56:37'),(7,3,7,'2019-01-14 06:32:30','2019-01-14 06:32:30');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,'Oferta','2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,'Demanda','2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,'Usuario_oferta','2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sectors`
--

DROP TABLE IF EXISTS `sectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sectors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beta_desapalancado` decimal(22,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sectors`
--

LOCK TABLES `sectors` WRITE;
/*!40000 ALTER TABLE `sectors` DISABLE KEYS */;
INSERT INTO `sectors` VALUES (1,'Agricultura, ganadería, caza, silvicultura y pesca',0.86,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,'Explotación de minas y canteras',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,'Industrias manufactureras',1.10,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,'Suministro de electricidad, gas, vapor y aire acondicionado',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,'Distribución de agua; evacuación y tratamiento de aguas residuales, gestión de desechos y actividades',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,'Construcción',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(7,'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(8,'Transporte y almacenamiento',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(9,'Alojamiento y servicios de comida',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(10,'Información y comunicaciones',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(11,'Actividades financieras y de seguros',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(12,'Actividades inmobiliarias',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(13,'Actividades profesionales, científicas y técnicas',0.91,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(14,'Actividades de servicios administrativos y de apoyo',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(15,'Administración pública y defensa planes de seguridad social de afiliación obligatoria',0.35,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(16,'Educación',0.90,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(17,'Actividades de atención de la salud humana y de asistencia social',0.70,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(18,'Actividades artísticas, de entretenimiento y recreación',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(19,'Otras actividades de servicios',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(20,'Actividades de los hogares en calidad de empleadores; actividades no diferenciadas de los hogares individuales como productores de bienes y servicios para uso propio',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(21,'Actividades de organizaciones y entidades extraterritoriales',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(22,'Otras actividades no incluidas en el listado',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `sectors` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simulation_demands`
--

LOCK TABLES `simulation_demands` WRITE;
/*!40000 ALTER TABLE `simulation_demands` DISABLE KEYS */;
INSERT INTO `simulation_demands` VALUES (1,2,1,60000000.00,272000000.00,1.64,44.59,1104285714.29,15.79,'2019-01-14 05:57:04','2019-01-14 05:57:04'),(2,3,2,40000000.00,30800000.00,22.41,26.55,80400000.00,12.95,'2019-01-14 06:33:10','2019-01-14 06:33:10');
/*!40000 ALTER TABLE `simulation_demands` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simulations`
--

LOCK TABLES `simulations` WRITE;
/*!40000 ALTER TABLE `simulations` DISABLE KEYS */;
INSERT INTO `simulations` VALUES (1,12,'2017',55000000.00,38000000.00,70000000.00,10000000.00,6000000.00,20000000.00,85000000.00,-37000000.00,'urbinafoto@gmail.com',NULL,'2019-01-14 04:47:39','2019-01-14 04:47:39'),(2,1,'2017',500000000.00,60000000.00,50000000.00,20000000.00,30000000.00,10000000.00,600000000.00,440000000.00,'geral201014@hotmail.com',NULL,'2019-01-14 05:56:32','2019-01-14 05:56:32'),(3,15,'2017',70000000.00,40000000.00,45000000.00,35000000.00,8000000.00,26000000.00,90000000.00,28000000.00,'juansebastianur@hotmail.com',NULL,'2019-01-14 06:32:23','2019-01-14 06:32:23');
/*!40000 ALTER TABLE `simulations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'banco@banco.com','$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',NULL,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,'banco2@banco.com','$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',NULL,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,'banco3@banco.com','$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',NULL,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,'banco4@banco.com','$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda',NULL,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,'admin@admin.com','$2y$10$YmeZCujf6kz3Po1NZ9trfeqRYB71QCNtTB7xjfeL4ZY.3/9WWaNda','YJwfgLY2g9Rslnwq8JKLRzfjwuyDRrZy2Mi6BuTLVzjmICwVONMi0sdNwEjr','2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,'geral201014@hotmail.com','$2y$10$ukR7/0bHlXXLuBJPVjqLkulHeOPoogQNIROcdMR5m/SKsbe/tvzI2','wCSps6W63iO9UhtzOh2WbTyzDCbXBinNS7jPgOZluabrca5zNtlCxQgcwDBQ','2019-01-14 05:56:37','2019-01-23 06:17:04'),(7,'juansebastianur@hotmail.com','$2y$10$2b40JR8dOzeKyEpAyVEb5Ot832sdH7VsJsDQZL6z2ATv1hPcjHIM2','mXN1wnJFsPFvs2bSC5LAPMQw9vcz7tPbJ5v65bA8HyEGkXU7M21F0uAfeFbp','2019-01-14 06:32:30','2019-01-21 20:37:17');
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

-- Dump completed on 2019-02-14 15:37:17
