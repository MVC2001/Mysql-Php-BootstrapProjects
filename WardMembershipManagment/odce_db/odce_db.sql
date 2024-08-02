-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 07:57 PM
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
-- Database: `odce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2023-06-01 17:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `admin_txts_tbl`
--

CREATE TABLE `admin_txts_tbl` (
  `text_id` int(11) NOT NULL,
  `text_message` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_txts_tbl`
--

INSERT INTO `admin_txts_tbl` (`text_id`, `text_message`, `created_at`) VALUES
(2, 'welcome my streate member', '2023-05-30 21:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_tbl`
--

CREATE TABLE `citizen_tbl` (
  `cit_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_OfBirth` varchar(30) NOT NULL,
  `education_level` varchar(30) NOT NULL,
  `health_status` varchar(30) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `postal_codes` varchar(30) NOT NULL,
  `house_ownership` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_tbl`
--

INSERT INTO `citizen_tbl` (`cit_id`, `fullname`, `gender`, `date_OfBirth`, `education_level`, `health_status`, `occupation`, `phone`, `postal_codes`, `house_ownership`, `email`, `password`, `created_at`) VALUES
(2, 'Mbunge', 'Male', '2023-05-31', 'Tertialy', 'good', 'Graphic designer', '06757463623', 'toto4i4ic39343', 'Rented', 'mbunge@gmail.com', 'df1957ade7c116e230856b663b5221a9', '2023-06-01 17:40:01'),
(3, 'Rusi', 'Female', '2001-05-10', 'Tertialy', 'good', 'UI designer', '07865784', 'test', 'Rented', 'rusi@gmail.com', '131aaca0eafb4b6ff9f5a7257850adf3', '2023-05-31 20:05:26'),
(4, 'Rose', 'Female', '2023-06-01', 'Tertialy', 'good', 'UI designer', '0709685858', 'eie499e9ee', 'Owned', 'rose@gmail.com', '2dfd327aa656917e323eeef2f4711469', '2023-05-31 21:37:09'),
(5, 'Pevison', 'Male', '2023-06-01', 'Tertialy', 'good', 'test', '06067968756', 'dydyd', 'Rented', 'pevi@gmail.com', '96ed6fee77fb57e23b3d931863a29d16', '2023-05-31 21:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_txts_tbl`
--

CREATE TABLE `citizen_txts_tbl` (
  `text_id` int(11) NOT NULL,
  `text_message` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_txts_tbl`
--

INSERT INTO `citizen_txts_tbl` (`text_id`, `text_message`, `name`, `created_at`) VALUES
(2, 'hello mwenyekit im comming soo', 'anny', '2023-05-30 21:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `deletedcitizen_tbl`
--

CREATE TABLE `deletedcitizen_tbl` (
  `cit_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `postal_codes` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deletedcitizen_tbl`
--

INSERT INTO `deletedcitizen_tbl` (`cit_id`, `fullname`, `gender`, `occupation`, `postal_codes`, `created_at`) VALUES
(1, 'juma musa', 'Male', 'IT MANAGER', 'GKRJR', '2023-05-30 23:02:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_txts_tbl`
--
ALTER TABLE `admin_txts_tbl`
  ADD PRIMARY KEY (`text_id`);

--
-- Indexes for table `citizen_tbl`
--
ALTER TABLE `citizen_tbl`
  ADD PRIMARY KEY (`cit_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `citizen_txts_tbl`
--
ALTER TABLE `citizen_txts_tbl`
  ADD PRIMARY KEY (`text_id`);

--
-- Indexes for table `deletedcitizen_tbl`
--
ALTER TABLE `deletedcitizen_tbl`
  ADD PRIMARY KEY (`cit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_txts_tbl`
--
ALTER TABLE `admin_txts_tbl`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `citizen_tbl`
--
ALTER TABLE `citizen_tbl`
  MODIFY `cit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `citizen_txts_tbl`
--
ALTER TABLE `citizen_txts_tbl`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deletedcitizen_tbl`
--
ALTER TABLE `deletedcitizen_tbl`
  MODIFY `cit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
