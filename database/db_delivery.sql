-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2025 at 05:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL COMMENT 'ชื่อเต็ม',
  `customerAddress` varchar(200) NOT NULL COMMENT 'ชื่อบริษัท',
  `customerCompany` varchar(60) NOT NULL COMMENT 'ที่อยู่ปัจจุบัน',
  `customerPhone` varchar(10) NOT NULL COMMENT 'เบอร์ลูกค้า',
  `receiverName` varchar(50) NOT NULL COMMENT 'ชื่อคนรับของ',
  `receiverPhone` varchar(10) NOT NULL COMMENT 'เบอร์คนรับของ',
  `addDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_delivery`
--

CREATE TABLE `tb_delivery` (
  `id` int(11) NOT NULL,
  `deliveryDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ส่งของ',
  `order_customerName_ref` varchar(60) NOT NULL COMMENT 'ชื่อลูกค้า',
  `order_receiverName` varchar(50) NOT NULL COMMENT 'ชื่อคนรับ',
  `order_receiverPhone` varchar(10) NOT NULL COMMENT 'เบอร์คนรับ',
  `order_payment` varchar(50) NOT NULL COMMENT 'การชำระเงิน',
  `order_pickupLocation` text NOT NULL COMMENT 'สถานที่นัดรับ',
  `description` text NOT NULL COMMENT 'รายละเอียด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_delivery`
--
ALTER TABLE `tb_delivery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_delivery`
--
ALTER TABLE `tb_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
