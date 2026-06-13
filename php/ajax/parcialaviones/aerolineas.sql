# MySQL-Front 3.2  (Build 14.8)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='SYSTEM' */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: localhost    Database: aerolineas
# ------------------------------------------------------
# Server version 5.0.41-community-nt

DROP DATABASE IF EXISTS `aerolineas`;
CREATE DATABASE `aerolineas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aerolineas`;

#
# Table structure for table aviones
#

CREATE TABLE `aviones` (
  `idAvion` int(11) NOT NULL auto_increment,
  `idModelo` int(11) NOT NULL default '0',
  `matricula` varchar(10) default NULL,
  `fechaIngreso` date NOT NULL default '0000-00-00',
  `capacidad` int(3) NOT NULL default '0',
  `distribucion` varchar(15) default NULL,
  PRIMARY KEY  (`idAvion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table aviones
#

INSERT INTO `aviones` VALUES (1,1,'LV-BYY','2009-05-13',138,'12C + 126Y');
INSERT INTO `aviones` VALUES (2,1,'LV-BZA','2009-06-06',128,'8W + 120Y');
INSERT INTO `aviones` VALUES (3,1,'LV-CYN','2012-08-30',128,'8W + 120Y');
INSERT INTO `aviones` VALUES (4,2,'LV-CTC','2011-12-22',170,'8C + 162Y');
INSERT INTO `aviones` VALUES (5,2,'LV-FUA','2014-07-19',170,'8C + 162Y');
INSERT INTO `aviones` VALUES (6,3,'LV-FVH','2015-02-28',267,'24C + 243Y');
INSERT INTO `aviones` VALUES (7,3,'LV-FVI','2015-04-30',267,'24C + 243Y');
INSERT INTO `aviones` VALUES (8,4,'LV-CDY','2010-09-20',96,'8W + 88Y');
INSERT INTO `aviones` VALUES (9,4,'LV-CDZ','2010-09-20',96,'8W + 88Y');

#
# Table structure for table modelos
#

CREATE TABLE `modelos` (
  `idModelo` int(11) NOT NULL auto_increment,
  `nombre` varchar(250) default NULL,
  `nombreReducido` varchar(50) default NULL,
  `fabricante` varchar(100) default NULL,
  PRIMARY KEY  (`idModelo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table modelos
#

INSERT INTO `modelos` VALUES (1,'BOEING 737-700','B737','BOEING');
INSERT INTO `modelos` VALUES (2,'BOEING 737-800','B738','BOEING');
INSERT INTO `modelos` VALUES (3,'AIRBUS A330-200','A332','AIRBUS');
INSERT INTO `modelos` VALUES (4,'EMBRAER 190','ERJ195','EMBRAER');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
