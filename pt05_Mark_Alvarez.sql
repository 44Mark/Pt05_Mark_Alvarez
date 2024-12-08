-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: proxysql-01.dd.scip.local
-- Tiempo de generación: 05-12-2024 a las 01:09:20
-- Versión del servidor: 10.10.2-MariaDB-1:10.10.2+maria~deb11
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ddb237146`
--
-- CREATE DATABASE IF NOT EXISTS `ddb237146` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
-- USE `ddb237146`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taula_articles`
--

DROP TABLE IF EXISTS `taula_articles`;
CREATE TABLE `taula_articles` (
  `isbn` varchar(25) NOT NULL,
  `titol` varchar(25) NOT NULL,
  `cos` text NOT NULL,
  `correu_usuari` varchar(255) NOT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `taula_articles`
--

INSERT INTO `taula_articles` (`isbn`, `titol`, `cos`, `correu_usuari`, `data_hora`) VALUES
('978-8413143194', 'El imperio final', 'El inicio de la saga Nacidos de la Bruma.', '0', '2024-11-19 19:45:16'),
('978-8413143941', 'El camino de los reyes', 'Una épica historia de reyes, traición y magia.', '0', '2024-11-19 19:45:16'),
('978-8413143958', 'Palabras radiantes', 'Una continuación de la aventura de los portadores del juramento.', '0', '2024-11-19 19:45:16'),
('978-8413146591', 'Juramentada', 'La tercera entrega de la saga de la Guerra de la Desolación.', '0', '2024-11-19 19:45:16'),
('978-8416865398', 'Edgedancer', 'Una novela corta en el universo de El Archivo de las Tormentas.', '0', '2024-11-19 19:45:16'),
('978-8417347008', 'Dawnshard', 'Novela corta que sigue a Rysn, situada entre Juramentada y Ritmos de Guerra.', '0', '2024-11-19 19:45:16'),
('978-8417347329', 'El Ritmo de la Guerra', 'La cuarta entrega de El Archivo de las Tormentas.', '0', '2024-11-19 19:45:16'),
('978-8417347398', 'Skyward', 'El inicio de la saga Skyward, una historia de ciencia ficción juvenil.', '0', '2024-11-19 19:45:16'),
('978-8417347473', 'Starsight', 'La segunda parte de la serie Skyward.', '0', '2024-11-19 19:45:16'),
('978-8417347572', 'Cytonic', 'La tercera entrega de la saga Skyward.', '0', '2024-11-19 19:45:16'),
('978-8466658843', 'Elantris', 'Una ciudad antigua llena de magia olvidada.', '0', '2024-11-19 19:45:16'),
('978-8466658874', 'El aliento de los dioses', 'Un libro autoconclusivo en el mundo de la cosmere.', '0', '2024-11-19 19:45:16'),
('978-8466658904', 'El pozo de la ascensión', 'La segunda parte de Nacidos de la Bruma.', '0', '2024-11-19 19:45:16'),
('978-8466658911', 'El héroe de las eras', 'El final de la trilogía Nacidos de la Bruma.', '0', '2024-11-19 19:45:16'),
('978-8490708293', 'Sombras de identidad', 'Una secuela de Nacidos de la Bruma con nuevos personajes.', '0', '2024-11-19 19:45:16'),
('9783453654764', 'Ca', 'sa', 'm.alvarez@sapalomera.cat', '2024-11-29 18:20:28'),
('9788417347001', 'z', 'zx', 'ma@ma', '2024-11-22 17:52:07'),
('9788417347009', 'a', 'a', 'ma@ma', '2024-11-22 19:40:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `nom` varchar(100) NOT NULL,
  `correu` varchar(255) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tokenPassword` varchar(255) NOT NULL,
  `tokenPasswordTime` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hybridAuth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`nom`, `correu`, `contrasenya`, `foto`, `tokenPassword`, `tokenPasswordTime`, `hybridAuth`) VALUES
('Admin Super Dios', 'admin@super.cat', '$2y$10$Ytmi8p2xq9YTQQjKMjV.vuS0MkXz7.EuVagaNYbSApWZEb9zEERUy', '../../Vista/assets/fotosUsuaris/dios.jpg', '', '2024-11-25 18:29:19', ''),
('Mark Álvarez Caballero', 'm.alvarez@sapalomera.cat', '', 'https://lh3.googleusercontent.com/a/ACg8ocLg_JmfQQRxLb-dHyjo1_eaHiwNC3ywWwbhpgAhMYEWTSkLLA=s96-c', '', '2024-12-04 22:13:27', 'Google');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `taula_articles`
--
ALTER TABLE `taula_articles`
  ADD PRIMARY KEY (`isbn`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD UNIQUE KEY `Correu` (`correu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
