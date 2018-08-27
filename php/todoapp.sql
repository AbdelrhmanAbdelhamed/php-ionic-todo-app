-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2016 at 06:01 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `Id` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Remainder` varchar(255) DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`Id`, `Description`, `Remainder`, `isDone`, `userId`) VALUES
(12, 'Test', 'null', 1, 26),
(14, 'Test 2', 'null', 0, 26);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `password`) VALUES
(26, 'AA', 'AA@gmail.com', 'AA'),
(27, 'BB', 'BB@gmail.com', 'BB'),
(28, 'CC', 'CC@gmail.com', 'CC'),
(29, 'DD', 'DD@gmail.com', 'DD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
