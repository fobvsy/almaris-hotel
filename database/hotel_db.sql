-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2026 pada 08.42
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
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nomor_kamar` varchar(20) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('tersedia','dipesan') NOT NULL DEFAULT 'tersedia',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nomor_kamar`, `tipe_kamar`, `harga`, `status`, `foto`, `created_at`) VALUES
(5, '101', 'Standard', 500000, 'tersedia', 'room_1780985836_1349.png', '2026-06-02 04:11:03'),
(7, '102', 'Standard', 500000, 'tersedia', 'room_1780985828_4485.png', '2026-06-02 05:54:01'),
(8, '103', 'Standard', 500000, 'tersedia', 'room_1780985819_1949.png', '2026-06-02 05:54:15'),
(9, '201', 'Deluxe', 800000, 'tersedia', 'room_1780985806_5646.png', '2026-06-02 05:54:59'),
(10, '202', 'Deluxe', 800000, 'tersedia', 'room_1780985792_6469.png', '2026-06-02 16:22:31'),
(11, '301', 'Suite', 1200000, 'tersedia', 'room_1780985778_8608.png', '2026-06-02 16:22:47'),
(12, '302', 'Suite', 1200000, 'tersedia', 'room_1780985771_3004.png', '2026-06-02 16:23:00'),
(13, '401', 'Presidential', 1500000, 'tersedia', 'room_1780985762_8677.png', '2026-06-02 16:23:26'),
(14, '402', 'Presidential', 1500000, 'tersedia', 'room_1780985754_2465.png', '2026-06-02 16:23:45'),
(15, '501', 'Family', 1800000, 'tersedia', 'room_1780985732_3093.png', '2026-06-02 16:26:19'),
(16, '502', 'Family', 1800000, 'tersedia', 'room_1780985723_9272.png', '2026-06-02 16:26:29'),
(17, '601', 'Exclusive', 2200000, 'tersedia', 'room_1780985715_1136.png', '2026-06-02 16:26:45'),
(18, '602', 'Exclusive', 2200000, 'tersedia', 'room_1780985706_4717.png', '2026-06-02 16:26:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('pending','checkin','checkout') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `id_kamar`, `check_in`, `check_out`, `total_harga`, `status`, `created_at`) VALUES
(2, 2, 5, '2026-06-02', '2026-06-05', 1500000, 'checkout', '2026-06-02 04:13:49'),
(3, 2, 9, '2026-06-02', '2026-06-06', 3200000, 'checkout', '2026-06-02 05:56:31'),
(4, 2, 7, '2026-06-02', '2026-06-03', 500000, 'checkout', '2026-06-02 15:45:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@almaris.hotel', '$2y$10$PqrzejFbU3D5DG5Z5isGXe.Hjpeeo80oifK7kk7Qw8JTG.mTagpca', 'admin', '2026-06-01 07:34:08'),
(2, 'Alex', 'alex@yahoo.id', '$2y$10$yBdnAIAyBlwtyGJk9uVBz.3Cqq8VaO.QmG6ge1quXkX4pS73SC0Ma', 'user', '2026-06-01 08:35:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD UNIQUE KEY `nomor_kamar` (`nomor_kamar`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `fk_reservasi_user` (`id_user`),
  ADD KEY `fk_reservasi_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `fk_reservasi_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservasi_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
