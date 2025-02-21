-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2025 a las 16:58:55
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
  `id_plaza` varchar(20) NOT NULL,
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
  `nombre_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `ocupacion_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `telefono_padres` varchar(20) NOT NULL DEFAULT 'No registrado',
  `correo_padres` varchar(100) NOT NULL DEFAULT 'No registrado',
  `tipo_familia` varchar(50) NOT NULL DEFAULT 'No registrado',
  `direccion_padres` varchar(150) NOT NULL DEFAULT 'No registrado',
  `record_calificaciones` varchar(255) DEFAULT NULL,
  `acta_nacimiento_pdf` varchar(255) DEFAULT NULL,
  `estado` enum('Pendiente','Aprobado','Denegado') NOT NULL DEFAULT 'Pendiente',
  `motivo_denegacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_estudiantes`
--

INSERT INTO `datos_estudiantes` (`id_plaza`, `nombre`, `apellido`, `segundo_apellido`, `edad`, `id_acta_nacimiento`, `escuela_anterior`, `direccion_actual`, `sector`, `localidad`, `fecha_nacimiento`, `lugar_nacimiento`, `nacionalidad`, `correo_electronico`, `grado_solicitado`, `nombre_padres`, `ocupacion_padres`, `telefono_padres`, `correo_padres`, `tipo_familia`, `direccion_padres`, `record_calificaciones`, `acta_nacimiento_pdf`, `estado`, `motivo_denegacion`) VALUES
('PL2759093', 'Jhoanny', 'Reynoso', 'Arias', 15, '738473834', 'una escuela muy dura', 'Boca Chica', 'La caleta', 'Santo Domingo Este', '2009-01-28', 'un lugar bacanooo', 'otro', 'estudiante@gmail.com', 'Tercero', 'Padre Duro', 'privada', '8096784323', 'padreee@gmail.com', 'monoparental', 'direccion de casa', 'uploads/Jhoanny_Reynoso_738473834/record.pdf', 'uploads/Jhoanny_Reynoso_738473834/acta.pdf', 'Pendiente', NULL),
('PL2816499', 'Luisangel hiohi', 'dsadsdsad', 'kdjsjdksdssdds34567', NULL, '79787877', 'ffdsfdfdffdkkk', 'jkhiuhuuhihuihihu', 'asasasasasakhj', 'Distrito Nacional', '2025-02-11', 'knknvnkvkcvnkcvcx', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'Luis Ramirez', 'publica', '1234567890', '', 'biparental', 'asdfghjkl;lkjhgf', 'uploads/Luisangel_hiohi_dsadsdsad/record.pdf', 'uploads/Luisangel_hiohi_dsadsdsad/acta.pdf', 'Pendiente', NULL),
('PL2860540', 'Francisco', 'Vargas', 'Rosario', 17, '123O21I323', 'Politecnico de Wsakaka', 'mieldalandia', 'WASAKAKA', 'Santo Domingo Este', '2006-04-23', 'Santo Domingo', 'Haitiano', 'fdksjf@gmail.com', 'Tercero', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'uploads/Francisco_Vargas_123O21I323/record.pdf', 'uploads/Francisco_Vargas_123O21I323/acta.pdf', 'Pendiente', NULL),
('PL4811519', 'Luisangel', 'Ramirez', 'Casilla', NULL, '1234567811', 'San martin de porres', 'Los corales', 'Los corales', 'Santo Domingo Este', '2025-02-19', 'Zona franca', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'Luis Ramirez', 'publica', '8889991111', '', 'monoparental', 'Los corales', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Aprobado', NULL),
('PL5048725', 'ARRO CON POLLO', 'POLLITO', 'ROBERT', 15, '923849832', 'ASKJDKAJS', 'POPOPO', 'KAJSKDJAKSJ', 'Santo Domingo Este', '2008-05-15', 'KASKA', 'otro', 'gab@gmail.com', 'Tercero', 'MILMON', 'publica', '8096578564', 'padrecito@gmail.com', 'monoparental', 'un lugar pila de bacano', 'uploads/ARRO_CON_POLLO_POLLITO_923849832/record.pdf', 'uploads/ARRO_CON_POLLO_POLLITO_923849832/acta.pdf', 'Pendiente', NULL),
('PL6732352', 'Luisangel gamer', 'sadsdasds', 'sSADASDASDA', NULL, '1232435645234567', 'ASDASD', 'ASDASDAS', 'asasasasasakhj', 'Distrito Nacional', '2025-02-13', 'Zona franca', 'sadsakdsajdsad', 'luisangsasdasdsel@gmail.com', 'Segundo', 'wersdfgsdfsdf', 'publica', '8889991734', '', 'monoparental', 'asasasasasaasas', 'uploads/Luisangel_gamer_sadsdasds/record.pdf', 'uploads/Luisangel_gamer_sadsdasds/acta.pdf', 'Aprobado', NULL),
('PL6794127', 'Gabriel de Jesús', 'Reynoso', 'Reyes', 16, '93454389', 'Mi casa', 'Ciudad Gótica', 'Ciudad Nomo', 'Santo Domingo Este', '2008-05-19', 'Roma', 'Romano', 'gabrey1905@gmail.com', 'Tercero', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'uploads/Gabriel_de_Jes__s_Reynoso_93454389/record.pdf', 'uploads/Gabriel_de_Jes__s_Reynoso_93454389/acta.pdf', 'Pendiente', NULL),
('PL7191041', 'Luisangel sss', 'Ramirezzzz', 'Casillasss', NULL, '79787821212', 'ffdsfdfdffdhjk', 'fdjiofjdoifjisdofds', 'asasasasasakhj', 'Distrito Nacional', '2025-01-29', 'Zona franca', 'Republica dominicana', 'luisangel@gmail.com', 'Segundo', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/record.pdf', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/acta.pdf', 'Denegado', NULL),
('PL7868142', 'TRIKITI', 'TROKO', 'TRAKA', 14, '23223232', 'ksjakdas', 'wawasa', 'iqueweiuqiuew', 'Santo Domingo Este', '2019-03-12', 'kjaskdjaskjda', 'Romano', 'askdaskjdas@gmail.com', 'Segundo', 'TROTORKOK', 'No registrado', 'No registrado', 'AJSDHJASHDAS@gmail.com', 'biparental', 'LAKAKA', NULL, NULL, 'Pendiente', NULL),
('PL8677924', 'ola234', 'dwdwdwd', 'kdjsjdksdssdds34567', NULL, '797878334232222299', ';lkdopsmdpsods', 'asasasasasaasas', 'asasasasasa', 'Santo Domingo Este', '2025-02-11', 'knknvnkvkcvnkcvcx', 'sadsakdsajdsad', 'luisangssel@gmail.com', 'Primero', 'wersdfgsdfsdf', 'publica', '8889991111', '', 'biparental', 'hjjjjjjjjjjjj', 'uploads/ola234_dwdwdwd/record.pdf', 'uploads/ola234_dwdwdwd/acta.pdf', 'Pendiente', NULL),
('PL8824462', 'tirindolaaaa', 'polman', 'hakiki', 17, '9384932842', 'lololollll', 'una direccion dura', 'un sectorcito', 'Santo Domingo Este', '2018-05-14', 'lugarcito plipiti', 'dominicana', 'uncorreo@gmail.com', 'Segundo', 'Juan Soto', 'privada', '8094360987', 'correito@gmail.com', 'monoparental', 'una baina dura', 'uploads/tirindolaaaa_polman_9384932842/record.pdf', 'uploads/tirindolaaaa_polman_9384932842/acta.pdf', 'Pendiente', NULL),
('PL9283415', 'Luisangel f', 'Ramirez', 'Casilla', NULL, '12121212122', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'uploads/Luisangel_f_Ramirez/record.pdf', 'uploads/Luisangel_f_Ramirez/acta.pdf', 'Denegado', NULL),
('PL9894907', 'Luisangel', 'Ramirez', 'Casilla', NULL, '1212121212', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Pendiente', NULL);

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
  ADD PRIMARY KEY (`id_plaza`),
  ADD KEY `id_acta_nacimiento` (`id_acta_nacimiento`);

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
