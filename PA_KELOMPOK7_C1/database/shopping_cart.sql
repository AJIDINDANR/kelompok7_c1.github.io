-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2023 pada 06.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumahmakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `quantity` int(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pesanan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `nama`, `harga`, `quantity`, `no_telp`, `alamat`, `pesanan`) VALUES
(3, 'Nasi Ayam Goreng', 25000.00, 1, '', '', ''),
(4, 'Nasi Ayam Goreng', 25000.00, 1, '', '', ''),
(5, 'Nasi Ayam Goreng', 25000.00, 1, '', '', ''),
(6, 'Nasi Ayam Goreng', 25000.00, 1, '', '', ''),
(7, 'Nasi Ayam Goreng', 25000.00, 1, '2637125', 'bengkuring', 't'),
(8, 'Nasi Ayam Goreng', 25000.00, 1, '2637125', 'bengkuring', 't'),
(9, 'Nasi Ayam Goreng', 25000.00, 1, '08535243', 'bengkuring', 't'),
(10, 'Nasi Ayam Goreng', 25000.00, 1, '7', 'en', 'r'),
(11, 'Nasi Ayam Goreng', 25000.00, 1, 'u', '8', '8');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
