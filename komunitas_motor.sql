-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 01:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komunitas_motor`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `alamat`, `email`, `nomor_handphone`, `jenis_kelamin`, `tanggal_masuk`, `status`) VALUES
(5, 'Eko Prasetyo', 'Jl. Melati No. 5, Semarang', 'eko@example.com', '085678901234', 'L', '2017-11-30', 'tidak aktif'),
(6, 'Fani Rahmawati', 'Jl. Mawar No. 6, Medan', 'fani@example.com', '086789012345', 'P', '2022-02-14', 'aktif'),
(7, 'Gilang Prabowo', 'Jl. Anggrek No. 7, Bali', 'gilang@example.com', '087890123456', 'L', '2019-09-05', 'aktif'),
(8, 'Hani Sari', 'Jl. Bougenville No. 8, Makassar', 'hani@example.com', '088901234567', 'P', '2020-12-01', 'aktif'),
(9, 'Iwan Kurniawan', 'Jl. Flamboyan No. 9, Palembang', 'iwan@example.com', '089012345678', 'L', '2016-06-15', 'tidak aktif'),
(10, 'Julianto', 'Jl. Angsana No. 10, Batam', 'julianto@example.com', '090123456789', 'L', '2023-03-01', 'aktif'),
(11, 'salvano', 'jl. wijaya kusuma no. 26 desa karangwangi', 'salva555@gmail.com', '08522798124', 'L', '2025-01-23', 'aktif'),
(12, 'octa', 'jl. karangwereng', 'iadi@gmail.com', '085786368326', 'L', '2025-02-01', 'aktif'),
(13, 'rendriyan', 'jl. karangwangi', 'hansgustiadi@gmail.com', '08522798124', 'L', '2025-02-01', 'aktif');

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `set_status` BEFORE INSERT ON `anggota` FOR EACH ROW BEGIN
    SET NEW.status = IF(DATEDIFF(CURDATE(), NEW.tanggal_masuk) <= 1095, 'aktif', 'tidak aktif');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `anggota_view`
-- (See below for the actual view)
--
CREATE TABLE `anggota_view` (
`id` int(11)
,`nama` varchar(100)
,`alamat` varchar(255)
,`email` varchar(100)
,`nomor_handphone` varchar(15)
,`jenis_kelamin` enum('L','P')
,`tanggal_masuk` date
,`status` enum('aktif','tidak aktif')
);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `average_rating` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `id_role`, `average_rating`) VALUES
(1, 'admin', 'Administrator', '0192023a7bbd73250516f069df18b500', 1, 0);

-- --------------------------------------------------------

--
-- Structure for view `anggota_view`
--
DROP TABLE IF EXISTS `anggota_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `anggota_view`  AS SELECT `anggota`.`id` AS `id`, `anggota`.`nama` AS `nama`, `anggota`.`alamat` AS `alamat`, `anggota`.`email` AS `email`, `anggota`.`nomor_handphone` AS `nomor_handphone`, `anggota`.`jenis_kelamin` AS `jenis_kelamin`, `anggota`.`tanggal_masuk` AS `tanggal_masuk`, `anggota`.`status` AS `status` FROM `anggota` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_role` (`nama_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
