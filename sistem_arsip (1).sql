-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 23.33
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor_surat`, `tanggal`, `tujuan`, `perihal`, `file_surat`) VALUES
(6, '090/MAS.YPS/I/2025', '2025-01-25', 'Guru dan Staf', 'SK.Panitia PPDB', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg'),
(7, '091/MAS.YPS/I/2025', '2025-01-26', 'Wali kelas xii', 'Undangan', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg'),
(8, '092/MAS.YPS/I/2025', '2025-01-28', 'MTs S Jenggot', 'Undangan', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `file_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal`, `perihal`, `asal_surat`, `file_surat`) VALUES
(7, '027/PMPD-AMAYO/I-25', '2025-02-07', 'Pendaftaran PMPD', 'Ama Yogyakarta', 'KOPRASI SERBA USAHA.docx'),
(8, '275/UN.02/TU/II/2025', '2025-02-15', 'Undangan', 'Universitas Diponegoro', 'WhatsApp Image 2025-06-28 at 18.43.04.jpeg'),
(9, '396/PW.II/LPMNU/SU/I/2025', '2025-02-15', 'Edaran diklat', 'PW Nu Jawa Tengah Lp. Ma\'arif  Nu', 'WhatsApp Image 2025-06-28 at 18.43.04.jpeg'),
(10, '020/LB.HR/YPS/II/2025', '2025-02-18', 'Ketetapan libur ramadhan dan hari raya idul fitri 1446 H', 'Yayasan pendidikan salafiyah', 'WhatsApp Image 2025-06-28 at 18.43.03.jpeg'),
(11, '021/APMS/YPS/II/2025', '2025-02-18', 'ketetapan anggaran pelaksanaan PHB genap da PAT', 'Yayasan pendidikan salafiyah', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg'),
(12, 'B-10/KK.II.34/4/PP.00/02/2025', '2025-02-18', 'Undangan', 'Kemenag kota pekalongan', 'WhatsApp Image 2025-06-28 at 18.43.04.jpeg'),
(13, 'B/053/400.7/2025', '2025-02-25', 'Undangan', 'UPT puskesmas jenggot', 'WhatsApp Image 2025-06-28 at 18.43.04.jpeg'),
(14, '25/A.48.01/PMB/II/2025', '2025-02-25', 'Permohonan izin PMB', 'PPMB universitas pekalongan', 'WhatsApp Image 2025-06-28 at 18.43.03.jpeg'),
(15, '103/II.34-E', '2025-06-29', 'pemberitahuan pendaftran KTA', 'Kwartir cabang kota pekalongan', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg'),
(16, '97/II.34-B', '2025-04-13', 'Edaran penilaian pramuks', 'Kwartir cabang kota pekalongan', 'WhatsApp Image 2025-06-28 at 18.43.03.jpeg'),
(17, '009/K3MI.PKL.SLTN/IV/2025', '2025-04-15', 'Undangan', 'KKMI dabin1 kota pekalongan', 'WhatsApp Image 2025-06-28 at 18.41.36.jpeg'),
(18, 'B/006/34.X/Ps.I/Ak.02/III/2025', '2025-04-13', 'pengantar pra penelitian', 'STAIKAP', 'WhatsApp Image 2025-06-28 at 18.43.03.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `Username`, `Password`, `created_at`) VALUES
(1, 'Admin', '12345678', '2025-05-19 19:58:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verify_token`, `is_verified`) VALUES
(11, 'admin', '$2y$10$0z49bE2psgENirDhge1CcuaCMcwYPwOz3tnfTwzkaMZcbAE5EQVzq', 'awalia.agst8@gmail.com', '9b0537de58d552d588634770dede0b03', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
