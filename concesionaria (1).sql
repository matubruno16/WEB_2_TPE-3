-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2024 a las 19:08:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `imagen`, `valoracion`) VALUES
(8, 'Mercedes Benz', 'img/vehiculos/6712a39d90a24.jpg', 5),
(9, 'Volkswagen ', 'img/vehiculos/6712a3a687cf4.jpg', 10),
(10, 'Ford', 'img/vehiculos/6712a3f5242e5.jpg', 8),
(11, 'Fiat', 'img/vehiculos/6712a3fe90a65.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `contraseña` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `nombre_usuario`, `contraseña`) VALUES
(1, 'Matias', 'matias@gmail.com', '$2y$10$7eBjz3TM3rzE.khsQ06jR.2Ni.h4IffFLRnIuxHWWCzTfK0Chnlzq'),
(2, 'Martiniano', 'martu@gmail.com', '$2y$10$zPJYcNBHjv6DupbdA5vGZuBJuNsB1oc3iv7Z6OQZf5zcELimY2y/O'),
(6, 'Aprobame (porfavor)', 'webadmin', '$2y$10$SqYnX2sJjU5mWq8bFQ4JHOyyBaSkj5s7zc8Gjt8hv8rXSx8tW1mdy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `marca` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `consumo` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `modelo`, `marca`, `descripcion`, `imagen`, `consumo`, `valoracion`) VALUES
(26, 'Ranger', 10, 'Es una camioneta 4x4', 'img/vehiculos/6712a4968a9b4.jpg', 8, 6),
(27, 'Saveiro', 9, 'Es una camioneta chiquita pero muy fachera', 'img/vehiculos/6712a4af3b747.jpg', 5, 7),
(28, 'Cronos', 11, 'Es el auto mas vendido en 2023', 'img/vehiculos/6712a4bf610ee.jpg', 3, 10),
(29, 'Ka', 10, 'Es un auto chico para cuidad', 'img/vehiculos/6712a4d493032.jpg', 4, 8),
(30, 'Clase A', 8, 'Es una locura de auto', 'img/vehiculos/6712a51dca76f.jpg', 7, 9),
(31, 'Voyage', 9, 'Muy bonito', 'img/vehiculos/default.png', 1, 1),
(32, 'Mobi', 11, 'Chiquito y comodisimo, un rayo', 'img/vehiculos/default.png', 9, 4),
(33, 'Fastback', 11, 'Medio grande pero re comodo', 'img/vehiculos/default.png', 9, 4),
(34, 'T-cross', 9, 'Grandote', 'img/vehiculos/default.png', 10, 8),
(35, 'Nivus', 8, 'Nuevito nuevito', 'img/vehiculos/default.png', 3, 9),
(36, 'Coupe', 8, 'Un lujo', 'img/vehiculos/default.png', 6, 6),
(37, 'AMG GT', 8, 'Un poquitin caro pero muy muy lindo', 'img/vehiculos/default.png', 4, 6),
(38, 'Pulse', 11, 'No tiene nada que ver con las pulsaciones', 'img/vehiculos/default.png', 8, 7),
(42, 'ejemplo1', 15, 'algo', '', 8, 6),
(43, 'ejemplo1', 15, 'algo', '', 8, 6),
(44, 'ejemplo1', 15, 'algo', '', 8, 6),
(45, 'ejemplo1', 15, 'algo', '', 8, 6),
(46, 'ejemplo1', 15, 'algo', '', 8, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`nombre_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `marca` (`marca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
