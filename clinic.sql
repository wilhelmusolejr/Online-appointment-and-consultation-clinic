-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 01:56 AM
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
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gender`
--

CREATE TABLE `tbl_gender` (
  `gender_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gender`
--

INSERT INTO `tbl_gender` (`gender_id`, `type`) VALUES
(2, 'female'),
(1, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status`) VALUES
(1, 'good'),
(2, 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact`
--

CREATE TABLE `tbl_transact` (
  `transact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `board_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact`
--

INSERT INTO `tbl_transact` (`transact_id`, `user_id`, `board_page`) VALUES
(1, 1, 4),
(116, 1, 2),
(117, 1, 3),
(118, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint`
--

CREATE TABLE `tbl_transact_appoint` (
  `appoint_id` int(11) NOT NULL,
  `transact_id` int(11) NOT NULL,
  `appoint_for` int(11) NOT NULL,
  `consult_info_id` int(11) DEFAULT NULL,
  `food_info_id` int(11) DEFAULT NULL,
  `physical_info_id` int(11) DEFAULT NULL,
  `medical_info_id` int(11) DEFAULT NULL,
  `appoint_date_submitted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint`
--

INSERT INTO `tbl_transact_appoint` (`appoint_id`, `transact_id`, `appoint_for`, `consult_info_id`, `food_info_id`, `physical_info_id`, `medical_info_id`, `appoint_date_submitted`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2023-02-06 03:34:47'),
(93, 105, 1, NULL, NULL, NULL, NULL, '2023-02-08 21:39:26'),
(94, 106, 1, NULL, NULL, NULL, NULL, '2023-02-08 21:42:07'),
(95, 107, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:30:47'),
(96, 108, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:31:43'),
(97, 109, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:35:11'),
(98, 110, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:35:17'),
(99, 111, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:35:57'),
(100, 112, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:42:02'),
(101, 113, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:45:31'),
(102, 114, 1, NULL, NULL, NULL, NULL, '2023-02-09 02:46:49'),
(103, 115, 1, NULL, NULL, NULL, NULL, '2023-02-09 03:23:29'),
(104, 116, 1, NULL, NULL, NULL, NULL, '2023-02-09 13:19:49'),
(105, 117, 1, NULL, NULL, NULL, NULL, '2023-02-09 13:52:15'),
(106, 118, 1, NULL, NULL, NULL, NULL, '2023-02-09 17:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_checkpoint_appoint_status`
--

CREATE TABLE `tbl_transact_appoint_checkpoint_appoint_status` (
  `appoint_checkpoint_appoint_status_id` int(11) NOT NULL,
  `transact_id` int(11) NOT NULL,
  `appoint_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_checkpoint_appoint_status`
--

INSERT INTO `tbl_transact_appoint_checkpoint_appoint_status` (`appoint_checkpoint_appoint_status_id`, `transact_id`, `appoint_status`) VALUES
(1, 1, 'APPROVED'),
(13, 105, 'PENDING'),
(14, 106, 'PENDING'),
(15, 107, 'PENDING'),
(16, 108, 'PENDING'),
(17, 109, 'PENDING'),
(18, 110, 'PENDING'),
(19, 111, 'PENDING'),
(20, 112, 'PENDING'),
(21, 113, 'PENDING'),
(22, 114, 'APPROVED'),
(23, 115, 'APPROVED'),
(24, 116, 'PENDING'),
(25, 117, 'APPROVED'),
(26, 118, 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_checkpoint_rnd_status`
--

CREATE TABLE `tbl_transact_appoint_checkpoint_rnd_status` (
  `appoint_checkpoint_rnd_status_id` int(11) NOT NULL,
  `transact_id` int(11) NOT NULL,
  `rnd_status` varchar(10) NOT NULL,
  `rnd_id` int(11) DEFAULT NULL COMMENT 'insert the id of the rnd (acts as an user id)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_checkpoint_rnd_status`
--

INSERT INTO `tbl_transact_appoint_checkpoint_rnd_status` (`appoint_checkpoint_rnd_status_id`, `transact_id`, `rnd_status`, `rnd_id`) VALUES
(1, 1, 'APPROVED', 4),
(12, 105, 'PENDING', NULL),
(13, 106, 'PENDING', NULL),
(14, 107, 'PENDING', NULL),
(15, 108, 'PENDING', NULL),
(16, 109, 'PENDING', NULL),
(17, 110, 'PENDING', NULL),
(18, 111, 'PENDING', NULL),
(19, 112, 'PENDING', NULL),
(20, 113, 'PENDING', NULL),
(21, 114, 'APPROVED', 3),
(22, 115, 'APPROVED', 1),
(23, 116, 'PENDING', NULL),
(24, 117, 'APPROVED', 6),
(25, 118, 'APPROVED', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_client`
--

CREATE TABLE `tbl_transact_appoint_client` (
  `client_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `mobile_num` varchar(20) NOT NULL,
  `email_add` varchar(20) NOT NULL,
  `relationship_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_client`
--

INSERT INTO `tbl_transact_appoint_client` (`client_id`, `appoint_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birthdate`, `mobile_num`, `email_add`, `relationship_status`) VALUES
(1, 1, 'Wilhelmus', 'Regondola', 'Ole', 1, '2001-11-11', '09972976807', 'test@gmail.com', 1),
(68, 93, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(69, 94, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(70, 95, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(71, 96, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(72, 97, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(73, 98, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(74, 99, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(75, 100, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(76, 101, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(77, 102, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(78, 103, 'Sum', '', 'Sum', 2, '2023-02-03', '09964523546', 'onthemakings@gmail.c', 0),
(79, 104, 'Test', 'Regondola', 'Client', 2, '2001-11-11', '09972976807', 'test@gmail.com', 0),
(80, 105, 'Test', 'Regondola', 'Client', 2, '2001-11-11', '09972976807', 'test@gmail.com', 0),
(81, 106, 'Test', 'Regondola', 'Client', 2, '2001-11-11', '09972976807', 'test@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_consult`
--

CREATE TABLE `tbl_transact_appoint_consult` (
  `consult_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `chief_complaint` varchar(255) NOT NULL,
  `appoint_date` date NOT NULL,
  `appoint_time` time NOT NULL,
  `referral_form_id` int(11) DEFAULT NULL,
  `medical_record_id` int(11) DEFAULT NULL,
  `appoint_more_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_consult`
--

INSERT INTO `tbl_transact_appoint_consult` (`consult_id`, `appoint_id`, `chief_complaint`, `appoint_date`, `appoint_time`, `referral_form_id`, `medical_record_id`, `appoint_more_info`) VALUES
(1, 1, 'Titeng galit', '2023-02-03', '00:12:00', 1, 1, 'More info test'),
(80, 93, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(81, 94, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(82, 95, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(83, 96, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(84, 97, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(85, 98, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(86, 99, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(87, 100, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(88, 101, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(89, 102, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(90, 103, 'tite', '2002-01-01', '01:00:00', 0, 0, ''),
(91, 104, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(92, 105, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, ''),
(93, 106, 'chief complaint test', '2002-01-01', '01:00:00', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food`
--

CREATE TABLE `tbl_transact_appoint_food` (
  `food_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `food_allergies_id` int(11) DEFAULT NULL,
  `food_like_id` int(11) DEFAULT NULL,
  `food_dislike_id` int(11) DEFAULT NULL,
  `type_diet_id` varchar(30) NOT NULL,
  `smoke_level_id` int(11) NOT NULL,
  `drink_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food`
--

INSERT INTO `tbl_transact_appoint_food` (`food_id`, `appoint_id`, `food_allergies_id`, `food_like_id`, `food_dislike_id`, `type_diet_id`, `smoke_level_id`, `drink_level_id`) VALUES
(1, 1, 1, 1, 1, '1', 2, 4),
(62, 93, NULL, NULL, NULL, 'food type diet test', 1, 2),
(63, 94, NULL, NULL, NULL, 'food type diet test', 1, 2),
(64, 95, NULL, NULL, NULL, 'food type diet test', 1, 2),
(65, 96, NULL, NULL, NULL, 'food type diet test', 1, 2),
(66, 97, NULL, NULL, NULL, 'food type diet test', 1, 2),
(67, 98, NULL, NULL, NULL, 'food type diet test', 1, 2),
(68, 99, NULL, NULL, NULL, 'food type diet test', 1, 2),
(69, 100, NULL, NULL, NULL, 'food type diet test', 1, 2),
(70, 101, NULL, NULL, NULL, 'food type diet test', 1, 2),
(71, 102, NULL, NULL, NULL, 'food type diet test', 1, 2),
(72, 103, NULL, NULL, NULL, 'food type diet test', 1, 2),
(73, 104, NULL, NULL, NULL, 'food type diet test', 5, 5),
(74, 105, NULL, NULL, NULL, 'food type diet test', 1, 2),
(75, 106, NULL, NULL, NULL, 'food type diet test', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food_allergy`
--

CREATE TABLE `tbl_transact_appoint_food_allergy` (
  `food_allergy_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `allergy_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food_allergy`
--

INSERT INTO `tbl_transact_appoint_food_allergy` (`food_allergy_id`, `appoint_id`, `allergy_name`) VALUES
(1, 1, 'allegy1'),
(3, 1, 'allegy2'),
(59, 81, 'food'),
(60, 81, 'allergy'),
(61, 81, 'test'),
(62, 82, 'food'),
(63, 82, 'allergy'),
(64, 82, 'test'),
(65, 91, 'food'),
(66, 91, 'allergy'),
(67, 91, 'test'),
(68, 92, 'food'),
(69, 92, 'allergy'),
(70, 92, 'test'),
(71, 93, 'food'),
(72, 93, 'allergy'),
(73, 93, 'test'),
(74, 94, 'food'),
(75, 94, 'allergy'),
(76, 94, 'test'),
(77, 95, 'food'),
(78, 95, 'allergy'),
(79, 95, 'test'),
(80, 96, 'food'),
(81, 96, 'allergy'),
(82, 96, 'test'),
(83, 97, 'food'),
(84, 97, 'allergy'),
(85, 97, 'test'),
(86, 98, 'food'),
(87, 98, 'allergy'),
(88, 98, 'test'),
(89, 99, 'food'),
(90, 99, 'allergy'),
(91, 99, 'test'),
(92, 100, 'food'),
(93, 100, 'allergy'),
(94, 100, 'test'),
(95, 101, 'food'),
(96, 101, 'allergy'),
(97, 101, 'test'),
(98, 102, 'food'),
(99, 102, 'allergy'),
(100, 102, 'test'),
(101, 103, 'food'),
(102, 103, 'allergy'),
(103, 103, 'test'),
(104, 104, 'food'),
(105, 104, 'allergy'),
(106, 104, 'test'),
(107, 105, 'food'),
(108, 105, 'allergy'),
(109, 105, 'test'),
(110, 106, 'food'),
(111, 106, 'allergy'),
(112, 106, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food_diet`
--

CREATE TABLE `tbl_transact_appoint_food_diet` (
  `diet_type_id` int(11) NOT NULL,
  `diet_type_name` varchar(20) NOT NULL,
  `appoint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food_diet`
--

INSERT INTO `tbl_transact_appoint_food_diet` (`diet_type_id`, `diet_type_name`, `appoint_id`) VALUES
(1, 'Vegan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food_dislike`
--

CREATE TABLE `tbl_transact_appoint_food_dislike` (
  `food_dislike_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `food_dislike_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food_dislike`
--

INSERT INTO `tbl_transact_appoint_food_dislike` (`food_dislike_id`, `appoint_id`, `food_dislike_name`) VALUES
(1, 1, 'dislike 1'),
(2, 1, 'dislike 2'),
(3, 1, 'dislike 3'),
(29, 73, 'dislike'),
(30, 73, 'test'),
(31, 74, 'food'),
(32, 74, 'dislike'),
(33, 74, 'test'),
(34, 75, 'food'),
(35, 75, 'dislike'),
(36, 75, 'test'),
(37, 76, 'food'),
(38, 76, 'dislike'),
(39, 76, 'test'),
(40, 77, 'food'),
(41, 77, 'dislike'),
(42, 77, 'test'),
(43, 78, 'food'),
(44, 78, 'dislike'),
(45, 78, 'test'),
(46, 79, 'food'),
(47, 79, 'dislike'),
(48, 79, 'test'),
(49, 80, 'food'),
(50, 80, 'dislike'),
(51, 80, 'test'),
(52, 81, 'food'),
(53, 81, 'dislike'),
(54, 81, 'test'),
(55, 82, 'food'),
(56, 82, 'dislike'),
(57, 82, 'test'),
(58, 91, 'food'),
(59, 91, 'dislike'),
(60, 91, 'test'),
(61, 92, 'food'),
(62, 92, 'dislike'),
(63, 92, 'test'),
(64, 93, 'food'),
(65, 93, 'dislike'),
(66, 93, 'test'),
(67, 94, 'food'),
(68, 94, 'dislike'),
(69, 94, 'test'),
(70, 95, 'food'),
(71, 95, 'dislike'),
(72, 95, 'test'),
(73, 96, 'food'),
(74, 96, 'dislike'),
(75, 96, 'test'),
(76, 97, 'food'),
(77, 97, 'dislike'),
(78, 97, 'test'),
(79, 98, 'food'),
(80, 98, 'dislike'),
(81, 98, 'test'),
(82, 99, 'food'),
(83, 99, 'dislike'),
(84, 99, 'test'),
(85, 100, 'food'),
(86, 100, 'dislike'),
(87, 100, 'test'),
(88, 101, 'food'),
(89, 101, 'dislike'),
(90, 101, 'test'),
(91, 102, 'food'),
(92, 102, 'dislike'),
(93, 102, 'test'),
(94, 103, 'food'),
(95, 103, 'dislike'),
(96, 103, 'test'),
(97, 104, 'food'),
(98, 104, 'dislike'),
(99, 104, 'test'),
(100, 105, 'food'),
(101, 105, 'dislike'),
(102, 105, 'test'),
(103, 106, 'food'),
(104, 106, 'dislike'),
(105, 106, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food_like`
--

CREATE TABLE `tbl_transact_appoint_food_like` (
  `food_like_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `food_like_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food_like`
--

INSERT INTO `tbl_transact_appoint_food_like` (`food_like_id`, `appoint_id`, `food_like_name`) VALUES
(1, 1, 'foodLikeTest1'),
(66, 93, 'food'),
(67, 93, 'like'),
(68, 93, 'test'),
(69, 94, 'food'),
(70, 94, 'like'),
(71, 94, 'test'),
(72, 95, 'food'),
(73, 95, 'like'),
(74, 95, 'test'),
(75, 96, 'food'),
(76, 96, 'like'),
(77, 96, 'test'),
(78, 97, 'food'),
(79, 97, 'like'),
(80, 97, 'test'),
(81, 98, 'food'),
(82, 98, 'like'),
(83, 98, 'test'),
(84, 99, 'food'),
(85, 99, 'like'),
(86, 99, 'test'),
(87, 100, 'food'),
(88, 100, 'like'),
(89, 100, 'test'),
(90, 101, 'food'),
(91, 101, 'like'),
(92, 101, 'test'),
(93, 102, 'food'),
(94, 102, 'like'),
(95, 102, 'test'),
(96, 103, 'food'),
(97, 103, 'like'),
(98, 103, 'test'),
(99, 104, 'food'),
(100, 104, 'like'),
(101, 104, 'test'),
(102, 105, 'food'),
(103, 105, 'like'),
(104, 105, 'test'),
(105, 106, 'food'),
(106, 106, 'like'),
(107, 106, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_food_status`
--

CREATE TABLE `tbl_transact_appoint_food_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_food_status`
--

INSERT INTO `tbl_transact_appoint_food_status` (`status_id`, `status_name`) VALUES
(1, 'Daily'),
(2, 'Weekly'),
(3, 'Monthly'),
(4, 'Ocassionally'),
(5, 'Never');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_medical`
--

CREATE TABLE `tbl_transact_appoint_medical` (
  `medical_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `current_medication` int(11) NOT NULL,
  `self_past_condition_id` int(11) NOT NULL,
  `family_past_condition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_medical`
--

INSERT INTO `tbl_transact_appoint_medical` (`medical_id`, `appoint_id`, `current_medication`, `self_past_condition_id`, `family_past_condition_id`) VALUES
(1, 1, 1, 1, 1),
(68, 93, 0, 1, 1),
(69, 94, 0, 1, 1),
(70, 95, 0, 1, 1),
(71, 96, 0, 1, 1),
(72, 97, 0, 1, 1),
(73, 98, 0, 1, 1),
(74, 99, 0, 1, 1),
(75, 100, 0, 1, 1),
(76, 101, 0, 1, 1),
(77, 102, 0, 1, 1),
(78, 103, 0, 1, 1),
(79, 104, 0, 1, 1),
(80, 105, 0, 1, 1),
(81, 106, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_physical`
--

CREATE TABLE `tbl_transact_appoint_physical` (
  `physical_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `actual_weight` varchar(20) NOT NULL,
  `current_height` varchar(20) NOT NULL,
  `body_type_id` int(11) DEFAULT NULL,
  `physical_activity_id` int(11) NOT NULL,
  `gain_weight_level_id` int(11) NOT NULL,
  `lose_weight_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_physical`
--

INSERT INTO `tbl_transact_appoint_physical` (`physical_id`, `appoint_id`, `actual_weight`, `current_height`, `body_type_id`, `physical_activity_id`, `gain_weight_level_id`, `lose_weight_level_id`) VALUES
(1, 1, 'weight test', 'height test', 1, 1, 1, 1),
(57, 80, '1', '1', NULL, 0, 0, 0),
(58, 81, '1', '1', NULL, 0, 0, 0),
(59, 82, '1', '1', NULL, 0, 0, 0),
(60, 91, '1', '1', NULL, 0, 0, 0),
(61, 92, '1', '1', NULL, 0, 0, 0),
(62, 93, '1', '1', NULL, 0, 0, 0),
(63, 94, '1', '1', NULL, 0, 0, 0),
(64, 95, '1', '1', NULL, 0, 0, 0),
(65, 96, '1', '1', NULL, 0, 0, 0),
(66, 97, '1', '1', NULL, 0, 0, 0),
(67, 98, '1', '1', NULL, 0, 0, 0),
(68, 99, '1', '1', NULL, 0, 0, 0),
(69, 100, '1', '1', NULL, 0, 0, 0),
(70, 101, '1', '1', NULL, 0, 0, 0),
(71, 102, '1', '1', NULL, 0, 0, 0),
(72, 103, '1', '1', NULL, 0, 0, 0),
(73, 104, '1', '1', NULL, 0, 0, 0),
(74, 105, '1', '1', NULL, 0, 0, 0),
(75, 106, '1', '1', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_appoint_physical_bodytype`
--

CREATE TABLE `tbl_transact_appoint_physical_bodytype` (
  `body_type_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `body_type_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_appoint_physical_bodytype`
--

INSERT INTO `tbl_transact_appoint_physical_bodytype` (`body_type_id`, `appoint_id`, `body_type_name`) VALUES
(1, 1, 'endomorph'),
(2, 1, 'ectomorph'),
(21, 94, 'endomorph'),
(22, 94, 'ectomorph'),
(23, 95, 'endomorph'),
(24, 96, 'endomorph'),
(25, 97, 'endomorph'),
(26, 98, 'endomorph'),
(27, 99, 'endomorph'),
(28, 100, 'endomorph'),
(29, 101, 'endomorph'),
(30, 102, 'endomorph'),
(31, 103, 'endomorph'),
(32, 104, 'endomorph'),
(33, 104, 'mesomorph'),
(34, 105, 'endomorph'),
(35, 106, 'endomorph');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_consult`
--

CREATE TABLE `tbl_transact_consult` (
  `consult_id` int(11) NOT NULL,
  `transact_id` int(11) NOT NULL,
  `rnd_id` int(11) NOT NULL,
  `consult_date_finish` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_consult`
--

INSERT INTO `tbl_transact_consult` (`consult_id`, `transact_id`, `rnd_id`, `consult_date_finish`) VALUES
(1, 1, 4, NULL),
(18, 118, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_consult_checkpoint_result_status`
--

CREATE TABLE `tbl_transact_consult_checkpoint_result_status` (
  `consult_result_status_id` int(11) NOT NULL,
  `transact_id` int(11) NOT NULL,
  `consult_result_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_consult_checkpoint_result_status`
--

INSERT INTO `tbl_transact_consult_checkpoint_result_status` (`consult_result_status_id`, `transact_id`, `consult_result_status`) VALUES
(1, 1, 'APPROVED'),
(2, 94, 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transact_consult_schedule`
--

CREATE TABLE `tbl_transact_consult_schedule` (
  `consult_schedule_id` int(11) NOT NULL,
  `consult_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `rnd_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transact_consult_schedule`
--

INSERT INTO `tbl_transact_consult_schedule` (`consult_schedule_id`, `consult_id`, `client_id`, `rnd_id`, `date`, `time`) VALUES
(1, 1, 1, 3, '2023-04-01', '03:32:48'),
(21, 3, 1, 3, '2023-02-08', '23:04:00'),
(22, 11, 9, 3, '2023-02-09', '22:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_acc_info`
--

CREATE TABLE `tbl_user_acc_info` (
  `acc_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_acc_info`
--

INSERT INTO `tbl_user_acc_info` (`acc_no`, `user_id`, `email`, `pass`, `status`) VALUES
(1, 1, 'test@gmail.com', 'test', 'VERIFIED'),
(2, 0, 'test1@gmail.com', 'test', '1'),
(3, 3, 'test2@gmail.com', 'test', '1'),
(5, 6, '', 'jaydee', 'VERIFIED'),
(7, 8, 'jenny.humbong@gmail.com', 'test', 'VERIFIED'),
(8, 9, 'onthemakings@gmail.com', 'test', 'VERIFIED'),
(9, 10, 'wilhelmus.morales@gmail.com', 'jaydee', 'VERIFIED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profile`
--

CREATE TABLE `tbl_user_profile` (
  `user_id` int(11) NOT NULL,
  `user_privilege` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_profile`
--

INSERT INTO `tbl_user_profile` (`user_id`, `user_privilege`, `user_type`, `first_name`, `middle_name`, `last_name`, `contact`, `gender`, `birthdate`, `profile_img`) VALUES
(1, 'client', 'student', 'Test', 'Regondola', 'Client', '09972976807', 1, '2001-11-11', ''),
(3, 'rnd', '', 'Test', 'TITE', 'Admin', '09943568375', 1, '2001-11-11', ''),
(6, '', '', 'Benjie', 'tite', 'Asese', '09963573468', 1, '2023-02-02', ''),
(8, 'rnd', '', 'Jenny', '', 'Humbong', 'jaydee', 1, '2023-02-02', ''),
(9, '', '', 'Sum', '', 'Sum', '09964523546', 1, '2023-02-03', ''),
(10, 'client', 'Student', 'wilhelmus', '', 'Ole', '09943568375', 1, '2023-02-08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  ADD PRIMARY KEY (`gender_id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_transact`
--
ALTER TABLE `tbl_transact`
  ADD PRIMARY KEY (`transact_id`);

--
-- Indexes for table `tbl_transact_appoint`
--
ALTER TABLE `tbl_transact_appoint`
  ADD PRIMARY KEY (`appoint_id`);

--
-- Indexes for table `tbl_transact_appoint_checkpoint_appoint_status`
--
ALTER TABLE `tbl_transact_appoint_checkpoint_appoint_status`
  ADD PRIMARY KEY (`appoint_checkpoint_appoint_status_id`);

--
-- Indexes for table `tbl_transact_appoint_checkpoint_rnd_status`
--
ALTER TABLE `tbl_transact_appoint_checkpoint_rnd_status`
  ADD PRIMARY KEY (`appoint_checkpoint_rnd_status_id`);

--
-- Indexes for table `tbl_transact_appoint_client`
--
ALTER TABLE `tbl_transact_appoint_client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_transact_appoint_consult`
--
ALTER TABLE `tbl_transact_appoint_consult`
  ADD PRIMARY KEY (`consult_id`);

--
-- Indexes for table `tbl_transact_appoint_food`
--
ALTER TABLE `tbl_transact_appoint_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_transact_appoint_food_allergy`
--
ALTER TABLE `tbl_transact_appoint_food_allergy`
  ADD PRIMARY KEY (`food_allergy_id`);

--
-- Indexes for table `tbl_transact_appoint_food_diet`
--
ALTER TABLE `tbl_transact_appoint_food_diet`
  ADD PRIMARY KEY (`diet_type_id`);

--
-- Indexes for table `tbl_transact_appoint_food_dislike`
--
ALTER TABLE `tbl_transact_appoint_food_dislike`
  ADD PRIMARY KEY (`food_dislike_id`);

--
-- Indexes for table `tbl_transact_appoint_food_like`
--
ALTER TABLE `tbl_transact_appoint_food_like`
  ADD PRIMARY KEY (`food_like_id`);

--
-- Indexes for table `tbl_transact_appoint_food_status`
--
ALTER TABLE `tbl_transact_appoint_food_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_transact_appoint_medical`
--
ALTER TABLE `tbl_transact_appoint_medical`
  ADD PRIMARY KEY (`medical_id`);

--
-- Indexes for table `tbl_transact_appoint_physical`
--
ALTER TABLE `tbl_transact_appoint_physical`
  ADD PRIMARY KEY (`physical_id`);

--
-- Indexes for table `tbl_transact_appoint_physical_bodytype`
--
ALTER TABLE `tbl_transact_appoint_physical_bodytype`
  ADD PRIMARY KEY (`body_type_id`);

--
-- Indexes for table `tbl_transact_consult`
--
ALTER TABLE `tbl_transact_consult`
  ADD PRIMARY KEY (`consult_id`);

--
-- Indexes for table `tbl_transact_consult_checkpoint_result_status`
--
ALTER TABLE `tbl_transact_consult_checkpoint_result_status`
  ADD PRIMARY KEY (`consult_result_status_id`);

--
-- Indexes for table `tbl_transact_consult_schedule`
--
ALTER TABLE `tbl_transact_consult_schedule`
  ADD PRIMARY KEY (`consult_schedule_id`);

--
-- Indexes for table `tbl_user_acc_info`
--
ALTER TABLE `tbl_user_acc_info`
  ADD PRIMARY KEY (`acc_no`);

--
-- Indexes for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gender` (`gender`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gender`
--
ALTER TABLE `tbl_gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transact`
--
ALTER TABLE `tbl_transact`
  MODIFY `transact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint`
--
ALTER TABLE `tbl_transact_appoint`
  MODIFY `appoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_checkpoint_appoint_status`
--
ALTER TABLE `tbl_transact_appoint_checkpoint_appoint_status`
  MODIFY `appoint_checkpoint_appoint_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_checkpoint_rnd_status`
--
ALTER TABLE `tbl_transact_appoint_checkpoint_rnd_status`
  MODIFY `appoint_checkpoint_rnd_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_client`
--
ALTER TABLE `tbl_transact_appoint_client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_consult`
--
ALTER TABLE `tbl_transact_appoint_consult`
  MODIFY `consult_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food`
--
ALTER TABLE `tbl_transact_appoint_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food_allergy`
--
ALTER TABLE `tbl_transact_appoint_food_allergy`
  MODIFY `food_allergy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food_diet`
--
ALTER TABLE `tbl_transact_appoint_food_diet`
  MODIFY `diet_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food_dislike`
--
ALTER TABLE `tbl_transact_appoint_food_dislike`
  MODIFY `food_dislike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food_like`
--
ALTER TABLE `tbl_transact_appoint_food_like`
  MODIFY `food_like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_food_status`
--
ALTER TABLE `tbl_transact_appoint_food_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_medical`
--
ALTER TABLE `tbl_transact_appoint_medical`
  MODIFY `medical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_physical`
--
ALTER TABLE `tbl_transact_appoint_physical`
  MODIFY `physical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_transact_appoint_physical_bodytype`
--
ALTER TABLE `tbl_transact_appoint_physical_bodytype`
  MODIFY `body_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_transact_consult`
--
ALTER TABLE `tbl_transact_consult`
  MODIFY `consult_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_transact_consult_checkpoint_result_status`
--
ALTER TABLE `tbl_transact_consult_checkpoint_result_status`
  MODIFY `consult_result_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transact_consult_schedule`
--
ALTER TABLE `tbl_transact_consult_schedule`
  MODIFY `consult_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user_acc_info`
--
ALTER TABLE `tbl_user_acc_info`
  MODIFY `acc_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
