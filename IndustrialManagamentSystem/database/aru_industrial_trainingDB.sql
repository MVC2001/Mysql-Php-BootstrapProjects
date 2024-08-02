-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 06:54 PM
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
-- Database: `aru_industrial_trainingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `fieldreport`
--

CREATE TABLE `fieldreport` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `report_date` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `supervisorRemark` varchar(50) NOT NULL,
  `supervisorMarks` varchar(50) NOT NULL,
  `supervisorComment` varchar(100) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `trainerComment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `student` varchar(255) NOT NULL,
  `reportMarks` varchar(50) NOT NULL,
  `presntationMarks` varchar(100) NOT NULL,
  `course` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL,
  `presentationMarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `supervisor`, `student`, `reportMarks`, `presntationMarks`, `course`, `marks`, `presentationMarks`) VALUES
(2, 'Yohana Kangwe', 'Isack ism ', '40', '', 'ISM', 9, '30');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `fieldName` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `start_from` varchar(50) NOT NULL,
  `end_to` varchar(50) NOT NULL,
  `assign` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `fieldName`, `location`, `address`, `trainer`, `supervisor`, `fullName`, `course`, `start_from`, `end_to`, `assign`, `created_at`) VALUES
(1, 'IT FIELD', 'TCB BANK, MAKUMBUSHO ', 'Millenium tower,makumbusho', 'Arthur Ndosi', 'Yohana Kangwe', 'Isack ism ', 'ISM', '2024-06-05', '06/09/2024', 'assigned', '2024-06-04 00:55:18'),
(2, 'IT FIELD', 'MLIMAN TOWER', 'Millenium tower,makumbusho', 'Arthur Ndosi', 'Yohana Kangwe', 'new student', 'ISM', '2024-06-06', '2024-06-20', 'assigned', '2024-06-05 15:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `assign` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullName`, `role`, `course`, `status`, `email`, `assign`, `trainer`, `password`, `created_at`) VALUES
(2, 'admin', 'admin', '', 'active', 'admin123@gmail.com', '', '', '1386f990a2a7bb6eef430b7d02646487', '2024-06-05 16:52:38'),
(3, 'Guest user', '', '', 'active', 'guestuser123@gmail.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '2024-06-03 22:45:29'),
(4, 'IndustrialField_coordinator', 'IndustrialField_coordinator', '', 'active', 'IndustrialFieldCoordinator123@mail.com', '', '', '517b50c259800fe8fdf780f42fb483a6', '2024-06-03 22:52:59'),
(5, 'Student test', 'student', 'ISM', 'active', 'student123@gmaill.com', '', '', '34a30b7e5ae03a9a3efc1d080ace43c2', '2024-06-19 13:00:18'),
(6, 'Yohana Kangwe', 'supervisor', '', 'active', 'yohanaKangwe123@gmail.com', '', '', '4467b66908d595bdc5d7d6a701f2b9b5', '2024-06-04 00:17:57'),
(8, 'Arthur Ndosi', 'IndustrialField_trainer', '', 'active', 'arthurndosI1123@gmail.com', '', '', 'd8e71cdea0773077e6bf57722bc71054', '2024-06-04 00:36:34'),
(9, 'Isack ism ', 'student', 'ISM', 'active', 'isaCk123@gmail.com', '', '', 'edb635ddab5572eeef4aadb8d7f30be3', '2024-06-04 00:47:59'),
(10, 'new student', 'student', 'ISM', 'active', 'studentsshah123ASHSHSH@gmail.com', '', '', 'fbe81170091a4017a64f542690872072', '2024-06-05 15:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `weeklyreport`
--

CREATE TABLE `weeklyreport` (
  `id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `trainer` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `supervisorRemark` varchar(50) NOT NULL,
  `supervisorComment` varchar(50) NOT NULL,
  `supervisorMarks` varchar(50) NOT NULL,
  `report_date` varchar(50) NOT NULL,
  `trainerComment` varchar(255) NOT NULL,
  `marksv1` varchar(50) NOT NULL,
  `trainerMarks` varchar(50) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `hourswork` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `supervisorRemarkV2` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weeklyreport`
--

INSERT INTO `weeklyreport` (`id`, `day`, `fullName`, `trainer`, `supervisor`, `activity`, `comment`, `supervisorRemark`, `supervisorComment`, `supervisorMarks`, `report_date`, `trainerComment`, `marksv1`, `trainerMarks`, `marks`, `hourswork`, `remark`, `supervisorRemarkV2`, `created_at`) VALUES
(13, 'Wednesday', 'Isack ism ', 'Arthur Ndosi', 'Yohana Kangwe', 'dfffff', 'dffffffff', 'remarked', 'rrrrrrrrrrrrrrrrrrrrr', '10', '2024-06-06', '', '', '23', '', '3', '', 'i am remark', '2024-06-19 15:41:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fieldreport`
--
ALTER TABLE `fieldreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `weeklyreport`
--
ALTER TABLE `weeklyreport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fieldreport`
--
ALTER TABLE `fieldreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `weeklyreport`
--
ALTER TABLE `weeklyreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
