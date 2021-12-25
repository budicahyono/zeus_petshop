-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 08:35 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zeus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `idbayar` int(11) NOT NULL,
  `notransaksi` int(11) DEFAULT NULL,
  `pengirim` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `jml_transfer` varchar(45) DEFAULT NULL,
  `tgl_transfer` date DEFAULT NULL,
  `foto_struk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`idbayar`, `notransaksi`, `pengirim`, `email`, `jml_transfer`, `tgl_transfer`, `foto_struk`) VALUES
(1, 1, 'Tes Aja', 'tes@gmail.com', '95000', '2020-08-01', 'trx_struk_1.jpg'),
(2, 2, 'Tes Aja', 'tes@gmail.com', '160000', '2020-08-28', 'trx_struk_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chatting`
--

CREATE TABLE `chatting` (
  `id` int(11) NOT NULL,
  `id_chatting` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `status_chat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatting_detail`
--

CREATE TABLE `chatting_detail` (
  `id_chatting_detail` int(11) NOT NULL,
  `id_chatting` int(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kopos` int(11) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `email`, `username`, `password`, `telepon`, `alamat`, `kopos`, `provinsi`, `kota`, `status`) VALUES
(1, 'Tes Aja', 'tes@gmail.com', 'tes', '$2y$10$q53YqttLPcf2NtdoG.T49.ah76kO8BQ.76ou0l5u5lyanVUQnqpeC', '123', 'Jalan Gunung Salju Amban', 98311, '25', '272', 1),
(2, 'Anak JKT', 'jakarta@gmail.com', 'jakarta', '$2y$10$ZW1sWXwQ3C1c5Pcg.K9uJu3GZjiftsIxsB4/NtxdOuuG/iyU59aHW', '08112', 'Blok M', 11220, '6', '151', 1),
(3, 'Sembarang aja', 'sembarang@gmail.com', 'sembarang', '$2y$10$aJLnQpXMLnvL6TXqB/q4aOT5/RiDRO/yRN6eqiAAzxw.nB22I3/fa', '0812', 'Jalan mana aja', 82119, '1', '447', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kat` int(3) NOT NULL,
  `judul_kat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kat`, `judul_kat`) VALUES
(1, 'Makanan Anjing'),
(2, 'Makanan Kucing'),
(3, 'Pet Care');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(1) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `notransaksi` int(11) NOT NULL,
  `origin` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `service` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `id_customer`, `notransaksi`, `origin`, `destination`, `weight`, `service`) VALUES
(1, 1, 1, 272, 272, 1500, 'CTC'),
(2, 1, 2, 272, 272, 120, 'CTC'),
(3, 2, 3, 272, 151, 60, 'OKE');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(300) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `seo_deskripsi` varchar(100) NOT NULL,
  `seo_keywords` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `warna` varchar(100) NOT NULL,
  `kat` int(11) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(4) NOT NULL,
  `garansi` varchar(25) NOT NULL,
  `uploader` varchar(200) NOT NULL,
  `updater` varchar(200) NOT NULL,
  `jam_upload` time NOT NULL,
  `tgl_upload` date NOT NULL,
  `jam_update` time NOT NULL,
  `tgl_update` date NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `judul_seo`, `seo_deskripsi`, `seo_keywords`, `deskripsi`, `warna`, `kat`, `harga`, `stok`, `berat`, `garansi`, `uploader`, `updater`, `jam_upload`, `tgl_upload`, `jam_update`, `tgl_update`, `img`) VALUES
