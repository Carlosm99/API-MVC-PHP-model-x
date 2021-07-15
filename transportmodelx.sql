-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 08:19 AM
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
-- Database: `transportmodelx`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `PrimerNombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Permiso` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `PrimerNombre`, `Apellido`, `Permiso`, `username`, `password`) VALUES
(1, 'Jose', 'Martinez', 'Admin', 'joemar', 'd33e845151d68897aa3f52ad0ffb9639'),
(2, 'Charles', 'Medina', 'editor', 'chamed', '71c40551c598f5a1c96d6ea83c7bbb3a'),
(3, 'Richard', 'Medina', 'editor', 'chamed', '71c40551c598f5a1c96d6ea83c7bbb3a');

-- --------------------------------------------------------

--
-- Table structure for table `boletos`
--

CREATE TABLE `boletos` (
  `id_boleto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_corrida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `boletos`
--

INSERT INTO `boletos` (`id_boleto`, `id_usuario`, `id_corrida`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `busline`
--

CREATE TABLE `busline` (
  `id_busline` int(11) NOT NULL,
  `BuslineName` varchar(50) NOT NULL,
  `ownerName` varchar(50) NOT NULL,
  `ownerApellido` varchar(50) NOT NULL,
  `antiguedad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busline`
--

INSERT INTO `busline` (`id_busline`, `BuslineName`, `ownerName`, `ownerApellido`, `antiguedad`) VALUES
(1, 'BBOC', 'Liam', 'Smith', 8),
(2, 'Lyn\'s', 'Noah', 'Johnson', 12),
(3, 'Westline ', 'Oliver', 'William', 6),
(4, 'Griga Line', 'Elijah', 'Garcia', 9),
(5, 'Joshua\'s Bus', 'Joshua', 'Miller', 7),
(6, 'Tomas Chell ', 'Lucas', 'Martinez', 12),
(7, 'Westline ', 'Oliver', 'William', 6);

-- --------------------------------------------------------

--
-- Table structure for table `corridas`
--

CREATE TABLE `corridas` (
  `id_corrida` int(11) NOT NULL,
  `id_busline` int(11) NOT NULL,
  `Origen` varchar(100) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Inicial_origen` varchar(5) NOT NULL,
  `Inicial_destino` varchar(5) NOT NULL,
  `Hora_de_partida` time NOT NULL,
  `hora_de_llegada` time NOT NULL,
  `dias_de_operacion` varchar(20) NOT NULL,
  `costo` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `corridas`
--

INSERT INTO `corridas` (`id_corrida`, `id_busline`, `Origen`, `Destino`, `Inicial_origen`, `Inicial_destino`, `Hora_de_partida`, `hora_de_llegada`, `dias_de_operacion`, `costo`) VALUES
(2, 7, '', 'Francis', 'Toled', 'ST', '00:00:00', '07:00:00', '08:00:00 ', '0'),
(3, 1, 'Corozal', 'Belize City', 'CZ', 'BZ', '03:00:00', '04:00:00', 'MON-FRI', '9'),
(10, 1, 'Action', 'Belize City', 'CZ', 'BZ', '03:00:00', '04:00:00', 'MON-FRI', '9'),
(11, 4, 'Don Jorge', 'Toledo', 'ST', 'TL', '07:00:00', '08:00:00', 'MON-FRI ', '2'),
(12, 7, 'Nuevo entrada', 'Toledo', 'ST', 'TL', '07:00:00', '08:00:00', 'MON-FRI ', '2');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `PrimerNombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` int(10) NOT NULL,
  `lugar_de_origen` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `PrimerNombre`, `Apellido`, `Email`, `Telefono`, `lugar_de_origen`, `username`, `password`) VALUES
(1, 'Richard', 'Davis', 'richdavis@gmail.com', 6230918, 'Belmopan', 'ricdav', '0c06a6924083fa1b9aedea6d6f958a2f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`id_boleto`),
  ADD KEY `id_usuario` (`id_usuario`,`id_corrida`),
  ADD KEY `id_corrida` (`id_corrida`);

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
  ADD KEY `id_busline` (`id_busline`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `boletos`
--
ALTER TABLE `boletos`
  MODIFY `id_boleto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `busline`
--
ALTER TABLE `busline`
  MODIFY `id_busline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `corridas`
--
ALTER TABLE `corridas`
  MODIFY `id_corrida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boletos`
--
ALTER TABLE `boletos`
  ADD CONSTRAINT `boletos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `boletos_ibfk_2` FOREIGN KEY (`id_corrida`) REFERENCES `corridas` (`id_corrida`);

--
-- Constraints for table `corridas`
--
ALTER TABLE `corridas`
  ADD CONSTRAINT `corridas_ibfk_1` FOREIGN KEY (`id_busline`) REFERENCES `busline` (`id_busline`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
