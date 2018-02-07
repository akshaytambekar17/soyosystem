-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2018 at 02:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aspirevision_syo`
--
CREATE DATABASE IF NOT EXISTS `aspirevision_syo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aspirevision_syo`;

-- --------------------------------------------------------

--
-- Table structure for table `project_data`
--

DROP TABLE IF EXISTS `project_data`;
CREATE TABLE `project_data` (
  `project_id` int(100) NOT NULL,
  `project_name` varchar(500) NOT NULL,
  `project_state` varchar(200) NOT NULL,
  `project_dist` varchar(200) NOT NULL,
  `project_city` varchar(200) NOT NULL,
  `sys_type` varchar(500) NOT NULL,
  `d_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `project_data`
--

TRUNCATE TABLE `project_data`;
--
-- Dumping data for table `project_data`
--

INSERT INTO `project_data` (`project_id`, `project_name`, `project_state`, `project_dist`, `project_city`, `sys_type`, `d_id`) VALUES
(1, 'Pump', 'Maharashtra', 'Pune', 'Pune', 'solar', '0'),
(2, 'AC', 'Maharashtra', 'Jalgoan', 'Jalgaon', 'Conditioner', '0'),
(3, '2', 'fdgdf', 'gfdgvf', 'gfg', 'gfg', 'gdfg'),
(4, 'dfgvfg', 'fgf', 'fgf', 'fg', 'gfgf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_device_param`
--

DROP TABLE IF EXISTS `soyo_device_param`;
CREATE TABLE `soyo_device_param` (
  `dvc_id` int(100) NOT NULL,
  `dev_imei` decimal(50,0) NOT NULL,
  `itv` float NOT NULL,
  `itc` float NOT NULL,
  `itp` float NOT NULL,
  `acv1` float NOT NULL,
  `acv2` float NOT NULL,
  `acv3` float NOT NULL,
  `acc1` float NOT NULL,
  `acc2` float NOT NULL,
  `acc3` float NOT NULL,
  `frq` float NOT NULL,
  `enrg` float NOT NULL,
  `lph` float NOT NULL,
  `temp` float NOT NULL,
  `sig_str` int(5) NOT NULL,
  `p_stat` int(5) NOT NULL,
  `nlc` int(5) NOT NULL,
  `drc` int(5) NOT NULL,
  `srt_ckt` int(5) NOT NULL,
  `x_heat` int(5) NOT NULL,
  `o_load` int(5) NOT NULL,
  `dcb_err` int(5) NOT NULL,
  `temp_sen_abst` int(5) NOT NULL,
  `emrg` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `soyo_device_param`
--

TRUNCATE TABLE `soyo_device_param`;
--
-- Dumping data for table `soyo_device_param`
--

INSERT INTO `soyo_device_param` (`dvc_id`, `dev_imei`, `itv`, `itc`, `itp`, `acv1`, `acv2`, `acv3`, `acc1`, `acc2`, `acc3`, `frq`, `enrg`, `lph`, `temp`, `sig_str`, `p_stat`, `nlc`, `drc`, `srt_ckt`, `x_heat`, `o_load`, `dcb_err`, `temp_sen_abst`, `emrg`) VALUES
(1, '866762020580492', 0, 0, 0, 45535, 34.88, 234, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '862118028689567', 0, 0, 0, 9875, 888, 234, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '813697485216932', 0, 0, 0, 3087, 546, 534, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '793145268315463', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '746982531498651', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, '865479315874236', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '697521364892167', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_notification`
--

DROP TABLE IF EXISTS `soyo_notification`;
CREATE TABLE `soyo_notification` (
  `note_id` int(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `send_to` int(100) NOT NULL,
  `send_from` int(100) NOT NULL,
  `type` int(10) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `soyo_notification`
--

TRUNCATE TABLE `soyo_notification`;
--
-- Dumping data for table `soyo_notification`
--

INSERT INTO `soyo_notification` (`note_id`, `message`, `send_to`, `send_from`, `type`, `status`) VALUES
(1, 'vdfg fgvdfv has registered. Waiting for your response.', 1, 8, 1, 0),
(2, 'Saniya Sharmahas registered. Waiting for your response.', 1, 10, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_users`
--

DROP TABLE IF EXISTS `soyo_users`;
CREATE TABLE `soyo_users` (
  `user_id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `dist` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `mobile` decimal(10,0) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `adhar` int(16) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(6) NOT NULL,
  `type` int(3) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `soyo_users`
--

TRUNCATE TABLE `soyo_users`;
--
-- Dumping data for table `soyo_users`
--

INSERT INTO `soyo_users` (`user_id`, `fname`, `lname`, `state`, `dist`, `city`, `mobile`, `email`, `username`, `password`, `adhar`, `date`, `time`, `type`, `status`) VALUES
(1, 'Admin', 'Soyo', 'Maharashtra', 'Pune', 'Pune', '9876543213', 'info@gmail.com', 'admin', 'admin@123', 0, '0000-00-00', '00:00:', 1, 0),
(2, 'karishma', 'kawate', 'Maharashtra', 'Jalgoan', 'Pune', '9156886093', 'karishma6.kawat@gmail.com', 'kk', 'kk', 0, '2018-01-25', '07:32 ', 2, 0),
(3, 'test', 'test', 'Maharashtra', 'Jalgoan', 'Bhusawal', '9156886093', 'test@gamil.com', 'test', 'test123', 0, '2018-01-26', '12:37 ', 3, 0),
(4, 'Reshma', 'Narkhede', 'Maharashtra', 'Jalgoan', 'Jalgaon', '9458699068', 'reshma@gmail.com', 'reshma', 'reshma', 0, '2018-01-26', '12:41 ', 2, 0),
(5, 'vishal', 'Kawate', 'Maharashtra', 'Jalgoan', 'Bhusawal', '7986543215', 'vish@gmail.com', 'vish', 'vish', 0, '2018-01-26', '12:44 ', 3, 0),
(6, 'Yash', 'Khadke', 'Maharashtra', 'Jalgoan', 'Jalgaon', '8765432187', 'yash@gmail.com', 'yash', 'yash', 0, '2018-01-26', '12:54 ', 2, 0),
(7, 'gfg', 'fgf', 'Maharashtra', 'fghhg', 'hb', '8765432187', 'karishma6.kawat@gmail.com', 'jkjk', 'jkjk', 0, '2018-02-02', '05:26 ', 2, 0),
(8, 'ved', 'gfdgdf', 'fgvdfv', 'cvcvfd', 'fvd', '8765432187', 'hema1007@gmail.com', 'asas', 'asas', 0, '2018-02-02', '05:29 ', 2, 0),
(10, 'Saniya', 'Sharma', 'Maharashtra', 'Pune', 'Pune', '9458699068', 'saniya@gmail.com', 'saniya', 'saniya', 0, '2018-02-02', '07:01 ', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_user_system`
--

DROP TABLE IF EXISTS `soyo_user_system`;
CREATE TABLE `soyo_user_system` (
  `sys_id` int(10) NOT NULL,
  `sys_imei` decimal(50,0) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `soyo_user_system`
--

TRUNCATE TABLE `soyo_user_system`;
--
-- Dumping data for table `soyo_user_system`
--

INSERT INTO `soyo_user_system` (`sys_id`, `sys_imei`, `username`, `password`) VALUES
(1, '866762020580492', 'admin', 'admin@123'),
(2, '862118028689567', 'kk', 'kk123'),
(3, '813697485216932', 'vish', 'vish'),
(4, '793145268315463', 'pune', 'pune@123'),
(5, '746982531498651', 'karish', 'karish123'),
(6, '865479315874236', 'soyo', 'soyo@123'),
(7, '697521364892167', 'system', 'sys@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_data`
--
ALTER TABLE `project_data`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `soyo_device_param`
--
ALTER TABLE `soyo_device_param`
  ADD PRIMARY KEY (`dvc_id`);

--
-- Indexes for table `soyo_notification`
--
ALTER TABLE `soyo_notification`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `soyo_users`
--
ALTER TABLE `soyo_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `soyo_user_system`
--
ALTER TABLE `soyo_user_system`
  ADD PRIMARY KEY (`sys_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_data`
--
ALTER TABLE `project_data`
  MODIFY `project_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `soyo_device_param`
--
ALTER TABLE `soyo_device_param`
  MODIFY `dvc_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_notification`
--
ALTER TABLE `soyo_notification`
  MODIFY `note_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `soyo_users`
--
ALTER TABLE `soyo_users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `soyo_user_system`
--
ALTER TABLE `soyo_user_system`
  MODIFY `sys_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
