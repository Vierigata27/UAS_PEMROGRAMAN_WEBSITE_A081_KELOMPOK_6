-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 01:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `padu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `nama`, `email`, `no`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'test', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `no_berita` int(100) NOT NULL,
  `no_pengaduan` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `judul` varchar(300) NOT NULL,
  `keterangan_laporan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `hasil_berita` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`no_berita`, `no_pengaduan`, `user_id`, `judul`, `keterangan_laporan`, `status`, `gambar`, `tempat`, `admin_id`, `hasil_berita`, `waktu`) VALUES
(10, 'F1', 4, 'AC Rusak di FIK', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At cumque sapiente incidunt consectetur quis ducimus aperiam esse, saepe blanditiis molestiae, culpa adipisci distinctio soluta voluptatem itaque, corporis nihil architecto quas.', 'Selesai', 'ac.jpg', '', 1, 'KAMI TELAH MENUNJUKAN KEPADA PIHAK TERKAIT DALAM BEBERAPA HARI AC AKAN DI PERBAIKI, TERIMA KASIH', '2023-06-11 12:46:01'),
(11, 'F1', 4, 'AC Rusak di FIK', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. At cumque sapiente incidunt consectetur quis ducimus aperiam esse, saepe blanditiis molestiae, culpa adipisci distinctio soluta voluptatem itaque, corporis nihil architecto quas.', 'Tindak Lanjut', 'ac.jpg', '', 1, 'ac akan di perbaiki tanggal 27-08-2024', '2023-06-12 04:37:54'),
(12, 'K1', 4, 'KEKERASAN DI AREA UPN', 'HAII SAYA MENGADU ADA TINDAK KEKERASAN DI AREA UPN', 'Publikasi', '', '', 1, '', '2023-06-12 05:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `no_komentar` int(200) NOT NULL,
  `no_berita` varchar(300) NOT NULL,
  `user_id` int(100) NOT NULL,
  `teks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`no_komentar`, `no_berita`, `user_id`, `teks`) VALUES
(1, '11', 4, 'WOW SANGAT BAGUS SEKALI'),
(8, '11', 4, 'cek'),
(9, '11', 4, 'lalalla'),
(10, '12', 4, 'cek cek'),
(11, '12', 4, 'lolololo'),
(12, '12', 4, 'hai');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan_fasilitas`
--

CREATE TABLE `pengaduan_fasilitas` (
  `no_pengaduan` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan_laporan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `tempat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan_kekerasan`
--

CREATE TABLE `pengaduan_kekerasan` (
  `no_pengaduan` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan_laporan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `tempat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan_kekerasan`
--

INSERT INTO `pengaduan_kekerasan` (`no_pengaduan`, `user_id`, `judul`, `keterangan_laporan`, `status`, `waktu`, `tempat`) VALUES
('K1', 4, 'forza', '12323', 'Publikasi', '2023-06-12', 'Gedung FIK 1'),
('K2', 4, 'Atomic Habits', 'vfsfsfsfsf', 'Vertifikasi', '2023-06-12', 'Gedung FIK 1'),
('K3', 4, 'test', 'tegfefefefefeff', 'Vertifikasi', '2023-06-13', 'Gedung FIK 1');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan_lain`
--

CREATE TABLE `pengaduan_lain` (
  `no_pengaduan` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan_laporan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `tempat` varchar(300) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan_susila`
--

CREATE TABLE `pengaduan_susila` (
  `no_pengaduan` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `keterangan_laporan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `tempat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `npm` varchar(100) NOT NULL,
  `no` varchar(50) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama`, `email`, `npm`, `no`, `gender`, `tanggal_lahir`, `fakultas`, `prodi`, `password`, `foto`) VALUES
(4, 'Vieri Arief Maulana', '21081010140@student.upnjatim.ac.id', '21081010140', '082331646363', 'Laki-Laki', '2003-06-29', 'Ilmu Komputer', 'Informatika', '$2y$10$tsyaYDA1sunKzudbhZuna.n3waalJmZPMK.PT16lZMbUyMf/1OI2G', '12 MIPA7, VIERI ARIEF M _compress40.jpg'),
(5, 'Ersalina', '21081010123@student.upnjatim.ac.id', '21081010123', '08233164322', 'Perempuan', '2003-04-26', 'Ekonomi', 'Menejent', '$2y$10$KqdhdjHV/pU1TNfcIe59K.F20xbib5mkj7rDFh1yKXVaFHAFBRdhq', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`no_berita`),
  ADD KEY `no_pengaduan` (`no_pengaduan`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`no_komentar`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `no_pengaduan` (`no_berita`);

--
-- Indexes for table `pengaduan_fasilitas`
--
ALTER TABLE `pengaduan_fasilitas`
  ADD PRIMARY KEY (`no_pengaduan`);

--
-- Indexes for table `pengaduan_kekerasan`
--
ALTER TABLE `pengaduan_kekerasan`
  ADD PRIMARY KEY (`no_pengaduan`);

--
-- Indexes for table `pengaduan_lain`
--
ALTER TABLE `pengaduan_lain`
  ADD PRIMARY KEY (`no_pengaduan`);

--
-- Indexes for table `pengaduan_susila`
--
ALTER TABLE `pengaduan_susila`
  ADD PRIMARY KEY (`no_pengaduan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `no_berita` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `no_komentar` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
