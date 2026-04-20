-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compet`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `created_at`) VALUES
(4, 'no class', '2026-04-20'),
(5, 'from pc27', '2026-04-20'),
(6, 'dqwdqd', '2026-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `deadline`, `file`) VALUES
(2, 'da', 'dqdqw', '2026-04-20', '1776665342_bg.jpg'),
(3, 'dqw', 'dwqd', '2026-04-20', '1776665381_CCST LOGO - NEW (1).png'),
(4, 'dqw', 'dwqd', '2026-04-20', '1776665501_CCST LOGO - NEW (1).png'),
(5, 'efw', 'wqd', '2026-04-20', '1776665515_SCHOOL.png');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`) VALUES
(1, 3, '2026-04-20', 'Absent'),
(2, 3, '2026-04-20', 'Present'),
(3, 3, '2026-04-20', 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `term` varchar(20) DEFAULT NULL,
  `attendance` int(11) DEFAULT NULL,
  `activity` int(11) DEFAULT NULL,
  `quiz` int(11) DEFAULT NULL,
  `recitation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `subject`, `grade`, `section`, `term`, `attendance`, `activity`, `quiz`, `recitation`) VALUES
(1, 2, 'ART-APP', '98', 'ACT 2-A', 'PRELIM', 98, 98, 98, 98),
(2, 2, 'PATHFIT', '98', 'ACT 2-A', 'PRELIM', 98, 98, 98, 98),
(3, 2, 'MULTIMEDIA', '98', 'ACT 2-A', 'PRELIM', 98, 98, 98, 98),
(4, 2, 'SYSTEM-ANALYSIS', '98', 'ACT 2-A', 'PRELIM', 98, 98, 98, 98),
(5, 2, 'ART-APP', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(6, 2, 'PATHFIT', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(7, 2, 'MULTIMEDIA', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(8, 2, 'SYSTEM-ANALYSIS', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(9, 2, 'ART-APP', '90', 'ACT 2-A', 'FINALS', 90, 90, 90, 90),
(10, 2, 'PATHFIT', '90', 'ACT 2-A', 'FINALS', 90, 90, 90, 90),
(11, 2, 'MULTIMEDIA', '90', 'ACT 2-A', 'FINALS', 90, 90, 90, 90),
(12, 2, 'SYSTEM-ANALYSIS', '90', 'ACT 2-A', 'FINALS', 90, 90, 90, 90),
(13, 1, 'ART-APP', '90', 'ACT 2-A', 'PRELIM', 90, 90, 90, 90),
(14, 1, 'PATHFIT', '90', 'ACT 2-A', 'PRELIM', 90, 90, 90, 90),
(15, 1, 'MULTIMEDIA', '90', 'ACT 2-A', 'PRELIM', 90, 90, 90, 90),
(16, 1, 'SYSTEM-ANALYSIS', '90', 'ACT 2-A', 'PRELIM', 90, 90, 90, 90),
(17, 1, 'ART-APP', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(18, 1, 'PATHFIT', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(19, 1, 'MULTIMEDIA', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(20, 1, 'SYSTEM-ANALYSIS', '71', 'ACT 2-A', 'MIDTERM', 71, 71, 71, 71),
(21, 1, 'ART-APP', '98', 'ACT 2-A', 'FINALS', 98, 98, 98, 98),
(22, 1, 'PATHFIT', '98', 'ACT 2-A', 'FINALS', 98, 98, 98, 98),
(23, 1, 'MULTIMEDIA', '98', 'ACT 2-A', 'FINALS', 98, 98, 98, 98),
(24, 1, 'SYSTEM-ANALYSIS', '95.75', 'ACT 2-A', 'FINALS', 98, 98, 98, 89);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `assignment_title` varchar(100) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `submitted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `student_id`, `assignment_title`, `file`, `submitted_at`) VALUES
(1, 3, 'dwqd', '1776666227_CCST LOGO - NEW (1).png', '2026-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','teacher') DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `number`) VALUES
(1, 'Mark Bongala Burce', 'burcemarkangelo4@gmail.com', '$2y$10$kfUVxOOjDaV9chP/Xn8E2e//Y24My0VHY/4Yc.tiqFHEDPc0s8Jhu', 'teacher', NULL),
(2, 'Kent Sikret askldjlkajsd', 'sample@email.com', '$2y$10$0hfr26jnXcGet8yepdFUpOM8b99WIARMwWaqnIa8a.wK0cfflaEe2', 'teacher', NULL),
(3, 'Mark Bongala Burce', 'burcemark@gmail.com', '$2y$10$Z0koRRMsd9sCCtfkwmYCde4WHraS6/R/kXVOmdmRwxUpjlGzc3k4S', 'student', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
