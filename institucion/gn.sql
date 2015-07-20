-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2015 a las 03:36:46
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id_cliente` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(8) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE IF NOT EXISTS `detalle_factura` (
`id_detalle_fac` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
`id_imagen` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_productos` int(11) NOT NULL,
  `id_proveedores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) unsigned NOT NULL,
  `precio` decimal(5,2) unsigned NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
`id_proveedores` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
`id_servicio` int(11) NOT NULL,
  `nombre_servicios` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(5,2) unsigned NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
`id_tipo` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo`, `tipo`, `descripcion`) VALUES
(1, 'Administrador', 'Hace de todo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_productos`
--

CREATE TABLE IF NOT EXISTS `tipo_productos` (
`id_tipo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `tipo`, `descripcion`) VALUES
(0, 'Administrador', 'Tiene todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `usuario`, `clave`, `id_tipo`) VALUES
(2, 'd', 'd', 'd', 'd', 1),
(3, 'diego', 'diegoalrama@gmail.com', 'diego', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
`id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `cantidad` int(11) unsigned NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `Total` decimal(5,2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id_cliente`), ADD UNIQUE KEY `correo` (`correo`), ADD UNIQUE KEY `telefono` (`telefono`), ADD UNIQUE KEY `direccion` (`direccion`), ADD UNIQUE KEY `direccion_2` (`direccion`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
 ADD PRIMARY KEY (`id_detalle_fac`), ADD KEY `id_venta` (`id_venta`,`id_producto`), ADD KEY `id_producto` (`id_producto`), ADD KEY `cantidad` (`cantidad`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
 ADD PRIMARY KEY (`id_imagen`), ADD KEY `id_productos` (`id_productos`,`id_proveedores`), ADD KEY `id_proveedores` (`id_proveedores`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id_producto`), ADD UNIQUE KEY `nombre_productos` (`nombre_producto`), ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
 ADD PRIMARY KEY (`id_proveedores`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
 ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
 ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
 ADD PRIMARY KEY (`id_tipo`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `nombre` (`nombre`), ADD UNIQUE KEY `correo` (`correo`), ADD UNIQUE KEY `usuario` (`usuario`), ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
 ADD PRIMARY KEY (`id_venta`), ADD KEY `id_producto` (`id_producto`,`id_tipo_producto`,`id_proveedor`,`id_cliente`,`id_usuario`), ADD KEY `id_producto_2` (`id_producto`), ADD KEY `id_tipo_producto` (`id_tipo_producto`), ADD KEY `id_proveedor` (`id_proveedor`), ADD KEY `id_cliente` (`id_cliente`), ADD KEY `id_usuario` (`id_usuario`), ADD KEY `id_cliente_2` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
MODIFY `id_detalle_fac` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
MODIFY `id_proveedores` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_productos`
--
ALTER TABLE `tipo_productos`
MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
ADD CONSTRAINT `fk_productos_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
ADD CONSTRAINT `fk_venta_9` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
ADD CONSTRAINT `fk_productos` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id_producto`),
ADD CONSTRAINT `fk_proveedores` FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id_proveedores`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `fk_productos_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_productos` (`id_tipo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_usuarios` (`id_tipo`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
ADD CONSTRAINT `fk_ventas_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
ADD CONSTRAINT `fk_ventas_2` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tipo_productos` (`id_tipo`),
ADD CONSTRAINT `fk_ventas_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedores`),
ADD CONSTRAINT `fk_ventas_4` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
ADD CONSTRAINT `fk_ventas_5` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
