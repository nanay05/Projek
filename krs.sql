-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jan 2025 pada 14.17
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
-- Database: `krs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inputmhs`
--

CREATE TABLE `inputmhs` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `ipk` float DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `matkul` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inputmhs`
--

INSERT INTO `inputmhs` (`id`, `nama`, `nim`, `ipk`, `sks`, `matkul`) VALUES
(1, 'Rio', 'A11.2021.123444', 3, 24, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jwl_mhs`
--

CREATE TABLE `jwl_mhs` (
  `id` int(11) NOT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `matkul` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `kelp` varchar(20) DEFAULT NULL,
  `ruangan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jwl_mhs`
--

INSERT INTO `jwl_mhs` (`id`, `mahasiswa_id`, `matkul`, `sks`, `kelp`, `ruangan`) VALUES
(3, 1, 'Pemograman Berbasis Web', 3, 'A11.4201', 'H6.3'),
(4, 1, 'Metedologi Penelitian', 3, 'A11.4201', 'H6.3'),
(5, 1, 'Pendidikan Pancasila', 3, 'A11.4201', 'H6.3'),
(6, 1, 'Sistem Terdistribusi', 3, 'A11.4201', 'H6.3'),
(7, 1, 'Bahasa Indonesia', 3, 'A11.4201', 'H6.3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inputmhs`
--
ALTER TABLE `inputmhs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inputmhs`
--
ALTER TABLE `inputmhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jwl_mhs`
--
ALTER TABLE `jwl_mhs`
  ADD CONSTRAINT `jwl_mhs_ibfk_1` FOREIGN KEY (`mahasiswa_id`) REFERENCES `inputmhs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
