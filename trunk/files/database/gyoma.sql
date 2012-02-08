-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: 192.50.250.5
-- Tiempo de generación: 11-01-2012 a las 14:04:51
-- Versión del servidor: 5.1.26
-- Versión de PHP: 5.2.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gyoma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorio`
--

DROP TABLE IF EXISTS `accesorio`;
CREATE TABLE `accesorio` (
  `Id_Accesorio` int(10) NOT NULL AUTO_INCREMENT,
  `CodReferencia` varchar(100) DEFAULT NULL,
  `NombreMarca` varchar(100) NOT NULL,
  `NombreLinea` varchar(100) NOT NULL,
  `NombreEquipo` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(2000) DEFAULT NULL,
  `Precio` float(100,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Accesorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `accesorio`
--

INSERT INTO `accesorio` (`Id_Accesorio`, `CodReferencia`, `NombreMarca`, `NombreLinea`, `NombreEquipo`, `Descripcion`, `Precio`) VALUES
(1, 'FUS7251', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor Volumétrico Intracavitario 3D9-3 banda ancha, de 9 a 3 MHz para 3D/4D ginecología y obstetricia, fertidad, urologia y contraste.', 99.00),
(2, 'FUS7252', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor Volumétrico Convex V6-2 banda ancha, de 6 a 2 MHz para 3D/4D abdominal, ginecología y obstetricia.', 99.00),
(3, 'FUS7253', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor lineal volumétrico V13-5, para aplicaciones 3D abdominal, obstetricia, musculoesquelético, pequeñas partes y vascular.', 99.00),
(4, 'FUS7261', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor Sectorial S4-1 de banda ancha para abdomen, ginecología y obstetricia, fertilidad, contraste y abdomen vascular.', 99.00),
(5, 'FUS7262', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor Sectorial S5-1 banda ancha con tecnología PureWave, cristal de onda pura, para Ecocardiografía Adulto.', 99.00),
(6, 'FUS7263', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor Transesofágico S7-2 Ommi TEE sectorial de banda ancha Eco Adulto.', 99.00),
(7, 'FUS7271', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor lineal L9-3 banda ancha de 9-3 MHz para pequeñas partes,cerebrovascular,vascular periférico,contraste y mamas.', 99.00),
(8, 'FUS7272', 'Philips', 'US (Ultrasonido)', 'iU22', 'Transductor lineal L12-5 banda ancha de 12 a 5 MHz de 50 mm para pequeñas partes, pediátrico,cerebrovascular, vascular periférico, musculoesquelético.', 99.00),
(9, 'FUS7273', 'Philips', 'US (Ultrasonido)', 'iU22', ' Transductor lineal L17-5 banda ancha de 17 a 5 MHz para pequeñas partes, pediátrico, cerebrovascular, vascular periférico y musculoesquelético.', 99.00),
(10, 'iU22', 'Philips', 'US (Ultrasonido)', NULL, 'Ninguna', 99.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alerta`
--

