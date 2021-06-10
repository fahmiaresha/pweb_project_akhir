-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 07:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan_order_supplier`
--

CREATE TABLE `catatan_order_supplier` (
  `ID_CATATAN_ORDER_SUPPLIER` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `TANGGAL_CATATAN_ORDER_SUPPLIER` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DESKRIPSI_CATATAN_ORDER_SUPPLIER` text NOT NULL,
  `STATUS_ORDER_SUPPLIER` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_order_supplier`
--

INSERT INTO `catatan_order_supplier` (`ID_CATATAN_ORDER_SUPPLIER`, `ID_SUPPLIER`, `TANGGAL_CATATAN_ORDER_SUPPLIER`, `DESKRIPSI_CATATAN_ORDER_SUPPLIER`, `STATUS_ORDER_SUPPLIER`) VALUES
(1, 1, '2021-01-20 04:10:45', '1 Karung Ban Dalam Uk.20', 1),
(2, 4, '2020-11-28 13:19:25', '1 Karung Ban Dalam Uk.26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_pre_order_pelanggan`
--

CREATE TABLE `catatan_pre_order_pelanggan` (
  `ID_CATATAN_PRE_ORDER_PELANGGAN` int(11) NOT NULL,
  `ID_PELANGGAN` int(11) NOT NULL,
  `DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN` text NOT NULL,
  `TANGGAL_CATATAN_PRE_ORDER_PELANGGAN` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS_PRE_ORDER` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_pre_order_pelanggan`
--

INSERT INTO `catatan_pre_order_pelanggan` (`ID_CATATAN_PRE_ORDER_PELANGGAN`, `ID_PELANGGAN`, `DESKRIPSI_CATATAN_PRE_ODER_PELANGGAN`, `TANGGAL_CATATAN_PRE_ORDER_PELANGGAN`, `STATUS_PRE_ORDER`) VALUES
(5, 7, 'Ban dalam Uk.26', '2021-01-20 03:51:41', 1),
(6, 7, 'Tempat duduk Uk.20', '2020-11-25 05:35:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penerimaan_barang`
--

CREATE TABLE `detail_penerimaan_barang` (
  `ID_DETAIL_PENERIMAAN_BARANG` int(11) NOT NULL,
  `ID_PENERIMAAN_BARANG` int(11) NOT NULL,
  `ID_PRODUK` int(11) NOT NULL,
  `JUMLAH_PRODUK_DITERIMA` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `TANGGAL_PEMBELIAN_PRODUK` varchar(200) NOT NULL,
  `ID_KATEGORI_PRODUK` int(11) NOT NULL,
  `STOK_LAMA_PRODUK` int(11) NOT NULL,
  `STOK_BARU_PRODUK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penerimaan_barang`
--

INSERT INTO `detail_penerimaan_barang` (`ID_DETAIL_PENERIMAAN_BARANG`, `ID_PENERIMAAN_BARANG`, `ID_PRODUK`, `JUMLAH_PRODUK_DITERIMA`, `ID_SUPPLIER`, `TANGGAL_PEMBELIAN_PRODUK`, `ID_KATEGORI_PRODUK`, `STOK_LAMA_PRODUK`, `STOK_BARU_PRODUK`) VALUES
(17, 1, 2, 5, 1, '11-10-20 12:00 AM', 5, 48, 53),
(18, 1, 4, 2, 1, '11-10-20 12:00 AM', 7, 5010, 5012),
(19, 1, 16, 3, 1, '23-12-20 12:00 AM', 8, 6, 9),
(20, 2, 3, 4, 4, '12-10-20 12:00 AM', 6, 5, 9),
(21, 2, 15, 3, 4, '20-12-20 12:00 AM', 5, 92, 95),
(22, 2, 17, 3, 4, '23-12-20 12:00 AM', 8, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `ID_PRODUK` int(11) NOT NULL,
  `ID_PENJUALAN` int(11) NOT NULL,
  `HARGA_PRODUK` double NOT NULL,
  `JUMLAH_PRODUK` int(11) NOT NULL,
  `TOTAL_HARGA_PRODUK` double NOT NULL,
  `TANGGAL_PENJUALAN` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`ID_PRODUK`, `ID_PENJUALAN`, `HARGA_PRODUK`, `JUMLAH_PRODUK`, `TOTAL_HARGA_PRODUK`, `TANGGAL_PENJUALAN`) VALUES
(2, 1, 30000, 1, 30000, '2020-12-17'),
(2, 2, 25000, 1, 25000, '2020-12-17'),
(2, 3, 25000, 10, 250000, '2020-12-17'),
(2, 6, 30000, 1, 30000, '2020-12-18'),
(2, 7, 25000, 1, 25000, '2020-12-18'),
(2, 8, 25000, 1, 25000, '2020-12-20'),
(2, 10, 25000, 2, 50000, '2020-12-22'),
(2, 14, 30000, 1, 30000, '2021-01-06'),
(2, 17, 30000, 1, 30000, '2021-01-20'),
(2, 18, 30000, 1, 30000, '2021-01-23'),
(2, 19, 30000, 1, 30000, '2021-01-23'),
(2, 20, 30000, 1, 30000, '2021-01-24'),
(2, 22, 30000, 10, 300000, '2021-01-28'),
(3, 1, 60000, 1, 60000, '2020-12-17'),
(3, 2, 52000, 1, 52000, '2020-12-17'),
(3, 4, 60000, 3, 180000, '2020-12-17'),
(3, 5, 60000, 2, 120000, '2020-12-18'),
(3, 7, 52000, 1, 52000, '2020-12-18'),
(3, 11, 60000, 1, 60000, '2020-12-30'),
(3, 14, 60000, 1, 60000, '2021-01-06'),
(3, 17, 60000, 1, 60000, '2021-01-20'),
(3, 18, 60000, 1, 60000, '2021-01-23'),
(3, 19, 60000, 1, 60000, '2021-01-23'),
(3, 20, 60000, 1, 60000, '2021-01-24'),
(3, 21, 52000, 1, 52000, '2021-01-24'),
(3, 22, 60000, 1, 60000, '2021-01-28'),
(4, 1, 5000, 1, 5000, '2020-12-17'),
(4, 12, 5000, 4, 20000, '2021-01-06'),
(4, 14, 5000, 1, 5000, '2021-01-06'),
(4, 15, 5000, 6, 30000, '2021-01-06'),
(4, 22, 5000, 1, 5000, '2021-01-28'),
(15, 9, 15000, 2, 30000, '2020-12-20'),
(15, 13, 15000, 2, 30000, '2021-01-06'),
(15, 14, 20000, 1, 20000, '2021-01-06'),
(15, 16, 20000, 1, 20000, '2021-01-15'),
(15, 22, 20000, 1, 20000, '2021-01-28'),
(16, 13, 17000, 2, 34000, '2021-01-06'),
(16, 14, 25000, 1, 25000, '2021-01-06'),
(16, 22, 25000, 1, 25000, '2021-01-28'),
(17, 14, 25000, 1, 25000, '2021-01-06');

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `update_stok_barang` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE produk SET STOK_PRODUK=STOK_PRODUK-NEW.JUMLAH_PRODUK
WHERE ID_PRODUK=NEW.ID_PRODUK;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_produk`
--

CREATE TABLE `history_produk` (
  `ID_HISTORY_PRODUK` int(11) NOT NULL,
  `TANGGAL_PEMBELIAN_PRODUK` varchar(200) NOT NULL,
  `ID_KATEGORI_PRODUK` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `NAMA_PRODUK` varchar(20) NOT NULL,
  `STOK_PRODUK` int(11) NOT NULL,
  `HARGA_BELI_PRODUK` double NOT NULL,
  `HARGA_JUAL_RESELLER_PRODUK` double NOT NULL,
  `HARGA_JUAL_PELANGGAN_PRODUK` double NOT NULL,
  `DESKRIPSI_PRODUK` varchar(200) NOT NULL,
  `TANGGAL_DIUBAH` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_PEGAWAI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_produk`
--

INSERT INTO `history_produk` (`ID_HISTORY_PRODUK`, `TANGGAL_PEMBELIAN_PRODUK`, `ID_KATEGORI_PRODUK`, `ID_SUPPLIER`, `NAMA_PRODUK`, `STOK_PRODUK`, `HARGA_BELI_PRODUK`, `HARGA_JUAL_RESELLER_PRODUK`, `HARGA_JUAL_PELANGGAN_PRODUK`, `DESKRIPSI_PRODUK`, `TANGGAL_DIUBAH`, `ID_PEGAWAI`) VALUES
(1, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 30, 25000, 30000, 35000, '-', '2021-01-23 13:27:44', 1),
(2, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 50, 20000, 25000, 30000, '-', '2021-01-23 13:47:31', 1),
(3, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 53, 20000, 25000, 30000, '-', '2021-01-26 03:35:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `history_sebelum_perubahan_produk`
--

CREATE TABLE `history_sebelum_perubahan_produk` (
  `ID` int(11) NOT NULL,
  `TANGGAL_PEMBELIAN_PRODUK` varchar(200) NOT NULL,
  `ID_KATEGORI_PRODUK` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `NAMA_PRODUK` varchar(200) NOT NULL,
  `STOK_PRODUK` int(11) NOT NULL,
  `HARGA_BELI_PRODUK` double NOT NULL,
  `HARGA_JUAL_RESELLER_PRODUK` double NOT NULL,
  `HARGA_JUAL_PELANGGAN_PRODUK` double NOT NULL,
  `DESKRIPSI_PRODUK` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_sebelum_perubahan_produk`
--

INSERT INTO `history_sebelum_perubahan_produk` (`ID`, `TANGGAL_PEMBELIAN_PRODUK`, `ID_KATEGORI_PRODUK`, `ID_SUPPLIER`, `NAMA_PRODUK`, `STOK_PRODUK`, `HARGA_BELI_PRODUK`, `HARGA_JUAL_RESELLER_PRODUK`, `HARGA_JUAL_PELANGGAN_PRODUK`, `DESKRIPSI_PRODUK`) VALUES
(1, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 25, 25000, 30000, 35000, '-'),
(2, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 30, 25000, 30000, 35000, '-'),
(3, '11-10-20 12:00 AM', 5, 1, 'Kenda Uk.26', 53, 20000, 25000, 30000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `ID_JABATAN` int(11) NOT NULL,
  `NAMA_JABATAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`ID_JABATAN`, `NAMA_JABATAN`) VALUES
(1, 'Owner'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pelanggan`
--

CREATE TABLE `kategori_pelanggan` (
  `ID_KATEGORI_PELANGGAN` int(11) NOT NULL,
  `NAMA_KATEGORI_PELANGGAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pelanggan`
--

INSERT INTO `kategori_pelanggan` (`ID_KATEGORI_PELANGGAN`, `NAMA_KATEGORI_PELANGGAN`) VALUES
(1, 'Reseller'),
(2, 'Non-Reseller');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `ID_KATEGORI_PRODUK` int(11) NOT NULL,
  `NAMA_KATEGORI_PRODUK` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`ID_KATEGORI_PRODUK`, `NAMA_KATEGORI_PRODUK`) VALUES
(5, 'Ban Dalam'),
(6, 'Ban Luar'),
(7, 'Service'),
(8, 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_nota_supplier`
--

CREATE TABLE `laporan_nota_supplier` (
  `ID_LAPORAN_NOTA_SUPPLIER` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `TANGGAL_LAPORAN_NOTA_SUPPLIER` date NOT NULL,
  `TOTAL_NOTA_LUNAS_BAYAR` double NOT NULL,
  `TOTAL_NOTA_BELUM_BAYAR` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_penjualan`
--

CREATE TABLE `laporan_penjualan` (
  `ID_LAPORAN` int(11) NOT NULL,
  `TANGGAL_LAPORAN` date NOT NULL,
  `TOTAL_PENJUALAN_LAPORAN` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nota_supplier`
--

CREATE TABLE `nota_supplier` (
  `ID_NOTA_SUPLIER` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `NOMOR_NOTA_SUPPLIER` varchar(15) NOT NULL DEFAULT '-',
  `TOTAL_BAYAR_NOTA_SUPPLIER` double NOT NULL,
  `FOTO_NOTA_SUPPLIER` varchar(255) NOT NULL,
  `STATUS_NOTA_SUPPLIER` tinyint(1) DEFAULT 0,
  `TANGGAL_NOTA_SUPPLIER` timestamp NOT NULL DEFAULT current_timestamp(),
  `TANGGAL_NOTA_DATANG` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_supplier`
--

INSERT INTO `nota_supplier` (`ID_NOTA_SUPLIER`, `ID_SUPPLIER`, `NOMOR_NOTA_SUPPLIER`, `TOTAL_BAYAR_NOTA_SUPPLIER`, `FOTO_NOTA_SUPPLIER`, `STATUS_NOTA_SUPPLIER`, `TANGGAL_NOTA_SUPPLIER`, `TANGGAL_NOTA_DATANG`) VALUES
(23, 1, 'TM0827', 15000000, '1611878725_Screenshot (8).png', 1, '2021-01-29 00:05:25', '2021-01-29'),
(24, 4, 'TMK008', 10000000, '1611879137_Screenshot (43).png', 1, '2021-01-29 00:12:17', '2021-01-29'),
(25, 4, 'TK9007', 5000000, '1611879286_Screenshot (101).png', 0, '2021-01-29 00:14:46', '2021-01-27'),
(26, 1, 'TMK084', 12500000, '1611879330_Screenshot (116).png', 0, '2021-01-29 00:15:30', '2021-01-29'),
(27, 4, 'TM7523', 5000000, '1611879387_Screenshot (75).png', 1, '2021-01-29 00:16:27', '2021-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `ID_NOTIFIKASI` int(11) NOT NULL,
  `DESKRIPSI_NOTIFIKASI` text NOT NULL,
  `TANGGAL_NOTIFIKASI` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('areshafahm@gmail.com', '$2y$10$hEwwqyR9buSj.vefCWRfMO9PV9HMFER6OKapaSftYMowj4oxZOFPG', '2020-12-23 04:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_PELANGGAN` int(11) NOT NULL,
  `ID_KATEGORI_PELANGGAN` int(11) NOT NULL,
  `NAMA_PELANGGAN` varchar(50) NOT NULL,
  `ALAMAT_PELANGGAN` varchar(300) DEFAULT '-',
  `TELP_PELANGGAN` varchar(12) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_PELANGGAN`, `ID_KATEGORI_PELANGGAN`, `NAMA_PELANGGAN`, `ALAMAT_PELANGGAN`, `TELP_PELANGGAN`) VALUES
(1, 2, 'Umum', 'Sidoarjo', NULL),
(7, 2, 'Zudi Hardiansyah', 'Sidoarjo', '085986435643'),
(9, 1, 'Fahmi Aresha', 'Sidoarjo', '089634656688'),
(13, 2, 'Gabriel', 'Surabaya', NULL),
(24, 2, 't', NULL, NULL),
(25, 1, 'test', NULL, NULL),
(26, 1, 'test', '123', NULL),
(27, 2, 'aresha', 'sby', NULL),
(28, 2, 'aresha2', 'aresha2', NULL),
(29, 2, 'z', 'z', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `ID_PENERIMAAN_BARANG` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `NOMOR_NOTA` varchar(20) NOT NULL,
  `TANGGAL_PENERIMAAN_BARANG` timestamp NOT NULL DEFAULT current_timestamp(),
  `TANGGAL_NOTA` varchar(250) NOT NULL,
  `FOTO_NOTA` varchar(255) DEFAULT NULL,
  `TOTAL_PENERIMAAN_BARANG` int(11) NOT NULL,
  `CATATAN_PENERIMAAN_BARANG` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`ID_PENERIMAAN_BARANG`, `ID_USER`, `NOMOR_NOTA`, `TANGGAL_PENERIMAAN_BARANG`, `TANGGAL_NOTA`, `FOTO_NOTA`, `TOTAL_PENERIMAAN_BARANG`, `CATATAN_PENERIMAAN_BARANG`) VALUES
(1, 1, 'TM0857', '2021-01-26 02:48:49', '26-1-21 12:00 AM', '1611629329_Screenshot (1).png', 10, NULL),
(2, 1, 'TMK008', '2021-01-26 02:49:25', '26-1-21 12:00 AM', '', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_PENJUALAN` int(11) NOT NULL,
  `ID_USER` int(11) UNSIGNED DEFAULT NULL,
  `ID_PELANGGAN` int(11) DEFAULT NULL,
  `KATEGORI_PELANGGAN_PENJUALAN` int(11) NOT NULL,
  `TANGGAL_PENJUALAN` timestamp NULL DEFAULT current_timestamp(),
  `TANGGAL_PENJUALAN_ASLI` date NOT NULL DEFAULT current_timestamp(),
  `TOTAL_PENJUALAN` double NOT NULL,
  `CASH_PELANGGAN` double NOT NULL,
  `CHANGE_PELANGGAN` double NOT NULL,
  `CATATAN_PENJUALAN` text DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`ID_PENJUALAN`, `ID_USER`, `ID_PELANGGAN`, `KATEGORI_PELANGGAN_PENJUALAN`, `TANGGAL_PENJUALAN`, `TANGGAL_PENJUALAN_ASLI`, `TOTAL_PENJUALAN`, `CASH_PELANGGAN`, `CHANGE_PELANGGAN`, `CATATAN_PENJUALAN`) VALUES
(1, 1, 1, 2, '2020-12-17 01:46:52', '2020-12-17', 95000, 100000, 5000, NULL),
(2, 1, 1, 1, '2020-12-17 01:47:15', '2020-12-17', 77000, 400000, 323000, NULL),
(3, 1, 1, 1, '2020-12-17 01:49:08', '2020-12-17', 250000, 500000, 250000, NULL),
(4, 1, 1, 2, '2020-12-17 01:49:33', '2020-12-17', 180000, 400000, 220000, NULL),
(5, 1, 1, 2, '2020-12-18 12:01:09', '2020-12-18', 120000, 120000, 0, NULL),
(6, 1, 1, 2, '2020-12-18 12:05:18', '2020-12-18', 30000, 50000, 20000, NULL),
(7, 1, 1, 1, '2020-12-18 12:18:17', '2020-12-18', 77000, 150000, 73000, NULL),
(8, 1, 1, 1, '2020-12-20 10:24:22', '2020-12-20', 25000, 100000, 75000, NULL),
(9, 1, 1, 1, '2020-12-20 10:29:59', '2020-12-20', 30000, 50000, 20000, NULL),
(10, 1, 1, 1, '2020-12-22 13:14:53', '2020-12-22', 50000, 80000, 30000, NULL),
(11, 1, 1, 2, '2020-12-30 06:50:20', '2020-12-30', 60000, 100000, 40000, NULL),
(12, 1, 1, 2, '2021-01-06 03:49:04', '2021-01-06', 20000, 50000, 30000, NULL),
(13, 16, 1, 1, '2021-01-06 07:28:33', '2021-01-06', 64000, 120000, 56000, NULL),
(14, 16, 1, 2, '2021-01-06 08:47:00', '2021-01-06', 165000, 400000, 235000, NULL),
(15, 1, 1, 2, '2021-01-06 08:53:35', '2021-01-06', 30000, 80000, 50000, NULL),
(16, 1, 1, 2, '2021-01-15 11:44:16', '2021-01-15', 20000, 100000, 80000, NULL),
(17, 1, 1, 2, '2021-01-20 03:59:29', '2021-01-20', 90000, 400000, 310000, NULL),
(18, 1, 13, 2, '2021-01-23 15:43:04', '2021-01-23', 90000, 400000, 310000, NULL),
(19, 1, 28, 2, '2021-01-23 15:44:21', '2021-01-23', 90000, 400000, 310000, NULL),
(20, 1, 13, 2, '2021-01-24 09:36:43', '2021-01-24', 90000, 100000, 10000, NULL),
(21, 1, 9, 1, '2021-01-24 10:32:32', '2021-01-24', 52000, 400000, 348000, NULL),
(22, 1, 1, 2, '2021-01-28 10:47:13', '2021-01-28', 410000, 4000000, 3590000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID_PRODUK` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `ID_KATEGORI_PRODUK` int(11) NOT NULL,
  `TANGGAL_PEMBELIAN_PRODUK` text NOT NULL,
  `NAMA_PRODUK` varchar(40) NOT NULL,
  `STOK_PRODUK` int(11) NOT NULL,
  `HARGA_BELI_PRODUK` double NOT NULL,
  `HARGA_JUAL_RESELLER_PRODUK` double NOT NULL,
  `HARGA_JUAL_PELANGGAN_PRODUK` double NOT NULL,
  `DESKRIPSI_PRODUK` text DEFAULT '',
  `FOTO_PRODUK` varchar(200) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_PRODUK`, `ID_SUPPLIER`, `ID_KATEGORI_PRODUK`, `TANGGAL_PEMBELIAN_PRODUK`, `NAMA_PRODUK`, `STOK_PRODUK`, `HARGA_BELI_PRODUK`, `HARGA_JUAL_RESELLER_PRODUK`, `HARGA_JUAL_PELANGGAN_PRODUK`, `DESKRIPSI_PRODUK`, `FOTO_PRODUK`) VALUES
(2, 1, 5, '11-10-20 12:00 AM', 'Kenda Uk.26', 43, 20000, 25000, 30000, '-', '1611632145_Screenshot (8).png'),
(3, 4, 6, '12-10-20 12:00 AM', 'Swallow Uk.20', 8, 45000, 52000, 60000, '-', '1608459047_Screenshot (9).png'),
(4, 1, 7, '11-10-20 12:00 AM', 'Service', 5011, 0, 5000, 5000, '-', '1608459032_Capture-2.PNG'),
(15, 4, 5, '20-12-20 12:00 AM', 'Kenda Uk.12', 94, 10000, 15000, 20000, NULL, '1608460125_Screenshot (27).png'),
(16, 1, 8, '23-12-20 12:00 AM', 'Lampu depan', 8, 10000, 17000, 25000, '-', '1608726690_Screenshot (22).png'),
(17, 4, 8, '23-12-20 12:00 AM', 'Lampu belakang', 8, 15000, 20000, 25000, '-', '1608726786_Screenshot (77).png'),
(19, 4, 8, '26-1-21 12:00 AM', 'Jok', 100, 30000, 45000, 60000, NULL, '1611632263_Screenshot (33).png');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ID_PELANGGAN` int(11) DEFAULT 0,
  `ID_SERVICE` int(11) NOT NULL,
  `NAMA_SEPEDA_SERVICE` varchar(200) DEFAULT NULL,
  `DESKRIPSI_SERVICE` text NOT NULL,
  `TANGGAL_SERVICE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS_SERVICE` tinyint(1) NOT NULL DEFAULT 0,
  `PEGAWAI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ID_PELANGGAN`, `ID_SERVICE`, `NAMA_SEPEDA_SERVICE`, `DESKRIPSI_SERVICE`, `TANGGAL_SERVICE`, `STATUS_SERVICE`, `PEGAWAI`) VALUES
(7, 9, 'Wim Cycle Uk.20', 'Ganti ban dalam dan ban luar.', '2021-01-06 03:31:04', 0, 1),
(1, 10, 'Polygon Uk.26', 'Ganti tempat duduk', '2021-01-06 03:31:11', 0, 16),
(7, 13, 'Wim Cycle Uk.16', 'Ganti tempat duduk', '2021-01-06 03:39:36', 1, 1),
(9, 15, 'Wim Cycle Uk.12', 'Ganti ban dalam', '2021-01-06 03:47:45', 1, 1),
(7, 16, 'Polygon Uk.24', 'Ganti ban luar', '2021-01-06 03:46:35', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` int(11) NOT NULL,
  `NAMA_SUPPLIER` varchar(40) NOT NULL,
  `ALAMAT_SUPPLIER` varchar(100) NOT NULL,
  `NAMA_PEMASOK_BARANG` text NOT NULL,
  `TELP_SUPPLIER` varchar(12) DEFAULT NULL,
  `EMAIL_SUPPLIER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `NAMA_SUPPLIER`, `ALAMAT_SUPPLIER`, `NAMA_PEMASOK_BARANG`, `TELP_SUPPLIER`, `EMAIL_SUPPLIER`) VALUES
(1, 'Toko Mekar Jaya', 'Surabaya', 'Ban Dalam', '08577123123', 'mekarjaya@gmail.com'),
(4, 'Toko Mulia', 'Sidoarjo', 'Ban Luar', '0893241232', 'tokomulia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `update_stok`
--

CREATE TABLE `update_stok` (
  `id_update_stok` bigint(20) NOT NULL,
  `waktu_update_stok` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_supplier` varchar(255) NOT NULL,
  `tanggal_pembelian_produk` varchar(255) NOT NULL,
  `stok_saat_ini` int(11) NOT NULL,
  `stok_ditambah` int(11) NOT NULL,
  `stok_total` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `kategori_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `update_stok`
--

INSERT INTO `update_stok` (`id_update_stok`, `waktu_update_stok`, `nama_supplier`, `tanggal_pembelian_produk`, `stok_saat_ini`, `stok_ditambah`, `stok_total`, `nama_produk`, `nama_user`, `kategori_produk`) VALUES
(7, '2021-01-05 05:09:14', '4', '12-10-20 12:00 AM', 7, 3, 10, '3', '1', '6'),
(8, '2021-01-06 02:36:33', '1', '11-10-20 12:00 AM', 5000, 10, 5010, '4', '1', '7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ID_JABATAN` int(11) NOT NULL,
  `telp_user` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_user` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_akun` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ID_JABATAN`, `telp_user`, `alamat_user`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status_akun`) VALUES
(1, 1, '089634656688', 'Sidoarjo', 'Fahmi', 'areshafahm@gmail.com', NULL, '$2y$10$SeihTVHor1AixLFilqnjLOCYwitmshozJrnzOSy1VzVCpEVkfXb1y', 'SmaRexY3wu4tTgGkva5pMmq2xUreu94XXMl27jiKBljhBIB2qKtGNseD5BGz', '2020-11-21 23:22:02', '2020-11-22 00:18:44', 1),
(16, 2, '0858123123', 'Surabaya', 'Sater', 'sateronly@gmail.com', NULL, '$2y$10$u0KJ/1jZTHoCR4l0jRi8hujv0oFt4eOyXgi8YbZM1m8rXSGZc4Qjq', 'Lb7DrMvfxY7VFXEDTZnvYIwBTi44I9EsHMEc0XDtFRSYCIPZ56dbqDFurSGK', NULL, '2021-01-19 20:39:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp`
--

CREATE TABLE `whatsapp` (
  `ID_WHATSAPP` int(11) NOT NULL,
  `TANGGAL_WHATSAPP` timestamp NULL DEFAULT current_timestamp(),
  `NO_WHATSAPP` varchar(15) NOT NULL,
  `PESAN_WHATSAPP` text NOT NULL,
  `KATEGORI_WHATSAPP` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `whatsapp`
--

INSERT INTO `whatsapp` (`ID_WHATSAPP`, `TANGGAL_WHATSAPP`, `NO_WHATSAPP`, `PESAN_WHATSAPP`, `KATEGORI_WHATSAPP`) VALUES
(9, '2020-11-28 13:18:19', '085986435643', 'Ban Dalam Uk.26 Ready', 'Pelanggan'),
(10, '2020-11-28 13:19:25', '0893241232', '1 Karung Ban Dalam Uk.26', 'Supplier'),
(12, '2020-12-10 08:14:57', '089634656688', 'hgh', 'Pelanggan'),
(13, '2021-01-20 03:51:42', '085986435643', 'Ban dalam Uk.26', 'Pelanggan'),
(14, '2021-01-20 04:10:45', '08577123123', '1 Karung Ban Dalam Uk.20', 'Supplier'),
(15, '2021-01-22 03:27:55', '085986435643', 'Ban dalam Uk.26', 'Pelanggan'),
(16, '2021-01-22 03:28:25', '089634656688', 'Tempat duduk Uk.20', 'Pelanggan'),
(17, '2021-01-22 03:33:31', '089634656688', '123', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan_order_supplier`
--
ALTER TABLE `catatan_order_supplier`
  ADD PRIMARY KEY (`ID_CATATAN_ORDER_SUPPLIER`),
  ADD KEY `FK_MEMILIKI123123` (`ID_SUPPLIER`);

--
-- Indexes for table `catatan_pre_order_pelanggan`
--
ALTER TABLE `catatan_pre_order_pelanggan`
  ADD PRIMARY KEY (`ID_CATATAN_PRE_ORDER_PELANGGAN`),
  ADD KEY `FK_MEMILIKI412` (`ID_PELANGGAN`);

--
-- Indexes for table `detail_penerimaan_barang`
--
ALTER TABLE `detail_penerimaan_barang`
  ADD PRIMARY KEY (`ID_DETAIL_PENERIMAAN_BARANG`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`ID_PRODUK`,`ID_PENJUALAN`),
  ADD KEY `FK_MEMILIKI1231235` (`ID_PENJUALAN`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_produk`
--
ALTER TABLE `history_produk`
  ADD PRIMARY KEY (`ID_HISTORY_PRODUK`);

--
-- Indexes for table `history_sebelum_perubahan_produk`
--
ALTER TABLE `history_sebelum_perubahan_produk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`ID_JABATAN`);

--
-- Indexes for table `kategori_pelanggan`
--
ALTER TABLE `kategori_pelanggan`
  ADD PRIMARY KEY (`ID_KATEGORI_PELANGGAN`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`ID_KATEGORI_PRODUK`);

--
-- Indexes for table `laporan_nota_supplier`
--
ALTER TABLE `laporan_nota_supplier`
  ADD PRIMARY KEY (`ID_LAPORAN_NOTA_SUPPLIER`),
  ADD KEY `FK_MEMILIKI412123` (`ID_SUPPLIER`);

--
-- Indexes for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  ADD PRIMARY KEY (`ID_LAPORAN`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota_supplier`
--
ALTER TABLE `nota_supplier`
  ADD PRIMARY KEY (`ID_NOTA_SUPLIER`),
  ADD KEY `FK_TERDAPAT2313` (`ID_SUPPLIER`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`ID_NOTIFIKASI`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_PELANGGAN`),
  ADD KEY `FK_MEMILIKI22123` (`ID_KATEGORI_PELANGGAN`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`ID_PENERIMAAN_BARANG`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_PENJUALAN`),
  ADD KEY `FK_TERDAPAT1231` (`ID_PELANGGAN`),
  ADD KEY `FK_ID_USER` (`ID_USER`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_PRODUK`),
  ADD KEY `FK_MEMILIKI123` (`ID_SUPPLIER`),
  ADD KEY `FK_TERDAPAT` (`ID_KATEGORI_PRODUK`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID_SERVICE`),
  ADD KEY `FK_MEMILIKI12312344` (`ID_PELANGGAN`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- Indexes for table `update_stok`
--
ALTER TABLE `update_stok`
  ADD PRIMARY KEY (`id_update_stok`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_jabatan1223123` (`ID_JABATAN`);

--
-- Indexes for table `whatsapp`
--
ALTER TABLE `whatsapp`
  ADD PRIMARY KEY (`ID_WHATSAPP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan_order_supplier`
--
ALTER TABLE `catatan_order_supplier`
  MODIFY `ID_CATATAN_ORDER_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `catatan_pre_order_pelanggan`
--
ALTER TABLE `catatan_pre_order_pelanggan`
  MODIFY `ID_CATATAN_PRE_ORDER_PELANGGAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_penerimaan_barang`
--
ALTER TABLE `detail_penerimaan_barang`
  MODIFY `ID_DETAIL_PENERIMAAN_BARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_produk`
--
ALTER TABLE `history_produk`
  MODIFY `ID_HISTORY_PRODUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history_sebelum_perubahan_produk`
--
ALTER TABLE `history_sebelum_perubahan_produk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `ID_JABATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_pelanggan`
--
ALTER TABLE `kategori_pelanggan`
  MODIFY `ID_KATEGORI_PELANGGAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `ID_KATEGORI_PRODUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan_nota_supplier`
--
ALTER TABLE `laporan_nota_supplier`
  MODIFY `ID_LAPORAN_NOTA_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_penjualan`
--
ALTER TABLE `laporan_penjualan`
  MODIFY `ID_LAPORAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nota_supplier`
--
ALTER TABLE `nota_supplier`
  MODIFY `ID_NOTA_SUPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `ID_NOTIFIKASI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_PELANGGAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  MODIFY `ID_PENERIMAAN_BARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `ID_PENJUALAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ID_PRODUK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ID_SERVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `update_stok`
--
ALTER TABLE `update_stok`
  MODIFY `id_update_stok` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `whatsapp`
--
ALTER TABLE `whatsapp`
  MODIFY `ID_WHATSAPP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan_order_supplier`
--
ALTER TABLE `catatan_order_supplier`
  ADD CONSTRAINT `FK_MEMILIKI123123` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`);

--
-- Constraints for table `catatan_pre_order_pelanggan`
--
ALTER TABLE `catatan_pre_order_pelanggan`
  ADD CONSTRAINT `FK_MEMILIKI412` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `FK_MEMILIKI1231234` FOREIGN KEY (`ID_PRODUK`) REFERENCES `produk` (`ID_PRODUK`),
  ADD CONSTRAINT `FK_MEMILIKI1231235` FOREIGN KEY (`ID_PENJUALAN`) REFERENCES `penjualan` (`ID_PENJUALAN`);

--
-- Constraints for table `laporan_nota_supplier`
--
ALTER TABLE `laporan_nota_supplier`
  ADD CONSTRAINT `FK_MEMILIKI412123` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`);

--
-- Constraints for table `nota_supplier`
--
ALTER TABLE `nota_supplier`
  ADD CONSTRAINT `FK_TERDAPAT2313` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `FK_MEMILIKI22123` FOREIGN KEY (`ID_KATEGORI_PELANGGAN`) REFERENCES `kategori_pelanggan` (`ID_KATEGORI_PELANGGAN`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_TERDAPAT1231` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `FK_MEMILIKI123` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`),
  ADD CONSTRAINT `FK_TERDAPAT` FOREIGN KEY (`ID_KATEGORI_PRODUK`) REFERENCES `kategori_produk` (`ID_KATEGORI_PRODUK`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_MEMILIKI12312344` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_jabatan1223123` FOREIGN KEY (`ID_JABATAN`) REFERENCES `jabatan` (`ID_JABATAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
