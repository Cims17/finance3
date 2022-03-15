-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 07:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rahma`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `idAkun` int(11) NOT NULL,
  `kodeAkun` varchar(255) NOT NULL,
  `jenisAkun` varchar(255) NOT NULL,
  `namaAkun` varchar(255) NOT NULL,
  `saldoAwal` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `saldoAkhir` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`idAkun`, `kodeAkun`, `jenisAkun`, `namaAkun`, `saldoAwal`, `kredit`, `debit`, `saldoAkhir`, `created_at`, `updated_at`) VALUES
(0, '121234', 'adawdaw', 'memew', 200000, 0, 0, 202000, '0000-00-00', '2022-01-16'),
(1, '110-123', 'Belanja', 'Aset', 0, 0, 0, 123123, '0000-00-00', ''),
(2, '123123', 'awda', 'wdawdad', 0, 0, 0, 0, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(11) NOT NULL,
  `kodeBarang` varchar(55) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `idJenis` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idBarang`, `kodeBarang`, `nama`, `idJenis`, `keterangan`, `harga`, `created_at`) VALUES
(1, '110-120', 'Pring', 2, 'Mudah Rusak', 20000, 20220117),
(2, '2013123', 'priing', 1, 'Barang ', 2000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_usaha`
--

CREATE TABLE `info_usaha` (
  `idUsaha` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `idJenis` int(11) NOT NULL,
  `namaJenis` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`idJenis`, `namaJenis`, `created_at`) VALUES
(1, 'Sembako', '2022-01-16 20:09:43'),
(2, 'Pecah Belah', '2022-01-16 20:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `log_akun`
--

CREATE TABLE `log_akun` (
  `idAkun` int(11) NOT NULL,
  `saldoAwal` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_akun`
--

INSERT INTO `log_akun` (`idAkun`, `saldoAwal`, `kredit`, `debit`, `keterangan`, `tanggal`) VALUES
(0, 200000, NULL, NULL, 'asuuuu', '2022-01-16 19:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idPelanggan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `status` enum('Mitra','Non Mitra','','') NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `nama`, `alamat`, `no_telp`, `status`, `created_at`) VALUES
(1, 'wadwad', 'awda', 'awdawd', 'Mitra', 'awdawd'),
(2, 'fadel', 'awdawd', '0892323', 'Mitra', ''),
(3, 'wadwd', 'awdad', 'awdad', 'Mitra', ''),
(4, 'awd', ' Jl. Imam Bonjol No.26. Kel. Alai Gelombang', 'wdad', 'Mitra', '');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idPembelian` int(11) NOT NULL,
  `noTransaksi` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idTransaksi` int(11) NOT NULL,
  `noTransaksi` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `pelanggan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `idTransaksi` int(11) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `alamat`, `npwp`, `tanggal`) VALUES
(1, 'hehe', 'ehehe', 'hehe', '2022-01-16 19:57:34'),
(2, 'awdad', 'wdawd', 'awdadw', '2022-01-16 20:04:23'),
(3, 'babap', 'awd', 'wd', '2022-01-16 20:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `idAkun` int(11) NOT NULL,
  `saldoAwal` int(11) DEFAULT NULL,
  `kredit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `saldoAkhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`idAkun`, `saldoAwal`, `kredit`, `debit`, `saldoAkhir`) VALUES
(1, 0, 10000, 1000, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idSupp` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idSupp`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'awdawd', 'awda', '1231290129'),
(2, 'awd', 'awd', 'wda'),
(3, 'awdw', 'dawd', 'wadd'),
(4, 'awd', 'awd', 'awd');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `username`, `email`, `password`, `role`) VALUES
(1, 'fadel', 'fadelirsyad10@gmail.com', '$2y$10$5w5L4nAQKMJEAmc65lJdBeHyCExzfOA5CHVps2NWhwVq/ZsyGw71.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idAkun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`),
  ADD KEY `idjenis` (`idJenis`);

--
-- Indexes for table `info_usaha`
--
ALTER TABLE `info_usaha`
  ADD PRIMARY KEY (`idUsaha`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`idJenis`);

--
-- Indexes for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD KEY `akun2` (`idAkun`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idPelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idPembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD KEY `penjualan` (`idTransaksi`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD KEY `akun1` (`idAkun`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idSupp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `info_usaha`
--
ALTER TABLE `info_usaha`
  MODIFY `idUsaha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `idJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idPelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idPembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idSupp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `idjenis` FOREIGN KEY (`idJenis`) REFERENCES `jenis_barang` (`idJenis`);

--
-- Constraints for table `log_akun`
--
ALTER TABLE `log_akun`
  ADD CONSTRAINT `akun2` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`);

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan` FOREIGN KEY (`idTransaksi`) REFERENCES `penjualan` (`idTransaksi`);

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `akun1` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
