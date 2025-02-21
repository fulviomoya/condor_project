-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2025 a las 05:04:15
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
-- Base de datos: `registroestudiantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `contraseña_hash` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `nombre_usuario`, `contraseña_hash`) VALUES
(6, 'admin1', '$2y$10$XYKBNpdBmwYCNgYpDfDYlexvLuoz1Jpg7aRWFE3n6.gIpW3Gem1jK'),
(7, 'admin2', '$2y$10$5GZraan6jDccYTln.gWvK.P.cHiV3HaIs81E.s1IJWxwoFGIM1qYO'),
(8, 'admin3', '$2y$10$Yj0C/UMAbEo1hesjN/QF8uAOEUCm4PBFaX80CL045E0wquSRaFTiW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_estudiantes`
--

CREATE TABLE `datos_estudiantes` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `id_acta_nacimiento` varchar(20) NOT NULL,
  `escuela_anterior` varchar(100) DEFAULT NULL,
  `direccion_actual` varchar(150) NOT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` varchar(100) NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `grado_solicitado` varchar(50) NOT NULL,
  `record_calificaciones` varchar(255) DEFAULT NULL,
  `acta_nacimiento_pdf` varchar(255) DEFAULT NULL,
  `estado` enum('Pendiente','Aprobado','Denegado') NOT NULL DEFAULT 'Pendiente',
  `ocupacion_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `telefono_padres` varchar(20) NOT NULL DEFAULT 'No registrado',
  `correo_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `nombre_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `tipo_familia` varchar(50) NOT NULL DEFAULT 'No registrado',
  `direccion_padres` varchar(150) NOT NULL DEFAULT 'No registrado',
  `motivo_denegacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_estudiantes`
--

INSERT INTO `datos_estudiantes` (`nombre`, `apellido`, `segundo_apellido`, `edad`, `id_acta_nacimiento`, `escuela_anterior`, `direccion_actual`, `sector`, `localidad`, `fecha_nacimiento`, `lugar_nacimiento`, `nacionalidad`, `correo_electronico`, `grado_solicitado`, `record_calificaciones`, `acta_nacimiento_pdf`, `estado`, `ocupacion_padres`, `telefono_padres`, `correo_padres`, `nombre_padres`, `tipo_familia`, `direccion_padres`, `motivo_denegacion`) VALUES
('Luisangel', 'Ramirez', 'Casilla', NULL, '1212121212', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Pendiente', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', NULL),
('Luisangel f', 'Ramirez', 'Casilla', NULL, '12121212122', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'uploads/Luisangel_f_Ramirez/record.pdf', 'uploads/Luisangel_f_Ramirez/acta.pdf', 'Denegado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', NULL),
('Luisangel gamer', 'sadsdasds', 'sSADASDASDA', NULL, '1232435645234567', 'ASDASD', 'ASDASDAS', 'asasasasasakhj', 'Distrito Nacional', '2025-02-13', 'Zona franca', 'sadsakdsajdsad', 'luisangsasdasdsel@gmail.com', 'Segundo', 'uploads/Luisangel_gamer_sadsdasds/record.pdf', 'uploads/Luisangel_gamer_sadsdasds/acta.pdf', 'Aprobado', 'publica', '8889991734', '', 'wersdfgsdfsdf', 'monoparental', 'asasasasasaasas', NULL),
('Luisangel', 'Ramirez', 'Casilla', NULL, '1234567811', 'San martin de porres', 'Los corales', 'Los corales', 'Santo Domingo Este', '2025-02-19', 'Zona franca', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Aprobado', 'publica', '8889991111', '', 'Luis Ramirez', 'monoparental', 'Los corales', NULL),
('Luisangel sss', 'Ramirezzzz', 'Casillasss', NULL, '79787821212', 'ffdsfdfdffdhjk', 'fdjiofjdoifjisdofds', 'asasasasasakhj', 'Distrito Nacional', '2025-01-29', 'Zona franca', 'Republica dominicana', 'luisangel@gmail.com', 'Segundo', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/record.pdf', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/acta.pdf', 'Denegado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', NULL),
('ola234', 'dwdwdwd', 'kdjsjdksdssdds34567', NULL, '797878334232222299', ';lkdopsmdpsods', 'asasasasasaasas', 'asasasasasa', 'Santo Domingo Este', '2025-02-11', 'knknvnkvkcvnkcvcx', 'sadsakdsajdsad', 'luisangssel@gmail.com', 'Primero', 'uploads/ola234_dwdwdwd/record.pdf', 'uploads/ola234_dwdwdwd/acta.pdf', 'Pendiente', 'publica', '8889991111', '', 'wersdfgsdfsdf', 'biparental', 'hjjjjjjjjjjjj', NULL),
('Luisangel hiohi', 'dsadsdsad', 'kdjsjdksdssdds34567', NULL, '79787877', 'ffdsfdfdffdkkk', 'jkhiuhuuhihuihihu', 'asasasasasakhj', 'Distrito Nacional', '2025-02-11', 'knknvnkvkcvnkcvcx', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'uploads/Luisangel_hiohi_dsadsdsad/record.pdf', 'uploads/Luisangel_hiohi_dsadsdsad/acta.pdf', 'Pendiente', 'publica', '1234567890', '', 'Luis Ramirez', 'biparental', 'asdfghjkl;lkjhgf', NULL);

--
-- Disparadores `datos_estudiantes`
--
DELIMITER $$
CREATE TRIGGER `before_insert_estudiante` BEFORE INSERT ON `datos_estudiantes` FOR EACH ROW BEGIN
    DECLARE total_estudiantes INT;
    SELECT COUNT(*) INTO total_estudiantes FROM datos_estudiantes;
    
    IF total_estudiantes >= 500 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se pueden agregar más estudiantes, límite alcanzado.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_padres`
--

CREATE TABLE `datos_padres` (
  `id` int(11) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `nombre_padres` varchar(100) NOT NULL,
  `tipo_familia` varchar(50) NOT NULL,
  `direccion_actual` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_padres`
--

INSERT INTO `datos_padres` (`id`, `ocupacion`, `telefono`, `correo_electronico`, `nombre_padres`, `tipo_familia`, `direccion_actual`) VALUES
(8, 'privada', '8889991111', 'luisangel@gmail.com', 'wersdfgsdfsdf', '', 'asasasasasaasashjh'),
(9, 'publica', '6019521325', 'luisangsssel@gmail.com', 'wersdfgsdfsdf', '', 'fdjiofjdoifjisdofds');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `datos_estudiantes`
--
ALTER TABLE `datos_estudiantes`
  ADD PRIMARY KEY (`id_acta_nacimiento`),
  ADD KEY `idx_estado` (`estado`);

--
-- Indices de la tabla `datos_padres`
--
ALTER TABLE `datos_padres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `datos_padres`
--
ALTER TABLE `datos_padres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
