-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 12:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id_number` int(11) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `other_name` varchar(30) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_date` date NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_number`),
  UNIQUE KEY `username_uni` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id_number`, `surname`, `other_name`, `phone_number`, `gender`, `username`, `password`, `registered_date`, `role`) VALUES
(12345, 'wamalwa', 'ian wafula', 708811733, 'Male', 'ianwafula@gmail.com', '$2y$10$z19x3tZmLPVleJAmQjdG7e6BThH0ttHCyanWxlksf7RL/5kTeJwlu', '2016-02-21', 'clerk'),
(23583687, 'Salah', 'George', 724345641, 'Male', 'sallageo@gmail.com', '$2y$10$DI.uQ8udAzlqFFF5jhDJjun1WdW2VW9gueJUng49t4lFs0v5bjoDa', '2016-02-21', 'superuser'),
(29483944, 'oyugi', 'zephaniah onyago', 732438794, 'Male', 'zephp3@gmail.com', '$2y$10$RdfwnYSXz9w.m/hq8ch5t.yb1tbEUlT2HzQnFjuIL/iBKlpdenfa2', '2016-02-21', 'clerk'),
  (30776967, 'wekhanya', 'kevin wafula', 729243690, 'Male', 'kevinwafula60@gmail.com',
   '$2y$10$pdfB7zd.KbQNmjXhK2dFx.LBW.nZfzEr230MOWOActIZ47KV5GEYm', '2016-02-20', 'superuser'),
  (34556667, 'fred', 'nunun', 76543221, 'Male', 'fredwamae34@gmail.com',
   '$2y$10$aCgNuPmhDSzBDL22sf98me1Ck4vAlz4Zk/15CqeZfyCkHXRM2mJa6', '2016-08-31', 'clerk'),
  (324252566, 'mwangi', 'fred', 756556666, 'Male', 'fredrickmuriuki97@yahoo.com',
   '$2y$10$2k0g35pK61AXcdZBEO6sxOz7zEf9QKP5TR8.1qR/xYtd3SRx4IW3q', '2016-08-31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(30) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `registrar` varchar(30) NOT NULL DEFAULT 'admin@admin.com',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 12;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `full_name`, `phone_number`, `gender`, `registrar`) VALUES
(1, 'admin admin', 729243690, 'female', 'admin@admin.com'),
(2, 'kevin wafula', 729243690, 'male', 'admin@admin.com'),
(3, 'bryan musau', 76543513, 'Male', 'admin@admin.com'),
(4, 'ryle neville', 707088125, 'Male', 'admin@admin.com'),
(5, 'dennis marley', 684651351, 'Male', 'admin@admin.com'),
(6, 'k', 5, 'Male', 'admin@admin.com'),
(7, 'abdul abdi', 84653132, 'Male', 'admin@admin.com'),
(8, 'evancia kandie', 47554, 'Female', 'admin@admin.com'),
(9, 'ian wafula', 708811733, 'Male', 'admin@admin.com'),
  (10, 'griffins adelmo', 726469456, 'Male', 'admin@admin.com'),
  (11, 'fred muriuki', 719348776, 'Male', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `fundraising`    VARCHAR(35) NOT NULL,
  `trips`          VARCHAR(35) NOT NULL,
  `church service` VARCHAR(35) NOT NULL,
  `group meeting`  VARCHAR(35) NOT NULL,
  UNIQUE KEY `fundraising` (`fundraising`, `trips`, `church service`, `group meeting`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `men`
--

CREATE TABLE IF NOT EXISTS `men` (
  `id`      INT(10)     NOT NULL,
  `name`    VARCHAR(30) NOT NULL,
  `contact` INT(10)     NOT NULL,
  `email`   VARCHAR(32) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `men`
--

INSERT INTO `men` (`id`, `name`, `contact`, `email`) VALUES
  (9827345, 'fafa fofo', 2147483647, 'fafan@gmail.com'),
  (41244, 'ann atieno', 75231655, 'ann3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL,
  `purpose` varchar(25) NOT NULL,
  `cash` int(11) NOT NULL DEFAULT '0',
  `cheque` int(11) NOT NULL DEFAULT '0',
  `forex` int(11) NOT NULL DEFAULT '0',
  `receipt_status` tinyint(1) NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  KEY `payments_details_id_fk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `purpose`, `cash`, `cheque`, `forex`, `receipt_status`, `payment_date`) VALUES
(1, 'tithe', 0, 0, 0, 0, '2016-01-01'),
(2, 'construction', 50000, 0, 0, 0, '2016-02-18'),
(3, 'investment', 90000, 0, 0, 0, '2016-02-19'),
(3, 'children', 10000, 0, 0, 0, '2016-02-19'),
(4, 'education', 19000000, 0, 0, 0, '2016-02-19'),
(5, 'tithe', 6546546, 68, 0, 0, '2016-02-19'),
(6, 'purpose', 0, 0, 0, 0, '2016-02-19'),
(7, 'children', 0, 8946351, 0, 0, '2016-02-19'),
(7, 'investment', 54312, 0, 0, 0, '2016-02-19'),
(8, 'building', 5651651, 0, 0, 0, '2016-02-20'),
(9, 'education', 50000, 20000, 0, 0, '2016-02-21'),
(10, 'tithe', 1000, 0, 0, 0, '2016-02-21'),
  (10, 'children', 0, 50000, 0, 0, '2016-02-21'),
  (11, 'education', 45000, 0, 1, 0, '2016-08-31'),
  (11, 'children', 0, 0, 0, 0, '2016-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `priviledges`
--

CREATE TABLE IF NOT EXISTS `priviledges` (
  `username` varchar(30) NOT NULL,
  `roles` varchar(20) NOT NULL,
  KEY `fk_user_priviledges` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE IF NOT EXISTS `purposes` (
  `purpose` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purposes`
--

INSERT INTO `purposes` (`purpose`) VALUES
('tithe'),
('children'),
('quarterlies'),
('education'),
('investment'),
('world mission'),
('building funds');

-- --------------------------------------------------------

--
-- Table structure for table `women`
--

CREATE TABLE IF NOT EXISTS `women` (
  `id`      INT(10)     NOT NULL,
  `name`    VARCHAR(30) NOT NULL,
  `contact` INT(10)     NOT NULL,
  `email`   VARCHAR(32) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `women`
--

INSERT INTO `women` (`id`, `name`, `contact`, `email`) VALUES
  (762354, '0', 0, '0'),
  (762354, 'meza meza', 0, ''),
  (762354, 'meza meza', 0, ''),
  (762354, 'meza meza', 0, ''),
  (67246324, 'toto toto', 73273, ''),
  (67246324, 'toto toto', 73273, ''),
  (67246324, 'moto toto', 631651, ''),
  (345464, 'dada dada', 78776569, ''),
  (345464, 'dada dada', 78776569, ''),
  (345464, 'dada dada', 78776569, ''),
  (345464, 'dada dada', 78776569, ''),
  (785687, 'nana kanana', 75645456, 'kanana@gmail,com');

-- --------------------------------------------------------

--
-- Table structure for table `youth`
--

CREATE TABLE IF NOT EXISTS `youth` (
  `id`      INT(10)     NOT NULL,
  `name`    VARCHAR(30) NOT NULL,
  `contact` INT(11)     NOT NULL,
  `email`   VARCHAR(30) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `youth`
--

INSERT INTO `youth` (`id`, `name`, `contact`, `email`) VALUES
  (12, 'safgvdsg', 0, ''),
  (12, 'safgvdsg', 0, ''),
  (12, 'safgvdsg', 0, ''),
  (12, 'safgvdsg', 0, ''),
  (23344, 'fdfbxfhfxn', 0, ''),
  (535636, 'sfdhgvsanmvc', 0, ''),
  (535636, 'sfdhgvsanmvc', 0, ''),
  (535636, 'sfdhgvsanmvc', 0, ''),
  (424255632, 'fgdghzxxgj', 0, ''),
  (67164126, 'gogo bobo', 0, ''),
  (67164126, 'gogo bobo', 0, ''),
  (765678, 'dudu dada', 99887676, 'dudu@gmail.com'),
  (0, 'vava  dada', 0, ''),
  (0, 'vava  dada', 0, ''),
  (0, 'vava  dada', 0, ''),
  (0, 'vava  dada', 0, ''),
  (787999, 'kevin muya', 2147483647, 'muya@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_details_id_fk` FOREIGN KEY (`id`) REFERENCES `details` (`id`);

--
-- Constraints for table `priviledges`
--
ALTER TABLE `priviledges`
  ADD CONSTRAINT `fk_user_priviledges` FOREIGN KEY (`username`) REFERENCES `auth` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
