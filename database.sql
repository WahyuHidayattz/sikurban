-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2024 at 12:23 AM
-- Server version: 10.11.8-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikurban`
--

-- --------------------------------------------------------

--
-- Table structure for table `hewan`
--

CREATE TABLE `hewan` (
  `id` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `kualitas` varchar(255) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hewan`
--

INSERT INTO `hewan` (`id`, `id_supplier`, `nama`, `jenis`, `kualitas`, `berat`, `harga`, `tanggal`, `catatan`, `status`) VALUES
(2, 2, 'Ayam Kampung', 'Jual', 'STANDAR', 5, 15000, '2024-09-25 12:28:46', 'Ini untuk dijual ke pengepul', 'SEMBELIH'),
(3, 1, 'Kambing Garut', 'Jual aja', 'STANDAR', 55, 25000, '2024-09-25 12:31:04', 'Jual aja lah', 'SEMBELIH'),
(4, 3, 'Kerbau Sawah', 'Hewan Kurban', 'PREMIUM', 1500, 435000, '2024-09-25 22:40:37', 'Untuk dibagikan ', 'HIDUP');

-- --------------------------------------------------------

--
-- Table structure for table `hewan_keluar`
--

CREATE TABLE `hewan_keluar` (
  `id` int(11) NOT NULL,
  `id_potong` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hewan_keluar`
--

INSERT INTO `hewan_keluar` (`id`, `id_potong`, `berat`, `harga`, `total_harga`, `nama_penerima`, `tanggal`) VALUES
(7, 7, 5, 15000, 150000, 'M. Syahrul Gunawan', '2024-09-26 00:20:18'),
(8, 6, 20, 35000, 1190000, 'Wahyu Hidayat', '2024-09-26 00:20:25'),
(9, 6, 5, 35000, 1190000, 'Muhammad Marshall', '2024-09-26 00:20:34'),
(10, 6, 9, 35000, 1190000, 'M. Syahrul Gunawan', '2024-09-26 00:20:42'),
(11, 9, 2, 43000, 86000, 'M. Agung Zamzami', '2024-09-26 00:20:54'),
(12, 10, 1, 10000, 10000, 'M. Agung Zamzami', '2024-09-26 00:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `hewan_potong`
--

CREATE TABLE `hewan_potong` (
  `id` int(11) NOT NULL,
  `id_hewan` int(11) DEFAULT NULL,
  `nama_bagian` varchar(255) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hewan_potong`
--

INSERT INTO `hewan_potong` (`id`, `id_hewan`, `nama_bagian`, `berat`, `harga`, `tanggal`) VALUES
(5, 3, 'Jeroan', 11, 20000, '2024-09-25 14:25:54'),
(6, 3, 'Daging', 34, 35000, '2024-09-25 14:26:07'),
(7, 3, 'tulang', 10, 15000, '2024-09-25 14:28:00'),
(8, 2, 'Tulang', 2, 14000, '2024-09-25 23:03:55'),
(9, 2, 'Daging', 2, 43000, '2024-09-25 23:04:11'),
(10, 2, 'Jeroan', 1, 10000, '2024-09-25 23:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(100) DEFAULT NULL,
  `rekening` varchar(100) DEFAULT NULL,
  `nomor_rekening` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `nomor_hp`, `rekening`, `nomor_rekening`, `status`) VALUES
(1, 'PT. Indomarco Prismatama', 'Cibuah, Banten', '082249925346', 'BCA', '42100021', 'active'),
(2, 'PT. Charelon Pokhpand', 'Serang', '081389192149', 'BRI', '425000021', 'active'),
(3, 'PT. Indofarma Meredeka', 'Pandeglang', '08777665544', 'BCA', '24000067', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_hp` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `alamat`, `nomor_hp`, `password`, `role`) VALUES
(1, 'Wahyu Hidayat', 'admin', 'Kp. Pasir Kalapa', '082249925346', '123', 'admin'),
(2, 'Wahyu Hidayat', 'kasir', 'Kp. Pasir Kalapa', '082249925346', '123', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hewan_keluar`
--
ALTER TABLE `hewan_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hewan_potong`
--
ALTER TABLE `hewan_potong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hewan`
--
ALTER TABLE `hewan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hewan_keluar`
--
ALTER TABLE `hewan_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hewan_potong`
--
ALTER TABLE `hewan_potong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
