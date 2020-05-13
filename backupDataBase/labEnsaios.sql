-- MySQL dump 10.17  Distrib 10.3.15-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database: labEnsaios
-- ------------------------------------------------------
-- Server version	10.3.15-MariaDB-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alertas`
--

DROP TABLE IF EXISTS `alertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alertas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_ambiente` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `avisoTemp` tinyint(1) DEFAULT NULL,
  `avisoUmid` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alertas_id_ambiente_foreign` (`id_ambiente`),
  KEY `alertas_id_user_foreign` (`id_user`),
  CONSTRAINT `alertas_id_ambiente_foreign` FOREIGN KEY (`id_ambiente`) REFERENCES `ambientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alertas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alertas`
--

LOCK TABLES `alertas` WRITE;
/*!40000 ALTER TABLE `alertas` DISABLE KEYS */;
INSERT INTO `alertas` VALUES (1,1,1,NULL,NULL,'2019-09-08 21:49:27','2019-09-08 21:49:27'),(2,2,1,NULL,NULL,'2019-09-08 21:49:36','2019-09-08 21:49:36'),(3,3,1,NULL,NULL,'2019-09-08 21:50:03','2019-09-08 21:50:03');
/*!40000 ALTER TABLE `alertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ambientes`
--

DROP TABLE IF EXISTS `ambientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ambientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusUmid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spTemp` double(8,2) NOT NULL,
  `minTemp` double(8,2) DEFAULT NULL,
  `maxTemp` double(8,2) DEFAULT NULL,
  `minUmid` double(8,2) DEFAULT NULL,
  `maxUmid` double(8,2) DEFAULT NULL,
  `spUmid` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambientes`
--

LOCK TABLES `ambientes` WRITE;
/*!40000 ALTER TABLE `ambientes` DISABLE KEYS */;
INSERT INTO `ambientes` VALUES (1,'sala1','Sala Auxiliar 1','manual','manual',25.60,20.00,28.00,30.00,80.00,65.00,NULL,NULL),(2,'sala2','Sala Auxiliar 2','automatico','automatico',27.00,20.00,35.00,20.00,100.00,60.00,NULL,'2019-09-08 23:00:35'),(3,'Laboratório','Laboratório de Ensaios','automatico','manual',23.00,20.00,30.00,30.00,80.00,70.00,NULL,'2019-09-08 22:15:04'),(4,'Exterior','Exterior','manual','manual',0.00,0.00,0.00,0.00,0.00,0.00,NULL,NULL);
/*!40000 ALTER TABLE `ambientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ensaios`
--

DROP TABLE IF EXISTS `ensaios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ensaios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataI` datetime NOT NULL,
  `dataF` datetime NOT NULL,
  `id_ambiente` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `data` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ensaios_id_ambiente_foreign` (`id_ambiente`),
  KEY `ensaios_id_user_foreign` (`id_user`),
  CONSTRAINT `ensaios_id_ambiente_foreign` FOREIGN KEY (`id_ambiente`) REFERENCES `ambientes` (`id`),
  CONSTRAINT `ensaios_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ensaios`
--

LOCK TABLES `ensaios` WRITE;
/*!40000 ALTER TABLE `ensaios` DISABLE KEYS */;
/*!40000 ALTER TABLE `ensaios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exteriors`
--

DROP TABLE IF EXISTS `exteriors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exteriors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `umid` double(8,2) NOT NULL,
  `temp` double(8,2) NOT NULL,
  `energia` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exteriors`
--

LOCK TABLES `exteriors` WRITE;
/*!40000 ALTER TABLE `exteriors` DISABLE KEYS */;
INSERT INTO `exteriors` VALUES (1,95.00,31.34,NULL,'2019-09-08 21:47:32',NULL),(2,95.00,31.39,NULL,'2019-09-08 21:48:33',NULL),(3,95.00,31.35,NULL,'2019-09-08 21:49:33',NULL),(4,95.00,31.33,NULL,'2019-09-08 21:50:33',NULL),(5,95.00,31.39,NULL,'2019-09-08 21:51:34',NULL),(6,95.00,31.36,NULL,'2019-09-08 21:52:34',NULL),(7,95.00,31.39,NULL,'2019-09-08 21:53:35',NULL),(8,95.00,31.39,NULL,'2019-09-08 21:54:35',NULL),(9,95.00,31.39,NULL,'2019-09-08 21:55:36',NULL),(10,95.00,31.51,NULL,'2019-09-08 21:56:36',NULL),(11,95.00,31.39,NULL,'2019-09-08 21:57:36',NULL),(12,95.00,31.35,NULL,'2019-09-08 21:58:37',NULL),(13,95.00,31.37,NULL,'2019-09-08 21:59:37',NULL),(14,95.00,31.42,NULL,'2019-09-08 22:00:37',NULL),(15,95.00,31.40,NULL,'2019-09-08 22:01:38',NULL),(16,95.00,31.39,NULL,'2019-09-08 22:02:38',NULL),(17,95.00,31.39,NULL,'2019-09-08 22:03:39',NULL),(18,95.00,31.39,NULL,'2019-09-08 22:04:39',NULL),(19,95.00,31.34,NULL,'2019-09-08 22:05:40',NULL),(20,95.00,31.42,NULL,'2019-09-08 22:06:40',NULL),(21,95.00,31.49,NULL,'2019-09-08 22:07:40',NULL),(22,95.00,31.36,NULL,'2019-09-08 22:08:41',NULL),(23,95.00,31.49,NULL,'2019-09-08 22:09:41',NULL),(24,95.00,31.24,NULL,'2019-09-08 22:10:41',NULL),(25,95.00,31.39,NULL,'2019-09-08 22:11:42',NULL),(26,95.00,31.39,NULL,'2019-09-08 22:12:42',NULL),(27,95.00,31.36,NULL,'2019-09-08 22:13:43',NULL),(28,95.00,31.42,NULL,'2019-09-08 22:14:43',NULL),(29,95.00,31.36,NULL,'2019-09-08 22:15:43',NULL),(30,95.00,31.45,NULL,'2019-09-08 22:16:44',NULL),(31,95.00,31.39,NULL,'2019-09-08 22:17:44',NULL),(32,95.00,31.38,NULL,'2019-09-08 22:18:45',NULL),(33,95.00,31.42,NULL,'2019-09-08 22:19:45',NULL),(34,95.00,31.26,NULL,'2019-09-08 22:20:45',NULL),(35,95.00,31.67,NULL,'2019-09-08 22:21:46',NULL),(36,95.00,31.67,NULL,'2019-09-08 22:22:46',NULL),(37,95.00,31.75,NULL,'2019-09-08 22:23:47',NULL),(38,95.00,31.75,NULL,'2019-09-08 22:24:47',NULL),(39,95.00,31.82,NULL,'2019-09-08 22:25:48',NULL),(40,95.00,31.75,NULL,'2019-09-08 22:26:48',NULL),(41,95.00,31.75,NULL,'2019-09-08 22:27:48',NULL),(42,95.00,31.75,NULL,'2019-09-08 22:28:49',NULL),(43,95.00,31.82,NULL,'2019-09-08 22:29:49',NULL),(44,95.00,31.78,NULL,'2019-09-08 22:30:50',NULL),(45,95.00,31.79,NULL,'2019-09-08 22:31:50',NULL),(46,95.00,31.75,NULL,'2019-09-08 22:32:50',NULL),(47,95.00,31.79,NULL,'2019-09-08 22:33:51',NULL),(48,95.00,31.82,NULL,'2019-09-08 22:34:51',NULL),(49,95.00,31.85,NULL,'2019-09-08 22:35:52',NULL),(50,95.00,31.79,NULL,'2019-09-08 22:36:52',NULL),(51,95.00,31.79,NULL,'2019-09-08 22:37:52',NULL),(52,95.00,31.75,NULL,'2019-09-08 22:38:53',NULL),(53,95.00,31.79,NULL,'2019-09-08 22:39:53',NULL),(54,95.00,31.79,NULL,'2019-09-08 22:40:53',NULL),(55,95.00,31.79,NULL,'2019-09-08 22:41:54',NULL),(56,95.00,31.82,NULL,'2019-09-08 22:42:54',NULL),(57,95.00,31.79,NULL,'2019-09-08 22:43:55',NULL),(58,95.00,31.82,NULL,'2019-09-08 22:44:55',NULL),(59,95.00,31.92,NULL,'2019-09-08 22:45:55',NULL),(60,95.00,31.82,NULL,'2019-09-08 22:46:56',NULL),(61,95.00,31.75,NULL,'2019-09-08 22:47:56',NULL),(62,95.00,31.85,NULL,'2019-09-08 22:48:57',NULL),(63,95.00,31.79,NULL,'2019-09-08 22:49:57',NULL),(64,95.00,31.79,NULL,'2019-09-08 22:50:57',NULL),(65,95.00,31.82,NULL,'2019-09-08 22:51:58',NULL),(66,95.00,31.82,NULL,'2019-09-08 22:52:58',NULL),(67,95.00,31.82,NULL,'2019-09-08 22:53:58',NULL),(68,95.00,31.82,NULL,'2019-09-08 22:54:59',NULL),(69,95.00,31.82,NULL,'2019-09-08 22:55:59',NULL),(70,95.00,30.89,NULL,'2019-09-08 22:57:00',NULL),(71,95.00,31.08,NULL,'2019-09-08 22:58:00',NULL),(72,95.00,31.13,NULL,'2019-09-08 22:59:00',NULL),(73,91.00,31.31,NULL,'2019-09-08 23:00:04',NULL),(74,91.00,31.36,NULL,'2019-09-08 23:01:05',NULL),(75,91.00,31.42,NULL,'2019-09-08 23:02:05',NULL),(76,91.00,31.42,NULL,'2019-09-08 23:03:06',NULL),(77,91.00,31.39,NULL,'2019-09-08 23:04:06',NULL);
/*!40000 ALTER TABLE `exteriors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `spTemp` double(8,2) NOT NULL,
  `spUmid` double(8,2) NOT NULL,
  `umid` double(8,2) NOT NULL,
  `temp` double(8,2) NOT NULL,
  `eUmid` double(8,2) NOT NULL,
  `eTemp` double(8,2) NOT NULL,
  `maxTemp` double(8,2) DEFAULT NULL,
  `minTemp` double(8,2) DEFAULT NULL,
  `maxUmid` double(8,2) DEFAULT NULL,
  `minUmid` double(8,2) DEFAULT NULL,
  `energia` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorios`
--

LOCK TABLES `laboratorios` WRITE;
/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` VALUES (1,23.00,70.00,92.80,29.89,22.80,6.89,25.00,20.00,80.00,60.00,NULL,'2019-09-08 21:47:32',NULL),(2,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,60.00,NULL,'2019-09-08 21:48:33',NULL),(3,23.00,70.00,92.80,29.90,22.80,6.90,25.00,20.00,80.00,60.00,NULL,'2019-09-08 21:49:33',NULL),(4,23.00,70.00,92.80,29.88,22.80,6.88,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:50:33',NULL),(5,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:51:34',NULL),(6,23.00,70.00,92.80,29.91,22.80,6.91,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:52:34',NULL),(7,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:53:35',NULL),(8,23.00,70.00,92.80,29.93,22.80,6.93,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:54:35',NULL),(9,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:55:36',NULL),(10,23.00,70.00,92.80,30.05,22.80,7.05,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:56:36',NULL),(11,23.00,70.00,92.80,29.93,22.80,6.93,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:57:36',NULL),(12,23.00,70.00,92.80,29.90,22.80,6.90,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:58:37',NULL),(13,23.00,70.00,92.80,29.92,22.80,6.92,25.00,20.00,80.00,30.00,NULL,'2019-09-08 21:59:37',NULL),(14,23.00,70.00,92.80,29.97,22.80,6.97,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:00:37',NULL),(15,23.00,70.00,92.80,29.95,22.80,6.95,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:01:38',NULL),(16,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:02:38',NULL),(17,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:03:39',NULL),(18,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:04:39',NULL),(19,23.00,70.00,92.80,29.89,22.80,6.89,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:05:40',NULL),(20,23.00,70.00,92.80,29.96,22.80,6.96,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:06:40',NULL),(21,23.00,70.00,92.80,30.03,22.80,7.03,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:07:40',NULL),(22,23.00,70.00,92.80,29.91,22.80,6.91,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:08:41',NULL),(23,23.00,70.00,92.80,30.03,22.80,7.03,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:09:41',NULL),(24,23.00,70.00,92.80,29.79,22.80,6.79,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:10:41',NULL),(25,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:11:42',NULL),(26,23.00,70.00,92.80,29.94,22.80,6.94,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:12:42',NULL),(27,23.00,70.00,92.80,29.91,22.80,6.91,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:13:43',NULL),(28,23.00,70.00,92.80,29.97,22.80,6.97,25.00,20.00,80.00,30.00,NULL,'2019-09-08 22:14:43',NULL),(29,23.00,70.00,92.80,29.91,22.80,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:15:43',NULL),(30,23.00,70.00,92.80,30.00,22.80,7.00,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:16:44',NULL),(31,23.00,70.00,92.80,29.94,22.80,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:17:44',NULL),(32,23.00,70.00,92.80,29.93,22.80,6.93,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:18:45',NULL),(33,23.00,70.00,92.80,29.97,22.80,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:19:45',NULL),(34,23.00,70.00,92.80,29.82,22.80,6.82,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:20:45',NULL),(35,23.00,70.00,92.70,29.83,22.70,6.83,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:21:46',NULL),(36,23.00,70.00,92.70,29.83,22.70,6.83,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:22:46',NULL),(37,23.00,70.00,92.70,29.90,22.70,6.90,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:23:47',NULL),(38,23.00,70.00,92.70,29.90,22.70,6.90,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:24:47',NULL),(39,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:25:48',NULL),(40,23.00,70.00,92.70,29.91,22.70,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:26:48',NULL),(41,23.00,70.00,92.70,29.91,22.70,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:27:48',NULL),(42,23.00,70.00,92.70,29.90,22.70,6.90,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:28:49',NULL),(43,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:29:49',NULL),(44,23.00,70.00,92.70,29.93,22.70,6.93,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:30:50',NULL),(45,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:31:50',NULL),(46,23.00,70.00,92.70,29.91,22.70,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:32:50',NULL),(47,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:33:51',NULL),(48,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:34:51',NULL),(49,23.00,70.00,92.70,30.00,22.70,7.00,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:35:52',NULL),(50,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:36:52',NULL),(51,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:37:52',NULL),(52,23.00,70.00,92.70,29.91,22.70,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:38:53',NULL),(53,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:39:53',NULL),(54,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:40:53',NULL),(55,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:41:54',NULL),(56,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:42:54',NULL),(57,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:43:55',NULL),(58,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:44:55',NULL),(59,23.00,70.00,92.70,30.06,22.70,7.06,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:45:55',NULL),(60,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:46:56',NULL),(61,23.00,70.00,92.70,29.91,22.70,6.91,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:47:56',NULL),(62,23.00,70.00,92.70,29.99,22.70,6.99,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:48:57',NULL),(63,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:49:57',NULL),(64,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:50:57',NULL),(65,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:51:58',NULL),(66,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:52:58',NULL),(67,23.00,70.00,92.70,29.96,22.70,6.96,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:53:58',NULL),(68,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:54:59',NULL),(69,23.00,70.00,92.70,29.97,22.70,6.97,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:55:59',NULL),(70,23.00,70.00,92.70,29.71,22.70,6.71,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:57:00',NULL),(71,23.00,70.00,92.70,29.89,22.70,6.89,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:58:00',NULL),(72,23.00,70.00,92.70,29.94,22.70,6.94,30.00,20.00,80.00,30.00,NULL,'2019-09-08 22:59:00',NULL),(73,23.00,70.00,91.30,29.76,21.30,6.76,30.00,20.00,80.00,30.00,NULL,'2019-09-08 23:00:04',NULL),(74,23.00,70.00,91.30,29.80,21.30,6.80,30.00,20.00,80.00,30.00,NULL,'2019-09-08 23:01:05',NULL),(75,23.00,70.00,91.30,29.86,21.30,6.86,30.00,20.00,80.00,30.00,NULL,'2019-09-08 23:02:05',NULL),(76,23.00,70.00,91.30,29.86,21.30,6.86,30.00,20.00,80.00,30.00,NULL,'2019-09-08 23:03:06',NULL),(77,23.00,70.00,91.30,29.83,21.30,6.83,30.00,20.00,80.00,30.00,NULL,'2019-09-08 23:04:06',NULL);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (66,'2014_10_12_000000_create_users_table',1),(67,'2014_10_12_100000_create_password_resets_table',1),(68,'2019_07_04_191249_create_ambientes_table',1),(69,'2019_07_04_191323_create_sala1s_table',1),(70,'2019_07_04_191452_create_sala2s_table',1),(71,'2019_07_04_191556_create_exteriors_table',1),(72,'2019_07_04_192501_create_laboratorios_table',1),(73,'2019_07_04_192502_create_ensaios_table',1),(74,'2019_09_04_201908_create_alertas_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `sala1s`
--

DROP TABLE IF EXISTS `sala1s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala1s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `spTemp` double(8,2) NOT NULL,
  `spUmid` double(8,2) NOT NULL,
  `umid` double(8,2) NOT NULL,
  `temp` double(8,2) NOT NULL,
  `eUmid` double(8,2) NOT NULL,
  `eTemp` double(8,2) NOT NULL,
  `maxTemp` double(8,2) DEFAULT NULL,
  `minTemp` double(8,2) DEFAULT NULL,
  `maxUmid` double(8,2) DEFAULT NULL,
  `minUmid` double(8,2) DEFAULT NULL,
  `energia` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala1s`
--

LOCK TABLES `sala1s` WRITE;
/*!40000 ALTER TABLE `sala1s` DISABLE KEYS */;
INSERT INTO `sala1s` VALUES (1,25.60,65.00,94.00,21.16,29.00,-4.44,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:47:32',NULL),(2,25.60,65.00,94.00,21.15,29.00,-4.45,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:48:33',NULL),(3,25.60,65.00,94.00,21.15,29.00,-4.45,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:49:33',NULL),(4,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:50:33',NULL),(5,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:51:34',NULL),(6,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:52:34',NULL),(7,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:53:35',NULL),(8,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:54:35',NULL),(9,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:55:36',NULL),(10,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:56:36',NULL),(11,25.60,65.00,94.00,21.26,29.00,-4.34,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:57:36',NULL),(12,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:58:37',NULL),(13,25.60,65.00,94.00,21.29,29.00,-4.31,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:59:37',NULL),(14,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:00:37',NULL),(15,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:01:38',NULL),(16,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:02:38',NULL),(17,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:03:39',NULL),(18,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:04:39',NULL),(19,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:05:40',NULL),(20,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:06:40',NULL),(21,25.60,65.00,94.00,21.23,29.00,-4.37,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:07:40',NULL),(22,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:08:41',NULL),(23,25.60,65.00,94.00,21.23,29.00,-4.37,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:09:41',NULL),(24,25.60,65.00,94.00,21.29,29.00,-4.31,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:10:41',NULL),(25,25.60,65.00,94.00,21.26,29.00,-4.34,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:11:42',NULL),(26,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:12:42',NULL),(27,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:13:43',NULL),(28,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:14:43',NULL),(29,25.60,65.00,94.00,21.16,29.00,-4.44,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:15:43',NULL),(30,25.60,65.00,94.00,21.15,29.00,-4.45,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:16:44',NULL),(31,25.60,65.00,94.00,21.18,29.00,-4.42,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:17:44',NULL),(32,25.60,65.00,94.00,21.19,29.00,-4.41,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:18:45',NULL),(33,25.60,65.00,94.00,21.18,29.00,-4.42,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:19:45',NULL),(34,25.60,65.00,94.00,21.22,29.00,-4.38,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:20:45',NULL),(35,25.60,65.00,94.00,21.36,29.00,-4.24,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:21:46',NULL),(36,25.60,65.00,94.00,21.32,29.00,-4.28,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:22:46',NULL),(37,25.60,65.00,94.00,21.31,29.00,-4.29,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:23:47',NULL),(38,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:24:47',NULL),(39,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:25:48',NULL),(40,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:26:48',NULL),(41,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:27:48',NULL),(42,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:28:49',NULL),(43,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:29:49',NULL),(44,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:30:50',NULL),(45,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:31:50',NULL),(46,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:32:50',NULL),(47,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:33:51',NULL),(48,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:34:51',NULL),(49,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:35:52',NULL),(50,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:36:52',NULL),(51,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:37:52',NULL),(52,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:38:53',NULL),(53,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:39:53',NULL),(54,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:40:53',NULL),(55,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:41:54',NULL),(56,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:42:54',NULL),(57,25.60,65.00,94.00,21.40,29.00,-4.20,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:43:55',NULL),(58,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:44:55',NULL),(59,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:45:55',NULL),(60,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:46:56',NULL),(61,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:47:56',NULL),(62,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:48:57',NULL),(63,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:49:57',NULL),(64,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:50:57',NULL),(65,25.60,65.00,94.00,21.33,29.00,-4.27,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:51:58',NULL),(66,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:52:58',NULL),(67,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:53:58',NULL),(68,25.60,65.00,94.00,21.34,29.00,-4.26,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:54:59',NULL),(69,25.60,65.00,94.00,21.37,29.00,-4.23,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:55:59',NULL),(70,25.60,65.00,94.00,21.17,29.00,-4.43,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:57:00',NULL),(71,25.60,65.00,94.00,21.17,29.00,-4.43,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:58:00',NULL),(72,25.60,65.00,94.00,21.15,29.00,-4.45,28.00,20.00,80.00,30.00,NULL,'2019-09-08 22:59:00',NULL),(73,25.60,65.00,89.00,21.36,24.00,-4.24,28.00,20.00,80.00,30.00,NULL,'2019-09-08 23:00:04',NULL),(74,25.60,65.00,89.00,21.38,24.00,-4.22,28.00,20.00,80.00,30.00,NULL,'2019-09-08 23:01:05',NULL),(75,25.60,65.00,89.00,21.38,24.00,-4.22,28.00,20.00,80.00,30.00,NULL,'2019-09-08 23:02:05',NULL),(76,25.60,65.00,89.00,21.38,24.00,-4.22,28.00,20.00,80.00,30.00,NULL,'2019-09-08 23:03:06',NULL),(77,25.60,65.00,89.00,21.35,24.00,-4.25,28.00,20.00,80.00,30.00,NULL,'2019-09-08 23:04:06',NULL);
/*!40000 ALTER TABLE `sala1s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala2s`
--

DROP TABLE IF EXISTS `sala2s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sala2s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `spTemp` double(8,2) NOT NULL,
  `spUmid` double(8,2) NOT NULL,
  `umid` double(8,2) NOT NULL,
  `temp` double(8,2) NOT NULL,
  `eUmid` double(8,2) NOT NULL,
  `eTemp` double(8,2) NOT NULL,
  `maxTemp` double(8,2) DEFAULT NULL,
  `minTemp` double(8,2) DEFAULT NULL,
  `maxUmid` double(8,2) DEFAULT NULL,
  `minUmid` double(8,2) DEFAULT NULL,
  `energia` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala2s`
--

LOCK TABLES `sala2s` WRITE;
/*!40000 ALTER TABLE `sala2s` DISABLE KEYS */;
INSERT INTO `sala2s` VALUES (1,24.00,60.00,95.00,28.43,35.00,4.43,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:47:32',NULL),(2,24.00,60.00,95.00,28.52,35.00,4.52,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:48:33',NULL),(3,24.00,60.00,95.00,28.49,35.00,4.49,28.00,20.00,80.00,30.00,NULL,'2019-09-08 21:49:33',NULL),(4,27.00,60.00,95.00,28.51,35.00,1.51,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:50:33',NULL),(5,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:51:34',NULL),(6,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:52:34',NULL),(7,27.00,60.00,95.00,28.49,35.00,1.49,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:53:35',NULL),(8,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:54:35',NULL),(9,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:55:36',NULL),(10,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:56:36',NULL),(11,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:57:36',NULL),(12,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:58:37',NULL),(13,27.00,60.00,95.00,28.40,35.00,1.40,35.00,20.00,80.00,30.00,NULL,'2019-09-08 21:59:37',NULL),(14,27.00,60.00,95.00,28.49,35.00,1.49,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:00:37',NULL),(15,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:01:38',NULL),(16,27.00,60.00,95.00,28.51,35.00,1.51,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:02:38',NULL),(17,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:03:39',NULL),(18,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:04:39',NULL),(19,27.00,60.00,95.00,28.36,35.00,1.36,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:05:40',NULL),(20,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:06:40',NULL),(21,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:07:40',NULL),(22,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:08:41',NULL),(23,27.00,60.00,95.00,28.61,35.00,1.61,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:09:41',NULL),(24,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:10:41',NULL),(25,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:11:42',NULL),(26,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:12:42',NULL),(27,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:13:43',NULL),(28,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:14:43',NULL),(29,27.00,60.00,95.00,28.55,35.00,1.55,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:15:43',NULL),(30,27.00,60.00,95.00,28.49,35.00,1.49,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:16:44',NULL),(31,27.00,60.00,95.00,28.52,35.00,1.52,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:17:44',NULL),(32,27.00,60.00,95.00,28.51,35.00,1.51,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:18:45',NULL),(33,27.00,60.00,95.00,28.51,35.00,1.51,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:19:45',NULL),(34,27.00,60.00,95.00,28.48,35.00,1.48,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:20:45',NULL),(35,27.00,60.00,95.00,28.62,35.00,1.62,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:21:46',NULL),(36,27.00,60.00,95.00,28.65,35.00,1.65,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:22:46',NULL),(37,27.00,60.00,95.00,28.70,35.00,1.70,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:23:47',NULL),(38,27.00,60.00,95.00,28.75,35.00,1.75,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:24:47',NULL),(39,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:25:48',NULL),(40,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:26:48',NULL),(41,27.00,60.00,95.00,28.75,35.00,1.75,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:27:48',NULL),(42,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:28:49',NULL),(43,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:29:49',NULL),(44,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:30:50',NULL),(45,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:31:50',NULL),(46,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:32:50',NULL),(47,27.00,60.00,95.00,28.78,35.00,1.78,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:33:51',NULL),(48,27.00,60.00,95.00,28.69,35.00,1.69,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:34:51',NULL),(49,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:35:52',NULL),(50,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:36:52',NULL),(51,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:37:52',NULL),(52,27.00,60.00,95.00,28.85,35.00,1.85,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:38:53',NULL),(53,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:39:53',NULL),(54,27.00,60.00,95.00,28.72,35.00,1.72,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:40:53',NULL),(55,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:41:54',NULL),(56,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:42:54',NULL),(57,27.00,60.00,95.00,28.72,35.00,1.72,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:43:55',NULL),(58,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:44:55',NULL),(59,27.00,60.00,95.00,28.75,35.00,1.75,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:45:55',NULL),(60,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:46:56',NULL),(61,27.00,60.00,95.00,28.79,35.00,1.79,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:47:56',NULL),(62,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:48:57',NULL),(63,27.00,60.00,95.00,28.70,35.00,1.70,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:49:57',NULL),(64,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:50:57',NULL),(65,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:51:58',NULL),(66,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:52:58',NULL),(67,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:53:58',NULL),(68,27.00,60.00,95.00,28.76,35.00,1.76,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:54:59',NULL),(69,27.00,60.00,95.00,28.73,35.00,1.73,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:55:59',NULL),(70,27.00,60.00,95.00,28.35,35.00,1.35,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:57:00',NULL),(71,27.00,60.00,95.00,28.32,35.00,1.32,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:58:00',NULL),(72,27.00,60.00,95.00,28.36,35.00,1.36,35.00,20.00,80.00,30.00,NULL,'2019-09-08 22:59:00',NULL),(73,27.00,60.00,90.00,28.25,30.00,1.25,35.00,20.00,80.00,30.00,NULL,'2019-09-08 23:00:04',NULL),(74,27.00,60.00,90.00,28.29,30.00,1.29,35.00,20.00,100.00,20.00,NULL,'2019-09-08 23:01:05',NULL),(75,27.00,60.00,90.00,28.33,30.00,1.33,35.00,20.00,100.00,20.00,NULL,'2019-09-08 23:02:05',NULL),(76,27.00,60.00,90.00,28.27,30.00,1.27,35.00,20.00,100.00,20.00,NULL,'2019-09-08 23:03:06',NULL),(77,27.00,60.00,90.00,28.24,30.00,1.24,35.00,20.00,100.00,20.00,NULL,'2019-09-08 23:04:06',NULL);
/*!40000 ALTER TABLE `sala2s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Érico Rosiski Weber','ericoweber@hotmail.com',NULL,'$2y$10$bXVysSrcVLI5WfA5S1xthe50tmtQzX3kBM/zNaU.zhCfDomsVoWz.',NULL,'2019-09-08 21:49:14','2019-09-08 21:49:14');
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

-- Dump completed on 2019-09-08 20:04:08
