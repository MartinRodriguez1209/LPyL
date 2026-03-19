-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2022 a las 14:53:17
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `franquicia`
--
CREATE DATABASE IF NOT EXISTS `franquicia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `franquicia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `codigoCategoria` int(11) NOT NULL,
  `categoria` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codigoCategoria`, `categoria`) VALUES
(1, 'PANTALONES'),
(2, 'POLLERAS'),
(3, 'VESTIDOS'),
(4, 'ZAPATOS'),
(5, 'PULLOVER'),
(6, 'BLUSAS'),
(7, 'REMERAS'),
(8, 'SACOS Y CAMPERAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `nroCliente` int(11) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `domicilio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nroCliente`, `apellido`, `nombre`, `domicilio`) VALUES
(1, 'PEREZ', 'CLARA', 'SAN MARTIN 150'),
(2, 'FERNANDEZ', 'ANA', 'BELGRANO 150'),
(3, 'GONZALEZ', 'FABIAN', 'RIVADAVIA 80'),
(4, 'CASARES', 'JORGE', 'HUERGO 158'),
(5, 'ORTIZ', 'VALERIA', 'RAWSON 1850'),
(6, 'CASARES', 'JORGE', 'HUERGO 158'),
(7, 'ORTIZ', 'VALERIA', 'RAWSON 1850'),
(8, 'ZULUAGA', 'MARTIN MARCELO', 'LOS AROMOS 789'),
(9, 'GARRIGOS', 'LAURA ANA', 'SANTA FE 1796');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `nroProducto` int(11) NOT NULL,
  `codCategoria` int(10) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `stock` int(10) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` int(3) NOT NULL COMMENT 'Porcentaje que se resta al precio',
  `impuesto` int(3) NOT NULL COMMENT 'Porcentaje que sumar al precio',
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`nroProducto`, `codCategoria`, `descripcion`, `stock`, `precio`, `descuento`, `impuesto`, `imagen`) VALUES
(1, 1, 'Pantalón Jean Negro', 30, '8540.20', 10, 15, ''),
(2, 1, 'Pantalón de Vestir Verde', 30, '12540.10', 15, 15, ''),
(3, 2, 'Pollera Maxi Azul', 28, '7962.55', 12, 15, ''),
(4, 3, 'Vestido Solero', 1, '10720.24', 15, 21, ''),
(5, 3, 'Vestido de Verano', 1, '15890.45', 15, 20, ''),
(6, 8, 'Saco de Paño Negro', 20, '25978.52', 25, 12, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `nroFactura` int(11) NOT NULL,
  `fechaFactura` date NOT NULL,
  `nroCliente` int(10) NOT NULL,
  `importeTotal` decimal(12,2) NOT NULL,
  `descuentoTotal` decimal(12,2) NOT NULL,
  `impuestoTotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`nroFactura`, `fechaFactura`, `nroCliente`, `importeTotal`, `descuentoTotal`, `impuestoTotal`) VALUES
(1, '2022-06-09', 5, '55241.10', '6151.11', '8286.16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaproducto`
--

DROP TABLE IF EXISTS `ventaproducto`;
CREATE TABLE `ventaproducto` (
  `nroFactura` int(10) NOT NULL,
  `nroProducto` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `descuento` decimal(12,2) NOT NULL,
  `impuesto` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventaproducto`
--

INSERT INTO `ventaproducto` (`nroFactura`, `nroProducto`, `cantidad`, `precio`, `descuento`, `impuesto`) VALUES
(1, 1, 5, '42701.00', '4270.10', '6405.15'),
(1, 2, 1, '12540.10', '1881.01', '1881.01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codigoCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nroCliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`nroProducto`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`nroFactura`);

--
-- Indices de la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD PRIMARY KEY (`nroFactura`,`nroProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codigoCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `nroCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `nroProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `nroFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
