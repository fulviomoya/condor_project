-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2025 a las 20:47:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
-- Estructura de tabla para la tabla `datos_estudiantes`
--

CREATE TABLE `datos_estudiantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
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
  `direccion_padres` varchar(150) NOT NULL DEFAULT 'No registrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos_estudiantes`
--

INSERT INTO `datos_estudiantes` (`id`, `nombre`, `apellido`, `segundo_apellido`, `id_acta_nacimiento`, `escuela_anterior`, `direccion_actual`, `sector`, `localidad`, `fecha_nacimiento`, `lugar_nacimiento`, `nacionalidad`, `correo_electronico`, `grado_solicitado`, `record_calificaciones`, `acta_nacimiento_pdf`, `estado`, `ocupacion_padres`, `telefono_padres`, `correo_padres`, `nombre_padres`, `tipo_familia`, `direccion_padres`) VALUES
(108, 'ola234', 'dwdwdwd', 'kdjsjdksdssdds34567', '797878334232222299', ';lkdopsmdpsods', 'asasasasasaasas', 'asasasasasa', 'Santo Domingo Este', '2025-02-11', 'knknvnkvkcvnkcvcx', 'sadsakdsajdsad', 'luisangssel@gmail.com', 'Primero', 'uploads/ola234_dwdwdwd/record.pdf', 'uploads/ola234_dwdwdwd/acta.pdf', 'Pendiente', 'publica', '8889991111', '', 'wersdfgsdfsdf', 'biparental', 'hjjjjjjjjjjjj'),
(109, 'Luisangel', 'Ramirez', 'Casilla', '1234567811', 'San martin de porres', 'Los corales', 'Los corales', 'Santo Domingo Este', '2025-02-19', 'Zona franca', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Aprobado', 'publica', '8889991111', '', 'Luis Ramirez', 'monoparental', 'Los corales'),
(110, 'Luisangel gamer', 'sadsdasds', 'sSADASDASDA', '1232435645234567', 'ASDASD', 'ASDASDAS', 'asasasasasakhj', 'Distrito Nacional', '2025-02-13', 'Zona franca', 'sadsakdsajdsad', 'luisangsasdasdsel@gmail.com', 'Segundo', 'uploads/Luisangel_gamer_sadsdasds/record.pdf', 'uploads/Luisangel_gamer_sadsdasds/acta.pdf', 'Aprobado', 'publica', '8889991734', '', 'wersdfgsdfsdf', 'monoparental', 'asasasasasaasas'),
(111, 'Luisangel hiohi', 'dsadsdsad', 'kdjsjdksdssdds34567', '79787877', 'ffdsfdfdffdkkk', 'jkhiuhuuhihuihihu', 'asasasasasakhj', 'Distrito Nacional', '2025-02-11', 'knknvnkvkcvnkcvcx', 'Republica dominicana', 'luisangssel@gmail.com', 'Primero', 'uploads/Luisangel_hiohi_dsadsdsad/record.pdf', 'uploads/Luisangel_hiohi_dsadsdsad/acta.pdf', 'Pendiente', 'publica', '1234567890', '', 'Luis Ramirez', 'biparental', 'asdfghjkl;lkjhgf'),
(112, 'Luisangel', 'Ramirez', 'Casilla', '1212121212', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'uploads/Luisangel_Ramirez/record.pdf', 'uploads/Luisangel_Ramirez/acta.pdf', 'Pendiente', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado'),
(113, 'Luisangel f', 'Ramirez', 'Casilla', '12121212122', 'San martiin', 'Los corales', 'Los mina', 'Santo Domingo Este', '2025-02-04', 'Hospital', 'Dominicano', 'luisangssel@gmail.com', 'Segundo', 'uploads/Luisangel_f_Ramirez/record.pdf', 'uploads/Luisangel_f_Ramirez/acta.pdf', 'Denegado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado'),
(114, 'Luisangel sss', 'Ramirezzzz', 'Casillasss', '79787821212', 'ffdsfdfdffdhjk', 'fdjiofjdoifjisdofds', 'asasasasasakhj', 'Distrito Nacional', '2025-01-29', 'Zona franca', 'Republica dominicana', 'luisangel@gmail.com', 'Segundo', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/record.pdf', 'uploads/Luisangel_sss_Ramirezzzz_79787821212/acta.pdf', 'Denegado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado', 'No registrado');

--
-- Disparadores `datos_estudiantes`
--
DELIMITER $$
CREATE TRIGGER `before_insert_estudiante` BEFORE INSERT ON `datos_estudiantes` FOR EACH ROW BEGIN
    DECLARE total_estudiantes INT;
    SELECT COUNT(*) INTO total_estudiantes FROM datos_estudiantes;
    
    IF total_estudiantes >= 300 THEN
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
-- Indices de la tabla `datos_estudiantes`
--
ALTER TABLE `datos_estudiantes`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT de la tabla `datos_estudiantes`
--
ALTER TABLE `datos_estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `datos_padres`
--
ALTER TABLE `datos_padres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
