-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2012 at 08:19 PM
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
  `ord` int(11) NOT NULL DEFAULT '0',
  `shw` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idaccess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`idaccess`, `idparent`, `title`, `image`, `url`, `ord`, `shw`) VALUES
(6, 0, 'Medidas', '73e079image3014.png', 'Diferentes tipos de medidas: de centralizaci&oacute;n, de variabilidad, de posici&oacute;n y de forma', 0, 1),
(7, 0, 'Gr&aacute;ficas', '24e450g3862.png', 'Dibujar todo tipo de gr&aacute;ficas como torta, barra, etc.', 0, 1),
(9, 0, 'Distribuciones', '9a5626g6080.png', 'Diferentes tipos de distribuciones de probabilidad', 0, 1),
(10, 7, 'Gr&aacute;fica Circular', '82a3e324e450g3862.png', 'Graficas/Torta', 0, 1),
(11, 7, 'Histograma', '9c3079g5488.png', 'Graficas/Barra', 0, 1),
(12, 7, 'Caja y Bigotes', 'dff5a1g5504.png', 'Graficas/CajayBigotes', 0, 1),
(13, 7, 'Diagrama de Ojiva', '7184e0g5777.png', 'Graficas/FrecuenciaAcumulada', 0, 1),
(14, 0, 'Estimaci&oacute;n', 'f7cdfeg4652.png', 'Estimaciones por intervalos e intervalos de confianza', 0, 1),
(15, 0, 'Sobre la Aplicaci&oacute;n', 'e8619ag5289.png', 'Descubre quienes trabajaron en esta aplicaci&oacute;n y como contribuir', 9999, 1),
(16, 15, 'Quienes Colaboraron', 'a4d7f5g5289.png', 'About/Quienes', 0, 1),
(17, 15, 'Como Contribuir', '8b1bf2g5789.png', 'About/Como', 0, 1),
(19, 6, 'Medidas de Centralizaci&oacute;n', 'b6730373e079image3014.png', 'Medidas/Centralizacion', 0, 1),
(20, 6, 'Medidas de Variabilidad', 'c5145a73e079image3014.png', 'Medidas/Variabilidad', 0, 1),
(21, 15, 'Documentaci&oacute;n', '06c7c8g6253.png', 'About/Documentacion', 0, 1),
(23, 14, 'Intervalo de Confianza para la Media', 'f18a70miu.png', 'Estimacion/media', 0, 1),
(24, 14, 'Intervalo de Confianza para la Varianza', '237b47sigma.png', 'Estimacion/Varianza', 0, 1),
(25, 14, 'Intervalo de Confianza para ProporciÃ³n', '6a0313proporcion.png', 'Estimacion/Proporcion', 0, 1),
(26, 14, 'Intervalo de Confianza para  Diferencia de Medias', '690b7cdiferenciaMedias.png', 'Estimacion/DiferenciaDeMedia', 0, 1),
(27, 14, 'Intervalo para el Cociente de Varianzas', '94aaadcoefVar.png', 'Estimacion/CocienteVarianzas', 0, 1),
(28, 14, 'Intervalo para la Diferencia de Proporciones', 'ac35fddifP.png', 'Estimacion/DiferenciaProporcion', 0, 1),
(29, 14, 'Intervalo de PredicciÃ³n', 'a8b320prediccion.png', 'Estimacion/Prediccion', 0, 1),
(30, 14, 'Intervalo de Tolerancia', 'c3fe8ftolerancia.png', 'Estimacion/Tolerancia', 0, 1),
(31, 7, 'Diagrama de Poligono', 'e8e7c3g4647.png', 'Graficas/Frecuencia', 0, 1),
(32, 7, 'Diagrama de Puntos', 'c07571g4648.png', 'Graficas/Puntos', 0, 1),
(33, 7, 'Diagrama de Pareto', '2470e6g4649.png', 'Graficas/Pareto', 0, 1),
(34, 7, 'Pol&iacute;gono de frecuencia', '2382c3g4650.png', 'Graficas/PoligonoFrecuencia', 0, 1),
(35, 6, 'Medidas de Posici&oacute;n', '07849bg4651.png', 'Medidas/Posicion', 0, 1),
(36, 7, 'Ingresar Datos Manualmente', '5701e806c7c8g6253.png', 'Graficas/Datos', 9999, 1),
(37, 6, 'Medidas de Forma', '8a96a806c7c8g6253.png', 'Medidas/Forma', 0, 1),
(38, 6, 'Ingresar Datos Manualmente', 'f4d1a006c7c8g6253.png', 'Graficas/Datos', 9999, 1),
(39, 9, 'DistribuciÃ³n Binomial', 'fedd2bg8037.png', 'Probability/Binomial', 0, 1),
(40, 9, 'DistribuciÃ³n GeomÃ©trica', '4611fbg8102.png', 'Probability/Geometrica', 0, 1),
(41, 9, 'DistribuciÃ³n Binomial Negativa', '2ba2b9g8224.png', 'Probability/BinomialNegativa', 0, 1),
(42, 9, 'DistribuciÃ³n HipergeomÃ©trica', '3cd86ag8313.png', 'Probability/HiperGeometrica', 0, 1),
(43, 9, 'DistribuciÃ³n de Poisson', 'fcce40g9031.png', 'Probability/Poisson', 0, 1),
(44, 9, 'DistribuciÃ³n Uniforme Discreta', 'b79b8cg9224.png', 'Probability/UniformeDiscreta', 0, 1),
(45, 9, 'DistribuciÃ³n Normal', '9ce5bcg9512.png', 'Probability/Normal', 0, 1),
(46, 9, 'DistribuciÃ³n Normal EstÃ¡ndar', 'c4418fg9739.png', 'Probability/NormalEstandar', 0, 1),
(47, 9, 'DistribuciÃ³n Uniforme Continua', '8fff21g9927.png', 'Probability/UniformeContinua', 0, 1),
(48, 9, 'DistribuciÃ³n Exponencial', '7f6992g10143.png', 'Probability/Exponencial', 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`idexample`, `idaccess`, `example`, `iduser`, `creationdate`) VALUES
(1, 35, '<ul>\r\n <li>Ejemplo 1\r\n  <ul>\r\n   <li>Aqui va texto oculto, solo se muestra al hacer cli en el texto de arriba</li>\r\n  </ul>\r\n </li>\r\n <li>Ejemplo 2\r\n  <ul>\r\n   <li>Este es el segundo comentario. Se mostro al hacer clic sobre el texto Ejemplo 2</li>\r\n  </ul>\r\n </li>\r\n</ul>', 1, '2012-05-17 06:00:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`idhelp`, `idaccess`, `help`, `iduser`, `creationdate`) VALUES
(1, 10, 'Esto es un ejemplo de ayuda, hecho en la <b>grÃ¡fica de torta</b> mas info aca', 1, '2012-05-14 16:27:15'),
(2, 35, '<ul>\r\n	<li>Titulo 1\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo 2\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo 3\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo n\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n</ul>', 1, '2012-05-17 05:52:48');

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

--
-- Dumping data for table `modexample`
--

INSERT INTO `modexample` (`idexample`, `iduser`, `example`, `modificationdate`) VALUES
(1, 1, '<ul>\r\n <li>Ejemplo 1\r\n  <ul>\r\n   <li>Aqui va texto oculto, solo se muestra al hacer cli en el texto de arriba</li>\r\n  </ul>\r\n </li>\r\n <li>Ejemplo 2\r\n  <ul>\r\n   <li>Este es el segundo comentario. Se mostro al hacer clic sobre el texto Ejemplo 2</li>\r\n  </ul>\r\n </li>\r\n</ul>', '2012-05-20 15:19:07'),
(1, 1, 'Aqui les va esta', '2012-05-20 15:19:58');

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

--
-- Dumping data for table `modhelp`
--

INSERT INTO `modhelp` (`idhelp`, `iduser`, `help`, `modificationdate`) VALUES
(2, 1, '<ul>\r\n	<li>Titulo 1\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo 2\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo 3\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n	\r\n	<li>Titulo n\r\n		<ul>\r\n			<li>Aqui va el texto</li>\r\n		</ul>\r\n	</li>\r\n</ul>', '2012-05-20 15:11:59'),
(2, 1, 'hola mundo', '2012-05-20 15:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, 'sedinson', '247be2fed4f687a5bbd6d9c0d5b845cc'),
(2, 'jbentham', 'b08e9c703083c108ff9fd63d5138e1f4'),
(3, 'fdcardenas', 'df5e8a5d3e236206548b1a5ce831b269'),
(4, 'daniescol', '45fbaf0f7901747d8192321c5ecbd422'),
(5, 'leandroniebles', '48a728601a5a05c9751a072466755c6b'),
(6, 'oscarhporto', '836f0ef3ca322557e0dd3a92bdf0757d');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
