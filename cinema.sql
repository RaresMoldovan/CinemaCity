-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: cinema
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Genre id',
  `name` varchar(255) NOT NULL COMMENT 'Genre name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Genre table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'romance'),(2,'drama'),(3,'thriller'),(4,'science fiction'),(5,'fantasy'),(7,'adventure'),(8,'fantasy'),(9,'animation'),(10,'superhero'),(11,'mystery'),(12,'crime'),(13,'biography'),(14,'action'),(15,'history');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall`
--

DROP TABLE IF EXISTS `hall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hall` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Hall ID',
  `name` varchar(255) NOT NULL COMMENT 'Hall name',
  `nr_of_places` int(11) unsigned NOT NULL COMMENT 'Hall size',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Hall table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall`
--

LOCK TABLES `hall` WRITE;
/*!40000 ALTER TABLE `hall` DISABLE KEYS */;
INSERT INTO `hall` VALUES (1,'Main Hall',20),(2,'Second Hall',15),(3,'Fun Hall',20),(4,'Smiley Hall',22),(5,'Small Hall',20);
/*!40000 ALTER TABLE `hall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Movie ID',
  `name` varchar(255) NOT NULL COMMENT 'Movie name',
  `description` text COMMENT 'Movie description',
  `year` int(11) NOT NULL COMMENT 'Movie year appearance',
  `image` varchar(255) NOT NULL DEFAULT '\n' COMMENT 'Movie poster',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Movie table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES (1,'The Shawshank Redemption','Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',1994,'https://m.media-amazon.com/images/M/MV5BMDFkYTc0MGEtZmNhMC00ZDIzLWFmNTEtODM1ZmRlYWMwMWFmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg'),(2,'The Godfather','The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',1972,'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,704,1000_AL_.jpg'),(3,'The Godfather: Part II','The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.',1974,'https://m.media-amazon.com/images/M/MV5BMWMwMGQzZTItY2JlNC00OWZiLWIyMDctNDk2ZDQ2YjRjMWQ0XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,701,1000_AL_.jpg'),(4,'The Dark Knight','When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.',2008,'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SY1000_CR0,0,675,1000_AL_.jpg'),(5,'12 Angry Men','A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.',1957,'https://m.media-amazon.com/images/M/MV5BMWU4N2FjNzYtNTVkNC00NzQ0LTg0MjAtYTJlMjFhNGUxZDFmXkEyXkFqcGdeQXVyNjc1NTYyMjg@._V1_SY1000_CR0,0,649,1000_AL_.jpg'),(6,'Schindler\'s List','In German-occupied Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazi Germans.',1993,'https://m.media-amazon.com/images/M/MV5BNDE4OTMxMTctNmRhYy00NWE2LTg3YzItYTk3M2UwOTU5Njg4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SY1000_CR0,0,666,1000_AL_.jpg'),(7,'The Lord of the Rings: The Return of the King','Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',2003,'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,675,1000_AL_.jpg'),(8,'Pulp Fiction','The lives of two mob hitmen, a boxer, a gangster\'s wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',1994,'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SY1000_CR0,0,686,1000_AL_.jpg'),(9,'The Good, the Bad and the Ugly','A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.',1966,'https://m.media-amazon.com/images/M/MV5BOTQ5NDI3MTI4MF5BMl5BanBnXkFtZTgwNDQ4ODE5MDE@._V1_SY1000_CR0,0,656,1000_AL_.jpg'),(10,'Fight Club','An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.',1999,'https://m.media-amazon.com/images/M/MV5BNGM2NjQxZTAtMmU5My00YTk5LWFmOWMtYjZlYzk4YzMwNjFlXkEyXkFqcGdeQXVyNDk3NzU2MTQ@._V1_SY1000_CR0,0,666,1000_AL_.jpg');
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_to_genre`
--

DROP TABLE IF EXISTS `movie_to_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movie_to_genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) unsigned NOT NULL COMMENT 'Movie id',
  `genre_id` int(11) unsigned NOT NULL COMMENT 'Genre id',
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `genre_id` (`genre_id`),
  CONSTRAINT `movie_to_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `movie_to_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='Movie and genre association';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_to_genre`
--

LOCK TABLES `movie_to_genre` WRITE;
/*!40000 ALTER TABLE `movie_to_genre` DISABLE KEYS */;
INSERT INTO `movie_to_genre` VALUES (89,1,2),(90,2,12),(91,2,2),(92,3,12),(93,3,2),(94,4,14),(95,4,12),(96,4,2),(97,4,3),(98,5,12),(99,5,2),(100,6,13),(101,6,2),(102,6,15),(103,7,7),(104,7,2),(105,7,5),(106,8,12),(107,8,2),(108,9,2),(109,10,2),(110,10,3);
/*!40000 ALTER TABLE `movie_to_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Reservation id',
  `user_id` int(11) unsigned NOT NULL COMMENT 'User id',
  `seat_id` int(11) unsigned NOT NULL COMMENT 'Seat id',
  `show_id` int(11) unsigned NOT NULL COMMENT 'Show id',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `seat_id` (`seat_id`),
  KEY `show_id` (`show_id`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Reservation table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (2,1,680,1),(3,3,680,5);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Seat id',
  `hall_id` int(11) unsigned NOT NULL COMMENT 'Hall id',
  `code` varchar(5) NOT NULL COMMENT 'Seat code',
  PRIMARY KEY (`id`),
  KEY `hall_id` (`hall_id`),
  CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=777 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat`
--

LOCK TABLES `seat` WRITE;
/*!40000 ALTER TABLE `seat` DISABLE KEYS */;
INSERT INTO `seat` VALUES (680,1,'A1'),(681,1,'A2'),(682,1,'A3'),(683,1,'A4'),(684,1,'A5'),(685,1,'A6'),(686,1,'A7'),(687,1,'A8'),(688,1,'A9'),(689,1,'A10'),(690,1,'B1'),(691,1,'B2'),(692,1,'B3'),(693,1,'B4'),(694,1,'B5'),(695,1,'B6'),(696,1,'B7'),(697,1,'B8'),(698,1,'B9'),(699,1,'B10'),(700,2,'S11'),(701,2,'S12'),(702,2,'S13'),(703,2,'S14'),(704,2,'S15'),(705,2,'S21'),(706,2,'S22'),(707,2,'S23'),(708,2,'S24'),(709,2,'S25'),(710,2,'S31'),(711,2,'S32'),(712,2,'S33'),(713,2,'S34'),(714,2,'S35'),(715,3,'F1'),(716,3,'F2'),(717,3,'F3'),(718,3,'F4'),(719,3,'F5'),(720,3,'F6'),(721,3,'F7'),(722,3,'F8'),(723,3,'F9'),(724,3,'F10'),(725,3,'F11'),(726,3,'F12'),(727,3,'F13'),(728,3,'F14'),(729,3,'F15'),(730,3,'F16'),(731,3,'F17'),(732,3,'F18'),(733,3,'F19'),(734,3,'F20'),(735,4,'A1'),(736,4,'B'),(737,4,'C'),(738,4,'D'),(739,4,'E'),(740,4,'F'),(741,4,'G'),(742,4,'H'),(743,4,'I'),(744,4,'J'),(745,4,'K'),(746,4,'L'),(747,4,'M'),(748,4,'N'),(749,4,'O'),(750,4,'P'),(751,4,'Q'),(752,4,'R'),(753,4,'S'),(754,4,'T'),(755,4,'U'),(756,4,'V'),(757,5,'S11'),(758,5,'S12'),(759,5,'S13'),(760,5,'S14'),(761,5,'S15'),(762,5,'S21'),(763,5,'S22'),(764,5,'S23'),(765,5,'S24'),(766,5,'S25'),(767,5,'S31'),(768,5,'S32'),(769,5,'S33'),(770,5,'S34'),(771,5,'S35'),(772,5,'S41'),(773,5,'S42'),(774,5,'S43'),(775,5,'S44'),(776,5,'S45');
/*!40000 ALTER TABLE `seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `show`
--

DROP TABLE IF EXISTS `show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `show` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Show id',
  `movie_id` int(11) unsigned NOT NULL COMMENT 'Movie id',
  `hall_id` int(11) unsigned NOT NULL COMMENT 'Hall id',
  `time` datetime NOT NULL COMMENT 'Show time and date',
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `hall_id` (`hall_id`),
  CONSTRAINT `show_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `show_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Show table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `show`
--

LOCK TABLES `show` WRITE;
/*!40000 ALTER TABLE `show` DISABLE KEYS */;
INSERT INTO `show` VALUES (1,1,1,'2018-08-20 13:30:00'),(2,1,3,'2018-08-21 20:30:00'),(3,1,1,'2018-08-22 22:40:00'),(4,4,1,'2018-08-20 16:00:00'),(5,4,1,'2018-08-21 18:20:00'),(6,2,4,'2018-08-20 15:00:00'),(7,2,4,'2018-08-24 22:30:00'),(8,3,2,'2018-08-23 10:30:00'),(9,3,2,'2018-08-23 14:30:00'),(10,10,5,'2018-08-22 12:20:00'),(11,10,5,'2018-08-22 20:30:00'),(12,9,5,'2018-08-15 17:00:00'),(13,7,3,'2018-08-25 16:00:00'),(14,7,3,'2018-08-25 21:30:00'),(15,5,2,'2018-08-24 21:30:00'),(16,5,2,'2018-08-24 16:00:00'),(17,6,1,'2018-08-24 16:00:00'),(18,8,1,'2018-08-24 16:00:00'),(21,6,1,'2018-08-24 20:00:00'),(22,1,5,'2018-08-28 13:10:00'),(25,9,5,'2018-08-28 13:10:00');
/*!40000 ALTER TABLE `show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User id',
  `email` varchar(255) NOT NULL COMMENT 'User email',
  `password` char(32) NOT NULL COMMENT 'User password',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Use table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'raresmldvn@yahoo.com','21232f297a57a5a743894a0e4a801fc3'),(2,'rares@mail.com','1a1dc91c907325c69271ddf0c944bc72'),(3,'raresmldvn31@gmail.com','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-16 21:27:19
