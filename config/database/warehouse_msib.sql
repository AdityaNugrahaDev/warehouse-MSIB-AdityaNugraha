-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2024 at 12:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse_msib`
--

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `capacity` int NOT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `opening_hour` time DEFAULT NULL,
  `closing_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `name`, `location`, `capacity`, `status`, `opening_hour`, `closing_hour`) VALUES
(3, 'PT. Distribusi Mandiri', 'Surabaya', 12000, 'aktif', '09:00:00', '18:00:00'),
(6, 'PT. Anugerah Logistic', 'Cikarang', 12500, 'tidak_aktif', '07:30:00', '16:30:00'),
(8, 'PT. Karya Mandiri', 'Semarang', 15000, 'aktif', '09:00:00', '18:00:00'),
(10, 'PT. Logistik Utama', 'Jakarta Selatan', 15000, 'aktif', '08:00:00', '17:00:00'),
(11, 'PT. Maju Jaya', 'Bandung', 12000, 'tidak_aktif', '08:30:00', '18:00:00'),
(12, 'PT. Abadi Sejahtera', 'Yogyakarta', 18500, 'aktif', '08:00:00', '18:00:00'),
(13, 'PT. Global Logistics', 'Jakarta', 20000, 'aktif', '08:00:00', '17:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
