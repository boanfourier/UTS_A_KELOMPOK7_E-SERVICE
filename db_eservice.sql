-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Okt 2021 pada 19.59
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_eservice`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `posting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `posting_id`, `user_id`, `komentar`, `created_at`) VALUES
(26, 9, 8, 'testing', '2021-10-22 04:59:22'),
(27, 9, 2, 'apa ini', '2021-10-22 05:00:27'),
(28, 10, 2, 'test 2', '2021-10-22 05:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posting`
--

CREATE TABLE `posting` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` text,
  `status` enum('finished','unfinished') NOT NULL,
  `createdby` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posting`
--

INSERT INTO `posting` (`id`, `judul`, `deskripsi`, `gambar`, `status`, `createdby`, `created_at`, `updated_at`) VALUES
(1, 'kdmflsfsfnkjdsn', 'njdkfsndkjfns sjk fnsn', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(2, 'dfskmdsm', 'klm', NULL, 'unfinished', 10, '2021-10-23 17:47:53', '0000-00-00 00:00:00'),
(3, 'dfklsf', 'smdfkls', 'asset/upload/posting/1634818758.png', 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(4, 'Foto Makanan', 'akflsmflds', 'asset/upload/posting/1634818826.png', 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(5, 'ksdfmlsmf sdmfkl sd', 'mklmdsfmsd s', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(6, 'sdfmlsk', 'mklsdf', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(7, 'aaaaaaaa', 'kmdlfksdlmflksd', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(8, 'kmelrwermlkwerkl wme', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '0000-00-00 00:00:00'),
(9, 'ini coba Testing', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, ', 'asset/upload/posting/1634835632.jpg', 'finished', 13, '2021-10-23 17:43:18', '2021-10-23 17:43:18'),
(10, 's dfkfmsdfls', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good', NULL, 'unfinished', 13, '2021-10-23 17:42:38', '2021-10-21 16:57:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `foto`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$rEVvMHi63a0BpKstj0zxj.MFHBtnNa7dJJufUI0xX4/29KeK8KH7m', 'asset/upload/1634968728.jpg', 'admin'),
(10, 'faizal', 'faizal', '$2y$10$9EjZt87t2t9RBO4p6rYPdOY66UTNn9Dh3Wbx3Y5a0SPmz3TG0lNqq', 'asset/upload/default.png', 'user'),
(13, 'user', 'user', '$2y$10$.t1q3VnkUUE4qGKaOwbvFeLtaOXFBO5Hq/T1uloIp0iAcNB8WprqO', 'asset/upload/default.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `posting`
--
ALTER TABLE `posting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
