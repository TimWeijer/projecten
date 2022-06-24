-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 09:37 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boekenlijst`
--

-- --------------------------------------------------------

--
-- Table structure for table `top10 boeken`
--

CREATE TABLE `top10 boeken` (
  `id` int(11) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `uitgever` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `prijs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `top10 boeken`
--

INSERT INTO `top10 boeken` (`id`, `auteur`, `naam`, `uitgever`, `foto`, `prijs`) VALUES
(1, 'Delia Owens', 'Daar waar de rivierkreeften zingen', '\r\nThe House of Books', 'Null', '10'),
(2, 'Michael Pilarczyk', 'Invictus Library - Je bent zoals je denkt', '\r\nInvictus Publishing', 'Null', '17,95'),
(3, 'Haemin Sunim', 'De dingen die je alleen ziet als je er de tijd voor neemt', '\r\nBoekerij', 'Null', '16,99'),
(4, 'Stephen Hawking & Rob de Ridder', 'De antwoorden op de grote vragen', '\r\nSpectrum', 'Null', '10'),
(5, 'Lale Gül\r\n', 'Ik ga leven', 'Prometheus', 'Null', '20,99'),
(6, 'Kelly Weekers\r\n', 'De kracht van keuze', '\r\nKosmos Uitgevers', 'Null', '21,99'),
(7, 'Charlie Mackesy & Arthur Japin', 'De jongen, de mol, de vos en het paard\r\n', '\r\nKokboekencentrum Jeugd', 'Null', '20,00'),
(8, 'Dai Carter', 'Nu of nooit', 'Prometheus\r\n', 'Null', '22,50'),
(9, 'Michael Pilarczyk', 'Master Your Mindset', '\r\nInvictus Publishing', 'Null', '21,95'),
(10, 'Eva Jinek', 'Droom groot', '\r\nSpectrum', 'Null', '24,99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `top10 boeken`
--
ALTER TABLE `top10 boeken`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `top10 boeken`
--
ALTER TABLE `top10 boeken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
