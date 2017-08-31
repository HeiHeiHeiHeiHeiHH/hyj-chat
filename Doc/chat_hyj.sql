-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: chat_hyj
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
-- Table structure for table `chat_auth`
--

DROP TABLE IF EXISTS `chat_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_auth` (
  `hyj_id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `hyj_name` varchar(20) DEFAULT 'MonCheri',
  `hyj_token` varchar(100) NOT NULL,
  `hyj_phone` char(11) DEFAULT NULL,
  `hyj_mail` varchar(30) DEFAULT NULL,
  `hyj_sex` tinyint(1) DEFAULT '1',
  `hyj_age` char(2) DEFAULT '18',
  `hyj_uid` int(10) NOT NULL,
  `hyj_headpic` varchar(60) DEFAULT '/home/www/Chat/Application/Web/image/qq.jpg',
  KEY `hyj_id` (`hyj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_auth`
--

LOCK TABLES `chat_auth` WRITE;
/*!40000 ALTER TABLE `chat_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_userinfo`
--

DROP TABLE IF EXISTS `chat_userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_userinfo` (
  `hyj_uid` char(10) NOT NULL,
  `hyj_groups` varchar(120) DEFAULT NULL,
  `hyj_frinds` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_userinfo`
--

LOCK TABLES `chat_userinfo` WRITE;
/*!40000 ALTER TABLE `chat_userinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_userinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-31 17:43:38
