-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2017 a las 04:56:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `computacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codigo` int(11) NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `nombreProducto`, `precio`, `proveedor`) VALUES
(1, 'Telefono', '1365.00', 'Motorola'),
(2, 'Tablet ', '2500.00', 'Apple'),
(3, 'Notebook', '3500.00', 'HP'),
(4, 'Base Notebook', '150.00', 'Noga'),
(5, 'Cargador', '300.00', 'Universal'),
(6, 'Servidor', '15800.00', 'Lenovo'),
(7, 'Mini PC', '5450.00', 'Brix'),
(8, 'All in One', '26351.00', 'HP'),
(10, 'Impresora', '3500.00', 'HP'),
(11, 'Cartucho', '300.00', 'HP'),
(12, 'Laser', '2500.00', 'pro'),
(13, 'Scanner', '458.00', 'Lenovo'),
(14, 'Tonner', '1562.00', 'Universal'),
(15, 'Monitor', '4875.00', 'Sumsung'),
(16, 'Proyector', '8500.00', 'ViewSonic'),
(17, 'Soporte', '1878.00', 'Noga'),
(18, 'Televisor', '15000.00', 'Sumsung'),
(19, 'Pantalla', '5425.00', 'Loch'),
(20, 'Tarjeta Memoria', '127.00', 'Micro SD'),
(21, 'Disco Rigido', '1948.00', 'Seagate'),
(22, 'Pendrive', '356.00', 'Cruzer'),
(23, 'Gravadora', '281.00', 'Piano'),
(24, 'Gabinete', '223.00', 'Kanji'),
(25, 'Cooler', '300.00', 'Cougar'),
(26, 'Fuente', '139.00', 'Noga'),
(27, 'Estabilizador', '1268.00', 'Asium'),
(28, 'Teclado', '233.00', 'Logitech'),
(29, 'Mouse', '154.00', 'Traveler'),
(30, 'Auriculares', '598.00', 'Genius'),
(31, 'Parlantes', '2298.00', 'Philips'),
(32, 'Joystick', '2247.00', 'Ptz'),
(33, 'Router', '418.00', 'Extender'),
(34, 'Switch', '202.00', 'TP-Link'),
(35, 'Placa de red', '228.00', 'TP-Link');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stockproducto`
--

CREATE TABLE `stockproducto` (
  `codigo` int(10) NOT NULL,
  `sucursal` varchar(60) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fechaAlta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stockproducto`
--

