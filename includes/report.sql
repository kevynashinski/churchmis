-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2016 at 09:34 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id`           INT(11)     NOT NULL,
  `full_name`    VARCHAR(30) NOT NULL,
  `phone_number` INT(11)     NOT NULL,
  `gender`       VARCHAR(7)  NOT NULL,
  `registrar`    VARCHAR(50) NOT NULL DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `full_name`, `phone_number`, `gender`, `registrar`) VALUES
  (1, 'admin admin', 729243690, 'female', 'kevinwafula60@gmail.com'),
  (2, 'kevin wafula', 729243690, 'male', 'kevinwafula60@gmail.com'),
  (3, 'bryan musau', 76543513, 'Male', 'kevinwafula60@gmail.com'),
  (4, 'ryle neville', 707088125, 'Male', 'kevinwafula60@gmail.com'),
  (5, 'dennis marley', 684651351, 'Male', 'kevinwafula60@gmail.com'),
  (6, 'k', 5, 'Male', 'kevinwafula60@gmail.com'),
  (7, 'abdul abdi', 84653132, 'Male', 'kevinwafula60@gmail.com'),
  (8, 'evancia kandie', 47554, 'Female', 'kevinwafula60@gmail.com'),
  (9, 'ian wafula', 708811733, 'Male', 'kevinwafula60@gmail.com'),
  (10, 'griffins adelmo', 726469456, 'Male', 'kevinwafula60@gmail.com'),
  (11, 'fred muriuki', 719348776, 'Male', 'kevinwafula60@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id`   INT(11)      NOT NULL,
  `event_name` VARCHAR(50)  NOT NULL,
  `start_date` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `venue`      VARCHAR(100) NOT NULL,
  `username`   VARCHAR(50)           DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `start_date`, `end_date`, `created_at`, `venue`, `username`) VALUES
  (1, 'fundraising', '2016-09-22 16:38:07', '2016-10-17 21:00:00', '2016-09-21 10:50:12', 'Chipolopolo', NULL),
  (2, 'wedding for mr and mrs so and so', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-09-22 17:05:59',
   'nairobi chapel', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id`   INT(11)     NOT NULL,
  `group_name` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username`   VARCHAR(50)          DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `created_at`, `username`) VALUES
  (1, 'Women Group', '0000-00-00 00:00:00', 'kevinwafula60@gmail.com'),
  (2, 'Men Group', '0000-00-00 00:00:00', 'kevinwafula60@gmail.com'),
  (5, 'Youth Group', '2016-09-21 13:49:51', 'kevinwafula60@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id`    INT(11)     NOT NULL,
  `fullname`     VARCHAR(50) NOT NULL,
  `email`        VARCHAR(50) NOT NULL,
  `phone_number` INT(11)     NOT NULL,
  `gender`       VARCHAR(10) NOT NULL,
  `group_id`     INT(11)     NOT NULL,
  `username`     VARCHAR(50) DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `fullname`, `email`, `phone_number`, `gender`, `group_id`, `username`) VALUES
  (2, 'kevin wafula', 'kevinwafula60@gmail.com', 729243690, 'male', 1, 'kevinwafula60@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mpesa`
--

CREATE TABLE `mpesa` (
  `mpesa_id`     INT(11)     NOT NULL,
  `mpesa_code`   VARCHAR(15) NOT NULL,
  `full_name`    VARCHAR(50) NOT NULL,
  `date`         DATE        NOT NULL,
  `time`         TIME        NOT NULL,
  `created_at`   TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount`       VARCHAR(10)          DEFAULT NULL,
  `phone_number` VARCHAR(15)          DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `mpesa`
--

INSERT INTO `mpesa` (`mpesa_id`, `mpesa_code`, `full_name`, `date`, `time`, `created_at`, `amount`, `phone_number`)
VALUES
  (1, 'ME34K53N2', 'KEVIN WAFULA', '2016-09-16', '08:24:00', '2016-09-20 05:22:07', '530', NULL),
  (5, 'KE34MN36T', 'Lenic Njagi', '2016-09-15', '07:18:00', '2016-09-20 05:27:28', '405', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id`      INT(11)   NOT NULL,
  `news_details` TEXT,
  `created_at`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username`     VARCHAR(50)        DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_details`, `created_at`, `username`) VALUES
  (1, 'There will be an annual thanks giving at the church on 16th Sep, 2016. All are welcome', '2016-09-20 07:30:36',
   'kevinwafula60@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id`             INT(11)     NOT NULL,
  `purpose`        VARCHAR(25) NOT NULL,
  `cash`           INT(11)     NOT NULL DEFAULT '0',
  `cheque`         INT(11)     NOT NULL DEFAULT '0',
  `forex`          INT(11)     NOT NULL DEFAULT '0',
  `receipt_status` TINYINT(1)  NOT NULL DEFAULT '0',
  `payment_date`   DATE        NOT NULL
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

CREATE TABLE `priviledges` (
  `username` varchar(30) NOT NULL,
  `roles`    VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE `purposes` (
  `purpose`  VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) DEFAULT 'kevinwafula60@gmail.com'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purposes`
--

INSERT INTO `purposes` (`purpose`, `username`) VALUES
  ('tithe', 'kevinwafula60@gmail.com'),
  ('children', 'kevinwafula60@gmail.com'),
  ('quarterlies', 'kevinwafula60@gmail.com'),
  ('education', 'kevinwafula60@gmail.com'),
  ('investment', 'kevinwafula60@gmail.com'),
  ('world mission', 'kevinwafula60@gmail.com'),
  ('building funds', 'kevinwafula60@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id`    INT(11)     NOT NULL,
  `role`       VARCHAR(20) NOT NULL,
  `added_by`   VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username`   VARCHAR(50)          DEFAULT 'kevinwafula60@gmail.com'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_number`       INT(11)      NOT NULL,
  `surname`         VARCHAR(20)  NOT NULL,
  `other_name`      VARCHAR(30)  NOT NULL,
  `phone_number`    INT(11)      NOT NULL,
  `gender`          VARCHAR(7)   NOT NULL,
  `username`        VARCHAR(50)  NOT NULL,
  `password`        VARCHAR(255) NOT NULL,
  `registered_date` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role`            VARCHAR(10)           DEFAULT NULL,
  `photo`           VARCHAR(100)          DEFAULT NULL,
  `phototype`       VARCHAR(10)           DEFAULT NULL,
  `city`            VARCHAR(50)           DEFAULT 'Nairobi'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_number`, `surname`, `other_name`, `phone_number`, `gender`, `username`, `password`, `registered_date`, `role`, `photo`, `phototype`, `city`)
VALUES
  (250, 'user', 'new user', 789565521, 'Female', 'newuser@gmail.com',
        '$2y$10$SbrCYt0gR.3efh28OZ9dwuMSfVV2JBKBLt1ajVRM1R0wyTjPzPLha', '2016-09-12 21:00:00', 'clerk', NULL, NULL,
   'Nairobi'),
  (10000, 'hello', 'hawayu', 48651320, 'Female', 'hello@gmail.com',
          '$2y$10$fCQVt1caW3Z6YusOCWR6AOWc3ggE.W69EbQ/TnV2aE0OKH/zpxcBO', '2016-09-22 16:05:37', NULL, NULL, NULL,
   'Nairobi'),
  (12345, 'wamalwa', 'ian wafula', 708811733, 'Male', 'ianwafula@gmail.com',
          '$2y$10$z19x3tZmLPVleJAmQjdG7e6BThH0ttHCyanWxlksf7RL/5kTeJwlu', '2016-02-20 21:00:00', 'clerk', NULL, NULL,
   'Nairobi'),
  (64531, 'alksdjflkj', 'ajsdflkjasd', 1532, 'Female', 'kevinwa@gmail.com',
          '$2y$10$u65.qHbOVYHlcwsVLOItH.QLyiFnjTK2J8HsocmE4HMPUxhwh8sTe', '2016-09-22 16:03:32', NULL, NULL, NULL,
   'Nairobi'),
  (845612, 'kevin', 'wafula wekhanya', 51320, 'Male', 'kevinwafula60@gmail.com',
           '$2y$10$5uCQvRsw/Rz2vOo69qd/seqLbK77EmS3Q2bgi0t5SvjvWeDagAynm', '2016-09-22 16:24:22', 'admin', NULL, NULL,
   'Nairobi'),
  (23583687, 'Salah', 'George', 724345641, 'Male', 'sallageo@gmail.com',
             '$2y$10$DI.uQ8udAzlqFFF5jhDJjun1WdW2VW9gueJUng49t4lFs0v5bjoDa', '2016-02-20 21:00:00', 'supervisor', NULL,
             NULL, 'Nairobi'),
  (29483944, 'oyugi', 'zephaniah onyago', 732438794, 'Male', 'zephp3@gmail.com',
             '$2y$10$RdfwnYSXz9w.m/hq8ch5t.yb1tbEUlT2HzQnFjuIL/iBKlpdenfa2', '2016-02-20 21:00:00', 'clerk', NULL, NULL,
   'Nairobi'),
  (34556667, 'fred', 'nunun', 76543221, 'Male', 'fredwamae34@gmail.com',
             '$2y$10$aCgNuPmhDSzBDL22sf98me1Ck4vAlz4Zk/15CqeZfyCkHXRM2mJa6', '2016-08-30 21:00:00', 'clerk', NULL, NULL,
   'Nairobi'),
  (86451320, 'Akelo', 'Richard Onyango', 727709772, 'Male', 'akellorichard@gmail.com',
             '$2y$10$DpH9p2.WsX1kTSdCvpMzFO7mogpu.yJpnG/mBLCFo9RlP0rC6aRMy', '2016-09-22 17:02:20', 'supervisor', NULL,
             NULL, 'Nairobi'),
  (324252566, 'mwangi', 'fred', 756556666, 'Male', 'fredrickmuriuki97@yahoo.com',
              '$2y$10$2k0g35pK61AXcdZBEO6sxOz7zEf9QKP5TR8.1qR/xYtd3SRx4IW3q', '2016-08-30 21:00:00', NULL, NULL, NULL,
   'Nairobi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `details_users_username_fk` (`registrar`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_users_username_fk` (`username`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `groups_users_username_fk` (`username`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `members_groups_group_id_fk` (`group_id`),
  ADD KEY `members_users_username_fk` (`username`);

--
-- Indexes for table `mpesa`
--
ALTER TABLE `mpesa`
  ADD PRIMARY KEY (`mpesa_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `news_users_username_fk` (`username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD KEY `payments_details_id_fk` (`id`);

--
-- Indexes for table `priviledges`
--
ALTER TABLE `priviledges`
  ADD KEY `fk_user_priviledges` (`username`);

--
-- Indexes for table `purposes`
--
ALTER TABLE `purposes`
  ADD KEY `purposes_users_username_fk` (`username`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role` (`role`),
  ADD KEY `roles_users_username_fk` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_number`),
  ADD UNIQUE KEY `username_uni` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `mpesa`
--
ALTER TABLE `mpesa`
  MODIFY `mpesa_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_users_username_fk` FOREIGN KEY (`registrar`) REFERENCES `users` (`username`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_groups_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `members_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_details_id_fk` FOREIGN KEY (`id`) REFERENCES `details` (`id`);

--
-- Constraints for table `priviledges`
--
ALTER TABLE `priviledges`
  ADD CONSTRAINT `fk_user_priviledges` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `priviledges_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `purposes`
--
ALTER TABLE `purposes`
  ADD CONSTRAINT `purposes_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_users_username_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
