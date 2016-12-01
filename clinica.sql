-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2016 a las 19:11:51
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria`) VALUES
('admin'),
('clinico'),
('usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE IF NOT EXISTS `medico` (
  `matricula` int(50) NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `horario` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`matricula`, `correo`, `dia`, `horario`) VALUES
(236, 'pedro@hotmail.com', 'lu', 'mañana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obrasoc`
--

CREATE TABLE IF NOT EXISTS `obrasoc` (
  `obra_Soc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fec_Reg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fec_Mod` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `obrasoc`
--

INSERT INTO `obrasoc` (`obra_Soc`, `estado`, `fec_Reg`, `fec_Mod`) VALUES
('Pami', 'Vigente', '2016-08-09 11:14:41', NULL),
('Particular', 'Vigente', '2016-08-09 11:13:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resetpass`
--

CREATE TABLE IF NOT EXISTS `resetpass` (
  `id` int(50) NOT NULL,
  `idusuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `creado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE IF NOT EXISTS `turno` (
  `id` int(100) NOT NULL,
  `paciente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medico` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `horario` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id`, `paciente`, `medico`, `fecha`, `horario`) VALUES
(3, 'pedrito@hotmail.com', 'pedro@hotmail.com', '05-12-2016', 'mañana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `obra_Soc` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fec_Reg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `activation_key` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `validated` int(10) DEFAULT NULL,
  `fec_Ing` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correo`, `contrasena`, `apellido`, `nombre`, `telefono`, `obra_Soc`, `provincia`, `localidad`, `direccion`, `foto`, `fec_Reg`, `activation_key`, `validated`, `fec_Ing`, `categoria`) VALUES
('pedrin@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'a', 'a', 1, 'Pami', 'a', 'a', 'a', 'pedrinhotmailcom.jpg', '05-10-2016 (20:41:48)', 'v0e461aj6xcn75nm2pt851xna3kmueuc', 1, '01-12-2016 (13:17:34)', 'admin'),
('pedrito@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'pedro', 'alvarez', 212343, 'Pami', 'buenos aires', 'avellaneda', 'mitre 12345', 'pedritohotmailcom.jpg', '05-10-2016 (20:09:58)', 'u4a2kcabd9l0ir5rp5em59c7lgfm7lof', 1, '01-12-2016 (12:02:00)', 'usuario'),
('pedro@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Roberto', 'Ramirez', 12, 'Particular', 'a', 'a', 'a', 'porDefecto.jpg', '06-10-2016 (21:44:14)', 'smyrjjmulftm94ho7y54orqjdxp1j926', 1, '24-11-2016 (15:57:12)', 'clinico'),
('pedroq@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'a', 'a', 1, ' Particular ', 'a', 'a', 'a', 'pedroqhotmailcom.jpg', '05-10-2016 (18:50:29)', 'fw97uw9fnxqttndru4e1nxi1r6zk4hg0', NULL, NULL, ''),
('pedrow@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Alvarez', 'Pedro', 12, 'Particular', 'buenos aires', 'lomas de zamora', 'a', 'pedrowhotmailcom.jpg', '17-10-2016 (11:21:54)', '1dh72tdfdabkdxif29odxe29wzdfg2to', 1, NULL, NULL),
('perron@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'a', 'a', 1, 'Pami', 'a', 'a', 'a', 'porDefecto.jpg', '04-11-2016 (14:54:29)', 'wtw3xmob7lo128zgch7aftfr389lq6s0', NULL, NULL, 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria`);

--
-- Indices de la tabla `obrasoc`
--
ALTER TABLE `obrasoc`
  ADD PRIMARY KEY (`obra_Soc`);

--
-- Indices de la tabla `resetpass`
--
ALTER TABLE `resetpass`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resetpass`
--
ALTER TABLE `resetpass`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
