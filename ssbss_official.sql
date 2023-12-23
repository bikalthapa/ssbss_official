-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 02:15 PM
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
-- Database: `ssbss_official`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'Class 10 CE'),
(2, 'Class 9 CE'),
(3, 'Class 10 EM'),
(4, 'Class 9 EM'),
(5, 'Class 8 EM'),
(6, 'Class 7 EM'),
(7, 'Class 6 EM'),
(8, 'Class 5 EM'),
(9, 'Class 10 NM'),
(10, 'Class 9 NM'),
(11, 'Class 8 NM'),
(12, 'Class 7 NM'),
(13, 'Class 6 NM'),
(14, 'Class 5 NM');

-- --------------------------------------------------------

--
-- Table structure for table `class_section`
--

CREATE TABLE `class_section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_section`
--

INSERT INTO `class_section` (`section_id`, `section_name`, `class_id`) VALUES
(1, 'Annapurna', 5),
(2, 'Annapurna', 6),
(3, 'Annapurna', 7),
(4, 'Annapurna', 8),
(5, 'Annapurna', 11),
(6, 'Annapurna', 12),
(7, 'Annapurna', 13),
(8, 'Annapurna', 14),
(9, 'Sagarmatha', 5),
(10, 'Sagarmatha', 6),
(11, 'Sagarmatha', 7),
(12, 'Sagarmatha', 8),
(13, 'Sagarmatha', 11),
(14, 'Sagarmatha', 12),
(15, 'Sagarmatha', 13),
(16, 'Sagarmatha', 14);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL,
  `doc_title` varchar(255) DEFAULT NULL,
  `doc_file` varchar(255) DEFAULT NULL,
  `upload_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`doc_id`, `doc_title`, `doc_file`, `upload_date`) VALUES
(5, 'SSBSS Abhiyan', '3019 23-11-25-05-25MP-EXP-3.pdf', '2023-11-25'),
(6, 'Rubicks Cube', '8697 23-11-25-05-02MP-EXP-3.pdf', '2023-11-25'),
(7, 'Rubicks Cube', '6800 23-11-25-05-35Chapter 1.pdf', '2023-11-25'),
(8, 'FES Question Answer Grade 9', '1811 23-11-25-05-40question_answers.pdf', '2023-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(2555) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `src`, `thumbnail`, `upload_date`, `type`) VALUES
(20, 'Rubicks Cube', '9849 ndescr 23-12-09-11-10.txt', '6949 23-12-09-11-09336372751_760405572065793_1688880329429791351_n.jpg', '2023-12-09', 'news');

-- --------------------------------------------------------

--
-- Table structure for table `news_img`
--

CREATE TABLE `news_img` (
  `n_img_id` int(11) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_img`
--

INSERT INTO `news_img` (`n_img_id`, `filename`, `news_id`) VALUES
(4, '5391 rt_img 23-12-09-10-48students_with_prizes.jpg', 16),
(5, '5640 rt_img 23-12-09-10-49students_with_teachers.jpg', 16),
(6, '719 rt_img 23-12-09-10-24smart_board.jpg', 17),
(7, '3242 rt_img 23-12-09-10-24students_with_prizes.jpg', 17),
(8, '807 rt_img 23-12-09-10-25students_with_teachers.jpg', 17),
(9, '3432 rt_img 23-12-09-10-50slogo.png', 18),
(10, '1757 rt_img 23-12-09-10-51smart_board.jpg', 18),
(11, '1972 rt_img 23-12-09-10-52students_with_prizes.jpg', 18),
(12, '7859 rt_img 23-12-09-10-54students_with_teachers.jpg', 18),
(13, '318 rt_img 23-12-09-11-19336496830_165567619707549_8757264684857635796_n.jpg', 19),
(14, '8414 rt_img 23-12-09-11-20336521132_1427703387769594_6853570445252875981_n.jpg', 19),
(15, '9655 rt_img 23-12-09-11-20336533521_1392010781585439_1163202946554964262_n.jpg', 19),
(16, '1390 rt_img 23-12-09-11-11343166789_1635110687007565_925906957560815730_n.jpg', 20),
(17, '4198 rt_img 23-12-09-11-11343172556_581948483917391_4344915794062906571_n.jpg', 20),
(18, '7200 rt_img 23-12-09-11-12343236470_1384063252441427_6672821276591578302_n.jpg', 20);

-- --------------------------------------------------------

--
-- Table structure for table `result_files`
--

CREATE TABLE `result_files` (
  `rst_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `published_year` int(11) DEFAULT NULL,
  `published_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result_files`
--

INSERT INTO `result_files` (`rst_id`, `file_name`, `class_id`, `term`, `published_year`, `published_date`) VALUES
(24, '2517 23-12-08-07-18 CE 9.csv', 2, 1, 2080, 23),
(25, '3665 23-12-08-07-18 CE 10.csv', 1, 1, 2080, 23),
(26, '3605 23-12-08-07-21 EM 09.csv', 4, 1, 2080, 23),
(27, '9119 23-12-08-07-21 EM 10.csv', 3, 1, 2080, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) DEFAULT NULL,
  `u_email` varchar(255) DEFAULT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_role`) VALUES
(1, 'SSBSS ADMIN', 'shantibhagwatiletang2009@gmail.com', '$2y$10$xJ3Y458QX.crvGvFpkQgA.GX/dOO27qql1oOnwO/WsLQ5NrX.O/gK', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_section`
--
ALTER TABLE `class_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `news_img`
--
ALTER TABLE `news_img`
  ADD PRIMARY KEY (`n_img_id`);

--
-- Indexes for table `result_files`
--
ALTER TABLE `result_files`
  ADD PRIMARY KEY (`rst_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class_section`
--
ALTER TABLE `class_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_img`
--
ALTER TABLE `news_img`
  MODIFY `n_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `result_files`
--
ALTER TABLE `result_files`
  MODIFY `rst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
