-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 09:08 PM
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
  `total_funds_CAD` decimal(9,2) NOT NULL,
  `referral_code` varchar(25) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `total_funds_CAD`, `referral_code`, `user_id`) VALUES
(1, '301.00', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cryptocurrency`
--

DROP TABLE IF EXISTS `cryptocurrency`;
CREATE TABLE `cryptocurrency` (
  `crypto_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cryptocurrency`
--

INSERT INTO `cryptocurrency` (`crypto_id`, `name`, `code`) VALUES
(1, 'Bitcoin', 'BTC'),
(2, 'Ethereum', 'ETH'),
(5, 'Shiba Inu', 'SHIB'),
(6, 'DogeCoin', 'DOGE');

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
  `crypto_id` int(5) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `total` double(12,2) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, '1234', 'sfgd', 'dfdf', '0000-00-00', '123', 'blah@email', 0),
(3, '$2y$10$5Fj6jZg0aKYx/voKbODPTenwf1LCg.VuDZKgrbnhsVCeJ8k2gINyy', 'dvb', 'dfbv', '0000-00-00', '', 'test', 0),
(4, '$2y$10$89ar3HWzpxrnhaIFY0wG2OmtB1E3gpwtRf/B.IChaMDFsH95Wz78W', 'test', 'test', '0000-00-00', '', 'test@gmail.com', 0),
(5, '$2y$10$ATL0BrK6UQ0YFuoBHVNT7eA7fTVmXaQI6PGLcgLNNpED/fywD15by', 'Natalie', 'Mulodjanov', '0000-00-00', '', 'ntaliemulodjanov@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
CREATE TABLE `wallet` (
  `user_id` int(5) NOT NULL,
  `crypto_id` int(5) NOT NULL,
  `amount` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD PRIMARY KEY (`crypto_id`);

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
  ADD KEY `transaction_crypto_id_fk` (`crypto_id`),
  ADD KEY `transaction_account_id_fk` (`account_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD KEY `wallet_user_id_fk` (`user_id`),
  ADD KEY `wallet_crypto_id_fk` (`crypto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cryptocurrency`
--
ALTER TABLE `cryptocurrency`
  MODIFY `crypto_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactions_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transaction_crypto_id_fk` FOREIGN KEY (`crypto_id`) REFERENCES `cryptocurrency` (`crypto_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_crypto_id_fk` FOREIGN KEY (`crypto_id`) REFERENCES `cryptocurrency` (`crypto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `wallet_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
