-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 11:01 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transportmodel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_boleto` int(11) NOT NULL,
  `PrimerNombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Permiso` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `boletos`
--

CREATE TABLE `boletos` (
  `id_boleto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_corrida` int(11) NOT NULL,
  `costo` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `busline`
--

CREATE TABLE `busline` (
  `id_busline` int(11) NOT NULL,
  `BuslineName` varchar(80) NOT NULL,
  `estacion_salida` varchar(80) NOT NULL,
  `estacion_llegada` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `corridas`
--

CREATE TABLE `corridas` (
  `id_corrida` int(11) NOT NULL,
  `id_busline` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Origen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estacion`
--

CREATE TABLE `estacion` (
  `id_estacion` int(11) NOT NULL,
  `nombre_estacion` varchar(50) NOT NULL,
  `localizacion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `id_estacion` int(11) NOT NULL,
  `Hora_de_partida` time NOT NULL,
  `hora_de_llegada` time NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usarios`
--

CREATE TABLE `usarios` (
  `id_usuario` int(11) NOT NULL,
  `PrimerNombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Telefono` int(10) NOT NULL,
  `lugar_de_origen` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_horario` (`id_horario`,`id_boleto`);

--
-- Indexes for table `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id_boleto`),
  ADD KEY `id_usuario` (`id_usuario`,`id_corrida`);

--
-- Indexes for table `busline`
--
ALTER TABLE `busline`
  ADD PRIMARY KEY (`id_busline`);

--
-- Indexes for table `corridas`
--
ALTER TABLE `corridas`
  ADD PRIMARY KEY (`id_corrida`),
  ADD KEY `id_busline` (`id_busline`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indexes for table `estacion`
--
ALTER TABLE `estacion`
  ADD PRIMARY KEY (`id_estacion`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_estacion` (`id_estacion`);

--
-- Indexes for table `usarios`
--
ALTER TABLE `usarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `busline`
--
ALTER TABLE `busline`
  MODIFY `id_busline` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corridas`
--
ALTER TABLE `corridas`
  MODIFY `id_corrida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estacion`
--
ALTER TABLE `estacion`
  MODIFY `id_estacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usarios`
--
ALTER TABLE `usarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
