-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 04:44 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(50) DEFAULT NULL,
  `email` varchar(328) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_by_data` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 0,
  `user_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `email`, `mobile_number`, `user_name`, `password`, `created_by_data`, `status`, `user_image`) VALUES
(1, 'Dhruvin Padhara', 'dhruvin@1012.com', '9898980987', 'dbpadhara', 'db10', '2021-01-19 10:22:07', 0, 'person_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `exam_master`
--

CREATE TABLE `exam_master` (
  `exam_id` int(11) NOT NULL,
  `exam_title` varchar(50) DEFAULT NULL,
  `semester` tinyint(2) DEFAULT NULL,
  `field_id` tinyint(4) DEFAULT NULL,
  `total_question` smallint(6) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `question_file` varchar(100) DEFAULT NULL,
  `created_by_id` char(1) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp(),
  `bifercation` tinyint(1) DEFAULT 1,
  `active_flag` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_master`
--

-- INSERT INTO `exam_master` (`exam_id`, `exam_title`, `semester`, `field_id`, `total_question`, `exam_date`, `question_file`, `created_by_id`, `created_date`, `bifercation`, `active_flag`, `status`) VALUES
-- (1, 'core java', 1, 1, 15, '2021-02-17', NULL, '1', '2021-01-16 15:41:51', 1, 0, 1),
-- (2, 'core php', 2, 2, 25, '2021-01-21', NULL, '2', '2021-01-19 18:04:34', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` tinyint(4) NOT NULL,
  `field_name` varchar(30) DEFAULT NULL,
  `created_by_id` tinyint(2) DEFAULT NULL,
  `created_by_date` timestamp NULL DEFAULT current_timestamp(),
  `active_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field`
--

-- INSERT INTO `field` (`field_id`, `field_name`, `created_by_id`, `created_by_date`, `active_flag`) VALUES
-- (1, 'MCA', 1, '2021-01-16 12:55:16', 0),
-- (2, 'B.E(Computer)', 1, '2021-01-16 12:58:22', 0),
-- (3, 'B.E(Electrical)', 1, '2021-01-16 12:58:37', 0),
-- (4, 'BBA', 1, '2021-01-21 12:19:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question` varchar(100) DEFAULT NULL,
  `option1` varchar(50) DEFAULT NULL,
  `option2` varchar(50) DEFAULT NULL,
  `option3` varchar(50) DEFAULT NULL,
  `option4` varchar(50) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `active_flag` tinyint(1) DEFAULT 0,
  `created_by_id` tinyint(4) DEFAULT NULL,
  `created_by_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

-- INSERT INTO `question` (`question_id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_id`, `active_flag`, `created_by_id`, `created_by_date`) VALUES
-- (1, 'Extension of java file?.', '.java', '.class', 'javaa', 'none of above', '.java', 1, 0, 1, '2021-01-17 16:27:49'),
-- (2, 'java language can be supported operator overloadin', 'true', 'false', 'both', 'none of above', 'false', 1, 0, 1, '2021-01-17 16:27:49'),
-- (3, 'What is the range of short data type in Java?', '-128 to 127', '-32768 to 32767', '-2147483648 to 2147483647', ' None of above', '-32768 to 32767', 1, 0, 1, '2021-01-17 16:41:17'),
-- (4, 'What is the range of byte data type in Java?', '-128 to 127', '-32768 to 32767', '-2147483648 to 2147483647', 'none of aboce', '-128 to 127', 1, 0, 1, '2021-01-17 16:41:17'),
-- (5, 'An expression involving byte, int, and literal num', 'int', 'long', 'byte', 'float', 'int', 1, 0, 1, '2021-01-17 16:41:17'),
-- (6, 'Which data type value is returned by all transcend', 'int ', 'float', 'double', 'long', 'double', 1, 0, 1, '2021-01-17 16:41:17'),
-- (7, 'Which of these values can a boolean variable conta', 'True & False', '0 & 1', 'Any integer value', 'True', 'True & False', 1, 0, 1, '2021-01-17 16:41:17'),
-- (8, 'Who is known as father of Java Programming Languag', 'James Gosling', 'M. P Java', 'Charel Babbage', ' Blais Pascal', 'James Gosling', 1, 0, 1, '2021-01-18 05:12:57'),
-- (9, 'Which provides runtime environment for java byte c', 'JDK', 'JRE', 'JVM', 'JAVAC', 'JVM', 1, 0, 1, '2021-01-18 05:12:57'),
-- (10, 'Which of the following are not Java keywords ? ', 'double', 'then', 'abstract', 'case', 'then', 1, 0, 1, '2021-01-18 05:12:57'),
-- (21, 'Extension of php', '.php', '.html', '.xml', '.ph', 'undefined', 2, 0, 1, '2021-01-22 18:43:48'),
-- (22, 'What should be the correct syntax to write a PHP code?', '< php >', 'system.out.print()', '<?php ?>', '<? ?>', 'undefined', 2, 0, 1, '2021-01-22 18:43:48'),
-- (23, 'Which of the below statements is equivalent to $add += $add?', '$add = $add', '$add = $add +$add', '$add = $add + 1', '$add = $add + $add + 1', 'undefined', 2, 0, 1, '2021-01-22 18:43:48'),
-- (24, 'If $a = 12 what will be returned when ($a == 12) ? 5 : 1 is executed?', '12', '1', 'error', '5', 'undefined', 2, 0, 1, '2021-01-22 18:43:48'),
-- (25, 'Extension of php', '.php', '.html', '.xml', '.ph', 'undefined', 2, 0, 1, '2021-01-22 18:44:42'),
-- (26, 'What should be the correct syntax to write a PHP code?', '< php >', 'system.out.print()', '<?php ?>', '<? ?>', 'undefined', 2, 0, 1, '2021-01-22 18:44:42'),
-- (27, 'Which of the below statements is equivalent to $add += $add?', '$add = $add', '$add = $add +$add', '$add = $add + 1', '$add = $add + $add + 1', 'undefined', 2, 0, 1, '2021-01-22 18:44:42'),
-- (28, 'If $a = 12 what will be returned when ($a == 12) ? 5 : 1 is executed?', '12', '1', 'error', '5', 'undefined', 2, 0, 1, '2021-01-22 18:44:42'),
-- (29, 'Extension of php', '.php', '.html', '.xml', '.ph', 'undefined', 2, 0, 1, '2021-01-22 18:46:37'),
-- (30, 'What should be the correct syntax to write a PHP code?', '< php >', 'system.out.print()', '<?php ?>', '<? ?>', 'undefined', 2, 0, 1, '2021-01-22 18:46:37'),
-- (31, 'Which of the below statements is equivalent to $add += $add?', '$add = $add', '$add = $add +$add', '$add = $add + 1', '$add = $add + $add + 1', 'undefined', 2, 0, 1, '2021-01-22 18:46:38'),
-- (32, 'If $a = 12 what will be returned when ($a == 12) ? 5 : 1 is executed?', '12', '1', 'error', '5', 'undefined', 2, 0, 1, '2021-01-22 18:46:38'),
-- (33, 'Extension of php', '.php', '.html', '.xml', '.ph', 'undefined', 2, 0, 1, '2021-01-22 18:48:24'),
-- (34, 'What should be the correct syntax to write a PHP code?', '< php >', 'system.out.print()', '<?php ?>', '<? ?>', 'undefined', 2, 0, 1, '2021-01-22 18:48:24'),
-- (35, 'Which of the below statements is equivalent to $add += $add?', '$add = $add', '$add = $add +$add', '$add = $add + 1', '$add = $add + $add + 1', 'undefined', 2, 0, 1, '2021-01-22 18:48:24'),
-- (36, 'If $a = 12 what will be returned when ($a == 12) ? 5 : 1 is executed?', '12', '1', 'error', '5', 'undefined', 2, 0, 1, '2021-01-22 18:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_answer`
--

CREATE TABLE `user_exam_answer` (
  `user_exam_answer_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_exam_answer`
--

-- INSERT INTO `user_exam_answer` (`user_exam_answer_id`, `question_id`, `answer`, `exam_id`, `user_id`, `created_by_date`) VALUES
-- (1, 1, '.java', 1, 1, '2021-01-18 18:21:27'),
-- (2, 2, 'true', 1, 1, '2021-01-18 18:21:27'),
-- (3, 3, '-32768 to 32767', 1, 1, '2021-01-18 18:21:27'),
-- (4, 4, '-128 to 127', 1, 1, '2021-01-18 18:21:27'),
-- (5, 5, 'int', 1, 1, '2021-01-18 18:21:27'),
-- (6, 6, 'int ', 1, 1, '2021-01-18 18:21:28'),
-- (7, 7, 'True & False', 1, 1, '2021-01-18 18:21:28'),
-- (8, 8, 'James Gosling', 1, 1, '2021-01-18 18:21:28'),
-- (9, 9, 'JDK', 1, 1, '2021-01-18 18:21:28'),
-- (10, 10, 'double', 1, 1, '2021-01-18 18:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_status`
--

CREATE TABLE `user_exam_status` (
  `user_exam_id` int(11) NOT NULL,
  `total_question` tinyint(4) NOT NULL DEFAULT 0,
  `correct_answer` tinyint(4) NOT NULL DEFAULT 0,
  `wrong_answer` tinyint(4) NOT NULL DEFAULT 0,
  `exam_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_by_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_exam_status`
--

-- INSERT INTO `user_exam_status` (`user_exam_id`, `total_question`, `correct_answer`, `wrong_answer`, `exam_id`, `user_id`, `status`, `created_by_date`) VALUES
-- (1, 10, 8, 2, 1, 1, 0, '2021-01-20 09:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `field_id` tinyint(4) DEFAULT NULL,
  `semester` tinyint(2) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(35) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `active_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_registration`
--

-- INSERT INTO `user_registration` (`user_id`, `user_name`, `field_id`, `semester`, `email`, `password`, `profile_pic`, `status`, `active_flag`) VALUES
-- (1, 'Dhruvin', 2, 1, 'db@1.com', 'db10', 'person_2.jpg', 0, 0),
-- (2, 'parth', 3, 8, 'parth@1.com', 'parth@1211', 'person_4.jpg', 0, 0),
-- (3, 'meet patel', 1, 6, 'meet@1.com', 'meet@1012', 'person_2.jpg', 1, 0),
-- (4, 'krushank', 1, 2, 'kp@1.com', 'hello', 'bg_5.jpg', 0, 1),
-- (5, 'darshan', 2, 3, 'darshan@1.com', 'darshan', 'bg_6.jpg', 0, 1),
-- (6, 'Krunal', 1, 1, 'krunal@1.com', 'krunal123', 'person_1.jpg', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `exam_master`
--
ALTER TABLE `exam_master`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  ADD PRIMARY KEY (`user_exam_answer_id`);

--
-- Indexes for table `user_exam_status`
--
ALTER TABLE `user_exam_status`
  ADD PRIMARY KEY (`user_exam_id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_master`
--
ALTER TABLE `exam_master`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  MODIFY `user_exam_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_exam_status`
--
ALTER TABLE `user_exam_status`
  MODIFY `user_exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
