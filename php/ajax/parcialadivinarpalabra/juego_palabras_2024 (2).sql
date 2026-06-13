-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.12-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
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


-- Volcando estructura de base de datos para juego_palabras_2024
CREATE DATABASE IF NOT EXISTS `juego_palabras_2024` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `juego_palabras_2024`;

-- Volcando estructura para tabla juego_palabras_2024.palabras
CREATE TABLE IF NOT EXISTS `palabras` (
  `idPalabra` int(11) NOT NULL AUTO_INCREMENT,
  `palabra` varchar(45) NOT NULL,
  `dificultadPalabra` enum('Baja','Media','Alta') NOT NULL,
  `acertada` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPalabra`),
  UNIQUE KEY `idPalabra_UNIQUE` (`idPalabra`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla juego_palabras_2024.palabras: 8 rows
/*!40000 ALTER TABLE `palabras` DISABLE KEYS */;
INSERT INTO `palabras` (`idPalabra`, `palabra`, `dificultadPalabra`, `acertada`) VALUES
	(1, 'madrid', 'Baja', 0),
	(2, 'silla', 'Baja', 0),
	(3, 'escalera', 'Media', 0),
	(4, 'leon', 'Baja', 0),
	(5, 'margarita', 'Media', 0),
	(6, 'bicicleta', 'Media', 0),
	(7, 'perfume', 'Media', 0),
	(8, 'paris', 'Baja', 0);
/*!40000 ALTER TABLE `palabras` ENABLE KEYS */;

-- Volcando estructura para tabla juego_palabras_2024.pistas
CREATE TABLE IF NOT EXISTS `pistas` (
  `idpista` int(11) NOT NULL AUTO_INCREMENT,
  `idPalabra` int(11) NOT NULL,
  `ordenPista` int(11) NOT NULL,
  `pista` varchar(100) NOT NULL,
  PRIMARY KEY (`idpista`),
  UNIQUE KEY `idpista_UNIQUE` (`idpista`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla juego_palabras_2024.pistas: 40 rows
/*!40000 ALTER TABLE `pistas` DISABLE KEYS */;
INSERT INTO `pistas` (`idpista`, `idPalabra`, `ordenPista`, `pista`) VALUES
	(1, 1, 1, 'Es un lugar'),
	(2, 1, 2, 'Es una ciudad'),
	(3, 1, 3, 'Está en Europa'),
	(4, 1, 4, 'Es famosa por sus comidas y su vida nocturna'),
	(5, 1, 5, 'Es la capital de España'),
	(6, 2, 1, 'Hay mucha variedad de modelos'),
	(7, 2, 2, 'Suele ser muy cómoda'),
	(8, 2, 3, 'La pueden usar una o dos personas a la vez'),
	(9, 2, 4, 'Tiene patas'),
	(10, 2, 5, 'Se usa para descansar'),
	(11, 3, 1, 'Se usa para poder desplazarnos de un lugar a otro'),
	(12, 3, 2, 'En algunos aviones, se oculta debajo de las puertas'),
	(13, 3, 3, 'Usarla cansa, pero hace bien al corazón'),
	(14, 3, 4, 'Uno de sus modelos clásicos tiene nombre de animal'),
	(15, 3, 5, 'En los edificios, se usa para las emergencias'),
	(16, 4, 1, 'Donde manda capitán, no manda marinero'),
	(17, 4, 2, 'No es usual, pero se lo puede encontrar en algunas ciudades grandes'),
	(18, 4, 3, 'No va a la peluqueria, pero tiene una cabellera imponente'),
	(19, 4, 4, 'Es un animal'),
	(20, 4, 5, 'Es el rey'),
	(21, 5, 1, 'Puede ser muchas cosas'),
	(22, 5, 2, 'Usarla puede ser algo inutil'),
	(23, 5, 3, 'Puede ser un nombre, o una bebida, o una flor'),
	(24, 5, 4, 'Puede usarse para conocer el amor de una persona'),
	(25, 5, 5, 'Me quiere, no me quiere, me quiere, no me quiere'),
	(26, 6, 1, 'Se puede usar para demorar el pago de algo'),
	(27, 6, 2, 'También se usa para poder desplazarnos de un lugar a otro'),
	(28, 6, 3, 'Es un medio de transporte muy usado en Europa'),
	(29, 6, 4, 'Si le sacamos algunas partes, nos podemos caer'),
	(30, 6, 5, 'Las mas chicas tienen 4 ruedas, las medianas y grandes tienen 2 ruedas'),
	(31, 7, 1, 'Lo usan hombres, mujeres y niños'),
	(32, 7, 2, 'Algunos pasan desapercibidos, otros no'),
	(33, 7, 3, 'Se puede usar para seducir'),
	(34, 7, 4, 'Es uno de los productos preferidos en los free shop'),
	(35, 7, 5, 'Los que se elaboran en Francia, son muy fuertes'),
	(36, 8, 1, 'Es un lugar'),
	(37, 8, 2, 'Hay mucho amor'),
	(38, 8, 3, 'Tiene mucha luminosidad'),
	(39, 8, 4, 'Es la capital turistica del mundo'),
	(40, 8, 5, 'Es la capital de Francia');
/*!40000 ALTER TABLE `pistas` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
