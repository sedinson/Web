-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2012 at 06:58 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stat`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `idaccess` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `url` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`idaccess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`idaccess`, `idparent`, `title`, `image`, `url`) VALUES
(6, 0, 'Medidas', '73e079image3014.png', 'Diferentes tipos de medidas: de centralizaci&oacute;n, de variabilidad, de posici&oacute;n y de forma'),
(7, 0, 'Gr&aacute;ficas', '24e450g3862.png', 'Dibujar todo tipo de gr&aacute;ficas como torta, barra, etc.'),
(9, 0, 'Distribuciones', '9a5626g6080.png', 'Diferentes tipos de distribuciones de probabilidad'),
(10, 7, 'Gr&aacute;fica Circular', '82a3e324e450g3862.png', 'Graficas/Torta'),
(11, 7, 'Diagrama de Barras', '9c3079g5488.png', 'Graficas/Barra'),
(12, 7, 'Caja y Bigotes', 'dff5a1g5504.png', 'Graficas/CajayBigotes'),
(13, 7, 'Diagrama de Frecuencia Acumulada', '7184e0g5777.png', 'Graficas/FrecuenciaAcumulada'),
(14, 0, 'Estimaci&oacute;n', 'f7cdfeg4652.png', 'Estimaciones por intervalos e intervalos de confianza'),
(15, 0, 'Sobre la Aplicaci&oacute;n', 'e8619ag5289.png', 'Descubre quienes trabajaron en esta aplicaci&oacute;n y como contribuir'),
(16, 15, 'Quienes Colaboraron', 'a4d7f5g5289.png', 'About/Quienes'),
(17, 15, 'Como Contribuir', '8b1bf2g5789.png', 'About/Como'),
(18, 9, 'Normal', '6673b0g6080.png', 'Distribucion/Normal'),
(19, 6, 'Medidas de Centralizaci&oacute;n', 'b6730373e079image3014.png', 'Medidas/Centralizacion'),
(20, 6, 'Medidas de Variabilidad', 'c5145a73e079image3014.png', 'Medidas/Variabilidad'),
(21, 15, 'Documentaci&oacute;n', '06c7c8g6253.png', 'About/Documentacion'),
(23, 14, 'Intervalo de Confianza para la Media', 'f18a70miu.png', 'Estimacion/media'),
(24, 14, 'Intervalo de Confianza para la Varianza', '237b47sigma.png', 'Estimacion/Varianza'),
(25, 14, 'Intervalo de Confianza para ProporciÃ³n', '6a0313proporcion.png', 'Estimacion/Proporcion'),
(26, 14, 'Intervalo de Confianza para  Diferencia de Medias', '690b7cdiferenciaMedias.png', 'Estimacion/DiferenciaDeMedia'),
(27, 14, 'Intervalo para el Coeficiente de Varianzas', '94aaadcoefVar.png', 'Estimacion/CoeficienteVarianzas'),
(28, 14, 'Intervalo para la Diferencia de Proporciones', 'ac35fddifP.png', 'Estimacion/DiferenciaProporcion'),
(29, 14, 'Intervalo de PredicciÃ³n', 'a8b320prediccion.png', 'Estimacion/Prediccion'),
(30, 14, 'Intervalo de Tolerancia', 'c3fe8ftolerancia.png', 'Estimacion/Tolerancia'),
(31, 7, 'Diagrama de Frecuencia', 'e8e7c3g4647.png', 'Graficas/Frecuencia'),
(32, 7, 'Diagrama de Puntos', 'c07571g4648.png', 'Graficas/Puntos'),
(33, 7, 'Diagrama de Pareto', '2470e6g4649.png', 'Graficas/Pareto'),
(34, 7, 'Diagrama de Ojiva', '2382c3g4650.png', 'Graficas/Ojiva'),
(35, 6, 'Medidas de Posici&oacute;n', '07849bg4651.png', 'Medidas/Posicion'),
(36, 7, 'Ingresar Datos Manualmente', '5701e806c7c8g6253.png', 'Graficas/Datos'),
(37, 6, 'Ingresar Datos Manualmente', '8a96a806c7c8g6253.png', 'Graficas/Datos');

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `idexample` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idexample`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `idhelp` int(11) NOT NULL AUTO_INCREMENT,
  `idaccess` int(11) NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `iduser` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idhelp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`idhelp`, `idaccess`, `help`, `iduser`, `creationdate`) VALUES
(1, 10, 'Esto es un ejemplo de ayuda, hecho en la <b>grÃ¡fica de torta</b>', 1, '2012-05-14 16:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `modexample`
--

CREATE TABLE IF NOT EXISTS `modexample` (
  `idexample` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `example` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modhelp`
--

CREATE TABLE IF NOT EXISTS `modhelp` (
  `idhelp` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `help` text COLLATE utf8_spanish2_ci NOT NULL,
  `modificationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, 'sedinson', '247be2fed4f687a5bbd6d9c0d5b845cc');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
