-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Apr 2022 pada 21.02
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapkeu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `idAkun` int(11) NOT NULL,
  `kodeAkun` varchar(255) NOT NULL,
  `idJenis` int(11) NOT NULL,
  `namaAkun` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `saldoAwal` int(11) DEFAULT 0,
  `kredit` int(11) DEFAULT 0,
  `debit` int(11) DEFAULT 0,
  `saldoAkhir` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`idAkun`, `kodeAkun`, `idJenis`, `namaAkun`, `keterangan`, `saldoAwal`, `kredit`, `debit`, `saldoAkhir`, `created_at`, `updated_at`) VALUES
(50, '110-12', 1, 'Coba nihhh', '', 70000000, 70000000, 0, 0, '2022-04-05', '2022-04-05'),
(51, '310-12', 13, 'ekuitas', '', 700000000, 0, 700000000, 0, '2022-04-05', '2022-04-05'),
(52, '220-12', 12, 'liabi', '', 300000000, 0, 300000000, 0, '2022-04-05', '2022-04-05'),
(53, '120-30', 14, 'Coba nihhh', '', 300000, 0, 300000, 0, '2022-04-05', '2022-04-05'),
(54, '51-12', 16, 'HPP', '', 300000, 0, 300000, 0, '2022-04-05', '2022-04-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(11) NOT NULL,
  `kodeBarang` varchar(55) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `idJenis` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idBarang`, `kodeBarang`, `nama`, `idJenis`, `keterangan`, `harga`, `stok`, `created_at`) VALUES
(2, '2013123', 'Aqua Tanggung 600ml (24 Botol)', 2, '', 35000, 94, '0000-00-00'),
(5, '2013128', 'Aqua Gelas 240ml (48 Cup)', 2, '', 27000, 100, '2022-02-17'),
(6, '2013175', 'Vit Gelas 220 ml (42 cup)', 2, '', 25000, 99, '2022-02-17'),
(8, '1', 'Le mineral (15 liter)', 1, '', 20000, 104, '2022-02-21'),
(9, '2', 'Vit + Galon (19 liter)', 1, '', 48000, 98, '2022-02-21'),
(10, '3', 'Vit (19 liter)', 1, '', 12000, 195, '2022-02-21'),
(11, '4', 'Aqua + Galon (19 liter)', 1, '', 50000, 100, '2022-02-21'),
(12, '5', 'Aqua (19 liter)', 1, '', 17000, 199, '2022-02-21'),
(13, '6', 'Cleo + Galon (19 liter)', 1, '', 46000, 100, '2022-02-21'),
(14, '7', 'Cleo (19 Liter)', 1, '', 17000, 97, '2022-02-21'),
(21, 'DJOK32', 'coba kode', 1, '', 1000, 40, '2022-04-04'),
(22, '2323', 'Gelas kaca', 2, '', 10000, 10, '2022-04-04'),
(23, 'okok', 'Milo', 2, '', 7000, 10, '2022-04-05'),
(24, 'Aq1223', 'Aqua Kardus ', 2, '', 5000, 10, '2022-04-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit_log`
--

CREATE TABLE `debit_log` (
  `id` int(11) NOT NULL,
  `idAkun` int(11) NOT NULL,
  `idLog` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `debit_log`
--

INSERT INTO `debit_log` (`id`, `idAkun`, `idLog`, `debit`, `tanggal`) VALUES
(57, 51, 110, 700000000, '2022-04-05'),
(58, 52, 111, 300000000, '2022-04-05'),
(59, 53, 112, 300000, '2022-04-05'),
(60, 54, 113, 300000, '2022-04-05');

--
-- Trigger `debit_log`
--
DELIMITER $$
CREATE TRIGGER `debit` AFTER INSERT ON `debit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET debit = debit + NEW.debit
    WHERE idAkun = NEW.idAkun;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_debit` AFTER DELETE ON `debit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET debit = debit - OLD.debit
    WHERE idAkun = OLD.idAkun;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_debit` AFTER UPDATE ON `debit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET debit = debit - OLD.debit + NEW.debit
    WHERE idAkun = OLD.idAkun;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_akun`
--

CREATE TABLE `jenis_akun` (
  `idJenis` int(11) NOT NULL,
  `namaJenis` varchar(255) NOT NULL,
  `kodeJenis` int(11) NOT NULL,
  `id_tipeAkun` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_akun`
--

INSERT INTO `jenis_akun` (`idJenis`, `namaJenis`, `kodeJenis`, `id_tipeAkun`, `tanggal`) VALUES
(1, 'Aset Lancar', 110, 3, '2022-01-25'),
(10, 'Aset Tetap', 120, 3, '2022-03-09'),
(12, 'Liabilitas Jangka Pendek', 220, 4, '2022-03-09'),
(13, 'Ekuitas', 310, 4, '2022-03-09'),
(14, 'Pembelian', 120, 2, '2022-03-30'),
(16, 'HPPcoba', 51, 5, '2022-04-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `idJenis` int(11) NOT NULL,
  `namaJenis` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`idJenis`, `namaJenis`, `created_at`) VALUES
(1, 'Galon', '2022-02-25 05:58:19'),
(2, 'Kardus', '2022-02-25 05:58:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit_log`
--

CREATE TABLE `kredit_log` (
  `id` int(11) NOT NULL,
  `idAkun` int(11) NOT NULL,
  `idLog` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kredit_log`
--

INSERT INTO `kredit_log` (`id`, `idAkun`, `idLog`, `kredit`, `tanggal`) VALUES
(49, 50, 109, 70000000, '2022-04-05');

--
-- Trigger `kredit_log`
--
DELIMITER $$
CREATE TRIGGER `delete_kredit` AFTER DELETE ON `kredit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET kredit = kredit - OLD.kredit
    WHERE idAkun = OLD.idAkun;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kredit` AFTER INSERT ON `kredit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET kredit = kredit + NEW.kredit
    WHERE idAkun = NEW.idAkun;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_kredit` AFTER UPDATE ON `kredit_log` FOR EACH ROW BEGIN 
	UPDATE akun SET kredit = kredit - OLD.kredit + NEW.kredit
    WHERE idAkun = OLD.idAkun;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_akun`
--

CREATE TABLE `log_akun` (
  `idLog` int(11) NOT NULL,
  `idAkun` int(11) NOT NULL,
  `saldoAwal` int(11) DEFAULT 0,
  `kredit` int(11) DEFAULT 0,
  `debit` int(11) DEFAULT 0,
  `keterangan` varchar(255) DEFAULT NULL,
  `input_from` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_akun`
--

INSERT INTO `log_akun` (`idLog`, `idAkun`, `saldoAwal`, `kredit`, `debit`, `keterangan`, `input_from`, `tanggal`) VALUES
(109, 50, 0, 70000000, 0, '', 'Saldo Awal', '2022-04-05'),
(110, 51, 0, 0, 700000000, '', 'Saldo Awal', '2022-04-05'),
(111, 52, 0, 0, 300000000, '', 'Saldo Awal', '2022-04-05'),
(112, 53, 0, 0, 300000, '', 'Saldo Awal', '2022-04-05'),
(113, 54, 0, 0, 300000, '', 'Saldo Awal', '2022-04-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
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
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `nama`, `alamat`, `no_telp`, `status`, `created_at`) VALUES
(3, 'Ervany Septa Prawara Arisanto ', 'Desa Kradinan Kecamatan Dolopo Kabupaten Madiun', '083846900621', 'Mitra', ''),
(4, 'Fadel Muhammad Irsyad', ' Jl. Imam Bonjol No.26. Kel. Alai Gelombang', '081234357779', 'Mitra', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `idPembelian` int(11) NOT NULL,
  `noTransaksi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `idSupp` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `totalPembelian` int(11) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`idPembelian`, `noTransaksi`, `tanggal`, `idSupp`, `keterangan`, `totalPembelian`, `bayar`, `created_at`) VALUES
(36, 'B20220310035', '2022-03-10', 4, ' meonggg', 70000, '', '2022-03-09 19:40:55'),
(37, 'B20220310036', '2022-02-01', 2, ' coba trigger tambah barang nih bosss', 100000, '', '2022-03-09 21:33:27'),
(38, 'B20220310037', '2022-03-10', 2, ' Coba lagi', 150000, '', '2022-03-09 19:52:52'),
(39, 'B20220310038', '2022-03-10', 2, ' ', 20000, '', '2022-03-10 07:08:13'),
(40, 'B20220310039', '2022-03-10', 4, ' ', 25000, '', '2022-03-10 07:11:10'),
(41, 'B20220405040', '2022-04-05', 2, ' Coba lagiii ', 40000, '', '2022-04-04 17:26:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelianDetail` int(11) NOT NULL,
  `idPembelian` int(11) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `totalHarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelianDetail`, `idPembelian`, `namaBarang`, `kuantitas`, `harga`, `totalHarga`) VALUES
(29, 36, 'Aqua', 10, 2000, 20000),
(30, 36, 'Milo', 10, 5000, 50000),
(31, 37, 'Vit (19 liter)', 100, 1000, 100000),
(32, 38, 'Aqua (19 liter)', 100, 1000, 100000),
(33, 38, 'Cleo', 50, 1000, 50000),
(34, 39, 'Aqua', 2, 10000, 20000),
(35, 40, 'Le mineral (15 liter)', 5, 5000, 25000),
(36, 41, 'Aqua Kardus ', 10, 4000, 40000);

--
-- Trigger `pembelian_detail`
--
DELIMITER $$
CREATE TRIGGER `tambahstokbarang` AFTER INSERT ON `pembelian_detail` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok+NEW.kuantitas
    WHERE nama = NEW.namaBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `idTransaksi` int(11) NOT NULL,
  `noTransaksi` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `idPelanggan` int(11) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`idTransaksi`, `noTransaksi`, `tanggal`, `idPelanggan`, `keterangan`, `total`, `bayar`, `created_at`) VALUES
(16, 'A20220306015', '2022-03-06', 4, '', 85000, 0, '2022-03-06 02:52:01'),
(17, 'A20220310016', '2022-03-10', 3, '', 44000, 0, '2022-03-10 05:19:52'),
(18, 'A20220310017', '2022-03-10', 4, '', 35000, 50000, '2022-03-10 05:31:21'),
(19, 'A20220310018', '2022-03-10', 3, '', 69000, 100000, '2022-03-10 05:34:54'),
(20, 'A20220310019', '2022-03-10', 4, 'cieee nambah keterangan', 34000, 50000, '2022-03-10 05:53:12'),
(21, 'A20220310020', '2022-03-10', 3, 'pembayaran barang', 140000, 140000, '2022-03-09 19:06:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualanDetail` int(11) NOT NULL,
  `idTransaksi` int(11) NOT NULL,
  `idBarang` int(11) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualanDetail`, `idTransaksi`, `idBarang`, `namaBarang`, `kuantitas`, `total`) VALUES
(3, 16, 6, 'Vit Gelas 220 ml (42 cup)', 1, 25000),
(4, 16, 9, 'Vit + Galon (19 liter)', 1, 48000),
(5, 16, 10, 'Vit (19 liter)', 1, 12000),
(6, 17, 10, 'Vit (19 liter)', 2, 24000),
(7, 17, 8, 'Le mineral (15 liter)', 1, 20000),
(8, 18, 2, 'Aqua Tanggung 600ml (24 Botol)', 1, 35000),
(9, 19, 2, 'Aqua Tanggung 600ml (24 Botol)', 1, 35000),
(10, 19, 14, 'Cleo (19 Liter)', 2, 34000),
(11, 20, 12, 'Aqua (19 liter)', 1, 17000),
(12, 20, 14, 'Cleo (19 Liter)', 1, 17000),
(13, 21, 2, 'Aqua Tanggung 600ml (24 Botol)', 4, 140000);

--
-- Trigger `penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `pembelian` AFTER INSERT ON `penjualan_detail` FOR EACH ROW BEGIN
	UPDATE barang SET stok = stok-NEW.kuantitas
    WHERE idBarang = NEW.idbarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `nama`, `alamat`, `npwp`, `tanggal`) VALUES
(1, 'ADAM JAYA', 'Dusun Krajan, Desa Kradinan, Kecamatan Dolopo', '1023998043471901233212', '2021-11-01'),
(3, 'Adi Putra', 'Desa Kradinan Kecamatan Dolopo Kabupaten Madiun', '12418939082101823443', '2021-09-17'),
(5, 'VanSyah Studio', 'Dusun Krajan, Desa Kradinan, Kecamatan Dolopo', '10239980434719038028390', '2022-03-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo_awal_log`
--

CREATE TABLE `saldo_awal_log` (
  `id` int(11) NOT NULL,
  `idAkun` int(11) NOT NULL,
  `saldoAwal` int(11) NOT NULL,
  `tipe_awal` varchar(20) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo_awal_log`
--

INSERT INTO `saldo_awal_log` (`id`, `idAkun`, `saldoAwal`, `tipe_awal`, `tanggal`) VALUES
(37, 50, 70000000, 'Kredit', '2022-04-05'),
(38, 51, 700000000, 'Debit', '2022-04-05'),
(39, 52, 300000000, 'Debit', '2022-04-05'),
(40, 53, 300000, 'Debit', '2022-04-05'),
(41, 54, 300000, 'Debit', '2022-04-05');

--
-- Trigger `saldo_awal_log`
--
DELIMITER $$
CREATE TRIGGER `saldoAwal` AFTER INSERT ON `saldo_awal_log` FOR EACH ROW BEGIN 
	UPDATE akun SET saldoAwal = NEW.saldoAwal
    WHERE idAkun = NEW.idAkun;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saldoAwal2` AFTER UPDATE ON `saldo_awal_log` FOR EACH ROW BEGIN 
	UPDATE akun SET saldoAwal = NEW.saldoAwal
    WHERE idAkun = NEW.idAkun;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `idSupp` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`idSupp`, `nama`, `alamat`, `no_telp`) VALUES
(2, 'Aneka grosir minuman novitasari', 'Jalan Tawangsari No. 83 Kota Madiun', '0895329990656'),
(4, 'Distributor Aneka Minuman Dalam Kemasan \"Widodo\"', 'desa kradinan kecamatan dolopo kabupaten madiun', '083846900621');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_akun`
--

CREATE TABLE `tipe_akun` (
  `id_tipeAkun` int(11) NOT NULL,
  `nama_tipeAkun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tipe_akun`
--

INSERT INTO `tipe_akun` (`id_tipeAkun`, `nama_tipeAkun`) VALUES
(1, 'Pendapatan'),
(2, 'Beban'),
(3, 'Aset'),
(4, 'Liabilitas dan Ekuitas'),
(5, 'HPP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `username`, `email`, `password`, `role`) VALUES
(1, 'fadel', 'fadelirsyad10@gmail.com', '$2y$10$5w5L4nAQKMJEAmc65lJdBeHyCExzfOA5CHVps2NWhwVq/ZsyGw71.', 1),
(2, 'Ervany Septa Prawara Arisanto', 'ervany@gmail.com', '$2y$10$vSEF3ViA/F1DRrgDHAEjXuI8VjopSrxMPid/mrq0N/w7klcuzs1La', 1),
(3, 'septa', 'septa@gmail.com', '$2y$10$TPsxXE6CxzNM89fjMJGxVuAUFDWD64fSKV1ghDa1zmdvb.Re0Ylmy', 77),
(4, 'meongbanget', 'meong@gmail.com', '$2y$10$Y63JgCxMOGGoCy3j2R7uvOJ.dVqzOHIWsSBUy7ENlSx1E/0c0P0iO', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`idAkun`),
  ADD KEY `jns` (`idJenis`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`),
  ADD KEY `idjenis` (`idJenis`);

--
-- Indeks untuk tabel `debit_log`
--
ALTER TABLE `debit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debit_log` (`idAkun`),
  ADD KEY `logdebit` (`idLog`);

--
-- Indeks untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  ADD PRIMARY KEY (`idJenis`),
  ADD KEY `id_tipeAkun` (`id_tipeAkun`);

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`idJenis`);

--
-- Indeks untuk tabel `kredit_log`
--
ALTER TABLE `kredit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kredit` (`idAkun`),
  ADD KEY `log` (`idLog`);

--
-- Indeks untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  ADD PRIMARY KEY (`idLog`),
  ADD KEY `wadawd` (`idAkun`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idPelanggan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idPembelian`),
  ADD KEY `idSupp` (`idSupp`);

--
-- Indeks untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelianDetail`),
  ADD KEY `idPembelian` (`idPembelian`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `idPelanggan` (`idPelanggan`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_penjualanDetail`),
  ADD KEY `penjualan` (`idTransaksi`),
  ADD KEY `penjualan_detail_ibfk_1` (`idBarang`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saldo_awal_log`
--
ALTER TABLE `saldo_awal_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saldoAwal` (`idAkun`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idSupp`);

--
-- Indeks untuk tabel `tipe_akun`
--
ALTER TABLE `tipe_akun`
  ADD PRIMARY KEY (`id_tipeAkun`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `idAkun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `debit_log`
--
ALTER TABLE `debit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  MODIFY `idJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `idJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kredit_log`
--
ALTER TABLE `kredit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idPelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idPembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelianDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_penjualanDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `saldo_awal_log`
--
ALTER TABLE `saldo_awal_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idSupp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `jns` FOREIGN KEY (`idJenis`) REFERENCES `jenis_akun` (`idJenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `idjenis` FOREIGN KEY (`idJenis`) REFERENCES `jenis_barang` (`idJenis`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `debit_log`
--
ALTER TABLE `debit_log`
  ADD CONSTRAINT `debit_log` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `logdebit` FOREIGN KEY (`idLog`) REFERENCES `log_akun` (`idLog`);

--
-- Ketidakleluasaan untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  ADD CONSTRAINT `jenis_akun_ibfk_1` FOREIGN KEY (`id_tipeAkun`) REFERENCES `tipe_akun` (`id_tipeAkun`);

--
-- Ketidakleluasaan untuk tabel `kredit_log`
--
ALTER TABLE `kredit_log`
  ADD CONSTRAINT `kredit` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`),
  ADD CONSTRAINT `log` FOREIGN KEY (`idLog`) REFERENCES `log_akun` (`idLog`);

--
-- Ketidakleluasaan untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  ADD CONSTRAINT `wadawd` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`idSupp`) REFERENCES `supplier` (`idSupp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`idPembelian`) REFERENCES `pembelian` (`idPembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`idPelanggan`) REFERENCES `pelanggan` (`idPelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan` FOREIGN KEY (`idTransaksi`) REFERENCES `penjualan` (`idTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`idBarang`) REFERENCES `barang` (`idBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `saldo_awal_log`
--
ALTER TABLE `saldo_awal_log`
  ADD CONSTRAINT `saldoAwal` FOREIGN KEY (`idAkun`) REFERENCES `akun` (`idAkun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
