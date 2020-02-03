-- MySQL dump 10.13  Distrib 5.7.19, for Linux (i686)
--
-- Host: localhost    Database: secad_sm19
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Posts`;

CREATE TABLE `Posts` (
	`postid` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`content` text NOT NULL,
	`posttime` TIMESTAMP NOT NULL,
	`postedby` varchar(50) NOT NULL,
	 FOREIGN KEY (`postedby`) REFERENCES `Users` (`username`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Comments`;

CREATE TABLE `Comments` (
	`commentid` int(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`comment` text NOT NULL,
	`commenttime` TIMESTAMP NOT NULL,
	`commentby` varchar(50) NOT NULL,
	 FOREIGN KEY (`commentby`) REFERENCES `Users` (`username`) ON DELETE CASCADE,
	`postid` int(6) NOT NULL,
	 FOREIGN KEY (`postid`) REFERENCES `Posts` (`postid`) ON DELETE CASCADE
);

LOCK TABLES `Users` WRITE;
INSERT INTO `Users` VALUES ('admin','*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB');
UNLOCK TABLES;

LOCK TABLES `Posts` WRITE;
INSERT INTO Posts(content, postedby) VALUES ('Just a test post','admin');
UNLOCK TABLES;

LOCK TABLES `Comments` WRITE;
INSERT INTO Comments(comment, commentby) VALUES ('Right back at you, bro','admin');
UNLOCK TABLES;




/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-23 18:48:53
