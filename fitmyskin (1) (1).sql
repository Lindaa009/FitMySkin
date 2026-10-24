-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2026 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitmyskin`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `tanggal_pemakaian` datetime NOT NULL,
  `kondisi_kulit` varchar(50) DEFAULT NULL,
  `jadwal_pemakaian` enum('Siang','Malam') DEFAULT NULL,
  `catatan_jadwal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id_jurnal`, `id_user`, `id_product`, `tanggal_pemakaian`, `kondisi_kulit`, `jadwal_pemakaian`, `catatan_jadwal`) VALUES
(1, 3, 1, '2026-10-08 18:48:43', 'Normal', 'Malam', 'Kulit terasa bersih setelah menggunakan cleanser'),
(2, 3, 2, '2026-10-08 18:48:43', 'Normal', 'Malam', 'Serum digunakan 2-3 tetes'),
(3, 3, 3, '2026-10-08 18:48:43', 'Baik', 'Malam', 'Kulit terasa lembap'),
(4, 3, 4, '2026-10-08 18:48:43', 'Baik', 'Siang', 'Digunakan sebelum beraktivitas di luar'),
(10, 3, 1, '2026-10-11 16:04:59', 'Nyaman', 'Siang', '{\"symptoms\":[],\"note\":\"\"}');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `bahan_aktif` varchar(255) DEFAULT NULL,
  `jenis_produk` enum('Cleanser','Toner','Serum','Moisturizer','Sunscreen','Masker','Exfoliator','Other') DEFAULT NULL,
  `jadwal_pemakaian` enum('Siang','Malam','Siang dan Malam') DEFAULT NULL,
  `status_pemakaian` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `catatan_product` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_user`, `nama_produk`, `merek`, `bahan_aktif`, `jenis_produk`, `jadwal_pemakaian`, `status_pemakaian`, `catatan_product`) VALUES
(1, 3, 'Gentle Cleanser', 'Skintific', 'Ceramide', 'Cleanser', 'Siang dan Malam', 'Aktif', 'Gunakan secukupnya'),
(2, 3, 'Niacinamide Serum', 'The Originote', 'Niacinamide', 'Serum', 'Malam', 'Aktif', 'Gunakan 2-3 tetes'),
(3, 3, 'Moisturizer', 'Skintific', 'Ceramide', 'Moisturizer', 'Siang dan Malam', 'Aktif', 'Gunakan setelah serum'),
(4, 3, 'Sunscreen', 'Azarine', 'SPF 50', 'Sunscreen', 'Siang', 'Aktif', 'Gunakan sebelum keluar rumah');

-- --------------------------------------------------------

--
-- Table structure for table `urutan_skincare`
--

CREATE TABLE `urutan_skincare` (
  `id_urutan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_diubah` date NOT NULL,
  `detail_urutan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urutan_skincare`
--

INSERT INTO `urutan_skincare` (`id_urutan`, `id_user`, `tanggal_diubah`, `detail_urutan`) VALUES
(1, 1, '2026-10-08', '1. Cleanser → 2. Toner → 3. Serum → 4. Moisturizer → 5. Sunscreen'),
(2, 1, '2026-10-08', '1. Cleanser → 2. Toner → 3. Serum → 4. Moisturizer → 5. Sunscreen'),
(3, 3, '2026-10-11', '{\"pagi\":[{\"title\":\"Facial Wash\",\"desc\":\"Langkah 1: Pembersih\"},{\"title\":\"Toner\",\"desc\":\"Langkah 2: Penyeimbang\"},{\"title\":\"Serum\",\"desc\":\"Langkah 3: Perawatan Khusus\"},{\"title\":\"Moisturizer\",\"desc\":\"Langkah 4: Pengunci\"},{\"title\":\"Sunscreen\",\"desc\":\"Langkah 5: Perlindungan Terluar\"}],\"malam\":[{\"title\":\"Facial Wash\",\"desc\":\"Langkah 1: Pembersih\"},{\"title\":\"Toner\",\"desc\":\"Langkah 2: Penyeimbang\"},{\"title\":\"Serum\",\"desc\":\"Langkah 3: Perawatan Khusus\"},{\"title\":\"Moisturizer\",\"desc\":\"Langkah 4: Pengunci\"}]}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `alamat_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `tipe_kulit` varchar(50) DEFAULT NULL,
  `concerns` text DEFAULT NULL,
  `alergi` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `alamat_email`, `password`, `foto_profil`, `tipe_kulit`, `concerns`, `alergi`, `tanggal_lahir`, `no_wa`) VALUES
(1, 'Nuha', 'nuha@gmail.com', '123456', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Userbaru', 'testbaru@example.com', '$2y$12$dQ0XeT2QhOhv5giadQkML.DeeqbKS64ggn3ad7s47LVREnMoQ8QHW', 'avatars/3eOJ2TmRF9A8nXxr0WYfF9deD4dW9QBkibxIMvGV.png', 'Kombinasi', '[\"pori pori tersumbat\"]', '[\"fragrance\"]', '2026-10-01', '+62  352-2343-2342');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `urutan_skincare`
--
ALTER TABLE `urutan_skincare`
  ADD PRIMARY KEY (`id_urutan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `alamat_email` (`alamat_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `urutan_skincare`
--
ALTER TABLE `urutan_skincare`
  MODIFY `id_urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `urutan_skincare`
--
ALTER TABLE `urutan_skincare`
  ADD CONSTRAINT `urutan_skincare_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
