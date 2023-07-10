-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: agmarkets
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin1`
--

DROP TABLE IF EXISTS `admin1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin1` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `marketName` varchar(70) NOT NULL,
  `marketDescription` text,
  `activated` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin1`
--

LOCK TABLES `admin1` WRITE;
/*!40000 ALTER TABLE `admin1` DISABLE KEYS */;
INSERT INTO `admin1` VALUES (1000,'Erin','Langdon','admin_frm_ara','$2y$10$aGfiGTGROGDhJ0ehLArlOuev4Go4nm9DYPPKEmwQ31dPsPjKiC7I2','ay1235@ara.ac.nz','1992-06-17','Le_Ciel_Girfts','This market is about selling high-end gifts for buyers.','yes'),(1001,'Jo','Wright','tester_one','$2y$10$BrSZT0u22lzqALgbKp/wJu/ThkczKnCnjmXg/tVWmKWcxYdVFUfwe','testing@gmail.com','1989-09-29','Lala Land','This market is for trading gifts for toodlers','no');
/*!40000 ALTER TABLE `admin1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buyer1`
--

DROP TABLE IF EXISTS `buyer1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buyer1` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `profileDescription` text,
  `activated` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyer1`
--

LOCK TABLES `buyer1` WRITE;
/*!40000 ALTER TABLE `buyer1` DISABLE KEYS */;
INSERT INTO `buyer1` VALUES (200,'Tuxedo','Mask','sailor_moon','$2y$10$bdqWrB195BN0Luofen0nVeSUbzP6DfIZWWmw0x1u0HI4ndm1k007u','sailor_tuxedo@gmail.com','1989-08-09','I enjoy shopping for quality products.','yes'),(201,'Elle','Belle','elle_belle','$2y$10$GV8sFReUYa556Uolb/nROe599lCIVylo3Zlz2Jn0oI1LXl9J7aTMm','lemon_treel@gmail.com','1991-09-01','Looking for unique creative items : - D','no'),(202,'Bob','Builder','bob_builder','$2y$10$/ITzOWSX8JxyHUL9NXbsQuep1NaMbXIHbjPbvwiZoD2tsRAkN/W3e','the_builder@hotmail.com','1977-09-03','Interested in home renovation.','no');
/*!40000 ALTER TABLE `buyer1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `productName` varchar(60) NOT NULL,
  `productDescription` text,
  `category` varchar(20) NOT NULL,
  `buyNow` decimal(7,2) NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `userId` (`userId`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `seller1` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,1,'Diorsnow Moisturiser 220mL','The moisturiser is responsible for keeping your complexion bright and moisturised.','Skincare',201.00),(2,1,'Swarovski Y necklace','Kite cut, Star, White, Rose gold-tone plated','Jewellery',220.00),(3,2,'Philips Sonicare Diamond Clean Electric Toothbrush','Thoroughly clean your teeth and gums and keep your mouth fresh and healthy.','Technology',320.00),(4,2,'Nespresso Inissia Coffee Machine','Premium portioned coffee in an ultra compact, lightweight and vibrant machine.','Kitchen',380.00);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seller1`
--

DROP TABLE IF EXISTS `seller1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seller1` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `profileDescription` text,
  `activated` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seller1`
--

LOCK TABLES `seller1` WRITE;
/*!40000 ALTER TABLE `seller1` DISABLE KEYS */;
INSERT INTO `seller1` VALUES (1,'Maple','Syrup','tres_tres_chic','$2y$10$31HkBpZ39WsrjpMdzqge2OcEzTt4ND.RCXd9bqrIu0zQFjy8vkhNK','fashionable@hotmail.com','2001-02-11','Look out for chic presents!','yes'),(2,'John','Create','john2022','$2y$10$LTBtOkVUjhbE0z6FdMjym.jNVUvivhLpQRznu5SHzhf4dMdUBqVIu','business-reno@outlook.com','1962-04-06','Interesting little products for you.','yes'),(3,'Jason','Mason','jason_mason','$2y$10$RCo80DjZeZ3ouy8TUXcTHuocic.xRjFpgNEOtUwSmy6dr2A5Lgab6','dotdot@hotmail.com','1971-06-07','What I sell is different every week.','no');
/*!40000 ALTER TABLE `seller1` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-13 13:45:03
