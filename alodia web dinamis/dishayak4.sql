-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 03:45 PM
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
-- Database: `ayloaff`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id_dish` int(255) NOT NULL,
  `gambar_dish` varchar(255) NOT NULL,
  `nama_dish` text NOT NULL,
  `harga_dish` decimal(15,3) NOT NULL,
  `deskripsi_dish` varchar(255) NOT NULL,
  `tanggal_beli` date DEFAULT NULL,
  `jam` time NOT NULL,
  `order` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id_dish`, `gambar_dish`, `nama_dish`, `harga_dish`, `deskripsi_dish`, `tanggal_beli`, `jam`, `order`) VALUES
(0, 'backdrop.png', 'PENTOL BIHUN', 6000.000, '<p>Dibuat dengan daging ayam dan udang, menciptakan rasa yang luar biasa</p>\r\n', '2025-05-20', '20:22:00', 'Take Away'),
(1, 'WhatsApp Image 2025-05-10 at 18.46.42.jpeg', 'gatau ya', 2000.000, '<p>lalalalalalalal</p>\r\n', '2025-05-17', '20:46:00', 'Take Away'),
(2, 'backdrop.png', 'MIGOR', 10000.000, '<p>mie gowreenggg</p>\r\n', '2025-05-21', '20:37:00', 'Dine in'),
(3, '', 'PISUKE', 5.000, 'PISUKE adalah Pisang Susu Keju, makanan ringan yang sangat enak, yang terbuat dari pisang yg di temani dengan susu dan ditambah dengan keju.', NULL, '00:00:00', ''),
(4, '', 'BURGER', 5.000, 'Burger adalah makanan yang berupa roti dan berbentuk bundar, diiris menjadi dua, dan ditengahnya berisi patty, kemudian ditambahkan dengan saus mayonais dan sayur-sayuran seperti selada, tomat dan timun.', NULL, '00:00:00', ''),
(5, '', 'HOT DOG', 5.000, 'Hot dog adalah hidangan yang terdiri dari sosis panggang, kukus, atau rebus yang disajikan di dalam irisan roti dilengkapi dengan saus dan sayur-sayuran.', NULL, '00:00:00', ''),
(6, '', 'SAMOSA', 5.000, 'Isi dari camilan ini adalah kentang yang dibumbui, bawang, kacang polong, daging sapi atau ayam. Selain itu terdapat samosa dengan isian sayur dan bahan makanan vegetarian lainnya.', NULL, '00:00:00', ''),
(7, '', 'PEMPEK', 5.000, 'Pempek terbuat dari campuran daging ikan giling, tapioka, air, dan bumbu-bumbu, yang biasanya disajikan dengan kuah cuko.', NULL, '00:00:00', ''),
(8, '', 'KEBAB', 5.000, 'Kelebihan kebab dibanding makanan khas berbahan daging seperti burger dan sejenisnya adalah, irisan dagingnya tipis dan banyak. Ada pula perpaduan sayur dan lainnya, sehingga kandungan gizi dari satu porsi kebab bisa memenuhi kebutuhan gizi Anda.', NULL, '00:00:00', ''),
(9, '', 'RISOL MAYO', 5.000, 'Berbentuk gulungan yang memiliki berbagai isian, dari ragout, telur, hingga smoked beef. Biasanya, risol disajikan dengan cara digoreng dan dimakan bersama saus sambal. Perpaduan rasa renyah dan creamy pada risol ini menciptakan rasa yang gurih dan renyah', NULL, '00:00:00', ''),
(12, '', 'MIE GORENG', 5.000, 'Mie goreng terletak pada perpaduan sempurna rasa gurih dan manisnya. Mie, yang biasanya terbuat dari tepung terigu, digoreng dengan saus gurih yang seringkali termasuk kecap asin, bawang putih, jahe, dan cabai.', NULL, '00:00:00', ''),
(13, '', 'MIE GORENG', 5.000, 'Mie goreng terletak pada perpaduan sempurna rasa gurih dan manisnya. Mie, yang biasanya terbuat dari tepung terigu, digoreng dengan saus gurih yang seringkali termasuk kecap asin, bawang putih, jahe, dan cabai.', NULL, '00:00:00', ''),
(27, 'WhatsApp Image 2025-05-21 at 11.46.19.jpeg', 'gatau ya', 2.000, '<p>LALALALALALA</p>\r\n', '2025-05-30', '01:29:00', 'Dine in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id_dish`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id_dish` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