INSERT INTO `stockproducto` (`codigo`, `sucursal`, `cantidad`, `fechaAlta`) VALUES
(1, 'Centro', 20, '2016-01-25'),
(1, 'Diadema', 10, '2016-01-25'),
(1, 'Pueyrredon', 30, '2015-06-07'),
(1, 'Rada Tilly', 5, '2015-06-07'),
(2, 'Centro', 25, '2016-02-18'),
(2, 'Diadema', 12, '2016-02-18'),
(2, 'Moreno', 14, '2015-01-05'),
(2, 'Pueyrredon', 4, '2015-01-05'),
(3, 'Centro', 8, '2014-03-12'),
(3, 'Diadema', 18, '2014-03-12'),
(3, 'Pueyrredon', 0, '2015-01-05'),
(3, 'Rada Tilly', 1, '2015-01-05'),
(4, 'Centro', 4, '2015-01-05'),
(4, 'Diadema', 5, '2015-01-05'),
(4, 'Pueyrredon', 14, '2015-01-05'),
(4, 'Rada Tilly', 9, '2015-01-05'),
(5, 'Centro', 71, '2015-01-05'),
(5, 'Norte', 41, '2015-01-05'),
(5, 'Pueyrredon', 29, '2015-01-05'),
(5, 'Sarmiento', 20, '2015-01-05'),
(6, 'Centro', 78, '2015-12-13'),
(6, 'Moreno', 4, '2015-01-05'),
(6, 'Pueyrredon', 20, '2015-01-05'),
(6, 'Rada Tilly', 17, '2015-12-13'),
(7, 'Centro', 0, '2017-06-04'),
(7, 'Pueyrredon', 0, '2014-04-03'),
(7, 'Rada Tilly', 0, '2017-06-04'),
(7, 'Saavedra', 0, '2014-04-03'),
(8, 'Centro', 24, '2016-03-18'),
(8, 'Pueyrredon', 30, '2016-07-08'),
(8, 'Rada Tilly', 10, '2016-07-08'),
(8, 'Sur', 24, '2016-03-18'),
(9, 'Pueyrredon', 42, '2017-05-03'),
(9, 'Saavedra', 2, '2017-05-03'),
(10, 'Centro', 32, '2016-07-08'),
(10, 'Sur', 37, '2016-07-08'),
(11, 'Centro', 7, '2015-06-07'),
(11, 'Moreno', 62, '2016-09-03'),
(11, 'Pueyrredon', 6, '2016-09-03'),
(11, 'Sur', 7, '2015-06-07'),
(12, 'Centro', 26, '2016-09-03'),
(12, 'Norte', 47, '2014-03-12'),
(12, 'Pueyrredon', 26, '2014-03-12'),
(12, 'Sur', 6, '2016-09-03'),
(13, 'Centro', 40, '2014-02-01'),
(13, 'Norte', 8, '2014-03-12'),
(13, 'Pueyrredon', 80, '2014-03-12'),
(13, 'Sur', 4, '2014-02-01'),
(14, 'Centro', 17, '2016-07-08'),
(14, 'Pueyrredon', 12, '2014-02-01'),
(14, 'Rada Tilly', 12, '2014-02-01'),
(14, 'Sur', 17, '2016-07-08'),
(15, 'Centro', 22, '2014-02-01'),
(15, 'Pueyrredon', 0, '2014-02-01'),
(15, 'Saavedra', 0, '2014-02-01'),
(15, 'Sur', 56, '2014-02-01'),
(16, 'Centro', 8, '2015-12-13'),
(16, 'Moreno', 25, '2014-02-01'),
(16, 'Pueyrredon', 23, '2014-02-01'),
(16, 'Sur', 8, '2015-12-13'),
(17, 'Centro', 14, '2015-01-05'),
(17, 'Pueyrredon', 22, '2014-02-01'),
(17, 'Rada Tilly', 32, '2014-02-01'),
(17, 'Sur', 14, '2015-01-05'),
(18, 'Centro', 2, '2014-02-01'),
(18, 'Pueyrredon', 14, '2017-05-03'),
(18, 'Rada Tilly', 23, '2017-05-03'),
(18, 'Sur', 2, '2014-02-01'),
(19, 'Centro', 1, '2015-12-13'),
(19, 'Moreno', 6, '2016-07-08'),
(19, 'Pueyrredon', 61, '2016-07-08'),
(19, 'Sur', 1, '2015-12-13'),
(20, 'Centro', 0, '2014-02-01'),
(20, 'Diadema', 20, '2016-07-08'),
(20, 'Pueyrredon', 17, '2016-07-08'),
(20, 'Rada Tilly', 0, '2014-02-01'),
(21, 'Centro', 0, '2015-01-05'),
(21, 'Moreno', 3, '2016-07-08'),
(21, 'Pueyrredon', 30, '2016-07-08'),
(21, 'Rada Tilly', 0, '2015-01-05'),
(22, 'Centro', 6, '2016-07-08'),
(22, 'Pueyrredon', 24, '2016-03-18'),
(22, 'Rada Tilly', 12, '2016-03-18'),
(22, 'Sarmiento', 6, '2016-07-08'),
(23, 'Centro', 7, '2013-04-25'),
(23, 'Pueyrredon', 12, '2016-02-18'),
(23, 'Rada Tilly', 28, '2016-02-18'),
(23, 'Sarmiento', 7, '2013-04-25'),
(24, 'Centro', 8, '2012-07-26'),
(24, 'Pueyrredon', 31, '2016-01-25'),
(24, 'Rada Tilly', 20, '2016-01-25'),
(24, 'Sarmiento', 8, '2012-07-26'),
(25, 'Centro', 14, '2017-05-03'),
(25, 'Pueyrredon', 11, '2015-12-13'),
(25, 'Rada Tilly', 14, '2015-12-13'),
(25, 'Sarmiento', 19, '2017-05-03'),
(26, 'Centro', 12, '2014-02-01'),
(26, 'Pueyrredon', 1, '2015-12-13'),
(26, 'Saavedra', 1, '2015-12-13'),
(26, 'Sarmiento', 2, '2014-02-01'),
(27, 'Centro', 11, '2015-12-13'),
(27, 'Norte', 81, '2015-12-13'),
(27, 'Pueyrredon', 8, '2015-12-13'),
(27, 'Sarmiento', 11, '2015-12-13'),
(28, 'Centro', 10, '2016-07-08'),
(28, 'Pueyrredon', 1, '2015-12-13'),
(28, 'Saavedra', 12, '2015-12-13'),
(28, 'Sarmiento', 10, '2016-07-08'),
(29, 'Centro', 8, '2012-07-26'),
(29, 'Pueyrredon', 9, '2017-05-03'),
(29, 'Rada Tilly', 45, '2017-05-03'),
(29, 'Sarmiento', 8, '2012-07-26'),
(30, 'Centro', 9, '2017-05-03'),
(30, 'Pueyrredon', 0, '2017-06-04'),
(30, 'Saavedra', 0, '2017-06-04'),
(30, 'Sarmiento', 15, '2017-05-03'),
(31, 'Centro', 7, '2014-03-12'),
(31, 'Moreno', 4, '2014-02-01'),
(31, 'Pueyrredon', 41, '2014-02-01'),
(31, 'Sarmiento', 7, '2014-03-12'),
(32, 'Centro', 2, '2017-05-03'),
(32, 'Norte', 63, '2013-04-25'),
(32, 'Pueyrredon', 7, '2013-04-25'),
(32, 'Sarmiento', 2, '2017-05-03'),
(33, 'Centro', 1, '2012-07-26'),
(33, 'Pueyrredon', 1, '2012-07-26'),
(33, 'Saavedra', 15, '2012-07-26'),
(33, 'Sarmiento', 1, '2012-07-26'),
(34, 'Centro', 0, '2014-04-03'),
(34, 'Diadema', 6, '2012-07-26'),
(34, 'Pueyrredon', 8, '2012-07-26'),
(34, 'Rada Tilly', 0, '2014-04-03'),
(35, 'Centro', 4, '2015-01-05'),
(35, 'Pueyrredon', 8, '2012-07-26'),
(35, 'Rada Tilly', 12, '2012-07-26'),
(35, 'Sarmiento', 4, '2015-01-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `stockproducto`
--
ALTER TABLE `stockproducto`
  ADD PRIMARY KEY (`codigo`,`sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