DROP TABLE IF EXISTS `alerta`;
CREATE TABLE `alerta` (
  `Id_Alerta` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `Contador` int(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Alerta`),
  KEY `Alerta_fk` (`Id_Negociacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`Id_Alerta`, `Id_Negociacion`, `Status`, `Contador`) VALUES
(1, 152, 0, NULL),
(2, 153, 0, NULL),
(3, 154, 0, NULL),
(4, 155, 0, 10),
(5, 156, 0, NULL),
(6, 157, 0, NULL),
(7, 158, 0, 0),
(8, 159, 0, 0),
(9, 160, 1, 1),
(10, 161, 0, 0),
(11, 162, 0, 0),
(12, 163, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertamod`
--

DROP TABLE IF EXISTS `alertamod`;
CREATE TABLE `alertamod` (
  `Id_AlertaMod` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Contador` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_AlertaMod`),
  KEY `AlertaMod_fk` (`Id_Negociacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcar la base de datos para la tabla `alertamod`
--

INSERT INTO `alertamod` (`Id_AlertaMod`, `Id_Negociacion`, `Contador`) VALUES
(1, 156, 6),
(2, 157, 7),
(3, 158, 0),
(4, 159, 0),
(5, 160, 8),
(6, 161, 0),
(7, 162, 1),
(8, 163, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `Id_Cliente` int(10) NOT NULL AUTO_INCREMENT,
  `Tipo_C` varchar(40) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Cedula` varchar(20) DEFAULT NULL,
  `Sexo` varchar(20) NOT NULL,
  `Dia` varchar(5) NOT NULL,
  `Mes` varchar(50) NOT NULL,
  `Rif` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Telefono2` varchar(20) NOT NULL,
  `Telefono3` varchar(20) DEFAULT NULL,
  `Especialidad` varchar(40) NOT NULL,
  `Subespecial` varchar(40) NOT NULL,
  `Web` varchar(1000) DEFAULT NULL,
  `Departamento` varchar(40) NOT NULL,
  `Twitter` varchar(40) DEFAULT NULL,
  `Facebook` varchar(40) DEFAULT NULL,
  `Googleplus` varchar(40) DEFAULT NULL,
  `Direccion` varchar(1000) NOT NULL,
  `Direccion2` varchar(1000) NOT NULL,
  `Direccion3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Tipo_C`, `Nombre`, `Apellido`, `Cedula`, `Sexo`, `Dia`, `Mes`, `Rif`, `Email`, `Telefono`, `Telefono2`, `Telefono3`, `Especialidad`, `Subespecial`, `Web`, `Departamento`, `Twitter`, `Facebook`, `Googleplus`, `Direccion`, `Direccion2`, `Direccion3`) VALUES
(1, 'x', NULL, NULL, NULL, 'x', '1', 'x', '1', 'x', '1', '1', NULL, 'x', 'x', NULL, 'x', NULL, NULL, NULL, 'x', 'x', NULL),
(2, 'Privado', 'Jose', 'Rodriguez', 'V-17423457', 'Hombre', '10', 'Mayo', 'V-17423457-0', 'veiraj@hotmail.com', '12312313123', '12312312312', '45645645645', 'Nutrologia', 'ffsdfsdfsdf', 'www.prueba.com', 'sdfsdfsfsdf', '@sdfsdfsdf', '', '', 'gdfgdfg', 'dfgdfgdfg', ''),
(3, 'Privado', 'Dario', 'Rodriguez', 'V-17423457', 'Hombre', '10', 'Mayo', 'V-17423457-0', 'veiraj@hotmail.com', '12312313123', '12312312312', '45645645645', 'Nutrologia', 'ffsdfsdfsdf', 'www.prueba.com', 'sdfsdfsfsdf', '@sdfsdfsdf', '', '', 'gdfgdfg', 'dfgdfgdfg', ''),
(4, 'Privado', 'Rauil', 'Rodriguez', 'V-17423457', 'Hombre', '10', 'Mayo', 'V-17423457-0', 'veiraj@hotmail.com', '12312313123', '12312312312', '45645645645', 'Nutrologia', 'ffsdfsdfsdf', 'www.prueba.com', 'sdfsdfsfsdf', '@sdfsdfsdf', '', '', 'gdfgdfg', 'dfgdfgdfg', ''),
(5, 'Privado', 'capriles', 'Rodriguez', 'V-17423457', 'Hombre', '10', 'Mayo', 'V-17423457-0', 'veiraj@hotmail.com', '12312313123', '12312312312', '45645645645', 'Nutrologia', 'ffsdfsdfsdf', 'www.prueba.com', 'sdfsdfsfsdf', '@sdfsdfsdf', '', '', 'gdfgdfg', 'dfgdfgdfg', ''),
(6, 'Publico', 'Maria', 'Veira', 'V-53453453', 'Hombre', '15', 'Enero', 'V-34534534-5', '345345dfg@fsef', '23424234234', '23423423423', '', 'Cirugia', 'fggdfgdfg', 'dfggdfgdfg', 'dgdfgdfg', 'dfgdfg@', '', '', 'dfgdfg', 'dfgdfgdfg', 'dfgdfgdfg'),
(7, 'Privado', 'Jose', 'werwer', 'V-22344234', 'Hombre', '1', 'Marzo', 'V-23423423-1', 'sdsf@F', '23423423423', '23423423423', '', 'Nutricion', 'dfgdfgdfg', 'fgdfgdfg', 'dfgdfgdfg', 'fgdfgdfgdf', '', '', 'dgfgdfg', 'dfgdfgdfg', ''),
(8, 'Privado', 'Daniel', 'werwer', 'V-22344234', 'Hombre', '1', 'Marzo', 'V-23423423-1', 'sdsf@F', '23423423423', '23423423423', '', 'Nutricion', 'dfgdfgdfg', 'fgdfgdfg', 'dfgdfgdfg', 'fgdfgdfgdf', '', '', 'dgfgdfg', 'dfgdfgdfg', ''),
(9, 'Privado', 'David', 'dfgdfg', 'V-43534534', 'Hombre', '17', 'Enero', 'V-34534534-0', 'dfggdfg@fsd', '34534534534', '34534534534', '', 'Cirugia', 'ertert', 'ertert', 'ertert', 'ertert', '', '', 'et', 'rt', ''),
(10, 'Privado', 'ttttt', 'ttttt', 'V-34444444', 'Mujer', '7', 'Febrero', 'V-44444444-2', 'gdfgdfg@dgdfg', '45555555555', '55555555555', '55555555555', 'Fisioterapia', 'gfghfghfgh', 'hffhfghfgh', 'fgnhfghfh', 'rhthtrh', 'fghfghfgh', '', 'fghfgh', 'fghfghfgh', ''),
(11, 'Privado', 'ttttt', 'ttttt', 'V-34444444', 'Mujer', '7', 'Febrero', 'V-44444444-2', 'gdfgdfg@dgdfg', '45555555555', '55555555555', '55555555555', 'Fisioterapia', 'gfghfghfgh', 'hffhfghfgh', 'fgnhfghfh', 'rhthtrh', 'fghfghfgh', '', 'fghfgh', 'fghfghfgh', ''),
(12, 'Privado', 'ttttt', 'ttttt', 'V-34444444', 'Mujer', '7', 'Febrero', 'V-44444444-2', 'gdfgdfg@dgdfg', '45555555555', '55555555555', '55555555555', 'Fisioterapia', 'gfghfghfgh', 'hffhfghfgh', 'fgnhfghfh', 'rhthtrh', 'fghfghfgh', '', 'fghfgh', 'fghfghfgh', ''),
(13, 'Publico', 'hhfgh', 'fhfgh', 'V-5656', 'Mujer', '4', 'Marzo', 'V-56456546-2', 'hgjghj@esf', '56456555555', '55555555555', '55555555555', 'Mastologia', 'tyutyu', 'tyuty', 'hgjghj', 'ghjghj', '', '', 'ghjghj', 'ghjghj', ''),
(14, 'Privado', 'egdf', 'dfg', 'V-45345646', 'Hombre', '1', 'Mayo', 'V-45645645-1', 'df@f', '34534535345', '34534534534', '', 'Cirugia', 'ert', '', 'dgdgdg', 'fgdfg', '', '', 'fgdf', 'dfgdfg', ''),
(15, 'Privado', 'egdf', 'dfg', 'V-45345646', 'Hombre', '1', 'Mayo', 'V-45645645-1', 'df@f', '34534535345', '34534534534', '', 'Cirugia', 'ert', '', 'dgdgdg', 'fgdfg', '', '', 'fgdf', 'dfgdfg', ''),
(16, 'Privado', 'egdf', 'dfg', 'V-45345646', 'Hombre', '1', 'Mayo', 'V-45645645-1', 'df@f', '34534535345', '34534534534', '', 'Cirugia', 'ert', '', 'dgdgdg', 'fgdfg', '', '', 'fgdf', 'dfgdfg', ''),
(17, 'Privado', 'egdf', 'dfg', 'V-45345646', 'Hombre', '1', 'Mayo', 'V-45645645-1', 'df@f', '34534535345', '34534534534', '', 'Cirugia', 'ert', '', 'dgdgdg', 'fgdfg', '', '', 'fgdf', 'dfgdfg', ''),
(18, 'Privado', 'egdf', 'dfg', 'V-45345646', 'Hombre', '1', 'Mayo', 'V-45645645-1', 'df@f', '34534535345', '34534534534', '', 'Cirugia', 'ert', '', 'dgdgdg', 'fgdfg', '', '', 'fgdf', 'dfgdfg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eic`
--

DROP TABLE IF EXISTS `eic`;
CREATE TABLE `eic` (
  `Id_Eic` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Empleado` int(10) DEFAULT NULL,
  `Id_Institucion` int(10) DEFAULT NULL,
  `Id_Cliente` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_Eic`),
  KEY `EIC_fk` (`Id_Empleado`),
  KEY `EIC_fk2` (`Id_Institucion`),
  KEY `EIC_fk3` (`Id_Cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcar la base de datos para la tabla `eic`
--

INSERT INTO `eic` (`Id_Eic`, `Id_Empleado`, `Id_Institucion`, `Id_Cliente`) VALUES
(4, 11111111, 1, 5),
(5, 11111111, 1, 5),
(6, 11111111, 2, 6),
(7, 11111111, 10, 6),
(8, 11111111, 9, 7),
(9, 11111111, 9, 8),
(10, 11111111, 7, 9),
(11, 11111111, 1, 9),
(12, NULL, 9, 10),
(13, NULL, 7, 10),
(14, 11111111, 9, 11),
(15, 11111111, 7, 11),
(16, 11111111, 9, 12),
(17, 11111111, 7, 12),
(18, 11111111, 2, 13),
(19, 11111111, 8, 13),
(20, 11111111, 7, 14),
(21, 11111111, 7, 15),
(22, 11111111, 1, 15),
(23, 11111111, 7, 16),
(24, 11111111, 1, 16),
(25, 11111111, 7, 17),
(26, 11111111, 1, 17),
(27, 11111111, 7, 18),
(28, 11111111, 1, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `Cedula` int(8) NOT NULL,
  `Usuario` varchar(10) NOT NULL,
  `Clave` varchar(10) NOT NULL,
  `Nombre_1` varchar(20) NOT NULL,
  `Nombre_2` varchar(20) DEFAULT NULL,
  `Apellido_1` varchar(20) NOT NULL,
  `Apellido_2` varchar(20) DEFAULT NULL,
  `Fecha_Ingreso` varchar(10) NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Telf_Casa` varchar(15) NOT NULL,
  `Telf_Ofi` varchar(15) DEFAULT NULL,
  `Telf_Cel` varchar(15) DEFAULT NULL,
  `Tipo_Empleado` varchar(20) NOT NULL,
  `Cod_Vendedor` int(5) NOT NULL,
  `Cod_Supervisor` int(8) DEFAULT NULL,
  PRIMARY KEY (`Cedula`),
  KEY `empleado_fk` (`Cod_Supervisor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`Cedula`, `Usuario`, `Clave`, `Nombre_1`, `Nombre_2`, `Apellido_1`, `Apellido_2`, `Fecha_Ingreso`, `Sexo`, `Correo`, `Telf_Casa`, `Telf_Ofi`, `Telf_Cel`, `Tipo_Empleado`, `Cod_Vendedor`, `Cod_Supervisor`) VALUES
(11111111, 'Elp', '54321', 'Jose', NULL, 'Rodriguez', NULL, '10/10/2011', 'Masculino', 'jrodriguezv.11@gmail.com', '234144', NULL, NULL, 'Vendedor', 1234, 17423457),
(17423457, 'Jrv', '12345', 'Javier', NULL, 'Rodriguez', NULL, '10/10/2011', 'Masculino', 'Javier@gmail.com', '234144', NULL, NULL, 'Administrador', 1234, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialnp`
--

DROP TABLE IF EXISTS `historialnp`;
CREATE TABLE `historialnp` (
  `Id_HistorialNP` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Accesorio` int(10) DEFAULT NULL,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Cantidad` int(100) DEFAULT NULL,
  PRIMARY KEY (`Id_HistorialNP`),
  KEY `HistorialNP_fk` (`Id_Accesorio`),
  KEY `HistorialNP_fk2` (`Id_Negociacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=289 ;

--
-- Volcar la base de datos para la tabla `historialnp`
--

INSERT INTO `historialnp` (`Id_HistorialNP`, `Id_Accesorio`, `Id_Negociacion`, `Cantidad`) VALUES
(1, 10, 52, 10),
(2, 2, 52, 50),
(3, 2, 52, 50),
(4, 2, 52, 50),
(5, 2, 52, 50),
(6, 2, 52, 50),
(7, 2, 52, 50),
(8, 2, 52, 50),
(9, 2, 52, 50),
(10, 10, 54, 99),
(11, 10, 54, 99),
(12, 10, 54, 99),
(13, 3, 54, 22),
(14, 7, 54, 25),
(15, 10, 53, 2),
(16, 10, 55, 1),
(17, 2, 55, 2),
(18, 7, 55, 3),
(19, 7, 54, 25),
(20, 7, 54, 25),
(21, 7, 54, 25),
(22, 7, 54, 25),
(23, 7, 54, 25),
(24, 7, 54, 25),
(25, 7, 54, 25),
(26, 7, 54, 25),
(27, 7, 54, 25),
(28, 7, 54, 25),
(29, 7, 54, 25),
(31, 7, 54, 25),
(32, 7, 54, 25),
(33, 10, 57, 80),
(34, 2, 57, 78),
(35, 1, 57, 3),
(36, 10, 59, 23),
(37, 10, 43, 66),
(38, 10, 43, 66),
(39, 10, 43, 66),
(40, 10, 43, 66),
(41, 10, 43, 46),
(42, 10, 1, 89),
(43, 10, 1, 89),
(44, 10, 1, 89),
(45, 10, 1, 46),
(46, 10, 1, 46),
(47, 10, 1, 46),
(48, 10, 1, 46),
(49, 10, 1, 90),
(50, 10, 1, 90),
(51, NULL, 1, NULL),
(52, NULL, 1, NULL),
(53, 10, 1, 90),
(54, 4, 1, 57),
(55, 4, 1, 57),
(56, 4, 1, 57),
(57, 4, 1, 57),
(58, 4, 1, 57),
(59, 4, 1, 57),
(60, 4, 1, 57),
(61, 4, 1, 57),
(62, 4, 1, 57),
(63, 4, 1, 57),
(64, 4, 1, 57),
(65, 3, 1, 7),
(66, 3, 1, 7),
(67, 6, 1, 88),
(68, 7, 1, 8),
(69, 5, 1, 66),
(70, NULL, 1, NULL),
(71, NULL, 1, NULL),
(72, 7, 1, 8),
(73, NULL, 1, NULL),
(74, NULL, 1, NULL),
(75, 10, 1, 98),
(76, 7, 1, 78),
(77, 10, 57, 3),
(78, 2, 57, 3),
(79, 10, 57, 76),
(80, 10, 13, 34),
(81, 7, 13, 44),
(82, 10, 11, 66),
(83, 8, 11, 445),
(84, 10, 62, 5555),
(85, 3, 62, 545),
(86, 10, 77, 24),
(87, 10, 77, 24),
(88, 3, 77, 68),
(89, 1, 77, 1),
(90, 1, 77, 1),
(91, 10, 77, 24),
(92, 10, 72, 78),
(93, 10, 72, 78),
(94, 10, 72, 78),
(95, 1, 72, 99),
(96, 1, 72, 77),
(97, 1, 72, 77),
(98, 10, 70, 76),
(99, 3, 70, 65),
(100, 10, 77, 89),
(101, 10, 77, 88),
(102, 10, 77, 88),
(103, 2, 77, 99),
(104, 10, 57, 33),
(105, 1, 57, 3),
(109, 10, NULL, 33),
(110, 10, 14, 33),
(111, 10, 14, 33),
(112, 10, 14, 3),
(113, 10, 14, 3),
(114, 10, 14, 3),
(115, 10, 14, 4),
(116, 10, 14, 4),
(117, 10, 14, 22),
(118, 10, 14, 22),
(119, 10, 14, 22),
(120, 10, 14, 22),
(121, 1, 14, 33),
(122, 5, 14, 23),
(123, 5, 14, 23),
(124, 3, 14, 3),
(127, 10, 76, 34),
(128, 1, 73, 45),
(141, 3, 2, 99),
(142, 3, 2, 76),
(143, 4, 2, 3),
(144, 1, 73, 45),
(145, 1, 73, 1),
(149, 4, 4, 56),
(150, 1, 4, 33),
(151, 10, 64, 33),
(152, 10, 64, 33),
(153, 10, 64, 33),
(154, 10, 64, 33),
(155, 10, 64, 33),
(156, 10, 64, 33),
(157, 10, 64, 33),
(158, 10, 64, 33),
(159, 10, 56, 33),
(160, 10, 56, 7),
(161, 10, 56, 7),
(165, 10, 56, 11),
(166, 10, 56, 55),
(167, 10, 56, 55),
(168, 10, 56, 55),
(180, 10, 3, 2),
(181, 10, 3, 66),
(182, 10, 3, 77),
(183, 10, 3, 99),
(185, 1, 2, 33),
(186, 10, 73, 87),
(188, 2, 73, 77),
(190, 10, 73, 567),
(194, 10, 79, 5),
(195, 1, 80, 2),
(196, 1, 79, 2),
(198, 10, 79, 5),
(199, 10, 80, 25),
(200, 4, 79, 2),
(201, 1, 80, 22),
(202, 3, 80, 4),
(203, 10, 110, 22),
(204, 10, 111, 33),
(205, 3, 111, 3),
(206, 4, 111, 556),
(207, 2, 111, 33),
(208, 2, 111, 33),
(209, 2, 111, 33),
(210, 2, 111, 33),
(211, 2, 111, 33),
(212, 2, 111, 33),
(213, 10, 92, 34),
(214, 3, 92, 3),
(215, 10, 112, 99),
(216, 2, 112, 2),
(217, 7, 112, 34),
(218, 10, 67, 22),
(219, 10, 67, 55),
(220, NULL, NULL, NULL),
(221, NULL, NULL, NULL),
(222, 1, 67, 4),
(223, 10, 22, 55),
(224, 1, 22, 9),
(234, 1, 8, 7),
(235, 1, 8, 8),
(236, 1, 8, 8),
(237, 1, 8, 1),
(238, 10, 8, 1),
(239, 10, 8, 3),
(240, 10, 8, 5),
(241, 10, 8, 4),
(242, 10, 8, 7),
(243, 10, 8, 7),
(244, 10, 113, 4),
(245, 10, 113, 35),
(246, 1, 67, 34),
(247, 1, 67, 34),
(248, 1, 67, 34),
(249, 10, 133, 55),
(250, 1, 133, 67),
(251, 10, 140, 2),
(252, 10, 6, 4),
(253, 10, 6, 5),
(254, 3, 6, 33),
(255, 4, 6, 4),
(256, 10, 114, 34),
(257, 2, 114, 3),
(258, 4, 114, 4),
(259, 10, 145, 56),
(260, 10, 145, 5),
(261, 1, 6, 78),
(262, 1, 6, 78),
(263, 10, 144, 45),
(264, 5, 144, 5),
(265, 5, 144, 5),
(266, 5, 144, 5),
(267, 5, 144, 5),
(268, 10, 146, 55),
(269, 10, 146, 55),
(271, 10, 132, 7),
(274, 4, 161, 88),
(275, 10, 161, 5),
(276, 10, 155, 23),
(277, 10, 155, 4),
(278, 1, 155, 56),
(279, 1, 155, 5),
(280, 2, 155, 7),
(281, 10, 150, 3),
(282, 10, 156, 5),
(283, 10, 156, 77),
(284, 10, 157, 6),
(285, 10, 157, 77),
(286, 10, 160, 45),
(287, 10, 162, 1),
(288, 1, 162, 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_ns`
--

DROP TABLE IF EXISTS `historial_ns`;
CREATE TABLE `historial_ns` (
  `Id_Historial_Ns` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Id_Seguimiento` int(10) DEFAULT NULL,
  `FechaS` varchar(30) DEFAULT NULL,
  `TipoS` varchar(50) DEFAULT NULL,
  `Resumen` varchar(500) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Historial_Ns`),
  KEY `Historial_Ns_fk` (`Id_Negociacion`),
  KEY `Historial_Ns_fk2` (`Id_Seguimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Volcar la base de datos para la tabla `historial_ns`
--

INSERT INTO `historial_ns` (`Id_Historial_Ns`, `Id_Negociacion`, `Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`) VALUES
(1, 143, 143, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(2, 144, 144, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(3, 144, 144, '01/04/2012', 'Correo electronico', 'Prueba', 'Borrador'),
(4, 140, 140, '01/18/2012', 'Mensaje de texto', 'Otra Prueba', 'Borrador'),
(5, 140, 140, '01/11/2012', 'Mensaje de texto', 'Prueba final', 'Ganada'),
(6, 143, 143, '01/04/2012', 'Correo electronico', 'Prueba 1', 'Borrador'),
(7, 143, 143, '01/05/2012', 'Mensaje de texto', 'Prueba 2', 'Borrador'),
(8, 143, 143, '01/06/2012', 'Mensaje de texto', 'Prueba 3', 'Activa'),
(9, 143, 143, '01/07/2012', 'Correo electronico', 'Prueba final', 'Ganada'),
(10, 137, 137, '01/04/2012', 'Correo electronico', 'sdsdsdsd', 'Borrador'),
(11, 137, 137, '01/10/2012', 'Mensaje de texto', 'dfsdfsdgsdgsgsdg', 'Borrador'),
(12, 137, 137, '01/05/2012', 'Correo electronico', 'gdfghdfgfdgdfgdfgdfgdfg', 'Activa'),
(13, 113, 113, '01/03/2012', 'Correo electronico', 'fdgdfgdfgdfg', 'Borrador'),
(14, 113, 113, '01/04/2012', 'Mensaje de texto', 'fgdfhfghghjghkghkjk', 'Activa'),
(15, 113, 113, '01/19/2012', 'Mensaje de texto', 'sfgdfhfghfgjfgj', 'Perdida'),
(16, 4, 4, '01/03/2012', 'Mensaje de texto', 'es una prueba', 'Borrador'),
(17, 4, 4, '01/11/2012', 'Correo electronico', 'bdfghfgjfgjh', 'Activa'),
(18, 145, 145, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(19, 146, 146, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(20, 147, 147, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(21, 148, 148, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(22, 149, 149, '05/01/2012', 'Inicial', NULL, 'Borrador'),
(23, 114, 114, '01/05/2012', 'Correo electronico', 'Prueba', 'Borrador'),
(24, 114, 114, '01/06/2012', 'Correo electronico', 'Prueba 3', 'Activa'),
(25, 150, 150, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(26, 151, 151, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(27, 152, 152, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(28, 153, 153, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(29, 154, 154, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(30, 155, 155, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(31, 156, 156, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(32, 157, 157, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(33, 67, 67, '11/01/2012', 'Correo electronico', 'tgrhtr', 'Ganada'),
(34, 140, 140, '06/01/2012', 'Llamada telefonica', 'jguhgjhgjhgjhgjhgjhgjhg', 'Borrador'),
(35, 140, 140, '06/01/2012', 'Llamada telefonica', 'jguhgjhgjhgjhgjhgjhgjhg', 'Borrador'),
(36, 158, 158, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(37, 159, 159, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(38, 160, 160, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(39, 161, 161, '07/01/2012', 'Inicial', NULL, 'Borrador'),
(40, 161, 161, '11/01/2012', 'Correo electronico', 'tyergergtergtertrttr', 'Borrador'),
(41, 161, 161, '07/01/2012', '- Selecciona -', 'Durante la semana, visite a ernesto', '- Selecciona -'),
(42, 155, 155, '09/01/2012', 'Correo electronico', 'sdfsdfsdf', 'Borrador'),
(43, 155, 155, '10/01/2012', 'Correo electronico', 'gdfgdfgdfg', 'Borrador'),
(44, 156, 156, '10/01/2012', 'Correo electronico', 'fhhfghg', 'Borrador'),
(45, 156, 156, '10/01/2012', 'Correo electronico', 'ytyutyutyutyutyu', 'Activa'),
(46, 156, 156, '09/01/2012', 'Correo electronico', 'rtertert', 'Borrador'),
(47, 156, 156, '09/01/2012', 'Correo electronico', 'gghi', 'Activa'),
(48, 4, 4, '09/01/2012', NULL, 'Porque me dio la gana', 'Activa'),
(49, 8, 8, '09/01/2012', NULL, 'Eres un animal...', 'Ganada'),
(50, 8, 8, '09/01/2012', NULL, '2da Ves, Animal', 'Ganada'),
(51, 5, 5, '09/01/2012', NULL, 'egdgdfgdfgdfgdfg', 'Activa'),
(52, 162, 162, '10/01/2012', 'Inicial', NULL, 'Borrador'),
(53, 162, 162, '10/01/2012', 'Visita', 'PRUEBA - 1 en Esta Negociacin...', 'Borrador'),
(54, 162, 162, '10/01/2012', 'Visita', 'Prueba - 2 de la Negociacin ...', 'Borrador'),
(55, 7, 7, '11/01/2012', 'Correo electronico', 'asdfsfsdf', 'Borrador'),
(56, 7, 7, '11/01/2012', 'Correo electronico', 'asdfsfsdf', 'Borrador'),
(57, 163, 163, '11/01/2012', 'Inicial', NULL, 'Borrador'),
(58, 160, 160, '11/01/2012', 'Correo electronico', 'sdfsdfsdfsdf', 'Borrador'),
(59, 160, 160, '12/01/2012', 'Otro', 'gdfgdfgdfgdfgdfgdfgdfgdfg', 'Activa'),
(60, 67, 67, '11/01/2012', 'Otro', 'Cualquier Vaina', 'Borrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

DROP TABLE IF EXISTS `institucion`;
CREATE TABLE `institucion` (
  `Id_Institucion` int(10) NOT NULL AUTO_INCREMENT,
  `Tipo_I` varchar(50) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Especialidad` varchar(100) NOT NULL,
  `Pais` varchar(100) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `Ciudad` varchar(100) NOT NULL,
  `CodigoP` int(5) NOT NULL,
  `Rif` varchar(100) DEFAULT NULL,
  `Web` varchar(200) DEFAULT NULL,
  `Telefono1` varchar(30) NOT NULL,
  `Telefono2` varchar(30) DEFAULT NULL,
  `Telefono3` varchar(30) DEFAULT NULL,
  `Twitter` varchar(30) DEFAULT NULL,
  `Facebook` varchar(30) DEFAULT NULL,
  `GooglePlus` varchar(30) DEFAULT NULL,
  `Direccion1` varchar(1000) NOT NULL,
  `Direccion2` varchar(1000) NOT NULL,
  `Direccion3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id_Institucion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`Id_Institucion`, `Tipo_I`, `Nombre`, `Especialidad`, `Pais`, `Estado`, `Ciudad`, `CodigoP`, `Rif`, `Web`, `Telefono1`, `Telefono2`, `Telefono3`, `Twitter`, `Facebook`, `GooglePlus`, `Direccion1`, `Direccion2`, `Direccion3`) VALUES
(1, 'x', NULL, 'x', 'x', 'x', 'x', 1, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'x', 'x', NULL),
(2, 'Publico', 'Clinicas Caracas', 'Emergenciologia', 'Venezuela', 'Bolivar', 'Upata', 345, 'Jdfgdfgdfg353', 'www.prueba.com', '2395433453', '212', '212', NULL, NULL, NULL, 'dgdfgdfg', 'gdfgdfgdfg', ''),
(7, 'Privado', 'Loira', 'Cardiologia', 'Venezuela', 'Aragua', 'Maracay', 5345, 'J-sdfsdfwr', NULL, '212324234', '- Selecciona -', '212', NULL, NULL, NULL, 'werwer', 'sfsfsdfsd', ''),
(8, 'Publico', 'Prueba', 'Nefrologia', 'Venezuela', 'Carabobo', 'Valencia', 42342, 'J-342342342342', NULL, '5345345', '', '', '@ejemplo2', '', '', 'dfgdfgg', 'dfgdfgdfg', ''),
(9, 'Publico', 'Prueba', 'Nefrologia', 'Venezuela', 'Carabobo', 'Valencia', 42342, 'J-342342342342', NULL, '5345345', '', '', '@ejemplo2', '', '', 'dfgdfgg', 'dfgdfgdfg', ''),
(10, 'Publico', 'dfgdfg', 'Cirugia', 'Venezuela', 'Monagas', 'Matur', 53534, 'J-34534554', NULL, '34534534534', '', '', '@dgdfgdfg', '', '', 'dfgdfgdfgdfg', 'dgdfgdfgdfg', ''),
(11, '- Selecciona -', 'gdf', 'Emergenciologia', 'Venezuela', 'Aragua', 'Maracay', 45, 'J-345', NULL, '34534534534', '', '', '345', '', '', '345', '345', ''),
(12, 'Privado', 'gtrterteter', 'Cirugia', 'Venezuela', 'Miranda', 'Los Teques', 53453, 'J-3453453453', NULL, '34534534534', '34534534534', '34534534534', '34534', 'rgerg', '', 'dgdg', 'dfgdfg', ''),
(13, 'Privado', 'jjjj', 'Gineco-Obstetricia', 'Venezuela', 'Aragua', 'Maracay', 55555, 'J-5545465454', NULL, '45645646464', '45646464564', '45645646456', 'ytryhrty', '', '', 'ryrty', 'rtyrtyry', ''),
(14, 'Privado', 'jjjj', 'Gineco-Obstetricia', 'Venezuela', 'Aragua', 'Maracay', 55555, 'J-5545465454', NULL, '45645646464', '45646464564', '45645646456', 'ytryhrty', '', '', 'ryrty', 'rtyrtyry', ''),
(15, 'Privado', 'uu', 'Pediatria', 'Venezuela', 'Monagas', 'Matur', 65655, 'J-5655675675', NULL, '56457656756', '', '', 'rtyry', '', '', 'rtyrty', 'rtyrty', ''),
(16, 'Privado', 'uu', 'Pediatria', 'Venezuela', 'Monagas', 'Matur', 65655, 'J-5655675675', NULL, '56457656756', '', '', 'rtyry', '', '', 'rtyrty', 'rtyrty', ''),
(17, 'Privado', 'uu', 'Pediatria', 'Venezuela', 'Monagas', 'Matur', 65655, 'J-5655675675', NULL, '56457656756', '', '', 'rtyry', '', '', 'rtyrty', 'rtyrty', ''),
(18, 'Privado', 'erte', 'Pediatria', 'Venezuela', 'Sucre', 'Cuman', 34535, 'J-3453453453', NULL, '34535353534', '', '', '345345ert', '', '', 'dfg', 'dfg', ''),
(19, '- Selecciona -', 'Empresas LP21', 'Multi-Especialidad', 'Venezuela', 'Distrito Capital', 'Caracas', 1010, 'J-311733590', NULL, '02125784742', '02125720444', '', '@ELP21', 'EMPRESAS LP21', '', 'La Candelaria', 'La Candelaria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negociacion`
--

DROP TABLE IF EXISTS `negociacion`;
CREATE TABLE `negociacion` (
  `Id_Negociacion` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Cliente` int(10) DEFAULT NULL,
  `Id_Institucion` int(10) DEFAULT NULL,
  `Id_Empleado` int(10) DEFAULT NULL,
  `FechaP` varchar(20) DEFAULT NULL,
  `NumeroODC` varchar(20) DEFAULT NULL,
  `FechaODC` varchar(20) DEFAULT NULL,
  `Banco` varchar(50) DEFAULT NULL,
  `PagoInicial` float(100,2) DEFAULT NULL,
  `CondicionesPago` varchar(50) DEFAULT NULL,
  `FechaPago` varchar(20) DEFAULT NULL,
  `NDeposito` varchar(50) DEFAULT NULL,
  `Status` int(5) DEFAULT NULL,
  `Descuento` varchar(10) DEFAULT NULL,
  `Total` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Negociacion`),
  KEY `Negociacion_fk` (`Id_Cliente`),
  KEY `Negociacion_fk2` (`Id_Institucion`),
  KEY `Negociacion_fk3` (`Id_Empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Volcar la base de datos para la tabla `negociacion`
--

INSERT INTO `negociacion` (`Id_Negociacion`, `Id_Cliente`, `Id_Institucion`, `Id_Empleado`, `FechaP`, `NumeroODC`, `FechaODC`, `Banco`, `PagoInicial`, `CondicionesPago`, `FechaPago`, `NDeposito`, `Status`, `Descuento`, `Total`) VALUES
(1, 2, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, 11111111, '06/01/2012', NULL, '12/22/2011', NULL, NULL, NULL, NULL, '334235235', NULL, NULL, NULL),
(4, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '10755.36'),
(5, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(6, 3, NULL, 11111111, '07/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '10', '20157.983999999997'),
(7, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '', ''),
(8, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '10', '5089.392'),
(9, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 3, NULL, 11111111, '12/01/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, 'chfjhgjhg', '12/12/2011', '1234567', NULL, NULL, NULL),
(16, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(23, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 7, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 4, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 3, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 6, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 4, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, NULL, 11111111, '12/30/2011', '12345678', NULL, NULL, 4646546.00, 'Efectivo', '12/02/2011', '123456', NULL, NULL, NULL),
(58, 4, NULL, 11111111, '14/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 8, NULL, NULL, '15/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 6, NULL, NULL, '17/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 5, NULL, NULL, '17/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 3, NULL, NULL, '17/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 4, NULL, NULL, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 4, NULL, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 7, NULL, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 4, NULL, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 4, NULL, 11111111, '06/01/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '50', '9058.5'),
(68, 4, NULL, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, 2, NULL, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, 2, 11111111, '19/12/2011', '324234', '12/01/2011', NULL, 456.00, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, 2, NULL, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, 2, 11111111, '12/08/2011', '6543w', '12/01/2011', 'Banescooo', 200000.00, 'Efectivo', '12/01/2011', '123456', NULL, NULL, NULL),
(73, NULL, 2, 11111111, '19/12/2011', NULL, '12/07/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, 2, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, 9, 11111111, '12/15/2011', '456', '12/13/2011', 'Provi', 23242.00, 'Chequ', '12/13/2011', '76543', NULL, NULL, NULL),
(76, NULL, 9, 11111111, '12/01/2011', NULL, NULL, NULL, NULL, NULL, '12/10/2011', NULL, NULL, NULL, NULL),
(77, NULL, 9, 11111111, '19/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 3, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(92, 5, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 10, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(94, 10, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(98, 9, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 8, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 5, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 8, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(103, 5, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 7, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 8, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(106, 4, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, NULL, 11, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, NULL, 11, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 8, NULL, 11111111, '20/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(110, 6, NULL, 11111111, '06/01/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(111, 3, NULL, 11111111, '21/12/2011', NULL, '12/13/2011', NULL, NULL, NULL, NULL, NULL, 1, '20', '70076.16'),
(112, NULL, 7, 11111111, '21/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(113, NULL, 2, 11111111, '27/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(114, 3, NULL, 11111111, '28/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(115, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(116, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(117, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(118, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(119, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(120, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(121, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(122, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(123, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(124, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(125, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(126, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(127, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(128, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(129, 3, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(130, NULL, 9, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(131, NULL, 11, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(132, 4, NULL, 11111111, '01/01/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(133, NULL, 7, 11111111, '12/30/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(134, 7, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(135, NULL, 7, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(136, 4, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(137, 5, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(138, 8, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(139, 8, NULL, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(140, NULL, 19, 11111111, '29/12/2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(141, 3, NULL, 11111111, '03/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(142, NULL, 7, 11111111, '03/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(143, 5, NULL, 11111111, '03/01/2012', NULL, '01/03/2012', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(144, NULL, 19, 11111111, '12/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '25', '4826.25'),
(145, NULL, 19, 11111111, '04/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '10', '5435.1'),
(146, 5, NULL, 11111111, '12/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(147, 12, NULL, 11111111, '04/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(148, NULL, 12, 11111111, '04/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL),
(149, 3, NULL, 11111111, '05/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(150, 2, NULL, 11111111, '07/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(151, NULL, 19, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(152, 6, NULL, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(153, NULL, 19, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(154, 6, NULL, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(155, 6, NULL, 11111111, '09/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(156, 6, NULL, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '5', '8637.552'),
(157, NULL, 19, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '5', '7806.15'),
(158, 5, NULL, 11111111, '01/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(159, NULL, 19, 11111111, '06/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(160, 5, NULL, 11111111, '17/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(161, 6, NULL, 11111111, '07/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(162, NULL, 19, 11111111, '10/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '5', '3686.76'),
(163, NULL, 19, 11111111, '11/01/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ns`
--

DROP TABLE IF EXISTS `ns`;
CREATE TABLE `ns` (
  `Id_NS` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Id_Seguimiento` int(10) DEFAULT NULL,
  `FechaS` varchar(30) DEFAULT NULL,
  `TipoS` varchar(50) DEFAULT NULL,
  `Resumen` varchar(500) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_NS`),
  KEY `NS_fk` (`Id_Negociacion`),
  KEY `NS_fk2` (`Id_Seguimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Volcar la base de datos para la tabla `ns`
--

INSERT INTO `ns` (`Id_NS`, `Id_Negociacion`, `Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL),
(2, 2, 2, NULL, NULL, NULL, NULL),
(3, 3, 3, NULL, NULL, NULL, NULL),
(4, 4, 4, NULL, NULL, NULL, NULL),
(5, 5, 5, NULL, NULL, NULL, NULL),
(6, 6, 6, NULL, NULL, NULL, NULL),
(7, 7, 7, NULL, NULL, NULL, NULL),
(8, 8, 8, NULL, NULL, NULL, NULL),
(9, 9, 9, NULL, NULL, NULL, NULL),
(10, 10, 10, NULL, NULL, NULL, NULL),
(11, 11, 11, NULL, NULL, NULL, NULL),
(12, 12, 12, NULL, NULL, NULL, NULL),
(13, 13, 13, NULL, NULL, NULL, NULL),
(14, 14, 14, NULL, NULL, NULL, NULL),
(15, 15, 15, NULL, NULL, NULL, NULL),
(16, 16, 16, NULL, NULL, NULL, NULL),
(17, 17, 17, NULL, NULL, NULL, NULL),
(18, 18, 18, NULL, NULL, NULL, NULL),
(19, 19, 19, NULL, NULL, NULL, NULL),
(20, 20, 20, NULL, NULL, NULL, NULL),
(21, 21, 21, NULL, NULL, NULL, NULL),
(22, 22, 22, NULL, NULL, NULL, NULL),
(23, 23, 23, NULL, NULL, NULL, NULL),
(24, 24, 24, NULL, NULL, NULL, NULL),
(25, 25, 25, NULL, NULL, NULL, NULL),
(26, 26, 26, NULL, NULL, NULL, NULL),
(27, 27, 27, NULL, NULL, NULL, NULL),
(28, 28, 28, NULL, NULL, NULL, NULL),
(29, 29, 29, NULL, NULL, NULL, NULL),
(30, 30, 30, NULL, NULL, NULL, NULL),
(31, 31, 31, NULL, NULL, NULL, NULL),
(32, 32, 32, NULL, NULL, NULL, NULL),
(33, 33, 33, NULL, NULL, NULL, NULL),
(34, 34, 34, NULL, NULL, NULL, NULL),
(35, 35, 35, NULL, NULL, NULL, NULL),
(36, 36, 36, NULL, NULL, NULL, NULL),
(37, 37, 37, NULL, NULL, NULL, NULL),
(38, 38, 38, NULL, NULL, NULL, NULL),
(39, 39, 39, NULL, NULL, NULL, NULL),
(40, 40, 40, NULL, NULL, NULL, NULL),
(41, 41, 41, NULL, NULL, NULL, NULL),
(42, 42, 42, NULL, NULL, NULL, NULL),
(43, 43, 43, NULL, NULL, NULL, NULL),
(44, 44, 44, NULL, NULL, NULL, NULL),
(45, 45, 45, NULL, NULL, NULL, NULL),
(46, 46, 46, NULL, NULL, NULL, NULL),
(47, 47, 47, NULL, NULL, NULL, NULL),
(48, 48, 48, NULL, NULL, NULL, NULL),
(49, 49, 49, NULL, NULL, NULL, NULL),
(50, 50, 50, NULL, NULL, NULL, NULL),
(51, 51, 51, NULL, NULL, NULL, NULL),
(52, 52, 52, NULL, NULL, NULL, NULL),
(53, 53, 53, NULL, NULL, NULL, NULL),
(54, 54, 54, NULL, NULL, NULL, NULL),
(55, 55, 55, NULL, NULL, NULL, NULL),
(56, 56, 56, NULL, NULL, NULL, NULL),
(57, 57, 57, NULL, NULL, NULL, NULL),
(58, 58, 58, NULL, NULL, NULL, NULL),
(59, 59, 59, NULL, NULL, NULL, NULL),
(60, 60, 60, NULL, NULL, NULL, NULL),
(61, 61, 61, NULL, NULL, NULL, NULL),
(62, 62, 62, NULL, NULL, NULL, NULL),
(63, 63, 63, NULL, NULL, NULL, NULL),
(64, 64, 64, NULL, NULL, NULL, NULL),
(65, 65, 65, NULL, NULL, NULL, NULL),
(66, 66, 66, NULL, NULL, NULL, NULL),
(67, 67, 67, NULL, NULL, NULL, NULL),
(68, 68, 68, NULL, NULL, NULL, NULL),
(69, 69, 69, NULL, NULL, NULL, NULL),
(70, 70, 70, NULL, NULL, NULL, NULL),
(71, 71, 71, NULL, NULL, NULL, NULL),
(72, 72, 72, NULL, NULL, NULL, NULL),
(73, 73, 73, NULL, NULL, NULL, NULL),
(74, 74, 74, NULL, NULL, NULL, NULL),
(75, 75, 75, NULL, NULL, NULL, NULL),
(76, 76, 76, NULL, NULL, NULL, NULL),
(77, 77, 77, NULL, NULL, NULL, NULL),
(78, 78, 78, NULL, NULL, NULL, NULL),
(79, 79, 79, NULL, NULL, NULL, NULL),
(80, 80, 80, NULL, NULL, NULL, NULL),
(81, 81, 81, NULL, NULL, NULL, NULL),
(82, 82, 82, NULL, NULL, NULL, NULL),
(83, 83, 83, NULL, NULL, NULL, NULL),
(84, 84, 84, NULL, NULL, NULL, NULL),
(85, 85, 85, NULL, NULL, NULL, NULL),
(86, 86, 86, NULL, NULL, NULL, NULL),
(87, 87, 87, NULL, NULL, NULL, NULL),
(88, 88, 88, NULL, NULL, NULL, NULL),
(89, 89, 89, NULL, NULL, NULL, NULL),
(90, 90, 90, NULL, NULL, NULL, NULL),
(91, 91, 91, NULL, NULL, NULL, NULL),
(92, 92, 92, NULL, NULL, NULL, NULL),
(93, 93, 93, NULL, NULL, NULL, NULL),
(94, 94, 94, NULL, NULL, NULL, NULL),
(95, 95, 95, NULL, NULL, NULL, NULL),
(96, 96, 96, NULL, NULL, NULL, NULL),
(97, 97, 97, NULL, NULL, NULL, NULL),
(98, 98, 98, NULL, NULL, NULL, NULL),
(99, 99, 99, NULL, NULL, NULL, NULL),
(100, 100, 100, NULL, NULL, NULL, NULL),
(101, 101, 101, NULL, NULL, NULL, NULL),
(102, 102, 102, NULL, NULL, NULL, NULL),
(103, 103, 103, NULL, NULL, NULL, NULL),
(104, 104, 104, NULL, NULL, NULL, NULL),
(105, 105, 105, NULL, NULL, NULL, NULL),
(106, 106, 106, NULL, NULL, NULL, NULL),
(107, 107, 107, NULL, NULL, NULL, NULL),
(108, 108, 108, NULL, NULL, NULL, NULL),
(109, 109, 109, NULL, NULL, NULL, NULL),
(110, 110, 110, NULL, NULL, NULL, NULL),
(111, 111, 111, NULL, NULL, NULL, NULL),
(112, 112, 112, NULL, NULL, NULL, NULL),
(113, 113, 113, NULL, NULL, NULL, NULL),
(114, 114, 114, NULL, NULL, NULL, NULL),
(115, 115, 115, NULL, NULL, NULL, NULL),
(116, 116, 116, NULL, NULL, NULL, NULL),
(117, 117, 117, NULL, NULL, NULL, NULL),
(118, 118, 118, NULL, NULL, NULL, NULL),
(119, 119, 119, NULL, NULL, NULL, NULL),
(120, 120, 120, NULL, NULL, NULL, NULL),
(121, 121, 121, NULL, NULL, NULL, NULL),
(122, 122, 122, NULL, NULL, NULL, NULL),
(123, 123, 123, NULL, NULL, NULL, NULL),
(124, 124, 124, NULL, NULL, NULL, NULL),
(125, 125, 125, NULL, NULL, NULL, NULL),
(126, 126, 126, NULL, NULL, NULL, NULL),
(127, 127, 127, NULL, NULL, NULL, NULL),
(128, 128, 128, NULL, NULL, NULL, NULL),
(129, 129, 129, NULL, NULL, NULL, NULL),
(130, 130, 130, NULL, NULL, NULL, NULL),
(131, 131, 131, NULL, NULL, NULL, NULL),
(132, 132, 132, NULL, NULL, NULL, NULL),
(133, 133, 133, NULL, NULL, NULL, NULL),
(134, 134, 134, NULL, NULL, NULL, NULL),
(135, 135, 135, NULL, NULL, NULL, NULL),
(136, 136, 136, NULL, NULL, NULL, NULL),
(137, 137, 137, NULL, NULL, NULL, NULL),
(138, 138, 138, NULL, NULL, NULL, NULL),
(139, 139, 139, NULL, NULL, NULL, NULL),
(140, 140, 140, NULL, NULL, NULL, NULL),
(141, 141, 141, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(142, 142, 142, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(144, 143, 143, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(145, 144, 144, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(146, 145, 145, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(147, 146, 146, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(148, 147, 147, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(149, 148, 148, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(150, 149, 149, '05/01/2012', 'Inicial', NULL, 'Borrador'),
(151, 150, 150, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(152, 151, 151, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(153, 152, 152, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(154, 153, 153, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(155, 154, 154, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(156, 155, 155, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(157, 156, 156, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(158, 157, 157, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(159, 158, 158, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(160, 159, 159, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(161, 160, 160, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(162, 161, 161, '07/01/2012', 'Inicial', NULL, 'Borrador'),
(163, 162, 162, '10/01/2012', 'Inicial', NULL, 'Borrador'),
(164, 163, 163, '11/01/2012', 'Inicial', NULL, 'Borrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE `seguimiento` (
  `Id_Seguimiento` int(10) NOT NULL AUTO_INCREMENT,
  `FechaS` varchar(30) DEFAULT NULL,
  `TipoS` varchar(50) DEFAULT NULL,
  `Resumen` varchar(500) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Seguimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Volcar la base de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`) VALUES
(1, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(2, '01/11/2012', 'Mensaje de texto', 'fgdfgdfgdfgdfgdfg', 'Activa'),
(3, '12/14/2011', 'Mensaje de texto', 'defsdf', 'Activa'),
(4, '01/11/2012', 'Correo electronico', 'bdfghfgjfgjh', 'Activa'),
(5, '12/08/2011', 'Visita', 'erere', 'Activa'),
(6, '01/04/2012', 'Correo electronico', 'Hola', 'Borrador'),
(7, '11/01/2012', 'Correo electronico', 'asdfsfsdf', 'Borrador'),
(8, '12/29/2011', 'Correo electronico', 'gdhfgh', 'Ganada'),
(9, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(10, '01/11/2012', 'Llamada telefonica', 'bbbbb', 'Perdida'),
(11, '14/12/2011', 'Inicial', NULL, 'Cerrada'),
(12, '14/12/2011', 'Inicial', NULL, 'Perdida'),
(13, '14/12/2011', 'Inicial', NULL, 'Ganada'),
(14, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(15, '12/14/2011', 'Llamada telefonica', 'xcghjk', 'Cerrada'),
(16, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(17, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(18, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(19, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(20, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(21, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(22, '12/20/2011', 'Mensaje de texto', 'uuhh', 'Ganada'),
(23, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(24, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(25, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(26, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(27, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(28, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(29, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(30, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(31, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(32, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(33, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(34, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(35, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(36, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(37, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(38, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(39, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(40, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(41, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(42, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(43, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(44, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(45, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(46, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(47, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(48, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(49, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(50, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(51, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(52, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(53, '01/04/2012', 'Correo electronico', 'dfgdfg', 'Ganada'),
(54, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(55, NULL, NULL, NULL, NULL),
(56, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(57, '12/07/2011', 'Mensaje de texto', 'dgdfgdgdfgdfgdfg', 'Ganada'),
(58, '14/12/2011', 'Inicial', NULL, 'Borrador'),
(59, '15/12/2011', 'Inicial', NULL, 'Borrador'),
(60, '17/12/2011', 'Inicial', NULL, 'Borrador'),
(61, '17/12/2011', 'Inicial', NULL, 'Borrador'),
(62, '17/12/2011', 'Inicial', NULL, 'Borrador'),
(63, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(64, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(65, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(66, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(67, '11/01/2012', 'Otro', 'Cualquier Vaina', 'Borrador'),
(68, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(69, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(70, '12/19/2011', 'Mensaje de texto', 'utyu', 'Ganada'),
(71, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(72, '12/20/2011', 'Correo electronico', 'gbgh', 'Ganada'),
(73, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(74, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(75, '12/14/2011', 'Correo electronico', 'ssfsdf', 'Ganada'),
(76, '19/12/2011', 'Inicial', NULL, 'Borrador'),
(77, '12/20/2011', 'Mensaje de texto', 'fgdfgdfgdfg', 'Ganada'),
(78, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(79, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(80, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(81, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(82, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(83, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(84, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(85, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(86, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(87, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(88, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(89, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(90, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(91, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(92, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(93, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(94, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(95, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(96, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(97, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(98, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(99, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(100, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(101, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(102, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(103, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(104, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(105, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(106, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(107, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(108, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(109, '20/12/2011', 'Inicial', NULL, 'Borrador'),
(110, '12/08/2011', 'Visita', '3rwrwrewrewrwerwe', 'Borrador'),
(111, '21/12/2011', 'Inicial', NULL, 'Borrador'),
(112, '12/28/2011', 'Correo electronico', 'Prueba', 'Activa'),
(113, '01/19/2012', 'Mensaje de texto', 'sfgdfhfghfgjfgj', 'Perdida'),
(114, '01/06/2012', 'Correo electronico', 'Prueba 3', 'Activa'),
(115, '12/29/2011', 'Visita', 'PRUEBA', 'Activa'),
(116, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(117, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(118, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(119, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(120, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(121, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(122, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(123, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(124, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(125, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(126, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(127, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(128, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(129, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(130, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(131, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(132, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(133, '12/29/2011', 'Mensaje de texto', 'ghfgh', 'Ganada'),
(134, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(135, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(136, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(137, '01/05/2012', 'Correo electronico', 'gdfghdfgfdgdfgdfgdfgdfg', 'Activa'),
(138, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(139, '29/12/2011', 'Inicial', NULL, 'Borrador'),
(140, '06/01/2012', 'Llamada telefonica', 'jguhgjhgjhgjhgjhgjhgjhg', 'Borrador'),
(141, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(142, '03/01/2012', 'Inicial', NULL, 'Borrador'),
(143, '01/07/2012', 'Correo electronico', 'Prueba final', 'Ganada'),
(144, '01/04/2012', 'Correo electronico', 'Prueba', 'Borrador'),
(145, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(146, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(147, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(148, '04/01/2012', 'Inicial', NULL, 'Borrador'),
(149, '05/01/2012', 'Inicial', NULL, 'Borrador'),
(150, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(151, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(152, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(153, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(154, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(155, '10/01/2012', 'Correo electronico', 'gdfgdfgdfg', 'Borrador'),
(156, '09/01/2012', 'Correo electronico', 'gghi', 'Activa'),
(157, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(158, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(159, '06/01/2012', 'Inicial', NULL, 'Borrador'),
(160, '12/01/2012', 'Otro', 'gdfgdfgdfgdfgdfgdfgdfgdfg', 'Activa'),
(161, '07/01/2012', '- Selecciona -', 'Durante la semana, visite a ernesto', '- Selecciona -'),
(162, '10/01/2012', 'Visita', 'Prueba - 2 de la Negociacin ...', 'Borrador'),
(163, '11/01/2012', 'Inicial', NULL, 'Borrador');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `alerta`
--
ALTER TABLE `alerta`
  ADD CONSTRAINT `Alerta_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`);

--
-- Filtros para la tabla `alertamod`
--
ALTER TABLE `alertamod`
  ADD CONSTRAINT `AlertaMod_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`);

--
-- Filtros para la tabla `eic`
--
ALTER TABLE `eic`
  ADD CONSTRAINT `EIC_fk` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Cedula`),
  ADD CONSTRAINT `EIC_fk2` FOREIGN KEY (`Id_Institucion`) REFERENCES `institucion` (`Id_Institucion`),
  ADD CONSTRAINT `EIC_fk3` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `Empleado_fk` FOREIGN KEY (`Cod_Supervisor`) REFERENCES `empleado` (`Cedula`);

--
-- Filtros para la tabla `historial_ns`
--
ALTER TABLE `historial_ns`
  ADD CONSTRAINT `Historial_Ns_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`),
  ADD CONSTRAINT `Historial_Ns_fk2` FOREIGN KEY (`Id_Seguimiento`) REFERENCES `seguimiento` (`Id_Seguimiento`);

--
-- Filtros para la tabla `negociacion`
--
ALTER TABLE `negociacion`
  ADD CONSTRAINT `Negociacion_fk` FOREIGN KEY (`Id_Cliente`) REFERENCES `cliente` (`Id_Cliente`),
  ADD CONSTRAINT `Negociacion_fk2` FOREIGN KEY (`Id_Institucion`) REFERENCES `institucion` (`Id_Institucion`),
  ADD CONSTRAINT `Negociacion_fk3` FOREIGN KEY (`Id_Empleado`) REFERENCES `empleado` (`Cedula`);

--
-- Filtros para la tabla `ns`
--
ALTER TABLE `ns`
  ADD CONSTRAINT `NS_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`),
  ADD CONSTRAINT `NS_fk2` FOREIGN KEY (`Id_Seguimiento`) REFERENCES `seguimiento` (`Id_Seguimiento`);
