-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 07:04 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengajuan_redhunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `satuan`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Laptop', 34, 'laptop', NULL, '2020-10-19 00:40:30', '2020-11-01 19:29:45'),
(3, 'Sepatu', 34, 'sepatu', NULL, '2020-10-19 21:05:49', '2020-10-19 21:05:49'),
(4, 'Air Mineral', 44, 'air-mineral', NULL, '2020-10-19 21:06:26', '2020-11-01 19:29:53'),
(5, 'Sendal', 34, 'sendal', NULL, '2020-10-20 23:11:23', '2020-10-20 23:11:23'),
(6, 'Gergaji', 34, 'gergaji', NULL, '2020-11-01 19:27:19', '2020-11-01 19:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `child_menu`
--

CREATE TABLE `child_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_menu` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_menu`
--

INSERT INTO `child_menu` (`id`, `url`, `icon`, `id_menu`, `created_at`, `updated_at`, `description`, `deleted_at`) VALUES
(5, '/coba/coba', 'fal fa-laptop', 12, '2020-02-18 19:15:27', '2020-02-26 21:07:49', 'Coba aja', '2020-02-26 21:07:49'),
(6, '/mencoba-child', 'fal fa-file', 13, '2020-02-25 19:52:53', '2020-02-26 21:06:08', 'Mencoba', '2020-02-26 21:06:08'),
(7, '/abis', 'fal fa-save', 13, '2020-02-25 19:52:53', '2020-02-26 21:06:08', 'abis', '2020-02-26 21:06:08'),
(8, '/laporan-dasar', 'fal fa-file', 16, '2020-02-26 21:32:03', '2020-02-26 21:48:10', 'Laporan Dasar', '2020-02-26 21:48:10'),
(9, '/laporan-dua', 'fal fa-file', 16, '2020-02-26 21:32:03', '2020-02-26 21:48:10', 'Laporan 3', '2020-02-26 21:48:10'),
(10, '/laporan-satu', 'fal fa-file', 17, '2020-02-26 21:52:37', '2020-10-21 00:46:46', 'Laporan satu', '2020-10-21 00:46:46'),
(11, '/laporan-dua', 'fal fa-file', 17, '2020-02-26 21:52:37', '2020-10-21 00:46:46', 'Laporan dua', '2020-10-21 00:46:46');

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
-- Table structure for table `inventoris`
--

CREATE TABLE `inventoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_lantai` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `foto` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lantais`
--

CREATE TABLE `lantais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lantai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lantais`
--

INSERT INTO `lantais` (`id`, `lantai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lantai 1', '2020-11-04 02:59:18', '2020-11-04 22:55:19', '2020-11-04 22:55:19'),
(2, 'xsdvs', '2020-11-04 20:02:17', '2020-11-04 20:02:21', '2020-11-04 20:02:21'),
(3, 'cxv', '2020-11-04 20:02:29', '2020-11-04 20:02:36', '2020-11-04 20:02:36'),
(4, 'xvxc', '2020-11-04 20:02:33', '2020-11-04 22:55:22', '2020-11-04 22:55:22'),
(5, 'Lantai 1', '2020-11-05 02:42:10', '2020-11-05 02:42:10', NULL),
(6, 'Lantai 2', '2020-11-05 02:42:23', '2020-11-05 02:42:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE `master_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Status Pernikahan', '2020-02-12 02:57:38', '2020-10-21 00:47:22', '2020-10-21 00:47:22'),
(4, 'Jabatan', '2020-02-12 08:30:59', '2020-02-12 08:30:59', NULL),
(5, 'Roles', '2020-02-12 21:16:36', '2020-02-12 21:16:36', NULL),
(6, 'Negara', '2020-02-26 21:04:47', '2020-02-26 21:05:07', '2020-02-26 21:05:07'),
(7, 'Hewan', '2020-02-26 21:50:57', '2020-10-21 00:47:17', '2020-10-21 00:47:17'),
(8, 'Kelas', '2020-03-02 19:18:05', '2020-03-02 19:18:05', NULL),
(9, 'Satuan Barang', '2020-10-18 22:14:55', '2020-10-18 22:14:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_data_detail`
--

CREATE TABLE `master_data_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_master_data` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_data_detail`
--

INSERT INTO `master_data_detail` (`id`, `description`, `id_master_data`, `created_at`, `updated_at`, `deleted_at`) VALUES
(16, 'Janda', 3, '2020-02-12 20:53:07', '2020-10-21 00:47:22', '2020-10-21 00:47:22'),
(17, 'Duda', 3, '2020-02-12 20:53:07', '2020-10-21 00:47:22', '2020-10-21 00:47:22'),
(18, 'Lajang', 3, '2020-02-12 20:53:07', '2020-10-21 00:47:22', '2020-10-21 00:47:22'),
(19, 'Menikah', 3, '2020-02-12 20:53:07', '2020-10-21 00:47:22', '2020-10-21 00:47:22'),
(21, 'Programmer', 4, '2020-02-12 21:15:55', '2020-02-12 21:15:55', NULL),
(22, 'Admin', 5, '2020-02-12 21:16:36', '2020-10-18 22:18:24', '2020-10-18 22:18:24'),
(23, 'Developer', 5, '2020-02-12 21:16:36', '2020-02-12 21:16:36', NULL),
(25, 'Users', 5, '2020-02-26 21:04:15', '2020-10-18 22:18:24', '2020-10-18 22:18:24'),
(26, 'Indonesia', 6, '2020-02-26 21:04:47', '2020-02-26 21:05:07', '2020-02-26 21:05:07'),
(27, 'Malaysia', 6, '2020-02-26 21:04:47', '2020-02-26 21:05:07', '2020-02-26 21:05:07'),
(28, 'Hewan Air', 7, '2020-02-26 21:50:57', '2020-10-21 00:47:17', '2020-10-21 00:47:17'),
(29, 'Hewan Laut', 7, '2020-02-26 21:50:57', '2020-10-21 00:47:17', '2020-10-21 00:47:17'),
(30, 'Management', 5, '2020-02-26 23:03:49', '2020-02-26 23:03:49', NULL),
(31, 'Android Development', 8, '2020-03-02 19:18:05', '2020-03-02 19:18:05', NULL),
(32, 'Web Development', 8, '2020-03-02 19:18:05', '2020-03-02 19:18:05', NULL),
(33, 'Game Development', 8, '2020-03-02 19:18:05', '2020-03-02 19:18:05', NULL),
(34, 'PCS', 9, '2020-10-18 22:14:55', '2020-10-18 22:14:55', NULL),
(35, 'Lusin', 9, '2020-10-18 22:14:55', '2020-10-18 22:14:55', NULL),
(36, 'Finance', 5, '2020-10-18 22:18:24', '2020-10-18 22:18:24', NULL),
(37, 'HRD', 5, '2020-10-18 22:18:24', '2020-10-18 22:18:24', NULL),
(38, 'Marketing', 5, '2020-10-18 22:18:24', '2020-10-18 22:18:24', NULL),
(39, 'Training', 5, '2020-10-18 22:18:24', '2020-10-18 22:18:24', NULL),
(40, 'GA', 5, '2020-10-18 22:18:24', '2020-10-25 18:56:28', NULL),
(41, 'IT', 5, '2020-10-18 22:18:24', '2020-10-25 18:56:28', NULL),
(42, 'COO', 5, '2020-10-25 18:56:28', '2020-10-25 18:56:28', NULL),
(43, 'Meter', 9, '2020-11-01 19:26:52', '2020-11-01 19:26:52', NULL),
(44, 'Dus', 9, '2020-11-01 19:26:52', '2020-11-01 19:26:52', NULL),
(45, 'Roll', 9, '2020-11-01 19:26:52', '2020-11-01 19:26:52', NULL),
(46, 'Pel', 9, '2020-11-01 19:26:52', '2020-11-01 19:26:52', NULL),
(47, 'Galon', 9, '2020-11-01 19:26:52', '2020-11-01 19:26:52', NULL),
(48, 'Cm', 9, '2020-11-01 19:30:49', '2020-11-01 19:30:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_child` tinyint(1) NOT NULL DEFAULT 0,
  `icon` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `priority` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `url`, `status_child`, `icon`, `created_at`, `updated_at`, `description`, `deleted_at`, `priority`) VALUES
(1, '/menu', 0, 'fal fa-bars', '2020-02-16 04:07:22', '2020-02-16 04:07:22', 'Menu Management', NULL, NULL),
(3, '/dahsboard', 0, 'fal fa-window', '2020-02-16 06:39:01', '2020-02-25 23:33:59', 'Dashboard', NULL, 100000),
(4, '/report', 1, 'fal fa-file', '2020-02-16 07:07:40', '2020-02-18 00:03:45', 'Report', '2020-02-18 00:03:45', NULL),
(10, '/users', 0, 'fal fa-users', '2020-02-17 21:54:50', '2020-02-17 21:54:50', 'Users Management', NULL, NULL),
(11, '/role-management', 0, 'fal fa-users', '2020-02-17 23:31:44', '2020-02-26 21:05:59', 'Role Management', NULL, 12),
(12, '/mencoba', 1, 'fal fa-tv', '2020-02-18 19:15:27', '2020-02-26 21:07:49', 'Mencoba', '2020-02-26 21:07:49', NULL),
(13, '/mencoba-lagi', 1, 'fal fa-file', '2020-02-25 19:52:53', '2020-02-26 21:06:08', 'mencob', '2020-02-26 21:06:08', 100),
(14, '/masterdata', 0, 'far fa-sliders-v-square', '2020-02-26 20:57:57', '2020-02-26 20:57:57', 'Master Data', NULL, 1),
(15, '/lagi-cob', 0, 'far fa-car', '2020-02-26 21:06:43', '2020-02-26 21:07:39', 'Lagi Coba', '2020-02-26 21:07:39', 2),
(16, '/laporan', 1, 'fal fa-file', '2020-02-26 21:32:03', '2020-02-26 21:48:10', 'Laporan', '2020-02-26 21:48:10', 1),
(17, '/laporan', 1, 'fal fa-file', '2020-02-26 21:52:37', '2020-10-21 00:46:46', 'Laporan', '2020-10-21 00:46:46', 10),
(18, '/color', 0, 'fal fa-tint', '2020-10-18 22:13:16', '2020-10-18 22:13:16', 'Setting Color', NULL, 1),
(19, '/barang', 0, 'fal fa-box', '2020-10-21 00:28:38', '2020-10-21 00:28:38', 'Data Barang', NULL, 50),
(20, '/pengajuan-parent', 0, 'fal fa-archive', '2020-10-21 00:35:40', '2020-10-21 19:35:46', 'Pengajuan', NULL, 51),
(21, '/lantai', 0, 'fal fa-home', '2020-11-02 01:42:42', '2020-11-02 01:42:42', 'Data Lantai', NULL, 49),
(22, '/pembelian', 0, 'fal fa-archive', '2020-11-03 22:12:32', '2020-11-03 22:12:48', 'Pembelian', NULL, 50),
(23, '/inventori', 0, 'fal fa-archive', '2020-11-06 21:40:42', '2020-11-06 21:40:42', 'Inventori', NULL, 48);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_02_11_020623_create_master_data_table', 1),
(5, '2020_02_11_020929_create_master_data_detail_table', 1),
(6, '2020_02_13_075923_create_menu_table', 2),
(7, '2020_02_13_080528_create_child_menu_table', 2),
(8, '2020_02_16_105844_edit_table_menu', 3),
(9, '2020_02_18_065944_tambah_soft_delete', 4),
(10, '2020_02_19_011506_create_table_role_menu', 5),
(11, '2020_02_26_061536_tambah_field_prioritas', 6),
(12, '2020_02_28_071726_foto_profile_users', 7),
(13, '2020_10_14_031957_create_settings_table', 8),
(17, '2020_10_19_044853_create_barangs_table', 9),
(29, '2020_11_02_023037_create_lantais_table', 12),
(30, '2020_11_02_024546_create_ruangans_table', 12),
(38, '2020_10_19_081027_create_pengajuans_table', 13),
(39, '2020_10_21_081231_create_parent_pengajuans_table', 13),
(40, '2020_10_24_062958_edit_table_pengajuan', 13),
(41, '2020_11_02_090243_create_pembelians_table', 13),
(42, '2020_11_02_090346_create_pembelian_details_table', 13),
(47, '2020_11_05_022510_create_inventoris_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `parent_pengajuans`
--

CREATE TABLE `parent_pengajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `divisi` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_details`
--

CREATE TABLE `pembelian_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `input_by` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `tempat_beli` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuans`
--

CREATE TABLE `pengajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `perkiraan_harga` double NOT NULL,
  `total` double NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan_pengadaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengajuan` tinyint(4) NOT NULL DEFAULT 0,
  `alasan_tolak` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `saran_coo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` int(11) NOT NULL,
  `parent_menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `id_role`, `parent_menu`, `child_menu`, `created_at`, `updated_at`) VALUES
(1, 22, '[1,3,10,11,12,13]', '[5,6,7]', '2020-02-18 19:29:38', '2020-02-25 22:00:52'),
(3, 23, '[1,3,10,11,14,18,19,20,21,22,23]', '[]', '2020-02-18 21:33:17', '2020-11-06 21:41:23'),
(5, 30, '[1,11]', '[]', '2020-02-26 23:04:00', '2020-02-28 00:12:24'),
(6, 39, '[20,23,22]', '[]', '2020-10-20 02:46:16', '2020-11-06 21:42:05'),
(7, 37, '[20,22,23]', '[]', '2020-10-21 00:35:53', '2020-11-06 21:41:46'),
(8, 40, '[20,19,21,22]', '[]', '2020-10-21 00:41:43', '2020-11-05 00:22:24'),
(9, 38, '[20,23,22]', '[]', '2020-10-21 00:43:11', '2020-11-06 21:41:56'),
(10, 36, '[20,23,22]', '[]', '2020-10-21 00:49:52', '2020-11-06 21:41:38'),
(11, 41, '[20,22,23]', '[]', '2020-10-21 00:54:54', '2020-11-06 21:42:19'),
(12, 42, '[20,23,22]', '[]', '2020-10-25 18:57:23', '2020-11-06 21:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lantai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `ruangan`, `id_lantai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ruang Kantor', 1, '2020-11-04 02:59:18', '2020-11-04 22:55:19', '2020-11-04 22:55:19'),
(2, 'Kamar Mandi', 1, '2020-11-04 02:59:18', '2020-11-04 22:55:19', '2020-11-04 22:55:19'),
(3, 'vsdvs', 2, '2020-11-04 20:02:17', '2020-11-04 20:02:20', '2020-11-04 20:02:20'),
(4, 'vxvxc', 3, '2020-11-04 20:02:29', '2020-11-04 20:02:36', '2020-11-04 20:02:36'),
(5, 'vxcvcx', 4, '2020-11-04 20:02:33', '2020-11-04 22:55:22', '2020-11-04 22:55:22'),
(6, 'Ruang Kantor', 5, '2020-11-05 02:42:10', '2020-11-05 02:42:10', NULL),
(7, 'dfadaf', 6, '2020-11-05 02:42:23', '2020-11-05 02:42:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `color`, `created_at`, `updated_at`) VALUES
(1, '#880E4FFF', NULL, '2020-11-19 01:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `foto`) VALUES
(1, 'Jabir d', 'admin@admin.com', NULL, '$2y$10$AmBpObk4WD1Ou79BNcdHB.orFnnpn/fiXkHEKLYOnl1TaH.BNHZOG', 23, NULL, '2020-02-25 08:30:34', '2020-10-20 02:43:54', NULL, 'foto_profile/vRNW4GT3MyWQIkAZzbBd7LIdOFnoFTJPS9LHimIz.png'),
(7, 'test', 'fafes@gmail.com', NULL, '$2y$10$Ajnsl679X0v6ZxTppQUfLOITmnNmFy/.dn.CNMRWOHYGE0ehkK7.u', 22, NULL, '2020-02-27 01:11:42', '2020-02-27 07:47:11', '2020-02-27 07:47:11', NULL),
(8, 'management', 'management@gmail.com', NULL, '$2y$10$5H6YUp9KHKywJ5Nln3DWVuyOSRekn7UacdDAcG1fxqI7k.tgIjSMO', 30, NULL, '2020-02-27 07:49:36', '2020-02-28 00:12:41', NULL, NULL),
(9, 'Wahyu', 'wahyu_ramadhan15@redhunter.id', NULL, '$2y$10$JdhP6v8NyHj0meWND/ilDuatt3VxPDqnG3KblAyyPhbXqtH12Lilq', 39, NULL, '2020-10-20 02:44:38', '2020-10-20 02:45:24', NULL, NULL),
(10, 'Himatul Myla', 'mila@redhunter.id', NULL, '$2y$10$v7Fk2hTkoiJ5l7nDJyJQme0UCkNQkvSrWB947bCMb56qcqzzKR8Vy', 37, NULL, '2020-10-21 00:27:43', '2020-10-21 00:27:43', NULL, NULL),
(11, 'Finance Satu', 'finance@redhunter.id', NULL, '$2y$10$pxPv0z9wiJNDIaBJor1Qle0iVxHXCV7aTggaM9JdB9X00NRTPr1.6', 36, NULL, '2020-10-21 00:50:22', '2020-10-21 00:50:22', NULL, NULL),
(12, 'juli', 'juli_jaluy@redhunter.id', NULL, '$2y$10$C3nxVH5QLvqrHEbadgtTr.81gtk3WMmGc1Z92fTcWAR1zEld2/9Gi', 42, NULL, '2020-10-25 20:17:03', '2020-11-01 19:19:53', NULL, NULL),
(13, 'sufiyanto', 'sufiyamen@redhunter.id', NULL, '$2y$10$nLjVg0aqmN3927uUWU/fxOyv0drIeNTWUTY8phHLsT0vZMmRprfS2', 40, NULL, '2020-11-01 19:22:08', '2020-11-01 19:22:08', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_nama_index` (`nama`),
  ADD KEY `barangs_satuan_index` (`satuan`),
  ADD KEY `barangs_slug_index` (`slug`);

--
-- Indexes for table `child_menu`
--
ALTER TABLE `child_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_menu_id_menu_index` (`id_menu`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventoris`
--
ALTER TABLE `inventoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventoris_kode_unique` (`kode`),
  ADD KEY `inventoris_id_barang_index` (`id_barang`),
  ADD KEY `inventoris_id_lantai_index` (`id_lantai`),
  ADD KEY `inventoris_id_ruangan_index` (`id_ruangan`),
  ADD KEY `inventoris_id_user_index` (`id_user`);

--
-- Indexes for table `lantais`
--
ALTER TABLE `lantais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_data`
--
ALTER TABLE `master_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_data_description_index` (`description`);

--
-- Indexes for table `master_data_detail`
--
ALTER TABLE `master_data_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_data_detail_description_index` (`description`),
  ADD KEY `master_data_detail_id_master_data_index` (`id_master_data`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_pengajuans`
--
ALTER TABLE `parent_pengajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_pengajuans_nomor_surat_index` (`nomor_surat`),
  ADD KEY `parent_pengajuans_created_by_index` (`created_by`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelians_id_pengajuan_index` (`id_pengajuan`);

--
-- Indexes for table `pembelian_details`
--
ALTER TABLE `pembelian_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_details_id_barang_index` (`id_barang`),
  ADD KEY `pembelian_details_id_pengajuan_index` (`id_pengajuan`),
  ADD KEY `pembelian_details_id_pembelian_index` (`id_pembelian`),
  ADD KEY `pembelian_details_input_by_index` (`input_by`);

--
-- Indexes for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuans_id_barang_index` (`id_barang`),
  ADD KEY `pengajuans_created_by_index` (`created_by`),
  ADD KEY `pengajuans_id_divisi_index` (`id_divisi`),
  ADD KEY `pengajuans_id_parent_index` (`id_parent`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_menu_id_role_index` (`id_role`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_role_index` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `child_menu`
--
ALTER TABLE `child_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoris`
--
ALTER TABLE `inventoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lantais`
--
ALTER TABLE `lantais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_data_detail`
--
ALTER TABLE `master_data_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `parent_pengajuans`
--
ALTER TABLE `parent_pengajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian_details`
--
ALTER TABLE `pembelian_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
