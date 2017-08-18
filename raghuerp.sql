-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 03:38 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raghuerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `dp` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `reg_no`, `name`, `email`, `mobile`, `dp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@raghueducational.org', '8500373704', '', 1, '2017-06-13 02:00:00', '2017-06-15 05:11:10');

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `update_admins_timestamp` BEFORE UPDATE ON `admins` FOR EACH ROW BEGIN
Set New.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `college` varchar(5) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college`, `full_name`, `status`) VALUES
('REC', 'Raghu Engineering College', 1),
('RIT', 'Raghu Institute of Technology', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department` varchar(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `college` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department`, `full_name`, `college`, `status`) VALUES
('CSE', 'Computer Science and Engineering', 'REC', 1),
('ECE', 'Electronics and Communication Engineering', 'RIT', 1),
('EEE', 'Electrical and Electronics Engineering', 'RIT', 1),
('MECH', 'Mechanical Engineering', 'REC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation`, `status`) VALUES
('Assistant Professor', 1),
('Associate Professor', 1),
('Office Assistant', 1),
('Principal', 1),
('Professor', 1),
('System Administrator', 1),
('Technician', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_12_104039_create_personal_data_table', 1),
(4, '2017_06_13_051023_create_admins_table', 1),
(5, '2017_06_13_051146_create_staff_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `title` varchar(10) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dispname` varchar(15) DEFAULT NULL,
  `college` varchar(15) NOT NULL,
  `department` varchar(30) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `dp` varchar(30) DEFAULT NULL,
  `present_address` text,
  `permanent_address` text,
  `employment_type` varchar(20) NOT NULL,
  `pan` varchar(20) DEFAULT NULL,
  `aadhar` varchar(20) DEFAULT NULL,
  `passport` varchar(25) DEFAULT NULL,
  `dateob` date NOT NULL,
  `placeob` varchar(255) DEFAULT NULL,
  `stateob` varchar(50) DEFAULT NULL,
  `countryob` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `nationality` varchar(30) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `caste` varchar(30) DEFAULT NULL,
  `roll` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `reg_no`, `title`, `firstname`, `lastname`, `dispname`, `college`, `department`, `designation`, `qualification`, `email`, `mobile`, `dp`, `present_address`, `permanent_address`, `employment_type`, `pan`, `aadhar`, `passport`, `dateob`, `placeob`, `stateob`, `countryob`, `gender`, `nationality`, `religion`, `caste`, `roll`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RECCSE001', '', 'Cse Hod', 'Faculty', 'CseHod', 'REC', 'CSE', 'Professor', 'Ph.D.', 'cse_hod@raghuenggcollege.com', '9859852589', '', 'Raghu Engineering College', 'madhurawada', '', '', '', '', '1975-06-05', '', '', '', '', '', '', '', '', 0, '2017-06-14 02:00:00', '2017-06-19 06:05:58');

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `update_staff_timestamp` BEFORE UPDATE ON `staff` FOR EACH ROW BEGIN
Set New.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(6) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `dispname` varchar(15) NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `fathername` varchar(255) DEFAULT NULL,
  `mothername` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `dp` varchar(30) DEFAULT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text,
  `aadhar` varchar(20) DEFAULT NULL,
  `dob` date NOT NULL,
  `placeob` varchar(255) DEFAULT NULL,
  `stateob` varchar(255) DEFAULT NULL,
  `countryob` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `nationality` varchar(30) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `caste` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `dispname`, `reg_no`, `fathername`, `mothername`, `email`, `mobile`, `dp`, `present_address`, `permanent_address`, `aadhar`, `dob`, `placeob`, `stateob`, `countryob`, `gender`, `nationality`, `religion`, `caste`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vinay', 'Kumar', 'Vinay', '125CSE895', '', '', 'cse_student@raghuenggcollege.com', '9879875850', '', 'Raghu Engineering College', 'NAD Kotha Road', '', '1999-08-05', '', '', '', 'M', '', '', '', 1, '2017-06-15 00:00:00', '2017-06-15 00:00:00');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `update_students_timestamp` BEFORE UPDATE ON `students` FOR EACH ROW BEGIN
Set New.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_no` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `utype` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `reg_no`, `password`, `utype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'b1a5b64256e27fa5ae76d62b95209ab3', 'adm', '1234', '2017-06-13 02:00:00', '2017-06-13 02:00:00'),
(2, 'CseHod', 'RECCSE001', 'b1a5b64256e27fa5ae76d62b95209ab3', 'stf', '1235', '2017-06-14 12:29:29', '2017-06-14 12:29:29'),
(3, 'Vinay Kumar', '125CSE895', 'b1a5b64256e27fa5ae76d62b95209ab3', 'std', '1236', '2017-06-14 13:27:30', '2017-06-14 13:27:30');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `update_users_timestamp` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
Set New.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD UNIQUE KEY `college` (`college`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD UNIQUE KEY `designation` (`designation`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_empid_unique` (`reg_no`),
  ADD UNIQUE KEY `staff_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;








//raghu erp mess


-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 02:49 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raghuerp_mess`
--

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `mid` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `item_type` varchar(24) DEFAULT NULL,
  `latest_in` int(8) NOT NULL,
  `latest_out` int(8) NOT NULL,
  `total_balance` int(8) NOT NULL,
  `last_in_updated` datetime DEFAULT NULL,
  `last_out_updated` date DEFAULT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0-inactive, 1-active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`mid`, `item`, `item_type`, `latest_in`, `latest_out`, `total_balance`, `last_in_updated`, `last_out_updated`, `status`) VALUES
(1, 'Rice', 'food', 100, 10, -70, NULL, '2017-08-17', 1),
(2, 'Oil', 'kitchen', 20, 3, 30, '2017-08-17 05:59:23', '2017-08-17', 0),
(3, 'Onions', 'vegatables', 2, 32, 0, '2017-08-17 05:54:48', '2017-08-17', 1),
(4, 'Potatos', 'vegatables', 0, 0, 0, NULL, NULL, 1),
(5, 'bringals', 'vegatables', 0, 0, 0, NULL, NULL, 1),
(6, 'dall', 'food', 5, 5, 30, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_list`
--

CREATE TABLE `menu_list` (
  `id` int(10) NOT NULL,
  `mday` varchar(20) NOT NULL,
  `breakfast` varchar(50) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `snacks` varchar(50) NOT NULL,
  `dinner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`id`, `mday`, `breakfast`, `lunch`, `snacks`, `dinner`) VALUES
(1, 'Sunday', 'idly and onion dosa', 'Tindoora fry,rice,dal,sambar', 'biscuits & bajji', 'curd rice'),
(2, 'Monday', 'puri and dosa', 'potato fry,sambar,rice,chutney', 'samosa ,tea', 'curd rice ,sambar rice & fry'),
(3, 'Tuesday', ' upma  and bajji', 'tomato dal, brinjal curry,sambar,rice', 'bajji and groundnuts', 'curd rice and chapathi'),
(6, 'wednesday', 'vada and pongal', 'fry.tomato pappu, and sambar', 'samosa', 'curd rice and  potato fry'),
(7, 'Thursday', ' dosa and idly', 'lady''s finger curry,sambar,rice  and curd', 'mirchi bajji and tea', 'curd rice and sambar'),
(8, 'Friday', 'pesarattu dosa and upma', 'carrot curry,sambar,mango pappu and rice', 'biscuits and milk', 'curd rice and chapathi'),
(9, 'Saturday', 'rava dosa ', 'brinjal curry,sambar, and curd rice', 'samosa', 'veg birayani ');

-- --------------------------------------------------------

--
-- Table structure for table `stock_register`
--

CREATE TABLE `stock_register` (
  `srid` int(50) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `item` varchar(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `units` varchar(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `edate` date NOT NULL,
  `slot_type` varchar(10) NOT NULL,
  `trans_type` varchar(3) NOT NULL COMMENT 'IN, OUT',
  `insert_dt` datetime DEFAULT CURRENT_TIMESTAMP,
  `balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_register`
--

INSERT INTO `stock_register` (`srid`, `reg_no`, `item`, `quantity`, `units`, `price`, `edate`, `slot_type`, `trans_type`, `insert_dt`, `balance`) VALUES
(1, '', '1', 15, '', 500.00, '2017-08-08', '', 'IN', '2017-08-08 10:54:06', 0),
(2, '', '1', 50, '', 1500.00, '2017-08-08', '', 'IN', '2017-08-08 10:55:47', 0),
(3, '', '2', 5, '', 350.00, '2017-08-10', '', 'IN', '2017-08-08 10:59:14', 0),
(4, '', '1', 15, '', 0.00, '2017-08-09', 'Lunch', 'Out', '2017-08-08 11:27:52', 0),
(5, '', '1', 50, '', 1560.00, '2017-08-09', '', 'IN', '2017-08-08 11:35:47', 0),
(6, '', '2', 50, '', 3850.00, '2017-08-09', '', 'IN', '2017-08-08 11:35:47', 0),
(7, '', '3', 16, '', 200.00, '2017-08-01', '', 'IN', '2017-08-11 10:49:12', 0),
(8, '', '1', 10, '', 0.00, '2017-08-11', 'Lunch', 'Out', '2017-08-11 10:50:03', 0),
(9, '', '2', 2, '', 0.00, '2017-08-11', 'Lunch', 'Out', '2017-08-11 10:50:03', 0),
(10, '', '3', 5, '', 0.00, '2017-08-11', 'Lunch', 'Out', '2017-08-11 10:50:03', 0),
(11, '', '2', 1, '', 0.00, '2017-08-09', 'Snacks', 'Out', '2017-08-11 11:08:23', 0),
(27, '', '4', 4, '', 0.00, '2017-08-13', 'Snacks', 'Out', '2017-08-14 09:32:15', 0),
(29, 'RECCSE001', '1', 5, '', 0.00, '2017-08-30', 'Lunch', 'Out', '2017-08-14 10:42:01', 0),
(30, 'admin', '3', 2, '', 150.00, '2017-08-08', '', 'IN', '2017-08-14 10:46:22', 0),
(31, 'admin', '1', 100, '', 250.00, '2017-08-13', '', 'IN', '2017-08-14 10:49:29', 0),
(32, 'admin', '2', 10, '', 550.00, '2017-08-13', '', 'IN', '2017-08-14 10:49:29', 0),
(33, 'admin', '4', 2, '', 20.00, '2017-08-22', '', 'IN', '2017-08-14 14:11:03', 0),
(34, 'admin', '3', 2, '', 20.00, '2017-08-14', '', 'IN', '2017-08-17 15:50:10', 0),
(37, 'admin', '2', 2, '', 620.00, '2017-07-31', '', 'IN', '2017-08-17 16:41:14', 0),
(38, 'admin', '2', 2, '', 0.00, '2017-08-15', 'Lunch', 'Out', '2017-08-17 16:41:40', 0),
(39, '', '2', 2, 'litres', 200.00, '2017-08-02', '', 'IN', '2017-08-17 17:57:36', 10),
(40, '', '2', 20, 'litres', 2000.00, '2017-08-16', '', 'IN', '2017-08-17 17:59:23', 30),
(41, '', '1', 50, 'kgs', 0.00, '2017-08-16', 'Lunch', 'Out', '2017-08-17 18:05:12', -50),
(42, '', '1', 10, 'kgs', 0.00, '2017-08-07', 'Lunch', 'Out', '2017-08-17 18:05:44', -60),
(43, '', '1', 10, 'kgs', 0.00, '2017-08-01', 'Lunch', 'Out', '2017-08-17 18:06:55', -70);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `menu_list`
--
ALTER TABLE `menu_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_register`
--
ALTER TABLE `stock_register`
  ADD PRIMARY KEY (`srid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu_list`
--
ALTER TABLE `menu_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `stock_register`
--
ALTER TABLE `stock_register`
  MODIFY `srid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

