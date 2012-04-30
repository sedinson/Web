-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-04-2012 a las 04:49:54
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `stat`
--
CREATE DATABASE `stat` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `stat`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `idaccess` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `url` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`idaccess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=22 ;

--
-- Volcar la base de datos para la tabla `access`
--

INSERT INTO `access` (`idaccess`, `idparent`, `title`, `image`, `url`) VALUES
(6, 0, 'Medidas', '73e079image3014.png', 'Diferentes tipos de medidas: de centralizaci&oacute;n, de variabilidad, de posici&oacute;n y de forma'),
(7, 0, 'Graficas', '24e450g3862.png', 'Dibujar todo tipo de gr&aacute;ficas como torta, barra, etc.'),
(9, 0, 'Distribuciones', '9a5626g6080.png', 'Diferentes tipos de distribuciones de probabilidad'),
(10, 7, 'Torta', '82a3e324e450g3862.png', 'Graficas/Torta'),
(11, 7, 'Barra', '9c3079g5488.png', 'Graficas/Barra'),
(12, 7, 'Caja y Bigotes', 'dff5a1g5504.png', 'Graficas/CajayBigotes'),
(13, 7, 'Frecuencia Acumulada', '7184e0g5777.png', 'Graficas/FrecuenciaAcumulada'),
(14, 0, 'Estimaci&oacute;n', 'f7cdfeg4652.png', 'Estimaciones por intervalos e intervalos de confianza'),
(15, 0, 'Sobre Nosotros', 'e8619ag5289.png', 'Descubre quienes trabajaron en esta aplicaci&oacute;n y como contribuir'),
(16, 15, 'Quienes Colaboraron', 'a4d7f5g5289.png', 'About/Quienes'),
(17, 15, 'Como Contribuir', '8b1bf2g5789.png', 'About/Como'),
(18, 9, 'Normal', '6673b0g6080.png', 'Distribucion/Normal'),
(19, 6, 'Centralizaci&oacute;n', 'b6730373e079image3014.png', 'Medidas/Centralizacion'),
(20, 6, 'Variabilidad', 'c5145a73e079image3014.png', 'Medidas/Variabilidad'),
(21, 15, 'Documentaci&oacute;n', '06c7c8g6253.png', 'About/Documentacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `idexample` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idexample`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `example`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `idhelp` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhelp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `help`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modexample`
--

CREATE TABLE IF NOT EXISTS `modexample` (
  `idexample` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcar la base de datos para la tabla `modexample`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modhelp`
--

CREATE TABLE IF NOT EXISTS `modhelp` (
  `idhelp` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcar la base de datos para la tabla `modhelp`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `user`
--

