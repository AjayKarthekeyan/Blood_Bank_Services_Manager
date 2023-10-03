-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2023 at 05:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodinfo`
--

CREATE TABLE `bloodinfo` (
  `bid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `bg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodinfo`
--

INSERT INTO `bloodinfo` (`bid`, `hid`, `bg`) VALUES
(1, 1, 'B+'),
(2, 2, 'A+'),
(5, 3, 'AB-'),
(6, 4, 'B-'),
(7, 4, 'AB+'),
(8, 5, 'O-'),
(9, 5, 'B+'),
(10, 6, 'A-'),
(11, 6, 'B-'),
(12, 3, 'O-'),
(13, 1, 'AB-'),
(14, 7, 'A+'),
(15, 7, 'B-'),
(16, 7, 'B+');

-- --------------------------------------------------------

--
-- Table structure for table `bloodrequest`
--

CREATE TABLE `bloodrequest` (
  `reqid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `bg` varchar(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodrequest`
--

INSERT INTO `bloodrequest` (`reqid`, `hid`, `rid`, `bg`, `status`) VALUES
(1, 1, 1, 'B+', 'Pending'),
(2, 3, 3, 'AB-', 'Rejected'),
(3, 3, 2, 'B+', 'Accepted'),
(4, 1, 2, 'B+', 'Accepted'),
(5, 7, 2, 'A+', 'Accepted'),
(6, 0, 2, 'B+', 'Pending'),
(7, 0, 3, 'B+', 'Pending'),
(8, 7, 4, 'A+', 'Accepted'),
(9, 0, 4, 'A+', 'Pending'),
(10, 2, 2, 'A+', 'Pending'),
(11, 1, 4, 'B+', 'Pending'),
(12, 2, 4, 'B+', 'Pending'),
(14, 3, 1, 'AB+', 'Accepted'),
(15, 3, 4, 'AB+', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `demail` varchar(255) NOT NULL,
  `dpassword` varchar(100) NOT NULL,
  `dphone` varchar(100) NOT NULL,
  `dbg` varchar(10) NOT NULL,
  `dcity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `dname`, `demail`, `dpassword`, `dphone`, `dbg`, `dcity`) VALUES
(1, 'AJAY K', 'ajaystar535@gmail.com', 'ajay@123', '63828569xx', 'B-', 'Chennai'),
(2, 'vijay', 'vijay@gmail.com', 'vijay@123', '9876543210', 'B+', 'Coimbator'),
(3, 'Bala', 'bala@gmail.com', 'bala@123', '9865473201', 'AB+', 'chennai');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `hname` varchar(100) NOT NULL,
  `hemail` varchar(100) NOT NULL,
  `hpassword` varchar(100) NOT NULL,
  `hphone` varchar(100) NOT NULL,
  `hcity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `hname`, `hemail`, `hpassword`, `hphone`, `hcity`) VALUES
(1, 'Fortis Mallar Hospital', 'healthcare@fortismalarhospital.com', 'Fortismalar@123', '914442892222', 'Chennai'),
(2, 'SRM Hospital', 'healthmatters@srmhospital.com', 'Srm@123', '914427452270', 'Kancheepuram'),
(3, 'Apollo Multi Speciality Hospital', 'Apollocares@apollohospitals.com', 'Apollo@123', '914428290200', 'Chennai'),
(4, 'MIOT Hospital', 'miotcares@miothospital.com', 'Miot@123', '9122492288', 'Chennai'),
(5, 'CSI Kalyani Hospital', 'healthpioneer@csikalyanihospital.com', 'Csikalyani@123', '914428476433', 'Chennai'),
(6, 'Kauvery Hospital', 'lifecare@kauveryhospital.com', 'Kauvery@123', '914462855324', 'Salem'),
(7, 'Sathyabama Hospital', 'sathyabamahospital@gmail.com', 'sathyabama@123', '04444445555', 'chennai');

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` int(11) NOT NULL,
  `rname` varchar(100) NOT NULL,
  `remail` varchar(100) NOT NULL,
  `rpassword` varchar(100) NOT NULL,
  `rphone` varchar(100) NOT NULL,
  `rbg` varchar(10) NOT NULL,
  `rcity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `rname`, `remail`, `rpassword`, `rphone`, `rbg`, `rcity`) VALUES
(1, 'Ajay.K', 'Ajayk@gmail.com', 'ajayk@123', '9178234217', 'A+', 'Chengalpattu'),
(2, 'AJAY', 'ajay@gmail.com', 'ajay@123', '63828569xx', 'B-', 'chennai'),
(3, 'Hari', 'hari@gmail.com', 'hari@123', '9174568052', 'B+', 'Madurai'),
(4, 'Abilash', 'abilash@gmail.com', 'abi@123', '9876543210', 'AB+', 'Chennai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodinfo`
--
ALTER TABLE `bloodinfo`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `bloodrequest`
--
ALTER TABLE `bloodrequest`
  ADD PRIMARY KEY (`reqid`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hemail` (`hemail`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `remail` (`remail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodinfo`
--
ALTER TABLE `bloodinfo`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bloodrequest`
--
ALTER TABLE `bloodrequest`
  MODIFY `reqid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloodinfo`
--
ALTER TABLE `bloodinfo`
  ADD CONSTRAINT `bloodinfo_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hospitals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
