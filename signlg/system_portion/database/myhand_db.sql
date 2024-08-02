-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 07:11 PM
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
-- Database: `myhand_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alphabet`
--

CREATE TABLE `alphabet` (
  `id` int(11) NOT NULL,
  `alphabet` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alphabet`
--

INSERT INTO `alphabet` (`id`, `alphabet`, `description`, `created_at`) VALUES
(2, 'A.png', 'A', '2024-05-27 08:08:12'),
(3, 'B.png', 'B', '2024-05-27 10:01:52'),
(4, 'C.png', 'C', '2024-05-27 10:02:06'),
(5, 'D.png', 'D', '2024-05-27 10:02:19'),
(6, 'E.png', 'E', '2024-05-27 10:02:59'),
(7, 'F.png', 'F', '2024-05-27 10:03:13'),
(8, 'G.png', 'G', '2024-05-27 10:03:25'),
(9, 'H.png', 'H', '2024-05-27 10:03:54'),
(10, 'I.png', 'I', '2024-05-27 10:04:11'),
(11, 'J.png', 'J', '2024-05-27 10:04:23'),
(12, 'K.png', 'K', '2024-05-27 10:04:37'),
(13, 'L.png', 'L', '2024-05-27 10:04:51'),
(14, 'M.png', 'M', '2024-05-27 10:05:11'),
(15, 'N.png', 'N', '2024-05-27 10:05:52'),
(16, 'O.png', 'O', '2024-05-27 10:06:08'),
(17, 'P.png', 'P', '2024-05-27 10:06:23'),
(18, 'Q.png', 'Q', '2024-05-27 10:06:37'),
(19, 'R.png', 'R', '2024-05-27 10:06:52'),
(20, 'S.png', 'S', '2024-05-27 10:07:05'),
(21, 'T.png', 'T', '2024-05-27 10:07:20'),
(22, 'U.png', 'U', '2024-05-27 10:07:34'),
(23, 'V.png', 'V', '2024-05-27 10:07:49'),
(24, 'W.png', 'W', '2024-05-27 10:07:59'),
(25, 'X.png', 'X', '2024-05-27 10:08:11'),
(26, 'Y.png', 'Y', '2024-05-27 10:08:24'),
(27, 'Z.png', 'Z', '2024-05-27 10:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `up_file` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `up_file`, `category`) VALUES
(14, 'ABOUT US.docx', 'hello this '),
(15, 'DATA BASE.pdf', 'mbunge book');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'John Z. Petro ', 'jzacharia971@gmail.com', 'hellow', '2024-05-16 15:32:40'),
(2, 'HAMIS', 'jzacharia971@gmail.com', 'HELLOW', '2024-05-20 11:58:39'),
(3, 'ISACK', 'isaack@gmail.com', 'eeee', '2024-05-27 09:16:26'),
(4, 'glory', 'jzacharia971@gmail.com', 'ESRRSERDF', '2024-05-28 12:48:50'),
(5, 'John Z. Petro ', 'jzacharia971@gmail.com', 'je naweza kupata vitabu vya kujifunza lugha ya alama ya Tanzaniua', '2024-06-03 09:27:00'),
(6, 'Sabina', 'sabina@gmail.com', 'habari', '2024-06-06 05:25:23'),
(7, 'NEEMA', 'neema@gmail.com', 'LAT TZ', '2024-06-12 08:36:23'),
(8, 'john', 'john@gmail.com', 'habari', '2024-06-12 08:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `s_id` int(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `your_answer` varchar(50) NOT NULL,
  `is_correct` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `s_id`, `user_id`, `answer`, `your_answer`, `is_correct`, `created_at`) VALUES
(164, 13, 15, 'Deaf', 'Deaf', 'true', '2024-06-28 17:01:43'),
(165, 14, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(166, 15, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(167, 16, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(168, 17, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(169, 18, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(170, 19, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(171, 20, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(172, 21, 15, 'mvc test', '', '', '2024-06-28 15:11:24'),
(173, 22, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(174, 23, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(175, 24, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(176, 25, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(177, 26, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(178, 27, 15, 'mvc tes', '', '', '2024-06-28 15:11:25'),
(179, 28, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(180, 29, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(181, 30, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(182, 31, 15, 'mvc test', '', '', '2024-06-28 15:11:25'),
(183, 32, 15, 'mvc test', 'Deaf', 'false', '2024-06-28 16:22:10'),
(359, 45, 12, 'aaaaaaaaaaaaaaaaaa', 'Head', 'false', '2024-06-28 17:00:50'),
(360, 46, 12, 'xxxxxxxxxxxxxxxx', 'Neck', 'false', '2024-06-28 17:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `receiversms`
--

CREATE TABLE `receiversms` (
  `contact_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiversms`
--

INSERT INTO `receiversms` (`contact_id`, `email`, `message`, `created_at`) VALUES
(1, 'jzacharia971@gmail.com', 'hhehhehe hello recie sbsha', '2024-05-21 09:54:35'),
(2, 'user123gmail.com', 'nnnnnnnnnnnnnnnn', '2024-05-21 10:51:13'),
(3, 'jzacharia971@gmail.com', 'uisdfuirewieyyew', '2024-05-23 09:42:50'),
(4, 'jzacharia971@gmail.com', 'jhkgdfgerfyygruyjdferyg', '2024-05-27 08:42:50'),
(5, 'jzacharia971@gmail.com', 'nhafegyrgryu', '2024-05-27 08:43:00'),
(6, 'jzacharia971@gmail.com', 'rrr', '2024-05-27 09:05:37'),
(7, 'isaack@gmail.com', '4ed5rfr5fr', '2024-05-27 09:17:15'),
(8, 'isaack@gmail.com', 'gggg', '2024-05-28 06:07:01'),
(9, 'jzacharia971@gmail.com', 'bbb', '2024-05-28 06:07:20'),
(10, 'jzacharia971@gmail.com', 'FFDFGHFT6R', '2024-05-28 12:49:24'),
(11, 'jzacharia971@gmail.com', 'Ndio unaweza kupata', '2024-06-03 09:28:26'),
(12, 'sabina@gmail.com', 'njema', '2024-06-06 05:32:46'),
(13, 'neema@gmail.com', 'OK', '2024-06-12 08:36:53'),
(14, 'john@gmail.com', 'safi', '2024-06-12 08:48:24');

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
(2, 'guest', 'dgfdfsgggggwweww', '2024-03-28 00:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `symbols_tbl`
--

CREATE TABLE `symbols_tbl` (
  `s_id` int(11) NOT NULL,
  `s_upload` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symbols_tbl`
--

INSERT INTO `symbols_tbl` (`s_id`, `s_upload`, `description`, `created_at`) VALUES
(12, '1.jpg', 'MOJA ', '2024-06-05 20:31:46'),
(13, 'ADUI.jpg', 'ADUI', '2024-06-05 20:32:14'),
(14, 'AJE.jpg', 'AJE', '2024-06-05 20:32:26'),
(15, 'AMKA.jpg', 'AMKA', '2024-06-05 20:32:39'),
(16, 'ANDIKA.jpg', 'ANDIKA', '2024-06-05 20:33:00'),
(17, 'ASKOFU.jpg', 'ASKOFU', '2024-06-05 20:33:16'),
(18, 'BABA.jpg', 'BABA', '2024-06-05 20:33:35'),
(19, 'BABU.jpg', 'BABU', '2024-06-05 20:33:49'),
(20, 'BARIDI.jpg', 'BARIDI', '2024-06-05 20:34:04'),
(21, 'BASI.jpg', 'BASI', '2024-06-05 20:34:21'),
(22, 'BIBI.jpg', 'BIBI', '2024-06-05 20:34:37'),
(23, 'BIMTI.jpg', 'BINTI', '2024-06-05 20:34:52'),
(24, 'BINAMU.jpg', 'BINAMU', '2024-06-05 20:35:11'),
(25, 'BOX.jpg', 'BOX', '2024-06-05 20:35:29'),
(26, 'CHAKI.jpg', 'CHAKI', '2024-06-05 20:35:47'),
(27, 'CHELEWA.jpg', 'CHELEWA', '2024-06-05 20:36:08'),
(28, 'CHEO.jpg', 'CHEO', '2024-06-05 20:36:57'),
(29, 'DADA.jpg', 'DADA\r\n', '2024-06-05 20:37:20'),
(30, 'DEREVA.jpg', 'DEREVA', '2024-06-05 20:37:47'),
(31, 'FAMILIA.jpg', 'FAMILIA', '2024-06-05 20:38:07'),
(32, 'HABARI.jpg', 'HABARI', '2024-06-05 20:38:26'),
(33, 'HISTORIA.jpg', 'HISTORIA', '2024-06-05 20:38:44'),
(34, 'HUDUMA.jpg', 'HUDUMA', '2024-06-05 20:39:04'),
(35, 'JANA.jpg', 'JANA', '2024-06-05 20:39:37'),
(36, 'JASHO.jpg', 'JASHO', '2024-06-05 20:40:02'),
(37, 'JUA.jpg', 'JUA', '2024-06-05 20:40:22'),
(38, 'JUMA PILI.jpg', 'JUMA PILI', '2024-06-05 20:40:53'),
(39, 'JUMLA.jpg', 'KANISA', '2024-06-05 20:41:21'),
(40, 'KAKA.jpg', 'KAKA', '2024-06-05 20:41:50'),
(41, 'KANISA.jpg', 'BIBLIA', '2024-06-05 20:42:11'),
(42, 'KATA.jpg', 'KATA', '2024-06-05 20:42:31'),
(43, 'KAZI.jpg', 'KAZI', '2024-06-05 20:42:56'),
(44, 'KITI.jpg', 'KITI', '2024-06-05 20:43:25'),
(45, 'KOFIA.jpg', 'KOFIA', '2024-06-05 20:43:53'),
(46, 'KUFA.jpg', 'KUFA', '2024-06-05 20:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `genda` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `gender`, `address`, `date_of_birth`, `phone`, `email`, `password`, `role`, `genda`, `created_at`) VALUES
(6, 'administrator', 'male', 'mwenge,mliman ardhi', '2024-03-29', '0682131140', 'administrator@gmail.com', '9e9bd9de0cca9dea7ed72c56b4dc957b', 'administrator', 'none-deaf', '2024-06-28 15:42:09'),
(9, 'fhhhhhh', 'female', 'fffffffffffffg', '2024-03-26', '687777777777744', 'user123gmail.com', '202cb962ac59075b964b07152d234b70', 'normal_user', 'deal', '2024-05-23 08:57:18'),
(10, 'ISACK', 'male', 'MBEYA', '2024-05-08', '0786738940', 'isaack@gmail.com', '202cb962ac59075b964b07152d234b70', 'normal_user', 'none-dea', '2024-05-28 13:04:39'),
(11, 'Emmanuel', 'male', 'mwanza', '2025-01-02', '0712345678', 'emmanuel@gmail.com', '202cb962ac59075b964b07152d234b70', 'normal_user', 'deaf', '2024-06-02 17:12:47'),
(12, 'John Z. Petro', 'male', 'Ardhi University', '2000-12-21', '0742972252', 'jzacharia971@gmail.com', '1b41185c9e9b5e23f50fe020bc878c4b', 'normal_user', 'none-deal', '2024-06-28 16:49:58'),
(13, 'Sabina', 'female', 'Ardhi University', '2005-02-06', '0711111111', 'sabina@gmail.com', '202cb962ac59075b964b07152d234b70', 'normal_user', 'deal', '2024-06-06 05:30:03'),
(14, 'NEEMA', 'female', 'DODOMA', '2010-02-21', '072222222', 'neema@gmail.com', '202cb962ac59075b964b07152d234b70', 'normal_user', 'deal', '2024-06-12 08:38:38'),
(15, 'john', 'male', 'Ardhi University', '2024-06-17', '0742972252', 'john123@gmail.com', '47fbe738eafc1948d0db42921d90f7a3', 'normal_user', 'none-deal', '2024-06-28 15:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `video_tbl`
--

CREATE TABLE `video_tbl` (
  `v_id` int(11) NOT NULL,
  `v_upload` longblob NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video_tbl`
--

INSERT INTO `video_tbl` (`v_id`, `v_upload`, `description`, `created_at`) VALUES
(16, 0x75706c6f6164732f412c5f452c5f492c5f4f2c5f552e5f5f5f574153494c49414e415f4e415f56495a4957495f4b57415f4c554748415f59415f414c414d415f59415f54414e5a414e49412e2e2833363070292e6d7034, 'IRABU', '2024-06-03 08:12:54'),
(17, 0x75706c6f6164732f534f554e445f574954485f504943545552455f54534c2833363070292e6d7034, 'ALFABETI', '2024-06-03 08:13:44'),
(18, 0x75706c6f6164732f79326d6174652e636f6d202d2053414c414d55204e41204d41414d4b495a495f333630702e6d7034, 'SALAMU (A)', '2024-06-03 08:14:53'),
(19, 0x75706c6f6164732f53414c414d41202d20534c2e6d7034, 'SALAMU (B)', '2024-06-03 08:15:15'),
(20, 0x75706c6f6164732f46414d494c4941202d20534c2e6d7034, 'FAMILIA (A)', '2024-06-03 08:16:08'),
(21, 0x75706c6f6164732f574154555f4b4154494b415f46414d494c4941283130383070292e6d7034, 'FAMILIA (B)', '2024-06-03 08:16:47'),
(22, 0x75706c6f6164732f46616d696c69615f6b77615f6c756768615f79615f416c616d612833363070292e6d7034, 'FAMILIA (C)', '2024-06-03 08:17:15'),
(23, 0x75706c6f6164732f4e59414b4154495f4b4154494b415f53494b555f6b77615f6c756768615f79615f416c616d615f79615f54616e7a616e69612833363070292e6d7034, 'NYAKATI (A)', '2024-06-03 08:20:42'),
(24, 0x75706c6f6164732f5649442d32303234303530352d5741303037372e6d7034, 'NYAKATI (B)', '2024-06-03 08:21:02'),
(25, 0x75706c6f6164732f5649442d32303234303531322d5741303032372e6d7034, 'MAKABILA', '2024-06-03 08:21:41'),
(28, 0x75706c6f6164732f4d4154554e44415f4b57415f4c554748415f59415f414c414d415f59415f54414e5a414e49415f5f54534c5f283130383070292e6d7034, 'MATUNDA ', '2024-06-03 08:23:46'),
(29, 0x75706c6f6164732f4a6966756e7a655f4d616a696e615f79615f4d696b6f615f6e615f4d61656e656f5f6d62616c696d62616c695f79615f54616e7a616e69615f6b77615f6c756768615f7a615f416c616d612e283130383070292e6d7034, 'MIKOA (A)', '2024-06-03 08:24:27'),
(30, 0x75706c6f6164732f524547494f4e535f4f465f54414e5a414e49415f494e5f54534c2e5f5f5f5f5f5f5f5f5f5f5f5f6d696b6f615f79615f54616e7a616e69615f283130383070292e6d7034, 'MIKOA (B)', '2024-06-03 08:24:42'),
(31, 0x75706c6f6164732f5649442d32303234303530392d5741303036392e6d7034, 'MIKOA (C)', '2024-06-03 08:24:58'),
(32, 0x75706c6f6164732f534f4349414c204d45444941202d534c2e6d7034, 'MITANDAO YA  KIJAMII', '2024-06-03 08:32:07'),
(33, 0x75706c6f6164732f5649442d32303234303531302d5741303038352e6d7034, 'MATAIFA', '2024-06-03 08:32:27'),
(34, 0x75706c6f6164732f436f6c6f7572735f696e5f54616e7a616e69615f7369676e5f6c616e6775616765283130383070292e6d7034, 'RANGI (A)', '2024-06-03 08:33:05'),
(35, 0x75706c6f6164732f4c554748415f59415f414c414d415f59415f54414e5a414e49415f4e415f4d4159414c4c412832343070292e6d7034, 'RANGI (B)', '2024-06-03 08:33:21'),
(36, 0x75706c6f6164732f53485547555249202d20534c2e6d7034, 'TAASISI NA MAHALI', '2024-06-03 08:34:07'),
(37, 0x75706c6f6164732f4b554a4954414d42554c495348415f4b57415f4c554748415f59415f414c414d412833363070292e6d7034, 'UTAMBULISHO', '2024-06-03 08:34:30'),
(38, 0x75706c6f6164732f564954555f5659415f4441524153414e495f4b57415f4c554748415f59415f414c414d412833363070292e6d7034, 'VIFAA VYA DARASANI', '2024-06-03 08:35:04'),
(39, 0x75706c6f6164732f564954555f5659415f4a494b4f4e495f5f425f5f54534c2833363070292e6d7034, 'VIFAA VYA JIKONI (A)', '2024-06-03 08:35:44'),
(40, 0x75706c6f6164732f566974755f7679615f6a696b6f6e695f6b77615f6c756768615f79615f616c616d612833363070292e6d7034, 'VIFAA VYA JIKONI (B)', '2024-06-03 08:35:58'),
(41, 0x75706c6f6164732f766974755f7679615f736562756c656e695f6b77615f6c756768615f79615f616c616d612833363070292e6d7034, 'VIFAA VYA SEBULENI (A)', '2024-06-03 08:36:41'),
(42, 0x75706c6f6164732f44656c6963696f75735f666f6f645f666f756e645f5f5f696e54616e7a616e69612d54534c5f5f616c616d615f7a615f7679616b756c615f6d62616c696d62616c695f6b77615f6c756768615f6d62616c696d62616c695f283130383070292e6d7034, 'VYAKULA', '2024-06-03 08:37:02'),
(43, 0x75706c6f6164732f4d616a696e615f79615f77616e79616d615f6b77615f6c756768615f79615f616c616d612e2833363070292e6d7034, 'WANYAMA', '2024-06-03 08:37:22'),
(44, 0x75706c6f6164732f57696d626f5f77615f54616966615f6b6174696b615f6c756768615f79615f616c616d612833363070292e6d7034, 'WIMBO WA TAIFA LA TANZANIA', '2024-06-03 08:38:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alphabet`
--
ALTER TABLE `alphabet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiversms`
--
ALTER TABLE `receiversms`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `symbols_tbl`
--
ALTER TABLE `symbols_tbl`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `video_tbl`
--
ALTER TABLE `video_tbl`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alphabet`
--
ALTER TABLE `alphabet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `receiversms`
--
ALTER TABLE `receiversms`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `symbols_tbl`
--
ALTER TABLE `symbols_tbl`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `video_tbl`
--
ALTER TABLE `video_tbl`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
