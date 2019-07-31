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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'banco@banco.com','$2y$10$Wcrcm4WomcVeI/9UkBQpzupg4CLq1I.ukecMBIxBLw8SjkuorXXFG','HrYf2BkhTrYcVseyeBQFUwqdmUGkJGTK2eDVGd9nCUlwlFQJXN6sGftjvXKG','2019-01-12 01:49:37','2019-01-12 01:49:37'),(2,'banco2@banco.com','$2y$10$Wcrcm4WomcVeI/9UkBQpzupg4CLq1I.ukecMBIxBLw8SjkuorXXFG','Ldn2svIHohmCZ9d9c79RuTfhvOpNJJr9AiIY5ZpHuE9kDmddv7iy3YKEy622','2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,'banco3@banco.com','$2y$10$Wcrcm4WomcVeI/9UkBQpzupg4CLq1I.ukecMBIxBLw8SjkuorXXFG','LgAtthvyFvSEJZtfOOaevYbUn0tIsmbTg68l1wJhWf7vWplbwbZrwnrmcWs6','2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,'banco4@banco.com','$2y$10$Wcrcm4WomcVeI/9UkBQpzupg4CLq1I.ukecMBIxBLw8SjkuorXXFG','ZadHkmoT6h1BiPMMfyW8HaWW2kMrXwLaEXzMoKYsfGW5GFMvv0JN5fYqdlor','2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,'admin@admin.com','$2y$10$Wcrcm4WomcVeI/9UkBQpzupg4CLq1I.ukecMBIxBLw8SjkuorXXFG','DSLPVOyMcTC4pjMWqUtvfPGSM1yDo2LFFIvQ7JCKr91faPiJw0RffJkCf10P','2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,'geral201014@hotmail.com','$2y$10$ukR7/0bHlXXLuBJPVjqLkulHeOPoogQNIROcdMR5m/SKsbe/tvzI2','wCSps6W63iO9UhtzOh2WbTyzDCbXBinNS7jPgOZluabrca5zNtlCxQgcwDBQ','2019-01-14 05:56:37','2019-01-23 06:17:04'),(7,'juansebastianur@hotmail.com','$2y$10$2b40JR8dOzeKyEpAyVEb5Ot832sdH7VsJsDQZL6z2ATv1hPcjHIM2','RNQm6bBbGwYLyUSS2bRFedaoWzMVtlnUGxjQfrG8xWplc3FpmZnzc3x4QaLB','2019-01-14 06:32:30','2019-01-21 20:37:17'),(8,'danielareyna@latinvestco.com','$2y$10$.O24DXgJLoJYd23oZNcp.et4oQ5deasxE2IjC0T/qHddq9iPaO0l2','3sqNuGlgVOCNybvQglOX4aekxHyclA2HsBvEigYeA3inU1rMEyN03c9yIOYa','2019-03-28 01:07:43','2019-03-28 21:48:42'),(9,'nicolas.diaz@cesa.edu.co','$2y$10$N/2SeRgAKEIAusBOsYJA1.RtgSoqgwzMmFnMmkLd6quvnlZ5Zz/y.','k0GJC2usfEFfwWZ5r429pB6BGAk3pS1rLShMCj3zADmJjPT2QJ4mmjp0P5wt','2019-03-28 01:33:24','2019-03-28 01:33:24'),(10,'danielitar18@hotmail.com','$2y$10$lZFz0LGxed4EpAkWIUgX3eujwJkUfnFDc9krYrZSwuIb5Oz3MVOIa','CfcKdvCb7IwIC70MkNVIAIQCBJ3oZ6uljjdvwc6gxZTSw46wA3IXOn0B2inn','2019-03-28 21:55:57','2019-03-28 21:55:57'),(11,'jdcardenasd10@gmail.com','$2y$10$5wA1tf73af05PpYn363KN./VTmyDGBVJ3KvmrVvcCnjN4GY8MIaDG','0VSDpRUF00ljO7MkjLSGBUcunSDBfCkG0oAdJqykP49gS9FtsyAwEueYazDm','2019-05-21 20:58:57','2019-05-21 20:58:57'),(17,'testeo@it_tec.com','$2y$10$JIr5cBEgxRhyRoGi6IfagupnLQ39XLd/cPzo/o00ctaC4ifTXqncu',NULL,'2019-05-21 22:27:31','2019-05-21 22:27:31');
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

-- Dump completed on 2019-07-31 16:34:05
