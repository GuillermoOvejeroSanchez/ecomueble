-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2020 a las 12:30:04
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecomueble`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(10) PRIMARY KEY,
  `nombre` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` int(9) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tipoUsuario` tinyint(1) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(2) PRIMARY KEY,
  `tipo` varchar(15) NOT NULL
  

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(1) PRIMARY KEY,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(10) PRIMARY KEY,
  `descripcion` varchar(350) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `idEstado` int(1) NOT NULL,
  `idCategoria` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`),
  FOREIGN KEY (`idCategoria`) REFERENCES `categoria`(`idCategoria`),
  FOREIGN KEY (`idEstado`) REFERENCES `estado`(`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `idTransaccion` int(10) PRIMARY KEY ,
  `idProducto` int(10) NOT NULL,
  `idComprador` int(10) NOT NULL,
  `fecha` date NOT NULL,
  FOREIGN KEY (`idProducto`) REFERENCES `producto`(`idProducto`),
  FOREIGN KEY (`idComprador`) REFERENCES `usuario`(`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idReporte` int(10) PRIMARY KEY,
  `motivo` varchar(200) NOT NULL,
  `idProducto` int(10) NOT NULL,
  `reportador` int(10) NOT NULL,
  `fechaReporte` date,
  `resolucion` tinyint(1) NOT NULL,
  FOREIGN KEY (`reportador`) REFERENCES `usuario`(`idUsuario`),
  FOREIGN KEY (`idProducto`) REFERENCES `producto`(`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `idValoracion` int(10) PRIMARY KEY,
  `idUsuario` int(10) NOT NULL,
  `nota` int(1) NOT NULL,
  FOREIGN KEY (`idUsuario`) REFERENCES `usuario`(`idUsuario`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
