-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: db747861774.db.1and1.com
-- Generation Time: Nov 28, 2018 at 05:02 PM
-- Server version: 5.5.60-0+deb7u1-log
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db747861774`
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
  `ch_title` varchar(255) NOT NULL,
  `ch_content` text NOT NULL,
  `ch_deleted` tinyint(4) NOT NULL,
  `ch_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapitres`
--

INSERT INTO `chapitres` (`ch_id`, `ch_title`, `ch_content`, `ch_deleted`, `ch_date`) VALUES
(32, 'Chapitre 2 : Le dormeur du val', '<p>C\'est un trou de verdure o&ugrave; chante une rivi&egrave;re,&nbsp;<br />Accrochant follement aux herbes des haillons&nbsp;<br />D\'argent ; o&ugrave; le soleil, de la montagne fi&egrave;re,&nbsp;<br />Luit : c\'est un petit val qui mousse de rayons.<br /><br />Un soldat jeune, bouche ouverte, t&ecirc;te nue,&nbsp;<br />Et la nuque baignant dans le frais cresson bleu,&nbsp;<br />Dort ; il est &eacute;tendu dans l\'herbe, sous la nue,&nbsp;<br />P&acirc;le dans son lit vert o&ugrave; la lumi&egrave;re pleut.<br /><br />Les pieds dans les gla&iuml;euls, il dort. Souriant comme&nbsp;<br />Sourirait un enfant malade, il fait un somme :&nbsp;<br />Nature, berce-le chaudement : il a froid.<br /><br />Les parfums ne font pas frissonner sa narine ;&nbsp;<br />Il dort dans le soleil, la main sur sa poitrine,&nbsp;<br />Tranquille. Il a deux trous rouges au c&ocirc;t&eacute; droit.</p>', 0, '2018-11-03'),
(34, 'Chapitre 4 : Voyelles', '<p>A noir, E blanc, I rouge, U vert, O bleu : voyelles,&nbsp;<br />Je dirai quelque jour vos naissances latentes :&nbsp;<br />A, noir corset velu des mouches &eacute;clatantes&nbsp;<br />Qui bombinent autour des puanteurs cruelles,<br /><br />Golfes d\'ombre ; E, candeurs des vapeurs et des tentes,&nbsp;<br />Lances des glaciers fiers, rois blancs, frissons d\'ombelles ;&nbsp;<br />I, pourpres, sang crach&eacute;, rire des l&egrave;vres belles&nbsp;<br />Dans la col&egrave;re ou les ivresses p&eacute;nitentes ;<br /><br />U, cycles, vibrements divins des mers virides,&nbsp;<br />Paix des p&acirc;tis sem&eacute;s d\'animaux, paix des rides&nbsp;<br />Que l\'alchimie imprime aux grands fronts studieux ;<br /><br />O, supr&ecirc;me Clairon plein des strideurs &eacute;tranges,&nbsp;<br />Silences travers&eacute;s des Mondes et des Anges ;&nbsp;<br />- O l\'Om&eacute;ga, rayon violet de Ses Yeux !</p>', 0, '2018-11-03'),
(35, 'Chapitre 5 : A l\'aube', '<p><span style=\"text-decoration: underline;\"><strong>J\'ai embrass&eacute; l\'aube d\'&eacute;t&eacute;.</strong></span><br /><br />Rien ne bougeait encore au front des palais. L\'eau &eacute;tait morte. Les camps d\'ombres ne quittaient pas la route&nbsp;<br />du bois. J\'ai march&eacute;, r&eacute;veillant les haleines vives et ti&egrave;des, et les pierreries regard&egrave;rent, et les ailes&nbsp;<br />se lev&egrave;rent sans bruit.<br /><br />La premi&egrave;re entreprise fut, dans le sentier d&eacute;j&agrave; empli de frais et bl&ecirc;mes &eacute;clats, une fleur qui me dit son nom.<br /><br />Je ris au wasserfall blond qui s\'&eacute;chevela &agrave; travers les sapins : &agrave; la cime argent&eacute;e je reconnus la d&eacute;esse.<br /><br />Alors je levai un &agrave; un les voiles. Dans l\'all&eacute;e, en agitant les bras. Par la plaine, o&ugrave; je l\'ai d&eacute;nonc&eacute;e au coq.&nbsp;<br />A la grand\'ville elle fuyait parmi les clochers et les d&ocirc;mes, et courant comme un mendiant sur les quais de marbre,&nbsp;<br />je la chassais.<br /><br />En haut de la route, pr&egrave;s d\'un bois de lauriers, je l\'ai entour&eacute;e avec ses voiles amass&eacute;s, et j\'ai senti un peu&nbsp;<br />son immense corps. L\'aube et l\'enfant tomb&egrave;rent au bas du bois.<br /><br />Au r&eacute;veil il &eacute;tait midi.</p>', 0, '2018-11-03');

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
(1, 33, 'Alain DESPRES', 'Je suis bluffé par une prose si douce et délectable. On dirait du Rimbaud.', 0, '2018-11-27'),
(2, 31, 'Patrick CHAUMONT', 'Ce passage avec Vénus, me donne des frissons...', 0, '2018-11-27'),
(3, 35, 'Yannick BOBO', 'J\'adore ! Très bon !', 0, '2018-11-27'),
(4, 35, 'Azélie MAUROT', 'Parfait ! Du délice, je me régale !!!', 0, '2018-11-27'),
(6, 35, 'Frédéric COVERGUE', 'Un commentaire de plus, pour un chapitre de plus !', 0, '2018-11-27'),
(7, 35, 'Dominique LAURENT', 'Bravo. Très bon chapitre. J\'adore.', 0, '2018-11-27');

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
  MODIFY `ch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
