-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jan 2019 pada 09.56
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posit`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `online`
--

CREATE TABLE `online` (
  `id_session` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `waktu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `online`
--

INSERT INTO `online` (`id_session`, `id_login`, `waktu`) VALUES
(1, 0, ''),
(2, 0, ''),
(3, 0, ''),
(4, 4, ''),
(5, 0, ''),
(6, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `ids` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jam` varchar(30) NOT NULL,
  `isistatus` longtext NOT NULL,
  `fotof` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`ids`, `iduser`, `tanggal`, `jam`, `isistatus`, `fotof`, `tipe`) VALUES
(77, 4, '26 07 2018', '14 50', 'tai', 'kosong', 'status'),
(78, 2, '21 11 2018', '17 56', 'kosong', '5bf539debf5ce.jpg', 'foto'),
(79, 1, '29 11 2018', '16 05', 'kosong', '5bffabd654cfa.jpg', 'foto'),
(80, 1, '29 11 2018', '16 05', 'sodom aku bang', 'kosong', 'status'),
(81, 4, '10 12 2018', '18 46', 'asdasdasd', 'kosong', 'status');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkomentar`
--

CREATE TABLE `tbkomentar` (
  `idk` int(11) NOT NULL,
  `idstatus` int(10) NOT NULL,
  `iduserk` int(11) NOT NULL,
  `tanggalk` varchar(50) NOT NULL,
  `jamk` varchar(30) NOT NULL,
  `isikomentar` longtext NOT NULL,
  `notif` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkomentar`
--

INSERT INTO `tbkomentar` (`idk`, `idstatus`, `iduserk`, `tanggalk`, `jamk`, `isikomentar`, `notif`) VALUES
(90, 77, 3, '26 07 2018', '17 56', 'indehoy', 'sudah'),
(91, 77, 5, '26 07 2018', '17 56', 'crot', 'sudah'),
(92, 77, 2, '26 07 2018', '17 56', 'mantap', 'sudah'),
(93, 77, 2, '21 11 2018', '17 56', 'fuck\r\n', 'belum'),
(95, 78, 1, '29 11 2018', '16 09', 'asda', 'belum'),
(96, 81, 4, '10 12 2018', '18 46', 'asdas', 'sudah'),
(97, 81, 2, '09 01 2019', '15 55', 'asu', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL,
  `jnskelamin` varchar(30) NOT NULL,
  `notlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `foto`, `alamat`, `tgllahir`, `jnskelamin`, `notlp`) VALUES
(1, 'Ketut', 'ketut', '123', 'kk.png', 'karang', '2018-07-11', 'Laki-laki', '02312232'),
(2, 'Krisna', 'krisna', '321', 'll.PNG', 'pahoman', '2018-07-01', 'Laki-laki', '0321233'),
(3, 'Sanjaya', 'sanjaya', '123', 'jj.jpg', 'sukarame', '2018-07-04', 'Laki-laki', '04231231'),
(4, 'Mia khalifah', 'mia', '321', 'mm.jpg', 'raja basa', '2018-07-11', 'Perempuan', '0124123'),
(5, 'becool', 'becol', '123', 'krisna.jpg', 'mulyasari', '2018-07-11', 'Laki-laki', '12312312'),
(6, 'anjing', 'anjing', '123', 'krisna.jpg', 'jembatan', '2018-07-03', 'Laki-laki', '1312312312');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ids`);

--
-- Indexes for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  ADD PRIMARY KEY (`idk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbkomentar`
--
ALTER TABLE `tbkomentar`
  MODIFY `idk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
