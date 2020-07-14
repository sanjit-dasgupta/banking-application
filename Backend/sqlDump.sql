-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 160.153.146.172:3308
-- Generation Time: Apr 30, 2019 at 08:47 AM
-- Server version: 5.6.32
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `flor4002762722`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Line1` text NOT NULL,
  `Line2` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `PinCode` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100003 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` VALUES(100000, 'Address Line_1', 'Address Line_2', 'Chandigarh', 'Punjab', '122001');
INSERT INTO `address` VALUES(100001, 'oewhfi', 'qouf', '1235', 'fqwo', '122008');
INSERT INTO `address` VALUES(100002, '11', '11', '11', '11', '11');

-- --------------------------------------------------------

--
-- Table structure for table `approve_requests`
--

CREATE TABLE `approve_requests` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `manager` text NOT NULL,
  `requesting_user` text NOT NULL,
  `Created Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request_type` text NOT NULL,
  `new_value` text NOT NULL,
  `status` text NOT NULL,
  `Updated Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `approve_requests`
--


-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `AddressID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100003 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` VALUES(100000, 'Vasant Kunj', 100000);
INSERT INTO `branch` VALUES(100001, 'Paschim Vihar', 100000);
INSERT INTO `branch` VALUES(100002, 'Dwarka', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `account_number` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `account_type` text NOT NULL,
  `balance` double NOT NULL,
  `banker` text NOT NULL,
  `approved` char(1) NOT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100005 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` VALUES(100000, 'customer', 'Savings', 2050, 'banker', 'Y');
