-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2026 pada 13.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemrogramanweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id_customer` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id_customer`, `nama`, `nik`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
(9, 'nova', '1234567890987657', '085234567865', 'Batam', '2026-04-24 22:10:35', '2026-05-10 01:01:34'),
(10, 'Nova eliza', '0077420071029002', '08972236526', 'lr.asrama haji', '2026-04-25 05:58:21', '2026-04-25 05:58:21'),
(11, 'jeni', '0008292000110928', '085289372839', 'bandung', '2026-04-25 07:22:53', '2026-04-25 07:22:53'),
(12, 'karin', '0072976123478990', '083165283930', 'jakarta', '2026-04-26 00:30:41', '2026-04-26 00:30:41'),
(13, 'noja', '0008909233903030', '082134238976', 'medan', '2026-04-26 00:32:35', '2026-04-26 00:32:35'),
(14, 'jaja', '0008993382290202', '0897897363820', 'Ambon', '2026-04-26 05:45:19', '2026-04-26 05:45:19'),
(16, 'Nova Eliza Oktaria', '0901910202002202', '08972236526', 'Lr.Asrama haji', '2026-04-26 08:12:03', '2026-04-26 08:12:03'),
(17, 'Tiara h', '1209923872652347', '08675524526', 'Medann', '2026-05-02 02:16:57', '2026-05-02 02:16:57'),
(18, 'eliza', '0077293839082788', '085234590076', 'jl.jepang', '2026-05-02 02:50:15', '2026-05-02 02:50:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_29_062712_create_mobils_table', 1),
(5, '2026_03_31_142112_create_customers_table', 1),
(6, '2026_04_06_090003_create_rentals_table', 2),
(7, '2026_04_08_132909_create_transaksis_table', 3),
(8, '2026_04_12_075357_add_email_password_to_customers_table', 4),
(9, '2026_04_23_160000_update_metode_bayar_enum_in_transaksis_table', 5),
(13, '2026_04_24_000000_rename_gambar_to_foto_in_mobils_table', 6),
(14, '2026_04_24_000001_fix_mobil_foto_references', 6),
(15, '2026_04_24_000002_cleanup_invalid_mobils', 6),
(16, '2026_04_24_023230_add_email_password_to_customers_table', 7),
(17, '2026_04_25_124420_add_status_transaksi_to_transaksis_table', 8),
(18, '2026_04_25_133122_add_detail_to_transaksis_table', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobils`
--

CREATE TABLE `mobils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mobil` varchar(255) NOT NULL,
  `no_polisi` varchar(255) NOT NULL,
  `harga_per_hari` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'tersedia',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mobils`
--

INSERT INTO `mobils` (`id`, `nama_mobil`, `no_polisi`, `harga_per_hari`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Toyota Innova', 'T 1001 ABC', 350000, 'tidak tersedia', '1776995244_toyota_innova.png', '2026-04-03 20:07:23', '2026-05-02 01:04:25'),
(2, 'Toyota Alphard', 'T 1002 ABD', 500000, 'tidak tersedia', '1776995286_1776483553_toyota_alphard.png', '2026-04-03 20:07:23', '2026-04-26 05:45:19'),
(3, 'Toyota Avanza', 'T 1003 BAS', 450000, 'tidak tersedia', '1776995323_Auto_2000-removebg-preview.png', '2026-04-03 20:07:23', '2026-04-26 06:48:43'),
(4, 'Toyota Fortuner', 'T 1004 BAF', 350000, 'tidak tersedia', '1776995359_fortuner.png', '2026-04-03 20:07:23', '2026-04-26 18:55:05'),
(5, 'Mitsubishi Galant', 'M 2002 MAG', 400000, 'tersedia', '1776995387_1998_Mitsubishi_Galant_JP-spec-removebg-preview.png', '2026-04-03 20:07:23', '2026-04-23 12:21:45'),
(6, 'Mitsubishi Triton', 'M 2003 MAT', 350000, 'tidak tersedia', '1776995414_2018_Mitsubishi_Triton__facelift__with_Dynamic_Shield_front-end_spied-removebg-preview.png', '2026-04-03 20:07:23', '2026-04-26 08:09:39'),
(7, 'Mitsubishi XForce', 'M 2005 MAX', 600000, 'tersedia', '1776995439_Mitsubishi_XForce_HEV_-_TH_version_2025-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-26 01:06:10'),
(8, 'Mitsubishi Xpander', 'M 2007 MAP', 480000, 'tersedia', '1776995464_Mitsubishi_Xpander_to_get_a_new_variant_at_GIIAS_2018-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-23 12:22:53'),
(9, 'Honda CRV', 'H 3001 HIC', 750000, 'tersedia', '1776995499_2015_Honda_CR-View.png', '2026-04-03 20:07:24', '2026-04-23 12:23:18'),
(10, 'Honda HR-V', 'H 3009 HAR', 500000, 'tersedia', 'hr-v.png', '2026-04-03 20:07:24', '2026-04-26 01:05:31'),
(11, 'Honda Jazz', 'H 3006 HAJ', 380000, 'tersedia', 'jazz.png', '2026-04-03 20:07:24', '2026-04-26 01:05:43'),
(12, 'Honda BRV', 'H 3005 HAB', 400000, 'tersedia', '1776995566_Honda_Brv_2021-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-23 12:24:18'),
(13, 'Daihatsu Xenia', 'D 4000 DEX', 700000, 'tersedia', '1776995608_Daihatsu_Xenia.png', '2026-04-03 20:07:24', '2026-04-23 12:24:42'),
(14, 'Daihatsu Terios', 'D 4001 DAT', 450000, 'tersedia', '1776995644_Daihatsu_Terios-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-23 12:25:03'),
(15, 'Daihatsu Sigra', 'D 4003 DAS', 420000, 'tersedia', 'sigra.png', '2026-04-03 20:07:24', '2026-04-23 12:25:22'),
(16, 'Daihatsu Ayla', 'D 4009 DAA', 550000, 'tersedia', '1776995686_ayla.png', '2026-04-03 20:07:24', '2026-04-26 01:06:31'),
(17, 'Hyundai Tucson', 'Y 5001 YAT', 500000, 'tersedia', '1776995709_2026_Hyundai_Tucson_Review__Pricing__and_Specs-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-23 12:26:35'),
(18, 'Hyundai Creta', 'Y 5002 YAC', 520000, 'tersedia', '1776995743_Nice_Hyundai_2017__Hyundai_Creta_Hyundai_Creta_Check_more_at_http___carboard_pro_Cars-Gallery_2017_hyundai-2017-hyundai-creta-hyundai-creta_-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-26 01:01:58'),
(19, 'Hyundai Santa Fe', 'Y 5003 YAE', 490000, 'tersedia', '1776995769_Hyundai_recalls_over_400_000_Santa_Fe.png', '2026-04-03 20:07:24', '2026-04-23 12:28:05'),
(20, 'Hyundai Inster', 'Y 5004 YAI', 620000, 'tersedia', '1776995788_Hyundai_Inster_2025.png', '2026-04-03 20:07:24', '2026-04-23 12:28:24'),
(21, 'Suzuki Jimmy', 'S 6001 ABC', 380000, 'tersedia', '1776995823_1776488012_Suzuki-jimmy-removebg-preview.png', '2026-04-03 20:07:24', '2026-04-23 12:29:21'),
(22, 'Suzuki XL-7', 'S 6003 ABS', 300000, 'tidak tersedia', '1776995881_suzuki xl.png', '2026-04-23 11:58:01', '2026-04-26 08:12:03'),
(23, 'Suzuki Ertiga', 'S 6005 ABK', 350000, 'tersedia', '1776995931_Suzuki_Ertiga_Mild-Hybrid_2022_Meluncur_di_India__Apa_Saja_yang_Berubah_-removebg-preview (1).png', '2026-04-23 11:58:51', '2026-04-23 12:30:06'),
(24, 'Suzuki Baleno', 'S 6008 ABN', 300000, 'tersedia', '1776995970_Suzuki_Balenoview.png', '2026-04-23 11:59:30', '2026-04-23 12:30:27'),
(25, 'Jeep Wrangler', 'J 1234 JEEP', 500000, 'tersedia', '1777553529_2025_Jeep_Wrangler_Trim_Levels_Explained_in_Frontenac__KS_-_Jay_Hatfield_Jeep-removebg-preview.png', '2026-04-30 05:52:10', '2026-04-30 05:52:10'),
(26, 'Jeep Rubicon', 'J 1235 JAAK', 499999, 'tersedia', '1777553838_download__3_-removebg-preview.png', '2026-04-30 05:57:18', '2026-04-30 05:57:18'),
(27, 'Isuzu MU-X', 'J 1236 JAKI', 400000, 'tersedia', '1777554236_India-bound_2017_Isuzu_MU-X__facelift__launched_in_Thailand-removebg-preview.png', '2026-04-30 05:58:24', '2026-04-30 06:03:56'),
(28, 'Isuzu D Max', 'J 1237 JAKK', 399999, 'tersedia', '1777554033_Isuzu_D_Max_2023_Price_In_USA___Features_And_Specs-removebg-preview.png', '2026-04-30 05:59:39', '2026-04-30 06:03:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobil_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` enum('aktif','selesai','dibatalkan') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`id`, `mobil_id`, `customer_id`, `tanggal_sewa`, `tanggal_kembali`, `lama_sewa`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(14, 2, 10, '2026-04-26', '2026-04-28', 2, 1000000.00, 'selesai', '2026-04-25 05:58:22', '2026-04-26 01:05:36'),
(17, 11, 11, '2026-04-27', '2026-05-04', 7, 2660000.00, 'selesai', '2026-04-25 07:22:53', '2026-04-26 01:05:43'),
(18, 6, 12, '2026-04-27', '2026-04-29', 2, 700000.00, 'selesai', '2026-04-26 00:30:41', '2026-04-26 01:05:28'),
(19, 18, 13, '2026-05-04', '2026-05-06', 2, 1040000.00, 'selesai', '2026-04-26 00:32:35', '2026-04-26 01:01:58'),
(20, 1, 13, '2026-05-04', '2026-05-06', 2, 700000.00, 'selesai', '2026-04-26 01:11:49', '2026-04-26 18:59:59'),
(21, 2, 14, '2026-04-27', '2026-04-28', 1, 500000.00, 'aktif', '2026-04-26 05:45:19', '2026-04-26 05:45:19'),
(27, 22, 16, '2026-05-03', '2026-05-05', 2, 600000.00, 'aktif', '2026-04-26 08:12:03', '2026-04-26 08:12:03'),
(28, 4, 16, '2026-05-03', '2026-05-29', 26, 9100000.00, 'aktif', '2026-04-26 18:55:05', '2026-04-26 18:55:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pwu8rpYnm7yKavHXDMZkzDT4WQ3YVZrAXXcmeQN9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'YTo3OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoicmJLTjYxR2djREFVTTY3cnpUa2tUWW9RSm54RFpwck9PZkNJZDVxQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2Frc2kiO3M6NToicm91dGUiO3M6MTU6InRyYW5zYWtzaS5pbmRleCI7fXM6NToibG9naW4iO2I6MTtzOjQ6InJvbGUiO3M6NToiYWRtaW4iO3M6ODoidXNlcm5hbWUiO3M6OToia2Vsb21wb2s2IjtzOjQ6Im5hbWEiO3M6MTA6IktlbG9tcG9rIDYiO30=', 1777284961);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `jumlah_bayar` decimal(15,2) NOT NULL DEFAULT 0.00,
  `metode_bayar` enum('cash','transfer','qris') DEFAULT NULL,
  `status_bayar` enum('belum','lunas') NOT NULL DEFAULT 'belum',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_transaksi` enum('pending','dikonfirmasi','berjalan','selesai','dibatalkan') NOT NULL DEFAULT 'pending',
  `tanggal_sewa` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `status_pembayaran` varchar(255) NOT NULL DEFAULT 'Belum Lunas',
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `rental_id`, `tanggal_bayar`, `jumlah_bayar`, `metode_bayar`, `status_bayar`, `bukti_bayar`, `created_at`, `updated_at`, `status_transaksi`, `tanggal_sewa`, `tanggal_kembali`, `total_harga`, `status_pembayaran`, `status`) VALUES
(14, 14, '2026-04-26', 1000000.00, 'transfer', 'lunas', 'bukti.png', '2026-04-25 05:58:22', '2026-04-26 01:05:36', 'pending', NULL, NULL, 0, 'Lunas', 'pending'),
(16, 17, '2026-04-27', 2660000.00, 'cash', 'lunas', '1777127563.jfif', '2026-04-25 07:22:53', '2026-04-30 05:04:44', 'pending', NULL, NULL, 0, 'Lunas', 'lunas'),
(17, 18, '2026-04-27', 700000.00, 'cash', 'lunas', 'foto1.png', '2026-04-26 00:30:41', '2026-04-30 04:50:55', 'pending', NULL, NULL, 0, 'Lunas', 'lunas'),
(18, 19, '2026-05-04', 1040000.00, 'transfer', 'lunas', '1777188944.png', '2026-04-26 00:32:35', '2026-04-26 08:06:22', 'pending', NULL, NULL, 0, 'Lunas', 'lunas'),
(19, 20, '2026-05-04', 700000.00, 'transfer', 'lunas', '12345.png', '2026-04-26 01:11:49', '2026-04-26 18:59:59', 'pending', NULL, NULL, 0, 'Lunas', 'lunas'),
(20, 21, '2026-04-27', 500000.00, 'transfer', 'lunas', '1777188944.png', '2026-04-26 05:45:19', '2026-04-26 07:54:14', 'pending', NULL, NULL, 0, 'Lunas', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@rental.com', '2026-04-04 03:07:23', '$2y$12$.Zle/OAec6oAYRrgrjBLa.Ry/F1ckDVn1E7GoGcpzZ09e4OJPK0zG', 'admin', '7Ec9cEi2T3', '2026-04-04 03:07:23', '2026-04-04 03:07:23'),
(4, 'nova', 'nova@gmail.com', NULL, '$2y$12$/bfSg1.v658iy2/2Ffsi8OqPiL6YyA7.BY7RqECvlsjXd6cWCT1e.', 'user', NULL, '2026-05-03 08:53:01', '2026-05-03 08:53:01'),
(5, 'jeni', 'jeni1@gmail.com', NULL, '$2y$12$R2C5SGdsp/eenLlIGbajdu7TlOvZkGRws80OdGAcVpTR0QwtYcYtS', 'user', NULL, '2026-05-03 08:53:40', '2026-05-03 08:53:40'),
(7, 'tiara h', 'tiara2@gmail.com', NULL, '$2y$12$y5ffmia5Kug8.Bva1xafFuMib6vYxy4X2jnLZsd3iENaF1AnxfqBO', 'user', NULL, '2026-05-03 09:19:48', '2026-05-03 09:19:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `customers_nik_unique` (`nik`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobils`
--
ALTER TABLE `mobils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobils_no_polisi_unique` (`no_polisi`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_mobil_id_foreign` (`mobil_id`),
  ADD KEY `rentals_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_rental_id_foreign` (`rental_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `mobils`
--
ALTER TABLE `mobils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`) ON DELETE CASCADE,
  ADD CONSTRAINT `rentals_mobil_id_foreign` FOREIGN KEY (`mobil_id`) REFERENCES `mobils` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
