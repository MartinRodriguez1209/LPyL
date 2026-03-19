-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para raileurope
CREATE DATABASE IF NOT EXISTS `raileurope` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `raileurope`;

-- Volcando estructura para tabla raileurope.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEmpresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paisEmpresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `webEmpresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `logoEmpresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla raileurope.empresas: ~7 rows (aproximadamente)
INSERT INTO `empresas` (`idEmpresa`, `nombreEmpresa`, `paisEmpresa`, `webEmpresa`, `logoEmpresa`) VALUES
	(1, 'Renfe', 'España', 'https://www.renfe.com/', 'logos/renfe.jpg'),
	(2, 'Ouigo', 'Francia', 'https://www.ouigo.com/', 'logos/oiugo.jpg'),
	(3, 'Italotreno', 'Italia', 'https://www.italotreno.com/', 'logos/italotreno.jpg'),
	(4, 'Iryo', 'España', 'https://iryo.eu', 'logos/iryo.jpg'),
	(5, 'Trenitalia', 'Italia', 'https://www.trenitalia.com/', 'logos/trenitalia.jpg'),
	(6, 'Eurostar', 'Reino Unido', 'https://www.eurostar.com/', 'logos/eurostar.jpg'),
	(7, 'Deutsche Bahn', 'Alemania', 'https://int.bahn.de/', 'logos/DeutscheBahn.jpg');

-- Volcando estructura para tabla raileurope.servicios
CREATE TABLE IF NOT EXISTS `servicios` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `nroServicio` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ciudadOrigenServicio` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ciudadDestinoServicio` varchar(100) CHARACTER SET utf8 NOT NULL,
  `estacionOrigenServicio` varchar(100) CHARACTER SET utf8 NOT NULL,
  `estacionDestinoServicio` varchar(100) CHARACTER SET utf8 NOT NULL,
  `horaSalidaServicio` time NOT NULL,
  `horaLlegadaServicio` time NOT NULL,
  `frecuenciaServicio` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'DIARIO',
  `precioServicio` int(11) NOT NULL DEFAULT 0,
  `idEmpresa` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla raileurope.servicios: ~35 rows (aproximadamente)
