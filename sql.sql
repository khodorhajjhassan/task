-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2023 at 05:40 PM
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
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificates_id` int(11) NOT NULL,
  `certificates_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificates_id`, `certificates_name`) VALUES
(1, 'bachelor'),
(2, 'master'),
(3, 'phd');

-- --------------------------------------------------------

--
-- Table structure for table `usercertificates`
--

CREATE TABLE `usercertificates` (
  `userCertificates_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `degree_name` varchar(255) DEFAULT NULL,
  `degreeURL` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usercertificates`
--

INSERT INTO `usercertificates` (`userCertificates_id`, `user_id`, `certificate_id`, `degree_name`, `degreeURL`) VALUES
(29, 10, 1, 'aaaaaaa', NULL),
(30, 10, 1, 'aaaaaaaa', NULL),
(31, 10, 3, 'computer science', NULL),
(32, 10, 2, '121212', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `is_approved` int(1) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `blood_type`, `gender`, `is_approved`, `is_admin`, `last_login`) VALUES
(2, 'khodor', 'khodor@gmail.com', '$2y$10$JMcNxz42XPlQdNdZ9LPyJ.jhbeJn3BS0/L1DSOrvvEowDEvlnjNlW', 'A+', 'MALE', 1, 1, '2023-09-23 17:40:00'),
(9, 'khodor', 'lebnen88@gmail.com', '$2y$10$k89vpBE0zzuquRadVBuea.WGmQ4kxTWtuJG2LViksiaK7SRUV79Qa', 'A+', 'Female', 1, 0, '2023-09-23 17:23:00'),
(10, 'ali', 'khodorhajjhassan1@gmail.com', '$2y$10$JMcNxz42XPlQdNdZ9LPyJ.jhbeJn3BS0/L1DSOrvvEowDEvlnjNlW', 'B+', 'Male', 1, 0, '2023-09-23 17:39:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_statistics`
-- (See below for the actual view)
--
CREATE TABLE `user_statistics` (
`total_users` bigint(21)
,`users_not_approved` bigint(21)
,`users_with_bachelor` bigint(21)
,`users_with_Master` bigint(21)
,`users_with_Phd` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `user_statistics`
--
DROP TABLE IF EXISTS `user_statistics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_statistics`  AS SELECT (select count(0) from `users` where `users`.`is_approved` = 1 and `users`.`is_admin` = 0) AS `total_users`, (select count(0) from `users` where `users`.`is_approved` = 0 and `users`.`is_admin` = 0) AS `users_not_approved`, (select count(0) from `usercertificates` where `usercertificates`.`certificate_id` = 1) AS `users_with_bachelor`, (select count(0) from `usercertificates` where `usercertificates`.`certificate_id` = 2) AS `users_with_Master`, (select count(0) from `usercertificates` where `usercertificates`.`certificate_id` = 3) AS `users_with_Phd` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificates_id`);

--
-- Indexes for table `usercertificates`
--
ALTER TABLE `usercertificates`
  ADD PRIMARY KEY (`userCertificates_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `certificate_id` (`certificate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usercertificates`
--
ALTER TABLE `usercertificates`
  MODIFY `userCertificates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usercertificates`
--
ALTER TABLE `usercertificates`
  ADD CONSTRAINT `usercertificates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `usercertificates_ibfk_2` FOREIGN KEY (`certificate_id`) REFERENCES `certificates` (`certificates_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
