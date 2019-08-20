-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-08-2019 a las 21:02:42
-- Versión del servidor: 5.7.27-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ajllita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `asistencia` int(1) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `observacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_usuario`, `fecha`, `asistencia`, `fecha_registro`, `observacion`) VALUES
(2, 45, '2019-08-13', 0, NULL, ''),
(3, 45, '2019-08-13', 0, '2019-08-14 13:24:36', ''),
(4, 45, '2019-08-14', 0, '2019-08-14 14:28:47', 'Motivo de fuerza mayor'),
(5, 45, '2019-08-23', 0, '2019-08-14 13:24:36', ''),
(6, 46, '2019-08-23', 0, '2019-08-14 13:24:36', ''),
(7, 45, '2019-08-24', 0, NULL, ''),
(8, 46, '2019-08-24', 0, NULL, ''),
(14, 44, '2019-08-19', 1, '2019-08-19 17:15:55', ''),
(15, 45, '2019-08-19', 0, NULL, ''),
(16, 46, '2019-08-19', 0, NULL, ''),
(17, 79, '2019-08-19', 0, NULL, ''),
(18, 80, '2019-08-19', 0, NULL, ''),
(19, 82, '2019-08-19', 0, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casas_campana`
--

CREATE TABLE `casas_campana` (
  `id_casa_campana` int(11) NOT NULL,
  `nombre_casa_campana` varchar(200) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `organizacion` varchar(200) NOT NULL,
  `responsable` varchar(200) NOT NULL,
  `contacto_responsable` int(10) NOT NULL,
  `circunscripcion` int(2) NOT NULL,
  `distrito` int(2) NOT NULL,
  `ubicacion_latitud` float NOT NULL,
  `ubicacion_longitud` float NOT NULL,
  `situacion` varchar(50) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `casas_campana`
--

INSERT INTO `casas_campana` (`id_casa_campana`, `nombre_casa_campana`, `direccion`, `organizacion`, `responsable`, `contacto_responsable`, `circunscripcion`, `distrito`, `ubicacion_latitud`, `ubicacion_longitud`, `situacion`, `activo`) VALUES
(1, 'Casa Central ', 'calle Beltran, 16 de Julio', 'Ministerio de Culturas y Turismo', 'Karin Hurtado', 67641025, 10, 6, 21, 21, 'En Funcionamiento', 1),
(2, 'Casa Norte', 'Ex tranca de Rio Seco', 'EPSAS', 'Min. Culturas', 67641025, 11, 6, 21, 21, 'En Funcionamiento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circunscripcion`
--

CREATE TABLE `circunscripcion` (
  `id_circunscripcion` int(11) NOT NULL,
  `circunscripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id_distrito` int(11) NOT NULL,
  `distrito` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id_distrito`, `distrito`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, '11'),
(12, '12'),
(13, '13'),
(14, '14'),
(15, '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(11) NOT NULL,
  `codigo_mesas_oep` varchar(10) NOT NULL,
  `codigo_ajllita` int(11) NOT NULL,
  `foto_presidenciales` text NOT NULL,
  `foto_uninominales` text NOT NULL,
  `numero_votantes` int(7) NOT NULL,
  `id_recinto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `codigo_mesas_oep`, `codigo_ajllita`, `foto_presidenciales`, `foto_uninominales`, `numero_votantes`, `id_recinto`) VALUES
(1, 'ABC1', 1, '../storage/media/foto_presidenciales/presidencial-id_mesa_1', '../storage/media/foto_uninominales/uninominal-id_mesa_1', 500, 1),
(2, 'ABC2', 2, '', '', 300, 1),
(3, 'ABC3', 3, '', '', 250, 1),
(4, 'ABC4', 4, '', '', 350, 1),
(5, 'BCD1', 5, '', '', 500, 2),
(6, 'ABC1', 6, '', '', 500, 2),
(7, 'ABC1', 7, '', '', 500, 2),
(8, 'ABC1', 8, '', '', 500, 2),
(9, 'ABC1', 9, '', '', 500, 2),
(10, 'ABC1', 10, '', '', 500, 3),
(11, 'ABC1', 11, '', '', 500, 3),
(12, 'ABC1', 12, '', '', 500, 3),
(13, 'ABC1', 13, '', '', 500, 3),
(14, 'ABC1', 14, '', '', 500, 3),
(15, 'ABC1', 15, '', '', 500, 3),
(16, 'ABC1', 16, '', '', 500, 3),
(17, 'ABC1', 17, '', '', 500, 3),
(18, 'ABC1', 18, '', '', 500, 3),
(19, 'ABC1', 19, '', '', 500, 3),
(20, 'ABC1', 20, '', '', 500, 3),
(21, 'ABC1', 21, '', '', 500, 3),
(22, 'ABC1', 22, '', '', 500, 3),
(23, 'ABC1', 23, '', '', 500, 4),
(24, 'ABC1', 24, '', '', 500, 4),
(25, 'ABC1', 25, '', '', 500, 4),
(26, 'ABC1', 26, '', '', 500, 4),
(27, 'ABC1', 27, '', '', 500, 4),
(28, 'ABC1', 28, '', '', 500, 4),
(29, 'ABC1', 29, '', '', 500, 4),
(30, 'ABC1', 30, '', '', 500, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen`
--

CREATE TABLE `origen` (
  `id_origen` int(11) NOT NULL,
  `origen` varchar(50) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `origen`
--

INSERT INTO `origen` (`id_origen`, `origen`, `activo`) VALUES
(1, 'Organizaciones Sociales', 1),
(2, 'Organizaciones Gubernamentales', 1),
(3, 'Instrumento Político', 1),
(4, 'Autoridades', 1),
(5, 'Simpatizantes (Casas de Campaña)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id_partido` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id_partido`, `nombre`, `sigla`, `logo`) VALUES
(1, 'Partido Conservador', 'PC', ''),
(2, 'Movimiento al Socialismo', 'MAS', ''),
(3, 'Movimiento Nacionalista Revolucionario', 'MNR', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Crear Solicitud', 'crear_solicitud', 'Crea solicitud de Vacaciones', '2019-02-07 00:50:09', '2019-02-07 00:50:09'),
(2, 'Aprobar Solicitud', 'aprobar_solicitud', 'Aprobar solicitud en Unidad', '2019-02-07 01:12:24', '2019-02-07 01:12:24'),
(3, 'Autorizar Solicitud', 'autorizar_solicitud', 'Autoriza la solicitud de Vacaciones', '2019-02-07 01:16:08', '2019-02-07 01:16:08'),
(4, 'Agregar Usuario', 'agregar_usuario', 'Agrega usuarios al sistema', '2019-02-12 11:41:21', '2019-02-12 11:41:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 3, 2, '2019-02-07 01:16:26', '2019-02-07 01:16:26'),
(4, 4, 2, '2019-02-12 11:41:40', '2019-02-12 11:41:40'),
(5, 3, 1, '2019-05-04 04:09:23', '2019-05-04 04:09:23'),
(6, 2, 1, '2019-05-04 04:10:11', '2019-05-04 04:10:11'),
(7, 2, 5, '2019-05-04 04:15:00', '2019-05-04 04:15:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(30) DEFAULT NULL,
  `materno` varchar(30) DEFAULT NULL,
  `cedula_identidad` int(10) NOT NULL,
  `complemento_cedula` varchar(5) DEFAULT NULL,
  `expedido` varchar(5) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_celular` int(10) NOT NULL,
  `telefono_referencia` int(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `grado_compromiso` int(2) NOT NULL,
  `fecha_registro` date NOT NULL,
  `activo` int(1) NOT NULL,
  `asignado` int(1) NOT NULL,
  `id_recinto` int(11) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `id_sub_origen` int(11) NOT NULL,
  `id_responsable_registro` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre`, `paterno`, `materno`, `cedula_identidad`, `complemento_cedula`, `expedido`, `fecha_nacimiento`, `telefono_celular`, `telefono_referencia`, `email`, `direccion`, `grado_compromiso`, `fecha_registro`, `activo`, `asignado`, `id_recinto`, `id_origen`, `id_sub_origen`, `id_responsable_registro`, `id_rol`) VALUES
(1, 'ALICIA', 'ARAUZ', 'ARANJUEZ', 122465, '', '', '2019-08-07', 213124, 0, 'alicia@gmail.com', 'Av. siempre viva', 1, '2019-08-13', 0, 0, 2, 2, 3, 40, 4),
(2, 'ALICIA', 'ARAUZ', 'ARANJUEZ', 132465, '', '', '2019-08-07', 213124, 0, 'alicia@gmail.com', 'Av. siempre viva', 1, '2019-08-13', 1, 0, 2, 1, 0, 40, 17),
(4, 'ALICIA', 'ARAUZ', '', 132467, '', 'PT', '2019-08-15', 2212344, 0, '', 'Av. siempre viva', 1, '2019-08-13', 0, 0, 1, 2, 0, 40, 4),
(5, 'ALICIA', 'ARAUZ', '', 132468, '', 'PT', '2019-08-15', 2212344, 0, '', 'Av. siempre viva', 1, '2019-08-13', 1, 0, 1, 2, 0, 40, 16),
(6, 'BRYAN', 'BETACUR', '', 1324659, '', 'LP', '2019-08-22', 2212344, 2452345, '', 'Av. siempre viva', 1, '2019-08-14', 1, 0, 1, 3, 9, 44, 16),
(7, 'BRYAN', 'BETACUR', '', 13246593, '', 'LP', '2019-08-22', 2212344, 2452345, '', 'Av. siempre viva', 1, '2019-08-13', 1, 0, 1, 2, 4, 40, 4),
(8, 'CARLA', '', 'CONDORI', 132465444, '', 'SC', '2019-08-07', 314234, 12431324, '', 'Av. siempre viva', 1, '2019-08-14', 1, 0, 1, 3, 5, 44, 16),
(9, 'DANIELA', 'DURAN', '', 132465445, '', 'CH', '2019-08-07', 34134, 124313, '', 'Av. siempre viva', 5, '2019-08-14', 1, 0, 4, 4, 11, 44, 16),
(10, 'ESTEFANNY', 'FREUD', 'FERNANDEZ', 123456, '123', 'OR', '2019-08-01', 2212344, 12431324, 'estefanny@gmail.com', 'Av. siempre viva', 3, '2019-08-13', 1, 0, 1, 1, 0, 40, 16),
(11, 'GUSTAVO', 'GUTIERREZ', 'GERONIMO', 123456, '', 'LP', '2019-08-07', 12313, 0, '', 'Av. siempre viva', 1, '2019-08-13', 1, 0, 1, 1, 0, 40, 16),
(12, 'HELEN', 'HORTEGA', '', 132465, '123', 'LP', '2019-08-14', 12313, 2212344, 'helen@gmail.com', 'Av. siempre viva', 5, '2019-08-13', 1, 0, 1, 3, 5, 40, 16),
(13, 'Marco', 'Mamani', 'Quisbert', 4764635, NULL, 'LP', '2019-08-04', 60104841, 2200910, 'marco.mamani@minculturas.gob.bo', '', 5, '2019-08-14', 1, 0, 1, 1, 1, 1, 10),
(14, 'JHELEN', 'JIMENEZ', '', 123456, '132', 'PT', '2019-08-14', 12313, 2212344, 'helen@gmail.com', 'Av. siempre viva', 5, '2019-08-14', 1, 0, 2, 2, 3, 44, 23),
(15, 'LORENA', 'LAURA', 'LOPEZ', 12345, '123', 'LP', '2019-08-07', 2212344, 2212344, '', 'Av. siempre viva', 4, '2019-08-15', 1, 1, 1, 1, 1, 44, 20),
(16, 'MAZIEL', 'MOLLO', 'MEJIA', 222222, '221', 'LP', '2019-08-21', 12313, 2212344, '', 'Av. siempre viva', 1, '2019-08-16', 1, 0, 2, 2, 3, 44, 20),
(17, 'NINOSKA', 'NINA', '', 222222, '', 'OR', '2019-08-05', 1341234, 1431234, '', 'Av. siempre viva', 5, '2019-08-16', 1, 0, 3, 1, 1, 44, 16),
(18, 'OSCAR', '', 'ORTIZ', 222222, '222', 'OR', '2019-08-06', 22165464, 2221654, '', 'Av. siempre viva', 5, '2019-08-16', 1, 0, 40, 3, 0, 44, 17),
(19, 'PAOLA', 'PEREZ', 'PAZ', 654321, '', 'LP', '2019-08-07', 2212344, 12431324, '', 'Av. siempre viva', 5, '2019-08-19', 1, 0, 1, 4, 10, 44, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulantes`
--

CREATE TABLE `postulantes` (
  `id_postulante` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(25) NOT NULL,
  `materno` varchar(25) NOT NULL,
  `id_partido` int(11) NOT NULL,
  `id_circunscripcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recintos`
--

CREATE TABLE `recintos` (
  `id_recinto` int(11) NOT NULL,
  `codigo_recinto_oep` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `circunscripcion` int(2) NOT NULL,
  `distrito` int(2) NOT NULL,
  `distrito_referencial` varchar(200) NOT NULL,
  `zona` varchar(200) NOT NULL,
  `zona_referencial` varchar(200) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `lugar_referencial` varchar(200) NOT NULL,
  `geolocalizacion` varchar(200) NOT NULL,
  `ubicacion_latitud` float NOT NULL,
  `ubicacion_longitud` float NOT NULL,
  `numero_mesas` int(3) NOT NULL,
  `numero_votantes` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recintos`
--

INSERT INTO `recintos` (`id_recinto`, `codigo_recinto_oep`, `nombre`, `circunscripcion`, `distrito`, `distrito_referencial`, `zona`, `zona_referencial`, `direccion`, `lugar_referencial`, `geolocalizacion`, `ubicacion_latitud`, `ubicacion_longitud`, `numero_mesas`, `numero_votantes`) VALUES
(1, '1', 'Col. Tunari', 10, 4, '', 'VILLA TUNARI', '', 'Pasaje 13 entre Av. Sucre y Calle Mariano Baptista', '', '', 16.4966, 68.2101, 67, 15235),
(2, '2', 'Unidad Educativa Union Europea', 11, 2, '', 'SANTIAGO II', '', 'Calle 6 Santiago II entre Calles 7 y 5', '', '', 16.4966, 68.2101, 63, 14345),
(3, '3', 'Unidad Educativa San Roque', 13, 7, '', 'SAN ROQUE', '', 'Av. Pamamericana S/N entre Calle 24 de Enero y Av. San Roque', '', '', 16.4966, 68.2101, 56, 12939),
(4, '4', 'Colegio Antonio Paredes Candia', 10, 5, '', 'VILLA INGENIO', '', 'Av. Gualberto Villarroel S/N', '', '', 16.4966, 68.2101, 53, 12187),
(5, '5', 'Colegio San Jose', 10, 6, '', 'ALTO LIMA', '', 'Calle Manco Kapac N° 100 y Bolivar', '', '', 16.4966, 68.2101, 49, 11103),
(6, '6', 'Colegio Puerto Del Rosario (Nuevos Horizontes)', 11, 2, '', 'NUEVOS HORIZONTES', '', 'Av. Illimani S/N Frente a La Plaza Bolivar entre Calle La Cumbre y Esmeralda', '', '', 16.4966, 68.2101, 49, 11178),
(7, '7', 'Colegio Martin Cardenas', 11, 3, '', 'VILLA ADELA', '', 'Calle Oscar Alfaro S/N entre Calle Bustamente y Hernando Siles', '', '', 16.4966, 68.2101, 48, 10787),
(8, '8', 'Col. España', 12, 8, '', 'SENKATA 79', '', 'Calle Ruíz S/N', '', '', 16.4966, 68.2101, 45, 10264),
(9, '9', 'Colegio Luis Espinal Camps', 13, 3, '', 'COSMOS 79', '', 'Av. Civica S/N, entre Calle Pailala y Av. Callapa.', '', '', 16.4966, 68.2101, 45, 10301),
(10, '10', 'Colegio Adrian Castillo Nava', 10, 6, '', 'ALTO LIMA', '', 'Calle Bolivar S/N entre Calles 6 y 7', '', '', 16.4966, 68.2101, 44, 9821),
(11, '11', 'Col. Rotary Chuquiago Marca', 11, 1, '', 'SANTA ROSA', '', 'Calle 4 N° 1000 entre Av. Cívica y Calle C', '', '', 16.4966, 68.2101, 42, 9399),
(12, '12', 'Unidad Educativa Bautista Saavedra', 13, 14, '', 'URB. BAUTISTA SAAVEDRA', '', 'Calle Mariano Ramallo S/N, entre Calles José María Serrano y Jose Maria Linares.', '', '', 16.4966, 68.2101, 41, 9517),
(13, '13', 'Colegio Illimani', 12, 3, '', 'ROMERO PAMPA', '', 'Calle Boldo N° 2075 Casi Esq. Av. Retama', '', '', 16.4966, 68.2101, 40, 9073),
(14, '14', 'Col. Puerto Mejillones', 11, 1, '', 'CIUDAD SATELITE', '', 'Av. del Policia S/N entre Av. Eucebio Morales y Av. Arturo Ballivian Frente al Sindiocato Pedro Domingo Murillo', '', '', 16.4966, 68.2101, 39, 8691),
(15, '15', 'Colegio Huayna Potosi', 10, 5, '', 'HUAYNA POTOSI', '', 'Calle Córdova entre Calle Mariscal Antonio José de Sucre y 3 de Mayo', '', '', 16.4966, 68.2101, 39, 8919),
(16, '16', 'Colegio Don Bosco', 12, 12, '', 'SAN MARTIN(CHIJINI ALTO)', '', 'Calle Ricardo Bustamante N°100 entre Calle Octavio Rivero y Raúl Salmon', '', '', 16.4966, 68.2101, 37, 8453),
(17, '17', 'Escuela 16 de Febrero', 13, 4, '', 'URB. 16 DE FEBRERO', '', 'Calle 21 de Septiembre S/N, entre Calles 2 de Mayo y Luis Espinal.', '', '', 16.4966, 68.2101, 37, 8444),
(18, '18', 'Col. 1ro de Mayo', 11, 3, '', 'URB 1RO DE MAYO', '', 'Av. Mariscal  Santa Cruz S/N entre Calles 5 y 3 de Mayo', '', '', 16.4966, 68.2101, 37, 8496),
(19, '19', 'Col. San Vicente De Paul', 13, 4, '', 'VILLA PEDRO DOMINGO MURILLO', '', 'Calle Bartolome Andrade S/N entre Calles José María Landaberi y Juan Esquivel', '', '', 16.4966, 68.2101, 36, 8309),
(20, '20', 'Esc. Libertad en las Americas', 11, 1, '', 'VILLA EXALTACION', '', 'Av. 6 de Junio N° 26 entre Av. La Paz y Calle 20', '', '', 16.4966, 68.2101, 35, 8029),
(21, '21', 'Esc. Juvenal Mariaca', 10, 6, '', 'VILLA 16 DE JULIO', '', 'Calle Arazabe N° 2815 entre Calle Hnos. Santa Cruz y Hnos. Esperanza', '', '', 16.4966, 68.2101, 35, 7820),
(22, '22', 'Colegio Andres de Sta. Cruz', 10, 5, '', 'VILLA TAHUANTINSUYO', '', 'Av. Kollasuyo S/N', '', '', 16.4966, 68.2101, 34, 7613),
(23, '23', 'Col. 25 de Julio', 12, 8, '', 'SENKATA 79', '', 'Calle Mariscal Braun S/N', '', '', 16.4966, 68.2101, 34, 7693),
(24, '24', 'Colegio 23 de Marzo', 12, 8, '', '23 DE MARZO', '', 'Av. José Luis Atahuichi Calle Heroes del Pacífico y Río Loa S/N', '', '', 16.4966, 68.2101, 34, 7813),
(25, '25', 'Col. Calama', 11, 3, '', 'PACAJES CALUYO', '', 'Av. Caluyo Pacajes S/N entre Calles 5 y 6', '', '', 16.4966, 68.2101, 34, 7796),
(26, '26', 'Col. Santa Maria De Los Angeles', 10, 6, '', 'VILLA 16 DE JULIO', '', 'Calle Tte. J. Arazabe  N°3190 entre Calle Founier y Nistaus', '', '', 16.4966, 68.2101, 33, 7434),
(27, '27', 'Unidad Educativa Mariscal Antonio Jose E', 10, 5, '', 'MARISCAL  SUCRE', '', 'Calle Demetrio Canelas S/N entre Av. Claudio Cortez y Calle Mirtha Aguirre', '', '', 16.4966, 68.2101, 31, 6975),
(28, '28', 'Escuela Juan Carlos Flores Bedregal (San José de Yunguyo)', 13, 4, '', 'SAN JOSE DE YUNGUYO', '', 'Av. Misael Saracho S/N, entre Calle Quindío.', '', '', 16.4966, 68.2101, 31, 7003),
(29, '29', 'Unidad Educativa Republica de Francia', 12, 2, '', 'VILLA CUPILUPACA', '', 'Calle Río Bermejo N° 2034 entre Rio Madidi y Rio Orton', '', '', 16.4966, 68.2101, 31, 7094),
(30, '30', 'Escuela Guaqui', 10, 6, '', 'ALTO LIMA', '', 'Calle Tarija  S/N  entre San José  Av. Huayna Potosi', '', '', 16.4966, 68.2101, 31, 6922),
(31, '31', 'Unidad Educativa Noruega', 10, 5, '', 'HUAYNA POTOSI', '', 'Calle Llica  S/N entre Av. Imperial y Calle Azteca', '', '', 16.4966, 68.2101, 30, 6798),
(32, '32', 'Colegio 27 de Mayo', 12, 8, '', '27 DE MAYO', '', 'Av. 27 de Mayo S/N', '', '', 16.4966, 68.2101, 30, 6822),
(33, '33', 'Esc. Tarapaca', 12, 8, '', 'TARAPACA', '', 'Av. Virgen de La Cruz S/N Esq. Av. Villa Imperial', '', '', 16.4966, 68.2101, 30, 6906),
(34, '34', 'Unidad Educativa Progreso', 13, 7, '', 'EL PROGRESO', '', 'Calle Argentina S/N entre Calle 22.', '', '', 16.4966, 68.2101, 29, 6634),
(35, '35', 'Col. Vicente Tejada', 11, 1, '', 'V TEJADA RECTANGULAR', '', 'Calle 9 N°100 entre Calles J. Squier y Escalon Aguero', '', '', 16.4966, 68.2101, 28, 6316),
(36, '36', 'Unidad Educativa 3 de Mayo', 12, 3, '', 'URB 3 DE MAYO', '', 'Av. Mojocoya S/N Esq. Yotala', '', '', 16.4966, 68.2101, 27, 6233),
(37, '37', 'Unidad Educativa Franz Tamayo', 13, 14, '', 'URB FRANZ TAMAYO', '', 'Calle Fausto Reinaga S/N y Calle 5 de Octubre', '', '', 16.4966, 68.2101, 27, 6284),
(38, '38', 'Col. Gran Bretaña', 10, 6, '', 'LOS ANDES', '', 'Calle Pascoe S/N entre Calle Balboa y Manuel Carpio', '', '', 16.4966, 68.2101, 27, 6152),
(39, '39', 'Col. Topater', 12, 8, '', 'MERCEDES UNID. VEC. \"H\"', '', 'Calle Sin Nombre N° 1650 entre Av. Genaro Sanjinez y Calle Angel Salas', '', '', 16.4966, 68.2101, 25, 5734),
(40, '40', 'Colegio Nestor Paz', 12, 3, '', 'QUISWARAS', '', 'Calle S/N Esq. Colquencha S/N', '', '', 16.4966, 68.2101, 25, 5592),
(41, '41', 'Colegio Walter Alpire 1er Patio', 13, 4, '', 'RIO SECO', '', 'Calle 10 S/N, entre Av. Circunvalación y Calle 5 al Lado de La Plaza Max Fernández.', '', '', 16.4966, 68.2101, 25, 5524),
(42, '42', 'Unidad Educativa Juan Jose Torres', 12, 3, '', 'URB JAIME PAZ ZAMORA', '', 'Av. La Paz S/N entre Calle Parinacota y Calle San Pedro', '', '', 16.4966, 68.2101, 25, 5624),
(43, '43', 'Col. Rafael Mendoza', 10, 5, '', 'VILLA ESPERANZA', '', 'Av. Vasquez entre Av. J. Arzabe y Calle  A. Pascoe', '', '', 16.4966, 68.2101, 24, 5489),
(44, '44', 'Unidad Educativa Illimani', 10, 5, '', 'VILLA MERCURIO', '', 'Calle Gran Bretaña S/N entre Calles Paraguay y Filipinas', '', '', 16.4966, 68.2101, 24, 5525),
(45, '45', 'Escuela Brasil', 13, 4, '', 'BRASIL', '', 'Av. Cuzco S/N entre Pasaje Taibo Lado Plaza del Dinosaurio', '', '', 16.4966, 68.2101, 24, 5518),
(46, '46', 'Escuela Republica de China Popular', 13, 4, '', 'SAN FELIPE DE SEQUE', '', 'Av. Evo Morales S/N y Av. Atahuallpa Frente a La Iglesia 16 de Febrero', '', '', 16.4966, 68.2101, 24, 5556),
(47, '47', 'U.E. Oscar Alfaro', 13, 14, '', 'URB. BAUTISTA SAAVEDRA', '', 'Av. Litoral S/N entre Av. Esteban Arce y Rafael Monje', '', '', 16.4966, 68.2101, 24, 5451),
(48, '48', 'Unidad Educativa Ecologico Los Pinos', 12, 8, '', 'ECOLOGICO LOS PINOS', '', 'Calle Florida S/N entre Calle Aiquile y Tajibo', '', '', 16.4966, 68.2101, 24, 5469),
(49, '49', 'Unidad Educativa Tecnica Yunguyo', 13, 4, '', 'VILLA YUNGUYO', '', 'Av. 7 de Octubre S/N entre Calles Manuel  Araujo y Juan Bautista Arismendi.', '', '', 16.4966, 68.2101, 24, 5469),
(50, '50', 'Unidad Educativa 12 de Octubre', 11, 1, '', 'VILLA 12 DE OCTUBRE', '', 'Av. Rodolfo Palenque S/N y Calle 9', '', '', 16.4966, 68.2101, 23, 5104),
(51, '51', 'Colegio M Quiroga Santa Cruz', 10, 5, '', 'PUERTO MEJILLONES', '', 'Calle 4 entre Calle I y Calle H N. S/N', '', '', 16.4966, 68.2101, 23, 5144),
(52, '52', 'Unidad Educativa Ingavi', 10, 5, '', 'VILLA INGAVI', '', 'Calle Huatajata S/N entre Av. Arapata y Calle Mapiri', '', '', 16.4966, 68.2101, 23, 5279),
(53, '53', 'Unidad Educativa 6 de Junio', 13, 3, '', 'COSMOS 79', '', 'Pasaje 69 S/N entre Calle Pancaña y Pasaje Coltica.', '', '', 16.4966, 68.2101, 23, 5260),
(54, '54', 'Unidad Educativa San Luis', 12, 3, '', 'SAN LUIS PAMPA', '', 'Av. Litoral N° 7 Lado Iglesia entre Calles D y F', '', '', 16.4966, 68.2101, 23, 5286),
(55, '55', 'Esc. Elizardo Perez', 10, 6, '', 'VILLA BALLIVIAN', '', 'Calle Adolfo Borda  S/N entre Calles L de La Vega y René Vargas', '', '', 16.4966, 68.2101, 23, 5103),
(56, '56', 'Unidad Educativa Eva Peron', 11, 1, '', 'VILLA DOLORES', '', 'Av. Antofagasta S/N entre Calles 4 y 5, Lado Surtidor de Gasolina', '', '', 16.4966, 68.2101, 22, 4836),
(57, '57', 'Colegio 6 de Junio', 12, 2, '', '6 DE JUNIO', '', 'Calle Hector Iturralde Calle Hugo Dávila', '', '', 16.4966, 68.2101, 22, 4970),
(58, '58', 'Unidad Educativa Villa Cooperativa', 13, 14, '', 'URB. COOPERATIVA', '', 'Calle San Bartolome Nº1584  entre Calle Bajo Milluni y 1ro de Mayo.', '', '', 16.4966, 68.2101, 22, 5009),
(59, '59', 'Col. Libertador S. Bolivar', 11, 2, '', 'VILLA BOLIVAR  D', '', 'Calle 102 Enttre Calle 133 y Av. 110', '', '', 16.4966, 68.2101, 22, 4826),
(60, '60', 'Col. Heroes del Pacifico', 11, 1, '', 'CIUDAD SATELITE', '', 'Calle 5 Victoria de Villalba S/N entre Calle 25 B y Calle 26 a Media Cuadra de Cotel S.A.', '', '', 16.4966, 68.2101, 21, 4772),
(61, '61', 'Unidad Educativa Brasilia', 11, 1, '', 'VILLA DOLORES', '', 'Calle Subteniente Justo G. Badani S/N entre Calles 13 y 14', '', '', 16.4966, 68.2101, 21, 4733),
(62, '62', 'Unidad Educativa Santiago I', 11, 1, '', 'SANTIAGO \"I\"', '', 'Avenida 2 S/N entre Calle 6 y Av. 20 Detras del Cementerio Tarapaca', '', '', 16.4966, 68.2101, 21, 4634),
(63, '63', 'Escuela Rafael Pabon', 10, 5, '', 'VILLA GERMAN BUSCH', '', 'Calle Radio Condor S/N entre Calles Radio Mendez y Altiplano', '', '', 16.4966, 68.2101, 21, 4643),
(64, '64', 'Unidad Educativa 25 de Julio', 13, 4, '', '25 DE JULIO', '', 'Calle Chisi S/N, entre Calles Puma Punko E Illapa.', '', '', 16.4966, 68.2101, 21, 4706),
(65, '65', 'Escuela Juan Jose Torrez', 10, 6, '', 'ALTO LIMA', '', 'Av. Huayna Potosi S/N y Calle 37 Concepción', '', '', 16.4966, 68.2101, 21, 4640),
(66, '66', 'Unidad Educativa Republica de Cuba (Villa Ingenio U.-1)', 10, 5, '', 'VILLA INGENIO U. - 1', '', 'Av. Magdalena Rocha N°6214 entre Calles Pacaguara y Bororo', '', '', 16.4966, 68.2101, 20, 4624),
(67, '67', 'Col. Bolivia', 11, 1, '', 'ROSAS PAMPA', '', 'Av. 4 S/N entre Calles 11 y 12', '', '', 16.4966, 68.2101, 20, 4626),
(68, '68', 'Col. Mutual La Paz', 12, 2, '', 'URB EL KENKO', '', 'Calle 12 N°447 entre Avenidas A y B', '', '', 16.4966, 68.2101, 20, 4474),
(69, '69', 'Instituto Educativo Jesus de Nazareth', 13, 3, '', 'PARAISO  I', '', 'Av. Aucapata Nº1000 entre Av. Junin y Calle Tomas Frias', '', '', 16.4966, 68.2101, 20, 4472),
(70, '70', 'Unidad Educativa Donozo Torres', 11, 1, '', 'CIUDAD SATELITE', '', 'Calle 4 S/N y Arturo Ballivian Frente a La Plaza Bolivia', '', '', 16.4966, 68.2101, 19, 4175),
(71, '71', 'Esc. Ballivian', 10, 6, '', 'VILLA BALLIVIAN', '', 'Calle Nistaus S/N entre Av. René Vargas y Jorge Carrasco', '', '', 16.4966, 68.2101, 19, 4299),
(72, '72', 'Escuela Tupac Katari', 10, 5, '', 'TUPAC KATARI', '', 'Calle 4 S/N entre Calles 10 y 9', '', '', 16.4966, 68.2101, 18, 4008),
(73, '73', 'Unidad Educativa San Juan de Calama', 11, 3, '', 'VILLA CALAMA', '', 'Calle Ignacio Warnes entre  Calle Jose Miguel de Carrasco y Av. Ayopaya', '', '', 16.4966, 68.2101, 18, 3953),
(74, '74', 'Unidad Educativa Juan Capriles', 11, 1, '', 'VILLA DOLORES', '', 'Calle 1 S/N entre Calles Constantino D. Medina y J. Manuel Sempertegui', '', '', 16.4966, 68.2101, 17, 3716),
(75, '75', 'Colegio Fernando Nogales Castro', 13, 4, '', 'URB MERCEDARIO', '', 'Av. Santiago Vaca Guzmán S/N, entre Calles Jorge Salazar Nostajo y Alfredo Sanjinés.', '', '', 16.4967, 68.2101, 17, 3914),
(76, '76', 'Escuela Raul Salmon De La Barra', 13, 4, '', 'ESTRELLAS DE BELEN', '', 'Calle Alberto Wilde N°200, entre Junta Vecinal.', '', '', 16.4967, 68.2101, 17, 3736),
(77, '77', 'Unidad Educativa Mercedes Elio De Rivero', 12, 12, '', 'ALTO CHIJINI', '', 'Av. República  Bolivariana  de Venezuela N° 1125 y Av. Concretec', '', '', 16.4967, 68.2101, 17, 3879),
(78, '78', 'Esc. Bolivar Municipal', 11, 2, '', 'VILLA BOLIVAR  MUNICIPAL', '', 'Av. Bolivia entre Calle 5 y Calle 6 al Lado de La Sede Social Bolivar', '', '', 16.4967, 68.2101, 17, 3866),
(79, '79', 'Unidad Educativa  Alto De La Alianza', 11, 3, '', 'ALTO DE LA ALIANZA', '', 'Calle Cleto Perez S/N entre Calles Alto de La Alianza y Campero', '', '', 16.4967, 68.2101, 17, 3882),
(80, '80', 'Col. Tec. Humanistico Jose Ballivian', 10, 6, '', 'VILLA BALLIVIAN', '', 'Calle Alvarez Plata  N° 200 entre Calles R. Vargas y J. Carrasco', '', '', 16.4967, 68.2101, 17, 3813),
(81, '81', 'Col. 18 de Diciembre', 12, 8, '', '18 DE DICIEMBRE', '', 'Av. Versalles  S/N entre Ramos Gavilan', '', '', 16.4967, 68.2101, 16, 3684),
(82, '82', 'Esc. Los Andes', 10, 6, '', 'LOS ANDES', '', 'Calle Arturo Valle S/N entre Av. La Paz y Calle Hernan', '', '', 16.4967, 68.2101, 16, 3593),
(83, '83', 'Unidad Educativa Carlos Palenque', 11, 3, '', 'VILLA DOLORES \"F\"', '', 'Calle B Frente a Plaza 21 de Diciembre entre Calles 5 y 6', '', '', 16.4967, 68.2101, 16, 3558),
(84, '84', 'Col. Atipiris', 12, 8, '', 'URB. FABRIL - COBIJA', '', 'Calle Antonio Castro y Grigota S/N', '', '', 16.4967, 68.2101, 15, 3364),
(85, '85', 'Colegio Walter Alpire 2do Patio', 13, 4, '', 'RIO SECO', '', 'Calle 10 S/N, entre Av. Circunvalación y Calle 5 al Lado de La Plaza Max Fernández.', '', '', 16.4967, 68.2101, 15, 3299),
(86, '86', 'Colegio Luis Espinal Camps (Aeropuerto)', 11, 3, '', 'LUIS ESPINAL', '', 'Frente Plaza Luis Espinal N° 1740 entre Av. Punata y Calle Colon', '', '', 16.4967, 68.2101, 15, 3326),
(87, '87', 'Unidad Educativa Villa Alemania', 11, 3, '', 'VILLA ALEMANIA', '', 'Frente Plaza del Estudiante al Lado de La Iglesia San Antonio de Padua entre Calles Garcia y Toledo', '', '', 16.4967, 68.2101, 15, 3293),
(88, '88', 'U.E. Tokio', 10, 5, '', 'VILLA INGAVI', '', 'Av. Virgen de La Candelaria S/N entre Calle San Agustín y Caluyo', '', '', 16.4967, 68.2101, 14, 3005),
(89, '89', 'Escuela Tejada Triangular', 11, 1, '', 'V TEJADA TRIANGULAR', '', 'Calle 10 S/N entre Calles 4b y 4c', '', '', 16.4967, 68.2101, 14, 3106),
(90, '90', 'Unidad Educativa La Paz', 11, 3, '', 'VILLA ESTHER  (COSMOS 77)', '', 'Av. G S/N entre Calles 5 y 6', '', '', 16.4967, 68.2101, 14, 3077),
(91, '91', 'Col. Basill Miller', 10, 6, '', 'VILLA BALLIVIAN', '', 'Calle Rafael Pabón N° 100 entre Calle Founier y Nistaus', '', '', 16.4967, 68.2101, 14, 3201),
(92, '92', 'Col. Eduardo Avaroa', 11, 2, '', 'VILLA EDUARDO AVAROA', '', 'Calle 107 N° 107 entre Calles 140 y 139', '', '', 16.4967, 68.2101, 13, 2987),
(93, '93', 'Colegio Bolivia Mar', 12, 8, '', 'CUMARAVI', '', 'Calle Roque Dalton S/N', '', '', 16.4967, 68.2101, 13, 2939),
(94, '94', 'Unid. Educ. M. Quiroga Santa Cruz', 11, 3, '', 'VILLA BOLIVAR  \"C\"', '', 'Av. Las Americas S/N entre Calles 128 y 130', '', '', 16.4967, 68.2101, 13, 2978),
(95, '95', 'Esc. Luis Espinal Camps', 10, 6, '', 'ALTO SAID - VILLA VICTORIA', '', 'Calle D y C', '', '', 16.4967, 68.2101, 13, 2907),
(96, '96', 'Unidad Educativa Integracion', 11, 6, '', 'VILLA BORIS  BANZER', '', 'Calle Independencia S/N y Teniente Dorado', '', '', 16.4967, 68.2101, 13, 2835),
(97, '97', 'Centro Educativo Catolico Mercedes', 12, 8, '', 'MERCEDES UNID. VEC. \"C\"', '', 'Av. Achiri S/N entre Calles Tihuanacu y Prolongación La Paz', '', '', 16.4967, 68.2101, 12, 2749),
(98, '98', 'Colegio Particular San Miguel', 13, 4, '', 'RIO SECO', '', 'Av. Cuzco N° 2074, entre Calle 10 y Av. Sucre.', '', '', 16.4967, 68.2101, 11, 2385),
(99, '99', 'Unidad Educativa Gran Poder', 12, 2, '', 'URB EL KENKO', '', 'Calle 8 S/N entre Calles 6 y 7', '', '', 16.4967, 68.2101, 11, 2537),
(100, '100', 'Unidad Educativa Tupac Amaru', 12, 8, '', 'MERCEDES UNID. VEC. \"F\"', '', 'Calle Manuel Mamani S/N a Dos Cuadras de La Parada del  Micro 505', '', '', 16.4967, 68.2101, 11, 2370),
(101, '101', 'U. E. Villa Adela Yunguyo (Villa Adela Yunguyo)', 11, 3, '', 'VILLA ADELA YUNGUYO', '', 'Calle Malla entre Calle Tihuanaco y Av. Puerto Acosta N. S/N', '', '', 16.4967, 68.2101, 11, 2483),
(102, '102', 'Unidad Educativa Santa Rosa de Lima', 10, 5, '', 'SANTA ROSA DE LIMA', '', 'Calle Eugenio Díaz S/N Esquina Prolongación Cap de Villa', '', '', 16.4967, 68.2101, 10, 2134),
(103, '103', 'Unidad Educativa The Strongest', 10, 5, '', 'VILLA STRONGEST', '', 'Av. Ñancahuazu S/N entre Calle Ticocha y Chaviri', '', '', 16.4967, 68.2101, 10, 2319),
(104, '104', 'Col. Republica De Italia', 12, 8, '', 'SENKATA 79', '', 'Av. Inca Huasi S/N y Calle Pichu Pichu', '', '', 16.4967, 68.2101, 10, 2193),
(105, '105', 'Unidad Educativa Aniceto Arce', 12, 2, '', 'VILLA AROMA', '', 'Calle Peatonal S/N entre Calles 1A y 2A', '', '', 16.4967, 68.2101, 10, 2130),
(106, '106', 'Unidad Educativa Adela Zamudio', 11, 3, '', 'VILLA ILLIMANI', '', 'Calle David Crespo N° 1050 entre Av. Cochabamba y Av. Adela Zamudio', '', '', 16.4967, 68.2101, 10, 2309),
(107, '107', 'U.E. San Andres', 11, 1, '', 'VILLA EXALTACION', '', 'Av. La Razón S/N entre Calle La Primera y Av. Illimani', '', '', 16.4967, 68.2101, 9, 1858),
(108, '108', 'U.E. Gral. Armando Escobar Uria', 11, 1, '', 'CIUDAD SATELITE', '', 'Calle 27 o Calle G entre Av. Agustin y Calle F. Caballero N. S/N', '', '', 16.4967, 68.2101, 8, 1783),
(109, '109', 'Escuela Juan Carlos Flores Bedregal (23 de Marzo)', 13, 4, '', '23 DE MARZO', '', 'Av. Misael Saracho S/N, entre Calle Quindío.', '', '', 16.4967, 68.2101, 8, 1653),
(110, '110', 'U.E. Cristal', 12, 8, '', 'SENKATA 79', '', 'Calle Cipreces entre Avenida Ana Maria Flores y Calle Calvert S/N', '', '', 16.4967, 68.2101, 8, 1744),
(111, '111', 'Esc. Primavera', 11, 3, '', 'VILLA PRIMAVERA', '', 'Av. San Buen Ventura S/N y Calle Mecapaca', '', '', 16.4967, 68.2101, 8, 1681),
(112, '112', 'Colegio Mariscal Andres De Santa Cruz', 11, 1, '', 'VILLA TEJADA  ALPACOMA', '', 'Calle K entre  Av. Diego de Ocaña y Av. Panorámica', '', '', 16.4967, 68.2101, 7, 1501),
(113, '113', 'Sede Social Junta Vecinal', 12, 2, '', 'ASUNCION DE SAN PEDRO', '', 'Calle Ramon Mariaca S/N entre Calles Gregorio Ramos y Av. Litoral  al Lado del Centro de Salud', '', '', 16.4967, 68.2101, 7, 1484),
(114, '114', 'U. E. Villa Adela Yunguyo (Villa Adela)', 11, 3, '', 'VILLA ADELA', '', 'Av. Puerto Acosta N° 1454 entre Calles Tihuanacu y Yaco Cerca al Puente Bolivia', '', '', 16.4967, 68.2101, 6, 1352),
(115, '115', 'Unidad Educativa Republica de Cuba (Pacajes)', 11, 3, '', 'PACAJES', '', 'Calle 5 S/N entre  Av. Las Américas y Av. B', '', '', 16.4967, 68.2101, 6, 1189),
(116, '116', 'Unidad Educativa Andres Bello', 11, 1, '', 'BOLIVAR \"A\"', '', 'Calle Tellez Rojas S/N  Av. del Aviador', '', '', 16.4967, 68.2101, 5, 1141),
(117, '117', 'U.E. Fuerza Aerea Argentina', 13, 7, '', 'URB. LEON', '', 'Avenida Kollasuyo S/N, entre Calles Mario Mercado Vaca Guzmán y Caranavi.', '', '', 16.4967, 68.2101, 5, 1053),
(118, '118', 'U.E. Amigos Del Chaco', 11, 3, '', 'AMIG DEL CHACO', '', 'Av. Rurrenabaque S/N entre Calle B y C', '', '', 16.4967, 68.2101, 5, 1119),
(119, '119', 'Unidad Educativa Pablo Zarate Villca', 10, 5, '', 'HUAYNA POTOSI', '', 'Av. Ingenio y Calle Chauria', '', '', 16.4967, 68.2101, 3, 544),
(120, '120', 'Unidad Educativa Andres Bello (U. E. 16 de Julio)', 11, 1, '', 'BOLIVAR \"A\"', '', 'Calle Tellez Rojas, S/N, Av. del Aviador, Zona Bolivar A', '', '', 16.4967, 68.2101, 3, 620),
(121, '121', 'Colegio Puerto Del Rosario (Villa Porvenir)', 11, 2, '', 'VILLA PORVENIR', '', 'Av. Illimani S/N Frente a La Plaza Bolivar entre Calle La Cumbre y Esmeralda', '', '', 16.4967, 68.2101, 3, 583),
(122, '122', 'Sede Vecinal', 11, 2, '', 'VILLA BOLIVAR B', '', 'Calle 104 S/N Lado Empresa Alanoca', '', '', 16.4967, 68.2101, 3, 505),
(123, '123', 'Unidad Educativa Eduardo Avaroa I', 13, 9, '', 'POMAMAYA BAJA', '', 'Sobre La Plaza S/N Comunidad Pomamaya', '', '', 16.4967, 68.2101, 3, 685),
(124, '124', 'Unidad Educativa Rep. Del Uruguay', 13, 11, '', 'TACACHIRA', '', 'Frente a La Cancha Tacachira S/N', '', '', 16.4967, 68.2101, 3, 601),
(125, '125', 'Unidad Educativa Venezuela', 13, 14, '', 'URB FRANZ TAMAYO', '', 'Av. Ladislao Cabrera y Villalobos', '', '', 16.4967, 68.2101, 3, 724),
(126, '126', 'U.E. República de Canadá', 12, 12, '', 'ALTO CHIJINI', '', 'Urb. a Calle Oruro #220', '', '', 16.4967, 68.2101, 2, 400),
(127, '127', 'U.E. Particular Interandino Boliviano', 10, 6, '', 'VILLA 16 DE JULIO', '', 'Calle Victor Gutierrez N° 3339 entre Calles Catacora y Alvarez Plata', '', '', 16.4967, 68.2101, 1, 239),
(128, '128', 'U.E. Mariscal de Zepita', 10, 4, '', 'VILLA TUNARI', '', 'Av. Costanera, entre calles F. Tunari y Calle 20 Tunari', '', '', 16.4967, 68.2101, 0, 0),
(129, '129', 'U.E. Villa el Carmen', 11, 2, '', 'Villa el Carmen', '', 'Av. Modesto Omiste entre Calle Eufracio Ibañez y Atocha', '', '', 16.4967, 68.2101, 0, 0),
(130, '130', 'U.E. Akapana Fuerza Andina', 12, 8, '', 'MERCEDES UNID. VEC. \"F\"', '', 'Av. Ayacuho esquina Carlos Palenque s/n', '', '', 16.4967, 68.2101, 0, 0),
(131, '131', 'U.E. Ernesto Che Guevara', 13, 7, '', 'SAN ROQUE', '', 'Av. Adolfo Salas', '', '', 16.4967, 68.2101, 0, 0),
(132, '132', 'U.E. Iberdrola', 12, 8, '', 'San Pedro San Pablo', '', 'Av. Hernando Siles Suazo', '', '', 16.4967, 68.2101, 0, 0),
(133, '133', 'U.E. Juan Pablo II', 13, 3, '', 'COSMOS 79', '', 'Calle Adoquinada y Av. Audiencia', '', '', 16.4967, 68.2101, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_persona_mesa`
--

CREATE TABLE `rel_persona_mesa` (
  `id_persona_mesa` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_campana`
--

CREATE TABLE `rel_usuario_campana` (
  `id_usuario_casa_campana` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_casa_campana` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_usuario_campana`
--

INSERT INTO `rel_usuario_campana` (`id_usuario_casa_campana`, `id_usuario`, `id_casa_campana`, `activo`) VALUES
(1, 88, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_circunscripcion`
--

CREATE TABLE `rel_usuario_circunscripcion` (
  `id_usuario_circunscripcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_circunscripcion` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_usuario_circunscripcion`
--

INSERT INTO `rel_usuario_circunscripcion` (`id_usuario_circunscripcion`, `id_usuario`, `id_circunscripcion`, `activo`) VALUES
(1, 77, 10, 1),
(2, 78, 10, 1),
(3, 79, 0, 1),
(4, 90, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_distrito`
--

CREATE TABLE `rel_usuario_distrito` (
  `id_usuario_distrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_usuario_distrito`
--

INSERT INTO `rel_usuario_distrito` (`id_usuario_distrito`, `id_usuario`, `id_distrito`, `activo`) VALUES
(1, 72, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_mesa`
--

CREATE TABLE `rel_usuario_mesa` (
  `id_usuario_mesa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_usuario_mesa`
--

INSERT INTO `rel_usuario_mesa` (`id_usuario_mesa`, `id_usuario`, `id_mesa`, `activo`) VALUES
(1, 45, 1, 1),
(2, 45, 2, 1),
(13, 63, 17, 1),
(14, 63, 18, 1),
(31, 91, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_recinto`
--

CREATE TABLE `rel_usuario_recinto` (
  `id_usuario_recinto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_recinto` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_usuario_recinto`
--

INSERT INTO `rel_usuario_recinto` (`id_usuario_recinto`, `id_usuario`, `id_recinto`, `activo`) VALUES
(1, 71, 66, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_usuario_transporte`
--

CREATE TABLE `rel_usuario_transporte` (
  `id_usuario_transporte` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_transporte` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rel_usuario_transporte`
--

INSERT INTO `rel_usuario_transporte` (`id_usuario_transporte`, `id_usuario`, `id_transporte`, `activo`) VALUES
(1, 45, 14, 1),
(2, 82, 5, 1),
(3, 83, 5, 1),
(4, 89, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `nivel` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `nivel`, `created_at`, `updated_at`, `special`) VALUES
(1, 'SuperAdministrador', 'super_admin', 'Administrador del Sistema', 0, '2019-02-04 09:13:33', '2019-02-04 09:13:33', NULL),
(2, 'Administrador', 'admin', 'Administrador de Recursos Humanos', 0, '2019-02-04 09:14:04', '2019-02-04 09:14:04', NULL),
(5, 'reporte', 'reporte', 'reporte', 0, '2019-05-04 04:14:11', '2019-05-04 04:14:11', NULL),
(6, 'encuestador', 'encuestador', 'encuestador', 0, '2019-05-04 04:21:19', '2019-05-04 04:21:19', NULL),
(7, 'revisor', 'revisor', 'Usuario Revisor de Encuestas', 0, '2019-07-04 15:22:41', '2019-07-04 15:22:41', NULL),
(8, 'estadar', 'estadar', 'Usuario estadar', 0, NULL, NULL, NULL),
(15, 'DelegadoMas', 'delegado_mas', 'Delegado del MAS', 90, NULL, NULL, NULL),
(16, 'Conductor', 'conductor', 'Usuarios con vehiculo', 100, NULL, NULL, NULL),
(17, 'Registrador', 'registrador', 'Registrador en Casa de Campaña', 110, NULL, NULL, NULL),
(18, 'CallCenter', 'call_center', 'Supervisor Call Center', 120, NULL, NULL, NULL),
(20, 'Informatico', 'informatico', 'Delegado informático', 130, NULL, NULL, NULL),
(21, 'ResponsableRecinto', 'responsable_recinto', 'Responsable de Recinto', 140, NULL, NULL, NULL),
(22, 'ResponsableDistrito', 'responsable_distrito', 'Responsable de Distrito', 150, NULL, NULL, NULL),
(23, 'ResponsableCircunscripcion', 'responsable_circunscripcion', 'Responsable de Circunscripción', 160, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-02-04 09:15:53', '2019-02-04 09:15:53'),
(5, 2, 1, '2019-02-07 09:21:05', '2019-02-07 09:21:05'),
(22, 2, 21, '2019-02-12 11:34:20', '2019-02-12 11:34:20'),
(50, 5, 42, '2019-05-04 04:16:32', '2019-05-04 04:16:32'),
(51, 6, 21, '2019-05-04 04:21:38', '2019-05-04 04:21:38'),
(83, 4, 44, '2019-07-04 20:14:10', '2019-07-04 20:14:10'),
(84, 3, 44, '2019-07-04 20:14:10', '2019-07-04 20:14:10'),
(85, 7, 44, '2019-07-04 20:14:29', '2019-07-04 20:14:29'),
(98, 8, 40, '2019-08-14 00:22:29', '2019-08-14 00:22:29'),
(99, 8, 43, '2019-08-14 00:22:29', '2019-08-14 00:22:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_origen`
--

CREATE TABLE `sub_origen` (
  `id_sub_origen` int(11) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sub_origen`
--

INSERT INTO `sub_origen` (`id_sub_origen`, `id_origen`, `nombre`, `activo`) VALUES
(1, 1, 'Fejuve', 1),
(2, 1, 'COR', 1),
(3, 2, 'Yacana', 1),
(4, 2, 'ADSIB', 1),
(5, 3, 'TSE', 1),
(9, 3, 'Regional El Alto', 1),
(10, 4, 'Marco Mamani', 1),
(11, 4, 'Fabricio Torrico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportes`
--

CREATE TABLE `transportes` (
  `id_transporte` int(11) NOT NULL,
  `conductor` varchar(200) NOT NULL,
  `contacto_conductor` varchar(10) NOT NULL,
  `propietario` varchar(200) NOT NULL,
  `contacto_propietario` varchar(10) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `id_suborigen` int(11) NOT NULL,
  `distrito` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transportes`
--

INSERT INTO `transportes` (`id_transporte`, `conductor`, `contacto_conductor`, `propietario`, `contacto_propietario`, `id_origen`, `id_suborigen`, `distrito`, `marca`, `modelo`, `placa`, `activo`) VALUES
(1, '1', '', '', '', 0, 0, 0, '', '', '', 0),
(2, '1', '1', '1', '', 0, 0, 0, '', '', '', 0),
(3, '1', '1', '1', '1', 0, 0, 0, '', '', '', 0),
(4, '1', '1', '1', '1', 1, 1, 0, '', '', '', 0),
(5, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 1, 1, 2, 'Renault', 'Logan', '3333LBA', 1),
(6, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 5, 0, 6, 'Renault', 'Logan', '3333LBA', 1),
(7, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 2, 3, 6, 'Renault', 'Logan', '3333LBA', 1),
(8, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 2, 3, 6, 'Renault', 'Logan', '3333LBA', 1),
(9, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 1, 1, 6, 'Renault', 'Logan', '3333LBA', 1),
(10, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 1, 1, 6, 'Renault', 'Logan', '3333LBA', 1),
(11, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 2, 3, 2, 'Renault', 'Logan', '3333LBA', 1),
(12, 'Fabricio Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 1, 1, 6, 'Renault', 'Logan', '3333LBA', 1),
(13, 'Fabricio Gabriel Torrico Barahona', '60104841', 'Dante Torrico', '60601946', 1, 2, 2, 'Renault', 'Logan', '3333LBA', 1),
(14, '', '', 'Fabricio Torrico', '60104841', 1, 1, 2, 'Renault', 'Logan', '1234 -XYZ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_persona` int(11) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `id_persona`, `activo`) VALUES
(1, 'William', 'william', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'Lv1lKIDLu3HKVJJdx0yxZx1M6xdqJgHXdLYbkyVrflRwFt2zqbr0gZN1MiXf', '2019-01-31 20:02:24', '2019-07-25 20:18:46', 0, 0),
(38, 'ENCUESTADOR', 'encuestas222@gmail.com', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'CnF6ZADW9cnmdWfbNvPkG3H8LWNlozBGooo6UtdwKYF5XrhicNuwIoPWeITt', '2019-05-02 20:51:02', '2019-05-17 15:21:12', 0, 0),
(39, 'ENCUESTADOR', 'encuesta11111@gmail.com', '$2y$10$SfJjzZOHkK6.CHmUuecFDu8ApKrrcC./Iz4VaAELNel5dFzlsw5pK', NULL, '2019-05-02 20:57:24', '2019-05-02 20:57:24', 0, 0),
(40, 'ENCUESTADOR', 'encuestador', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'KI1MT35JgryMomO1e7dtv5axNvML2eOKnkMkZiPpRJ014m8WYcbHFCmL9JTw', '2019-05-02 21:00:44', '2019-08-13 18:37:27', 0, 0),
(42, 'MAE', 'mae', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'CxGRTyOUvOwXfmPvJvxiNa1ikwoSn9XYJjkjALOQnDNPzjKAELzPL7HnuGjl', '2019-05-04 04:11:57', '2019-08-12 13:44:44', 0, 0),
(43, 'ENCUESTADOR', 'encuestas@gmail.com', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'F8ZapUjMyqXrVcpXAOdqr929MqMfG4eGW4Zea89u40nTocGvwnLMUSW4BL5H', '2019-05-17 13:43:14', '2019-07-25 21:54:07', 0, 0),
(44, 'REVISOR', 'revisor', '$2y$10$VD2SrWs0of/hUAXt80HnJe54ChGpcWLPp9kZg4/b5w.A8OfbCueo2', 'yzNO8iHogrCfs6h7Q332WRR7t7vc9QAosAFmqmSpxOmIHCAWTwPxdlxquXzM', '2019-07-04 20:14:09', '2019-08-17 00:06:28', 0, 1),
(45, 'Fabricio Gabriel Torrico Barahona', 'fabricio.torrico', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, 3, 1),
(46, 'Marco Mamani', 'marco.mamani@minculturas.gob.bo', '1234', NULL, NULL, NULL, 13, 1),
(91, '12345123', 'lorenalauralopez@12345123', '$2y$10$maqqTAcJKMO2uskV7H7mNuF62WGHG.wMFCaqpprAaRJe2Dglhelni', NULL, '2019-08-19 23:58:09', '2019-08-19 23:58:09', 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(25) NOT NULL,
  `contrasena` varchar(25) NOT NULL,
  `activo` binary(0) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_presidenciales`
--

CREATE TABLE `votos_presidenciales` (
  `id_votos_presidenciales` int(11) NOT NULL,
  `registrado` binary(0) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_partido` int(11) NOT NULL,
  `validos` int(7) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos_presidenciales`
--

INSERT INTO `votos_presidenciales` (`id_votos_presidenciales`, `registrado`, `id_mesa`, `id_partido`, `validos`, `id_usuario`) VALUES
(1, '', 1, 1, 50, 44),
(2, '', 1, 2, 23, 44),
(3, '', 1, 3, 36, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_presidenciales_r`
--

CREATE TABLE `votos_presidenciales_r` (
  `id_votos_presidenciales_r` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `nulos` int(7) NOT NULL,
  `blancos` int(7) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos_presidenciales_r`
--

INSERT INTO `votos_presidenciales_r` (`id_votos_presidenciales_r`, `id_mesa`, `nulos`, `blancos`, `id_usuario`) VALUES
(3, 1, 5, 5, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_uninominales`
--

CREATE TABLE `votos_uninominales` (
  `id_votos_uninominales` int(11) NOT NULL,
  `registrado` binary(0) NOT NULL,
  `id_circunscripcion` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_partido` int(11) NOT NULL,
  `validos` int(7) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos_uninominales`
--

INSERT INTO `votos_uninominales` (`id_votos_uninominales`, `registrado`, `id_circunscripcion`, `id_mesa`, `id_partido`, `validos`, `id_usuario`) VALUES
(1, '', 0, 1, 1, 33, 44),
(2, '', 0, 1, 2, 12, 44),
(3, '', 0, 1, 3, 50, 44),
(4, '', 0, 2, 2, 225, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_uninominales_r`
--

CREATE TABLE `votos_uninominales_r` (
  `id_votos_uninominales_r` int(11) NOT NULL,
  `id_circunscripcion` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `nulos` int(7) NOT NULL,
  `blancos` int(7) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `votos_uninominales_r`
--

INSERT INTO `votos_uninominales_r` (`id_votos_uninominales_r`, `id_circunscripcion`, `id_mesa`, `nulos`, `blancos`, `id_usuario`) VALUES
(1, 0, 1, 2, 5, 44);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `casas_campana`
--
ALTER TABLE `casas_campana`
  ADD PRIMARY KEY (`id_casa_campana`);

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id_distrito`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`);

--
-- Indices de la tabla `origen`
--
ALTER TABLE `origen`
  ADD PRIMARY KEY (`id_origen`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id_partido`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  ADD PRIMARY KEY (`id_postulante`);

--
-- Indices de la tabla `recintos`
--
ALTER TABLE `recintos`
  ADD PRIMARY KEY (`id_recinto`);

--
-- Indices de la tabla `rel_persona_mesa`
--
ALTER TABLE `rel_persona_mesa`
  ADD PRIMARY KEY (`id_persona_mesa`);

--
-- Indices de la tabla `rel_usuario_campana`
--
ALTER TABLE `rel_usuario_campana`
  ADD PRIMARY KEY (`id_usuario_casa_campana`);

--
-- Indices de la tabla `rel_usuario_circunscripcion`
--
ALTER TABLE `rel_usuario_circunscripcion`
  ADD PRIMARY KEY (`id_usuario_circunscripcion`);

--
-- Indices de la tabla `rel_usuario_distrito`
--
ALTER TABLE `rel_usuario_distrito`
  ADD PRIMARY KEY (`id_usuario_distrito`);

--
-- Indices de la tabla `rel_usuario_mesa`
--
ALTER TABLE `rel_usuario_mesa`
  ADD PRIMARY KEY (`id_usuario_mesa`);

--
-- Indices de la tabla `rel_usuario_recinto`
--
ALTER TABLE `rel_usuario_recinto`
  ADD PRIMARY KEY (`id_usuario_recinto`);

--
-- Indices de la tabla `rel_usuario_transporte`
--
ALTER TABLE `rel_usuario_transporte`
  ADD PRIMARY KEY (`id_usuario_transporte`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `sub_origen`
--
ALTER TABLE `sub_origen`
  ADD PRIMARY KEY (`id_sub_origen`);

--
-- Indices de la tabla `transportes`
--
ALTER TABLE `transportes`
  ADD PRIMARY KEY (`id_transporte`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `votos_presidenciales`
--
ALTER TABLE `votos_presidenciales`
  ADD PRIMARY KEY (`id_votos_presidenciales`);

--
-- Indices de la tabla `votos_presidenciales_r`
--
ALTER TABLE `votos_presidenciales_r`
  ADD PRIMARY KEY (`id_votos_presidenciales_r`);

--
-- Indices de la tabla `votos_uninominales`
--
ALTER TABLE `votos_uninominales`
  ADD PRIMARY KEY (`id_votos_uninominales`);

--
-- Indices de la tabla `votos_uninominales_r`
--
ALTER TABLE `votos_uninominales_r`
  ADD PRIMARY KEY (`id_votos_uninominales_r`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `casas_campana`
--
ALTER TABLE `casas_campana`
  MODIFY `id_casa_campana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `origen`
--
ALTER TABLE `origen`
  MODIFY `id_origen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id_partido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `postulantes`
--
ALTER TABLE `postulantes`
  MODIFY `id_postulante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recintos`
--
ALTER TABLE `recintos`
  MODIFY `id_recinto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT de la tabla `rel_persona_mesa`
--
ALTER TABLE `rel_persona_mesa`
  MODIFY `id_persona_mesa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_campana`
--
ALTER TABLE `rel_usuario_campana`
  MODIFY `id_usuario_casa_campana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_circunscripcion`
--
ALTER TABLE `rel_usuario_circunscripcion`
  MODIFY `id_usuario_circunscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_distrito`
--
ALTER TABLE `rel_usuario_distrito`
  MODIFY `id_usuario_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_mesa`
--
ALTER TABLE `rel_usuario_mesa`
  MODIFY `id_usuario_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_recinto`
--
ALTER TABLE `rel_usuario_recinto`
  MODIFY `id_usuario_recinto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rel_usuario_transporte`
--
ALTER TABLE `rel_usuario_transporte`
  MODIFY `id_usuario_transporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `sub_origen`
--
ALTER TABLE `sub_origen`
  MODIFY `id_sub_origen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `transportes`
--
ALTER TABLE `transportes`
  MODIFY `id_transporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `votos_presidenciales`
--
ALTER TABLE `votos_presidenciales`
  MODIFY `id_votos_presidenciales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `votos_presidenciales_r`
--
ALTER TABLE `votos_presidenciales_r`
  MODIFY `id_votos_presidenciales_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `votos_uninominales`
--
ALTER TABLE `votos_uninominales`
  MODIFY `id_votos_uninominales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `votos_uninominales_r`
--
ALTER TABLE `votos_uninominales_r`
  MODIFY `id_votos_uninominales_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