INSERT INTO `servicios` (`idServicio`, `nroServicio`, `ciudadOrigenServicio`, `ciudadDestinoServicio`, `estacionOrigenServicio`, `estacionDestinoServicio`, `horaSalidaServicio`, `horaLlegadaServicio`, `frecuenciaServicio`, `precioServicio`, `idEmpresa`) VALUES
	(1, 'Iryo 1000', 'Madrid', 'Sevilla', 'Puerta de Atocha', 'Santa Justa', '06:50:00', '09:32:00', 'DIARIO', 30095, 4),
	(2, 'AVE 02080', 'Madrid', 'Sevilla', 'Puerta de Atocha', 'Santa Justa', '08:00:00', '10:43:00', 'DIARIO', 46798, 1),
	(3, 'Iryo 1010', 'Madrid', 'Sevilla', 'Puerta de Atocha', 'Santa Justa', '08:51:00', '11:33:00', 'DIARIO', 32565, 4),
	(4, 'AVE 03872', 'Madrid', 'Sevilla', 'Puerta de Atocha', 'Santa Justa', '11:05:00', '13:48:00', 'DIARIO', 46798, 1),
	(5, 'AVE 02360', 'Madrid', 'Sevilla', 'Puerta de Atocha', 'Santa Justa', '16:30:00', '19:03:00', 'DIARIO', 31199, 1),
	(6, 'Iryo 06062', 'Madrid', 'Valencia', 'Chamartin', 'Joaquin Sorolla', '06:45:00', '08:39:00', 'LU-MA-MI-JU-VI', 18410, 4),
	(7, 'OUIGO Espana 64', 'Madrid', 'Valencia', 'Chamartin', 'Joaquin Sorolla', '07:15:00', '09:09:00', 'DIARIO', 19000, 2),
	(8, 'AVE 05890', 'Madrid', 'Valencia', 'Puerta de Atocha', 'Joaquin Sorolla', '09:44:00', '11:47:00', 'DIARIO', 44861, 1),
	(9, 'AVE 03071', 'Madrid', 'Barcelona', 'Puerta de Atocha', 'Sants', '07:00:00', '09:30:00', 'DIARIO', 38999, 1),
	(10, 'OUIGO Espana 64', 'Madrid', 'Barcelona', 'Puerta de Atocha', 'Sants', '07:05:00', '09:50:00', 'DIARIO', 31974, 2),
	(11, 'Iryo 06291', 'Madrid', 'Barcelona', 'Puerta de Atocha', 'Sants', '09:08:00', '12:00:00', 'DIARIO', 37768, 4),
	(12, 'OUIGO Espana 64', 'Barcelona', 'Madrid', 'Sants', 'Puerta de Atocha', '06:30:00', '09:15:00', 'DIARIO', 43601, 2),
	(13, 'Iryo 06090', 'Barcelona', 'Madrid', 'Sants', 'Puerta de Atocha', '08:55:00', '11:40:00', 'DIARIO', 61720, 4),
	(14, 'AVLO 06304', 'Barcelona', 'Madrid', 'Sants', 'Puerta de Atocha', '10:00:00', '13:17:00', 'DIARIO', 43601, 1),
	(15, 'Iryo 06011', 'Sevilla', 'Barcelona', 'Santa Justa', 'Sants', '06:54:00', '12:45:00', 'DIARIO', 84639, 4),
	(16, 'AVE 03943', 'Sevilla', 'Barcelona', 'Santa Justa', 'Sants', '08:40:00', '14:21:00', 'DIARIO', 84309, 1),
	(17, 'EUROMED 01071', 'Barcelona', 'Valencia', 'Sants', 'Joaquin Sorolla', '07:15:00', '10:10:00', 'DIARIO', 47339, 1),
	(18, 'FR 9682', 'Roma', 'Milan', 'Termini', 'Milano Centrale', '05:38:00', '08:30:00', 'DIARIO', 77429, 5),
	(19, 'Napoli Centrale - Milano Centrale 9970', 'Roma', 'Milan', 'Termini', 'Milano Centrale', '07:30:00', '10:45:00', 'DIARIO', 73646, 3),
	(20, 'FR 9634', 'Roma', 'Milan', 'Termini', 'Milano Centrale', '12:50:00', '16:05:00', 'DIARIO', 77429, 5),
	(21, 'Milano Centrale - Roma Termini 9907', 'Milan', 'Florencia', 'Milano Centrale', 'Santa Maria Novella', '05:40:00', '07:35:00', 'LU-MI-VI-SA-DO', 40591, 3),
	(22, 'Venezia Santa Lucia - Napoli Centrale 8903', 'Florencia', 'Roma', 'Santa Maria Novella', 'Termini', '09:28:00', '11:05:00', 'DIARIO', 36716, 3),
	(23, 'FA 8551', 'Florencia', 'Roma', 'Campo Marte', 'Termini', '10:06:00', '11:32:00', 'DIARIO', 27029, 5),
	(24, 'FR 9633', 'Milan', 'Roma', 'Milano Centrale', 'Termini', '13:30:00', '16:40:00', 'DIARIO', 77404, 5),
	(25, 'Milano Centrale - Roma Termini 9985', 'Milan', 'Roma', 'Milano Centrale', 'Termini', '14:20:00', '17:25:00', 'DIARIO', 70623, 3),
	(26, 'Eurostar 9080', 'Londres', 'Paris', 'Saint Pancras International', 'Gare du Nord', '06:01:00', '09:20:00', 'DIARIO', 131751, 6),
	(27, 'Eurostar 9022', 'Londres', 'Paris', 'Saint Pancras International', 'Gare du Nord', '11:31:00', '14:48:00', 'DIARIO', 152095, 6),
	(28, 'Eurostar 9027', 'Paris', 'Londres', 'Gare du Nord', 'Saint Pancras International', '12:12:00', '13:30:00', 'DIARIO', 127876, 6),
	(29, 'Eurostar 9106', 'Londres', 'Amsterdam', 'Saint Pancras International', 'Amsterdam Centraal', '06:16:00', '11:15:00', 'DIARIO', 139501, 6),
	(30, 'Eurostar 9113', 'Bruselas', 'Londres', 'Bruxelles Midi', 'Saint Pancras International', '07:56:00', '08:57:00', 'DIARIO', 93969, 6),
	(31, 'ICE 1001', 'Berlin', 'Munich', 'Berlin Hauptbahnhof', 'Munchen Hauptbahnhof', '06:00:00', '10:02:00', 'DIARIO', 87179, 7),
	(32, 'ICE 1005', 'Berlin', 'Munich', 'Berlin Hauptbahnhof', 'Munchen Hauptbahnhof', '12:04:00', '16:01:00', 'DIARIO', 96866, 7),
	(33, 'ICE 275', 'Berlin', 'Frankfurt', 'Berlin Hauptbahnhof', 'Francfort del Meno Hauptbahnhof', '04:29:00', '08:44:00', 'DIARIO', 46481, 7),
	(34, 'ICE 608', 'Munich', 'Berlin', 'Munchen Hauptbahnhof', 'Berlin Hauptbahnhof', '00:21:00', '05:26:00', 'DIARIO', 54229, 7),
	(35, 'ICE 728', 'Munich', 'Frankfurt', 'Munchen Hauptbahnhof', 'Francfort del Meno Hauptbahnhof', '06:47:00', '10:04:00', 'DIARIO', 44544, 7);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
