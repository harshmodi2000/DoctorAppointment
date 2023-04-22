-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2021 at 07:22 PM
-- Server version: 8.0.22
-- PHP Version: 7.3.24-(to be removed in future macOS)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int NOT NULL,
  `name` varchar(120) NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Comel Hassim', 'comel', 'docteurenric@gmail.com', '$2y$10$Xtn/38s2hd9bbiFnkB/RMeGxUSkDYEX1dVDZpmgb1LogsPLYCMiMC'),
(2, 'Comel Hassim', 'coco20', 'admin@acoshop.admin', '$2y$10$bBIZcNWQyfdsAkDLRK5oSekzRv.jIreP.OJBVh.JcQfjc8VIdIMX.'),
(3, 'Gurpreet Singh', 'Guru@123', 'gurupreetsingh9073@gmail.com', '$2y$10$OgVoLxw22AqKvt3BPmpdA.Gw8W/HMqPBcSAWkYandstpJwUY7TbLW');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int NOT NULL,
  `patientId` int NOT NULL,
  `doctorId` int NOT NULL,
  `appointmentDate` date NOT NULL,
  `appointmentTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patientId`, `doctorId`, `appointmentDate`, `appointmentTime`) VALUES
(1, 1, 1, '2021-05-01', '10:15:00'),
(2, 1, 1, '2021-05-01', '11:00:00'),
(3, 1, 1, '2021-05-01', '11:45:00'),
(4, 1, 1, '2021-05-01', '12:30:00'),
(5, 1, 1, '2021-05-01', '13:15:00'),
(6, 1, 1, '2021-05-02', '13:00:00'),
(7, 1, 1, '2021-05-02', '13:45:00'),
(8, 1, 1, '2021-05-02', '14:30:00'),
(9, 1, 1, '2021-05-02', '15:15:00'),
(10, 1, 1, '2021-05-02', '16:00:00'),
(11, 1, 1, '2021-05-03', '09:00:00'),
(12, 1, 1, '2021-05-03', '09:45:00'),
(13, 1, 1, '2021-05-03', '10:30:00'),
(14, 1, 1, '2021-05-03', '11:15:00'),
(15, 1, 1, '2021-05-03', '12:00:00'),
(16, 1, 1, '2021-05-03', '12:45:00'),
(17, 1, 1, '2021-05-03', '13:30:00'),
(18, 1, 1, '2021-05-03', '15:00:00'),
(19, 1, 1, '2021-05-03', '14:15:00'),
(20, 1, 1, '2021-05-03', '15:45:00'),
(21, 1, 1, '2021-05-03', '16:30:00'),
(22, 1, 1, '2021-05-03', '17:15:00'),
(23, 1, 1, '2021-05-03', '18:00:00'),
(24, 1, 2, '2021-05-02', '13:00:00'),
(25, 2, 2, '2021-05-02', '13:45:00'),
(26, 2, 2, '2021-05-02', '14:30:00'),
(27, 1, 2, '2021-05-02', '15:15:00'),
(28, 1, 2, '2021-05-02', '16:00:00'),
(29, 2, 2, '2021-05-03', '09:00:00'),
(30, 1, 2, '2021-05-03', '09:45:00'),
(31, 1, 1, '2021-05-05', '15:00:00'),
(32, 1, 1, '2021-05-05', '15:45:00'),
(33, 1, 1, '2021-05-05', '15:45:00'),
(34, 1, 1, '2021-05-05', '13:30:00'),
(35, 1, 1, '2021-05-05', '09:00:00'),
(36, 1, 1, '2021-05-05', '14:15:00'),
(37, 1, 1, '2021-05-06', '09:00:00'),
(38, 1, 1, '2021-05-06', '12:45:00'),
(39, 1, 2, '2021-05-06', '09:45:00'),
(40, 1, 1, '2021-05-06', '11:15:00'),
(41, 1, 3, '2021-05-07', '09:00:00'),
(42, 1, 1, '2021-05-06', '09:45:00'),
(43, 1, 4, '2021-05-07', '10:30:00'),
(44, 1, 1, '2021-05-07', '17:15:00'),
(45, 1, 4, '2021-05-09', '13:00:00'),
(46, 1, 4, '2021-05-09', '13:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `appointmentId` int NOT NULL,
  `bookingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('requested','confirmed','request_for_ cancellation') NOT NULL DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `appointmentId`, `bookingDate`, `status`) VALUES
(1, 7, '2021-05-08 13:58:32', 'confirmed'),
(2, 8, '2021-05-01 10:35:02', 'requested'),
(3, 9, '2021-05-01 10:35:52', 'requested'),
(4, 10, '2021-05-01 10:37:34', 'requested'),
(5, 11, '2021-05-01 12:15:53', 'requested'),
(6, 12, '2021-05-01 12:16:38', 'requested'),
(7, 13, '2021-05-01 12:21:13', 'requested'),
(8, 14, '2021-05-01 12:23:11', 'requested'),
(9, 15, '2021-05-01 12:26:43', 'requested'),
(10, 16, '2021-05-01 12:42:29', 'requested'),
(11, 17, '2021-05-01 12:46:02', 'requested'),
(12, 18, '2021-05-01 12:47:14', 'requested'),
(13, 19, '2021-05-01 12:47:57', 'requested'),
(14, 20, '2021-05-01 12:49:03', 'requested'),
(15, 21, '2021-05-01 12:51:47', 'requested'),
(16, 22, '2021-05-01 17:02:00', 'requested'),
(17, 23, '2021-05-01 17:02:28', 'requested'),
(18, 24, '2021-05-01 17:02:51', 'requested'),
(19, 31, '2021-05-04 19:31:08', 'requested'),
(20, 32, '2021-05-05 12:29:02', 'requested'),
(21, 33, '2021-05-05 12:29:08', 'requested'),
(22, 34, '2021-05-05 12:29:27', 'requested'),
(23, 35, '2021-05-05 13:42:36', 'requested'),
(24, 36, '2021-05-05 13:42:58', 'requested'),
(25, 37, '2021-05-05 13:50:43', 'requested'),
(26, 38, '2021-05-05 13:55:24', 'requested'),
(27, 39, '2021-05-05 13:56:54', 'requested'),
(28, 40, '2021-05-05 18:29:12', 'requested'),
(29, 41, '2021-05-05 18:31:21', 'requested'),
(30, 42, '2021-05-05 23:34:59', 'requested'),
(31, 43, '2021-05-06 19:05:31', 'requested'),
(32, 44, '2021-05-07 12:10:29', 'requested'),
(33, 45, '2021-05-08 18:21:05', 'requested'),
(34, 46, '2021-05-08 18:21:22', 'requested');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `isFromPatient` tinyint(1) NOT NULL,
  `msg` longtext NOT NULL,
  `msg_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `did`, `pid`, `isFromPatient`, `msg`, `msg_ts`) VALUES
