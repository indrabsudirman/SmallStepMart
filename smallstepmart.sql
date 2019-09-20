-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 31, 2019 at 04:26 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smallstepmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `jenisProduk` varchar(80) NOT NULL,
  `namaProduk` varchar(255) NOT NULL,
  `hargaProduk` decimal(13,2) NOT NULL,
  `stokProduk` int(11) NOT NULL,
  `gambarProduk` varchar(255) NOT NULL,
  `tanggalMasuk` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `jenisProduk`, `namaProduk`, `hargaProduk`, `stokProduk`, `gambarProduk`, `tanggalMasuk`) VALUES
(1, 'Susu', 'Dancow', '34000.00', 400, '5d6a33c4abe98.jpg', '2019-08-31 15:45:56'),
(2, 'Perlengkapan Memasak', 'Kecap manis Bango 250ml', '12000.00', 120, '5d6a3507a98e2.jpg', '2019-08-31 15:51:19'),
(3, 'Perlengkapan Mandi', 'Sikat Gigi Formula', '10000.00', 138, '5d6a355751c4d.jpg', '2019-08-31 15:52:39'),
(4, 'Perlengkapan Sekolah', 'Pensil 2B', '5500.00', 123, '5d6a35f8b3a08.jpg', '2019-08-31 15:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(9, 'Indra Sudirman', '$2y$10$A.X.ExiVMNgetjUhWEoareKNetZ2ea0uoaxXrT1/Q1juxeWrbqFsq', '2019-08-31 16:03:56'),
(10, 'Feri Irawan', '$2y$10$6TbihdulZd9YNrWARTMFVeKFXyg1SKWE.0Cc2yInVuQGIMC5o7SQG', '2019-08-31 16:04:11'),
(11, 'Muhammad Iqbal', '$2y$10$Xti7eDv5A.dOK6Dwzpb1B./H3hHERvwL.2t6eyVYsNX3PZHBbvy2C', '2019-08-31 16:04:31'),
(12, 'Della Panji Yudistira', '$2y$10$OZibpDdShPLuiOt8vB6GwOO2lgv1tONbAVwB1IYdObDSsEDUGR7by', '2019-08-31 16:04:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
