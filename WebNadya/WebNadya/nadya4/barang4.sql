-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 03:58 PM
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
(1, 'Mother Board', 'mobo.jpg', '<p>Motherboard (juga dikenal sebagai mainboard atau sistem board) adalah papan sirkuit utama dalam komputer. Ia berfungsi sebagai fondasi yang menghubungkan dan mengkoordinasikan semua komponen perangkat keras komputer, memungkinkan komunikasi antar kompo', 100000, '22:22:00', '2025-05-17', 'Transfer'),
(2, 'Flashdisk', 'flashdisk.jpg', '<p>Flashdisk adalah perangkat penyimpanan data portabel kecil yang menggunakan teknologi flash memory, biasanya terhubung melalui port USB. Perangkat ini digunakan untuk menyimpan dan mentransfer data antar perangkat, seperti komputer, laptop, atau smartp', 80000, '11:42:00', '2025-05-12', 'Cash'),
(3, 'Monitor', 'monitor.jpg', '<p>Monitor adalah perangkat keras pada komputer yang berfungsi untuk menampilkan hasil pemrosesan data dari CPU, seperti teks, gambar, dan video. Secara umum, monitor dapat diartikan sebagai layar visual yang menampilkan informasi dari komputer.</p>\r\n', 1000000, '08:50:00', '2025-05-19', 'Qris'),
(4, 'Laptop', 'laptop.jpg', '<p>Laptop, yang juga dikenal sebagai komputer jinjing atau notebook, adalah komputer pribadi yang memiliki ukuran kecil dan ringan sehingga mudah dipindahkan atau dibawa. Laptop memiliki fungsi yang sama dengan komputer desktop, seperti dapat menjalankan ', 2500000, '11:15:00', '2025-05-31', 'OVO'),
(5, 'Keyboard', 'keyboard.jpg', '<p>Keyboard adalah perangkat input yang berfungsi untuk memasukkan teks, angka, simbol, dan perintah ke dalam komputer atau perangkat elektronik lainnya. Dengan keyboard, pengguna dapat berinteraksi dengan perangkat dan menjalankan berbagai fungsi.</p>\r\n', 99000, '06:36:00', '2025-05-11', 'Shopeepay'),
(6, 'ESP32', 'espp.jpg', '<p>ESP32 adalah&amp;nbsp;mikrokontroler SoC (System on Chip) yang dikembangkan oleh Espressif Systems, yang merupakan penerus dari ESP8266.</p>\r\n', 90000, '16:54:00', '2025-05-12', 'Transfer'),
(7, 'LCD I2C 16x2', 'lcdi2c.jpg', '<p>LCD I2C adalah&amp;nbsp;layar LCD yang menggunakan antarmuka komunikasi I2C untuk terhubung dengan mikrokontroler atau perangkat lain.&amp;nbsp;Antarmuka I2C mempermudah koneksi dan pemrograman LCD dibandingkan dengan LCD standar yang membutuhkan banya', 25000, '14:56:00', '2025-05-31', 'Gopay');

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
