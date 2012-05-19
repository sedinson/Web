-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-04-2012 a las 20:05:13
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `access`
--

INSERT INTO `access` (`idaccess`, `idparent`, `title`, `image`, `url`) VALUES
(6, 0, 'Medidas', '73e079image3014.png', 'Diferentes tipos de medidas: de centralizaci&oacute;n, de variabilidad, de posici&oacute;n y de forma'),
(7, 0, 'Graficas', '24e450g3862.png', 'Dibujar todo tipo de gr&aacute;ficas como torta, barra, etc.'),
(8, 6, 'Ejemplo', '68227fimage3014.png', 'Prueba/uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `idexample` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idexample`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `idhelp` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhelp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modexample`
--

CREATE TABLE IF NOT EXISTS `modexample` (
  `idexample` int(11) NOT NULL,
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modhelp`
--

CREATE TABLE IF NOT EXISTS `modhelp` (
  `idhelp` int(11) NOT NULL,
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
