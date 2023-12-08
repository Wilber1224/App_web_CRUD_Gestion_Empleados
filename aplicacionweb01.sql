-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2023 a las 03:11:30
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aplicacionweb01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleados`
--

CREATE TABLE `tb_empleados` (
  `id` int(11) NOT NULL,
  `primernombre` varchar(255) DEFAULT NULL,
  `segundornombre` varchar(255) DEFAULT NULL,
  `primerapellido` varchar(255) DEFAULT NULL,
  `segundoapellido` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `idpuesto` int(11) DEFAULT NULL,
  `fechadeingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_empleados`
--

INSERT INTO `tb_empleados` (`id`, `primernombre`, `segundornombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`) VALUES
(43, 'Jhoacin', '', 'Escolastico', 'Sanchez', '1689062699_perfil_jhoa.jpeg', '1689062699_cv_jhoacin3.pdf', 29, '2023-07-11'),
(44, 'Armando', '', 'Escolastico', 'Jimenez', '1689062737_fondo1.jpg', '1689062737_cv_armando.pdf', 37, '2023-07-25'),
(45, 'Lala', 'Mamashita', 'Escolastico', 'Sanchez', '1689062776_fotoLala.jpeg', '1689062776_cv_lala.pdf', 34, '2023-07-12'),
(46, 'Norma', '', 'Sanchez', 'Genares', '1689062822_foto_emanuel.png', '1689062822_cv_norma.pdf', 35, '2023-07-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_puestos`
--

CREATE TABLE `tb_puestos` (
  `id` int(11) NOT NULL,
  `nombredelpuesto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_puestos`
--

INSERT INTO `tb_puestos` (`id`, `nombredelpuesto`) VALUES
(28, 'teste'),
(29, 'front-end'),
(30, 'backend '),
(31, 'Desarrollador Full Stack'),
(32, 'Programador de ciberseguridad'),
(33, 'Programador de Inteligencia Artificial (IA)'),
(34, 'Programador Python'),
(35, 'Scrum Master.'),
(36, 'Programador de juegos de ordenador'),
(37, 'Técnico de introducción de datos'),
(38, 'Administrador de sitios web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `usuario`, `contraseña`, `correo`) VALUES
(5, 'Armando2', 'armando123', 'armandoescolastico@gmail.com'),
(6, 'Domelipa', 'norma123', 'Domelipa@gmail.com'),
(7, 'jhoacin', 'jhoss123', 'jhoacinescolastico@gmail.com'),
(8, 'Lucia', '111', 'juan@gmail.com'),
(9, 'Lala', 'lala123', 'lala@gmail.com'),
(10, 'Laco', 'laco123', 'laco@gmail.com'),
(11, 'Irma', 'ACTUALIZAR', 'irma@gmail.com'),
(13, 'jhoacin', '123', 'jhoacin18esco@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpuesto` (`idpuesto`);

--
-- Indices de la tabla `tb_puestos`
--
ALTER TABLE `tb_puestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `tb_puestos`
--
ALTER TABLE `tb_puestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  ADD CONSTRAINT `tb_empleados_ibfk_1` FOREIGN KEY (`idpuesto`) REFERENCES `tb_puestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
