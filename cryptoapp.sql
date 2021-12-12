-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 12:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptoapp`
--
CREATE DATABASE IF NOT EXISTS `cryptoapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cryptoapp`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `account_id` int(5) NOT NULL,
  `available_funds_CAD` decimal(9,2) NOT NULL,
  `referral_code` varchar(25) NOT NULL,
  `user_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `available_funds_CAD`, `referral_code`, `user_id`) VALUES
(2, '0.00', '0000', 7),
(3, '-9999999.99', '0000', 8),
(4, '0.00', '0000', NULL),
(5, '0.00', '0000', NULL),
(6, '0.00', '0000', NULL),
(7, '0.00', '2670', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cryptocurrency`
--

DROP TABLE IF EXISTS `cryptocurrency`;
CREATE TABLE `cryptocurrency` (
  `crypto_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL,
  `exchange_rate` decimal(10,0) NOT NULL,
  `last_refreshed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cryptocurrency`
--

INSERT INTO `cryptocurrency` (`crypto_id`, `name`, `code`, `exchange_rate`, `last_refreshed`) VALUES
(1, 'Bitcoin', 'BTC', '72390', '2021-12-01 23:48:37'),
(2, 'Ethereum', 'ETH', '5774', '2021-12-01 23:48:38'),
(5, 'Shiba Inu', 'SHIB', '0', '2021-12-01 23:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_status`
--

DROP TABLE IF EXISTS `crypto_status`;
CREATE TABLE `crypto_status` (
  `user_id` int(5) NOT NULL,
  `crypto_id` int(5) NOT NULL,
  `status` enum('favorite','blacklist') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `transactions_id` int(5) NOT NULL,
  `account_id` int(5) NOT NULL,
  `crypto_code` varchar(5) DEFAULT NULL,
  `amount` double(10,10) NOT NULL,
  `total` double(12,2) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactions_id`, `account_id`, `crypto_code`, `amount`, `total`, `date_time`) VALUES
(28, 2, 'BTC', -10000.0000000000, 10000.00, '2021-12-11 18:35:54'),
(29, 2, 'BTC', -200.0000000000, 200.00, '2021-12-11 18:46:20'),
(30, 2, 'BTC', 0.0000000000, 20.00, '2021-12-11 18:54:58'),
(31, 2, 'BTC', 0.0000000000, 0.00, '2021-12-11 18:55:53'),
(32, 2, 'BTC', 0.0000000000, 0.00, '2021-12-11 18:56:11'),
(33, 2, 'BTC', -10.0000000000, 10.00, '2021-12-11 18:56:49'),
(34, 2, 'BTC', 0.0000000000, -20.00, '2021-12-11 20:49:07'),
(35, 2, 'ETH', 0.0034638033, -20.00, '2021-12-11 20:50:25'),
(36, 2, 'BTC', 0.0002762813, -20.00, '2021-12-11 20:50:39'),
(37, 2, 'ETH', -0.0034638033, 20.00, '2021-12-11 20:56:14'),
(38, 4, 'BTC', 0.0002762813, -20.00, '2021-12-11 21:14:22'),
(39, 4, 'ETH', -0.9999999999, 20.00, '2021-12-11 21:14:30'),
(40, 4, 'ETH', 0.0034638033, -20.00, '2021-12-11 21:14:38'),
(41, 4, 'BTC', -0.0002762813, 20.00, '2021-12-11 21:15:16'),
(42, 4, 'ETH', -0.0034638033, 20.00, '2021-12-11 21:15:16'),
(43, 4, NULL, 0.0000000000, 80.00, '2021-12-11 21:15:26'),
(44, 5, 'BTC', 0.0006907031, -50.00, '2021-12-11 21:27:59'),
(45, 5, 'ETH', 0.0086595081, -50.00, '2021-12-11 21:28:06'),
(46, 5, 'BTC', -0.0006907031, 50.00, '2021-12-11 21:28:17'),
(47, 5, 'ETH', -0.0086595081, 50.00, '2021-12-11 21:28:17'),
(48, 5, 'BTC', 0.0006907031, -50.00, '2021-12-11 21:29:20'),
(49, 5, 'ETH', 0.0086595081, -50.00, '2021-12-11 21:29:28'),
(50, 5, 'BTC', -0.0006907031, 50.00, '2021-12-11 21:29:38'),
(51, 5, 'ETH', -0.0086595081, 50.00, '2021-12-11 21:29:38'),
(52, 5, 'BTC', 0.0006907031, -50.00, '2021-12-11 21:30:28'),
(53, 5, 'ETH', 0.0086595081, -50.00, '2021-12-11 21:30:35'),
(54, 5, 'BTC', -0.0006907031, 50.00, '2021-12-11 21:31:00'),
(55, 5, 'ETH', -0.0086595081, 50.00, '2021-12-11 21:31:00'),
(56, 5, 'BTC', 0.0013814063, -100.00, '2021-12-11 21:33:07'),
(57, 5, 'ETH', 0.0086595081, -50.00, '2021-12-11 21:33:14'),
(58, 5, 'BTC', -0.0013814063, 100.00, '2021-12-11 21:33:25'),
(59, 5, 'ETH', -0.0086595081, 50.00, '2021-12-11 21:33:25'),
(60, 5, NULL, 0.0000000000, 150.00, '2021-12-11 21:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `two_factor_authentication_token` varchar(72) NOT NULL,
  `email` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password_hash`, `first_name`, `last_name`, `dob`, `two_factor_authentication_token`, `email`, `isAdmin`) VALUES
(7, '$2y$10$H1DrJog8D9HNjjYKyK9ZEuDWxTslwRsyEsRdwCtPzDI9/AD0EGh8y', 'Natalie', 'Mulodjanov', '0000-00-00', '', 'ntaliemulodjanov@gmail.com', 0),
(8, '$2y$10$dkM9BpcZ11i/qMyyOy0Axe1mWXxw19Pbz7knMlpBbdFbIbrNL/BI2', 'yaniv', 'Bolyasni', '0000-00-00', '', 'itai.bolyasni25@gmail.com', 0),
(12, '$2y$10$uHIX7q/R4tkW7JpTFAqyfu8pd92qMALuFX6mPF6T7VEyae1oHFYDe', 'asd', 'asd', '0000-00-00', '', 'ii@ii.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE `wallet` (
  `account_id` int(5) NOT NULL,
  `crypto_code` varchar(5) NOT NULL,
  `amount` decimal(10,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`account_id`, `crypto_code`, `amount`) VALUES
(2, 'BTC', '0.0000000000'),
(2, 'ETH', '0.0000000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_user_id_fk` (`user_id`);

--
-- Indexes for table `cryptocurrency`
--
ALTER TABLE `cryptocurrency`
  ADD PRIMARY KEY (`crypto_id`),
  ADD UNIQUE KEY `crypto_name_unique` (`code`) USING BTREE;

--
-- Indexes for table `crypto_status`
--
ALTER TABLE `crypto_status`
  ADD KEY `crypto_status_crypto_id_fk` (`crypto_id`),
  ADD KEY `crypto_status_user_id_fk` (`user_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactions_id`),
  ADD KEY `transaction_account_id_fk` (`account_id`),
  ADD KEY `transaction_crypto_code_fk` (`crypto_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD KEY `wallet_account_id_fk` (`account_id`),
  ADD KEY `wallet_cryoto_code_fk` (`crypto_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cryptocurrency`
--
ALTER TABLE `cryptocurrency`
  MODIFY `crypto_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactions_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `crypto_status`
--
ALTER TABLE `crypto_status`
  ADD CONSTRAINT `crypto_status_crypto_id_fk` FOREIGN KEY (`crypto_id`) REFERENCES `cryptocurrency` (`crypto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `crypto_status_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_crypto_code_fk` FOREIGN KEY (`crypto_code`) REFERENCES `cryptocurrency` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `wallet_cryoto_code_fk` FOREIGN KEY (`crypto_code`) REFERENCES `cryptocurrency` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
