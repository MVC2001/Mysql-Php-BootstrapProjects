-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 02:16 PM
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
-- Database: `heriety`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `answer_count` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `user_id`, `question_id`, `answer`, `answer_count`, `courseCode`, `created_at`) VALUES
(37, 5, 44, 'Use englishv', '3', 'IS554', '2024-06-19 11:48:32'),
(38, 4, 43, 'Use englishfffffteee', '3', 'IS554', '2024-06-19 11:49:30'),
(39, 4, 42, 'Use englishfffffteee', '3', 'IS554', '2024-06-19 11:49:55'),
(40, 4, 47, 'ASgassgfsf', '1', '', '2024-06-19 12:09:30'),
(41, 4, 46, 'dffsfsf', '1', '', '2024-06-19 12:09:30'),
(42, 4, 45, 'srssrrssr', '1', '', '2024-06-19 12:09:30'),
(43, 4, 44, 'srsrsrsr', '1', '', '2024-06-19 12:09:30'),
(47, 4, 40, 'ssfffffffff', '1', '', '2024-06-19 12:15:45'),
(48, 4, 39, 'srssfsffs', '1', '', '2024-06-19 12:15:45'),
(49, 4, 38, 'sdsdss', '1', '', '2024-06-19 12:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `question` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `user_id`, `question`, `program`, `courseCode`, `description`, `created_at`) VALUES
(38, 3, 'question 1', 'ISM ', 'ISM', 'ghhhhhhhhhhhhhhhhhh', '2024-06-01 22:58:07'),
(39, 3, 'question 2', 'ISM ', 'ISM', 'ghhhhhhhhhhhhhhhhhh', '2024-06-01 22:57:59'),
(40, 3, 'question 3', 'ISM ', 'ISM', 'ghhhhhhhhhhhhhhhhhh', '2024-06-01 22:57:48'),
(42, 3, 'shh', 'ISM', 'IS554', 'rhhhhhhhh', '2024-06-01 22:41:51'),
(43, 3, 'jjjjjjjjjjjjjjjjj', 'ISM', 'IS554', 'jllllllllllllllllllll', '2024-06-01 22:43:08'),
(44, 6, 'hello how is is212', 'ISM', 'IS212', 'gggggggggggggg', '2024-06-01 23:10:00'),
(45, 6, 'explan mean of programming', 'ISM', 'IS212', 'gggggggggggggg', '2024-06-01 23:10:00'),
(46, 6, 'gf', 'ISM', 'IS212', 'fdd', '2024-06-02 00:03:00'),
(47, 6, 'ggf', 'ISM', 'IS212', 'fdd', '2024-06-02 00:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `role` varchar(40) NOT NULL,
  `school` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `courseCode` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullName`, `role`, `school`, `department`, `program`, `courseCode`, `email`, `password`, `created_at`) VALUES
(1, 'admn', 'admin', '', '', '', '', 'admin123@gmal.com', 'd953ee6fb432cf11a6284a1506ff8c99', '2024-05-27 19:49:05'),
(3, 'sgsggsgs', 'staff', 'SERBI', 'Computer_Systems_and_Mathematics', 'ISM', 'ISM', 'staff123@gmail.com', 'ebe1180386362178b36f58cc9041000b', '2024-06-19 10:14:15'),
(4, 'Student', 'student', 'SERBI', 'Computer_Systems_and_Mathematics', 'ISM', 'IS554', 'student123@gmaill.com', '34a30b7e5ae03a9a3efc1d080ace43c2', '2024-05-27 22:09:35'),
(5, 'studentv2', 'student', 'SERBI', 'Computer_Systems_and_Mathematics', 'ISM', 'IS55444', 'studentv3@gmail.com', 'dd421a54b40a822dc9dc82ca667e1703', '2024-05-28 10:19:58'),
(6, 'user v2', 'staff', 'SERBI', 'Building_Economics', 'ISM', 'IS554', 'is212@gmail.com', '8a1c6a6d852eaa15c0f1e0ea033226e7', '2024-06-19 10:18:36'),
(7, 'new studentv5', 'student', 'SERBI', 'Computer_Systems_and_Mathematics', 'ISM', '', 'newstudent123@gmail.com', 'e120ea280aa50693d5568d0071456460', '2024-06-19 11:57:34'),
(8, 'CSN user', 'student', 'SERBI', 'Computer_Systems_and_Mathematics', 'CSN', '', 'csnuser123@gmail.com', 'dcbaa5c5fc2ff8c10e3437ed463d75b7', '2024-06-19 11:58:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
