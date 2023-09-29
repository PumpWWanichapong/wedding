-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 07:07 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountID` int(11) NOT NULL,
  `Prefix` varchar(50) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `PhoneNo` varchar(20) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `AccountType` varchar(50) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountID`, `Prefix`, `Name`, `LastName`, `Address`, `PhoneNo`, `Email`, `AccountType`, `Password`) VALUES
(1, 'นาย ', 'wachira', 'kan', '555/55', '095555555', 'wachira@gmail.com', 'User', 'company'),
(2, 'นาย ', 'Supakorn', 'Sati', '132/41 บ้าน', '065555555', 'Supakorn@gmai.com', 'User', 'company'),
(3, 'นาย ', 'จิรา', 'ข', ' - ', '0961155023', 'Testadmin@mail.com', 'Admin', 'company'),
(4, 'นาย ', 'Test', 'Test', 'T', '0961155023', 'Test@gmail.com', 'Admin', 'Pump_159'),
(5, NULL, 'user', 'user', '123/11', '0966666655', 'user@gmail.com', 'User', 'Passw0rd'),
(6, NULL, 'wanichapong', 'serksiri', '6/888  bbb', '0986167425', 'wanichapong165@gmail.com', 'User', 'Pw_14789');

-- --------------------------------------------------------

--
-- Table structure for table `attempt`
--

