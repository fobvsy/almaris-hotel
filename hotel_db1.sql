-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2026 pada 09.49
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
(1, '101', 'Deluxe Room', 750000, 'tersedia', 'deluxe.jpg', '2026-05-28 05:50:42'),
(2, '102', 'Executive Suite', 1250000, 'tersedia', 'executive.jpg', '2026-05-28 05:50:42'),
(3, '103', 'Presidential Room', 2500000, 'dipesan', 'presidential.jpg', '2026-05-28 05:50:42');

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
(1, 4, 3, '2026-06-01', '2026-06-02', 2500000, 'pending', '2026-06-01 07:44:49');

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
(1, 'Admin Hotel', 'admin@hotel.com', '$2y$10$N9v4j5vT8q3v0M2f0sJYQeKj2kYk7L7D8v7x3h4m1r8Y6s5a2b3c4', 'admin', '2026-05-28 05:50:29'),
(2, 'Gon', 'gon@yahoo.id', '$2y$10$QCpMc3q7a9IMscoV9DptF./Yt3u3zwROZ.p1m0LW45chL01U2cCqq', 'user', '2026-05-30 06:41:13'),
(3, 'Admin Baru', 'info@almaris.hotel', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin', '2026-06-01 07:32:17'),
(4, 'gond', 'gon@ftr.id', '$2y$10$PqrzejFbU3D5DG5Z5isGXe.Hjpeeo80oifK7kk7Qw8JTG.mTagpca', 'user', '2026-06-01 07:34:08'),
(5, 'Admin Baru', 'admin2@hotel.com', '$2y$10$QCPcMc3q7a9IMscoV9DptF/Yt3u3zwROZ.p1m0LW45cQ.ZpDCVXMK', 'admin', '2026-06-01 07:38:15');

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
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
