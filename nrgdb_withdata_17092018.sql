-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: nrg_db
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mngemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conferenceid` int(11) unsigned DEFAULT NULL,
  `confname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confstart` date DEFAULT NULL,
  `confend` date DEFAULT NULL,
  `confurl` text COLLATE utf8mb4_unicode_ci,
  `travelstart` date DEFAULT NULL,
  `travelend` date DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `benefits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `link` longtext COLLATE utf8mb4_unicode_ci,
  `admin_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_remarks` text COLLATE utf8mb4_unicode_ci,
  `status_m` enum('Pending','Approved','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `status_sm` enum('Pending','Approved','Rejected','Deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `another_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `another_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_frequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees_travelling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliverables` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsoring_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conferenceid` (`conferenceid`),
  CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`conferenceid`) REFERENCES `conference` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply`
--

LOCK TABLES `apply` WRITE;
/*!40000 ALTER TABLE `apply` DISABLE KEYS */;
INSERT INTO `apply` VALUES (1,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',3,'Angular Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Attending','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6IkVqODI4czdRRHRrZU8xRm9aSEliakE9PSIsInZhbHVlIjoidjA2SkI1QlVLRThMeDNOOVJrbjZEZz09IiwibWFjIjoiOTY4ZDA4OWFhYmVjNTlmYmM5ZjE3NDc5MjFmN2I0OTY2YzE0OTg1YzEwNTY4ZDkwNzJlZTEzYmU1ZTE1NDg0OSJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:41:40',NULL,0,NULL,'(822)034-1179','(822)034-1179','kayalvizhi.manavalan@excelenciaconsulting.com','LOY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(2,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',1,'Oracle Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-18','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6Ik92dUlsOG9FRmpBeGNOb3FGZW5KOGc9PSIsInZhbHVlIjoiSFNjRGZHdThSZHExYTVBMEZVNUtcL1E9PSIsIm1hYyI6IjM4NzhiNzkyMzdmZTYyMzIyYzliY2NmYjRkOTkzMjYyYjFiZGE1ZGIyOTg0MjRlNDg0ZGY0MmI5MWQzMTI3ZDMifQ==',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:09:30',NULL,0,NULL,'(822)034-1179','(822)034-1179','kayalvizhi.manavalan@excelenciaconsulting.com','OAY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(3,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',2,'Selenium Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Attending','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6Ik9ZclNJODZBXC8yUG9aOUdUUXprWFl3PT0iLCJ2YWx1ZSI6ImhpZURWKytrelQ1SE5aSGhaSVk5MFE9PSIsIm1hYyI6IjliNjg2ODljNTFjZDk1YWQyOTk0YWQxNDQwMWQyNzhmMTI3ODgzYjgzYjMyMGU1NTgwMTU0NmE3Njk2Njc1ZDEifQ==',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:09:22',NULL,0,NULL,'(822)034-1179','(822)034-1179','kayalvizhi.manavalan@excelenciaconsulting.com','MTY','213','133','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123'),(4,2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',2,'Selenium Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Speaking','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6InFXcm1ZZEd3T2Y0UUhub0MrcUsrbVE9PSIsInZhbHVlIjoiOVdmdVFPbElGNzZyb29ETHMxZUxDdz09IiwibWFjIjoiOTViNGM0MmE2NjYyOWU0YjdkMWI0OTU4YTI2Y2E1NDY1Y2VjZTAyOGQ2MjEzZmMwNTYzYmU5YzkzNmY0MThkMiJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:12:05',NULL,0,NULL,'(994)414-5573','(994)414-5573','','LOY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123'),(5,2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',1,'Oracle Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6InlsTFRlTzJaQUVsdHd1RUVBMEtcL3lRPT0iLCJ2YWx1ZSI6IlwvbGgxZ3FtS05kNCtkbk5seHpacFNRPT0iLCJtYWMiOiI4MThjM2I2YTU5NTRiYTVhMGI3N2Q4YWE2ZTdkMjhlMmNjMjNiYjg5ZjE3MDAwMTNjODBjMzM1NTkzZDNmOGQ4In0=',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:12:01',NULL,0,NULL,'(994)414-5573','(994)414-5573','','MTY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(6,2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',3,'Angular Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6IkNsaUxFR2dkanluclhrVGNVaDFweEE9PSIsInZhbHVlIjoiM2c1SHlIdjNlU0hPR2hmdTVKN2x1Zz09IiwibWFjIjoiMjRmZjhiOGRlYTg3MjRlMzc5ODAxMWFlNjBmZWE1Nzg1MjkwZGI0OGVjNmVjMDMzNDRiOGFkYzUzNzVkYjg2MSJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:41:40',NULL,0,NULL,'(994)414-5573','(994)414-5573','','LOY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(7,3,'Karthiga','Babu','karthiga.babu@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',2,'Selenium Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6IjF6d3RSamFFUmlPbjdKV0o5blFvUVE9PSIsInZhbHVlIjoicWtmbGFQamI3b2R1akplTTUyTjlKZz09IiwibWFjIjoiOWI4ZWZiN2E3NDk5OTA2MDNhYTBlNGFhOWZkNWY2YTE5MjA3ZWM0NTdlMTRlYjc4YjJhNjU3MWE1MDk5MjUyZCJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:11:54',NULL,0,NULL,'(801)569-3305','(801)569-3305','','OAY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123'),(8,3,'Karthiga','Babu','karthiga.babu@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',1,'Oracle Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Attending','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6ImZ4RGY3QTJDaktUemNzMVhrSXoxcHc9PSIsInZhbHVlIjoiV1VZY2x3ajNUYlZKQjZUbndldFwvUHc9PSIsIm1hYyI6ImFjYzI0YTIxMTU0YTg0NDEwZjEyNzZmMTkyMTE1ZjVhY2I5Nzc3M2RmMjY1NjcwZThlNjQxOTkzYzU5ZWJkMTMifQ==',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 08:11:26',NULL,0,NULL,'(801)569-3305','(801)569-3305','','LOY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(9,3,'Karthiga','Babu','karthiga.babu@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',3,'Angular Conference','2018-09-17','2018-09-18','http://www.nrg.com','2018-09-17','2018-09-19','Attending','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6ImpZd3Y3TVdFUUVkeWhDQlYxMjhsYUE9PSIsInZhbHVlIjoiOVhkNXdYb2h1ZkJJR0RWUjM2Q2N5Zz09IiwibWFjIjoiMGFiZTUwMmE0MjA3ZjliYjIzOWVmM2ViMDIxNDdmNGJiMDgxOGNiZTQxZmZjNDdiZjg4MWU1MDE2MGNlMGNjOSJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:41:40',NULL,0,NULL,'(801)569-3305','(801)569-3305','','OAY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(10,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',4,'AI Conference','2018-09-17','2018-09-17','http://www.nrg.com','2018-09-17','2018-09-20','Speaking','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6InZ5ZEtkSUt6dnhneDNOYUdoclRqTmc9PSIsInZhbHVlIjoib3FjYmdHQmRuVmgwak95V2pvTFZHQT09IiwibWFjIjoiNWQyZWZkNmY4MjNlOTE0NDcwNzFiMDFjYzRiMWNkNTkzMzE4Mjk0MTEyMTgwMDFhMmJhMGZiNTcyNjI3YjhjMSJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:05:21',NULL,0,NULL,'(822)034-1179','(822)034-1179','kayalvizhi.manavalan@excelenciaconsulting.com','MTY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(11,2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',4,'AI Conference','2018-09-17','2018-09-17','http://www.nrg.com','1970-01-01','1970-01-01','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6InBVZWxxd3E5Q3A3bGJNNm9XZEdtRHc9PSIsInZhbHVlIjoiVm5RYWMxbmhub1J5d2hIclltMVwvc2c9PSIsIm1hYyI6IjcwNDkzZjEwZjFlZjEwMjk2N2QxYzQ5NDMyNGEzYWIzN2UzNWU0MjU1ZGQ1OWYwZmI3MzY3ZTcxMDZiNTM1ZmQifQ==',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:10:39',NULL,0,NULL,'(994)414-5573','(994)414-5573','','OAY','234','','Chennai','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Other industry/vertical focus not mentioned above','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(12,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',7,'Business Intelligence','2018-09-17','2018-09-17','http://www.nrg.com','1970-01-01','1970-01-01','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6IlwvNDdkcW5La2JLTTZ2S1ZqXC9aeDhKdz09IiwidmFsdWUiOiJHZWhVUzNzXC9aRjJaZ1lyZURndGd1dz09IiwibWFjIjoiYjMwMDZlODBhZWI4MjE1MGI2NDYyNmJhNDQ3NjQzNjJkOGZmYzM3ZDAxZTQ0ZTVmNThhMjM4MzNhMmNjMDkwYiJ9','You have another meeting on that day',NULL,'Pending','Rejected',NULL,'2018-09-17 09:21:59',NULL,0,NULL,'(822)034-1179','','','OAY','213','','Chennai','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(13,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',8,'People Analytics','2018-09-17','2018-09-17','http://www.nrg.com','2018-09-17','2018-09-17','Sponsoring','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','eyJpdiI6ImRjbVV0OVR3ZjI4cDd2S2wxZDgxSGc9PSIsInZhbHVlIjoicnFaYVJMXC9cL1hDTXJoYnpEMmpEYmRnPT0iLCJtYWMiOiIwY2Q1ZjQ1NTQ5MTdlYmVhOTk2ODA0NTVhYTJkNTk1NTUwYThkMTkwMTRjM2Q5ODQ4ODU3YzZmZjc5OWUwNzcwIn0=',NULL,'Many of them are attending the same','Rejected','Approved',NULL,'2018-09-17 09:26:07',NULL,0,NULL,'(822)034-1179','','','MTY','123','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Option 3','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123'),(14,1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',9,'Reports Manipulation Conference','2018-09-17','2018-09-17','http://www.nrg.com','2018-09-17','2018-09-17','Exhibiting','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','eyJpdiI6InVTTGhSYXA1T3hpS0gyV0dmb2F2MHc9PSIsInZhbHVlIjoiSzNhUDFsbkNObFVtZllwMFI4d1R5UT09IiwibWFjIjoiYWUyMzc4OTcwZTllYTRlZmI5YzUyYjM2MzEwNmI0YzQ0NmIxZjU2YWZiMTc4OTVlYWVlYzQzZjE0MTBiODBkMiJ9',NULL,NULL,'Approved','Approved',NULL,'2018-09-17 09:29:48',NULL,0,NULL,'(822)034-1179','','','OAY','12412','123','Chennai','Chennai','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 2','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h',''),(15,2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',9,'Reports Manipulation Conference','2018-09-17','2018-09-17','http://www.nrg.com','2018-09-17','2018-09-19','Sponsoring','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','eyJpdiI6Ikt6cGRDZXphZE5naGtSVEF0K2R0M2c9PSIsInZhbHVlIjoiQmI5M2ZiY1AwclBHWW13T0EyZGV5dz09IiwibWFjIjoiN2IwMDNkMGIyMWJhYjIyZWFjZWM3ZmJkMzg2M2QxNDFkMDFjNGY5YTJjZWM4ODVkZTUwODQzZDUzMTg4OTY2OCJ9',NULL,NULL,'Pending','Pending',NULL,'2018-09-17 09:44:54',NULL,0,NULL,'(994)414-5573','(994)414-5573','','LOY','123','123','Chennai','Chennai','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','Option 3','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','123'),(16,3,'Karthiga','Babu','karthiga.babu@excelenciaconsulting.com','kayalvizhi.manavalan@gmail.com',8,'People Analytics','2018-09-17','2018-09-17','http://www.nrg.com','2018-09-17','2018-09-20','Attending','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','','eyJpdiI6IlpOMHVYVDVneEppZG1HNW9FajY1Q1E9PSIsInZhbHVlIjoiN1ZBYVpHb1NcL2x1V3hiMXBKRjBMM1E9PSIsIm1hYyI6Ijg3Y2YzNjRjNzBlNDY3Y2VjMzA1YjhlMGNjZWUzNGE4NzQwYTc1ZDA2ZDMyMzg0N2JkN2YyNWI3YzhhZDc0MTcifQ==',NULL,NULL,'Pending','Pending',NULL,'2018-09-17 09:45:38',NULL,0,NULL,'(801)569-3305','(801)569-3305','','OAY','233','','Chennai','','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','','Option 3','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','');
/*!40000 ALTER TABLE `apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conference` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conferencename` varchar(355) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conferenceurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency` enum('LOY','OAY','MTY') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `salesforce_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_sm` enum('Pending','Approved','Rejected','Deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `sm_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conference_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conf_start` date DEFAULT NULL,
  `travel_start` date DEFAULT NULL,
  `conf_end` date DEFAULT NULL,
  `travel_end` date DEFAULT NULL,
  `travel_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrg_past` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees_travelling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsoring_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliverables` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conference`
--

LOCK TABLES `conference` WRITE;
/*!40000 ALTER TABLE `conference` DISABLE KEYS */;
INSERT INTO `conference` VALUES (1,'Oracle Conference','http://www.nrg.com','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',1,'Option 1','LOY','eyJpdiI6ImpDKzFEVm5KWnpiSTQ3dkpXV01wV0E9PSIsInZhbHVlIjoiczk1bjhBVWZFN2pHZ2dhcGdVSzd2Zz09IiwibWFjIjoiZjI1MGIxOWI1OWRiNTgyNWM0NGQ1M2NjYTQyODM1OGNlMWQzMWFjM2ZhYzFmYjcyNmMzY2JlNDRiYzAxNjNhNyJ9',0,NULL,'Approved',NULL,NULL,'2018-09-17 07:58:16',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-18','2018-09-19','123','Chennai','Yes','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','Attending','','','','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i','kayalvizhi.manavalan@excelenciaconsulting.com'),(2,'Selenium Conference','http://www.nrg.com','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.',2,'Option 2','OAY','eyJpdiI6IlBUa1VPVzdCekxwVVluRzJDNGo1aEE9PSIsInZhbHVlIjoiTGhKZndzdHdXQWVnWUFFcEZUYWJKdz09IiwibWFjIjoiNDdkOGM1MDI4OWVmZWM2ZDkwMWY2MzQ3NDQzZmUyNjIwNzhjZDg5ZDcxMWEzOWNiZDA4MTMzZDE4M2FmYWUwNCJ9',0,NULL,'Approved',NULL,NULL,'2018-09-17 07:58:16',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-18','2018-09-17','123','Chennai','Yes','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','Sponsoring','123','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volupta','kaviyarasan.sadasivam@excelenciaconsulting.com'),(3,'Angular Conference','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',3,'Option 2','MTY','eyJpdiI6IkRGTmVMVHFjVlpTaWtiWms5cFdkTXc9PSIsInZhbHVlIjoiUExzN01PcnZ4M1Q5NTNSd25scEZGZz09IiwibWFjIjoiMTdiNTc2YTdiODZlZGFhNjUzOWRiNThhNzY0ZjA2MmE0MmZhMGYyMDBjNTQ1ODQ5NDA5YTlhYWJjMTljZGZlZSJ9',0,NULL,'Approved',NULL,NULL,'2018-09-17 09:40:36',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-18','2018-09-17','123','Chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Exhibiting','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','karthiga.babu@excelenciaconsulting.com'),(4,'AI Conference','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Option 2','LOY','eyJpdiI6IlwvMHhFalBJRm1BWWFySFViYlhxbFdBPT0iLCJ2YWx1ZSI6IkQxRVF2WU5iMjZsOFFSTlZCYnc0MHc9PSIsIm1hYyI6IjQzM2QwZmIxMWRlZTM1YmQ1Yzc0NjU1NTE1NGY3ODliZGM3ODYwOTYyMzUzMjg4MjZiY2VhZDEzY2Q2Y2Y4ZDkifQ==',0,NULL,'Approved',NULL,NULL,'2018-09-17 09:04:00',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','123','Chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Exhibiting','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(5,'User Intelligence/ Experience Conference','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Option 3','LOY','eyJpdiI6IkNjZmIwSDIyY0hLVlA2dU9PYU5xRmc9PSIsInZhbHVlIjoiSUdpdENlSU1zeGFzKzk2dkNBTzFIZz09IiwibWFjIjoiNjAyNGRkNTlkOWI4OGE0YTIwOTIzYzQ5YjE4MDM0ZjRkMTJlNmRkYzYzNDI3NjY5YTVmZmU3NDRjNjBkYzQ1MCJ9',0,NULL,'Rejected','Conference is not relevant',NULL,'2018-09-17 09:18:45',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','123','chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Exhibiting','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(6,'Power Electronics Conference','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Option 2','LOY','eyJpdiI6Imc3XC9vTDZQK2NhK0QxRWIzZTFaNVp3PT0iLCJ2YWx1ZSI6IldmUEt1aVg3WFwvNmxlZVE1Y29pOVwvdz09IiwibWFjIjoiMmJlOTc3NWNmZmJkMDJmNWJmY2ZlOWNiNmZkNWI2ODBiOTRiNTMzN2E4ODhlNjEwMzAyZTUzZjIyNzk3M2RiZSJ9',0,NULL,'Rejected','Conference is not relevant',NULL,'2018-09-17 09:17:52',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','234','chennai','No','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Attending','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(7,'Business Intelligence','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Other industry/vertical focus not mentioned above','LOY','eyJpdiI6InpqMFZaYWppZmIraXBnSGYwNklIb3c9PSIsInZhbHVlIjoicXpScnV0amtNTUVJVHFhOUxKckRaZz09IiwibWFjIjoiYTQzZTMyNWQ2YzM2OTg3NmQwOGI2NDEyMjQ4OGFlM2RmZGY2Y2E4NDgzZTk1YTdkYTE5YTdhZDZjZTc1NDY2ZCJ9',0,NULL,'Approved',NULL,NULL,'2018-09-17 09:21:01',NULL,0,NULL,NULL,'244','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','434','Chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Speaking','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(8,'People Analytics','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Option 3','OAY','eyJpdiI6InplUWswRGdxMHJ4NERCOVwvdVpaandRPT0iLCJ2YWx1ZSI6IklDbmhtcDQ5WXU0QUpnMUx2OGlvZUE9PSIsIm1hYyI6ImNhZjY2M2Y5MGFlNmFlODM4NjRkMzAwMjBjOWVmZGEwNDRlN2RkZWI4Mjg1NjE0ZmI1YmM4OTkyYmYyMmE3NDIifQ==',0,NULL,'Approved',NULL,NULL,'2018-09-17 09:24:01',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','123','Chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Speaking','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(9,'Reports Manipulation Conference','http://www.nrg.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.',1,'Option 2','LOY','eyJpdiI6ImZtbGE4ajdIck8xbjF5dWl4eTArM0E9PSIsInZhbHVlIjoiMUptbFZQT0tINlwvYWRCbVVMRzZ1eEE9PSIsIm1hYyI6IjkxMjI3OTg0MjA0ZjM2NDdmODY5MTQ3YjJiMzBhYjgyNzFlNDNmYjZjOGMzNDRjZGNjMjkzM2QxNTQxMzIwMDYifQ==',0,NULL,'Approved',NULL,NULL,'2018-09-17 09:28:32',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-17','2018-09-17','456','Chennai','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','Speaking','','','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','kayalvizhi.manavalan@excelenciaconsulting.com'),(10,'Salesforce Conference','http://www.nrg.com','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.',2,'Option 1','OAY','eyJpdiI6Im9wd01Vb2ZzeDdieFRaeUlkZG10RUE9PSIsInZhbHVlIjoiWGlkWWw2N0cxcnUrekZLR3pJTlFsQT09IiwibWFjIjoiZDY4OGMyNjRjYzlkMDNiNmVhNjFiNTFiNjliNzA1MmY2NzNkYWE3MDdjOTU3NWE0M2ExY2QxMTA3OGE4OGU5NCJ9',0,NULL,'Pending',NULL,NULL,'2018-09-17 09:44:11',NULL,0,NULL,NULL,'123','Chennai','2018-09-17','2018-09-17','2018-09-21','2018-09-21','123','Chennai','Yes','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','Speaking','','','','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal b','kaviyarasan.sadasivam@excelenciaconsulting.com');
/*!40000 ALTER TABLE `conference` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `conferenceid` int(10) unsigned DEFAULT NULL,
  `conferencename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yourname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `objective` text COLLATE utf8mb4_unicode_ci,
  `results` text COLLATE utf8mb4_unicode_ci,
  `recommendations` text COLLATE utf8mb4_unicode_ci,
  `key_customers` text COLLATE utf8mb4_unicode_ci,
  `actions` text COLLATE utf8mb4_unicode_ci,
  `business_opportunities` text COLLATE utf8mb4_unicode_ci,
  `other_opportunities` text COLLATE utf8mb4_unicode_ci,
  `upload_attendees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_leads` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conferenceid` (`conferenceid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`conferenceid`) REFERENCES `conference` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conferenceid` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salesforce_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_delete` tinyint(1) DEFAULT NULL,
  `sendleads` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `potential` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_conferenceid_foreign` (`conferenceid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,4,1,'Pradeep','PV','Project Head','Excelencia','pradeep@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:31:00',NULL,'0000-00-00 00:00:00',NULL,'',''),(2,4,1,'Bala','Krishnan','CEO','Excelencia','bala@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:31:29',NULL,'0000-00-00 00:00:00',NULL,'',''),(3,3,1,'Rajesh','PR','CTO','Excelencia','rajesh@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:32:24',NULL,'0000-00-00 00:00:00',NULL,'',''),(4,3,1,'Sundar','Swaminathan','Delivery Head','Excelencia','sundar@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:32:56',NULL,'0000-00-00 00:00:00',NULL,'',''),(5,7,1,'Kaviyarasan','Sadasivam','Team Lead','Excelencia','kaviyarasan@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:33:33',NULL,'0000-00-00 00:00:00',NULL,'',''),(6,7,1,'Kayalvizhi','Manavalan','Team Member','Excelencia','kayalvizhi@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:34:49',NULL,'0000-00-00 00:00:00',NULL,'',''),(7,1,1,'Velmurugan','S','UI/UX Designer','Excelencia','vel@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:35:33',NULL,'0000-00-00 00:00:00',NULL,'',''),(8,1,1,'Sunandhan','S','UI/ UX Designer','Excelencia','sunandhan@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:36:04',NULL,'0000-00-00 00:00:00',NULL,'',''),(9,8,1,'Hima','Joseph','TL','Excelencia','hima@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:36:38',NULL,'0000-00-00 00:00:00',NULL,'',''),(10,8,1,'Karthiga','Babu','TL','Excelencia','karthiga@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:37:06',NULL,'0000-00-00 00:00:00',NULL,'',''),(11,9,1,'Diana','Betcy','TL','Excelencia','diana@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:37:39',NULL,'0000-00-00 00:00:00',NULL,'',''),(12,9,1,'Gidhin','Shaji','TL','Excelencia','gidhin@excelenciaconsulting.com','','',NULL,NULL,'2018-09-17 09:38:05',NULL,'0000-00-00 00:00:00',NULL,'','');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_02_27_053058_create_conference_table',1),(2,'2017_02_27_053113_create_user_table',1),(3,'2017_02_27_053130_create_adminuser_table',1),(4,'2017_02_27_053146_create_feedback_table',1),(5,'2017_02_27_053200_create_leads_table',1),(6,'2017_02_27_053223_create_request_table',1),(7,'2014_10_12_000000_create_users_table',2),(8,'2014_10_12_100000_create_password_resets_table',2),(9,'2017_03_13_102445_create_requests_table',3),(10,'2017_03_15_061203_create_newconference_table',4),(11,'2017_03_16_090755_create_apply_table',5),(12,'2017_03_17_070846_create_conferencefeedback_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conferenceid` int(11) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,2,'kayalvizhi.manavalan@excelenciaconsulting.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.','2018-09-17 09:38:19','0000-00-00 00:00:00'),(2,2,'kayalvizhi.manavalan@excelenciaconsulting.com','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.','2018-09-17 09:38:31','0000-00-00 00:00:00'),(3,1,'kayalvizhi.manavalan@excelenciaconsulting.com','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem','2018-09-17 09:38:46','0000-00-00 00:00:00'),(4,1,'kayalvizhi.manavalan@excelenciaconsulting.com','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem','2018-09-17 09:38:52','0000-00-00 00:00:00'),(5,3,'kayalvizhi.manavalan@excelenciaconsulting.com','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.','2018-09-17 09:39:04','0000-00-00 00:00:00'),(6,3,'kayalvizhi.manavalan@excelenciaconsulting.com','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.','2018-09-17 09:39:08','0000-00-00 00:00:00'),(7,3,'kayalvizhi.manavalan@excelenciaconsulting.com','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.','2018-09-17 09:39:11','0000-00-00 00:00:00'),(8,9,'kayalvizhi.manavalan@excelenciaconsulting.com','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.','2018-09-17 09:39:22','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsorship_survey`
