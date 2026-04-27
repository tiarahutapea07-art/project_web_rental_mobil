-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2026 pada 05.36
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
-- Database: `pemrograman_web`
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `nama`, `email`, `password`, `nik`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'tiara irawati hutapea', '', '', '0591859382869395', '085896891379', 'medan sumut', '2026-04-05 19:19:45', '2026-04-05 19:19:45'),
(2, 'Haniii', '12094837846729@example.com', '$2y$12$nWIE7ba9xgUqBgYacZxAzuprs2NkfOW4Xa6GAqlUuaoJleiu.H07a', '12094837846729', '0815435263712', 'Serang', '2026-04-23 19:06:00', '2026-04-23 19:06:00');

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
(9, '2026_04_23_160000_update_metode_bayar_enum_in_transaksis_table', 5);

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
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mobils`
--

INSERT INTO `mobils` (`id`, `nama_mobil`, `no_polisi`, `harga_per_hari`, `status`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Toyota Innova', 'T 1001 ABC', 350000, 'tidak tersedia', '1776995244_toyota_innova.png', '2026-04-04 03:07:23', '2026-04-23 19:19:56'),
(2, 'Toyota Alphard', 'T 1002 ABD', 500000, 'tersedia', '1776995286_1776483553_toyota_alphard.png', '2026-04-04 03:07:23', '2026-04-23 19:20:28'),
(3, 'Toyota Avanza', 'T 1003 BAS', 450000, 'tersedia', '1776995323_Auto_2000-removebg-preview.png', '2026-04-04 03:07:23', '2026-04-23 19:20:52'),
(4, 'Toyota Fortuner', 'T 1004 BAF', 350000, 'tersedia', '1776995359_fortuner.png', '2026-04-04 03:07:23', '2026-04-23 19:21:14'),
(5, 'Mitsubishi Galant', 'M 2002 MAG', 400000, 'tersedia', '1776995387_1998_Mitsubishi_Galant_JP-spec-removebg-preview.png', '2026-04-04 03:07:23', '2026-04-23 19:21:45'),
(6, 'Mitsubishi Triton', 'M 2003 MAT', 350000, 'tersedia', '1776995414_2018_Mitsubishi_Triton__facelift__with_Dynamic_Shield_front-end_spied-removebg-preview.png', '2026-04-04 03:07:23', '2026-04-23 19:22:09'),
(7, 'Mitsubishi XForce', 'M 2005 MAX', 600000, 'tidak tersedia', '1776995439_Mitsubishi_XForce_HEV_-_TH_version_2025-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:22:31'),
(8, 'Mitsubishi Xpander', 'M 2007 MAP', 480000, 'tersedia', '1776995464_Mitsubishi_Xpander_to_get_a_new_variant_at_GIIAS_2018-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:22:53'),
(9, 'Honda CRV', 'H 3001 HIC', 750000, 'tersedia', '1776995499_2015_Honda_CR-View.png', '2026-04-04 03:07:24', '2026-04-23 19:23:18'),
(10, 'Honda HR-V', 'H 3009 HAR', 500000, 'tersedia', 'hr-v.png', '2026-04-04 03:07:24', '2026-04-23 19:23:42'),
(11, 'Honda Jazz', 'H 3006 HAJ', 380000, 'tersedia', 'jazz.png', '2026-04-04 03:07:24', '2026-04-23 19:23:59'),
(12, 'Honda BRV', 'H 3005 HAB', 400000, 'tersedia', '1776995566_Honda_Brv_2021-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:24:18'),
(13, 'Daihatsu Xenia', 'D 4000 DEX', 700000, 'tersedia', '1776995608_Daihatsu_Xenia.png', '2026-04-04 03:07:24', '2026-04-23 19:24:42'),
(14, 'Daihatsu Terios', 'D 4001 DAT', 450000, 'tersedia', '1776995644_Daihatsu_Terios-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:25:03'),
(15, 'Daihatsu Sigra', 'D 4003 DAS', 420000, 'tersedia', 'sigra.png', '2026-04-04 03:07:24', '2026-04-23 19:25:22'),
(16, 'Daihatsu Ayla', 'D 4009 DAA', 550000, 'tidak tersedia', '1776995686_ayla.png', '2026-04-04 03:07:24', '2026-04-23 19:25:58'),
(17, 'Hyundai Tucson', 'Y 5001 YAT', 500000, 'tersedia', '1776995709_2026_Hyundai_Tucson_Review__Pricing__and_Specs-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:26:35'),
(18, 'Hyundai Creta', 'Y 5002 YAC', 520000, 'tersedia', '1776995743_Nice_Hyundai_2017__Hyundai_Creta_Hyundai_Creta_Check_more_at_http___carboard_pro_Cars-Gallery_2017_hyundai-2017-hyundai-creta-hyundai-creta_-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:27:37'),
(19, 'Hyundai Santa Fe', 'Y 5003 YAE', 490000, 'tersedia', '1776995769_Hyundai_recalls_over_400_000_Santa_Fe.png', '2026-04-04 03:07:24', '2026-04-23 19:28:05'),
(20, 'Hyundai Inster', 'Y 5004 YAI', 620000, 'tersedia', '1776995788_Hyundai_Inster_2025.png', '2026-04-04 03:07:24', '2026-04-23 19:28:24'),
(21, 'Suzuki Jimmy', 'S 6001 ABC', 380000, 'tersedia', '1776995823_1776488012_Suzuki-jimmy-removebg-preview.png', '2026-04-04 03:07:24', '2026-04-23 19:29:21'),
(22, 'Suzuki XL-7', 'S 6003 ABS', 300000, 'tersedia', '1776995881_suzuki xl.png', '2026-04-23 18:58:01', '2026-04-23 19:29:46'),
(23, 'Suzuki Ertiga', 'S 6005 ABK', 350000, 'tersedia', '1776995931_Suzuki_Ertiga_Mild-Hybrid_2022_Meluncur_di_India__Apa_Saja_yang_Berubah_-removebg-preview (1).png', '2026-04-23 18:58:51', '2026-04-23 19:30:06'),
(24, 'Suzuki Baleno', 'S 6008 ABN', 300000, 'tersedia', '1776995970_Suzuki_Balenoview.png', '2026-04-23 18:59:30', '2026-04-23 19:30:27');

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
(1, 1, 2, '2026-04-24', '2026-04-25', 1, 350000.00, 'aktif', '2026-04-23 19:06:00', '2026-04-23 19:06:00');

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
('IqvjCJyJSZNecdZ66Edx52DVmPRKFPXJLVCQTKwy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVlhienh2MDVlS1hheVZPRGNpWm9SVWQ5cWFmU2lGMWlBQnFoOEF5dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YWJsZXMiO3M6NToicm91dGUiO3M6NjoidGFibGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJsb2dpbiI7YjoxO30=', 1775983187);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `rental_id`, `tanggal_bayar`, `jumlah_bayar`, `metode_bayar`, `status_bayar`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 350000.00, 'cash', 'belum', NULL, '2026-04-23 19:06:00', '2026-04-23 19:06:00');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@rental.com', '2026-04-04 03:07:23', '$2y$12$.Zle/OAec6oAYRrgrjBLa.Ry/F1ckDVn1E7GoGcpzZ09e4OJPK0zG', '7Ec9cEi2T3', '2026-04-04 03:07:23', '2026-04-04 03:07:23');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_nik_unique` (`nik`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `mobils`
--
ALTER TABLE `mobils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
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