(1, 'Royal Canin Zhitsu Adult', 'royal-canin-zhitsu-adult', 'Royal Canin Zhitsu Adult', 'Royal Canin Zhitsu Adult', 'Royal Canin Zhitsu Adult Makanan Anjing kemasan 2 kg', '', 1, '280000', 10, 2000, '', 'admin', 'admin', '13:08:04', '2019-09-01', '19:18:37', '2020-08-27', 'royal-canin-zhitsu-adult.png'),
(2, 'Royal Canin Maxi Puppy', 'royal-canin-maxi-puppy', 'Royal Canin Maxi Puppy', 'Royal Canin Maxi Puppy', 'Royal Canin Maxi Puppy Makanan Anjing kemasan 4 kg', '', 1, '480000', 9, 4000, '', 'admin', 'admin', '20:54:44', '2019-09-01', '21:19:57', '2019-09-01', 'royal-canin-maxi-puppy.jpg'),
(3, 'Royal Canin maxi adult', 'royal-canin-maxi-adult', 'royal canin maxi adult', 'Royal Canin maxi adult', 'Royal Canin maxi adult Makanan Anjing 15 kg', '', 1, '1230000', 18, 15000, '', 'admin', 'admin', '21:01:10', '2019-09-01', '21:58:30', '2019-09-01', 'royal-canin-maxi-adult.jpg'),
(4, 'Equilibrio Adult', 'equilibrio-adult', 'equilibrio adult', 'Equilibrio Adult', 'Equilibrio Adult Makanan Anjing kemasan 2 kg', '', 1, '210000', 1, 2000, '', 'admin', 'admin', '21:02:10', '2019-09-01', '21:58:49', '2019-09-01', 'equilibrio-adult.jpg'),
(5, 'Pedigree Adult', 'pedigree-adult', 'pedigree adult', 'Pedigree Adult', 'Pedigree Adult Makanan Anjing 1,5 kg', '', 1, '75000', 17, 1500, '', 'admin', 'admin', '21:05:42', '2019-09-01', '22:14:56', '2019-09-01', 'pedigree-adult.jpg'),
(6, 'Royal Canin Persian Adult', 'royal-canin-persian-adult', 'Royal Canin Persian Adult', 'royal canin persian adult', 'Royal Canin Persian Adult Makanan Kucing Kemasan 2 kg', '', 2, '350000', 32, 2000, '', 'admin', '', '21:31:57', '2019-09-01', '00:00:00', '0000-00-00', 'royal-canin-persian-adult.jpg'),
(7, 'Purina Proplan Kitten', 'purina-proplan-kitten', 'Purina Proplan Kitten', 'purina proplan kitten', 'Purina Proplan Kitten Makanan Kucing Kemasan 2,5 kg', '', 2, '450000', 30, 2500, '', 'admin', '', '21:34:53', '2019-09-01', '00:00:00', '0000-00-00', 'purina-proplan-kitten.jpg'),
(8, 'Equilibrio Adult Cat', 'equilibrio-adult-cat', 'Equilibrio Adult Cat', 'Equilibrio Adult Cat', 'Equilibrio Adult Cat Makanan Kucing Kemasan 1,5 kg', '', 2, '250000', 17, 1500, '', 'admin', '', '21:38:06', '2019-09-01', '00:00:00', '0000-00-00', 'equilibrio-adult-cat.jpg'),
(9, 'Whiskas Adult', 'whiskas-adult', 'Whiskas Adult', 'whiskas adult', 'Whiskas Adult Makanan Kucing kemasan 1 kg', '', 2, '75000', 19, 1000, '', 'admin', 'admin', '21:40:34', '2019-09-01', '21:43:14', '2019-09-01', 'whiskas-adult.jpg'),
(10, 'Whiskas Babycat', 'whiskas-babycat', 'Whiskas Babycat', 'Whiskas Babycat', 'Whiskas Babycat Makanan Kucing kemasan 85 gram', '', 2, '8000', 7, 85, '', 'admin', 'admin', '21:42:40', '2019-09-01', '21:43:32', '2019-09-01', 'whiskas-babycat.jpg'),
(11, 'Drontal Tablet Cat', 'drontal-tablet-cat', 'Drontal Tablet Cat', 'Drontal Tablet Cat', 'Drontal Tablet Cat ', '', 3, '25000', 197, 10, '', 'admin', '', '21:46:47', '2019-09-01', '00:00:00', '0000-00-00', 'drontal-tablet-cat.jpg'),
(12, 'Nutri Plus Gel', 'nutri-plus-gel', 'Nutri Plus Gel', 'Nutri Plus Gel', 'Nutri Plus Gel', '', 3, '150000', 295, 120, '', 'admin', '', '21:48:44', '2019-09-01', '00:00:00', '0000-00-00', 'nutri-plus-gel.jpg'),
(13, 'Scabies Cream Majittu', 'scabies-cream-majittu', 'Scabies Cream Majittu', 'Scabies Cream Majittu', 'Scabies Cream Majittu pembasmi kutu Anjing', '', 3, '50000', 199, 50, '', 'admin', '', '21:51:00', '2019-09-01', '00:00:00', '0000-00-00', 'scabies-cream-majittu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `notransaksi` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`notransaksi`, `username`, `tgl_checkout`, `status`) VALUES
(1, 'tes', '2020-08-01', 3),
(2, 'tes', '2020-08-28', 3),
(3, 'jakarta', '2020-08-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(1) NOT NULL,
  `notransaksi` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(300) NOT NULL,
  `berat` varchar(15) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `jumlah` varchar(15) NOT NULL,
  `jumlah_berat` varchar(15) NOT NULL,
  `subtotal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `notransaksi`, `username`, `id_produk`, `nama_produk`, `berat`, `harga`, `jumlah`, `jumlah_berat`, `subtotal`) VALUES
(1, '1', 'tes', 5, 'Pedigree Adult', '1500', '75000', '1', '1500', '75000'),
(2, '2', 'tes', 12, 'Nutri Plus Gel', '120', '150000', '1', '120', '150000'),
(3, '3', 'jakarta', 11, 'Drontal Tablet Cat', '10', '25000', '1', '10', '25000'),
(4, '3', 'jakarta', 13, 'Scabies Cream Majittu', '50', '50000', '1', '50', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `no_rek` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `foto`, `no_rek`, `bank`, `no_hp`) VALUES
(1, 'Ando Kanipa', 'admin', '$2y$10$byXtb/XM4s8u1aE05xABHOkeYNuU3M1QDRJOHWeRqvvxGAt/DvDym', 'admin.jpg', '123', 'Danamon', '0821-9965-9071');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`idbayar`);

--
-- Indexes for table `chatting`
--
ALTER TABLE `chatting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatting_detail`
--
ALTER TABLE `chatting_detail`
  ADD PRIMARY KEY (`id_chatting_detail`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `fk_customer_transaksi_detail1_idx` (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`notransaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_user_jawab1_idx` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `idbayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chatting`
--
ALTER TABLE `chatting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chatting_detail`
--
ALTER TABLE `chatting_detail`
  MODIFY `id_chatting_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kat` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `notransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