(1, 4, 1, 0, 'Hi', '2021-05-02 18:07:47'),
(2, 4, 1, 0, 'I m your Dr.Harsh Modi', '2021-05-02 19:35:22'),
(3, 4, 1, 0, 'How you have been doing lately?', '2021-05-02 19:41:46'),
(4, 4, 1, 1, 'I have been having Stomachache lately since the morning', '2021-05-02 19:43:19'),
(5, 4, 1, 1, 'And not able to sleep properly', '2021-05-03 08:01:11'),
(6, 4, 1, 1, 'thats it', '2021-05-03 11:53:10'),
(7, 4, 1, 0, 'HI', '2021-05-03 12:01:13'),
(8, 4, 1, 0, 'HI', '2021-05-03 12:01:31'),
(9, 4, 1, 1, 'Hi', '2021-05-03 12:02:31'),
(10, 4, 1, 0, 'This is \nDoctor', '2021-05-03 12:03:03'),
(11, 4, 1, 1, 'This is Patient', '2021-05-03 12:03:15'),
(12, 4, 1, 0, 'Hi\n', '2021-05-05 14:13:49'),
(13, 4, 1, 0, 'Projecy kaha tak pocha?', '2021-05-06 13:41:22'),
(14, 4, 1, 1, 'Kahi nai\n', '2021-05-06 13:41:57'),
(15, 4, 1, 1, '', '2021-05-07 19:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` char(1) NOT NULL,
  `profileImage` varchar(256) DEFAULT '0',
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `gender`, `profileImage`, `phone`, `email`, `username`, `password`) VALUES
(1, 'Comel Hassim', 'M', NULL, '+917779044043', 'docteurenric@gmail.com', '', '$2y$10$vggqkMhRmg4M611j1IJX4.FaHKIH2SqY453Si.KIAaHbpFz82wMrC'),
(2, 'girl', 'F', NULL, '+917779044043', 'admin@acoshop.admin', NULL, '$2y$10$PVza/2Yt7tjGINdOOTqaAOWTVggixrn6fSS.n6UZlswvDRzSwN8iO'),
(3, 'consultation', 'M', NULL, '+917779044043', 'aditya@aco.shop', NULL, '$2y$10$Wa7mU0dEUMmJP8YTLnBuq.H6ot1.IelSIK8waAjG3xY8gKMlGTJ4i'),
(4, 'Harsh Modi', 'M', NULL, '+919723941009', 'harshmodi2000@yahoo.in', 'harshmodi', '$2y$10$QMyfR8PgrvcphU9ioH5hEOnosPIJlL3FGbqgazITnkE6RtvgFvJES'),
(5, 'Rithvik Singh', 'M', NULL, '9102392392', 'rithvik.singh.999@gmail.com', 'rithvik', '$2y$10$orHGdguAZRawQtSnIy3wtO7nW1Ab4TXt3lc9IH8PaSOoNHzK8hoWu');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int NOT NULL,
  `pid` int NOT NULL,
  `apid` int NOT NULL,
  `age` int NOT NULL,
  `weight` int DEFAULT NULL,
  `bloodpressure_systolic` int DEFAULT NULL,
  `bloodpressure_diabolic` int DEFAULT NULL,
  `sugarlevel` int DEFAULT NULL,
  `specialNote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`id`, `pid`, `apid`, `age`, `weight`, `bloodpressure_systolic`, `bloodpressure_diabolic`, `sugarlevel`, `specialNote`) VALUES
(1, 2, 1, 80, 75, NULL, NULL, NULL, NULL);

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
('normal'),
('regular');

-- --------------------------------------------------------

--
-- Table structure for table `nightschift`
--

CREATE TABLE `nightschift` (
  `id` int NOT NULL,
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
-- Table structure for table `normal`
--

CREATE TABLE `normal` (
  `id` int NOT NULL,
  `days` varchar(128) DEFAULT NULL,
  `time1` varchar(20) DEFAULT NULL,
  `time2` varchar(20) DEFAULT NULL,
  `time3` varchar(20) DEFAULT NULL,
  `time4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `normal`
