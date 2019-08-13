-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2019 at 03:36 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `idberita` bigint(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice`
--

CREATE TABLE IF NOT EXISTS `detail_invoice` (
  `id_invoice` int(11) NOT NULL,
  `noinvoice` varchar(6) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_invoice`
--

INSERT INTO `detail_invoice` (`id_invoice`, `noinvoice`, `idproduk`, `jumlah`, `harga_jual`, `ongkir`) VALUES
(1, 'T00001', 2, 2, 40000, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `noinvoice` varchar(6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `totalbayar` float NOT NULL,
  `jmlbrg` int(11) NOT NULL,
  `transfer` int(11) NOT NULL,
  `tglkirim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`noinvoice`, `tanggal`, `idpelanggan`, `totalbayar`, `jmlbrg`, `transfer`, `tglkirim`) VALUES
('T00001', '2019-05-23 20:39:58', 10, 87000, 2, 1, '2019-05-23 20:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
(1, 'Kopi tubruk'),
(2, 'kopi bubuk'),
(3, 'Kopi gayo'),
(4, 'Kopi garut'),
(5, 'Kopi toraja'),
(6, 'Kopi ciwidey'),
(7, 'Kopi buhun'),
(8, 'Kopi blend'),
(9, 'Kopi kintamani'),
(10, 'Kopi manglayang'),
(11, 'Kopi robusta'),
(12, 'Kopi lintong');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE IF NOT EXISTS `ongkir` (
  `kodepos` int(11) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`kodepos`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `ongkir`) VALUES
(876556, 'kjj', 'hkjhk', 'hjkhj', 'hjhk', 787678),
(987654, 'Pasir awi', 'Pasar kemis', 'tangerang', 'banten', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `kelamin` set('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kodepos` int(11) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `kelamin`, `email`, `alamat`, `kodepos`, `kota`, `telp`, `tanggal_daftar`, `password`, `status`) VALUES
(4, 'Muhammad Ridwan', 'L', 'mr_rid15@gmail.com', 'THB Blok U4/14', 14125, 'bekasi', '085776335003', '2015-11-24', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(8, 'naufal', 'L', 'mursyidnaufal@gmail.com', '					\r\n		b		', 3, 'bandung', '0898989898', '2015-11-24', '9b10fff33476b792f79cdcce22598a48', 0),
(9, 'Ridwan', 'L', 'ridwan@gmail.com', 'thb u4/14					\r\n				', 14125, 'Bekasi', '085776335003', '2015-11-25', 'aa7b2038f04af0e4e62858a8f805aa64', 1),
(10, 'oong', 'L', 'oong.julian@yahoo.co.id', 'bgjh					\r\n				', 987654, 'tangerang', '09876855678', '2018-07-27', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(11, 'julian', 'L', 'jul@yahoo.com', 'hkjjg					\r\n				', 987654, 'tangerang', '989798765432', '2018-08-31', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(12, 'julian', 'L', 'jul@gmail.com', 'test', 987654, 'Tangerang', '087654345654', '2019-05-17', '827ccb0eea8a706c4c34a16891f84e7b', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE IF NOT EXISTS `pengelola` (
  `idpengelola` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`idpengelola`, `nama`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'o@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Muhammad Ridwan', 'ridwan', '', 'd584c96e6c1ba3ca448426f66e552e8e');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `idproduk` int(10) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `idkategori` int(255) NOT NULL,
  `deskripsi` text,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama_produk`, `idkategori`, `deskripsi`, `foto`) VALUES
(1, 'Kopi Sn', 1, 'kopi ini sangat enak', 'biji_kopi_kiloan_robusta_jawa_barat.jpg'),
(2, 'Kopi H', 2, 'kopi murni berkualitas									', 'kopi-murni-asli-1.jpeg'),
(3, 'Kopi gayo 1', 3, 'Kopi tanpa bahan pengawet									', 'kopi gayo 1.jpg'),
(4, 'kopi garut 1', 4, 'dijamin enak					', 'garut n 5.jpg'),
(5, 'Kopi buhun ', 7, 'No 1 kopi asli									', 'buhun 3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `idstok` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `idproduk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 1, 10000, 20000, 5),
(2, 2, 30000, 40000, 5),
(3, 3, 120000, 130000, 7),
(4, 4, 30000, 40000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dreturn`
--

CREATE TABLE IF NOT EXISTS `tbl_dreturn` (
  `noreturn` varchar(8) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return`
--

CREATE TABLE IF NOT EXISTS `tbl_return` (
  `noreturn` varchar(8) NOT NULL,
  `noinvoice` varchar(6) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `tgl_return` date NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id` int(11) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `no_transaksi` int(11) NOT NULL,
  `noinvoice` varchar(6) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `nama_rekening` varchar(30) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `rekening` int(11) NOT NULL,
  `transfer` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`noinvoice`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`kodepos`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`idpengelola`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `tbl_return`
--
ALTER TABLE `tbl_return`
  ADD PRIMARY KEY (`noreturn`);

--
-- Indexes for table `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `idberita` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `idpengelola` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
