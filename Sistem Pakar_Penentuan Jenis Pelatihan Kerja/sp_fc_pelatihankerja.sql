-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2025 pada 20.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_fc_pelatihankerja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `kode_user` varchar(6) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`kode_user`, `nama_user`, `user`, `pass`, `level`) VALUES
('U001', 'admin', 'admin', 'admin', 'admin'),
('U005', 'Zanu', 'juju', 'jeje', 'user'),
('U003', 'ok', 'ok', 'ok', 'user'),
('U004', 'Reza', 'rere', 'zaza', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dataminat`
--

CREATE TABLE `tb_dataminat` (
  `kode_dataminat` varchar(16) NOT NULL,
  `nama_dataminat` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_dataminat`
--

INSERT INTO `tb_dataminat` (`kode_dataminat`, `nama_dataminat`, `keterangan`) VALUES
('JK01', 'Laki-laki', 'Peserta berjenis kelamin laki-laki'),
('JK02', 'Perempuan', 'Peserta berjenis kelamin perempuan'),
('JK03', 'Laki-laki/Perempuan', 'Peserta bisa laki-laki atau perempuan'),
('M01', 'Pemrograman', 'Minat dalam bidang pemrograman komputer'),
('M02', 'Otomotif', 'Minat dalam bidang otomotif'),
('M03', 'Desain Grafis', 'Minat dalam desain grafis dan visual'),
('M04', 'Memasak', 'Minat dalam bidang memasak dan kuliner'),
('M05', 'Menjahit', 'Minat dalam keterampilan menjahit'),
('M06', 'Elektronika', 'Minat dalam bidang elektronika dan perakitan alat'),
('M07', 'Bisnis', 'Minat dalam kewirausahaan atau bisnis'),
('M08', 'Administrasi', 'Minat dalam administrasi dan pengelolaan dokumen'),
('M09', 'Kopi/Minuman', 'Minat dalam dunia kopi dan minuman'),
('M10', 'Pemasaran', 'Minat dalam bidang pemasaran produk/jasa'),
('M11', 'Komputer', 'Minat dalam pengoperasian dan penggunaan komputer'),
('M12', 'Akuntansi', 'Minat dalam pencatatan dan pengelolaan keuangan'),
('M13', 'Las/Manufaktur', 'Minat dalam teknik pengelasan dan manufaktur'),
('M14', 'Kecantikan', 'Minat dalam bidang tata rias dan kecantikan'),
('P01', 'SMA/SMK', 'Pendidikan terakhir setingkat SMA atau SMK'),
('P02', 'Diploma 1-2', 'Pendidikan terakhir diploma 1 atau 2'),
('P03', 'Diploma 3-4', 'Pendidikan terakhir diploma 3 atau 4'),
('P04', 'Sarjana 1', 'Pendidikan terakhir sarjana strata 1 (S1)'),
('P05', 'Sarjana 2', 'Pendidikan terakhir sarjana strata 2 (S2)'),
('U01', '18 - 25', 'Usia peserta antara 18 hingga 25 tahun'),
('U02', '18 - 30', 'Usia peserta antara 18 hingga 30 tahun'),
('U03', '18 - 35', 'Usia peserta antara 18 hingga 35 tahun'),
('U04', '18 - 40', 'Usia peserta antara 18 hingga 40 tahun'),
('U05', '20 - 35', 'Usia peserta antara 20 hingga 35 tahun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konsultasi`
--

CREATE TABLE `tb_konsultasi` (
  `ID` int(11) NOT NULL,
  `kode_dataminat` varchar(16) DEFAULT NULL,
  `jawaban` varchar(6) DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelatihan`
--

CREATE TABLE `tb_pelatihan` (
  `kode_pelatihan` varchar(16) NOT NULL,
  `nama_pelatihan` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `referensi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pelatihan`
--

INSERT INTO `tb_pelatihan` (`kode_pelatihan`, `nama_pelatihan`, `keterangan`, `referensi`) VALUES
('JP001', 'Web Developer', 'Web Developer adalah profesi yang bertanggung jawab membangun, mengelola, dan memelihara website/aplikasi berbasis web.', NULL),
('JP002', 'Mekanik Sepeda Motor', 'Mekanik sepeda motor bertugas memperbaiki, merawat, dan melakukan servis kendaraan bermotor roda dua.', NULL),
('JP003', 'Desain Grafis Digital', 'Pelatihan ini membekali peserta dengan keterampilan mendesain berbagai kebutuhan visual seperti logo, brosur, poster, dan konten digital menggunakan perangkat lunak grafis komputer. Cocok untuk karier di bidang kreatif dan industri digital.', NULL),
('JP004', 'Basic Cooking', 'Pelatihan ini mengajarkan teknik dasar memasak, mulai dari mempersiapkan bahan makanan, penggunaan alat dapur, hingga memasak dan menyajikan makanan dengan baik. Peserta akan memahami hygiene, keamanan pangan, dan dasar kuliner.', NULL),
('JP005', 'Menjahit dan Desain Busana', 'Program pelatihan yang melatih keterampilan menjahit, membuat pola pakaian, serta memahami tren dan prinsip desain busana. Peserta dapat merancang dan membuat pakaian sendiri maupun menerima pesanan.', NULL),
('JP006', 'Teknisi Elektronika Dasar', 'Pelatihan ini memberikan pengetahuan dasar tentang komponen, perakitan, dan perbaikan perangkat elektronik sederhana. Cocok untuk pemula yang ingin berkarier sebagai teknisi elektronika atau memperbaiki perangkat rumah tangga.', NULL),
('JP007', 'Kewirausahaan UMKM', 'Pelatihan ini membantu peserta memahami dasar-dasar memulai dan mengembangkan usaha kecil dan menengah, termasuk manajemen, pemasaran, pencatatan keuangan, dan strategi bisnis. Cocok untuk calon wirausaha dan pelaku usaha pemula.', NULL),
('JP008', 'Administrasi Perkantoran', 'Peserta akan belajar berbagai keterampilan administrasi, pengelolaan dokumen, pengarsipan, surat-menyurat, serta penggunaan perangkat lunak perkantoran. Sangat dibutuhkan untuk mendukung kegiatan operasional kantor.', NULL),
('JP009', 'Barista', 'Pelatihan untuk menjadi barista profesional, mencakup teknik membuat espresso, latte art, pengetahuan tentang jenis kopi, serta pelayanan pelanggan di kedai kopi. Cocok untuk yang ingin bekerja di industri food & beverage.', NULL),
('JP010', 'Digital Marketing', 'Pelatihan ini mengajarkan strategi pemasaran produk/jasa melalui media digital seperti media sosial, website, email, dan SEO. Cocok untuk pelaku bisnis maupun individu yang ingin meningkatkan penjualan secara online.', NULL),
('JP011', 'Operator Komputer', 'Peserta diajarkan keterampilan mengoperasikan komputer, mulai dari mengetik, menggunakan aplikasi perkantoran (Word, Excel, PowerPoint), hingga mengelola data dan dokumen digital.', NULL),
('JP012', 'Akuntansi Dasar', 'Pelatihan ini memperkenalkan konsep dasar akuntansi, pencatatan transaksi keuangan, pembuatan laporan keuangan sederhana, dan pentingnya pengelolaan keuangan dalam bisnis.', NULL),
('JP013', 'Teknik Las (Welding)', 'Pelatihan yang fokus pada teknik dasar pengelasan logam, penggunaan alat las, prosedur keselamatan, serta praktik menyambung dan memotong logam. Cocok untuk pekerjaan di bidang manufaktur dan konstruksi.', NULL),
('JP014', 'Montir Mobil', 'Program ini melatih peserta dalam mendiagnosa, memperbaiki, dan merawat kendaraan roda empat. Peserta akan memahami sistem mesin, kelistrikan, dan sistem lainnya pada mobil.', NULL),
('JP015', 'Tata Rias dan Kecantikan', 'Pelatihan ini memberikan pengetahuan dan praktik tentang teknik tata rias wajah, perawatan kulit, make-up untuk berbagai acara, serta tips merawat kecantikan secara umum. Cocok untuk yang ingin berkarier di dunia kecantikan.', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_relasi`
--

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL,
  `kode_pelatihan` varchar(16) DEFAULT NULL,
  `kode_dataminat` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_relasi`
--

INSERT INTO `tb_relasi` (`ID`, `kode_pelatihan`, `kode_dataminat`) VALUES
(204, 'JP001', 'U01'),
(205, 'JP001', 'JK01'),
(206, 'JP001', 'P01'),
(207, 'JP001', 'M01'),
(208, 'JP002', 'U02'),
(209, 'JP002', 'JK01'),
(210, 'JP002', 'P01'),
(211, 'JP002', 'M02'),
(212, 'JP003', 'U03'),
(213, 'JP003', 'JK03'),
(214, 'JP003', 'P02'),
(215, 'JP003', 'M03'),
(216, 'JP004', 'U02'),
(217, 'JP004', 'JK02'),
(218, 'JP004', 'P01'),
(219, 'JP004', 'M04'),
(220, 'JP005', 'U03'),
(221, 'JP005', 'JK02'),
(222, 'JP005', 'P01'),
(223, 'JP005', 'M05'),
(224, 'JP006', 'U02'),
(225, 'JP006', 'JK01'),
(226, 'JP006', 'P03'),
(227, 'JP006', 'M06'),
(228, 'JP007', 'U05'),
(229, 'JP007', 'JK03'),
(230, 'JP007', 'P05'),
(231, 'JP007', 'M07'),
(232, 'JP008', 'U03'),
(233, 'JP008', 'JK02'),
(234, 'JP008', 'P01'),
(235, 'JP008', 'M08'),
(236, 'JP009', 'U02'),
(237, 'JP009', 'JK01'),
(238, 'JP009', 'P01'),
(239, 'JP009', 'M09'),
(240, 'JP010', 'U03'),
(241, 'JP010', 'JK03'),
(242, 'JP010', 'P04'),
(243, 'JP010', 'M10'),
(244, 'JP011', 'U04'),
(245, 'JP011', 'JK03'),
(246, 'JP011', 'P01'),
(247, 'JP011', 'M11'),
(248, 'JP012', 'U05'),
(249, 'JP012', 'JK02'),
(250, 'JP012', 'P01'),
(251, 'JP012', 'M12'),
(252, 'JP013', 'U03'),
(253, 'JP013', 'JK01'),
(254, 'JP013', 'P02'),
(255, 'JP013', 'M13'),
(256, 'JP014', 'U02'),
(257, 'JP014', 'JK01'),
(258, 'JP014', 'P02'),
(259, 'JP014', 'M02'),
(260, 'JP015', 'U03'),
(261, 'JP015', 'JK02'),
(262, 'JP015', 'P01'),
(263, 'JP015', 'M14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indeks untuk tabel `tb_dataminat`
--
ALTER TABLE `tb_dataminat`
  ADD PRIMARY KEY (`kode_dataminat`);

--
-- Indeks untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_pelatihan`
--
ALTER TABLE `tb_pelatihan`
  ADD PRIMARY KEY (`kode_pelatihan`);

--
-- Indeks untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_konsultasi`
--
ALTER TABLE `tb_konsultasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_relasi`
--
ALTER TABLE `tb_relasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
