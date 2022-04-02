-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Apr 2022 pada 01.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

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
(16, '1', 1, 'Fadelmi', 'belanja', 300000, 50000, 0, 250000, '2022-01-26', '2022-01-26'),
(17, '2', 12, 'Ervany', 'Coba', 100000, 60000, 100000, 140000, '2022-03-03', '2022-03-03'),
(22, '1101', 1, 'Kas', 'Kas kecil', 100000, 0, 10000, 110000, '2022-03-10', '2022-03-10'),
(23, '2', 10, 'Coba Aset Tetap', 'djksd', 0, 0, 0, 0, '2022-03-31', '2022-03-31'),
(24, '12', 13, 'Coba ekuitas', '', 0, 0, 0, 0, '2022-03-31', '2022-03-31'),
(26, '310-2', 13, 'Coba kode jenis', '', 0, 0, 0, 0, '2022-04-01', '2022-04-01');

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
(14, '7', 'Cleo (19 Liter)', 1, '', 17000, 97, '2022-02-21');

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
(11, 17, 55, 100000, '2022-03-03'),
(12, 22, 65, 10000, '2022-03-31');

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
(14, 'Pembelian', 120, 2, '2022-03-30');

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
(12, 16, 46, 15000, '2022-01-26'),
(15, 16, 47, 10000, '2022-01-26'),
(16, 16, 53, 20000, '2022-03-03'),
(17, 17, 54, 10000, '2022-03-03'),
(18, 16, 56, 5000, '2022-03-03'),
(19, 17, 57, 40000, '2022-03-03'),
(20, 17, 64, 10000, '2022-03-31');

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
(42, 16, 2000000, 0, 0, 'Saldo Awal', 'Saldo Awal', '2022-01-26'),
(44, 16, 1000000, 0, 0, '', 'Saldo Awal', '2022-01-26'),
(46, 16, 0, 15000, 0, 'hehe', 'Jurnal Umum', '2022-01-26'),
(47, 16, 0, 10000, 0, 'makan', 'Jurnal Penyesuaian', '2022-01-26'),
(48, 16, 30000, 0, 0, 'Coba Nabung', 'Saldo Awal', '2022-02-06'),
(49, 16, 30000, 0, 0, 'Coba Nabung2', 'Saldo Awal', '2022-02-06'),
(50, 16, 30000, 0, 0, '', 'Saldo Awal', '2022-02-08'),
(51, 16, 50000, 0, 0, '', 'Saldo Awal', '2022-02-08'),
(52, 17, 100000, 0, 0, 'coba tambah saldo', 'Saldo Awal', '2022-03-03'),
(53, 16, 0, 20000, 0, 'coba tambah kredit', 'Jurnal Umum', '2022-03-03'),
(54, 17, 0, 10000, 0, 'coba tambah kredit', 'Jurnal Umum', '2022-03-03'),
(55, 17, 0, 0, 100000, 'coba tambah debit', 'Jurnal Umum', '2022-03-03'),
(56, 16, 0, 5000, 0, 'Minum', 'Jurnal Penyesuaian', '2022-03-03'),
(57, 17, 0, 40000, 0, 'Makan', 'Jurnal Penyesuaian', '2022-03-03'),
(58, 16, 300000, 0, 0, 'namba saldooo', 'Saldo Awal', '2022-03-08'),
(63, 22, 100000, 0, 0, 'modal', 'Saldo Awal', '2022-03-10'),
(64, 17, 0, 10000, 0, '', 'Jurnal Umum', '2022-03-31'),
(65, 22, 0, 0, 10000, '', 'Jurnal Penyesuaian', '2022-03-31');

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
(40, 'B20220310039', '2022-03-10', 4, ' ', 25000, '', '2022-03-10 07:11:10');

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
(35, 40, 'Le mineral (15 liter)', 5, 5000, 25000);

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
(5, 'VanSyah Studio', 'Dusun Krajan, Desa Kradinan, Kecamatan Dolopo', '10239980434719038028390', '2022-03-09'),
(8, 'Ervany Septa Prawara Arisanto', 'Dusun Krajan, Desa Kradinan, Kecamatan Dolopo', '102399804347190123321', '2022-03-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo_awal_log`
--

CREATE TABLE `saldo_awal_log` (
  `id` int(11) NOT NULL,
  `idAkun` int(11) NOT NULL,
  `saldoAwal` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo_awal_log`
--

INSERT INTO `saldo_awal_log` (`id`, `idAkun`, `saldoAwal`, `tanggal`) VALUES
(4, 16, 300000, '2022-01-26'),
(6, 17, 100000, '2022-03-03'),
(9, 22, 100000, '2022-03-10');

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
(4, 'Liabilitas dan Ekuitas');

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
(3, 'septa', 'septa@gmail.com', '$2y$10$TPsxXE6CxzNM89fjMJGxVuAUFDWD64fSKV1ghDa1zmdvb.Re0Ylmy', 77);

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
  MODIFY `idAkun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `debit_log`
--
ALTER TABLE `debit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jenis_akun`
--
ALTER TABLE `jenis_akun`
  MODIFY `idJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `idJenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kredit_log`
--
ALTER TABLE `kredit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `log_akun`
--
ALTER TABLE `log_akun`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idPelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idPembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelianDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idSupp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