--

INSERT INTO `normal` (`id`, `days`, `time1`, `time2`, `time3`, `time4`) VALUES
(1, 'MON-TUE-FRI-SAT', '12:05-14:00', '17:00-19:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `partition_default`
--

CREATE TABLE `partition_default` (
  `duration` int UNSIGNED DEFAULT NULL,
  `margin` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `id` int NOT NULL,
  `user` tinyint(1) NOT NULL,
  `email` varchar(128) NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expiry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`id`, `user`, `email`, `selector`, `token`, `expiry`) VALUES
(4, 0, 'docteurenric@gmail.com', '5526342c6dbe620e', '$2y$10$jxuhivRtBtNwcgjd55V2J.X/JXOPaYh2vf/NyKAPSdAouuAlUl.fi', '1619146019'),
(5, 0, 'admin@acoshop.admin', '62f1a93de88ea3e2', '$2y$10$dFzXC2hzuh3YLAJ8pOG5VuzlIIcrGvM3bb4fRnP0CpAI0Xjg/h5xq', '1620131504'),
(6, 0, 'aditya@aco.shop', '467661982757da0f', '$2y$10$Dz2zD4fQJ1DKYNqrio4JGuGlF6XiynnAuOsefe2Ya6LUiyaclMrAi', '1620131536'),
(16, 0, 'harshmodi2000@yahoo.in', '85c5487883bda5b1', '$2y$10$5aV4f7f2916xGaX3W.3DVuOXYAKXY4OUVv.WtnKC1bOsJCca3ktee', '1620331912');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
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
(1, 'Comel Hassim', 'M', '40, Sardar Smurti Society, Near Agro Petrol Pump, Juhapura, Sarkhej Road', '+917779044043', '1997-05-28', 'docteurenric@gmail.com', 'comel', '$2y$10$NXMhH.1KG/DQr1rdplJSgecje5dOtJ2/03Y707hCWVF726yYouluK'),
(2, 'Harsh', 'M', '40, Sardar Smurti Society, Near Agro Petrol Pump, Juhapura, Sarkhej Road', '+917779044043', '1998-06-05', 'harsh@gmail.com', 'harsh', '$2y$10$q2gRuvgooqqCEQ6vZBTiZ.dEq8loYmMzoD2KywKryQE38LcHYrxCi'),
(3, 'Harsh Modi', 'M', 'Shahibaug,Ahmedabad', '9723941009', '1999-05-20', 'harshmodi2000@yahoo.in', 'harshmodi2000', '$2y$10$ERRtxQiAIEXelMzsYEvsiuO5QztCKc.TxXTnclbLnA7e.qj4UjhcW'),
(4, 'Gurpreet Singh', 'M', 'Narol,Ahmedabad', '9026076769', '1999-12-19', 'gurupreetsingh9073@gmail.com', 'Guru@123', '$2y$10$d4TtHY8TZXnRVfMFXx.7s.9LcXXN2nrnQELtjekuBXCAl6kSkBIvm');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int NOT NULL,
  `appointmentId` int NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `BP` varchar(10) DEFAULT NULL,
  `HR` varchar(10) DEFAULT NULL,
  `T` varchar(5) DEFAULT NULL,
  `RR` varchar(5) DEFAULT NULL,
  `SPO2` varchar(5) DEFAULT NULL,
  `remarks` longtext,
  `prescriptionFile` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `appointmentId`, `name`, `age`, `weight`, `BP`, `HR`, `T`, `RR`, `SPO2`, `remarks`, `prescriptionFile`) VALUES
