-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: 192.50.250.5
-- Tiempo de generación: 14-02-2012 a las 23:47:46
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
  `Nombre` varchar(20) DEFAULT NULL,
  `Precio` varchar(10) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id_Accesorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `accesorio`
--

INSERT INTO `accesorio` (`Id_Accesorio`, `Nombre`, `Precio`, `Descripcion`) VALUES
(1, 'Mouse', '110', 'Mouse lacer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aequipo`
--

DROP TABLE IF EXISTS `aequipo`;
CREATE TABLE `aequipo` (
  `Id_AEquipo` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int(10) DEFAULT NULL,
  `Id_Accesorio` int(10) DEFAULT NULL,
  PRIMARY KEY (`Id_AEquipo`),
  KEY `AEquipo_fk` (`Id_Equipo`),
  KEY `AEquipo_fk2` (`Id_Accesorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `aequipo`
--

INSERT INTO `aequipo` (`Id_AEquipo`, `Id_Equipo`, `Id_Accesorio`) VALUES
(1, 1, 1),
(2, 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `alerta`
--

INSERT INTO `alerta` (`Id_Alerta`, `Id_Negociacion`, `Status`, `Contador`) VALUES
(1, 1, 0, 0),
(2, 2, 0, 0),
(3, 3, 0, 0),
(4, 4, 0, 0),
(5, 5, 0, 0),
(6, 6, 0, 0),
(7, 7, 0, 0),
(8, 8, 0, 0),
(9, 9, 0, 0),
(10, 10, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `alertamod`
--

INSERT INTO `alertamod` (`Id_AlertaMod`, `Id_Negociacion`, `Contador`) VALUES
(1, 1, 1),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE `ciudad` (
  `Id_Ciudad` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Estado` int(10) DEFAULT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Id_Ciudad`),
  KEY `Ciudad_fk` (`Id_Estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcar la base de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`Id_Ciudad`, `Id_Estado`, `Nombre`) VALUES
(1, 1, 'Puerto Ayacucho'),
(2, 1, 'San Fernando de Atabapo'),
(3, 1, 'Maroa'),
(4, 1, 'San Carlos de Rio Negro'),
(5, 1, 'San juan de Manapiare'),
(6, 2, 'Barcelona'),
(7, 3, 'San Fernando de Apure'),
(8, 4, 'Maracay'),
(9, 5, 'Barinas'),
(10, 6, 'Ciudad Bolívar'),
(11, 6, 'Puerto Ordaz'),
(12, 6, 'San Felix'),
(13, 6, 'Upata'),
(14, 6, 'Guasipati'),
(15, 6, 'El Callao'),
(16, 6, 'Tumeremo'),
(17, 6, 'El Dorado'),
(18, 6, 'Santa Elena de Uairen'),
(19, 6, 'El Pauji'),
(20, 7, 'Valencia'),
(21, 8, 'San Carlos'),
(22, 9, 'Tucupita'),
(23, 9, 'Curiapo'),
(24, 9, 'Pedernales'),
(25, 10, 'Coro'),
(26, 11, 'San Juan de Los Morros'),
(27, 12, 'Barquisimeto'),
(28, 13, 'Merida'),
(29, 14, 'Los Teques'),
(30, 15, 'Maturín'),
(31, 16, 'La Asunción'),
(32, 16, 'Porlamar'),
(33, 16, 'Pampatar'),
(34, 16, 'Juan Griego'),
(35, 16, 'Santa Ana'),
(36, 16, 'Coche'),
(37, 16, 'Cubagua'),
(38, 17, 'Guanare'),
(39, 18, 'Cumaná'),
(40, 19, 'San Cristóbal'),
(41, 20, 'Trujillo'),
(42, 21, 'Felipe'),
(43, 22, 'San Felipe'),
(44, 23, 'Maracaibo'),
(45, 24, 'Caracas');

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
  `CPostal` varchar(10) DEFAULT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Telefono2` varchar(20) NOT NULL,
  `Telefono3` varchar(20) DEFAULT NULL,
  `Especialidad` varchar(40) NOT NULL,
  `Subespecial` varchar(40) DEFAULT NULL,
  `Web` varchar(1000) DEFAULT NULL,
  `Departamento` varchar(40) NOT NULL,
  `Twitter` varchar(40) DEFAULT NULL,
  `Facebook` varchar(40) DEFAULT NULL,
  `Googleplus` varchar(40) DEFAULT NULL,
  `Direccion` varchar(1000) NOT NULL,
  `Direccion2` varchar(1000) NOT NULL,
  `Direccion3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_Cliente`, `Tipo_C`, `Nombre`, `Apellido`, `Cedula`, `Sexo`, `Dia`, `Mes`, `Rif`, `Email`, `CPostal`, `Telefono`, `Telefono2`, `Telefono3`, `Especialidad`, `Subespecial`, `Web`, `Departamento`, `Twitter`, `Facebook`, `Googleplus`, `Direccion`, `Direccion2`, `Direccion3`) VALUES
(1, 'Privado', 'Javier', 'Rodriguez Veira', 'V-17423457', 'Hombre', '10', 'Mayo', 'V-17423457-0', 'jrodriguezv.11@gmail.com', '12345', '02122342342', '04242131231', '', 'Nutricion', '', '', 'Nutricion', '@Jrv', '', '', 'Montalban 1', 'Montalban 1', ''),
(2, 'Privado', 'Daniel', 'Rodriguez Veira', 'V-87654567', 'Hombre', '11', 'Febrero', 'V-87654567-2', 'daniel@hotmail.com', '', '02122342342', '04241231231', '', 'Cirugia', '', '', 'Cirugia', '@danielrv', '', '', 'Montalban 2', 'El paraiso', ''),
(3, 'Privado', 'Jose', 'Vicente', 'V-23234323', 'Hombre', '14', 'Abril', 'V-23234323-4', 'josevi@gmail.com', '', '02124562738', '04241263884', '', 'Radiologia', '', '', 'Radiologia', '@josevi', '', '', 'El Paraso', 'El Paraso', ''),
(4, 'Privado', 'Marilu', 'Moraga', 'V-6286950', 'Mujer', '1', 'Octubre', 'V-06286950-1', 'marilu.moraga@grupoyoma.com', '', '02129456666', '04143052062', '', 'Neumonologia', '', '', 'Laboratorio de F P', '', '', '', 'Calle San Rafael C C Plaza La Trinidad', 'Calle San Rafael C C Plaza La Trinidad', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `eic`
--

INSERT INTO `eic` (`Id_Eic`, `Id_Empleado`, `Id_Institucion`, `Id_Cliente`) VALUES
(1, 12374904, 1, 4);

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
(12374904, 'lpurroy', 'purroyl', 'Luis', NULL, 'Purroy', NULL, '11/01/2012', 'Masculino', 'purroy.luis@lp21.com.ve', '02125720444', '02125720444', '04246666666', 'Vendedor', 3331, 17423457),
(17234567, 'daniel', '12345', 'Daniel', NULL, 'Rodriguez', 'Veira', '11/02/2012', 'Masculino', 'danielrv@hotmail.com', '2122452356', '4241267888', NULL, 'Despachador', 2244, 17423457),
(17423457, 'veiraj', '12345', 'Javier', NULL, 'Rodriguez', 'Veira', '11/01/2012', 'Masculino', 'jrodriguezv.11@gmail.com', '02124422764', NULL, NULL, 'Administrador', 1234, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

DROP TABLE IF EXISTS `equipo`;
CREATE TABLE `equipo` (
  `Id_Equipo` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(40) DEFAULT NULL,
  `Precio` varchar(15) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id_Equipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`Id_Equipo`, `Nombre`, `Precio`, `Descripcion`) VALUES
(1, 'Vostro 1510', '4050', 'Intel core duo, 2.0 GHZ, 2GB de ram, pantalla de 15.4 pulgadas...'),
(2, 'MacBook Pro', '20000', '15 pulgadas, procesador Core i7, 4 GB de ram...'),
(3, 'MacBook Pro', '20500', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `Id_Estado` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Pais` int(10) DEFAULT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Id_Estado`),
  KEY `Estado_fk` (`Id_Pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id_Estado`, `Id_Pais`, `Nombre`) VALUES
(1, 1, 'Amazonas'),
(2, 1, 'Anzoategui'),
(3, 1, 'Apure'),
(4, 1, 'Aragua'),
(5, 1, 'Barinas'),
(6, 1, 'Bolivar'),
(7, 1, 'Carabobo'),
(8, 1, 'Cojedes'),
(9, 1, 'Delta Amacuro'),
(10, 1, 'Falcon'),
(11, 1, 'Guarico'),
(12, 1, 'Lara'),
(13, 1, 'Merida'),
(14, 1, 'Miranda'),
(15, 1, 'Monagas'),
(16, 1, 'Nueva Esparta'),
(17, 1, 'Portuguesa'),
(18, 1, 'Sucre'),
(19, 1, 'Tachira'),
(20, 1, 'Trujillo'),
(21, 1, 'Vargas'),
(22, 1, 'Yaracuy'),
(23, 1, 'Zulia'),
(24, 1, 'Distrito Capital');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcar la base de datos para la tabla `historialnp`
--

INSERT INTO `historialnp` (`Id_HistorialNP`, `Id_Accesorio`, `Id_Negociacion`, `Cantidad`) VALUES
(3, 1, 2, 2),
(4, 1, 1, 1),
(6, 1, 7, 2),
(7, 1, 9, 5),
(8, 1, 10, 1),
(9, 1, 10, 1),
(10, 1, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialnp2`
--

DROP TABLE IF EXISTS `historialnp2`;
CREATE TABLE `historialnp2` (
  `Id_HistorialNP2` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int(10) DEFAULT NULL,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Cantidad` int(100) DEFAULT NULL,
  PRIMARY KEY (`Id_HistorialNP2`),
  KEY `HistorialNP2_fk` (`Id_Equipo`),
  KEY `HistorialNP2_fk2` (`Id_Negociacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `historialnp2`
--

INSERT INTO `historialnp2` (`Id_HistorialNP2`, `Id_Equipo`, `Id_Negociacion`, `Cantidad`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 2, 1, 1),
(10, 1, 7, 1),
(11, 1, 9, 5),
(12, 1, 5, 2),
(13, 1, 10, 2),
(14, 1, 8, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcar la base de datos para la tabla `historial_ns`
--

INSERT INTO `historial_ns` (`Id_Historial_Ns`, `Id_Negociacion`, `Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`) VALUES
(1, 1, 1, '30/01/2012', 'Inicial', NULL, 'Borrador'),
(2, 2, 2, '30/01/2012', 'Inicial', NULL, 'Borrador'),
(3, 1, 1, '30/01/2012', 'Llamada telefonica', 'Prueba 1', 'Borrador'),
(4, 2, 2, '30/01/2012', 'Visita', 'Prueba 2', 'Borrador'),
(5, 2, 2, '30/01/2012', 'Llamada telefonica', 'Prueba 3', 'Activa'),
(6, 2, 2, '30/01/2012', 'Llamada telefonica', 'Prueba 4', 'Activa'),
(7, 2, 2, '30/01/2012', 'Visita', 'Se entrego la cotizacion', 'Activa'),
(8, 2, 2, '30/01/2012', 'Llamada telefonica', 'Esta pensando como pagar...', 'Activa'),
(9, 2, 2, '30/01/2012', 'Visita', 'PRUEBA-1', 'Activa'),
(10, 2, 2, '30/01/2012', 'Visita', 'PRUEBA 2', 'Activa'),
(11, 3, 3, '02/02/2012', 'Inicial', NULL, 'Borrador'),
(12, 4, 4, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(13, 5, 5, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(14, 6, 6, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(15, 6, 6, '03/02/2012', 'Correo electronico', 'Prueba', 'Activa'),
(16, 3, 3, '03/02/2012', 'Correo electronico', 'Prueba', 'Ganada'),
(17, 4, 4, '03/02/2012', 'Mensaje de texto', 'eff', 'Perdida'),
(18, 3, 3, '03/02/2012', 'Correo electronico', 'dfgdfg', 'Cerrada'),
(19, 7, 7, '08/02/2012', 'Inicial', NULL, 'Borrador'),
(20, 8, 8, '08/02/2012', 'Inicial', NULL, 'Borrador'),
(21, 9, 9, '09/02/2012', 'Inicial', NULL, 'Borrador'),
(22, 5, 5, '10/02/2012', 'Visita', 'Prueba...', 'Activa'),
(23, 10, 10, '10/02/2012', 'Inicial', NULL, 'Borrador'),
(24, 10, 10, '10/02/2012', 'Visita', 'Visita programada x Gerente', 'Borrador'),
(25, 10, 10, '10/02/2012', NULL, 'Fdfgdddh', 'Borrador'),
(26, 8, 8, '14/02/2012', 'Mensaje de texto', 'Prueba 3', 'Ganada');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`Id_Institucion`, `Tipo_I`, `Nombre`, `Especialidad`, `Pais`, `Estado`, `Ciudad`, `CodigoP`, `Rif`, `Web`, `Telefono1`, `Telefono2`, `Telefono3`, `Twitter`, `Facebook`, `GooglePlus`, `Direccion1`, `Direccion2`, `Direccion3`) VALUES
(1, 'Privado', 'LP21', 'Imagenologia', 'Venezuela', 'Distrito Capital', 'Caracas', 12345, 'J-3445345345', 'www.lp21.com.ve', '58212578474', '58212578474', '58212578474', '@lp21', '', '', 'Bellas Artes', 'Bellas Artes', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

DROP TABLE IF EXISTS `linea`;
CREATE TABLE `linea` (
  `Id_Linea` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Linea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `linea`
--

INSERT INTO `linea` (`Id_Linea`, `Nombre`) VALUES
(1, 'Laptop'),
(2, 'Monitores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE `marca` (
  `Id_Marca` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `marca`
--

INSERT INTO `marca` (`Id_Marca`, `Nombre`) VALUES
(1, 'Dell'),
(2, 'Apple'),
(3, 'HP'),
(4, 'Lenovo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_linea`
--

DROP TABLE IF EXISTS `marca_linea`;
CREATE TABLE `marca_linea` (
  `Id_Marca_Linea` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Marca` int(10) NOT NULL,
  `Id_Linea` int(10) NOT NULL,
  PRIMARY KEY (`Id_Marca_Linea`),
  KEY `Marca_Linea_fk` (`Id_Marca`),
  KEY `Marca_Linea_fk2` (`Id_Linea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `marca_linea`
--

INSERT INTO `marca_linea` (`Id_Marca_Linea`, `Id_Marca`, `Id_Linea`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ml_equipo`
--

DROP TABLE IF EXISTS `ml_equipo`;
CREATE TABLE `ml_equipo` (
  `Id_ML_Equipo` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Equipo` int(10) NOT NULL,
  `Id_Marca_Linea` int(10) NOT NULL,
  PRIMARY KEY (`Id_ML_Equipo`),
  KEY `ML_Equipo_fk` (`Id_Equipo`),
  KEY `ML_Equipo_fk2` (`Id_Marca_Linea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `ml_equipo`
--

INSERT INTO `ml_equipo` (`Id_ML_Equipo`, `Id_Equipo`, `Id_Marca_Linea`) VALUES
(1, 1, 1),
(2, 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `negociacion`
--

INSERT INTO `negociacion` (`Id_Negociacion`, `Id_Cliente`, `Id_Institucion`, `Id_Empleado`, `FechaP`, `NumeroODC`, `FechaODC`, `Banco`, `PagoInicial`, `CondicionesPago`, `FechaPago`, `NDeposito`, `Status`, `Descuento`, `Total`) VALUES
(1, NULL, 1, 12374904, '30/01/2012', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, '10', '18099'),
(2, 1, NULL, 12374904, '30/01/2012', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, NULL, NULL),
(3, 1, NULL, 12374904, '02/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, 2, NULL, 12374904, '03/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 2, NULL, 12374904, '03/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(6, 2, NULL, 12374904, '03/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(7, 1, NULL, 12374904, '08/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(8, 1, NULL, 12374904, '08/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '10', '3645'),
(9, 1, NULL, 17234567, '09/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '0'),
(10, 4, NULL, 12374904, '10/02/2012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '8320');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `ns`
--

INSERT INTO `ns` (`Id_NS`, `Id_Negociacion`, `Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`) VALUES
(1, 1, 1, '30/01/2012', 'Inicial', NULL, 'Borrador'),
(2, 2, 2, '30/01/2012', 'Inicial', NULL, 'Borrador'),
(3, 3, 3, '02/02/2012', 'Inicial', NULL, 'Borrador'),
(4, 4, 4, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(5, 5, 5, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(6, 6, 6, '03/02/2012', 'Inicial', NULL, 'Borrador'),
(7, 7, 7, '08/02/2012', 'Inicial', NULL, 'Borrador'),
(8, 8, 8, '08/02/2012', 'Inicial', NULL, 'Borrador'),
(9, 9, 9, '09/02/2012', 'Inicial', NULL, 'Borrador'),
(10, 10, 10, '10/02/2012', 'Inicial', NULL, 'Borrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `Id_Pais` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Id_Pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `pais`
--

INSERT INTO `pais` (`Id_Pais`, `Nombre`) VALUES
(1, 'Venezuela');

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
  `Porcentaje` int(5) DEFAULT NULL,
  PRIMARY KEY (`Id_Seguimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcar la base de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`Id_Seguimiento`, `FechaS`, `TipoS`, `Resumen`, `Status`, `Porcentaje`) VALUES
(1, '30/01/2012', 'Llamada telefonica', 'Prueba 1', 'Borrador', 25),
(2, '30/01/2012', 'Visita', 'PRUEBA 2', 'Activa', 90),
(3, '03/02/2012', 'Correo electronico', 'dfgdfg', 'Cerrada', 100),
(4, '03/02/2012', 'Mensaje de texto', 'eff', 'Perdida', 0),
(5, '10/02/2012', 'Visita', 'Prueba...', 'Activa', 75),
(6, '03/02/2012', 'Correo electronico', 'Prueba', 'Activa', 50),
(7, '08/02/2012', 'Inicial', NULL, 'Borrador', 25),
(8, '14/02/2012', 'Mensaje de texto', 'Prueba 3', 'Ganada', 100),
(9, '09/02/2012', 'Inicial', NULL, 'Borrador', 25),
(10, '10/02/2012', 'Visita', 'Visita programada x Gerente', 'Borrador', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcalendario`
--

DROP TABLE IF EXISTS `tcalendario`;
CREATE TABLE `tcalendario` (
  `Id_TCalendario` int(255) NOT NULL AUTO_INCREMENT,
  `Id_Empleado` int(255) NOT NULL,
  `Fecha` varchar(10) DEFAULT NULL,
  `Evento` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Id_TCalendario`),
  KEY `TCalendario_fk` (`Id_Empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tcalendario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventanego`
--

DROP TABLE IF EXISTS `ventanego`;
CREATE TABLE `ventanego` (
  `Id_VentaNego` int(10) NOT NULL AUTO_INCREMENT,
  `Id_Negociacion` int(10) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Final` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`Id_VentaNego`),
  KEY `VentaNego_fk` (`Id_Negociacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `ventanego`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `aequipo`
--
ALTER TABLE `aequipo`
  ADD CONSTRAINT `AEquipo_fk` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipo` (`Id_Equipo`),
  ADD CONSTRAINT `AEquipo_fk2` FOREIGN KEY (`Id_Accesorio`) REFERENCES `accesorio` (`Id_Accesorio`);

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
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `Ciudad_fk` FOREIGN KEY (`Id_Estado`) REFERENCES `estado` (`Id_Estado`);

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
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `Estado_fk` FOREIGN KEY (`Id_Pais`) REFERENCES `pais` (`Id_Pais`);

--
-- Filtros para la tabla `historialnp`
--
ALTER TABLE `historialnp`
  ADD CONSTRAINT `HistorialNP_fk` FOREIGN KEY (`Id_Accesorio`) REFERENCES `accesorio` (`Id_Accesorio`),
  ADD CONSTRAINT `HistorialNP_fk2` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`);

--
-- Filtros para la tabla `historialnp2`
--
ALTER TABLE `historialnp2`
  ADD CONSTRAINT `HistorialNP2_fk` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipo` (`Id_Equipo`),
  ADD CONSTRAINT `HistorialNP2_fk2` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`);

--
-- Filtros para la tabla `historial_ns`
--
ALTER TABLE `historial_ns`
  ADD CONSTRAINT `Historial_Ns_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`),
  ADD CONSTRAINT `Historial_Ns_fk2` FOREIGN KEY (`Id_Seguimiento`) REFERENCES `seguimiento` (`Id_Seguimiento`);

--
-- Filtros para la tabla `marca_linea`
--
ALTER TABLE `marca_linea`
  ADD CONSTRAINT `Marca_Linea_fk` FOREIGN KEY (`Id_Marca`) REFERENCES `marca` (`Id_Marca`),
  ADD CONSTRAINT `Marca_Linea_fk2` FOREIGN KEY (`Id_Linea`) REFERENCES `linea` (`Id_Linea`);

--
-- Filtros para la tabla `ml_equipo`
--
ALTER TABLE `ml_equipo`
  ADD CONSTRAINT `ML_Equipo_fk` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipo` (`Id_Equipo`),
  ADD CONSTRAINT `ML_Equipo_fk2` FOREIGN KEY (`Id_Marca_Linea`) REFERENCES `marca_linea` (`Id_Marca_Linea`);

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

--
-- Filtros para la tabla `ventanego`
--
ALTER TABLE `ventanego`
  ADD CONSTRAINT `VentaNego_fk` FOREIGN KEY (`Id_Negociacion`) REFERENCES `negociacion` (`Id_Negociacion`);
