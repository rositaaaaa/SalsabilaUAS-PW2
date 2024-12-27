-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ranti.tb_pendaftaran
CREATE TABLE IF NOT EXISTS `tb_pendaftaran` (
  `Id_Pendaftaran` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Peserta` int(11) NOT NULL,
  `Id_Seminar` int(11) NOT NULL,
  `Status` enum('Terdaftar','Dikonfirmasi','Batal') NOT NULL,
  `Tanggal_Daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Metode_Pembayaran` enum('Transfer','Cash','Gratis') NOT NULL,
  `Jumlah_Bayar` int(11) NOT NULL,
  `Bukti_Pembayaran` varchar(255) NOT NULL,
  `Catatan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Pendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ranti.tb_pendaftaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_pendaftaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pendaftaran` ENABLE KEYS */;

-- Dumping structure for table ranti.tb_peserta
CREATE TABLE IF NOT EXISTS `tb_peserta` (
  `Id_Peserta` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telepon` varchar(15) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `Posisi` varchar(50) NOT NULL,
  `Kategori` enum('Umum','Mahasiswa','Dosen') NOT NULL,
  `Kehadiran` enum('Hadir','Tidak Hadir') NOT NULL,
  `Upload_file` varchar(255) NOT NULL,
  `Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ranti.tb_peserta: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_peserta` DISABLE KEYS */;
INSERT INTO `tb_peserta` (`Id_Peserta`, `Nama`, `Email`, `Telepon`, `Alamat`, `Posisi`, `Kategori`, `Kehadiran`, `Upload_file`, `Dibuat`) VALUES
	(5, 'asd', 'arieflukman557@gmail.com', '082180181958', 'Jl.Jambi Simpang III Sipin Kota Baru Kota Jambi', 'asd', 'Umum', 'Hadir', '59273fd2918b801b34d69fd03d42a03f.jpg', '2024-12-19 13:05:43');
INSERT INTO `tb_peserta` (`Id_Peserta`, `Nama`, `Email`, `Telepon`, `Alamat`, `Posisi`, `Kategori`, `Kehadiran`, `Upload_file`, `Dibuat`) VALUES
	(6, 'asd', 'arieflukman557@gmail.comasd', '082180181958', 'Jl.Jambi Simpang III Sipin Kota Baru Kota Jambi', 'asd', 'Umum', 'Hadir', '59273fd2918b801b34d69fd03d42a03f.jpg', '2024-12-19 13:06:40');
INSERT INTO `tb_peserta` (`Id_Peserta`, `Nama`, `Email`, `Telepon`, `Alamat`, `Posisi`, `Kategori`, `Kehadiran`, `Upload_file`, `Dibuat`) VALUES
	(7, 'adsdas', 'dea@gmail.com', '1312312312', 'Jl.Jambi Simpang III Sipin Kota Baru Kota Jambi', 'ad', 'Umum', 'Hadir', 'Scan Here.png', '2024-12-19 13:07:03');
/*!40000 ALTER TABLE `tb_peserta` ENABLE KEYS */;

-- Dumping structure for table ranti.tb_seminar
CREATE TABLE IF NOT EXISTS `tb_seminar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Judul` varchar(200) NOT NULL,
  `Deskripsi` text NOT NULL,
  `Tanggal` date NOT NULL,
  `Lokasi` varchar(255) NOT NULL,
  `Kapasitas` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Kategori` varchar(100) NOT NULL,
  `Narasumber` varchar(100) NOT NULL,
  `Dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ranti.tb_seminar: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_seminar` DISABLE KEYS */;
INSERT INTO `tb_seminar` (`ID`, `Judul`, `Deskripsi`, `Tanggal`, `Lokasi`, `Kapasitas`, `Harga`, `Kategori`, `Narasumber`, `Dibuat`) VALUES
	(1, 'Pablic spiking', 'Benefit yang kamu dapatkan :\r\n Dapat Esertifikat\r\n More relation!', '2024-12-30', 'Via zoom', 250, 25, 'Pendidikan', 'Siti S.kom', '2024-12-17 16:59:30');
INSERT INTO `tb_seminar` (`ID`, `Judul`, `Deskripsi`, `Tanggal`, `Lokasi`, `Kapasitas`, `Harga`, `Kategori`, `Narasumber`, `Dibuat`) VALUES
	(2, 'Worshop digital agus sedih', 'Pelajari teknik-taknik baru', '2024-12-01', 'Jakarta', 100, 500000, '', 'John Doe', '2024-12-18 07:16:41');
INSERT INTO `tb_seminar` (`ID`, `Judul`, `Deskripsi`, `Tanggal`, `Lokasi`, `Kapasitas`, `Harga`, `Kategori`, `Narasumber`, `Dibuat`) VALUES
	(5, 'tes judul', 'tes deskripsi', '2024-12-18', 'palembang', 20, 3000, '', 'agus sedih', '2024-12-18 23:02:49');
/*!40000 ALTER TABLE `tb_seminar` ENABLE KEYS */;

-- Dumping structure for table ranti.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Pimpinan','User') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ranti.tb_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`Id`, `username`, `password`, `role`) VALUES
	(1, 'admin', '$2y$10$M8xS5ht.DpbI06uZrk3wzuPjwVEaBHgOPLLcqa2NnHjgIsythwtM.', 'Admin');
INSERT INTO `tb_user` (`Id`, `username`, `password`, `role`) VALUES
	(14, 'user', '$2y$10$2orVf6MeCr8u5B3wjPDlfekIKi/fw3LVHX2IfeC.N8y5zD1hAIpjG', 'User');
INSERT INTO `tb_user` (`Id`, `username`, `password`, `role`) VALUES
	(15, 'pimpinan', '$2y$10$6zkTWn7LLU5Zx14fYVmkmOgFXmxRCP.sIjIaxzsnWE.PR80RmSP0W', 'Pimpinan');
INSERT INTO `tb_user` (`Id`, `username`, `password`, `role`) VALUES
	(16, 'user', '$2y$10$b73/zvTfr7rlrZsWAwF9pOs1ZLf1Yvx5ubRaOETPAsJTytTFNI4my', 'User');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