(29, 49, '', '', '', '', '', '', '', '', '', 'p29_609659d771e84.txt'),
(30, 43, 'Comel Hassim', '70', '70', '89-120', '80', '97', '120', '98', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regular`
--

CREATE TABLE `regular` (
  `id` int NOT NULL,
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
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `service` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `service`) VALUES
(6, 'family doctor', '1,2,3,4'),
(7, 'cardiologist', '1,5,6,7'),
(8, 'Neurologist', '1,16,17,18,19'),
(9, 'physiotherapist', '1,8,9,10,11'),
(10, 'dentist', '1,12,13,14,15');

-- --------------------------------------------------------

--
-- Table structure for table `role_map`
--

CREATE TABLE `role_map` (
  `doctorId` int DEFAULT NULL,
  `roleId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_map`
--

INSERT INTO `role_map` (`doctorId`, `roleId`) VALUES
(1, 7),
(2, 10),
(3, 6),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_map`
--

CREATE TABLE `schedule_map` (
  `id` int NOT NULL,
  `doctorId` int NOT NULL,
  `schedule_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_map`
--

INSERT INTO `schedule_map` (`id`, `doctorId`, `schedule_name`) VALUES
(2, 1, 'regular'),
(3, 2, 'regular'),
(4, 3, 'regular'),
(5, 4, 'regular'),
(6, 5, 'nightschift');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `duration` int NOT NULL
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
(19, 'NCS', 20),
(20, 'Oxygen', 10);

-- --------------------------------------------------------

--
-- Table structure for table `time_partition`
--

CREATE TABLE `time_partition` (
  `roleId` int NOT NULL,
  `preferred` int DEFAULT NULL,
  `margin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkdid` (`doctorId`),
  ADD KEY `fkpid` (`patientId`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkapId` (`appointmentId`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `did` (`did`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apid` (`apid`),
  ADD KEY `pid` (`pid`);

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
-- Indexes for table `normal`
--
ALTER TABLE `normal`
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
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointmentId` (`appointmentId`);

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
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `role_map`
--
ALTER TABLE `role_map`
  ADD UNIQUE KEY `roleId` (`roleId`),
  ADD KEY `fkdoctorRoleId` (`doctorId`);

--
-- Indexes for table `schedule_map`
--
ALTER TABLE `schedule_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkdoctorId` (`doctorId`),
  ADD KEY `fkschedulename` (`schedule_name`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `time_partition`
--
ALTER TABLE `time_partition`
  ADD KEY `fktimedId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nightschift`
--
ALTER TABLE `nightschift`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `normal`
--
ALTER TABLE `normal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `regular`
--
ALTER TABLE `regular`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedule_map`
--
ALTER TABLE `schedule_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fkdid` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkpid` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fkapId` FOREIGN KEY (`appointmentId`) REFERENCES `appointment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`did`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`id`);

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`apid`) REFERENCES `appointment` (`id`),
  ADD CONSTRAINT `medical_history_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`id`);

--
-- Constraints for table `role_map`
--
ALTER TABLE `role_map`
  ADD CONSTRAINT `fkdoctorRoleId` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkroleId` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_map`
--
ALTER TABLE `schedule_map`
  ADD CONSTRAINT `fkdoctorId` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkschedulename` FOREIGN KEY (`schedule_name`) REFERENCES `model_list` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_partition`
--
ALTER TABLE `time_partition`
  ADD CONSTRAINT `fktimedId` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
