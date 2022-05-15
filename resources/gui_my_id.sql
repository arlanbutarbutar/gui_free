-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2022 pada 05.17
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gui_my_id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_databases`
--

CREATE TABLE `t_databases` (
  `id_database` int(11) NOT NULL,
  `id_user` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_menu_navbar`
--

CREATE TABLE `t_menu_navbar` (
  `id_menu_navbar` int(11) NOT NULL,
  `id_user` varchar(100) DEFAULT NULL,
  `menu_navbar` varchar(100) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_projects`
--

CREATE TABLE `t_projects` (
  `id_project` int(11) NOT NULL,
  `id_user` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `route` varchar(50) DEFAULT NULL,
  `progress` int(11) DEFAULT NULL,
  `domain` varchar(225) DEFAULT NULL,
  `date` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_users`
--

CREATE TABLE `t_users` (
  `id_user` varchar(100) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `date` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_users`
--

INSERT INTO `t_users` (`id_user`, `id_status`, `username`, `email`, `password`, `date`) VALUES
('$2y$10$vWgHQ0nZVP2u/Q2Z7fvg2OWYQNFdfYfBX106t4V1n2ht98bflHiPS', 2, 'admin', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', 'Friday, 06 May 2022 05:14:38 am');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_users_status`
--

CREATE TABLE `t_users_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_users_status`
--

INSERT INTO `t_users_status` (`id_status`, `status`) VALUES
(1, 'Tidak Aktif'),
(2, 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_databases`
--
ALTER TABLE `t_databases`
  ADD PRIMARY KEY (`id_database`);

--
-- Indeks untuk tabel `t_menu_navbar`
--
ALTER TABLE `t_menu_navbar`
  ADD PRIMARY KEY (`id_menu_navbar`);

--
-- Indeks untuk tabel `t_projects`
--
ALTER TABLE `t_projects`
  ADD PRIMARY KEY (`id_project`);

--
-- Indeks untuk tabel `t_users_status`
--
ALTER TABLE `t_users_status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_databases`
--
ALTER TABLE `t_databases`
  MODIFY `id_database` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_menu_navbar`
--
ALTER TABLE `t_menu_navbar`
  MODIFY `id_menu_navbar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_projects`
--
ALTER TABLE `t_projects`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_users_status`
--
ALTER TABLE `t_users_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
