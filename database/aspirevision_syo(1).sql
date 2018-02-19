-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2018 at 03:46 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.2.1-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soyosystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_data`
--

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
-- Dumping data for table `project_data`
--

INSERT INTO `project_data` (`project_id`, `project_name`, `project_state`, `project_dist`, `project_city`, `sys_type`, `d_id`) VALUES
(1, 'Pump', 'Maharashtra', 'Pune', 'Pune', 'solar', '0'),
(2, 'AC', 'Maharashtra', 'Jalgoan', 'Jalgaon', 'Conditioner', '0'),
(3, '2', 'fdgdf', 'gfdgvf', 'gfg', 'gfg', 'gdfg'),
(4, 'dfgvfg', 'fgf', 'fgf', 'fg', 'gfgf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_device`
--

CREATE TABLE `soyo_device` (
  `id` bigint(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `drive_manufacture_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_device`
--

INSERT INTO `soyo_device` (`id`, `device_name`, `drive_manufacture_id`, `created_at`) VALUES
(3, '862118028689567', 3, ''),
(4, '866762020580492', 6, '2018-02-10 10:28:16am'),
(6, '813697485216932', 3, '2018-02-10 04:10:13pm'),
(7, 'Test device123', 0, '2018-02-12 11:27:18pm');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_device_param`
--

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
  `emrg` int(5) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_device_param`
--

INSERT INTO `soyo_device_param` (`dvc_id`, `dev_imei`, `itv`, `itc`, `itp`, `acv1`, `acv2`, `acv3`, `acc1`, `acc2`, `acc3`, `frq`, `enrg`, `lph`, `temp`, `sig_str`, `p_stat`, `nlc`, `drc`, `srt_ckt`, `x_heat`, `o_load`, `dcb_err`, `temp_sen_abst`, `emrg`, `user_id`) VALUES
(1, '4', 0, 0, 0, 45535, 34.88, 234, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14),
(2, '3', 0, 0, 0, 9875, 888, 234, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 14),
(3, '813697485216932', 0, 0, 0, 3087, 546, 534, 0, 0, 0, 0, 600.67, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '793145268315463', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '746982531498651', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, '865479315874236', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '697521364892167', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_device_paramters`
--

CREATE TABLE `soyo_device_paramters` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `device_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `unique_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_device_paramters`
--

INSERT INTO `soyo_device_paramters` (`id`, `name`, `device_id`, `category`, `unique_id`) VALUES
(13, 'acv1', 2, '', ''),
(14, 'new itv', 2, '', ''),
(15, 'acv4', 2, '', ''),
(16, 'engry', 1, '', ''),
(17, 'work', 1, '', ''),
(26, 'Energy Meter Comm unication', 3, '', 'F1'),
(27, 'EnergyMeter CBC', 3, '', 'F2'),
(28, 'Vo Mode', 3, '', 'F3'),
(29, 'Actual Energy', 3, '', 'P1'),
(30, 'VO mode Energy', 3, '', 'P2'),
(31, 'lnput Voltage R-Y', 3, '', 'P3'),
(32, 'Phase Voltage', 3, '', 'F4'),
(33, 'Energy Meter Comm unication', 4, '', 'F1'),
(34, 'Low Voltage', 6, '', 'F1'),
(35, 'System ON', 6, '', 'F2'),
(36, 'lnput Current B', 6, '', 'P1'),
(38, 'acce', 7, '', 'F1'),
(39, 'acce2', 7, '', 'F2');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_device_request`
--

CREATE TABLE `soyo_device_request` (
  `id` bigint(11) NOT NULL,
  `parameter` varchar(100) NOT NULL,
  `value` float NOT NULL,
  `imei` varchar(100) NOT NULL,
  `vfd_id` int(11) NOT NULL,
  `product_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_device_request`
--

INSERT INTO `soyo_device_request` (`id`, `parameter`, `value`, `imei`, `vfd_id`, `product_type`) VALUES
(1, 'F1', 100, '866762020580492', 3, 1),
(2, 'F2', 2345.91, '866762020580492', 3, 1),
(3, 'F3', 1098.09, '862118028689567', 3, 1),
(4, 'P1', 0.9, '866762020580492', 3, 1),
(5, 'P2', 8.9, '862118028689567', 3, 1),
(6, 'P3', 3, '862118028689567', 3, 1),
(7, 'F4', 1, '862118028689567', 3, 1),
(8, 'F1', 100, '862118028689567', 3, 1),
(9, 'F2', 2345.91, '862118028689567', 3, 1),
(10, 'F3', 1098.09, '862118028689567', 3, 1),
(11, 'P1', 0.9, '862118028689567', 3, 1),
(12, 'P2', 8.9, '862118028689567', 3, 1),
(13, 'P3', 3, '862118028689567', 3, 1),
(14, 'F4', 1, '862118028689567', 3, 1),
(15, 'F1', 100, '862118028689567', 3, 1),
(16, 'F2', 2345.91, '862118028689567', 3, 1),
(17, 'F3', 1098.09, '862118028689567', 3, 1),
(18, 'P1', 0.9, '862118028689567', 3, 1),
(19, 'P2', 8.9, '862118028689567', 3, 1),
(20, 'P3', 3, '862118028689567', 3, 1),
(21, 'F4', 1, '862118028689567', 3, 1),
(22, 'F1', 100, '862118028689567', 3, 1),
(23, 'F2', 2345.91, '862118028689567', 3, 1),
(24, 'F3', 1098.09, '862118028689567', 3, 1),
(25, 'P1', 0.9, '862118028689567', 3, 1),
(26, 'P2', 8.9, '862118028689567', 3, 1),
(27, 'P3', 3, '862118028689567', 3, 1),
(28, 'F4', 1, '862118028689567', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_district`
--

CREATE TABLE `soyo_district` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_district`
--

INSERT INTO `soyo_district` (`id`, `name`, `state_id`) VALUES
(1, 'Ahmednagar', 15),
(2, 'Akola', 15),
(3, 'Amravati', 15),
(4, 'Aurangabad', 15),
(5, 'Beed', 15),
(6, 'Bhandara', 15),
(7, 'Buldhana', 15),
(8, 'Chandrapur', 15),
(9, 'Dhule', 15),
(10, 'Gadchiroli', 15),
(11, 'Gondia', 15),
(12, 'Hingoli', 15),
(13, 'Jalgaon', 15),
(14, 'Jalna', 15),
(15, 'Kolhapur', 15),
(16, 'Latur', 15),
(17, 'Mumbai City', 15),
(18, 'Mumbai Suburban', 15),
(19, 'Nagpur', 15),
(20, 'Nanded', 15),
(21, 'Nandurbar', 15),
(22, 'Nashik', 15),
(23, 'Osmanabad', 15),
(24, 'Parbhani', 15),
(25, 'Pune', 15),
(26, 'Raigad', 15),
(27, 'Ratnagiri', 15),
(28, 'Sangli', 15),
(29, 'Satara', 15),
(30, 'Sindhudurg', 15),
(31, 'Solapur', 15),
(32, 'Thane', 15),
(33, 'Wardha', 15),
(34, 'Washim', 15),
(35, 'Yavatmal', 15),
(36, 'Palghar', 15);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_drive_manufacture`
--

CREATE TABLE `soyo_drive_manufacture` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_drive_manufacture`
--

INSERT INTO `soyo_drive_manufacture` (`id`, `name`) VALUES
(1, 'Nord Drive Systems Pvt. Ltd.'),
(2, 'Srijan Control Drives'),
(3, 'Chemco Group of Companies'),
(4, 'Powercare Corporation'),
(5, 'Gennext Control, India'),
(6, 'Hyco Drive Company'),
(7, 'Drive Technologies');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_notification`
--

CREATE TABLE `soyo_notification` (
  `id` int(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `send_to` int(100) NOT NULL,
  `send_from` int(100) NOT NULL,
  `type` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view` int(5) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_notification`
--

INSERT INTO `soyo_notification` (`id`, `message`, `send_to`, `send_from`, `type`, `status`, `user_id`, `view`, `created_at`) VALUES
(1, 'vdfg fgvdfv has registered. Waiting for your response.', 1, 8, 1, 0, 0, 1, ''),
(2, 'Saniya Sharmahas registered. Waiting for your response.', 1, 10, 1, 0, 0, 1, ''),
(3, 'Admin added new distributer Nikhil Vharamble', 1, 1, 0, 0, 17, 1, '2018-02-11 06:03:55pm'),
(4, 'akshay tambekar added new user akshay User tambekar user', 1, 14, 0, 0, 20, 1, '2018-02-15 10:54:19am'),
(5, 'akshay tambekar added new user test2 user surname user', 1, 14, 0, 0, 22, 1, '2018-02-15 10:57:52am'),
(6, 'Nikhil Vharamble added new user test2 user surname user', 1, 17, 0, 0, 27, 0, '2018-02-19 03:17:57pm');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_product`
--

CREATE TABLE `soyo_product` (
  `p_id` int(10) NOT NULL,
  `product_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `product_img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `soyo_product`
--

INSERT INTO `soyo_product` (`p_id`, `product_name`, `product_img`, `added_by`) VALUES
(2, 'Solar Water Pumping System', 'solar-water2.jpg', 1),
(3, 'Solar Off Grid Power Plant', 'solar-off-grid-power-plant1.jpg', 1),
(4, 'Solar Inverters', 'inverter2.jpg', 1),
(5, 'LED Garden Light', 'led-lights1.jpg', 1),
(6, '20 Kw Power Pack', 'battery1.jpg', 1),
(7, 'Offline UPS', 'ups1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_projects`
--

CREATE TABLE `soyo_projects` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `distributer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_projects`
--

INSERT INTO `soyo_projects` (`id`, `name`, `state_id`, `district_id`, `description`, `city`, `created_at`, `distributer_id`) VALUES
(1, 'Test project1', 15, 15, 'Test project description2', 'Kolhapur', '2018-02-19 12:23:17', 17);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_state`
--

CREATE TABLE `soyo_state` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_state`
--

INSERT INTO `soyo_state` (`id`, `name`, `country_id`) VALUES
(1, 'Andhra Pradesh', 82),
(2, 'Arunachal Pradesh', 82),
(3, 'Assam', 82),
(4, 'Bihar', 82),
(5, 'Chhattisgarh', 82),
(6, 'Goa', 82),
(7, 'Gujarat', 82),
(8, 'Haryana', 82),
(9, 'Himachal Pradesh', 82),
(10, 'Jammu and Kashmir', 82),
(11, 'Jharkhand', 82),
(12, 'Karnataka', 82),
(13, 'Kerala', 82),
(14, 'Madhya Pradesh', 82),
(15, 'Maharashtra', 82),
(16, 'Manipur', 82),
(17, 'Meghalaya', 82),
(18, 'Mizoram', 82),
(19, 'Nagaland', 82),
(20, 'Odisha', 82),
(21, 'Punjab', 82),
(22, 'Rajasthan', 82),
(23, 'Sikkim', 82),
(24, 'Tamil Nadu', 82),
(25, 'Telangana', 82),
(26, 'Tripura', 82),
(27, 'Uttar Pradesh', 82),
(28, 'Uttarakhand', 82),
(29, 'West Bengal', 82),
(30, 'Andaman and Nicobar Islands', 82),
(31, 'Chandigarh', 82),
(32, 'Dadra and Nagar Haveli', 82),
(33, 'Daman and Diu', 82),
(34, 'Delhi', 82),
(35, 'Lakshadweep', 82),
(36, 'Puducherry', 82);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_users`
--

CREATE TABLE `soyo_users` (
  `user_id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `dist` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `adhar` bigint(16) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL DEFAULT '00:00:00',
  `type` int(3) NOT NULL,
  `status` int(5) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `site_image` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_users`
--

INSERT INTO `soyo_users` (`user_id`, `fname`, `lname`, `state`, `dist`, `city`, `mobile`, `email`, `username`, `password`, `adhar`, `date`, `time`, `type`, `status`, `profile_image`, `added_by`, `address`, `site_image`, `created_at`, `project_id`) VALUES
(1, 'Admin', 'Soyo', '15', '25', 'Kolhapur', 9876543213, 'info@gmail.com', 'admin', 'admin@123', 0, '2018-01-25', '01:00:', 1, 0, 'admin2.png', 0, '', '', '', 0),
(2, 'karishma', 'kawate', '15', '25', 'Kolhapur', 9156886093, 'karishma6.kawat@gmail.com', 'kk', 'kk', 0, '2018-01-25', '07:32 ', 2, 0, 'debate_web_team.jpg', 0, '', '', '', 0),
(3, 'test', 'test', '15', '25', 'Bhusawal', 9156886093, 'test@gamil.com', 'test', 'test123', 0, '2018-01-26', '12:37 ', 3, 1, '400266_237783952963915_21745964_n.jpg', 0, 'pune', 'Image_Slider1.jpg', '', 0),
(5, 'vishal', 'Kawate', '15', '25', 'Bhusawal', 7986543215, 'vish@gmail.com', 'vish', 'vish', 0, '2018-01-26', '12:44 ', 3, 1, '', 0, '', '', '', 0),
(6, 'Yash', 'Khadke', 'Maharashtra', 'Jalgoan', 'Jalgaon', 8765432187, 'yash@gmail.com', 'yash', 'yash', 0, '2018-01-26', '12:54 ', 2, 0, '', 0, '', '', '', 0),
(8, 'ved', 'gfdgdf', 'fgvdfv', 'cvcvfd', 'fvd', 8765432187, 'hema1007@gmail.com', 'asas', 'asas', 0, '2018-02-02', '05:29 ', 2, 0, '', 0, '', '', '', 0),
(10, 'Saniya', 'Sharma', 'Maharashtra', 'Pune', 'Pune', 9458699068, 'saniya@gmail.com', 'saniya', 'saniya', 0, '2018-02-02', '07:01 ', 3, 1, '', 0, '', '', '', 0),
(17, 'Nikhil', 'Vharamble', '15', '25', 'Pune', 12345678901, 'niks@gmail.com', 'niks', '12345', 0, '2018-02-11', '06:03:55pm', 2, 1, 'ERP_slider2.jpg', 0, '', '', '', 0),
(19, 'test1', 'test1', '15', '25', 'Pune', 7789456213, 'test@gmail.com', 'testuser1', '12345', 78, '2018-02-11', '06:03:55pm', 3, 1, 'images1.jpeg', 2, 'pune', 'images2.jpeg', '2018-02-13 12:45:55pm', 0),
(20, 'akshay User', 'tambekar user', '15', '25', 'pune', 12345678901, 'akitambekar17@gmail.com', 'akshayuser', '123456', 0, '2018-02-15', '10:54:19am', 3, 1, 'admin5.png', 14, 'pune', 'Image_Slider2.jpg', '2018-02-15 10:54:19am', 0),
(22, 'test2 user', 'surname user', '15', '25', 'pune', 12345678901, 'test2@gmail.com', 'test2 user', '12345', 0, '2018-02-15', '10:57:52am', 3, 0, 'ERP_slider4.jpg', 14, 'pune', 'Team_Velociracers___website_photo8.jpg', '2018-02-15 10:57:52am', 0),
(27, 'test2 user', 'surname user', '15', '3', 'amrabati', 12345678901, 'test2@gmail.com', 'test2user', 'test', 1234567890123456, '2018-02-19', '03:17:57pm', 3, 0, 'coepfinal1.jpg', 17, 'amrvati', '', '2018-02-19 03:17:57pm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `soyo_user_site_information`
--

CREATE TABLE `soyo_user_site_information` (
  `id` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `solar_panel` varchar(255) NOT NULL,
  `pump` varchar(255) NOT NULL,
  `no_lbows` varchar(255) NOT NULL,
  `installer` varchar(255) NOT NULL,
  `installation_date` datetime NOT NULL,
  `warranty` varchar(255) NOT NULL,
  `imei_no` varchar(255) NOT NULL,
  `device_type` int(11) NOT NULL,
  `vfd_type` int(11) NOT NULL,
  `pipe_height` varchar(255) NOT NULL,
  `pipe_diameter` varchar(255) NOT NULL,
  `site_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_user_site_information`
--

INSERT INTO `soyo_user_site_information` (`id`, `user_id`, `location`, `owner`, `solar_panel`, `pump`, `no_lbows`, `installer`, `installation_date`, `warranty`, `imei_no`, `device_type`, `vfd_type`, `pipe_height`, `pipe_diameter`, `site_image`) VALUES
(1, 19, 'pune', 'dist', 'a1', 'solar', '43', 'distributerdsd', '2018-02-13 12:45:55', '2sd', '123456789', 6, 3, '21', '43', ''),
(2, 20, 'pune', 'owener', 'solar panel', 'pump', '5', 'Akshay', '2018-02-15 10:54:19', '2', '866762020580492', 6, 2, '15', '24', ''),
(3, 22, 'pune', 'owener', 'solar panel', 'pump', '5', 'Akshay', '2018-02-15 10:57:52', '2', '0987654321s', 3, 2, '15', '24', '');

-- --------------------------------------------------------

--
-- Table structure for table `soyo_user_system`
--

CREATE TABLE `soyo_user_system` (
  `sys_id` int(10) NOT NULL,
  `sys_imei` decimal(50,0) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `soyo_vfd`
--

CREATE TABLE `soyo_vfd` (
  `id` bigint(11) NOT NULL,
  `vfd_name` varchar(255) NOT NULL,
  `drive_manufacture_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soyo_vfd`
--

INSERT INTO `soyo_vfd` (`id`, `vfd_name`, `drive_manufacture_id`, `created_at`) VALUES
(1, 'VFD 1', 2, '2018-02-12 11:06:32pm'),
(2, 'Testing vfd', 2, '2018-02-16 10:55:20pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_data`
--
ALTER TABLE `project_data`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `soyo_device`
--
ALTER TABLE `soyo_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_device_param`
--
ALTER TABLE `soyo_device_param`
  ADD PRIMARY KEY (`dvc_id`);

--
-- Indexes for table `soyo_device_paramters`
--
ALTER TABLE `soyo_device_paramters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id_fk` (`device_id`);

--
-- Indexes for table `soyo_device_request`
--
ALTER TABLE `soyo_device_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_district`
--
ALTER TABLE `soyo_district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_drive_manufacture`
--
ALTER TABLE `soyo_drive_manufacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_notification`
--
ALTER TABLE `soyo_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_product`
--
ALTER TABLE `soyo_product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `soyo_projects`
--
ALTER TABLE `soyo_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_state`
--
ALTER TABLE `soyo_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_users`
--
ALTER TABLE `soyo_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `soyo_user_site_information`
--
ALTER TABLE `soyo_user_site_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soyo_user_system`
--
ALTER TABLE `soyo_user_system`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `soyo_vfd`
--
ALTER TABLE `soyo_vfd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_data`
--
ALTER TABLE `project_data`
  MODIFY `project_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `soyo_device`
--
ALTER TABLE `soyo_device`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_device_param`
--
ALTER TABLE `soyo_device_param`
  MODIFY `dvc_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_device_paramters`
--
ALTER TABLE `soyo_device_paramters`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `soyo_device_request`
--
ALTER TABLE `soyo_device_request`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `soyo_district`
--
ALTER TABLE `soyo_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `soyo_drive_manufacture`
--
ALTER TABLE `soyo_drive_manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_notification`
--
ALTER TABLE `soyo_notification`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `soyo_product`
--
ALTER TABLE `soyo_product`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_projects`
--
ALTER TABLE `soyo_projects`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `soyo_state`
--
ALTER TABLE `soyo_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `soyo_users`
--
ALTER TABLE `soyo_users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `soyo_user_site_information`
--
ALTER TABLE `soyo_user_site_information`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `soyo_user_system`
--
ALTER TABLE `soyo_user_system`
  MODIFY `sys_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soyo_vfd`
--
ALTER TABLE `soyo_vfd`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
