-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2022 at 05:52 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crypto_hyip`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `ID` int NOT NULL,
  `userID` int NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `planID` int NOT NULL,
  `planTitle` varchar(50) DEFAULT NULL,
  `percentage` int DEFAULT '0',
  `profitFrequency` varchar(10) DEFAULT 'end',
  `transactionID` varchar(100) DEFAULT NULL,
  `depositAddress` varchar(191) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `cryptoCurrency` varchar(50) DEFAULT 'btc',
  `cryptoAmount` varchar(255) DEFAULT NULL,
  `depositStatus` enum('pending','approved','released') DEFAULT 'pending',
  `depositApprovalDate` timestamp NULL DEFAULT NULL,
  `interestBalance` double(10,2) DEFAULT '0.00',
  `lastInterestDate` timestamp NULL DEFAULT NULL COMMENT 'The date of the most recent interest paid to user',
  `finalInterestDate` timestamp NULL DEFAULT NULL COMMENT 'The date the last and final interest will be paid to user',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `ID` int NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `content` text,
  `useGeneralHeader` tinyint(1) DEFAULT NULL,
  `useGeneralFooter` tinyint(1) DEFAULT NULL,
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `ID` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `ordering` int DEFAULT NULL,
  `hasBadge` tinyint(1) DEFAULT '0',
  `minimum` int DEFAULT NULL,
  `maximum` int DEFAULT NULL,
  `percentage` int DEFAULT NULL,
  `referralPercentage` int DEFAULT NULL,
  `durationType` enum('hour','day','week','month','year') DEFAULT NULL,
  `profitFrequency` enum('end','hourly','daily','weekly','monthly','yearly') DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queued_jobs`
--

CREATE TABLE `queued_jobs` (
  `ID` int NOT NULL,
  `type` varchar(50) DEFAULT 'mail',
  `data` longtext,
  `status` enum('queued','processing','done','failed') DEFAULT 'queued',
  `error` text,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `ID` int NOT NULL,
  `referralUserID` int NOT NULL,
  `referralUserName` varchar(50) DEFAULT NULL,
  `referredUserID` int NOT NULL,
  `referredUserName` varchar(50) DEFAULT NULL,
  `referralPaid` tinyint(1) NOT NULL DEFAULT '0',
  `referralBonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `traillog`
--

CREATE TABLE `traillog` (
  `ID` int NOT NULL,
  `userID` int NOT NULL,
  `userName` varchar(50) NOT NULL,
  `logType` varchar(50) DEFAULT 'none',
  `transactionID` int DEFAULT NULL,
  `transactionDetails` varchar(200) DEFAULT NULL,
  `cryptoCurrency` varchar(50) DEFAULT 'btc',
  `amount` double(10,2) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userType` varchar(10) NOT NULL DEFAULT 'user',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `btcAddress` varchar(50) DEFAULT NULL,
  `btcBalance` varchar(50) DEFAULT '0',
  `bchAddress` varchar(50) DEFAULT NULL,
  `bchBalance` varchar(50) DEFAULT '0',
  `bnbAddress` varchar(50) DEFAULT NULL,
  `bnbBalance` varchar(50) DEFAULT '0',
  `ethAddress` varchar(50) DEFAULT NULL,
  `ethBalance` varchar(50) DEFAULT '0',
  `dogeAddress` varchar(50) DEFAULT NULL,
  `dogeBalance` varchar(50) DEFAULT '0',
  `ltcAddress` varchar(50) DEFAULT NULL,
  `ltcBalance` varchar(50) DEFAULT '0',
  `pmAddress` varchar(50) DEFAULT NULL,
  `pmBalance` varchar(50) DEFAULT '0',
  `trxAddress` varchar(50) DEFAULT NULL,
  `trxBalance` varchar(50) DEFAULT '0',
  `usdtAddress` varchar(50) DEFAULT NULL,
  `usdtBalance` varchar(50) DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `secretQuestion` text,
  `secretAnswer` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `ID` int NOT NULL,
  `userID` int NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `cryptoCurrency` varchar(50) DEFAULT NULL,
  `withdrawalAddress` varchar(100) DEFAULT NULL,
  `withdrawalStatus` varchar(15) DEFAULT 'pending',
  `messageFromUser` varchar(1000) DEFAULT ' ',
  `messageFromAdmin` varchar(1000) DEFAULT ' ',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting`);

--
-- Indexes for table `traillog`
--
ALTER TABLE `traillog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `traillog`
--
ALTER TABLE `traillog`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
