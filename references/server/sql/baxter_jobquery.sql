-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2018 at 03:12 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baxter_jobquery`
--

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `employerId` int(11) NOT NULL,
  `employerName` varchar(255) NOT NULL,
  `employerDescription` varchar(255) NOT NULL,
  `employerLocation` varchar(255) NOT NULL,
  `employerType` varchar(255) NOT NULL,
  `employerSponsor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`employerId`, `employerName`, `employerDescription`, `employerLocation`, `employerType`, `employerSponsor`) VALUES
(1, 'McDonald\'s', 'We got frozen beef.', '332 St John St Portland ME 04102', 'Business', 'Yes'),
(2, 'Walmart', 'Sponsored by Lil Pump, Gucci for only the best clothing.', '500 Gallery Blvd Scarborough ME 04074', 'Business', ''),
(3, 'Subway', 'I like their sandwiches.', '498 Congress St Portland ME 04101', 'Business', 'Yes'),
(4, 'Wendy\'s', 'Funny prank we don\'t even have any frozen beef.', '50 Market St South Portland ME 04106', 'Business', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobId` int(11) NOT NULL,
  `employerId` int(11) NOT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `jobDescription` text NOT NULL,
  `jobLocation` varchar(255) NOT NULL,
  `jobSponsor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobId`, `employerId`, `jobTitle`, `jobDescription`, `jobLocation`, `jobSponsor`) VALUES
(1, 1, 'Fry Cook', 'Making French fries and chicken nuggets.', 'Forest Ave, ME', 'Yes'),
(2, 1, 'Cashier', 'Ringing up Happy Meals.', 'John St', 'Yes'),
(3, 2, 'Inventory', 'Loading cargo into the warehouse.', 'Falmouth, ME', 'Yes'),
(4, 2, 'Greeter', 'Welcoming people to Wal-Mart.', 'Scarborough, ME', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userToken` text NOT NULL,
  `userFirst` varchar(255) NOT NULL,
  `userLast` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userEmail`, `userToken`, `userFirst`, `userLast`, `userPassword`) VALUES
(1, 'mustafa.ah@baxter-academy.org', '', 'Mustafa', 'Abu Hamad', '08d6b784d8e959bd202f80af8f587445'),
(2, 'Brendanwalton09@gmail.com', '', 'bob', 'bob', '69ce821ce9e7e9ef9be5a5407811b538'),
(25, '43mjkj@f5.si', '', 'Riley', 'Adela', ''),
(26, 'randomemail@gmail.com', '', 'random', 'person', ''),
(27, 'burnmytoes9@gmail.com', '', 'Alexander', 'Carter', '9c56df6c8060490abd2c6859348c9746'),
(28, 'nikowoodhouse@gmail.com', '', 'Niko', 'Woodhouse', 'ee26e7bd21ad86835eb597731e6cc963'),
(29, 'urmom@gmail.com', '', 'Conner', 'Slaughter Heynen', '4fe2dae188944860765d4879c508ec63');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`employerId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `employerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
