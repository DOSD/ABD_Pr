-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2017 a las 21:40:00
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abd_practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`Nombre`) VALUES
('Clasica'),
('Hardstyle'),
('House'),
('Metal'),
('Pop'),
('Rap'),
('Regueton'),
('Rock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `Nombre` varchar(20) NOT NULL,
  `Genero` varchar(20) NOT NULL,
  `EdadMinima` int(2) NOT NULL,
  `EdadMaxima` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`Nombre`, `Genero`, `EdadMinima`, `EdadMaxima`) VALUES
('ACDC', 'Rock', 10, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `Emisor` varchar(20) NOT NULL,
  `Receptor` varchar(20) NOT NULL,
  `GrupoReceptor` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Texto` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `Nombre` varchar(30) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Contrasenia` varchar(8) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Edad` int(2) DEFAULT NULL,
  `TipoMusica` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`Nombre`, `Username`, `Contrasenia`, `Email`, `Edad`, `TipoMusica`) VALUES
('Administrador', 'ADMIN', 'ADMIN', 'suport@melomania.com', NULL, NULL),
('Ivy', 'dosd', 'dosd', 'ivangulyk@hotmail.com', 15, 'Rock'),
('Ivan Gulyk', 'user', 'user', 'ivangulyk@hotmail.com', 15, 'Rock');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`Nombre`),
  ADD KEY `Genero` (`Genero`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `TipoMusica` (`TipoMusica`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`Genero`) REFERENCES `genero` (`Nombre`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`TipoMusica`) REFERENCES `genero` (`Nombre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
