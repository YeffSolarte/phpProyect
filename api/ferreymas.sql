-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 09-07-2016 a las 00:57:50
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.37
=======
-- Tiempo de generación: 24-06-2016 a las 03:06:22
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15
>>>>>>> 89011b1cdfd6c8e074c5c680536886f08e20d12c

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreymas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_art` int(11) NOT NULL,
  `cod_art` varchar(5) NOT NULL,
  `nom_art` varchar(50) NOT NULL,
  `pre_com` double NOT NULL,
  `pre_ven` double NOT NULL,
  `img_art` varchar(100) DEFAULT NULL,
  `exi_art` int(10) NOT NULL,
  `des_art` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_art`, `cod_art`, `nom_art`, `pre_com`, `pre_ven`, `img_art`, `exi_art`, `des_art`) VALUES
(1, '1', 'lavaloza', 2000, 10000, NULL, 10, '0'),
(2, '2', 'arroz', 1500, 5000, NULL, 10, '0'),
(3, '3', 'Yeff Articulo', 5, 1000, NULL, 10, '0'),
(4, '4', 'Yeff Articulo 2', 5, 1000, NULL, 10, '0');

=======
>>>>>>> 89011b1cdfd6c8e074c5c680536886f08e20d12c
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `tip_doc` varchar(50) NOT NULL,
  `doc_cli` int(20) NOT NULL,
  `nom_cli` varchar(50) NOT NULL,
  `dir_cli` varchar(50) NOT NULL,
  `tel_cli` int(15) NOT NULL,
  `ciu_cli` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consecutivos`
--

CREATE TABLE `consecutivos` (
  `id_tip` int(1) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `fec_act` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_det_fac` int(11) NOT NULL,
  `id_fac` int(11) NOT NULL,
  `id_art` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tot_des` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_emp` int(11) NOT NULL,
  `tip_doc` varchar(50) NOT NULL,
  `doc_emp` int(20) NOT NULL,
  `cod_emp` varchar(5) NOT NULL,
  `nom_emp` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_fac` int(11) NOT NULL,
  `id_tip` int(11) NOT NULL,
  `consecutivo` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_emp` int(11) NOT NULL,
  `tot_des` float DEFAULT NULL,
  `tot_fac` float NOT NULL,
  `fec_fac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_pro` int(11) NOT NULL,
  `tip_doc` varchar(50) NOT NULL,
  `doc_pro` int(20) NOT NULL,
  `nom_pro` varchar(50) NOT NULL,
  `dir_pro` varchar(50) NOT NULL,
  `tel_pro` int(15) NOT NULL,
  `ciu_pro` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_art`),
  ADD UNIQUE KEY `cod_art` (`cod_art`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `consecutivos`
--
ALTER TABLE `consecutivos`
  ADD PRIMARY KEY (`id_tip`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_det_fac`),
  ADD KEY `id_fac` (`id_fac`),
  ADD KEY `id_art` (`id_art`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_emp`),
  ADD UNIQUE KEY `cod_emp` (`cod_emp`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_fac`),
  ADD KEY `id_tip` (`id_tip`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_pro` (`id_pro`),
  ADD KEY `id_emp` (`id_emp`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_pro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
<<<<<<< HEAD
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT;
>>>>>>> 89011b1cdfd6c8e074c5c680536886f08e20d12c
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_emp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_fac` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_fac`) REFERENCES `factura` (`id_fac`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_art`) REFERENCES `articulos` (`id_art`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_tip`) REFERENCES `consecutivos` (`id_tip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cli`) REFERENCES `clientes` (`id_cli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`id_pro`) REFERENCES `proveedores` (`id_pro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`id_emp`) REFERENCES `empleados` (`id_emp`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