CREATE TABLE `attempt` (
  `AID` int(11) NOT NULL,
  `AccountID` int(11) DEFAULT NULL,
  `AttemptDate` date DEFAULT NULL,
  `AttemptTemp` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attempt`
--

INSERT INTO `attempt` (`AID`, `AccountID`, `AttemptDate`, `AttemptTemp`) VALUES
(1, 3, '2023-08-10', '09:24:00'),
(2, 2, '2023-08-15', '09:30:00'),
(3, 5, '2023-09-02', '08:30:00'),
(4, 5, '2023-09-06', '10:00:00'),
(5, 5, '2023-09-06', '08:00:00'),
(6, 5, '2023-09-12', '10:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `attemptdetail`
--

CREATE TABLE `attemptdetail` (
  `ADID` int(11) NOT NULL,
  `AID` int(11) DEFAULT NULL,
  `PID` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attemptdetail`
--

INSERT INTO `attemptdetail` (`ADID`, `AID`, `PID`, `Amount`) VALUES
(1, 1, 1, 1),
(8, 2, 1, 1),
(9, 3, 1, 1),
(10, 4, 11, 1),
(11, 5, 1, 1),
(12, 6, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `fliedoc`
--

CREATE TABLE `fliedoc` (
  `FID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `FlieName` varchar(500) DEFAULT NULL,
  `FileURL` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fliedoc`
--

INSERT INTO `fliedoc` (`FID`, `PID`, `FlieName`, `FileURL`) VALUES
(16, 1, 'file_1693739440158_109.jpeg', '64f469bceab5a.jpeg'),
(17, 1, 'file_1693739255495_685.jpeg', '64f469bcecae2.jpeg'),
(18, 11, 'file_1693739763830_840.jpeg', '64f46af672804.jpeg'),
(19, 12, 'file_1693739797777_946.jpeg', '64f46b1b541f5.jpeg'),
(21, 6, 'file_1693741034230_816.jpeg', '64f46ff149d9c.jpeg'),
(22, 6, 'file_1693741019951_580.jpeg', '64f46ff14e4e9.jpeg'),
(23, 13, 'file_1694088367089_385.jpeg', '64f9bcc86062d.jpeg'),
(24, 13, 'file_1694088353073_265.jpeg', '64f9bcc86f2b0.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OID` int(11) NOT NULL,
  `AccountID` int(11) DEFAULT NULL,
  `OrderPrice` decimal(10,2) DEFAULT NULL,
  `OrderAmount` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `ReturnDate` date DEFAULT NULL,
  `OrderType` varchar(3) DEFAULT NULL,
  `Bill` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OID`, `AccountID`, `OrderPrice`, `OrderAmount`, `CreateBy`, `CreateDate`, `StartDate`, `EndDate`, `ReturnDate`, `OrderType`, `Bill`) VALUES
(1, 1, '5000.00', NULL, NULL, NULL, '2023-08-10', '2023-08-10', '2023-08-10', NULL, NULL),
(2, 1, '5001.00', NULL, NULL, NULL, '2023-08-10', '2023-08-10', '2023-08-10', NULL, NULL),
(3, 3, '5000.00', NULL, NULL, NULL, '2023-08-10', '2023-08-11', '2023-08-10', NULL, NULL),
(5, 5, '5000.00', 1, NULL, '2023-09-03 18:21:38', '2023-09-03', '2023-09-03', '2023-09-04', 'O', '64f46ca069379_qrcode.png'),
(8, 5, '1500.00', 1, NULL, '2023-09-07 17:58:56', '2023-09-07', '2023-09-07', '2023-09-08', 'O', '64f9ad391a12d_019159190430332489.jpeg'),
(10, 5, '5000.00', 1, NULL, '2023-09-07 18:41:09', '2023-09-07', '2023-09-07', '2023-09-13', 'O', '64f9b74f1ac04_019166212108172210.jpeg'),
(11, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C', NULL),
(12, 5, '10000.00', 2, NULL, '2023-09-13 22:14:18', '2023-09-13', '2023-09-14', NULL, 'O', '6501d1fac8235_019274224124121907.jpeg'),
(13, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ODID` int(11) NOT NULL,
  `OID` int(11) DEFAULT NULL,
  `PID` int(11) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`ODID`, `OID`, `PID`, `Amount`, `Price`) VALUES
(1, 1, 1, 1, '5000.00'),
(2, 2, 4, 1, '1.00'),
(3, 2, 1, 1, '5000.00'),
(4, 3, 1, 1, '5000.00'),
(5, 5, 1, 1, '5000.00'),
(9, 8, 11, 1, '1500.00'),
(12, 10, 1, 1, '5000.00'),
(14, 12, 1, 2, '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PID` int(11) NOT NULL,
  `ProductName` varchar(250) DEFAULT NULL,
  `ProductDetail` varchar(500) DEFAULT NULL,
  `Zise` varchar(20) DEFAULT NULL,
  `ProductAmount` int(11) DEFAULT NULL,
  `FID` int(11) DEFAULT NULL,
  `ProductPrice` decimal(18,2) DEFAULT NULL,
  `Discount` decimal(18,2) DEFAULT NULL,
  `ProductType` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PID`, `ProductName`, `ProductDetail`, `Zise`, `ProductAmount`, `FID`, `ProductPrice`, `Discount`, `ProductType`) VALUES
(1, 'Minimal Dress 33', 'Minimal Dress 33', 'L', 2, NULL, '5000.00', '6000.00', 'ชุดเจ้าสาว'),
(6, 'ชุดไทยเจ้าสาว BP002 ', 'ชุดไทยเจ้าสาว BP002 ', 'XL', 1, NULL, '1000.00', '500.00', 'ชุดไทย'),
(11, 'ชุดแต่งงานชาย', '', 'M', 1, NULL, '1500.00', '2000.00', 'ชุดแต่งงาน'),
(12, 'ชุดแต่งงานชาย', 'ชุดสำหรับสุภาพบุรุษสุดหล่อ', 'L', 1, NULL, '15000.00', '50000.00', 'ชุดแต่งงานผู้ชาย'),
(13, 'ชุดแต่งงานชาย  bp001', 'ชุดสำหรับสุภาพบุรุษสุดหล่อ', 'L', 1, NULL, '5000.00', '10000.00', 'ชุดแต่งงานผู้ชาย');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `PromotionID` int(11) NOT NULL,
  `PromotionName` varchar(255) DEFAULT NULL,
  `PromotionDetail` varchar(500) DEFAULT NULL,
  `PromotionStartDate` date DEFAULT NULL,
  `PromotionEndDate` date DEFAULT NULL,
  `PromotionFile` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`PromotionID`, `PromotionName`, `PromotionDetail`, `PromotionStartDate`, `PromotionEndDate`, `PromotionFile`) VALUES
(2, 'ลด 5 %', 'ลด 5 %', '2023-08-01', '2023-08-31', '64f46a9f0b336_64f3fa7a31333_Promoion2.jpg'),
(3, 'ลด 50% แถมเครื่องประดับ', 'แพ็กเกจชุดแต่งงานชายและชุดเจ้าสาวจากราคา39999 เหลือ 25000', '2023-08-02', '2023-08-11', '64f46a80973eb_64eb861059d22_Promotion1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `attemptdetail`
--
ALTER TABLE `attemptdetail`
  ADD PRIMARY KEY (`ADID`);

--
-- Indexes for table `fliedoc`
--
ALTER TABLE `fliedoc`
  ADD PRIMARY KEY (`FID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ODID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`PromotionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attempt`
--
ALTER TABLE `attempt`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attemptdetail`
--
ALTER TABLE `attemptdetail`
  MODIFY `ADID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fliedoc`
--
ALTER TABLE `fliedoc`
  MODIFY `FID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `ODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `PromotionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
