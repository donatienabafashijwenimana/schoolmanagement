-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 09:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `class_name` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(000, 'l5soda'),
(001, 'l5sodb'),
(007, 'l3sod'),
(008, 'l4mlm'),
(009, 'l3mlm');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `dept_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(002, 'ict'),
(003, 'construction'),
(005, 'finance'),
(006, 'telecomunication'),
(007, 'electricity');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `l_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `lname` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`l_id`, `lname`) VALUES
(001, 'level3'),
(004, 'level4'),
(005, 'level5');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_code` varchar(22) NOT NULL,
  `module_name` varchar(222) NOT NULL,
  `dept_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_code`, `module_name`, `dept_id`) VALUES
('008', 'algorithm', 003),
('0099', 'programming', 002),
('654545', 'cost estimation', 005),
('tx001', 'taxation', 005);

-- --------------------------------------------------------

--
-- Table structure for table `mod_trade_tr`
--

CREATE TABLE `mod_trade_tr` (
  `ass_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `module_code` varchar(22) NOT NULL,
  `trede_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `tr_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mod_trade_tr`
--

INSERT INTO `mod_trade_tr` (`ass_id`, `module_code`, `trede_id`, `tr_id`) VALUES
(001, '654545', 006, 018),
(002, 'tx001', 006, 018),
(003, 'tx001', 008, 018),
(004, '0099', 001, 019);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `result_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `t_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `module_code` varchar(22) DEFAULT NULL,
  `trede_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `marks` int(11) NOT NULL,
  `overmarks` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`result_id`, `t_id`, `module_code`, `trede_id`, `marks`, `overmarks`, `type`) VALUES
(001, 012, 'tx001 ', 006, 8, 10, 'ass1'),
(002, 013, 'tx001 ', 006, 15, 10, 'ass1'),
(003, 014, 'tx001 ', 006, 17, 10, 'ass1'),
(004, 015, 'tx001 ', 006, 21, 10, 'ass1');

-- --------------------------------------------------------

--
-- Table structure for table `trade`
--

CREATE TABLE `trade` (
  `trede_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `trede_name` varchar(25) NOT NULL,
  `dept_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `l_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trade`
--

INSERT INTO `trade` (`trede_id`, `trede_name`, `dept_id`, `l_id`) VALUES
(001, 'sod', 002, 001),
(002, 'mas', 003, 001),
(003, 'els', 006, 001),
(004, 'etel', 006, 001),
(005, 'etel', 006, 004),
(006, 'acc', 005, 001),
(007, 'rct', 003, 001),
(008, 'acc', 005, 004);

-- --------------------------------------------------------

--
-- Table structure for table `trainee`
--

CREATE TABLE `trainee` (
  `t_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `fname` varchar(222) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `trade_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainee`
--

INSERT INTO `trainee` (`t_id`, `fname`, `lname`, `trade_id`) VALUES
(010, 'prince', 'gitego', 001),
(011, 'fabrice', 'ishimwe', 001),
(012, 'jmv', 'kanamugire', 006),
(013, 'rebecca', 'uwiwnwza', 006),
(014, 'olivier', 'ndizeye', 006),
(015, 'alex', 'kayisisre', 006),
(016, 'kevin', 'gikundiro', 001);

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `tr_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `tr_fname` varchar(222) NOT NULL,
  `tr_lname` varchar(2222) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dept_id` int(3) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`tr_id`, `tr_fname`, `tr_lname`, `email`, `dept_id`) VALUES
(017, 'donatien', 'abafashijwenimana', 'doanaabafashijwe@gmail.com', 007),
(018, 'egide', 'iragena', 'iraegi@gmail.com', 005),
(019, 'fabrice', 'ishimwe', 'ishi@gmail.com', 002),
(020, 'gitego', 'prince', 'gitepri@gmail.com', 005);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(222) NOT NULL,
  `role` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `password`) VALUES
(000, 'fidele', 'dos', '12345'),
(004, 'gatorepatrick', 'STUDENT', '123'),
(017, 'abafashijwedonatien', 'TRAINER', '123'),
(018, 'egiiragena', 'TRAINER', '1212'),
(019, 'fabish', 'TRAINER', '1212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_code`),
  ADD KEY `class_id` (`dept_id`);

--
-- Indexes for table `mod_trade_tr`
--
ALTER TABLE `mod_trade_tr`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `module_code` (`module_code`),
  ADD KEY `mod_trade_tr_ibfk_2` (`trede_id`),
  ADD KEY `tr_id` (`tr_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `module_code` (`module_code`),
  ADD KEY `trede_id` (`trede_id`);

--
-- Indexes for table `trade`
--
ALTER TABLE `trade`
  ADD PRIMARY KEY (`trede_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `l_id` (`l_id`);

--
-- Indexes for table `trainee`
--
ALTER TABLE `trainee`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `class_id` (`trade_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `trainer_ibfk_1` (`dept_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `l_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mod_trade_tr`
--
ALTER TABLE `mod_trade_tr`
  MODIFY `ass_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `result_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trade`
--
ALTER TABLE `trade`
  MODIFY `trede_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `trainee`
--
ALTER TABLE `trainee`
  MODIFY `t_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `tr_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mod_trade_tr`
--
ALTER TABLE `mod_trade_tr`
  ADD CONSTRAINT `mod_trade_tr_ibfk_1` FOREIGN KEY (`module_code`) REFERENCES `module` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mod_trade_tr_ibfk_2` FOREIGN KEY (`trede_id`) REFERENCES `trade` (`trede_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mod_trade_tr_ibfk_3` FOREIGN KEY (`tr_id`) REFERENCES `trainer` (`tr_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`module_code`) REFERENCES `module` (`module_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`t_id`) REFERENCES `trainee` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_4` FOREIGN KEY (`trede_id`) REFERENCES `trade` (`trede_id`);

--
-- Constraints for table `trade`
--
ALTER TABLE `trade`
  ADD CONSTRAINT `trade_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trade_ibfk_2` FOREIGN KEY (`l_id`) REFERENCES `level` (`l_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainee`
--
ALTER TABLE `trainee`
  ADD CONSTRAINT `trainee_ibfk_1` FOREIGN KEY (`trade_id`) REFERENCES `trade` (`trede_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `trainer_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
