-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2020 a las 16:55:23
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `roomview`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `EMP_NO` int(4) NOT NULL,
  `NOMBRE` varchar(25) DEFAULT NULL,
  `APELLIDO` varchar(14) DEFAULT NULL,
  `CLAVE` varchar(25) DEFAULT NULL,
  `DPTO` varchar(25) DEFAULT NULL,
  `TIPO_EMP` varchar(25) DEFAULT NULL,
  `EMAIL` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`EMP_NO`, `NOMBRE`, `APELLIDO`, `CLAVE`, `DPTO`, `TIPO_EMP`, `EMAIL`) VALUES
(1000, 'ADMIN', 'ADMIN', '1000AdminA', 'ADMINISTRADOR', 'ADMIN', 'admin@gmail.com'),
(1001, 'LUIS', 'GARCIA', '1001LuisG', 'MARKETING', 'JEFE', 'luisgarcia@gmail.com'),
(1002, 'OLGA', 'PEREZ', '1002OlgaP', 'INFORMATICA', 'EMPLEADO', 'olgaperez@hotmail.com'),
(1003, 'CESAR', 'LOPEZ', '1003CesarL', 'RRHH', 'JEFE', 'cesarlopez@gmail.com'),
(1004, 'JULIAN', 'MONTES', '1004JulianM', 'ADMINISTRACION', 'EMPLEADO', 'julianmontes@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id`, `id_reserva`, `id_empleado`, `descripcion`) VALUES
(4, 26, 1001, 'Quiero eliminar esta reunion'),
(5, 28, 1001, 'deseo eliminar la reunion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `textcolor` varchar(255) NOT NULL DEFAULT 'white',
  `start` text NOT NULL,
  `sala_no` int(11) NOT NULL,
  `emp_no` int(11) NOT NULL,
  `hora` text NOT NULL,
  `dia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `title`, `descripcion`, `color`, `textcolor`, `start`, `sala_no`, `emp_no`, `hora`, `dia`) VALUES
(27, 'Reunion informatica', '', '#0011ff', 'white', '2020-06-03 12:30', 2, 1001, '12:30', '2020-06-03'),
(29, 'reunion para charlar', 'somos 3 personas', '#00d9ff', 'white', '2020-06-04 11:30', 3, 1001, '11:30', '2020-06-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `SALA_NO` int(4) NOT NULL,
  `TIPO` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`SALA_NO`, `TIPO`) VALUES
(1, 'VIDEOCONFERENCIA'),
(2, 'ESTANDAR'),
(3, 'ESTANDAR'),
(4, 'VIDEOCONFERENCIA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EMP_NO`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`SALA_NO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
