-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: oei-db
-- Generation Time: Dec 07, 2023 at 05:19 AM
-- Server version: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oei`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners_seccion`
--

CREATE TABLE `banners_seccion` (
  `banner_seccion_id` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `alt` text NOT NULL,
  `seccion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `_id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `edad` smallint(3) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'P' COMMENT 'P: pendiente\r\nA: aprobada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `keyword_id` int(11) NOT NULL,
  `keyword` varchar(20) NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword`, `estado`) VALUES
(1, 'Diego2022', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `title` varchar(65) NOT NULL,
  `headline` varchar(500) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `file_content` varchar(100) NOT NULL,
  `status` char(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seccion`
--

CREATE TABLE `seccion` (
  `seccion_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `multiple` char(1) NOT NULL,
  `imagen` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seccion`
--

INSERT INTO `seccion` (`seccion_id`, `nombre`, `multiple`, `imagen`) VALUES
(1, 'Seccion uno (descripcion, contactos, redes sociales)', '0', '0'),
(2, 'Sección dos principal (carrusel de imágenes)', '1', '1'),
(3, 'Sección tres (Mayor de 18 años...)', '0', '0'),
(4, 'Sección cuatro (Nuestra oferta)', '0', '1'),
(5, 'Sección cinco (Paginas publicas)', '0', '0'),
(6, 'Sección seis (una imagen)', '0', '1'),
(7, 'Sección siete (una imagen)', '0', '1'),
(8, 'Sección ocho (una imagen)', '0', '1'),
(9, 'Sección nueve (noticias)', '1', '1'),
(10, 'Sección diez (trabaja con nosotros card 1)', '0', '1'),
(11, 'Sección once (trabaja con nosotros card 2)', '0', '1'),
(12, 'Sección doce(trabaja con nosotros card 3)', '0', '1'),
(13, 'Sección trece (preguntas frecuentes)', '0', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners_seccion`
--
ALTER TABLE `banners_seccion`
  ADD PRIMARY KEY (`banner_seccion_id`),
  ADD KEY `seccion_id_fk` (`seccion_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`keyword_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`seccion_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners_seccion`
--
ALTER TABLE `banners_seccion`
  ADD CONSTRAINT `seccion_id_fk` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`seccion_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
