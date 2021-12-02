-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2021 pada 20.33
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fcm_topsis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) NOT NULL,
  `nama_alternatif` text DEFAULT NULL,
  `ket_alternatif` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `ket_alternatif`) VALUES
('A001', 'Wardi', 'RT.01 RW.06'),
('A002', 'Somi', 'RT.01 RW.06'),
('A003', 'Ponidi', 'RT.01 RW.06'),
('A004', 'Moh. Amirudin', 'RT.01 RW.06'),
('A005', 'Jainuri', 'RT.01 RW.06'),
('A006', 'Selamet Marif', 'RT.01 RW.06'),
('A007', 'Sugiyanto', 'RT.01 RW.06'),
('A008', 'Sodikun', 'RT.01 RW.06'),
('A009', 'Khoirul Rojikin', 'RT.01 RW.06'),
('A010', 'Serly Anggraeni Ike Damayanti', 'RT.01 RW.06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_atribut`
--

CREATE TABLE `tb_atribut` (
  `kode_atribut` varchar(16) NOT NULL,
  `nama_atribut` varchar(255) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_atribut`
--

INSERT INTO `tb_atribut` (`kode_atribut`, `nama_atribut`, `atribut`) VALUES
('C01', 'Pendapatan setiap bulan', 'benefit'),
('C02', 'Pengeluaran setiap bulan', 'benefit'),
('C03', 'Luas lahan tempat tinggal', 'benefit'),
('C04', 'status tempat tinggal', 'benefit'),
('C05', 'Mendapatkan bantuan dari luar', 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cluster`
--

CREATE TABLE `tb_cluster` (
  `kode_alternatif` varchar(16) NOT NULL,
  `cluster` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_cluster`
--

INSERT INTO `tb_cluster` (`kode_alternatif`, `cluster`) VALUES
('A001', 'C2'),
('A002', 'C2'),
('A003', 'C1'),
('A004', 'C2'),
('A005', 'C1'),
('A006', 'C1'),
('A007', 'C2'),
('A008', 'C1'),
('A009', 'C1'),
('A010', 'C2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_atribut` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`ID`, `kode_alternatif`, `kode_atribut`, `nilai`) VALUES
(1, 'A001', 'C01', 12),
(2, 'A001', 'C02', 8),
(3, 'A001', 'C03', 12),
(4, 'A001', 'C04', 1),
(5, 'A001', 'C05', 1),
(6, 'A002', 'C01', 11),
(7, 'A002', 'C02', 8),
(8, 'A002', 'C03', 12),
(9, 'A002', 'C04', 1),
(10, 'A002', 'C05', 1),
(11, 'A003', 'C01', 10),
(12, 'A003', 'C02', 5),
(13, 'A003', 'C03', 12),
(14, 'A003', 'C04', 1),
(15, 'A003', 'C05', 1),
(16, 'A004', 'C01', 10),
(17, 'A004', 'C02', 7),
(18, 'A004', 'C03', 12),
(19, 'A004', 'C04', 1),
(20, 'A004', 'C05', 2),
(21, 'A005', 'C01', 8),
(22, 'A005', 'C02', 5),
(23, 'A005', 'C03', 11),
(24, 'A005', 'C04', 1),
(25, 'A005', 'C05', 1),
(26, 'A006', 'C01', 6),
(27, 'A006', 'C02', 6),
(28, 'A006', 'C03', 12),
(29, 'A006', 'C04', 1),
(30, 'A006', 'C05', 2),
(520, 'A007', 'C05', 2),
(519, 'A007', 'C04', 1),
(518, 'A007', 'C03', 13),
(517, 'A007', 'C02', 9),
(516, 'A007', 'C01', 11),
(51, 'A008', 'C01', 9),
(52, 'A008', 'C02', 1),
(53, 'A008', 'C03', 13),
(54, 'A008', 'C04', 1),
(55, 'A008', 'C05', 2),
(56, 'A009', 'C01', 8),
(57, 'A009', 'C02', 6),
(58, 'A009', 'C03', 12),
(59, 'A009', 'C04', 1),
(60, 'A009', 'C05', 1),
(61, 'A010', 'C01', 10),
(62, 'A010', 'C02', 6),
(63, 'A010', 'C03', 11),
(64, 'A010', 'C04', 1),
(65, 'A010', 'C05', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`) USING BTREE;

--
-- Indeks untuk tabel `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`) USING BTREE;

--
-- Indeks untuk tabel `tb_atribut`
--
ALTER TABLE `tb_atribut`
  ADD PRIMARY KEY (`kode_atribut`) USING BTREE;

--
-- Indeks untuk tabel `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=521;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
