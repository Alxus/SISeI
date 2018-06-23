-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2018 at 09:11 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siseixii`
--

-- --------------------------------------------------------

--
-- Table structure for table `asistente`
--

CREATE TABLE IF NOT EXISTS `asistente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` bigint(20) NOT NULL,
  `facebook_name` varchar(200) NOT NULL,
  `facebook_first_name` varchar(200) NOT NULL,
  `facebook_link` varchar(300) NOT NULL,
  `nombre_real` varchar(55) NOT NULL,
  `apellido_real` varchar(55) NOT NULL,
  `no_control` varchar(8) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `carrera` tinyint(4) NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `talla` varchar(4) NOT NULL,
  `id_cuarto` int(11) DEFAULT NULL,
  `pro` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `asistente`
--

INSERT INTO `asistente` (`id`, `facebook_id`, `facebook_name`, `facebook_first_name`, `facebook_link`, `nombre_real`, `apellido_real`, `no_control`, `tel`, `email`, `password`, `carrera`, `sexo`, `talla`, `id_cuarto`, `pro`, `created_at`, `updated_at`) VALUES
(1, 123456, ':v', ':v', ':v', ':v', ':v', '123123', '12312312', 'adasdadas@asdad.com', NULL, 0, 0, '', NULL, 0, '2018-06-02 00:52:02', '0000-00-00 00:00:00'),
(2, 123456, ':v', ':v', ':v', ':v', ':v', '123123', '12312312', 'adasdadas@asdad.com', NULL, 0, 1, '0', NULL, 0, '2018-06-02 00:52:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asistente_carnet`
--

CREATE TABLE IF NOT EXISTS `asistente_carnet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_id` int(11) NOT NULL,
  `carnet_id` int(11) NOT NULL,
  `debe` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `asistente_taller`
--

CREATE TABLE IF NOT EXISTS `asistente_taller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_id` int(11) NOT NULL,
  `taller_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_id` int(11) NOT NULL,
  `conferencia_id` int(11) NOT NULL,
  `taller_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `carnet`
--

CREATE TABLE IF NOT EXISTS `carnet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `precio` int(11) NOT NULL,
  `limite` int(11) NOT NULL,
  `descripcion` varchar(240) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_id` int(11) NOT NULL,
  `conferencia_id` int(11) NOT NULL,
  `taller_id` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conferencia`
--

CREATE TABLE IF NOT EXISTS `conferencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ponente_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `calificacion` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `logo_empresa` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cuarto`
--

CREATE TABLE IF NOT EXISTS `cuarto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `clave` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_carnet_id` int(11) NOT NULL,
  `id_cargo` varchar(100) NOT NULL,
  `folio_cargo` varchar(100) NOT NULL,
  `customer_name` varchar(120) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` datetime NOT NULL,
  `fecha_pago` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tienda` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  `descripcion_abono` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ponente`
--

CREATE TABLE IF NOT EXISTS `ponente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conferencia_id` int(11) NOT NULL,
  `taller_id` int(11) NOT NULL,
  `nombres` varchar(55) NOT NULL,
  `apellidos` varchar(55) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asistente_id` int(11) NOT NULL,
  `conferencia_id` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taller`
--

CREATE TABLE IF NOT EXISTS `taller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ponente_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `requisitos` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `limite` tinyint(1) NOT NULL,
  `registrados` tinyint(1) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `nivel` varchar(12) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `taller`
--

INSERT INTO `taller` (`id`, `ponente_id`, `nombre`, `descripcion`, `requisitos`, `fecha`, `hora`, `lugar`, `limite`, `registrados`, `calificacion`, `nivel`, `imagen`, `icono`, `created_at`, `updated_at`) VALUES
(1, 0, 'Como ser una verga', 'Taller que te enseña a ser una verga', 'Ninguno, asi nomas jalese alv', '2018-12-31', '23:00:00', 'En mi casa', 10, 0, 0, '1', 'http://[::1]/SISeIXII/assets/img/logo_tecnm.png', 'http://[::1]/SISeIXII/assets/img/logo_itc.png', '2018-06-01 23:36:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `nombres` varchar(55) NOT NULL,
  `apellidos` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_accessed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `tipo`, `nombres`, `apellidos`, `created_at`, `updated_at`, `last_accessed`) VALUES
(1, 'DavidMV', 'mm123', 0, 'David Adrian', 'Meza Valenzuela', '2018-06-16 00:13:19', '0000-00-00 00:00:00', '2018-06-23 02:37:47'),
(2, 'Silvia', '123456789', 1, 'Silvia', 'Lopez', '2018-06-20 02:01:39', '0000-00-00 00:00:00', '2018-06-20 03:02:28'),
(3, 'SuperUser', '123456789', 1, 'Heleodoro', 'Medrano', '2018-06-20 02:05:26', '0000-00-00 00:00:00', '2018-06-20 03:18:37'),
(4, 'Lalillopro', '123456789', 2, 'Eduardo', 'Balderas', '2018-06-20 02:06:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ElBryan', '123456789', 3, 'Bryan', 'Vazquez', '2018-06-20 02:10:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ElBryan', '123456789', 3, 'Bryan', 'Vazquez', '2018-06-20 02:19:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
