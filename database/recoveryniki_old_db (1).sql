-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 08:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recoveryniki_old_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_history`
--

CREATE TABLE `action_history` (
  `id` int(11) NOT NULL,
  `case_register_id` int(11) NOT NULL,
  `action_title` varchar(256) DEFAULT NULL,
  `action_description` varchar(1024) DEFAULT NULL,
  `visibility_type` varchar(10) DEFAULT NULL,
  `action_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `bizrule` text DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_itemchild`
--

CREATE TABLE `auth_itemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `case_register`
--

CREATE TABLE `case_register` (
  `id` int(11) NOT NULL,
  `device_serial_number` varchar(30) NOT NULL,
  `device_internal_serial_number` varchar(20) DEFAULT NULL,
  `device_maker_id` int(11) DEFAULT NULL,
  `device_model` varchar(25) DEFAULT NULL,
  `device_firmware` varchar(15) DEFAULT NULL,
  `device_mlc` varchar(20) DEFAULT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `device_size` varchar(10) DEFAULT NULL,
  `crash_type` varchar(10) DEFAULT NULL,
  `inward_remarks` varchar(2048) DEFAULT NULL,
  `outward_remarks` varchar(2048) DEFAULT NULL,
  `customer_remarks` varchar(512) NOT NULL,
  `files_to_recover` varchar(512) DEFAULT NULL,
  `service_options` varchar(10) DEFAULT NULL,
  `case_register_state` tinyint(4) NOT NULL COMMENT 'will store only (in, out, register) ',
  `case_status` tinyint(4) NOT NULL COMMENT 'case status (OPEN,INPROCESS,PROCESSED<CLOSED)',
  `case_result` tinyint(4) NOT NULL COMMENT 'value should be(WIN,LOSS)',
  `estimate_amount` float DEFAULT NULL,
  `estimate_approved_by_customer` tinyint(4) DEFAULT NULL,
  `case_received_date` datetime DEFAULT NULL,
  `case_return_date` datetime DEFAULT NULL,
  `sd_hddno` varchar(20) NOT NULL,
  `sd_size` varchar(12) NOT NULL,
  `sd_remarks` varchar(256) NOT NULL,
  `st_logic_cards_status` tinyint(4) NOT NULL,
  `st_hdd_assembly_status` tinyint(4) NOT NULL,
  `st_location` varchar(25) NOT NULL,
  `case_created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city_location`
--

CREATE TABLE `city_location` (
  `id` int(11) NOT NULL,
  `city_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `customer_primary_email_id` varchar(60) NOT NULL,
  `customer_mobile_no1` varchar(15) NOT NULL,
  `customer_mobile_no2` varchar(15) DEFAULT NULL,
  `office_phone` varchar(15) DEFAULT NULL,
  `office_fax` varchar(15) DEFAULT NULL,
  `customer_alt_email_id` varchar(60) DEFAULT NULL,
  `office_addressline` varchar(100) DEFAULT NULL,
  `customer_city_location` int(11) DEFAULT NULL,
  `shipping_addressline` varchar(100) DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_manufacturer`
--

CREATE TABLE `device_manufacturer` (
  `id` int(11) NOT NULL,
  `manufacturer_name` varchar(30) NOT NULL,
  `sort_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_name` varchar(60) NOT NULL,
  `employee_email_id` varchar(60) NOT NULL,
  `employee_mobile_no1` varchar(15) NOT NULL,
  `employee_mobile_no2` varchar(15) DEFAULT NULL,
  `employee_city_location` int(11) NOT NULL,
  `employee_created_dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `problem_issues`
--

CREATE TABLE `problem_issues` (
  `id` int(11) NOT NULL,
  `problem_no` varchar(20) DEFAULT NULL,
  `problem_title` varchar(100) DEFAULT NULL,
  `problem_description` varchar(512) DEFAULT NULL,
  `problem_solution` varchar(512) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `lastlogin_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

INSERT INTO `user` (`id`, `username`, `password`, `user_type`, `is_active`, `lastlogin_time`) VALUES
(1, 'superadmin', '123456', 'SuperAdmin', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_history`
--
ALTER TABLE `action_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `auth_itemchild`
--
ALTER TABLE `auth_itemchild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `case_register`
--
ALTER TABLE `case_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_location`
--
ALTER TABLE `city_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_manufacturer`
--
ALTER TABLE `device_manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_email_id` (`employee_email_id`);

--
-- Indexes for table `problem_issues`
--
ALTER TABLE `problem_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`itemname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_history`
--
ALTER TABLE `action_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `case_register`
--
ALTER TABLE `case_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city_location`
--
ALTER TABLE `city_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_manufacturer`
--
ALTER TABLE `device_manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problem_issues`
--
ALTER TABLE `problem_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_itemchild`
--
ALTER TABLE `auth_itemchild`
  ADD CONSTRAINT `auth_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
