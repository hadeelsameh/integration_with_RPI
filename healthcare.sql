-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 01:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `roomid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `color`, `roomid`) VALUES
(1, 'yellow', 2),
(2, 'pink', 5),
(3, 'yellow', 5),
(4, 'black', 5),
(5, 'red', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ssn` int(11) NOT NULL,
  `password` text NOT NULL,
  `speciality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `ssn`, `password`, `speciality`) VALUES
(6, '755', 0, '$2y$10$LkyydaLooXoZYFaaq6lvEe8w9BOq9zfWSwTGrHW4BAS7vgCNOo97q', 'surgery'),
(7, 'ola', 284, '$2y$10$Fi9mkYm88.t4V.U/BqTagOpX2G9VPqrkKe9TxU9qe67Jw/sPfSoM.', 'cardio'),
(8, 'hadeel', 6327, '$2y$10$bXMVyvJJHSlyKZ95.xrckuHEwHzrTMmR77C/euHgfVZ796vvGMOTa', 'cardio'),
(9, 'Hadeeel', 2147483647, '$2y$10$OYuwJI8.luObdes9D6qkROzHgFv.f67eM7B35jToH654Q1a8H3hKC', 'cardio');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `ssn` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `heartrate` int(11) NOT NULL,
  `temprature` int(11) NOT NULL,
  `spo` int(11) NOT NULL,
  `bloodglucose` int(11) NOT NULL,
  `bedid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `status` varchar(500) NOT NULL,
  `doctornotes` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `ssn`, `name`, `gender`, `age`, `heartrate`, `temprature`, `spo`, `bloodglucose`, `bedid`, `roomid`, `status`, `doctornotes`) VALUES
(1, 6457, 'ali', 'male', 65, 80, 37, 97, 80, 5, 2, 'normal', 'this is dotty'),
(2, 9675, 'asia', 'female', 45, 80, 38, 97, 80, 4, 5, 'verygood', 'about to check out'),
(3, 7429, 'raafat', 'male', 55, 85, 39, 90, 70, 2, 2, 'danger', 'intensivecare'),
(4, 8608, 'adham', 'male', 88, 1000, 40, 30, 190, 8, 2, 'danger', 'very danger'),
(5, 738, 'neemaat', 'female', 88, 89, 37, 95, 190, 1, 2, 'diabetes', 'mesh 3aref');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(11) NOT NULL,
  `location` varchar(500) NOT NULL,
  `department` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `location`, `department`) VALUES
(2, '2floor', 'cardio'),
(5, '2floor', 'cardio');

-- --------------------------------------------------------

--
-- Table structure for table `treatedby`
--

CREATE TABLE `treatedby` (
  `doctorid` int(11) NOT NULL,
  `patientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatedby`
--

INSERT INTO `treatedby` (`doctorid`, `patientid`) VALUES
(7, 3),
(7, 4),
(8, 1),
(8, 2),
(8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `visitstimetable`
--

CREATE TABLE `visitstimetable` (
  `ind` int(11) NOT NULL,
  `patientid` int(11) NOT NULL,
  `day` date NOT NULL,
  `time` time NOT NULL,
  `isvideocall` int(11) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitstimetable`
--

INSERT INTO `visitstimetable` (`ind`, `patientid`, `day`, `time`, `isvideocall`, `verified`) VALUES
(1, 1, '2021-05-17', '13:00:00', 2, 0),
(2, 1, '2021-05-17', '17:00:00', 1, 0),
(3, 1, '2021-05-10', '13:00:00', 0, 0),
(4, 2, '2021-05-17', '18:06:00', 2, 0),
(5, 1, '2021-05-17', '03:12:00', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`,`roomid`),
  ADD KEY `roomid` (`roomid`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `ssn` (`ssn`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ssn` (`ssn`),
  ADD KEY `roomid` (`roomid`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `treatedby`
--
ALTER TABLE `treatedby`
  ADD UNIQUE KEY `doctorid` (`doctorid`,`patientid`),
  ADD KEY `patientid` (`patientid`);

--
-- Indexes for table `visitstimetable`
--
ALTER TABLE `visitstimetable`
  ADD PRIMARY KEY (`ind`),
  ADD UNIQUE KEY `day` (`day`,`time`),
  ADD KEY `patientid` (`patientid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitstimetable`
--
ALTER TABLE `visitstimetable`
  MODIFY `ind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed`
--
ALTER TABLE `bed`
  ADD CONSTRAINT `b_id` FOREIGN KEY (`id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bed_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON UPDATE CASCADE;

--
-- Constraints for table `treatedby`
--
ALTER TABLE `treatedby`
  ADD CONSTRAINT `treatedby_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `treatedby_ibfk_2` FOREIGN KEY (`patientid`) REFERENCES `patients` (`id`);

--
-- Constraints for table `visitstimetable`
--
ALTER TABLE `visitstimetable`
  ADD CONSTRAINT `visitstimetable_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
