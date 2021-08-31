-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 07:31 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tlrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tlr_assignteam`
--

CREATE TABLE `tlr_assignteam` (
  `id` int(11) NOT NULL,
  `sourceId` int(11) NOT NULL,
  `requisitionId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `stagesId` int(11) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1-Assign,2-Unassign',
  `reAssigned` enum('Yes','No') NOT NULL DEFAULT 'No',
  `updatedBy` int(11) NOT NULL,
  `updatedDate` date NOT NULL,
  `lastUpdatedTime` datetime NOT NULL,
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_city`
--

CREATE TABLE `tlr_city` (
  `id` int(11) NOT NULL,
  `stateId` int(11) NOT NULL,
  `cityName` varchar(150) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_client`
--

CREATE TABLE `tlr_client` (
  `id` int(11) NOT NULL,
  `clientName` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `spocContact` varchar(20) NOT NULL,
  `mobile` int(10) NOT NULL,
  `clientWebsite` text NOT NULL,
  `clientSpoc` varchar(150) NOT NULL,
  `uploadContract` text DEFAULT NULL,
  `iprimedspocClient` varchar(150) NOT NULL,
  `companyName` varchar(200) NOT NULL,
  `masterPassword` varchar(150) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `lastUpdatedTime` datetime NOT NULL,
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tlr_client`
--

INSERT INTO `tlr_client` (`id`, `clientName`, `email`, `password`, `address`, `description`, `spocContact`, `mobile`, `clientWebsite`, `clientSpoc`, `uploadContract`, `iprimedspocClient`, `companyName`, `masterPassword`, `isDeleted`, `lastUpdatedTime`, `createdTime`) VALUES
(1, 'pankaj', 'pankaj@ygmail.com', 'pankaj@123', 'Mumbai', 'description', '291-20239898', 987654321, 'google.com', 'text', '', 'IPRIMED', 'textlocal', 'pankaj@123', 'N', '0000-00-00 00:00:00', '2021-06-20 23:01:32'),
(2, 'Pankaj', 'pankajx@ygmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mumbai', 'This is just test description for checking editiing', '120-20345678', 2147483647, 'www.goqii.com', 'tesxtspoc', 'uploadsow/Three little pigs.pdf', 'spocforlead', 'google', '81ec8e45a2b2d6c8f6aaf0ee40689c08', 'N', '0000-00-00 00:00:00', '2021-06-20 23:37:13'),
(3, 'Pankaj', 'pankaj@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mumbai', 'This is just test description text', '120-20345678', 1234567890, 'www.google.com', 'tesxtspoc', 'uploadsow/Three little pigs.pdf', 'spocforlead', 'yahoo', '81ec8e45a2b2d6c8f6aaf0ee40689c08', 'N', '0000-00-00 00:00:00', '2021-06-20 23:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `tlr_feedback`
--

CREATE TABLE `tlr_feedback` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `stagesId` int(11) NOT NULL,
  `feedbackText` text NOT NULL,
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_requisitions`
--

CREATE TABLE `tlr_requisitions` (
  `id` int(11) NOT NULL,
  `reqNo` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `experienceMin` varchar(20) NOT NULL,
  `experienceMax` varchar(20) NOT NULL,
  `ctcRangeMin` int(20) NOT NULL,
  `ctcRangeMax` int(20) NOT NULL,
  `noticePeriod` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `resourceCount` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `keyTechnicalSkills` text NOT NULL,
  `otherSkill` text NOT NULL,
  `comment` text NOT NULL,
  `jdUpload` text NOT NULL,
  `iptest` text NOT NULL,
  `stages` text NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `updatedDate` datetime NOT NULL,
  `clientId` varchar(50) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `lastUpdatedTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_rolemaster`
--

CREATE TABLE `tlr_rolemaster` (
  `id` int(11) NOT NULL,
  `roleName` varchar(150) NOT NULL,
  `roleType` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-Source,2-Training',
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_selectionstages`
--

CREATE TABLE `tlr_selectionstages` (
  `id` int(11) NOT NULL,
  `stageName` varchar(150) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_sourcingteam`
--

CREATE TABLE `tlr_sourcingteam` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `mobile` int(10) NOT NULL,
  `currentCompany` text NOT NULL,
  `currentDesignation` varchar(150) NOT NULL,
  `currentDepartment` varchar(200) NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  `role` int(11) NOT NULL,
  `masterPassword` varchar(150) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `lastUpdatedTime` datetime NOT NULL,
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_state`
--

CREATE TABLE `tlr_state` (
  `id` int(11) NOT NULL,
  `countryId` int(11) NOT NULL,
  `stateName` varchar(150) NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tlr_test`
--

CREATE TABLE `tlr_test` (
  `id` int(11) NOT NULL,
  `testName` varchar(200) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `url` text NOT NULL,
  `isDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `lastUpdatedTime` datetime NOT NULL,
  `createdTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tlr_assignteam`
--
ALTER TABLE `tlr_assignteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_city`
--
ALTER TABLE `tlr_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_client`
--
ALTER TABLE `tlr_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_feedback`
--
ALTER TABLE `tlr_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_requisitions`
--
ALTER TABLE `tlr_requisitions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reqNo` (`reqNo`);

--
-- Indexes for table `tlr_rolemaster`
--
ALTER TABLE `tlr_rolemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_selectionstages`
--
ALTER TABLE `tlr_selectionstages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_sourcingteam`
--
ALTER TABLE `tlr_sourcingteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_state`
--
ALTER TABLE `tlr_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tlr_test`
--
ALTER TABLE `tlr_test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tlr_assignteam`
--
ALTER TABLE `tlr_assignteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_city`
--
ALTER TABLE `tlr_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_client`
--
ALTER TABLE `tlr_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tlr_feedback`
--
ALTER TABLE `tlr_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_requisitions`
--
ALTER TABLE `tlr_requisitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_rolemaster`
--
ALTER TABLE `tlr_rolemaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_selectionstages`
--
ALTER TABLE `tlr_selectionstages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_sourcingteam`
--
ALTER TABLE `tlr_sourcingteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_state`
--
ALTER TABLE `tlr_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tlr_test`
--
ALTER TABLE `tlr_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
