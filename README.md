# CodeStreet
A coding platform that would help programmers to compete, compare and improve their programming skills.

Many of the institutes, when conducting programming competitions, still use paper as a medium. 
This requires lot of manual labour that includes evaluating, processing and generating results. 
This problem gave us a thought to design something that would automate the above process and also make it efficient.
This very need led to the creation of CodeStreet that would ease the process of conducting programming competitions.

Some of the advantages of CodeStreet
1. Independent Online Compiler
2. Results include the Time and Space calculations.
3. Used ACE editor that would work as an I.D.E.
4. Manages load on the system by auto-terminating the indefinitely waiting processes(that might have been created by users intentionally/unintentionally.
5. Customizable code editor theme.
6. Simplified Test creation experience.

-------------------------------------------------------------------------------------------------------------------------------------------
Scripts to create database and tables.
----------------------------------------
-- Host: 127.0.0.1
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codestreet`
--
CREATE DATABASE IF NOT EXISTS `codestreet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `codestreet`;

-- --------------------------------------------------------

--
-- Table structure for table `q2tcmap`
--

CREATE TABLE `q2tcmap` (
  `qid` int(40) NOT NULL,
  `tcid` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(40) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question` varchar(2000) NOT NULL,
  `input_desc` varchar(500) NOT NULL,
  `output_desc` varchar(500) NOT NULL,
  `constraints` varchar(200) NOT NULL,
  `ex_input` varchar(500) NOT NULL,
  `ex_output` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t2qmap`
--

CREATE TABLE `t2qmap` (
  `testid` int(40) NOT NULL,
  `qid` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testcases`
--

CREATE TABLE `testcases` (
  `tcid` int(40) NOT NULL,
  `inputstream` varchar(1000) NOT NULL,
  `outputstream` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `testid` int(40) NOT NULL,
  `testname` varchar(100) NOT NULL,
  `no_of_ques` int(10) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(10) NOT NULL COMMENT 'Duration in mins',
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `uid` varchar(40) NOT NULL,
  `password` varchar(400) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `branch` varchar(6) NOT NULL,
  `year` varchar(1) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `admin` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `q2tcmap`
--
ALTER TABLE `q2tcmap`
  ADD PRIMARY KEY (`qid`,`tcid`),
  ADD KEY `tcid_fkey` (`tcid`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `t2qmap`
--
ALTER TABLE `t2qmap`
  ADD PRIMARY KEY (`testid`,`qid`),
  ADD KEY `qid_fkey` (`qid`);

--
-- Indexes for table `testcases`
--
ALTER TABLE `testcases`
  ADD PRIMARY KEY (`tcid`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`testid`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`uid`);


--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `testcases`
--
ALTER TABLE `testcases`
  MODIFY `tcid` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `testid` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for table `q2tcmap`
--
ALTER TABLE `q2tcmap`
  ADD CONSTRAINT `qid_fkey2` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`),
  ADD CONSTRAINT `tcid_fkey` FOREIGN KEY (`tcid`) REFERENCES `testcases` (`tcid`);

--
-- Constraints for table `t2qmap`
--
ALTER TABLE `t2qmap`
  ADD CONSTRAINT `qid_fkey` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`),
  ADD CONSTRAINT `testid_fkey` FOREIGN KEY (`testid`) REFERENCES `tests` (`testid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
