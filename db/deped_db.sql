-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 06:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deped_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `civil`
--

CREATE TABLE `civil` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `careerService` varchar(250) NOT NULL,
  `rating` varchar(250) NOT NULL,
  `dateOfExam` varchar(250) NOT NULL,
  `placeOfExam` varchar(250) NOT NULL,
  `licenseNumber` varchar(250) NOT NULL,
  `licenseDateOfValidity` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `civil`
--

INSERT INTO `civil` (`id`, `email`, `careerService`, `rating`, `dateOfExam`, `placeOfExam`, `licenseNumber`, `licenseDateOfValidity`) VALUES
(1, 'renz@i', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dor`
--

CREATE TABLE `dor` (
  `id` int(11) NOT NULL,
  `school_name` varchar(1000) NOT NULL,
  `dor_pics` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `educationalbg`
--

CREATE TABLE `educationalbg` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `schoolCollege` varchar(250) NOT NULL,
  `graduateStudies` varchar(250) NOT NULL,
  `collegeCourse` varchar(250) NOT NULL,
  `graduateCourse` varchar(250) NOT NULL,
  `collegeFrom` varchar(250) NOT NULL,
  `collegeTo` varchar(250) NOT NULL,
  `graduateFrom` varchar(250) NOT NULL,
  `graduateTo` varchar(250) NOT NULL,
  `collegeHigh` varchar(250) NOT NULL,
  `graduateHigh` varchar(250) NOT NULL,
  `collegeYear` varchar(250) NOT NULL,
  `graduateYear` varchar(250) NOT NULL,
  `collegeScholar` varchar(250) NOT NULL,
  `graduateScholar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educationalbg`
--

INSERT INTO `educationalbg` (`id`, `email`, `schoolCollege`, `graduateStudies`, `collegeCourse`, `graduateCourse`, `collegeFrom`, `collegeTo`, `graduateFrom`, `graduateTo`, `collegeHigh`, `graduateHigh`, `collegeYear`, `graduateYear`, `collegeScholar`, `graduateScholar`) VALUES
(13, 'renz@i', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `article` varchar(250) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date_acquired` varchar(250) NOT NULL,
  `unit_value` varchar(250) NOT NULL,
  `total_value` varchar(250) NOT NULL,
  `source_of_fund` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `permission` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `bday` varchar(250) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `contactNo` varchar(250) NOT NULL,
  `sex` varchar(250) NOT NULL,
  `yearAsSchoolHead` varchar(250) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `learnersPerf` varchar(250) NOT NULL,
  `teacherPerf` varchar(250) NOT NULL,
  `financialMng` varchar(250) NOT NULL,
  `complaints` varchar(250) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `school` varchar(500) NOT NULL,
  `citizenship` varchar(250) NOT NULL,
  `civil` varchar(250) NOT NULL,
  `zipcode` varchar(250) NOT NULL,
  `employeeNo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `bday`, `address`, `email`, `contactNo`, `sex`, `yearAsSchoolHead`, `duration`, `learnersPerf`, `teacherPerf`, `financialMng`, `complaints`, `picture`, `school`, `citizenship`, `civil`, `zipcode`, `employeeNo`) VALUES
(1, 'Admin', '01/17/1996', '1225 sta monica subd ugong valenzuela city', 'ikejoseph.lumaad@deped.gov.ph', '09396439742', 'Male', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', '', 'uploads/profile_pics/bckground.png', '', '', '', '', ''),
(17, 'q', '', '', 'renz@i', '', '', '', '', '', '', '', '', '', 'High School', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(250) NOT NULL,
  `school_id` varchar(250) NOT NULL,
  `division` varchar(250) NOT NULL,
  `school_type` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `contact_no` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `duration_of_stay` varchar(250) NOT NULL,
  `learners_perf` varchar(250) NOT NULL,
  `teacher_perf` varchar(250) NOT NULL,
  `financial` varchar(250) NOT NULL,
  `compaint` varchar(250) NOT NULL,
  `issue` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school_name`, `school_id`, `division`, `school_type`, `contact_person`, `contact_no`, `email`, `district`, `level`, `address`, `duration_of_stay`, `learners_perf`, `teacher_perf`, `financial`, `compaint`, `issue`) VALUES
(14, 'q', '123123', 'DCS-Valenzuela', 'Private', 'renz capena', '0923123', 'renz@e', 'Congressional I', 'Elementary School', '', '', '', '', '', '', ''),
(15, '', '', '', '', '', '', 't', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `picture` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `role`, `school`, `picture`) VALUES
(1, 'admin@1', 'admin', 'Admin', 'none', ''),
(45, 'renz@i', 'renz', 'Client', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `civil`
--
ALTER TABLE `civil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dor`
--
ALTER TABLE `dor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educationalbg`
--
ALTER TABLE `educationalbg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `civil`
--
ALTER TABLE `civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dor`
--
ALTER TABLE `dor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `educationalbg`
--
ALTER TABLE `educationalbg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
