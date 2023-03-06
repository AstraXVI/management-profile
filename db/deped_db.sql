-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 07:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `pic` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `pic`, `name`) VALUES
(9, 'uploads/announcement/330592988_519480886922121_4301420214595789631_n.jpg', '330592988_519480886922121_4301420214595789631_n.jpg'),
(10, 'uploads/announcement/308160417_491670489636305_2880562263675572756_n.jpg', '308160417_491670489636305_2880562263675572756_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `lvl` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'renz@123', '1', '', '', '', 'nums', 'date'),
(15, 'renz@123', '2', '4', '1', '2', '12', '2029'),
(34, 'Norlitan.santos@deped.gov.ph', 'RA - 1080 Bar/Board Eligibility', '0', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `credential`
--

CREATE TABLE `credential` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pic` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credential`
--

INSERT INTO `credential` (`id`, `email`, `pic`, `name`, `type`) VALUES
(13, 'Edithad.baesa@deped.gov.ph', 'uploads/credentials/308160417_491670489636305_2880562263675572756_n.jpg', '308160417_491670489636305_2880562263675572756_n.jpg', 'Image'),
(15, 'Edithad.baesa@deped.gov.ph', 'uploads/credentials/330592988_519480886922121_4301420214595789631_n.jpg', '330592988_519480886922121_4301420214595789631_n.jpg', 'Image'),
(16, 'Edithad.baesa@deped.gov.ph', 'uploads/credentials/sample.docx', 'sample.docx', 'File');

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
  `graduateScholar` varchar(250) NOT NULL,
  `elemSchool` varchar(250) NOT NULL,
  `secSchool` varchar(250) NOT NULL,
  `vocSchool` varchar(250) NOT NULL,
  `elemEduc` varchar(250) NOT NULL,
  `secEduc` varchar(250) NOT NULL,
  `vocEduc` varchar(250) NOT NULL,
  `elemFrom` varchar(250) NOT NULL,
  `secFrom` varchar(250) NOT NULL,
  `vocFrom` varchar(250) NOT NULL,
  `elemTo` varchar(250) NOT NULL,
  `secTo` varchar(250) NOT NULL,
  `vocTo` varchar(250) NOT NULL,
  `elemHighLvl` varchar(250) NOT NULL,
  `secHighLvl` varchar(250) NOT NULL,
  `vocHighLvl` varchar(250) NOT NULL,
  `elemGraduate` varchar(250) NOT NULL,
  `secGraduate` varchar(250) NOT NULL,
  `vocGraduate` varchar(250) NOT NULL,
  `elemScholar` varchar(250) NOT NULL,
  `secScholar` varchar(250) NOT NULL,
  `vocScholar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educationalbg`
--

INSERT INTO `educationalbg` (`id`, `email`, `schoolCollege`, `graduateStudies`, `collegeCourse`, `graduateCourse`, `collegeFrom`, `collegeTo`, `graduateFrom`, `graduateTo`, `collegeHigh`, `graduateHigh`, `collegeYear`, `graduateYear`, `collegeScholar`, `graduateScholar`, `elemSchool`, `secSchool`, `vocSchool`, `elemEduc`, `secEduc`, `vocEduc`, `elemFrom`, `secFrom`, `vocFrom`, `elemTo`, `secTo`, `vocTo`, `elemHighLvl`, `secHighLvl`, `vocHighLvl`, `elemGraduate`, `secGraduate`, `vocGraduate`, `elemScholar`, `secScholar`, `vocScholar`) VALUES
(1, 'Edithad.baesa@deped.gov.ph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'Gloriad.morenos@deped.gov.ph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'Marialourdesb.viray@deped.gov.ph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'Jeda.camposano@deped.gov.ph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 'Norlitan.santos@deped.gov.ph', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `educationaldegree`
--

CREATE TABLE `educationaldegree` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `lvl` varchar(250) NOT NULL,
  `nameSchool` varchar(250) NOT NULL,
  `education` varchar(250) NOT NULL,
  `periodFrom` varchar(250) NOT NULL,
  `periodTo` varchar(250) NOT NULL,
  `highLvl` varchar(250) NOT NULL,
  `year` varchar(250) NOT NULL,
  `scholar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educationaldegree`
--

INSERT INTO `educationaldegree` (`id`, `email`, `lvl`, `nameSchool`, `education`, `periodFrom`, `periodTo`, `highLvl`, `year`, `scholar`) VALUES
(32, 'Gloriad.morenos@deped.gov.ph', 'Post Degree', '', '', '', '', '', '', ''),
(33, 'Gloriad.morenos@deped.gov.ph', 'Masters Degree', '', '', '', '', '', '', ''),
(34, 'Gloriad.morenos@deped.gov.ph', 'Post Degree', '', '', '', '', '', '', ''),
(36, 'Edithad.baesa@deped.gov.ph', 'Post Degree', '', '', '', '', '', '', '');

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
-- Table structure for table `learning`
--

CREATE TABLE `learning` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `dateFrom` varchar(250) NOT NULL,
  `dateTo` varchar(250) NOT NULL,
  `hours` varchar(250) NOT NULL,
  `typeOfLd` varchar(250) NOT NULL,
  `conducted` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learning`
--

INSERT INTO `learning` (`id`, `email`, `title`, `dateFrom`, `dateTo`, `hours`, `typeOfLd`, `conducted`) VALUES
(4, 'admin@1', 'qq', '', '', 'q', 'q', 'q'),
(5, '', 'w', '', '', '', '', ''),
(9, '', 'qq', '2023-02-24', '', '3', '', ''),
(10, '', 'qq', '2023-02-24', '', '3', '', '');

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
  `employeeNo` varchar(250) NOT NULL,
  `placeBirth` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `bday`, `address`, `email`, `contactNo`, `sex`, `yearAsSchoolHead`, `duration`, `learnersPerf`, `teacherPerf`, `financialMng`, `complaints`, `picture`, `school`, `citizenship`, `civil`, `zipcode`, `employeeNo`, `placeBirth`) VALUES
(26, 'Editha D. Baesa', '', '', 'Edithad.baesa@deped.gov.ph', '', 'Female', '', '', '', '', '', '', 'uploads/profile_pics/images (12) (1).jpeg', 'Elementary School', 'filipino', 'single', '', '', ''),
(27, 'Norlita N. Santos', '', '', 'Norlitan.santos@deped.gov.ph', '', 'Male', '', '', '', '', '', '', 'uploads/profile_pics/GitHub-Mark.png', 'Elementary School', '', '', '', '1231', ''),
(28, 'Gloria D. Morenos', '', '', 'Gloriad.morenos@deped.gov.ph', '', 'Male', '', '', '', '', '', '', '', 'Elementary School', '', '', '', '', ''),
(29, 'Maria Lourdes B. Viray', '', '', 'Marialourdesb.viray@deped.gov.ph', '', 'Female', '', '', '', '', '', '', '', 'Elementary School', '', '', '', '', ''),
(30, 'Jed A. Camposano', '', '', 'Jeda.camposano@deped.gov.ph', '', 'Male', '', '', '', '', '', '', '', 'Elementary School', '', '', '', '', '');

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
(49, 'Edithad.baesa@deped.gov.ph', 'editha@2023', 'Client', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `voluntary`
--

CREATE TABLE `voluntary` (
  `id` int(11) NOT NULL,
  `nameAddress` varchar(250) NOT NULL,
  `dateFrom` varchar(250) NOT NULL,
  `dateTo` varchar(250) NOT NULL,
  `hours` varchar(250) NOT NULL,
  `position` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dateFrom` varchar(250) NOT NULL,
  `dateTo` varchar(250) NOT NULL,
  `positionLvl` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL,
  `monthSalary` varchar(250) NOT NULL,
  `salary` varchar(250) NOT NULL,
  `statusApointment` varchar(250) NOT NULL,
  `govService` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civil`
--
ALTER TABLE `civil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credential`
--
ALTER TABLE `credential`
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
-- Indexes for table `educationaldegree`
--
ALTER TABLE `educationaldegree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning`
--
ALTER TABLE `learning`
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
-- Indexes for table `voluntary`
--
ALTER TABLE `voluntary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `civil`
--
ALTER TABLE `civil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `credential`
--
ALTER TABLE `credential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dor`
--
ALTER TABLE `dor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `educationalbg`
--
ALTER TABLE `educationalbg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `educationaldegree`
--
ALTER TABLE `educationaldegree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `learning`
--
ALTER TABLE `learning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `voluntary`
--
ALTER TABLE `voluntary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