--

DROP TABLE IF EXISTS `sponsorship_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsorship_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sponsorship_costs` varchar(255) DEFAULT NULL,
  `is_speaker` varchar(255) DEFAULT NULL,
  `leads` enum('20','40','60') DEFAULT NULL,
  `booth_traffic` enum('20','40','60') DEFAULT NULL,
  `relevant` enum('20','40','60') DEFAULT NULL,
  `promotional_assets` enum('20','40','60') DEFAULT NULL,
  `nrg_social_mentions` enum('20','40','60') DEFAULT NULL,
  `conf_social_mentions` enum('20','40','60') DEFAULT NULL,
  `invite_open` enum('20','40','60') DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `conference_score` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsorship_survey`
--

LOCK TABLES `sponsorship_survey` WRITE;
/*!40000 ALTER TABLE `sponsorship_survey` DISABLE KEYS */;
INSERT INTO `sponsorship_survey` VALUES (1,4,1,'23000','Yes','20','20','40','60','60','60','60',0,NULL,NULL,NULL,NULL,'31'),(2,3,1,'25000','Yes','40','60','60','60','60','60','60',0,NULL,NULL,NULL,NULL,'48'),(3,7,1,'65000','No','40','40','40','40','20','20','60',0,NULL,NULL,NULL,NULL,'39'),(4,8,1,'12450','Yes','60','60','60','60','60','60','60',0,NULL,NULL,NULL,NULL,'60');
/*!40000 ALTER TABLE `sponsorship_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standarduser`
--

DROP TABLE IF EXISTS `standarduser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `standarduser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `manager_firstname` varchar(255) DEFAULT NULL,
  `manager_lastname` varchar(255) DEFAULT NULL,
  `manager_email` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `modified_date` datetime DEFAULT NULL,
  `another_phone` varchar(255) DEFAULT NULL,
  `another_email` varchar(255) DEFAULT NULL,
  `manager` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standarduser`
