-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2023 at 08:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `kajian`
--

CREATE TABLE `kajian` (
  `id_kajian` int(11) NOT NULL,
  `nama_kajian` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `prihal` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe` enum('dahulu','antara','akhir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kajian`
--

INSERT INTO `kajian` (`id_kajian`, `nama_kajian`, `bidang`, `prihal`, `file`, `tipe`) VALUES
(3, 'Kajian Pendahuluan 1', 'Rida', 'KKN', '1688989928_44f54ce30ad588030854.pdf', 'dahulu'),
(5, 'Kajian Akhir', 'BIdang Akhir', 'Akhir Prihal', '1688992560_19b91ebd0a01db45ea76.pdf', 'akhir'),
(6, 'Kajian Pendahuluan 2', 'Rida', 'KKN', '1689021920_717a95008f8adb0925dc.pdf', 'dahulu'),
(7, 'Kajian Antara 1', 'Kominfo', 'KKN', '1689083564_98b5eb24fb35f662b9df.pdf', 'antara');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `created`, `user_id`) VALUES
(2, '0512d890651f7eb258bca7cd6dc135fe', '2023-07-09', 1),
(3, 'ce61a248cae72399197f67b851dae970', '2023-07-09', 1),
(5, '81d795d101645e95bf94446133d2c821', '2023-07-09', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('user','admin','pimpinan','') NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `verification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `password`, `email`, `role`, `picture`, `status`, `nik`, `verification`) VALUES
(4, 'Muhammad Dzaky', '$2y$10$RdcZNMrvgg6gMZoHfVuB1ubJqdrwHy4e368SrCEkTgrHIGilC/B2u', 'admin@mail.com', 'admin', '1689088157_c086a1ea1ca545c8a3f6.png', 'Pegawai', '1872020202020001', 1),
(6, 'Budi', '$2y$10$yEhGgTdi/oXKFSMB5SB75utEb7nxL9ujCYlTVldE4Z2Imz6teBzwa', 'user@mail.com', 'user', '1689088243_373b9d33e4937daa5fb3.png', 'Mahasiswa', '2131221213213122', 1),
(7, 'Pimpinan', '$2y$10$jLrOeqEsGa1pVYQGSPQkbekW8j6oHgzN4GEwzKcOMAeiwsGOc8CrC', 'pimpinan@mail.com', 'pimpinan', 'default.jpg', 'pegawai', '1231232132132132', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `id_usulan` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `id_kajian` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `prihal_usulan` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `status_usulan` enum('terverifikasi','pending','proses','revisi','tolak') NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`id_usulan`, `users_id`, `id_kajian`, `created_at`, `prihal_usulan`, `instansi`, `status_usulan`, `updated_at`) VALUES
(12, 6, 3, '2023-07-10', 'Penelitian', 'Universitas Indonesia', 'terverifikasi', '2023-07-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kajian`
--
ALTER TABLE `kajian`
  ADD PRIMARY KEY (`id_kajian`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id_usulan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kajian`
--
ALTER TABLE `kajian`
  MODIFY `id_kajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
