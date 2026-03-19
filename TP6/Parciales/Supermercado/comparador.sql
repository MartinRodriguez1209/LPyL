-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 14:26:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comparador`
--
CREATE DATABASE IF NOT EXISTS `comparador` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `comparador`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id_producto` int(4) NOT NULL,
  `id_supermercado` int(4) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id_producto`, `id_supermercado`, `precio`) VALUES
(1, 1, '1500.00'),
(1, 2, '1750.00'),
(1, 3, '1585.20'),
(1, 4, '1495.50'),
(1, 5, '1780.00'),
(1, 6, '1500.00'),
(1, 7, '999.00'),
(1, 8, '1435.00'),
(1, 9, '1790.00'),
(1, 10, '1650.00'),
(1, 11, '1675.50'),
(1, 12, '1650.00'),
(2, 1, '2150.00'),
(2, 2, '1850.00'),
(2, 3, '1720.50'),
(2, 4, '1975.60'),
(2, 5, '1890.00'),
(2, 6, '1920.00'),
(2, 7, '2000.00'),
(2, 8, '1678.00'),
(2, 9, '1719.00'),
(3, 1, '4350.00'),
(3, 3, '4478.00'),
(3, 4, '4900.00'),
(3, 6, '4776.00'),
(3, 7, '4598.00'),
(3, 8, '5000.00'),
(3, 9, '4978.50'),
(3, 10, '4750.62'),
(3, 11, '4680.00'),
(3, 12, '4980.00'),
(4, 2, '10560.00'),
(4, 3, '11890.00'),
(4, 5, '10980.00'),
(4, 6, '13150.00'),
(4, 7, '12600.00'),
(4, 9, '14789.00'),
(4, 10, '13520.00'),
(4, 11, '17890.00'),
(5, 1, '16500.00'),
(5, 3, '15400.00'),
(5, 5, '16250.00'),
(5, 6, '15870.00'),
(5, 7, '14999.00'),
(5, 8, '18150.52'),
(5, 9, '17158.80'),
(5, 10, '16152.20'),
(5, 11, '19158.00'),
(5, 12, '18745.00'),
(6, 1, '980.00'),
(6, 2, '1100.20'),
(6, 3, '1098.03'),
(6, 5, '999.00'),
(6, 6, '978.50'),
(6, 7, '977.00'),
(6, 9, '968.20'),
(6, 10, '979.00'),
(6, 11, '996.00'),
(6, 12, '1078.20'),
(7, 1, '685.00'),
(7, 2, '679.00'),
(7, 3, '705.00'),
(7, 4, '695.00'),
(7, 5, '710.50'),
(7, 6, '695.00'),
(7, 7, '685.00'),
(7, 8, '780.00'),
(7, 9, '699.00'),
(7, 12, '740.00'),
(8, 1, '780.00'),
(8, 2, '810.00'),
(8, 3, '800.00'),
(8, 5, '850.00'),
(8, 7, '840.00'),
(8, 8, '710.50'),
(8, 9, '848.00'),
(8, 10, '980.00'),
(8, 11, '780.00'),
(8, 12, '785.00'),
(10, 1, '780.00'),
(10, 2, '810.00'),
(10, 3, '800.00'),
(10, 5, '850.00'),
(10, 7, '840.00'),
(10, 8, '710.50'),
(10, 9, '848.00'),
(10, 10, '980.00'),
(10, 11, '780.00'),
(10, 12, '785.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(4) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`) VALUES
(1, 'Yerba'),
(2, 'Fideos'),
(3, 'Pollo'),
(4, 'Carne de Vaca'),
(5, 'Carne de Cerdo'),
(6, 'Arroz'),
(7, 'Porotos'),
(8, 'Aceitunas'),
(9, 'Pan'),
(10, 'Aceite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supermercado`
--

CREATE TABLE `supermercado` (
  `id_supermercado` int(4) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `ubicacion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `supermercado`
--

INSERT INTO `supermercado` (`id_supermercado`, `nombre`, `ubicacion`) VALUES
(1, 'La Anonima', 'Centro'),
(2, 'La Anonima', '13 de Diciembre'),
(3, 'Jumbo', 'Centro'),
(4, 'Supermercado Oceano', 'Roca'),
(5, 'Cooperativa Obrera', 'Roca'),
(6, 'Cooperativa Obrera', 'Pueyrredon'),
(7, 'Carrefour', 'Centro'),
(8, 'Carrefour', 'Pueyrredon'),
(9, 'Maxiconsumo', 'Pueyrredon'),
(10, 'Diarco', 'Centro'),
(11, 'Chango Mas', 'Pueyrredon'),
(12, 'Supermercado Mayo', '13 de Diciembre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id_producto`,`id_supermercado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `supermercado`
--
ALTER TABLE `supermercado`
  ADD PRIMARY KEY (`id_supermercado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `supermercado`
--
ALTER TABLE `supermercado`
  MODIFY `id_supermercado` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
