-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 30, 2019 at 07:44 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class_follow_up`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `subjects` varchar(150) NOT NULL,
  `grade` enum('8','9','10','11','12') NOT NULL,
  `number_of_tests` int(11) DEFAULT NULL,
  `components` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `subjects`, `grade`, `number_of_tests`, `components`) VALUES
(23, 'Algebra 1/2', 'Mathematics', '8', 10, '10 tests and R&I'),
(24, 'Work and Prosperity', 'Economics', '10', 7, '7 tests and R&I'),
(25, 'Streams of Civilization Volume 1', 'History', '9', 17, '17 tests and an R&I');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `enrollment_type` enum('First Time','Re-enrollment') NOT NULL,
  `enrollment_date` date NOT NULL,
  `grade_of_enrollment` enum('8','9','10','11','12') NOT NULL,
  `cat_status` varchar(100) DEFAULT NULL,
  `documentation_sent` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_id`, `enrollment_type`, `enrollment_date`, `grade_of_enrollment`, `cat_status`, `documentation_sent`) VALUES
(1, 173277, 'First Time', '2019-04-06', '9', 'CAT completed', ''),
(2, 123456, 'First Time', '2019-04-20', '8', 'CAT not needed', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_number` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `order_details` varchar(100) NOT NULL,
  `amount_paid` varchar(20) NOT NULL,
  `shipping_details` varchar(250) DEFAULT NULL,
  `delivery_status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_number`, `enrollment_id`, `order_details`, `amount_paid`, `shipping_details`, `delivery_status`) VALUES
(78472, 1, 'busm3953_badm-assignment-(1).pdf', '$725.18', 'Books will be shipped, tests will arrive by email.', 'Tests arrived'),
(194244, 2, '84-dov-dori.pdf', '$612.25', 'Will come by email', 'Has arrived.');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `enrollment_status` enum('Enrolled','Not enrolled','Enrollment Pending') NOT NULL,
  `student_type` enum('Current','Past') NOT NULL,
  `date_of_departure` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `enrollment_status`, `student_type`, `date_of_departure`) VALUES
(24331, 'Veronica', '', 'Logde', '2004-01-10', 'Female', 'Enrolled', 'Current', NULL),
(55323, 'Henry', '', 'Fallon', '2004-01-10', 'Male', 'Not enrolled', 'Past', '2019-03-10'),
(123456, 'Hencha', '', 'McKnight', '2004-10-15', 'Female', 'Enrolled', 'Current', NULL),
(173277, 'Flora', 'Abigail', 'Mills', '2001-04-17', 'Female', 'Enrolled', 'Current', NULL),
(173284, 'Matthew', 'Rufus', 'Doiley', '1999-10-03', 'Male', 'Not enrolled', 'Current', NULL),
(234963, 'Snow', 'Success', 'White', '2006-02-02', 'Female', 'Enrollment Pending', 'Current', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `grade` enum('8','9','10','11','12') NOT NULL,
  `test_sent` varchar(250) DEFAULT NULL,
  `quickscore_status` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student_id`, `course_id`, `grade`, `test_sent`, `quickscore_status`) VALUES
(24331, 23, '8', 'All tests sent ', 'All reports received'),
(24331, 25, '9', '10 tests sent', 'reports for test 1-9 received'),
(173277, 23, '8', 'Sent 3 on 10 tests', 'Received QuickScore for tests 1 and 2.');

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE `student_grade` (
  `student_id` int(11) NOT NULL,
  `grade` enum('8','9','10','11','12') NOT NULL,
  `end_date` date NOT NULL,
  `grade_completion_status` mediumtext,
  `report_card_status` mediumtext,
  `diploma_status` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`student_id`, `grade`, `end_date`, `grade_completion_status`, `report_card_status`, `diploma_status`) VALUES
(24331, '8', '2018-08-15', 'completed', 'all report cards recevied', 'Diploma received'),
(24331, '9', '2020-08-15', 'not done', 'first quarter received', 'no diploma'),
(24331, '10', '2020-08-15', 'gdxfjchgkj', 'fehtjk,kjnbvfcth', 'gtdyjhkbnhcyfugi'),
(24331, '11', '2022-12-30', ' nothing', 'nothing', 'nothing'),
(173277, '8', '2019-07-26', 'Grade is not complete', 'No report cards have been received ', 'Diploma has not been received');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `trans_description` mediumtext NOT NULL,
  `total` varchar(50) NOT NULL,
  `transaction_details` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `student_id`, `trans_date`, `trans_description`, `total`, `transaction_details`) VALUES
(865, 173284, '2018-01-28', 'khvjhv,', '$12.99', 'uclan-bsc-bcis-programme-sheet.pdf'),
(23435, 24331, '2018-01-30', 'Order one lesson planner', '$5.99', 'p_031874.doc');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `upload_id` int(11) NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `file_type` varchar(150) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`upload_id`, `order_number`, `transaction_id`, `file_name`, `file_type`, `file_size`) VALUES
(3, 78472, NULL, 'busm3953_badm-assignment-(1).pdf', 'application/pdf', 399912),
(4, NULL, 757, 'currentclasshandbook.pdf', 'application/pdf', 2967777),
(5, NULL, 7578, 'currentclasshandbook.pdf', 'application/pdf', 2967777),
(6, NULL, 442425, 'osd_december_2018_assignment_-_final_8286-copy.pdf', 'application/pdf', 332420),
(7, NULL, 53634, 'latest-uclan-brochure.pdf', 'application/pdf', 1616049),
(8, NULL, 53634, 'latest-uclan-brochure.pdf', 'application/pdf', 1616049),
(9, NULL, 865, 'uclan-bsc-bcis-programme-sheet.pdf', 'application/pdf', 847930),
(10, 194244, NULL, '84-dov-dori.pdf', 'application/pdf', 549287),
(11, NULL, 23435, 'p_031874.doc', 'application/msword', 288768);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_level` enum('Administrator','User') NOT NULL,
  `username` varchar(255) NOT NULL,
  `pswrd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_level`, `username`, `pswrd`) VALUES
(1, 'Test', '', 'Administrator', 'test1', ''),
(2, 'Demo', '', 'Administrator', 'demo', '$2y$10$kwuGkDErf9LjxOkSp57rQOcBSPOvNMONGqhBsThXc0LYNtsV.Dw6S'),
(4, 'User', 'User', 'Administrator', 'user123', '$2y$10$AI7wtiq5VU5J6XxdPw6mteMUhOcNiHkBHJ1sGe8gVbILMR.KXkdUW'),
(5, 'Chris', 'Evans', 'User', 'cevans', '$2y$10$V/hbDtilqoZIcfhyYNIBXOHrDtjXThNoe1kOgvq9/IaOxG.B4Rs1e'),
(8, 'Kasey', 'Capris', 'User', 'kcapris', '$2y$10$u4z/WCWhNA5iSoZKc8pAteEay3GG9ZHchC5A5cOxbj4eWCSlZQ3jG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_number`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_grade`
--
ALTER TABLE `student_grade`
  ADD UNIQUE KEY `student_id_2` (`student_id`,`grade`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_user` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`enrollment_id`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `student_grade`
--
ALTER TABLE `student_grade`
  ADD CONSTRAINT `student_grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
