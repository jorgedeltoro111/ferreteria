-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2023 a las 07:27:03
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
-- Base de datos: `ferreteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` varchar(15) DEFAULT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Dirección` varchar(20) DEFAULT NULL,
  `Teléfono` varchar(15) DEFAULT NULL,
  `Correo electrónico` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_Compra` varchar(15) DEFAULT NULL,
  `ID_Producto` varchar(15) DEFAULT NULL,
  `ID_Proveedor` varchar(15) DEFAULT NULL,
  `Fecha` varchar(15) DEFAULT NULL,
  `Cantidad` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` varchar(15) DEFAULT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Descripción` varchar(40) DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `Existencias` float DEFAULT NULL,
  `Categoría` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_Proveedor` varchar(15) DEFAULT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Dirección` varchar(40) DEFAULT NULL,
  `Teléfono` float DEFAULT NULL,
  `Correo electrónico` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` varchar(15) DEFAULT NULL,
  `ID_Producto` varchar(15) DEFAULT NULL,
  `ID_Cliente` varchar(15) DEFAULT NULL,
  `Fecha` varchar(15) NOT NULL,
  `Cantidad` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