--

LOCK TABLES `standarduser` WRITE;
/*!40000 ALTER TABLE `standarduser` DISABLE KEYS */;
INSERT INTO `standarduser` VALUES (1,'Kayalvizhi','Manavalan','kayalvizhi.manavalan@excelenciaconsulting.com',NULL,NULL,NULL,'2018-09-17 09:03:44',NULL,NULL,0,NULL,'','','kayalvizhi.manavalan@gmail.com','(822)034-1179'),(2,'Kaviyarasan','Sadasivam','kaviyarasan.sadasivam@excelenciaconsulting.com',NULL,NULL,NULL,'2018-09-17 09:44:11',NULL,NULL,0,NULL,'','','kayalvizhi.manavalan@excelenciaconsulting.com','(994)414-5573'),(3,'Karthiga','Babu','karthiga.babu@excelenciaconsulting.com',NULL,NULL,NULL,'2018-09-17 07:51:36',NULL,NULL,0,NULL,'(801)569-3305','','kayalvizhi.manavalan@gmail.com','(801)569-3305');
/*!40000 ALTER TABLE `standarduser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) DEFAULT NULL,
  `competitors` varchar(255) DEFAULT NULL,
  `conference_costs` varchar(255) DEFAULT NULL,
  `conference_expenses` varchar(255) DEFAULT NULL,
  `scheduled` varchar(255) DEFAULT NULL,
  `attended` varchar(255) DEFAULT NULL,
  `personal_contacts` varchar(255) DEFAULT NULL,
  `elaborateno` varchar(255) DEFAULT NULL,
  `additional_plans` varchar(255) DEFAULT NULL,
  `recommend` varchar(255) DEFAULT NULL,
  `attendees` varchar(255) DEFAULT NULL,
  `companies` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `conferenceid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (1,'Brand Awareness','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123','123','2','2','Yes','','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','10','2','2','2018-09-17 09:09:07',NULL,NULL,4,1),(2,'Entering a new market','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','123','123','3','3','Yes','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human h','8','2','2','2018-09-17 09:11:03',NULL,NULL,4,2);
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','sathish@excelenciaconsulting.com','$2y$10$oPti7OPYAoNID/RjhGn2eOcOv2EjWODPjGecpJjIii9zbfb.L73YO','uUU8DCfEdj7QeOLT5AENmLH6QajfvsY69JIkDRcVG5yWP18LNRo9t2SOO7vI','00D5C0000008iKT!ASAAQLeVgKmpR.oBTxCBfy3hAnzU1R4Z71MhoraByE5t0z3sCwwHlulKaa2LI7ba6FPxu8Q8ouWBRILcWFWu7nwLo4J9lfyn','0000-00-00 00:00:00','0000-00-00 00:00:00');
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

-- Dump completed on 2018-09-17  9:50:04
