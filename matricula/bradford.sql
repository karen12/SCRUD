-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2015 a las 01:45:33
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bradford`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
`id_agenda` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `hora` time NOT NULL,
  `actividad` varchar(70) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
`id_docente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dui` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE IF NOT EXISTS `grados` (
`id_grado` int(11) NOT NULL,
  `grado` int(11) unsigned NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_mensualidad` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE IF NOT EXISTS `institucion` (
`id_ins` int(11) NOT NULL,
  `nombre_ins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel_ins` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_ins` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `correo_ins` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `objetivo_ins` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mision_ins` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vision_ins` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `principios_ins` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `director_ins` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_redes_s` int(11) NOT NULL,
  `valores` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_ins`, `nombre_ins`, `tel_ins`, `direccion_ins`, `correo_ins`, `objetivo_ins`, `mision_ins`, `vision_ins`, `principios_ins`, `director_ins`, `id_redes_s`, `valores`, `id_usuario`) VALUES
(2, 'Bradford', '21342654', 'rgeqetghqeheq', 'ghghhgghsg', 'sajkbsakjsabjksa', 'dfasgdsgef', 'bgtftegrgr', 'grqegreqgrqe', 'rgeqetghqeheq', 1, '0', 1),
(3, 'sam fsam,.f sa', '126712', 'nlknlknlknlknlknl', 'sldknSDkb', 'bkibkjbkjbk', 'lknlknlknmklnlnlknkln', 'bgkjbgkkjhjkbgjjmkbbk', 'kjbkjlnlkmlknlknlknlk', 'nlknlknlknlknlknl', 1, '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
`id_ma` int(11) NOT NULL,
  `Precio` decimal(5,2) unsigned NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id_ma`, `Precio`, `descripcion`) VALUES
(1, '60.00', 'sadsadsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensualidad`
--

CREATE TABLE IF NOT EXISTS `mensualidad` (
`id_men` int(11) NOT NULL,
  `nivel` int(10) unsigned NOT NULL,
  `precio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE IF NOT EXISTS `redes_sociales` (
`id_red` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id_red`, `nombre`, `logo`, `id_usuario`) VALUES
(1, 'facebook', '10440749_581967021926517_157836809232437290_n.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
`id_tipo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dscripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo`, `nombre`, `dscripcion`) VALUES
(1, 'ADministrador', 'asdsadsadsad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `id_tipo`, `usuario`, `clave`) VALUES
(1, 'diego', 'diegoalarama@gmail.com', 1, 'diego', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utiles`
--

CREATE TABLE IF NOT EXISTS `utiles` (
  `id_articulo` int(11) NOT NULL,
  `nombre_art` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_art` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `precio_art` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
 ADD PRIMARY KEY (`id_agenda`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
 ADD PRIMARY KEY (`id_docente`), ADD UNIQUE KEY `dui` (`dui`), ADD UNIQUE KEY `correo` (`correo`), ADD UNIQUE KEY `telefono` (`telefono`), ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
 ADD PRIMARY KEY (`id_grado`), ADD KEY `id_mensualidad` (`id_mensualidad`,`id_matricula`), ADD KEY `id_matricula` (`id_matricula`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
 ADD PRIMARY KEY (`id_ins`), ADD UNIQUE KEY `tel_ins` (`tel_ins`), ADD UNIQUE KEY `correo_ins` (`correo_ins`), ADD UNIQUE KEY `director_ins` (`director_ins`), ADD KEY `id_usuario` (`id_usuario`), ADD KEY `id_redes_s` (`id_redes_s`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
 ADD PRIMARY KEY (`id_ma`), ADD KEY `id_usuarios` (`descripcion`);

--
-- Indices de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
 ADD PRIMARY KEY (`id_men`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
 ADD PRIMARY KEY (`id_red`), ADD KEY `id_ins` (`id_usuario`), ADD KEY `id_usuarios` (`id_usuario`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
 ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `usuario` (`usuario`), ADD UNIQUE KEY `correo` (`correo`), ADD UNIQUE KEY `clave` (`clave`), ADD KEY `id_tipo` (`id_tipo`), ADD FULLTEXT KEY `usuario_2` (`usuario`);

--
-- Indices de la tabla `utiles`
--
ALTER TABLE `utiles`
 ADD PRIMARY KEY (`id_articulo`), ADD UNIQUE KEY `nombre_art` (`nombre_art`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
MODIFY `id_ins` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mensualidad`
--
ALTER TABLE `mensualidad`
MODIFY `id_men` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
MODIFY `id_red` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `institucion`
--
ALTER TABLE `institucion`
ADD CONSTRAINT `asasas` FOREIGN KEY (`id_redes_s`) REFERENCES `redes_sociales` (`id_red`),
ADD CONSTRAINT `sa` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `hkjjh` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_usuarios` (`id_tipo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
