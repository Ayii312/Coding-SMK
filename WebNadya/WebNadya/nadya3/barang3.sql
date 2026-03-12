-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nadyamart`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `jam` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama`, `gambar`, `deskripsi`, `harga`, `jam`, `tanggal`, `payment`) VALUES
(1, 'Mother Board', '', 'Motherboard (juga dikenal sebagai mainboard atau sistem board) adalah papan sirkuit utama dalam komputer. Ia berfungsi sebagai fondasi yang menghubungkan dan mengkoordinasikan semua komponen perangkat keras komputer, memungkinkan komunikasi antar komponen', 100000, NULL, '2025-05-21', ''),
(2, 'Flashdisk 32GB', '', 'Flashdisk adalah perangkat penyimpanan data portabel kecil yang menggunakan teknologi flash memory, biasanya terhubung melalui port USB. Perangkat ini digunakan untuk menyimpan dan mentransfer data antar perangkat, seperti komputer, laptop, atau smartphon', 80000, NULL, NULL, ''),
(3, 'Monitor', '', 'Monitor adalah perangkat keras pada komputer yang berfungsi untuk menampilkan hasil pemrosesan data dari CPU, seperti teks, gambar, dan video. Secara umum, monitor dapat diartikan sebagai layar visual yang menampilkan informasi dari komputer. ', 250000, NULL, NULL, ''),
(4, 'Laptop', '', 'Laptop, yang juga dikenal sebagai komputer jinjing atau notebook, adalah komputer pribadi yang memiliki ukuran kecil dan ringan sehingga mudah dipindahkan atau dibawa. Laptop memiliki fungsi yang sama dengan komputer desktop, seperti dapat menjalankan per', 2000000, '16:44:39', '2025-05-21', ''),
(5, 'Keyboard', '', 'Keyboard adalah perangkat input yang berfungsi untuk memasukkan teks, angka, simbol, dan perintah ke dalam komputer atau perangkat elektronik lainnya. Dengan keyboard, pengguna dapat berinteraksi dengan perangkat dan menjalankan berbagai fungsi, mulai dar', 70000, '16:48:12', '2025-05-10', ''),
(6, 'ESP32', 'esp32.jpg', '<p>Modul ESP32</p>\r\n', 90000, '20:31:00', '2025-05-16', 'OVO'),
(7, 'LCD I2C 16x2', 'lcd.jpg', '<p>LCD Project Arduino</p>\r\n', 25000, '20:31:00', '2025-05-20', 'Cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `kode_barang` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
