-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 12:58 AM
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
-- Database: `orsapplication_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clearance_forms`
--

CREATE TABLE `clearance_forms` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `indexNo` varchar(50) NOT NULL,
  `yearOfStudy` varchar(50) NOT NULL,
  `file_upload` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance_forms`
--

INSERT INTO `clearance_forms` (`id`, `fullName`, `indexNo`, `yearOfStudy`, `file_upload`, `description`, `created_at`) VALUES
(1, 'USER TEST', 'S0551/0072/2018', '3444444444', 'Gmail - IMPORTANT_ FIRST DISSERTATION PROGRESS ASS', 'drfffffffffffg', '2024-05-20 16:03:28'),
(2, 'Yohana Kangwe', 'S0551/0072/2019', '344444', 'MyFieldReportOfficial.pdf', 'fddddddddddddddddddddd', '2024-05-20 16:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `indexNo` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `school` varchar(100) NOT NULL,
  `wented_at` varchar(255) NOT NULL,
  `clearanceForm` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resultsleep_tbl`
--

CREATE TABLE `resultsleep_tbl` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `indexNo` varchar(255) NOT NULL,
  `sleep_file` varchar(255) NOT NULL,
  `school` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approved` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resultsleep_tbl`
--

INSERT INTO `resultsleep_tbl` (`id`, `fullName`, `indexNo`, `sleep_file`, `school`, `status`, `approved`, `created_at`) VALUES
(7, 'userv3', '0558.0072.2018', 'mysystemArchtecture.png', '', 'active', 'approved', '2024-03-01 14:56:52'),
(10, 'MUDHIHIR H NYEMA', '0551.0072.2018', 'Sleeep Demo MVC.docx', 'makongo sec', 'active', 'approved', '2024-03-05 07:59:21'),
(11, 'USER TEST', 'S0551/0072/2018', 'MyFieldReportOfficial.pdf', 'mbezi high', 'active', '', '2024-05-20 16:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `description`, `created_at`) VALUES
(1, 'admin', 'vbbbbbbbbbbbbbbbbbbbbb', '2024-05-20 15:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `school_tbl`
--

CREATE TABLE `school_tbl` (
  `school_id` int(11) NOT NULL,
  `school` varchar(100) NOT NULL,
  `regNo` varchar(100) NOT NULL,
  `head_ofScool` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_tbl`
--

INSERT INTO `school_tbl` (`school_id`, `school`, `regNo`, `head_ofScool`, `created_at`) VALUES
(2, 'mbezi high', 'TSN26889/T.2010', 'MVCsSofts', '2024-03-04 19:09:16'),
(6, 'makongo sec', 'TSN26889/T.201044', 'MVCsSoftsv1', '2024-03-05 06:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `indexNo` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `school` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `validy_student` varchar(50) NOT NULL,
  `wented_at` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullName`, `indexNo`, `role`, `school`, `email`, `validy_student`, `wented_at`, `password`, `created_at`) VALUES
(7, 'Studentv1', '0559.0079.2018', '', 'makongo sec', 'studentTest123@gmail.com', '', '', '44100bfd13f6230dd99d3b9730f3136a', '2024-03-05 07:42:02'),
(8, 'userv3', '0551.0072.2018', '', '', 'userv3A3@gmail.com', '', '', 'c34fb678b44e8b414db2f6f439b6af61', '2024-03-01 14:42:02'),
(9, 'admin', '', 'admin', '', 'adminA123@gmail.com', '', '', 'fb04448a5ff15962b393c64cce2c3b28', '2024-03-01 14:46:34'),
(10, 'userV4', '0559.0079.2018', '', '', 'userV4231@gmail.com', '', '', '862a816b416767e068085dee61c60fd9', '2024-03-01 15:10:43'),
(13, 'makongo', '', 'head_of_school', 'makongo sec', 'makongo@gmail.com', '', '', 'fefc385393e3df115ff0695a2e077923', '2024-03-05 07:21:20'),
(14, 'MUDHIHIR H NYEMA', '0551.0072.2018', '', '', 'nyemamudhihirA123@gmail.com', '', '', '65f6fe1c3142e935209211a626085c87', '2024-03-05 07:53:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clearance_forms`
--
ALTER TABLE `clearance_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resultsleep_tbl`
--
ALTER TABLE `resultsleep_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `school_tbl`
--
ALTER TABLE `school_tbl`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clearance_forms`
--
ALTER TABLE `clearance_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `resultsleep_tbl`
--
ALTER TABLE `resultsleep_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_tbl`
--
ALTER TABLE `school_tbl`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
