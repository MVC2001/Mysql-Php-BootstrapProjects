-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 11:59 AM
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
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission_tbl`
--

CREATE TABLE `permission_tbl` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `yearOfStudy` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Dept` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL,
  `departingOn` varchar(255) NOT NULL,
  `returningOn` varchar(255) NOT NULL,
  `reasonFor` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `cForDirOfStuService` varchar(255) NOT NULL,
  `approveForDirOfStuService` varchar(255) NOT NULL,
  `approved1_at` varchar(255) NOT NULL,
  `cForHoD` varchar(255) NOT NULL,
  `approveForHoD` varchar(255) NOT NULL,
  `approved2_at` varchar(255) NOT NULL,
  `cForDeanOfSchl` varchar(255) NOT NULL,
  `approveForDeanOfSchl` varchar(100) NOT NULL,
  `approved3_at` varchar(255) NOT NULL,
  `dateOfreturned` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission_tbl`
--

INSERT INTO `permission_tbl` (`id`, `fullName`, `regNo`, `yearOfStudy`, `Course`, `Dept`, `School`, `days`, `departingOn`, `returningOn`, `reasonFor`, `signature`, `phoneNumber`, `date`, `cForDirOfStuService`, `approveForDirOfStuService`, `approved1_at`, `cForHoD`, `approveForHoD`, `approved2_at`, `cForDeanOfSchl`, `approveForDeanOfSchl`, `approved3_at`, `dateOfreturned`, `created_at`) VALUES
(9, 'studentv2', '2789/T.2021', 'Year-three', 'ism', 'Computer Systems and Mathematics', 'SERBI', '4', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'hgggggggggggggggg', '', '0764333222', '2024-03-03 00:00:00.000', 'im a director of students service now im forward this permission is serious one', 'already_forwarded', '2024-05-19', 'im a od and im forward this poermsssion', 'already_forwarded', '2024-05-19', 'im dean of achool now im permit thsi permission', 'Permissioned_granted', '2024-05-13', '', '2024-05-13 09:34:22'),
(10, 'Permissionv1', '26787/T.2023', 'Year-two', 'CSN', 'Business Studies', 'SACEM', '4', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'RHFEFIIIIIIIIIIIIII', '', '0786754636662', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-04 09:10:22'),
(11, 'Permissionv5', '26789/T.2023', 'Year-two', 'LMV', 'Land Management and Valuation', 'SSPSS', '12', '2024-02-08 00:00:00.000', '2024-02-09 00:00:00.000', 'RHFEFIIIIIIIIIIIIII56557RR', '', '078675463', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-03 12:49:36'),
(12, 'SEES', '2455/T.2022', 'Year-one', 'MISE', 'Interior Design', 'SEES', '5', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'Seremony', '', '0776744373', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-03 14:21:02'),
(13, 'yturrr', '677/T.2002', 'Year-one', 'LMV', 'Environmental Science and Management', 'SSPSS', '43', '2024-03-03 00:00:00.000', '2024-03-03 00:00:00.000', 'FDFDDDD', '', '0997685544', '2024-03-03 00:00:00.000', '', '', '', '', '', '', '', '', '', '', '2024-03-04 10:51:41'),
(14, 'studentv2', '26889/T.2022', 'Year-one', 'LMV', 'Civil and Environmental Engineering', 'SSPSS', '5', '2024-03-05', '2024-03-13', 'HELLO TEST PERMISSION', '', '0682131140', '2024-03-20', '', '', '', '', '', '', '', '', '', '', '2024-03-04 12:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `School` varchar(100) NOT NULL,
  `Dept` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullName`, `School`, `Dept`, `role`, `email`, `password`, `created_at`) VALUES
(4, 'administrator', '', '', 'administrator', 'administrator@gmail.com', '9e9bd9de0cca9dea7ed72c56b4dc957b', '2024-03-02 23:06:54'),
(16, 'fullname', '', '', '', 'studentpermission@gmail.com', '27c61308fbd4f48ebe078e6e4c2c6e81', '2024-03-02 23:56:50'),
(17, 'HOD', 'SACEM', 'Land-Management and Valuation', 'directorOfstuService', 'hod123@gmail.com', '19135dfe6897d7f3409cac152092b71a', '2024-03-03 12:03:59'),
(18, 'SSPSS', 'SSPSS', 'Civil and Environmental-Engineering', 'directorOfstuService', 'sspss123@gmail.com', '783391e7dbc6d140f6f1a316ae8b190c', '2024-03-03 12:48:11'),
(20, 'SERBI', 'SERBI', 'Computer-Systems and Mathematics', 'directorOfstuService', 'serb123@gmail.com', '6d36083665e46b7a62f6d2455f2b0178', '2024-03-03 12:58:11'),
(21, 'studentv2', '', '', '', 'studentv2@gmail.com', 'b3478d15705d44bec7a3319bb36d2536', '2024-05-12 12:02:12'),
(22, 'HOD', 'SERBI', 'Computer-Systems and Mathematics', 'HOD', 'hodv2@gmail.com', '948a5ac2a79f594ce37ab636a5cc64f0', '2024-03-04 08:14:46'),
(23, 'hod1', 'SACEM', 'Environmental-Science and Management', 'HOD', 'hod1v1@gmail.com', '0402198b3ed978737d61819d93157152', '2024-03-04 09:04:34'),
(25, 'Dean of school', 'SERBI', 'Geospatial-Sciences and Technology', 'DeanOfSchl', 'deanofschlv1@gmail.com', 'a60a3cbe536458b65d769fd9997d21c6', '2024-03-04 09:17:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission_tbl`
--
ALTER TABLE `permission_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
