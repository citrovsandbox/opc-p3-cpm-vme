-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2018 at 09:31 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'dev', 'e77989ed21758e78331b20e477fc5582');

-- --------------------------------------------------------

--
-- Table structure for table `chapitres`
--

CREATE TABLE `chapitres` (
  `ch_id` int(11) NOT NULL,
  `ch_title` text NOT NULL,
  `ch_content` text NOT NULL,
  `ch_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapitres`
--

INSERT INTO `chapitres` (`ch_id`, `ch_title`, `ch_content`, `ch_date`) VALUES
(21, 'Comme un coucher de Soleil couchant...', '<p><img src=\"https://www.stromspa.com/wp-content/uploads/2017/07/alaska.png\" alt=\"Coucher de soleil Alaska\" width=\"500\" height=\"347\" /></p>\n<p>Cette fois encore, je me prends au jeu de l\'admiration et du d&eacute;sir d\'habiter ici. Les esquimaux ont l\'air si heureux...Et que dire des pingouins...</p>\n<p>Quand on pense qu\'&agrave; Paris il fait la m&ecirc;me temp&eacute;rature...et pourtant le paysage n\'a rien &agrave; voir...</p>', '2018-10-23'),
(22, 'Une aurore boréale, mais tellement boréale !', '<p><img src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXeDBCtFayv0iy1HDhOLDBoTjdNESsbaHJ5kFH9l5yP5JiGmlO\" alt=\"\" width=\"500\" height=\"333\" /></p>\n<p>Ca y est les gars je l\'ai enfin vue ! Ma premi&egrave;re aurore bor&eacute;ale !! Qu\'est-ce que je suis content, mais alors qu\'est-ce que je suis content !! Tout ce bleu...ce vert...</p>\n<p>Saviez-vous que le champ magn&eacute;tique terrestre avait un rapport avec ce ph&eacute;nom&egrave;ne ?</p>\n<p>&nbsp;</p>', '2018-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_chapitre_id` int(11) NOT NULL,
  `com_author` varchar(255) NOT NULL,
  `com_content` text NOT NULL,
  `com_flag` int(11) NOT NULL,
  `com_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `com_chapitre_id`, `com_author`, `com_content`, `com_flag`, `com_date`) VALUES
(1, 20, 'Patrick CHAUMONT', 'Trop bien ce oui-oui, il est vraiment trop fort!', 0, '2018-10-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapitres`
--
ALTER TABLE `chapitres`
  ADD PRIMARY KEY (`ch_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chapitres`
--
ALTER TABLE `chapitres`
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
