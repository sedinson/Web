-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-04-2012 a las 06:35:10
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `access`
--

INSERT INTO `access` (`idaccess`, `idparent`, `title`, `image`, `url`) VALUES
(1, 0, 'Descripcion', '55134fpath3084-7.png', 'Comentario'),
(2, 1, 'Titulo', '9c4eedKoala.jpg', 'Prueba/uno'),
(3, 0, 'Otro Mas', 'faf32bChrysanthemum.jpg', 'Lass Diarra'),
(4, 0, 'Nuevo Titulo', '329477Koala.jpg', 'Nuevo Comentario'),
(5, 0, 'Cita en un bar', '2099c0Hydrangeas.jpg', 'Ricardo Arjona'),
(6, 0, 'A Ti', '096e12mundo-1600-x-1200.jpg', 'Ricardo Arjona');

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
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
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
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
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
  `author` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcar la base de datos para la tabla `modhelp`
--

