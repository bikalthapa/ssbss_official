-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 04:55 PM
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
(1, 'Schoo', '9342 23-10-17-02-55question_answers.pdf', '2023-10-17');

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
(2, 'Notice Title 0', 'something notice src0', 'image.jpg', '2023-02-02', 'notice'),
(3, 'News Title 1', 'Something news src1', 'image.jpg', '2023-02-02', 'news'),
(4, 'Notice Title 1', 'something notice src1', 'image.jpg', '2023-02-02', 'notice'),
(5, 'News Title 2', 'Something news src2', 'image.jpg', '2023-02-02', 'news'),
(6, 'Notice Title 2', 'something notice src2', 'image.jpg', '2023-02-02', 'notice'),
(7, 'News Title 3', 'Something news src3', 'image.jpg', '2023-02-02', 'news'),
(8, 'Notice Title 3', 'something notice src3', 'image.jpg', '2023-02-02', 'notice'),
(9, 'News Title 4', 'Something news src4', 'image.jpg', '2023-02-02', 'news'),
(10, 'Notice Title 4', 'something notice src4', 'image.jpg', '2023-02-02', 'notice'),
(11, 'News Title 5', 'Something news src5', 'image.jpg', '2023-02-02', 'news'),
(12, 'Notice Title 5', 'something notice src5', 'image.jpg', '2023-02-02', 'notice'),
(13, 'News Title 6', 'Something news src6', 'image.jpg', '2023-02-02', 'news'),
(14, 'Notice Title 6', 'something notice src6', 'image.jpg', '2023-02-02', 'notice'),
(15, 'News Title 7', 'Something news src7', 'image.jpg', '2023-02-02', 'news'),
(16, 'Notice Title 7', 'something notice src7', 'image.jpg', '2023-02-02', 'notice'),
(17, 'News Title 8', 'Something news src8', 'image.jpg', '2023-02-02', 'news'),
(18, 'Notice Title 8', 'something notice src8', 'image.jpg', '2023-02-02', 'notice'),
(19, 'News Title 9', 'Something news src9', 'image.jpg', '2023-02-02', 'news'),
(20, 'Notice Title 9', 'something notice src9', 'image.jpg', '2023-02-02', 'notice'),
(21, 'News Title 10', 'Something news src10', 'image.jpg', '2023-02-02', 'news'),
(22, 'Notice Title 10', 'something notice src10', 'image.jpg', '2023-02-02', 'notice'),
(23, 'News Title 11', 'Something news src11', 'image.jpg', '2023-02-02', 'news'),
(24, 'Notice Title 11', 'something notice src11', 'image.jpg', '2023-02-02', 'notice'),
(25, 'News Title 12', 'Something news src12', 'image.jpg', '2023-02-02', 'news'),
(26, 'Notice Title 12', 'something notice src12', 'image.jpg', '2023-02-02', 'notice'),
(27, 'News Title 13', 'Something news src13', 'image.jpg', '2023-02-02', 'news'),
(28, 'Notice Title 13', 'something notice src13', 'image.jpg', '2023-02-02', 'notice'),
(29, 'News Title 14', 'Something news src14', 'image.jpg', '2023-02-02', 'news'),
(30, 'Notice Title 14', 'something notice src14', 'image.jpg', '2023-02-02', 'notice'),
(31, 'News Title 15', 'Something news src15', 'image.jpg', '2023-02-02', 'news'),
(32, 'Notice Title 15', 'something notice src15', 'image.jpg', '2023-02-02', 'notice'),
(33, 'News Title 16', 'Something news src16', 'image.jpg', '2023-02-02', 'news'),
(34, 'Notice Title 16', 'something notice src16', 'image.jpg', '2023-02-02', 'notice'),
(35, 'News Title 17', 'Something news src17', 'image.jpg', '2023-02-02', 'news'),
(36, 'Notice Title 17', 'something notice src17', 'image.jpg', '2023-02-02', 'notice'),
(37, 'News Title 18', 'Something news src18', 'image.jpg', '2023-02-02', 'news'),
(38, 'Notice Title 18', 'something notice src18', 'image.jpg', '2023-02-02', 'notice'),
(39, 'News Title 19', 'Something news src19', 'image.jpg', '2023-02-02', 'news'),
(40, 'Notice Title 19', 'something notice src19', 'image.jpg', '2023-02-02', 'notice'),
(41, 'News Title 20', 'Something news src20', 'image.jpg', '2023-02-02', 'news'),
(42, 'Notice Title 20', 'something notice src20', 'image.jpg', '2023-02-02', 'notice'),
(43, 'News Title 21', 'Something news src21', 'image.jpg', '2023-02-02', 'news'),
(44, 'Notice Title 21', 'something notice src21', 'image.jpg', '2023-02-02', 'notice'),
(45, 'News Title 22', 'Something news src22', 'image.jpg', '2023-02-02', 'news'),
(46, 'Notice Title 22', 'something notice src22', 'image.jpg', '2023-02-02', 'notice'),
(47, 'News Title 23', 'Something news src23', 'image.jpg', '2023-02-02', 'news'),
(48, 'Notice Title 23', 'something notice src23', 'image.jpg', '2023-02-02', 'notice'),
(49, 'News Title 24', 'Something news src24', 'image.jpg', '2023-02-02', 'news'),
(50, 'Notice Title 24', 'something notice src24', 'image.jpg', '2023-02-02', 'notice'),
(51, 'News Title 25', 'Something news src25', 'image.jpg', '2023-02-02', 'news'),
(52, 'Notice Title 25', 'something notice src25', 'image.jpg', '2023-02-02', 'notice'),
(53, 'News Title 26', 'Something news src26', 'image.jpg', '2023-02-02', 'news'),
(54, 'Notice Title 26', 'something notice src26', 'image.jpg', '2023-02-02', 'notice'),
(55, 'News Title 27', 'Something news src27', 'image.jpg', '2023-02-02', 'news'),
(56, 'Notice Title 27', 'something notice src27', 'image.jpg', '2023-02-02', 'notice'),
(57, 'News Title 28', 'Something news src28', 'image.jpg', '2023-02-02', 'news'),
(59, 'News Title 29', 'Something news src29', 'image.jpg', '2023-02-02', 'news'),
(61, 'Rubicks Cube', 'asdf', 'all_teachers.jpg', '2023-10-18', 'news'),
(62, 'Rubicks Cube', 'asdfasdfadsf', 'frame.png', '2023-10-03', 'news'),
(63, 'Rubicks Cube', 'asdfasdfadsf', 'frame.png', '2023-10-03', 'news'),
(64, 'Rubicks Cube', 'asdfasdfadsf', 'frame.png', '2023-10-03', 'news'),
(65, 'Rubicks Cube', 'asdfasdfadsf', 'frame.png', '2023-10-03', 'news'),
(70, 'Rubicks Cubeasdfasdfasdf', 'asdfasdfasdfasdfasdfasdfasdfasdf', 'Screenshot (199).png', '2023-10-15', 'news'),
(71, 'Rubicks Cubeasdfasdfasdf', 'asdfasdfasdfasdfasdfasdfasdfasdf', 'Screenshot (199).png', '2023-10-15', 'news'),
(72, 'Rubicks Cubeasdfasdfasdf', 'asdfasdfasdfasdfasdfasdfasdfasdf', 'Screenshot (199).png', '2023-10-15', 'news'),
(73, 'asdf', 'as', 'white_tigers.jpg', '2023-10-15', 'news'),
(74, 'asdf', 'as', 'white_tigers.jpg', '2023-10-15', 'news'),
(75, 'asdf', 'asdf', 'aquarium_3d.jpg', '2023-10-15', 'news'),
(78, 'news title dashaina', 'asdfasdfadsfadsf', '1811 23-10-25-12-50all_teachers.jpg', '2023-10-25', 'news');

