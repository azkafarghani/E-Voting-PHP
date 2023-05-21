-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2023 pada 09.39
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-voting1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Administrator','Petugas','Pemilih') NOT NULL,
  `status` enum('1','0') NOT NULL,
  `jenis` enum('PAN','PST') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `status`, `jenis`) VALUES
(1, 'Azka Lazuardi', 'azkafarghani', '1234', 'Administrator', '0', 'PAN'),
(0, '', 'asdadad', 'asdad', 'Administrator', '1', 'PAN'),
(0, '', 'fghfgh', 'fghfgh', 'Administrator', '1', 'PAN'),
(0, '', 'fghfgh', 'fghfgh', 'Administrator', '1', 'PAN'),
(0, 'hokage', 'bismillahbisa ', '1234', 'Administrator', '1', 'PAN'),
(0, 'hashirama', 'hokage1', 'hokage1', 'Administrator', '1', 'PAN'),
(0, 'tsunade', 'tsuna', 'suna', 'Administrator', '1', 'PAN'),
(0, 'Azka Lazuardi', 'azkafarghani', '12345', 'Administrator', '1', 'PAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_calon`
--

CREATE TABLE `tb_calon` (
  `id_calon` varchar(2) NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `foto_calon` varchar(200) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_calon`
--

INSERT INTO `tb_calon` (`id_calon`, `nama_calon`, `foto_calon`, `keterangan`) VALUES
('1', 'Kandidat 1', 'Chrysanthemum.jpg', 'oke'),
('2', 'Kandidat 2', 'Tulips.jpg', 'oka'),
('3', 'Kandidat 3', 'Jellyfish.jpg', 'yups');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Administrator','Petugas','Pemilih') NOT NULL,
  `status` enum('1','0') NOT NULL,
  `jenis` enum('PAN','PST') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`, `status`, `jenis`) VALUES
(4, 'azki lawal', 'azkilawal1', 'azki22', 'Pemilih', '0', 'PST'),
(5, 'dualima', '25dualima', '2525', 'Administrator', '0', 'PST'),
(9, 'tes', 'tes', '9294', 'Pemilih', '1', 'PST'),
(17, 'minato', '13123', '12313', 'Petugas', '1', 'PAN'),
(20, 'tobirama', 'tobi', 'tobirama', 'Administrator', '0', 'PAN'),
(21, 'hashirama', 'hokage1', 'hokage1', 'Administrator', '1', 'PAN'),
(23, 'Azka Lazuardi', 'azkafarghani', '12345', 'Administrator', '1', 'PAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_vote`
--

CREATE TABLE `tb_vote` (
  `id_vote` int(11) NOT NULL,
  `id_calon` varchar(2) NOT NULL,
  `id_pemilih` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_vote`
--

INSERT INTO `tb_vote` (`id_vote`, `id_calon`, `id_pemilih`, `date`) VALUES
(25, '1', 5, '2021-12-19 10:48:48'),
(26, '2', 5, '2021-12-19 10:54:50'),
(27, '2', 5, '2021-12-19 12:20:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_calon`
--
ALTER TABLE `tb_calon`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD PRIMARY KEY (`id_vote`),
  ADD KEY `id_calon` (`id_calon`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_vote`
--
ALTER TABLE `tb_vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_vote`
--
ALTER TABLE `tb_vote`
  ADD CONSTRAINT `tb_vote_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `tb_calon` (`id_calon`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
