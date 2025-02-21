
CREATE DATABASE registroestudiantes;
USE registroestdiantes;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
 
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

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

ALTER TABLE `datos_estudiantes`
  ADD PRIMARY KEY (`id_plaza`),
  ADD KEY `id_acta_nacimiento` (`id_acta_nacimiento`);

ALTER TABLE `datos_padres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);
 
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `datos_padres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT; 