-- --------------------------------------------------------

--
-- Table structure for table `result_files`
--

CREATE TABLE `result_files` (
  `rst_id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `config_file_name` varchar(255) DEFAULT NULL,
  `published_date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result_files`
--

INSERT INTO `result_files` (`rst_id`, `file_name`, `class_id`, `section_id`, `config_file_name`, `published_date`) VALUES
(1, 'data_filled_1.csv', 1, NULL, 'default.php', 20230202),
(2, 'data_filled_1.csv', 2, NULL, 'default.php', 20230202),
(3, 'data_filled_1.csv', 3, NULL, 'default.php', 20230202),
(4, 'data_filled_1.csv', 4, NULL, 'default.php', 20230202),
(5, 'data_filled_1.csv', 9, NULL, 'default.php', 20230202),
(6, 'data_filled_1.csv', 10, NULL, 'default.php', 20230202),
(7, 'data_filled_1.csv', 5, 1, 'default.php', 20230202),
(8, 'data_filled_2.csv', 5, 9, 'default.php', 20230202),
(9, 'data_filled_1.csv', 6, 2, 'default.php', 20230202),
(10, 'data_filled_2.csv', 6, 10, 'default.php', 20230202),
(11, 'data_filled_1.csv', 7, 3, 'default.php', 20230202),
(12, 'data_filled_2.csv', 7, 11, 'default.php', 20230202),
(13, 'data_filled_1.csv', 8, 4, 'default.php', 20230202),
(14, 'data_filled_2.csv', 8, 12, 'default.php', 20230202),
(15, '1045 23-10-26-04-08 R2.csv', 6, 0, 'default.php', 0),
(16, '4002 23-10-26-05-46 R1.csv', 5, 5, 'default.php', 0),
(17, '3299 23-10-26-05-30 R2.csv', 5, 5, 'default.php', 0),
(18, '9289 23-10-26-05-59 R2.csv', 5, 1, 'default.php', 0),
(19, '492 23-10-26-05-03 R2.csv', 5, 1, 'default.php', 0),
(20, '1961 23-10-26-05-14 R2.csv', 5, 1, 'default.php', 0),
(21, '5652 23-10-27-06-20 R1.csv', 0, 0, 'default.xml', 0),
(22, '2371 23-10-27-06-50 R1.csv', 0, 0, 'default.xml', 0),
(23, '3803 23-10-27-06-51 R2.csv', 0, 0, 'default.xml', 0),
(24, '3390 23-10-27-06-08 R2.csv', 0, 0, 'default.xml', 2080),
(25, '4281 23-10-27-06-37 R2.csv', 0, 0, 'default.xml', 2080),
(26, '794 23-10-27-06-04 R1.csv', 0, 0, 'default.xml', 2080),
(27, '1964 23-10-27-05-09 R1.csv', 0, 0, 'default.xml', 2080),
(28, '5284 23-10-27-05-11 R2.csv', 0, 0, 'default.xml', 2080),
(29, '4774 23-10-27-05-12 R1.csv', 5, 1, 'default.xml', 2080),
(30, '8435 23-10-27-05-12 R2.csv', 2, NULL, 'default.xml', 2080),
(31, '8337 23-10-28-04-11 R1.csv', 0, 0, 'default.xml', 2080),
(32, '1393 23-10-28-04-11 R2.csv', 0, 0, 'default.xml', 2080),
(33, '6531 23-10-28-04-51 data_filled_1.csv', 3, NULL, 'default.xml', 2080),
(34, '9201 23-10-28-04-52 R1.csv', 1, NULL, 'default.xml', 2080),
(35, '3355 23-10-28-04-52 R2.csv', 1, NULL, 'default.xml', 2080),
(36, '590 23-10-28-05-46 R1.csv', 5, 0, 'default.xml', 2080),
(37, '2822 23-10-28-05-35 R1.csv', 5, 0, 'default.xml', 2080),
(38, '1060 23-10-28-06-40 R1.csv', 5, 0, 'default.xml', 2080),
(39, '3316 23-10-28-06-41 R2.csv', 4, NULL, 'default.xml', 2080),
(40, '9632 23-10-28-06-36 R1.csv', 5, 0, 'default.xml', 2080),
(41, '595 23-10-28-06-36 R2.csv', 4, NULL, 'default.xml', 2080),
(42, '3568 23-10-28-06-47 R1.csv', 5, 0, 'default.xml', 2080),
(43, '2626 23-10-28-06-48 R2.csv', 4, NULL, 'default.xml', 2080),
(44, '9870 23-10-28-06-30 R1.csv', 5, 0, 'default.xml', 2080),
(45, '6687 23-10-28-06-31 R2.csv', 4, NULL, 'default.xml', 2080),
(46, '4061 23-10-28-06-33 R2.csv', 2, NULL, 'default.xml', 2080),
(47, '3595 23-10-28-06-31 R2.csv', 2, NULL, 'default.xml', 2080),
(48, '6964 23-10-28-06-27 R1.csv', 5, 1, 'default.xml', 2080),
(49, '9737 23-10-28-06-27 R2.csv', 5, 1, 'default.xml', 2080);

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
-- Indexes for table `result_files`
--
ALTER TABLE `result_files`
  ADD PRIMARY KEY (`rst_id`);

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
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `result_files`
--
ALTER TABLE `result_files`
  MODIFY `rst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
