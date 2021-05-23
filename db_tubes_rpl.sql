-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 12:21 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tubes_rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_apply_project`
--

CREATE TABLE `tb_apply_project` (
  `id_apply` int(3) NOT NULL,
  `id_applicant` int(3) NOT NULL,
  `id_project` int(3) NOT NULL,
  `id_owner` int(3) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` varchar(256) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `req_data` varchar(256) NOT NULL,
  `experiences` varchar(256) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_apply_project`
--

INSERT INTO `tb_apply_project` (`id_apply`, `id_applicant`, `id_project`, `id_owner`, `full_name`, `address`, `sex`, `birth_date`, `phone_num`, `req_data`, `experiences`, `status`) VALUES
(1, 1, 4, 3, 'Muhammad Iqbal Zain', 'Lembang', 'male', '2021-05-06', '085813761927', 'drive.google.com', 'sadf', 1),
(2, 3, 1, 1, 'Muhammad Melvyn Maunti', 'Soreang City', 'male', '2021-05-05', '0888888888', 'drive.google.com', 'Hai dude', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id_project` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `end_date` date DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `date_project` date NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`id_project`, `id_owner`, `status`, `end_date`, `title`, `location`, `category`, `date_project`, `description`) VALUES
(1, 1, 1, NULL, 'Dynamic', 'Bandung', 'Event', '2021-05-07', 'asdasda'),
(2, 1, 0, NULL, 'Qurban', 'Bandung Tenggara', 'Event', '2021-05-26', 'Hola Aasjdasdjhashkd asoidasodah aslkdl'),
(3, 1, 1, NULL, 'Kumpul Keluarga', 'Soreang', 'Silaturahmi', '2021-05-17', 'Monti family gathering'),
(4, 3, 1, NULL, 'Bukber', 'Bandung', 'Silaturahmi', '2021-05-24', 'Makan makan sobat'),
(5, 3, 1, NULL, 'Sahur On The road', 'Bandung', 'Silaturahmi', '2021-05-31', 'Bobobo'),
(6, 3, 0, NULL, 'Qurban', 'Soreang', 'Ibadah', '2021-05-29', 'Potong hewan'),
(7, 1, 0, NULL, 'Asisten Pemrograman XIII', 'Bandung', 'Asisten', '2021-05-29', 'Dibuka lowongan, untuk mahasiswa yang ingin menjadi asisten pemrograman angkatan ke XIII. Harus bisa alpro dasar dan struktur data'),
(8, 1, 0, NULL, 'Panitia Sembilan', 'Jakarta', 'Politics', '2021-05-28', 'Ini merupakan deskripsi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `username`, `password`) VALUES
(1, 'iqbalzain99@upi.edu', 'iqbal', '1234'),
(3, 'montiGantengz@gmail.com', 'monti', '1234'),
(4, 'bigel@yahoo.com', 'bigel', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_apply_project`
--
ALTER TABLE `tb_apply_project`
  ADD PRIMARY KEY (`id_apply`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_apply_project`
--
ALTER TABLE `tb_apply_project`
  MODIFY `id_apply` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
