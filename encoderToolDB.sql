-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2014 at 08:54 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `encoderToolDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `eAccessControl`
--

CREATE TABLE IF NOT EXISTS `eAccessControl` (
  `accessLevel` int(11) NOT NULL,
`ID` int(11) NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eAccessControl`
--

INSERT INTO `eAccessControl` (`accessLevel`, `ID`, `userType`) VALUES
(99, 1, 'Administrator'),
(21, 2, 'User'),
(11, 3, 'Viewer');

-- --------------------------------------------------------

--
-- Table structure for table `eAccessLog`
--

CREATE TABLE IF NOT EXISTS `eAccessLog` (
`ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `timeLogin` datetime DEFAULT NULL,
  `timeLogout` datetime DEFAULT NULL,
  `IPaddress` varchar(25) DEFAULT NULL,
  `userName` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eAccessLog`
--

INSERT INTO `eAccessLog` (`ID`, `userID`, `timeLogin`, `timeLogout`, `IPaddress`, `userName`) VALUES
(75, 1, '2014-10-18 13:17:36', NULL, '::1', 'admin'),
(76, 1, '2014-10-18 13:17:55', NULL, '::1', 'admin'),
(77, 1, '2014-10-18 13:19:20', NULL, '::1', 'admin'),
(78, 1, '2014-10-18 13:22:09', NULL, '::1', 'admin'),
(79, 5, '2014-10-18 13:24:15', NULL, '::1', 'pavan'),
(80, 5, '2014-10-18 13:25:01', NULL, '::1', 'pavan'),
(81, 1, '2014-10-18 13:25:34', NULL, '::1', 'admin'),
(82, 5, '2014-10-18 13:26:19', NULL, '::1', 'pavan'),
(83, 5, '2014-10-18 13:26:52', NULL, '::1', 'pavan'),
(84, 1, '2014-10-18 13:27:01', NULL, '::1', 'admin'),
(85, 1, '2014-10-18 13:40:15', NULL, '::1', 'admin'),
(86, 1, '2014-10-18 14:31:08', NULL, '::1', 'admin'),
(87, 1, '2014-10-18 15:38:56', NULL, '::1', 'admin'),
(88, 1, '2014-10-18 16:25:18', NULL, '::1', 'admin'),
(89, 1, '2014-10-18 16:31:19', NULL, '::1', 'admin'),
(90, 1, '2014-10-18 16:37:36', NULL, '::1', 'admin'),
(91, 1, '2014-10-18 16:39:01', NULL, '::1', 'admin'),
(92, 1, '2014-10-18 16:39:24', NULL, '::1', 'admin'),
(93, 1, '2014-10-18 16:49:26', NULL, '::1', 'admin'),
(94, 1, '2014-10-18 16:51:43', NULL, '::1', 'admin'),
(95, 1, '2014-10-18 17:33:04', NULL, '::1', 'admin'),
(96, 1, '2014-10-19 13:42:45', NULL, '::1', 'admin'),
(97, 1, '2014-10-19 13:42:50', NULL, '::1', 'admin'),
(98, 2, '2014-10-19 13:43:00', NULL, '::1', 'user'),
(99, 1, '2014-10-19 14:31:26', NULL, '::1', 'admin'),
(100, 1, '2014-10-19 17:08:46', NULL, '::1', 'admin'),
(101, 1, '2014-10-20 03:28:42', NULL, '::1', 'admin'),
(102, 1, '2014-10-20 04:06:28', NULL, '::1', 'admin'),
(103, 7, '2014-10-20 04:07:38', NULL, '::1', 'saibal'),
(104, 5, '2014-10-20 04:45:49', NULL, '::1', 'pavan'),
(105, 11, '2014-10-20 04:48:26', NULL, '::1', 'marshi'),
(106, 1, '2014-10-20 04:49:15', NULL, '::1', 'admin'),
(107, 5, '2014-10-20 04:52:13', NULL, '::1', 'pavan'),
(108, 1, '2014-10-20 05:40:04', NULL, '::1', 'admin'),
(109, 2, '2014-10-20 05:41:41', NULL, '::1', 'user'),
(110, 1, '2014-10-20 05:42:26', NULL, '::1', 'admin'),
(111, 1, '2014-10-20 12:00:07', NULL, '::1', 'admin'),
(112, 1, '2014-10-20 12:03:31', NULL, '::1', 'admin'),
(113, 1, '2014-10-20 17:48:32', NULL, '::1', 'admin'),
(114, 1, '2014-10-21 07:02:57', NULL, '::1', 'admin'),
(115, 1, '2014-10-21 07:03:03', NULL, '::1', 'admin'),
(116, 2, '2014-10-21 07:04:00', NULL, '::1', 'user'),
(117, 1, '2014-10-21 07:05:28', NULL, '::1', 'admin'),
(118, 12, '2014-10-21 07:05:55', NULL, '::1', 'navya'),
(119, 1, '2014-10-21 07:14:21', NULL, '::1', 'admin'),
(120, 1, '2014-10-21 09:23:04', NULL, '::1', 'admin'),
(121, 1, '2014-10-21 14:00:31', NULL, '::1', 'admin'),
(122, 1, '2014-10-21 14:06:41', NULL, '::1', 'admin'),
(123, 1, '2014-10-21 14:08:57', NULL, '::1', 'admin'),
(124, 1, '2014-10-21 14:12:07', NULL, '::1', 'admin'),
(125, 1, '2014-10-21 14:18:33', NULL, '::1', 'admin'),
(126, 1, '2014-10-21 14:21:14', NULL, '::1', 'admin'),
(127, 1, '2014-10-21 14:22:31', NULL, '::1', 'admin'),
(128, 1, '2014-10-21 14:33:17', NULL, '::1', 'admin'),
(129, 1, '2014-10-21 14:51:31', NULL, '::1', 'admin'),
(130, 1, '2014-10-21 14:55:33', NULL, '::1', 'admin'),
(131, 1, '2014-10-21 15:44:51', NULL, '::1', 'admin'),
(132, 1, '2014-10-21 17:00:52', NULL, '::1', 'admin'),
(133, 1, '2014-10-22 14:08:07', NULL, '::1', 'admin'),
(134, 1, '2014-10-22 14:56:02', NULL, '::1', 'admin'),
(135, 1, '2014-10-22 14:58:44', NULL, '::1', 'admin'),
(136, 1, '2014-10-22 15:30:30', NULL, '::1', 'admin'),
(137, 1, '2014-10-22 15:30:55', NULL, '::1', 'admin'),
(138, 1, '2014-10-22 15:31:09', NULL, '::1', 'admin'),
(139, 1, '2014-10-22 15:31:49', NULL, '::1', 'admin'),
(140, 1, '2014-10-22 15:51:52', NULL, '::1', 'admin'),
(141, 1, '2014-10-22 16:22:18', NULL, '::1', 'admin'),
(142, 1, '2014-10-22 18:16:35', NULL, '::1', 'admin'),
(143, 1, '2014-10-23 03:27:59', NULL, '::1', 'admin'),
(144, 11, '2014-10-23 03:37:44', NULL, '::1', 'marshi'),
(145, 1, '2014-10-23 09:19:15', NULL, '::1', 'admin'),
(146, 1, '2014-10-23 09:52:33', NULL, '::1', 'admin'),
(147, 13, '2014-10-23 17:26:37', '2014-10-23 17:53:16', '::1', 'kalyan'),
(148, 13, '2014-10-23 18:04:17', NULL, '::1', 'kalyan'),
(149, 13, '2014-10-23 20:31:05', NULL, '::1', 'kalyan');

-- --------------------------------------------------------

--
-- Table structure for table `eEncoder`
--

CREATE TABLE IF NOT EXISTS `eEncoder` (
`ID` int(11) NOT NULL,
  `encoderIP` bigint(11) NOT NULL,
  `encoderInfo` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eEncoder`
--

INSERT INTO `eEncoder` (`ID`, `encoderIP`, `encoderInfo`) VALUES
(1, 3323081730, 'Flash encoder and will used for IIS network also.'),
(3, 3323079959, 'Flash encoder'),
(5, 3323079957, 'Flash encoder2'),
(7, 3323080910, 'This encoder is used for icecast network.'),
(8, 3324122881, 'Ingest encoder');

-- --------------------------------------------------------

--
-- Table structure for table `eEncoderAllocation`
--

CREATE TABLE IF NOT EXISTS `eEncoderAllocation` (
`ID` int(11) NOT NULL,
  `encoderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `startDate` bigint(20) NOT NULL,
  `endDate` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eEncoderAllocation`
--

INSERT INTO `eEncoderAllocation` (`ID`, `encoderID`, `userID`, `startDate`, `endDate`) VALUES
(1, 1, 1, 1413639203, 1414157603),
(2, 3, 5, 1413639203, 1414157603),
(3, 5, 14, 1413639203, 1414157603),
(4, 7, 14, 1413639203, 1414157603),
(5, 1, 12, 1414244003, 1414503203),
(6, 1, 13, 1413731664, 1413733664),
(7, 3, 12, 1414096740, 1414116180),
(8, 3, 14, 1414096860, 1414724640);

-- --------------------------------------------------------

--
-- Table structure for table `eUser`
--

CREATE TABLE IF NOT EXISTS `eUser` (
`ID` int(11) NOT NULL,
  `username` varchar(16) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(30) NOT NULL,
  `accessLevel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eUser`
--

INSERT INTO `eUser` (`ID`, `username`, `password`, `email`, `accessLevel`) VALUES
(1, 'admin', '1844156d4166d94387f1a4ad031ca5fa', 'admin@akamai.com', 99),
(2, 'user', '6ad14ba9986e3615423dfca256d04e3f', '', 11),
(5, 'pavan', '62cee51e57683afb139a784189c8cfc7', 'pavan@akamai.com', 99),
(11, 'marshi', '53ee7c368102bd378a3d1b33e421dc35', 'marshi@akamai.com', 11),
(12, 'navya', '27e1b4ba0a4d02ac247463a31ce38115', 'navya@akamai.com', 21),
(13, 'kalyan', '32f093dfdfaa606d5f816fbcc9d58a4a', 'kalyan@akamai.com', 21),
(14, 'vaishnavi', '0f41bad9010cfbbe863de7d7f4faebae', '', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eAccessControl`
--
ALTER TABLE `eAccessControl`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eAccessLog`
--
ALTER TABLE `eAccessLog`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eEncoder`
--
ALTER TABLE `eEncoder`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `encoderIP` (`encoderIP`);

--
-- Indexes for table `eEncoderAllocation`
--
ALTER TABLE `eEncoderAllocation`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eUser`
--
ALTER TABLE `eUser`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eAccessControl`
--
ALTER TABLE `eAccessControl`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eAccessLog`
--
ALTER TABLE `eAccessLog`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `eEncoder`
--
ALTER TABLE `eEncoder`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eEncoderAllocation`
--
ALTER TABLE `eEncoderAllocation`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eUser`
--
ALTER TABLE `eUser`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
