-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Agu 2024 pada 02.09
-- Versi server: 8.0.30
-- Versi PHP: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pariwisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `package` varchar(50) NOT NULL,
  `quantity` int NOT NULL,
  `visit_date` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `package`, `quantity`, `visit_date`, `total`) VALUES
(2, 'andi', 'andyisroq0@gmail.com', '10793054917', '1000000', 2, '2024-08-07', 2000000.00),
(3, 'andi', 'andyisroq0@gmail.com', '08112039712', '1000000', 3, '2024-08-08', 3000000.00),
(4, 'andi', 'andyisroq0@gmail.com', '08112039712', '1000000', 3, '2024-08-08', 3000000.00),
(5, 'andi', 'andyisroq0@gmail.com', '08112039712', '1000000', 3, '2024-08-08', 3000000.00),
(6, 'andi', 'andyisroq0@gmail.com', '08112039712', '500000', 5, '2024-08-08', 2500000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `image_url`) VALUES
(1, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(2, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(3, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(4, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(5, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(6, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(7, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(8, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(9, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(10, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(11, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg'),
(12, 'https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `image_url`) VALUES
(1, 'Paket A', 'Apa Saja Keuntungan mengambil Paket A', 'https://asset.kompas.com/crops/UN0JVVylf-4o9LyIicjKoQ2lt2Y=/0x159:900x759/1200x800/data/photo/2021/12/19/61bf16536e7fd.jpg'),
(2, 'Paket B', 'Apa Saja Keuntungan mengambil Paket B', 'https://asset.kompas.com/crops/UN0JVVylf-4o9LyIicjKoQ2lt2Y=/0x159:900x759/1200x800/data/photo/2021/12/19/61bf16536e7fd.jpg'),
(3, 'Paket C', 'Apa Saja Keuntungan mengambil Paket C', 'https://asset.kompas.com/crops/UN0JVVylf-4o9LyIicjKoQ2lt2Y=/0x159:900x759/1200x800/data/photo/2021/12/19/61bf16536e7fd.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'admin', '1', 'admin@gmail.com', '$2y$10$AUuOQoSxpMSSOaXOY0zJqubPFtG4b682XDqOeEvaKsx3xwoVDOeNq'),
(2, 'admin', '2', 'admin2@gmail.com', '$2y$10$CRyzD0g4QsxJlJ4Lz46AXOzRnPzwui.eVgTOhcnnrkdLjJUBQG9vK');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
