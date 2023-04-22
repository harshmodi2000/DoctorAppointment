-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2021 at 06:48 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Comel Hassim', 'comel', 'docteurenric@gmail.com', '$2y$10$Xtn/38s2hd9bbiFnkB/RMeGxUSkDYEX1dVDZpmgb1LogsPLYCMiMC');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` char(1) NOT NULL,
  `speciality` varchar(128) NOT NULL,
  `profileImage` varchar(256) DEFAULT '0',
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `gender`, `speciality`, `profileImage`, `phone`, `email`, `username`, `password`) VALUES
(8, 'Comel Hassim', 'M', 'Cardiologist', 'd8.jpg', '8980244741', 'docteurenric@gmail.com', 'comel', '$2y$10$fAx3f.4L0rurnT3NGKJZeeDG963MXqGwmvJHv3OiEKEwI7fUyBFS2');

-- --------------------------------------------------------

--
-- Table structure for table `model_list`
--

CREATE TABLE `model_list` (
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_list`
--

INSERT INTO `model_list` (`name`) VALUES
('nightschift'),
('regular');

-- --------------------------------------------------------

--
-- Table structure for table `nightschift`
--

CREATE TABLE `nightschift` (
  `id` int(2) NOT NULL,
  `days` varchar(128) DEFAULT NULL,
  `time1` varchar(20) DEFAULT NULL,
  `time2` varchar(20) DEFAULT NULL,
  `time3` varchar(20) DEFAULT NULL,
  `time4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nightschift`
--

INSERT INTO `nightschift` (`id`, `days`, `time1`, `time2`, `time3`, `time4`) VALUES
(1, 'MON-TUE-WED', '18:30-00:00', '', '', ''),
(2, 'THU-FRI', '04:55-16:55', '17:56-08:56', '14:53-04:55', ''),
(3, 'SAT-SUN', '05:56-02:54', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `id` int(11) NOT NULL,
  `user` tinyint(1) NOT NULL,
  `email` varchar(128) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expiry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `address` text,
  `phone` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `gender`, `address`, `phone`, `date_of_birth`, `email`, `username`, `password`) VALUES
(2, 'Comel Hassim', 'M', '40, Sardar Smurti Society, Near Agro Petrol Pump, Juhapura, Sarkhej Road', '7779044043', '2021-02-19', 'docteurenric@gmail.com', 'comel', '$2y$10$cYSoWkgpkXHfa2XrNmnGD.EsBBY5hWuVSefPlHqWH5JqU8ssDtjdy');

-- --------------------------------------------------------

--
-- Table structure for table `regular`
--

CREATE TABLE `regular` (
  `id` int(2) NOT NULL,
  `days` varchar(128) DEFAULT NULL,
  `time1` varchar(20) DEFAULT NULL,
  `time2` varchar(20) DEFAULT NULL,
  `time3` varchar(20) DEFAULT NULL,
  `time4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regular`
--

INSERT INTO `regular` (`id`, `days`, `time1`, `time2`, `time3`, `time4`) VALUES
(1, 'MON-TUE-WED-THU-FRI', '09:00-12:45', '13:30-18:45', '', ''),
(2, 'SAT', '08:00-13:15', '', '', ''),
(3, 'SUN', '13:00-16:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `service` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `service`) VALUES
(1, 'Family Doctor', '1,2,3,4'),
(3, 'Cardiologist', '1,5,6,7'),
(4, 'Neurologist', '1,16,17,18,19'),
(5, 'Physiotherapist', '1,8,9,10,11'),
(6, 'Dentist', '1,12,13,14,15');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_map`
--

CREATE TABLE `schedule_map` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `schedule_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `duration` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `duration`) VALUES
(1, 'Consultation', 45),
(2, 'Physical examination', 30),
(3, 'Allergy injection', 10),
(4, 'Flu shot & Immunization', 10),
(5, 'Electrocardiogram', 15),
(6, 'Stress lab', 15),
(7, 'ECP', 15),
(8, 'Post Operative Care', 30),
(9, 'Rehabilitation', 45),
(10, 'Injury screening', 30),
(11, 'Work conditioning', 45),
(12, 'Dental Implants', 45),
(13, 'Teeth cleaning', 20),
(14, 'Extraction', 45),
(15, 'Whitening', 30),
(16, 'Botox', 25),
(17, 'TCD', 15),
(18, 'EEG', 15),
(19, 'NCS', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_list`
--
ALTER TABLE `model_list`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `nightschift`
--
ALTER TABLE `nightschift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regular`
--
ALTER TABLE `regular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `schedule_map`
--
ALTER TABLE `schedule_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nightschift`
--
ALTER TABLE `nightschift`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regular`
--
ALTER TABLE `regular`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule_map`
--
ALTER TABLE `schedule_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
