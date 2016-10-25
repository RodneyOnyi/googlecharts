-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2015 at 10:56 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `knbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolment`
--

CREATE TABLE IF NOT EXISTS `enrolment` (
  `enrolment_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(100) NOT NULL,
  `male` int(250) NOT NULL,
  `female` int(250) NOT NULL,
  `total_enrolment` int(250) NOT NULL,
  PRIMARY KEY (`enrolment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `enrolment`
--

INSERT INTO `enrolment` (`enrolment_id`, `year`, `male`, `female`, `total_enrolment`) VALUES
(1, '1963', 586724, 304829, 891553),
(2, '1964', 657635, 357084, 1014716),
(3, '1965', 641103, 369786, 1010889),
(4, '1966', 645867, 397549, 1043416),
(5, '1967', 689795, 443384, 1133179),
(6, '1968', 725030, 484650, 1209680),
(7, '1969', 762827, 519470, 1282297),
(8, '1970', 836307, 591282, 1427589),
(9, '1971', 881007, 644491, 1525498),
(10, '1972', 956620, 719299, 1675919),
(11, '1973', 1025133, 790904, 1816017),
(12, '1974', 1491531, 1214347, 2705878),
(13, '1975', 1561501, 1319654, 2881155),
(14, '1976', 1554124, 1340493, 2894617),
(15, '1977', 1584100, 1393600, 2977700);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
