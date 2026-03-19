-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-06-2016 a las 01:11:42
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `nroDocumento` int(8) NOT NULL,
  `ApellidoNombre` varchar(50) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  PRIMARY KEY (`nroDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`nroDocumento`, `ApellidoNombre`, `domicilio`) VALUES
(1011993, 'MATHIAS JUAN MANUEL           ', 'CONGRESO       1440           '),
(1011996, 'BARRIENTOS NAVARRO MARIA', 'ANTONIO OSTOICH  1458         '),
(1011999, 'ULLOA MARCELINA ESTHER        ', 'CODIGO 489 N. 1280            '),
(1012001, 'VELASQUEZ JOSE                ', 'OSTOICH        1280           '),
(1031998, 'OJEDA HERMES HERNAN           ', 'LA PULPERIA 30                '),
(1092000, 'VIDAL CARLOS                  ', 'HICHAZO BLANCO 0820           '),
(1101998, 'LEVIEN HECTOR                 ', 'RAFAEL UROZ NRO. 50           '),
(1111999, 'SALDIVIA CARMEN               ', 'JUAN ALTAVISTA 4870           '),
(2072003, 'MILLATUREO JUAN F.            ', 'LUIS SANDRINI 4670            '),
(4092001, 'SALDIVIA GOMEZ MAGALI         ', 'JAIME DAVALOS 4624            '),
(5072000, 'SANTANDER JOSE                ', 'ANGEL VELAZ 1615              '),
(5092003, 'LEIVA TALMA                   ', 'JAIME DAVALOS NRO 4710        '),
(5472399, 'BUSTAMANTE SEGUNDO            ', 'LUIS SANDRINI 4772            '),
(6102000, 'TURRA ANA ROSARIO             ', 'J. CARLOS ALTAVISTA 4772      '),
(6112006, 'QUELIN J. ROBERTO Y OTROS     ', 'SUCRE 121                     '),
(6701150, 'YAÑEZ ORFELINA DEL CARMEN     ', 'SUCRE 130                     '),
(6948184, 'GALLARDO HERNANDEZ FRANCISCO  ', 'LAFERRERE 2264                '),
(7052013, 'BARRIENTOS PAREDES MARIA      ', 'LAS VIOLETAS 1316             '),
(7112012, 'BARRIA MIRANDA ELENA          ', 'RAMOS RUIZ 985-Bo.Vialidad    '),
(7121991, 'BAHAMONDE JOSE MIGUEL         ', 'DABROSKI LUIS 1672            '),
(7815660, 'LILLO GONZALEZ JOSE           ', 'PUNTA NOVALES 950             '),
(8012015, 'CAILEO J Y DIAZ J             ', 'CANCHA RAYADA 183             '),
(8017512, 'CARCAMO JOSE ZOILO            ', 'SUPREMACIA     0870           '),
(9091994, 'RUBILAR EDITA                 ', 'DE MAR ESTRELLA0258           '),
(10145998, 'HUENCHUMAN HUENTEN JUAN O.    ', 'LOS CIRUELOS 4466             '),
(11061996, 'SOTO CARDENAS CELEDONIO       ', 'TIMOTEO ORTEGO N 4618         '),
(11062013, 'MANSILLA MANUEL A             ', 'CAIQUEN 2355                  '),
(11122002, 'BLANCA LUZ BAHAMONDE          ', 'JESUS MARCIAL 8253            '),
(11669931, 'LINCOMAN OSVALDO              ', 'HIPOLITO YRIGOYEN 3428        '),
(14011988, 'SANSANA RIGOBERTO             ', 'MARIANO RODRIGO               '),
(14092006, 'URIBE JOSE ADALIO             ', 'LINEAS AEREAS D2419           '),
(14102005, 'ALONSO LINCURA ISMAEL         ', 'CALLE 534 NRO 3644.           '),
(14389956, 'PEREZ ALVAREZ ROGELI          ', 'FORMOSA 3619                  '),
(14835669, 'SANTIBAEZ AMADEO GUILLERMO   ', 'LOS JAZMINES   1472           '),
(16001247, 'CHIGUAY JUAN ANASELI          ', 'LOS PLATANOS 3740             '),
(16001566, 'SOVIER AUGUSTO                ', 'LOS CLAVELES 1279             '),
(16363179, 'MILLAN SERGIO                 ', 'LOS CLAVELES   1229           '),
(16757560, 'BARRIA ANDRADE JOSE           ', 'GUSTAVO BAHAMONDE 2758        '),
(18021998, 'GALLARDO ORZODINDO            ', 'ADOLFO ARIGONI 1568           '),
(18042038, 'BARRIA MANUEL ANTONIO         ', 'ORTEGA JOSE 1584              '),
(18072007, 'NAVARRO ANA DE                ', 'CARLOS CAMPOS 1758            '),
(18543326, 'GALLARDO VICENTA VDA          ', 'JAIME DE GUEVARA 1726         '),
(18649940, 'PAILLAN EMILIO                ', 'MARCELO BERBEL 1735           '),
(18711065, 'CARDENAS PAREDES P            ', '12 DE OCTUBRE  3342           '),
(18771206, 'MANZUR, ANA MARIA             ', 'JESUS MARCIAL  970            '),
(18796843, 'GUICHAPANI JUAN ANTO          ', 'AV.TEHUELCHES 1015 KM.3       '),
(18832306, 'GALINDO ANA ELVIRA            ', 'SAN MARTIN 1641               '),
(19041993, 'URIBE MANSILLA CAMIL          ', 'BASE MATIENZO  1320           '),
(19062013, 'CARCAMO CARLOS                ', 'GANZOS VERDES 4454            '),
(20682028, 'AGUERO RICARDO                ', 'CALLE 683 Nro 1466            '),
(22042003, 'ZUNIGA IRIS YOLANDA           ', 'COD.685-NRO.1370-ZONA DE QUINT'),
(22621685, 'ZUÑIGA TERESA GLADYS          ', 'JUAN LUKEWICH    691          '),
(23112012, 'PEREZ VIDAL OLEGARIO          ', 'COLOMBIA 525                  '),
(23121264, 'ALARCON GUZMAN JOSE           ', 'GUATEMALA 580                 '),
(23180563, 'ZU/IGA, RAFAEL ORLANDO        ', 'FORMOSA        1245           '),
(23247170, 'SOTO JUAN PEDRO               ', 'PJE. 590 NRO. 1450            '),
(23530094, 'LUNA FELIX EDUARDO            ', 'MISIONES 1265                 '),
(24096418, 'MILLAR PABLO                  ', 'PASAJE 679     1450           '),
(24122008, 'DIAZ JOSE SIDERIO             ', 'MISIONES 1280                 '),
(24302080, 'GONZALEZ LUZ NORMA            ', 'AVDA.H.YRIGOYEN4900           '),
(24302353, 'MIRANDA MONICA ESTELA         ', 'CODIGO 2434 CASA 1340-D.BOSCO '),
(24929810, 'BARRIAS ADRIANA DE            ', 'ASOC. VEC. STANDART NORTE     '),
(24947936, 'MENDEZ OSCAR EDUARDO          ', 'CODIGO 2437    1458           '),
(25078405, 'MANSILLA JOSE CARLOS          ', 'CALLE 52 CASA 581             '),
(25191962, 'ALTAMIRANO LUIS               ', 'COD 2431 CASA 837             '),
(25280974, 'VERA ROSAMEL                  ', 'CALLE 709 Nro 3051            '),
(25619217, 'DELGADO SALDIVIA PEDRO        ', 'CODIGO 710     3015           '),
(26128034, 'MARICOY MARIA ANTONIA         ', 'AVDA.DEL PARQUE 444-LAS ARQUID'),
(26128429, 'MOLINA CHAVEZ GERARDO         ', 'E. LARRETA 64 B PTE, ORTIZ    '),
(26219683, 'HARO CARLOS                   ', 'DEL PARQUE     0518           '),
(26415850, 'BARRIA ULLOA ARTURO           ', 'COLONOS CHECOLOSVACOS 1678    '),
(26415892, 'OYARZO SUBIABRE JUAN          ', 'CALLE 555 Nro. 2474           '),
(26845236, 'REALES JORGE EDUARDO          ', 'BASE IRIZAR    1162           '),
(26857280, 'BARUZZO DANIEL                ', 'CALLE 0758     4813           '),
(26857497, 'VIDAL OSORIO RICARDO          ', 'BATALLA DE GANS3975           '),
(26898240, 'VIDAL JOSE EMILIO             ', 'J. DE NEVARES 1579            '),
(27493667, 'AGUILA TORRES-SOTO GUIDO OMAR ', 'LAS MARGARITAS 1268           '),
(27669058, 'DIAZ GABINO SEGUNDO           ', 'LUIS SAENZ PENIA 2080         '),
(27814445, 'CARDENAS MANSILLA JOSE        ', 'CRONICA Nro 684               '),
(27814458, 'CARDENAS HERNANDEZ DANIEL     ', 'EL DOMADOR Nro 738            '),
(28021185, 'MANSILLA JUAN                 ', 'CALLE 640 Nro 3562            '),
(28075237, 'MALDONADO MARIA P.            ', 'CALLE 852 Nro 809             '),
(28403344, 'MARQUEZ AGUILA MANUE          ', 'CALLE 0640     3466           '),
(28740105, 'LLANCAMAN GODOY MARIA         ', 'AV. TEHUELCHES Nro 431        '),
(28872291, 'GUICHA REINALDO               ', 'PIEDRABUENA LUIS COMA. Nro 542'),
(29090289, 'HERNANDEZ SOTO FROIL          ', 'GOLFO SAN JORGE Nro 10  "2"   '),
(29101998, 'OJEDA MARIA RAQUEL            ', 'COX GUILLERMO Nro 170         '),
(29111995, 'COPTO MARIA LUCILA            ', 'CARRIZO ANTONIO ISAIAS Nro1127'),
(29342769, 'MARICOY,OFELIA NAHUELQUIN VDA ', 'MONTES DE OCA Nro 428         '),
(29425037, 'ESPINDOLA MIGUEL ANGEL        ', 'LOS GALESES Nro 226           '),
(29585829, 'CHAVEZ JOSE ERASMO            ', 'FOYEL Nro 198                 '),
(29585876, 'BARRIA B R Y VIVAR            ', 'MONTES DE OCA Nro 428         '),
(29671741, 'GONZALEZ JUAN ANGEL           ', 'TOMAS PEDRAZA 1822            '),
(29750832, 'DIAZ JUAN Y OJEDA IGOR MARIA  ', 'ANTONIO MORAN Nro. 815        '),
(29797408, 'QUINTEROS JUAN Y BARRIENTOS L.', 'JULIO BENITEZ Nro. 2621       '),
(29957335, 'GONZALEZ Y NIRILEFF           ', 'VELEZSARSFIELD1370 PISO1 DPTO4'),
(30051986, 'PEREZ AGUSTINA                ', 'TRES SARGENTOS Nro 2825       '),
(30112006, 'OCHOA RICARDO DANIEL          ', 'RENZO ADAMES 2613             '),
(30351997, 'MUJICA ROBERTO OSCAR          ', 'PASAJE Nro 126                '),
(30521046, 'DELGADO LUIS CESAR            ', 'MARIANO RODRIGUEZ Nro. 161    '),
(30661603, 'RUIZ CRISTINA ISABEL          ', 'DEIPEINAU FEDERICO            '),
(30661649, 'CABEZAS JUSTO                 ', 'LOS PINOS Nro 950             '),
(31071985, 'HARO IRINEO                   ', 'SANCHEZ FLORENCIO Nro 3170    '),
(31072007, 'VIDAL TRONCOSO HAYDEE         ', 'CALLE 651 Nro 1964            '),
(31102012, 'ZILCH WALTER                  ', 'CAIQUEN Nro 2077              '),
(31360698, 'ULLOA VICTORIA DEL CARMEN     ', 'LAS FRESAS 4662               '),
(31441006, 'AGUILAR GALLARDO H            ', 'LAS FRESAS 4778               '),
(31637601, 'GUINAO JUAN                   ', 'FRANCISCO  BEHR Nro 415       '),
(31637690, 'CARDENAS FRADIO Y MOREYRA A.  ', 'COD 847 N 1805                '),
(31818205, 'GONZALEZ MIGUEL A.            ', 'CAMARONES Nro 5106            '),
(31958837, 'MALDONADO, OTILIA M.          ', 'FRANCISCO BEHR Nro 785        '),
(31985732, 'GARCIA LAURA ESTHER           ', 'COMUNIDAD 2487                '),
(32441429, 'CONTRERAS FRANCISCO           ', 'DEIPENAU FEDERICO MZ:H LOTE:3 '),
(32955856, 'OYARZO AMELIA                 ', 'DEIPENAU FEDERICO             '),
(33153973, 'VIDAL CONTRERAS JUAN PEDRO    ', 'ONAS NRO 2980                 '),
(33161190, 'LATURRETE MOLINA LUIS         ', 'CRUZ DEL SUR Nro 270 Dpto 10  '),
(33182777, 'CAMPOS SANDRA                 ', 'JUAN JOSE PASO Nro. 1213      '),
(33316063, 'QUELIPANI, RAMON R            ', 'CODIGO 1585 CASA 1863         '),
(33412608, 'VARGAS VARGAS, BONIFACIA      ', 'BENITO LINCH 1187             '),
(33450684, 'GALLARDO JOSE M               ', 'LOS ESPA/ES KM PASO NUEVO 170 '),
(33466604, 'SUBIABRE JUAN SIMON           ', 'MARTIN NAGAIN Nro:5           '),
(33467244, 'SANTANDER CESAR               ', 'CODIGO 2434 Nro 1768          '),
(34606606, 'HUENCHILLA ADOLFO             ', 'POLONIA Nro 1343              '),
(35047266, 'CORONADO JOSE NEMESI          ', 'MZA 1 LOTE 8 (S/N) KM17       '),
(35383046, 'BIBLIOTECA POPULAR BARRIO GOBE', 'FRANCISCO BEHR Nro 248 P.1 "B"'),
(35383427, 'TORRES CESAR Y LEIVA GABRIEL  ', 'FRANCISCO DE VIEDMA Nro 174   '),
(35659499, 'GORDILLO RITA                 ', 'CODIGO 561 NRO 3185           '),
(37347569, 'MARTIN, SELVA ESTRELLA        ', 'ANTOFAGASTA 617               '),
(92382087, 'SOTO OMAR                     ', 'POLONIA Nro 1971              '),
(92394682, 'TOROS LEONILA                 ', 'COMUNIDAD N 2480              '),
(92524103, 'INALEFF BERNABE               ', 'CALLE 2 Nro 1858              '),
(92534511, 'MANSILLA CLOTILDE             ', 'LOS ANDES Nro 830             '),
(92756674, 'BARRIENTOS ESTELA             ', 'FRAGATA SARMIENTO N924        '),
(93029205, 'PEREZ EDITA ELIANA            ', 'RUCCI IGNACIO Nro 2060        '),
(93735983, 'DIAZ JUAN                     ', 'HUERGO 3915                   '),
(94223988, 'OYARZO GODOY ELBA             ', 'CODIGO CASA 1 Nro 1975        '),
(94325727, 'VIDAL JOSE IGNACIO            ', 'GUARANIES Nro 504             ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `nroComentario` int(11) NOT NULL AUTO_INCREMENT,
  `idInmueble` int(10) NOT NULL,
  `fechaComentario` date NOT NULL,
  `comentario` varchar(500) NOT NULL,
  PRIMARY KEY (`nroComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE IF NOT EXISTS `inmueble` (
  `idInmueble` int(11) NOT NULL AUTO_INCREMENT,
  `tipoInmueble` enum('Casa','Departamento','Terreno','Quinta') NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `cantidadDormitorios` int(2) NOT NULL,
  `mejoras` enum('Jardin','Piscina','Garage','Cercado','Sin cerco') NOT NULL,
  `cantidadBanios` int(2) NOT NULL,
  `observacion` varchar(200) NOT NULL,
  PRIMARY KEY (`idInmueble`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=257 ;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`idInmueble`, `tipoInmueble`, `domicilio`, `cantidadDormitorios`, `mejoras`, `cantidadBanios`, `observacion`) VALUES
(1, 'Departamento', '12 DE OCTUBRE  3342           ', 3, 'Garage', 1, ''),
(2, 'Departamento', 'ADOLFO ARIGONI 1568           ', 1, 'Garage', 1, ''),
(3, 'Casa', 'ANGEL VELAZ 1615              ', 4, 'Jardin', 2, ' Casa con linda vista'),
(4, 'Casa', 'ANTOFAGASTA 617               ', 2, 'Cercado', 1, 'Cerco esta nuevo'),
(5, 'Casa', 'San Martín Nro. 150', 2, 'Cercado', 1, 'Es bonita'),
(6, 'Departamento', 'ANTONIO OSTOICH  1458         ', 2, 'Garage', 1, ''),
(7, 'Terreno', 'ASOC. VEC. STANDART NORTE     ', 0, 'Cercado', 0, ''),
(8, 'Departamento', 'AV. TEHUELCHES Nro 431        ', 2, 'Piscina', 1, ''),
(9, 'Departamento', 'AV.TEHUELCHES 1015 KM.3       ', 2, 'Piscina', 1, ''),
(10, 'Departamento', 'AVDA.DEL PARQUE 444-LAS ARQUID', 2, 'Piscina', 1, ''),
(11, 'Quinta', 'AVDA.H.YRIGOYEN4900           ', 2, 'Piscina', 2, ''),
(12, 'Terreno', 'BASE IRIZAR    1162           ', 0, 'Cercado', 0, ''),
(13, 'Departamento', 'BASE MATIENZO  1320           ', 3, 'Piscina', 2, ''),
(14, 'Departamento', 'BATALLA DE GANS3975           ', 3, 'Garage', 2, ''),
(15, 'Departamento', 'BENITO LINCH 1187             ', 4, 'Jardin', 2, 'Blaba bala'),
(16, 'Casa', 'BUQUE LA PLATA Nro 90         ', 2, 'Cercado', 1, 'No tiene vecinos molestos'),
(17, 'Departamento', 'CAIQUEN 2355                  ', 4, 'Jardin', 2, 'Blaba bala'),
(18, 'Casa', 'CAIQUEN 2441                  ', 3, 'Cercado', 1, ''),
(19, 'Casa', 'CAIQUEN Nro 2077              ', 5, 'Cercado', 3, ''),
(20, 'Departamento', 'CALLE 0640     3466           ', 4, 'Jardin', 2, 'Blaba bala'),
(21, 'Terreno', 'CALLE 0758     4813           ', 0, 'Cercado', 0, ''),
(22, 'Quinta', 'CALLE 2 Nro 1858              ', 4, 'Garage', 1, ''),
(23, 'Casa', 'CALLE 52 CASA 581             ', 7, 'Sin cerco', 5, 'Blaba bala'),
(24, 'Terreno', 'CALLE 534 NRO 3644.           ', 0, 'Cercado', 0, ''),
(25, 'Terreno', 'CALLE 555 Nro. 2474           ', 0, 'Cercado', 0, ''),
(26, 'Casa', 'CALLE 640 Nro 3562            ', 1, 'Sin cerco', 1, 'Blaba bala'),
(27, 'Casa', 'CALLE 651 Nro 1964            ', 1, 'Sin cerco', 1, 'Blaba bala'),
(28, 'Terreno', 'CALLE 683 Nro 1466            ', 0, 'Cercado', 0, ''),
(29, 'Casa', 'CALLE 709 Nro 3051            ', 1, 'Sin cerco', 1, 'Blaba bala'),
(30, 'Casa', 'CALLE 852 Nro 809             ', 3, 'Jardin', 2, 'Blaba bala'),
(31, 'Casa', 'CAMARONES Nro 5106            ', 2, 'Jardin', 2, 'Blaba bala'),
(32, 'Quinta', 'CANCHA RAYADA 183             ', 5, 'Piscina', 1, ''),
(33, 'Casa', 'CARLOS CAMPOS 1758            ', 3, 'Jardin', 2, ''),
(34, 'Casa', 'CARRIZO ANTONIO ISAIAS Nro1127', 3, 'Jardin', 2, ''),
(35, 'Casa', 'COD 2431 CASA 837             ', 3, 'Jardin', 1, ''),
(36, 'Quinta', 'COD 847 N 1805                ', 3, 'Garage', 1, ''),
(37, 'Casa', 'COD.685-NRO.1370-ZONA DE QUINT', 2, 'Garage', 1, ''),
(38, 'Terreno', 'CODIGO 1585 CASA 1863         ', 0, 'Cercado', 0, ''),
(39, 'Casa', 'CODIGO 2434 CASA 1340-D.BOSCO ', 2, 'Garage', 1, ''),
(40, 'Casa', 'CODIGO 2434 Nro 1768          ', 2, 'Garage', 1, ''),
(41, 'Casa', 'CODIGO 2437    1458           ', 2, 'Garage', 1, ''),
(42, 'Departamento', 'CODIGO 489 N. 1280            ', 4, 'Jardin', 3, 'Blaba bala'),
(43, 'Quinta', 'CODIGO 561 NRO 3185           ', 2, 'Garage', 1, ''),
(44, 'Casa', 'CODIGO 710     3015           ', 2, 'Garage', 2, ''),
(45, 'Terreno', 'CODIGO CASA 1 Nro 1975        ', 0, 'Cercado', 0, ''),
(46, 'Terreno', 'COLOMBIA 525                  ', 0, 'Cercado', 0, ''),
(47, 'Terreno', 'COLONOS CHECOLOSVACOS 1678    ', 0, 'Sin cerco', 0, ''),
(48, 'Casa', 'COMUNIDAD 2487                ', 2, 'Garage', 2, ''),
(49, 'Departamento', 'COMUNIDAD N 2480              ', 4, 'Jardin', 3, 'Blaba bala'),
(50, 'Quinta', 'CONGRESO       1440           ', 2, 'Piscina', 3, ''),
(51, 'Terreno', 'COX GUILLERMO Nro 170         ', 0, 'Sin cerco', 0, ''),
(52, 'Quinta', 'CRONICA Nro 684               ', 3, 'Garage', 3, ''),
(53, 'Quinta', 'CRUZ DEL SUR Nro 270 Dpto 10  ', 3, 'Garage', 3, ''),
(54, 'Terreno', 'DABROSKI LUIS 1672            ', 0, 'Sin cerco', 0, ''),
(55, 'Casa', 'DE MAR ESTRELLA0258           ', 1, 'Garage', 2, ''),
(56, 'Casa', 'DEIPEINAU FEDERICO            ', 1, 'Garage', 1, ''),
(57, 'Terreno', 'DEIPENAU FEDERICO             ', 0, 'Sin cerco', 0, ''),
(58, 'Casa', 'DEIPENAU FEDERICO MZ:H LOTE:3 ', 1, 'Piscina', 1, ''),
(59, 'Quinta', 'DEL PARQUE     0518           ', 3, 'Garage', 1, ''),
(60, 'Casa', 'E. LARRETA 64 B PTE, ORTIZ    ', 3, 'Piscina', 1, ''),
(61, 'Quinta', 'EL DOMADOR Nro 738            ', 3, 'Piscina', 4, ''),
(62, 'Casa', 'FORMOSA        1245           ', 3, 'Piscina', 1, ''),
(63, 'Departamento', 'FORMOSA 3619                  ', 4, 'Jardin', 3, 'Blaba bala'),
(64, 'Casa', 'FOYEL Nro 198                 ', 3, 'Piscina', 1, ''),
(65, 'Terreno', 'FRAGATA SARMIENTO N924        ', 0, 'Sin cerco', 0, ''),
(66, 'Quinta', 'FRANCISCO  BEHR Nro 415       ', 4, 'Jardin', 4, ''),
(67, 'Terreno', 'FRANCISCO BEHR Nro 248 P.1 "B"', 0, 'Sin cerco', 0, ''),
(68, 'Departamento', 'FRANCISCO BEHR Nro 785        ', 2, 'Garage', 3, 'Blaba bala'),
(69, 'Departamento', 'FRANCISCO DE VIEDMA Nro 174   ', 1, 'Garage', 1, 'Blaba bala'),
(70, 'Departamento', 'GANZOS VERDES 4454            ', 3, 'Garage', 1, 'Blaba bala'),
(71, 'Quinta', 'GOLFO SAN JORGE Nro 10  "2"   ', 4, 'Jardin', 4, ''),
(72, 'Departamento', 'GUARANIES Nro 504             ', 1, 'Garage', 1, ''),
(73, 'Departamento', 'GUATEMALA 580                 ', 3, 'Garage', 1, ''),
(74, 'Terreno', 'GUSTAVO BAHAMONDE 2758        ', 0, 'Sin cerco', 0, ''),
(75, 'Departamento', 'HICHAZO BLANCO 0820           ', 2, 'Garage', 2, ''),
(76, 'Departamento', 'HIPOLITO YRIGOYEN 3428        ', 2, 'Garage', 2, ''),
(77, 'Casa', 'HUERGO 3915                   ', 3, 'Piscina', 1, ''),
(78, 'Casa', 'J. CARLOS ALTAVISTA 4772      ', 3, 'Piscina', 1, ''),
(79, 'Departamento', 'J. DE NEVARES 1579            ', 2, 'Garage', 2, ''),
(80, 'Quinta', 'JAIME DAVALOS 4624            ', 4, 'Jardin', 5, ''),
(81, 'Departamento', 'JAIME DAVALOS NRO 4710        ', 2, 'Garage', 1, ''),
(82, 'Casa', 'JAIME DE GUEVARA 1726         ', 4, 'Jardin', 3, ''),
(83, 'Departamento', 'JESUS MARCIAL  970            ', 3, 'Jardin', 1, ''),
(84, 'Departamento', 'JESUS MARCIAL 8253            ', 1, 'Jardin', 1, ''),
(85, 'Casa', 'JUAN ALTAVISTA 4870           ', 2, 'Jardin', 2, ''),
(86, 'Quinta', 'JUAN JOSE PASO Nro. 1213      ', 5, 'Piscina', 5, ''),
(87, 'Departamento', 'JUAN LUKEWICH    691          ', 1, 'Jardin', 1, ''),
(88, 'Terreno', 'JULIO BENITEZ Nro. 2621       ', 0, 'Sin cerco', 0, ''),
(89, 'Terreno', 'LA PULPERIA 30                ', 0, 'Sin cerco', 0, ''),
(90, 'Casa', 'LAFERRERE 2264                ', 2, 'Jardin', 3, ''),
(91, 'Departamento', 'LAS FRESAS 4662               ', 1, 'Piscina', 3, ''),
(92, 'Terreno', 'LAS FRESAS 4778               ', 0, 'Sin cerco', 0, ''),
(93, 'Casa', 'LAS MARGARITAS 1268           ', 1, 'Jardin', 3, ''),
(94, 'Terreno', 'LAS VIOLETAS 1316             ', 0, 'Cercado', 0, ''),
(95, 'Departamento', 'LINEAS AEREAS D2419           ', 1, 'Garage', 3, ''),
(96, 'Casa', 'LOS ANDES Nro 830             ', 1, 'Jardin', 2, ''),
(97, 'Quinta', 'LOS CIRUELOS 4466             ', 5, 'Jardin', 5, ''),
(98, 'Casa', 'LOS CLAVELES   1229           ', 1, 'Jardin', 1, ''),
(99, 'Casa', 'LOS CLAVELES 1279             ', 4, 'Jardin', 3, ''),
(100, 'Casa', 'LOS ESPA/ES KM PASO NUEVO 170 ', 2, 'Jardin', 1, ''),
(101, 'Casa', 'LOS GALESES Nro 226           ', 2, 'Jardin', 1, ''),
(102, 'Casa', 'LOS JAZMINES   1472           ', 2, 'Jardin', 1, ''),
(103, 'Terreno', 'LOS PINOS Nro 950             ', 0, 'Cercado', 0, ''),
(104, 'Casa', 'LOS PLATANOS 3740             ', 2, 'Jardin', 1, ''),
(105, 'Departamento', 'LUIS DABROWSKI 1634           ', 1, 'Garage', 3, ''),
(106, 'Casa', 'LUIS SAENZ PENIA 2080         ', 2, 'Jardin', 1, ''),
(107, 'Departamento', 'LUIS SANDRINI 4670            ', 3, 'Garage', 1, ''),
(108, 'Terreno', 'LUIS SANDRINI 4772            ', 0, 'Cercado', 0, ''),
(109, 'Terreno', 'MARCELO BERBEL 1735           ', 0, 'Cercado', 0, ''),
(110, 'Casa', 'MARIANO RODRIGO               ', 2, 'Jardin', 1, ''),
(111, 'Casa', 'MARIANO RODRIGUEZ Nro. 161    ', 3, 'Piscina', 2, ''),
(112, 'Departamento', 'MARTIN NAGAIN Nro:5           ', 2, 'Garage', 1, ''),
(113, 'Departamento', 'MISIONES 1265                 ', 1, 'Garage', 1, ''),
(114, 'Casa', 'MISIONES 1280                 ', 3, 'Piscina', 2, ''),
(115, 'Departamento', 'MONTES DE OCA Nro 428         ', 3, 'Garage', 1, ''),
(116, 'Terreno', 'MONTES DE OCA Nro 428         ', 0, 'Cercado', 0, ''),
(117, 'Casa', 'MZA 1 LOTE 8 (S/N) KM17       ', 3, 'Piscina', 2, ''),
(118, 'Departamento', 'ONAS NRO 2980                 ', 4, 'Garage', 1, ''),
(119, 'Casa', 'ORTEGA JOSE 1584              ', 3, 'Piscina', 1, ''),
(120, 'Departamento', 'OSTOICH        1280           ', 2, 'Garage', 2, ''),
(121, 'Casa', 'PASAJE 679     1450           ', 2, 'Piscina', 1, ''),
(122, 'Casa', 'PASAJE Nro 126                ', 3, 'Sin cerco', 2, ''),
(123, 'Quinta', 'PIEDRABUENA LUIS COMA. Nro 542', 5, 'Jardin', 4, ''),
(124, 'Casa', 'PJE. 590 NRO. 1450            ', 2, 'Sin cerco', 2, ''),
(125, 'Quinta', 'POLONIA Nro 1343              ', 2, 'Jardin', 1, ''),
(126, 'Casa', 'POLONIA Nro 1971              ', 3, 'Sin cerco', 2, ''),
(127, 'Departamento', 'PUNTA NOVALES 950             ', 1, 'Garage', 2, ''),
(128, 'Quinta', 'RAFAEL UROZ NRO. 50           ', 2, 'Piscina', 2, ''),
(129, 'Terreno', 'RAMOS RUIZ 985-Bo.Vialidad    ', 0, 'Cercado', 0, ''),
(130, 'Terreno', 'RENZO ADAMES 2613             ', 0, 'Cercado', 0, ''),
(131, 'Departamento', 'REPUBLICA DOMINICANA 685      ', 2, 'Garage', 2, ''),
(132, 'Casa', 'RIVADAVIA 4050                ', 2, 'Sin cerco', 2, ''),
(133, 'Terreno', 'RUCCI IGNACIO Nro 2060        ', 0, 'Cercado', 0, ''),
(134, 'Casa', 'SAN MARTIN 1641               ', 2, 'Sin cerco', 2, ''),
(135, 'Quinta', 'SANCHEZ FLORENCIO Nro 3170    ', 5, 'Jardin', 2, ''),
(136, 'Terreno', 'SUCRE 121                     ', 0, 'Cercado', 0, ''),
(137, 'Departamento', 'SUCRE 130                     ', 2, 'Garage', 2, ''),
(138, 'Departamento', 'SUPREMACIA     0870           ', 2, 'Garage', 2, ''),
(139, 'Casa', 'TIMOTEO ORTEGO N 4618         ', 1, 'Sin cerco', 1, ''),
(140, 'Quinta', 'TOMAS PEDRAZA 1822            ', 5, 'Jardin', 4, ''),
(141, 'Casa', 'TRES SARGENTOS Nro 2825       ', 1, 'Cercado', 1, ''),
(142, 'Quinta', 'VELEZSARSFIELD1370 PISO1 DPTO4', 5, 'Cercado', 5, ''),
(256, 'Casa', 'Salta 1534', 3, 'Jardin', 4, 'Esta en el mejor barrio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operacion`
--

CREATE TABLE IF NOT EXISTS `operacion` (
  `nroOperacion` int(11) NOT NULL AUTO_INCREMENT,
  `idInmueble` int(10) NOT NULL,
  `nroDocumento` int(8) NOT NULL,
  `tipoOperacion` enum('Alquiler','Venta') NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `importe` int(11) NOT NULL,
  PRIMARY KEY (`nroOperacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Volcado de datos para la tabla `operacion`
--

INSERT INTO `operacion` (`nroOperacion`, `idInmueble`, `nroDocumento`, `tipoOperacion`, `FechaInicio`, `FechaFin`, `importe`) VALUES
(1, 4, 1011993, 'Venta', '2012-03-01', '0000-00-00', 245000),
(2, 5, 1011996, 'Venta', '2015-04-01', '0000-00-00', 325000),
(3, 7, 1011999, 'Venta', '2015-02-10', '0000-00-00', 123000),
(4, 12, 1012001, 'Venta', '2016-03-05', '0000-00-00', 150000),
(5, 16, 1031998, 'Venta', '2016-05-04', '0000-00-00', 145000),
(6, 18, 1092000, 'Venta', '2016-05-04', '0000-00-00', 325000),
(7, 19, 1101998, 'Venta', '2016-05-03', '0000-00-00', 145000),
(8, 21, 1111999, 'Alquiler', '2016-04-02', '2018-04-02', 12000),
(9, 24, 2072003, 'Venta', '2016-06-02', '0000-00-00', 145000),
(10, 25, 4092001, 'Venta', '2016-06-02', '0000-00-00', 123000),
(11, 28, 5072000, 'Venta', '2016-06-03', '0000-00-00', 245000),
(12, 38, 5092003, 'Alquiler', '2015-05-02', '2017-05-01', 1200),
(13, 45, 5472399, 'Alquiler', '2015-11-04', '2017-11-03', 1200),
(14, 46, 6102000, 'Alquiler', '2016-06-02', '2018-06-02', 4000),
(26, 1, 8017512, 'Alquiler', '2015-04-01', '2017-03-31', 5000),
(27, 2, 9091994, 'Alquiler', '2012-03-01', '2014-03-01', 14000),
(28, 6, 10145998, 'Alquiler', '2014-05-01', '2016-04-30', 12000),
(29, 14, 11061996, 'Alquiler', '2013-12-01', '2015-12-01', 12000),
(30, 22, 11062013, 'Venta', '2016-06-02', '0000-00-00', 245000),
(31, 36, 11122002, 'Alquiler', '2015-05-02', '2017-05-01', 3500),
(32, 37, 11669931, 'Alquiler', '2015-05-02', '2017-05-01', 23000),
(33, 39, 14011988, 'Alquiler', '2015-10-01', '2017-09-30', 3500),
(34, 40, 14092006, 'Alquiler', '2015-10-01', '2017-09-30', 3200),
(35, 41, 14092006, 'Alquiler', '2015-10-01', '2017-09-30', 23000),
(36, 43, 14102005, 'Alquiler', '2015-11-04', '2017-11-03', 3500),
(37, 44, 14389956, 'Alquiler', '2015-11-04', '2017-11-03', 7500),
(38, 48, 14835669, 'Alquiler', '2016-06-02', '2018-06-02', 1000),
(65, 3, 24302353, 'Venta', '2012-03-01', '0000-00-00', 150000),
(66, 15, 24929810, 'Venta', '2015-04-01', '0000-00-00', 325000),
(67, 17, 24947936, 'Alquiler', '2013-12-01', '2015-12-01', 12000),
(68, 20, 25078405, 'Venta', '2016-06-02', '0000-00-00', 325000),
(69, 30, 25191962, 'Venta', '2016-06-03', '0000-00-00', 150000),
(70, 31, 25280974, 'Alquiler', '2016-04-02', '2018-04-02', 2400),
(71, 33, 25619217, 'Alquiler', '2016-03-01', '2018-03-01', 3500),
(72, 34, 26128034, 'Alquiler', '2016-03-01', '2018-03-01', 3500),
(73, 35, 26128429, 'Alquiler', '2016-03-01', '2018-03-01', 3500),
(74, 42, 26219683, 'Alquiler', '2015-11-04', '2017-11-03', 4300),
(75, 49, 26415850, 'Alquiler', '2016-06-02', '2018-06-02', 7500),
(101, 8, 29957335, 'Venta', '2015-02-13', '0000-00-00', 150000),
(102, 9, 30051986, 'Venta', '2015-02-14', '0000-00-00', 325000),
(103, 10, 30112006, 'Alquiler', '2015-04-01', '2017-03-31', 5000),
(104, 11, 30351997, 'Venta', '2016-03-02', '0000-00-00', 325000),
(105, 13, 30521046, 'Venta', '2016-03-05', '0000-00-00', 150000),
(106, 32, 30661603, 'Alquiler', '2012-03-04', '2014-03-04', 2400),
(123, 23, 33316063, 'Alquiler', '2013-12-01', '2015-12-01', 2400),
(124, 26, 33412608, 'Venta', '2016-06-03', '0000-00-00', 245000),
(125, 27, 33450684, 'Venta', '2016-06-03', '0000-00-00', 120000),
(126, 29, 33466604, 'Alquiler', '2016-04-02', '2018-04-02', 2400),
(127, 47, 33467244, 'Alquiler', '2016-06-02', '2018-06-02', 7500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