INSERT INTO `customers` VALUES(100001, 'customer', 'Current', -700, 'banker', 'Y');
INSERT INTO `customers` VALUES(100002, 'customer', 'Savings', 1000, 'banker', 'Y');
INSERT INTO `customers` VALUES(100003, 'customer', 'Current', 4000, 'banker', 'Y');
INSERT INTO `customers` VALUES(100004, 'Anshul', 'Savings', 9997600, 'banker', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `token` text NOT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_accessed_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired` char(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` VALUES(1, 'anshul', '51cafbe5ab1cf7cc5f1e27dbb321274b', '2019-04-30 01:26:10', '2019-04-30 01:26:10', 'Y');
INSERT INTO `login_data` VALUES(2, 'banker', '11fafcef4266baad0900242e0c4d0912', '2019-04-30 01:27:21', '2019-04-30 01:27:27', 'Y');
INSERT INTO `login_data` VALUES(3, 'banker', 'a41ad3fc790c381f7549d33c3343b72c', '2019-04-30 01:29:42', '2019-04-30 01:29:51', 'Y');
INSERT INTO `login_data` VALUES(4, 'banker', '5f9db473a4f38a173e9bafe6a84c01b8', '2019-04-30 01:30:12', '2019-04-30 01:30:19', 'Y');
INSERT INTO `login_data` VALUES(5, 'banker', '32f9fc723fba9cd1ca801bc63def6800', '2019-04-30 01:31:27', '2019-04-30 01:31:27', 'Y');
INSERT INTO `login_data` VALUES(6, 'shrey', 'dedc7f0629e1fb2169f72bd10ac46954', '2019-04-30 01:34:08', '2019-04-30 01:34:08', 'Y');
INSERT INTO `login_data` VALUES(7, 'anshul', '4869f9868949d4cb1c99db70c5e78766', '2019-04-30 01:34:23', '2019-04-30 01:34:23', 'Y');
INSERT INTO `login_data` VALUES(8, 'customer', '5e04a7676efbad559a269de7365c029b', '2019-04-30 07:22:11', '2019-04-30 19:42:28', 'Y');
INSERT INTO `login_data` VALUES(9, 'banker ', '366fb6d3069e8c93ae4e1a6969ae73fd', '2019-04-30 07:33:32', '2019-04-30 07:33:32', 'Y');
INSERT INTO `login_data` VALUES(10, 'anshul', 'e19a1d16a64f6d19c7ed1efd120ec426', '2019-04-30 07:34:08', '2019-04-30 07:34:08', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) NOT NULL,
  `transaction_amt` double NOT NULL,
  `transaction_type` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` double NOT NULL,
  `ref` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000017 ;

--
-- Dumping data for table `transaction_history`
--

INSERT INTO `transaction_history` VALUES(1000000, 100000, 200, 'Deposit', '2019-04-11 10:26:58', 2000, '123456');
INSERT INTO `transaction_history` VALUES(1000001, 100000, 1000, 'Deposit', '2019-04-11 10:31:20', 3000, '122122');
INSERT INTO `transaction_history` VALUES(1000002, 100001, 400, 'Deposit', '2019-04-11 11:06:20', 2300, '1234');
INSERT INTO `transaction_history` VALUES(1000003, 100001, 1000, 'Withdrawal', '2019-04-11 11:22:28', 1300, '-');
INSERT INTO `transaction_history` VALUES(1000004, 100001, 2000, 'Transfer', '2019-04-11 11:35:27', -700, '100000');
INSERT INTO `transaction_history` VALUES(1000005, 100000, 2000, 'Deposit', '2019-04-11 11:35:27', 5000, '100001');
INSERT INTO `transaction_history` VALUES(1000006, 100004, 1000, 'Deposit', '2019-04-11 22:31:06', 10001000, '2473584');
INSERT INTO `transaction_history` VALUES(1000007, 100004, 10000, 'Withdrawal', '2019-04-11 23:01:44', 9991000, '-');
INSERT INTO `transaction_history` VALUES(1000008, 100004, 1000, 'Transfer', '2019-04-11 23:02:29', 9990000, '100000');
INSERT INTO `transaction_history` VALUES(1000009, 100000, 1000, 'Deposit', '2019-04-11 23:02:29', 6000, '100004');
INSERT INTO `transaction_history` VALUES(1000010, 100004, 1000, 'Deposit', '2019-04-12 00:01:39', 9991000, '12345');
INSERT INTO `transaction_history` VALUES(1000011, 100004, 2500, 'Deposit', '2019-04-30 04:00:54', 9993500, '14842');
INSERT INTO `transaction_history` VALUES(1000012, 100004, 100, 'Deposit', '2019-04-30 06:38:59', 9993600, '111111');
INSERT INTO `transaction_history` VALUES(1000013, 100000, 100, 'Deposit', '2019-04-30 07:23:59', 6100, '100');
INSERT INTO `transaction_history` VALUES(1000014, 100000, 50, 'Withdrawal', '2019-04-30 19:36:19', 6050, '-');
INSERT INTO `transaction_history` VALUES(1000015, 100000, 4000, 'Transfer', '2019-04-30 19:38:19', 2050, '100004');
INSERT INTO `transaction_history` VALUES(1000016, 100004, 4000, 'Deposit', '2019-04-30 19:38:19', 9997600, '100000');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_verify`
--

CREATE TABLE `transaction_verify` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(11) NOT NULL,
  `transaction_amt` double NOT NULL,
  `transaction_type` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ref` text NOT NULL,
  `OTP` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `transaction_verify`
--

INSERT INTO `transaction_verify` VALUES(1, 100000, 2000, 'Withdrawal', '2019-04-11 11:18:48', '-', 163798);
INSERT INTO `transaction_verify` VALUES(2, 100000, 2000, 'Withdrawal', '2019-04-11 11:20:07', '-', 547659);
INSERT INTO `transaction_verify` VALUES(3, 100000, 1000, 'Withdrawal', '2019-04-11 11:20:57', '-', 352332);
INSERT INTO `transaction_verify` VALUES(4, 100001, 1000, 'Withdrawal', '2019-04-11 11:22:19', '-', 572544);
INSERT INTO `transaction_verify` VALUES(5, 100001, 2000, 'Transfer', '2019-04-11 11:35:15', '100000', 656643);
INSERT INTO `transaction_verify` VALUES(6, 100004, 10000, 'Withdrawal', '2019-04-11 22:59:28', '-', 783399);
INSERT INTO `transaction_verify` VALUES(7, 100004, 1000, 'Transfer', '2019-04-11 23:02:12', '100000', 952570);
INSERT INTO `transaction_verify` VALUES(8, 100004, 1000, 'Transfer', '2019-04-12 00:02:16', '100000', 976070);
INSERT INTO `transaction_verify` VALUES(9, 100004, 1000, 'Withdrawal', '2019-04-30 04:01:31', '-', 795326);
INSERT INTO `transaction_verify` VALUES(10, 100004, 1000, 'Withdrawal', '2019-04-30 04:02:01', '-', 492496);
INSERT INTO `transaction_verify` VALUES(11, 100004, 10000, 'Transfer', '2019-04-30 04:05:32', '100003', 284890);
INSERT INTO `transaction_verify` VALUES(12, 100004, 1000, 'Transfer', '2019-04-30 04:10:35', '100001', 696547);
INSERT INTO `transaction_verify` VALUES(13, 100004, 400, 'Withdrawal', '2019-04-30 07:20:10', '-', 984528);
INSERT INTO `transaction_verify` VALUES(14, 100000, 20, 'Withdrawal', '2019-04-30 07:24:32', '-', 426456);
INSERT INTO `transaction_verify` VALUES(15, 100000, 100, 'Withdrawal', '2019-04-30 07:25:56', '-', 493997);
INSERT INTO `transaction_verify` VALUES(16, 100004, 19999, 'Withdrawal', '2019-04-30 07:34:32', '-', 517124);
INSERT INTO `transaction_verify` VALUES(17, 100000, 50, 'Withdrawal', '2019-04-30 19:35:58', '-', 724619);
INSERT INTO `transaction_verify` VALUES(18, 100000, 4000, 'Transfer', '2019-04-30 19:38:10', '100004', 935450);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `enabled` char(1) NOT NULL,
  PRIMARY KEY (`username`(50))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES('admin', 'e99a18c428cb38d5f260853678922e03', 'Admin', 'Y');
INSERT INTO `users` VALUES('Anshul', '240bc306d1a19916d636f3d614e03024', 'Customer', 'Y');
INSERT INTO `users` VALUES('banker', '7f019af5742937201d0a7403437f9ef6', 'Personal Banker', 'Y');
INSERT INTO `users` VALUES('customer', '7f019af5742937201d0a7403437f9ef6', 'Customer', 'Y');
INSERT INTO `users` VALUES('shrey', '4f44e202fc14ed71b12530d3a219c70f', 'Customer', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `username` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `dob` date NOT NULL,
  `phone_number` text NOT NULL,
  `email_address` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `addressID` int(11) NOT NULL,
  UNIQUE KEY `username` (`username`(50))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` VALUES('admin', 'Sanjit', 'Dasgupta', '1999-05-14', '9643961040', 'sanjitdasgupta999@gmail.com', 100000, 100000);
INSERT INTO `user_details` VALUES('customer', 'Supjit', 'Badassgupta', '2019-01-01', '9643961043', 'sanjitdasgupta68@gmail.com', 100000, 100000);
INSERT INTO `user_details` VALUES('banker', 'Personal', 'Banker', '2019-04-03', '9999999999', 'abc@gmail.com', 100000, 100000);
INSERT INTO `user_details` VALUES('Anshul', 'Anshul ', 'Subramanian', '1999-09-04', '9999885342', 'asnhul_subramanian17@srmuniv.edu.in', 100000, 100001);
INSERT INTO `user_details` VALUES('shrey', 'Shreyansh', '123', '1999-04-05', '123', '12@gmail.cio', 100000, 100002);
