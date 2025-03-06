-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Mar 2025 pada 07.55
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dinotain`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `stok`) VALUES
('', '', 0),
('B01', 'sate', 4),
('B02', 'nj', 5),
('B03', 'nh', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelangan`
--

CREATE TABLE `tbl_pelangan` (
  `id_pelangan` int(11) NOT NULL,
  `nama_pelangan` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telep` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pelangan`
--

INSERT INTO `tbl_pelangan` (`id_pelangan`, `nama_pelangan`, `alamat`, `no_telep`) VALUES
(1, 'Wahyu', 'Surakarta', '98'),
(2, 'Tiyas', 'Boyolali', '897 675 8975');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_provinsi`
--

CREATE TABLE `tbl_provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `provinsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`id_provinsi`, `provinsi`) VALUES
(1, 'ACEH'),
(2, 'SUMANTERA UTARA'),
(3, 'SUMANTERA BARAT'),
(4, 'RIAU'),
(5, 'JAMBI'),
(6, 'SUMANTERA BARAT'),
(7, 'BENGKULU'),
(8, 'LAMPUNG'),
(9, 'KEPULAUAN BANGKA BELITUNG'),
(10, 'KEPULAUAN RIAU'),
(11, 'DKI JAKARTA'),
(12, 'JAWA BARAT'),
(13, 'JAWA TENGAH'),
(14, 'DI YOGYAKARTA'),
(15, 'JAWA TIMUR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` int(10) NOT NULL,
  `level` varchar(15) NOT NULL,
  `nama_usaha` varchar(50) NOT NULL,
  `katagori_usaha` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_tel` int(11) NOT NULL,
  `provinsi` varchar(20) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `pesan_nota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `level`, `nama_usaha`, `katagori_usaha`, `email`, `no_tel`, `provinsi`, `alamat`, `kode_pos`, `pesan_nota`) VALUES
(1, 'coba', 34, 'user', 'ma', 'atk', 'halif@gmail.com', 566, 'jawa', 'sambi', 976, 'jshsfgs');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_pelangan`
--
ALTER TABLE `tbl_pelangan`
  ADD PRIMARY KEY (`id_pelangan`);

--
-- Indeks untuk tabel `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`,`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_pelangan`
--
ALTER TABLE `tbl_pelangan`
  MODIFY `id_pelangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
