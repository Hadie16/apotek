-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2024 at 04:18 AM
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
-- Database: `mahabbah`
--

-- --------------------------------------------------------

--
-- Table structure for table `alkes`
--

CREATE TABLE `alkes` (
  `id_alkes` int(11) NOT NULL,
  `kode_alkes` varchar(255) NOT NULL,
  `gambar_alkes` varchar(255) NOT NULL,
  `nama_alkes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alkes`
--

INSERT INTO `alkes` (`id_alkes`, `kode_alkes`, `gambar_alkes`, `nama_alkes`) VALUES
(2, 'ALK-2023-0001', '64d3a9cf8061c.png', 'Masker Non-Medis Disposable 3 Ply 50 Pieces'),
(3, 'ALK-2023-0002', '64d3aa556a318.png', 'Safety Thermometer Digital MC-201'),
(4, 'ALK-2023-0003', '64d3aae676ac8.png', 'Safe Glove Latex Examination Gloves Powdered Size S 100 Pieces'),
(5, 'ALK-2023-0004', '64d9a764ce3a2.png', 'Hansaplast Kain Elastis Mix 10 Lembar'),
(6, 'ALK-2023-0005', '64d9a817a2019.png', 'Betadine Skin Cleanser Antiseptic 100 ml');

-- --------------------------------------------------------

--
-- Table structure for table `cek_kesehatan`
--

CREATE TABLE `cek_kesehatan` (
  `id_cek_kesehatan` int(11) NOT NULL,
  `kode_cek_kesehatan` varchar(255) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tanggal_cek_kesehatan` date NOT NULL,
  `status` enum('Proses','Selesai') NOT NULL,
  `total_biaya` decimal(30,0) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `id_ttk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cek_kesehatan`
--

INSERT INTO `cek_kesehatan` (`id_cek_kesehatan`, `kode_cek_kesehatan`, `id_pasien`, `tanggal_cek_kesehatan`, `status`, `total_biaya`, `catatan`, `id_ttk`) VALUES
(1, 'CKS-2023-0001', 44, '2023-08-14', 'Selesai', 40000, 'Acak', 2),
(2, 'CKS-2023-0002', 45, '2023-08-14', 'Selesai', 30000, '-', 2),
(3, 'CKS-2023-0003', 43, '2023-08-14', 'Selesai', 10000, '-', 2),
(4, 'CKS-2023-0004', 42, '2023-08-14', 'Selesai', 10000, '-', 2),
(5, 'CKS-2023-0005', 44, '2023-08-14', 'Proses', 20000, '-', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_cek_kesehatan`
--

CREATE TABLE `detail_cek_kesehatan` (
  `id_detail_cek_kesehatan` int(11) NOT NULL,
  `id_cek_kesehatan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `biaya` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_cek_kesehatan`
--

INSERT INTO `detail_cek_kesehatan` (`id_detail_cek_kesehatan`, `id_cek_kesehatan`, `id_kategori`, `nilai`, `biaya`) VALUES
(1, 1, 1, 20, 10000),
(2, 1, 2, 30, 10000),
(3, 1, 3, 20, 20000),
(4, 2, 0, 3.14, 0),
(5, 2, 2, 12, 10000),
(6, 2, 3, 12, 20000),
(7, 3, 0, 3.14, 0),
(8, 3, 2, 25, 10000),
(9, 3, 0, 3.14, 0),
(10, 4, 0, 3.14, 0),
(11, 4, 2, 30, 10000),
(12, 4, 0, 3.14, 0),
(13, 5, 0, 3.14, 0),
(14, 5, 0, 3.14, 0),
(15, 5, 3, 3.14, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penerimaan_alkes`
--

CREATE TABLE `detail_penerimaan_alkes` (
  `id_detail_penerimaan_alkes` int(11) NOT NULL,
  `id_penerimaan_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `jumlah_detail_penerimaan_alkes` int(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `harga_detail_penerimaan_alkes` decimal(30,0) NOT NULL,
  `sub_total` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penerimaan_alkes`
--

INSERT INTO `detail_penerimaan_alkes` (`id_detail_penerimaan_alkes`, `id_penerimaan_alkes`, `id_alkes`, `jumlah_detail_penerimaan_alkes`, `satuan`, `tanggal_kadaluarsa`, `batch_number`, `harga_detail_penerimaan_alkes`, `sub_total`) VALUES
(8, 9, 2, 50, 'Box', '2025-01-01', 'EQ20231', 50000, 2500000),
(9, 10, 4, 50, 'Box', '2025-01-01', 'EQ20232', 50000, 2500000),
(10, 11, 5, 30, 'Pack', '2025-01-01', 'EQ20233', 5000, 150000),
(11, 12, 6, 40, 'Botol', '2025-01-01', 'EQ20239', 40000, 1600000),
(12, 13, 3, 20, 'Unit', '2030-01-01', 'EQ202333', 25000, 500000),
(13, 17, 2, 1, 'Box', '2024-05-10', 'h', 0, 0),
(14, 18, 3, 1, 'Unit', '2024-05-10', 'k', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penerimaan_obat`
--

CREATE TABLE `detail_penerimaan_obat` (
  `id_detail_penerimaan_obat` int(11) NOT NULL,
  `id_penerimaan_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_detail_penerimaan_obat` int(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `harga_detail_penerimaan_obat` decimal(30,0) NOT NULL,
  `sub_total` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penerimaan_obat`
--

INSERT INTO `detail_penerimaan_obat` (`id_detail_penerimaan_obat`, `id_penerimaan_obat`, `id_obat`, `jumlah_detail_penerimaan_obat`, `satuan`, `tanggal_kadaluarsa`, `batch_number`, `harga_detail_penerimaan_obat`, `sub_total`) VALUES
(1, 1, 11, 100, 'Pcs', '2025-01-01', 'MED6891', 3000, 300000),
(2, 2, 10, 10, 'Box', '2023-09-09', '1', 2000, 20000),
(3, 2, 8, 10, 'Pcs', '2023-09-09', '2', 3000, 30000),
(4, 3, 7, 200, 'Box', '2023-09-09', '33', 40000, 8000000),
(5, 6, 7, 20, 'Box', '2023-09-08', '222', 20000, 400000),
(6, 7, 8, 100, 'Pcs', '2023-08-22', '2', 2000, 200000),
(7, 8, 10, 400, 'Pcs', '2023-08-30', '22', 1000, 400000),
(8, 9, 10, 400, 'Pcs', '2023-08-25', '22', 100, 40000),
(9, 10, 10, 400, 'Pcs', '2023-09-01', '3', 3000, 1200000),
(10, 11, 10, 400, 'Pcs', '2023-09-01', '3', 3000, 1200000),
(11, 12, 10, 400, 'Pcs', '2023-09-01', '3', 3000, 1200000),
(12, 13, 10, 400, 'Pcs', '2023-09-01', '3', 3000, 1200000),
(13, 14, 10, 400, 'Pcs', '2023-09-01', '111', 1000, 400000),
(14, 15, 10, 400, 'Pcs', '2023-08-25', '11', 1000, 400000),
(15, 16, 7, 100, 'Pcs', '2023-08-26', '11', 11, 1100),
(16, 17, 9, 30, 'Pcs', '2023-09-08', '3', 3, 90),
(17, 18, 7, 33, 'Pcs', '2023-09-07', '111', 111, 3663),
(18, 19, 7, 33, 'Pcs', '2023-09-07', '1', 1, 33),
(19, 20, 7, 33, 'Pcs', '2023-09-07', '1', 1, 33),
(20, 21, 8, 20, 'Box', '2023-09-08', '1', 1, 20),
(21, 22, 7, 10, 'Box', '2023-09-01', '1', 1, 10),
(22, 23, 7, 10, 'Box', '2023-08-31', '1', 1, 10),
(23, 24, 7, 10, 'Box', '2023-08-25', '1', 1, 10),
(24, 25, 7, 10, 'Box', '2023-08-24', '1', 1, 10),
(25, 26, 7, 10, 'Box', '2023-09-06', '7', 8, 80),
(26, 27, 7, 10, 'Box', '2023-09-07', '3', 3, 30),
(27, 28, 7, 111, 'Botol', '2023-09-05', '1', 1, 111),
(28, 29, 7, 30, 'Box', '2024-01-01', 'MN20231', 50000, 1500000),
(29, 30, 8, 30, 'Box', '2024-01-01', 'MN20232', 40000, 1200000),
(30, 31, 11, 30, 'Box', '2024-01-01', 'MN20233', 30000, 900000),
(31, 32, 9, 30, 'Box', '2024-01-01', 'MN20234', 40000, 1200000),
(32, 33, 10, 30, 'Box', '2024-01-01', 'MN20236', 50000, 1500000),
(33, 42, 7, 5, 'Box', '2023-11-03', 'fffse', 1000, 5000),
(34, 43, 11, 20, 'Sachet', '2025-10-10', '222gg', 0, 0),
(35, 44, 11, 20, 'Sachet', '2025-10-10', '222gg', 0, 0),
(37, 46, 7, 2, 'box', '2023-12-08', 'weww', 0, 0),
(38, 47, 9, 1, 'Strip', '2024-04-03', 'h', 0, 0),
(39, 48, 9, 1, 'Strip', '2024-05-07', 'h', 0, 0),
(40, 49, 7, 2, 'box', '2024-06-27', 'j', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan_alkes`
--

CREATE TABLE `detail_pengadaan_alkes` (
  `id_detail_pengadaan_alkes` int(11) NOT NULL,
  `id_pengadaan_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_pengadaan_alkes`
--

INSERT INTO `detail_pengadaan_alkes` (`id_detail_pengadaan_alkes`, `id_pengadaan_alkes`, `id_alkes`, `jumlah`, `satuan`) VALUES
(7, 7, 2, 50, 'Box'),
(8, 8, 4, 50, 'Box'),
(9, 9, 5, 30, 'Pack'),
(10, 10, 6, 40, 'Botol'),
(11, 11, 3, 20, 'Unit'),
(12, 12, 2, 20, 'Box');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan_obat`
--

CREATE TABLE `detail_pengadaan_obat` (
  `id_detail_pengadaan_obat` int(11) NOT NULL,
  `id_pengadaan_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_pengadaan_obat`
--

INSERT INTO `detail_pengadaan_obat` (`id_detail_pengadaan_obat`, `id_pengadaan_obat`, `id_obat`, `jumlah`, `satuan`) VALUES
(20, 18, 7, 30, 'Box'),
(21, 19, 8, 30, 'Box'),
(22, 20, 11, 30, 'Box'),
(23, 21, 9, 30, 'Box'),
(24, 22, 10, 30, 'Box'),
(25, 23, 7, 5, 'Box'),
(26, 24, 7, 10, 'Box');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_alkes`
--

CREATE TABLE `detail_penjualan_alkes` (
  `id_detail_penjualan_alkes` int(11) NOT NULL,
  `id_penjualan_alkes` int(11) NOT NULL,
  `id_stok_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `jumlah_detail_penjualan_alkes` int(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_detail_penjualan_alkes` decimal(30,0) NOT NULL,
  `total_harga_detail_penjualan_alkes` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penjualan_alkes`
--

INSERT INTO `detail_penjualan_alkes` (`id_detail_penjualan_alkes`, `id_penjualan_alkes`, `id_stok_alkes`, `id_alkes`, `jumlah_detail_penjualan_alkes`, `satuan`, `harga_detail_penjualan_alkes`, `total_harga_detail_penjualan_alkes`) VALUES
(1, 1, 2, 2, 5, 'Box', 55000, 275000),
(2, 2, 3, 3, 2, 'Unit', 30000, 60000),
(3, 3, 4, 4, 8, 'Box', 55000, 440000),
(4, 4, 5, 5, 2, 'Pack', 6000, 12000),
(5, 5, 6, 6, 4, 'Botol', 43000, 172000),
(6, 6, 2, 2, 10, 'Box', 55000, 550000),
(7, 7, 2, 2, 11, 'Box', 55000, 605000),
(8, 8, 2, 2, 4, 'Box', 55000, 220000),
(9, 9, 2, 2, 3, 'Box', 55000, 165000),
(10, 10, 6, 6, 1, 'Botol', 43000, 43000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_obat`
--

CREATE TABLE `detail_penjualan_obat` (
  `id_detail_penjualan_obat` int(11) NOT NULL,
  `id_penjualan_obat` int(11) NOT NULL,
  `id_stok_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_detail_penjualan_obat` int(255) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_detail_penjualan_obat` decimal(30,0) NOT NULL,
  `total_harga_detail_penjualan_obat` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penjualan_obat`
--

INSERT INTO `detail_penjualan_obat` (`id_detail_penjualan_obat`, `id_penjualan_obat`, `id_stok_obat`, `id_obat`, `jumlah_detail_penjualan_obat`, `satuan`, `harga_detail_penjualan_obat`, `total_harga_detail_penjualan_obat`) VALUES
(2, 2, 2, 7, 5, 'Strip', 6000, 30000),
(3, 3, 3, 8, 6, 'Strip', 5000, 30000),
(4, 4, 4, 9, 7, 'Strip', 5000, 35000),
(5, 5, 5, 10, 8, 'Strip', 6000, 48000),
(6, 6, 6, 11, 12, 'Sachet', 2500, 30000),
(7, 7, 2, 7, 10, 'Strip', 6000, 60000),
(8, 8, 7, 11, 1, 'Sachet', 2000, 2000),
(9, 9, 7, 11, 1, 'Sachet', 2000, 2000),
(10, 10, 8, 11, 1, 'Sachet', 2000, 2000),
(11, 11, 9, 11, 2, 'Sachet', 2000, 4000),
(12, 12, 9, 11, 1, 'Sachet', 2000, 2000),
(13, 13, 5, 10, 4, 'Strip', 6000, 24000),
(14, 14, 5, 10, 2, 'Strip', 6000, 12000),
(15, 15, 5, 10, 1, 'Strip', 6000, 6000),
(16, 16, 5, 10, 2, 'Strip', 6000, 12000),
(17, 17, 5, 10, 2, 'Strip', 6000, 12000),
(18, 18, 5, 10, 1, 'Strip', 6000, 6000),
(19, 19, 5, 10, 1, 'Strip', 6000, 6000),
(20, 20, 5, 10, 1, 'Strip', 6000, 6000),
(21, 21, 9, 11, 2, 'Sachet', 2000, 4000),
(22, 22, 11, 11, 32, 'Sachet', 2000, 64000),
(23, 23, 11, 11, 22, 'Sachet', 2000, 44000),
(24, 24, 11, 11, 21, 'Sachet', 2000, 42000),
(25, 25, 11, 11, 22, 'Sachet', 2000, 44000),
(26, 26, 7, 7, 6, 'Strip', 6000, 36000),
(27, 27, 11, 11, 1, 'Sachet', 2000, 2000),
(28, 28, 11, 11, 2, 'Sachet', 2000, 4000),
(29, 29, 11, 11, 1, 'Sachet', 2000, 2000),
(30, 30, 7, 7, 1, 'Strip', 6000, 6000),
(31, 31, 11, 11, 1, 'Sachet', 2000, 2000),
(32, 32, 7, 7, 1, 'Strip', 6000, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_alkes`
--

CREATE TABLE `detail_retur_alkes` (
  `id_detail_retur_alkes` int(11) NOT NULL,
  `id_retur_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `batch_number` varchar(40) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `value` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_retur_alkes`
--

INSERT INTO `detail_retur_alkes` (`id_detail_retur_alkes`, `id_retur_alkes`, `id_alkes`, `jumlah`, `satuan`, `batch_number`, `tanggal_kadaluarsa`, `value`) VALUES
(30, 7, 6, 1, 'Botol', 'EQ20239', '2025-01-01', 40000),
(31, 8, 2, 1, 'Box', 'EQ20231', '2025-01-01', 50000),
(33, 10, 2, 1, 'Box', 'EQ20231', '2025-01-01', 50000),
(46, 9, 4, 1, 'Box', 'EQ20232', '2025-01-01', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_retur_obat`
--

CREATE TABLE `detail_retur_obat` (
  `id_detail_retur_obat` int(11) NOT NULL,
  `id_retur_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `batch_number` varchar(40) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `value` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_retur_obat`
--

INSERT INTO `detail_retur_obat` (`id_detail_retur_obat`, `id_retur_obat`, `id_obat`, `jumlah`, `satuan`, `batch_number`, `tanggal_kadaluarsa`, `value`) VALUES
(40, 16, 7, 2, 'box', 'MN20231', '2024-01-01', 5000),
(60, 12, 11, 1, 'Sachet', 'MN20233', '2024-01-01', 1500),
(62, 17, 7, 3, 'box', 'MN20231', '2025-01-01', 5000),
(63, 18, 9, 1, 'Strip', 'MN20234', '2024-01-01', 4000),
(64, 19, 10, 1, 'Strip', 'MN20236', '2024-01-01', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_cek_kesehatan`
--

CREATE TABLE `kategori_cek_kesehatan` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  `biaya_kategori` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_cek_kesehatan`
--

INSERT INTO `kategori_cek_kesehatan` (`id_kategori`, `kode_kategori`, `nama_kategori`, `biaya_kategori`) VALUES
(1, 'KTG-CGD-1', 'Cek Gula Darah', 10000),
(2, 'KTG-CAU-2', 'Cek Asam Urat', 10000),
(3, 'KTG-CKL-3', 'Cek Kolesterol', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `ketersediaan_alkes`
--

CREATE TABLE `ketersediaan_alkes` (
  `id_ketersediaan_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `box` int(11) NOT NULL,
  `jumlah_ketersediaan_alkes` int(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_beli_alkes` decimal(10,0) NOT NULL,
  `tanggal_kadaluarsa_alkes` date NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ketersediaan_alkes`
--

INSERT INTO `ketersediaan_alkes` (`id_ketersediaan_alkes`, `id_alkes`, `box`, `jumlah_ketersediaan_alkes`, `satuan`, `harga_beli_alkes`, `tanggal_kadaluarsa_alkes`, `batch_number`, `id_supplier`) VALUES
(2, 2, 0, 1, 'Box', 50000, '2025-01-01', 'EQ20231', 1),
(3, 4, 0, 9, 'Box', 50000, '2025-01-01', 'EQ20232', 2),
(4, 5, 0, 3, 'Pack', 5000, '2025-01-01', 'EQ20233', 1),
(5, 6, 0, 42, 'Botol', 40000, '2025-01-01', 'EQ20239', 2),
(6, 3, 0, 5, 'Unit', 25000, '2030-01-01', 'EQ202333', 2),
(7, 3, 0, 1, 'Unit', 25000, '2024-05-10', 'k', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ketersediaan_obat`
--

CREATE TABLE `ketersediaan_obat` (
  `id_ketersediaan_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `box` int(11) NOT NULL,
  `jumlah_ketersediaan_obat` int(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_beli_obat` decimal(10,0) NOT NULL,
  `tanggal_kadaluarsa_obat` date NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ketersediaan_obat`
--

INSERT INTO `ketersediaan_obat` (`id_ketersediaan_obat`, `id_obat`, `box`, `jumlah_ketersediaan_obat`, `satuan`, `harga_beli_obat`, `tanggal_kadaluarsa_obat`, `batch_number`, `id_supplier`) VALUES
(18, 7, 38, 350, 'Strip', 5000, '2025-01-01', 'MN20231', 1),
(19, 8, 3, 30, 'Strip', 4000, '2024-01-01', 'MN20232', 2),
(20, 11, 0, 78, 'Sachet', 1500, '2024-01-01', 'MN20233', 2),
(21, 9, 0, 46, 'Strip', 4000, '2024-01-01', 'MN20234', 1),
(22, 10, 0, 24, 'Strip', 5000, '2024-01-01', 'MN20236', 1),
(24, 11, 0, 30, 'Sachet', 1000, '2025-10-10', '222gg', 1),
(25, 9, 0, 2, 'Strip', 4000, '2023-11-03', '121wssx', 1),
(26, 7, 2, 20, 'strip', 5000, '2023-12-08', 'weww', 1),
(27, 9, 0, 1, 'Strip', 4000, '2024-04-03', 'h', 1),
(28, 9, 0, 1, 'Strip', 4000, '2024-05-07', 'h', 1),
(29, 7, 0, 2, 'box', 5000, '2024-06-27', 'j', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `kode_obat` varchar(30) NOT NULL,
  `gambar_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `sediaan_obat` varchar(255) NOT NULL,
  `jenis_obat` varchar(255) NOT NULL,
  `kategori_obat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `kode_obat`, `gambar_obat`, `nama_obat`, `sediaan_obat`, `jenis_obat`, `kategori_obat`) VALUES
(7, 'OBT-2023-0001', '64d3a34031bb5.png', 'Paracetamol 500 mg 10 Kaplet', 'Tablet', 'Analgesik', 'Obat Bebas'),
(8, 'OBT-2023-0002', '64d3a52e5e538.png', 'Ibuprofen 200 mg 10 Tablet', 'Tablet', 'Anti-inflamasi', 'Obat Bebas Terbatas'),
(9, 'OBT-2023-0003', '64d3a69f78f67.png', 'Cetirizine 10 mg 10 Tablet', 'Tablet', 'Antihistamin', 'Obat Keras'),
(10, 'OBT-2023-0004', '64d3a73a3da62.png', 'Loratadine 10 mg 10 Tablet', 'Tablet', 'Antihistamin', 'Obat Keras'),
(11, 'OBT-2023-0005', '64d3a859bd4f8.png', 'Entrostop Anak Sirup 10 ml', 'Obat Cair', 'Obat tidur', 'Obat Herbal Terstandar (OHT)');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `kode_pasien` varchar(30) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat_pasien` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kode_pasien`, `nama_pasien`, `jenis_kelamin`, `alamat_pasien`, `tanggal_lahir`, `no_telepon`) VALUES
(42, 'PSN-2023-0001', 'Alme Kosvic', 'Perempuan', 'Rome', '2000-08-01', '085243378611'),
(43, 'PSN-2023-0002', 'Seroph Sastin', 'Laki-laki', 'Zagreb', '2000-08-01', '081322222231'),
(44, 'PSN-2023-0003', 'Merly Saposh', 'Perempuan', 'Banjarmasin', '2000-01-01', '08525237894'),
(45, 'PSN-2023-0004', 'Vivid Jena', 'Perempuan', 'Banjarbaru', '2002-02-02', '085259878822');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_alkes`
--

CREATE TABLE `penerimaan_alkes` (
  `id_penerimaan_alkes` int(11) NOT NULL,
  `kode_penerimaan_alkes` varchar(255) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_penerimaan_alkes` date NOT NULL,
  `total_harga` decimal(30,0) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penerimaan_alkes`
--

INSERT INTO `penerimaan_alkes` (`id_penerimaan_alkes`, `kode_penerimaan_alkes`, `no_faktur`, `tanggal_penerimaan_alkes`, `total_harga`, `id_supplier`) VALUES
(9, 'PNMS-2023-00001', 'NF2108-456', '2023-08-14', 2500000, 1),
(10, 'PNMS-2023-00000', 'NF2108-457', '2023-08-14', 2500000, 2),
(11, 'PNMS-2023-00000', 'NF2108-458', '2023-08-14', 150000, 1),
(12, 'PNMS-2023-00000', 'NF2108-4511', '2023-08-14', 1600000, 2),
(13, 'PNMS-2023-00000', 'NF2108-4533', '2023-08-14', 500000, 2),
(14, 'PNMS-2024-0000', 'NF2108-457', '2024-04-07', 0, 2),
(15, 'PNMS-2024-0000', 'NF2108-457', '2024-04-07', 0, 2),
(16, 'PNMS-2024-0001', 'NF2108-456', '2024-04-07', 0, 2),
(17, 'PNMS-2024-0000', 'NF2108-456', '2024-04-30', 0, 1),
(18, 'PNMS-2024-0000', 'NF2108-457', '2024-04-30', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_obat`
--

CREATE TABLE `penerimaan_obat` (
  `id_penerimaan_obat` int(11) NOT NULL,
  `kode_penerimaan_obat` varchar(255) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_penerimaan_obat` date NOT NULL,
  `total_harga` decimal(30,0) NOT NULL,
  `id_supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penerimaan_obat`
--

INSERT INTO `penerimaan_obat` (`id_penerimaan_obat`, `kode_penerimaan_obat`, `no_faktur`, `tanggal_penerimaan_obat`, `total_harga`, `id_supplier`) VALUES
(29, 'PNM-2023-0001', 'NF2108-456', '2023-08-14', 1500000, 2),
(30, 'PNM-2023-0002', 'NF2108-457', '2023-08-14', 1200000, 2),
(31, 'PNM-2023-0003', 'NF2108-458', '2023-08-14', 900000, 2),
(32, 'PNM-2023-0004', 'NF2108-4510', '2023-08-14', 1200000, 2),
(33, 'PNM-2023-0005', 'NF2108-459', '2023-08-14', 1500000, 1),
(40, 'PNM-2023-0007', '111', '2023-10-30', 55555, 1),
(41, 'PNM-2023-0008', 'esferdg', '2023-10-30', 5000, 1),
(42, 'PNM-2023-0008', 'esferdg', '2023-10-30', 5000, 1),
(43, 'PNM-2023-0006', 'RET-2023-0001', '2023-10-30', 0, 1),
(44, 'PNM-2023-0006', 'RET-2023-0001', '2023-10-30', 0, 1),
(46, 'PNM-2023-0010', 'NF2108-4510', '2023-11-06', 0, 1),
(47, 'PNM-2024-0011', 'NF2108-458', '2024-04-07', 0, 1),
(48, 'PNM-2024-0012', 'NF2108-457', '2024-04-29', 0, 1),
(49, 'PNM-2024-0013', 'NF2108-456', '2024-06-11', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_alkes`
--

CREATE TABLE `pengadaan_alkes` (
  `id_pengadaan_alkes` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `jenis_produk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `status` enum('Dipesan','Diterima','Draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengadaan_alkes`
--

INSERT INTO `pengadaan_alkes` (`id_pengadaan_alkes`, `kode`, `jenis_produk`, `tanggal`, `id_supplier`, `status`) VALUES
(5, 'PGDS-2023-0001', 1, '2023-08-12', 2, 'Diterima'),
(7, 'PGDS-2023-0001', 1, '2023-08-14', 1, 'Diterima'),
(8, 'PGDS-2023-0002', 1, '2023-08-14', 2, 'Diterima'),
(9, 'PGDS-2023-0003', 1, '2023-08-14', 1, 'Diterima'),
(10, 'PGDS-2023-0004', 1, '2023-08-14', 2, 'Diterima'),
(11, 'PGDS-2023-0005', 1, '2023-08-14', 2, 'Diterima'),
(12, 'PGDS-2023-0006', 1, '2023-08-14', 2, 'Dipesan');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_obat`
--

CREATE TABLE `pengadaan_obat` (
  `id_pengadaan_obat` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `jenis_produk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `status` enum('Dipesan','Diterima','Draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengadaan_obat`
--

INSERT INTO `pengadaan_obat` (`id_pengadaan_obat`, `kode`, `jenis_produk`, `tanggal`, `id_supplier`, `status`) VALUES
(18, 'PGD-2023-0001', 1, '2023-08-14', 1, 'Diterima'),
(19, 'PGD-2023-0002', 1, '2023-08-14', 2, 'Diterima'),
(20, 'PGD-2023-0003', 1, '2023-08-14', 2, 'Diterima'),
(21, 'PGD-2023-0004', 1, '2023-08-14', 1, 'Diterima'),
(22, 'PGD-2023-0005', 1, '2023-08-14', 1, 'Diterima'),
(23, 'PGD-2023-0006', 1, '2023-08-14', 1, 'Diterima'),
(24, 'PGD-2024-0007', 1, '2024-05-28', 1, 'Dipesan');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_alkes`
--

CREATE TABLE `penjualan_alkes` (
  `id_penjualan_alkes` int(11) NOT NULL,
  `kode_penjualan_alkes` varchar(255) NOT NULL,
  `tanggal_penjualan_alkes` datetime NOT NULL,
  `total_harga` decimal(30,0) NOT NULL,
  `id_ttk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penjualan_alkes`
--

INSERT INTO `penjualan_alkes` (`id_penjualan_alkes`, `kode_penjualan_alkes`, `tanggal_penjualan_alkes`, `total_harga`, `id_ttk`) VALUES
(1, 'PNJS-2023-0001', '2023-08-14 02:44:38', 275000, 2),
(2, 'PNJS-2023-0005', '2023-08-14 02:44:54', 60000, 2),
(3, 'PNJS-2023-0002', '2023-08-14 02:45:11', 440000, 2),
(4, 'PNJS-2023-0003', '2023-08-14 02:45:33', 12000, 2),
(5, 'PNJS-2023-0004', '2023-08-14 02:45:43', 172000, 2),
(6, 'PNJS-2023-0006', '2023-12-02 06:45:06', 550000, 2),
(7, 'PNJS-2024-0007', '2024-05-15 11:43:49', 605000, 2),
(8, 'PNJS-2024-0008', '2024-05-15 11:48:23', 220000, 2),
(9, 'PNJS-2024-0009', '2024-05-15 11:52:59', 165000, 2),
(10, 'PNJS-2024-0010', '2024-05-29 10:20:13', 43000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_obat`
--

CREATE TABLE `penjualan_obat` (
  `id_penjualan_obat` int(11) NOT NULL,
  `kode_penjualan_obat` varchar(255) NOT NULL,
  `tanggal_penjualan_obat` datetime NOT NULL,
  `total_harga` decimal(30,0) NOT NULL,
  `id_ttk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penjualan_obat`
--

INSERT INTO `penjualan_obat` (`id_penjualan_obat`, `kode_penjualan_obat`, `tanggal_penjualan_obat`, `total_harga`, `id_ttk`) VALUES
(2, 'PNJ-2023-0001', '2023-08-14 11:36:01', 30000, 2),
(3, 'PNJ-2023-0002', '2023-08-14 11:38:04', 30000, 2),
(4, 'PNJ-2023-0003', '2023-08-14 11:38:18', 35000, 2),
(5, 'PNJ-2023-0004', '2023-08-14 11:38:27', 48000, 2),
(6, 'PNJ-2023-0005', '2023-08-14 11:38:35', 30000, 2),
(7, 'PNJ-2023-0006', '2023-12-02 06:44:44', 60000, 2),
(8, 'PNJ-2024-0007', '2024-05-12 11:03:31', 2000, 2),
(9, 'PNJ-2024-0008', '2024-05-12 11:11:38', 2000, 2),
(10, 'PNJ-2024-0009', '2024-05-12 11:27:46', 2000, 2),
(11, 'PNJ-2024-0010', '2024-05-12 11:30:00', 4000, 2),
(12, 'PNJ-2024-0011', '2024-05-12 12:15:32', 2000, 2),
(13, 'PNJ-2024-0012', '2024-05-12 12:18:22', 24000, 2),
(14, 'PNJ-2024-0013', '2024-05-12 12:22:17', 12000, 2),
(15, 'PNJ-2024-0014', '2024-05-12 12:23:02', 6000, 2),
(16, 'PNJ-2024-0015', '2024-05-12 12:35:25', 12000, 2),
(17, 'PNJ-2024-0016', '2024-05-12 12:36:00', 12000, 2),
(18, 'PNJ-2024-0017', '2024-05-12 12:42:59', 6000, 2),
(19, 'PNJ-2024-0018', '2024-05-12 12:44:01', 6000, 2),
(20, 'PNJ-2024-0019', '2024-05-12 12:48:59', 6000, 2),
(21, 'PNJ-2024-0020', '2024-05-14 09:56:55', 4000, 2),
(22, 'PNJ-2024-0021', '2024-05-15 10:08:25', 64000, 2),
(23, 'PNJ-2024-0022', '2024-05-15 10:37:53', 44000, 2),
(24, 'PNJ-2024-0023', '2024-05-15 10:42:35', 42000, 2),
(25, 'PNJ-2024-0024', '2024-05-15 10:51:44', 44000, 2),
(26, 'PNJ-2024-0025', '2024-05-15 11:14:53', 36000, 2),
(27, 'PNJ-2024-0026', '2024-05-29 10:06:53', 2000, 2),
(28, 'PNJ-2024-0027', '2024-05-29 10:11:17', 4000, 2),
(29, 'PNJ-2024-0028', '2024-05-29 10:15:37', 2000, 2),
(30, 'PNJ-2024-0029', '2024-05-29 10:16:37', 6000, 2),
(31, 'PNJ-2024-0030', '2024-05-29 10:17:04', 2000, 2),
(32, 'PNJ-2024-0031', '2024-05-29 10:17:36', 6000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `retur_alkes`
--

CREATE TABLE `retur_alkes` (
  `id_retur_alkes` int(11) NOT NULL,
  `kode_retur_alkes` varchar(30) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `no_faktur` varchar(40) NOT NULL,
  `status` enum('Proses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retur_alkes`
--

INSERT INTO `retur_alkes` (`id_retur_alkes`, `kode_retur_alkes`, `id_supplier`, `tanggal_retur`, `no_faktur`, `status`) VALUES
(6, 'RETS-2023-0001', 1, '2023-11-29', 'NF2108-457', 'Proses'),
(7, 'RETS-2023-0000', 2, '2023-11-29', 'NF2108-457', 'Selesai'),
(8, 'RETS-2024-0000', 2, '2024-04-05', 'NF2108-456', 'Selesai'),
(9, 'RETS-2024-0001', 2, '2024-04-17', 'NF2108-457', 'Selesai'),
(10, 'RETS-2024-0000', 1, '2024-04-29', 'NF2108-456', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `retur_obat`
--

CREATE TABLE `retur_obat` (
  `id_retur_obat` int(11) NOT NULL,
  `kode_retur_obat` varchar(30) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `no_faktur` varchar(40) NOT NULL,
  `status` enum('Proses','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retur_obat`
--

INSERT INTO `retur_obat` (`id_retur_obat`, `kode_retur_obat`, `id_supplier`, `tanggal_retur`, `no_faktur`, `status`) VALUES
(12, 'RET-2023-0004', 1, '2023-11-06', 'NF2108-4510', 'Selesai'),
(14, 'RET-2024-0005', 1, '2024-04-05', 'NF2108-458', 'Selesai'),
(15, 'RET-2024-0006', 1, '2024-04-29', 'NF2108-457', 'Selesai'),
(16, 'RET-2024-0007', 1, '2024-04-30', 'NF2108-456', 'Selesai'),
(17, 'RET-2024-0008', 1, '2024-05-25', 'NF2108-457', 'Proses'),
(18, 'RET-2024-0009', 2, '2024-05-29', 'NF2108-457', 'Proses'),
(19, 'RET-2024-0010', 1, '2024-05-29', 'NF2108-457', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `stok_alkes`
--

CREATE TABLE `stok_alkes` (
  `id_stok_alkes` int(11) NOT NULL,
  `id_ketersediaan_alkes` int(11) NOT NULL,
  `id_alkes` int(11) NOT NULL,
  `jumlah_stok_alkes` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_jual_alkes` decimal(30,0) NOT NULL,
  `tanggal_kadaluarsa_alkes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stok_alkes`
--

INSERT INTO `stok_alkes` (`id_stok_alkes`, `id_ketersediaan_alkes`, `id_alkes`, `jumlah_stok_alkes`, `satuan`, `harga_jual_alkes`, `tanggal_kadaluarsa_alkes`) VALUES
(2, 2, 2, 0, 'Box', 55000, '2025-01-01'),
(3, 6, 3, 11, 'Unit', 30000, '2030-01-01'),
(4, 3, 4, 24, 'Box', 55000, '2025-01-01'),
(5, 4, 5, 16, 'Pack', 6000, '2025-01-01'),
(6, 5, 6, 21, 'Botol', 43000, '2025-01-01'),
(7, 2, 2, 0, 'Box', 55000, '2025-01-01'),
(8, 2, 2, 4, 'Box', 55000, '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `stok_obat`
--

CREATE TABLE `stok_obat` (
  `id_stok_obat` int(11) NOT NULL,
  `id_ketersediaan_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_stok_obat` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_jual_obat` decimal(30,0) NOT NULL,
  `tanggal_kadaluarsa_obat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stok_obat`
--

INSERT INTO `stok_obat` (`id_stok_obat`, `id_ketersediaan_obat`, `id_obat`, `jumlah_stok_obat`, `satuan`, `harga_jual_obat`, `tanggal_kadaluarsa_obat`) VALUES
(2, 18, 7, 220, 'Strip', 6000, '2024-01-01'),
(3, 19, 8, 238, 'Strip', 5000, '2024-01-01'),
(4, 21, 9, 236, 'Strip', 5000, '2024-01-01'),
(5, 22, 10, 207, 'Strip', 6000, '2024-01-01'),
(6, 20, 11, 476, 'Sachet', 2500, '2024-01-01'),
(7, 24, 11, 0, 'Sachet', 2000, '2025-10-10'),
(8, 24, 11, 0, 'Sachet', 2000, '2025-10-10'),
(9, 24, 11, 0, 'Sachet', 2000, '2025-10-12'),
(10, 24, 11, 0, 'Sachet', 2000, '2025-10-10'),
(11, 24, 11, 0, 'Sachet', 2000, '2025-10-10'),
(12, 24, 11, 10, 'Sachet', 2000, '2025-10-10'),
(13, 18, 7, 0, 'Strip', 6000, '2025-01-01'),
(14, 18, 7, 2, 'Strip', 6000, '2025-01-01'),
(15, 18, 7, 22, 'Strip', 6000, '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `no_telepon_supplier` varchar(15) NOT NULL,
  `email_supplier` varchar(30) NOT NULL,
  `alamat_supplier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telepon_supplier`, `email_supplier`, `alamat_supplier`) VALUES
(1, 'PT. Bina San Prima', '05116747667', 'bspbjm@binasanprima.com', 'Kota Banjarbaru'),
(2, 'PT. Anugrah Argon Medica', '081314691338', 'care@anugrah-argon.com', 'Banjarmasin');

-- --------------------------------------------------------

--
-- Table structure for table `ttk`
--

CREATE TABLE `ttk` (
  `id_ttk` int(11) NOT NULL,
  `nama_ttk` varchar(30) NOT NULL,
  `telepon_ttk` varchar(15) NOT NULL,
  `email_ttk` varchar(30) NOT NULL,
  `alamat_ttk` varchar(255) NOT NULL,
  `status_ttk` enum('Aktif','Tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ttk`
--

INSERT INTO `ttk` (`id_ttk`, `nama_ttk`, `telepon_ttk`, `email_ttk`, `alamat_ttk`, `status_ttk`) VALUES
(1, 'amero constilla', '089494', 'cons@gmail.com', 'lima', 'Aktif'),
(2, 'belsa aremus', '09383', 'g@gmail.com', 'Madrid', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` varchar(20) NOT NULL,
  `id_ttk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `id_ttk`) VALUES
(19, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator', 2),
(20, 'constila', '11d8c28a64490a987612f2332502467f', 'operator', 1),
(24, 'a', '0cc175b9c0f1b6a831c399e269772661', 'pimpinan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alkes`
--
ALTER TABLE `alkes`
  ADD PRIMARY KEY (`id_alkes`);

--
-- Indexes for table `cek_kesehatan`
--
ALTER TABLE `cek_kesehatan`
  ADD PRIMARY KEY (`id_cek_kesehatan`),
  ADD KEY `id_pasien` (`id_pasien`,`id_ttk`),
  ADD KEY `id_ttk` (`id_ttk`);

--
-- Indexes for table `detail_cek_kesehatan`
--
ALTER TABLE `detail_cek_kesehatan`
  ADD PRIMARY KEY (`id_detail_cek_kesehatan`),
  ADD KEY `id_cek_kesehatan` (`id_cek_kesehatan`,`id_kategori`);

--
-- Indexes for table `detail_penerimaan_alkes`
--
ALTER TABLE `detail_penerimaan_alkes`
  ADD PRIMARY KEY (`id_detail_penerimaan_alkes`),
  ADD KEY `id_penerimaan_alkes` (`id_penerimaan_alkes`,`id_alkes`),
  ADD KEY `id_alkes` (`id_alkes`);

--
-- Indexes for table `detail_penerimaan_obat`
--
ALTER TABLE `detail_penerimaan_obat`
  ADD PRIMARY KEY (`id_detail_penerimaan_obat`),
  ADD KEY `id_penerimaan_obat` (`id_penerimaan_obat`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `detail_pengadaan_alkes`
--
ALTER TABLE `detail_pengadaan_alkes`
  ADD PRIMARY KEY (`id_detail_pengadaan_alkes`),
  ADD KEY `id_pengadaan_alkes` (`id_pengadaan_alkes`,`id_alkes`),
  ADD KEY `id_alkes` (`id_alkes`);

--
-- Indexes for table `detail_pengadaan_obat`
--
ALTER TABLE `detail_pengadaan_obat`
  ADD PRIMARY KEY (`id_detail_pengadaan_obat`),
  ADD KEY `id_pengadaan_obat` (`id_pengadaan_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `detail_penjualan_alkes`
--
ALTER TABLE `detail_penjualan_alkes`
  ADD PRIMARY KEY (`id_detail_penjualan_alkes`),
  ADD KEY `id_penjualan_alkes` (`id_penjualan_alkes`,`id_stok_alkes`,`id_alkes`),
  ADD KEY `id_stok_alkes` (`id_stok_alkes`),
  ADD KEY `id_alkes` (`id_alkes`);

--
-- Indexes for table `detail_penjualan_obat`
--
ALTER TABLE `detail_penjualan_obat`
  ADD PRIMARY KEY (`id_detail_penjualan_obat`),
  ADD KEY `id_penjualan_obat` (`id_penjualan_obat`,`id_stok_obat`,`id_obat`),
  ADD KEY `id_stok_obat` (`id_stok_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `detail_retur_alkes`
--
ALTER TABLE `detail_retur_alkes`
  ADD PRIMARY KEY (`id_detail_retur_alkes`),
  ADD KEY `id_retur_alkes` (`id_retur_alkes`,`id_alkes`),
  ADD KEY `id_alkes` (`id_alkes`);

--
-- Indexes for table `detail_retur_obat`
--
ALTER TABLE `detail_retur_obat`
  ADD PRIMARY KEY (`id_detail_retur_obat`),
  ADD KEY `id_retur_obat` (`id_retur_obat`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `kategori_cek_kesehatan`
--
ALTER TABLE `kategori_cek_kesehatan`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ketersediaan_alkes`
--
ALTER TABLE `ketersediaan_alkes`
  ADD PRIMARY KEY (`id_ketersediaan_alkes`),
  ADD KEY `id_alkes` (`id_alkes`,`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `ketersediaan_obat`
--
ALTER TABLE `ketersediaan_obat`
  ADD PRIMARY KEY (`id_ketersediaan_obat`),
  ADD KEY `id_obat` (`id_obat`,`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `penerimaan_alkes`
--
ALTER TABLE `penerimaan_alkes`
  ADD PRIMARY KEY (`id_penerimaan_alkes`),
  ADD KEY `id_pengadaan_alkes` (`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `penerimaan_obat`
--
ALTER TABLE `penerimaan_obat`
  ADD PRIMARY KEY (`id_penerimaan_obat`),
  ADD KEY `id_pengadaan_obat` (`id_supplier`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `pengadaan_alkes`
--
ALTER TABLE `pengadaan_alkes`
  ADD PRIMARY KEY (`id_pengadaan_alkes`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  ADD PRIMARY KEY (`id_pengadaan_obat`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `penjualan_alkes`
--
ALTER TABLE `penjualan_alkes`
  ADD PRIMARY KEY (`id_penjualan_alkes`),
  ADD KEY `id_ttk` (`id_ttk`);

--
-- Indexes for table `penjualan_obat`
--
ALTER TABLE `penjualan_obat`
  ADD PRIMARY KEY (`id_penjualan_obat`),
  ADD KEY `id_ttk` (`id_ttk`);

--
-- Indexes for table `retur_alkes`
--
ALTER TABLE `retur_alkes`
  ADD PRIMARY KEY (`id_retur_alkes`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `retur_obat`
--
ALTER TABLE `retur_obat`
  ADD PRIMARY KEY (`id_retur_obat`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `stok_alkes`
--
ALTER TABLE `stok_alkes`
  ADD PRIMARY KEY (`id_stok_alkes`),
  ADD KEY `id_ketersediaan_alkes` (`id_ketersediaan_alkes`,`id_alkes`),
  ADD KEY `id_alkes` (`id_alkes`);

--
-- Indexes for table `stok_obat`
--
ALTER TABLE `stok_obat`
  ADD PRIMARY KEY (`id_stok_obat`),
  ADD KEY `id_ketersediaan_obat` (`id_ketersediaan_obat`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `ttk`
--
ALTER TABLE `ttk`
  ADD PRIMARY KEY (`id_ttk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ttk` (`id_ttk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alkes`
--
ALTER TABLE `alkes`
  MODIFY `id_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cek_kesehatan`
--
ALTER TABLE `cek_kesehatan`
  MODIFY `id_cek_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_cek_kesehatan`
--
ALTER TABLE `detail_cek_kesehatan`
  MODIFY `id_detail_cek_kesehatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_penerimaan_alkes`
--
ALTER TABLE `detail_penerimaan_alkes`
  MODIFY `id_detail_penerimaan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_penerimaan_obat`
--
ALTER TABLE `detail_penerimaan_obat`
  MODIFY `id_detail_penerimaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `detail_pengadaan_alkes`
--
ALTER TABLE `detail_pengadaan_alkes`
  MODIFY `id_detail_pengadaan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_pengadaan_obat`
--
ALTER TABLE `detail_pengadaan_obat`
  MODIFY `id_detail_pengadaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_penjualan_alkes`
--
ALTER TABLE `detail_penjualan_alkes`
  MODIFY `id_detail_penjualan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_penjualan_obat`
--
ALTER TABLE `detail_penjualan_obat`
  MODIFY `id_detail_penjualan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `detail_retur_alkes`
--
ALTER TABLE `detail_retur_alkes`
  MODIFY `id_detail_retur_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `detail_retur_obat`
--
ALTER TABLE `detail_retur_obat`
  MODIFY `id_detail_retur_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `kategori_cek_kesehatan`
--
ALTER TABLE `kategori_cek_kesehatan`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ketersediaan_alkes`
--
ALTER TABLE `ketersediaan_alkes`
  MODIFY `id_ketersediaan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ketersediaan_obat`
--
ALTER TABLE `ketersediaan_obat`
  MODIFY `id_ketersediaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `penerimaan_alkes`
--
ALTER TABLE `penerimaan_alkes`
  MODIFY `id_penerimaan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penerimaan_obat`
--
ALTER TABLE `penerimaan_obat`
  MODIFY `id_penerimaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pengadaan_alkes`
--
ALTER TABLE `pengadaan_alkes`
  MODIFY `id_pengadaan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  MODIFY `id_pengadaan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `penjualan_alkes`
--
ALTER TABLE `penjualan_alkes`
  MODIFY `id_penjualan_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan_obat`
--
ALTER TABLE `penjualan_obat`
  MODIFY `id_penjualan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `retur_alkes`
--
ALTER TABLE `retur_alkes`
  MODIFY `id_retur_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `retur_obat`
--
ALTER TABLE `retur_obat`
  MODIFY `id_retur_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stok_alkes`
--
ALTER TABLE `stok_alkes`
  MODIFY `id_stok_alkes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok_obat`
--
ALTER TABLE `stok_obat`
  MODIFY `id_stok_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ttk`
--
ALTER TABLE `ttk`
  MODIFY `id_ttk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cek_kesehatan`
--
ALTER TABLE `cek_kesehatan`
  ADD CONSTRAINT `cek_kesehatan_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `cek_kesehatan_ibfk_2` FOREIGN KEY (`id_ttk`) REFERENCES `ttk` (`id_ttk`);

--
-- Constraints for table `detail_cek_kesehatan`
--
ALTER TABLE `detail_cek_kesehatan`
  ADD CONSTRAINT `detail_cek_kesehatan_ibfk_1` FOREIGN KEY (`id_cek_kesehatan`) REFERENCES `cek_kesehatan` (`id_cek_kesehatan`);

--
-- Constraints for table `detail_penerimaan_alkes`
--
ALTER TABLE `detail_penerimaan_alkes`
  ADD CONSTRAINT `detail_penerimaan_alkes_ibfk_2` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`);

--
-- Constraints for table `detail_penerimaan_obat`
--
ALTER TABLE `detail_penerimaan_obat`
  ADD CONSTRAINT `detail_penerimaan_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Constraints for table `detail_pengadaan_alkes`
--
ALTER TABLE `detail_pengadaan_alkes`
  ADD CONSTRAINT `detail_pengadaan_alkes_ibfk_1` FOREIGN KEY (`id_pengadaan_alkes`) REFERENCES `pengadaan_alkes` (`id_pengadaan_alkes`),
  ADD CONSTRAINT `detail_pengadaan_alkes_ibfk_2` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`);

--
-- Constraints for table `detail_pengadaan_obat`
--
ALTER TABLE `detail_pengadaan_obat`
  ADD CONSTRAINT `detail_pengadaan_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `detail_pengadaan_obat_ibfk_2` FOREIGN KEY (`id_pengadaan_obat`) REFERENCES `pengadaan_obat` (`id_pengadaan_obat`);

--
-- Constraints for table `detail_penjualan_alkes`
--
ALTER TABLE `detail_penjualan_alkes`
  ADD CONSTRAINT `detail_penjualan_alkes_ibfk_1` FOREIGN KEY (`id_detail_penjualan_alkes`) REFERENCES `penjualan_alkes` (`id_penjualan_alkes`),
  ADD CONSTRAINT `detail_penjualan_alkes_ibfk_2` FOREIGN KEY (`id_stok_alkes`) REFERENCES `stok_alkes` (`id_stok_alkes`),
  ADD CONSTRAINT `detail_penjualan_alkes_ibfk_3` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`);

--
-- Constraints for table `detail_penjualan_obat`
--
ALTER TABLE `detail_penjualan_obat`
  ADD CONSTRAINT `detail_penjualan_obat_ibfk_1` FOREIGN KEY (`id_penjualan_obat`) REFERENCES `penjualan_obat` (`id_penjualan_obat`),
  ADD CONSTRAINT `detail_penjualan_obat_ibfk_2` FOREIGN KEY (`id_stok_obat`) REFERENCES `stok_obat` (`id_stok_obat`),
  ADD CONSTRAINT `detail_penjualan_obat_ibfk_3` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Constraints for table `detail_retur_alkes`
--
ALTER TABLE `detail_retur_alkes`
  ADD CONSTRAINT `detail_retur_alkes_ibfk_1` FOREIGN KEY (`id_retur_alkes`) REFERENCES `retur_alkes` (`id_retur_alkes`),
  ADD CONSTRAINT `detail_retur_alkes_ibfk_2` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`);

--
-- Constraints for table `detail_retur_obat`
--
ALTER TABLE `detail_retur_obat`
  ADD CONSTRAINT `detail_retur_obat_ibfk_1` FOREIGN KEY (`id_retur_obat`) REFERENCES `retur_obat` (`id_retur_obat`),
  ADD CONSTRAINT `detail_retur_obat_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Constraints for table `ketersediaan_alkes`
--
ALTER TABLE `ketersediaan_alkes`
  ADD CONSTRAINT `ketersediaan_alkes_ibfk_1` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`),
  ADD CONSTRAINT `ketersediaan_alkes_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `ketersediaan_obat`
--
ALTER TABLE `ketersediaan_obat`
  ADD CONSTRAINT `ketersediaan_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `ketersediaan_obat_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penerimaan_alkes`
--
ALTER TABLE `penerimaan_alkes`
  ADD CONSTRAINT `penerimaan_alkes_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penerimaan_obat`
--
ALTER TABLE `penerimaan_obat`
  ADD CONSTRAINT `penerimaan_obat_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  ADD CONSTRAINT `pengadaan_obat_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penjualan_alkes`
--
ALTER TABLE `penjualan_alkes`
  ADD CONSTRAINT `penjualan_alkes_ibfk_1` FOREIGN KEY (`id_ttk`) REFERENCES `ttk` (`id_ttk`);

--
-- Constraints for table `penjualan_obat`
--
ALTER TABLE `penjualan_obat`
  ADD CONSTRAINT `penjualan_obat_ibfk_1` FOREIGN KEY (`id_ttk`) REFERENCES `ttk` (`id_ttk`);

--
-- Constraints for table `retur_alkes`
--
ALTER TABLE `retur_alkes`
  ADD CONSTRAINT `retur_alkes_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `retur_obat`
--
ALTER TABLE `retur_obat`
  ADD CONSTRAINT `retur_obat_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `stok_alkes`
--
ALTER TABLE `stok_alkes`
  ADD CONSTRAINT `stok_alkes_ibfk_1` FOREIGN KEY (`id_alkes`) REFERENCES `alkes` (`id_alkes`);

--
-- Constraints for table `stok_obat`
--
ALTER TABLE `stok_obat`
  ADD CONSTRAINT `stok_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_ttk`) REFERENCES `ttk` (`id_ttk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
