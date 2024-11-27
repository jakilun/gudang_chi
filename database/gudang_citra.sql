-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 08:43 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_citra`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) DEFAULT '0',
  `stok_minimum` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `berat` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `stok_minimum`, `created_at`, `updated_at`, `berat`) VALUES
(7, 'NL25', 'Nalbumin 25', 0, 100, '2024-11-23 01:10:51', '2024-11-23 01:10:51', '0.25'),
(8, 'CZ12', 'Cozieum', 0, 300, '2024-11-23 01:11:06', '2024-11-23 01:11:06', '0.20'),
(9, 'Oyaho10', 'Oyaho', 0, 100, '2024-11-23 01:11:20', '2024-11-23 01:11:20', '0.10'),
(10, 'NBP7', 'Nano Brazilian Propolis', 0, 100, '2024-11-24 14:03:51', '2024-11-24 14:04:10', '0.02');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `nama_pegawai`, `role`, `created_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin Gudang', 'admin', '2024-11-22 16:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_labels`
--

CREATE TABLE `shipping_labels` (
  `id` int(11) NOT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `alamat_penerima` text,
  `telepon_penerima` varchar(15) DEFAULT NULL,
  `nama_pengirim` varchar(255) DEFAULT NULL,
  `telepon_pengirim` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_transaksi_master` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_labels`
--

INSERT INTO `shipping_labels` (`id`, `nama_penerima`, `alamat_penerima`, `telepon_penerima`, `nama_pengirim`, `telepon_pengirim`, `created_at`, `id_transaksi_master`, `id_transaksi`) VALUES
(25, 'ahmad muzaki', 'Ruko Darwin Timur No.26-27 Gading Serpong, Medang, pagedangan, Kabupaten Tangerang', '082221539913', 'zaki', '082221539913', '2024-11-27 04:00:22', 2, 2),
(26, 'sita', 'gading serpong', '082221539913', 'zaki', '082221539913', '2024-11-27 04:02:26', 3, 3),
(27, 'ahmad muzaki', 'Ruko Darwin Timur No.26-27 Gading Serpong, Medang, pagedangan, Kabupaten Tangerang', '082221539913', 'zaki', '082221539913', '2024-11-27 04:20:23', 5, 5),
(29, 'ahmad muzaki', 'Ruko Darwin Timur No.26-27 Gading Serpong, Medang, pagedangan, Kabupaten Tangerang', '082221539913', 'zaki', '082221539913', '2024-11-27 07:02:47', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_master`
--

CREATE TABLE `transaksi_master` (
  `id_transaksi_master` int(11) NOT NULL,
  `jenis_transaksi` varchar(10) NOT NULL,
  `keterangan` text,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_master`
--

INSERT INTO `transaksi_master` (`id_transaksi_master`, `jenis_transaksi`, `keterangan`, `waktu`) VALUES
(1, 'masuk', 'Retur dari stokis bandung', '2024-11-27 02:12:28'),
(2, 'keluar', 'Bu Niken', '2024-11-27 02:13:11'),
(3, 'keluar', 'testing', '2024-11-27 04:02:06'),
(4, 'masuk', 'Retur Stokis Banjarnegara', '2024-11-27 04:10:24'),
(5, 'keluar', 'kirim ke pak rio', '2024-11-27 04:19:53'),
(6, 'keluar', 'bu niken', '2024-11-27 04:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_stok`
--

CREATE TABLE `transaksi_stok` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis_transaksi` enum('masuk','keluar') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text,
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_transaksi_master` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_stok`
--

INSERT INTO `transaksi_stok` (`id_transaksi`, `id_barang`, `jenis_transaksi`, `jumlah`, `keterangan`, `waktu`, `id_transaksi_master`) VALUES
(34, 7, 'keluar', 2, NULL, '2024-11-27 09:13:11', 2),
(35, 8, 'keluar', 2, '', '2024-11-27 09:28:12', 2),
(36, 8, 'keluar', 5, NULL, '2024-11-27 11:02:06', 3),
(37, 7, 'keluar', 5, NULL, '2024-11-27 11:02:06', 3),
(38, 7, 'masuk', 20, 'Retur Stokis Banjarnegara', '2024-11-27 11:15:06', 4),
(39, 8, 'masuk', 15, 'Retur Stokis Banjarnegara', '2024-11-27 11:10:24', 4),
(40, 7, 'keluar', 2, 'kirim ke pak rio', '2024-11-27 11:19:53', 5),
(41, 7, 'keluar', 4, 'bu niken', '2024-11-27 11:40:48', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `shipping_labels`
--
ALTER TABLE `shipping_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_master` (`id_transaksi_master`);

--
-- Indexes for table `transaksi_master`
--
ALTER TABLE `transaksi_master`
  ADD PRIMARY KEY (`id_transaksi_master`);

--
-- Indexes for table `transaksi_stok`
--
ALTER TABLE `transaksi_stok`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_labels`
--
ALTER TABLE `shipping_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transaksi_master`
--
ALTER TABLE `transaksi_master`
  MODIFY `id_transaksi_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_stok`
--
ALTER TABLE `transaksi_stok`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipping_labels`
--
ALTER TABLE `shipping_labels`
  ADD CONSTRAINT `fk_transaksi_master` FOREIGN KEY (`id_transaksi_master`) REFERENCES `transaksi_master` (`id_transaksi_master`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_stok`
--
ALTER TABLE `transaksi_stok`
  ADD CONSTRAINT `transaksi_stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
