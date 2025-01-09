-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: carebridge
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `application_steps`
--

DROP TABLE IF EXISTS `application_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caregiver_id` bigint(20) unsigned NOT NULL,
  `step_number` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_steps_caregiver_id_foreign` (`caregiver_id`),
  CONSTRAINT `application_steps_caregiver_id_foreign` FOREIGN KEY (`caregiver_id`) REFERENCES `caregivers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_steps`
--

LOCK TABLES `application_steps` WRITE;
/*!40000 ALTER TABLE `application_steps` DISABLE KEYS */;
INSERT INTO `application_steps` VALUES (4,7,2,'Submitted','2024-11-13 22:22:10','2024-11-13 22:22:10','2024-11-13 22:22:10'),(5,7,2,'Approved','2024-11-13 22:22:28','2024-11-13 22:22:28','2024-11-13 22:22:28'),(6,8,2,'Submitted','2024-11-18 00:13:36','2024-11-18 00:13:36','2024-11-18 00:13:36'),(7,8,2,'Approved','2024-11-18 00:13:59','2024-11-18 00:13:59','2024-11-18 00:13:59'),(8,9,2,'Submitted','2024-11-18 10:54:20','2024-11-18 10:54:20','2024-11-18 10:54:20'),(9,9,2,'Approved','2024-11-18 10:57:08','2024-11-18 10:57:08','2024-11-18 10:57:08'),(10,10,2,'Submitted','2024-11-18 11:10:56','2024-11-18 11:10:56','2024-11-18 11:10:56'),(11,10,2,'Approved','2024-11-18 11:12:44','2024-11-18 11:12:44','2024-11-18 11:12:44'),(12,11,2,'Submitted','2024-11-18 13:29:19','2024-11-18 13:29:19','2024-11-18 13:29:19'),(13,11,2,'Approved','2024-11-18 13:29:48','2024-11-18 13:29:48','2024-11-18 13:29:48'),(14,12,2,'Submitted','2024-11-18 20:46:22','2024-11-18 20:46:22','2024-11-18 20:46:22'),(15,12,2,'Pending','2024-11-29 09:50:50','2024-11-29 09:50:50','2024-11-29 09:50:50');
/*!40000 ALTER TABLE `application_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `elderly_id` bigint(20) unsigned NOT NULL,
  `caregiver_id` bigint(20) unsigned NOT NULL,
  `doctor_id` bigint(20) unsigned NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `status` enum('pending','confirmed','canceled','rescheduled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_elderly_id_foreign` (`elderly_id`),
  KEY `appointments_caregiver_id_foreign` (`caregiver_id`),
  KEY `appointments_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `appointments_caregiver_id_foreign` FOREIGN KEY (`caregiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `appointments_elderly_id_foreign` FOREIGN KEY (`elderly_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,69,70,2,'2025-01-07 11:20:00','pending',NULL,'2025-01-07 04:20:50','2025-01-07 04:20:50');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessments`
--

DROP TABLE IF EXISTS `assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessments`
--

LOCK TABLES `assessments` WRITE;
/*!40000 ALTER TABLE `assessments` DISABLE KEYS */;
INSERT INTO `assessments` VALUES (1,'แบบประเมินโรคซึมเศร้า (9Q)','แบบประเมินภาวะโรคซึมเศร้าด้วยคำถาม 9 ข้อ','2024-11-22 18:55:16','2024-11-22 18:55:16');
/*!40000 ALTER TABLE `assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caregivers`
--

DROP TABLE IF EXISTS `caregivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caregivers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `specialization` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `application_step` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caregivers_user_id_foreign` (`user_id`),
  CONSTRAINT `caregivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caregivers`
--

LOCK TABLES `caregivers` WRITE;
/*!40000 ALTER TABLE `caregivers` DISABLE KEYS */;
INSERT INTO `caregivers` VALUES (7,2,'ประสบการณ์',10.49560350,99.18476060,0.00,3,'Approved',4,'2024-11-13 22:22:10','2024-11-14 23:50:30'),(8,9,'กายภาพบำบัด',8.07075840,98.82501120,0.00,1,'Approved',4,'2024-11-18 00:13:36','2024-11-18 00:13:59'),(9,7,'สัตวแพทย์',13.75633090,100.50176510,0.00,50,'Approved',4,'2024-11-18 10:54:20','2024-11-18 11:19:04'),(10,10,'จักษุแพทย์ กระจกตาและผ่าตัดแก้ไข',10.49563880,99.18340860,0.00,25,'Approved',4,'2024-11-18 11:10:56','2024-11-18 11:12:44'),(11,12,'ดูแลผู้สูงอายุ',10.49568950,99.18469900,0.00,1,'Approved',4,'2024-11-18 13:29:19','2024-11-18 13:29:48'),(12,13,'กายภาพบำบัด',10.50648271,99.18683638,0.00,1,'Pending',2,'2024-11-18 20:46:22','2024-11-18 20:46:22');
/*!40000 ALTER TABLE `caregivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cognitive_screenings`
--

DROP TABLE IF EXISTS `cognitive_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cognitive_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `geriatric_screening_id` bigint(20) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cognitive_screenings_geriatric_screening_id_foreign` (`geriatric_screening_id`),
  CONSTRAINT `cognitive_screenings_geriatric_screening_id_foreign` FOREIGN KEY (`geriatric_screening_id`) REFERENCES `geriatric_screenings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cognitive_screenings`
--

LOCK TABLES `cognitive_screenings` WRITE;
/*!40000 ALTER TABLE `cognitive_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `cognitive_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (12,'เทส',2,18,NULL,'2024-11-18 12:55:07','2024-11-18 12:55:07'),(13,'Wow',14,16,NULL,'2024-11-19 11:28:16','2024-11-19 11:28:16'),(14,'---',21,18,NULL,'2024-11-23 08:57:26','2024-11-23 08:57:26'),(15,'hhhh',21,18,14,'2024-11-23 08:57:38','2024-11-23 08:57:38'),(16,'มีประโยชน์มากๆครับ',7,14,NULL,'2024-11-26 14:01:44','2024-11-26 14:01:44');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation_user`
--

DROP TABLE IF EXISTS `conversation_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversation_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_user_conversation_id_foreign` (`conversation_id`),
  KEY `conversation_user_user_id_foreign` (`user_id`),
  CONSTRAINT `conversation_user_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation_user`
--

LOCK TABLES `conversation_user` WRITE;
/*!40000 ALTER TABLE `conversation_user` DISABLE KEYS */;
INSERT INTO `conversation_user` VALUES (3,2,9,NULL,NULL),(4,2,2,NULL,NULL),(5,3,13,NULL,NULL),(6,3,9,NULL,NULL),(7,4,9,NULL,NULL),(8,4,10,NULL,NULL),(9,5,9,NULL,NULL),(10,5,7,NULL,NULL),(11,6,25,NULL,NULL),(12,6,7,NULL,NULL),(13,7,27,NULL,NULL),(14,7,9,NULL,NULL),(15,8,27,NULL,NULL),(16,8,2,NULL,NULL),(17,9,21,NULL,NULL),(18,9,9,NULL,NULL),(20,10,2,NULL,NULL),(21,11,69,NULL,NULL),(22,11,70,NULL,NULL);
/*!40000 ALTER TABLE `conversation_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations` VALUES (2,'Conversation','2024-11-24 14:43:33','2024-11-24 14:43:33'),(3,'Conversation','2024-11-24 17:40:53','2024-11-24 17:40:53'),(4,'Conversation','2024-11-24 20:35:17','2024-11-24 20:35:17'),(5,'Conversation','2024-11-24 20:41:33','2024-11-24 20:41:33'),(6,'Conversation','2024-11-26 13:58:01','2024-11-26 13:58:01'),(7,'Conversation','2024-11-26 14:10:17','2024-11-26 14:10:17'),(8,'Conversation','2024-11-26 14:11:01','2024-11-26 14:11:01'),(9,'Conversation','2024-11-27 13:04:39','2024-11-27 13:04:39'),(10,'Conversation','2024-11-29 13:49:37','2024-11-29 13:49:37'),(11,'Conversation','2025-01-05 17:01:19','2025-01-05 17:01:19');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depression_screenings`
--

DROP TABLE IF EXISTS `depression_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depression_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `geriatric_screening_id` bigint(20) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` enum('yes','no') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `depression_screenings_geriatric_screening_id_foreign` (`geriatric_screening_id`),
  CONSTRAINT `depression_screenings_geriatric_screening_id_foreign` FOREIGN KEY (`geriatric_screening_id`) REFERENCES `geriatric_screenings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depression_screenings`
--

LOCK TABLES `depression_screenings` WRITE;
/*!40000 ALTER TABLE `depression_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `depression_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diabetes_healths`
--

DROP TABLE IF EXISTS `diabetes_healths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diabetes_healths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `health_assessment_id` bigint(20) unsigned NOT NULL,
  `diabetes_status` enum('undiagnosed','treated','untreated') NOT NULL,
  `fpg` decimal(5,2) DEFAULT NULL,
  `random_glucose` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diabetes_health_health_assessment_id_foreign` (`health_assessment_id`),
  CONSTRAINT `diabetes_health_health_assessment_id_foreign` FOREIGN KEY (`health_assessment_id`) REFERENCES `health_assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diabetes_healths`
--

LOCK TABLES `diabetes_healths` WRITE;
/*!40000 ALTER TABLE `diabetes_healths` DISABLE KEYS */;
INSERT INTO `diabetes_healths` VALUES (5,6,'undiagnosed',1.00,1.00,'2025-01-07 07:31:57','2025-01-07 07:31:57'),(6,7,'undiagnosed',1.00,1.00,'2025-01-07 07:33:08','2025-01-07 07:33:08'),(7,8,'undiagnosed',1.00,1.00,'2025-01-07 07:34:56','2025-01-07 07:34:56'),(8,9,'undiagnosed',1.00,1.00,'2025-01-07 07:38:03','2025-01-07 07:38:03'),(9,10,'undiagnosed',1.00,1.00,'2025-01-07 08:03:15','2025-01-07 08:03:15');
/*!40000 ALTER TABLE `diabetes_healths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elderly_caregiver`
--

DROP TABLE IF EXISTS `elderly_caregiver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elderly_caregiver` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `elderly_id` bigint(20) unsigned NOT NULL,
  `caregiver_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `elderly_caregiver_elderly_id_caregiver_id_unique` (`elderly_id`,`caregiver_id`),
  KEY `elderly_caregiver_caregiver_id_foreign` (`caregiver_id`),
  CONSTRAINT `elderly_caregiver_caregiver_id_foreign` FOREIGN KEY (`caregiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `elderly_caregiver_elderly_id_foreign` FOREIGN KEY (`elderly_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elderly_caregiver`
--

LOCK TABLES `elderly_caregiver` WRITE;
/*!40000 ALTER TABLE `elderly_caregiver` DISABLE KEYS */;
INSERT INTO `elderly_caregiver` VALUES (1,69,70,'2025-01-05 12:47:17','2025-01-05 12:47:17');
/*!40000 ALTER TABLE `elderly_caregiver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation_topics`
--

DROP TABLE IF EXISTS `evaluation_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluation_topics` (
  `id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation_topics`
--

LOCK TABLES `evaluation_topics` WRITE;
/*!40000 ALTER TABLE `evaluation_topics` DISABLE KEYS */;
INSERT INTO `evaluation_topics` VALUES (4,'ประโยชน์และความคุ้มค่า',NULL,'2024-11-21 13:54:22','2024-11-21 14:02:45'),(10,'การใช้งานง่ายของเว็บไซต์','เว็บไซต์ใช้งานง่ายและไม่ซับซ้อน','2024-11-21 23:53:15','2024-11-21 23:53:15'),(11,'ความครบถ้วนของข้อมูล','ข้อมูลที่แสดงมีความครบถ้วนและน่าเชื่อถือ','2024-11-21 23:53:15','2024-11-21 23:53:15'),(12,'ความเร็วในการโหลดเว็บไซต์','เว็บไซต์โหลดเร็วและไม่มีปัญหาในระหว่างการใช้งาน','2024-11-21 23:53:15','2024-11-21 23:53:15'),(13,'ความสวยงามของเว็บไซต์','เว็บไซต์มีการออกแบบที่น่าสนใจและเข้าถึงง่าย','2024-11-21 23:53:15','2024-11-21 23:53:15'),(14,'ความเป็นประโยชน์ของฟังก์ชัน','ฟังก์ชันต่าง ๆ ในเว็บไซต์ช่วยตอบโจทย์การใช้งาน','2024-11-21 23:53:15','2024-11-21 23:53:15');
/*!40000 ALTER TABLE `evaluation_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eye_healths`
--

DROP TABLE IF EXISTS `eye_healths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eye_healths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `health_assessment_id` bigint(20) unsigned NOT NULL,
  `has_eye_issue` tinyint(1) DEFAULT NULL,
  `distance_vision_issue` tinyint(1) DEFAULT NULL,
  `near_vision_issue` tinyint(1) DEFAULT NULL,
  `cataract_risk_left` tinyint(1) DEFAULT NULL,
  `cataract_risk_right` tinyint(1) DEFAULT NULL,
  `glaucoma_risk_left` tinyint(1) DEFAULT NULL,
  `glaucoma_risk_right` tinyint(1) DEFAULT NULL,
  `macular_degeneration_left` tinyint(1) DEFAULT NULL,
  `macular_degeneration_right` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `eye_health_health_assessment_id_foreign` (`health_assessment_id`),
  CONSTRAINT `eye_health_health_assessment_id_foreign` FOREIGN KEY (`health_assessment_id`) REFERENCES `health_assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eye_healths`
--

LOCK TABLES `eye_healths` WRITE;
/*!40000 ALTER TABLE `eye_healths` DISABLE KEYS */;
INSERT INTO `eye_healths` VALUES (2,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:31:58','2025-01-07 07:31:58'),(3,7,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:33:08','2025-01-07 07:33:08'),(4,8,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:34:56','2025-01-07 07:34:56'),(5,9,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:38:03','2025-01-07 07:38:03'),(6,10,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,'2025-01-07 08:03:15','2025-01-07 08:03:15');
/*!40000 ALTER TABLE `eye_healths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fall_risk_screenings`
--

DROP TABLE IF EXISTS `fall_risk_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fall_risk_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `geriatric_screening_id` bigint(20) unsigned NOT NULL,
  `time_taken` int(11) NOT NULL,
  `assessment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fall_risk_screenings_geriatric_screening_id_foreign` (`geriatric_screening_id`),
  CONSTRAINT `fall_risk_screenings_geriatric_screening_id_foreign` FOREIGN KEY (`geriatric_screening_id`) REFERENCES `geriatric_screenings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fall_risk_screenings`
--

LOCK TABLES `fall_risk_screenings` WRITE;
/*!40000 ALTER TABLE `fall_risk_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `fall_risk_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geriatric_screenings`
--

DROP TABLE IF EXISTS `geriatric_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geriatric_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `health_assessment_id` bigint(20) unsigned NOT NULL,
  `cognitive_status` text NOT NULL,
  `depression_status` text NOT NULL,
  `knee_osteoarthritis_status` text NOT NULL,
  `fall_risk_status` text NOT NULL,
  `incontinence_status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `geriatric_screenings_health_assessment_id_foreign` (`health_assessment_id`),
  CONSTRAINT `geriatric_screenings_health_assessment_id_foreign` FOREIGN KEY (`health_assessment_id`) REFERENCES `health_assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geriatric_screenings`
--

LOCK TABLES `geriatric_screenings` WRITE;
/*!40000 ALTER TABLE `geriatric_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `geriatric_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_assessments`
--

DROP TABLE IF EXISTS `health_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health_assessments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `recorded_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `health_assessments_user_id_foreign` (`user_id`),
  KEY `health_assessments_recorded_by_foreign` (`recorded_by`),
  CONSTRAINT `health_assessments_recorded_by_foreign` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `health_assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_assessments`
--

LOCK TABLES `health_assessments` WRITE;
/*!40000 ALTER TABLE `health_assessments` DISABLE KEYS */;
INSERT INTO `health_assessments` VALUES (6,69,70,'2025-01-07 07:31:57','2025-01-07 07:31:57'),(7,69,70,'2025-01-07 07:33:08','2025-01-07 07:33:08'),(8,69,70,'2025-01-07 07:34:56','2025-01-07 07:34:56'),(9,69,70,'2025-01-07 07:38:03','2025-01-07 07:38:03'),(10,69,70,'2025-01-07 08:03:15','2025-01-07 08:03:15');
/*!40000 ALTER TABLE `health_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_checks`
--

DROP TABLE IF EXISTS `health_checks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health_checks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `recorded_by` bigint(20) unsigned DEFAULT NULL,
  `check_date` date NOT NULL,
  `blood_pressure_sbp` int(11) DEFAULT NULL,
  `blood_pressure_dbp` int(11) DEFAULT NULL,
  `fpg` double DEFAULT NULL,
  `fpg_risk` tinyint(1) DEFAULT NULL,
  `blood_test_results` text DEFAULT NULL,
  `hearing_left` varchar(255) DEFAULT NULL,
  `hearing_right` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `osta_index` float DEFAULT NULL,
  `osteoporosis_risk` varchar(255) DEFAULT NULL,
  `other_results` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `health_checks_user_id_foreign` (`user_id`),
  KEY `fk_recorded_by` (`recorded_by`),
  CONSTRAINT `fk_recorded_by` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_checks`
--

LOCK TABLES `health_checks` WRITE;
/*!40000 ALTER TABLE `health_checks` DISABLE KEYS */;
INSERT INTO `health_checks` VALUES (7,17,NULL,'2024-11-21',11,1,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-21 04:43:52','2024-11-21 04:43:52'),(8,17,NULL,'2024-11-21',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-21 05:05:47','2024-11-21 05:05:47'),(9,18,NULL,'2024-11-21',120,80,20,0,NULL,'ได้ยิน','ได้ยิน',20,56,NULL,NULL,NULL,'2024-11-21 08:42:37','2024-11-21 08:42:37'),(10,29,NULL,'2024-11-01',112,79,96,0,'ปกติ','ได้ยิน','ได้ยิน',71,52,NULL,NULL,NULL,'2024-11-27 18:51:32','2024-11-27 18:51:32'),(11,69,NULL,'2024-12-31',12,12,12,1,NULL,'ได้ยิน','ได้ยิน',20,60,NULL,NULL,NULL,'2024-12-31 05:25:04','2024-12-31 05:25:04'),(12,69,NULL,'2025-01-06',NULL,NULL,15,1,NULL,'ได้ยิน','ได้ยิน',NULL,NULL,NULL,NULL,NULL,'2025-01-06 02:50:37','2025-01-06 02:50:37'),(13,69,2,'2025-01-06',NULL,NULL,NULL,1,NULL,'ได้ยิน','ได้ยิน',NULL,NULL,NULL,NULL,NULL,'2025-01-06 02:53:53','2025-01-06 02:53:53');
/*!40000 ALTER TABLE `health_checks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hypertension_healths`
--

DROP TABLE IF EXISTS `hypertension_healths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hypertension_healths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `health_assessment_id` bigint(20) unsigned NOT NULL,
  `hypertension_status` enum('undiagnosed','treated','untreated') NOT NULL,
  `sbp` int(11) DEFAULT NULL,
  `dbp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hypertension_health_health_assessment_id_foreign` (`health_assessment_id`),
  CONSTRAINT `hypertension_health_health_assessment_id_foreign` FOREIGN KEY (`health_assessment_id`) REFERENCES `health_assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hypertension_healths`
--

LOCK TABLES `hypertension_healths` WRITE;
/*!40000 ALTER TABLE `hypertension_healths` DISABLE KEYS */;
INSERT INTO `hypertension_healths` VALUES (5,6,'undiagnosed',1,1,'2025-01-07 07:31:57','2025-01-07 07:31:57'),(6,7,'undiagnosed',1,1,'2025-01-07 07:33:08','2025-01-07 07:33:08'),(7,8,'undiagnosed',1,1,'2025-01-07 07:34:56','2025-01-07 07:34:56'),(8,9,'undiagnosed',1,1,'2025-01-07 07:38:03','2025-01-07 07:38:03'),(9,10,'undiagnosed',1,1,'2025-01-07 08:03:15','2025-01-07 08:03:15');
/*!40000 ALTER TABLE `hypertension_healths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incontinence_screenings`
--

DROP TABLE IF EXISTS `incontinence_screenings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incontinence_screenings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `geriatric_screening_id` bigint(20) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` enum('yes','no') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incontinence_screenings_geriatric_screening_id_foreign` (`geriatric_screening_id`),
  CONSTRAINT `incontinence_screenings_geriatric_screening_id_foreign` FOREIGN KEY (`geriatric_screening_id`) REFERENCES `geriatric_screenings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incontinence_screenings`
--

LOCK TABLES `incontinence_screenings` WRITE;
/*!40000 ALTER TABLE `incontinence_screenings` DISABLE KEYS */;
/*!40000 ALTER TABLE `incontinence_screenings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_conversation_id_foreign` (`conversation_id`),
  KEY `messages_user_id_foreign` (`user_id`),
  CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,2,9,'ยิ่งไม่ใช่เว็บ healthcare เข้าทุกวัน',1,'2024-11-24 14:43:43','2024-11-26 13:55:40'),(2,3,13,'ทัก',1,'2024-11-24 17:41:00','2024-11-24 20:33:29'),(3,3,9,'ทัก',0,'2024-11-24 17:41:26','2024-11-24 17:41:26'),(4,4,9,'Haloo!',0,'2024-11-24 20:38:13','2024-11-24 20:38:13'),(5,5,9,'test',1,'2024-11-24 20:41:37','2024-11-26 13:33:57'),(6,5,7,'สวัสดีค้าบบบ',1,'2024-11-26 13:34:02','2024-11-26 14:02:38'),(7,2,2,'hi',1,'2024-11-26 13:55:44','2024-11-26 14:16:11'),(8,6,25,'สวัสดีครับ',1,'2024-11-26 13:58:16','2024-11-26 13:58:56'),(9,6,7,'สวัสดีครับ ต้องการความช่วยเหลืออะไรครับ',0,'2024-11-26 13:59:16','2024-11-26 13:59:16'),(10,7,27,'ไงพวก',1,'2024-11-26 14:10:31','2024-11-26 14:14:39'),(11,8,27,'ิพิเดิิดดิ',1,'2024-11-26 14:11:17','2024-11-26 14:11:22'),(12,8,27,'มีถั่วไหม',1,'2024-11-26 14:11:31','2024-11-26 14:11:35'),(13,8,27,'หิว',1,'2024-11-26 14:11:47','2024-11-26 14:12:02'),(14,8,2,'gvhvvhuh',1,'2024-11-26 14:12:02','2024-11-26 14:12:38'),(15,8,27,'ไม่ตอบละ',1,'2024-11-26 14:12:47','2024-11-26 14:12:48'),(16,8,2,'ไก่',1,'2024-11-26 14:13:14','2024-11-26 14:13:41'),(17,8,2,'1-1Rvปะ',1,'2024-11-26 14:13:37','2024-11-26 14:13:41'),(18,8,27,'ไม่เล่นเกมกาก',1,'2024-11-26 14:13:47','2024-11-27 09:41:20'),(19,5,9,'หนักแล้ว',1,'2024-11-26 14:14:34','2024-11-29 07:23:49'),(20,7,9,'...',0,'2024-11-26 14:14:43','2024-11-26 14:14:43'),(21,8,2,'อิหยังว่ะ',0,'2024-11-27 12:51:04','2024-11-27 12:51:04'),(22,2,9,'เทส',1,'2024-11-27 12:53:33','2024-11-27 12:53:41'),(23,2,2,'ทำไมไม่ทำงาน',1,'2024-11-27 12:54:01','2024-11-27 12:54:16'),(24,2,2,'ไหน',1,'2024-11-27 12:56:53','2024-11-27 12:56:58'),(25,2,9,'เทส',1,'2024-11-27 12:57:03','2024-11-27 13:05:26'),(26,9,21,'helloooooooooo',1,'2024-11-27 13:04:45','2024-11-27 13:06:16'),(27,9,21,'uuuuuuuuuuuu',1,'2024-11-27 13:04:50','2024-11-27 13:06:16'),(28,9,21,'woooooooooooooooo',1,'2024-11-27 13:04:55','2024-11-27 13:06:16'),(29,9,21,':o',1,'2024-11-27 13:05:40','2024-11-27 13:06:16'),(30,9,9,'มาละ',1,'2024-11-27 13:06:20','2024-11-27 13:17:33'),(31,9,21,'weeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee',1,'2024-11-27 13:06:22','2024-11-27 13:30:37'),(32,9,9,'ขึ้นไหม',1,'2024-11-27 13:06:25','2024-11-27 13:17:33'),(33,9,21,'yes',1,'2024-11-27 13:06:32','2024-11-27 13:30:37'),(34,9,21,'ขึ้น',1,'2024-11-27 13:06:34','2024-11-27 13:30:37'),(35,9,21,'ฉ่าม',1,'2024-11-27 13:06:36','2024-11-27 13:30:37'),(36,9,9,'แบบไม่ต้องรีเฟชรหน้าจอ',1,'2024-11-27 13:06:39','2024-11-27 13:17:33'),(37,9,21,'แจ๋วมาก',1,'2024-11-27 13:06:41','2024-11-27 13:30:37'),(38,9,9,'โอเค 5555',1,'2024-11-27 13:06:42','2024-11-27 13:17:33'),(39,9,21,'เยียยยยยย',1,'2024-11-27 13:06:47','2024-11-27 13:30:37'),(40,9,21,'เรียลไทม์เว่อวัง',1,'2024-11-27 13:06:51','2024-11-27 13:30:37'),(41,9,21,'Ghengmak',1,'2024-11-27 13:06:57','2024-11-27 13:30:37'),(42,9,9,'เราตั้งดีเลย์ไว้ 3 วิ',1,'2024-11-27 13:07:06','2024-11-27 13:17:33'),(43,9,9,'ข่อมจั๊บ',1,'2024-11-27 13:07:13','2024-11-27 13:17:33'),(44,9,21,'แจ๋ววววว',1,'2024-11-27 13:07:21','2024-11-27 13:30:37'),(45,9,9,'ตอนนี้เรากำลังเพิ่มข้อความอ่านแล้วใต้ข้อความของเราอยู่',1,'2024-11-27 13:07:54','2024-11-27 13:17:33'),(46,9,21,'เกกกก',1,'2024-11-27 13:08:29','2024-11-27 13:30:37'),(47,9,21,'เนี่ย วันนี้ยูมาบ้านเค้าได้เว่ยย',1,'2024-11-27 13:08:39','2024-11-27 13:30:37'),(48,9,21,'เพราะอากาศไม่หนาว',1,'2024-11-27 13:08:47','2024-11-27 13:30:37'),(49,9,21,'แต่ร้อน',1,'2024-11-27 13:08:52','2024-11-27 13:30:37'),(50,9,9,'อยู่จะกินอะไรไหมล่ะ',1,'2024-11-27 13:11:13','2024-11-27 13:17:33'),(51,9,9,'เดี๊ยวได้เข้าไป',1,'2024-11-27 13:11:18','2024-11-27 13:17:33'),(52,9,9,'นั่งชิลๆด้วย ไหนๆก็เหลือซ้อมละ',1,'2024-11-27 13:11:25','2024-11-27 13:17:33'),(53,9,21,'วอื',1,'2024-11-27 13:17:37','2024-11-27 13:30:37'),(54,9,21,'โฯ',1,'2024-11-27 13:17:39','2024-11-27 13:30:37'),(55,9,21,'โนนๆๆๆๆๆๆๆ',1,'2024-11-27 13:17:43','2024-11-27 13:30:37'),(56,9,21,'เค้ากินน้ำพอแล้ว',1,'2024-11-27 13:17:49','2024-11-27 13:30:37'),(57,9,21,'5555555555555',1,'2024-11-27 13:17:51','2024-11-27 13:30:37'),(58,9,9,'ยูยังดูอยู่ป่ะ',1,'2024-11-27 13:29:39','2024-11-27 13:30:37'),(59,9,9,'เพิ่งอัพเดท',1,'2024-11-27 13:29:43','2024-11-27 13:30:37'),(60,9,9,'โอเคยูเปิดทิ้งไว้',1,'2024-11-27 13:31:00','2024-11-27 13:31:01'),(61,9,9,'มันขึ้นว่าอ่านแล้ว',1,'2024-11-27 13:31:03','2024-11-27 13:31:04'),(62,9,9,'test',1,'2024-11-27 13:39:05','2024-11-27 13:39:19'),(63,9,21,'ใใ',1,'2024-11-27 13:39:24','2024-11-27 13:39:32'),(64,9,21,'เย่วๆ',1,'2024-11-27 13:39:28','2024-11-27 13:39:32'),(65,9,9,'อุอิ',1,'2024-11-27 19:05:49','2024-11-28 09:53:06'),(68,10,2,'สวัสดี',1,'2024-11-29 13:50:58','2024-11-29 13:50:58'),(70,10,2,'วอท',1,'2024-11-29 13:53:00','2024-11-29 13:53:01'),(71,10,2,'1-1 rove ป่าว',1,'2024-11-29 13:53:10','2024-11-29 13:53:13'),(73,10,2,'บ้า',0,'2024-11-29 13:55:45','2024-11-29 13:55:45'),(74,10,2,'มาดิ',0,'2024-11-29 13:55:48','2024-11-29 13:55:48'),(75,10,2,'ให้ สอง!!!!!',0,'2024-11-29 13:56:07','2024-11-29 13:56:07'),(76,11,69,'ฮัลโหล',1,'2025-01-05 17:35:07','2025-01-05 17:36:05'),(77,11,70,'หนักแล้ว',0,'2025-01-07 08:55:05','2025-01-07 08:55:05');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_11_11_034738_create_roles_table',2),(5,'2024_11_11_034900_create_role_user_table',2),(6,'2024_11_11_041836_create_posts_table',3),(7,'2024_11_11_042006_create_comments_table',4),(8,'2024_11_11_110852_create_user_personal_info_table',5),(9,'2024_11_11_114858_add_image_to_posts_table',6),(10,'2024_11_12_015901_create_caregivers_table',7),(11,'2024_11_13_113315_add_status_to_caregivers_table',8),(12,'2024_11_14_041628_create_application_steps_table',9),(13,'2024_11_14_045517_add_application_step_to_caregivers_table',10),(14,'2024_11_16_103851_create_visits_table',11),(15,'2024_11_16_233859_add_avatar_to_users_table',12),(16,'2024_12_24_120020_create_user_physical_table',13),(17,'2024_12_27_125245_create_elderly_caregiver_table',14),(18,'2025_01_06_124018_create_health_assessments_table',15),(19,'2025_01_06_125800_create_geriatric_screenings_table',16),(20,'2025_01_06_130009_create_cognitive_screenings_table',17),(21,'2025_01_06_130245_create_fall_risk_screenings_table',18),(22,'2025_01_06_130339_create_incontinence_screenings_table',19),(23,'2025_01_06_130907_create_depression_screenings_table',20),(24,'2025_01_06_131645_create_hypertension_health_table',21),(25,'2025_01_06_131752_create_diabetes_health_table',22),(26,'2025_01_06_131843_create_oral_health_table',23),(27,'2025_01_06_131907_create_eye_health_table',24),(28,'2025_01_07_090329_create_appointments_table',25);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oral_healths`
--

DROP TABLE IF EXISTS `oral_healths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oral_healths` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `health_assessment_id` bigint(20) unsigned NOT NULL,
  `brushing_frequency` enum('none','once_daily','twice_daily','more_than_twice_daily','other') DEFAULT NULL,
  `brushing_other` varchar(255) DEFAULT NULL,
  `uses_toothpaste` tinyint(1) DEFAULT NULL,
  `cleans_between_teeth` tinyint(1) DEFAULT NULL,
  `cleaning_tool` varchar(255) DEFAULT NULL,
  `smokes_more_than_10` tinyint(1) DEFAULT NULL,
  `chews_areca` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oral_health_health_assessment_id_foreign` (`health_assessment_id`),
  CONSTRAINT `oral_health_health_assessment_id_foreign` FOREIGN KEY (`health_assessment_id`) REFERENCES `health_assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oral_healths`
--

LOCK TABLES `oral_healths` WRITE;
/*!40000 ALTER TABLE `oral_healths` DISABLE KEYS */;
INSERT INTO `oral_healths` VALUES (3,6,'none',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:31:57','2025-01-07 07:31:57'),(4,7,'none',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:33:08','2025-01-07 07:33:08'),(5,8,'none',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 07:34:56','2025-01-07 07:34:56'),(6,9,'none','1',NULL,NULL,'1',NULL,1,'2025-01-07 07:38:03','2025-01-07 07:38:03'),(7,10,'none','1',1,NULL,'1',NULL,NULL,'2025-01-07 08:03:15','2025-01-07 08:03:15');
/*!40000 ALTER TABLE `oral_healths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('tossapornza007@gmail.com','$2y$12$CbwsCgx4DmUR94Yvq.1Gn.7z67hIgXV0pcPqqDOkPHQ5ugCoZycSm','2024-11-18 10:18:31');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_author_id_foreign` (`author_id`),
  CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (14,'5 โรคระบาดหน้าหนาว ทุกเพศทุกวัยควรระวัง','1.โรคไข้หวัด ไข้หวัดใหญ่\r\nอาการสำคัญ คือ มีไข้ ปวดศีรษะ น้ำมูกไหล ไอ เจ็บหรือแสบคอ\r\nสำหรับไข้หวัดใหญ่จะมีอาการรุนแรงกว่าไข้หวัดทั่วไป คือ มีไข้สูง หนาวสั่น ปวดศีรษะ ปวดกระดูกและกล้ามเนื้อ หรืออาจมีอาการคลื่นไส้อาเจียนร่วมด้วย\r\n\r\n2.โรคติดเชื้อไวรัส RSV\r\nมีอาการสำคัญเหมือนโรคไข้หวัดและไข้หวัดใหญ่ ซึ่งผู้ป่วยมักหายเองได้ภายใน 1-2 สัปดาห์ แต่สำหรับเด็กที่มีอายุต่ำกว่า 5 ปี รวมทั้งผู้ป่วยโรคเรื้อรังเกี่ยวกับหัวใจและปอด และผู้ป่วยภาวะภูมิคุ้มกันบกพร่อง หากพบว่ามีไข้สูงมากกว่า 39 องศาเซลเซียส ไอ มีเสมหะ หายใจเร็วและแรง หอบเหนื่อยหรือมีเสียงวี๊ดขณะหายใจ ควรรีบไปพบแพทย์โดยเร็ว\r\n3.โรคมือ เท้า ปาก\r\nอาการสำคัญ คือ มีไข้ 2–4 วัน เบื่ออาหาร มีแผลคล้ายแผลร้อนในที่ปาก ลิ้น เหงือก กระพุ้งแก้ม และมีผื่นเป็นจุดแดง ซึ่งต่อมาจะกลายเป็นตุ่มน้ำพองใส แดง บริเวณที่ฝ่ามือ ฝ่าเท้า ต้นขา หรือที่ก้น ไม่มีอาการคัน หากไม่มีภาวะแทรกซ้อนจะทุเลาและหายเป็นปกติภายใน 10 วัน\r\n\r\n4.โรคหลอดลมอักเสบ และปอดบวม\r\nอาการสำคัญ คือ มีไข้ ไอ มีเสมหะมาก แน่นหน้าอก หายใจไม่ออก เหนื่อยหอบ\r\n\r\n5.โรคอุจจาระร่วงจากเชื้อโรต้าไวรัส\r\nอาการสำคัญ คือ มีไข้ อาเจียน และถ่ายเหลวเป็นน้ำ ซึ่งอาการถ่ายเหลวจะหายภายใน 3-7 วัน',7,'2024-11-18 11:01:33','2024-11-18 11:09:10','uploads/posts/1731902493.jpg'),(16,'ดูแลสุขภาพอย่างไร? ให้ดีทั้งกายและจิต ห่างไกลโรคภัยแบบยั่งยืน','รับประทานอาหารที่มีประโยชน์ และดื่มน้ำให้เพียงพอ\r\nอาหารและน้ำเป็นสิ่งจำเป็นอย่างมากที่จะช่วยเพิ่มพลังงานให้แก่ร่างกาย ควรกินอาหารให้ครบ 5 หมู่ และครบ 3 มื้อ เพื่อให้ได้สารอาหารที่ครบถ้วน อาหารที่ควรกินคือ กินข้าวเป็นอาหารหลักและกินผักผลไม้เป็นประจำ หรือการกินปลาซึ่งเป็นแหล่งโปรตีนที่ดี มีไขมันต่ำ และการกินไข่ที่มีโปรตีนสูง จะช่วยซ่อมแซมร่างกายได้ดี แถมยังหาซื้อได้ง่ายอีกด้วย โดยสารอาหารต่างๆ ที่เราได้รับจะเข้ามาช่วยเสริมสร้างพลังงานให้อวัยวะต่างๆ ให้ร่างกายทำงานได้ดีขึ้น และการกินอาหารที่มีประโยชน์ยังช่วยควบคุมน้ำหนักได้อีกด้วย นอกจากนี้ยังช่วยซ่อมแซมส่วนที่สึกหรอในร่างกาย ทำให้มีสุขภาพร่างกายแข็งแรง\r\n\r\nน้ำมีความจำเป็นต่อร่างกายเป็นอย่างมาก เนื่องจากร้อยละ 60 ของน้ำหนักตัวร่างกายเราประกอบไปด้วยน้ำ ดังนั้นจึงควรดื่มน้ำให้เพียงพอ โดยปริมาณน้ำที่ควรได้รับคือ 100-150 มิลลิลิตรต่อ 100 กิโลแคลอรี่ของพลังงานที่ได้รับในแต่ละวัน หรือ 8-10 แก้วต่อวัน\r\n\r\nพักผ่อนให้เพียงพอ\r\nแน่นอนว่าการนอนหลับคือการพักผ่อนชั้นดี เพราะการนอนหลับพักผ่อนเป็นพื้นฐานในการรักษาสุขภาพโดยรวม นอกจากจะเป็นส่วนช่วยให้ฟื้นฟูการทำงานของร่างกายแล้ว ยังช่วยให้เกิดความสมดุล ให้ร่างกาย ทำงานเป็นปกติอีกด้วย\r\n\r\nการนอนหลับให้เกิดประสิทธิภาพที่ดี คือควรนอนให้ได้อย่างน้อย 7-8 ชั่วโมง ซึ่งในแต่ละวัยมีความต้องการชั่วโมงการนอนไม่เท่ากัน อย่างเด็กเล็กจะต้องได้รับการนอนหลับพักผ่อนมากกว่าวัยอื่นๆ การอดนอนจะทำให้ระบบต่างๆ ในร่างกายทำงานได้ไม่ดี ระบบเผาผลาญไม่ดี ฮอร์โมนทำงานผิดปกติ ซึ่งอาจจะส่งผลต่อสภาพอารมณ์และจิตใจได้\r\n\r\nดังนั้นการได้รับการพักผ่อนที่เพียงพอ จะช่วยลดอาการซึมเศร้าและความวิตกกังวลต่างๆ  ทำให้สมองปลอดโปร่งมากขึ้น สมาธิดีขึ้น และทำให้ตัดสินใจอะไรได้ดีมากขึ้นด้วย',7,'2024-11-18 11:09:57','2024-11-18 11:09:57','uploads/posts/1731902997.jpg'),(17,'การดูแลสุขภาพกายและใจให้สมดุล','หากเครียดมากๆ หรือพักผ่อนไม่เพียงพอ ฮอร์โมนความเครียดจะสูงขึ้น การทำงานของระบบฮอร์โมนอื่นๆ ก็กระทบกระเทือนไปด้วย เช่น มีผื่นภูมิแพ้ที่ผิวหนัง เป็นสิวเรื้อรัง ท้องอืด อาหารไม่ย่อย ท้องผูก ท้องเสีย นอนไม่หลับ ตื่นขึ้นมาไม่สดชื่น อารมณ์ปรวนแปร อ่อนเพลียไม่ทราบสาเหตุ บางคนอาจเกิดอาการซึมเศร้า มีความคิดทำร้ายร่างกายตนเองและคิดฆ่าตัวตายได้ หลายคนเมื่อเกิดอาการเหล่านี้ก็จะรักษาไปตามอาการ โดยการรับประทานยา เมื่อหายแล้วสักพักก็เกิดอาการขึ้นซ้ำอีก เมื่อหากร่างกายหายเป็นปกติสมบูรณ์แล้ว แต่จิตใจยังมีปัญหาอยู่ ไม่ได้รับการแก้ไขเรื่องความไม่สมดุล ก็ทำให้เกิดความเจ็บป่วยขึ้นอีก แต่เมื่อใดที่ร่างกายและจิตใจมีความสมดุล ระบบต่างๆ ของร่างกายก็กระตุ้นให้ร่างกายซ่อมแซมตัวเองได้ อาการผิดปกติจะดีขึ้นและสามารถป้องกันโรคต่างๆ ได้อย่างมีประสิทธิภาพ จึงขอแนะนำวิธีการสร้างสมดุลด้านจิตใจและร่างกาย เพื่อเพิ่มคุณภาพชีวิตให้ดีขึ้นโดยมีหลัก 5 ข้อ ดังนี้\r\n\r\n\r\nหมั่นออกกำลังกาย เพื่อเสริมสร้างให้ร่างกายแข็งแรง สมบูรณ์ เพราะจะช่วยทำให้หัวใจและปอดแข็งแรง เลือดไปเลี้ยงสมองได้มากขึ้น ช่วยลดคอเรสเตอรอล ทำให้โอกาสเส้นเลือดอุดตันลดลง ส่งผลดีต่อระบบการย่อยและการขับถ่าย ทั้งยังช่วยให้นอนหลับสนิทอีกด้วย\r\n\r\n\r\nรับประทานอาหารที่มีประโยชน์และจำเป็นต่อร่างกาย ดื่มน้ำให้เพียงพอ ไม่ควรกินอาหารที่เป็นกรดหรือด่างมากจนเกินไป แต่ถ้าเมื่อไรที่ร่างกายและอวัยวะภายในมีความร้อน อาหารที่มีฤทธิ์เย็นช่วยปรับสมดุลของร่างกายให้เป็นปกติได้ คือ ผักบุ้ง ตำลึง ผักหวาน แตงกวา ฟัก และหัวปลี ส่วนผลไม้ควรเป็นประเภท มังคุด มะยม แตงโม แตงไทย แคนตาลูป ส้มโอ กล้วยน้ำว้า แก้วมังกร กระท้อน แอปเปิ้ล น้ำมะพร้าว และลูกพรุน เป็นต้น\r\n\r\nพักผ่อนให้เพียงพอ เพราะการอดนอนทำให้ระบบการเผาผลาญในร่างกายไม่ดี ฮอร์โมนทำงานผิดปกติ เกิดการติดขัดของเมตาโบลิซึ่ม และส่งผลต่อด้านอารมณ์และจิตใจได้\r\n\r\n\r\nเสริมสร้างจิตใจให้แข็งแรง โดยการฝึกทักษะการผ่อนคลาย ดูแลจิตใจเพื่อรับมือกับความเครียดอย่างสม่ำเสมอ หยุดคิดเรื่องเครียดต่างๆ หากิจกรรมสร้างสรรค์ทำ เช่น ฟังเพลง ดูหนัง เล่นกีฬา ท่องเที่ยว หรือทำกิจกรรมร่วมกับครอบครัว\r\n\r\n\r\nคอยสังเกตดูแลเอาใจใส่ตัวเองทั้งร่างกายและจิตใจ ว่าอยู่ในภาวะสมดุลหรือไม่ ทำอะไรเกินหรือขาดไปบ้าง ให้ฟังเสียงของร่างกายและจิตใจ เพื่อจะได้รู้ว่าเราควรปรับตัวเองเพื่อให้ร่างกายและจิตใจอยู่ในสภาวะสมดุลอย่างไร',7,'2024-11-18 11:11:13','2024-11-18 11:11:13','uploads/posts/1731903073.jpg'),(18,'เทคนิคการดูแลสุขภาพผู้สูงอายุ','เทคนิคด้านการดูแลสุขภาพกายผู้สูงอายุ\r\nอาหารการกิน ผู้สูงอายุควรรับประทานอาหารที่มีประโยชน์ครบ 5 หมู่ เน้นผักและผลไม้สด หลีกเลี่ยงอาหารที่มีไขมันสูง น้ำตาลสูง และโซเดียมสูง ผู้สูงอายุควรดื่มน้ำสะอาดอย่างน้อยวันละ 8 แก้ว\r\n\r\nการออกกำลังกาย ผู้สูงอายุควรออกกำลังกายอย่างสม่ำเสมอ อย่างน้อยวันละ 30 นาที การออกกำลังกายที่เหมาะสมสำหรับผู้สูงอายุ ได้แก่ การเดิน ว่ายน้ำ ขี่จักรยาน เต้นแอโรบิก เป็นต้น การออกกำลังกายจะช่วยเสริมสร้างกล้ามเนื้อและกระดูกให้แข็งแรง ช่วยให้ร่างกายแข็งแรงและเคลื่อนไหวได้อย่างคล่องแคล่ว\r\n\r\nการตรวจสุขภาพ ผู้สูงอายุควรไปตรวจสุขภาพเป็นประจำทุกปี เพื่อตรวจเช็คสุขภาพร่างกายและจิตใจ ป้องกันโรคภัยไข้เจ็บต่างๆ\r\n\r\nสุขอนามัยส่วนบุคคล ผู้สูงอายุควรดูแลสุขอนามัยส่วนบุคคลให้สะอาดอยู่เสมอ อาบน้ำสระผมเป็นประจำทุกวัน แปรงฟันวันละ 2 ครั้ง ตัดเล็บให้สั้นอยู่เสมอ\r\n\r\nเทคนิคด้านการดูแลสุขภาพจิตผู้สูงอายุ\r\nพูดคุยและรับฟัง ผู้ดูแลควรพูดคุยและรับฟังผู้สูงอายุอย่างเข้าใจ ให้ความสำคัญกับความรู้สึกและความคิดเห็นของผู้สูงอายุ หลีกเลี่ยงการพูดจาหยาบคายหรือดูถูกผู้สูงอายุ\r\n\r\nส่งเสริมกิจกรรมทำ ผู้ดูแลควรส่งเสริมให้ผู้สูงอายุมีกิจกรรมทำ เช่น พบปะสังสรรค์กับญาติมิตร เข้าร่วมกิจกรรมทางสังคม หรือทำกิจกรรมที่ผู้สูงอายุชื่นชอบ การมีกิจกรรมทำจะช่วยให้ผู้สูงอายุรู้สึกมีคุณค่าและมีความสุข\r\n\r\nสังเกตอาการ ผู้ดูแลควรสังเกตอาการของผู้สูงอายุอย่างใกล้ชิด หากพบความผิดปกติ เช่น ซึมเศร้า เบื่ออาหาร นอนไม่หลับ ควรรีบพาไปพบแพทย์\r\n\r\nเทคนิคด้านการจัดสภาพแวดล้อม\r\nจัดสภาพแวดล้อมให้เอื้อต่อการอยู่อาศัย ผู้ดูแลควรจัดสภาพแวดล้อมให้เอื้อต่อการอยู่อาศัยของผู้สูงอายุ เช่น ติดตั้งราวจับในห้องน้ำ ทางลาด ไฟส่องสว่าง เป็นต้น การจัดสภาพแวดล้อมที่ปลอดภัยจะช่วยป้องกันผู้สูงอายุจากอุบัติเหตุ\r\n\r\nติดตั้งอุปกรณ์ช่วยเดิน หากผู้สูงอายุมีปัญหาในการเดิน ผู้ดูแลควรติดตั้งอุปกรณ์ช่วยเดิน เช่น ไม้เท้า วอล์คเกอร์ เป็นต้น อุปกรณ์ช่วยเดินจะช่วยให้ผู้สูงอายุสามารถเคลื่อนไหวได้อย่างสะดวกและปลอดภัย\r\n\r\nดูแลความสะอาดและความปลอดภัย ผู้ดูแลควรดูแลให้บ้านหรือที่อยู่อาศัยสะอาดและปลอดภัย เพื่อป้องกันอันตรายที่อาจเกิดขึ้นกับผู้สูงอายุ เช่น ไฟฟ้าลัดวงจร ลื่นล้ม เป็นต้น\r\n\r\nการดูแลผู้สูงอายุเป็นงานที่ต้องใช้ความเอาใจใส่และความเข้าใจ ผู้ดูแลควรคำนึงถึงทั้งด้านสุขภาพกายและสุขภาพจิตของผู้สูงอายุ เพื่อให้ผู้สูงอายุสามารถดำรงชีวิตได้อย่างมีความสุขและมีคุณภาพ',7,'2024-11-18 11:12:45','2024-11-18 11:12:45','uploads/posts/1731903165.png');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assessment_id` bigint(20) unsigned NOT NULL,
  `question_text` text NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_assessment_id_foreign` (`assessment_id`),
  CONSTRAINT `questions_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluation_topic_id` bigint(20) unsigned NOT NULL,
  `stars` int(11) NOT NULL DEFAULT 0,
  `feedback` text DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (5,4,2,NULL,2,'2024-11-21 16:30:59','2024-11-21 16:30:59'),(6,4,3,'เว็บไซต์ดีไซน์เข้าถึงง่ายมาก',9,'2024-11-21 23:51:26','2024-11-22 20:17:02'),(7,4,3,NULL,NULL,'2024-11-22 14:04:49','2024-11-22 14:04:49'),(10,4,5,'ดี!',10,'2024-11-23 13:41:54','2024-11-23 13:41:54'),(11,4,5,'แจ๋วมากครับ',24,'2024-11-23 13:52:16','2024-11-23 13:52:16'),(12,4,4,NULL,7,'2024-11-23 17:39:38','2024-11-23 17:39:38'),(13,4,4,'ดีค่ะเพจใช้งานง่าย ลายละเอียดก็โอเคค่ะขอบคุณค่ะ',23,'2024-11-23 22:40:27','2024-11-23 22:40:27'),(14,4,5,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56'),(15,10,2,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56'),(16,11,3,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56'),(17,12,5,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56'),(18,13,2,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56'),(19,14,3,NULL,21,'2024-11-26 15:39:49','2024-11-26 15:41:56');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `fk_role_user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_role_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_role_user_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_role_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,2,1,NULL,NULL),(2,3,2,NULL,NULL),(3,1,2,NULL,NULL),(4,4,2,NULL,NULL),(5,5,2,NULL,NULL),(6,6,2,NULL,NULL),(7,7,2,NULL,NULL),(8,8,2,NULL,NULL),(9,9,2,NULL,NULL),(10,10,2,NULL,NULL),(11,11,2,NULL,NULL),(12,12,2,NULL,NULL),(13,13,2,NULL,NULL),(14,14,2,NULL,NULL),(15,15,2,NULL,NULL),(16,16,2,NULL,NULL),(17,20,4,NULL,NULL),(18,21,2,NULL,NULL),(19,22,2,NULL,NULL),(20,23,2,NULL,NULL),(21,24,2,NULL,NULL),(22,25,2,NULL,NULL),(23,26,2,NULL,NULL),(24,27,2,NULL,NULL),(25,28,2,NULL,NULL),(26,29,4,NULL,NULL),(27,30,4,NULL,NULL),(28,31,4,NULL,NULL),(29,32,4,NULL,NULL),(30,33,4,NULL,NULL),(31,34,4,NULL,NULL),(32,35,4,NULL,NULL),(33,36,4,NULL,NULL),(34,37,4,NULL,NULL),(35,38,4,NULL,NULL),(36,39,2,NULL,NULL),(44,69,4,NULL,NULL),(45,70,5,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator role','2024-11-10 20:55:14','2024-11-10 20:55:14'),(2,'user','Regular user role','2024-11-10 20:55:14','2024-11-10 20:55:14'),(3,'authority','Authority Role','2024-11-20 11:41:40','2024-11-20 11:41:40'),(4,'patient','Patient role','2024-11-20 17:19:33','2024-11-20 17:19:33'),(5,'caregiver','Caregiver Role','2024-12-27 04:48:55','2024-12-27 04:48:55');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('8uVtQnwziXeKSo4KDUACEzjH53T2oj2hG99FDfW2',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicGZsY3JiRGY4WnJJY2dhTUJIbzNWSzNCVDJqbjdOTXVJaVVKU2ZYcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1731760055);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_answers`
--

DROP TABLE IF EXISTS `survey_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assessment_id` bigint(20) unsigned NOT NULL,
  `question_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_answers_assessment_id_foreign` (`assessment_id`),
  KEY `survey_answers_question_id_foreign` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_answers`
--

LOCK TABLES `survey_answers` WRITE;
/*!40000 ALTER TABLE `survey_answers` DISABLE KEYS */;
INSERT INTO `survey_answers` VALUES (1,1,8,2,'\"\\u0e44\\u0e21\\u0e48\\u0e21\\u0e35\\u0e40\\u0e25\\u0e22\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(2,1,9,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e1a\\u0e32\\u0e07\\u0e27\\u0e31\\u0e19(1-7)\\u0e27\\u0e31\\u0e19\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(3,1,10,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e1a\\u0e32\\u0e07\\u0e27\\u0e31\\u0e19(1-7)\\u0e27\\u0e31\\u0e19\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(4,1,11,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e1a\\u0e48\\u0e2d\\u0e22(\\u0e21\\u0e32\\u0e01\\u0e01\\u0e27\\u0e48\\u0e327\\u0e27\\u0e31\\u0e19)\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(5,1,12,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(6,1,13,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(7,1,14,2,'\"1\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(8,1,15,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e1a\\u0e32\\u0e07\\u0e27\\u0e31\\u0e19(1-7)\\u0e27\\u0e31\\u0e19\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(9,1,16,2,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e1a\\u0e48\\u0e2d\\u0e22(\\u0e21\\u0e32\\u0e01\\u0e01\\u0e27\\u0e48\\u0e327\\u0e27\\u0e31\\u0e19)\"','2024-11-22 21:01:35','2024-11-22 21:01:35'),(10,1,8,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(11,1,9,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(12,1,10,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(13,1,11,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(14,1,12,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(15,1,13,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(16,1,14,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(17,1,15,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(18,1,16,NULL,'\"\\u0e40\\u0e1b\\u0e47\\u0e19\\u0e17\\u0e38\\u0e01\\u0e27\\u0e31\\u0e19\"','2024-11-23 09:30:49','2024-11-23 09:30:49'),(19,1,8,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(20,1,9,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(21,1,10,23,'\"0\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(22,1,11,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(23,1,12,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(24,1,13,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(25,1,14,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(26,1,15,23,'\"1\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(27,1,16,23,'\"0\"','2024-11-23 13:03:16','2024-11-23 13:03:16'),(28,1,8,9,'\"1\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(29,1,9,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(30,1,10,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(31,1,11,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(32,1,12,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(33,1,13,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(34,1,14,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(35,1,15,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(36,1,16,9,'\"0\"','2024-11-24 23:20:15','2024-11-24 23:20:15'),(37,1,8,NULL,'\"1\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(38,1,9,NULL,'\"2\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(39,1,10,NULL,'\"3\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(40,1,11,NULL,'\"1\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(41,1,12,NULL,'\"0\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(42,1,13,NULL,'\"0\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(43,1,14,NULL,'\"3\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(44,1,15,NULL,'\"0\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(45,1,16,NULL,'\"0\"','2024-11-26 13:30:39','2024-11-26 13:30:39'),(46,1,8,40,'\"2\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(47,1,9,40,'\"1\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(48,1,10,40,'\"0\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(49,1,11,40,'\"0\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(50,1,12,40,'\"0\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(51,1,13,40,'\"1\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(52,1,14,40,'\"2\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(53,1,15,40,'\"0\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(54,1,16,40,'\"0\"','2024-11-29 13:49:08','2024-11-29 13:49:08'),(55,1,8,2,'\"2\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(56,1,9,2,'\"3\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(57,1,10,2,'\"2\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(58,1,11,2,'\"1\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(59,1,12,2,'\"2\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(60,1,13,2,'\"0\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(61,1,14,2,'\"2\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(62,1,15,2,'\"1\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(63,1,16,2,'\"2\"','2024-12-24 05:13:47','2024-12-24 05:13:47'),(64,1,8,2,'\"2\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(65,1,9,2,'\"3\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(66,1,10,2,'\"2\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(67,1,11,2,'\"1\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(68,1,12,2,'\"2\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(69,1,13,2,'\"0\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(70,1,14,2,'\"2\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(71,1,15,2,'\"1\"','2024-12-24 05:15:49','2024-12-24 05:15:49'),(72,1,16,2,'\"2\"','2024-12-24 05:15:49','2024-12-24 05:15:49');
/*!40000 ALTER TABLE `survey_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_personal_info`
--

DROP TABLE IF EXISTS `user_personal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_personal_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `care_type` varchar(255) DEFAULT NULL,
  `preferred_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_personal_info_user_id_foreign` (`user_id`),
  CONSTRAINT `user_personal_info_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_personal_info`
--

LOCK TABLES `user_personal_info` WRITE;
/*!40000 ALTER TABLE `user_personal_info` DISABLE KEYS */;
INSERT INTO `user_personal_info` VALUES (1,3,'','','2024-11-14','male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-11 04:41:54','2024-11-11 04:41:54'),(2,10,'','','2004-10-13','male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 11:05:59','2024-11-18 11:05:59'),(6,20,'','','2024-11-21','male','test','test',NULL,NULL,NULL,NULL,NULL,'2024-11-21 16:14:04','2024-11-21 16:14:04'),(7,29,'','','1953-10-02','male','080-868-3836','14 หมู่ 8 ต.ท่ายาง จ.ชุมพร อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 18:43:47','2024-11-27 18:43:47'),(8,30,'','','2501-06-01','female','-','8/2 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 18:59:54','2024-11-27 18:59:54'),(9,31,'','','2494-05-02','female','-','34 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:07:05','2024-11-27 19:07:05'),(10,32,'','','2488-03-27','male','-','34 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:11:02','2024-11-27 19:11:02'),(11,33,'','','2501-12-14','female','-','128 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','ความดันโลหิตสูง','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:18:30','2024-11-27 19:18:30'),(12,34,'','','2489-06-02','male','-','34/1 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:21:40','2024-11-27 19:21:40'),(13,35,'','','2485-02-10','male','-','34/1 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:23:39','2024-11-27 19:23:39'),(14,36,'','','2502-12-25','female','084-460-9739','3 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','สุขภาพปกติ','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:27:25','2024-11-27 19:27:25'),(15,37,'','','2475-11-12','male','084-460-9739','3 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','ความดันโลหิตสูง','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:30:20','2024-11-27 19:30:20'),(16,38,'','','2501-05-19','female','080-879-2110','92/4 หมู่ 8 ต.ท่ายาง อ.เมือง จ.ชุมพร 86000','เบาหวาน','ไม่มี','ไม่มี',NULL,NULL,'2024-11-27 19:35:37','2024-11-27 19:35:37'),(39,69,'Tossaporn','Khamkawe','2024-12-27','male',NULL,'Krom Luang Road, Chumphon',NULL,NULL,NULL,NULL,NULL,'2024-12-27 08:27:04','2024-12-27 08:27:04'),(40,70,'Tossaporn','Khamkawe','2024-12-27',NULL,'0917217128','77/4',NULL,NULL,NULL,NULL,NULL,'2024-12-27 08:27:05','2024-12-27 08:27:05'),(41,2,NULL,NULL,NULL,'male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-05 16:30:52','2025-01-05 16:30:52');
/*!40000 ALTER TABLE `user_personal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_physical`
--

DROP TABLE IF EXISTS `user_physical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_physical` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_physical_user_id_foreign` (`user_id`),
  CONSTRAINT `user_physical_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_physical`
--

LOCK TABLES `user_physical` WRITE;
/*!40000 ALTER TABLE `user_physical` DISABLE KEYS */;
INSERT INTO `user_physical` VALUES (4,69,170.00,60.00,'a','2024-12-27 08:27:04','2024-12-27 08:27:04');
/*!40000 ALTER TABLE `user_physical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `citizen_id` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test',NULL,'test@test.com',NULL,'$2y$12$F0pWVz43.lFwJQmjcvZZaOc5aBlZvuSjKE66bsBiKFzGe6IBfvm0u',NULL,'2024-11-10 19:59:24','2024-11-10 19:59:24',NULL),(2,'Admin User',NULL,'admin@admin.com',NULL,'$2y$12$840lWd1MVsesX.cuHXLVm.4woTUG7RGIhvBVXxb365bThdq4H8y7C','b4wESz1ZKtGQsLRKowiSlkm1d3KOP8lbzpVGsM9b6gwPrGYiwXxAnWlWyUUr','2024-11-10 20:55:15','2024-11-18 13:03:17',NULL),(3,'Regular User',NULL,'user@example.com',NULL,'$2y$12$6i2nvJf/mO6cOxAz8nizquPzqy3x.9KiEEx4tjWjt.Of12jYd2BMy',NULL,'2024-11-10 20:55:16','2024-11-17 02:11:44','1731784304.png'),(4,'test user',NULL,'test@example.com',NULL,'$2y$12$lZYL.uBNYOeSnRbN5lttt.DjOqL0p5yu0F5nVpTWdPrVLn6CL3TgS',NULL,'2024-11-10 22:37:53','2024-11-10 22:37:53',NULL),(5,'test1',NULL,'test1@gmail.com',NULL,'$2y$12$.lAMAxl8gS5XgjRGvpl7Bewob8rba6QecAE4ZwHBiUOV/w9cZxiTu',NULL,'2024-11-10 22:47:28','2024-11-10 22:47:28',NULL),(6,'test2',NULL,'test2@test.com',NULL,'$2y$12$NeRtRFSj4JhjB6rffSCy/OcMjRzyTERnwIN9zQ3lDIf4dakvQqcTm',NULL,'2024-11-10 22:50:18','2024-11-10 22:50:18',NULL),(7,'กาก้า',NULL,'sams600211@gmail.com',NULL,'$2y$12$1FbCdw47o4Q4qNZd2wZJruqNA74EBzbBOaws.t6DTPmo4NVnFRfoa','wkq9RXFaNYQJmYQPP7Yjvq0wGml3u0HW2bjl8G0c5XoFfSZbhM6NIPC8osVl','2024-11-17 12:14:14','2024-11-18 11:02:23','1731902543.jpg'),(8,'new',NULL,'zanazxc123456@gmail.com',NULL,'$2y$12$O/yJOtRM.YeyjiVclo/WqOT.W4dobUsGQ3RI1DdR7J.UwvcSwbkky',NULL,'2024-11-17 19:46:55','2024-11-17 19:46:55',NULL),(9,'Tossaporn Khamkawe',NULL,'tossapornza007@gmail.com',NULL,'$2y$12$ZCFqw3.3ZI4tf/BVh1bTceeVupWjpMzPb1Q.PAZupEupX/X36YaMa','Ertnsmlz4OGlO8c665NqS8WOe4r0Ahwt3nV9rnHk0mpmZo31S5aBp3sWV1sq','2024-11-18 00:11:53','2024-11-19 17:28:23','1732012103.png'),(10,'Krissana',NULL,'mikezxc093@gmail.com',NULL,'$2y$12$z.PDrLgXLDphk13vG0t.9udZvArUEE4gW/..lipNFL1dGqZuCeyoi',NULL,'2024-11-18 11:03:00','2024-11-18 11:03:00',NULL),(11,'Sittisak',NULL,'sittisak9963@gmail.com',NULL,'$2y$12$Uc.PWuh75c80G/VjcGnqQ.Vnvmp1NptEeo6ptdNQiSNII7iI3.IWC',NULL,'2024-11-18 11:37:22','2024-11-18 11:37:22',NULL),(12,'ทดสอบ',NULL,'test@gmail.com',NULL,'$2y$12$4RLTOanNCVWgBfMJtyzlg.8EjnJcvbtbv1UJLFwhpIcVt18OL23ia',NULL,'2024-11-18 13:27:57','2024-11-18 13:27:57',NULL),(13,'ภัคจีรา คำแก้ว',NULL,'pakjerazaza12@gmail.com',NULL,'$2y$12$lqkbfGfiMVzcIDO/qqRqMu9j1hj0jq.GKXV1sgbGFkbdlckCqTM1.',NULL,'2024-11-18 20:43:09','2024-11-24 17:42:15','1732444935.jpeg'),(14,'a',NULL,'a@gmail.com',NULL,'$2y$12$aalIz.1mh9qDqRkp3eWthudQNh1OhqqKqmKDmzw8glyBj2fswZ8cq',NULL,'2024-11-19 11:20:31','2024-11-19 11:20:31',NULL),(15,'Sky',NULL,'skyminecraft55529@gmail.com',NULL,'$2y$12$12GGpfhe60X6AuWl53CzQe690t4gytmIf6xB2h4.Y1VFpuKbfOeDa',NULL,'2024-11-19 11:25:50','2024-11-19 11:25:50',NULL),(16,'natthaphol2019',NULL,'natthapholsaeaueng@gmail.com',NULL,'$2y$12$LXG5Wc03RzprU15dwaSHxuhObpypvd44r/mShY8tAIaVCKNopkD7G',NULL,'2024-11-19 14:02:51','2024-11-19 14:03:11','1731999791.png'),(20,'test',NULL,'testtestcom@gmail.com',NULL,'$2y$12$.4IOcDqDHkfIqrLsD.CbluMTTgUXuKnT4QrTDcYhj7Y1LR0Lu87Q6',NULL,'2024-11-21 16:14:04','2024-11-21 16:14:04',NULL),(21,'Galerin',NULL,'jirussa.s.31.1@gmail.com',NULL,'$2y$12$xp4X1WNfpUiESNf.rqsoV.SvbB8sZhppX3a.fpCDnGF2CtGgIZxkm',NULL,'2024-11-22 13:57:13','2024-11-22 14:09:25','1732259365.png'),(22,'Galerin01',NULL,'jirussa7128@hotmail.com',NULL,'$2y$12$8yvvW4ZTiVgQZ88MQugXD.nQOW4k/wtFXKCW7jKvs6Gn2ASkzFLxK',NULL,'2024-11-22 15:30:25','2024-11-22 15:32:52',NULL),(23,'คงกฏ',NULL,'kongkod5595@gmail.com',NULL,'$2y$12$ZRCmzAXFwh2vmGXbN2dggOJyUn0ke.89DBrQddzwdhFqHaOUVmxPi',NULL,'2024-11-23 12:37:04','2024-11-23 12:37:04',NULL),(24,'Seilyne',NULL,'kimtaehyungkookyv@gmail.com',NULL,'$2y$12$z4hdiPNN8R.XusbmNMTWuesDNOwyx9e.aU96ZsfG/ubsLWJflojzW',NULL,'2024-11-23 13:51:00','2024-11-23 13:51:00',NULL),(25,'นายยอดดี',NULL,'jiraphat.05m@gmail.com',NULL,'$2y$12$ianDiZNMf/kvDRV8tHN8bed89DLLXOrOpfgEv99VtwFv/Oh4PcA9i',NULL,'2024-11-26 13:57:37','2024-11-26 13:57:37',NULL),(26,'Whang pee',NULL,'narutood1308@gmail.com',NULL,'$2y$12$.BBrnrHGqouHnnG1.WD9eu/RR676v6D1CCuwsj8C5HTUmncnJ/vW.',NULL,'2024-11-26 13:58:32','2024-11-26 13:58:32',NULL),(27,'test123',NULL,'test123@gmail.com',NULL,'$2y$12$djKDaiGhW.lAUPe0AQYyWehCwMpHKmIEGbPLcutraNXMmcE/6Ix4W',NULL,'2024-11-26 14:09:48','2024-11-26 14:09:48',NULL),(28,'Ririchel',NULL,'suppapsalintip@gmail.com',NULL,'$2y$12$pBno6sJi6fWxZLspK0vN1.dusxdVSX01Mup7.qBW6umxRr24RmGDS',NULL,'2024-11-26 19:37:57','2024-11-26 19:37:57',NULL),(29,'สมนึก แผ้วสว่าง',NULL,'somnuekpaewsawang@gmail.com',NULL,'$2y$12$SHPHKJSw14wY6D8yEsyqgOEIAP0mPQJaDtPIWBXmcvIa9.YNsNkYy',NULL,'2024-11-27 18:43:47','2024-11-27 18:43:47',NULL),(30,'สายพิน รัตนกูล',NULL,'saiphinrattanakun@gmail.com',NULL,'$2y$12$YZmpHmb9dOH7zXCLvJyo6O4B71STSvZ8w9SmFQh1CmX3QShqan396',NULL,'2024-11-27 18:59:54','2024-11-27 18:59:54',NULL),(31,'พิมมาศ สุทธิวงช์',NULL,'phimmatsutthiwong@gmail.com',NULL,'$2y$12$yDLwRj3vcY2AheWS7PF2vOl15uUWOsEN3S0XFWk3Ob8Q.lhIOECrq',NULL,'2024-11-27 19:07:05','2024-11-27 19:07:05',NULL),(32,'สุทธิศักดิ์ สุทธิวงษ์',NULL,'sutthisaksutthiwong@gmail.com',NULL,'$2y$12$V2eAHBeFpdwspXvHUTeEEejgDkBzK3H4jMes/P.KazAWlOXn/shES',NULL,'2024-11-27 19:11:02','2024-11-27 19:11:02',NULL),(33,'พูลผล นครพัฒน์',NULL,'phunphonnakhonphat@gmail.com',NULL,'$2y$12$AZecVJ6y5d2bJIkzUOZcde7cavX/t9y6NdZ5PKcV0eF69hWs8RfK.',NULL,'2024-11-27 19:18:30','2024-11-27 19:18:30',NULL),(34,'ลำจวน เรืองรัฒน์',NULL,'lamchuanrueang@gmail.com',NULL,'$2y$12$OzH70RKuON3OFvf2AHx76uE4u6cKreu2CwfxjntjgDUyB1YC/QT/q',NULL,'2024-11-27 19:21:40','2024-11-27 19:21:40',NULL),(35,'สุชาติ เรืองรัตน์',NULL,'suchatrueangrat@gmail.com',NULL,'$2y$12$q5/nPvwNVFXDw7tFiurLseYMhnpTjiqAmyr6rOSw4i4D4c0zIO1E.',NULL,'2024-11-27 19:23:39','2024-11-27 19:23:39',NULL),(36,'๋ณิชาวรรณ พุทธรักษา',NULL,'nichawanphuttharaksa@gmail.com',NULL,'$2y$12$0q9sg3xl8S.p9ctRnPEWaeAb2gxbOphstCxNgJpjPSfqeXoCneHmG',NULL,'2024-11-27 19:27:25','2024-11-27 19:27:25',NULL),(37,'เนือม พุทธรักษา',NULL,'neomphuttharaksa@gmail.com',NULL,'$2y$12$Y4G9y/k3a0KaFuny.eQage18F9hokZJXlQdZs7A7tEhv9nHzRCvEe',NULL,'2024-11-27 19:30:20','2024-11-27 19:30:20',NULL),(38,'สุจิต เรืองศรี',NULL,'suchitrueangsi@gmail.com',NULL,'$2y$12$mBSridU090Q8VYjEh0IEHec6R57dR2bpqzMCj2swgOPwvZEaIcgJm',NULL,'2024-11-27 19:35:37','2024-11-27 19:35:37',NULL),(39,'ธัญญพัทธ์',NULL,'tanyapat0705@gmail.com',NULL,'$2y$12$q3HFbu7923zEqQYIdQkHa.jGip2aRrGQGOAgybeOnECYmklZbLVUm',NULL,'2024-11-29 10:12:50','2024-11-29 10:12:50',NULL),(69,'Patient','1909701170440',NULL,NULL,'$2y$12$iI45RjTToETcrHXZ/h82suH0EBe3gHy9MaxZXeKj7NJDaAnmy.T5S','goz7oRZTRB7YVuZVsyyyVqIYwHGjCYsYqP4B71QYOusBtxentcStHlNHXUbJ','2024-12-27 08:27:04','2024-12-27 08:27:04',NULL),(70,'Caregiver','1869900569220',NULL,NULL,'$2y$12$RnPki4ihFw47icdujV5ssOJ0SmD5wEy1PvmJssKNUDbjZLk7gW3b2','n1GmhXxQZAp6FMVYJ89G5QRGVg6PshauO55qNUpaZ5fRQuKUhUlP14wz4cSC','2024-12-27 08:27:05','2024-12-27 08:27:05',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
INSERT INTO `visits` VALUES (1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-16 03:51:13',NULL,NULL),(2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-16 17:00:54','2024-11-16 17:00:54','2024-11-16 17:00:54'),(3,'2405:9800:b970:f64c:8937:5c7e:6945:6176','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-17 02:11:48','2024-11-17 02:11:48','2024-11-17 02:11:48'),(4,'2405:9800:b970:f64c:b5f3:e7d2:7f11:3d71','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-17 02:14:55','2024-11-17 02:14:55','2024-11-17 02:14:55'),(5,'1.10.220.33','Mozilla/5.0 (Linux; Android 13; CPH2333 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/484.0.0.68.109;]','2024-11-17 02:16:32','2024-11-17 02:16:32','2024-11-17 02:16:32'),(6,'192.178.8.40','Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)','2024-11-17 02:57:58','2024-11-17 02:57:58','2024-11-17 02:57:58'),(7,'184.22.175.155','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/484.0.0.42.109;FBBV/662558124;FBDV/iPhone12,1;FBMD/iPhone;FBSN/iOS;FBSV/17.7.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-17 02:58:17','2024-11-17 02:58:17','2024-11-17 02:58:17'),(8,'2405:9800:b970:f64c:9c2b:975f:615e:2728','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.8 Mobile/15E148 Safari/604.1','2024-11-17 02:58:30','2024-11-17 02:58:30','2024-11-17 02:58:30'),(9,'184.22.190.230','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36','2024-11-17 08:35:38','2024-11-17 08:35:38','2024-11-17 08:35:38'),(10,'171.97.246.32','Mozilla/5.0 (Linux; Android 13; 2201117TG Build/TKQ1.221114.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.108 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/484.0.0.68.109;]','2024-11-17 11:42:05','2024-11-17 11:42:05','2024-11-17 11:42:05'),(11,'2001:44c8:662c:887e::1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36','2024-11-17 12:14:19','2024-11-17 12:14:19','2024-11-17 12:14:19'),(12,'3.81.217.32','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-11-17 14:59:23','2024-11-17 14:59:23','2024-11-17 14:59:23'),(13,'185.246.175.123','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-17 15:11:12','2024-11-17 15:11:12','2024-11-17 15:11:12'),(14,'152.39.231.69','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-17 15:12:01','2024-11-17 15:12:01','2024-11-17 15:12:01'),(15,'2405:9800:b970:f64c:64f9:df64:4a13:fe52','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.8 Mobile/15E148 Safari/604.1','2024-11-17 15:15:15','2024-11-17 15:15:15','2024-11-17 15:15:15'),(16,'2403:6200:8870:c96f:618b:8ab6:5b91:8167','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0','2024-11-17 19:45:45','2024-11-17 19:45:45','2024-11-17 19:45:45'),(17,'2001:44c8:460c:b06a:1ef:cda8:4e46:74b2','Mozilla/5.0 (Linux; Android 12; V2027) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 VivoBrowser/12.2.0.2','2024-11-17 19:53:20','2024-11-17 19:53:20','2024-11-17 19:53:20'),(18,'2405:9800:b970:f64c:f4c1:3a14:fa2d:9d7a','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-17 20:34:59','2024-11-17 20:34:59','2024-11-17 20:34:59'),(19,'2405:9800:b970:f64c:a9be:6002:f56f:d031','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-17 20:50:16','2024-11-17 20:50:16','2024-11-17 20:50:16'),(20,'44.199.39.34','Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/125.0.6422.26 Safari/537.36','2024-11-17 21:19:25','2024-11-17 21:19:25','2024-11-17 21:19:25'),(21,'118.172.223.189','Mozilla/5.0 (Android 13; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-17 21:20:27','2024-11-17 21:20:27','2024-11-17 21:20:27'),(22,'118.173.185.117','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-17 21:45:46','2024-11-17 21:45:46','2024-11-17 21:45:46'),(23,'2a09:bac5:312b:e64::16f:28','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36','2024-11-17 22:57:01','2024-11-17 22:57:01','2024-11-17 22:57:01'),(24,'2405:9800:b970:f64c:a9be:6002:f56f:d031','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 00:10:52','2024-11-18 00:10:52','2024-11-18 00:10:52'),(25,'223.27.237.4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-11-18 00:11:20','2024-11-18 00:11:20','2024-11-18 00:11:20'),(26,'2405:9800:b970:f64c:b5f3:e7d2:7f11:3d71','Mozilla/5.0 (Linux; Android 13; 2201117TG Build/TKQ1.221114.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.108 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/484.0.0.68.109;]','2024-11-18 00:21:11','2024-11-18 00:21:11','2024-11-18 00:21:11'),(27,'85.254.40.238','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36','2024-11-18 01:44:00','2024-11-18 01:44:00','2024-11-18 01:44:00'),(28,'223.24.62.55','Mozilla/5.0 (Linux; Android 10; vivo 1935 Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 Line/14.18.1/IAB','2024-11-18 07:27:22','2024-11-18 07:27:22','2024-11-18 07:27:22'),(29,'49.229.151.212','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0','2024-11-18 09:06:48','2024-11-18 09:06:48','2024-11-18 09:06:48'),(30,'95.177.180.85','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','2024-11-18 10:11:00','2024-11-18 10:11:00','2024-11-18 10:11:00'),(31,'2001:44c8:432e:6903:4118:f43:f515:be31','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 10:17:42','2024-11-18 10:17:42','2024-11-18 10:17:42'),(32,'2001:44c8:432d:fbdd:50ca:e401:a91d:aaa4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 10:44:37','2024-11-18 10:44:37','2024-11-18 10:44:37'),(33,'2001:44c8:460c:b06a:a02c:34df:cbaf:d381','Mozilla/5.0 (Linux; Android 12; vivo 1920 Build/SP1A.210812.003; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36  [FB_IAB/FB4A;FBAV/481.1.0.74.109;]','2024-11-18 10:45:15','2024-11-18 10:45:15','2024-11-18 10:45:15'),(34,'44.199.39.34','Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/125.0.6422.26 Safari/537.36','2024-11-18 10:51:30','2024-11-18 10:51:30','2024-11-18 10:51:30'),(35,'2001:44c8:432e:6903:51d5:780e:3a6e:d92d','Mozilla/5.0 (Linux; Android 14; 23043RP34G Build/UKQ1.230917.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Safari/537.36 [FB_IAB/FB4A;FBAV/484.0.0.68.109;]','2024-11-18 11:02:25','2024-11-18 11:02:25','2024-11-18 11:02:25'),(36,'2001:44c8:432d:fbdd:51d5:780e:3a6e:d92d','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-18 11:05:06','2024-11-18 11:05:06','2024-11-18 11:05:06'),(37,'2001:44c8:48d3:120d:ea5d:eae:791a:693','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Mobile Safari/537.36','2024-11-18 11:36:13','2024-11-18 11:36:13','2024-11-18 11:36:13'),(38,'49.230.144.200','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-18 12:03:36','2024-11-18 12:03:36','2024-11-18 12:03:36'),(39,'49.229.150.232','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 12:40:04','2024-11-18 12:40:04','2024-11-18 12:40:04'),(40,'2001:44c8:432e:6903:f4d6:540b:b06a:661','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 12:54:29','2024-11-18 12:54:29','2024-11-18 12:54:29'),(41,'2001:44c8:460c:b06a:10bb:fd49:98f5:63cc','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-18 12:59:32','2024-11-18 12:59:32','2024-11-18 12:59:32'),(42,'2001:44c8:460c:b06a:4d77:5748:25bf:a504','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 13:05:38','2024-11-18 13:05:38','2024-11-18 13:05:38'),(43,'49.229.149.7','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 13:27:15','2024-11-18 13:27:15','2024-11-18 13:27:15'),(44,'49.230.145.246','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-18 13:27:43','2024-11-18 13:27:43','2024-11-18 13:27:43'),(45,'106.74.27.105','Mozilla/5.0 (Linux; Android 7.0; SM-G950U Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.6422.26 Mobile Safari/537.36','2024-11-18 13:41:10','2024-11-18 13:41:10','2024-11-18 13:41:10'),(46,'49.229.134.137','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-18 14:44:55','2024-11-18 14:44:55','2024-11-18 14:44:55'),(47,'94.176.49.56','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-18 15:11:21','2024-11-18 15:11:21','2024-11-18 15:11:21'),(48,'92.119.25.241','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-18 15:12:02','2024-11-18 15:12:02','2024-11-18 15:12:02'),(49,'2001:44c8:432b:89dc::','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-18 18:22:04','2024-11-18 18:22:04','2024-11-18 18:22:04'),(50,'198.240.89.186','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-18 19:23:54','2024-11-18 19:23:54','2024-11-18 19:23:54'),(51,'203.109.60.188','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-18 19:32:21','2024-11-18 19:32:21','2024-11-18 19:32:21'),(52,'2405:9800:b970:f64c:ed00:1501:eb60:41cd','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-18 20:05:53','2024-11-18 20:05:53','2024-11-18 20:05:53'),(53,'2405:9800:b970:f64c:9525:4461:f31:695b','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/484.0.0.42.109;FBBV/662558124;FBDV/iPhone12,1;FBMD/iPhone;FBSN/iOS;FBSV/17.7.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-18 20:42:08','2024-11-18 20:42:08','2024-11-18 20:42:08'),(54,'184.22.175.155','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/484.0.0.42.109;FBBV/662558124;FBDV/iPhone12,1;FBMD/iPhone;FBSN/iOS;FBSV/17.7.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-18 20:47:47','2024-11-18 20:47:47','2024-11-18 20:47:47'),(55,'49.237.45.40','Mozilla/5.0 (iPhone; CPU iPhone OS 18_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22A3354 Instagram 357.1.4.36.93 (iPhone13,2; iOS 18_0; en_TH; en; scale=3.00; 1170x2532; 662351939; IABMV/1)','2024-11-18 21:47:17','2024-11-18 21:47:17','2024-11-18 21:47:17'),(56,'149.56.150.80','Mozilla/5.0 (compatible; Dataprovider.com)','2024-11-19 01:16:45','2024-11-19 01:16:45','2024-11-19 01:16:45'),(57,'34.64.196.231','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36','2024-11-19 03:28:50','2024-11-19 03:28:50','2024-11-19 03:28:50'),(58,'2405:9800:b970:f64c:b5f3:e7d2:7f11:3d71','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-19 06:23:19','2024-11-19 06:23:19','2024-11-19 06:23:19'),(59,'205.169.39.20','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36','2024-11-19 06:36:11','2024-11-19 06:36:11','2024-11-19 06:36:11'),(60,'205.169.39.114','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36','2024-11-19 06:36:24','2024-11-19 06:36:24','2024-11-19 06:36:24'),(61,'35.87.218.123','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.19582','2024-11-19 07:40:55','2024-11-19 07:40:55','2024-11-19 07:40:55'),(62,'34.211.141.126','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.19582','2024-11-19 08:50:40','2024-11-19 08:50:40','2024-11-19 08:50:40'),(63,'34.223.254.88','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.19582','2024-11-19 08:52:22','2024-11-19 08:52:22','2024-11-19 08:52:22'),(64,'2001:44c8:4607:2d24:24a1:4a8:1635:d96c','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-19 09:40:07','2024-11-19 09:40:07','2024-11-19 09:40:07'),(65,'66.249.70.7','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/130.0.6723.116 Safari/537.36','2024-11-19 09:45:18','2024-11-19 09:45:18','2024-11-19 09:45:18'),(66,'66.249.64.231','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.6723.116 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','2024-11-19 09:52:00','2024-11-19 09:52:00','2024-11-19 09:52:00'),(67,'66.249.64.230','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/130.0.6723.116 Safari/537.36','2024-11-19 09:52:06','2024-11-19 09:52:06','2024-11-19 09:52:06'),(68,'95.177.180.85','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','2024-11-19 10:12:59','2024-11-19 10:12:59','2024-11-19 10:12:59'),(69,'49.237.9.133','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-19 11:18:55','2024-11-19 11:18:55','2024-11-19 11:18:55'),(70,'2405:9800:ba00:be62:a0a0:9d30:9a23:f145','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-19 11:19:20','2024-11-19 11:19:20','2024-11-19 11:19:20'),(71,'49.231.105.134','Mozilla/5.0 (Linux; Android 14; SM-A546E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36','2024-11-19 11:19:28','2024-11-19 11:19:28','2024-11-19 11:19:28'),(72,'2001:fb1:1:58f7:acde:29e2:cdcf:a109','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/484.0.0.42.109;FBBV/662558124;FBDV/iPhone11,8;FBMD/iPhone;FBSN/iOS;FBSV/16.6.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-19 11:55:03','2024-11-19 11:55:03','2024-11-19 11:55:03'),(73,'49.229.139.93','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-19 12:33:58','2024-11-19 12:33:58','2024-11-19 12:33:58'),(74,'49.231.105.133','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Mobile Safari/537.36','2024-11-19 13:29:34','2024-11-19 13:29:34','2024-11-19 13:29:34'),(75,'2001:44c8:4613:ed49:10cc:4811:4109:f70b','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-19 13:39:00','2024-11-19 13:39:00','2024-11-19 13:39:00'),(76,'2001:fb1:1:58f7:d8a0:8e72:2e00:5171','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-19 14:02:04','2024-11-19 14:02:04','2024-11-19 14:02:04'),(77,'2001:44c8:4284:12a1:3a5e:fb48:480:9fe5','Mozilla/5.0 (Linux; Android 14; CPH2473 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.107 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/484.0.0.68.109;]','2024-11-19 15:06:59','2024-11-19 15:06:59','2024-11-19 15:06:59'),(78,'115.87.249.220','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-19 16:05:55','2024-11-19 16:05:55','2024-11-19 16:05:55'),(79,'34.118.39.249','Mozilla/5.0 (iPhone13,2; U; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) Version/10.0 Mobile/15E148 Safari/602.1','2024-11-19 17:11:31','2024-11-19 17:11:31','2024-11-19 17:11:31'),(80,'66.249.70.8','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.6723.116 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','2024-11-20 03:58:46','2024-11-20 03:58:46','2024-11-20 03:58:46'),(81,'205.169.39.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36','2024-11-20 04:36:30','2024-11-20 04:36:30','2024-11-20 04:36:30'),(82,'205.169.39.157','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36','2024-11-20 08:03:40','2024-11-20 08:03:40','2024-11-20 08:03:40'),(83,'2001:44c8:4612:afd4:7418:b79c:c4d5:bde5','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-20 08:45:08','2024-11-20 08:45:08','2024-11-20 08:45:08'),(84,'2001:44c8:423e:c738:15fb:f5c4:60e7:e407','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-20 09:21:48','2024-11-20 09:21:48','2024-11-20 09:21:48'),(85,'2001:44c8:423e:c738:1530:2704:9e12:b84c','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-20 09:50:47','2024-11-20 09:50:47','2024-11-20 09:50:47'),(86,'95.177.180.85','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','2024-11-20 10:07:11','2024-11-20 10:07:11','2024-11-20 10:07:11'),(87,'202.29.233.125','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-20 13:32:12','2024-11-20 13:32:12','2024-11-20 13:32:12'),(88,'119.12.183.83','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-20 15:10:35','2024-11-20 15:10:35','2024-11-20 15:10:35'),(89,'168.151.134.251','Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/99.0.4844.47 Mobile/15E148 Safari/604.1','2024-11-20 15:11:35','2024-11-20 15:11:35','2024-11-20 15:11:35'),(90,'49.230.160.85','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-20 16:10:51','2024-11-20 16:10:51','2024-11-20 16:10:51'),(91,'27.55.86.206','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-20 23:24:40','2024-11-20 23:24:40','2024-11-20 23:24:40'),(92,'35.93.119.188','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0','2024-11-21 01:46:13','2024-11-21 01:46:13','2024-11-21 01:46:13'),(93,'34.222.109.251','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0','2024-11-21 01:46:43','2024-11-21 01:46:43','2024-11-21 01:46:43'),(94,'27.55.77.41','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0','2024-11-21 08:23:13','2024-11-21 08:23:13','2024-11-21 08:23:13'),(95,'95.177.180.85','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','2024-11-21 10:09:14','2024-11-21 10:09:14','2024-11-21 10:09:14'),(96,'2001:44c8:4612:afd4:6401:bdad:1310:6ced','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-21 10:22:10','2024-11-21 10:22:10','2024-11-21 10:22:10'),(97,'2001:44c8:4612:afd4:452a:2c8:180d:b93','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-21 13:16:06','2024-11-21 13:16:06','2024-11-21 13:16:06'),(98,'2001:44c8:4612:afd4:ac44:6f14:6a50:570','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-21 13:50:50','2024-11-21 13:50:50','2024-11-21 13:50:50'),(99,'1.2.235.71','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-21 14:55:11','2024-11-21 14:55:11','2024-11-21 14:55:11'),(100,'2001:44c8:4612:afd4:3527:3a2a:1906:3002','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-21 19:35:12','2024-11-21 19:35:12','2024-11-21 19:35:12'),(101,'184.22.190.230','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-22 00:02:47','2024-11-22 00:02:47','2024-11-22 00:02:47'),(102,'216.251.130.76','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/121.0.6167.184 Safari/537.36','2024-11-22 04:22:34','2024-11-22 04:22:34','2024-11-22 04:22:34'),(103,'2001:44c8:4612:afd4:40c1:219d:f785:4404','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-22 07:02:33','2024-11-22 07:02:33','2024-11-22 07:02:33'),(104,'95.177.163.4','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1','2024-11-22 10:24:52','2024-11-22 10:24:52','2024-11-22 10:24:52'),(105,'2001:44c8:42e2:2943:4103:34b:a01b:4147','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-22 13:43:09','2024-11-22 13:43:09','2024-11-22 13:43:09'),(106,'2001:44c8:42e2:2943:154:a0e9:d7c5:5d7c','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-22 13:57:40','2024-11-22 13:57:40','2024-11-22 13:57:40'),(107,'52.90.51.19','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-11-22 18:02:02','2024-11-22 18:02:02','2024-11-22 18:02:02'),(108,'2001:44c8:42e2:2943:2dcb:611d:298d:ffff','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-22 20:16:57','2024-11-22 20:16:57','2024-11-22 20:16:57'),(109,'119.13.90.176','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3 like Mac OS X) AppleWebKit/602.1.50 (KHTML, like Gecko) CriOS/56.0.2924.75 Mobile/14E5239e Safari/602.1','2024-11-22 22:05:02','2024-11-22 22:05:02','2024-11-22 22:05:02'),(110,'2001:44c8:42e2:2943:154:a0e9:d7c5:5d7c','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-23 00:13:04','2024-11-23 00:13:04','2024-11-23 00:13:04'),(111,'1.10.221.249','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-23 07:09:10','2024-11-23 07:09:10','2024-11-23 07:09:10'),(112,'2001:44c8:42e2:2943:690d:1df1:970d:ac3','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-23 08:36:52','2024-11-23 08:36:52','2024-11-23 08:36:52'),(113,'2405:9800:b970:f64c:b5f3:e7d2:7f11:3d71','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-23 09:01:30','2024-11-23 09:01:30','2024-11-23 09:01:30'),(114,'2001:44c8:42e2:2943:814a:1605:6bca:1264','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-23 11:57:09','2024-11-23 11:57:09','2024-11-23 11:57:09'),(115,'2001:44c8:42e2:a4de:180a:7c7a:7202:6562','Mozilla/5.0 (Linux; Android 12; V2111 Build/SP1A.210812.003; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.78 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/491.0.0.58.78;IABMV/1;]','2024-11-23 12:35:37','2024-11-23 12:35:37','2024-11-23 12:35:37'),(116,'2001:44c8:42e1:52d0:4c2:f38f:6855:fb28','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1','2024-11-23 13:08:39','2024-11-23 13:08:39','2024-11-23 13:08:39'),(117,'2001:44c8:4606:5027:15fb:f5c4:60e7:e407','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-23 13:37:42','2024-11-23 13:37:42','2024-11-23 13:37:42'),(118,'2001:44c8:422c:fa62:3127:ad3a:9093:1a95','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/21G93 Instagram 358.0.0.33.95 (iPhone14,5; iOS 17_6_1; th_TH; th; scale=3.00; 1170x2532; 663992737)','2024-11-23 13:39:28','2024-11-23 13:39:28','2024-11-23 13:39:28'),(119,'2001:44c8:4537:3680:9cac:f77f:2c67:fe07','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.0 Safari/605.1.15','2024-11-23 13:57:35','2024-11-23 13:57:35','2024-11-23 13:57:35'),(120,'2001:44c8:4854:dd88:15fb:f5c4:60e7:e407','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-23 14:04:02','2024-11-23 14:04:02','2024-11-23 14:04:02'),(121,'2001:44c8:42e2:2943:f8b8:3c90:e2ce:89b5','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-23 15:24:11','2024-11-23 15:24:11','2024-11-23 15:24:11'),(122,'2001:44c8:42e2:2943:858e:6c51:1365:31fd','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-23 16:51:53','2024-11-23 16:51:53','2024-11-23 16:51:53'),(123,'184.22.79.29','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1','2024-11-23 17:37:10','2024-11-23 17:37:10','2024-11-23 17:37:10'),(124,'2001:44c8:4854:dd88:180a:7cdd:6fa9:c388','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-23 17:38:15','2024-11-23 17:38:15','2024-11-23 17:38:15'),(125,'2405:9800:b970:f64c:41c3:b03:6716:9270','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/485.1.0.45.110;FBBV/665337277;FBDV/iPhone12,1;FBMD/iPhone;FBSN/iOS;FBSV/17.7.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-23 17:39:14','2024-11-23 17:39:14','2024-11-23 17:39:14'),(126,'184.22.190.94','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-23 18:36:27','2024-11-23 18:36:27','2024-11-23 18:36:27'),(127,'2405:9800:b970:f64c:4dee:451d:d014:54e','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-23 19:10:49','2024-11-23 19:10:49','2024-11-23 19:10:49'),(128,'2405:9800:b970:f64c:a40d:f20f:729d:d8e8','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-23 19:11:03','2024-11-23 19:11:03','2024-11-23 19:11:03'),(129,'2001:44c8:42e2:2943:f964:41db:442e:2941','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-23 19:37:09','2024-11-23 19:37:09','2024-11-23 19:37:09'),(130,'49.231.225.146','Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/485.1.0.45.110;FBBV/665337277;FBDV/iPhone14,5;FBMD/iPhone;FBSN/iOS;FBSV/18.1.1;FBSS/3;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-23 22:28:58','2024-11-23 22:28:58','2024-11-23 22:28:58'),(131,'2001:44c8:42e2:2943:3902:611c:792:ccb3','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36','2024-11-23 22:37:54','2024-11-23 22:37:54','2024-11-23 22:37:54'),(132,'52.11.111.126','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-24 05:27:33','2024-11-24 05:27:33','2024-11-24 05:27:33'),(133,'2001:44c8:4603:7ede:15fb:f5c4:60e7:e407','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-24 09:26:58','2024-11-24 09:26:58','2024-11-24 09:26:58'),(134,'104.197.69.115','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/125.0.6422.60 Safari/537.36','2024-11-24 09:44:34','2024-11-24 09:44:34','2024-11-24 09:44:34'),(135,'205.169.39.122','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36','2024-11-24 09:44:58','2024-11-24 09:44:58','2024-11-24 09:44:58'),(136,'2001:44c8:42e2:2943:3874:66e9:5e10:2585','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-24 11:37:21','2024-11-24 11:37:21','2024-11-24 11:37:21'),(137,'2405:9800:b970:f64c:c825:6af5:6bde:c199','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-24 14:42:39','2024-11-24 14:42:39','2024-11-24 14:42:39'),(138,'2405:9800:b970:f64c:1016:16f6:b6a6:e5a4','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-24 15:12:48','2024-11-24 15:12:48','2024-11-24 15:12:48'),(139,'2405:9800:b970:f64c:f5d9:91c0:5173:c6dc','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 [FBAN/FBIOS;FBAV/485.1.0.45.110;FBBV/665337277;FBDV/iPhone12,1;FBMD/iPhone;FBSN/iOS;FBSV/17.7.1;FBSS/2;FBCR/;FBID/phone;FBLC/th_TH;FBOP/80]','2024-11-24 17:39:42','2024-11-24 17:39:42','2024-11-24 17:39:42'),(140,'2001:44c8:42e2:2943:204e:c1a6:9fa8:c5c6','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1','2024-11-25 08:05:29','2024-11-25 08:05:29','2024-11-25 08:05:29'),(141,'2001:44c8:42e2:2943:d95b:826d:54e6:bde3','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-25 08:05:58','2024-11-25 08:05:58','2024-11-25 08:05:58'),(142,'49.229.134.138','Mozilla/5.0 (Linux; Android 15; 23078PND5G Build/AP3A.240617.008; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.78 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/491.0.0.58.78;IABMV/1;]','2024-11-25 08:11:30','2024-11-25 08:11:30','2024-11-25 08:11:30'),(143,'27.55.79.156','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-25 11:20:51','2024-11-25 11:20:51','2024-11-25 11:20:51'),(144,'2001:44c8:42e2:2943:e4bc:2c66:c84a:fe17','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-25 11:42:41','2024-11-25 11:42:41','2024-11-25 11:42:41'),(145,'2001:44c8:42e2:2943:311f:e67d:196b:cbb2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-25 15:44:18','2024-11-25 15:44:18','2024-11-25 15:44:18'),(146,'2405:9800:bc30:357f:dde2:3309:c726:df50','Mozilla/5.0 (iPad; CPU OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22B91 Instagram 358.0.0.33.95 (iPad12,1; iPadOS 18_1_1; th_TH; th; scale=2.00; 750x1334; 663992737)','2024-11-25 20:28:26','2024-11-25 20:28:26','2024-11-25 20:28:26'),(147,'2001:44c8:42e2:2943:8cda:70b6:7451:e5ed','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-25 20:29:30','2024-11-25 20:29:30','2024-11-25 20:29:30'),(148,'167.71.11.99','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/121.0.0.0 Safari/537.36','2024-11-26 05:27:50','2024-11-26 05:27:50','2024-11-26 05:27:50'),(149,'2405:9800:b970:f64c:1016:16f6:b6a6:e5a4','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-26 07:57:55','2024-11-26 07:57:55','2024-11-26 07:57:55'),(150,'2001:44c8:423e:a7b:7889:e421:5270:b3e9','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-26 08:47:50','2024-11-26 08:47:50','2024-11-26 08:47:50'),(151,'110.77.141.202','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-26 08:49:43','2024-11-26 08:49:43','2024-11-26 08:49:43'),(152,'2001:44c8:4535:a17f:7436:ec9e:fa28:2a8b','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-26 13:11:14','2024-11-26 13:11:14','2024-11-26 13:11:14'),(153,'2001:44c8:4535:a17f:7490:a1fe:b8b7:9fc4','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-26 13:34:19','2024-11-26 13:34:19','2024-11-26 13:34:19'),(154,'2001:44c8:4535:a17f:9dee:e93f:e559:f4f6','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-26 13:43:05','2024-11-26 13:43:05','2024-11-26 13:43:05'),(155,'2001:44c8:42ea:6627:940f:ebff:fe94:51c','Mozilla/5.0 (Linux; Android 14; 23013PC75G Build/UKQ1.230804.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.78 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/491.0.0.58.78;IABMV/1;]','2024-11-26 13:57:38','2024-11-26 13:57:38','2024-11-26 13:57:38'),(156,'2405:9800:b970:f64c:69a1:5b21:18cd:237','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-26 14:02:15','2024-11-26 14:02:15','2024-11-26 14:02:15'),(157,'49.230.146.132','Mozilla/5.0 (Android 14; Mobile; rv:132.0) Gecko/132.0 Firefox/132.0','2024-11-26 14:07:30','2024-11-26 14:07:30','2024-11-26 14:07:30'),(158,'106.74.27.105','Mozilla/5.0 (Linux; Android 7.0; SM-G950U Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.6422.26 Mobile Safari/537.36','2024-11-26 16:39:22','2024-11-26 16:39:22','2024-11-26 16:39:22'),(159,'2001:44c8:42e2:2943:91c0:dd7c:790d:9a03','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36','2024-11-26 17:02:42','2024-11-26 17:02:42','2024-11-26 17:02:42'),(160,'66.249.82.203','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4590.2 Safari/537.36 Chrome-Lighthouse','2024-11-26 18:21:56','2024-11-26 18:21:56','2024-11-26 18:21:56'),(161,'66.249.82.201','Mozilla/5.0 (Linux; Android 7.0; Moto G (4)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4590.2 Mobile Safari/537.36 Chrome-Lighthouse','2024-11-26 18:21:56','2024-11-26 18:21:56','2024-11-26 18:21:56'),(162,'2405:9800:bc21:1681:c42a:2503:7849:ebab','Mozilla/5.0 (iPad; CPU OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22B91 Instagram 358.0.0.33.95 (iPad12,1; iPadOS 18_1_1; th_TH; th; scale=2.00; 750x1334; 663992737)','2024-11-26 19:27:37','2024-11-26 19:27:37','2024-11-26 19:27:37'),(163,'2405:9800:b970:f64c:bc63:8059:1f0e:80ef','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-26 20:37:14','2024-11-26 20:37:14','2024-11-26 20:37:14'),(164,'202.29.233.125','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-27 01:36:24','2024-11-27 01:36:24','2024-11-27 01:36:24'),(165,'110.77.141.202','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-27 01:45:55','2024-11-27 01:45:55','2024-11-27 01:45:55'),(166,'207.102.138.33','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/123.0.6312.105 Safari/537.36','2024-11-27 06:50:36','2024-11-27 06:50:36','2024-11-27 06:50:36'),(167,'2405:9800:b970:f64c:b96b:78fa:ae8e:dee9','Mozilla/5.0 (iPhone; CPU iPhone OS 17_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/343.0.695551749 Mobile/15E148 Safari/604.1','2024-11-27 09:07:12','2024-11-27 09:07:12','2024-11-27 09:07:12'),(168,'49.229.133.79','Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0','2024-11-27 09:37:56','2024-11-27 09:37:56','2024-11-27 09:37:56'),(169,'2001:44c8:4609:c50b:5563:77ec:f6d9:b260','Mozilla/5.0 (iPad; CPU OS 18_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22A3370 Instagram 358.0.0.33.95 (iPad12,1; iPadOS 18_0_1; th_TH; th; scale=2.00; 750x1334; 663992737)','2024-11-27 10:13:18','2024-11-27 10:13:18','2024-11-27 10:13:18'),(170,'2001:44c8:4609:c50b:61e4:9988:9ee9:aa86','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1','2024-11-27 10:13:47','2024-11-27 10:13:47','2024-11-27 10:13:47'),(171,'1.46.149.64','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Safari/605.1.15','2024-11-27 10:15:31','2024-11-27 10:15:31','2024-11-27 10:15:31'),(172,'1.46.137.115','Mozilla/5.0 (iPhone; CPU iPhone OS 18_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1 Mobile/15E148 Safari/604.1','2024-11-27 10:22:06','2024-11-27 10:22:06','2024-11-27 10:22:06'),(173,'2405:9800:b970:f64c:90b6:fe:e522:2843','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-27 10:22:41','2024-11-27 10:22:41','2024-11-27 10:22:41'),(174,'2001:44c8:42f5:e1f3:4a2:3fbd:c44e:6b2f','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Safari Line/14.19.2','2024-11-27 10:25:32','2024-11-27 10:25:32','2024-11-27 10:25:32'),(175,'2001:44c8:4601:ab05:edae:1eaa:c248:58be','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1','2024-11-27 12:30:16','2024-11-27 12:30:16','2024-11-27 12:30:16'),(176,'2405:9800:b970:f64c:1016:16f6:b6a6:e5a4','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-27 12:53:12','2024-11-27 12:53:12','2024-11-27 12:53:12'),(177,'2001:44c8:460e:f0df:f432:81a6:903f:d00a','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-27 13:01:58','2024-11-27 13:01:58','2024-11-27 13:01:58'),(178,'2001:44c8:4535:a17f:ed60:7493:b29d:657c','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-27 13:33:06','2024-11-27 13:33:06','2024-11-27 13:33:06'),(179,'35.84.134.13','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-11-27 22:46:12','2024-11-27 22:46:12','2024-11-27 22:46:12'),(180,'2001:44c8:460e:f0df:6023:fe2a:7c33:64f8','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-28 08:37:38','2024-11-28 08:37:38','2024-11-28 08:37:38'),(181,'2001:44c8:460e:f0df:1855:1d6b:1ffc:b7a8','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-28 08:46:18','2024-11-28 08:46:18','2024-11-28 08:46:18'),(182,'110.77.141.202','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-28 08:49:42','2024-11-28 08:49:42','2024-11-28 08:49:42'),(183,'2001:44c8:460e:f0df:b968:7a29:c0bf:9a0e','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-28 10:24:18','2024-11-28 10:24:18','2024-11-28 10:24:18'),(184,'202.29.233.125','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-28 12:18:01','2024-11-28 12:18:01','2024-11-28 12:18:01'),(185,'2001:44c8:460e:f0df:9dc9:6cc4:c8e7:c1d4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-28 13:14:25','2024-11-28 13:14:25','2024-11-28 13:14:25'),(186,'35.91.13.154','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-11-28 22:22:16','2024-11-28 22:22:16','2024-11-28 22:22:16'),(187,'2001:44c8:432b:8094:b891:cfe8:add4:f198','Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0','2024-11-29 07:12:39','2024-11-29 07:12:39','2024-11-29 07:12:39'),(188,'2001:44c8:432b:8094:c938:df25:ba88:6629','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15','2024-11-29 07:12:40','2024-11-29 07:12:40','2024-11-29 07:12:40'),(189,'2001:44c8:432b:8094:30c0:b6c:e4c7:e3d6','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15','2024-11-29 07:23:58','2024-11-29 07:23:58','2024-11-29 07:23:58'),(190,'2001:44c8:4539:8eee:b516:1b8f:517f:81f3','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15','2024-11-29 08:38:18','2024-11-29 08:38:18','2024-11-29 08:38:18'),(191,'2001:44c8:4539:8eee:b891:cfe8:add4:f198','Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0','2024-11-29 08:54:49','2024-11-29 08:54:49','2024-11-29 08:54:49'),(192,'2001:44c8:4539:8eee:4978:549c:c86f:ffd3','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-11-29 08:55:25','2024-11-29 08:55:25','2024-11-29 08:55:25'),(193,'2001:44c8:4603:acd2:c1e6:c74:93ee:dc1e','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-29 08:57:36','2024-11-29 08:57:36','2024-11-29 08:57:36'),(194,'2001:44c8:4603:acd2:b1d1:9661:5af2:cd01','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-29 09:47:09','2024-11-29 09:47:09','2024-11-29 09:47:09'),(195,'2001:44c8:4539:8eee:180c:4b4f:3549:cb0d','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-29 09:52:06','2024-11-29 09:52:06','2024-11-29 09:52:06'),(196,'182.232.224.109','Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1','2024-11-29 10:12:21','2024-11-29 10:12:21','2024-11-29 10:12:21'),(197,'2001:44c8:4539:8eee:48ca:7d6:1d11:b119','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15','2024-11-29 10:17:34','2024-11-29 10:17:34','2024-11-29 10:17:34'),(198,'2001:44c8:4603:acd2:9d90:6689:b1ca:c3ce','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-29 10:28:45','2024-11-29 10:28:45','2024-11-29 10:28:45'),(199,'49.230.53.40','Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0','2024-11-29 11:01:06','2024-11-29 11:01:06','2024-11-29 11:01:06'),(200,'2001:44c8:4603:acd2:c0a7:309b:4856:6967','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-29 11:01:23','2024-11-29 11:01:23','2024-11-29 11:01:23'),(201,'223.24.153.14','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.5 Mobile/15E148 Safari/604.1','2024-11-29 11:02:36','2024-11-29 11:02:36','2024-11-29 11:02:36'),(202,'2001:44c8:423e:c46:7018:a7ff:fe8e:691c','Mozilla/5.0 (Linux; Android 14; CPH2529 Build/UKQ1.230924.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/130.0.6723.108 Mobile Safari/537.36 Line/14.19.1/IAB','2024-11-29 11:42:44','2024-11-29 11:42:44','2024-11-29 11:42:44'),(203,'2001:44c8:42e4:8a04:90ce:c3f3:62ee:c40e','Mozilla/5.0 (iPhone; CPU iPhone OS 16_7_10 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1','2024-11-29 13:30:13','2024-11-29 13:30:13','2024-11-29 13:30:13'),(204,'223.24.92.244','Mozilla/5.0 (iPhone; CPU iPhone OS 18_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1 Mobile/15E148 Safari/604.1','2024-11-29 13:40:28','2024-11-29 13:40:28','2024-11-29 13:40:28'),(205,'2001:44c8:4539:8eee:9d90:6689:b1ca:c3ce','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-11-29 13:55:44','2024-11-29 13:55:44','2024-11-29 13:55:44'),(206,'2001:44c8:4539:8eee:dc0d:52f3:73c8:7cad','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Safari/605.1.15','2024-11-29 14:09:16','2024-11-29 14:09:16','2024-11-29 14:09:16'),(207,'118.173.201.204','Mozilla/5.0 (X11; Linux x86_64; rv:133.0) Gecko/20100101 Firefox/133.0','2024-11-29 19:43:14','2024-11-29 19:43:14','2024-11-29 19:43:14'),(208,'34.221.93.75','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-11-29 22:36:36','2024-11-29 22:36:36','2024-11-29 22:36:36'),(209,'2001:44c8:4603:acd2:cc23:9d5d:9290:a51d','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-11-30 10:33:10','2024-11-30 10:33:10','2024-11-30 10:33:10'),(210,'2001:44c8:4603:acd2:c0a7:309b:4856:6967','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-11-30 11:22:23','2024-11-30 11:22:23','2024-11-30 11:22:23'),(211,'34.223.43.68','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-11-30 22:34:47','2024-11-30 22:34:47','2024-11-30 22:34:47'),(212,'49.237.5.9','Mozilla/5.0 (iPad; CPU OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/131.0.6778.73 Mobile/15E148 Safari/604.1','2024-11-30 23:15:55','2024-11-30 23:15:55','2024-11-30 23:15:55'),(213,'223.24.168.106','Mozilla/5.0 (iPad; CPU OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/131.0.6778.73 Mobile/15E148 Safari/604.1','2024-11-30 23:50:17','2024-11-30 23:50:17','2024-11-30 23:50:17'),(214,'31.204.150.139','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-01 06:52:39','2024-12-01 06:52:39','2024-12-01 06:52:39'),(215,'118.173.203.24','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-01 09:16:41','2024-12-01 09:16:41','2024-12-01 09:16:41'),(216,'2001:44c8:4603:d20a:ddc2:d437:c5c7:bfe4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','2024-12-01 11:42:56','2024-12-01 11:42:56','2024-12-01 11:42:56'),(217,'2405:9800:b970:f64c:8052:7330:df0b:b77d','Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1','2024-12-01 15:53:05','2024-12-01 15:53:05','2024-12-01 15:53:05'),(218,'2405:9800:b970:f64c:d9db:8b6f:77bd:9a71','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-01 15:57:13','2024-12-01 15:57:13','2024-12-01 15:57:13'),(219,'66.249.77.134','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.69 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','2024-12-01 22:22:42','2024-12-01 22:22:42','2024-12-01 22:22:42'),(220,'66.249.71.134','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.69 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','2024-12-01 22:22:44','2024-12-01 22:22:44','2024-12-01 22:22:44'),(221,'2001:44c8:4603:d20a:11b6:d3d6:2a7:f11b','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-12-01 22:33:14','2024-12-01 22:33:14','2024-12-01 22:33:14'),(222,'66.249.75.228','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/131.0.6778.69 Safari/537.36','2024-12-01 22:44:25','2024-12-01 22:44:25','2024-12-01 22:44:25'),(223,'54.218.8.27','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-01 23:08:51','2024-12-01 23:08:51','2024-12-01 23:08:51'),(224,'2001:44c8:4603:d20a:5301:dff2:1a8b:8a43','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-12-02 09:52:15','2024-12-02 09:52:15','2024-12-02 09:52:15'),(225,'125.24.128.65','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-02 17:57:16','2024-12-02 17:57:16','2024-12-02 17:57:16'),(226,'3.94.208.115','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-12-02 21:42:30','2024-12-02 21:42:30','2024-12-02 21:42:30'),(227,'35.93.110.100','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-02 21:58:40','2024-12-02 21:58:40','2024-12-02 21:58:40'),(228,'2001:44c8:4603:d20a:f477:743:2b4d:5a3e','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-12-03 07:46:15','2024-12-03 07:46:15','2024-12-03 07:46:15'),(229,'223.24.166.141','Mozilla/5.0 (Linux; Android 10; vivo 1935) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 VivoBrowser/13.2.3.0','2024-12-03 15:46:40','2024-12-03 15:46:40','2024-12-03 15:46:40'),(230,'27.55.83.27','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/340.3.689937600 Mobile/15E148 Safari/604.1','2024-12-03 19:53:55','2024-12-03 19:53:55','2024-12-03 19:53:55'),(231,'2001:44c8:4603:d20a:3947:bbe3:1803:632','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2024-12-03 21:12:06','2024-12-03 21:12:06','2024-12-03 21:12:06'),(232,'223.24.164.73','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/340.3.689937600 Mobile/15E148 Safari/604.1','2024-12-04 06:53:25','2024-12-04 06:53:25','2024-12-04 06:53:25'),(233,'2001:44c8:4603:d20a:307:83c2:8a6f:9559','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-12-04 08:36:19','2024-12-04 08:36:19','2024-12-04 08:36:19'),(234,'2001:44c8:4603:d20a:7908:f8b3:ddbb:c92f','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-04 08:40:40','2024-12-04 08:40:40','2024-12-04 08:40:40'),(235,'2001:44c8:4603:d20a:6164:a74c:fe5e:4ee4','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-04 08:46:44','2024-12-04 08:46:44','2024-12-04 08:46:44'),(236,'2405:9800:b970:f64c:49dc:ae43:b5d1:64dc','Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1','2024-12-04 10:56:39','2024-12-04 10:56:39','2024-12-04 10:56:39'),(237,'202.44.38.245','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.0 Safari/605.1.15','2024-12-04 15:08:10','2024-12-04 15:08:10','2024-12-04 15:08:10'),(238,'223.24.62.131','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/340.3.689937600 Mobile/15E148 Safari/604.1','2024-12-04 18:06:17','2024-12-04 18:06:17','2024-12-04 18:06:17'),(239,'27.55.76.76','Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/340.3.689937600 Mobile/15E148 Safari/604.1','2024-12-05 06:47:30','2024-12-05 06:47:30','2024-12-05 06:47:30'),(240,'118.173.31.96','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-05 09:33:33','2024-12-05 09:33:33','2024-12-05 09:33:33'),(241,'2001:44c8:423c:712:e4d3:445b:83ea:2325','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-06 13:33:57','2024-12-06 13:33:57','2024-12-06 13:33:57'),(242,'2405:9800:b970:f64c:f048:20e4:52:3540','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-06 19:05:11','2024-12-06 19:05:11','2024-12-06 19:05:11'),(243,'35.87.160.204','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-06 22:43:42','2024-12-06 22:43:42','2024-12-06 22:43:42'),(244,'118.173.31.72','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-07 12:33:01','2024-12-07 12:33:01','2024-12-07 12:33:01'),(245,'184.22.175.137','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-07 20:00:28','2024-12-07 20:00:28','2024-12-07 20:00:28'),(246,'205.169.39.19','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36','2024-12-07 21:03:30','2024-12-07 21:03:30','2024-12-07 21:03:30'),(247,'54.71.38.249','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-07 22:14:19','2024-12-07 22:14:19','2024-12-07 22:14:19'),(248,'44.198.165.238','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-12-08 11:11:37','2024-12-08 11:11:37','2024-12-08 11:11:37'),(249,'118.172.240.112','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-08 14:35:42','2024-12-08 14:35:42','2024-12-08 14:35:42'),(250,'34.211.145.158','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-08 22:26:05','2024-12-08 22:26:05','2024-12-08 22:26:05'),(251,'118.172.240.112','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-09 00:30:04','2024-12-09 00:30:04','2024-12-09 00:30:04'),(252,'184.22.175.137','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-10 11:19:43','2024-12-10 11:19:43','2024-12-10 11:19:43'),(253,'35.80.5.247','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-10 22:54:18','2024-12-10 22:54:18','2024-12-10 22:54:18'),(254,'2001:44c8:4605:2b69:1ea:3e14:abc2:f7bd','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36','2024-12-11 15:31:03','2024-12-11 15:31:03','2024-12-11 15:31:03'),(255,'35.89.33.75','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-11 22:21:21','2024-12-11 22:21:21','2024-12-11 22:21:21'),(256,'66.249.71.34','Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.69 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)','2024-12-12 13:25:53','2024-12-12 13:25:53','2024-12-12 13:25:53'),(257,'66.249.66.81','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/131.0.6778.69 Safari/537.36','2024-12-12 13:32:49','2024-12-12 13:32:49','2024-12-12 13:32:49'),(258,'35.84.38.173','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-12 22:51:18','2024-12-12 22:51:18','2024-12-12 22:51:18'),(259,'110.77.141.202','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-13 11:49:30','2024-12-13 11:49:30','2024-12-13 11:49:30'),(260,'2001:44c8:4857:24bd:e898:2f6c:3add:9699','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-13 11:53:21','2024-12-13 11:53:21','2024-12-13 11:53:21'),(261,'2001:44c8:4857:24bd:8d13:6dc7:2204:5cf2','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-13 13:37:16','2024-12-13 13:37:16','2024-12-13 13:37:16'),(262,'18.235.3.96','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','2024-12-13 18:26:48','2024-12-13 18:26:48','2024-12-13 18:26:48'),(263,'35.93.21.16','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-13 23:28:26','2024-12-13 23:28:26','2024-12-13 23:28:26'),(264,'44.234.117.5','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-14 22:02:05','2024-12-14 22:02:05','2024-12-14 22:02:05'),(265,'35.86.214.112','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/68.0.3440.106 Safari/537.36','2024-12-15 22:15:37','2024-12-15 22:15:37','2024-12-15 22:15:37'),(266,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-19 02:06:45','2024-12-19 02:06:45','2024-12-19 02:06:45'),(267,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-24 01:48:18','2024-12-24 01:48:18','2024-12-24 01:48:18'),(268,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-25 07:25:43','2024-12-25 07:25:43','2024-12-25 07:25:43'),(269,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-26 01:19:34','2024-12-26 01:19:34','2024-12-26 01:19:34'),(270,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-27 02:00:56','2024-12-27 02:00:56','2024-12-27 02:00:56'),(271,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2024-12-31 05:16:49','2024-12-31 05:16:49','2024-12-31 05:16:49'),(272,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2025-01-01 06:25:04','2025-01-01 06:25:04','2025-01-01 06:25:04'),(273,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2025-01-04 08:42:15','2025-01-04 08:42:15','2025-01-04 08:42:15'),(274,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2025-01-05 04:26:18','2025-01-05 04:26:18','2025-01-05 04:26:18'),(275,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0','2025-01-05 17:35:16','2025-01-05 17:35:16','2025-01-05 17:35:16'),(276,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','2025-01-07 01:20:25','2025-01-07 01:20:25','2025-01-07 01:20:25');
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-08  8:47:25
