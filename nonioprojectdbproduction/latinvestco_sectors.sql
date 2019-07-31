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
INSERT INTO `sectors` VALUES (1,'Agricultura, ganadería, caza, silvicultura y pesca',5.00,'2019-01-12 01:49:37','2019-03-28 01:38:50'),(2,'Explotación de minas y canteras',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(3,'Industrias manufactureras',1.10,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(4,'Suministro de electricidad, gas, vapor y aire acondicionado',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(5,'Distribución de agua; evacuación y tratamiento de aguas residuales, gestión de desechos y actividades',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(6,'Construcción',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(7,'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(8,'Transporte y almacenamiento',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(9,'Alojamiento y servicios de comida',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(10,'Información y comunicaciones',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(11,'Actividades financieras y de seguros',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(12,'Actividades inmobiliarias',5.00,'2019-01-12 01:49:37','2019-03-28 01:59:36'),(13,'Actividades profesionales, científicas y técnicas',0.91,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(14,'Actividades de servicios administrativos y de apoyo',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(15,'Administración pública y defensa planes de seguridad social de afiliación obligatoria',0.35,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(16,'Educación',0.90,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(17,'Actividades de atención de la salud humana y de asistencia social',0.70,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(18,'Actividades artísticas, de entretenimiento y recreación',2.00,'2019-01-12 01:49:37','2019-03-28 01:10:56'),(19,'Otras actividades de servicios',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(20,'Actividades de los hogares en calidad de empleadores; actividades no diferenciadas de los hogares individuales como productores de bienes y servicios para uso propio',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(21,'Actividades de organizaciones y entidades extraterritoriales',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37'),(22,'Otras actividades no incluidas en el listado',0.38,'2019-01-12 01:49:37','2019-01-12 01:49:37');
/*!40000 ALTER TABLE `sectors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-31 16:36:11
